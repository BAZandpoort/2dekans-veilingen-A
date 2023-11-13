-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 nov 2023 om 16:06
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 7.4.29

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tblboden`
--

INSERT INTO `tblboden` (`productid`, `bod`, `gebruikersid`) VALUES
(3, '50.00', 2),
(1, '200.00', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcategorieen`
--

CREATE TABLE `tblcategorieen` (
  `categorienaam` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblchat`
--

CREATE TABLE `tblchat` (
  `gesprekID` int(11) NOT NULL,
  `ontvanger` mediumtext NOT NULL,
  `zenderVoornaam` mediumtext NOT NULL,
  `zenderAchternaam` varchar(9999) NOT NULL,
  `bericht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tblchat`
--

INSERT INTO `tblchat` (`gesprekID`, `ontvanger`, `zenderVoornaam`, `zenderAchternaam`, `bericht`) VALUES
(2, '', 'klant', 'klant', 'test'),
(2, '', 'klant', 'klant', 'test'),
(2, '', 'klant', 'klant', 'test'),
(2, '', 'klant', 'klant', 'test'),
(2, '', 'klant', 'klant', 'test'),
(2, '', 'klant', 'klant', 'test'),
(2, '', 'klant', 'klant', 'ik wil dit niet fixen\r\n'),
(2, '', 'klant', 'klant', 'g'),
(2, '', 'klant', 'klant', 'g'),
(2, '', 'klant', 'klant', 'g'),
(2, '', 'klant', 'klant', 'help mij aub de chat is aan de foute kant'),
(2, '', 'klant', 'klant', 'ik wil niet meer zijn problemen oplossen help mij bro'),
(2, '', 'klant', 'klant', 'ik wil niet meer zijn problemen oplossen help mij bro'),
(2, '', 'klant', 'klant', 'nee'),
(2, 'admin', 'klant', 'klant', 'help mij aub'),
(2, 'Array', 'klant', 'klant', 'ik wil niet meer zijn problemen oplossen help mij bro'),
(2, 'Array', 'klant', 'klant', 'ah shit here we go again'),
(2, 'admin', 'klant', 'klant', 'pls werk'),
(2, 'admin', 'klant', 'klant', 'werkt'),
(2, 'admin', 'admin', 'admin', 'ja wat is er?'),
(2, '', 'admin', 'admin', 'broer fuck of'),
(2, 'klant', 'admin', 'admin', 'h'),
(2, '', 'admin', 'admin', 'lol'),
(2, '', 'admin', 'admin', 'd'),
(2, 'klant', 'admin', 'admin', 'd'),
(2, '', 'admin', 'admin', 'd'),
(2, 'klant', 'admin', 'admin', 'd'),
(2, 'klant', 'admin', 'admin', 'ehehehehbe'),
(2, 'klant', 'admin', 'admin', 'bleh'),
(2, 'klant', 'admin', 'admin', '123'),
(2, 'klant', 'admin', 'admin', '123'),
(2, 'klant', 'admin', 'admin', '123'),
(2, 'klant', 'admin', 'admin', '123'),
(2, 'klant', 'admin', 'admin', '123'),
(2, 'klant', 'admin', 'admin', 'hallo'),
(2, 'admin', 'klant', 'klant', 'hy ik heb een vraag'),
(2, 'admin', 'klant', 'klant', 'lolololololollallalalalalala'),
(2, 'admin', 'klant', 'klant', 'how are you doing bitch'),
(2, 'admin', 'klant', 'klant', 'hallo'),
(2, 'klant', 'admin', 'admin', 'test'),
(2, 'klant', 'admin', 'admin', 'fuck bro ik krijg hier notificaties van dus stuur minder je bezorgd mij werk op een maandag morgend assholle\r\n'),
(2, 'admin', 'admin', 'admin', 'yes dit werkt'),
(9724258, 'admin', 'admin', 'admin', 'test'),
(9724258, 'admin', 'admin', 'admin', 'test'),
(9724258, 'admin', 'admin', 'admin', 'test'),
(9724258, 'admin', 'admin', 'admin', 'lol'),
(9724258, 'admin', 'admin', 'admin', 'lol'),
(9724258, 'admin', 'admin', 'admin', ''),
(9724258, 'admin', 'admin', 'admin', ''),
(9724258, '', 'admin', 'admin', 'test'),
(40, 'admin', 'admin', 'admin', 'test'),
(40, 'admin', 'admin', 'admin', 'lol'),
(40, 'admin', 'admin', 'admin', 'dit fucking werkt'),
(0, 'admin', 'admin', 'admin', 'test'),
(0, 'admin', 'admin', 'admin', 'lol dit werkt \r\n'),
(0, 'admin', 'admin', 'admin', 'fuck this mutherfucker'),
(5, 'admin', 'admin', 'admin', 'hallo'),
(5, '', 'admin', 'admin', '');

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
  `beschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tblgebruikers`
--

INSERT INTO `tblgebruikers` (`gebruikerid`, `email`, `voornaam`, `naam`, `wachtwoord`, `admin`, `status`, `profielfoto`, `beschrijving`) VALUES
(3, 'klant@klant.com', 'klant', 'klant', '$2y$10$q9w7n4wnb7bgOmr0XjNqquDdB5k5L7DceoQZdfRU.eLi/eag29hx2', 0, '', 'achtergrond.jpg', 'qsdfsq'),
(4, 'admin@admin.com', 'admin', 'admin', '$2y$10$vacIByzhbUwB34krJYtYLuQQlLjXTcsbNOWvqbr4tJHDqvrx3XTCK', 0, '', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 'admin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblnotifications`
--

CREATE TABLE `tblnotifications` (
  `id` int(11) NOT NULL,
  `notificatie` text NOT NULL,
  `ontvangersid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `link` varchar(9999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tblnotifications`
--

INSERT INTO `tblnotifications` (`id`, `notificatie`, `ontvangersid`, `status`, `link`) VALUES
(8, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(9, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(10, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(11, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(12, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(13, 'Je hebt een nieuw bericht', 3, 0, 'chatSystem.php?user=3'),
(14, 'Je hebt een nieuw bericht', 3, 0, 'chatSystem.php?user=3'),
(15, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(16, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(17, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(18, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(19, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(20, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(21, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(22, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(23, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4'),
(24, 'Je hebt een nieuw bericht', 4, 0, 'chatSystem.php?user=4');

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
(1, 1, 'test4.jpg', 'a', '45', 'ddd', '', '2023-10-06 14:02:21', '2023-10-23 22:00:00'),
(3, 1, 'test4.jpg', 'ddd', '50', 'ddd', '', '2023-10-06 14:08:13', '2023-10-31 13:59:25'),
(4, 1, 'electric-guitar-rock-guitar-stringed-instrument-royalty-free-thumbnail.jpg', 'Moons Ruben', '7', '35413.453694.2465324.3524.146512.45', '', '2023-10-12 07:42:43', '2023-10-14 01:42:43'),
(5, 5, 'lol', 'lol', '30', 'lol', 'lol', '2023-10-13 09:51:11', '2023-10-19 09:50:26'),
(6, 6, 'lo2', 'lo2', '30', 'lo2', 'lo2', '2023-10-13 09:51:11', '2023-10-25 09:50:26'),
(7, 7, 'lol3', 'lol3', '30', 'lol3', 'lol3', '2023-10-13 09:52:02', '2023-10-12 09:51:24'),
(8, 8, 'lol4', 'lol4', '30', 'lol6', 'lol4', '2023-10-13 09:52:02', '2023-10-25 09:51:24'),
(9, 9, '', 'lol9', '30', 'lol9', 'lol9', '2023-10-13 09:54:04', '2023-10-25 09:53:47');

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
-- Indexen voor tabel `tblnotifications`
--
ALTER TABLE `tblnotifications`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `gebruikerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `tblnotifications`
--
ALTER TABLE `tblnotifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
