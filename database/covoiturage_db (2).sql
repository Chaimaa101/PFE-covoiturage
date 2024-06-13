-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 juin 2024 à 14:05
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
  `commentaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trajets`
--

CREATE TABLE `trajets` (
  `id` int(11) NOT NULL,
  `depart` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `date_depart` date DEFAULT NULL,
  `statut` enum('proposé','choisi','validé') DEFAULT 'proposé',
  `passager_id` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `nbr_places` int(11) DEFAULT NULL,
  `date_arrivee` date DEFAULT NULL,
  `distance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(8, 'zahia', 'zahia@gmail.com', '$2y$10$8t8Y9Nw0l4d7wWgaMhzx9.vaouTpEqy8gNItxmfTkv69wvWxWmnZW', 'conducteur', '064445567', 'AIN CHOUK', '2024-05-07', '2024-05-21 13:12:00', 'said');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `trajets`
--
ALTER TABLE `trajets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `trajets_conducteurs`
--
ALTER TABLE `trajets_conducteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
