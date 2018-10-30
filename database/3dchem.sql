-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2018 at 11:28 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `3dchem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `last_login`) VALUES
(1, 'admin', 'admin', '2018-10-31 05:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `correct` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=237 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `quiz_id`, `question_id`, `answer`, `correct`) VALUES
(157, 4, 36, 'CH3 â€“ CH2 â€“ CH2 â€“ OH', '1'),
(158, 4, 36, 'CH3 â€“ CH2 â€“ CH2 â€“ CH2 â€“ CHO', '0'),
(159, 4, 36, 'CH3 â€“ CO â€“ CH3', '0'),
(160, 4, 36, 'CH3 â€“ CH2 â€“ CH2â€“CH2 â€“ CHO', '0'),
(173, 5, 40, 'Keton ', '1'),
(174, 5, 40, 'Ester ', '0'),
(175, 5, 40, 'Aldehid', '0'),
(176, 5, 40, 'Eter', '0'),
(177, 5, 41, 'Alkanal', '1'),
(178, 5, 41, 'Alkanon', '0'),
(179, 5, 41, 'Asam Alkanoat', '0'),
(180, 5, 41, 'Alkanoat', '0'),
(181, 5, 42, 'CnH2n+2O', '1'),
(182, 5, 42, 'CnH2nO', '0'),
(183, 5, 42, 'CnHO', '0'),
(184, 5, 42, 'CnH2O2', '0'),
(185, 5, 43, 'Asam Alkanoat', '1'),
(186, 5, 43, 'Alkanol', '0'),
(187, 5, 43, 'Alkoksialkana', '0'),
(188, 5, 43, 'Alkil Alkanoat', '0'),
(189, 5, 44, 'HCHO', '1'),
(190, 5, 44, 'CH3OH', '0'),
(191, 5, 44, 'CH3CHO', '0'),
(192, 5, 44, 'CH3COOH', '0'),
(193, 4, 35, 'Sifat suatu senyawa', '1'),
(194, 4, 35, 'Keisomeran suatu senyawa', '0'),
(195, 4, 35, 'Reaksi suatu senyawa', '0'),
(196, 4, 35, 'Sifat polar suatu senyawa', '0'),
(197, 4, 39, 'Etanol', '1'),
(198, 4, 39, 'Metanol', '0'),
(199, 4, 39, 'Propanol', '0'),
(200, 4, 39, 'Butanol', '0'),
(201, 4, 37, 'â€“CHO', '1'),
(202, 4, 37, 'â€“OH', '0'),
(203, 4, 37, 'â€“COORâ€™', '0'),
(204, 4, 37, 'â€“COH', '0'),
(205, 4, 38, 'Etil Aldehid', '1'),
(206, 4, 38, 'Butil Aldehid', '0'),
(207, 4, 38, 'Propil Aldehid', '0'),
(208, 4, 38, 'Metil Aldehid', '0'),
(215, 5, 45, 'adasd', '1'),
(216, 5, 45, 'aaaaa', '0'),
(217, 5, 45, 'degfr', '0'),
(218, 5, 45, 'efewf', '0'),
(223, 4, 48, 'Gitu deh', '1'),
(224, 4, 48, 'Ya', '0'),
(225, 4, 48, 'Tentu', '0'),
(226, 4, 48, 'Benar', '0'),
(227, 5, 47, 'uiop', '1'),
(228, 5, 47, 'qwerty', '0'),
(229, 5, 47, 'asdfg', '0'),
(230, 5, 47, 'hjklmn', '0'),
(231, 4, 49, 'Salah', '1'),
(232, 4, 49, 'Benar', '0'),
(233, 4, 50, 'Benar', '1'),
(234, 4, 50, 'Salah', '0'),
(235, 4, 51, 'Salah', '1'),
(236, 4, 51, 'Benar', '0');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `type` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `pass`, `type`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'koyume', '594f803b380a41396ed63dca39503542', 0),
(3, 'budi', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(4, 'ababa', '1feb2b05c3f7290ef291fd1ab4e7a97a', 0),
(5, 'muzzy', '3dc9ae7751542e333b4002717f2281dd', 0),
(6, 'Kemal', '1efcdbef601bde3fcd5d8bab43b01da3', 0),
(7, 'master', 'eb0a191797624dd3a48fa681d3061212', 0),
(8, 'alam', '133f19cfffb569f6447ebf073084a417', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id_artikel` int(11) NOT NULL AUTO_INCREMENT,
  `judul_artikel` varchar(70) NOT NULL,
  `tgl_terbit_artikel` datetime NOT NULL,
  `isi_artikel` text NOT NULL,
  PRIMARY KEY (`id_artikel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_artikel`, `judul_artikel`, `tgl_terbit_artikel`, `isi_artikel`) VALUES
(10, 'Tentang 3DChem', '2018-08-10 05:25:51', '&lt;p&gt;&lt;strong&gt;Apa itu 3DChem?&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;3DChem adalah sebuah multimedia interaktif berbasis web yang memvisualisasikan struktur tiga dimensi dari senyawa turunan alkana, dilengkapi dengan materi dan latihan serta dapat dijadikan media pembelajaran alternatif selain buku. Materi yang diajarkan dalam multimedia interaktif ini adalah materi senyawa turunan alkana. Multimedia interaktif ini dibangun menggunakan HTML5 disertai dengan teknologi WebGL untuk menampilkan visualisasi 3D dan kamu dapat berinteraksi langsung dengannya. Multimedia pembelajaran ini dapat diakses melalui browser di berbagai platform ternama.&lt;/p&gt;'),
(11, 'Tentang Kami', '2018-09-24 16:59:11', '&lt;p&gt;Dibuat oleh kami. Untukmu :)&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `code` varchar(9999) NOT NULL,
  `code_type` varchar(30) NOT NULL,
  `type` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_id`, `question`, `code`, `code_type`, `type`) VALUES
(35, 4, 35, 'Gugus fungsi dapat menentukan...', '', '', 'mc'),
(36, 4, 36, 'Berikut ini, manakah yang merupakan senyawa Alkanol?', '', '', 'mc'),
(37, 4, 37, 'Gugus fungsi dari Alkanal adalah...', '', '', 'mc'),
(38, 4, 38, 'Nama lazim dari struktur senyawa CH3CH2CHO adalah...', '', '', 'mc'),
(39, 4, 39, 'Alkohol yang paling banyak diproduksi dan dapat kita temukan dalam minuman berakohol adalah...', '', '', 'mc'),
(40, 5, 40, 'Nama lazim atau trivial dari Alkanon adalah...', '', '', 'mc'),
(41, 5, 41, 'Mengganti akhiran â€“a menjadi â€“al yang didahului dengan menyebutkan nama gugus alkil merupakan aturan penamaan IUPAC untuk...', '', '', 'mc'),
(42, 5, 42, 'Rumus Umum dari Alkanol dan Alkosialkana adalah....', '', '', 'mc'),
(43, 5, 43, 'Nama senyawa seperti Asam 2-metilpropanoat merupakan contoh penamaan IUPAC pada senyawa...', '', '', 'mc'),
(44, 5, 44, 'Senyawa Formaldehid memiliki strukturâ€¦..', '', '', 'mc'),
(45, 5, 45, 'aaaaaaa', '', '', 'mc'),
(47, 5, 47, 'sdsdsdsdsd', '', '', 'mc'),
(48, 4, 48, 'Ini budi, kan?', '', '', 'mc'),
(49, 4, 49, 'Masuk Pak eko', '', '', 'tf'),
(50, 4, 50, 'is', '', '', 'tf'),
(51, 4, 51, 'Tes', '', '', 'tf');

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

CREATE TABLE IF NOT EXISTS `quizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(50) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `display_questions` int(11) NOT NULL,
  `time_allotted` int(11) NOT NULL,
  `set_default` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `quizes`
--

INSERT INTO `quizes` (`id`, `quiz_id`, `quiz_name`, `total_questions`, `display_questions`, `time_allotted`, `set_default`) VALUES
(4, 4, 'Latihan Level 1', 10, 5, 10, 1),
(5, 5, 'Latihan Level 2', 6, 5, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_takers`
--

CREATE TABLE IF NOT EXISTS `quiz_takers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `percentage` varchar(24) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `quiz_takers`
--

INSERT INTO `quiz_takers` (`id`, `username`, `quiz_id`, `marks`, `percentage`, `date_time`, `duration`) VALUES
(3, '1245', 2, 0, '0', '2014-03-06 09:53:41', 5),
(4, '456789', 2, 1, '11.111111111111', '2014-03-06 09:54:35', 8),
(5, '1139095', 2, 1, '11.111111111111', '2014-03-06 10:20:01', 638),
(6, '45698777', 2, 0, '0', '2014-03-06 10:26:18', 298),
(7, '1139113', 1, 0, '0', '2014-03-06 10:27:14', 3079612),
(8, 'yoyo', 1, 4, '20', '2014-03-09 18:12:55', 61),
(11, 'yoyo', 2, 0, '0', '2014-03-09 18:17:18', 0),
(13, '1139113', 1, 0, '0', '2014-03-09 18:23:22', 3079612),
(14, '877656443', 2, 0, '0', '2014-03-09 18:35:07', 49),
(15, '0987', 2, 0, '0', '2014-03-09 18:36:23', 0),
(16, '1qaz', 2, 0, '0', '2014-03-09 18:39:33', 0),
(17, '1qaz22', 2, 0, '0', '2014-03-09 18:40:25', 0),
(18, '11qaz22', 2, 0, '0', '2014-03-09 18:40:49', 190),
(19, '123321', 2, 0, '0', '2014-03-09 20:33:35', 1472),
(20, '10', 2, 2, '22.222222222222', '2018-08-02 13:40:34', 20),
(21, 'AAAAA', 2, 3, '33.333333333333', '2018-08-02 13:45:18', 15),
(22, 'asaa', 2, 3, '33.333333333333', '2018-08-02 13:57:35', 14),
(23, 'Ababa', 2, 3, '33.333333333333', '2018-08-14 14:47:38', 18),
(24, 'aaaaaaaaa', 3, 0, '0', '2018-08-14 15:21:56', 48),
(25, 'ewfref', 3, 1, '100', '2018-08-14 15:23:45', 13),
(26, 'ewfrefj', 3, 0, '0', '2018-08-14 15:24:09', 0),
(27, 'ggg', 3, 0, '0', '2018-08-14 15:24:22', 0),
(28, 'eee', 3, 0, '0', '2018-08-14 15:24:32', 0),
(29, 'eeetht', 3, 1, '100', '2018-08-14 15:24:39', 5),
(30, 'eeethtthyju', 3, 1, '100', '2018-08-14 15:24:49', 5),
(31, 'ssss', 3, 0, '0', '2018-08-15 09:55:01', 4),
(32, 'rrrrr', 4, 3, '60', '2018-08-15 10:06:21', 28),
(33, 'tyh', 4, 0, '0', '2018-08-15 10:07:08', 0),
(34, 'xcxcx', 5, 4, '80', '2018-08-15 10:14:50', 59),
(35, 'eeeeeee', 4, 2, '40', '2018-08-15 10:15:58', 71),
(36, 'Budi', 4, 0, '0', '2018-08-15 10:48:41', 0),
(37, 'ggg', 4, 0, '0', '2018-08-15 10:49:06', 0),
(38, 'ooo', 4, 1, '20', '2018-08-15 10:51:22', 26),
(39, 'vbvbvc', 4, 1, '20', '2018-08-15 10:52:00', 8),
(40, 'sdsafrg', 4, 3, '60', '2018-08-15 10:58:38', 8),
(41, 'rtrjdgj', 4, 1, '20', '2018-08-15 10:59:22', 7),
(42, 'fdsfdset', 4, 1, '20', '2018-08-15 11:00:14', 9),
(43, 'ffdsfew', 4, 0, '0', '2018-08-15 11:01:55', 0),
(44, 'dfrhgyyre', 4, 0, '0', '2018-08-15 11:04:26', 5),
(45, 'qcbghjj', 4, 0, '0', '2018-08-15 11:06:49', 52),
(46, 'ooiyio', 4, 0, '0', '2018-08-15 11:12:45', 0),
(47, 'huighuigfuy', 4, 0, '0', '2018-08-15 11:15:47', 0),
(48, 'yyyyy', 4, 1, '20', '2018-08-15 11:17:50', 6),
(49, 'der43t', 4, 1, '20', '2018-08-15 11:18:41', 7),
(50, 'Kemal', 4, 1, '20', '2018-08-15 11:22:39', 10),
(51, 'hergrgf', 4, 0, '0', '2018-08-15 11:25:17', 9),
(52, 'fdsfer', 4, 0, '0', '2018-08-15 11:25:51', 49),
(53, 'jujuj', 4, 0, '0', '2018-08-15 11:28:55', 49),
(54, 'ef', 4, 3, '60', '2018-08-16 09:53:48', 9),
(55, 'ttttttt', 4, 2, '40', '2018-08-17 15:00:44', 15),
(56, 'iiii', 4, 0, '0', '2018-08-17 15:07:28', 7),
(57, 'bastian swei', 4, 3, '60', '2018-08-17 15:10:37', 8),
(58, 'ddddaa', 4, 3, '60', '2018-08-21 16:03:52', 49),
(59, 'Rossi', 4, 2, '40', '2018-08-24 14:22:12', 15),
(60, 'Danny Zweis', 4, 2, '40', '2018-08-29 14:40:43', 73),
(61, 'Iggy Azazael', 4, 2, '40', '2018-08-30 10:06:42', 9),
(62, 'Hikari Nur Cahya', 4, 1, '20', '2018-08-30 10:50:24', 9),
(63, 'Dimas Arie', 4, 1, '20', '2018-09-24 22:01:49', 9),
(64, 'dfsafaf', 4, 2, '40', '2018-10-30 23:43:11', 7),
(65, 'arob swire', 4, 4, '80', '2018-10-30 23:46:33', 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
