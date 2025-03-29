-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 29 mars 2025 à 15:51
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `food_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'DESSERTS'),
(2, 'SALADES'),
(3, 'VENOISERIE'),
(4, 'Cuisine africaine');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `serveur_id` int(11) DEFAULT 0,
  `validated_at` datetime DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `scheduled_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `name`, `client_id`, `serveur_id`, `validated_at`, `cancelled_at`, `scheduled_at`, `created_at`, `updated_at`) VALUES
(1, '4952', NULL, 0, NULL, NULL, NULL, '2025-03-29 14:29:10', '2025-03-29 14:29:10'),
(2, '2246', NULL, 0, NULL, NULL, NULL, '2025-03-29 14:36:58', '2025-03-29 14:36:58'),
(3, '3689', NULL, 0, NULL, NULL, NULL, '2025-03-29 14:49:03', '2025-03-29 14:49:03');

-- --------------------------------------------------------

--
-- Structure de la table `lignes`
--

CREATE TABLE `lignes` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `pu` double DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lignes`
--

INSERT INTO `lignes` (`id`, `commande_id`, `menu_id`, `pu`, `quantity`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 3200, 2, 1, '2025-03-29 14:29:10', '2025-03-29 14:29:10'),
(2, 2, 3, 4100, 3, 1, '2025-03-29 14:36:58', '2025-03-29 14:36:58'),
(3, 3, 8, 4500, 37, 1, '2025-03-29 14:49:03', '2025-03-29 14:49:03');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pu` double DEFAULT 0,
  `category_id` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `pu`, `category_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Salade d\'avocat', 'Salade faite a base d\'avocat', 4000, 2, 1, NULL, NULL),
(2, 'Poulet Mayo', 'Petite recette de poulet a la mayonnaise', 7000, 4, 1, '2025-03-01 14:32:15', '2025-03-01 14:32:15'),
(3, 'Saka Saka', 'Mets africain, congolais en particulier fait a base de feuille de manioc', 9500, 4, 0, '2025-03-01 14:32:15', '2025-03-22 15:08:49'),
(4, 'Mix papaye & ananas modif', 'Une petite salade de fruits faite de papaye et d\'ananas avec modification', 1850, 1, 1, '2025-02-28 15:12:12', '2025-03-08 14:39:27'),
(5, 'ngoulou banane', 'Un plat de ngoulou', 5350, 3, 0, '2025-03-08 13:41:26', '2025-03-08 14:23:21'),
(6, 'ngoulou', 'Un plat de ngoulou h', 15500, 3, 1, '2025-03-08 13:43:40', '2025-03-22 14:43:35'),
(7, 'ngoulou', 'Un plat de ngoulou', 15500, 4, 0, '2025-03-08 13:44:30', '2025-03-22 15:08:45'),
(8, 'Haricots a la sauce tomate', 'Plat de haricot a la sauce tomate', 5000, 4, 1, '2025-03-08 13:46:40', '2025-03-08 14:39:24');

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `male` tinyint(1) DEFAULT 1,
  `image_url` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrateur'),
(2, 'Manager');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `photo` varchar(50) DEFAULT NULL,
  `role_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `active`, `photo`, `role_id`) VALUES
(1, 'alban Malonga', 'a.malonga@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 1, NULL, 1),
(2, 'armel housta', 'a.housta@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 1, NULL, 2),
(3, 'ange Nambila', 'a.nambila@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', NULL, NULL, 1, NULL, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignes`
--
ALTER TABLE `lignes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `lignes`
--
ALTER TABLE `lignes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `profils`
--
ALTER TABLE `profils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
