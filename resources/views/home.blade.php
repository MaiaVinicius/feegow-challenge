@extends('layouts.app', ['current' => 'home'])
@section('title')
    <title>Home</title>
@endsection
@section('style')
    <style>
        html, body, {
            height: 100%;
            overflow: auto;
        }

        #ask {
            font-family: Helvetica,Arial,sans-serif;
            font-size: 30px;
            font-weight: bold;
            color: #fff;
        }

        .container {
            width: 100%;
            height: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
@section('body')
    <body>
        <div class="containter">
            <form action="/pro" id="form" method="post">
            @csrf
                <input name="espec" type="hidden" id="espec" value="0. Psicólogo clínico">
                <input name="especId" type="hidden" id="especId" value="188">
                <label id="ask" for="especiality">Qual é a especialidade que você procura ?</label><br>
                <select name="especiality" id="especiality" class="form-control" onChange="b()" value="0">
                </select>
                <button id="buscar" type="submit" class="btn btn-primary form-control">Buscar</button>
            </form>
        </div>
    </body>
@endsection

@section('javascript')
<script>
/**
 * Função que popula o select de busca com os dados da API requisitada.
 */
$(function(){
    $.ajax({
        url: "https://api.feegow.com.br/api/specialties/list",
        type: "get",
        data: {},
        headers: { 'x-access-token': "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38" },
        success: function(data) {
            for (let i = 0; i < data.content.length; i++) {
                $('#especiality').append(`<option value=${i}>${data.content[i]['nome']}</option>`)
            }
        }
    });
});

/**
 * Função utilizada para permutar as opções do select quando alteradas pelo usuário.
 */
function b() {
    const especialidade = $('#especiality').val()
    $.ajax({
        url: "https://api.feegow.com.br/api/specialties/list",
        type: "get",
        data: {},
        headers: { 'x-access-token': "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38" },
        success: function(data) {
            especId = data.content[especialidade]['especialidade_id'] == null ? 123 : data.content[especialidade]['especialidade_id']
            d = data.content[especialidade]['nome']
            $('#espec').remove()
            $('#especId').remove()
            $('#form').append(`<input name="espec" type="hidden" id="espec" value="${d}">`)
            $('#form').append(`<input name="especId" type="hidden" id="especId" value="${especId}">`)
        }
    });
}
</script>

@endsection
