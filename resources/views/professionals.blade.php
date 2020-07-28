@extends('layouts.app', ['current' => 'professionals'])
@section('title')
    <title>Especialidade de {{$espec}}</title>
@endsection
@section('style')
    <style>
        html, body, {
            height: 100%;
            overflow: auto;
        }

        #textName {
            display: flex;
            font-family: Helvetica,Arial,sans-serif;
            font-size: 15px;
            font-weight: bold;
            float: right;
            padding-right: 0px;
        }

        #desc {
            display: block;
        }

        #text {
            float: right;
        }

        #img {
            float: left;
            height: 75px;
            width: 75px;
            border-radius: 50%;
        }

        #agendar {
            margin: 5px 5px 5px 5px;
        }

        .card {
            width: 100%;
            height: 100%;
            display: flex;
        }
    </style>
@endsection
@section('body')
    <body>
        <div class="containter">
            <div class="card">
                <input type="hidden" id="espec" value="{{$espec}}">
                <input type="hidden" id="especId" value="{{$especId}}">
                <div class="card card-header"><strong>Especialistas Disponíveis</strong></div>
                <div class="card card-body">
                    <div class="container">
                        <div class="row" id="cardBody">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalAgendamento" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="form" method="POST" action="/solicity" id="formAgendamento">
                            <div class="modal-header">
                                <h5 class="modal-title">Solicitar horários para consultas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="removeId()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nome" class="control-label">Nome completo</label>
                                    <div class="input-group">
                                        <input name="nome" id="nome" type="text" class="form-control" placeholder="Insira seu nome completo">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nascimento" class="control-label">Data de nascimento</label>
                                    <div class="input-group">
                                        <input name="nascimento" id="nascimento" type="text" class="form-control" placeholder="Insira sua data de nascimento">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="slcAgendamento" class="control-label">Como conheceu ?</label>
                                    <div class="input-group">
                                        <select name="slcAgendamento" id="slcAgendamento" class="form-control" id="slcAgendamento" value="Amigos"><select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cpf" class="control-label">CPF</label>
                                    <div class="input-group">
                                        <input name="cpf" id="cpf" type="text" class="form-control" placeholder="Digite seu CPF">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="agendamento()">Solicitar horários</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="removeId()">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
@endsection

@section('javascript')
<script>
/**
 * requisição ajax que preenche a página com os profissionais da especialização desejada.
 */
$(function(){
    $.ajax({
        url: "https://api.feegow.com.br/api/professional/list",
        type: "get",
        data: {},
        headers: { 'x-access-token': "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38" },
        success: function(data) {
            let perfis = {}
            for (let i = 0; i < data.content.length; i++) {
                try {
                    /** Fiz essa cambiarra nos índices abaixo em "especialidades" para conseguir retornar o valor para mim, pois
                     *  não consegui encontrar outra maneira de fazer o retorno em cada índice.
                     *  Será interessante encontrar alguém que soubesse uma forma de consertar
                    */

                    /**
                    *   Basicamente as funções repetidas no ajax abaixo retorna os valores da API comparando com
                    *   os valores recebidos da página principal(especialidade) e implementa no HTML acima.
                    */
                    if($('#espec').val() == data.content[i].especialidades[0]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[1]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[2]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[3]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[4]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[5]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[6]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[7]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[8]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else if($('#espec').val() == data.content[i].especialidades[9]['nome_especialidade']) {
                        let crm = data.content[i]['conselho'] == null ? 'CRM' : data.content[i]['conselho']
                        let crmNum = data.content[i]['conselho'] == null ? '123456789' : data.content[i]['documento_conselho']
                        let idProfessional = data.content[i]['profissional_id'] == null ? '978' : data.content[i]['profissional_id']
                        $('#cardBody').append(`
                        <div class="card col-sm-4" style="margin-left: 3px; margin-right: 3px; margin-bottom: 5px;">
                            <div class="card-body">
                                <img id="img" src="${data.content[i]['foto']}">
                                <div id="text">
                                    <div class="row">
                                    <span id="textName">${data.content[i]['nome']}</span><br>
                                    </div>
                                    <div class="row">
                                    <text>${crm}: ${crmNum}</text>
                                    </div>
                                </div>
                            </div>
                        <button id="agendar" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modalAgendamento" onClick="know(${idProfessional})">Agendar</button>
                        </div>`)
                    } else {
                        //
                    }
                } catch {
                    //
                }
            }
        }
    });
});

/**
*   A função abaixo recebe o id do profissional e implementa um input hidden para ser consumido e também carrega
*   os valores do select.
*/

function know(id) {
    $('#professional_id').remove()
    $('#formAgendamento').append(`<input name="professional_id" type="hidden" id="professional_id" value="${id}">`)
    $.ajax({
        url: "https://api.feegow.com.br/api/patient/list-sources",
        type: "get",
        data: {},
        headers: { 'x-access-token': "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38" },
        success: function(data) {
            for (let i = 0; i < data.content.length; i++) {
                $('#slcAgendamento').append(`<option value="${data.content[i]['nome_origem']}">${data.content[i]['nome_origem']}</option>`)
            }
        }
    });
}

function removeId() {
    $('#professional_id').remove()
}

/**
*   A função envia a requisição post para salvar, os dados digitados e os dos inputs hiddens, no banco de dados.
*/
function agendamento() {
    $.ajax({
        url: "/solicity",
        type: "post",
        data: {
            specialty_id: $('#especId').val(),
            professional_id: $('#professional_id').val(),
            name: $('#nome').val(),
            espec: $('#espec').val(),
            cpf: $('#cpf').val(),
            source_id: $('#slcAgendamento').val(),
            birthdate: $('#nascimento').val(),
        },
        headers: { 'X-CSRF-TOKEN' : "{{ csrf_token() }}" },
        success: function(data) {
            alert('Sua solicitação foi enviada com sucesso.')
            return window.location.replace("http://localhost:8000/solicitacoes");
        },
        error: function(e){
            alert("Erro: " + e)
        }
    });
}
</script>
@endsection
