export class AgendamentoService {
    constructor(alertEl, form) {
        this._alertElement = alertEl;
        this._formElement = form;
        this._formData = new FormData(form);

        this._alertElement.classList.remove('alert-success', 'alert-danger');
        this._alertElement.hidden = true;
    }

    insereAgendamento() {
        let progress = document.getElementById('carregando');
        progress.removeAttribute('hidden');
        fetch('/agendamento', {
            method: 'POST',
            body: this._formData
        }).then(response => {
            if (!response.ok) {
                throw new Error();
            }

            this._formElement.reset();
            this._alertElement.classList.add('alert-success');
            this._alertElement.textContent = 'Agendamento solicitado com sucesso';
        }).catch(err => {
            const mensagem = err instanceof Error && err.message
                ? err.message
                : 'Ocorreu um erro inesperado';

            this._alertElement.classList.add('alert-danger');
            this._alertElement.textContent = mensagem;
        }).finally(() => {
            this._alertElement.removeAttribute('hidden');
            progress.hidden = true;
        });
    }
}
