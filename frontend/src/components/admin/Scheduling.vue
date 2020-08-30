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
                    <b-button href="#" variant="primary">Agendar</b-button>
                </b-card>

            </b-col>
        </b-row>
    </div>
</template>

<script>

import { baseApiUrl, showError } from '@/global'
import axios from 'axios'

export default {
    name: 'Scheduling',
    data: function() {
        return {
            mode: 'save',
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