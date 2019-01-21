export class BuscadorDeOrigens {
    constructor(el) {
        this._selectElement = el;
    }

    busca() {
        fetch('/api/patient/list-sources')
            .then(res => res.json())
            .then(sources => {
                this._selectElement.innerHTML = '<option value="">Selecione</option>';
                sources
                    .sort((a, b) => a.nome_origem < b.nome_origem ? -1 : 1)
                    .forEach(source => this._selectElement.innerHTML += `<option value="${source.origem_id}">${source.nome_origem}</option>`);
            });
    }
}