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
                    title: "Horário solicitado com sucesso!",
                    type: 'success',
                });
            },
            error: function (data) {
                $(form).find('.alert-danger').find('ul').html('');
                $.each(data.responseJSON.errors, function (key, value) {
                    $(form).find('.alert-danger').show();
                    $(form).find('.alert-danger').find('ul').append('<li>' + value + '</li>');
                });
            }
        });

        return false;
    };

    $("#especialidade").on("change", function(){
        $("#cards").html('<img class=" mx-auto d-block" src="/images/load.gif" />');
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
            $("#cards").html('');
            console.log(data)
            $("#cardsTemplate").tmpl(data).appendTo("#cards");
        });
    });

    $("#cards").on("click", ".agendar", function(){
        var professional_id = $(this).data("professional_id");
        var specialty_id = $(this).data("specialty_id");
        Swal.fire({
            html: $("#formTemplate").tmpl($(this).data()),
            type: 'info',
            showConfirmButton: false,
        });
    });
});