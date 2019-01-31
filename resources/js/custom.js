$(function () {

    submitForm = function(form) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "/api/solicitacaohorario",
            method: 'post',
            data: $(form).serialize(),
            success: function (data) {
                Swal.fire({
                    text: "Horário solicitado com sucesso!",
                    type: 'success',
                });
            },
            error: function (data) {
                $(form).find('.alert-danger').html('');
                $.each(data.responseJSON.errors, function (key, value) {
                    $(form).find('.alert-danger').show();
                    $(form).find('.alert-danger').append('<p>' + value + '</p>');
                });
            }
        });

        return false;
    };

    $("#especialidade").on("change", function(){
        $("#cards").html('');
        var specialty_id = $(this).val();
        $.ajax({
            url: "/profissionais/"+specialty_id,
            context: document.body
        }).done(function(obj) {
            data = $.map(obj, function(el) { return el });
            text = data.length + ' ' + $("#especialidade option:selected").text() + ' encontrado(s) ';
            $(".mt-5").html(text);
            if(data[0]) {
                data[0]['specialty_id'] = specialty_id;
            }
            $("#attendeesTemplate").tmpl(data).appendTo("#cards");
        });
    });

    $("#cards").on("click", ".agendar", function(){
        var professional_id = $(this).data("professional_id");
        var specialty_id = $(this).data("specialty_id");
        Swal.fire({
            html: $("#formTemplate").tmpl($(this).data()),
            type: 'info',
        });
        $(".cpf").mask("999.999.999-99");
    });
});