const express = require('express')
const app = express()
const bodyParser = require('body-parser');
const cors = require('cors');

//porta
const {PORT} = process.env

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended:true}));
app.use(cors());

//rotas
var api = require('./routes/api');
app.use('/api', api);

app.listen(PORT, () => console.log(`Example app listening at http://localhost:${PORT}`))