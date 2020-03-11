    $("#choosenSpecialist").on('change',function () {
        var specialist = $(this).find('select option:selected').html();
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
                        '                <button class="btn btn-success" id="agendar">Agendar</button>\n' +
                        '            </div>'
                    );

                });
            },
            failure: function (result) {
                $("#resultsFound").html("Ops: Houve um problema na comunicação, por favor tente mais tarde");
            }});
    });
$("#doctorsCase").on('click','#agendar',function () {
    $('#formAgendamento').modal('show');
});

