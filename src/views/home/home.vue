<template>
	<section>
		<div class="container">
			<professionals-list v-on:agendar="agendar" />
		</div>
    <md-dialog :class="'modal'" :md-active.sync="showDialog">
      <md-dialog-title>Preencha seus dados</md-dialog-title>
      <form>
        <md-field>
          <label>Nome Completo</label>
          <md-input required v-model="name" placeholder="Nome Completo"></md-input>
        </md-field>
        <md-field>
          <label>Onde Conheceu?</label>
          <md-select required v-model="source_id">
            <md-option 
              v-for="source in $store.state.sources" 
              :value="source.origem_id" 
              :key="source.origem_id">{{source.nome_origem}}</md-option>
          </md-select>
        </md-field>  
        <md-field>
          <md-icon>event</md-icon>
          <label>Data de Nascimento</label>
          <md-input required v-mask="['##/##/####']" v-model="birthdate"></md-input>
        </md-field>
        <md-field>
          <label>CPF</label>
          <md-input required v-mask="['###.###.###-##']" v-model="cpf" placeholder="CPF"></md-input>
        </md-field>                
      </form>
      <md-dialog-actions>
        <md-button class="md-raised md-accent" @click="enviar">Enviar</md-button>
      </md-dialog-actions> 
    </md-dialog>
    <md-dialog
      v-on:md-closed="response.status = false"
      :md-active.sync="response.status">  
      <md-dialog-title>Confirmação de Agendamento</md-dialog-title>
      <md-content>
        <p>
          {{response.message}}
        </p>
      </md-content>
      <md-dialog-actions>
        <md-button class="md-raised md-accent" @click="response.status = showDialog = false">Fechar</md-button>
      </md-dialog-actions>       
    </md-dialog>
	</section>
</template>

<script>
import store from "@/store";
import Vue from 'vue';
import professionalsList from "@/components/professionalsList/professionalsList.vue";
import VueTheMask from 'vue-the-mask';
import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueTheMask);
Vue.use(VueAxios, axios);

export default {

  name: 'home',
  methods: {
    enviar() {
      this.showDialog = false;
      var self = this;
      store.state.isLoading = true;

      if(this.specialty_id === '' || 
        this.professional_id === '' || 
        this.source_id === '' || 
        this.name === '' || 
        this.birthdate === '' || 
        this.cpf === '') {
          self.response.message = 'Você não preencheu todos os campos.';
          self.response.status = true;

          store.state.isLoading = false;
      } else {

        // Se as especialidades forem relacionadas não a busca, mas ao profissional escolhido.

        let especialidades = [];

        for (const [key, value] of Object.entries(this.professional.especialidades)) {
          if(value.especialidade_id !== null){
            especialidades.push(value.especialidade_id);
          }
        }

        // Se as especialidades forem de acordo com a busca bata usar store.state.selectedSpecialties.join()

        var data = new FormData();

        data.append('specialty_id', especialidades.join());    
        data.append('professional_id', this.professional.profissional_id);    
        data.append('source_id', this.source_id);
        data.append('name', this.name);
        data.append('birthdate', this.birthdate);
        data.append('cpf', this.cpf);      

        axios.post('http://dev.uppercreative.com.br/feegow/schedule', data)
        .then((response) => {
          self.response.message = response.data;
          self.response.status = true;

          store.state.isLoading = false;
        }, (error) => {
          console.log(error);
          store.state.isLoading = false;
        });  
      }

    
    },
    agendar(professional) {
      this.showDialog = true;
      this.professional = professional;
    }
  },
  data () {
    return {
      showDialog: false,
      response: {
        status: false,
        message: ''
      },
      professional: [],
      source_id: '',
      name: '',
      birthdate: '',
      cpf: ''
    }
  },
  components: {
    professionalsList
  } 
};
</script>

<style lang="sass">
@import './sass/_home'
</style>