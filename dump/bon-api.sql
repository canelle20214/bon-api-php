-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 04 avr. 2022 à 15:33
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bon-api`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  `status` varchar(100) NOT NULL,
  `insertion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `numero_de_table`
--

DROP TABLE IF EXISTS `numero_de_table`;
CREATE TABLE IF NOT EXISTS `numero_de_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_de_personnes` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `numero_de_table_reservation`
--

DROP TABLE IF EXISTS `numero_de_table_reservation`;
CREATE TABLE IF NOT EXISTS `numero_de_table_reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservation_id` int NOT NULL,
  `numero_de_table_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numero_de_table_id` (`numero_de_table_id`),
  KEY `reservation_id` (`reservation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

DROP TABLE IF EXISTS `plat`;
CREATE TABLE IF NOT EXISTS `plat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `plat`
--

INSERT INTO `plat` (`id`, `nom`, `prix`, `image`, `description`) VALUES
(2, 'Fourmis rouges avec du boeuf et du basilic', 25.6, 'https://www.mamawax.fr/img/cms/banniere-conseils-fourmis-rouges.jpg', 'Des fourmis de différentes tailles, dont certaines sont à peine visibles et d\'autres de presque un pouce de long, sont sautés avec du gingembre, de la citronnelle, de l\'ail, des échalotes et du bœuf émincé.\r\n\r\nBeaucoup de piments complètent le plat aromatique, sans dominer la saveur aigre délicate que les fourmis donnent au bœuf.\r\n\r\nCe repas est servi avec du riz, et si vous êtes chanceux, vous aurez aussi une partie de larves de fourmis dans votre bol.');

-- --------------------------------------------------------

--
-- Structure de la table `plat_commande`
--

DROP TABLE IF EXISTS `plat_commande`;
CREATE TABLE IF NOT EXISTS `plat_commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plat_id` int NOT NULL,
  `commande_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plat_id` (`plat_id`),
  KEY `commande_id` (`commande_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL,
  `nom` int NOT NULL,
  `nombre_de_personnes` int NOT NULL,
  `creneaux` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
