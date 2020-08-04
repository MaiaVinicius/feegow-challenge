$(document).ready(function () {
  function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i = 1; i <= 9; i++)
      Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if (Resto == 10 || Resto == 11) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++)
      Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if (Resto == 10 || Resto == 11) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
  }
  function formatarTexto(string) {
    if (typeof string !== "string") return "";
    string = string.replace(/[^a-zA-Z\u00C0-\u024F]/g, " ").trim();
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
  $(".lista_especialidades").select2({
    ajax: {
      dataType: "json",
      url: "https://api.feegow.com.br/api/specialties/list",

      headers: {
        "x-access-token":
          "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38",
      },

      processResults: function (data) {
        return {
          results: $.map(data.content, function (item) {
            return {
              text: formatarTexto(item.nome),
              id: item.especialidade_id,
            };
          }),
        };
      },
      cache: true,
      // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
    },
    placeholder: "Selecione uma especialidade",
    cache: true,
    width: "resolve", // need to override the changed default
  });

  $(".lista_especialidades").on("select2:select", function (e) {
    var data = e.params.data;
    $("#result")
      .empty()
      .append(
        '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
      );
    $("#specialty_id").val(data.id);
    $.ajax({
      url: "./src/classes/Professionals.php",
      type: "GET",
      data: {
        action: "listar",
        especialidade_id: data.id,
      },
      async: "true",
      cache: "false",
      success: function (data, textStatus, xhr) {
        $("#result").empty().html(data);

        //    console.log(JSON.parse(data));
      },
    });
  });

  $("#consult").on("show.bs.modal", function (e) {
    $(".lista_como_conheceu").select2({
      ajax: {
        dataType: "json",
        url: "https://api.feegow.com.br/api/patient/list-sources",

        headers: {
          "x-access-token":
            "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38",
        },
        processResults: function (data) {
          return {
            results: $.map(data.content, function (item) {
              return {
                text: item.nome_origem,
                id: item.origem_id,
              };
            }),
          };
        },
        cache: true,
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
      },
      placeholder: "Como nos conheceu?",
      cache: true,
      width: "resolve", // need to override the changed default
    });
    $(".cpf").mask("000.000.000-00", {
      reverse: true,
      placeholder: "CPF",
      onComplete: function (cpf) {
        cpf = cpf.replace(/\D/g, '');
        if (!TestaCPF(cpf)) {
          alert("Digite um cpf válido");
          $(".cpf").val("");
        }
      },
    });
  });
});

function abrirAgendamento(e, id) {
  $("#profissional_id").val(id);
  e.preventDefault();
  $("#consult").modal();
}

$("#enviar_consulta").click(function (e) {
  e.preventDefault();
  var dados = $("#agendar_consulta").serializeArray();
  dados.push({
    name: "action",
    value: "insert",
  });
  $.ajax({
    url: "./src/classes/Agendamento.php",
    type: "POST",
    data: dados,
    async: "true",
    success: function (data, textStatus, xhr) {
      if (data > 0) {
        $(".modal").modal("hide");
        $(".toast").toast("show");
        $("input[name=name]").val("");
        $("input[name=source_id]").val("");
        $("input[name=birthdate]").val("");
        $("input[name=cpf]").val("");
      }
    },
  });
});

function removeLoader() {
  $("#loadingDiv").fadeOut(500, function () {
    // fadeOut complete. Remove the loading div
    $("#loadingDiv").remove(); //makes page more lightweight
  });
}
