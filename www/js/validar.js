/* ----------------------------------------------------------------------------------------------------------------------
	JS PARA CARREGAR O SELECT
---------------------------------------------------------------------------------------------------------------------- */

var validadeModal = function(){
    var $opts = {};
	var _optsDefaults = {
        'fns'               :   null,
        'nomeCompleto'      :   false,
        'cpf'               :   false,
        'nascimento'        :   false,
        'selectConheceu'    :   false,
        'agendamento'       :   false
	};

    function init(opts,fns){
        opts.fns = fns
        $opts = fns.setDefaults(opts, _optsDefaults);

        $('.modal-body input').focusout((ev)=>{
            let quem = ev.target.id
            let valor = $(ev.target).val()
            if(valor[7] !== undefined){
                $opts[quem] =  true
                $(ev.target).removeClass('falta')
            }else{
                $opts[quem] =  false
                $(ev.target).addClass('falta')
            }
            liberaBtn()
        })

        $('.modal-body select').focusout((ev)=>{
            let quem = ev.target.id
            let valor = parseInt($(ev.target).val())
            if(valor > 0){
                $opts[quem] =  true
                $(ev.target).removeClass('falta')
            }else{
                $opts[quem] =  false
                $(ev.target).addClass('falta')
            }
            liberaBtn()
        })
    }

    function liberaBtn(){
        if(
            $opts.nomeCompleto &&
            $opts.cpf &&
            $opts.nascimento &&
            $opts.selectConheceu &&
            $opts.agendamento
        ){
            $('#agendar').attr('disabled',false)
        }else{
            $('#agendar').attr('disabled',true)
        }
    }

    /**
     * Funções externadas
     */
    return {
        init                : init,
    };
}()
