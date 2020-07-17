const axios = require('axios');


const {
    API_URL,
    TOKEN_API
} = process.env

const api = axios.create({
    baseURL: API_URL,
    timeout: 1000,
    headers: {'x-access-token': TOKEN_API}
  });


exports.especialidades = (callback) =>{
    api.get('/specialties/list')
    .then(function (response) {
        return callback(response.data)
    });
}

exports.profissionais = (especialidade,callback) =>{
    api.get('/professional/list?especialidade_id='+especialidade)
    .then(function (response) {
        return callback(response.data)
    });
}

exports.conheceu = (callback) =>{
    api.get('/patient/list-sources')
    .then(function (response) {
        return callback(response.data)
    });
}