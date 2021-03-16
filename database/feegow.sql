/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100411
Source Host           : localhost:3306
Source Database       : feegow

Target Server Type    : MYSQL
Target Server Version : 100411
File Encoding         : 65001

Date: 2020-10-25 20:27:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `conf_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conf_key` varchar(255) DEFAULT '',
  `conf_value` varchar(255) DEFAULT '',
  `conf_type` varchar(255) DEFAULT '',
  PRIMARY KEY (`conf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'BASE', 'http://localhost/feegow', 'ADMIN');
INSERT INTO `config` VALUES ('2', 'THEME', 'feegow', 'ADMIN');

-- ----------------------------
-- Table structure for schedules
-- ----------------------------
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `specialty_id` int(11) unsigned DEFAULT NULL,
  `professional_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `source_id` int(11) unsigned DEFAULT NULL,
  `birthdate` timestamp NULL DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of schedules
-- ----------------------------
