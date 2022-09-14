-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mar. 13 sep. 2022 à 21:52
-- Version du serveur : 10.5.8-MariaDB-1:10.5.8+maria~focal
-- Version de PHP : 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app_db`
--
DROP DATABASE IF EXISTS `app_db`;
CREATE DATABASE IF NOT EXISTS `app_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `app_db`;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment`
(
    `id`   int(11)      NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `body` longtext     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `name`, `body`)
VALUES (1, 'Limmy Lesbieraufrai', 'Le premier commentaire'),
       (2, 'Evy Damant', 'Ceci est un deuxieme contenu de commentaire');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user`
(
    `id`       int(11)      NOT NULL AUTO_INCREMENT,
    `email`    varchar(255) NOT NULL,
    `name`     varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `password`)
VALUES (1, 'ela.debonsyeux@mail.dev', 'Ela Debonsyeux', 'password');


--
-- Base de données : `hacker_db`
--
DROP DATABASE IF EXISTS `hacker_db`;
CREATE DATABASE IF NOT EXISTS `hacker_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hacker_db`;

-- --------------------------------------------------------

--
-- Structure de la table `cookie_record`
--

DROP TABLE IF EXISTS `cookie_record`;
CREATE TABLE IF NOT EXISTS `cookie_record`
(
    `id`         int(11)                                            NOT NULL AUTO_INCREMENT,
    `created_at` datetime                                           NOT NULL COMMENT '(DC2Type:datetime_immutable)',
    `data`       longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions`
(
    `version`        varchar(191) COLLATE utf8_unicode_ci NOT NULL,
    `executed_at`    datetime DEFAULT NULL,
    `execution_time` int(11)  DEFAULT NULL,
    PRIMARY KEY (`version`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`)
VALUES ('DoctrineMigrations\\Version20220914092508', '2022-09-14 09:25:19', 54);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
