import {BuscadorDeOrigens} from "./buscador-origens.js";
import {AgendamentoService} from "./agendamento-service.js";

let form = document.querySelector('form');

form.addEventListener('submit', e => {
    e.preventDefault();

    const service = new AgendamentoService(document.getElementById('resultado'), form);
    service.insereAgendamento();
});

const buscador = new BuscadorDeOrigens(document.getElementById('origem'));
buscador.busca();

VMasker(document.getElementById('cpf')).maskPattern('999.999.999-99');
