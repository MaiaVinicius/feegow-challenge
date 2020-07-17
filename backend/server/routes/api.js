var express = require('express');
var router = express.Router();

// chamada do controller
const apiController  = require("../controllers/apiController");

router.get('/', (req, res) => res.send('Hello World!'));
router.get('/structure', apiController.structure);
router.get('/getEspecialidades', apiController.especialidades);
router.get('/getProfissionais/:especialidade', apiController.profissionais);
router.get('/getConheceu', apiController.conheceu);
router.post('/agendar', apiController.agendar);




module.exports = router;