@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="row d-flex justify-content-between">
                        <span class='col-auto align-middle font-weight-bold text-white h4 my-0'>
                            {{ __('Consulta de') }}
                        </span>

                        <select name="specialtyId" id="specialtyId" v-model='selectedSpecialtyId' v-on:change='resetProfessionalList' class='col form-control align-middle mx-2'>
                            <option selected="selected" value='0'>Selecione uma especialidade</option>
                            @foreach ($specialtyList as $specialty)
                                <option value="{{$specialty['especialidade_id']}}">
                                    {{\Str::title($specialty['nome'])}}
                                </option>
                            @endforeach
                        </select>

                        <button type='button' v-on:click='specialtySelected' class="col-auto btn btn-success rounded-pill font-weight-bold align-middle px-3 mx-3">
                            {{ __('AGENDAR') }}
                        </button>
                    </div>
                </div>

                <div class="card-body professionals">
                    <div v-if='professionalList == null' class='text-center mx-auto'>
                        Selecione uma especialidade e clique em agendar para ver a lista de profissionais
                    </div>
                    <span v-else>
                        <h4 v-if='professionalList && professionalList.length' class='text-secondary font-weight-bold mb-3'>
                            @{{professionalList.length}} @{{specialtyName()}} econtrados
                        </h4>
                        <span v-else class='text-center mx-auto'>Ops! Nenhum profissional econtrado...</span>
                    </span>
                    <div class="card-columns">
                        <professional-card
                            v-on:professional-selected="handleProfessionalSelected($event)"
                            v-for="(professional) in professionalList"
                            v-bind:key="professional.profissional_id"
                            v-bind="professional"
                        ></professional-card>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment information modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class='modal-title text-secondary font-weight-bold'>Preencha seus dados</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-4">
                            <div class="col">
                                <input type="text" class="form-control" v-model='fullName' required placeholder="Nome completo">
                            </div>
                            <div class="col">
                                <select v-model="selectedPatientSourceId" required name='selectedPatientSourceId' class='form-control'>
                                    <option selected="selected" value='0'>Como conheceu?</option>
                                    <option v-for="option in patientSourcesList" v-bind:value="option.origem_id">
                                        @{{ option.nome_origem }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="date" v-model="birthDate" class="form-control" required placeholder="Nascimento">
                            </div>
                            <div class="col">
                                <input type="text" v-model="cpf" class="form-control" required placeholder="CPF">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-between border-0">
                    <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">CANCELAR</button>
                    <button type='button' v-on:click='submitAppointment' class="btn btn-success font-weight-bold rounded-pill">SOLICITAR HORÁRIOS</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment successfull modal -->
    <div class="modal fade" id="appointmentSuccessModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class='modal-title text-secondary font-weight-bold'>Agendamento salvo com sucesso!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Obrigado pela preferência! =D</p>
                </div>
                <div class="modal-footer d-flex justify-content-between border-0">
                    <a href="{{ route('home') }}" class="btn btn-light rounded-pill">Voltar ao início</a>
                    <a href="{{ route('appointmentList') }}" class="btn btn-link font-weight-bold">Ver agendamentos</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
