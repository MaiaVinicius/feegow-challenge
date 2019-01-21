export class BuscaProfissionais {
    constructor() {
        this._url = '/api/professional/list';
    }

    busca() {
        return fetch(this._url)
            .then(res => res.json())
            .then(profissionais => profissionais.filter(profissional => profissional.nome !== null));
    }
}