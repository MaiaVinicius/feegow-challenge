const apiURL = 'https://api.feegow.com.br/api';
const apiTOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38';
const headers = {
    'x-access-token': apiTOKEN
}

function maskCPF() {
    IMask($(this)[0], { mask: '000.000.000-00' });
}

async function getSpecialities() {
    const { data: { content: specialities } } = await axios.get(`${apiURL}/specialties/list`, { headers });

    const selectSpecialities = $('#specialities');

    specialities.map(speciality => {
        let optionEl = `<option value="${speciality.especialidade_id}">${speciality.nome}</option>`;

        selectSpecialities.append(optionEl);
    });
}

async function getSources() {
    const { data: { content: sources } } = await axios.get(`${apiURL}/patient/list-sources`, { headers });

    const selectSources = $('#sources');

    sources.map(source => {
        let optionEl = `<option value="${source.origem_id}">${source.nome_origem}</option>`;

        selectSources.append(optionEl);
    });
}

async function handleSearchProfessionals() {
    hideFormConsulta();

    const selectSpecialities = $('#specialities');
    const resultCards = $('#result-cards');
    const resultMessage = $('#result-message')
    const specilityId = selectSpecialities.val();

    if (specilityId == 0) return;

    resultCards.empty();

    const { data } = await axios.get(`${apiURL}/professional/list?especialidade_id=${specilityId}`, { headers });

    if (data.success == false)
        $.toast({
            heading: 'Atenção',
            text: 'Nenhum registro encontrado.',
            icon: 'error',
            loader: true,
            position: 'bottom-center'
        })

    const { content: professionals } = data;

    resultMessage.html(`<b>${professionals.length}</b> registro(s) encontrado(s).`);
    professionals.map(professional => {

        const slicedName = professional.nome.toLowerCase().split(" ");
        const name = slicedName.map(name => (name.charAt(0).toUpperCase() + name.slice(1))).join(" ");

        let professionalCard = `<div class="card professionals p-0" id="professional:${professional.profissional_id}">
                                    <div class="card-body p-2 d-flex justify-content-around">
                                        <img src="${professional.foto || 'https://functions.feegow.com/load-image?licenseId=105&folder=Perfil&file=464b312ca95ffed66f118352fc7bbaa0.jpg&renderMode=redirect'}" alt="Card image cap">
                                        <p class="card-title ml-2"><a>${professional.tratamento || ""} ${name}</a></p>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-success btn-sm btn-block mx-0" onclick="openFormConsulta('${professional.profissional_id}', '${specilityId}')"' >Agendar</button>
                                    </div>
                                </div>`

        resultCards.append(professionalCard)
    });
}

function hideFormConsulta() {
    $('#form-consulta').addClass("d-none");
}

function openFormConsulta(professionalId, specialityId) {
    const formConsulta = $('#form-consulta');

    formConsulta.find("form input[type='hidden']").remove();

    formConsulta.removeClass("d-none");
    formConsulta.find("form")
        .prepend(`<input type="hidden" name="professional_id" value="${professionalId}">`)
        .prepend(`<input type="hidden" name="specialty_id" value="${specialityId}">`);
}

function handleSubmitConsulta(event) {
    event.preventDefault();

    const form = $(this);
    const method = form.attr('method');
    const actionUrl = form.attr('action');

    $.ajax({
        type: method,
        url: actionUrl,
        data: form.serializeArray(),
        success: function (response) {
            $.toast({
                heading: 'Sucesso!',
                text: `${response}. Aguarde a página recarregar.`,
                icon: 'success',
                loader: true,
                position: 'bottom-center'
            });

            setTimeout(() => location.reload(), 5000);
        },
        error: function (reject) {

            const error = reject.responseJSON;

            if (error.hasOwnProperty('validation')) {

                const validationMessages = error.validation;

                form.find("small.sm-message").remove();
                form.find("[name]").removeClass("is-invalid");

                $.each(validationMessages, function (target, value) {
                    $.each(value, function (name, message) {
                        form
                            .find(`[name="${target}"]`)
                            .addClass("is-invalid")
                            .after(
                                `<small 
                                class="sm-message text-danger">
                                ${message}
                            </small>`
                            );
                    });
                });
            }

            if (error.hasOwnProperty('error')) {
                $.toast({
                    heading: 'Ops!',
                    text: error.error,
                    icon: 'error',
                    loader: true,
                    position: 'bottom-center'
                });
            }
        },
        beforeSend: function () { },
    });
}

function registerEvents() {
    $('#search-professionals').on("click", handleSearchProfessionals);
    $('#cancel-consulta').on("click", hideFormConsulta);
    $('#open-consulta').on("click", openFormConsulta);
    $('.cpf').on("keyup", maskCPF);
    $('#save-consulta').on("submit", handleSubmitConsulta);
}

function render() {
    getSpecialities();
    getSources();

    registerEvents();
}

render();