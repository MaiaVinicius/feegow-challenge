<template>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-3 p-3">
                <div v-if='foto' class='card-img rounded-circle border border-secondary' :style="'background-image:url('+foto+')'"></div>
                <div v-else class='card-img rounded-circle border border-secondary' style="background-image:url('https://cdn.feegow.com/img/user-dummy.png')"></div>
            </div>
            <div class="col-md-9">
                <div class="card-body pl-0">
                    <h5 class="card-title text-capitalize">{{tratamento ? tratamento.toLowerCase() : ''}} {{nome ? nome.toLowerCase() : ''}}</h5>
                    <p class="card-text text-muted">{{conselho}} {{documento_conselho}}</p>
                </div>
            </div>
        </div>
        <div class="row no-gutters mb-3">
            <div class="col-12 text-center">
                <button type='button' v-on:click='appointmentForm(profissional_id)' class="btn btn-success rounded-pill">AGENDAR</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tratamento', 'nome', 'conselho', 'documento_conselho', 'foto', 'profissional_id'],
        methods: {
            appointmentForm: function (selectedProfessionalId) {
                this.$emit('professional-selected', selectedProfessionalId);
            }
        }
    }
</script>

<style scoped>
.card {
    border-radius: 1rem;
    box-shadow: 0px 0px 7px #80808052;
}
.card-img {
    height: 58px;
    width: 58px;
    background-size: cover;
}
.card-body {
    padding: .7rem;
}
.card-title {
    font-weight: 500;
    font-family: system-ui;
}
</style>
