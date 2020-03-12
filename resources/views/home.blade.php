@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agendamentos realizados</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Profissional requisitado</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Data de Nascimento</th>
                        </tr>
                        </thead>
                        @foreach($schedule as $sche)
                            <tr>
                                <td>{{$sche["name_medic"]}}</td>
                                <td>{{$sche["name"]}}</td>
                                <td>{{$sche["cpf"]}}</td>
                                <td>{{$sche["birth_date"]}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
