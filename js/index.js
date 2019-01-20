var BASE_URL = "http://clinic5.feegow.com.br/components/public/api";
var TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38";
var specialitySelected = 0;
var professionalSelected = 0;

function prepareSelect() {
  fetch(`${BASE_URL}/specialties/list`, {
    method: 'GET',
    headers: {
      'x-access-token': TOKEN,
      'Content-Type': 'application/json',
      'Access-Control-Allow-Origin':'*'
    }
  })
    .then(async function(response) {
      if (response.ok) {
        const payload = await response.json();
        if (payload.success && Array.isArray(payload.content)) {
          var element = document.getElementById('speciality_id');
          element.innerHTML = `<option value="">Selecione uma especialidade</option>`;
          payload.content.forEach(function(speciality) {
            element.innerHTML += `<option value="${speciality.especialidade_id}">${speciality.nome}</option>`;
          });
        } else {
          Swal.fire({
            type: 'warning',
            title: 'Oops...',
            text: "Aconteceu um erro interno, tente novamente mais tarde."
          });
        }
      }
    })
    .catch((error) => {
      console.error('ERROR', error);
      Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: "Aconteceu um erro inesperado ao recuperar os dados, tente novamente mais tarde."
      });
    });
}

function getPeopleBySpeciality(speciality) {
  specialitySelected = speciality;
  document.getElementById('card_results').style.display = "block";
  document.getElementById('card_form').style.display = "none";
  document.getElementById('people_list').innerHTML = "";
  fetch(`${BASE_URL}/professional/list?ativo=1&especialidade_id=${speciality}`, {
    method: 'GET',
    headers: {
      'x-access-token': TOKEN,
      'Content-Type': 'application/json',
      'Access-Control-Allow-Origin':'*'
    }
  })
    .then(async function(response) {
      if (response.ok) {
        const payload = await response.json();
        if (payload.success && Array.isArray(payload.content)) {
          var element = document.getElementById('people_list');
          element.innerHTML = ``;
          payload.content.forEach(function(speciality) {
            const tratamento = speciality.sexo === "Masculino"? "Dr." : "Dra.";
            const photo = speciality.foto === null? "" : `<img src="${speciality.foto}" class="card-img-top" alt="${tratamento} ${speciality.nome}" style="width: 8rem;height: 8rem;align-self: center;">`;
            element.innerHTML += `
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <div class="card">
                ${photo}
                <div class="card-body">
                  <h5 class="card-title">${tratamento} ${speciality.nome}</h5>
                  <p class="card-text">${speciality.conselho}: ${speciality.documento_conselho === ""? "Não informado" : speciality.documento_conselho}</p>
                  <a href="#" class="btn btn-success agendar-profissional" id="${speciality.profissional_id}">Agendar</a>
                </div>
              </div>
            </div>
            `;
          });
          document.getElementById('card_results').style.display = "block";
        } else {
          Swal.fire({
            type: 'warning',
            title: 'Oops...',
            text: "Aconteceu um erro interno, tente novamente mais tarde."
          });
        }
      }
    })
    .catch((error) => {
      console.error('ERROR', error);
      Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: "Aconteceu um erro inesperado ao recuperar os dados, tente novamente mais tarde."
      });
    });
}

function getFormRequirements() {
  fetch(`${BASE_URL}/patient/list-sources`, {
    method: 'GET',
    headers: {
      'x-access-token': TOKEN,
      'Content-Type': 'application/json',
      'Access-Control-Allow-Origin':'*'
    }
  })
  .then(async function(response) {
    if (response.ok) {
      const payload = await response.json();
      if (payload.success && Array.isArray(payload.content)) {
        var element = document.getElementById('comoConheceuField');
        element.innerHTML = `<option value="">Selecione uma opção</option>`;
        payload.content.forEach(function(origin) {
          element.innerHTML += `<option value="${origin.origem_id}">${origin.nome_origem}</option>`;
        });
      } else {
        Swal.fire({
          type: 'warning',
          title: 'Oops...',
          text: "Aconteceu um erro interno, tente novamente mais tarde."
        });
      }
    }
  })
  .catch((error) => {
    console.error('ERROR', error);
    Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: "Aconteceu um erro inesperado ao recuperar os dados, tente novamente mais tarde."
    });
  });
}

function checkCPF(strCPF) {
  var Soma;
  var Resto;
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


window.onload = function() {
  prepareSelect();

  document.getElementById('btnAgendar').addEventListener('click', function(){
    let e = document.getElementById("speciality_id");
    let speciality = e.options[e.selectedIndex].value;
    if (speciality === undefined || speciality === null || speciality.trim() === "") {
      Swal.fire({
        title: 'Hey!',
        text: "Escolha uma especialidade válida!"
      });
    } else {
      getPeopleBySpeciality(speciality);
    }
  });

  $(document).on('click', '.agendar-profissional', function(e) {
    e.preventDefault();
    professionalSelected = e.target.id;
    if (professionalSelected !== 0 && professionalSelected !== undefined && professionalSelected !== null) {
      getFormRequirements();
      document.getElementById('card_results').style.display = "none";
      document.getElementById('card_form').style.display = "block";
    }
  });

  document.getElementById('solicitarHorario').addEventListener('click', function() {
    let nome = document.getElementById('nomeField').value;
    let como_conheceu = document.getElementById('comoConheceuField').value;
    let nascimento = document.getElementById('nascimentoField').value;
    let cpf = document.getElementById('cpfField').value.replace(/[\D]/g, "");

    if (nome.trim() !== "" && como_conheceu.trim() !== "" && nascimento !== "" && nascimento.length === 10 && cpf !== "") {
      if (checkCPF(cpf)) {
        const nascimentoSplited = nascimento.split('/');
        // Convert to FormData
        let form = new FormData();
        form.append('nome', nome);
        form.append('como_conheceu', como_conheceu);
        form.append('nascimento', `${nascimentoSplited[2]}-${nascimentoSplited[1]}-${nascimentoSplited[0]}`);
        form.append('cpf', cpf);
        form.append('especialidade', specialitySelected);
        form.append('profissional', professionalSelected);
        form.append('is_ajax', true);

        fetch('http://localhost:8080/backend/save.php', {
          method: "POST",
          body: form
        })
        .then(function(response) {
          if (response.ok) {
            document.getElementById('nomeField').value = "";
            document.getElementById('comoConheceuField').value = "";
            document.getElementById('nascimentoField').value = "";
            document.getElementById('cpfField').value = "";
            Swal.fire({
              type: 'success',
              title: 'Tudo certo!',
              text: "Agendamento realizado com sucesso!"
            });
          } else {
            Swal.fire({
              type: 'warning',
              title: 'Oops...',
              text: "Aconteceu um erro interno, tente novamente mais tarde."
            });
          }
        })
        .catch(function(error) {
          console.log('error', error);
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: "Aconteceu um erro inesperado, contate o suporte."
          });
        })
      } else {
        Swal.fire("CPF inválido!", "Digite corretamente e tente novamente.");
      }
    } else {
      Swal.fire("Hey!", "Todos os campos são obrigatórios!");
    }
  });
}
