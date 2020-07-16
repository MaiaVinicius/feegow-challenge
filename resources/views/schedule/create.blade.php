@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Novo Agendamento</div>

                <div class="card-body">
                    <div id="divMessage" class="alert d-none"></div>
                    <form>
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label class="font-weight-bolder">Consulta de:</label>
                                    <select name="specialty_id" id="specialty_id" class="custom-select form-control-xs">
                                        <option value="" selected>Selecione a Especialidade</option>
                                    </select>
                                </div>
                            </div>

                            <div id="divProfessional" class="form-row card-deck d-none">
                            </div>

                            <div id="divForm" class="d-none mt-5">

                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label class="font-weight-bolder">Nome Completo:</label>
                                        <input type="text" name="name" class="form-control form-control-sm" value="" required />
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="font-weight-bolder">Como Conheceu?:</label>
                                        <select name="source_id" id="source_id" class="custom-select form-control-xs">
                                            <option value="" selected>Selecione...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label class="font-weight-bolder">CPF:</label>
                                        <input type="text" name="cpf" class="form-control form-control-sm" value="" required />
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="font-weight-bolder">Data de nascimento:</label>
                                        <input type="text" name="birthdate" class="form-control form-control-sm" placeholder="Preencha no formato AAAA-MM-DD" value="" required />
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <div class="col-sm-4 offset-sm-8 text-md-right">
                                        <button type="button" id="btnSaveSchedule" class="btn btn-sm btn-outline-primary">
                                            <i class="material-icons vertical-align-middle">done_all</i> Agendar
                                        </button>
                                        <a href="{{ route('formViewSchedule') }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="material-icons vertical-align-middle">replay</i>Voltar
                                        </a> 
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="professional_id" id="professional_id" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/schedule/create.js') }}" type="text/javascript"></script>
<script>
    ScheduleCreate.init();
</script>
@endsection
