<template>
    <div class="article-admin">
        <b-form>
            <input id="article-id" type="hidden" v-model="article.id" />
            
            <b-form-group v-if="mode === 'save'" 
                label="Consulta de :" label-for="">
                <b-form-select id=""
                    :options="specialties" />
            </b-form-group>

            <b-button variant="primary" v-if="mode === 'save'"
                @click="save">Agendar</b-button>
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
            article: {},
            specialties: [],
            categories: [],
            users: [],
            page: 1,
            limit: 0,
            count: 0,
            fields: [
                { key: 'id', label: 'Código', sortable: true },
                { key: 'name', label: 'Nome', sortable: true },
                { key: 'description', label: 'Descrição', sortable: true },
                { key: 'actions', label: 'Ações' }
            ]
        }
    },
    methods: {
        loadSpecialties() {
            const url = `${baseApiUrl}/api/specialties`
            axios.get(url).then(res => {
                this.specialties = res.data.specialties.content
           
            })
        },
        reset() {
            this.mode = 'save'
            this.article = {}
            this.loadArticles()
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
        remove() {
            const id = this.article.id
            axios.delete(`${baseApiUrl}/articles/${id}`)
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