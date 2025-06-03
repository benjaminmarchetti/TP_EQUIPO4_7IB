-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 01:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nusuario`
--

-- --------------------------------------------------------

--
-- Table structure for table `recuperar`
--

CREATE TABLE `recuperar` (
  `EMAIL` varchar(50) NOT NULL,
  `CLAVE_NUEVA` int(8) NOT NULL,
  `TOKEN` varchar(100) NOT NULL,
  `FECHA_ALTA` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recuperar`
--

INSERT INTO `recuperar` (`EMAIL`, `CLAVE_NUEVA`, `TOKEN`, `FECHA_ALTA`) VALUES
('joako@gmail.com', 70448424, 'ee9c682ee32d0fdcc650617d0ea34c9c', '2025-05-20 19:34:56'),
('joako@gmail.com', 32655181, '57789cc55d205072e0b8f2977ce7d32a', '2025-05-20 19:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `registronuevo`
--

CREATE TABLE `registronuevo` (
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `user` varchar(60) NOT NULL,
  `pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registronuevo`
--

INSERT INTO `registronuevo` (`nombre`, `apellido`, `email`, `user`, `pass`) VALUES
('Benja', 'Paiva', 'mail@gmail.com', 'Benja123', '$2y$10$P3KWraf6jnlV1T4fypFQveDjaVD2wif.U2hNES7nZAkPGzOZpty4O'),
('joako', 'campi', 'joako@gmail.com', 'joako123', '$2y$10$0/1JrW69L3KJojue1D9ph.9OU/IAv/hFMs1GorVJq8SzwgslORXSi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
