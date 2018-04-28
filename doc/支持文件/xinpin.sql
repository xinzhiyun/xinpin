/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : xinpin

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-12-30 12:22:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xp_binding
-- ----------------------------
DROP TABLE IF EXISTS `xp_binding`;
CREATE TABLE `xp_binding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL COMMENT '经销商ID',
  `cid` int(11) NOT NULL COMMENT '机组ID',
  `addtime` int(11) NOT NULL COMMENT '绑定时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_binding
-- ----------------------------
INSERT INTO `xp_binding` VALUES ('1', '4', '1', '1514449160');
INSERT INTO `xp_binding` VALUES ('2', '4', '2', '1514449168');
INSERT INTO `xp_binding` VALUES ('3', '4', '3', '1514449179');
INSERT INTO `xp_binding` VALUES ('4', '4', '4', '1514449185');
INSERT INTO `xp_binding` VALUES ('5', '4', '5', '1514449192');
INSERT INTO `xp_binding` VALUES ('6', '4', '6', '1514449199');
INSERT INTO `xp_binding` VALUES ('7', '4', '7', '1514449206');
INSERT INTO `xp_binding` VALUES ('8', '4', '8', '1514449214');
INSERT INTO `xp_binding` VALUES ('9', '4', '9', '1514449223');

-- ----------------------------
-- Table structure for xp_card
-- ----------------------------
DROP TABLE IF EXISTS `xp_card`;
CREATE TABLE `xp_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iccard` varchar(50) NOT NULL COMMENT 'IC卡编号',
  `name` varchar(255) DEFAULT NULL COMMENT '持有人姓名',
  `studentcode` int(11) DEFAULT NULL COMMENT '学籍号',
  `school` varchar(255) DEFAULT NULL COMMENT '学校',
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `type` tinyint(1) NOT NULL COMMENT 'IC卡类型(0：免费 1：计费)',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态(0：未绑定 1：已绑定 2：挂失)',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_card
-- ----------------------------
INSERT INTO `xp_card` VALUES ('1', 'IC0002', '一楼', '568558', '状态新秀学校', '3', '0', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('2', 'IC0003', 'hhg', '828855', '献瑞而已学校', '3', '0', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('3', 'IC0004', '小阿      囧', '857', '高估菊   花姐姐学校', '3', '0', '1', '1514514781');
INSERT INTO `xp_card` VALUES ('4', 'IC0005', '小美', '5858568', '你咯胡咯简历学校', '3', '0', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('5', 'IC0006', '甜甜萌物语', '28458458', '无纪律唐考学校', '3', '0', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('6', 'IC0007', '物语', '5726428', '牛谜语咯了学校', '3', '0', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('7', 'IC0008', '鱼鱼', '5726428', '啦啦啦咯学校', '3', '0', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('8', 'IC0009', '@&lt;&gt;.../', '8885886', '牛仔裙金英敏学校', '3', '1', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('9', 'IC0010', '鱼鱼', '5726428', '依赖影响学校', '3', '1', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('10', 'IC0011', '鱼鱼', '5726428', '依赖影响学校', '3', '1', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('11', 'IC0012', '鱼鱼5726428', '55877', '依赖影响学校', '3', '1', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('12', 'IC0013', '鱼鱼', '5726428', '依赖影响越下越', '3', '1', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('13', 'IC0014', '夏天', '82546769', '夏天的学校', '3', '1', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('14', 'IC0015', '夏天', '82546769', '夏天的学校', '3', '1', '1', '1514446240');
INSERT INTO `xp_card` VALUES ('15', 'IC0016', null, null, null, null, '0', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('16', 'IC0017', null, null, null, null, '0', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('17', 'IC0018', null, null, null, null, '0', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('18', 'IC0019', null, null, null, null, '0', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('19', 'IC0020', null, null, null, null, '0', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('20', 'IC0021', null, null, null, null, '0', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('21', 'IC0022', null, null, null, null, '0', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('22', 'IC0023', null, null, null, null, '0', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('23', 'IC0024', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('24', 'IC0025', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('25', 'IC0026', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('26', 'IC0027', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('27', 'IC0028', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('28', 'IC0029', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('29', 'IC0030', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('30', 'IC0031', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('31', 'IC0032', null, null, null, null, '1', '0', '1514446240');
INSERT INTO `xp_card` VALUES ('32', 'IC0033', null, null, null, null, '1', '0', '1514446240');

-- ----------------------------
-- Table structure for xp_consume
-- ----------------------------
DROP TABLE IF EXISTS `xp_consume`;
CREATE TABLE `xp_consume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL COMMENT '设备ID',
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `icid` int(11) NOT NULL COMMENT 'IC卡ID',
  `flow` int(10) NOT NULL COMMENT '消费流量',
  `address` varchar(255) DEFAULT NULL COMMENT '消费地点',
  `time` int(11) NOT NULL COMMENT '消费时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_consume
-- ----------------------------

-- ----------------------------
-- Table structure for xp_crew
-- ----------------------------
DROP TABLE IF EXISTS `xp_crew`;
CREATE TABLE `xp_crew` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(255) NOT NULL COMMENT '机组名',
  `dcode` varchar(30) NOT NULL COMMENT '一号设备ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已绑定(0：未绑定  1：已绑定)',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_crew
-- ----------------------------
INSERT INTO `xp_crew` VALUES ('1', 'SB250', '23456', '1', '1514447464');
INSERT INTO `xp_crew` VALUES ('2', 'AE86', '34567', '1', '1514447464');
INSERT INTO `xp_crew` VALUES ('3', 'SB001', '123456', '1', '1514447560');
INSERT INTO `xp_crew` VALUES ('4', 'SB002', '123457', '1', '1514447560');
INSERT INTO `xp_crew` VALUES ('5', 'SB003', '123458', '1', '1514447560');
INSERT INTO `xp_crew` VALUES ('6', 'SB004', '123459', '1', '1514447560');
INSERT INTO `xp_crew` VALUES ('7', 'SB005', '123460', '1', '1514447560');
INSERT INTO `xp_crew` VALUES ('8', 'SB006', '123461', '1', '1514447560');
INSERT INTO `xp_crew` VALUES ('9', 'SB007', '123462', '1', '1514447560');
INSERT INTO `xp_crew` VALUES ('10', 'SB008', '123463', '0', '1514447560');
INSERT INTO `xp_crew` VALUES ('11', 'SB009', '123464', '0', '1514447560');
INSERT INTO `xp_crew` VALUES ('12', 'SB010', '123465', '0', '1514447560');
INSERT INTO `xp_crew` VALUES ('13', 'SB011', '123466', '0', '1514447560');
INSERT INTO `xp_crew` VALUES ('14', 'SB012', '123467', '0', '1514447560');
INSERT INTO `xp_crew` VALUES ('15', 'SB013', '123468', '0', '1514447560');
INSERT INTO `xp_crew` VALUES ('16', 'SB014', '123469', '0', '1514447560');
INSERT INTO `xp_crew` VALUES ('17', 'SB015', '123470', '0', '1514447560');
INSERT INTO `xp_crew` VALUES ('18', '12124215', '201705120000182', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('19', '12124216', '201705120000183', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('20', '12124217', '201705120000184', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('21', '12124218', '201705120000185', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('22', '12124219', '201705120000186', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('23', '12124220', '201705120000187', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('24', '12124221', '201705120000188', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('25', '12124222', '201705120000189', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('26', '12124223', '201705120000190', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('27', '12124224', '201705120000191', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('28', '12124225', '201705120000192', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('29', '12124226', '201705120000193', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('30', '12124227', '201705120000194', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('31', '12124228', '201705120000195', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('32', '12124229', '201705120000196', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('33', '12124230', '201705120000197', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('34', '12124231', '201705120000198', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('35', '12124232', '201705120000199', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('36', '12124233', '201705120000200', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('37', '12124234', '201705120000201', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('38', '12124235', '201705120000202', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('39', '12124236', '201705120000203', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('40', '12124237', '201705120000204', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('41', '12124238', '201705120000205', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('42', '12124239', '201705120000206', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('43', '12124240', '201705120000207', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('44', '12124241', '201705120000208', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('45', '12124242', '201705120000209', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('46', '12124243', '201705120000210', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('47', '12124244', '201705120000211', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('48', '12124245', '201705120000212', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('49', '12124246', '201705120000213', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('50', '12124247', '201705120000214', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('51', '12124248', '201705120000215', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('52', '12124249', '201705120000216', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('53', '12124250', '201705120000217', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('54', '12124251', '201705120000218', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('55', '12124252', '201705120000219', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('56', '12124253', '201705120000220', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('57', '12124254', '201705120000221', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('58', '12124255', '201705120000222', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('59', '12124256', '201705120000223', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('60', '12124257', '201705120000224', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('61', '12124258', '201705120000225', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('62', '12124259', '201705120000226', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('63', '12124260', '201705120000227', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('64', '12124261', '201705120000228', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('65', '12124262', '201705120000229', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('66', '12124263', '201705120000230', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('67', '12124264', '201705120000231', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('68', '12124265', '201705120000232', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('69', '12124266', '201705120000233', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('70', '12124267', '201705120000234', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('71', '12124268', '201705120000235', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('72', '12124269', '201705120000236', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('73', '12124270', '201705120000237', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('74', '12124271', '201705120000238', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('75', '12124272', '201705120000239', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('76', '12124273', '201705120000240', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('77', '12124274', '201705120000241', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('78', '12124275', '201705120000242', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('79', '12124276', '201705120000243', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('80', '12124277', '201705120000244', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('81', '12124278', '201705120000245', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('82', '12124279', '201705120000246', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('83', '12124280', '201705120000247', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('84', '12124281', '201705120000248', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('85', '12124282', '201705120000249', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('86', '12124283', '201705120000250', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('87', '12124284', '201705120000251', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('88', '12124285', '201705120000252', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('89', '12124286', '201705120000253', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('90', '12124287', '201705120000254', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('91', '12124288', '201705120000255', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('92', '12124289', '201705120000256', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('93', '12124290', '201705120000257', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('94', '12124291', '201705120000258', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('95', '12124292', '201705120000259', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('96', '12124293', '201705120000260', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('97', '12124294', '201705120000261', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('98', '12124295', '201705120000262', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('99', '12124296', '201705120000263', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('100', '12124297', '201705120000264', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('101', '12124298', '201705120000265', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('102', '12124299', '201705120000266', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('103', '12124300', '201705120000267', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('104', '12124301', '201705120000268', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('105', '12124302', '201705120000269', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('106', '12124303', '201705120000270', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('107', '12124304', '201705120000271', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('108', '12124305', '201705120000272', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('109', '12124306', '201705120000273', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('110', '12124307', '201705120000274', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('111', '12124308', '201705120000275', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('112', '12124309', '201705120000276', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('113', '12124310', '201705120000277', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('114', '12124311', '201705120000278', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('115', '12124312', '201705120000279', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('116', '12124313', '201705120000280', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('117', '12124314', '201705120000281', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('118', '12124315', '201705120000282', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('119', '12124316', '201705120000283', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('120', '12124317', '201705120000284', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('121', '12124318', '201705120000285', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('122', '12124319', '201705120000286', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('123', '12124320', '201705120000287', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('124', '12124321', '201705120000288', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('125', '12124322', '201705120000289', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('126', '12124323', '201705120000290', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('127', '12124324', '201705120000291', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('128', '12124325', '201705120000292', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('129', '12124326', '201705120000293', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('130', '12124327', '201705120000294', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('131', '12124328', '201705120000295', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('132', '12124329', '201705120000296', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('133', '12124330', '201705120000297', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('134', '12124331', '201705120000298', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('135', '12124332', '201705120000299', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('136', '12124333', '201705120000300', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('137', '12124334', '201705120000301', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('138', '12124335', '201705120000302', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('139', '12124336', '201705120000303', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('140', '12124337', '201705120000304', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('141', '12124338', '201705120000305', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('142', '12124339', '201705120000306', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('143', '12124340', '201705120000307', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('144', '12124341', '201705120000308', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('145', '12124342', '201705120000309', '0', '1514448441');
INSERT INTO `xp_crew` VALUES ('146', '1212454', 'AWASKS', '0', '1514451403');
INSERT INTO `xp_crew` VALUES ('147', '1212455', 'SDFSFS', '0', '1514451403');
INSERT INTO `xp_crew` VALUES ('148', '1212456', 'SFS*SDF', '0', '1514451403');
INSERT INTO `xp_crew` VALUES ('149', '1212457', 'ADS)*221', '0', '1514451403');
INSERT INTO `xp_crew` VALUES ('150', '1212458', 'DD00000', '0', '1514451403');
INSERT INTO `xp_crew` VALUES ('151', '1212459', '000)....', '0', '1514451403');

-- ----------------------------
-- Table structure for xp_devices
-- ----------------------------
DROP TABLE IF EXISTS `xp_devices`;
CREATE TABLE `xp_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '设备ID',
  `device_code` varchar(255) NOT NULL COMMENT '设备编码',
  `device_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '设备状态',
  `binding_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否绑定(0：未绑定 1：已绑定)',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '设备类型',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '激活时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_devices
-- ----------------------------
INSERT INTO `xp_devices` VALUES ('1', '121212121212121', '0', '0', '1', '1514450469', null);
INSERT INTO `xp_devices` VALUES ('2', '121212121212122', '0', '0', '1', '1514451180', null);
INSERT INTO `xp_devices` VALUES ('3', '012121012102120', '0', '0', '1', '1514535263', null);
INSERT INTO `xp_devices` VALUES ('4', '012132112121212', '0', '0', '1', '1514535280', null);

-- ----------------------------
-- Table structure for xp_devices_statu
-- ----------------------------
DROP TABLE IF EXISTS `xp_devices_statu`;
CREATE TABLE `xp_devices_statu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `DeviceID` varchar(20) NOT NULL COMMENT '设备码',
  `DeviceStause` tinyint(2) DEFAULT '11' COMMENT '设备状态 0:制水 1:冲洗 2:水满 3:缺水 4漏水 5:检修 6:欠费停机 7:关机 8:开机(仅命令)',
  `ReFlow` int(10) DEFAULT NULL COMMENT '剩余流量 租赁用',
  `Reday` int(10) DEFAULT NULL COMMENT '剩余天数 租赁用',
  `RawTDS` int(10) DEFAULT NULL COMMENT '纯水',
  `PureTDS` int(10) DEFAULT NULL COMMENT '原水',
  `Temperature` int(10) DEFAULT NULL COMMENT '温度',
  `ReFlowFilter1` int(10) DEFAULT NULL COMMENT '滤芯1剩余流量',
  `ReDayFilter1` int(10) DEFAULT NULL COMMENT '滤芯1剩余天数',
  `ReFlowFilter2` int(10) DEFAULT NULL COMMENT '滤芯2剩余流量',
  `ReDayFilter2` int(10) DEFAULT NULL COMMENT '滤芯2剩余天数',
  `ReFlowFilter3` int(10) DEFAULT NULL COMMENT '滤芯3剩余流量',
  `ReDayFilter3` int(10) DEFAULT NULL COMMENT '滤芯3剩余天数',
  `ReFlowFilter4` int(10) DEFAULT NULL COMMENT '滤芯4剩余流量',
  `ReDayFilter4` int(10) DEFAULT NULL COMMENT '滤芯4剩余天数',
  `ReFlowFilter5` int(10) DEFAULT NULL COMMENT '滤芯5剩余流量',
  `ReDayFilter5` int(10) DEFAULT NULL COMMENT '滤芯5剩余天数',
  `ReFlowFilter6` int(10) DEFAULT NULL COMMENT '滤芯6剩余流量',
  `ReDayFilter6` int(10) DEFAULT NULL COMMENT '滤芯6剩余天数',
  `ReFlowFilter7` int(10) DEFAULT NULL COMMENT '滤芯7剩余流量',
  `ReDayFilter7` int(10) DEFAULT NULL COMMENT '滤芯7剩余天数',
  `ReFlowFilter8` int(10) DEFAULT NULL COMMENT '滤芯8剩余流量',
  `ReDayFilter8` int(10) DEFAULT NULL COMMENT '滤芯8剩余天数',
  `LeasingMode` tinyint(1) DEFAULT NULL COMMENT '租赁模式  0:零售型 1:按流量计费 2:按时间计费 3:时长和流量套餐',
  `AliveStause` tinyint(1) DEFAULT NULL,
  `SumFlow` int(10) DEFAULT NULL COMMENT '累计流量',
  `SumDay` int(10) DEFAULT NULL COMMENT '累计天数',
  `FilterMode` tinyint(1) DEFAULT NULL COMMENT '滤芯模式',
  `Device` varchar(10) DEFAULT NULL,
  `ICCID` varchar(20) DEFAULT NULL,
  `CSQ` int(3) DEFAULT NULL,
  `Loaction` varchar(200) DEFAULT NULL,
  `addtime` varchar(11) DEFAULT NULL,
  `updatetime` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`DeviceID`,`DeviceStause`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_devices_statu
-- ----------------------------

-- ----------------------------
-- Table structure for xp_device_config
-- ----------------------------
DROP TABLE IF EXISTS `xp_device_config`;
CREATE TABLE `xp_device_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL COMMENT '设备ID',
  `dtid` int(11) NOT NULL COMMENT '设备类型ID',
  `vid` int(11) DEFAULT NULL COMMENT '经销商ID（备用）',
  `leasingmode` tinyint(1) DEFAULT NULL COMMENT '租赁模式(0：时间 1：流量)(备用)',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_device_config
-- ----------------------------

-- ----------------------------
-- Table structure for xp_device_type
-- ----------------------------
DROP TABLE IF EXISTS `xp_device_type`;
CREATE TABLE `xp_device_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(255) NOT NULL COMMENT '设备类型',
  `filter1` varchar(30) DEFAULT NULL COMMENT '一级滤芯',
  `filter2` varchar(30) DEFAULT NULL COMMENT '二级滤芯',
  `filter3` varchar(30) DEFAULT NULL COMMENT '三级滤芯',
  `filter4` varchar(30) DEFAULT NULL COMMENT '四级滤芯',
  `filter5` varchar(30) DEFAULT NULL COMMENT '五级滤芯',
  `filter6` varchar(30) DEFAULT NULL COMMENT '六级滤芯',
  `filter7` varchar(30) DEFAULT NULL COMMENT '七级滤芯',
  `filter8` varchar(30) DEFAULT NULL COMMENT '八级滤芯',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_device_type
-- ----------------------------
INSERT INTO `xp_device_type` VALUES ('1', 'awsd', '*&amp;&amp;&amp;    *-', '', '', '', '', '', '', '', '1514449681');

-- ----------------------------
-- Table structure for xp_filters
-- ----------------------------
DROP TABLE IF EXISTS `xp_filters`;
CREATE TABLE `xp_filters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filtername` varchar(30) NOT NULL COMMENT '滤芯名称',
  `alias` varchar(30) DEFAULT NULL COMMENT '滤芯别名',
  `timelife` int(11) NOT NULL COMMENT '时间寿命(小时)',
  `flowlife` int(11) NOT NULL COMMENT '流量寿命(升)',
  `balancetime` int(11) DEFAULT NULL COMMENT '时间寿命使能',
  `balanceflow` int(11) DEFAULT NULL COMMENT '流量寿命使能',
  `introduce` varchar(255) NOT NULL COMMENT '滤芯简介',
  `url` varchar(255) DEFAULT NULL COMMENT '购买网址',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_filters
-- ----------------------------
INSERT INTO `xp_filters` VALUES ('1', '*&amp;&amp;&amp;    *', '', '202', '202', null, null, '', '', '1514449389');
INSERT INTO `xp_filters` VALUES ('2', 'dess', '', '202', '2302', null, null, '', '', '1514449445');

-- ----------------------------
-- Table structure for xp_flow
-- ----------------------------
DROP TABLE IF EXISTS `xp_flow`;
CREATE TABLE `xp_flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '充值流水ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `ordernumber` varchar(32) NOT NULL COMMENT '商户订单号',
  `money` int(10) NOT NULL COMMENT '充值金额',
  `mode` tinyint(1) NOT NULL COMMENT '充值方式(0：系统赠送 1：微信 2：支付宝)',
  `time` int(11) NOT NULL COMMENT '充值时间',
  `currentbalance` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '当前余额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_flow
-- ----------------------------
INSERT INTO `xp_flow` VALUES ('1', '4', '1480327842201712281631161096', '1', '1', '1514449883', '1');
INSERT INTO `xp_flow` VALUES ('2', '4', '1480327842201712281504376806', '1', '1', '1514450331', '2');
INSERT INTO `xp_flow` VALUES ('3', '4', '1480327842201712281543294888', '1', '1', '1514450868', '3');
INSERT INTO `xp_flow` VALUES ('4', '4', '1480327842201712281550088411', '1', '1', '1514451264', '4');
INSERT INTO `xp_flow` VALUES ('5', '3', '1480327842201712281455363916', '1', '1', '1514451601', '1');
INSERT INTO `xp_flow` VALUES ('6', '4', '1480327842201712290844434770', '1', '1', '1514508290', '5');
INSERT INTO `xp_flow` VALUES ('7', '3', '1480327842201712291026431038', '1', '1', '1514514410', '2');

-- ----------------------------
-- Table structure for xp_leavel
-- ----------------------------
DROP TABLE IF EXISTS `xp_leavel`;
CREATE TABLE `xp_leavel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendors_id` int(11) NOT NULL COMMENT '经销商ID',
  `parent_vid` int(11) NOT NULL COMMENT '经销商父级ID',
  `path` varchar(255) NOT NULL COMMENT '经销商的层级关系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_leavel
-- ----------------------------

-- ----------------------------
-- Table structure for xp_loglist
-- ----------------------------
DROP TABLE IF EXISTS `xp_loglist`;
CREATE TABLE `xp_loglist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '登录用户ID',
  `content` varchar(255) NOT NULL COMMENT '操作内容',
  `time` int(11) NOT NULL COMMENT '操作时间',
  `ip` varchar(15) NOT NULL COMMENT '操作IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_loglist
-- ----------------------------

-- ----------------------------
-- Table structure for xp_users
-- ----------------------------
DROP TABLE IF EXISTS `xp_users`;
CREATE TABLE `xp_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `name` varchar(255) NOT NULL COMMENT '用户姓名',
  `phone` varchar(11) NOT NULL COMMENT '手机号码(登录账户)',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态(0：禁用1：启用)',
  `login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(15) DEFAULT NULL COMMENT '最后登录IP',
  `balance` int(10) NOT NULL DEFAULT '0' COMMENT '账户余额',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_users
-- ----------------------------
INSERT INTO `xp_users` VALUES ('1', '覃业宏', '18925295608', '668948cae77cf04d88f34c7dd009f127', '广东省,深圳市,龙岗区', '1', '1514544652', '14.116.137.168', '0', '1514277585');
INSERT INTO `xp_users` VALUES ('2', '谭涛', '18088887088', '95975a997faf0b88679842d4b291588d', '广东省,深圳市,龙岗区', '1', null, null, '0', '1514277604');
INSERT INTO `xp_users` VALUES ('3', 'qin', '13719273661', 'e10adc3949ba59abbe56e057f20f883e', '广东省,惠州市,惠阳区', '1', '1514536281', '14.116.133.169', '2', '1514514410');
INSERT INTO `xp_users` VALUES ('4', '吴智彬', '13425492760', '5dd5870283c637cad2b8a8f40d2cdf4f', '海南省,海口市,龙华区', '1', '1514527311', '183.3.227.102', '5', '1514508290');
INSERT INTO `xp_users` VALUES ('5', '$ A#这28', '13434173821', 'fd365265af2148be7f28b244b0b37176', '广东省,惠州市,惠东县', '1', '1514519673', '59.41.23.217', '0', '1514516510');

-- ----------------------------
-- Table structure for xp_vendors
-- ----------------------------
DROP TABLE IF EXISTS `xp_vendors`;
CREATE TABLE `xp_vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台用户ID',
  `name` varchar(255) NOT NULL COMMENT '经销商名字',
  `password` varchar(255) NOT NULL COMMENT '登录密码',
  `phone` varchar(11) NOT NULL COMMENT '联系电话',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `idcard` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `company` varchar(255) NOT NULL COMMENT '公司名称',
  `pid` int(11) DEFAULT NULL COMMENT '经销商上级ID',
  `leavel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '经销商级别(0：超级管理员 1：一级 2：二级)',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_vendors
-- ----------------------------
INSERT INTO `xp_vendors` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', '13800138000', '13800138000@139.com', '广州', null, ' 点球', null, '0', '1508989286');
INSERT INTO `xp_vendors` VALUES ('4', 'sdf', 'e10adc3949ba59abbe56e057f20f883e', '13236521254', '11@qq.com', '西藏 那曲地区 巴青县', '111111111111111111', 'zxc', null, '1', '1514449107');
INSERT INTO `xp_vendors` VALUES ('5', '*&amp;  *&amp;', 'e10adc3949ba59abbe56e057f20f883e', '13254623652', '**kksf@dll.com', '山东省 枣庄市 市中区', '111111122222223333', 'jdoajd', null, '1', '1514603845');
INSERT INTO `xp_vendors` VALUES ('6', '*(  *&amp;', 'e10adc3949ba59abbe56e057f20f883e', '13254621203', '878*@lkj.com', '湖北省 荆州市 郝穴镇', '111111222333213654', 'daed', null, '1', '1514604185');

-- ----------------------------
-- Table structure for xp_work
-- ----------------------------
DROP TABLE IF EXISTS `xp_work`;
CREATE TABLE `xp_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(30) NOT NULL COMMENT '工单编号(时间+机组id)',
  `name` varchar(50) NOT NULL COMMENT '处理人',
  `phone` varchar(11) NOT NULL COMMENT '处理人电话',
  `type` tinyint(1) NOT NULL COMMENT '工单类型(0：安装 1：维修 2：维护)',
  `content` text NOT NULL COMMENT '维护内容',
  `address` varchar(50) NOT NULL COMMENT '地址',
  `result` tinyint(1) NOT NULL COMMENT '处理结果(0：未处理 1：正在处理 2：已处理)',
  `time` varchar(30) NOT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_work
-- ----------------------------
INSERT INTO `xp_work` VALUES ('1', 'dfdd215', '元鱼', '13425165251', '0', 'zdz', '天津市 天津市 河西区', '2', '2017-12-28');
INSERT INTO `xp_work` VALUES ('2', '0212021', '元与昂', '13425164256', '0', 'osklflsf', '吉林省 辽源市 东丰镇', '0', '2017-12-29');
