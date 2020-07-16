@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Visualizar Agendamentos</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 offset-sm-8 text-md-right">
                            <a href="{{ route('formCreateSchedule') }}" class="btn btn-sm btn-success">
                                <i class="material-icons vertical-align-middle">note_add</i> Novo Agendamento
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 table-responsive-sm">
                            <table class="table table-sm table-striped table-bordered table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Especialidade</th>
                                        <th>Profissional</th>
                                        <th>Como Conheceu</th>
                                        <th>Data de nascimento</th>
                                        <th>Data Inclusão</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <nav id="paginationNav">
                        <ul class="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/schedule/view.js') }}" type="text/javascript"></script>
<script>
    ScheduleView.init();
</script>
@endsection
