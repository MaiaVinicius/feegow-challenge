<template>
	<header class="header">
	    <md-toolbar class="md-primary" md-elevation="1">
	      <h3 class="md-title">Consulta por</h3>
	      <md-field :class="'filled' ? selectedSpecialties.length > 0 : ''">
	        <label for="specialties">Especilidades</label>
	        <md-select v-model="selectedSpecialties" name="specialties" id="specialties" multiple>
	          <md-option 
		          v-for="specialtie in $store.state.specialties" 
		          :value="specialtie.especialidade_id" 
		          :key="specialtie.especialidade_id">{{specialtie.nome}}</md-option>
	        </md-select>
	      </md-field>
	      <md-button @click="search(selectedSpecialties)" class="md-raised md-accent">Buscar</md-button>
	    </md-toolbar>
	</header>
</template>

<script>
import store from "@/store";
import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueAxios, axios);

export default {

  name: 'appHeader',

  data() {
    return {
		selectedSpecialties: []
    };
  },
  methods: {
  	search(ids) {
  		var self = this;
  		store.state.isLoading = true;
		axios.get(`${store.state.api.url}professional/list`, {
			headers: {
				'x-access-token': store.state.api.token
			}	
		})
		  .then(response => {
			store.state.professionals = [];
		  	
		  	if(ids.length) {
				for (const [key, professional] of Object.entries(response.data.content)) {

			    	if(typeof professional.especialidades != "undefined" && 
			    		professional.especialidades != null && 
			    		professional.especialidades.length != null && 
			    		professional.especialidades.length > 0) {

						professional.especialidades.map(especialidade => {
						  if(especialidade.especialidade_id !== null &&
						  	ids.includes(especialidade.especialidade_id)) {

						  	if(store.state.professionals.some(item => item.profissional_id === professional.profissional_id) === false){
							  	store.state.professionals.push(professional);
						  	}		
						  }
						});
			    	}
				} 	
		  	} else {
		      for (const [key, value] of Object.entries(response.data.content)) {
		        if(value.nome !== null) {
		          if(store.state.professionals.some(item => item.profissional_id === value.profissional_id) === false){
		            store.state.professionals.push(value);
		          }  
		        }
		      }
		  	}

		  	store.state.isLoading = false;
		  }).catch(error => {
		    console.log(error);
		    store.state.isLoading = false;
		  })
  	}
  }
};
</script>

<style lang="sass">
@import './sass/_header'
</style>
