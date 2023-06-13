-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 07:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `pesan_feedback` varchar(300) NOT NULL,
  `rating` float NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `id_pengirim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `pesan_feedback`, `rating`, `tanggal_kirim`, `id_pengirim`) VALUES
(7, 'good app :)', 8.5, '2023-06-10', 2),
(9, 'GOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOD', 7.5, '2023-06-11', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'SCHOOL_SUBJECT'),
(2, 'LANGUAGE'),
(3, 'TECHNOLOGY'),
(4, 'GAMES'),
(5, 'CODING'),
(6, 'FIRST'),
(7, 'SECOND'),
(10, 'HITUNG'),
(11, 'IPA');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(13, 'SD KELAS 1'),
(14, 'SD KELAS 2'),
(15, 'SD KELAS 3'),
(16, 'SD KELAS 4'),
(17, 'SD KELAS 5'),
(18, 'SD KELAS 6'),
(19, 'SMP KELAS 7'),
(20, 'SMP KELAS 8'),
(21, 'SMP KELAS 9'),
(22, 'SMA KELAS 10'),
(23, 'SMA KELAS 11'),
(24, 'SMA KELAS 12');

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `id_kuis` int(11) NOT NULL,
  `nama_kuis` varchar(100) NOT NULL,
  `id_pembuat` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `level` varchar(100) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuis`
--

INSERT INTO `kuis` (`id_kuis`, `nama_kuis`, `id_pembuat`, `id_kategori`, `level`, `id_kelas`) VALUES
(37, 'MATEMATIKA', 3, 1, 'easy', 13),
(38, 'SAINS', 3, 3, 'easy', 19);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `jenis_user` varchar(6) NOT NULL,
  `foto_profil` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `email`, `password`, `username`, `jenis_user`, `foto_profil`) VALUES
(1, 'jenararka019@gmail.com', 'e1dc3f127b005d94ed22d7c5e48b0f61', 'AJM_12', 'mentor', 'duck.jpg'),
(2, 'tumbastruk@gmail.com', '1fbf02bbfd82877830debba69d81a7a9', 'Vanica', 'murid', 'vanica.jpg'),
(3, 'yanto19@gmail.com', 'cc1bd416925a1e21683707bb832a3d0c', 'mentor1', 'mentor', 'TURKI.png'),
(14, 'test@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'sayasiapa145', 'mentor', 'default.jpg'),
(16, 'tukutruk@gmail.com', '2d6de75c827ab3064c5c31388cae856f', 'trukwham2', 'murid', 'default.jpg'),
(18, 'truk43@gmail.com', '8914099dd4832ff1262d04196899c678', 'testo12', 'murid', 'default.jpg'),
(20, 'thorfinn@gmail.com', '989c65b92a3f250025b19ed9c453dfc4', 'Thorfin', 'murid', 'thorfin.webp');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_pengguna`
--

CREATE TABLE `quiz_pengguna` (
  `id_quizpengguna` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kuis` int(11) NOT NULL,
  `tanggal_bermain` date NOT NULL,
  `waktu_start` time NOT NULL,
  `waktu_finish` time NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_pengguna`
--

INSERT INTO `quiz_pengguna` (`id_quizpengguna`, `id_user`, `id_kuis`, `tanggal_bermain`, `waktu_start`, `waktu_finish`, `nilai`) VALUES
(77, 2, 37, '2023-06-10', '11:11:28', '11:11:46', 75),
(79, 2, 37, '2023-06-10', '11:16:39', '11:17:11', 100),
(80, 20, 37, '2023-06-10', '13:40:24', '13:40:34', 100),
(82, 20, 37, '2023-06-11', '12:27:54', '12:28:08', 80),
(83, 20, 38, '2023-06-11', '12:28:35', '12:28:50', 100);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `pertanyaan` varchar(300) NOT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `jenis_soal` varchar(11) NOT NULL,
  `id_kuis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `nomor`, `pertanyaan`, `jawaban_benar`, `option1`, `option2`, `option3`, `option4`, `jenis_soal`, `id_kuis`) VALUES
(54, 1, '1 + 1 = ', 1, '2', '3', '8', '11', 'option', 37),
(55, 2, 'APAKAH 23 + 48 = 71 ?', 5, 'BENAR', 'SALAH', '', '', 'truefalse', 37),
(56, 3, '42 - 8 = ?', 1, '34', '42', '21', '39', 'option', 37),
(57, 4, 'JIKA BUDI MEMILIKI 12 APEL DAN DIA MEMBERI GILANG 4 APEL MAKA BERPAKAH APEL YANG IA MILIKI SEKARANG ?', 1, '8 APEL', '4 APEL', '5 JERUK', '8 JERUK', 'option', 37),
(59, 1, 'Mata berguna untuk.....', 1, 'Melihat', 'Mendengar', 'Meraba', 'Mengecap', 'option', 38),
(60, 2, '..... edi merasakan dinginnya air', 3, 'mata', 'telinga', 'kulit', 'hidung', 'option', 38),
(61, 3, 'Hardin tidak melihat televisi terlalu dekat.\r\nPerilaku hardin merupakan contoh untuk menjaga', 2, 'hidung', 'mata', 'gigi', 'telinga', 'option', 38),
(62, 5, 'Jika Gilang memiliki 4 coklat dan 5 permen. Gilang memberi sarah 3 permen dan Rusdi 2 coklat.\r\nJumlah coklat dan permen gilang sekarang adalah....', 4, '2 coklat dan 3 permen', '1 coklat dan 4 permen', '3 coklat dan 2 permen', '2 coklat dan 2 permen', 'option', 37);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `fk_feed` (`id_pengirim`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`id_kuis`),
  ADD UNIQUE KEY `id_kelas` (`id_kelas`),
  ADD KEY `fk_pembuat` (`id_pembuat`),
  ADD KEY `fk_kuis` (`id_kategori`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `quiz_pengguna`
--
ALTER TABLE `quiz_pengguna`
  ADD PRIMARY KEY (`id_quizpengguna`),
  ADD KEY `fk_pengguna` (`id_user`),
  ADD KEY `fk_quiz` (`id_kuis`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `fk_soal` (`id_kuis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id_kuis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `quiz_pengguna`
--
ALTER TABLE `quiz_pengguna`
  MODIFY `id_quizpengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feed` FOREIGN KEY (`id_pengirim`) REFERENCES `pengguna` (`id_user`);

--
-- Constraints for table `kuis`
--
ALTER TABLE `kuis`
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `fk_kuis` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `fk_pembuat` FOREIGN KEY (`id_pembuat`) REFERENCES `pengguna` (`id_user`);

--
-- Constraints for table `quiz_pengguna`
--
ALTER TABLE `quiz_pengguna`
  ADD CONSTRAINT `fk_pengguna` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`),
  ADD CONSTRAINT `fk_quiz` FOREIGN KEY (`id_kuis`) REFERENCES `kuis` (`id_kuis`);

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `fk_soal` FOREIGN KEY (`id_kuis`) REFERENCES `kuis` (`id_kuis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
