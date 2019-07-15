/*
Navicat MySQL Data Transfer

Source Server         : laragon
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : company

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-07-15 18:48:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for c_admin
-- ----------------------------
DROP TABLE IF EXISTS `c_admin`;
CREATE TABLE `c_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of c_admin
-- ----------------------------
INSERT INTO `c_admin` VALUES ('5', 'admin', 'c26be8aaf53b15054896983b43eb6a65');
INSERT INTO `c_admin` VALUES ('6', 'zzs', 'c56d0e9a7ccec67b4ea131655038d604');
INSERT INTO `c_admin` VALUES ('9', '张泽山', '281d65e3bb12d3e9593dcd1fdda9de2b');

-- ----------------------------
-- Table structure for c_article
-- ----------------------------
DROP TABLE IF EXISTS `c_article`;
CREATE TABLE `c_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL COMMENT '文章标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `author` varchar(30) NOT NULL COMMENT '发布人',
  `content` text NOT NULL COMMENT '内容',
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '点击数',
  `favor` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `cateid` int(11) NOT NULL DEFAULT '0' COMMENT '栏目id',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of c_article
-- ----------------------------

-- ----------------------------
-- Table structure for c_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `c_auth_group`;
CREATE TABLE `c_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：为1正常，为0禁用',
  `rules` char(80) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of c_auth_group
-- ----------------------------
INSERT INTO `c_auth_group` VALUES ('7', '文章发布专员', '1', '2,3,10,20,4');
INSERT INTO `c_auth_group` VALUES ('6', '超级管理员', '1', '15,16,19,1,11,12,13,14,9,2,3,10,20,4');

-- ----------------------------
-- Table structure for c_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `c_auth_group_access`;
CREATE TABLE `c_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT 'uid',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- ----------------------------
-- Records of c_auth_group_access
-- ----------------------------
INSERT INTO `c_auth_group_access` VALUES ('5', '7');
INSERT INTO `c_auth_group_access` VALUES ('6', '7');
INSERT INTO `c_auth_group_access` VALUES ('9', '7');

-- ----------------------------
-- Table structure for c_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `c_auth_rule`;
CREATE TABLE `c_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识（英文）',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `pid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '父级id',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '等级',
  `sort` int(5) NOT NULL DEFAULT '10' COMMENT '排序值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of c_auth_rule
-- ----------------------------
INSERT INTO `c_auth_rule` VALUES ('11', 'conf/lst', '配置列表', '1', '1', '', '1', '1', '50');
INSERT INTO `c_auth_rule` VALUES ('2', 'link', '友情链接', '1', '1', '', '0', '0', '4');
INSERT INTO `c_auth_rule` VALUES ('4', 'link/del', '删除链接', '1', '1', '', '3', '2', '6');
INSERT INTO `c_auth_rule` VALUES ('1', 'sys', '系统设置', '1', '1', '', '0', '0', '7');
INSERT INTO `c_auth_rule` VALUES ('3', 'link/lst', '链接列表', '1', '1', '', '2', '1', '5');
INSERT INTO `c_auth_rule` VALUES ('10', 'link/add', '添加链接', '1', '1', '', '3', '2', '50');
INSERT INTO `c_auth_rule` VALUES ('9', 'conf/conf', '配置项', '1', '1', '', '1', '1', '50');
INSERT INTO `c_auth_rule` VALUES ('12', 'conf/add', '添加配置', '1', '1', '', '11', '2', '50');
INSERT INTO `c_auth_rule` VALUES ('13', 'conf/del', '配置删除', '1', '1', '', '11', '2', '50');
INSERT INTO `c_auth_rule` VALUES ('14', 'conf/edit', '配置编辑', '1', '1', '', '11', '2', '50');
INSERT INTO `c_auth_rule` VALUES ('15', 'admin', '管理员', '1', '1', '', '0', '0', '50');
INSERT INTO `c_auth_rule` VALUES ('16', 'admin/lst', '管理员列表', '1', '1', '', '15', '1', '50');
INSERT INTO `c_auth_rule` VALUES ('17', 'admin/add', '管理员添加', '1', '1', '', '16', '2', '50');
INSERT INTO `c_auth_rule` VALUES ('18', 'admin/del', '管理员删除', '1', '1', '', '16', '2', '50');
INSERT INTO `c_auth_rule` VALUES ('19', 'admin/edit', '管理员修改', '1', '1', '', '16', '2', '50');
INSERT INTO `c_auth_rule` VALUES ('20', 'link/edit', '修改链接', '1', '1', '', '3', '2', '50');

-- ----------------------------
-- Table structure for c_cate
-- ----------------------------
DROP TABLE IF EXISTS `c_cate`;
CREATE TABLE `c_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catename` varchar(30) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '栏目类型1列表栏目2单页栏目',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '栏目父级id',
  `sort` int(11) DEFAULT '50' COMMENT '排序值',
  `keywords` varchar(255) DEFAULT NULL COMMENT '栏目关键词',
  `desc` varchar(255) DEFAULT NULL COMMENT '栏目描述',
  `content` text COMMENT '栏目内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of c_cate
-- ----------------------------
INSERT INTO `c_cate` VALUES ('1', '2131231', '1', '0', '50', 'Zzscms资讯 体育 新闻 科技', '123213', '<p>31231231</p>');

-- ----------------------------
-- Table structure for c_conf
-- ----------------------------
DROP TABLE IF EXISTS `c_conf`;
CREATE TABLE `c_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cnname` varchar(50) NOT NULL COMMENT '配置中文名',
  `enname` varchar(50) NOT NULL COMMENT '配置英文名',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '配置类型 1单行文本框 2文本域 3单选按钮 4复选按钮 5下拉菜单',
  `sort` tinyint(1) NOT NULL DEFAULT '10' COMMENT '排序值',
  `value` text NOT NULL COMMENT '配置值',
  `values` varchar(255) NOT NULL DEFAULT '' COMMENT '配置可选值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- ----------------------------
-- Records of c_conf
-- ----------------------------
INSERT INTO `c_conf` VALUES ('1', '站点名称', 'sitename', '1', '53', '自行车站点', '');
INSERT INTO `c_conf` VALUES ('2', '站点关键词', 'keywords', '1', '52', '自行车', '');
INSERT INTO `c_conf` VALUES ('3', '站点描述', 'desc', '2', '51', '                                                                                                                                                                                                                                                                                                                                                                                                            12312313                                                                                                                                                                                           ', '');
INSERT INTO `c_conf` VALUES ('6', '是否关闭网站', 'close', '3', '50', '是', '是,否');
INSERT INTO `c_conf` VALUES ('7', '启动验证码', 'code', '4', '50', '是', '是');
INSERT INTO `c_conf` VALUES ('8', '自动清空缓存', 'cache', '5', '50', '3个小时', '1个小时,2个小时,3个小时');
INSERT INTO `c_conf` VALUES ('9', '允许评论', 'comment', '4', '50', '', '允许');

-- ----------------------------
-- Table structure for c_link
-- ----------------------------
DROP TABLE IF EXISTS `c_link`;
CREATE TABLE `c_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL COMMENT '链接名称',
  `description` varchar(30) NOT NULL COMMENT '链接描述',
  `url` varchar(255) NOT NULL COMMENT '链接地址',
  `sort` tinyint(1) NOT NULL DEFAULT '50' COMMENT '排序值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='链接表';

-- ----------------------------
-- Records of c_link
-- ----------------------------
INSERT INTO `c_link` VALUES ('1', '交易细则2', '1231231231', '3123123123', '1');
