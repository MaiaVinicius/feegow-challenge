<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feegow</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">
            <img src="https://www.feegowclinic.com.br/wp-content/uploads/2020/03/logo-feegow_branca.png" alt="Logo Feegow clinic" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form class="form-inline my-2 my-lg-0 ml-auto">
                <select class="form-control" name="specialties" id="specialties">
                    <option value="">Escolhar uma especialidade</option>
                </select>
            </form>
        </div>
    </nav>







    <div class="container" id="result">

    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalSchedule">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agendamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/schedule" method="post" id="form-agendamento" class="needs-validation" novalidate>

                        <div id="mensagem"></div>

                        <input type="hidden" id="specialty_id" name="specialty_id">
                        <input type="hidden" id="professional_id" name="professional_id">

                        <div class="form-group">
                            <label for="nome">Nome completo</label>
                            <input type="text" class="form-control required" id="nome" name="name">
                        </div>

                        <div class="form-group">
                            <label for="nome">CPF</label>
                            <input type="text" class="form-control required" id="cpf" name="cpf">
                        </div>

                        <div class="form-group">
                            <label for="nome">Data de nascimento</label>
                            <input type="date" class="form-control required" id="birthdate" name="birthdate">
                        </div>

                        <div class="form-group">
                            <label for="source">Como conheceu</label>
                            <select id="source" name="source_id" class="form-control required">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nome">Data do agendamento</label>
                            <input type="datetime-local" class="form-control required" id="agendamento" name="date_time">
                        </div>
                    </form>
                </div>

                <!-- specialty_id, professional_id, name, cpf, source_id (GET /patient/list-sources), birthdate e date_time. -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirm-agendamento">Agendar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
    <script src="/js/script.js"></script>
</body>

</html>
