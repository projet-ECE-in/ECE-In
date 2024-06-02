-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : dim. 02 juin 2024 à 21:30
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecein`
--

-- --------------------------------------------------------

--
-- Structure de la table `aime`
--

DROP TABLE IF EXISTS `aime`;
CREATE TABLE IF NOT EXISTS `aime` (
  `id_post` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `aime_state` int NOT NULL,
  PRIMARY KEY (`id_post`,`id_utilisateur`),
  KEY `aime_utilisateur0_FK` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `aime`
--

INSERT INTO `aime` (`id_post`, `id_utilisateur`, `aime_state`) VALUES
(33, 12, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

DROP TABLE IF EXISTS `ami`;
CREATE TABLE IF NOT EXISTS `ami` (
  `id_utilisateur` int NOT NULL,
  `id_utilisateur_ami` int NOT NULL,
  `ami_accept` int DEFAULT NULL,
  `date_accept` date NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_utilisateur_ami`),
  KEY `ami_utilisateur0_FK` (`id_utilisateur_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ami`
--

INSERT INTO `ami` (`id_utilisateur`, `id_utilisateur_ami`, `ami_accept`, `date_accept`) VALUES
(12, 1, 1, '2023-06-04'),
(12, 13, 1, '2023-06-05'),
(13, 14, 1, '2023-06-04'),
(14, 12, 1, '2023-06-05'),
(14, 15, 1, '2023-06-05'),
(15, 12, 1, '2023-06-04');

-- --------------------------------------------------------

--
-- Structure de la table `candidater`
--

DROP TABLE IF EXISTS `candidater`;
CREATE TABLE IF NOT EXISTS `candidater` (
  `offer_id` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `candidat_accept` int DEFAULT NULL,
  PRIMARY KEY (`offer_id`,`id_utilisateur`),
  KEY `candidater_utilisateur0_FK` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `comment_content` longtext NOT NULL,
  `comment_date` date NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_post` int NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `comment_utilisateur_FK` (`id_utilisateur`),
  KEY `comment_post0_FK` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enregistrer`
--

DROP TABLE IF EXISTS `enregistrer`;
CREATE TABLE IF NOT EXISTS `enregistrer` (
  `offer_id` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `save_state` int NOT NULL,
  PRIMARY KEY (`offer_id`,`id_utilisateur`),
  KEY `enregistrer_utilisateur0_FK` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `envoyer`
--

DROP TABLE IF EXISTS `envoyer`;
CREATE TABLE IF NOT EXISTS `envoyer` (
  `messages_id` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`messages_id`,`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `messages_id` int NOT NULL AUTO_INCREMENT,
  `user_receptor` int DEFAULT NULL,
  `user_sender` int DEFAULT NULL,
  `message` longtext,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `link` longtext,
  `user_pseudo` varchar(255) NOT NULL,
  PRIMARY KEY (`messages_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notification` int NOT NULL AUTO_INCREMENT,
  `notif_content` longtext NOT NULL,
  `notif_date` date NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_post` int NOT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `notification_utilisateur_FK` (`id_utilisateur`),
  KEY `notification_post0_FK` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offer`
--

DROP TABLE IF EXISTS `offer`;
CREATE TABLE IF NOT EXISTS `offer` (
  `offer_id` int NOT NULL AUTO_INCREMENT,
  `offer_date` date NOT NULL,
  `offer_content` longtext NOT NULL,
  `offer_type` varchar(255) NOT NULL,
  `offer_location` varchar(255) NOT NULL,
  `offer_domain` varchar(255) NOT NULL,
  `id_utilisateur` int NOT NULL,
  `offer_salaire` int NOT NULL,
  PRIMARY KEY (`offer_id`),
  KEY `offer_utilisateur_FK` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offer`
--

INSERT INTO `offer` (`offer_id`, `offer_date`, `offer_content`, `offer_type`, `offer_location`, `offer_domain`, `id_utilisateur`, `offer_salaire`) VALUES
(1, '2024-06-05', 'Offre d\'emploi dans la robotique.', 'emploi', 'Paris', 'Robotique', 0, 39000),
(2, '2024-06-08', 'Offre d\'emploi dans la Big Data.', 'emploi', 'Genève', 'Big_data', 0, 35000),
(3, '2024-05-29', 'Offre de stage dans l\'aéronautique.', 'stage', 'Londres', 'Aéronautique', 0, 1200),
(5, '2024-06-04', 'Offre de stage dans la cybersécurité.', 'stage', 'Marseille', 'Cybersécurité', 0, 1100);

-- --------------------------------------------------------

--
-- Structure de la table `partager`
--

DROP TABLE IF EXISTS `partager`;
CREATE TABLE IF NOT EXISTS `partager` (
  `id_post` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_post`,`id_utilisateur`),
  KEY `partager_utilisateur0_FK` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `post_image` varchar(255) DEFAULT NULL,
  `post_video` varchar(255) DEFAULT NULL,
  `post_cv` varchar(255) DEFAULT NULL,
  `post_location` varchar(255) DEFAULT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `post0_event1` int NOT NULL,
  `post_confid` int NOT NULL,
  `post_fic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `post_utilisateur_FK` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `post_image`, `post_video`, `post_cv`, `post_location`, `post_date`, `post_content`, `post0_event1`, `post_confid`, `post_fic`, `id_utilisateur`) VALUES
(27, '../Images/asso.webp', NULL, NULL, NULL, '2024-06-02 20:59:41', 'Présentation des associations 2024', 0, 0, NULL, 12),
(28, '../Images/welcome_day.jpg', NULL, NULL, NULL, '2024-05-31 00:00:00', 'Welcome Day', 1, 0, NULL, 1),
(29, '../Images/campus.webp', NULL, NULL, NULL, '2024-06-01 01:43:11', 'Welcome Day', 1, 0, NULL, 1),
(30, '../Images/ambassadeurs.webp', NULL, NULL, NULL, '2024-05-30 01:45:16', 'Welcome Day', 1, 0, NULL, 1),
(31, '../Images/bds.webp', NULL, NULL, NULL, '2024-06-02 21:33:31', 'Billeterie BDS 2024', 0, 0, NULL, 12),
(32, '../Images/cv_coco.jpg', NULL, NULL, NULL, '2024-06-02 21:37:05', 'Je cherche un emploi en tant qu\'ingénieur. Voici mon cv.', 0, 0, NULL, 15),
(33, '../Images/bde.webp', NULL, NULL, NULL, '2024-06-02 21:37:06', 'Voici notre nouveau BDE pour l\'année 2024 à l\'ECE Paris !', 0, 0, NULL, 14);

-- --------------------------------------------------------

--
-- Structure de la table `receptionner`
--

DROP TABLE IF EXISTS `receptionner`;
CREATE TABLE IF NOT EXISTS `receptionner` (
  `id_utilisateur` int NOT NULL,
  `messages_id` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`messages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `utilisateur_firstname` varchar(255) NOT NULL,
  `utilisateur_lastname` varchar(255) NOT NULL,
  `utilisateur_mail` varchar(255) NOT NULL,
  `utilisateur_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `utilisateur_pseudo` varchar(255) NOT NULL,
  `utilisateur_password` varchar(255) NOT NULL,
  `utilisateur_profile_picture` varchar(255) NOT NULL,
  `utilisateur_background_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `utilisateur_birthday` date NOT NULL,
  `utilisateur_cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `utilisateur_xml` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `utilisateur_role` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `utilisateur_firstname`, `utilisateur_lastname`, `utilisateur_mail`, `utilisateur_phone`, `utilisateur_pseudo`, `utilisateur_password`, `utilisateur_profile_picture`, `utilisateur_background_img`, `utilisateur_birthday`, `utilisateur_cv`, `utilisateur_xml`, `utilisateur_role`) VALUES
(1, 'ECE', 'Paris', 'ece.paris@ece.fr', NULL, 'ECE_Paris', '$2y$10$bd3rh3L9/Qfpv0rp4ARRFO9lvncMuvwqz7i4DMlmfBKXUefVN8FGy', '../../images/profile_pic/photoProfileECE_Paris.jpg', '../../images/wpp/backgroundECE_Paris.jpg', '1990-10-17', NULL, NULL, 1),
(12, '', '', 'timothee.wyrzykowski@edu.ece.fr', NULL, 'Sitaar', '$2y$10$XRFq1HwZC4Gci.6NMO92u.hXwE6mhxuWlO3adhTraNAZTJR9KBd.G', '../Images/img_profil.png', NULL, '0000-00-00', NULL, NULL, 0),
(13, '', '', 'maxence.ozog@edu.ece.fr', NULL, 'Max', '$2y$10$/poIKQT8H9zxViu/JcC9wuNRRCMuPvAe.wjsjUCAQu4mACrHSoBhC', '../Images/img_profil4.png', NULL, '0000-00-00', NULL, NULL, 0),
(14, '', '', 'alban.jaud@edu.ece.fr', NULL, 'alban', '$2y$10$TCc6Z1r.3pOtopfdu0oqoubt.GLcdXjUPxS7H0X5YV.US3CFHgRDK', '../Images/img_profil3.png', NULL, '0000-00-00', NULL, NULL, 0),
(15, '', '', 'corentin.chappuis@edu.ece.fr', NULL, 'coco', '$2y$10$OJnT75Al6S9N0.KHubo4eOS0dK0cRxEi.tilKKlBfmGo4EL6.qpiK', '../Images/img_profil2.png', NULL, '0000-00-00', NULL, NULL, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aime`
--
ALTER TABLE `aime`
  ADD CONSTRAINT `aime_post_FK` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `aime_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `ami`
--
ALTER TABLE `ami`
  ADD CONSTRAINT `ami_utilisateur0_FK` FOREIGN KEY (`id_utilisateur_ami`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `ami_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `candidater`
--
ALTER TABLE `candidater`
  ADD CONSTRAINT `candidater_offer_FK` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`offer_id`),
  ADD CONSTRAINT `candidater_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_post0_FK` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `comment_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
