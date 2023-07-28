-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 12:30 AM
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
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `atribut`
--

CREATE TABLE `atribut` (
  `ID_ATRIBUT` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_EVENT` int(11) DEFAULT NULL,
  `NAMA_ATRIBUT` varchar(255) DEFAULT NULL,
  `FOTO_ATRIBUT` text DEFAULT NULL,
  `TINGKAT_ATRIBUT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_person`
--

CREATE TABLE `contact_person` (
  `ID_CONTACT_PERSON` int(11) NOT NULL,
  `NAMA_CONTACT_PERSON` varchar(255) DEFAULT NULL,
  `NO_TELP_CONTACT_PERSON` varchar(15) DEFAULT NULL,
  `EMAIL_CONTACT_PERSON` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_person`
--

INSERT INTO `contact_person` (`ID_CONTACT_PERSON`, `NAMA_CONTACT_PERSON`, `NO_TELP_CONTACT_PERSON`, `EMAIL_CONTACT_PERSON`) VALUES
(3, 'ahmad', '92187312', 'ahmad@mail.com'),
(4, 'surya', '918237422', 'surya@mail.com'),
(5, 'ahmad', '9834323', 'ahmad@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `ID_EVENT` int(11) NOT NULL,
  `ID_JENIS_EVENT` int(11) DEFAULT NULL,
  `NAMA_EVENT` varchar(255) DEFAULT NULL,
  `TGL_MULAI_EVENT` date DEFAULT NULL,
  `TGL_AKHIR_EVENT` date DEFAULT NULL,
  `FOTO_EVENT` text DEFAULT NULL,
  `BIAYA_EVENT` int(11) DEFAULT NULL,
  `BANK_EVENT` varchar(255) DEFAULT NULL,
  `STATUS_EVENT` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_event`
--

CREATE TABLE `jenis_event` (
  `ID_JENIS_EVENT` int(11) NOT NULL,
  `NAMA_JENIS_EVENT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_event`
--

INSERT INTO `jenis_event` (`ID_JENIS_EVENT`, `NAMA_JENIS_EVENT`) VALUES
(6, 'Olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `ID_PESERTA` int(11) NOT NULL,
  `ID_TEAM` int(11) DEFAULT NULL,
  `NAMA_PESERTA` varchar(255) DEFAULT NULL,
  `FOTO_PESERTA` text DEFAULT NULL,
  `KARTU_PELAJAR` text DEFAULT NULL,
  `RAPORT_PELAJAR` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `ID_REGISTRASI` int(11) NOT NULL,
  `ID_EVENT` int(11) DEFAULT NULL,
  `JUMLAH_PESERTA` int(11) DEFAULT NULL,
  `BUKTI_BAYAR` text DEFAULT NULL,
  `STATUS_REGISTRASI` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `ID_TEAM` int(11) NOT NULL,
  `ID_CONTACT_PERSON` int(11) DEFAULT NULL,
  `ID_REGISTRASI` int(11) DEFAULT NULL,
  `NAMA_TEAM` varchar(255) DEFAULT NULL,
  `SEKOLAH` varchar(255) DEFAULT NULL,
  `TINGKAT` varchar(10) DEFAULT NULL,
  `PROVINSI` varchar(255) DEFAULT NULL,
  `KOTA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `EMAIL_USER` varchar(255) DEFAULT NULL,
  `NAMA_USER` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `NO_TELP` varchar(15) DEFAULT NULL,
  `ROLE` varchar(10) DEFAULT NULL,
  `FOTO` text DEFAULT NULL,
  `IS_ACTIVE` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `EMAIL_USER`, `NAMA_USER`, `PASSWORD`, `NO_TELP`, `ROLE`, `FOTO`, `IS_ACTIVE`) VALUES
(2, 'admin', 'admin@gmail.com', 'admin', '$2y$10$GK33iYrbuwl2uVXan/PqO.xG8pSAJng6moWtkDHie0yVEYZvyUKWC', '0182938913', 'ADMIN', 'user.png', '1'),
(3, 'user', 'somad@mail.com', 'user', '$2y$10$U82RlHfxmv1Lr1Fo9to9geaTI62vwK.uePu2UVlZYcJEp3zAA4oVK', '022520125', 'PANITIA', 'user.png', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atribut`
--
ALTER TABLE `atribut`
  ADD PRIMARY KEY (`ID_ATRIBUT`),
  ADD KEY `FK_RELATIONSHIP_6` (`ID_USER`);

--
-- Indexes for table `contact_person`
--
ALTER TABLE `contact_person`
  ADD PRIMARY KEY (`ID_CONTACT_PERSON`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ID_EVENT`),
  ADD KEY `FK_RELATIONSHIP_5` (`ID_JENIS_EVENT`);

--
-- Indexes for table `jenis_event`
--
ALTER TABLE `jenis_event`
  ADD PRIMARY KEY (`ID_JENIS_EVENT`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`ID_PESERTA`),
  ADD KEY `FK_RELATIONSHIP_2` (`ID_TEAM`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`ID_REGISTRASI`),
  ADD KEY `FK_RELATIONSHIP_4` (`ID_EVENT`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`ID_TEAM`),
  ADD KEY `FK_RELATIONSHIP_1` (`ID_CONTACT_PERSON`),
  ADD KEY `FK_RELATIONSHIP_3` (`ID_REGISTRASI`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atribut`
--
ALTER TABLE `atribut`
  MODIFY `ID_ATRIBUT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_person`
--
ALTER TABLE `contact_person`
  MODIFY `ID_CONTACT_PERSON` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `ID_EVENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jenis_event`
--
ALTER TABLE `jenis_event`
  MODIFY `ID_JENIS_EVENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `ID_PESERTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `ID_REGISTRASI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `ID_TEAM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atribut`
--
ALTER TABLE `atribut`
  ADD CONSTRAINT `FK_RELATIONSHIP_6` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`ID_JENIS_EVENT`) REFERENCES `jenis_event` (`ID_JENIS_EVENT`);

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ID_TEAM`) REFERENCES `team` (`ID_TEAM`) ON DELETE CASCADE;

--
-- Constraints for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_EVENT`) REFERENCES `event` (`ID_EVENT`) ON DELETE CASCADE;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_CONTACT_PERSON`) REFERENCES `contact_person` (`ID_CONTACT_PERSON`),
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_REGISTRASI`) REFERENCES `registrasi` (`ID_REGISTRASI`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
