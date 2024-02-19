-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 feb 2024 om 19:18
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
(25, 3, 3.00, 2),
(26, 1, 23.00, 2),
(27, 4, 100.00, 2),
(28, 4, 100.01, 2),
(29, 5, 51.00, 17),
(30, 6, 100.00, 12),
(31, 6, 4444.00, 12);

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
(10, 12, 'jurn@gmail.com', '$2y$10$zdDHPimaJCSfTZDh5nZjyO3778FUI/1idR4ejHb0b4B29A9V75PzO'),
(11, 12, 'jurn@gmail.com', '$2y$10$b3y8fGgVGQC6EHda4XHz9./e0X6rfUxzVduoKbPf/.UpyQyF12wJ.'),
(12, 12, 'jurn@gmail.com', '$2y$10$Tdjy0On5YEgpWZGxTk1nL.c8kFGm07N39kEHSigElZfmgJH1QB20C'),
(13, 12, 'jurn@gmail.com', '$2y$10$E68Jub7AaIuyZd4A7U2IhejIcBLXKljgq.wQevxbaP58IBx5xS.Xy'),
(14, 12, 'jurn@gmail.com', '$2y$10$K8MULh1m5JxdbwNYmy6wEe7xQJ9JwDLSL3GJpRVlatD7YySgy6TSC'),
(15, 12, 'jurn@gmail.com', '$2y$10$Q3C3nVFAGu2/b9d1TRK5kuzV5qIunpc8zcbcPVWtW96MANpNyY0Qi'),
(16, 2, 'test@gmail.com', '$2y$10$NtkJ4YiuvS78lZzV3KK6ie7f/xk3/MaGB7SWaMxmncpSDU8GR2//6'),
(17, 14, 'casper@gmail.com', '$2y$10$BCIlkypKpig/PK9AXcYX0uoOOOlqGAvWnRizThNaxAu6woGwxvyFa'),
(18, 15, 'a@a', '$2y$10$3o4Q63r44qF74WI5Hq3d5eYqCZaGaHgqVzMvZkVk/7dNUlfJHuPXi'),
(19, 16, 'de@de.de', '$2y$10$z3PiBI1DV0AYtP8wMlGWWu./eGk4D/hdDONFZIISemN5DlAG6fgZy'),
(20, 17, 'c@c.c', '$2y$10$xRvINsfBjhGxy8WB9l1HJ.LLXGTGCG6aLg5walyE53M4HdOSSXclO'),
(21, 18, 'cedric@mail.com', '$2y$10$N0iJ3MXaAu4nzmTp1gjKEOfGJ3LDUNi0bHewGW8x36huTAuB6JLQe'),
(22, 20, 'test@test', '$2y$10$uQQpaE8DwZuYOtFygFflCOpgIaDgM.LzkyORVFdC9R/iRAv6WInGG'),
(23, 26, 'n@n', '$2y$10$vzInAa5uTVFkHCrlGYSEueUhauKphlReGKJzpV7dPCjrWCGdbFHxm');

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
('speelgoed'),
('meubelen'),
('tuin'),
('huishouden'),
('kleren');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblchat`
--

CREATE TABLE `tblchat` (
  `gesprekid` text NOT NULL,
  `ontvangerid` int(11) NOT NULL,
  `zenderid` int(11) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblchat`
--

INSERT INTO `tblchat` (`gesprekid`, `ontvangerid`, `zenderid`, `link`) VALUES
('b297ec5f94065a29e3814852c3048730', 12, 12, 'chatSystem.php?user=12&chatid=b297ec5f94065a29e3814852c3048730'),
('6d9744eb93ebb9b051be3214493a8e99', 12, 2, 'chatSystem.php?user=12&chatid=6d9744eb93ebb9b051be3214493a8e99'),
('5e187cad21c4ea7a8a8149dc8d2d2615', 14, 14, 'chatSystem.php?user=14&chatid=5e187cad21c4ea7a8a8149dc8d2d2615'),
('14de6856f944d81e184a00a796321ac0', 18, 18, 'chatSystem.php?user=18&chatid=14de6856f944d81e184a00a796321ac0'),
('37be95d02ba4d8bf76b8d3f1577dbcdb', 20, 20, 'chatSystem.php?user=20&chatid=37be95d02ba4d8bf76b8d3f1577dbcdb');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblfacturen`
--

CREATE TABLE `tblfacturen` (
  `factuurid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `koperid` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `factuurpdf` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblfacturen`
--

INSERT INTO `tblfacturen` (`factuurid`, `productid`, `koperid`, `datum`, `factuurpdf`) VALUES
(3, 4, 2, '2024-01-08 14:29:54', NULL),
(4, 5, 17, '2024-01-22 14:30:07', NULL),
(6, 6, 12, '2024-01-22 14:42:42', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblfavorieten`
--

CREATE TABLE `tblfavorieten` (
  `productid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblfavorieten`
--

INSERT INTO `tblfavorieten` (`productid`, `gebruikerid`) VALUES
(4, 12),
(4, 2),
(7, 18);

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
  `status` text NOT NULL DEFAULT 'none',
  `profielfoto` text NOT NULL,
  `beschrijving` text NOT NULL,
  `adres` text NOT NULL,
  `theme` text NOT NULL,
  `reclame` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblgebruikers`
--

INSERT INTO `tblgebruikers` (`gebruikerid`, `email`, `voornaam`, `naam`, `wachtwoord`, `admin`, `status`, `profielfoto`, `beschrijving`, `adres`, `theme`, `reclame`) VALUES
(2, 'test@gmail.com', 'test', 'd', '$2y$10$hTvhQ4UCDxj16Il5J..qsOy48zFu0bUmnqHKefuI7q2YZqdp5IeCa', 0, 'none', 'profile.png', 'd', 'd', 'dark', NULL),
(3, 'nils@gmail.com', 'nils', 'd', '$2y$10$6aHJLkvvreVnKfS4676qb.ZleoPjlTU1G5Q4IxiiLo.BYFVyf4UDi', 0, '', 'profile.png', 'xdfhxd', '', 'dark', NULL),
(4, 'robi@gmail.com', 'Casper', 'Nauwelaerts', '$2y$10$6bLlGEUgnN5xJ/KgBN5ujeqkw3PqUYCRuds0IA6JnzQ.Lc5fZPmK2', 0, '', 'profile.png', 'tycjctcyt', '', 'dark', NULL),
(12, 'jurn@gmail.com', 'jurn', 'd', '$2y$10$jc8gaMBv98qnPJS7JpWQbO.U9eLCNCmB/iI.RPUyKH5aI6YB0/EAG', 0, 'none', 'profile.png', 'd', 's', 'dark', NULL),
(14, 'casper@gmail.com', 'casper', 'd', '$2y$10$0iYGZHD2RbUJRMkf.FN4re3hpu6fTvUz2lzgEIUa7S1SX1ciW6PuS', 0, 'none', 'monkey.jpg', 'd', 'd', 'retro', NULL),
(15, 'a@a', 'a', 'a', '$2y$10$jImoThSJFtLJhaYfILXY2OpcyaG.53BKxsPkRpWbWbBOkTrl8OW0e', 0, 'none', 'profile.png', 'a', 'aa', 'dark', NULL),
(16, 'de@de.de', 'd', 'd', '$2y$10$FYKUQCaTAusZSbAfak5ohOpU4TytaulQ1cfD3SQiuuVn8zy2PIf0u', 0, 'none', 'd.avif', 'd', 'd', 'dark', NULL),
(17, 'c@c.c', 'c', 'c', '$2y$10$bfjQ0cPC.bVwmpb43wYIx.WG4zAeNxUMiL8/9J3xy6AY9szKL13ga', 0, 'none', 'c.png', 'c', 'c', 'dark', 1),
(18, 'cedric@mail.com', 'Cédric', 'Verlinden', '$2y$10$hayEmGOxpxbxeBLfwrZ0XO6.qcuo8kvIT2F7m0Rcp.p150rz9qu86', 0, 'none', 'profile.png', '1', 'ABC ASS', 'retro', 1),
(20, 'test@test', 'Casper', 'dzdzdzd', '$2y$10$XulUoUgylC4dHR.6SwRM3OEzgLX8oqFusza05YcXbccd0AtMIByqC', 0, 'none', 'draak_water.jfif', 'fezgyfiucgtzey', 'feczveqvfeq23344', 'dark', 1),
(26, 'n@n', 'C', 'n', '$2y$10$IOgIM0AaIIvnVLoxklG1G.4PtPE1S.j0cXpHwd/jUo1JLC2A4uC/q', 0, 'none', 'download.png', 'ecfzvgfckezv', 'kut', 'dark', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblmessage`
--

CREATE TABLE `tblmessage` (
  `messageid` int(11) NOT NULL,
  `chatid` text NOT NULL,
  `zenderid` int(11) NOT NULL,
  `ontvangerid` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblmessage`
--

INSERT INTO `tblmessage` (`messageid`, `chatid`, `zenderid`, `ontvangerid`, `message`) VALUES
(1, 'b297ec5f94065a29e3814852c3048730', 12, 12, 'dddd'),
(2, 'b297ec5f94065a29e3814852c3048730', 12, 12, 'ddd'),
(3, '6d9744eb93ebb9b051be3214493a8e99', 2, 12, 'habba'),
(4, '6d9744eb93ebb9b051be3214493a8e99', 12, 12, 'dadada'),
(5, '14de6856f944d81e184a00a796321ac0', 18, 18, 'hi'),
(6, '14de6856f944d81e184a00a796321ac0', 18, 18, 'wsup\r\n'),
(7, '14de6856f944d81e184a00a796321ac0', 18, 18, '<h1>HELLO</h1>'),
(8, '14de6856f944d81e184a00a796321ac0', 18, 18, '<b>a</b>'),
(9, '14de6856f944d81e184a00a796321ac0', 18, 18, '<a href=\"google.com\" target\"_blank\">hello click me pls</a>'),
(10, '14de6856f944d81e184a00a796321ac0', 18, 18, '<a href=\"google.com\" target\"_blank\">hello click me pls</a>'),
(11, '14de6856f944d81e184a00a796321ac0', 18, 18, '<a href=\"http://google.com\" target\"_blank\"=\"\">hello click me pls</a>'),
(12, '14de6856f944d81e184a00a796321ac0', 18, 18, '<a href=\"https://app.feetfinder.com/signin\" target\"_blank\"=\"\">hello, cute cat here</a>'),
(13, '14de6856f944d81e184a00a796321ac0', 18, 18, '<a href=\"https://app.feetfinder.com/signin\" target=\"_blank\">hello, cute cat here</a>');

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
(8, 26, 'download.png', 'Bert', 300, 'vgezhkvcgtzey', 'speelgoed', '2024-02-18 16:34:52', '2024-02-20 16:34:52'),
(9, 26, '11817848-waterdraak-geïsoleerd-op-wit.jpg', 'A', 10000, 'fdezfhzejkbvfchze', 'kleren', '2024-02-18 16:35:25', '2024-02-20 16:35:25'),
(10, 20, 'draak_water.jfif', 'gceyzivfy', 900, 'gfyezougfy', 'tuin', '2024-02-18 16:38:59', '2024-02-20 04:38:59'),
(11, 20, 'adss.png', 'hgutlr', 300, 'vdgzhekzsg', 'meubelen', '2024-02-18 16:39:21', '2024-02-19 16:39:21');

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
  MODIFY `bodenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT voor een tabel `tblcache`
--
ALTER TABLE `tblcache`
  MODIFY `cacheid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `tblfacturen`
--
ALTER TABLE `tblfacturen`
  MODIFY `factuurid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `tblgebruikers`
--
ALTER TABLE `tblgebruikers`
  MODIFY `gebruikerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT voor een tabel `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `tblrapporten`
--
ALTER TABLE `tblrapporten`
  MODIFY `rapportid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;