export class ViewProfissionais {
    constructor(outputElement) {
        this._outputElement = outputElement;
        this._template = `
            <div class="card mx-1 mb-2">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ nome }} <br>
                        {{ dadosConselho }}
                    </h5>

                    <a href="/agendamento/{{ especialidade }}/{{ id }}" class="btn btn-outline-success">Agendar</a>
                </div>
            </div>`;
    }

    render(profissionais) {
        const elementos = profissionais.map(profissional => this.getHtml(profissional));

        this._outputElement.innerHTML = '';
        for (const i in elementos) {
            const el = document.createElement('div');
            el.classList.add('col-4');
            el.innerHTML = elementos[i];
            this._outputElement.appendChild(el);
        }
    }

    getHtml(profissional) {
        return this._template
            .replace('{{ nome }}', profissional.nome)
            .replace('{{ id }}', profissional.profissional_id)
            .replace('{{ especialidade }}', document.getElementById('especialidade').value)
            .replace('{{ dadosConselho }}', profissional.documento_conselho
                ? `<small class="text-muted">${profissional.conselho}: ${profissional.documento_conselho}</small>`
                : ''
            );
    }

    showLoader() {
        this._outputElement.innerHTML = ViewProfissionais.loader;
    }

    static get loader() {
        return '<div class="text-center"><progress></progres></div>';
    }
}