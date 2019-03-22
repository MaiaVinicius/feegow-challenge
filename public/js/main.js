function getLoading(){
    var html = '<div class="spinner-border text-success text-center" role="status"><span class="sr-only">Loading...</span></div>';
    return html;
}
function searchDoctor(specialty_id){

    $.ajax({
        url: '/search',
        cache: false,
        type: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: 'specialty_id='+specialty_id,
        dataType: 'html',
        beforeSend: function (xhr) {
            $('#doctors').html(getLoading());
        },
        success: function(response) {
            if(response){
                $('#doctors').html(response);
            }else{
                $('#doctors').html("Nenhum médico encontrado para a especialidade.");
            }
        },
        error: function () {
            $('#doctors').html('');
            alert('Erro ao processar');

        }
    }).done(function() {
    });
}

function doSchedule(data){

    $.ajax({
        url: '/schedule',
        cache: false,
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,
        dataType: 'json',
        beforeSend: function (xhr) {
        },
        success: function(response) {
            alert(response.message);
            if(response.success === true) {
                $('#formSchedule')[0].reset();
                $('#source_id').val('').trigger('change');
                $('#modal_agendar').modal('hide');
            }
        },
        error: function () {
        }
    }).done(function() {
    });
}

function validateCpf(strCPF){
    var Soma;
    var Resto;
    strCPF = strCPF.replace(/\D/g, '');
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

function validateBirthdate(date){
    var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(date);
    if (matches == null) return false;
    var d = matches[1];
    var m = matches[2] - 1;
    var y = matches[3];
    var composedDate = new Date(y, m, d);

    if(composedDate.getDate() == d &&
        composedDate.getMonth() == m &&
        composedDate.getFullYear() == y){
        if(composedDate.valueOf() > new Date().valueOf()) return false;

        return true;
    }

    return false;
}

$(function() {
    $("#birthdate").mask("99/99/9999");
    $("#cpf").mask("999.999.999-99");


    $("#btnSearch").on("click", function () {
        let specialty_id = $('#specialty').val();
        if(specialty_id){
            searchDoctor(specialty_id);
        }else{
            alert('Selecione uma especialidade');
        }

    });

    $(document).on("click", '#btnSchedule', function () {
        let professional_id = $(this).attr('professional_id');
        let specialty_id = $('#specialty').val();

        if(professional_id && specialty_id){
            $('#specialty_id').val(specialty_id);
            $('#professional_id').val(professional_id);
            $("#modal_agendar").modal();
        }else{
            $('#formSchedule')[0].reset();
            alert('Falha no processo');

        }

    });

    $(".close").on("click", function () {
        $('#formSchedule')[0].reset();
    });

    $("#formSchedule").on("submit", function () {
        let data = $('#formSchedule').serialize();

        let vCpf = validateCpf($('#cpf').val());
        let vBd = validateBirthdate($('#birthdate').val());


        if(vCpf === false){
            alert('CPF inválido');
            $('#cpf').focus();
            return false;
        }

        if(vBd === false){
            alert('Data de nascimento inválida');
            $('#birthdate').focus();
            return false;
        }

        doSchedule(data);
        return false;
    });

});



