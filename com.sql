-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL 版本:                  9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for company
CREATE DATABASE IF NOT EXISTS `company` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `company`;

-- Dumping structure for table company.c_admin
CREATE TABLE IF NOT EXISTS `c_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- Dumping data for table company.c_admin: ~2 rows (approximately)
DELETE FROM `c_admin`;
/*!40000 ALTER TABLE `c_admin` DISABLE KEYS */;
INSERT INTO `c_admin` (`id`, `name`, `password`) VALUES
	(5, '3123', 'e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `c_admin` ENABLE KEYS */;

-- Dumping structure for table company.c_article
CREATE TABLE IF NOT EXISTS `c_article` (
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

-- Dumping data for table company.c_article: ~1 rows (approximately)
DELETE FROM `c_article`;
/*!40000 ALTER TABLE `c_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_article` ENABLE KEYS */;

-- Dumping structure for table company.c_auth_group
CREATE TABLE IF NOT EXISTS `c_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：为1正常，为0禁用',
  `rules` char(80) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- Dumping data for table company.c_auth_group: 4 rows
DELETE FROM `c_auth_group`;
/*!40000 ALTER TABLE `c_auth_group` DISABLE KEYS */;
INSERT INTO `c_auth_group` (`id`, `title`, `status`, `rules`) VALUES
	(2, '开户流程', 1, ''),
	(3, '社会信用体系建设数据采集标准', 0, ''),
	(4, '风险披露', 0, ''),
	(5, 'gggggggggggg', 1, '');
/*!40000 ALTER TABLE `c_auth_group` ENABLE KEYS */;

-- Dumping structure for table company.c_auth_group_access
CREATE TABLE IF NOT EXISTS `c_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT 'uid',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- Dumping data for table company.c_auth_group_access: 0 rows
DELETE FROM `c_auth_group_access`;
/*!40000 ALTER TABLE `c_auth_group_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_auth_group_access` ENABLE KEYS */;

-- Dumping structure for table company.c_auth_rule
CREATE TABLE IF NOT EXISTS `c_auth_rule` (
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- Dumping data for table company.c_auth_rule: 3 rows
DELETE FROM `c_auth_rule`;
/*!40000 ALTER TABLE `c_auth_rule` DISABLE KEYS */;
INSERT INTO `c_auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`, `pid`, `level`, `sort`) VALUES
	(6, '1111', '顶级哦', 1, 1, '', 0, 0, 10);
/*!40000 ALTER TABLE `c_auth_rule` ENABLE KEYS */;

-- Dumping structure for table company.c_cate
CREATE TABLE IF NOT EXISTS `c_cate` (
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

-- Dumping data for table company.c_cate: ~1 rows (approximately)
DELETE FROM `c_cate`;
/*!40000 ALTER TABLE `c_cate` DISABLE KEYS */;
INSERT INTO `c_cate` (`id`, `catename`, `type`, `pid`, `sort`, `keywords`, `desc`, `content`) VALUES
	(1, '2131231', 1, 0, 50, 'Zzscms资讯 体育 新闻 科技', '123213', '<p>31231231</p>');
/*!40000 ALTER TABLE `c_cate` ENABLE KEYS */;

-- Dumping structure for table company.c_conf
CREATE TABLE IF NOT EXISTS `c_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cnname` varchar(50) NOT NULL COMMENT '配置中文名',
  `enname` varchar(50) NOT NULL COMMENT '配置英文名',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '配置类型 1单行文本框 2文本域 3单选按钮 4复选按钮 5下拉菜单',
  `sort` tinyint(1) NOT NULL DEFAULT '10' COMMENT '排序值',
  `value` text NOT NULL COMMENT '配置值',
  `values` varchar(255) NOT NULL DEFAULT '' COMMENT '配置可选值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- Dumping data for table company.c_conf: ~7 rows (approximately)
DELETE FROM `c_conf`;
/*!40000 ALTER TABLE `c_conf` DISABLE KEYS */;
INSERT INTO `c_conf` (`id`, `cnname`, `enname`, `type`, `sort`, `value`, `values`) VALUES
	(1, '站点名称', 'sitename', 1, 53, '自行车站点', ''),
	(2, '站点关键词', 'keywords', 1, 52, '自行车', ''),
	(3, '站点描述', 'desc', 2, 51, '                                                                                                                                                                                                                                                                                                                                                                                                            12312313                                                                                                                                                                                           ', ''),
	(6, '是否关闭网站', 'close', 3, 50, '是', '是,否'),
	(7, '启动验证码', 'code', 4, 50, '是', '是'),
	(8, '自动清空缓存', 'cache', 5, 50, '3个小时', '1个小时,2个小时,3个小时'),
	(9, '允许评论', 'comment', 4, 50, '', '允许');
/*!40000 ALTER TABLE `c_conf` ENABLE KEYS */;

-- Dumping structure for table company.c_link
CREATE TABLE IF NOT EXISTS `c_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL COMMENT '链接名称',
  `description` varchar(30) NOT NULL COMMENT '链接描述',
  `url` varchar(255) NOT NULL COMMENT '链接地址',
  `sort` tinyint(1) NOT NULL DEFAULT '50' COMMENT '排序值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='链接表';

-- Dumping data for table company.c_link: ~1 rows (approximately)
DELETE FROM `c_link`;
/*!40000 ALTER TABLE `c_link` DISABLE KEYS */;
INSERT INTO `c_link` (`id`, `title`, `description`, `url`, `sort`) VALUES
	(1, '交易细则2', '1231231231', '3123123123', 1);
/*!40000 ALTER TABLE `c_link` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
