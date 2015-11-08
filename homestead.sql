/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : homestead

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2015-10-23 11:11:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `child_frontpage`
-- ----------------------------
DROP TABLE IF EXISTS `child_frontpage`;
CREATE TABLE `child_frontpage` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `parent_id` int(3) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `redirect` text,
  `image` text,
  `mode` enum('_self','_blank') DEFAULT '_blank',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of child_frontpage
-- ----------------------------
INSERT INTO `child_frontpage` VALUES ('1', '1', 'Aplikasi Surat Menyurat', 'suratmennyurat.com', '1.jpg', '_blank');

-- ----------------------------
-- Table structure for `child_menu`
-- ----------------------------
DROP TABLE IF EXISTS `child_menu`;
CREATE TABLE `child_menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `parent_id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `redirect` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of child_menu
-- ----------------------------
INSERT INTO `child_menu` VALUES ('12', '1', 'addChild-12', 'addChild-13');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2015_09_24_203636_entrust_setup_tables', '1');
INSERT INTO `migrations` VALUES ('2015_09_24_204259_create_setting', '1');
INSERT INTO `migrations` VALUES ('2015_03_07_311070_create_tracker_paths_table', '2');
INSERT INTO `migrations` VALUES ('2015_03_07_311071_create_tracker_queries_table', '2');
INSERT INTO `migrations` VALUES ('2015_03_07_311072_create_tracker_queries_arguments_table', '2');
INSERT INTO `migrations` VALUES ('2015_10_17_235239_parent_frontpage', '3');
INSERT INTO `migrations` VALUES ('2015_10_17_235724_child_frontpage', '3');
INSERT INTO `migrations` VALUES ('2015_10_17_235854_parent_menu', '3');
INSERT INTO `migrations` VALUES ('2015_10_17_235923_child_menu', '3');
INSERT INTO `migrations` VALUES ('2015_10_22_211455_create_modules_table', '3');

-- ----------------------------
-- Table structure for `modules`
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `route` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('7', 'Home', '\'/\', \'PagesController@index\'', 'Route::get(\'/\', \'PagesController@index\');', '2015-10-22 21:55:34', '2015-10-22 22:00:07');
INSERT INTO `modules` VALUES ('8', 'login', '\'login\', [\'uses\'=>\'UsersController@login\', \'as\'=>\'users.login.get\']', 'Login module routing', '2015-10-22 21:56:11', '2015-10-22 22:00:15');
INSERT INTO `modules` VALUES ('9', 'admin/user', '\'admin/user\', [\'uses\'=>\'PagesController@user\', \'as\'=>\'admin.user.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 21:57:31', '2015-10-22 22:00:22');
INSERT INTO `modules` VALUES ('10', 'admin/role', '\'admin/role\', [\'uses\'=>\'PagesController@role\', \'as\'=>\'admin.role.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 21:58:17', '2015-10-22 22:00:43');
INSERT INTO `modules` VALUES ('11', 'admin/permission', '\'admin/permission\', [\'uses\'=>\'PagesController@permission\', \'as\'=>\'admin.permission.get\']', '', '2015-10-22 21:58:29', '2015-10-22 21:59:57');
INSERT INTO `modules` VALUES ('12', 'admin/module', '\'admin/module\', [\'uses\'=>\'PagesController@module\', \'as\'=>\'admin.permission.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 22:01:04', '2015-10-22 22:01:04');
INSERT INTO `modules` VALUES ('13', 'admin/tes', '\'admin/tes\', [\'uses\'=>\'PagesController@tes\', \'as\'=>\'admin.user.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 22:01:17', '2015-10-22 22:01:17');
INSERT INTO `modules` VALUES ('14', 'admin/dashboard', '\'admin/dashboard\', [\'uses\'=>\'PagesController@dashboard\', \'as\'=>\'admin.dashboard.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 22:01:27', '2015-10-22 22:01:27');
INSERT INTO `modules` VALUES ('15', 'admin/menu', '\'admin/menu\', [\'uses\'=>\'PagesController@menu\', \'as\'=>\'admin.menu.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 22:01:39', '2015-10-22 22:01:39');
INSERT INTO `modules` VALUES ('16', 'admin/preference', '\'admin/preference\', [\'uses\'=>\'PagesController@preference\', \'as\'=>\'admin.preference.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 22:01:55', '2015-10-22 22:01:55');
INSERT INTO `modules` VALUES ('17', 'admin/grid', '\'admin/grid\', [\'uses\'=>\'PagesController@grid\', \'as\'=>\'admin.grid.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 22:02:13', '2015-10-22 22:02:13');
INSERT INTO `modules` VALUES ('20', 'admin/form:child', '\'admin/form:child\', [\'uses\'=>\'ChildController@formChild\', \'as\'=>\'admin.grid.get\', \'middleware\'=>\'auth\']', '', '2015-10-22 22:25:19', '2015-10-22 22:25:19');
INSERT INTO `modules` VALUES ('26', 'Menu Images', 'any admin/gambar', '', '2015-10-22 22:28:56', '2015-10-22 22:28:56');
INSERT INTO `modules` VALUES ('27', 'admin/users', '[Menu^=admin/users]', '', '2015-10-22 22:29:20', '2015-10-22 22:29:20');
INSERT INTO `modules` VALUES ('28', 'admin/roles', '[Menu^=admin/roles]', '', '2015-10-22 22:29:38', '2015-10-22 22:29:38');
INSERT INTO `modules` VALUES ('29', 'admin/menu:child', 'admin/menu:child', '', '2015-10-22 22:30:05', '2015-10-22 22:30:05');
INSERT INTO `modules` VALUES ('30', 'admin/preference:image', 'admin/preference:image', '', '2015-10-22 22:30:18', '2015-10-22 22:30:18');
INSERT INTO `modules` VALUES ('31', 'admin/preference:background', 'admin/preference:background', '', '2015-10-22 22:30:30', '2015-10-22 22:30:30');
INSERT INTO `modules` VALUES ('32', 'admin/preference:logo', 'admin/preference:logo', '', '2015-10-22 22:30:38', '2015-10-22 22:30:38');
INSERT INTO `modules` VALUES ('33', 'admin/preference:footer', 'admin/preference:footer', '', '2015-10-22 22:30:45', '2015-10-22 22:30:45');

-- ----------------------------
-- Table structure for `parent_frontpage`
-- ----------------------------
DROP TABLE IF EXISTS `parent_frontpage`;
CREATE TABLE `parent_frontpage` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `position` int(2) NOT NULL DEFAULT '0',
  `redirect` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `mode` enum('_blank','_self') NOT NULL DEFAULT '_blank',
  `publicKey` text,
  `privateKey` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of parent_frontpage
-- ----------------------------
INSERT INTO `parent_frontpage` VALUES ('1', 'Aplikasi Surat', '7', 'http://www.google.com/', 'aplikasi-surat.png', '_blank', null, null, null, '2015-10-17 22:56:33');
INSERT INTO `parent_frontpage` VALUES ('2', 'Lamb 1', '2', 'http://www.google.com', '1.jpg', '_blank', null, null, null, null);
INSERT INTO `parent_frontpage` VALUES ('3', 'Sistem Informasi Pegawai', '3', 'http://www.apaaja.com', 'sistem-info-pegawai.png', '_blank', null, null, null, null);
INSERT INTO `parent_frontpage` VALUES ('4', 'Lamb 4', '4', 'http://www.wow.com', '4.jpg', '_blank', null, null, null, null);
INSERT INTO `parent_frontpage` VALUES ('5', 'Perjalanan Dinas', '6', 'http://www.aduh.com', 'perjalanan-dinas.png', '_blank', null, null, null, '2015-10-17 22:56:33');
INSERT INTO `parent_frontpage` VALUES ('6', 'Lamb 6', '4', 'http://www.awaw.com', '6.jpg', '_blank', null, null, null, '2015-10-17 22:56:33');
INSERT INTO `parent_frontpage` VALUES ('7', 'Aplikasi TV', '1', 'ewq', 'tele.png', '_blank', 'random string', 'random string', null, '2015-10-20 02:59:23');
INSERT INTO `parent_frontpage` VALUES ('9', 'Aplikasi Perumahan', '5', 'rumah.com', '201510172236370259.png', '_blank', null, null, null, '2015-10-17 22:56:33');

-- ----------------------------
-- Table structure for `parent_menu`
-- ----------------------------
DROP TABLE IF EXISTS `parent_menu`;
CREATE TABLE `parent_menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `redirect` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of parent_menu
-- ----------------------------
INSERT INTO `parent_menu` VALUES ('1', 'PRODUCT', 'www.google.com');
INSERT INTO `parent_menu` VALUES ('2', 'SERVICES', '');
INSERT INTO `parent_menu` VALUES ('3', 'ASSETS', '');
INSERT INTO `parent_menu` VALUES ('4', 'CONTACT', '');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `permission_role`
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `access` enum('self','module','app') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'self',
  `action` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`,`access`,`action`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '2', 'module', '7');
INSERT INTO `permission_role` VALUES ('1', '3', 'module', '11');
INSERT INTO `permission_role` VALUES ('1', '3', 'module', '12');
INSERT INTO `permission_role` VALUES ('1', '3', 'module', '9');
INSERT INTO `permission_role` VALUES ('1', '3', 'app', '1');
INSERT INTO `permission_role` VALUES ('1', '3', 'app', '3');
INSERT INTO `permission_role` VALUES ('1', '4', 'app', '6');
INSERT INTO `permission_role` VALUES ('1', '4', 'app', '7');
INSERT INTO `permission_role` VALUES ('1', '4', 'app', '9');

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `action` enum('access','add','edit','delete') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'access',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'can-access', 'Dapat Mengakses', 'this module to show any module which selected', 'true', '', '0000-00-00 00:00:00', '2015-10-22 20:01:38');
INSERT INTO `permissions` VALUES ('2', 'can-add', 'Dapat Menambah', '', 'true', 'add', '2015-10-20 00:19:45', '2015-10-20 10:55:48');
INSERT INTO `permissions` VALUES ('3', 'can-edit', 'Dapat Merubah', 'yeah, just edit!', 'true', 'edit', '0000-00-00 00:00:00', '2015-10-20 10:49:04');
INSERT INTO `permissions` VALUES ('4', 'can-delete', 'Dapat Menghapus', 'delete', 'true', 'delete', '2015-10-20 05:55:14', '2015-10-20 11:22:06');

-- ----------------------------
-- Table structure for `preference`
-- ----------------------------
DROP TABLE IF EXISTS `preference`;
CREATE TABLE `preference` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `logo` text,
  `footer` text,
  `grid` varchar(3) DEFAULT NULL,
  `background` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of preference
-- ----------------------------
INSERT INTO `preference` VALUES ('1', 'Nama Website', '  sistem-info-pegawai.png  ', 'a', '3x3', null);

-- ----------------------------
-- Table structure for `role_user`
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '2');
INSERT INTO `role_user` VALUES ('1', '3');
INSERT INTO `role_user` VALUES ('2', '4');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('2', 'User', 'user', 'Just User', '0000-00-00 00:00:00', '2015-10-19 22:40:18');
INSERT INTO `roles` VALUES ('3', 'admin', 'Administrator', 'Full Permission', '0000-00-00 00:00:00', '2015-10-19 22:40:31');
INSERT INTO `roles` VALUES ('4', 'Guest', 'guest', 'guest', '2015-10-21 02:47:01', '2015-10-21 02:47:07');

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', '4', '2015-10-18 09:54:46', '2015-10-18 09:56:31', 'grid_height');
INSERT INTO `settings` VALUES ('2', '3', '2015-10-18 09:54:46', '2015-10-18 09:54:46', 'grid_width');
INSERT INTO `settings` VALUES ('9', '  tele.png  ', '2015-10-18 08:44:06', '2015-10-18 08:44:06', 'Logo');
INSERT INTO `settings` VALUES ('10', 'website com aw', '2015-10-18 08:44:16', '2015-10-21 07:50:41', 'Title');
INSERT INTO `settings` VALUES ('11', '1379877294144.jpg', '2015-10-18 08:50:14', '2015-10-18 21:14:16', 'Background');
INSERT INTO `settings` VALUES ('12', 'asd', '2015-10-18 08:51:15', '2015-10-18 08:51:15', 'Footer');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8_unicode_ci,
  `public_key` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', null, 'admin', 'admin@admin.com', '$2a$10$RZBydh8bbDZuaY9wqBaf9O4BN25VVVJFBOtioB1kJDer5HZMhqsKy', '', '', '', '1ym5d1sYvEy1zbhqFzWjhjitegMC7HWCrnabDtkvl0u89l6BDwVb6of8W11L', 'share.png', null, '0000-00-00 00:00:00', '2015-10-22 13:20:34');
INSERT INTO `users` VALUES ('2', null, 'guest', 'guest@gmail.com', '$2y$10$J8H9R55HABou7yqgIxPqZ.oBhfECabOkssxbg5MIszc4Vge1SxwUW', '', 'guest', '', '74TDcve8JHt4tNKLYeHRXFuSvoxP8BimBrYK1mbblKfXIO1mq6M0UeB6CNex', '', null, '2015-10-22 11:27:45', '2015-10-22 13:20:45');
