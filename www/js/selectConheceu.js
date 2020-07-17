/* ----------------------------------------------------------------------------------------------------------------------
	JS PARA CARREGAR O SELECT
---------------------------------------------------------------------------------------------------------------------- */

var seletorConheceu = function(){
    var $opts = {};
	var _optsDefaults = {
		'api'			    :   'http://localhost:3000/api',
        'id'			    :   'selectConheceu',
        'fns'               :   null
	};

    function init(opts,fns){
        opts.fns = fns
        $opts = fns.setDefaults(opts, _optsDefaults);
        let url='/getConheceu'
        $opts.fns.request($opts.api+url,"GET",false,populate)

        $('.date').mask('00/00/0000');
        $('.cpf').mask('000.000.000-00', {reverse: true});
    }

    function populate(content,callback){
        let id = $(`#${$opts.id}`)
        let html = '<option value="0">Como conheceu?</option>'
        content.filter((item)=>{
            html += `<option value='${item.origem_id}'>${$opts.fns.normalizaString(item.nome_origem)}</option>`
        })
        $(id).children().detach()
        $(id).append(html)

        if(typeof callback == "function")
        callback()
    }
    /**
     * Funções externadas
     */
    return {
        init                : init,
    };
}()
