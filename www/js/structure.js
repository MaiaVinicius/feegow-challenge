/* ----------------------------------------------------------------------------------------------------------------------
	JS PARA CARREGAR O SELECT
---------------------------------------------------------------------------------------------------------------------- */

var structure = function(){
    var $opts = {};
	var _optsDefaults = {
		'api'			    :   'http://localhost:3000/api',
        'fns'               :   null
	};

    function init(opts,fns){
        opts.fns = fns
        $opts = fns.setDefaults(opts, _optsDefaults);
        let url = '/structure'
        $opts.fns.request($opts.api+url,"GET")
    }

    /**
     * Funções externadas
     */
    return {
        init                : init,
    };
}()
