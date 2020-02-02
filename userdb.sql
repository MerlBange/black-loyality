-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Feb 2020 um 21:56
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `user`
--
CREATE DATABASE IF NOT EXISTS `user` DEFAULT CHARACTER SET utf8 COLLATE utf8_german2_ci;
USE `user`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answers`
--

CREATE TABLE `answers` (
  `a_id` int(255) NOT NULL,
  `t_id` int(100) NOT NULL,
  `a_inhalt` text COLLATE utf8_german2_ci NOT NULL,
  `a_autor` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `a_datum` varchar(50) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `answers`
--

INSERT INTO `answers` (`a_id`, `t_id`, `a_inhalt`, `a_autor`, `a_datum`) VALUES
(1, 1, 'Marcel war hier!', 'Callmemaybex', '29-01-2020 17:37:14'),
(3, 1, 'Ich auch!', 'hiimtwist', '29-01-2020 17:50:25'),
(4, 1, 'Dies ist die neuste Antwort', 'hiimtwist', '29-01-2020 19:49:05'),
(5, 1, 'test', 'hiimtwist', '31-01-2020 08:51:38');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups`
--

CREATE TABLE `groups` (
  `g_id` int(100) NOT NULL,
  `g_name` varchar(50) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `groups`
--

INSERT INTO `groups` (`g_id`, `g_name`) VALUES
(1, 'Lehrer'),
(2, 'Schüler'),
(3, 'Klassensprecher');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `klassen`
--

CREATE TABLE `klassen` (
  `k_id` int(100) NOT NULL,
  `k_name` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `k_klassenlehrer` int(50) NOT NULL,
  `k_klassensprecher` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `klassen`
--

INSERT INTO `klassen` (`k_id`, `k_name`, `k_klassenlehrer`, `k_klassensprecher`) VALUES
(1, 'AIT17A', 4, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `n_id` int(100) NOT NULL,
  `n_eintrag` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `n_datum` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `n_autor` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `n_text` text COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`n_id`, `n_eintrag`, `n_datum`, `n_autor`, `n_text`) VALUES
(1, 'Version 1.0 veröffentlicht', '2019-12-18', 'Callmemaybex', 'Mit diesem Changelog eröffnen wir offiziell die Website unseres Clans \"Black Loyality\".<br> Bei Fragen oder Anregungen könnt ihr euch bei einem Admin im <a href=\"ts3server://black-loyality.de\">Teamspeak</a> melden.\r\n<br>\r\n<br>\r\n\r\n<b><u>Changelog 1.0:</b></u><br>\r\n-Login Funktion<br>\r\n-Registrierungs Funktion<br>\r\n-Profil Funktion inkl. ändern der Daten<br>\r\n-News und Changelog hinzugefügt<br>\r\n-Design überarbeitet<br><br>\r\n\r\n<b><u>Bekannte Bugs:</b></u><br>\r\n-keine<br><br>\r\n\r\nFalls Bugs auffallen sollten, meldet euch bitte bei einem Lehrer.'),
(2, 'Version 1.1 veröffentlicht', '2019-12-24', 'hiimtwist', 'Mit diesem Update führen wir die Password Change Funktion ein und wir haben ein paar kleinere Bugs behoben.\r\n<br>\r\n<br>\r\n\r\n<b><u>Changelog 1.1:</b></u><br>\r\n-Password Change Funktion<br>\r\n-Design überarbeitet<br><br>\r\n\r\n<b><u>Bekannte Bugs:</b></u><br>\r\n-keine<br><br>\r\n\r\nFalls Bugs auffallen sollten, meldet euch bitte bei einem Admin.\r\n<br><br>\r\nMit dem nächsten Update der Website, soll eine Passwort vergessen, sowie eine User Aktivierung hinzugefügt werden. <br>Außerdem werden Usergroups eingeführt.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `threads`
--

CREATE TABLE `threads` (
  `t_id` int(100) NOT NULL,
  `t_titel` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `t_inhalt` text COLLATE utf8_german2_ci NOT NULL,
  `t_datum` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `t_autor` varchar(50) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `threads`
--

INSERT INTO `threads` (`t_id`, `t_titel`, `t_inhalt`, `t_datum`, `t_autor`) VALUES
(1, 'Test Thread', 'Das hier ist das Forum', '28-01-2020', 'Callmemaybex');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_uname` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `u_password` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `u_name` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `u_vname` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `u_activated` tinyint(4) NOT NULL,
  `u_email` varchar(50) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`u_id`, `u_uname`, `u_password`, `u_name`, `u_vname`, `u_activated`, `u_email`) VALUES
(1, 'hiimtwist', '9a1996efc97181f0aee18321aa3b3b12', 'Elbers', 'Merlin', 1, 'merlin.elbers@gmx.de'),
(2, 'Callmemaybex', 'f30aa7a662c728b7407c54ae6bfd27d1', 'Bange', 'Marcel', 1, 'marcelmarcel623@yahoo.de'),
(3, 'Gast', '', 'Host', 'Local', 1, 'gast@localhost.de'),
(4, 'KL', 'f30aa7a662c728b7407c54ae6bfd27d1', 'Kleine', 'Thomas', 1, 'th.kleine@hoenne-berufskolleg.de'),
(5, 'Testuser', 'f30aa7a662c728b7407c54ae6bfd27d1', 'User', 'Test', 1, 'test@user.de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `usergroups`
--

CREATE TABLE `usergroups` (
  `g_id` int(100) NOT NULL,
  `u_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `usergroups`
--

INSERT INTO `usergroups` (`g_id`, `u_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 3),
(2, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userklassen`
--

CREATE TABLE `userklassen` (
  `u_id` int(100) NOT NULL,
  `k_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `userklassen`
--

INSERT INTO `userklassen` (`u_id`, `k_id`) VALUES
(2, 1),
(1, 1),
(4, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `t_id` (`t_id`);

--
-- Indizes für die Tabelle `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`g_id`);

--
-- Indizes für die Tabelle `klassen`
--
ALTER TABLE `klassen`
  ADD PRIMARY KEY (`k_id`),
  ADD KEY `k_klassenlehrer` (`k_klassenlehrer`),
  ADD KEY `k_klassensprecher` (`k_klassensprecher`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`n_id`);

--
-- Indizes für die Tabelle `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`t_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indizes für die Tabelle `usergroups`
--
ALTER TABLE `usergroups`
  ADD KEY `g_id` (`g_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indizes für die Tabelle `userklassen`
--
ALTER TABLE `userklassen`
  ADD KEY `u_id` (`u_id`),
  ADD KEY `k_id` (`k_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `answers`
--
ALTER TABLE `answers`
  MODIFY `a_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `groups`
--
ALTER TABLE `groups`
  MODIFY `g_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `klassen`
--
ALTER TABLE `klassen`
  MODIFY `k_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `n_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `threads`
--
ALTER TABLE `threads`
  MODIFY `t_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `threads` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `klassen`
--
ALTER TABLE `klassen`
  ADD CONSTRAINT `klassen_ibfk_1` FOREIGN KEY (`k_klassenlehrer`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `klassen_ibfk_2` FOREIGN KEY (`k_klassensprecher`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `usergroups`
--
ALTER TABLE `usergroups`
  ADD CONSTRAINT `usergroups_ibfk_1` FOREIGN KEY (`g_id`) REFERENCES `groups` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usergroups_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `userklassen`
--
ALTER TABLE `userklassen`
  ADD CONSTRAINT `userklassen_ibfk_1` FOREIGN KEY (`k_id`) REFERENCES `klassen` (`k_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userklassen_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
