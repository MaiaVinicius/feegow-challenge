<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      Feegow Challenge
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>
<body class="home">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Feegow</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <form class="form-inline my-2 my-lg-0">
          <label>Buscar por especialidade:&nbsp;</label>
          <select class="form-control mr-sm-2" id="speciality_id">
            <option value="">Carregando, por favor aguarde...</option>
          </select>
          <button class="btn btn-outline-success my-2 my-sm-0" type="button" id="btnAgendar">Agendar</button>
        </form>
      <li>
    </ul>
    
  </div>
</nav>

<div class="container" style="margin-top: 3vh;">
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card" id="card_results" style="display: none;">
        <div class="card-body">
          <h5>Resultado </h5>

          <div class="row" id="people_list"></div>
        </div>
      </div>

      <div class="card" id="card_form" style="display: none;">
        <div class="card-body">
          <h3>Preencha seus dados</h3>
          <form>
            <div class="row">
              <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label for="nomeField">Nome completo:</label>
                  <input type="text" class="form-control" id="nomeField" placeholder="Ex: José Silva">
                </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label for="comoConheceuField">Como conheceu:</label>
                  <select type="text" class="form-control" id="comoConheceuField">
                    <option value="">Carregando...</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label for="nomeField">Nascimento:</label>
                  <input type="text" class="form-control" id="nascimentoField" placeholder="Ex: 12/04/1995" data-mask="00/00/0000">
                </div>
              </div>

              <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label for="nomeField">CPF:</label>
                  <input type="text" class="form-control" id="cpfField" placeholder="Ex: 123.456.789-22" data-mask="000.000.000-00">
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-primary" id="solicitarHorario">Solicitar horários</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.1/dist/sweetalert2.all.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>
