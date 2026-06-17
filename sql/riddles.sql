-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20260519.eecbf60603
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 11:50 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escaperoom`
--

-- --------------------------------------------------------

--
-- Table structure for table `riddles`
--

CREATE TABLE `riddles` (
  `id` int NOT NULL,
  `riddle` varchar(255) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `roomId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riddles`
--

INSERT INTO `riddles` (`id`, `riddle`, `answer`, `hint`, `roomId`) VALUES
(1, 'Welke kleur is madeline\'s haar wanneer ze 1 dash heeft?', 'Oranje', 'Haar haar kan: Wit, Blauw, Oranje of Paars zijn.', 1),
(2, 'Wat is je einddoel in het game Celeste', 'Een berg beklimmen', 'Er zijn mensen die dit doen als een hobby', 1),
(3, 'Wat kan je in celeste oppakken voor extra score?', 'Aardbeien', 'Het is een rode fruit', 1),
(4, 'Welke type ziel bestuur je tijdens battles in undertale?', 'Determination', 'Het is een emotie', 2),
(5, 'Wat is het naam van het persoon die we als spelen.', 'Frisk', 'Hij heeft een blauw met roze strepen hoedie aan. (naam lijkt op fristie)', 2),
(6, 'Wat is sans?', 'Een skelet', 'Is gemaakt van botten', 2),
(7, 'Wat is cubhead gebaseerd op?', 'Een kop', 'Het is iets waaruit we drinken', 3),
(8, 'Wat is head naam van de broertje van cubhead?', 'Mugman', 'Hij is een mok', 3),
(9, 'Wie is het eindbaas in cubhead?', 'The devil', 'Het is een persoon die te maken heeft met hell', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `riddles`
--
ALTER TABLE `riddles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `riddles`
--
ALTER TABLE `riddles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
