-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 nov 2023 om 14:03
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db2dekansveilingen`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblboden`
--

CREATE TABLE `tblboden` (
  `productid` int(11) NOT NULL,
  `bod` decimal(10,2) NOT NULL,
  `gebruikersid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcache`
--

CREATE TABLE `tblcache` (
  `cacheid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL,
  `cachenaam` varchar(255) NOT NULL,
  `cachewaarde` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcategorieen`
--

CREATE TABLE `tblcategorieen` (
  `categorienaam` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblcategorieen`
--

INSERT INTO `tblcategorieen` (`categorienaam`) VALUES
('Sap');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblchat`
--

CREATE TABLE `tblchat` (
  `gesprekid` text NOT NULL,
  `ontvangerid` text NOT NULL,
  `zenderid` int(11) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblchat`
--

INSERT INTO `tblchat` (`gesprekid`, `ontvangerid`, `zenderid`, `link`) VALUES
('edff554a7101d1f11bfc37ecee460ce6', '8', 7, 'chatSystem.php?user=8&chatid=edff554a7101d1f11bfc37ecee460ce6');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblfacturen`
--

CREATE TABLE `tblfacturen` (
  `factuurid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `koperid` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `factuurpdf` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblfavorieten`
--

CREATE TABLE `tblfavorieten` (
  `productid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblgebruikers`
--

CREATE TABLE `tblgebruikers` (
  `gebruikerid` int(11) NOT NULL,
  `email` text NOT NULL,
  `voornaam` text NOT NULL,
  `naam` text NOT NULL,
  `wachtwoord` text NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `status` text NOT NULL,
  `profielfoto` text NOT NULL,
  `beschrijving` text NOT NULL,
  `adres` text NOT NULL,
  `theme` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblgebruikers`
--

INSERT INTO `tblgebruikers` (`gebruikerid`, `email`, `voornaam`, `naam`, `wachtwoord`, `admin`, `status`, `profielfoto`, `beschrijving`, `adres`, `theme`) VALUES
(7, 'nils@gmail.com', 'Nils', 'Van de Velde', '$2y$10$AbPFa5UMFAk3INfdc3zXO.e5J.aelt5o9Vq8w.rhS3yfmpT1HwoO2', 0, '', 'RVIM5HMA_400x4001.jpg', 'admin acc', '', ''),
(8, 'de@de.de', 'de', 'de', '$2y$10$7xic70cKqsb6vISj1V82j.BkVQDwqtf/FL.3aR3wkaIx1D.SYJNeu', 0, '', 'art1.png', 'de verkoper', '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblmessage`
--

CREATE TABLE `tblmessage` (
  `messageid` int(11) NOT NULL,
  `chatid` int(11) NOT NULL,
  `zenderid` int(11) NOT NULL,
  `ontvangerid` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblmessage`
--

INSERT INTO `tblmessage` (`messageid`, `chatid`, `zenderid`, `ontvangerid`, `message`) VALUES
(1, 0, 7, 8, 'hallo meneer de verkoper'),
(2, 0, 7, 8, 'ik zou graag uw sap hebben voor 1.80 euro'),
(3, 0, 8, 8, 'de minimum prijs is 2 euro meneer'),
(4, 0, 8, 8, 'heeft u dyslexie???'),
(5, 0, 7, 8, 'dssf'),
(6, 0, 7, 8, 'kut kop'),
(7, 0, 7, 8, 'gierighaard\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nµ\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(8, 0, 7, 8, 'gierig\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\ns'),
(9, 0, 7, 8, 'd\r\n\r\nd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblproducten`
--

CREATE TABLE `tblproducten` (
  `productid` int(11) NOT NULL,
  `verkoperid` int(11) NOT NULL,
  `foto` text NOT NULL,
  `naam` text NOT NULL,
  `prijs` decimal(10,0) NOT NULL,
  `beschrijving` text NOT NULL,
  `categorie` text NOT NULL,
  `startdatum` timestamp NOT NULL DEFAULT current_timestamp(),
  `eindtijd` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblproducten`
--

INSERT INTO `tblproducten` (`productid`, `verkoperid`, `foto`, `naam`, `prijs`, `beschrijving`, `categorie`, `startdatum`, `eindtijd`) VALUES
(10, 8, 'Appelsap_voedingswaarde1.jpg', 'sap', 2, 'lekker sappig sap van sap', 'Sap', '2023-11-24 08:40:48', '2023-11-24 14:40:48');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblrapporten`
--

CREATE TABLE `tblrapporten` (
  `rapportid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL,
  `melderid` int(11) NOT NULL,
  `reden` text NOT NULL,
  `behandeld` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tblcache`
--
ALTER TABLE `tblcache`
  ADD PRIMARY KEY (`cacheid`);

--
-- Indexen voor tabel `tblfacturen`
--
ALTER TABLE `tblfacturen`
  ADD PRIMARY KEY (`factuurid`);

--
-- Indexen voor tabel `tblgebruikers`
--
ALTER TABLE `tblgebruikers`
  ADD PRIMARY KEY (`gebruikerid`);

--
-- Indexen voor tabel `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`messageid`);

--
-- Indexen voor tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  ADD PRIMARY KEY (`productid`);

--
-- Indexen voor tabel `tblrapporten`
--
ALTER TABLE `tblrapporten`
  ADD PRIMARY KEY (`rapportid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tblfacturen`
--
ALTER TABLE `tblfacturen`
  MODIFY `factuurid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `tblgebruikers`
--
ALTER TABLE `tblgebruikers`
  MODIFY `gebruikerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `tblrapporten`
--
ALTER TABLE `tblrapporten`
  MODIFY `rapportid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
