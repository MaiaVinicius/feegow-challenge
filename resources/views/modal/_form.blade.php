<div class="modal fade" id="formAgendamento" tabindex="-1" role="dialog" aria-labelledby="formAgendamento" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preencha com suas informações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="resp"></div>
                <form class="form-row">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="Nome Completo" class="col-form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="message-text" class="col-form-label">Como conheceu</label>
                        <select class="custom-select" name="source_id" id="source_id">
                            @foreach($specialties["utilitiesSelect"]["content"] as $option)
                                <option value="{{$option["origem_id"]}}">{{$option["nome_origem"]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="message-text" class="col-form-label">Nascimento</label>
                        <input type="date" class="form-control" id="birthday" name="birthday">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="message-text" class="col-form-label">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
                <button type="button" class="btn btn-primary" id="enviarForm">SOLICITAR HORÁRIOS</button>
            </div>
        </div>
    </div>
</div>
