<template>
    <div class="article-admin">
        <b-form>
            <input id="article-id" type="hidden" v-model="article.id" />
            
            <b-form-group v-if="mode === 'save'" 
                label="Consulta de :" label-for="">
                <b-form-select id=""
                    :options="categories" v-model="article.categoryId" />
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
            articles: [],
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
        loadArticles() {
            const url = `${baseApiUrl}/articles?page=${this.page}`
            axios.get(url).then(res => {
                this.articles = res.data.data
                this.count = res.data.count
                this.limit = res.data.limit
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
        loadArticle(article, mode = 'save') {
            this.mode = mode
            axios.get(`${baseApiUrl}/articles/${article.id}`)
                .then(res => this.article = res.data)
        },
        loadCategories() {
            const url = `${baseApiUrl}/categories`
            axios.get(url).then(res => {
                this.categories = res.data.map(category => {
                    return { value: category.id, text: category.path }
                })
            })
        },
        loadUsers() {
            const url = `${baseApiUrl}/users`
            axios.get(url).then(res => {
                this.users = res.data.map(user => {
                    return { value: user.id, text: `${user.name} - ${user.email}` }
                })
            })
        }
    },
    watch: {
        page() {
            this.loadArticles()
        }
    },
    mounted() {
        this.loadUsers()
        this.loadCategories()
        this.loadArticles()
    }
}
</script>

<style>

</style>