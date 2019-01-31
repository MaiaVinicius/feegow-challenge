<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="_token" content="{{csrf_token()}}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <link href="/css/custom.css" rel="stylesheet" >
        <script src="/js/jquery.maskedinput.js"></script>
        <script src="/js/custom.js"></script>

        <script id="cardsTemplate" type="text/html">
            <div class="col-md-4">
                <div class="card card-profile text-center">
                    <div class="card-avatar">
                        <a href="#">
                            <img class="rounded-circle img center-block" src="@{{if foto}}${foto}@{{else}}/images/user.png@{{/if}}">
                        </a>
                    </div>
                    <div class="card-body ">
                        <h6 class="card-name text-gray">${nome}</h6>
                        <h4 class="card-title">CRM ${documento_conselho}</h4>
                        <a href="#" class="btn btn-info agendar btn-round" data-professional_id="${profissional_id}" data-specialty_id="${specialty_id}">Agendar</a>
                    </div>
                </div>
            </div>

        </script>
        <script id="formTemplate" type="text/html">
            <h1>Preencha seus dados</h1>
            <form method="post" class="form" onsubmit="return submitForm(this)">
                <div class="alert-danger" style="display: none"><ul></ul></div>
                <div class="container">
                <div class="form-row">
                    <div class="col">
                            <input type="text" name="name" class="form-control" placeholder="Nome completo" />
                    </div>
                    <div class="col">
                        {{Form::select('source_id', [""=>"Como nos conheceu?"] + $sources ,null, ['class'=>'form-control', 'id' => 'especialidade'])}}
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <input placeholder="Nascimento" name="birthdate" class="form-control" type="text" onfocus="(this.type='date')" onfocus="(this.type='text')">
                    </div>
                    <div class="col">
                        <input type="text" name="cpf" class="cpf form-control" placeholder="CPF" />
                    </div>
                </div>
                <input type="hidden" name="professional_id" value="${professional_id}" />
                <input type="hidden" name="specialty_id" value="${specialty_id}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-row">
                    <div class="col">
                        <input type="submit" class="btn btn-info" value="Solicitar horários" />
                    </div>
                </div>
            </div>
            </form>
        </script>

    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Selecione a especialidade</h2>
                <div id="custom-search-input">
                    <div class="input-group col-12">
                        <?php echo Form::select('especialidade', $specialities,null, ['class'=>'form-control form-control-lg', 'id' => 'especialidade']);?>
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="title">
            <h3 class="mt-5"></h3>
        </div>

        <div id="cards" class="row"></div>
    </div>
    </body>
</html>
