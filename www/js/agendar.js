/* ----------------------------------------------------------------------------------------------------------------------
	JS PARA CARREGAR O SELECT
---------------------------------------------------------------------------------------------------------------------- */

var agendar = function(){
    var $opts = {};
	var _optsDefaults = {
		'api'			    :   'http://localhost:3000/api',
        'id'			    :   'agendar',
        'fns'               :   null
	};

    function init(opts,fns){
        opts.fns = fns
        $opts = fns.setDefaults(opts, _optsDefaults);
 
        $('.date').mask('00/00/0000');
        $('.cpf').mask('000.000.000-00', {reverse: true});

        $(`#${$opts.id}`).click(()=>{
            let nomeCompleto    = $('#nomeCompleto').val()
            let conheceu        = $('#selectConheceu').val()
            let nascimento      = $('#nascimento').val()
            let cpf             = $('#cpf').val()
            let especialidade   = $('#selectEspecialidade').val()
            let profissional    = $('#profissional').val()
            let agendamento    = $('#agendamento').val()

            let obj = {
                nomeCompleto,
                conheceu,
                nascimento,
                cpf,
                especialidade,
                profissional,
                agendamento
            }

            let url='/agendar'
            $opts.fns.request($opts.api+url,'POST',obj,(resposta,coisa)=>{
                swal({
                    title: "Agendamento concluido!",
                    text: "Sua consulta foi agendada com sucesso!",
                    icon: "success",
                }).then((value) => {
                    location.reload();
                });
            })
        })
    }

    /**
     * Funções externadas
     */
    return {
        init                : init,
    };
}()
