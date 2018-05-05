-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 05 mai 2018 à 21:16
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `linkedece`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_album_utilisateur` (`utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `albummultimedia`
--

DROP TABLE IF EXISTS `albummultimedia`;
CREATE TABLE IF NOT EXISTS `albummultimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album` int(11) NOT NULL,
  `multimedia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_albummultimedia_album` (`album`),
  KEY `fk_albummultimedia_multimedia` (`multimedia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `post` int(11) NOT NULL AUTO_INCREMENT,
  `cible` int(11) NOT NULL,
  PRIMARY KEY (`post`),
  KEY `fk_commentaire_cible` (`cible`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`post`, `cible`) VALUES
(9, 5),
(8, 7),
(12, 11);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ecole` varchar(250) NOT NULL,
  `competence` varchar(250) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_formation_utilisateur` (`utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `ecole`, `competence`, `date_debut`, `date_fin`, `utilisateur`) VALUES
(1, 'ECE', 'Electronique, Informatique', '2015-09-01', '2020-06-30', 'julien');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`) VALUES
(1, 'SuperConv'),
(2, 'Test'),
(3, 'Test2');

-- --------------------------------------------------------

--
-- Structure de la table `groupeutilisateur`
--

DROP TABLE IF EXISTS `groupeutilisateur`;
CREATE TABLE IF NOT EXISTS `groupeutilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe` int(11) NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_groupeutilisateur_groupe` (`groupe`),
  KEY `fk_groupeutilisateur_utilisateur` (`utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupeutilisateur`
--

INSERT INTO `groupeutilisateur` (`id`, `groupe`, `utilisateur`) VALUES
(1, 1, 'julien'),
(2, 1, 'damien'),
(3, 2, 'julien'),
(4, 3, 'julien'),
(5, 3, 'nolwenn');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe` int(11) NOT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `message` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_message_groupe` (`groupe`),
  KEY `fk_message_utilisateur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `groupe`, `auteur`, `message`, `date`) VALUES
(1, 1, 'julien', 'Youhou !!!', '2018-05-04 17:56:22'),
(2, 1, 'damien', 'Cool !', '2018-05-04 18:03:17'),
(3, 1, 'julien', 'test', '2018-05-04 18:08:35'),
(4, 2, 'julien', 'geribgierngienhjieanihbe\r\n', '2018-05-04 18:20:46'),
(5, 3, 'julien', 'Cool !', '2018-05-04 18:21:23'),
(6, 3, NULL, 'Hey !', '2018-05-05 15:21:45');

-- --------------------------------------------------------

--
-- Structure de la table `multimedia`
--

DROP TABLE IF EXISTS `multimedia`;
CREATE TABLE IF NOT EXISTS `multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(3) NOT NULL,
  `fichier` varchar(500) NOT NULL,
  `date_ajout` datetime NOT NULL,
  `lieu` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fichier` (`fichier`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `multimedia`
--

INSERT INTO `multimedia` (`id`, `type`, `fichier`, `date_ajout`, `lieu`) VALUES
(1, 'img', 'ef2e78b735dcbb98341d.jpg', '2018-05-04 09:45:32', ''),
(3, 'img', '0332ba3de07da924cb72.jpg', '2018-05-04 16:38:11', NULL),
(4, 'img', '8fdc56f0f2bbdfad2cec.png', '2018-05-04 16:51:24', NULL),
(5, 'img', '195c456f3b0549af7f36.', '2018-05-04 23:31:04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(2) NOT NULL,
  `emetteur` varchar(100) NOT NULL,
  `cible` varchar(100) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `offre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notification_emetteur` (`emetteur`),
  KEY `fk_notification_cible` (`cible`),
  KEY `fk_notification_post` (`post`),
  KEY `fk_notification_offre` (`offre`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `date`, `type`, `emetteur`, `cible`, `post`, `offre`) VALUES
(1, '2018-05-05 16:32:14', 'pu', 'julien', 'nolwenn', 11, NULL),
(2, '2018-05-05 16:32:14', 'pu', 'julien', 'damien', 11, NULL),
(3, '2018-05-05 16:35:50', 'co', 'damien', 'julien', 12, NULL),
(4, '2018-05-05 16:40:19', 'pa', 'julien', 'julien', 11, NULL),
(5, '2018-05-05 16:40:33', 'li', 'julien', 'julien', 10, NULL),
(7, '2018-05-05 16:51:06', 'aa', 'elise', 'julien', NULL, NULL),
(11, '2018-05-05 18:59:21', 'rp', 'eric', 'damien', NULL, 1),
(12, '2018-05-05 18:59:48', 'ap', 'eric', 'nolwenn', NULL, 1),
(13, '2018-05-05 18:59:48', 'rp', 'eric', 'julien', NULL, 1),
(18, '2018-05-05 21:15:42', 'aa', 'elise', 'nolwenn', NULL, NULL),
(19, '2018-05-05 21:15:43', 'aa', 'elise', 'nolwenn', NULL, NULL),
(20, '2018-05-05 21:15:44', 'aa', 'elise', 'nolwenn', NULL, NULL),
(22, '2018-05-05 21:18:39', 'aa', 'damien', 'elise', NULL, NULL),
(23, '2018-05-05 21:18:43', 'aa', 'damien', 'nolwenn', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `auteur` varchar(100) NOT NULL,
  `poste` varchar(250) NOT NULL,
  `entreprise` varchar(250) NOT NULL,
  `secteur` varchar(250) NOT NULL,
  `acceptee` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_offre_utilisateur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id`, `date`, `auteur`, `poste`, `entreprise`, `secteur`, `acceptee`) VALUES
(1, '2018-05-05 18:32:31', 'eric', 'Developpeur', 'SG', 'Informatique', 1),
(2, '2018-05-05 23:15:25', 'eric', 'Developpeur', 'SG', 'Informatique', 0);

-- --------------------------------------------------------

--
-- Structure de la table `partage`
--

DROP TABLE IF EXISTS `partage`;
CREATE TABLE IF NOT EXISTS `partage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(100) NOT NULL,
  `publication` int(11) NOT NULL,
  `jaime` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_partage_publication` (`publication`),
  KEY `fk_partage_utilisateur` (`utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `partage`
--

INSERT INTO `partage` (`id`, `utilisateur`, `publication`, `jaime`) VALUES
(1, 'julien', 5, 1),
(2, 'julien', 4, 0),
(4, 'julien', 2, 0),
(5, 'julien', 1, 0),
(6, 'julien', 7, 1),
(7, 'julien', 11, 0),
(8, 'julien', 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(250) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_post_utilisateur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `message`, `auteur`, `date`) VALUES
(1, 'Cool un post !!!', 'nolwenn', '2018-05-03 11:16:29'),
(2, 'Trop cool un autre post !', 'julien', '2018-05-03 11:16:47'),
(4, 'test', 'julien', '2018-05-03 23:25:36'),
(5, 'test', 'julien', '2018-05-03 23:26:42'),
(7, 'test', 'julien', '2018-05-04 09:45:32'),
(8, 'Test', 'julien', '2018-05-05 12:24:00'),
(9, 'Cool', 'julien', '2018-05-05 16:29:09'),
(10, 'Test notifs', 'julien', '2018-05-05 16:31:46'),
(11, 'Test notifs', 'julien', '2018-05-05 16:32:14'),
(12, 'Ca marche !', 'damien', '2018-05-05 16:35:50');

-- --------------------------------------------------------

--
-- Structure de la table `postulation`
--

DROP TABLE IF EXISTS `postulation`;
CREATE TABLE IF NOT EXISTS `postulation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postulant` varchar(100) NOT NULL,
  `offre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_postulation_utilisateur` (`postulant`),
  KEY `fk_postulation_offre` (`offre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `postulation`
--

INSERT INTO `postulation` (`id`, `postulant`, `offre`) VALUES
(2, 'nolwenn', 1);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `post` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(250) DEFAULT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `multimedia` int(11) DEFAULT NULL,
  PRIMARY KEY (`post`),
  KEY `fk_publication_multimedia` (`multimedia`),
  KEY `fk_publication_post` (`post`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`post`, `lieu`, `public`, `multimedia`) VALUES
(1, NULL, 0, NULL),
(2, NULL, 0, NULL),
(4, '', 1, NULL),
(5, '', 1, NULL),
(7, '', 1, 1),
(10, '', 1, NULL),
(11, '', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

DROP TABLE IF EXISTS `relation`;
CREATE TABLE IF NOT EXISTS `relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur1` varchar(100) NOT NULL,
  `utilisateur2` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_relation_utilisateur2` (`utilisateur2`),
  KEY `fk_relation_utilisateur1` (`utilisateur1`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`id`, `utilisateur1`, `utilisateur2`) VALUES
(1, 'julien', 'nolwenn'),
(2, 'damien', 'julien'),
(4, 'elise', 'julien'),
(5, 'elise', 'nolwenn'),
(8, 'damien', 'elise'),
(9, 'damien', 'nolwenn');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `societe` varchar(250) NOT NULL,
  `poste` varchar(250) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stage_utilisateur` (`utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`id`, `societe`, `poste`, `date_debut`, `date_fin`, `utilisateur`) VALUES
(1, 'Ubisoft', 'Testeur', '2011-06-25', '2011-08-17', 'julien');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `type` varchar(3) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `naissance` date NOT NULL,
  `poste` varchar(250) NOT NULL,
  `secteur` varchar(250) NOT NULL,
  `photo_profil` int(11) DEFAULT NULL,
  `image_fond` int(11) DEFAULT NULL,
  PRIMARY KEY (`pseudo`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_utilisateur_imagefond` (`image_fond`),
  KEY `fk_utilisateur_photoprofil` (`photo_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo`, `email`, `mot_de_passe`, `type`, `nom`, `prenom`, `naissance`, `poste`, `secteur`, `photo_profil`, `image_fond`) VALUES
('damien', 'damien.garcias@edu.ece.fr', '$2y$10$gjBQL7B3ewu26cJtcHctv.g0eSGcPoX61LS0YAdyuzSF5HdJ6M8Uy', 'etu', 'Garcias', 'Damien', '1997-11-09', 'Etudiant', 'informatique', NULL, NULL),
('elise', 'elise.capellari@gmai.com', '$2y$10$nwkCDo9FBVapVjFLG851F.r5BCaMAMXJET0d.xLyGsk8tu4bz4E5e', 'etu', 'Capellari', 'Elise', '2000-01-19', 'Etudiante', 'Design', NULL, NULL),
('eric', 'eric.capellari@gmail.com', '$2y$10$FI5lYRJepk7rWCn1JhI2QOfhBa/uu33EU1lI/KRZstwfOokdyCVjS', 'par', 'Capellari', 'Eric', '1969-01-22', 'Chef de projet', 'Informatique', NULL, NULL),
('julien', 'julien.capellari@edu.ece.fr', '$2y$10$mLbpww0n8MGEH.vn8ePPGuVU1d3VP5uTnnev8X/eoSaDvWWMUNoTS', 'adm', 'Capellari', 'Julien', '1997-03-24', 'Etudiant', 'informatique', 3, NULL),
('nolwenn', 'nolwenn.gentric@edu.ece.fr', '$2y$10$eQX6iqfXrGrvDueZoTzFKeKaWZzbAUMN65dm3nZsX8J.iVUKPqR8a', 'adm', 'Gentric', 'Nolwenn', '1997-08-30', 'Etudiant', 'informatique', 4, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `fk_album_utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `albummultimedia`
--
ALTER TABLE `albummultimedia`
  ADD CONSTRAINT `fk_albummultimedia_album` FOREIGN KEY (`album`) REFERENCES `album` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_albummultimedia_multimedia` FOREIGN KEY (`multimedia`) REFERENCES `multimedia` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_cible` FOREIGN KEY (`cible`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_commentaire_post` FOREIGN KEY (`post`) REFERENCES `post` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `fk_formation_utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groupeutilisateur`
--
ALTER TABLE `groupeutilisateur`
  ADD CONSTRAINT `fk_groupeutilisateur_groupe` FOREIGN KEY (`groupe`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_groupeutilisateur_utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_groupe` FOREIGN KEY (`groupe`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_message_utilisateur` FOREIGN KEY (`auteur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE SET NULL;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notification_cible` FOREIGN KEY (`cible`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_notification_emetteur` FOREIGN KEY (`emetteur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_notification_offre` FOREIGN KEY (`offre`) REFERENCES `offre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_notification_post` FOREIGN KEY (`post`) REFERENCES `post` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `fk_offre_utilisateur` FOREIGN KEY (`auteur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `partage`
--
ALTER TABLE `partage`
  ADD CONSTRAINT `fk_partage_publication` FOREIGN KEY (`publication`) REFERENCES `publication` (`post`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_partage_utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_utilisateur` FOREIGN KEY (`auteur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `postulation`
--
ALTER TABLE `postulation`
  ADD CONSTRAINT `fk_postulation_offre` FOREIGN KEY (`offre`) REFERENCES `offre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_postulation_utilisateur` FOREIGN KEY (`postulant`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `fk_publication_multimedia` FOREIGN KEY (`multimedia`) REFERENCES `multimedia` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_publication_post` FOREIGN KEY (`post`) REFERENCES `post` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `fk_relation_utilisateur1` FOREIGN KEY (`utilisateur1`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_relation_utilisateur2` FOREIGN KEY (`utilisateur2`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `fk_stage_utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_utilisateur_imagefond` FOREIGN KEY (`image_fond`) REFERENCES `multimedia` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_utilisateur_photoprofil` FOREIGN KEY (`photo_profil`) REFERENCES `multimedia` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
