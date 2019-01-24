<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <form v-on:submit.prevent>
                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">Consulta de</label>
                                <div class="col">
                                    <select v-model="chosenSpecialty" class="form-control">
                                        <option value="">Default select</option>
                                        <option
                                            v-for="specialty in specialties"
                                            :value="specialty.especialidade_id"
                                            :key="specialty.especialidade_id"
                                            >{{ specialty.nome }}</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button type="submit" @click="getProfessionals()" class="btn btn-success">AGENDAR</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4" v-for="professional in professionals" :key="professional.profissional_id">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img :src="professional.foto" :alt="professional.nome" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="col-sm-9">
                                                <h5 class="card-title">{{ professional.nome }}</h5>
                                                <p class="card-text">
                                                    {{ professional.conselho }} {{ professional.documento_conselho }}
                                                </p>
                                            </div>
                                        </div>
                                        <button @click="chooseProfessional(professional.profissional_id)" class="btn btn-success float-right" data-toggle="modal" :data-target="'#schedule' + professional.profissional_id">AGENDAR</button>
                                    </div>
                                </div>

                                <!-- Schedule modal -->
                                <div class="modal fade" :id="'schedule' + professional.profissional_id" tabindex="-1" role="dialog" :aria-labelledby="'schedule' + professional.profissional_id + 'Label'" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" :id="'schedule' + professional.profissional_id + 'Label'">Preencha seus dados</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form v-on:submit.prevent>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-md-6">
                                                            <input v-model="fullname" placeholder="Nome Completo" type="text" class="form-control">
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <select v-model="chosenSource" class="form-control">
                                                                <option value="">Como conheceu?</option>
                                                                <option
                                                                    v-for="source in sources"
                                                                    :value="source.origem_id"
                                                                    :key="source.origem_id"
                                                                    >{{ source.nome_origem }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <input v-model="birthdate" placeholder="Nascimento" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <input v-model="cpf" placeholder="CPF" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button @click="saveSchedule()" type="button" class="btn btn-success">SOLICITAR HORÁRIOS</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                specialties: null,
                professionals: null,
                sources: null,
                chosenSpecialty: '',
                fullname: null,
                birthdate: null,
                chosenSource: '',
                chosenProfessional: null,
                cpf: null,
                loggedUser: null
            }
        },
        mounted() {
            this.getSpecialties();
            this.getSources();
            const metas = document.getElementsByTagName("meta");
            for (let i = 0; i < metas.length; i++) {
                if (metas[i].name === 'user_id') {
                    this.loggedUser = metas[i].content;
                }
            }
        },
        methods: {
            chooseProfessional(id) {
                this.chosenProfessional = id;
            },
            getSpecialties() {
                const specialties = localStorage.getItem('specialties');
                if (specialties) {
                    this.specialties = JSON.parse(specialties).content;
                    return;
                }
                window.axios.get('/api/specialties').then(({ data }) => {
                    this.specialties = JSON.parse(data).content;
                    localStorage.setItem('specialties', data);
                });
            },
            getProfessionals() {
                window.axios.get('/api/professionals', {
                    params: {
                        especialidade_id: this.chosenSpecialty
                    }
                }).then(({ data }) => {
                    this.professionals = data.content;
                });
            },
            getSources() {
                const sources = localStorage.getItem('sources');
                if (sources) {
                    this.sources = JSON.parse(sources).content;
                    return;
                }
                window.axios.get('/api/sources').then(({ data }) => {
                    this.sources = JSON.parse(data).content;
                    localStorage.setItem('sources', data);
                });
            },
            saveSchedule() {
                const fullname = this.fullname;
                const birthdate = this.birthdate;
                const chosenSource = this.chosenSource;
                const chosenProfessional = this.chosenProfessional;
                const cpf = this.cpf;

                window.axios.post('/api/schedule', {
                    name: fullname,
                    birthdate: birthdate,
                    source_id: chosenSource,
                    specialty_id: this.chosenSpecialty,
                    professional_id: chosenProfessional,
                    cpf: cpf,
                    user_id: this.loggedUser
                }).then(({ data }) => {
                    console.log(data);
                });

                this.fullname = null;
                this.birthdate = null;
                this.chosenSource = '';
                this.cpf = null;
            }
        }
    }
</script>
