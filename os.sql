/*
 Navicat Premium Data Transfer

 Source Server         : N49 Local
 Source Server Type    : MariaDB
 Source Server Version : 100148 (10.1.48-MariaDB-0ubuntu0.18.04.1)
 Source Host           : 192.168.1.123:3306
 Source Schema         : os

 Target Server Type    : MariaDB
 Target Server Version : 100148 (10.1.48-MariaDB-0ubuntu0.18.04.1)
 File Encoding         : 65001

 Date: 04/08/2023 02:35:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for equipamentos
-- ----------------------------
DROP TABLE IF EXISTS `equipamentos`;
CREATE TABLE `equipamentos`  (
  `id_equipamento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('IMP','EQP') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `modelo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `marca` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `serie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `garantia` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ref` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `num_patrimonio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `descricao` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id_equipamento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of equipamentos
-- ----------------------------
INSERT INTO `equipamentos` VALUES (1, 'EQP', 1, '1231', 'DELL', '1', '192.168.1.1', '1 ano', 'preto', 'EQP-1231231', 'teste');
INSERT INTO `equipamentos` VALUES (2, 'IMP', 1, '321', 'HP', 'DESKJET', '192.168.2.1', '', 'Branca', 'IMP-12312', NULL);
INSERT INTO `equipamentos` VALUES (3, 'EQP', 0, 'Inspiron 15', 'Dell', '2', '127.0.0.1', 'Sem Garantia', 'PC Preto', 'EQP-64c9ada7a4dcb', 'teste213123');
INSERT INTO `equipamentos` VALUES (5, 'IMP', 0, 'Deskjet', 'Hp', 'Serie 2', '127.0.0.1', 'teste', 'teste', 'EQP-64c9b071eb90c', 'teste');

-- ----------------------------
-- Table structure for os
-- ----------------------------
DROP TABLE IF EXISTS `os`;
CREATE TABLE `os`  (
  `id_os` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `data_hora` datetime NULL DEFAULT NULL,
  `data_hora_update` datetime NULL DEFAULT NULL,
  `id_equipamento` int(11) NULL DEFAULT NULL,
  `id_setor` int(11) NULL DEFAULT NULL,
  `problema_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `data_hora_agenda` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `diagnostico` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `solucao` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `previsao_entrega` datetime NULL DEFAULT NULL,
  `data_entrega` datetime NULL DEFAULT NULL,
  `valor` decimal(10, 2) NULL DEFAULT NULL,
  `obs` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `id_tecnico` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_os`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of os
-- ----------------------------
INSERT INTO `os` VALUES (1, 1, 2, '2023-07-31 22:20:05', '2023-07-31 22:20:15', 1, 1, 'Computador queimou fonte', NULL, 'Teste de diagnostico', 'teste de solução', '2023-08-24 00:14:00', '2023-08-04 01:22:07', NULL, 'teste', 2);
INSERT INTO `os` VALUES (2, 3, 2, '2023-07-31 22:20:05', '2023-07-31 22:20:15', 2, 1, 'HP sem cabo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `os` VALUES (3, 4, 2, '2023-07-31 22:20:05', '2023-07-31 22:20:15', 2, 1, 'HP sem cabo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `os` VALUES (4, 4, 2, '2023-07-31 22:20:05', '2023-07-31 22:20:15', 1, 1, 'Computador queimou fonte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `os` VALUES (8, 4, 1, '2023-08-02 00:04:01', '2023-08-02 00:04:01', 3, 1, 'teste23', NULL, NULL, NULL, NULL, NULL, NULL, 'teste', NULL);

-- ----------------------------
-- Table structure for setor
-- ----------------------------
DROP TABLE IF EXISTS `setor`;
CREATE TABLE `setor`  (
  `id_setor` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_setor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setor
-- ----------------------------
INSERT INTO `setor` VALUES (1, 'Almoxarifado', 1);
INSERT INTO `setor` VALUES (2, 'Geral', 0);
INSERT INTO `setor` VALUES (3, 'Sala', 1);
INSERT INTO `setor` VALUES (5, 'Almoxarifado 2', 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `roles` enum('ADMIN','TECNICO','USER') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'admin', '$2y$10$GGD.fRr9JVAMIZCcbr0HBOYB4ArNwq9EVbaALGjbAxjJQ9tAA8Kny', 'ADMIN', 1);
INSERT INTO `users` VALUES (2, 'Carlos', 'cdsx220', '$2y$10$z0W0QGeB78QF7y2c9b.otuIEmlKY1KeWlr8BuDcQtTTqLOp5AQ7v2', 'TECNICO', 1);
INSERT INTO `users` VALUES (4, 'joe', 'joedoe', '$2y$10$DEItauJ90nnmBxzZYX.pYO8OpDVitJqU30uro8PC4.YJiJ4w01u32', 'USER', 1);

SET FOREIGN_KEY_CHECKS = 1;
