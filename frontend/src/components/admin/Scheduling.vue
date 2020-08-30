<template>
    <div class="article-admin">
        <b-form>
            <b-form-group v-if="mode === 'save'" 
                label="Consulta de :" label-for="">
                <b-form-select id="specialties-id"
                    :options="specialties" v-model="specialist.especialidade_id"/>
            </b-form-group>

            <b-button variant="primary" v-if="mode === 'save'"
                @click="loadProfessional">Selecionar</b-button>
        </b-form>
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
        },

        loadProfessional() {
            const url = `${baseApiUrl}/api/professional`
            axios.get(url).then(res => {
                 this.professionals = res.data.professional
            }).catch(showError)

            this.professionalSelected = this.professionals.filter((item) => item.especialidade_id === this.specialist.especialidade_id);
            
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