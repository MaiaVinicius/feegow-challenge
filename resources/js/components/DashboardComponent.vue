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
                                    <button @click="saveSchedule()" class="btn btn-success float-right">AGENDAR</button>
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
                chosenSpecialty: ''
            }
        },
        mounted() {
            this.getSpecialties();
        },
        methods: {
            getSpecialties() {
                window.axios.get('/api/specialties').then(({ data }) => {
                    this.specialties = JSON.parse(data).content;
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
            saveSchedule() {
                
            }
        }
    }
</script>
