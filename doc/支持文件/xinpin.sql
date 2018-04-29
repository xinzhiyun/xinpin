/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : xinpin

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-04-29 12:04:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xp_binding
-- ----------------------------
DROP TABLE IF EXISTS `xp_binding`;
CREATE TABLE `xp_binding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL COMMENT '经销商ID',
  `did` int(11) NOT NULL COMMENT '设备ID',
  `addtime` int(11) NOT NULL COMMENT '绑定时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_binding
-- ----------------------------
INSERT INTO `xp_binding` VALUES ('46', '1', '79', '1524973683');
INSERT INTO `xp_binding` VALUES ('47', '50', '73', '1524973761');

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
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_card
-- ----------------------------
INSERT INTO `xp_card` VALUES ('66', '1811223636411456', '小琴', '85558', '广州学校', '17', '0', '1', '1515584435');
INSERT INTO `xp_card` VALUES ('67', 'UF0101701DY00003', null, null, null, null, '0', '0', '1515591002');
INSERT INTO `xp_card` VALUES ('83', '1811223636411458', null, null, null, null, '0', '0', '1524880896');
INSERT INTO `xp_card` VALUES ('68', '18112236364114563215', '夏姨', '85258', '广州学校', '17', '0', '1', '1515652637');
INSERT INTO `xp_card` VALUES ('69', 'XP01010100000001', '好好', '1254566525', '广州体育馆', '26', '0', '1', '1516020569');
INSERT INTO `xp_card` VALUES ('70', 'XP01010100000002', '看看', '123456', '魔的时候的', '27', '0', '1', '1516020569');
INSERT INTO `xp_card` VALUES ('71', 'XP01010100000003', '潘宏钢', '20180428', '清华大学', '20', '0', '1', '1516020569');
INSERT INTO `xp_card` VALUES ('72', 'XP01010100000004', null, null, null, null, '0', '0', '1516020569');
INSERT INTO `xp_card` VALUES ('73', 'XP01010100000005', null, null, null, null, '0', '0', '1516020569');
INSERT INTO `xp_card` VALUES ('74', 'XP01010100000006', null, null, null, null, '0', '0', '1516020569');
INSERT INTO `xp_card` VALUES ('75', 'XP01010100000007', null, null, null, null, '0', '0', '1516020569');
INSERT INTO `xp_card` VALUES ('76', 'XP01010100000008', '朱美丽', '123456666', '番禺中学', '24', '0', '1', '1516020569');
INSERT INTO `xp_card` VALUES ('77', 'XP01010100000009', '覃新民', '123456789', '石门二中', '22', '0', '1', '1516020569');
INSERT INTO `xp_card` VALUES ('78', 'XP01010100000010', null, null, null, null, '0', '0', '1516020569');
INSERT INTO `xp_card` VALUES ('79', '012541254215', '小叶', '8528025', '广州学校', '25', '0', '1', '1516605377');
INSERT INTO `xp_card` VALUES ('80', '11223344556677889900', '小米', '85236', '海洋大学', '25', '0', '1', '1516256273');
INSERT INTO `xp_card` VALUES ('81', '181122363641145532195', '夏琳', '85238', '海洋奇缘学校', '25', '0', '1', '1516256694');
INSERT INTO `xp_card` VALUES ('82', '181122363641145532192', null, null, null, null, '0', '0', '1524814761');
INSERT INTO `xp_card` VALUES ('84', '1811223636411459', '测试', '8585595', '测试学校', '30', '0', '1', '1524880896');
INSERT INTO `xp_card` VALUES ('85', '1811223636411457', null, null, null, null, '0', '0', '1524880947');
INSERT INTO `xp_card` VALUES ('86', '1811223636411451', null, null, null, null, '0', '0', '1524881014');
INSERT INTO `xp_card` VALUES ('87', '1811223636411452', null, null, null, null, '0', '0', '1524881014');

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
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_consume
-- ----------------------------
INSERT INTO `xp_consume` VALUES ('44', '72', null, '66', '16', null, '1515584514');
INSERT INTO `xp_consume` VALUES ('45', '72', null, '67', '1000', null, '1515591257');
INSERT INTO `xp_consume` VALUES ('46', '72', null, '67', '1000', null, '1515591260');
INSERT INTO `xp_consume` VALUES ('47', '72', null, '67', '1000', null, '1515591279');
INSERT INTO `xp_consume` VALUES ('48', '72', null, '67', '1000', null, '1515591285');
INSERT INTO `xp_consume` VALUES ('49', '72', null, '67', '1000', null, '1515591313');
INSERT INTO `xp_consume` VALUES ('50', '72', null, '67', '1000', null, '1515591316');
INSERT INTO `xp_consume` VALUES ('51', '72', null, '66', '16', null, '1515632894');
INSERT INTO `xp_consume` VALUES ('52', '72', null, '66', '16', null, '1515632963');
INSERT INTO `xp_consume` VALUES ('53', '72', null, '66', '16', null, '1515632989');
INSERT INTO `xp_consume` VALUES ('54', '72', null, '66', '16', null, '1515633044');
INSERT INTO `xp_consume` VALUES ('55', '72', null, '67', '1000', null, '1515647116');
INSERT INTO `xp_consume` VALUES ('56', '72', null, '67', '1000', null, '1515647118');
INSERT INTO `xp_consume` VALUES ('57', '72', null, '67', '1000', null, '1515647121');
INSERT INTO `xp_consume` VALUES ('58', '72', null, '66', '16', null, '1515647135');
INSERT INTO `xp_consume` VALUES ('59', '72', null, '67', '1000', null, '1515647292');
INSERT INTO `xp_consume` VALUES ('60', '72', null, '67', '1000', null, '1515647301');
INSERT INTO `xp_consume` VALUES ('61', '72', null, '67', '1000', null, '1515647302');
INSERT INTO `xp_consume` VALUES ('62', '72', null, '67', '1000', null, '1515647316');
INSERT INTO `xp_consume` VALUES ('63', '72', null, '67', '1000', null, '1515647325');
INSERT INTO `xp_consume` VALUES ('64', '72', null, '66', '32', null, '1515653088');
INSERT INTO `xp_consume` VALUES ('65', '72', null, '66', '32', null, '1515653552');
INSERT INTO `xp_consume` VALUES ('66', '72', null, '66', '32', null, '1515654569');
INSERT INTO `xp_consume` VALUES ('67', '72', null, '66', '16', null, '1516262771');
INSERT INTO `xp_consume` VALUES ('68', '72', null, '66', '16', null, '1516262806');
INSERT INTO `xp_consume` VALUES ('69', '72', null, '66', '16', null, '1516263178');
INSERT INTO `xp_consume` VALUES ('70', '72', null, '66', '16', null, '1516263614');
INSERT INTO `xp_consume` VALUES ('71', '72', null, '66', '16', null, '1516264353');
INSERT INTO `xp_consume` VALUES ('72', '72', null, '66', '16', null, '1516329034');
INSERT INTO `xp_consume` VALUES ('73', '72', null, '66', '16', null, '1516329059');
INSERT INTO `xp_consume` VALUES ('74', '70', null, '66', '16', null, '1516331200');
INSERT INTO `xp_consume` VALUES ('75', '70', null, '66', '16', null, '1516331291');
INSERT INTO `xp_consume` VALUES ('76', '70', null, '66', '16', null, '1516331429');
INSERT INTO `xp_consume` VALUES ('77', '70', null, '66', '16', null, '1516331623');
INSERT INTO `xp_consume` VALUES ('78', '70', null, '66', '16', null, '1516332042');
INSERT INTO `xp_consume` VALUES ('79', '70', null, '66', '16', null, '1516332255');
INSERT INTO `xp_consume` VALUES ('80', '70', null, '66', '16', null, '1516332634');
INSERT INTO `xp_consume` VALUES ('81', '70', null, '66', '16', null, '1516332688');
INSERT INTO `xp_consume` VALUES ('82', '70', null, '66', '16', null, '1516332770');
INSERT INTO `xp_consume` VALUES ('83', '70', null, '66', '16', null, '1516332886');
INSERT INTO `xp_consume` VALUES ('84', '70', null, '66', '16', null, '1516333556');

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
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_crew
-- ----------------------------
INSERT INTO `xp_crew` VALUES ('43', 'zo012', '112233445566778', '1', '1515583551');
INSERT INTO `xp_crew` VALUES ('44', 'XP180110000001', '352425023679981', '1', '1515591222');
INSERT INTO `xp_crew` VALUES ('45', 'xp002', '112633445566778', '1', '1515653075');
INSERT INTO `xp_crew` VALUES ('46', 'xp2000', '888888888888888', '1', '1515999662');
INSERT INTO `xp_crew` VALUES ('47', '007', '369852147963258', '1', '1516253600');
INSERT INTO `xp_crew` VALUES ('48', 'k012', '525525252525252', '1', '1516255435');
INSERT INTO `xp_crew` VALUES ('49', 'xp007', '112733445596778', '0', '1516255997');
INSERT INTO `xp_crew` VALUES ('50', 'ce001', '666663333333333', '1', '1524814370');
INSERT INTO `xp_crew` VALUES ('51', '测试1', '998877445566332', '1', '1524879821');

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
  `address` varchar(255) NOT NULL COMMENT '设备安装地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_devices
-- ----------------------------
INSERT INTO `xp_devices` VALUES ('70', '112233445566778', '1', '0', '11', '1515583538', '1515583785', '北京清华大学1号教学楼');
INSERT INTO `xp_devices` VALUES ('71', '352425023679981', '0', '0', '11', '1515591186', null, '北京清华大学2号教学楼');
INSERT INTO `xp_devices` VALUES ('72', '112633445566778', '0', '0', '11', '1515653060', null, '北京清华大学3号教学楼');
INSERT INTO `xp_devices` VALUES ('73', '888888888888888', '0', '1', '12', '1515999640', null, '北京清华大学4号教学楼');
INSERT INTO `xp_devices` VALUES ('74', '525525252525252', '0', '0', '12', '1515999799', null, '北京清华大学5号教学楼');
INSERT INTO `xp_devices` VALUES ('75', '369852147963258', '0', '0', '13', '1516253581', null, '北京清华大学6号教学楼');
INSERT INTO `xp_devices` VALUES ('76', '112733445596778', '0', '0', '13', '1516255964', null, '北京清华大学7号教学楼');
INSERT INTO `xp_devices` VALUES ('77', '666663333333333', '1', '0', '11', '1524814345', '1524878748', '北京清华大学8号教学楼');
INSERT INTO `xp_devices` VALUES ('78', '998877445566332', '0', '0', '15', '1524879793', null, '北京清华大学9号教学楼');
INSERT INTO `xp_devices` VALUES ('79', '112633445566779', '0', '1', '13', '1524970149', null, '上海复旦大学1号教学楼');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_devices_statu
-- ----------------------------
INSERT INTO `xp_devices_statu` VALUES ('7', '112233445566778', '11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null, 'GPRS', '11223344556677889900', '90', '10020\0\0\0\0\0', '1515583785', '1522205975');
INSERT INTO `xp_devices_statu` VALUES ('8', '352425023679981', '2', '30', '-1', '0', '0', '-1', '10000', '269', '10000', '539', '10000', '269', '20000', '269', '10000', '269', null, null, null, null, null, null, '1', '0', '0', '0', null, 'GPRS', '898602b8191750155005', '31', '25cb,708d\0', '1515590424', '1515647008');
INSERT INTO `xp_devices_statu` VALUES ('9', '112633445566778', '11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null, 'GPRS', '11223344556677889900', '90', '10020\0\0\0\0\0', '1515652917', '1515654566');
INSERT INTO `xp_devices_statu` VALUES ('10', '112733445596778', '11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null, 'GPRS', '11223344556677889900', '90', '10020\0\0\0\0\0', '1515668016', '1516257155');
INSERT INTO `xp_devices_statu` VALUES ('11', '352425025336838', '1', '-1', '-1', '0', '0', '-1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, null, null, null, null, null, '0', '0', '0', '32166', null, 'GPRS', '898602b8191750155005', '30', '\0\0\0\0,\0\0\0\0\0', '1515758092', '1515759877');
INSERT INTO `xp_devices_statu` VALUES ('12', '352425025291330', '11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', null, null, null, 'GPRS', '898602b8191750155005', '10', '25cb,708d\0', '1515935076', '1516630698');
INSERT INTO `xp_devices_statu` VALUES ('13', '112233445566', '11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null, 'WIFI', null, '90', null, '1522207958', '1522210506');
INSERT INTO `xp_devices_statu` VALUES ('14', '888888888888888', '3', '2000', '85', '90', '50', '32', '100', '-1', '100', '-1', '100', '-1', '100', '-1', '100', '-1', null, null, null, null, null, null, '3', '1', '0', '0', null, 'GPRS', '11223344556677889900', '90', '10020\0\0\0\0\0', '1524818893', '1524822703');
INSERT INTO `xp_devices_statu` VALUES ('15', '666663333333333', '11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null, 'GPRS', '11223344556677889900', '90', '10020\0\0\0\0\0', '1524878748', '1524882896');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_device_type
-- ----------------------------
INSERT INTO `xp_device_type` VALUES ('11', 'RO膜', 'RO膜-RO膜A型', 'PDF-PDF', '', '', '', '', '', '', '1515583523');
INSERT INTO `xp_device_type` VALUES ('12', '净水器', '滤芯-', 'RO膜-RO膜A型', 'RO膜-RO膜A型', '', '', '', '', '', '1515999600');
INSERT INTO `xp_device_type` VALUES ('13', '过滤', 'PDF-PDF', '滤芯-', 'RO膜-RO膜A型', '', '', '', '', '', '1516253545');
INSERT INTO `xp_device_type` VALUES ('14', '测试', 'RO膜-RO膜A型', 'RO膜-A型', 'pdf-', '', '', '', '', '', '1524815064');
INSERT INTO `xp_device_type` VALUES ('15', '测试1', '测试-测试型号', '', '', '', '', '', '', '', '1524879751');

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_filters
-- ----------------------------
INSERT INTO `xp_filters` VALUES ('12', 'RO膜', 'RO膜A型', '20', '20', null, null, '20小时20升', '', '1519953644');
INSERT INTO `xp_filters` VALUES ('13', '滤芯', '', '120', '200', null, null, '120小时200升', '', '1516605156');
INSERT INTO `xp_filters` VALUES ('14', 'PDF', 'PDF', '240', '150', null, null, '240小时150升', 'http://www.taobao.com', '1516253496');
INSERT INTO `xp_filters` VALUES ('15', 'pdf', '', '20', '20', null, null, '20小时20升', '', '1516258052');
INSERT INTO `xp_filters` VALUES ('16', 'RO膜', 'A型', '360', '5000', null, null, 'sdfsessdfsrefc', '', '1524815027');
INSERT INTO `xp_filters` VALUES ('17', '测试', '测试型号', '360', '500', null, null, 'sdfgdsfvsdashfujsjowjfslsajdfoasjflaopsfjsljfpoasjgjlkaspdofjfsafds', '', '1524879383');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_flow
-- ----------------------------
INSERT INTO `xp_flow` VALUES ('12', '17', '1480327842201801101941164246', '1', '1', '1515584483', '1');
INSERT INTO `xp_flow` VALUES ('13', '25', '1480327842201801181343256222', '1', '1', '1516254212', '1');
INSERT INTO `xp_flow` VALUES ('14', '17', '1480327842201801191129132496', '1', '1', '1516332560', '2');
INSERT INTO `xp_flow` VALUES ('15', '22', '1480327842201803171540549459', '1', '1', '1521272465', '1');
INSERT INTO `xp_flow` VALUES ('16', '30', '1480327842201804271548421407', '1', '1', '1524815328', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_users
-- ----------------------------
INSERT INTO `xp_users` VALUES ('17', '小琴', '18102543197', 'e10adc3949ba59abbe56e057f20f883e', '广东省,深圳市,南山区', '1', '1524878934', '113.96.219.247', '2', '1516332560');
INSERT INTO `xp_users` VALUES ('18', '吴智彬', '13425492760', '5dd5870283c637cad2b8a8f40d2cdf4f', '广东省,韶关市,始兴县', '1', null, null, '0', '1515585913');
INSERT INTO `xp_users` VALUES ('19', '彭龙召', '18002229021', 'e10adc3949ba59abbe56e057f20f883e', '广东省,深圳市,南山区', '1', '1524818897', '113.111.180.51', '0', '1515590925');
INSERT INTO `xp_users` VALUES ('20', '潘宏钢', '15920569139', '202cb962ac59075b964b07152d234b70', '广东省,深圳市,南山区', '1', '1524902532', '0.0.0.0', '0', '1515632277');
INSERT INTO `xp_users` VALUES ('21', '瓦斯', '18475039192', '6186475188882e567c19c340ab822b71', '广东省,深圳市,南山区', '1', '1520382137', '113.96.218.50', '0', '1515633108');
INSERT INTO `xp_users` VALUES ('22', '覃业宏', '18925295608', '668948cae77cf04d88f34c7dd009f127', '广东省,深圳市,龙岗区', '1', '1523192209', '183.3.226.234', '1', '1521272465');
INSERT INTO `xp_users` VALUES ('23', '覃业宏', '18925295608', '668948cae77cf04d88f34c7dd009f127', '广东省,深圳市,龙岗区', '1', null, null, '0', '1515677063');
INSERT INTO `xp_users` VALUES ('24', '杰杰', '18931376552', 'd0970714757783e6cf17b26fb8e2298f', '广东省,广州市,番禺区', '1', '1516674055', '123.151.76.248', '0', '1516195215');
INSERT INTO `xp_users` VALUES ('25', '小叶', '13708529632', 'e10adc3949ba59abbe56e057f20f883e', '广东省,茂名市,高州市', '1', '1520243757', '113.96.218.50', '1', '1516254212');
INSERT INTO `xp_users` VALUES ('26', '好好', '13434173821', 'e10adc3949ba59abbe56e057f20f883e', '广东省,广州市,番禺区', '1', null, null, '0', '1519972786');
INSERT INTO `xp_users` VALUES ('27', '513778392', '13027929642', 'c2556d49042d04d237f343109905b553', '广东省,深圳市,南山区', '1', null, null, '0', '1520619079');
INSERT INTO `xp_users` VALUES ('28', '郑红兵', '15399981211', '7cd85b90eaeb804fe6906296b9193b41', '湖南省,长沙市,雨花区', '1', null, null, '0', '1521874790');
INSERT INTO `xp_users` VALUES ('29', '飞哥', '18200908508', 'e10adc3949ba59abbe56e057f20f883e', '广东省,深圳市,南山区', '1', null, null, '0', '1522226219');
INSERT INTO `xp_users` VALUES ('30', '测试', '13610113352', '4297f44b13955235245b2497399d7a93', '广东省,广州市,番禺区', '1', '1524880587', '113.96.219.247', '1', '1524815328');

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
  `detailed` varchar(255) NOT NULL DEFAULT '钟村创源路' COMMENT '详细地址',
  `idcard` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `company` varchar(255) NOT NULL COMMENT '公司名称',
  `pid` int(11) DEFAULT NULL COMMENT '经销商上级ID',
  `leavel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '经销商级别(0：超级管理员 1：一级 2：二级)',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_vendors
-- ----------------------------
INSERT INTO `xp_vendors` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', '13800138000', '13800138000@139.com', '黑龙江省 鸡西市 鸡东县', '钟村创源路', '420321198506084225', ' 点球', null, '0', '1516255082');
INSERT INTO `xp_vendors` VALUES ('39', '阳光', 'e10adc3949ba59abbe56e057f20f883e', '13526532659', '114@334qq.com', '天津市 天津市 河西区', '钟村创源路', '441985198902081258', '太阳能有限公司', null, '1', '1515999276');
INSERT INTO `xp_vendors` VALUES ('47', '欣欣', 'e10adc3949ba59abbe56e057f20f883e', '13589563210', '258962@163.com', '河南省 周口市 沈丘县', '钟村创源路', '412512199806090236', '有限公司', null, '1', '1516605058');
INSERT INTO `xp_vendors` VALUES ('49', '测试', 'e10adc3949ba59abbe56e057f20f883e', '15902021320', '25221155@qq.com', '天津市 天津市 河西区', '钟村创源路', '42150119890205123x', '测试公司', null, '1', '1524879321');
INSERT INTO `xp_vendors` VALUES ('50', '盼盼', '202cb962ac59075b964b07152d234b70', '13838381438', '619328391@qq.com', '天津市 天津市 和平区', '天津市的详细地址', '430122199010224517', '盼盼公司', null, '1', '1524970882');

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
  `detailed` text NOT NULL COMMENT '详细地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xp_work
-- ----------------------------
INSERT INTO `xp_work` VALUES ('29', '0120120', '钟小姐', '13524216254', '1', '维修', '湖北省 襄樊市 樊城区', '0', '2018-01-15', '11');
INSERT INTO `xp_work` VALUES ('30', 'ceshi001', '张师傅', '13602023203', '0', '广州学校安装', '内蒙古 通辽市 开鲁镇', '0', '2018-04-28', '11');
INSERT INTO `xp_work` VALUES ('31', '1', '测试', '13838381438', '0', 'QQ', '天津市 天津市 河东区', '0', '2018-04-30', '我是详细地址');
