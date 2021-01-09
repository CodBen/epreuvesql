-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 déc. 2020 à 14:44
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wf3_php_intermediaire_benjamin`
--

-- --------------------------------------------------------

--
-- Structure de la table `advert`
--

CREATE TABLE `advert` (
  `id` int(11) NOT NULL,
  `title` varchar(160) NOT NULL,
  `description` varchar(160) NOT NULL,
  `postal_code` int(6) NOT NULL,
  `city` varchar(60) NOT NULL,
  `type` varchar(160) NOT NULL,
  `price` int(11) NOT NULL,
  `reservation_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `advert`
--

INSERT INTO `advert` (`id`, `title`, `description`, `postal_code`, `city`, `type`, `price`, `reservation_message`) VALUES
(5, 'tfAEZFzef', 'FZEFzefZEF', 25252, 'Fzefzdf', 'vente', 55, 'azfcaedaz'),
(6, 'Maison dans les bois', 'Cette maison se situe dans les bois au nord de Marseille', 13013, 'Marseille', 'location', 500, 'reservation_message'),
(7, 'Maison au calme', 'La maison se situe dans un quartier calme de Marseille', 13009, 'Marseille', 'location', 800, 'reservation_message'),
(8, 'Maison abandonnée', 'La maison nécessite de nombreux travaux', 13010, 'Marseille', 'vente', 50, 'reservation_message'),
(9, 'Maison élégante', 'Cette maison est splendide', 13008, 'Marseille', 'location', 900, 'reservation_message'),
(10, 'Maison mitoyenne', 'Maison sympathique pour locataires sociables', 13003, 'Marseille', 'location', 450, 'reservation_message'),
(11, 'Appartement tranquille', 'Appartement sympathique', 13005, 'Marseille', 'vente', 600, 'reservation_message'),
(12, 'Studio', 'Studio pour étudiant', 13006, 'Marseille', 'vente', 50, 'reservation_message'),
(13, 'Tente dans la ville', 'Petite tente à louer', 13001, 'Marseille', 'location', 100, 'reservation_message'),
(14, 'Appartement buyant', 'Appartement pour jeunes fêtards', 13008, 'Marseille', 'vente', 150, 'reservation_message'),
(15, 'Maison simple', 'Maison simple', 13005, 'Marseille', 'location', 500, 'reservation_message'),
(16, 'Maison au top', 'Le top du top', 13006, 'Marseille', 'vente', 500, 'reservation_message'),
(17, 'Appartement miteux', 'Pour crados', 13012, 'Marseille', 'location', 200, 'reservation_message'),
(18, 'Logement insalubre', 'Pour personnes négligées seulement', 13015, 'Marseille', 'location', 600, 'reservation_message'),
(19, 'Billets pour les états unis', 'Gratuit', 13003, 'Marseille', 'location', 0, 'agfzefdazdaz'),
(20, 'appart dans le 16ème', '16ème', 13016, 'Marseille', 'location', 500, 'ZGZQRGF'),
(21, 'Dernier test avant rendu', 'test', 130000, 'affAEZFAE', 'location', 75, 'FFFFFFFF');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
