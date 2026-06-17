-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20260519.eecbf60603
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2026 at 08:31 AM
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
(1, 'Welke type ziel bestuur je tijdens battles in undertale?', 'Determination', 'Het is een emotie', 1),
(2, 'Wat is je einddoel in het game Celeste', 'Een berg beklimmen', 'Er zijn mensen die dit doen als een hobby', 1),
(3, 'Wat kan je in celeste oppakken voor extra score?', 'Aardbeien', 'Het is een rode fruit', 1),
(4, 'D3 V0R1G3 T44L R3D J3 V4N D3 BUG.\r\n\r\nLees zoals je vroeger sms’te.', 'DE VORIGE TAAL RED JE VAN DE BUG.', 'Vervang cijfers door letters die erop lijken.', 2),
(5, 'Je ziet drie Cuphead‑bosses op het scherm verschijnen in retro‑stijl:\r\n\r\nThe Root Pack\r\n\r\nRibby & Croaks\r\n\r\nHilda Berg\r\n\r\n“Eentje blijft altijd op de grond.\r\nEentje springt soms.\r\nEentje vliegt altijd.\r\nWelke hoort niet in dit rijtje?”', 'Hilda Berg, want zij is de enige die altijd in de lucht zit', 'Denk niet aan moeilijkheid of level, maar aan waar ze vechten.', 2),
(6, '3 Deuren staan voor je.\r\n\r\nDeur 1: een taart\r\n\r\nDeur 2: een bot\r\n\r\nDeur 3: een slapend gezicht\r\n\r\nWelke deur kies je als je NIET wilt vechten?”', 'Deur 3 die staat voor sans', 'Denk aan hoe elk personage zich gedraagt in het spel.\r\nWie gaat het moeite niet in om met jouw te vechten?', 2);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE teams (
  id INT AUTO_INCREMENT PRIMARY KEY,
  teamName VARCHAR(100) NOT NULL,
  createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE team_members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  teamId INT NOT NULL,
  playerName VARCHAR(100) NOT NULL,
  FOREIGN KEY (teamId) REFERENCES teams(id) ON DELETE CASCADE
);

