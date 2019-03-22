@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Feegow Challenge</h2>
            <form id="formSpecialty">
                <div class="form-group">
                    @if(!empty($specialties))
                        <label for="specialty">Consulta de </label>
                        <select id="specialty" class="selectpicker" data-show-subtext="true" data-live-search="true" data-width="auto" required>
                            <option value="">Selecione a especialidade </option>
                            @foreach($specialties as $specialty)
                                <option value="{{$specialty->especialidade_id}}">{{$specialty->nome}}</option>
                            @endforeach
                        </select>
                        <button id="btnSearch" type="button" class="btn btn-success">Agendar</button>
                    @else
                        Falha ao obter dados da api, tente novamente.
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div id="doctors" class="row">

    </div>
@endsection


@section('modals')
    <div class="modal fade bootstrap-modal" id="modal_agendar" tabindex="-1" role="dialog" aria-labelledby="modal_agendar" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Solicite agendamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="formSchedule" action="/schedule">
                                <input type="hidden" id="specialty_id" name="specialty_id" required>
                                <input type="hidden" id="professional_id" name="professional_id" required>
                                <div class="row ">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" minlength="3" placeholder="Nome Completo" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            @if(!empty($sources))
                                                <select id="source_id" name="source_id" class="selectpicker" data-show-subtext="true" data-live-search="true" data-width="100%" required>
                                                    <option value="">Como conheceu?</option>
                                                    @foreach($sources as $source)
                                                        <option value="{{$source->origem_id}}">{{$source->nome_origem}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="Nascimento" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="btnConfirm" type="submit" class="btn btn-success">AGENDAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
