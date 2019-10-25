import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
  	isLoading: false,
  	professionals: [],
    specialties: [],
    sources: [],
    selectedSpecialties: [],
  	base_url: 'http://feegow.dev.uppercreative.com.br',
    api: {
  		url: 'https://api.feegow.com.br/api/',
	  	token: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38'
  	}
  },
  mutations: {},
  actions: {}
});
