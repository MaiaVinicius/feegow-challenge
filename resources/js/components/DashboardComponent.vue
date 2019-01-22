<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <form class="form-inline">
                            <div class="form-row">
                                <div class="col">
                                    Consulta de
                                </div>
                                <div class="col">
                                    <select class="form-control">
                                        <option>Default select</option>
                                        <option
                                            v-for="specialty in specialties"
                                            :value="specialty.especialidade_id"
                                            :key="specialty.especialidade_id"
                                            >{{ specialty.nome }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary col-sm">AGENDAR</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        I'm an example component.
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
                specialties: null
            }
        },
        mounted() {
            this.getSpecialties();
            console.log("console.log(this.specialties);");
            console.log(this.specialties);
        },
        methods: {
            getSpecialties() {
                window.axios.defaults.headers.common = {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                };
                window.axios.get('/api/specialties').then(({ data }) => {
                    console.log("console.log(data);");
                    console.log(data);
                    this.specialties = data.content;
                });
            }
        }
    }
</script>
