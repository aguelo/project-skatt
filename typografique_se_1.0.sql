-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 13, 2015 at 09:50 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

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
    `alt_key` int(11) NOT NULL,
    `q_key` int(11) NOT NULL COMMENT 'Foreign key',
    `alt_value` int(11) NOT NULL,
    `alt_string` varchar(64) NOT NULL
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ALT`
--
ALTER TABLE `ALT`
ADD PRIMARY KEY (`alt_key`), ADD UNIQUE KEY `alt_key` (`alt_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ALT`
--
ALTER TABLE `ALT`
MODIFY `alt_key` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=123;
