@extends('layouts.app', ['current' => 'solicitacoes'])
@section('title')
    <title>Solicitações</title>
@endsection
@section('style')
    <style>
        html, body, {
            height: 100%;
            overflow: auto;
        }
    </style>
@endsection
@section('body')
    <body>
        <div class="containter">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Todas as solicitações</h5>
@if(count($sols) > 0)
                    <table class="table table-ordered table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Nascimento</th>
                                <th>CPF</th>
                                <th>Especialidade</th>
                                <th>Como conheceu</th>
                                <th>Id da especialidade</th>
                                <th>Id do profissional</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sols as $s)
                            <tr>
                                <td>{{$s->name}}</td>
                                <td>{{$s->birthdate}}</td>
                                <td>{{$s->cpf}}</td>
                                <td>{{$s->especialty}}</td>
                                <td>{{$s->source_id}}</td>
                                <td>{{$s->specialty_id}}</td>
                                <td>{{$s->professional_id}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
@else <h4>Ainda não há solicitações<h4> @endif
                </div>
            </div>
        </div>
    </body>
@endsection

@section('javascript')

@endsection
