<template>
    <div class="article-admin">
        <b-form v-if="seeSelect === true">
            <b-form-group  
                label="Consulta de :" label-for="">
                <b-form-select id="specialties-id"
                    :options="specialties" v-model="specialist.especialidade_id"/>
            </b-form-group>

            <b-button variant="success" 
                @click="loadProfessional">Selecionar</b-button>
        </b-form>
        <b-table hover striped :items="professionalSelected" id="professional-id" v-model="professional.id" :fields="fields" v-if="seeCard === true">
            <template slot="actions" id="professional-id"  slot-scope="data">
                <b-button variant="success"  @click="loadSource(data.item)" v-model="professional.id" class="mr-2">
                    AGENDAR
                </b-button>

            </template>
        </b-table>

        <b-form v-if="seeForm === true">
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
                    <b-form-group label="CPF/CNPJ:" label-for="formData-cpf" id="formData-cpf">
                      <the-mask :mask="['###.###.###-##', '##.###.###/####-##']" v-model="formData.cpf" />
                    </b-form-group>
                </b-col>
                <b-col md="6" sm="12">
                    <b-form-group label="Como Conheceu:">
                   <b-form-select id="source-id"
                    :options="sources" v-model="source.origem_id"/>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col xs="12">
                    <b-button variant="success" 
                        @click="save">SOLICITAR HORÁRIOS</b-button>
                    
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
            professionals: [],
            professional:{},
            fields: [
                { key: 'nome', label: 'Nome', sortable: true },
                { key: 'documento_conselho', label: 'CRM', sortable: true },
                { key: 'actions', label: 'Ações' }
            ]
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

        loadSource(item) {
            
            const url = `${baseApiUrl}/api/sources`
            axios.get(url).then(res => {
          this.sources = res.data.sources.map(source => {
                return { ...source, value: source.origem_id, text: source.nome_origem }
                })
            })
            this.seeCard = false;
            this.seeForm = true;
            this.professional = item
        },

        save() {
            this.formData.specialty_id = this.specialist.especialidade_id
            this.formData.professional_id = this.professional.profissional_id
            this.formData.source_id = this.source.origem_id
            
            axios.post(`${baseApiUrl}/api/store`, this.formData)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
               })

            this.clear()        
        },

        clear() {
            this.seeCard = false;
            this.seeForm = false;
            this.seeSelect = true;

            this.formData = {};
            this.specialist = {};
            this.professional = {};
        }

    },

    mounted() {
        this.loadSpecialties()

    }
}
</script>

<style>

</style>