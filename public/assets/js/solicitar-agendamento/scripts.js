let form = document.querySelector('form');
form.addEventListener('submit', e => {
    e.preventDefault();

    const formData = new FormData(form);
    const alert = document.getElementById('resultado');
    alert.classList.remove('alert-success', 'alert-danger');
    alert.hidden = true;

    fetch('/agendamento', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (!response.ok) {
            throw new Error();
        }

        form.reset();
        alert.classList.add('alert-success');
        alert.textContent = 'Agendamento solicitado com sucesso';
    }).catch(err => {
        const mensagem = err instanceof Error && err.message
            ? err.message
            : 'Ocorreu um erro inesperado';

        alert.classList.add('alert-danger');
        alert.textContent = mensagem;
    }).finally(() => {
        alert.removeAttribute('hidden');
    });
});

fetch('/api/patient/list-sources')
    .then(res => res.json())
    .then(sources => {
        const select = document.getElementById('origem');
        select.innerHTML = '<option value="">Selecione</option>';
        sources
            .sort((a, b) => a.nome_origem < b.nome_origem ? -1 : 1)
            .forEach(source => select.innerHTML += `<option value="${source.origem_id}">${source.nome_origem}</option>`);
    });