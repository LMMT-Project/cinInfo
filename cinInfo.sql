-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.10.2-MariaDB-log - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cininfo
CREATE DATABASE IF NOT EXISTS `cininfo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `cininfo`;

-- Listage de la structure de la table cininfo. cmw_core_options
CREATE TABLE IF NOT EXISTS `cmw_core_options` (
  `option_name` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  `option_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_core_options : ~5 rows (environ)
/*!40000 ALTER TABLE `cmw_core_options` DISABLE KEYS */;
INSERT INTO `cmw_core_options` (`option_name`, `option_value`, `option_updated`) VALUES
	('captcha', 'none', '2022-12-28 21:52:02'),
	('dateFormat', 'd-m-Y H:i:s', '2022-12-28 21:52:02'),
	('description', 'Toute l\'information du ciné, directement sur votre écran.', '2022-12-28 21:52:47'),
	('name', 'CinInfo', '2022-12-28 21:52:47'),
	('theme', 'CinInfo', '2022-12-28 22:13:39');
/*!40000 ALTER TABLE `cmw_core_options` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_core_routes
CREATE TABLE IF NOT EXISTS `cmw_core_routes` (
  `core_routes_id` int(11) NOT NULL AUTO_INCREMENT,
  `core_routes_slug` varchar(300) NOT NULL,
  `core_routes_package` varchar(50) NOT NULL DEFAULT 'core',
  `core_routes_title` varchar(75) NOT NULL,
  `core_routes_method` varchar(10) NOT NULL DEFAULT 'GET',
  `core_routes_is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `core_routes_is_dynamic` tinyint(1) NOT NULL DEFAULT 0,
  `core_routes_weight` int(11) NOT NULL DEFAULT 1,
  `core_routes_last_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `core_routes_date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`core_routes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_core_routes : ~11 rows (environ)
/*!40000 ALTER TABLE `cmw_core_routes` DISABLE KEYS */;
INSERT INTO `cmw_core_routes` (`core_routes_id`, `core_routes_slug`, `core_routes_package`, `core_routes_title`, `core_routes_method`, `core_routes_is_admin`, `core_routes_is_dynamic`, `core_routes_weight`, `core_routes_last_edit`, `core_routes_date_creation`) VALUES
	(1, '/cmw-admin/updates/cms', 'core', 'cms', 'GET', 1, 0, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(2, '/cmw-admin/updates/cms/install', 'core', 'cmsinstall', 'GET', 1, 0, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(3, '/cmw-admin/pages/list', 'pages', 'list', 'GET', 1, 0, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(4, '/cmw-admin/pages/add', 'pages', 'add', 'GET', 1, 0, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(5, '/cmw-admin/pages/add', 'pages', 'add', 'POST', 1, 0, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(6, '/cmw-admin/pages/edit/:slug', 'pages', 'editslug', 'GET', 1, 1, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(7, '/cmw-admin/pages/edit', 'pages', 'edit', 'POST', 1, 0, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(8, '/cmw-admin/pages/delete/:id', 'pages', 'deleteid', 'GET', 1, 1, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(9, '/p/:slug', 'pages', 'pslug', 'GET', 1, 1, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(10, '/cmw-admin/users/settings', 'users', 'settings', 'GET', 1, 0, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03'),
	(11, '/cmw-admin/users/settings', 'users', 'settings', 'POST', 1, 0, 1, '2022-12-28 21:52:03', '2022-12-28 21:52:03');
/*!40000 ALTER TABLE `cmw_core_routes` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_mail_config_smtp
CREATE TABLE IF NOT EXISTS `cmw_mail_config_smtp` (
  `mail_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_config_mail` varchar(255) NOT NULL,
  `mail_config_mail_reply` varchar(255) NOT NULL,
  `mail_config_address_smtp` varchar(255) NOT NULL,
  `mail_config_user` varchar(255) NOT NULL,
  `mail_config_port` int(5) NOT NULL,
  `mail_config_protocol` varchar(50) NOT NULL,
  `mail_config_footer` mediumtext DEFAULT NULL,
  `mail_config_enable` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`mail_config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_mail_config_smtp : ~0 rows (environ)
/*!40000 ALTER TABLE `cmw_mail_config_smtp` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_mail_config_smtp` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_menus
CREATE TABLE IF NOT EXISTS `cmw_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `menu_level` int(1) NOT NULL,
  `menu_parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_menus : ~0 rows (environ)
/*!40000 ALTER TABLE `cmw_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_menus` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_pages
CREATE TABLE IF NOT EXISTS `cmw_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` longtext NOT NULL,
  `page_state` int(1) NOT NULL,
  `page_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `page_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `page_slug` varchar(255) NOT NULL,
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `page_slug` (`page_slug`),
  KEY `fk_pages_users` (`user_id`),
  CONSTRAINT `fk_pages_users` FOREIGN KEY (`user_id`) REFERENCES `cmw_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_pages : ~0 rows (environ)
/*!40000 ALTER TABLE `cmw_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_pages` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_permissions
CREATE TABLE IF NOT EXISTS `cmw_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_parent_id` int(11) DEFAULT NULL,
  `permission_code` varchar(50) NOT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `FK_PERMISSION_PARENT_ID` (`permission_parent_id`),
  CONSTRAINT `FK_PERMISSION_PARENT_ID` FOREIGN KEY (`permission_parent_id`) REFERENCES `cmw_permissions` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_permissions : ~13 rows (environ)
/*!40000 ALTER TABLE `cmw_permissions` DISABLE KEYS */;
INSERT INTO `cmw_permissions` (`permission_id`, `permission_parent_id`, `permission_code`) VALUES
	(1, NULL, 'operator'),
	(2, NULL, 'pages'),
	(3, NULL, 'core'),
	(4, NULL, 'users'),
	(5, 2, 'show'),
	(6, 2, 'add'),
	(7, 2, 'edit'),
	(8, 3, 'dashboard'),
	(9, 4, 'show'),
	(10, 4, 'add'),
	(11, 4, 'edit'),
	(12, 4, 'delete'),
	(13, 4, 'roles');
/*!40000 ALTER TABLE `cmw_permissions` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_roles
CREATE TABLE IF NOT EXISTS `cmw_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` tinytext NOT NULL,
  `role_description` text DEFAULT NULL,
  `role_weight` int(11) DEFAULT 0,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_roles : ~5 rows (environ)
/*!40000 ALTER TABLE `cmw_roles` DISABLE KEYS */;
INSERT INTO `cmw_roles` (`role_id`, `role_name`, `role_description`, `role_weight`) VALUES
	(1, 'Visiteur', 'Rôle pour les visiteurs', 0),
	(2, 'Utilisateur', 'Rôle pour les utilisateurs', 1),
	(3, 'Editeur', 'Rôle pour les éditeurs', 5),
	(4, 'Modérateur', 'Rôle pour les modérateurs', 10),
	(5, 'Administrateur', 'Rôle pour les administrateurs', 100);
/*!40000 ALTER TABLE `cmw_roles` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_roles_permissions
CREATE TABLE IF NOT EXISTS `cmw_roles_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `FK_ROLE_PERMISSION_PERMISSION_ID` (`permission_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `FK_ROLE_PERMISSION_PERMISSION_ID` FOREIGN KEY (`permission_id`) REFERENCES `cmw_permissions` (`permission_id`),
  CONSTRAINT `FK_ROLE_PERMISSION_ROLE_ID` FOREIGN KEY (`role_id`) REFERENCES `cmw_roles` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_roles_permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `cmw_roles_permissions` DISABLE KEYS */;
INSERT INTO `cmw_roles_permissions` (`permission_id`, `role_id`) VALUES
	(1, 5);
/*!40000 ALTER TABLE `cmw_roles_permissions` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_theme_config
CREATE TABLE IF NOT EXISTS `cmw_theme_config` (
  `theme_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_config_name` varchar(255) NOT NULL,
  `theme_config_value` mediumtext DEFAULT NULL,
  `theme_config_theme` varchar(255) NOT NULL,
  PRIMARY KEY (`theme_config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_theme_config : ~5 rows (environ)
/*!40000 ALTER TABLE `cmw_theme_config` DISABLE KEYS */;
INSERT INTO `cmw_theme_config` (`theme_config_id`, `theme_config_name`, `theme_config_value`, `theme_config_theme`) VALUES
	(1, 'primaryColor', '#4BD6FC', 'Sampler'),
	(2, 'secondaryColor', '#AE4BFC', 'Sampler'),
	(3, 'backgroundColor', '#757575', 'Sampler'),
	(4, 'img1', 'config/default/img/ez.png', 'Sampler'),
	(5, 'img2', 'config/default/img/ez.png', 'Sampler');
/*!40000 ALTER TABLE `cmw_theme_config` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_users
CREATE TABLE IF NOT EXISTS `cmw_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_pseudo` varchar(255) DEFAULT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_state` tinyint(1) NOT NULL DEFAULT 1,
  `user_key` varchar(255) NOT NULL,
  `user_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_logged` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_pseudo` (`user_pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_users : ~2 rows (environ)
/*!40000 ALTER TABLE `cmw_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_users` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_users_pictures
CREATE TABLE IF NOT EXISTS `cmw_users_pictures` (
  `users_pictures_user_id` int(11) NOT NULL,
  `users_pictures_image_name` varchar(255) NOT NULL,
  `users_pictures_last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `users_pictures_user_id` (`users_pictures_user_id`),
  CONSTRAINT `cmw_users_pictures_ibfk_1` FOREIGN KEY (`users_pictures_user_id`) REFERENCES `cmw_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_users_pictures : ~0 rows (environ)
/*!40000 ALTER TABLE `cmw_users_pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_users_pictures` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_users_roles
CREATE TABLE IF NOT EXISTS `cmw_users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `cmw_users_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cmw_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cmw_users_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `cmw_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_users_roles : ~2 rows (environ)
/*!40000 ALTER TABLE `cmw_users_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_users_roles` ENABLE KEYS */;

-- Listage de la structure de la table cininfo. cmw_users_settings
CREATE TABLE IF NOT EXISTS `cmw_users_settings` (
  `users_settings_name` varchar(255) NOT NULL,
  `users_settings_value` varchar(255) NOT NULL,
  `users_settings_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `users_settings_name` (`users_settings_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table cininfo.cmw_users_settings : ~2 rows (environ)
/*!40000 ALTER TABLE `cmw_users_settings` DISABLE KEYS */;
INSERT INTO `cmw_users_settings` (`users_settings_name`, `users_settings_value`, `users_settings_updated`) VALUES
	('defaultImage', 'defaultImage.jpg', '2022-12-28 21:52:02'),
	('resetPasswordMethod', '0', '2022-12-28 21:52:02');
/*!40000 ALTER TABLE `cmw_users_settings` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
