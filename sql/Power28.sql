-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  sam. 02 juin 2018 à 21:04
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Power28`
--

-- --------------------------------------------------------

--
-- Structure de la table `article_category`
--

CREATE TABLE `article_category` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `category_id`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 1, 1),
(4, 2, 4),
(5, 3, 4),
(6, 5, 4),
(7, 6, 4),
(8, 7, 2),
(9, 8, 1),
(10, 14, 1),
(11, 14, 2),
(12, 14, 4),
(13, 15, 2),
(14, 16, 3),
(15, 17, 3),
(16, 18, 2),
(17, 19, 2),
(18, 20, 3),
(19, 21, 3),
(20, 22, 1),
(21, 23, 1),
(22, 24, 1),
(23, 31, 3),
(24, 32, 3),
(25, 33, 3),
(26, 35, 2),
(27, 36, 1),
(28, 37, 1),
(29, 38, 2),
(30, 39, 2),
(31, 40, 3),
(32, 41, 2),
(33, 42, 2),
(34, 43, 2),
(35, 44, 2),
(36, 45, 2),
(37, 46, 3),
(38, 47, 3),
(39, 48, 1),
(40, 49, 3),
(41, 50, 1),
(42, 51, 1),
(43, 52, 1),
(44, 53, 1),
(45, 54, 2),
(46, 55, 2),
(47, 56, 2),
(48, 57, 2),
(49, 58, 1),
(50, 59, 2),
(51, 60, 2),
(52, 61, 3),
(53, 62, 2),
(54, 63, 2),
(55, 64, 1),
(56, 65, 1),
(57, 66, 1),
(58, 67, 1),
(59, 3, 2),
(60, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Cinéma', 'Trailers, infos, sorties...', NULL),
(2, 'Musique', 'Concerts, sorties d\'albums, festivals...', NULL),
(3, 'Théâtre', '', NULL),
(4, 'Jeux vidéos', 'Videos, tests...', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `screen`
--

CREATE TABLE `screen` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` date NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `screen`
--

INSERT INTO `screen` (`id`, `title`, `content`, `created_at`, `image`) VALUES
(0, 'Power28-accueil.png', 'Accueil et menu simplifié pour une navigation plus rapide.', '2018-05-27', 'Power28-accueil.png'),
(1, 'Power28-catalogue-1.png', 'Power28 contient votre catalogue produit. Chaque produit possède des caractéristiques propres et est lié à toutes les transactions de stock, entrées et sorties utiles à la gestion de votre stock.', '2018-05-27', 'Power28-catalogue-1.png'),
(2, 'Power28-catalogue-2.png', 'Chaque produit du catalogue peut contenir un nombre important de caractéristiques physiques ou financières utiles à la valorisation du stock. Les produits peuvent également être liés à une catégorie, un fabricant ou un ou plusieurs fournisseurs (grâce aux références fournisseurs *image n°5).', '2018-05-27', 'Power28-catalogue-2.png'),
(3, 'Power28-catalogue-3.png', 'Il est possible de consulter toutes les transactions de stock, entrées ou sorties, à partir d\'un produit du catalogue. Il vous est également possible de débiter ou créditer le stock à partir de cet endroit, manuellement ou par scan.', '2018-05-28', 'Power28-catalogue-3.png'),
(4, 'Power28-catalogue-4.png', 'Chaque produit du catalogue est lié à un ou plusieurs fournisseurs grâce aux références fournisseurs. Elles sont utiles à la mémorisation des informations financières de chaque produit. Ces références fournisseurs sont également utilisées dans les commandes pour accélérer votre processus de commande et connaître le montant de votre commande avant envoi au fournisseur. ', '2018-05-28', 'Power28-catalogue-4.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(225) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `is_admin`, `bio`) VALUES
(30, 'Admin', 'TheBrickBox', 'admin@thebrickbox.net', 'b53759f3ce692de7aff1b5779d3964da', 1, 'admin du blog'),
(31, 'User', 'TheBrickBox', 'user@thebrickbox.net', 'b53759f3ce692de7aff1b5779d3964da', 0, 'utilisateur du blog');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `screen`
--
ALTER TABLE `screen`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `screen`
--
ALTER TABLE `screen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
