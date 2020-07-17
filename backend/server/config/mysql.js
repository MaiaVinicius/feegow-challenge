// Dependencias
var mysql   = require('mysql')

const log4js = require("log4js");
let log = log4js.getLogger();
log.level = "debug";
/*
 * @sqlConnection
 * Cria a conexão, faz a query e fecha.
 */
const sqlConnection = (sql, values, next) => {

    // testando se tem argumentos
    if (arguments.length === 2) {
        next = values;
        values = null;
    }

    // pegando os valores do enviroment
    let {
        DB_CONNECTION,
        DB_HOST,
        DB_PORT,
        DB_DATABASE,
        DB_USERNAME,
        DB_PASSWORD
        } = process.env

    // cria a conexão padrão
    const connection = mysql.createConnection({
        host        : DB_HOST,
        user        : DB_USERNAME,
        password    : DB_PASSWORD,
        database    : DB_DATABASE
    });

    connection.connect(function(err) {
        if (err !== null) {
            log.error("[MYSQL] Erro ao conectar no mysql:" + err+'\n');
        }
    });

    log.info("[MYSQL] Conectado no mysql:"); 

    connection.query(sql, values, function(err) {

        connection.end(); // fecha a conexão

        if (err) {
            throw err;
        }

        // executa o callback
        next.apply(this, arguments);
    });
}

module.exports = sqlConnection;