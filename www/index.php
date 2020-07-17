<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">

    <title>feegow test</title>
  </head>
  <body>
    <div id='warper' class="d-flex justify-content-center align-items-center">
      <div class="card">
        <div class="card-body">
          <div id='logo'>
              <img src="/assets/logo_branca.png" alt="">
          </div>
          <div>
            <div class="form-group row consulta">
              <label for="selectEspecialidade" class="col-sm-3 col-form-label">Consulta de</label>
              <div class="col-sm-9">
                <select class="form-control" id="selectEspecialidade">
                  <option value="0">Carregando...</option>
                </select>
              </div>
            </div>
            <div id='grid' class='d-flex justify-content-start'>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Preencha seus dados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input id='profissional' type="hidden">

          <div class="row">
            <div class="col">
              <input id='nomeCompleto' type="text" class="form-control" placeholder="Nome completo" required>
            </div>
            <div class="col">
              <select id='selectConheceu' type="text" class="form-control" placeholder="Como conheceu" required>
              </select>
            </div>
          </div>
          </br>
          <div class="row">
            <div class="col">
              <input id='nascimento' type="text" class="form-control date" placeholder="Nascimento" required>
            </div>
            <div class="col">
              <input id='cpf' type="text" class="form-control cpf" placeholder="CPF" required>
            </div>
          </div>
          <?php
            $date = date("Y-m-d H:i");
            $dateInitialA = explode(' ',$date);
            $dateInitialA[1] = '08:30';
            $dateInitial = implode('T',$dateInitialA);
            $date = strtotime($date);
            $finaldate = date("Y-m-d H:i",strtotime("+7 day", $date));
            $finaldateA = explode(' ',$finaldate);
            $finaldateA[1] = '16:00';
            $finaldate = implode('T',$finaldateA);
          ?>
          </br>
          <div class="row">
            <div class="col">
              <input type="datetime-local" class='form-control' id="agendamento" name="agendamento" min="<?=$dateInitial?>" max="<?=$finaldate?>" required>
            </div>
          </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button id='agendar' type="button" class="btn btn-primary" disabled>Enviar</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/js/utils.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script src="/js/structure.js"></script>
    <script src="/js/selectEspecialidades.js"></script>
    <script src="/js/selectConheceu.js"></script>
    <script src="/js/agendar.js"></script>
    <script src="/js/validar.js"></script>
    <script>
      $(document).ready(function(){
        structure.init({},utilitarios)

        seletorEspecialidades.init({
          id			: 'selectEspecialidade'
        },utilitarios)

        seletorConheceu.init({
          id			: 'selectConheceu'
        },utilitarios)

        agendar.init({
          id			: 'agendar'
        },utilitarios)

        validadeModal.init({},utilitarios)

      })
    </script>
  </body>
</html>