const apiLib = require('../library/api-Lib')
const externa = require('../library/api-externa')


exports.structure = async (req,res)=>{
    res.send(apiLib.testaEstrutura())
}


exports.especialidades = (req,res)=>{
    externa.especialidades((resposta)=>{
        res.send(resposta)
    })
}

exports.profissionais = (req,res)=>{
    let especialidade = req.params.especialidade
    externa.profissionais(especialidade,(resposta)=>{
        res.send(resposta)
    })
}

exports.conheceu = (req,res)=>{
    externa.conheceu((resposta)=>{
        res.send(resposta)
    })
}

exports.agendar =  (req,res)=>{
    let params = req.body
    apiLib.agendar(params,(retorno)=>{
        res.send(retorno)
    })
}