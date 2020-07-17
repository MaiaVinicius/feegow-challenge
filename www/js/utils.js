/* ----------------------------------------------------------------------------------------------------------------------
	JS PARA CARREGAR OS UTILITARIOS
---------------------------------------------------------------------------------------------------------------------- */


var utilitarios = function(){
    const normalizaString = (nomeRaw) =>{
        var nomeArray = nomeRaw.toLowerCase().split(/\s+/);
        var normalizado = nomeArray.map(function(nome) {
            if(nome[0] == "("){
                return nome.charAt(0) + nome.charAt(1).toUpperCase() + nome.substr(2);
            }
            if(nome.length > 2){
                return nome.charAt(0).toUpperCase() + nome.substr(1);
            }
        });
        return normalizado.join(" ");
    }

    function setDefaults(params, defaults){
        var recursive = true;
        return $.extend(recursive, {}, defaults, params);
    }

    function request (url,type,data=false,destino=false,calback=false){

        let options = {
            type: type,
            headers: { "Accept": "application/json", "Access-Control-Allow-Origin":'test.com.br'},
            url:`${url}`,
            crossDomain: true,
            beforeSend: function(xhr){
                xhr.withCredentials = true;
            }
        } 
        if(data){
            options.data = data
        }

        $.ajax(options)
        .done(function (resposta) {
            if(resposta.success){
                if(typeof destino == "function"){
                    destino(resposta.content,calback)
                }else{
                    console.log(resposta)
                }
            } 
        })
        .fail(function(err) {
            swal({
                title: "Algo de errado não está certo!",
                text: "houston we have a problem!",
                icon: "error",
            })
            console.log('Err',err)
        })   
    }

    /**
     * Funções externadas
     */
    return {
        normalizaString     : normalizaString,
        setDefaults         : setDefaults,
        request             : request
    };
}()