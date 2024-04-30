/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_black_clover

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-04-30 20:16:50
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `magic_type`
-- ----------------------------
DROP TABLE IF EXISTS `magic_type`;
CREATE TABLE `magic_type` (
  `id_magic_type` int(255) NOT NULL AUTO_INCREMENT,
  `magic_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_magic_type`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of magic_type
-- ----------------------------
INSERT INTO `magic_type` VALUES ('1', 'Elemental Magic');
INSERT INTO `magic_type` VALUES ('3', 'Anti Magic');
INSERT INTO `magic_type` VALUES ('4', 'Illusion Magic');
INSERT INTO `magic_type` VALUES ('5', 'Healing Magic');
INSERT INTO `magic_type` VALUES ('6', 'Curse Magic');
INSERT INTO `magic_type` VALUES ('12', 'Transformation Magic');

-- ----------------------------
-- Table structure for `squad`
-- ----------------------------
DROP TABLE IF EXISTS `squad`;
CREATE TABLE `squad` (
  `id_squad` int(255) NOT NULL AUTO_INCREMENT,
  `squad_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_squad`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of squad
-- ----------------------------
INSERT INTO `squad` VALUES ('1', 'Black Bulls');
INSERT INTO `squad` VALUES ('2', 'Golden Dawn');
INSERT INTO `squad` VALUES ('3', 'Silver Eagles');
INSERT INTO `squad` VALUES ('4', 'Crimson Lions');
INSERT INTO `squad` VALUES ('5', 'Blue Rose');
INSERT INTO `squad` VALUES ('6', 'Green Mantis');
INSERT INTO `squad` VALUES ('7', 'Coral Peacocks');

-- ----------------------------
-- Table structure for `tcharacter`
-- ----------------------------
DROP TABLE IF EXISTS `tcharacter`;
CREATE TABLE `tcharacter` (
  `id_character` int(255) NOT NULL AUTO_INCREMENT,
  `character_name` varchar(255) DEFAULT NULL,
  `character_age` int(255) DEFAULT NULL,
  `character_height` int(255) DEFAULT NULL,
  `character_foto` varchar(50) DEFAULT NULL,
  `id_squad` int(255) NOT NULL,
  `id_magic_type` int(255) NOT NULL,
  PRIMARY KEY (`id_character`),
  KEY `fsquad` (`id_squad`),
  KEY `fmagic` (`id_magic_type`),
  CONSTRAINT `fmagic` FOREIGN KEY (`id_magic_type`) REFERENCES `magic_type` (`id_magic_type`),
  CONSTRAINT `fsquad` FOREIGN KEY (`id_squad`) REFERENCES `squad` (`id_squad`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tcharacter
-- ----------------------------
INSERT INTO `tcharacter` VALUES ('2', 'William Vangeance', '26', '172', 'william.jpg', '2', '1');
INSERT INTO `tcharacter` VALUES ('3', 'Mimosa Vermillion', '15', '158', 'mimosa.jpg', '2', '5');
INSERT INTO `tcharacter` VALUES ('4', 'Nozel Silva', '29', '177', 'nozel.jpg', '3', '1');
INSERT INTO `tcharacter` VALUES ('9', 'Gordon Agripa', '26', '187', 'gordon.jpg', '1', '6');
INSERT INTO `tcharacter` VALUES ('10', 'Asta', '16', '158', 'asta.jpeg', '1', '3');
