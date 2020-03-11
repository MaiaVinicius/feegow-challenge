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

                    if(value.foto.length == 0){
                        value.foto = doctorAvatar;
                    }
                    $("#doctorsCase").append(
                        '            <div class="col-md-2">\n' +
                        '                <img src="'+value.foto+'"  width="75" class="rounded-circle">\n' +
                        '                <h5>'+value.tratamento+' '+value.nome+'</h5>\n' +
                        '                <h5>'+value.conselho+' '+value.documento_conselho+'</h5>\n' +
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
            jQuery.ajax({
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

                },
                failure: function (result) {

                }});
        });
    });



