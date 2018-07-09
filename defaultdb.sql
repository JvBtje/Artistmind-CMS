-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 jul 2018 om 22:24
-- Serverversie: 10.1.30-MariaDB
-- PHP-versie: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `defaultdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `alllanguage`
--

CREATE TABLE `alllanguage` (
  `Id` int(11) NOT NULL,
  `Language` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso6392code` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `alllanguage`
--

INSERT INTO `alllanguage` (`Id`, `Language`, `iso6392code`) VALUES
(7, 'Nederlands', 'nld'),
(8, 'English', 'eng'),
(9, 'French', 'fra'),
(10, 'Spanish', 'spa'),
(11, 'Arabic', 'ara'),
(12, 'Chinese', 'zho'),
(13, 'Korean', 'kor'),
(14, 'Italian', 'ita'),
(15, 'Czech', 'ces'),
(16, 'Hebrew', 'heb'),
(17, 'German', 'deu'),
(18, 'Portuguese', 'por'),
(19, 'Russian', 'rus'),
(20, 'Japanese', 'jpn'),
(21, 'Vietnamese', 'vie'),
(22, 'Greek', 'ell'),
(23, 'Hindi', 'Hin'),
(24, 'Turkish', 'tur'),
(25, 'Afrikaans', 'afr'),
(26, 'Albanian', 'sqi'),
(27, 'Belarusian', 'bel'),
(28, 'Bulgarian', 'Bul'),
(29, 'Catalan', 'cat'),
(30, 'Croatian', 'hrv'),
(31, 'Danish', 'dan'),
(32, 'Estonian', 'est'),
(33, 'Finnish', 'fin'),
(34, 'Galician', 'glg'),
(35, 'Hungarian', 'hun'),
(36, 'Islandic', 'isl'),
(37, 'Indonesian', 'msa'),
(38, 'Irish', 'gle'),
(39, 'Italian', 'ita'),
(40, 'Latvian', 'lav'),
(41, 'Lithuanian', 'lit'),
(42, 'Macedonian', 'mkd'),
(43, 'Malay', 'msa'),
(44, 'Maltese', 'mlt'),
(45, 'Norwegian', 'nor'),
(46, 'Persian', 'fas'),
(47, 'Polish', 'pol'),
(48, 'Romanian', 'ron'),
(49, 'Serbian', 'srp'),
(50, 'Slovak', 'slk'),
(51, 'Slovene', 'slv'),
(52, 'Swahili', 'swa'),
(53, 'Swedish', 'swe'),
(54, 'Tagalog', 'tlg'),
(55, 'Thai', 'tha'),
(56, 'Ukrainian', 'ukr'),
(57, 'Welsh', 'cym');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `embedder`
--

CREATE TABLE `embedder` (
  `Id` int(11) NOT NULL,
  `EmbedderId` int(11) NOT NULL,
  `Tag` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formapplayment`
--

CREATE TABLE `formapplayment` (
  `Id` int(11) NOT NULL,
  `MainId` int(11) NOT NULL,
  `theName` text COLLATE utf8_unicode_ci,
  `theValue` text COLLATE utf8_unicode_ci,
  `theGroup` int(11) NOT NULL,
  `Language` int(11) NOT NULL,
  `theDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formfield`
--

CREATE TABLE `formfield` (
  `Id` int(11) NOT NULL,
  `Formid` int(11) NOT NULL,
  `Name` text COLLATE utf8_unicode_ci,
  `theValue` text COLLATE utf8_unicode_ci,
  `Type` enum('richtext','text','hidden','radio','checkbox','textarea','recieveremail','nextpage','submitbutton','Vertivicationcode','applyeremail') COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked` int(11) NOT NULL,
  `TheOrder` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `formrules` int(11) NOT NULL,
  `errormsg` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `forum`
--

CREATE TABLE `forum` (
  `Id` int(11) NOT NULL,
  `MainId` int(11) NOT NULL,
  `MaxLijst` int(11) NOT NULL,
  `TheDate` datetime NOT NULL,
  `Language` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `friends`
--

CREATE TABLE `friends` (
  `Id` int(11) NOT NULL,
  `User1` int(11) NOT NULL,
  `User2` int(11) NOT NULL,
  `Type` enum('Clear','Friend','Blocked','2Blocked','Pending') COLLATE utf8_unicode_ci DEFAULT NULL,
  `TheDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `galimg`
--

CREATE TABLE `galimg` (
  `Id` int(11) NOT NULL,
  `GalleryId` int(11) NOT NULL,
  `Theorder` int(11) NOT NULL,
  `Naam` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImgText` text COLLATE utf8_unicode_ci,
  `Url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gallery`
--

CREATE TABLE `gallery` (
  `Id` int(11) NOT NULL,
  `MainId` int(11) NOT NULL,
  `LargText` text COLLATE utf8_unicode_ci,
  `TheDate` datetime NOT NULL,
  `Language` int(11) NOT NULL,
  `ImageDetail` int(11) NOT NULL,
  `TumbSize` int(11) NOT NULL,
  `TumbRows` int(11) NOT NULL,
  `Tumbnailsquare` int(11) NOT NULL,
  `Messagetrue` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groepen`
--

CREATE TABLE `groepen` (
  `Id` int(11) NOT NULL,
  `Naam` text COLLATE utf8_unicode_ci,
  `Parent` int(11) NOT NULL,
  `TheOrder` int(11) NOT NULL,
  `theDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MainId` int(11) NOT NULL,
  `Type` text COLLATE utf8_unicode_ci,
  `Language` int(11) NOT NULL,
  `targetmainid` int(11) NOT NULL,
  `Menu` enum('Vertical','Horizontal','Hidden') COLLATE utf8_unicode_ci DEFAULT NULL,
  `Showtimestamp` int(11) NOT NULL,
  `Message` enum('Parent','No','Members','Groups','AllMembers','Public') COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastSaved` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PublishDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Publish` enum('Parent','No','Members','Groups','AllMembers','Public') COLLATE utf8_unicode_ci DEFAULT NULL,
  `basedocument` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groepentousergroepen`
--

CREATE TABLE `groepentousergroepen` (
  `Id` int(11) NOT NULL,
  `GroepenMainId` int(11) NOT NULL,
  `UserGroepenMainId` int(11) NOT NULL,
  `Type` enum('Publish','Message') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groepentousers`
--

CREATE TABLE `groepentousers` (
  `Id` int(11) NOT NULL,
  `GroepenMainId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Type` enum('Publish','Message') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groupmembers`
--

CREATE TABLE `groupmembers` (
  `Id` int(11) NOT NULL,
  `theGroup` int(11) NOT NULL,
  `theUser` int(11) NOT NULL,
  `Type` enum('Clear','Member','Blocked','Pending') COLLATE utf8_unicode_ci DEFAULT NULL,
  `TheDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `language`
--

CREATE TABLE `language` (
  `Id` int(11) NOT NULL,
  `Language` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso6392code` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `language`
--

INSERT INTO `language` (`Id`, `Language`, `iso6392code`) VALUES
(7, 'Nederlands', 'nld'),
(8, 'English', 'eng');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lijst`
--

CREATE TABLE `lijst` (
  `Id` int(11) NOT NULL,
  `MainId` int(11) NOT NULL,
  `SubGroupContent` int(11) NOT NULL,
  `MaxLijst` int(11) NOT NULL,
  `TheDate` datetime NOT NULL,
  `Language` int(11) NOT NULL,
  `ShowLijst` int(11) NOT NULL,
  `GroupToShow` int(11) NOT NULL,
  `Ordering2` enum('Date','Order','alfabet') COLLATE utf8_unicode_ci DEFAULT NULL,
  `Messagetrue` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `linkurenprojecten`
--

CREATE TABLE `linkurenprojecten` (
  `Id` int(11) NOT NULL,
  `IdUren` int(11) NOT NULL DEFAULT '0',
  `IdProjecten` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE `login` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TypeUser` enum('Member','Moderator','Admin','Nieuws') COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ErrorLogin` int(11) NOT NULL DEFAULT '0',
  `Nieuws` enum('uit','dag','week','maand') COLLATE utf8_unicode_ci DEFAULT NULL,
  `NieuwsDate` date NOT NULL,
  `Language` int(11) NOT NULL,
  `Email` text COLLATE utf8_unicode_ci,
  `Vertivicate` int(11) NOT NULL,
  `ProfileAcces` enum('Friends','Members','Public') COLLATE utf8_unicode_ci DEFAULT NULL,
  `Profilepic` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `login`
--

INSERT INTO `login` (`Id`, `Username`, `Password`, `TypeUser`, `LastLogin`, `Created`, `ErrorLogin`, `Nieuws`, `NieuwsDate`, `Language`, `Email`, `Vertivicate`, `ProfileAcces`, `Profilepic`) VALUES
(4, 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', '2018-07-09 18:24:24', '2009-02-19 07:00:00', 0, 'dag', '2018-03-18', 7, '', 0, 'Friends', './uploads/IMG_20180702_193901.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menu`
--

CREATE TABLE `menu` (
  `Id` int(11) NOT NULL,
  `Url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Window` enum('_blank','_parent','_self','_top') COLLATE utf8_unicode_ci DEFAULT NULL,
  `MainId` int(11) NOT NULL DEFAULT '0',
  `Naam` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TheOrder` int(11) NOT NULL DEFAULT '0',
  `Language` int(11) NOT NULL DEFAULT '0',
  `LargText` text COLLATE utf8_unicode_ci,
  `Largtext2` text COLLATE utf8_unicode_ci,
  `Largtext3` text COLLATE utf8_unicode_ci,
  `Largtext4` text COLLATE utf8_unicode_ci,
  `Largtext5` text COLLATE utf8_unicode_ci,
  `Largtext6` text COLLATE utf8_unicode_ci,
  `NumCol` int(11) NOT NULL DEFAULT '1',
  `ColWidth` int(11) NOT NULL DEFAULT '700',
  `ColHeigth` int(11) NOT NULL DEFAULT '20',
  `Largtext1bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext2bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext3bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext4bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext5bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext6bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HasSubMenu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `menu`
--

INSERT INTO `menu` (`Id`, `Url`, `Window`, `MainId`, `Naam`, `TheOrder`, `Language`, `LargText`, `Largtext2`, `Largtext3`, `Largtext4`, `Largtext5`, `Largtext6`, `NumCol`, `ColWidth`, `ColHeigth`, `Largtext1bg`, `Largtext2bg`, `Largtext3bg`, `Largtext4bg`, `Largtext5bg`, `Largtext6bg`, `HasSubMenu`) VALUES
(1, 'Login.php', '_self', 1, 'Login', 0, 7, '<br>', '', '', '', '', '', 1, 700, 20, '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menumember`
--

CREATE TABLE `menumember` (
  `Id` int(11) NOT NULL,
  `Url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Window` enum('_blank','_parent','_self','_top') COLLATE utf8_unicode_ci DEFAULT NULL,
  `MainId` int(11) NOT NULL DEFAULT '0',
  `Naam` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TheOrder` int(11) NOT NULL DEFAULT '0',
  `Language` int(11) NOT NULL DEFAULT '0',
  `LargText` text COLLATE utf8_unicode_ci,
  `Largtext2` text COLLATE utf8_unicode_ci,
  `Largtext3` text COLLATE utf8_unicode_ci,
  `Largtext4` text COLLATE utf8_unicode_ci,
  `Largtext5` text COLLATE utf8_unicode_ci,
  `Largtext6` text COLLATE utf8_unicode_ci,
  `NumCol` int(11) NOT NULL DEFAULT '1',
  `ColWidth` int(11) NOT NULL DEFAULT '700',
  `ColHeigth` int(11) NOT NULL DEFAULT '20',
  `Largtext1bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext2bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext3bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext4bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext5bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext6bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HasSubMenu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messagetext`
--

CREATE TABLE `messagetext` (
  `Id` int(11) NOT NULL,
  `Language` int(11) NOT NULL,
  `Replystext` text COLLATE utf8_unicode_ci,
  `Reply` text COLLATE utf8_unicode_ci,
  `Noreplyfound` text COLLATE utf8_unicode_ci,
  `introreply` text COLLATE utf8_unicode_ci,
  `Usernametext` text COLLATE utf8_unicode_ci,
  `emailtext` text COLLATE utf8_unicode_ci,
  `secretcodetext` text COLLATE utf8_unicode_ci,
  `insertsecretcodetext` text COLLATE utf8_unicode_ci,
  `informmetext` text COLLATE utf8_unicode_ci,
  `messagetext` text COLLATE utf8_unicode_ci,
  `messagebuttontext` text COLLATE utf8_unicode_ci,
  `Nomailtext` text COLLATE utf8_unicode_ci,
  `somebodyrespondtext` text COLLATE utf8_unicode_ci,
  `messageplaced` text COLLATE utf8_unicode_ci,
  `nomessagefound` text COLLATE utf8_unicode_ci,
  `emailisempty` text COLLATE utf8_unicode_ci,
  `messageisempty` text COLLATE utf8_unicode_ci,
  `usernameisempty` text COLLATE utf8_unicode_ci,
  `wrongsecretcode` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nieuwsbrief`
--

CREATE TABLE `nieuwsbrief` (
  `Id` int(11) NOT NULL,
  `Language` int(11) NOT NULL,
  `Aanmeldtekst` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AfmeldTekst` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Welkomtekstmessage` text COLLATE utf8_unicode_ci,
  `Afmeldtekstmessage` text COLLATE utf8_unicode_ci,
  `Nieuwsbriefnaam` text COLLATE utf8_unicode_ci,
  `Nieuwsbrieffooter` text COLLATE utf8_unicode_ci,
  `NieuwsbriefHeadding` text COLLATE utf8_unicode_ci,
  `MainId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `nieuwsbrief`
--

INSERT INTO `nieuwsbrief` (`Id`, `Language`, `Aanmeldtekst`, `AfmeldTekst`, `Welkomtekstmessage`, `Afmeldtekstmessage`, `Nieuwsbriefnaam`, `Nieuwsbrieffooter`, `NieuwsbriefHeadding`, `MainId`) VALUES
(1, 7, 'Aanmelden', 'Afmelden           ', 'De Artistmind Nieuwsbrief is een ideale manier om op de hoogte te blijven van de ontwikkelingen op artistmind.', 'Jammer dat u weg gaat ik hoop u snel nog een keer te zien', 'Artistmind Nieuwsbrief', '<a href=\"http://www.artistmind.nl/Whatsnew.php\" title=\"\" target=\"\">Berichten bekijken</a>', 'Dit is de artistmind Nieuwsbrief. Veel leesplezier gewenst', 1),
(3, 8, 'Subscribe', 'Unsubscribe ', 'Welcome to Artistmind', 'We hoop to see you soon', 'Artistmind Newsletter', 'If you want to unsubscribe you can do it &nbsp;<a href=\"http://www.artistmind.nl/nieuwsbrief.php\" title=\"\" target=\"\">here</a>.', 'This is the newsletter of today', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `projecten`
--

CREATE TABLE `projecten` (
  `Id` int(11) NOT NULL,
  `Omschrijving` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Uurtarief` float NOT NULL DEFAULT '0',
  `MainId` int(11) NOT NULL,
  `Language` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reclame`
--

CREATE TABLE `reclame` (
  `Id` int(11) NOT NULL,
  `MainId` int(11) NOT NULL,
  `Naam` text COLLATE utf8_unicode_ci,
  `TheOrder` int(11) NOT NULL,
  `Startdate` datetime NOT NULL,
  `Smalltext` text COLLATE utf8_unicode_ci,
  `TheDate` datetime NOT NULL,
  `TheGroup` int(11) NOT NULL,
  `Language` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reply`
--

CREATE TABLE `reply` (
  `Id` int(11) NOT NULL,
  `Bericht` longtext COLLATE utf8_unicode_ci,
  `TheDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ParentMainId` int(11) NOT NULL,
  `Email` longtext COLLATE utf8_unicode_ci,
  `Username` longtext COLLATE utf8_unicode_ci,
  `Language` int(11) NOT NULL,
  `ParentType` enum('richtext','forummsg','forum','user','url','photogallery','groep','lijst','privatemessage','usergroup','submessage') COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserId` int(11) NOT NULL,
  `MainId` int(11) NOT NULL,
  `Stat` enum('normal','deleted','history') COLLATE utf8_unicode_ci DEFAULT NULL,
  `Filelist` text COLLATE utf8_unicode_ci,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `richtext`
--

CREATE TABLE `richtext` (
  `Id` int(11) NOT NULL,
  `MainId` int(11) NOT NULL,
  `LargText` text COLLATE utf8_unicode_ci,
  `TheDate` datetime NOT NULL,
  `Language` int(11) NOT NULL,
  `Largtext2` text COLLATE utf8_unicode_ci,
  `Largtext3` text COLLATE utf8_unicode_ci,
  `Largtext4` text COLLATE utf8_unicode_ci,
  `Largtext5` text COLLATE utf8_unicode_ci,
  `Largtext6` text COLLATE utf8_unicode_ci,
  `NumCol` int(11) NOT NULL DEFAULT '1',
  `ColWidth` int(11) NOT NULL DEFAULT '700',
  `ColHeigth` int(11) NOT NULL DEFAULT '20',
  `Largtext1bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext2bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext3bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext4bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext5bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Largtext6bg` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Messagetrue` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `slides`
--

CREATE TABLE `slides` (
  `Id` int(11) NOT NULL,
  `IdGroup` int(11) NOT NULL,
  `Theorder` int(11) NOT NULL,
  `Imageurl` text COLLATE utf8_unicode_ci,
  `Url` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sounds`
--

CREATE TABLE `sounds` (
  `Id` int(11) NOT NULL,
  `Url` text COLLATE utf8_unicode_ci,
  `IdGal` int(11) NOT NULL,
  `TheOrder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `soundsmain`
--

CREATE TABLE `soundsmain` (
  `Id` int(11) NOT NULL,
  `Language` int(11) NOT NULL,
  `MainId` int(11) NOT NULL,
  `LargText` text COLLATE utf8_unicode_ci,
  `TheDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `system`
--

CREATE TABLE `system` (
  `Id` int(11) NOT NULL,
  `BackupEmail` text COLLATE utf8_unicode_ci,
  `LastBackup` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `submitemail` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submitreplyemail` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submitsenderemail` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DefaultLanguage` int(11) NOT NULL,
  `Nieuwsbrief` int(11) NOT NULL,
  `Backup` int(11) NOT NULL,
  `Nieuwsbriefwachttijd` enum('week','maand') COLLATE utf8_unicode_ci DEFAULT NULL,
  `Theme` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RedirectLogin` text COLLATE utf8_unicode_ci,
  `RedirectIndex` text COLLATE utf8_unicode_ci,
  `Redirect404` text COLLATE utf8_unicode_ci,
  `Redirect400` text COLLATE utf8_unicode_ci,
  `Redirect401` text COLLATE utf8_unicode_ci,
  `Redirect403` text COLLATE utf8_unicode_ci,
  `Redirect500` text COLLATE utf8_unicode_ci,
  `Listview` text COLLATE utf8_unicode_ci,
  `Listview2` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `system`
--

INSERT INTO `system` (`Id`, `BackupEmail`, `LastBackup`, `submitemail`, `submitreplyemail`, `submitsenderemail`, `DefaultLanguage`, `Nieuwsbrief`, `Backup`, `Nieuwsbriefwachttijd`, `Theme`, `RedirectLogin`, `RedirectIndex`, `Redirect404`, `Redirect400`, `Redirect401`, `Redirect403`, `Redirect500`, `Listview`, `Listview2`) VALUES
(1, '', '2018-04-01 01:10:05', '', '', '', 0, 1, 1, '', './Themes/default/', 'indexstandalone.php?plugin=Whatsnew', 'indexstandalone.php?plugin=Whatsnew', '', '', '', '', '', '<div id=\"listitiem\"><h4><a href=\"%listurl%\"> %listheading%</a></h4><a href=\"%listurl%\"><img src=\"./system/imgtumb.php?url=%listimage%&amp;maxsize=270&amp;aspectratio=0.56\"></a><br>%listtext% <h4><a href=\"%listurl%\"> meer...</a></h4></div>', '<div id=\"listitiem\"><div style=\"display:block;\"><h4><a href=\"%listurl%\"> %listheading%</a></h4>%listtext%<h4><a href=\"%listurl%\"> meer...</a></h4></div></div>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `themeoverride`
--

CREATE TABLE `themeoverride` (
  `Id` int(11) NOT NULL,
  `IdGroup` int(11) NOT NULL,
  `Themeurl` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `uren`
--

CREATE TABLE `uren` (
  `Id` int(11) NOT NULL,
  `StartDatumTijd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `EindDatumTijd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TheTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Omschrijving` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bedrag` float NOT NULL,
  `Uurtarief` float NOT NULL,
  `Type` enum('uren','uitgaven','inkomsten') COLLATE utf8_unicode_ci DEFAULT NULL,
  `User` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `usergroepen`
--

CREATE TABLE `usergroepen` (
  `Id` int(11) NOT NULL,
  `Naam` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Parent` int(11) NOT NULL,
  `TheOrder` int(11) NOT NULL,
  `theDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MainId` int(11) NOT NULL,
  `Type` enum('Closed','Open') COLLATE utf8_unicode_ci DEFAULT NULL,
  `Language` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `alllanguage`
--
ALTER TABLE `alllanguage`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `embedder`
--
ALTER TABLE `embedder`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `formapplayment`
--
ALTER TABLE `formapplayment`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `formfield`
--
ALTER TABLE `formfield`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `galimg`
--
ALTER TABLE `galimg`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `groepen`
--
ALTER TABLE `groepen`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `groepentousergroepen`
--
ALTER TABLE `groepentousergroepen`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `groepentousers`
--
ALTER TABLE `groepentousers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `groupmembers`
--
ALTER TABLE `groupmembers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `lijst`
--
ALTER TABLE `lijst`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `linkurenprojecten`
--
ALTER TABLE `linkurenprojecten`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexen voor tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `menumember`
--
ALTER TABLE `menumember`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `messagetext`
--
ALTER TABLE `messagetext`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `nieuwsbrief`
--
ALTER TABLE `nieuwsbrief`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `projecten`
--
ALTER TABLE `projecten`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `reclame`
--
ALTER TABLE `reclame`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `richtext`
--
ALTER TABLE `richtext`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `sounds`
--
ALTER TABLE `sounds`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `soundsmain`
--
ALTER TABLE `soundsmain`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `themeoverride`
--
ALTER TABLE `themeoverride`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `uren`
--
ALTER TABLE `uren`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `usergroepen`
--
ALTER TABLE `usergroepen`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `alllanguage`
--
ALTER TABLE `alllanguage`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT voor een tabel `embedder`
--
ALTER TABLE `embedder`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `formapplayment`
--
ALTER TABLE `formapplayment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `formfield`
--
ALTER TABLE `formfield`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `forum`
--
ALTER TABLE `forum`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `friends`
--
ALTER TABLE `friends`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `galimg`
--
ALTER TABLE `galimg`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `groepen`
--
ALTER TABLE `groepen`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `groepentousergroepen`
--
ALTER TABLE `groepentousergroepen`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `groepentousers`
--
ALTER TABLE `groepentousers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `groupmembers`
--
ALTER TABLE `groupmembers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `language`
--
ALTER TABLE `language`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `lijst`
--
ALTER TABLE `lijst`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `linkurenprojecten`
--
ALTER TABLE `linkurenprojecten`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `login`
--
ALTER TABLE `login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `menumember`
--
ALTER TABLE `menumember`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `messagetext`
--
ALTER TABLE `messagetext`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `nieuwsbrief`
--
ALTER TABLE `nieuwsbrief`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `projecten`
--
ALTER TABLE `projecten`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reclame`
--
ALTER TABLE `reclame`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reply`
--
ALTER TABLE `reply`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `richtext`
--
ALTER TABLE `richtext`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `slides`
--
ALTER TABLE `slides`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `sounds`
--
ALTER TABLE `sounds`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `soundsmain`
--
ALTER TABLE `soundsmain`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `system`
--
ALTER TABLE `system`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `themeoverride`
--
ALTER TABLE `themeoverride`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `uren`
--
ALTER TABLE `uren`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `usergroepen`
--
ALTER TABLE `usergroepen`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
