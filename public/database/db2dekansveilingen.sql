-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 okt 2023 om 22:20
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.0.28

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

--
-- Gegevens worden geëxporteerd voor tabel `tblboden`
--

INSERT INTO `tblboden` (`productid`, `bod`, `gebruikersid`) VALUES
(1, 20.00, 2),
(1, 21.50, 2),
(1, 22.40, 2),
(1, 30.67, 2),
(1, 31.80, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcategorieen`
--

CREATE TABLE `tblcategorieen` (
  `categorienaam` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `beschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblgebruikers`
--

INSERT INTO `tblgebruikers` (`gebruikerid`, `email`, `voornaam`, `naam`, `wachtwoord`, `admin`, `status`, `profielfoto`, `beschrijving`) VALUES
(1, 'jurn@gmail.com', 'jurn', 'dd', '$2y$10$5OywTtSKA8vNv3pX/rX9.eYDRMIuu2xyfHZcTAebkxf/IXeW2W2la', 0, '', 'monkey.jpg', ''),
(2, 'test@gmail.com', 'test', 'dd', '$2y$10$6kylllePP7cds53wXeDfguP0V/uBDumcTZoUFcqYPz1Io2173U75u', 0, '', 'profile.png', 'dd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblproducten`
--

CREATE TABLE `tblproducten` (
  `productid` int(11) NOT NULL,
  `verkoperid` int(11) NOT NULL,
  `foto` text NOT NULL,
  `naam` text NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `beschrijving` text NOT NULL,
  `categorie` text NOT NULL,
  `startdatum` timestamp NOT NULL DEFAULT current_timestamp(),
  `eindtijd` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblproducten`
--

INSERT INTO `tblproducten` (`productid`, `verkoperid`, `foto`, `naam`, `prijs`, `beschrijving`, `categorie`, `startdatum`, `eindtijd`) VALUES
(1, 1, '804-Grey-Worm.jpg', 'Test', 31.80, 'dd', '', '2023-10-12 20:09:14', '2023-10-14 08:09:14'),
(2, 2, 'images.jpg', 'ddd', 10.00, 'dd', '', '2023-10-12 20:16:34', '2023-10-14 14:16:34');

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
-- AUTO_INCREMENT voor een tabel `tblfacturen`
--
ALTER TABLE `tblfacturen`
  MODIFY `factuurid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tblgebruikers`
--
ALTER TABLE `tblgebruikers`
  MODIFY `gebruikerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `tblrapporten`
--
ALTER TABLE `tblrapporten`
  MODIFY `rapportid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
