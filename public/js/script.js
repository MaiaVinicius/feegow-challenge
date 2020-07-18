$(document).ready(function () {
    let baseUrl = "https://api.feegow.com.br/api";

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
                let option = $("<option>", {
                    text: item.nome,
                    value: item.especialidade_id,
                });
                $("#specialties").append(option);
            });
        },
    });

    $.get(baseUrl + "/patient/list-sources", (data) => {
        $.each(data.content, function (i, item) {
            let option = $("<option>", {
                text: item.nome_origem,
                value: item.origem_id,
            });
            $("#source").append(option);
        });
    });

    $("#cpf").mask("999.999.999-99");

    $("#specialties").on("change", function () {
        let specialty = $(this).val();

        $("#result").html("");

        if (!specialty) {
            return false;
        }

        $.ajax({
            url: baseUrl + "/professional/list",
            data: {
                ativo: 0,
                especialidade_id: specialty,
            },
            beforeSend: function () {
                $("#result").html("<img src='/images/loading.svg' id='loading'>");
            },
            success: function (data) {

                let cardGroup = $("<div>", { class: "card-group" });
                let result = $("#result");

                result.html("");

                $.each(data.content, function (i, item) {
                    let tratamento = acertaTratamento(item);
                    let card = $("<div>", {
                        class: "card",
                        id: "card-" + i,
                    });

                    let cardBody = $("<div>", { class: "card-body" });
                    let cardBodyTitle = $("<h5>", {
                        class: "card-title",
                        text: tratamento + " " + item.nome,
                    });
                    let cardBodyText = $("<p>", {
                        class: "card-text",
                        html:
                            '<small class="text-mutted">' +
                            item.especialidades
                                .map(
                                    (espec) =>
                                        espec.nome_especialidade +
                                        " " +
                                        espec.CBOS
                                )
                                .join("<br>") +
                            "</small>",
                    });

                    let imgCard = $("<img>", {
                        class: "card-img-top",
                        alt: tratamento + " " + item.nome,
                        src: item.foto,
                    });

                    let link = $("<a>", {
                        text: "Agendar",
                        class: "link-agendar text-center agendar mb-2",
                        "data-toggle": "modal",
                        "data-target": "#modalSchedule",
                        "data-professional": item.profissional_id,
                        "data-specialty": specialty,
                    });

                    cardBody.append(cardBodyTitle);
                    cardBody.append(cardBodyText);

                    card.append(imgCard);
                    card.append(cardBody);
                    card.append(link);

                    cardGroup.append(card);

                    result.append(cardGroup);
                });
            },
        });
    });

    $("#modalSchedule").on("show.bs.modal", function (event) {
        let button = $(event.relatedTarget);

        let professional = button.data("professional");
        let specialty = button.data("specialty");

        var modal = $(this);

        modal.find("#specialty_id").val(specialty);
        modal.find("#professional_id").val(professional);
    });

    $("#modalSchedule").on("hidden.bs.modal", function (event) {
        var modal = $(this);

        $("#nome").val("");
        $("#cpf").val("");
        $("#birthdate").val("");
        $("#agendamento").val("");
        $("#date_time").val("");

        modal.find("#specialty_id").val(0);
        modal.find("#professional_id").val(0);
    });

    $(".requerido").on("blur", function () {
        if ($(this).val() === "") {
            $(this).addClass("is-invalid");
        }
    });

    function acertaTratamento(item) {
        if (item.tratamento == null) {
            if (item.sexo.toLowerCase() == "masculino") {
                return "Dr.";
            } else {
                return "Dra.";
            }
        }

        return item.tratamento;
    }

    $("#confirm-agendamento").on("click", function () {
        $("#form-agendamento").submit();
    });

    $("#form-agendamento").on("submit", function (event) {
        event.preventDefault();

        let form = $(this);

        $.ajax({
            url: form.attr("action"),
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: form.serialize(),
            type: form.attr("method"),
            beforeSend: function () {
                $("#confirm-agendamento")
                    .addClass("disabled")
                    .html("Enviando...");
                $("#mensagem").removeClass("alert alert-success");

                let canSubmit = verificaObrigatorios();
                if (!canSubmit) {
                    $("#confirm-agendamento")
                        .removeClass("disabled")
                        .html("Agendar");
                }

                return canSubmit;
            },
            success: function (data, status) {
                $("#mensagem")
                    .addClass("alert alert-success")
                    .html("Agendamento efetuado com sucesso! ");

                escondeModal();
            },
            fail: function (data) {
                $("#mensagem")
                    .addClass("alert alert-success")
                    .html(
                        "Erro ao processar os dados por favor verifique e tente novamente!"
                    );

                escondeModal();
            },
        });
    });

    function escondeModal() {
        setTimeout(function () {
            $("#modalSchedule").modal("hide");
        }, 3000);
    }

    function verificaObrigatorios() {
        let canSubmit = true;
        $(".required").removeClass("is-invalid");
        $(".required").each(function () {
            let item = $(this);
            if (item.val() === "" || typeof item.val() === null) {
                item.addClass("is-invalid");
                canSubmit = false;
            }
        });
        return canSubmit;
    }
});
