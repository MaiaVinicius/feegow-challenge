var mysql_query = require('../config/mysql');



const runSql = (sql, callback) =>{
    mysql_query(sql, function(error, results)   {
        return callback(results);
    });
}

exports.testaEstrutura = async () =>{
    let sql =`CHECK TABLE agendamento FAST QUICK`
    await runSql(sql,(res)=>{
        if(res[0].Msg_type == "Error"){
            migration()
        }
    })
}

exports.agendar = async (agendamento,callback) =>{
    console.log(agendamento)
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;

    let sql =`INSERT INTO agendamento
        (
            name,
            cpf,
            birthdate,
            specialty_id,
            professional_id,
            source_id,
            date_time
        )
    VALUES(
        '${agendamento.nomeCompleto}',
        '${agendamento.cpf}',
        '${agendamento.nascimento}',
        ${agendamento.especialidade},
        ${agendamento.profissional},
        ${agendamento.conheceu},
        '${agendamento.agendamento}'
    );`
    
    await runSql(sql,(res)=>{
        let resposta
        if(res.affectedRows){
            resposta = {
                success:true,
                content:true
            }
        }else{
            resposta = {
                success:false,
                content:false
            }
        }
        return callback(resposta)
    })
}

const migration = async ()=>{
    let sql = `CREATE TABLE agendamento 
        (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL, 
            cpf char(14) NOT NULL,
            birthdate char(10) NOT NULL,
            specialty_id int NOT NULL,
            professional_id int NOT NULL,
            source_id int NOT NULL,
            date_time DATETIME NOT NULL
        )`;
    await runSql(sql,(res)=>{
        if(res){
            return true
        }
    })
}
