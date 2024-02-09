-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 jan 2024 om 16:17
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
-- Tabelstructuur voor tabel `maintenance`
--

CREATE TABLE `maintenance` (
  `Maintenance` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `maintenance`
--

INSERT INTO `maintenance` (`Maintenance`) VALUES
(0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblboden`
--

CREATE TABLE `tblboden` (
  `bodenId` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `bod` decimal(10,2) NOT NULL,
  `gebruikersid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblboden`
--

INSERT INTO `tblboden` (`bodenId`, `productid`, `bod`, `gebruikersid`) VALUES
(1, 1, 20.00, 2),
(2, 1, 21.50, 2),
(3, 1, 22.40, 2),
(4, 1, 30.67, 2),
(5, 1, 31.80, 2),
(6, 1, 32.00, 3),
(7, 1, 33.00, 3),
(8, 1, 34.00, 3),
(9, 1, 35.00, 3),
(21, 1, 52.00, 4),
(11, 1, 36.00, 3),
(12, 1, 37.00, 2),
(17, 1, 46.00, 2),
(14, 1, 39.00, 4),
(15, 1, 40.00, 2),
(16, 1, 45.00, 2),
(18, 1, 47.00, 2),
(19, 1, 50.00, 4),
(20, 1, 51.00, 4),
(22, 1, 67788.00, 4),
(23, 1, 7000000.00, 3),
(24, 3, 2.00, 3),
(25, 3, 3.00, 2);

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

--
-- Gegevens worden geëxporteerd voor tabel `tblcache`
--

INSERT INTO `tblcache` (`cacheid`, `gebruikerid`, `cachenaam`, `cachewaarde`) VALUES
(10, 12, 'beoordeling@gmail.hu', '$2y$10$EhD6YAfMWfDRJfzeQlz22ur77XVMR5rTFpjgauOg5Kj1NYhW7o7vy'),
(11, 14, 'rater@gmail.com', '$2y$10$mj6/8rPIzVZWZvHaJqBBk.mhyta5MsAkdmjM3f8VFUS8t6ZlvvXm6');

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
('elektronica'),
('speelgoed');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblchat`
--

CREATE TABLE `tblchat` (
  `ontvangerid` int(11) NOT NULL,
  `zenderid` int(11) NOT NULL,
  `gesprekid` int(11) NOT NULL,
  `link` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblchat`
--

INSERT INTO `tblchat` (`ontvangerid`, `zenderid`, `gesprekid`, `link`) VALUES
(12, 12, 4, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 3, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 85, 0),
(12, 12, 2147483647, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 68, 0),
(12, 12, 7082, 0),
(12, 12, 596, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 665589, 0),
(12, 12, 2, 0),
(12, 12, 0, 0),
(12, 12, 96, 0),
(12, 12, 4, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 6, 0),
(12, 12, 3, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 9491, 0),
(12, 12, 6, 0),
(12, 12, 0, 0),
(12, 12, 54, 0),
(12, 12, 2, 0),
(12, 12, 0, 0),
(12, 12, 2147483647, 0),
(12, 12, 81984272, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 12870, 0),
(12, 12, 7, 0),
(12, 12, 63, 0),
(12, 12, 2147483647, 0),
(12, 12, 0, 0),
(12, 12, 54, 0),
(12, 12, 97, 0),
(12, 12, 1, 0),
(12, 12, 0, 0),
(12, 12, 13232, 0),
(12, 12, 0, 0),
(12, 12, 6, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 12, 0, 0),
(12, 14, 33, 0),
(12, 14, 85, 0),
(12, 14, 270, 0),
(12, 14, 953, 0),
(12, 14, 0, 0),
(12, 14, 772, 0),
(12, 14, 2147483647, 0),
(12, 14, 0, 0),
(12, 14, 10000, 0),
(12, 14, 8, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 98, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 9, 0),
(12, 14, 0, 0),
(12, 14, 211, 0),
(12, 14, 1, 0),
(12, 14, 2147483647, 0),
(12, 14, 2147483647, 0),
(12, 14, 0, 0),
(12, 14, 3010896, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 5, 0),
(12, 14, 21, 0),
(12, 14, 8159, 0),
(12, 14, 4, 0),
(12, 14, 0, 0),
(12, 14, 4, 0),
(12, 14, 48, 0),
(12, 14, 7, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 4, 0),
(12, 14, 248, 0),
(12, 14, 90, 0),
(12, 14, 2, 0),
(12, 14, 5, 0),
(12, 14, 0, 0),
(12, 14, 8, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 4, 0),
(12, 14, 8479, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 1, 0),
(12, 14, 0, 0),
(12, 14, 623, 0),
(12, 14, 9, 0),
(12, 14, 6348, 0),
(12, 14, 0, 0),
(12, 14, 9113, 0),
(12, 14, 4, 0),
(12, 14, 7, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 1, 0),
(12, 14, 480, 0),
(12, 14, 137, 0),
(12, 14, 7, 0),
(12, 14, 3390, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 89, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 36, 0),
(12, 14, 67, 0),
(12, 14, 9, 0),
(12, 14, 4004, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 1, 0),
(12, 14, 52, 0),
(12, 14, 61277071, 0),
(12, 14, 2147483647, 0),
(12, 14, 151, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 3, 0),
(12, 14, 1, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 2147483647, 0),
(12, 14, 0, 0),
(12, 14, 123061463, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0),
(12, 14, 0, 0);

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

--
-- Gegevens worden geëxporteerd voor tabel `tblfacturen`
--

INSERT INTO `tblfacturen` (`factuurid`, `productid`, `koperid`, `datum`, `factuurpdf`) VALUES
(1, 1, 3, '0000-00-00 00:00:00', ''),
(2, 3, 2, '0000-00-00 00:00:00', '');

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
  `theme` text NOT NULL,
  `adres` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblgebruikers`
--

INSERT INTO `tblgebruikers` (`gebruikerid`, `email`, `voornaam`, `naam`, `wachtwoord`, `admin`, `status`, `profielfoto`, `beschrijving`, `theme`, `adres`) VALUES
(1, 'jurn@gmail.com', 'jurn', 'dd', '$2y$10$5OywTtSKA8vNv3pX/rX9.eYDRMIuu2xyfHZcTAebkxf/IXeW2W2la', 0, '', 'monkey.jpg', '', '', '0'),
(2, 'test@gmail.com', 'test', 'dd', '$2y$10$6kylllePP7cds53wXeDfguP0V/uBDumcTZoUFcqYPz1Io2173U75u', 0, '', 'profile.png', 'dd', 'dark', '0'),
(3, 'casper.nauwelaerts@gmail.com', 'Casper', 'Nauwelaerts', '$2y$10$6aHJLkvvreVnKfS4676qb.ZleoPjlTU1G5Q4IxiiLo.BYFVyf4UDi', 0, '', 'profile.png', 'xdfhxd', 'retro', '0'),
(4, 'casper@bazandpoort.be', 'Casper', 'Nauwelaerts', '$2y$10$6bLlGEUgnN5xJ/KgBN5ujeqkw3PqUYCRuds0IA6JnzQ.Lc5fZPmK2', 0, '', 'profile.png', 'tycjctcyt', '', '0'),
(12, 'beoordeling@gmail.hu', 'Beoordeeling', 'Beoordeling', '$2y$10$qfTg19r3xS00SwFsDrCEs.Fidc3RtB3Emz/RqCxrXkx/ecF/nATvK', 0, '', 'profile.png', 'fsdf', 'dark', '0'),
(13, '', '', '', '', 0, '', '', '', '', ''),
(14, 'rater@gmail.com', 'lol', 'lol', '$2y$10$M3OVZfWJ5dsmVhEtuULH7OWh4XgNL3/ZoSWjFydtVS8vyKvckqq5C', 0, '', 'profile.png', 'rater', 'dark', 'rater');

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
(1, 1, 'monkey.jpg', 'grasmaaier', 22, 'Dit is een grasmaaier.', 'speelgoed', '2023-10-06 13:45:32', '0000-00-00 00:00:00'),
(2, 1, 'Appelsap_voedingswaarde.jpg', 'gebouwhuis\r\n', 22, 'Dit is een grasmaaier.', 'speelgoed', '2023-10-06 13:45:32', '0000-00-00 00:00:00'),
(3, 1, 'RVIM5HMA_400x400.jpg', 'grasmaaier', 22, 'Dit is een grasmaaier.', 'elektronica\r\n', '2023-10-06 13:45:32', '0000-00-00 00:00:00'),
(4, 12, 'Nice__Sergii_Figurnyi_-_AdobeStock.jpg', 'test', 30, 'fsfqsdf', 'elektronica', '2024-01-26 13:02:33', '2024-01-28 07:02:33');

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblrating`
--

CREATE TABLE `tblrating` (
  `recentieID` int(11) NOT NULL,
  `gebruikersID` int(11) NOT NULL,
  `raterID` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblrating`
--

INSERT INTO `tblrating` (`recentieID`, `gebruikersID`, `raterID`, `rate`) VALUES
(1, 12, 14, 3);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tblboden`
--
ALTER TABLE `tblboden`
  ADD PRIMARY KEY (`bodenId`);

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
-- Indexen voor tabel `tblrating`
--
ALTER TABLE `tblrating`
  ADD PRIMARY KEY (`recentieID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tblboden`
--
ALTER TABLE `tblboden`
  MODIFY `bodenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `tblcache`
--
ALTER TABLE `tblcache`
  MODIFY `cacheid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `tblfacturen`
--
ALTER TABLE `tblfacturen`
  MODIFY `factuurid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `tblgebruikers`
--
ALTER TABLE `tblgebruikers`
  MODIFY `gebruikerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `tblrapporten`
--
ALTER TABLE `tblrapporten`
  MODIFY `rapportid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tblrating`
--
ALTER TABLE `tblrating`
  MODIFY `recentieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
