-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 nov 2023 om 20:21
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
  `bodenId` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `bod` decimal(10,2) NOT NULL,
  `gebruikersid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcache`
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
CREATE TABLE `tblcache` (
  `cacheid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL,
  `cachenaam` varchar(255) NOT NULL,
  `cachewaarde` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcategorieen`
--

CREATE TABLE `tblcategorieen` (
  `categorienaam` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tblcategorieen`
--

INSERT INTO `tblcategorieen` (`categorienaam`) VALUES
('elektronica'),
('speelgoed');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblfavorieten`
--

CREATE TABLE `tblfavorieten` (
  `productid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `theme` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblgebruikers`
--

INSERT INTO `tblgebruikers` (`gebruikerid`, `email`, `voornaam`, `naam`, `wachtwoord`, `admin`, `status`, `profielfoto`, `beschrijving`, `theme`) VALUES
(1, 'jurn@gmail.com', 'jurn', 'dd', '$2y$10$5OywTtSKA8vNv3pX/rX9.eYDRMIuu2xyfHZcTAebkxf/IXeW2W2la', 0, '', 'monkey.jpg', '', ''),
(2, 'test@gmail.com', 'test', 'dd', '$2y$10$6kylllePP7cds53wXeDfguP0V/uBDumcTZoUFcqYPz1Io2173U75u', 0, '', 'profile.png', 'dd', 'dark'),
(3, 'casper.nauwelaerts@gmail.com', 'Casper', 'Nauwelaerts', '$2y$10$6aHJLkvvreVnKfS4676qb.ZleoPjlTU1G5Q4IxiiLo.BYFVyf4UDi', 0, '', 'profile.png', 'xdfhxd', 'retro'),
(4, 'casper@bazandpoort.be', 'Casper', 'Nauwelaerts', '$2y$10$6bLlGEUgnN5xJ/KgBN5ujeqkw3PqUYCRuds0IA6JnzQ.Lc5fZPmK2', 0, '', 'profile.png', 'tycjctcyt', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tblproducten`
--

INSERT INTO `tblproducten` (`productid`, `verkoperid`, `foto`, `naam`, `prijs`, `beschrijving`, `categorie`, `startdatum`, `eindtijd`) VALUES
(1, 1, 'monkey.jpg', 'grasmaaier', '22', 'Dit is een grasmaaier.', 'speelgoed', '2023-10-06 13:45:32', '0000-00-00 00:00:00'),
(2, 1, 'Appelsap_voedingswaarde.jpg', 'gebouwhuis\r\n', '22', 'Dit is een grasmaaier.', 'speelgoed', '2023-10-06 13:45:32', '0000-00-00 00:00:00'),
(3, 1, 'RVIM5HMA_400x400.jpg', 'grasmaaier', '22', 'Dit is een grasmaaier.', 'elektronica\r\n', '2023-10-06 13:45:32', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tblboden`
--
ALTER TABLE `tblboden`
  ADD PRIMARY KEY (`bodenId`);
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
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tblboden`
--
ALTER TABLE `tblboden`
  MODIFY `bodenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
-- AUTO_INCREMENT voor een tabel `tblcache`
--
ALTER TABLE `tblcache`
  MODIFY `cacheid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `tblfacturen`
--
ALTER TABLE `tblfacturen`
  MODIFY `factuurid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tblgebruikers`
--
ALTER TABLE `tblgebruikers`
  MODIFY `gebruikerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `tblrapporten`
--
ALTER TABLE `tblrapporten`
  MODIFY `rapportid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;