-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 03 okt 2023 om 09:27
-- Serverversie: 8.0.27
-- PHP-versie: 7.4.26

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

DROP TABLE IF EXISTS `tblboden`;
CREATE TABLE IF NOT EXISTS `tblboden` (
  `productid` int NOT NULL,
  `bod` decimal(10,2) NOT NULL,
  `gebruikersid` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcategorieen`
--

DROP TABLE IF EXISTS `tblcategorieen`;
CREATE TABLE IF NOT EXISTS `tblcategorieen` (
  `categorienaam` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblfacturen`
--

DROP TABLE IF EXISTS `tblfacturen`;
CREATE TABLE IF NOT EXISTS `tblfacturen` (
  `factuurid` int NOT NULL AUTO_INCREMENT,
  `productid` int NOT NULL,
  `koperid` int NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `factuurpdf` blob NOT NULL,
  PRIMARY KEY (`factuurid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblfavorieten`
--

DROP TABLE IF EXISTS `tblfavorieten`;
CREATE TABLE IF NOT EXISTS `tblfavorieten` (
  `productid` int NOT NULL,
  `gebruikerid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblgebruikers`
--

DROP TABLE IF EXISTS `tblgebruikers`;
CREATE TABLE IF NOT EXISTS `tblgebruikers` (
  `gebruikerid` int NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `voornaam` text COLLATE utf8mb4_general_ci NOT NULL,
  `naam` text COLLATE utf8mb4_general_ci NOT NULL,
  `wachtwoord` text COLLATE utf8mb4_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `status` text COLLATE utf8mb4_general_ci NOT NULL,
  `profielfoto` text COLLATE utf8mb4_general_ci NOT NULL,
  `beschrijving` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`gebruikerid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblproducten`
--

DROP TABLE IF EXISTS `tblproducten`;
CREATE TABLE IF NOT EXISTS `tblproducten` (
  `productid` int NOT NULL AUTO_INCREMENT,
  `verkoperid` int NOT NULL,
  `foto` text COLLATE utf8mb4_general_ci NOT NULL,
  `naam` text COLLATE utf8mb4_general_ci NOT NULL,
  `prijs` decimal(10,0) NOT NULL,
  `beschrijving` text COLLATE utf8mb4_general_ci NOT NULL,
  `categorie` text COLLATE utf8mb4_general_ci NOT NULL,
  `startdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eindtijd` timestamp NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblrapporten`
--

DROP TABLE IF EXISTS `tblrapporten`;
CREATE TABLE IF NOT EXISTS `tblrapporten` (
  `rapportid` int NOT NULL AUTO_INCREMENT,
  `gebruikerid` int NOT NULL,
  `melderid` int NOT NULL,
  `reden` text COLLATE utf8mb4_general_ci NOT NULL,
  `behandeld` tinyint(1) NOT NULL,
  PRIMARY KEY (`rapportid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
