<template>
    <div class="article-admin">
        <b-form v-if="seeSelect === true">
            <b-form-group  
                label="Consulta de :" label-for="">
                <b-form-select id="specialties-id"
                    :options="specialties" v-model="specialist.especialidade_id"/>
            </b-form-group>

            <b-button variant="primary" 
                @click="loadProfessional">Selecionar</b-button>
        </b-form>
        <b-row>
            <b-col v-for="(iten, index) in professionalSelected" :key="index">
                <b-card
                    v-if="seeCard === true"
                    :title="iten.nome"
                >
                    <b-card-text> CRM:{{iten.documento_conselho}}</b-card-text> <br/><br/>
                    <b-button @click="loadSource" variant="primary">Agendar</b-button>
                </b-card>
            </b-col>
        </b-row>

        <b-form v-if="seeForm === true">
        <input id="user-id" type="hidden" v-model="formData.id" />
            <b-row>
                <b-col md="6" sm="12">
                    <b-form-group label="Nome Completo:" label-for="formData-name">
                        <b-form-input id="formData-name" type="text"
                            v-model="formData.name" required
                            placeholder="Informe o Nome Completo..." />
                    </b-form-group>
                </b-col>
                <b-col md="6" sm="12">
                    <b-form-group label="Nasciento" label-for="formData-birthdate">
                        <b-form-input id="formData-birthdate" type="date"
                            v-model="formData.birthdate" required
                            :readonly="mode === 'remove'"
                            placeholder="Informe a Data Nascimento..." />
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row >
                <b-col md="6" sm="12">
                    <b-form-group label="CPF/CNPJ:" label-for="formData-cpf">
                      <the-mask :mask="['###.###.###-##', '##.###.###/####-##']" v-model="formData.cpf" />
                    </b-form-group>
                </b-col>
                <b-col md="6" sm="12">
                    <b-form-group label="Como Conheceu:">
                   <b-form-select id="specialties-id"
                    :options="sources" v-model="source.especialidade_id"/>
                    </b-form-group>
                </b-col>
            </b-row>
        </b-form>
    </div>
</template>

<script>

import { baseApiUrl, showError } from '@/global'
import {TheMask} from 'vue-the-mask'
import axios from 'axios'

export default {
    name: 'Scheduling',
    components: {TheMask},
    data: function() {
        return {
            mode: 'save',
            formData:{},
            source:{},
            sources:[],
            specialist: {},
            specialties: [],
            seeCard: false,
            seeSelect: false,
            seeForm: false,
            professionalSelected: [],
            professionals: []
          
        }
    },
    methods: {
        loadSpecialties() {
            const url = `${baseApiUrl}/api/specialties`
            axios.get(url).then(res => {
                    this.specialties = res.data.specialties.map(specialist => {
                return { ...specialist, value: specialist.especialidade_id, text: specialist.nome }
                })
            })
            this.seeSelect = true;
        },

        loadProfessional() {
            const url = `${baseApiUrl}/api/professional`
            axios.get(url).then(res => {
                 this.professionals = res.data.professional
            }).catch(showError)
    
                this.professionalSelected = this.professionals
                    .filter((item) => item.especialidade_id === this.specialist.especialidade_id);
                if (this.professionalSelected.length > 0) {this.seeCard = true; this.seeSelect = false; }
        },

        loadSource() {
            const url = `${baseApiUrl}/api/sources`
            axios.get(url).then(res => {
          this.sources = res.data.sources.map(source => {
                return { ...source, value: source.origem_id, text: source.nome_origem }
                })
            })
            this.seeCard = false;
            this.seeForm = true;
        },

        save() {
            const method = this.article.id ? 'put' : 'post'
            const id = this.article.id ? `/${this.article.id}` : ''
            axios[method](`${baseApiUrl}/articles${id}`, this.article)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
                })
                .catch(showError)
        },

    },

    mounted() {
        this.loadSpecialties()

    }
}
</script>

<style>

</style>