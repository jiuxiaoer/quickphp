/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : jiuxiao_web

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2021-02-08 13:30:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for jiuxiao_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `jiuxiao_admin_log`;
CREATE TABLE `jiuxiao_admin_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) NOT NULL COMMENT '用户id',
  `page` varchar(50) COLLATE utf8mb4_bin NOT NULL COMMENT '用户请求页面',
  `ip` varchar(30) COLLATE utf8mb4_bin NOT NULL COMMENT '用户请求ip',
  `data` varchar(255) COLLATE utf8mb4_bin NOT NULL COMMENT '用户请求数据',
  `agent` varchar(255) COLLATE utf8mb4_bin NOT NULL COMMENT '用户请求代理',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of jiuxiao_admin_log
-- ----------------------------
INSERT INTO `jiuxiao_admin_log` VALUES ('22', '1000', '/admin/log/index', '127.0.0.1', '[]', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:24:28');
INSERT INTO `jiuxiao_admin_log` VALUES ('23', '1000', '/admin/author/index', '127.0.0.1', '[]', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:24:36');
INSERT INTO `jiuxiao_admin_log` VALUES ('24', '1000', '/admin/Author/edit', '127.0.0.1', '{\"id\":\"41\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:24:45');
INSERT INTO `jiuxiao_admin_log` VALUES ('25', '1000', '/admin/Author/edit', '127.0.0.1', '{\"id\":\"41\",\"pid\":\"40\",\"title\":\"操作日志\",\"href\":\"/admin/log/index\",\"icon\":\"layui-icon-rate\",\"sort\":\"0\",\"status\":\"1\",\"type\":\"1\",\"__token__\":\"d007218ca7cceb10afe00d09db669b7b\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:24:48');
INSERT INTO `jiuxiao_admin_log` VALUES ('26', '1000', '/admin/author/index', '127.0.0.1', '[]', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:24:51');
INSERT INTO `jiuxiao_admin_log` VALUES ('27', '1000', '/admin/log/index', '127.0.0.1', '[]', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:24:57');
INSERT INTO `jiuxiao_admin_log` VALUES ('28', '1000', '/admin/log/index', '127.0.0.1', '[]', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:25:57');
INSERT INTO `jiuxiao_admin_log` VALUES ('29', '1001', '/admin/user/index', '127.0.0.1', '[]', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:26:22');
INSERT INTO `jiuxiao_admin_log` VALUES ('30', '1001', '/admin/user/getUserJson', '127.0.0.1', '{\"page\":\"1\",\"limit\":\"10\"}', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', '1', '2021-02-08 13:26:22');

-- ----------------------------
-- Table structure for jiuxiao_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `jiuxiao_admin_user`;
CREATE TABLE `jiuxiao_admin_user` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '用户名',
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '密码',
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '手机号',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `login_ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '127.0.0.1' COMMENT '登陆ip',
  `operator_id` int(6) DEFAULT NULL COMMENT '操作人',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态  1 正常  -1 禁止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1010 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of jiuxiao_admin_user
-- ----------------------------
INSERT INTO `jiuxiao_admin_user` VALUES ('1000', 'admin', '40d42ff13e4e41a9c90fb0ca2ba4891d', '17692679521', '2021-02-08 12:25:39', '2021-02-08 12:25:39', '127.0.0.1', '1000', '1');
INSERT INTO `jiuxiao_admin_user` VALUES ('1001', 'jiuxiao', '9b55f2d8fc6907c727f4bb6ef5a48365', '13400146757', '2021-02-08 13:26:11', '2021-02-08 01:26:11', '127.0.0.1', '1000', '1');
INSERT INTO `jiuxiao_admin_user` VALUES ('1009', 'test', '9b55f2d8fc6907c727f4bb6ef5a48365', '13400146757', '2021-01-29 15:33:09', '2021-01-29 15:33:09', '127.0.0.1', null, '1');

-- ----------------------------
-- Table structure for jiuxiao_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `jiuxiao_auth_group`;
CREATE TABLE `jiuxiao_auth_group` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '权限名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `rules` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '权限规则ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of jiuxiao_auth_group
-- ----------------------------
INSERT INTO `jiuxiao_auth_group` VALUES ('1', '超级管理员', '1', '40,1,3,30,31,33,6,34,35,36,25,37,38,39,41');
INSERT INTO `jiuxiao_auth_group` VALUES ('2', '普通用户', '1', '40,1,3,6,25');
INSERT INTO `jiuxiao_auth_group` VALUES ('3', 'TEst', '-1', '1');
INSERT INTO `jiuxiao_auth_group` VALUES ('4', '测试1', '-1', '1,25');

-- ----------------------------
-- Table structure for jiuxiao_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `jiuxiao_auth_group_access`;
CREATE TABLE `jiuxiao_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of jiuxiao_auth_group_access
-- ----------------------------
INSERT INTO `jiuxiao_auth_group_access` VALUES ('1000', '1');
INSERT INTO `jiuxiao_auth_group_access` VALUES ('1001', '2');
INSERT INTO `jiuxiao_auth_group_access` VALUES ('1007', '2');
INSERT INTO `jiuxiao_auth_group_access` VALUES ('1008', '2');
INSERT INTO `jiuxiao_auth_group_access` VALUES ('1009', '2');

-- ----------------------------
-- Table structure for jiuxiao_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `jiuxiao_auth_rule`;
CREATE TABLE `jiuxiao_auth_rule` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '规则名称',
  `href` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT 'url地址',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '图标',
  `type` mediumint(10) NOT NULL DEFAULT '0',
  `pid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '父级id',
  `openType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '跳转方式',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(50) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `operator_id` int(6) DEFAULT NULL COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of jiuxiao_auth_rule
-- ----------------------------
INSERT INTO `jiuxiao_auth_rule` VALUES ('1', '权限管理', '', 'layui-icon-group', '0', '40', '', '1', '0', '2021-02-08 12:29:16', '2021-02-08 12:29:16', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('3', '权限列表', '/admin/author/index', 'layui-icon-group', '1', '1', '_iframe', '1', '0', '2021-01-18 17:42:00', '2021-01-18 17:42:00', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('6', '用户组管理', '/admin/group/index', 'layui-icon-user', '1', '1', '', '1', '0', '2021-01-25 01:23:58', '2021-01-25 01:23:58', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('25', '后台用户管理', '/admin/user/index', 'layui-icon-username', '1', '40', '', '1', '0', '2021-02-08 12:29:39', '2021-02-08 12:29:39', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('30', '删除权限', '/admin/author/delete', 'layui-icon-delete', '1', '3', '', '2', '0', '2021-01-29 12:49:09', '2021-01-29 12:49:09', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('31', '编辑权限', '/admin/author/edit', 'layui-icon-edit', '1', '3', '', '2', '0', '2021-01-29 12:43:51', '2021-01-29 12:43:51', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('33', '添加权限', '/admin/author/add', 'layui-icon-add-circle-fine', '1', '3', '', '2', '0', '2021-01-29 12:43:53', '2021-01-29 12:43:53', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('34', '添加用户组', '/admin/group/add', 'layui-icon-add-circle-fine', '1', '6', '', '2', '0', '2021-01-29 14:03:25', '2021-01-29 14:03:25', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('35', '编辑用户组', '/admin/group/edit', 'layui-icon-edit', '1', '6', '', '2', '0', '2021-01-29 14:03:17', '2021-01-29 14:03:17', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('36', '删除用户组', '/admin/group/delete', 'layui-icon-delete', '1', '6', '', '2', '0', '2021-01-29 14:07:42', '2021-01-29 14:07:42', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('37', '添加用户', '/admin/user/add', 'layui-icon-add-circle-fine', '1', '25', '', '2', '0', '2021-01-29 14:18:43', '2021-01-29 14:18:43', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('38', '编辑用户', '/admin/user/edit', 'layui-icon-edit', '1', '25', '', '2', '0', '2021-01-29 14:25:00', '2021-01-29 14:25:00', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('39', '删除用户', '/admin/user/delete', 'layui-icon-delete', '1', '25', '', '2', '0', '2021-01-29 14:25:50', '2021-01-29 14:25:50', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('40', '系统管理', '', 'layui-icon-set-sm', '0', '0', '', '1', '0', '2021-02-08 12:28:33', '2021-02-08 12:28:33', null);
INSERT INTO `jiuxiao_auth_rule` VALUES ('41', '操作日志', '/admin/log/index', 'layui-icon-rate', '1', '40', '', '1', '0', '2021-02-08 13:24:48', '2021-02-08 13:24:48', null);
