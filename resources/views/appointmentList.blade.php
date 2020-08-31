@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">
                    <span class='col-auto align-middle font-weight-bold text-white h4 my-0'>
                        {{ __('Agendamentos Realizados') }}
                    </span>
                </div>

                <div class="card-body professionals">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Especialidade</th>
                                <th scope="col">Profissional</th>
                                <th scope="col">Origem</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Nascimento</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($appointmentList as $appointment)
                            <tr>
                                <td>{{$appointment['name']}}</td>
                                <td>{{$appointment['specialty_id']}}</td>
                                <td>{{$appointment['professional_id']}}</td>
                                <td>{{$appointment['source_id']}}</td>
                                <td>{{$appointment['cpf']}}</td>
                                <td>{{$appointment['birthdate']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
