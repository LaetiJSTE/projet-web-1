-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 27 sep. 2022 à 00:41
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stampee2`
--

-- --------------------------------------------------------

--
-- Structure de la table `a_pour_favoris`
--

DROP TABLE IF EXISTS `a_pour_favoris`;
CREATE TABLE IF NOT EXISTS `a_pour_favoris` (
  `a_pour_favoris_uti_id` int(10) UNSIGNED NOT NULL,
  `a_pour_favoris_echre_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`a_pour_favoris_uti_id`,`a_pour_favoris_echre_id`),
  KEY `a_pour_favoris_echre_id` (`a_pour_favoris_echre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `echre_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `echre_prix` varchar(50) NOT NULL,
  `echre_PrixMise` varchar(50) DEFAULT NULL,
  `echre_dateDebut` varchar(50) NOT NULL,
  `echre_dateFin` varchar(50) NOT NULL,
  `echre_nombre` smallint(6) DEFAULT NULL,
  `echre_favoris` smallint(6) DEFAULT NULL,
  `echre_uti_id` int(11) NOT NULL,
  `echre_tmbe_id` int(11) NOT NULL,
  PRIMARY KEY (`echre_id`),
  KEY `echre_uti_id` (`echre_uti_id`),
  KEY `echre_tmbe_id` (`echre_tmbe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`echre_id`, `echre_prix`, `echre_PrixMise`, `echre_dateDebut`, `echre_dateFin`, `echre_nombre`, `echre_favoris`, `echre_uti_id`, `echre_tmbe_id`) VALUES
(4, '09832', '0', '1994', '2003', 0, 0, 1, 3),
(3, '60', '0', '2022-09-23', '2022-09-26', 0, 0, 1, 2),
(5, '6', '0', '1994', '2003', 0, 0, 1, 4),
(6, '6', '0', '1994', '2003', 0, 0, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `img_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `img_nom` varchar(150) NOT NULL,
  `img_tmbe_id` int(11) NOT NULL,
  PRIMARY KEY (`img_id`),
  KEY `img_tmbe_id` (`img_tmbe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`img_id`, `img_nom`, `img_tmbe_id`) VALUES
(5, 'timbre.jpg', 3),
(6, 'timbre2.jpg', 4),
(4, 'timbre5.jpg', 2),
(7, 'timbresimone.jpg', 5);

-- --------------------------------------------------------

--
-- Structure de la table `mise`
--

DROP TABLE IF EXISTS `mise`;
CREATE TABLE IF NOT EXISTS `mise` (
  `mise_uti_id` int(10) UNSIGNED NOT NULL,
  `mise_echre_id` int(10) UNSIGNED NOT NULL,
  `nbe_mise` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mise_uti_id`,`mise_echre_id`),
  KEY `mise_echre_id` (`mise_echre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(150) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `timbre`
--

DROP TABLE IF EXISTS `timbre`;
CREATE TABLE IF NOT EXISTS `timbre` (
  `tmbe_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tmbe_nom` varchar(150) NOT NULL,
  `tmbe_creation` varchar(50) NOT NULL,
  `tmbe_pays` varchar(255) NOT NULL,
  `tmbe_couleurs` varchar(50) NOT NULL,
  `tmbe_conditions` varchar(255) DEFAULT NULL,
  `tmbe_dimensions` varchar(150) NOT NULL,
  `tmbe_certifie` varchar(50) NOT NULL DEFAULT '0',
  `tmbe_uti_id` int(11) NOT NULL,
  PRIMARY KEY (`tmbe_id`),
  KEY `tmbe_uti_id` (`tmbe_uti_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `timbre`
--

INSERT INTO `timbre` (`tmbe_id`, `tmbe_nom`, `tmbe_creation`, `tmbe_pays`, `tmbe_couleurs`, `tmbe_conditions`, `tmbe_dimensions`, `tmbe_certifie`, `tmbe_uti_id`) VALUES
(3, 'je suis un autre timbre', '27232', 'allemagne', 'rouge', 'tres bon', '40x55', 'non', 1),
(2, 'timbre', '2000', 'france', 'bleu', 'tres bon', '6x6', 'non', 1),
(4, 'timbre', '3434', 'canada', 'jaune', 'bon', '9x92', 'oui', 1),
(5, 'a', '2000', 'a', 'a', 'tres bon', '6', 'oui', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `uti_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uti_mdp` varchar(255) NOT NULL,
  `uti_nom` varchar(255) NOT NULL,
  `uti_courriel` varchar(255) NOT NULL,
  `uti_role_id` int(11) NOT NULL,
  PRIMARY KEY (`uti_id`),
  KEY `uti_role_id` (`uti_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`uti_id`, `uti_mdp`, `uti_nom`, `uti_courriel`, `uti_role_id`) VALUES
(1, '$2y$10$0/6HvoOtNicQVWisymnMbe9MbWnMs/eANSY3s1OipLzNrGWiskQiW', 'a', 'a@a.com', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
