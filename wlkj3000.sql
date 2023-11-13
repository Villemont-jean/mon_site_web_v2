-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 13 nov. 2023 à 21:46
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wlkj3000`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `CommentaireId` int NOT NULL AUTO_INCREMENT,
  `ContactID` int NOT NULL,
  `Commentaire` text COLLATE utf8mb4_general_ci NOT NULL,
  `DateCreate` date DEFAULT NULL,
  PRIMARY KEY (`CommentaireId`),
  KEY `ContactID` (`ContactID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `CompID` int NOT NULL AUTO_INCREMENT,
  `CatComp` int NOT NULL,
  `Nom` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Comp` int NOT NULL,
  `Abs` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`CompID`),
  KEY `CatComp` (`CatComp`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`CompID`, `CatComp`, `Nom`, `Comp`, `Abs`) VALUES
(1, 1, 'HTML 5', 95, 'html'),
(2, 1, 'CSS 3', 90, 'css'),
(3, 1, 'JavaScript', 75, 'js'),
(4, 1, 'jQuery', 92, 'jquery'),
(5, 1, 'PHP', 30, 'php'),
(6, 1, 'MySql', 25, 'sql'),
(7, 2, 'Scratch 2 & 3', 85, 'scratch'),
(8, 2, 'gDevelop 5', 60, 'gdevelop'),
(9, 2, 'Unity 3D', 50, 'unity'),
(10, 2, 'Unreal Engine 5', 20, 'unreal'),
(11, 2, 'Cry-Engine', 10, 'cry engine'),
(12, 3, 'Blender 2.79', 75, 'blender 2.79'),
(13, 3, 'Blender 3 X', 50, 'blender 3x'),
(14, 3, 'Cinema 4D', 90, 'C4D R21'),
(15, 3, 'Scultris', 78, 'scultris'),
(16, 3, 'z-Brush', 20, 'z brush'),
(17, 4, 'PhotoShop', 45, 'photoshop'),
(18, 4, 'Illustrator', 45, 'illustrator'),
(19, 4, 'GIMP', 80, 'gimp'),
(20, 4, 'Inkscape', 70, 'inkscape'),
(21, 5, 'C#', 20, 'csharp'),
(22, 5, 'Lua', 10, 'lua'),
(23, 5, 'Python', 15, 'python');

-- --------------------------------------------------------

--
-- Structure de la table `competences_categorie`
--

DROP TABLE IF EXISTS `competences_categorie`;
CREATE TABLE IF NOT EXISTS `competences_categorie` (
  `CatComp` int NOT NULL AUTO_INCREMENT,
  `GroupNom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`CatComp`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `competences_categorie`
--

INSERT INTO `competences_categorie` (`CatComp`, `GroupNom`) VALUES
(1, 'Création de site web'),
(2, 'Création de jeu vidéo'),
(3, 'Création d\'animation 3D'),
(4, 'Manipulation d\'image'),
(5, 'Autre langage de programmation');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `ContactID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CommentaireID` int DEFAULT NULL,
  `DateCreate` date DEFAULT NULL,
  `IsTemporaire` int DEFAULT NULL,
  PRIMARY KEY (`ContactID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `FavoriteID` int NOT NULL AUTO_INCREMENT,
  `TempID` int NOT NULL,
  `CatTemp` int NOT NULL,
  `ContactID` int NOT NULL,
  `FavoriteValue` int NOT NULL,
  PRIMARY KEY (`FavoriteID`),
  KEY `TempID` (`TempID`),
  KEY `CatTemp` (`CatTemp`),
  KEY `ContactID` (`ContactID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `TempID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `UrlImg` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `AltImg` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Caption` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `AjoutDay` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` text COLLATE utf8mb4_general_ci NOT NULL,
  `CatTemp` int NOT NULL,
  `UrlTemp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`TempID`),
  KEY `CatTemp` (`CatTemp`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `template`
--

INSERT INTO `template` (`TempID`, `Title`, `UrlImg`, `AltImg`, `Caption`, `AjoutDay`, `Description`, `CatTemp`, `UrlTemp`) VALUES
(1, 'Zozor', 'zozor', 'zozor', 'mon 1er template', '2016-02-22 10:43:47', 'Mon premier template en front-End,d\'après un tuto du Zéro.com', 1, 'templates/web/zozor/'),
(2, 'Pâques', 'paques', 'Pâques', 'Animation Pâques', '2016-03-20 15:04:47', 'Ma première animation sur Cinema 4D. pour les fêtes de pâques 2016.', 2, 'https://youtu.be/5JA1jwZ67EQ'),
(3, 'Ache', 'ache', 'Ache', 'Ache', '2016-03-27 14:02:01', 'Pour ma deuxième vidéo, j\'i créer une ache à double tranchant. Je n\'ai pas garder le fichier en \".OBJ\" dommage !!', 2, 'https://youtu.be/3DnpVwbDhFs'),
(4, 'Wood', 'wood', 'wood', 'animation wood', '2016-03-27 20:35:04', 'Animation de chute de Bois, réaliser avec Cinema 4D', 2, 'https://youtu.be/x0a2YaeLBC0'),
(5, 'House', 'house', 'house', 'Inondation', '2016-04-16 10:40:14', 'Animation avec Realflow et Cinema 4D', 2, 'https://youtu.be/ta9LmRgK9Zc'),
(6, 'Flag', 'flag', 'flag', 'Animation Drapeau', '2016-04-16 21:46:58', 'Animation d\'un drapeau au vent avec la photo de mon Mariage.<br>avec deux mention j\'aime sur youtube', 2, 'https://youtu.be/xHcfJYUmi6I'),
(7, 'Happy', 'happy', 'happy', '3 Ans', '2016-07-27 14:37:11', 'Voici une petite vidéo pour nos 3 Ans de Mariage, que l\'on fête aujourd\'hui même.', 2, 'https://youtu.be/roGLfrTBWwI'),
(8, 'cube', 'cube', 'cube', 'Animation Web', '2016-09-09 15:04:59', 'l\'une de mes première animation en CSS pure. un TP qui m\'a été demander lors d\'une formation \"le web au service du multimédia\".<br> J\'ai ajouter un effet au hover plus une transition sur les images.<br>12 images d’animaux minions trouver sur internet ont permis cette animation', 1, 'templates/web/cube/'),
(9, 'Model Anim', 'model_anim', 'Model Anim', 'Model Anim', '2016-10-30 18:20:02', 'Une animation sans prétention', 2, 'https://youtu.be/TSncQNDT9Yg'),
(10, 'LabyImg', 'LabyImg', 'LabyImg', 'LabyImg', '2016-12-10 20:33:18', 'Vidéo réaliser avec Cinema 4D et Realflow<br>avec une mention j\'aime sur youtube', 2, 'https://youtu.be/cJfTb0H_t4Y'),
(11, 'Alambix', 'Alambix', 'Alambix', 'alambix', '2017-01-03 10:37:20', 'Animation en Spiral Créer avec Cinema 4D et Realflow', 2, 'https://youtu.be/UmH-XzZHHNs'),
(12, 'Robinet', 'Robinet', 'Robinet', 'Robinet', '2017-01-05 15:41:46', 'animation colorée réaliser avec Cinema 4D et Realflow<br>avec une mention j\'aime sur youtube', 2, 'https://youtu.be/Cx06gLJoeOw'),
(13, 'Balls', 'Balls', 'Balls', 'Balls', '2017-01-08 21:27:39', 'Animation sans prétention de balles qui rebondis', 2, 'https://youtu.be/sIi7Em8x7zM'),
(14, 'Light', 'Light', 'Light', 'Light', '2017-01-28 15:56:06', 'Effet de lumières et d\'ombres<br>avec une mention j\'aime sur youtube', 2, 'https://youtu.be/FaAtwbO03J0'),
(15, 'Vidéo Fluide', 'Video Fluide', 'Vidéo Fluide', 'Vidéo Fluide', '2017-02-08 21:34:15', 'Petite animation 3D avec Cinema 4D, Blender et Realflow', 2, 'https://youtu.be/PS4_ByHizDs'),
(16, 'Aquarium', 'Aquarium', 'Aquarium', 'Aquarium', '2017-06-09 21:38:12', 'Vidéo de simulation: d\'un aquarium sans poisson<br>avec une mention j\'aime sur youtube', 2, 'https://youtu.be/4PyEKbAdzXA'),
(17, '4 Ans Déjà', '4 Ans Deja', '4 Ans Déjà', '4 Ans Déjà', '2023-07-27 17:46:14', 'Il y a 4 ans, nous nous sommes Marié et mon amour pour toi est toujours aussi grand que la première fois.', 2, 'https://youtu.be/nymu3wFH9N4'),
(18, 'Happy Lulu', 'Happy Lulu', 'Happy Lulu', 'Happy Lulu', '2017-11-14 07:54:27', 'Joyeux anniversaire Ludivine', 2, 'https://youtu.be/J7nW7nZwhVk'),
(19, 'Noêl 2017', 'Noel 2017', 'Noêl 2017', 'Noêl 2017', '2017-12-24 18:58:55', 'Joyeux Noël\r\n<br><br>\r\nVidéo créer avec Cinéma 4D\r\nMusic : Merry Christmas - Site :universal-soundbank.com\r\n<br><br>\r\nComposition avec : Adobe Première Pro', 2, 'https://youtu.be/cvFnVIW6GHs'),
(20, 'Bonne Année 2018', 'year2018', 'Bonne Année 2018', 'Bonne Année 2018', '2017-12-31 19:05:03', 'Bonne et heureuse année 2018<br>avec une mention j\'aime sur youtube', 2, 'https://youtu.be/K9u_NARS8NE'),
(21, 'happy birthday my li', 'Happy Brother 2018', 'happy birthday my br', 'happy birthday Eric', '2018-03-07 07:25:39', 'à mon petit frère Eric<br>avec deux mentions j\'aime sur youtube', 2, 'https://youtu.be/ZrItfaWKjxs'),
(22, 'Happy 2018', 'Happy 2018', 'Happy 2018', 'Happy 2018', '2023-11-13 19:34:06', 'Vidéo pour notre anniversaire de Mariage.<br>avec deux mentions j\'aime sur youtube', 2, 'https://youtu.be/3fX5MJELTf8'),
(23, 'Happy Birthday Mathy', 'Happy Mathys 2018', 'Happy Birthday Mathy', 'Happy Birthday Mathy', '2023-11-13 19:53:06', 'Animation pour un joyeux anniversaire à mon neveu Mathys', 2, 'https://youtu.be/Vb5sW42O_5Q'),
(24, 'Happy HalloWeen 2018', 'Happy HalloWeen 2018', 'Happy HalloWeen 2018', 'Happy HalloWeen 2018', '2018-10-30 19:56:42', 'ma première animation pour un Joyeux Halloween<br>avec deux mentions j\'aime sur youtube', 2, 'https://youtu.be/6DQHm6yWJ9Y'),
(25, 'Happy Joss', 'Happy Joss 2018', 'Happy Joss', 'Happy Joss', '2018-11-27 07:07:40', 'Joyeux Anniversaire Joss', 2, 'https://youtu.be/zTpAAPIHZAc'),
(26, 'Happy Angel', 'Happy Angel', 'Happy Angel', 'Happy Angel', '2018-11-23 09:12:10', 'Joyeux Anniversaire Lindsay', 2, 'https://youtu.be/Rj9dsZzXa5w'),
(27, 'The Cave of The Life', 'The Cave', 'The Cave of The Life', 'The Cave of The Life', '2018-11-27 19:24:59', 'le premier Mois de grossesse de mon bébé, <br>il n\'a pas survécu plus longtemps', 2, 'https://youtu.be/jMM840inTtE'),
(28, 'Noel 2018', 'Noel 2018', 'Noel 2018', 'Noel 2018', '2018-12-24 17:27:16', 'joyeuses fêtes à toutes et à tous<br><br>\r\nHappy holidays to everyone<br>\r\nSchöne Ferien an alle<br>\r\nFelices fiestas a todos.', 2, 'https://youtu.be/Epq-mbDRE4g'),
(29, 'Test 01', 'Test 01', 'Test 01', 'Test 01', '2019-02-23 12:33:49', 'Test pourCinéma4D avec les Plugins RealFlow et TurbulanceFD\r\n<br><br>\r\nPremiers Test d\'une série de Test sur Cinéma4D.\r\n<br><br>\r\nMerci de mettre un pousse bleu ou rouge pour me faire progresser,<br>\r\nPartage si tu aime, donne moi ton avis et tes conseils', 2, 'https://youtu.be/XSPgvkqksOE'),
(30, 'Test 02', 'Test 02', 'Test 02', 'Test 02', '2019-03-11 13:38:44', 'Test pour Cinéma4D avec les Plugins TurbulanceFD \r\n<br><br>\r\nSérie de Test sur Cinéma4D. Merci de mettre un pousse bleu ou rouge pour me faire progresser, Partage si tu aime, donne moi ton avis et tes conseils', 2, 'https://youtu.be/ZM34sUxWuDA'),
(31, 'eaux 01', 'Water 01', 'eaux 01', 'eaux 01', '2019-03-30 15:43:44', 'Animation sans préssion', 2, 'https://youtu.be/v80vA3Xyxfs'),
(32, 'Girls', 'Girls', 'Girls', 'Girls', '2019-05-28 20:47:50', 'Test avec cineam 4D et RealFlow', 2, 'https://youtu.be/0IdCSDHM3D4'),
(33, 'Happy Bébé 2019', 'Happy Bebe 2019', 'Happy Bébé 2019', 'Happy Bébé 2019', '2019-08-07 09:52:12', 'Pour ton 34ème anniversaire mon bébé, Je t\'aime', 2, 'https://youtu.be/BLli173jRRs'),
(34, 'Joyeuse Fêtes 2019', 'Happy 2019', 'Joyeuse Fêtes 2019', 'Joyeuse Fêtes 2019', '2023-11-13 20:57:06', 'Joyeuse Fêtes de Fin d\'année à Tous ...<br>\nVidéo créer Par Jean\n<br><br><br>\nd\'après des models de C4D Débutant\nhttp://c4ddebutant.blogspot.com/\nhttp://mrkamigeek.blogspot.com/\n<br><br><br>\nMusic: \"O Holly Night\" Covered By Royse<br>\nhttps://www.youtube.com/watch?v=6HYnJoP73oE', 2, 'https://youtu.be/TovGYLD_Krc'),
(35, 'Bonne année 2020', 'year2020', 'Bonne année 2020', 'Bonne année 2020', '2023-11-13 21:00:39', 'Bonne année à Toutes et à Tous<br>\nMeilleur Vœux pour 2020', 2, 'https://youtu.be/IQ3uXT_sgyk'),
(36, 'St Valentin 2020', 'St Valentin 2020', 'St Valentin 2020', 'St Valentin 2020', '2020-02-14 09:03:20', 'Une Joyeuse fête des amoureux à tous', 2, 'https://youtu.be/Lw5kkI85FOk'),
(37, 'Anniv', 'Anniv', 'Anniv', 'Anniv', '2020-02-16 08:08:18', 'Bonne Anniversaire Leaticia, ma belle soeur', 2, 'https://youtu.be/hCG6uLApQAg'),
(38, 'Eric 2020', 'Eric 2020', 'Eric 2020', 'Eric 2020', '2020-03-05 10:11:42', 'Joyeux Anniversaire mon Petit Frère\n<br>\n<br><br>\nVidéo Créer Par Moi même\nModélisation du Chariot et Sol Moi même sur C4D\nImportation des modèles 3D : Arbre, Cactus, Bois Feu\nde Archjive 3d : https://archive3d.net/\n<br>\n<br><br>\nMusic de : Evening Melodrama par Kevin MacLeod est distribué sous la licence Creative Commons Attribution (https://creativecommons.org/licenses/by/4.0/)\nSource : http://incompetech.com/music/royalty-free/index.html?isrc=USUAN1200049\nArtiste : __url_artiste__', 2, 'https://youtu.be/bae1PJ78uno'),
(39, 'Happy Birthday Cédri', 'Happy Birthday Cedric', 'Happy Birthday Cédri', 'Happy Birthday Cédri', '2020-06-27 13:19:11', 'un Joyeux Anniversaire à Cédric<br>Attention vidéo interdite -18 ans', 2, 'https://youtu.be/lgVB7ccLsGg'),
(40, 'Happy Brithday Mégan', 'Happy Brithday Megane 2020', 'Happy Brithday Mégan', 'Happy Brithday Mégan', '2020-06-28 10:26:58', 'un Joyeux Anniversaire à Mégane', 2, 'https://youtu.be/ZcJXc8QkNjs'),
(41, 'Happy Elodie 2020', 'Happy Elodie 2020', 'Happy Elodie 2020', 'Happy Elodie 2020', '2020-07-15 21:31:36', 'un Joyeux Anniversaire à Élodie Troccard<br>\r\nBonne journée à Toi et à tous ceux que tu aime', 2, 'https://youtu.be/sQCiZyl2arI'),
(42, 'Happy Bébé 2020', 'Happy Bebe 2020', 'Happy Bébé 2020', 'Happy Bébé 2020', '2023-11-13 07:36:30', 'un joyeux anniversaire à ma femme aujourd\'hui<br>\r\nje t\'aime', 2, 'https://youtu.be/ZE-XqWz48v0'),
(43, 'Happy', 'Happy 2020', 'Happy', 'Happy', '2020-08-22 09:41:32', 'Un Joyeux Anniversaire de Mariage à vous deux', 2, 'https://youtu.be/UDkIdy4dws8'),
(44, 'Noël 2020', 'Noel 2020', 'Noël 2020', 'Noël 2020', '2020-12-25 21:46:37', 'Un Joyeux Noël 2020 pour tous!\n<br>\n<br><br>\nVidéo créer par VILLEMONT Jean\nd\'après la rue du Télégraphe à Cravant<br>avec une mention j\'aime sur youtube', 2, 'https://youtu.be/tl47-BnpcDc'),
(45, 'Bonne Année 2021', 'Bonne Annee 2021', 'Bonne Année 2021', 'Bonne Année 2021', '2020-12-31 23:50:03', 'Bonne année 2021<br>\r\nà tous !', 2, 'https://youtu.be/TxoLSjRXLVU'),
(46, 'St Valentin 2021', 'St Valentin 2021', 'St Valentin 2021', 'St Valentin 2021', '2021-02-14 07:17:59', 'Je vous souhaite à tous une bonne saint Valentin\n<br>\n<br><br>\ncréation réaliser par VILLEMONT Jean\nsur cinéma 4D avec RealFlow et Turbulancee FD\n<br>\n<br><br>\nMusic:Dance of the Sugar Plum Fairy  de Kevin MacLeod\n<br>\n<br><br>\nSource : http://incompetech.com/music/royalty-free/index.html?isrc=USUAN1100270\n<br><br>\nArtiste : http://incompetech.com/<br>avec deux mentions j\'aime sur youtube', 2, 'https://youtu.be/le8BObEsTtE'),
(47, 'Happy Brother', 'Happy Brother 2021', 'Happy Brother', 'Happy Brother', '2021-03-07 08:00:14', 'Un Joyeux Anniversaire à Eric<br>\r\nmon petit Fère', 2, 'https://youtu.be/x8hxMd012ns'),
(48, 'Happy Quentin 2021', 'Happy Quentin 2021', 'Happy Quentin 2021', 'Happy Quentin 2021', '2021-05-15 18:03:50', 'une petite vidéo pour mon neveu', 2, 'https://youtu.be/ZYrmSYthjMc'),
(49, 'Happy', 'Happy 2021', 'Happy', 'Happy', '2021-06-28 06:07:46', 'Bonne Anniversaire Mégane', 2, 'https://youtu.be/vTQiibZ_-LQ'),
(50, 'Logan', 'Logan', 'Logan', 'Logan', '2021-09-25 10:11:03', 'Logan. Arrivé prévu pour le 20 Janvier 2022 en exclusivité à l\'hôpital de Foix', 2, 'https://youtu.be/pWVYwhcjaUw'),
(51, 'Happy Mathys', 'Happy Mathys 2021', 'Happy Mathys', 'Happy Mathys', '2021-10-12 22:14:41', 'Un Joyeux Anniversaire à Mathys\r\n<br>\r\n<br><br>\r\nla Scène se trouve dans la bibliothèque de Cinema 4D\r\nl\'Animation des requins est de VILLEMONT Jean\r\n<br>\r\n<br>\r\n<br><br>\r\nla Music:\r\nDanse Macabre - Busy Strings de Kevin MacLeod fait l\'objet d\'une licence Creative Commons Attribution 4.0. https://creativecommons.org/licenses/by/4.0/\r\n<br><br>\r\nSource : http://incompetech.com/music/royalty-free/index.html?isrc=USUAN1100556\r\n<br><br>\r\nArtiste : http://incompetech.com/', 2, 'https://youtu.be/3_Pfyd_yiCs'),
(52, 'Halloween Low Poly', 'Halloween Low Poly', 'Halloween Low Poly', 'Halloween Low Poly', '2021-11-01 22:18:40', 'Un Joyeux Halloween avec un peu de retard, Scène créer en Low Poly sur cinema 4D', 2, 'https://youtu.be/8h73Uy4hwuc');

-- --------------------------------------------------------

--
-- Structure de la table `template_categorie`
--

DROP TABLE IF EXISTS `template_categorie`;
CREATE TABLE IF NOT EXISTS `template_categorie` (
  `CatTemp` int NOT NULL AUTO_INCREMENT,
  `CatNom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `isNbr` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`CatTemp`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `template_categorie`
--

INSERT INTO `template_categorie` (`CatTemp`, `CatNom`, `isNbr`) VALUES
(1, 'Création Site Web', 1),
(2, 'Animation 3D', 1),
(3, 'Jeu Vidéo 2D', 0),
(4, 'Jeu Vidéo 3D', 0),
(5, 'Objet 3D', 0),
(6, 'Manipulation d\'Image', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ContactID`) REFERENCES `contact` (`ContactID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `competences`
--
ALTER TABLE `competences`
  ADD CONSTRAINT `competences_ibfk_1` FOREIGN KEY (`CatComp`) REFERENCES `competences_categorie` (`CatComp`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`TempID`) REFERENCES `template` (`TempID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`CatTemp`) REFERENCES `template_categorie` (`CatTemp`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `favorite_ibfk_3` FOREIGN KEY (`ContactID`) REFERENCES `contact` (`ContactID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `template`
--
ALTER TABLE `template`
  ADD CONSTRAINT `template_ibfk_1` FOREIGN KEY (`CatTemp`) REFERENCES `template_categorie` (`CatTemp`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
