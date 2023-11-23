-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 nov 2023 om 10:06
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

--
-- Gegevens worden geëxporteerd voor tabel `tblboden`
--

INSERT INTO `tblboden` (`productid`, `bod`, `gebruikersid`) VALUES
(3, 50.00, 2),
(1, 200.00, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcategorieen`
--

CREATE TABLE `tblcategorieen` (
  `categorienaam` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('58710adb70b68111c779cd991eceeb65', '6', 5, 'chatSystem.php?user=6&chatid=58710adb70b68111c779cd991eceeb65');

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
(1, 1, 2, '2023-10-16 12:05:47', '');

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
(3, 'klant@klant.com', 'klant', 'klant', '$2y$10$q9w7n4wnb7bgOmr0XjNqquDdB5k5L7DceoQZdfRU.eLi/eag29hx2', 0, '', 'achtergrond.jpg', 'qsdfsq'),
(4, 'admin@admin.com', 'admin', 'admin', '$2y$10$vacIByzhbUwB34krJYtYLuQQlLjXTcsbNOWvqbr4tJHDqvrx3XTCK', 0, '', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 'admin'),
(5, 'jurn@gmail.com', 'Jurn', 'd', '$2y$10$ruREE7JPBkJ1DnG34XQ87.ouYjr56wgtpCQ1CZYLw1/6p9dLVJceW', 0, '', 'profile.png', 'd'),
(6, 'test@gmail.com', 'test', 'd', '$2y$10$aFsB1s.RN39QjQ.zq6ArgO7fV.X7kcBeFuyyfBRIXpbnC.TfJBm6i', 0, '', 'profile.png', 'd');

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
(1, 6, 'test4.jpg', 'a', 45, 'ddd', '', '2023-10-06 14:02:21', '2023-10-23 22:00:00'),
(3, 6, 'test4.jpg', 'ddd', 50, 'ddd', '', '2023-10-06 14:08:13', '2023-10-31 13:59:25'),
(4, 6, 'electric-guitar-rock-guitar-stringed-instrument-royalty-free-thumbnail.jpg', 'Moons Ruben', 7, '35413.453694.2465324.3524.146512.45', '', '2023-10-12 07:42:43', '2023-10-14 01:42:43'),
(5, 6, 'lol', 'lol', 30, 'lol', 'lol', '2023-10-13 09:51:11', '2023-10-19 09:50:26'),
(6, 6, 'lo2', 'lo2', 30, 'lo2', 'lo2', '2023-10-13 09:51:11', '2023-10-25 09:50:26'),
(7, 6, 'lol3', 'lol3', 30, 'lol3', 'lol3', '2023-10-13 09:52:02', '2023-10-12 09:51:24'),
(8, 6, 'lol4', 'lol4', 30, 'lol6', 'lol4', '2023-10-13 09:52:02', '2023-10-25 09:51:24'),
(9, 6, '', 'lol9', 30, 'lol9', 'lol9', '2023-10-13 09:54:04', '2023-10-25 09:53:47');

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
  MODIFY `gebruikerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `tblrapporten`
--
ALTER TABLE `tblrapporten`
  MODIFY `rapportid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
