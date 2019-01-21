let form = document.querySelector('form');
form.addEventListener('submit', e => {
    e.preventDefault();

    const formData = new FormData(form);
    const alert = document.getElementById('resultado');

    fetch('/agendamento', {
        method: 'POST',
        body: formData,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).then(response => {
        if (!response.ok) {
            throw new Error();
        }

        form.reset();
        alert.classList.add('alert-success');
        alert.textContent = 'Agendamento solicitado com sucesso';
    }).catch(err => {
        const mensagem = err instanceof Error
            ? err.message
            : 'Ocorreu um erro inesperado';

        alert.classList.add('alert-danger');
        alert.textContent = mensagem;
    }).finally(() => {
        alert.removeAttribute('hidden');
    });
});