/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : mysite

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-05-26 09:41:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admingroup`
-- ----------------------------
DROP TABLE IF EXISTS `admingroup`;
CREATE TABLE `admingroup` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '管理组名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admingroup
-- ----------------------------
INSERT INTO `admingroup` VALUES ('1', '超级管理员');
INSERT INTO `admingroup` VALUES ('2', '普通管理员');

-- ----------------------------
-- Table structure for `adminuser`
-- ----------------------------
DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE `adminuser` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理组id',
  `realname` varchar(20) NOT NULL COMMENT '管理员名',
  `username` varchar(50) NOT NULL COMMENT '登录账号',
  `password` char(32) NOT NULL COMMENT '登录密码',
  `salt` char(10) NOT NULL COMMENT '随机加密码',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of adminuser
-- ----------------------------
INSERT INTO `adminuser` VALUES ('1', '1', 'admin', 'admin', 'bb6ef8faba09f17c6668816493d02f6c', '024d7f84ff', '1432051920');
INSERT INTO `adminuser` VALUES ('16', '1', '刘备', 'liubei', '14aa678c21ff1d4969e4937d1411fc41', 'b2eeb7362e', '1432219398');
INSERT INTO `adminuser` VALUES ('17', '1', '关羽', 'guanyu', '6d8930bcc880b19a5e765fb6c2366749', '07a96b1f61', '1432219403');
INSERT INTO `adminuser` VALUES ('18', '1', '张飞', 'zhangfei', '56dd4898a10bfe6c3bae6a3d253ea374', '7634ea65a4', '1432219408');
INSERT INTO `adminuser` VALUES ('24', '1', '赵云', 'zhaoyun', '1ec2ab835e98203415a400f836de078d', '52720e0035', '1432268237');
INSERT INTO `adminuser` VALUES ('26', '1', '马超', 'machao', '060e5b589fb722c737c1ce716589d5a7', '42e77b6363', '1432268281');
INSERT INTO `adminuser` VALUES ('27', '1', '黄忠', 'huangzhong', 'd7cb8632b4784346dfce9a790c0a4a9e', '9b70e8fe62', '1432268288');
INSERT INTO `adminuser` VALUES ('28', '2', '路人甲', 'lurenjia', 'c0f6afdebf0f245556230182b222eec4', '5dd9db5e03', '1432270938');
INSERT INTO `adminuser` VALUES ('29', '2', '路人乙', 'lurenyi', '75f1dd4c576f3a90e9b6ae801df275ed', '1ecfb46347', '1432270955');
INSERT INTO `adminuser` VALUES ('30', '2', '路人丙', 'lurenbing', '264fd3cc0286919e82d129e0770a72d7', '903ce9225f', '1432270997');
INSERT INTO `adminuser` VALUES ('32', '2', '路人丁', 'lurending', '6684705d06110489513604f033fc3c61', '94c7bb58ef', '1432434392');
INSERT INTO `adminuser` VALUES ('33', '2', '路人戊', 'lurenwu', 'a89d949560d808d752d2ec218f1e908c', '539fd53b59', '1432434457');
INSERT INTO `adminuser` VALUES ('34', '2', '路人己', 'lurenji', '47c602477c3277311adcb4ff45770b95', '7eacb53257', '1432434476');
INSERT INTO `adminuser` VALUES ('35', '2', '路人庚', 'lurengeng', '1b64e6c3029c7f92a271b759ebfe9d3f', '8e82ab7243', '1432434509');
INSERT INTO `adminuser` VALUES ('36', '2', '路人辛', 'lurenxin', '83ce25a01c7965e232d2de5c50fada8c', '2723d092b6', '1432434565');
INSERT INTO `adminuser` VALUES ('37', '2', '路人壬', 'lurenren', '5ee6c8a710c2ebcc89aeee460cfbb139', '98b2979500', '1432434587');
INSERT INTO `adminuser` VALUES ('38', '2', '路人癸', 'lurengui', 'c084fc7104c7ec6ffa68fb20b78b3f26', '3416a75f4c', '1432434663');

-- ----------------------------
-- Table structure for `coupon`
-- ----------------------------
DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` smallint(5) unsigned NOT NULL COMMENT '类型id',
  `code` char(16) NOT NULL COMMENT '兑换码',
  `status` tinyint(3) unsigned NOT NULL COMMENT '状态（0：未兑换，1：已兑换）',
  `exptime` int(10) unsigned NOT NULL COMMENT '过期时间',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_code` (`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COMMENT='兑换券表';

-- ----------------------------
-- Records of coupon
-- ----------------------------
INSERT INTO `coupon` VALUES ('31', '1', '2370c88711118c23', '0', '1433109600', '1432307582');
INSERT INTO `coupon` VALUES ('32', '1', 'f0e37b68f1f92997', '0', '1433109600', '1432307582');
INSERT INTO `coupon` VALUES ('33', '1', '62a36994006b60fc', '0', '1433109600', '1432307582');
INSERT INTO `coupon` VALUES ('34', '1', '1106452d21c29215', '0', '1433109600', '1432307582');
INSERT INTO `coupon` VALUES ('35', '1', 'b4ad810d38fd1fe9', '0', '1433109600', '1432307582');
INSERT INTO `coupon` VALUES ('36', '1', '59ec681d9f11a133', '0', '1443650400', '1432307589');
INSERT INTO `coupon` VALUES ('37', '1', '9e1db0def8a41e5a', '0', '1443650400', '1432307589');
INSERT INTO `coupon` VALUES ('38', '1', '4aeb8513be30e0c6', '0', '1443650400', '1432307589');
INSERT INTO `coupon` VALUES ('39', '1', '793f9201569234d8', '0', '1443650400', '1432307589');
INSERT INTO `coupon` VALUES ('49', '1', '6c36560e0234d69c', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('50', '1', '99bc882ecdec8bd2', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('51', '1', '6cdc4c9570f47821', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('52', '1', '1b04e3801a2fd716', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('53', '1', '2da82d81b5870aa3', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('54', '1', 'f9aec0be3256b343', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('55', '1', '6f29a1e36107a5f6', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('56', '1', '307d3287afe11a08', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('57', '1', '867bdb3edb0c2898', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('58', '1', 'af64ce375afaed41', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('59', '1', 'e752a6a9e0e13dc8', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('60', '1', 'ed5fa64edbbf9c7e', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('61', '1', '83c18fdeb76cfc95', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('62', '1', '70b153044efe8eb5', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('63', '1', 'f39156b79fbd7e99', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('64', '1', '8d2a5b72aa0fcb89', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('65', '1', '32e12d37cc3709e0', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('66', '1', '9ff1ddbf9a2510e6', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('67', '1', 'ba2d1a9ccd5a7c20', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('68', '1', '56c33b683bf89bb4', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('69', '1', '6bafee75622619f1', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('70', '1', 'c7814f77f7306138', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('71', '1', '3eb909fbc748702e', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('72', '1', '9c606034071081c7', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('73', '1', '2760aae9046d3424', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('74', '1', 'f8e530e5481a7288', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('75', '1', '586e5eb38aa1d0ab', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('76', '1', '57b0a9e4e4dbb73e', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('77', '1', 'cce4ddc4d8a44c42', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('78', '1', '7d49062f00cbb702', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('79', '1', 'c5e1f61d6fb5f58f', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('80', '1', '3d6fe7db1b0a3a52', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('81', '1', '14a864d46a06db5e', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('82', '1', 'd191bb593afef79f', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('83', '1', '929ec1e2b7924855', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('84', '1', '715815f0f4516cc3', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('85', '1', '4a9e844ba570d86b', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('86', '1', '0692f83385538ccf', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('87', '1', '4b90d07f5cbf72fc', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('88', '1', '5661dccf44c7440d', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('89', '1', 'f712f4984ff59016', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('90', '1', '64702ef3be34d246', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('91', '1', 'b364700d206da8ad', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('92', '1', 'be1120a788ac487d', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('93', '1', '79f3de631f5cf7e1', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('94', '1', '5ac524fe1fcde897', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('95', '1', '3d943f1c510a4c5d', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('96', '1', '175d52e32d593380', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('97', '1', '38c343f535de32d1', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('98', '1', '5e686a7eb5b13f94', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('99', '1', '43e69b45f1ddcaa8', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('100', '1', 'bf1ee59fb95d88b8', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('101', '1', '8652cf8df17b3eec', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('102', '1', '479933f777eec919', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('103', '1', '7bdf1092cc3e342b', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('104', '1', 'a4b6e65493e9b48c', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('105', '1', 'bfe68000c26a6028', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('106', '1', '271b76162ee476a4', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('107', '1', '8613dba01624e5f6', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('108', '1', '5d85540f260b9077', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('109', '1', '4d804f903721130c', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('110', '1', 'f63653d9e5aec062', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('111', '1', 'f775700629d8dcca', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('112', '1', 'b38738fb03cd2da6', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('113', '1', '689e433e22f065f1', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('114', '1', 'a78196e390cb1707', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('115', '1', '169aaaaa469a55ab', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('116', '1', '946fab614e1ad793', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('117', '1', 'ff6c13b98f8bd863', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('118', '1', '36eb231213b96b6c', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('119', '1', '48c62ae3526fd558', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('120', '1', '35e45ce169ed022f', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('121', '1', '921b1bf024f52921', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('122', '1', 'eced41134dd9943c', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('123', '1', '895c7c1c11c44a92', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('124', '1', 'ec852fe90e434a08', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('125', '1', '35ce4fd3c356838f', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('126', '1', '6ea7a6c7a7059043', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('127', '1', '3419b9a0d28ad5f0', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('128', '1', '22f7f56f250e4d78', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('129', '1', '24265178b25c4690', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('130', '1', 'b6d3de327056a1d4', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('131', '1', '6149168379986120', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('132', '1', 'a5c08a25da3dbce5', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('133', '1', '8af373083a556707', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('134', '1', '280a9b4a779592c3', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('135', '1', 'a7de9ef8e0778c9a', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('136', '1', 'a38f3df77abcfadb', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('137', '1', '96adaceaf201666b', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('138', '1', '3f339ffa7402f787', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('139', '1', '1855bc2fa64ddd8e', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('140', '1', '73a9f5efe6c9f3ba', '0', '1433018304', '1432565125');
INSERT INTO `coupon` VALUES ('141', '1', '579ff5352338d414', '0', '1433018304', '1432565125');

-- ----------------------------
-- Table structure for `coupon_exchangeip`
-- ----------------------------
DROP TABLE IF EXISTS `coupon_exchangeip`;
CREATE TABLE `coupon_exchangeip` (
  `ip` varchar(15) NOT NULL COMMENT '兑换ip',
  `times` tinyint(3) unsigned NOT NULL COMMENT '兑换次数',
  `lasttime` int(10) unsigned NOT NULL COMMENT '最后兑奖时间',
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠券兑换限制表';

-- ----------------------------
-- Records of coupon_exchangeip
-- ----------------------------
INSERT INTO `coupon_exchangeip` VALUES ('127.0.0.1', '2', '1432432891');

-- ----------------------------
-- Table structure for `coupon_exchangelog`
-- ----------------------------
DROP TABLE IF EXISTS `coupon_exchangelog`;
CREATE TABLE `coupon_exchangelog` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `couponid` mediumint(8) unsigned NOT NULL COMMENT '优惠券id',
  `cellphone` varchar(15) NOT NULL COMMENT '手机号码',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='优惠券兑换表';

-- ----------------------------
-- Records of coupon_exchangelog
-- ----------------------------
INSERT INTO `coupon_exchangelog` VALUES ('1', '31', '13960902574', '1432432891');

-- ----------------------------
-- Table structure for `coupon_type`
-- ----------------------------
DROP TABLE IF EXISTS `coupon_type`;
CREATE TABLE `coupon_type` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of coupon_type
-- ----------------------------
INSERT INTO `coupon_type` VALUES ('1', '50M流量兑换券');
INSERT INTO `coupon_type` VALUES ('2', '100M流量兑换券');
