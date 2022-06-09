-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 10:40 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `hadir` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `sakit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `id_guru`, `bulan`, `tahun`, `hadir`, `izin`, `sakit`) VALUES
(1, 8, '6', '2022', 2, 2, 2),
(2, 8, '7', '2022', 1, 2, 3),
(5, 7, '6', '2022', 1, 2, 3),
(6, 9, '6', '2022', 4, 23, 22);

-- --------------------------------------------------------

--
-- Table structure for table `detail_gaji`
--

CREATE TABLE `detail_gaji` (
  `id` int(11) NOT NULL,
  `id_gaji` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_gaji`
--

INSERT INTO `detail_gaji` (`id`, `id_gaji`, `deskripsi`, `nominal`) VALUES
(95, 26, 'Gaji Pokok', 1020000),
(96, 26, 'Tambahan jam mengajar-0', 0),
(97, 26, 'THR', -1000000),
(109, 29, 'Gaji Pokok', 1020000),
(110, 29, 'Tambahan jam mengajar-1', 50000),
(111, 29, 'THR', 1000000),
(112, 29, 'Jarang masuk', -100000),
(113, 30, 'Gaji Pokok', 1020000),
(114, 30, 'Tambahan jam mengajar-1', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `id_guru` varchar(255) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `total_gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `id_guru`, `bulan`, `tahun`, `total_gaji`) VALUES
(26, '9', '7', '2022', 20000),
(29, '7', '12', '2022', 1970000),
(30, '7', '7', '2022', 1070000);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_hp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`, `alamat`, `id_jabatan`, `jk`, `no_hp`) VALUES
(7, '1201161048', 'Mochamad Rizkyy', 'ciceri', 1, 'L', '08953594493775'),
(8, '1201161040', 'Ilham Maulana', 'asdsad', 2, 'P', '08953594493775'),
(9, '1201161041', 'Fina', 'q', 1, 'L', '08953594493775'),
(10, '1201161049', 'Linda', 'asdsad', 1, 'P', '08953594493775');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `gaji_pokok`) VALUES
(1, 'Honorer', 1020000),
(2, 'Guru tetap', 1200000);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'admin'),
(3, 'bendahara'),
(4, 'kepsek');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `alamat`, `password`, `no_hp`, `role_id`, `jk`, `foto`) VALUES
(1, 'rizkyzet', 'Mochamad Rizky', 'Ciceri', '$2y$10$78JumAg3ZJcVgVfQZbRkhOYp3cxcN3YLfjVjluLUjVd8HbS.b0tb6', '0895359449377', 1, 'P', 'avatar-1.png'),
(7, 'ilham', 'Ilham Maulana', 'Cinangka', '$2y$10$FWFlqhVXkQULUQ0T7qa80.UnmpMX/PgrYfEsDJjWDntvMoNLnX9u2', '08953594493775', 1, 'L', 'avatar-1.png'),
(8, 'linda006', 'Linda', 'Kelapa Dua', '$2y$10$h/25b92XWd8YnUXtyZPyVuBNu5pEGCcek5RXOmsOzkV84auEdXc6G', '08953594493775', 1, 'P', 'avatar-1.png'),
(9, 'fauzi', 'Fauzi Firdaus', 'res', '$2y$10$3RhWx5sS8Wx387YbGW91D.fYUXEc23AykCTyKjHetq6J8GWgYNGA.', '08953594493775', 4, 'L', 'avatar-1.png'),
(10, 'rizkyzetzet', 'Mochamad Rizky', 'Ciracas', '$2y$10$TPNVfwcX9x.EQeAx5riZm.frRm0H.2uwBNw5xae0PQcXoP2oVdbSC', '08953594493775', 3, 'L', 'avatar-1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
