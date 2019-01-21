import {BuscaProfissionais} from "./busca-profissionais.js";
import {ViewProfissionais} from "./view-profissionais.js";

const busca = new BuscaProfissionais();
const view = new ViewProfissionais(document.getElementById('cards-profissionais'));
document.querySelector('#especialidade').addEventListener('change', () => {
    view.showLoader();
    busca.busca()
        .then(profisisonais => {
            view.render(profisisonais);
        })
        .catch(err => console.log(err));
});
