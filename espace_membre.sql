-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 20 juil. 2020 à 14:48
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `password`, `email`) VALUES
(11, 'lafatra Sam', '90283840d90de49b8e7984bd99b47fee0d4bd50d', 'rasamizafybryan98@icloud.com'),
(12, 'Bryan', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'rasamizafybryan98@gmail.co'),
(14, 'tsiky lafatra', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'rasamizafybryan98@gmail.com'),
(15, 'RasamizafyB', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'asamizafybryan98@gmail.com'),
(16, 'Rasamizafy', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'rsamizafybryan98@gmail.com'),
(18, 'bry', '0c9d125b39f8a674cee51c774d4f144fc452ab31', 'bry98@gmail.com'),
(19, 'bry98', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'brybry98@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
