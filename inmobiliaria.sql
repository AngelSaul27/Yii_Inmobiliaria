-- Adminer 4.8.1 MySQL 8.0.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `inmobiliaria`;
CREATE DATABASE `inmobiliaria` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `inmobiliaria`;

DROP TABLE IF EXISTS `agente_venta`;
CREATE TABLE `agente_venta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `correo_contacto` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `numero_contacto` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_agente_venta_user1_idx` (`user_id`),
  CONSTRAINT `fk_agente_venta_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `agente_venta` (`id`, `correo_contacto`, `numero_contacto`, `user_id`) VALUES
(1,	'example@gmail.com',	'1987654302',	2),
(2,	'agente@gmail.com',	'1987654302',	5);

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin',	1,	1700716854),
('Agente',	2,	1700723344),
('Agente',	5,	1700780569),
('Usuario',	4,	1700780126);

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `fk_auth_item_group_code` (`group_code`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`) VALUES
('/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/cita/*',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/cita/assigned',	3,	NULL,	NULL,	NULL,	1700782596,	1700782596,	NULL),
('/cita/register',	3,	NULL,	NULL,	NULL,	1700787292,	1700787292,	NULL),
('/cita/unsubscribe',	3,	NULL,	NULL,	NULL,	1700790001,	1700790001,	NULL),
('/cita/user',	3,	NULL,	NULL,	NULL,	1700788550,	1700788550,	NULL),
('/cita/view',	3,	NULL,	NULL,	NULL,	1700782596,	1700782596,	NULL),
('/debug/*',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/default/*',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/default/db-explain',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/default/download-mail',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/default/index',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/default/toolbar',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/default/view',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/user/*',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/user/reset-identity',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/debug/user/set-identity',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/gii/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/action',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/diff',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/preview',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/inmueble/*',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/inmueble/create',	3,	NULL,	NULL,	NULL,	1700782596,	1700782596,	NULL),
('/inmueble/delete',	3,	NULL,	NULL,	NULL,	1700782596,	1700782596,	NULL),
('/inmueble/edit',	3,	NULL,	NULL,	NULL,	1700782596,	1700782596,	NULL),
('/inmueble/view',	3,	NULL,	NULL,	NULL,	1700782596,	1700782596,	NULL),
('/management/*',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/management/carousel-create',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/management/carousel-edit',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/management/carousel-remove',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/management/carousel-view',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/site/*',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/site/error',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/site/index',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/site/inmueble-view',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/site/inmuebles-categoria',	3,	NULL,	NULL,	NULL,	1700793345,	1700793345,	NULL),
('/site/inmuebles-view',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/site/login',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/site/logout',	3,	NULL,	NULL,	NULL,	1700723276,	1700723276,	NULL),
('/site/register',	3,	NULL,	NULL,	NULL,	1700782596,	1700782596,	NULL),
('/site/register-agente',	3,	NULL,	NULL,	NULL,	1700782596,	1700782596,	NULL),
('/user-management/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/captcha',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/change-own-password',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/confirm-email',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/confirm-email-receive',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/confirm-registration-email',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/login',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/password-recovery',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/password-recovery-receive',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/registration',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/refresh-routes',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/set-child-permissions',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/set-child-routes',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/set-child-permissions',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/set-child-roles',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-permission/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-permission/set',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-permission/set-roles',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/change-password',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('Admin',	1,	'Admin',	NULL,	NULL,	1426062189,	1426062189,	NULL),
('Agente',	1,	'Agente',	NULL,	NULL,	1700723237,	1700723237,	NULL),
('Agente_Permision',	2,	'Agente',	NULL,	NULL,	1700723267,	1700723267,	NULL),
('assignRolesToUsers',	2,	'Assign roles to users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('bindUserToIp',	2,	'Bind user to IP',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('changeOwnPassword',	2,	'Change own password',	NULL,	NULL,	1426062189,	1426062189,	'userCommonPermissions'),
('changeUserPassword',	2,	'Change user password',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('commonPermission',	2,	'Common permission',	NULL,	NULL,	1426062188,	1426062188,	NULL),
('createUsers',	2,	'Create users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('deleteUsers',	2,	'Delete users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('editUserEmail',	2,	'Edit user email',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('editUsers',	2,	'Edit users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('Usuario',	1,	'Usuario',	NULL,	NULL,	1700723368,	1700723368,	NULL),
('Usuario_Permision',	2,	'Usuario',	NULL,	NULL,	1700723384,	1700723384,	NULL),
('viewRegistrationIp',	2,	'View registration IP',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('viewUserEmail',	2,	'View user email',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('viewUserRoles',	2,	'View user roles',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('viewUsers',	2,	'View users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('viewVisitLog',	2,	'View visit log',	NULL,	NULL,	1426062189,	1426062189,	'userManagement');

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Agente_Permision',	'/cita/assigned'),
('Usuario_Permision',	'/cita/register'),
('Usuario_Permision',	'/cita/unsubscribe'),
('Usuario_Permision',	'/cita/user'),
('Agente_Permision',	'/cita/view'),
('Agente_Permision',	'/inmueble/*'),
('Agente_Permision',	'/inmueble/create'),
('Agente_Permision',	'/inmueble/delete'),
('Agente_Permision',	'/inmueble/edit'),
('Agente_Permision',	'/inmueble/view'),
('Agente_Permision',	'/site/*'),
('commonPermission',	'/site/*'),
('Usuario_Permision',	'/site/*'),
('changeOwnPassword',	'/user-management/auth/change-own-password'),
('assignRolesToUsers',	'/user-management/user-permission/set'),
('assignRolesToUsers',	'/user-management/user-permission/set-roles'),
('viewVisitLog',	'/user-management/user-visit-log/grid-page-size'),
('viewVisitLog',	'/user-management/user-visit-log/index'),
('viewVisitLog',	'/user-management/user-visit-log/view'),
('editUsers',	'/user-management/user/bulk-activate'),
('editUsers',	'/user-management/user/bulk-deactivate'),
('deleteUsers',	'/user-management/user/bulk-delete'),
('changeUserPassword',	'/user-management/user/change-password'),
('createUsers',	'/user-management/user/create'),
('deleteUsers',	'/user-management/user/delete'),
('viewUsers',	'/user-management/user/grid-page-size'),
('viewUsers',	'/user-management/user/index'),
('editUsers',	'/user-management/user/update'),
('viewUsers',	'/user-management/user/view'),
('Agente',	'Agente_Permision'),
('Admin',	'assignRolesToUsers'),
('Admin',	'changeOwnPassword'),
('Admin',	'changeUserPassword'),
('Admin',	'createUsers'),
('Admin',	'deleteUsers'),
('Admin',	'editUsers'),
('Usuario',	'Usuario_Permision'),
('editUserEmail',	'viewUserEmail'),
('assignRolesToUsers',	'viewUserRoles'),
('Admin',	'viewUsers'),
('assignRolesToUsers',	'viewUsers'),
('changeUserPassword',	'viewUsers'),
('createUsers',	'viewUsers'),
('deleteUsers',	'viewUsers'),
('editUsers',	'viewUsers');

DROP TABLE IF EXISTS `auth_item_group`;
CREATE TABLE `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
('userCommonPermissions',	'User common permission',	1426062189,	1426062189),
('userManagement',	'User management',	1426062189,	1426062189);

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `carousel`;
CREATE TABLE `carousel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `titulo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `fecha_activacion` date NOT NULL,
  `fecha_desactivacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `carousel` (`id`, `imagen`, `titulo`, `descripcion`, `fecha_activacion`, `fecha_desactivacion`) VALUES
(6,	'carousel/3_23_11_2023_07_46_13.webp',	'Encuentra los mejores lugares para vivir',	'Contamos con las mejores casas y deparamentos',	'2023-11-23',	'2023-11-30'),
(7,	'carousel/2_23_11_2023_07_47_15.jpg',	'Encuentra los mejores lugares para vivir',	'Contamos con las mejores casas y deparamentos',	'2023-11-23',	'2023-11-30'),
(8,	'carousel/1_23_11_2023_07_47_23.jpg',	'Encuentra los mejores lugares para vivir',	'Contamos con las mejores casas y deparamentos',	'2023-11-23',	'2023-11-30');

DROP TABLE IF EXISTS `categoria_inmueble`;
CREATE TABLE `categoria_inmueble` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `categoria_inmueble` (`id`, `categoria`) VALUES
(1,	'Renta'),
(2,	'Compra');

DROP TABLE IF EXISTS `cita`;
CREATE TABLE `cita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `inmueble_id` int NOT NULL,
  `fecha_cita` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cita_user1_idx` (`user_id`),
  KEY `fk_cita_inmueble1_idx` (`inmueble_id`),
  CONSTRAINT `fk_cita_inmueble1` FOREIGN KEY (`inmueble_id`) REFERENCES `inmueble` (`id`),
  CONSTRAINT `fk_cita_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `cita` (`id`, `user_id`, `inmueble_id`, `fecha_cita`, `created_at`, `updated_at`) VALUES
(1,	4,	1,	'2023-11-25',	'2023-11-24',	'2023-11-24'),
(2,	4,	2,	'2023-11-30',	'2023-11-24',	'2023-11-24'),
(3,	4,	3,	NULL,	'2023-11-24',	'2023-11-24'),
(4,	4,	5,	NULL,	'2023-11-24',	'2023-11-24'),
(5,	4,	6,	NULL,	'2023-11-24',	'2023-11-24'),
(6,	4,	7,	NULL,	'2023-11-24',	'2023-11-24'),
(7,	4,	8,	NULL,	'2023-11-24',	'2023-11-24');

DROP TABLE IF EXISTS `inmueble`;
CREATE TABLE `inmueble` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nombre` varchar(125) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ubicacion` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `precio` float NOT NULL,
  `habitaciones` int NOT NULL DEFAULT '1',
  `banios` int NOT NULL DEFAULT '1',
  `niveles` int NOT NULL DEFAULT '1',
  `tamanio` int NOT NULL,
  `anio_construccion` year NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `agente_venta_id` int NOT NULL,
  `tipo_inmueble_id` int NOT NULL,
  `categoria_inmueble_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inmueble_agente_venta1_idx` (`agente_venta_id`),
  KEY `fk_inmueble_tipo_inmueble1_idx` (`tipo_inmueble_id`),
  KEY `fk_inmueble_categoria_inmueble1_idx` (`categoria_inmueble_id`),
  CONSTRAINT `fk_inmueble_agente_venta1` FOREIGN KEY (`agente_venta_id`) REFERENCES `agente_venta` (`id`),
  CONSTRAINT `fk_inmueble_categoria_inmueble1` FOREIGN KEY (`categoria_inmueble_id`) REFERENCES `categoria_inmueble` (`id`),
  CONSTRAINT `fk_inmueble_tipo_inmueble1` FOREIGN KEY (`tipo_inmueble_id`) REFERENCES `tipo_inmueble` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `inmueble` (`id`, `imagen`, `nombre`, `ubicacion`, `precio`, `habitaciones`, `banios`, `niveles`, `tamanio`, `anio_construccion`, `fecha_publicacion`, `timestamp`, `agente_venta_id`, `tipo_inmueble_id`, `categoria_inmueble_id`) VALUES
(1,	'inmuebles/3_23_11_2023_09_26_33.webp',	'Casa EU 1',	'Estados Unidos',	1000000,	4,	3,	230,	2,	'1970',	'2023-11-23',	'2023-11-23 08:45:05',	1,	2,	1),
(2,	'inmuebles/2_23_11_2023_09_33_32.jpg',	'Casa EU 2',	'Estados Unidos',	1000000,	4,	3,	230,	2,	'2023',	'2023-11-23',	'2023-11-23 08:33:32',	1,	2,	2),
(3,	'inmuebles/1_23_11_2023_09_33_52.jpg',	'Casa EU 3',	'Estados Unidos',	1000000,	4,	3,	230,	2,	'2023',	'2023-11-23',	'2023-11-23 08:33:52',	1,	2,	2),
(5,	'inmuebles/pexels-pixabay-276724_23_11_2023_09_30_58.jpg',	'Casa EU 4',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:30:58',	1,	1,	2),
(6,	'inmuebles/pexels-irina-iriser-754339_23_11_2023_09_31_10.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:31:10',	1,	1,	2),
(7,	'inmuebles/pexels-mali-maeder-99682_23_11_2023_09_31_19.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:31:19',	1,	1,	2),
(8,	'inmuebles/pexels-mike-bird-219532_23_11_2023_09_31_29.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:31:29',	1,	1,	2),
(9,	'inmuebles/pexels-evgeny-tchebotarev-2187605_23_11_2023_09_31_52.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:31:52',	1,	2,	1),
(10,	'inmuebles/pexels-pixabay-209296_23_11_2023_09_32_05.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:32:05',	1,	2,	1),
(11,	'inmuebles/pexels-pixabay-164338 (1)_23_11_2023_09_32_13.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:32:13',	1,	2,	1),
(12,	'inmuebles/pexels-expect-best-323780_23_11_2023_09_32_23.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:32:23',	1,	2,	2),
(13,	'inmuebles/pexels-magda-ehlers-772177_23_11_2023_09_32_31.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:32:31',	1,	2,	2),
(14,	'inmuebles/pexels-pixabay-164338_23_11_2023_09_33_59.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'1970',	'2023-11-22',	'2023-11-23 20:33:59',	1,	1,	1),
(15,	'inmuebles/pexels-pixabay-259588_23_11_2023_09_32_53.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:32:53',	1,	1,	1),
(16,	'inmuebles/pexels-binyamin-mellish-1396132_23_11_2023_09_33_04.jpg',	'Casa EU 5',	'Estados Unidos',	20000,	4,	3,	200,	2,	'2023',	'2023-11-22',	'2023-11-23 20:33:04',	1,	1,	1);

DROP TABLE IF EXISTS `tipo_inmueble`;
CREATE TABLE `tipo_inmueble` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `tipo_inmueble` (`id`, `tipo`) VALUES
(1,	'Casa'),
(2,	'Departamento');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(85) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'undefined',
  `confirmation_token` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `superadmin` smallint DEFAULT '0',
  `registration_ip` varchar(15) DEFAULT NULL,
  `bind_to_ip` varchar(255) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `email_confirmed` smallint NOT NULL DEFAULT '0',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user` (`id`, `username`, `password`, `auth_key`, `imagen`, `confirmation_token`, `status`, `superadmin`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`, `created_at`, `updated_at`) VALUES
(1,	'superadmin',	'$2y$13$MhlYe12xkGFnSeK0sO2up.Y9kAD9Ct6JS1i9VLP7YAqd1dFsSylz2',	'kz2px152FAWlkHbkZoCiXgBAd-S8SSjF',	'undefined',	NULL,	1,	1,	NULL,	NULL,	'superadmin@gmail.com',	0,	1426062188,	1426062188),
(2,	'Sofia Lopez',	'$2y$13$RnIHtrBvMuWQc9wA0cWkVOCCnM3JN595gK0tiLbgz7VNn7Au..SVK',	'_6zKRdgfYvlKwmD4-xyXfZURW4nDDBnR',	'usuario/agente.png',	NULL,	1,	0,	'127.0.0.1',	'',	'agente0@gmail.com',	0,	1700717144,	1700717144),
(4,	'juanito',	'$2y$13$KvpOVqO29zniPRd1Y6Y/kuKqR/nRTwQMeX3Z1HNqz2ZTupNezPMsK',	'GbicyxATiG2Zecss4As7ssTZCtGqNREr',	'usuario/logo_23_11_2023_11_55_25.webp',	NULL,	1,	0,	'127.0.0.1',	'',	'usuario@gmail.com',	0,	1700780126,	1700780126),
(5,	'Juanita',	'$2y$13$vcVs6RiCC5y7NU6nZA0eh.oNpGV8qhIg4WL7HScau72TjlMtuO3L.',	'e9_OIQrBaCa3FnAouWB0yi06F58OXSMX',	'usuario/logo_24_11_2023_12_02_49.webp',	NULL,	1,	0,	'127.0.0.1',	'',	'agente@gmail.com',	0,	1700780569,	1700780569);

DROP TABLE IF EXISTS `user_visit_log`;
CREATE TABLE `user_visit_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `visit_time` int NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user_visit_log` (`id`, `token`, `ip`, `language`, `user_agent`, `user_id`, `visit_time`, `browser`, `os`) VALUES
(2,	'655edd6babf21',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	1,	1700715883,	'Chrome',	'Windows'),
(3,	'655ef9e3cc9fb',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	1,	1700723171,	'Chrome',	'Windows'),
(4,	'655efb1eb7916',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	2,	1700723486,	'Chrome',	'Windows'),
(5,	'655eff775723c',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	1,	1700724599,	'Chrome',	'Windows'),
(6,	'655fb49867db2',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	2,	1700770968,	'Chrome',	'Windows'),
(7,	'655fd87bc7599',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	4,	1700780155,	'Chrome',	'Windows'),
(8,	'655fda54e5434',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	5,	1700780628,	'Chrome',	'Windows'),
(9,	'655fdae7df0d6',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	4,	1700780775,	'Chrome',	'Windows'),
(10,	'655fe1f86adf6',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	1,	1700782584,	'Chrome',	'Windows'),
(11,	'655ff422d657f',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	1,	1700787234,	'Chrome',	'Windows'),
(12,	'656000c2ca6ea',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	2,	1700790466,	'Chrome',	'Windows'),
(13,	'65600bf3ca02d',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	1,	1700793331,	'Chrome',	'Windows'),
(14,	'65600ee4ba18a',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	1,	1700794084,	'Chrome',	'Windows');

-- 2023-12-07 07:18:05
