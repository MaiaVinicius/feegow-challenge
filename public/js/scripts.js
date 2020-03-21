$(document).ready(function(){
    $('#cpf').mask('999.999.999-99');
    $('.dvLoading').hide();

    $('#specialtiesList').change(function(){
        $('#dvDoctors').empty();
        $('.dvLoading').show();
        
        id = $(this).val();
        $('#specialty_id').val(id);

        $.ajax({
            url: public_path + '/professionals',
            data: {
                id: id
            },
            success: function(response){
                $('.dvLoading').hide();
                if (!response.error) {
                    createCardProfessional(response.professionals);
                } else {
                    $.notify({ message: response.message }, { type: 'warning' });
                }
            }
        });
    });

    $('#saveSchedule').click(function(){
        $('#formSchedule').submit();
    });
});

function createCardProfessional (professionals)
{
    $('.titleHidden').show();
    for (i = 0; i < professionals.length; i++) {
        tratamento = professionals[i].tratamento != null ? professionals[i].tratamento : '';
        conselho = professionals[i].conselho != null ? professionals[i].conselho : '';
        documento_conselho = professionals[i].documento_conselho != null ? professionals[i].documento_conselho : '';

        image = professionals[i].foto != "" ? professionals[i].foto : "images/professional.png";

        card = "<div class='card cardProfessional'>"
            + " <div class='row'>"
            + "     <div class='col-md-4 center dvPhoto'>"
            + "         <img src='" + image + "' class='img-fluid imgPhoto'/>"
            + "     </div>"
            + "     <div class='col-md-8'>"
            + "         <div class='row'><div class='col-md-12 center'><b>" + tratamento + ' ' + professionals[i].nome + "</b></div></div>"
            + "         <div class='row'><div class='col-md-12 center'>" + conselho + ' ' + documento_conselho + "</div></div>"
            + "     </div>"
            + " </div>"
            + " <div class='row'><div class='col-md-12 center'>"
            + "     <button type='button' class='btn btn-success btn-sm btnSchedule' id='" + professionals[i].profissional_id + "'>" + lang_agendar + "</button>"
            + " </div></div>"
            + "</div>";
        
        $('#dvDoctors').append(card);
    }

    $('.btnSchedule').click(function() {
        id = $(this).attr('id');
        modalSchedule(id);
    });
}

function modalSchedule (professional_id) {
    $('#professional_id').val(professional_id);
    $('#name').val('');
    $('#source_id').val("");
    $('#birthdate').val("");
    $('#cpf').val("");

    $('#scheduleModal').modal('show');
}