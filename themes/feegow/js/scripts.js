$(function () {
    BASE = $("link[rel='base']").attr("href");
    var ajaxUrl = BASE + '/themes/feegow/_ajax/feegow.ajax.php';
    var baseUrl = "https://api.feegow.com.br/api";

    $.ajaxSetup({
        dataType: "JSON",
        headers: {
            "x-access-token":
                "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38",
        },
    });

    $.ajax({
        url: baseUrl + "/specialties/list",
        data: {
            ativo: 1,
        },
        success: function (data) {
            $.each(data.content, function (i, item) {
                var option = $("<option>", {
                    text: item.nome,
                    value: item.especialidade_id,
                });
                $("#specialties").append(option);
            });
        },
    });

    $.get(baseUrl + "/patient/list-sources", (data) => {
        $.each(data.content, function (i, item) {
            var option = $("<option>", {
                text: item.nome_origem,
                value: item.origem_id,
            });
            $("#source").append(option);
        });
    });

    /* Seleciona Profissionais */
    $("#specialties").on("change", function () {
        var specialty = $(this).val();

        $("#container").html("");

        if (!specialty) {
            return false;
        }

        $.ajax({
            url: baseUrl + "/professional/list",
            data: {
                ativo: 1,
                especialidade_id: specialty,
            },
            success: function (data) {
                var container = $("#container");
                container.html("");

                $.each(data.content, function (i, item) {
                    var sexo = (item.sexo.toLowerCase() == 'masculino' ? 'Dr. ' : 'Dra. ');
                    var conselho = (item.conselho == null ? 'CRM' : item.conselho);
                    var documentoConselho = (item.documento_conselho == "" ? 'N達o Informado' : item.documento_conselho);
                    var foto = (item.foto == null ? "https://functions.feegow.com/load-image?licenseId=105&folder=Perfil&file=8e71a5e588b6460dc027a5f1c2abfb90.jpg&renderMode=redirect" : item.foto);

                    var box =
                        "<div class='app_schedule_box'>" +
                        "<div class='app_schedule_img'>" +
                        "<img src=" + foto + " title=" + item.nome + " alt=" + item.nome + " />" +
                        "</div>" +

                        "<div class='app_schedule_desc'>" +
                        "<h3>" + sexo + " " + item.nome + "</h3>" +
                        "<span>" + conselho + ": " + documentoConselho + "</span>" +
                        "<button type='submit' class='btn_schedule' title='Agendar' data-professional='" + item.profissional_id + "' data-specialty='" + specialty + "'>Agendar</button>" +
                        "</div>" +
                        "</div>";


                    container.append(box);
                });
            },
        });
    });

    $('html').on('click', '.btn_schedule', function () {
        $('#container_specialty').fadeOut(400, function () {
            $('#container').fadeOut(400, function () {
                $('#container_data').fadeIn(400);
            });
        });
    });

    $('html').on('submit', 'form[name="form_data"]', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var button = $('.btn_schedule');

        var specialty = button.data("specialty");
        var professional = button.data("professional");
        var formData = $(this);
        formData.find("#specialty_id").val(specialty);
        formData.find("#professional_id").val(professional);
        var data = formData.serialize() + '&action=create_schedule';

        $.post(ajaxUrl, data, function (data) {
            if (data.send) {
                $('.j_sended_name').text(data.send);
                $('#container_data').fadeOut(400, function () {
                    $('.j_container_sended').fadeIn(400);
                });
            }
        }, 'json');
    });

    $('html').on('click', '.btn_cancel', function (e) {
        location.reload();
    });

    $('.j_container_sended_close').click(function () {
        $('.j_container_sended').fadeOut(200);
        $('#container_specialty').fadeIn(400, function () {
            $(this).trigger('reset');
            location.reload();
        });
        return false;
    });

    $(".j_mobile_menu").click(function (e) {
        e.preventDefault();
        var menu = $(this);
        var menu_nav = $(".j_mobile_menu_nav");
        if (menu.hasClass("opened")) {
            menu_nav.slideUp(200, function () {
                menu.removeClass("opened icon-cancel-circle").addClass("icon-menu");
            });
        } else {
            menu.addClass("opened icon-cancel-circle").removeClass("icon-menu");
            menu_nav.slideDown(200);
        }
    });

    $("*[data-scroll]").click(function (e) {
        var scroll = $("." + $(this).attr("data-scroll"));
        if (scroll.length) {
            $("html, body").animate({ scrollTop: scroll.offset().top }, 800);
        } else {
            $("html, body").animate({ scrollTop: 0 }, 800);
        }
        return false;
    });
});

