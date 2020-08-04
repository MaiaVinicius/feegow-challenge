<?php
   // At top:
   require('src/views/layout/Header.php');
   
   require_once("src/classes/Conexao.php");
   $conn = new Conexao();
   
   ?>

<div class="container-fluid d-flex justify-content-center align-items-center p-4 jumbotron">
   <div class="w-50">
      <select class="lista_especialidades" style="width: 100%;"></select>
   </div>
</div>
<div class="container mt-4">
   <div class="card-columns ">
      <div id="result"></div>
   </div>
</div>
<div class="modal fade" id="consult" tabindex="-1" role="dialog" aria-labelledby="consultLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Agendar Consulta</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form id="agendar_consulta" >
                  <input type="text" class="form-control" name="specialty_id" id="specialty_id" hidden>
                  <input type="text" class="form-control" name="professional_id" id="profissional_id" hidden>
                  <div class="form-group">
                     <input type="text" class="form-control" name="name" placeholder="Nome Completo">
                  </div>
                  <div class="form-group">
                     <select class="form-control lista_como_conheceu" name="source_id"
                        style="width: 100%;"></select>
                  </div>
                  <div class="form-group">
                     <input type="text" placeholder="Data de nascimento" class="form-control" name="birthdate" onfocus="(this.type='date')">
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control cpf" name="cpf">
                  </div>
                  <button class="btn btn-info btn-lg btn-block rounded-0" id="enviar_consulta">Solicitar
                  Horários</button>
               </form>
            </div>
         </div>
      </div>
   </div>


<?php
   // At bottom:
   require('src/views/layout/Footer.php');
   ?>