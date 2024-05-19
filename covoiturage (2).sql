-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 mai 2024 à 02:44
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
-- Base de données : `covoiturage`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_admin` int(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` int(10) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

CREATE TABLE `conducteur` (
  `id_cond` int(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` int(10) NOT NULL,
  `voiture` varchar(255) NOT NULL,
  `nbrplace` int(10) NOT NULL,
  `prix_km/h` float NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conducteur`
--

INSERT INTO `conducteur` (`id_cond`, `nom`, `prenom`, `email`, `telephone`, `voiture`, `nbrplace`, `prix_km/h`, `login`, `mdp`) VALUES
(1, 'amine', 'ikram', 'amineikram@gmail.com', 6123445, '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `id_passager` int(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` int(10) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`id_passager`, `nom`, `prenom`, `email`, `telephone`, `login`, `mdp`) VALUES
(1, 'Dari', 'Donia', 'doniadari__@gmail.com', 6123897, '', ''),
(2, 'AMINE', 'AMINE', 'AMINEIIM@gmail.com', 61298463, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `id_trajet` int(10) NOT NULL,
  `lieu_depart` varchar(255) NOT NULL,
  `lieu_darrivee` varchar(255) NOT NULL,
  `date_heure_depart` date NOT NULL,
  `statut` enum('proposé','choisi','validé','') NOT NULL,
  `id_cond` int(10) NOT NULL,
  `id_passager` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`id_trajet`, `lieu_depart`, `lieu_darrivee`, `date_heure_depart`, `statut`, `id_cond`, `id_passager`) VALUES
(1, 'EL Qods', 'Hay Hassani', '2024-05-08', 'choisi', 1, 1),
(2, 'ANFA', 'SEBATA', '2024-05-29', 'choisi', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `trajets_conducteurs`
--

CREATE TABLE `trajets_conducteurs` (
  `id` int(11) NOT NULL,
  `id_trajet` int(11) DEFAULT NULL,
  `id_conducteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajets_conducteurs`
--

INSERT INTO `trajets_conducteurs` (`id`, `id_trajet`, `id_conducteur`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 2, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `conducteur`
--
ALTER TABLE `conducteur`
  ADD PRIMARY KEY (`id_cond`);

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`id_passager`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD UNIQUE KEY `id_passager` (`id_passager`),
  ADD KEY `id_cond` (`id_cond`);

--
-- Index pour la table `trajets_conducteurs`
--
ALTER TABLE `trajets_conducteurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trajet` (`id_trajet`),
  ADD KEY `id_conducteur` (`id_conducteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `trajets_conducteurs`
--
ALTER TABLE `trajets_conducteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `trajets_conducteurs`
--
ALTER TABLE `trajets_conducteurs`
  ADD CONSTRAINT `trajets_conducteurs_ibfk_1` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id_trajet`),
  ADD CONSTRAINT `trajets_conducteurs_ibfk_2` FOREIGN KEY (`id_conducteur`) REFERENCES `conducteur` (`id_cond`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
