-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 22 juin 2024 à 19:05
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `covoiturage_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `id_trajet` int(11) NOT NULL,
  `id_conducteur` int(11) NOT NULL,
  `id_passager` int(11) NOT NULL,
  `note` int(11) NOT NULL CHECK (`note` >= 1 and `note` <= 5),
  `commentaire` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluations`
--

INSERT INTO `evaluations` (`id`, `id_trajet`, `id_conducteur`, `id_passager`, `note`, `commentaire`, `date_creation`) VALUES
(6, 47, 13, 11, 4, 'BIEN', '2024-06-13 12:06:27'),
(7, 47, 13, 11, 4, 'BIEN', '2024-06-13 12:06:35');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 16, 'A driver has chosen your trajectory.', 0, '2024-06-21 19:35:03'),
(2, 16, 'A driver has chosen your trajectory.', 0, '2024-06-21 19:37:35'),
(3, 17, 'A driver has chosen your trajectory.', 1, '2024-06-21 19:37:39'),
(4, 17, 'A driver has chosen your trajectory.', 1, '2024-06-21 22:19:52');

-- --------------------------------------------------------

--
-- Structure de la table `trajets`
--

CREATE TABLE `trajets` (
  `id` int(11) NOT NULL,
  `depart` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `date_depart` timestamp NULL DEFAULT NULL,
  `statut` enum('proposé','choisi','validé') DEFAULT 'proposé',
  `passager_id` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `nbr_places` int(11) DEFAULT NULL,
  `date_arrivee` timestamp NULL DEFAULT NULL,
  `distance` float NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajets`
--

INSERT INTO `trajets` (`id`, `depart`, `destination`, `date_depart`, `statut`, `passager_id`, `prix`, `nbr_places`, `date_arrivee`, `distance`, `date_creation`) VALUES
(45, 'anfa', 'bouskoura', '2024-06-13 16:10:00', 'proposé', 13, NULL, NULL, '2024-06-13 17:10:00', 0, '2024-06-13 11:42:39'),
(46, 'Casablanca, Sidi Belyout, arrondissement de Sidi Belyout مقاطعة سيدي بليوط, préfecture d\'arrondissem', 'bouskoura', '2024-06-13 15:42:00', 'proposé', 13, NULL, NULL, '2024-06-13 17:42:00', 15.61, '2024-06-13 11:43:01'),
(47, 'Boulevard des Préfectures, Anfa Université, Casablanca, arrondissement de Hay Hassani مقاطعة الحي ال', 'Boulevard de Fès, Sidi Maarouf, Casablanca, Zénith, arrondissement de Hay Hassani مقاطعة الحي الحسني', '2024-06-13 12:00:00', 'validé', 11, 5.99, NULL, '2024-06-13 13:00:00', 0.6, '2024-06-13 12:00:43'),
(48, 'Casablanca, Sidi Belyout, arrondissement de Sidi Belyout مقاطعة سيدي بليوط, préfecture d\'arrondissem', 'bouskoura', '2024-06-13 12:16:00', 'proposé', 11, 156.13, NULL, '2024-06-13 16:16:00', 15.61, '2024-06-13 12:16:26'),
(49, 'Ouarzazate, Pachalik d\'Ouarzazate, Province de Ouarzazate, Drâa-Tafilalet, Maroc', 'casablanca', '2024-06-17 11:31:00', 'proposé', 16, 3047.53, NULL, '2024-06-17 17:32:00', 304.75, '2024-06-17 11:32:56'),
(50, 'Ouarzazate, Pachalik d\'Ouarzazate, Province de Ouarzazate, Drâa-Tafilalet, Maroc', 'casablanca', '2024-06-17 11:31:00', 'proposé', 16, 3047.53, NULL, '2024-06-17 17:32:00', 304.75, '2024-06-17 11:34:34'),
(51, 'tanger', 'fes', '2024-06-10 11:34:00', 'proposé', 16, 2058.41, NULL, '2024-06-17 14:34:00', 205.84, '2024-06-17 11:35:09'),
(52, 'Dar Bouazza, Pachalik Dar Bouazza, Province de Nouaceur, Casablanca-Settat, 27223, Maroc', 'Médiouna, Pachalik de Médiouna, Province de Médiouna, Casablanca-Settat, 29490, Maroc', '2024-06-17 16:35:00', 'proposé', 16, 284.84, NULL, '2024-06-17 14:35:00', 28.48, '2024-06-17 11:35:46'),
(53, 'hay hassani ', 'bouskoura', '2024-06-05 11:35:00', 'proposé', 17, 0.00, NULL, '2024-06-05 12:35:00', 0, '2024-06-21 19:35:45'),
(54, 'Casablanca', 'Fès', '2024-06-21 19:37:00', 'proposé', 17, 0.00, NULL, '2024-06-21 13:37:00', 0, '2024-06-21 19:37:19');

-- --------------------------------------------------------

--
-- Structure de la table `trajets_conducteurs`
--

CREATE TABLE `trajets_conducteurs` (
  `id` int(11) NOT NULL,
  `trajet_id` int(11) DEFAULT NULL,
  `conducteur_id` int(11) DEFAULT NULL,
  `choisi` tinyint(1) DEFAULT 0,
  `valide` tinyint(1) DEFAULT 0,
  `annuler` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajets_conducteurs`
--

INSERT INTO `trajets_conducteurs` (`id`, `trajet_id`, `conducteur_id`, `choisi`, `valide`, `annuler`) VALUES
(126, 47, 13, 0, 1, 0),
(127, 47, 2, 1, 0, 0),
(129, 48, 13, 0, 0, 1),
(130, 49, 13, 1, 0, 0),
(134, 54, 13, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` enum('administrateur','passager','conducteur') DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp(),
  `prenom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `mot_de_passe`, `role`, `telephone`, `adresse`, `date_naissance`, `date_inscription`, `prenom`) VALUES
(1, 'hajar', 'hajar2000@gmail.com', '$2y$10$IhVJpBArAkA.Qh1LoVVzheJvx5myKaqzvQ2FotKBln/tQN43qsB0S', 'passager', NULL, NULL, NULL, '2024-05-20 13:05:43', NULL),
(2, 'ikram', 'amineikram3002@gmail.com', '$2y$10$1SKGRAI0rVFZn4qKOsy5du0n/zwFe9FB4gEzB28C1QBvPpRz/7qXG', 'conducteur', NULL, NULL, NULL, '2024-05-20 13:05:43', NULL),
(6, 'Amine', 'doniadn@gmail.com', '$2y$10$C0zf.2klXkWKwxLGRivPLeGr.ZIgab7/pLICX42wKDY7FkQCTvOFy', 'passager', '0698342665', 'El messoudia CD CASA', '2024-05-20', '2024-05-20 13:10:55', 'Donia'),
(7, 'AMINE', 'amine@gmail.com', '$2y$10$PC9D.8RxrS5OYppeHcoRtOmddWsf0yaZGylAD3MUSdFTJQWbgCdSa', 'passager', '064445567', 'AIN CHOUK', '2024-05-06', '2024-05-21 12:58:46', 'amine'),
(8, 'zahia', 'zahia@gmail.com', '$2y$10$8t8Y9Nw0l4d7wWgaMhzx9.vaouTpEqy8gNItxmfTkv69wvWxWmnZW', 'conducteur', '064445567', 'AIN CHOUK', '2024-05-07', '2024-05-21 13:12:00', 'said'),
(10, 'admin', 'admin@gmail.com', '$2y$10$6.gH3Svr6YOA5MujjiuhcODrOJDKbH0qdR1/zMkMWkmW3tajAOy4u', 'administrateur', '0701887150', 'Bouskoura Casablanca', '2024-06-10', '2024-06-12 15:09:46', 'admin'),
(11, 'passager', 'passager@gmail.com', '$2y$10$5BfYZYRava./kyZ.unAZm.8MeLclF.k4rIOS8E5U6qSHOb7huC/T2', 'passager', '0701887150', 'Bouskoura Casablanca', '2004-10-13', '2024-06-12 21:01:00', 'ikram'),
(13, 'conducteur', 'conducteur@gmail.com', '$2y$10$1i4E2m0lNaflrMgG5fUA1epxZfMpljDRYlV/wuY7s8v.2fNDPnP1S', 'conducteur', '0701887150', 'Bouskoura Casablanca', '2000-06-04', '2024-06-13 10:37:00', 'chaimaa'),
(16, 'passager', 'passager12@gmail.com', '$2y$10$MzZEGMooZqaSx9G0Qj7V9.MMKYIJk/Eeeeq1obElN4aodkFKZbldm', 'passager', '1234567890', 'casablanca', '2024-06-05', '2024-06-17 11:30:41', 'anouar'),
(17, 'chaimaa', 'sofia@gmail.com', '$2y$10$Af3BqF9O80cnr0i2/FeOKO4RRO3I67rd4JR2W8FGxsfzChq.nlYie', 'passager', '1234567890', 'ANFA', '2024-06-03', '2024-06-21 19:24:29', 'passager');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `id` int(11) NOT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `modele` varchar(50) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `couleur` varchar(20) DEFAULT NULL,
  `prix_km` float DEFAULT NULL,
  `conducteur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trajet` (`id_trajet`),
  ADD KEY `id_conducteur` (`id_conducteur`),
  ADD KEY `id_passager` (`id_passager`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `trajets`
--
ALTER TABLE `trajets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passager_id` (`passager_id`);

--
-- Index pour la table `trajets_conducteurs`
--
ALTER TABLE `trajets_conducteurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_trajet_conducteur` (`trajet_id`,`conducteur_id`),
  ADD KEY `conducteur_id` (`conducteur_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conducteur_id` (`conducteur_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `trajets`
--
ALTER TABLE `trajets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `trajets_conducteurs`
--
ALTER TABLE `trajets_conducteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`id_trajet`) REFERENCES `trajets` (`id`),
  ADD CONSTRAINT `evaluations_ibfk_2` FOREIGN KEY (`id_conducteur`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `evaluations_ibfk_3` FOREIGN KEY (`id_passager`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `trajets`
--
ALTER TABLE `trajets`
  ADD CONSTRAINT `trajets_ibfk_1` FOREIGN KEY (`passager_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `trajets_conducteurs`
--
ALTER TABLE `trajets_conducteurs`
  ADD CONSTRAINT `trajets_conducteurs_ibfk_1` FOREIGN KEY (`trajet_id`) REFERENCES `trajets` (`id`),
  ADD CONSTRAINT `trajets_conducteurs_ibfk_2` FOREIGN KEY (`conducteur_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD CONSTRAINT `voitures_ibfk_1` FOREIGN KEY (`conducteur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
