-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Jan 2020 um 20:52
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
(4, 1, 'Dies ist die neuste Antwort', 'hiimtwist', '29-01-2020 19:49:05');

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
(1, 'Version 1.25,4', '01-01-2020', 'Callmemaybex', 'Website eröffnung LOL');

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
(1, 'hiimtwist', 'f30aa7a662c728b7407c54ae6bfd27d1', 'Elbers', 'Merlin', 1, 'merlin.elbers@gmx.de'),
(2, 'Callmemaybex', 'f30aa7a662c728b7407c54ae6bfd27d1', 'Bange', 'Marcel', 1, 'marcelmarcel623@yahoo.de'),
(3, 'Gast', '', 'Host', 'Local', 1, 'gast@localhost.de');

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
(1, 2);

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
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `answers`
--
ALTER TABLE `answers`
  MODIFY `a_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `groups`
--
ALTER TABLE `groups`
  MODIFY `g_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `n_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `threads`
--
ALTER TABLE `threads`
  MODIFY `t_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `threads` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `usergroups`
--
ALTER TABLE `usergroups`
  ADD CONSTRAINT `usergroups_ibfk_1` FOREIGN KEY (`g_id`) REFERENCES `groups` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usergroups_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
