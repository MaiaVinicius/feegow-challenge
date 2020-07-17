/* ----------------------------------------------------------------------------------------------------------------------
	JS PARA CARREGAR O SELECT
---------------------------------------------------------------------------------------------------------------------- */

var seletorEspecialidades = function(){
    var $opts = {};
	var _optsDefaults = {
		'api'			    :   'http://localhost:3000/api',
        'id'			    :   'selectEspecialidade',
        'fns'               :   null
	};

    function init(opts,fns){
        opts.fns = fns
        $opts = fns.setDefaults(opts, _optsDefaults);
        let url='/getEspecialidades'
        $opts.fns.request($opts.api+url,'GET',false,populate,managerEspecialidade)
    }

    function populate(content,callback){
        let id = $(`#${$opts.id}`)
        let html = '<option>Selecione a especialidade</option>'
        content.filter((item)=>{
            html += `<option value='${item.especialidade_id}'>${$opts.fns.normalizaString(item.nome)}</option>`
        })
        $(id).children().detach()
        $(id).append(html)

        if(typeof callback == "function")
        callback()
    }

    function managerEspecialidade(){
        $(`#${$opts.id}`).change((ev)=>{
            let selecionado = $(ev.target).val()
            let url = '/getProfissionais/'+selecionado
            $opts.fns.request($opts.api+url,"GET",false,montaGrid)
        })
    }

    function montaGrid(content){
        let html = ''
        content.map((profissional)=>{
            html += montaBox(profissional)
        })
        $('#grid').children().detach()
        $('#grid').append(html)

        $('#form').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id') 
            var modal = $(this)
            modal.find('#profissional').val(recipient)
        })
    }

    function montaBox(profissional){
        let obj = `
            <div class='box' data-toggle="modal" data-target="#form" data-id="${profissional.profissional_id}">
                <div class='d-flex'>
                    <div class='col- col-sm-4'>
                        <div class='avatar'>
                            <img src='${profissional.foto}'/>
                        </div>
                    </div>
                    <div class='col-sm-8'>
                        <p>${profissional.tratamento!=null?profissional.tratamento:''} ${profissional.nome}</p>
                        <small>${profissional.conselho!=null?profissional.conselho:'CRM'}: ${profissional.documento_conselho}</small> 
                    </div>
                </div>
                <div class='d-flex'>
                    <button class='newBtn'>Agendar</button>
                </div>
            </div>
        
        `

        return obj
    }

    /**
     * Funções externadas
     */
    return {
        init                : init,
    };
}()
