/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');
Vue.component('professional-card', require('./components/ProfessionalCardComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        professionalList: null,
        patientSourcesList: null,
        selectedProfessionalId: null,
        selectedSpecialtyId: 0,
        selectedPatientSourceId: 0,
        fullName: null,
        birthDate: null,
        cpf: null,
    },
    methods: {
        // Action when user clicks the first "Agendar" button. Is mandatory to first select a specialty type
        specialtySelected: async function () {
            if ( !this.selectedSpecialtyId ) {
                toastr.warning('Selecione uma especialidade antes de tentar o agendamento');
                return;
            }
            try {
                $.blockUI();
                const resProfessional = await axios.get(`api/professional/list?especialidade_id=${this.selectedSpecialtyId}&ativo=1`);
                const resPatient = await axios.get('api/patient/list-sources');
                this.professionalList = resProfessional.data;
                this.patientSourcesList = resPatient.data;
            } catch (error) {
                toastr.error('Ops! Erro ao buscar especialista... Tente novamente', 'danger');
                console.error(error);
            } finally {
                $.unblockUI();
            }
        },
        // Action when user clicks the first "Solicitar Horário" button. All fields must be filled
        submitAppointment: async function () {
            toastr.clear();
            if (!this.selectedPatientSourceId || !this.fullName  || !this.birthDate  || !this.cpf ) {
                toastr.warning('Por favor, preencha todos os campos');
                return;
            }
            try {
                $.blockUI();
                const response = await axios.post('api/appoints/new-appoint', {
                    specialty_id: this.selectedSpecialtyId,
                    professional_id: this.selectedProfessionalId,
                    source_id: this.selectedPatientSourceId,
                    name: this.fullName,
                    cpf: this.cpf,
                    birthdate: this.birthDate,
                });
                this.appointmentSuccessfull();
            } catch (err) {
                this.handleAppointmentError(err);
            } finally {
                $.unblockUI();
            }
        },
        specialtyName: function () {
            return $('#specialtyId option:checked').text();
        },
        resetProfessionalList: function () {
            this.professionalList = null;
        },
        // When user select a professional, we can show the form asking personal data
        handleProfessionalSelected: function (professionalId) {
            this.selectedProfessionalId = professionalId;
            $('#appointmentModal').modal();
        },
        appointmentSuccessfull: function () {
            $('#appointmentModal').modal('hide');
            $('#appointmentSuccessModal').modal();
        },
        // We can show backend validation, as Laravel return status 422 with the messages
        handleAppointmentError(err) {
            if (err.response.status = 422) {
                let messages = '';
                const validationErrors = err.response.data.errors;
                for (const field in validationErrors) {
                    for (const fieldError in validationErrors[field]) {
                        messages += validationErrors[field][fieldError]+'<br>';
                    }
                }
                toastr.warning(messages, 'Verifique os dados inseridos', {
                    extendedTimeOut: 0,
                    timeOut: 0,
                });
            } else {
                toastr.error('Ops! Erro ao salvar agendamento...');
            }
        }
    },
});
