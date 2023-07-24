-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 17, 2023 at 01:39 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `id_community` int(11) NOT NULL,
  `name_community` varchar(50) NOT NULL,
  `member` int(11) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jenis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `nama_event`, `deskripsi`, `tanggal_mulai`, `tanggal_akhir`, `jenis_id`) VALUES
(4, 'Badminton', 'Olahraga', '2023-07-10', '2023-07-10', 12),
(5, 'Futsal', 'Olahraga Futsal', '2023-07-02', '2023-07-31', 12);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(12, 'Olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama_peserta` varchar(50) NOT NULL,
  `team_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id_registrasi` int(11) NOT NULL,
  `nama_team` varchar(50) NOT NULL,
  `peserta` int(11) NOT NULL,
  `sekolah` varchar(50) NOT NULL,
  `tingkat` enum('SD','SMP','SMA') NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id_registrasi`, `nama_team`, `peserta`, `sekolah`, `tingkat`, `provinsi`, `kota`, `file`, `event_id`) VALUES
(1, 'test', 2, 'sma 27 bandung', 'SD', 'jawa barat', 'bandung', '', 1),
(2, 'Futsal Team', 5, 'SMA Bandung', 'SD', 'Jawa Barat', 'Bandung', 'testimage.png', 5),
(3, 'Badminton Team', 2, 'SMA JAKARTA', 'SD', 'JAKARTA', 'JAKARTA', 'testimage.png', 4),
(39, 'Badmin2', 2, 'Bandung', 'SD', 'Provinsi', 'Kota', '5463d587acbebf4914a652924da6ff68.png', 4),
(43, 'badmin test', 2, 'bandung', 'SMA', 'bandung', 'bandung', '6aa0d3bb72873a61e533380620d387bc.png', 4),
(45, 'futsal test', 2, 'bandung', 'SMA', 'bandung', 'bandung', '71584046ecc5c3c369b90fe45aa3b47a.png', 0),
(46, 'futsal aaaa', 2, 'bandung', 'SMP', 'bandung', 'bandung', '25a606454b08cb54a2d63dae456f70d6.png', 0),
(47, 'futsal test 123', 2, 'bandung', 'SD', 'bandung', 'bandung', '2344cd2c441573e5838f21c0ca669f15.png', 0),
(48, 'maskd', 2, 'bandung', 'SMA', 'bandung', 'bandung', '6965bd3829544c68660a66821990ad87.png', 0),
(49, 'futsal testaaa', 2, 'bandung', 'SD', 'bandung', 'bandung', '2ac1a91238fb2a8408765ef8bd975606.png', 5),
(50, 'fustalll', 2, 'bandung', 'SD', 'bandung', 'bandung', '378a5a5e9c16dad8ee8082f7514fc0fd.png', 0),
(51, 'futsal testasdsasda', 2, 'bandung', 'SMP', 'bandung', 'bandung', '9b7866c21cb74722d1338f3a5c09da57.png', 5),
(55, 'fausafak', 2, 'ansficsa', 'SD', 'bandung', 'bandung', 'd568ac0fc4610e898586bf0482bd2ab8.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id_team` int(11) NOT NULL,
  `nama_team` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id_uploads` int(11) NOT NULL,
  `nama_peserta` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `kartu_pelajar` text NOT NULL,
  `raport` text NOT NULL,
  `registrasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id_uploads`, `nama_peserta`, `foto`, `kartu_pelajar`, `raport`, `registrasi_id`) VALUES
(44, 'nida', 'assets/file/foto/AMAAN-Email Header-People.png', 'assets/file/kartu_pelajar/AMAAN-Email Header-People.png', 'assets/file/raport/AMAAN-Email Header-People.png', 55);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `role` enum('panitia','admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `no_telp`, `role`, `password`, `created_at`, `foto`, `is_active`) VALUES
(19, 'admin', 'admin', 'admin@mails.com', '081231294218', 'admin', '$2y$10$gtfkrJRv6FXUqpc397QGmuXRLFz./tIr1DTSALhazq27xScD351z2', 1688316026, 'a9d66f2581735f8ac4d4549bd3332990.png', 1),
(20, 'panitia', 'panitia', 'panitia@mail.com', '08123456789', 'panitia', '$2y$10$iaZQBOJ6PPCzGw6x8.KN/eTYCqJHpLcngC/IAfD6GEgx/Gi9EpUqe', 1689041402, 'user.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`id_community`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id_registrasi`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id_team`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id_uploads`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id_team` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id_uploads` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
