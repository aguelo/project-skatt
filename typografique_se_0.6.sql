-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 08, 2015 at 10:10 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `typografique_se`
--

-- --------------------------------------------------------

--
-- Table structure for table `ALT`
--

CREATE TABLE `ALT` (
  `alt_key` int(11) NOT NULL AUTO_INCREMENT,
  `q_key` int(11) NOT NULL COMMENT 'Foreign key',
  `alt_value` int(11) NOT NULL,
  `alt_string` varchar(64) NOT NULL,
  PRIMARY KEY (`alt_key`),
  UNIQUE KEY `alt_key` (`alt_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `ALT`
--

INSERT INTO `ALT` (`alt_key`, `q_key`, `alt_value`, `alt_string`) VALUES
(1, 1, 10, 'Aldrig'),
(2, 1, 20, '1-3 gånger i månaden eller mer sällan'),
(3, 1, 30, '1-3 gånger i veckan'),
(4, 1, 40, '4 eller fler gånger i veckan'),
(5, 2, 10, '1-3 glas'),
(6, 2, 20, '3-6 glas'),
(7, 2, 30, '6-9 glas'),
(8, 2, 40, '10 glas eller fler'),
(9, 3, 10, 'Aldrig'),
(10, 3, 20, 'En eller flera gånger i månaden'),
(11, 3, 30, 'En eller flera gånger i veckan'),
(12, 3, 40, 'Dagligen'),
(13, 4, 10, 'Aldrig'),
(14, 4, 20, 'En eller flera gånger i månaden'),
(15, 4, 30, 'Varje vecka'),
(16, 4, 40, 'Dagligen'),
(17, 5, 10, 'Aldrig'),
(18, 5, 20, 'En eller flera gånger i månaden'),
(19, 5, 30, 'Varje vecka '),
(20, 5, 40, 'Dagligen'),
(21, 6, 10, 'Aldrig'),
(22, 6, 20, 'En eller flera gånger i månaden'),
(23, 6, 30, 'Varje vecka'),
(24, 6, 40, 'Dagligen'),
(25, 7, 10, 'Aldrig'),
(26, 7, 20, 'En eller flera gånger i månaden'),
(27, 7, 30, 'Varje vecka'),
(28, 7, 40, 'Dagligen'),
(29, 8, 10, 'Aldrig'),
(30, 8, 20, 'En eller flera gånger i månaden'),
(31, 8, 30, 'Varje vecka'),
(32, 8, 40, 'Dagligen'),
(33, 9, 10, 'Vej ej'),
(34, 9, 20, 'Nej'),
(35, 9, 30, 'Ja, men inte under det senaste året'),
(36, 9, 40, 'Ja, under det senaste året'),
(37, 10, 10, 'Vet ej'),
(38, 10, 20, 'Nej'),
(39, 10, 30, 'Ja, men inte under det senaste året'),
(40, 10, 40, 'Ja, under det senaste året'),
(41, 11, 40, 'För det mesta'),
(42, 11, 30, 'Oftast'),
(43, 11, 20, 'Ibland'),
(44, 11, 10, 'Inte alls'),
(45, 12, 10, 'Precis lika mycket'),
(46, 12, 20, 'Inte lika mycket'),
(47, 12, 30, 'Bara lite'),
(48, 12, 40, 'Knappt alls'),
(49, 13, 40, 'Alldeles bestämt och rätt mycket'),
(50, 13, 30, 'Ja, men inte så mycket'),
(51, 13, 20, 'Lite, men det oroar mig inte'),
(52, 13, 10, 'Inte alls'),
(53, 14, 10, 'Lika mycket som jag alltid kunnat'),
(54, 14, 20, 'Inte lika mycket'),
(55, 14, 30, 'Absolut inte så mycket '),
(56, 14, 40, 'Inte alls'),
(57, 15, 40, 'Mycket ofta'),
(58, 15, 30, 'Ofta'),
(59, 15, 20, 'Sällan'),
(60, 15, 10, 'Bara någon enstaka gång'),
(61, 16, 40, 'Inte alls'),
(62, 16, 30, 'Sällan'),
(63, 16, 20, 'Ibland'),
(64, 16, 10, 'För det mesta'),
(65, 17, 40, 'Inte alls'),
(66, 17, 30, 'Oftast'),
(67, 17, 20, 'Sällan'),
(68, 17, 10, 'Absolut'),
(69, 18, 40, 'Oftast'),
(70, 18, 30, 'Ibland'),
(71, 18, 20, 'Sällan'),
(72, 18, 10, 'Inte alls'),
(73, 19, 40, 'Helt och hållet'),
(74, 19, 30, 'Bryr mig inte så mycket som jag borde'),
(75, 19, 20, 'Bryr mig lite '),
(76, 19, 10, 'Bryr mig precis som förut'),
(77, 20, 40, 'Väldigt mycket'),
(78, 20, 30, 'Ofta'),
(79, 20, 20, 'Sällan'),
(80, 20, 10, 'Inte alls'),
(81, 21, 10, 'Inte alls'),
(82, 21, 20, 'Något'),
(83, 21, 30, 'Mycket'),
(84, 21, 40, 'Extremt'),
(85, 22, 10, 'Inte alls'),
(86, 22, 20, 'Något'),
(87, 22, 30, 'Mycket'),
(88, 22, 40, 'Extremt'),
(89, 23, 10, 'Inte alls'),
(90, 23, 20, 'Något'),
(91, 23, 30, 'Mycket'),
(92, 23, 40, 'Extremt'),
(93, 24, 10, 'Inte alls'),
(94, 24, 20, 'Något'),
(95, 24, 30, 'Mycket'),
(96, 24, 40, 'Extremt'),
(97, 25, 10, 'Inte alls'),
(98, 25, 20, 'Något'),
(99, 25, 30, 'Mycket'),
(100, 25, 40, 'Extremt'),
(101, 26, 10, 'Inte alls'),
(102, 26, 20, 'Något'),
(103, 26, 30, 'Mycket'),
(104, 26, 40, 'Extremt'),
(105, 27, 10, 'Inte alls'),
(106, 27, 20, 'Något'),
(107, 27, 30, 'Mycket'),
(108, 27, 40, 'Extremt'),
(109, 28, 10, 'Inte alls'),
(110, 28, 20, 'Något'),
(111, 28, 30, 'Mycket'),
(112, 28, 40, 'Extremt'),
(113, 29, 10, 'Inte alls'),
(114, 29, 20, 'Något'),
(115, 29, 30, 'Mycket'),
(116, 29, 40, 'Extremt'),
(117, 30, 10, 'Inte alls'),
(118, 30, 20, 'Något'),
(119, 30, 30, 'Mycket'),
(120, 30, 40, 'Extremt');

-- --------------------------------------------------------

--
-- Table structure for table `ANSWER`
--

CREATE TABLE `ANSWER` (
  `ans_key` int(11) NOT NULL AUTO_INCREMENT,
  `alt_key` int(11) NOT NULL COMMENT 'Foreign key',
  `s_key` int(11) NOT NULL COMMENT 'Foreign key',
  `q_key` int(11) NOT NULL COMMENT 'Foreign key',
  UNIQUE KEY `ans_key` (`ans_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `FORM`
--

CREATE TABLE `FORM` (
  `f_key` int(11) NOT NULL,
  `f_code` varchar(32) NOT NULL,
  `f_name` varchar(64) NOT NULL,
  UNIQUE KEY `f_key` (`f_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FORM`
--

INSERT INTO `FORM` (`f_key`, `f_code`, `f_name`) VALUES
(1, 'ALK-1', 'Alkoholvanor'),
(2, 'DEP-2', 'Depressionsenkät'),
(3, 'KLA-3', 'Klaustrofobitendenser');

-- --------------------------------------------------------

--
-- Table structure for table `PATIENT`
--

CREATE TABLE `PATIENT` (
  `p_number` varchar(10) NOT NULL,
  `p_firstname` varchar(32) NOT NULL,
  `p_lastname` varchar(64) NOT NULL,
  `p_email` varchar(64) NOT NULL,
  UNIQUE KEY `p_number` (`p_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PATIENT`
--

INSERT INTO `PATIENT` (`p_number`, `p_firstname`, `p_lastname`, `p_email`) VALUES
('8712120000', 'Magnus', 'Ulenius', 'magnus.ulenius@gmail.com'),
('9107040000', 'Axel', 'Jonsson', 'axel.jonsson@live.com');

-- --------------------------------------------------------

--
-- Table structure for table `QUESTION`
--

CREATE TABLE `QUESTION` (
  `q_key` int(11) NOT NULL AUTO_INCREMENT,
  `f_key` int(11) NOT NULL COMMENT 'Foreign key',
  `q_string` varchar(256) NOT NULL,
  UNIQUE KEY `q_key` (`q_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `QUESTION`
--

INSERT INTO `QUESTION` (`q_key`, `f_key`, `q_string`) VALUES
(1, 1, '1. Hur ofta dricker du alkohol?'),
(2, 1, '2. Hur många glas dricker du när du väl dricker?'),
(3, 1, '3. Hur ofta dricker du sex glas eller fler vid samma tillfälle?'),
(4, 1, '4. Hur ofta under det senaste året har du inte kunnat sluta dricka sedan du börjat?'),
(5, 1, '5. Hur ofta under det senaste året har du låtit bli att göra något som du borde gjort, för att du drack?'),
(6, 1, '6. Hur ofta under senaste året har du behövt en ”drink” på morgonen efter mycket drickande dagen innan?'),
(7, 1, '7. Hur ofta under det senaste året har du haft skuldkänslor eller samvetsförebråelser på grund av ditt drickande?'),
(8, 1, '8. Hur ofta under det senaste året har du druckit så att du dagen efter inte kommit ihåg vad du sagt eller gjort?'),
(9, 1, '9. Har du eller någon annan blivit skadad på grund av ditt drickande?'),
(10, 1, '10. Har en släkting eller vän, en läkare (eller någon annan inom sjukvården) oroat sig över ditt drickande eller antytt att du borde minska på det?'),
(11, 2, '1. Känner du dig spänd eller “uppskruvad”?'),
(12, 2, '2. Kan du uppskatta saker på samma sätt som tidigare?'),
(13, 2, '3. Är du rädd för att något farligt ska hända?'),
(14, 2, '4. Känner du att du kan skratta och se saker från den humoristiska sidan?'),
(15, 2, '5. Brukar du ha oroande tankar?'),
(16, 2, '6. Känner du dig glad?'),
(17, 2, '7. Kan du sitta själv i lugn och ro och känna dig avslappnad?'),
(18, 2, '8. Känner du dig rädd/bekymrad?'),
(19, 2, '9. Har du tappat intresse för ditt utseende?'),
(20, 2, '10. Känner du dig stressad och rastlös?'),
(21, 3, '1. Skulle du känna dig ångestfylld av att simma med näsklämma?'),
(22, 3, '2. Skulle du känna dig ångestfylld av att stå i en hiss på bottenvåning med dörrarna stängda?'),
(23, 3, '3. Skulle du känna dig ångestfylld av att försöka hämta andan medan du motionerar energiskt?'),
(24, 3, '4. Skulle du känna dig ångestfylld av att vara riktigt förkyld och uppleva andningssvårigheter genom näsan?'),
(25, 3, '5. Skulle du känna dig ångestfylld av att snorkla i en säker övningstank i 15 minuter?'),
(26, 3, '6. Skulle du känna dig ångestfylld av att använda en syrgasmask?'),
(27, 3, '7. Skulle du känna dig ångestfylld av att ligga i den nedre sängen i en våningssäng?'),
(28, 3, '8. Skulle du känna dig ångestfylld av att sitta i mitten av en fullsatt rad i en biosalong?'),
(29, 3, '9. Skulle du känna dig ångestfylld av att arbeta under en bil i 15 minuter?'),
(30, 3, '10. Skulle du känna dig ångestfylld av att sitta i en bastu i 15 min?');

-- --------------------------------------------------------

--
-- Table structure for table `RESULT`
--

CREATE TABLE `RESULT` (
  `r_key` int(11) NOT NULL AUTO_INCREMENT,
  `s_key` int(11) NOT NULL COMMENT 'Foreign key',
  `str_key` int(11) NOT NULL COMMENT 'Foreign key',
  `res_value` varchar(64) NOT NULL,
  UNIQUE KEY `r_key` (`r_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `RESULTSTRING`
--

CREATE TABLE `RESULTSTRING` (
  `str_key` int(11) NOT NULL,
  `string` varchar(64) NOT NULL,
  UNIQUE KEY `str_key` (`str_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SKATTNING`
--

CREATE TABLE `SKATTNING` (
  `s_key` int(11) NOT NULL AUTO_INCREMENT,
  `v_number` varchar(10) NOT NULL COMMENT 'Foreign key',
  `f_key` int(11) NOT NULL COMMENT 'Foreign key',
  `t_key` int(11) NOT NULL COMMENT 'Foreign key',
  `s_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `s_key` (`s_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=212 ;

-- --------------------------------------------------------

--
-- Table structure for table `TEMPLOGIN`
--

CREATE TABLE `TEMPLOGIN` (
  `t_key` int(11) NOT NULL AUTO_INCREMENT,
  `p_number` varchar(10) NOT NULL COMMENT 'Foreign key',
  `p_pass` varchar(6) NOT NULL,
  UNIQUE KEY `t_key` (`t_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=199 ;

-- --------------------------------------------------------

--
-- Table structure for table `VARDARE`
--

CREATE TABLE `VARDARE` (
  `v_number` varchar(10) NOT NULL,
  `v_pass` varchar(32) NOT NULL,
  `v_email` varchar(64) NOT NULL,
  UNIQUE KEY `v_number` (`v_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `VARDARE`
--

INSERT INTO `VARDARE` (`v_number`, `v_pass`, `v_email`) VALUES
('9107040000', '123456', 'axel.json@gmail.com');
