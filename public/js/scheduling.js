$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#choosenSpecialty").on('change',function () {
    var specialist = $(this).val();
    jQuery.ajax({
        url: urlGetSpecialties,
        method: 'get',
        data: {
            especialidade_id: $(this).val(),
        },
        success: function(result){
            $("#doctorsCase").html("");
            let listDoctors = JSON.parse(result).content;
            $("#resultsFound").html(listDoctors.length + " encontrados");
            $.each(listDoctors,function (key, value) {
                let tratamento = '';let conselho = '';let documento_conselho ='';
                if(value.foto.length == 0){
                    value.foto = doctorAvatar;
                }
                if(value.tratamento != null)
                {
                    tratamento = value.tratamento;
                }
                if(value.conselho != null)
                {
                    conselho = value.conselho;
                }
                if(value.documento_conselho != null)
                {
                    documento_conselho = value.documento_conselho;
                }

                $("#doctorsCase").append(
                    '            <div class="col-md-3 drCell">\n' +
                    '                <img src="'+value.foto+'"  class="rounded-circle">\n' +
                    '                <h5>'+ tratamento +' '+ value.nome +'</h5>\n' +
                    '                <h5>'+ conselho +' '+ documento_conselho +'</h5>\n' +
                    '                <button class="btn btn-success" id="agendar" idDoctor="'+value.profissional_id+'">Agendar</button>\n' +
                    '            </div>'
                );

            });
        },
        failure: function (result) {
            $("#resultsFound").html("Ops: Houve um problema na comunicação, por favor tente mais tarde");
        }});
});
//triggering Modal
$("#doctorsCase").on('click','#agendar',function () {
    $('#formAgendamento').modal('show');
    var profissional_id = $(this).attr("idDoctor");
    $("#enviarForm").click(function () {
        jQuery.ajax(
            {
                url: schedulingSave,
                method: 'put',
                data: {
                    professional_id:profissional_id,
                    cpf:$("#cpf").val(),
                    birth_date:$("#birthday").val(),
                    name:$("#name").val(),
                    source_id:$("#source_id").val(),
                    specialty_id:$("#choosenSpecialty").val()
                },
                success: function(result){
                    $('#formAgendamento').modal('hide');
                    $("#success").append("" +
                        "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">\n" +
                        "  <strong> Obrigado pela preferência </strong> Seu Agendamento foi criado com sucesso!.\n" +
                        "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                        "    <span aria-hidden=\"true\">&times;</span>\n" +
                        "  </button>\n" +
                        "</div>");
                },
                failure: function (result) {
                    alert("Erro ao salvar");
                    $('#formAgendamento').modal('hide');
                },error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    $("#resp").html();
                    $.each(errors.errors, function (key, value) {
                        $("#resp").append("" +
                            "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                            "  <strong> OPS! </strong> " + value + ".\n" +
                            "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                            "    <span aria-hidden=\"true\">&times;</span>\n" +
                            "  </button>\n" +
                            "</div>");
                    });
                }
            }
        );
    });
});



