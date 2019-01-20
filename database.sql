CREATE DATABASE IF NOT EXISTS `feegow` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `feegow`;

-- Copiando estrutura para tabela feegow.consultas
CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specialty_id` int(11) NOT NULL,
  `professional_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
