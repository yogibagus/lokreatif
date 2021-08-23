-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Agu 2021 pada 02.50
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lokreatif`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang_juri`
--

CREATE TABLE `bidang_juri` (
  `ID` int(11) NOT NULL,
  `KODE_USER` varchar(20) DEFAULT NULL,
  `ID_BIDANG` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bidang_juri`
--

INSERT INTO `bidang_juri` (`ID`, `KODE_USER`, `ID_BIDANG`) VALUES
(2, 'JRI_DDYHf85', 1),
(3, 'JRI_DMSPfad', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang_lomba`
--

CREATE TABLE `bidang_lomba` (
  `ID_BIDANG` int(10) NOT NULL,
  `BIDANG_LOMBA` varchar(50) DEFAULT NULL,
  `POSTER` varchar(50) DEFAULT NULL,
  `TEAM` tinyint(1) NOT NULL DEFAULT 0,
  `MIN_ANGGOTA` int(10) DEFAULT NULL,
  `MAX_ANGGOTA` int(10) DEFAULT NULL,
  `KETERANGAN` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bidang_lomba`
--

INSERT INTO `bidang_lomba` (`ID_BIDANG`, `BIDANG_LOMBA`, `POSTER`, `TEAM`, `MIN_ANGGOTA`, `MAX_ANGGOTA`, `KETERANGAN`) VALUES
(1, 'Mobile programming', NULL, 1, 2, 5, 'Upload poster, proposal, dan link demo aplikasi mobile'),
(3, 'Desain UI/UX', NULL, 0, NULL, NULL, 'Upload desain UI/IX dari suatu aplikasi'),
(4, 'Desain Poster', NULL, 0, NULL, NULL, '');

--
-- Trigger `bidang_lomba`
--
DELIMITER $$
CREATE TRIGGER `del_bidangJuri` BEFORE DELETE ON `bidang_lomba` FOR EACH ROW BEGIN

DELETE FROM BIDANG_JURI WHERE ID_BIDANG = OLD.ID_BIDANG;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `del_kriteria` BEFORE DELETE ON `bidang_lomba` FOR EACH ROW BEGIN

DELETE FROM KRITERIA_PENILAIAN WHERE ID_BIDANG = OLD.ID_BIDANG;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_item`
--

CREATE TABLE `form_item` (
  `ID_ITEM` int(10) NOT NULL,
  `ID_FORM` int(10) NOT NULL,
  `ITEM` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `form_item`
--

INSERT INTO `form_item` (`ID_ITEM`, `ID_FORM`, `ITEM`) VALUES
(2859, 289, 'D1'),
(2860, 289, 'D2'),
(2861, 289, 'D3'),
(2862, 289, 'D4'),
(2863, 289, 'S1'),
(2872, 299, 'D1'),
(2873, 299, 'D2'),
(2874, 299, 'D3'),
(2875, 299, 'S1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_meta`
--

CREATE TABLE `form_meta` (
  `ID_FORM` int(10) NOT NULL,
  `KEGIATAN` int(11) NOT NULL DEFAULT 1,
  `KODE` varchar(100) DEFAULT NULL,
  `PERTANYAAN` text DEFAULT NULL,
  `TYPE` varchar(20) DEFAULT NULL,
  `REQUIRED` tinyint(1) NOT NULL DEFAULT 0,
  `KETERANGAN` text DEFAULT NULL,
  `FILE_SIZE` int(10) DEFAULT NULL,
  `FILE_TYPE` varchar(20) DEFAULT NULL,
  `POSISI` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `form_meta`
--

INSERT INTO `form_meta` (`ID_FORM`, `KEGIATAN`, `KODE`, `PERTANYAAN`, `TYPE`, `REQUIRED`, `KETERANGAN`, `FILE_SIZE`, `FILE_TYPE`, `POSISI`) VALUES
(287, 1, 'event-online-charity-seminar-series-2-629', 'Nama akun facebook', 'TEXT', 1, '', 0, '', NULL),
(288, 1, 'event-online-charity-seminar-series-2-629', 'Umur', 'TEXT', 1, '', 0, '', NULL),
(289, 1, 'event-online-charity-seminar-series-2-629', 'Jenjang studi akhir', 'RADIO', 1, 'Pilih jenjang studi akhir anda. (Bukan sedang menempuh)', 0, '', NULL),
(290, 1, 'event-online-charity-seminar-series-2-629', 'SCAN KTA/KTP', 'FILE', 0, '', 10, 'png|jpg|jpeg', NULL),
(297, 1, 'lokreatif', 'Nama TIM', 'TEXT', 1, '', 0, '', NULL),
(298, 1, 'lokreatif', 'Nama dosen pembimbing', 'TEXT', 1, 'lengkap beserta gelar', 0, '', NULL),
(299, 1, 'lokreatif', 'Jenjang studi', 'RADIO', 1, '', 0, '', NULL),
(300, 1, 'lokreatif', 'SCAN KTA', 'FILE', 1, 'Jadikan satu file pdf', 10, 'pdf', NULL);

--
-- Trigger `form_meta`
--
DELIMITER $$
CREATE TRIGGER `del_formItem` BEFORE DELETE ON `form_meta` FOR EACH ROW BEGIN

DELETE FROM FORM_ITEM WHERE ID_FORM = OLD.ID_FORM;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_penilaian`
--

CREATE TABLE `kriteria_penilaian` (
  `ID_KRITERIA` int(10) NOT NULL,
  `ID_TAHAP` int(10) DEFAULT NULL,
  `ID_BIDANG` int(10) DEFAULT NULL,
  `KRITERIA` varchar(50) DEFAULT NULL,
  `KETERANGAN` text DEFAULT NULL,
  `BOBOT` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria_penilaian`
--

INSERT INTO `kriteria_penilaian` (`ID_KRITERIA`, `ID_TAHAP`, `ID_BIDANG`, `KRITERIA`, `KETERANGAN`, `BOBOT`) VALUES
(1, 1, 1, 'Kreativitas', 'Mantabs', 25),
(2, 1, 1, 'Ide', NULL, 25),
(3, 1, 1, 'Mood', '', 25),
(5, 1, 1, 'Disiplin', '', 25),
(14, 1, 3, 'Kreativitas', 't', 50),
(15, 1, 3, '', 'e', 50),
(16, 2, 1, 'Kreativitas', 'I', 25),
(17, 2, 1, 'Displin', 'N', 75),
(22, 1, 4, 'Kreativitas', 'wowww', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `ID_LOG` int(10) NOT NULL,
  `RECEIVER_GROUP` int(5) NOT NULL DEFAULT 1,
  `RECEIVER` varchar(20) DEFAULT NULL,
  `SENDER` varchar(20) DEFAULT NULL,
  `TYPE` int(10) DEFAULT NULL,
  `READ` tinyint(1) DEFAULT 0,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`ID_LOG`, `RECEIVER_GROUP`, `RECEIVER`, `SENDER`, `TYPE`, `READ`, `CREATED_AT`) VALUES
(1, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-06-12 06:10:58'),
(2, 1, 'USR_MHND116', 'USR_MHND116', 4, 1, '2021-06-12 06:43:55'),
(3, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-06-12 06:46:00'),
(4, 1, 'USR_MHND116', 'USR_MHND116', 3, 0, '2021-06-12 06:48:49'),
(7, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-06-12 06:10:58'),
(8, 1, 'USR_MHND116', 'USR_MHND116', 4, 1, '2021-06-12 06:43:55'),
(9, 1, 'USR_MHND116', 'USR_MHND116', 2, 1, '2021-06-12 06:46:00'),
(13, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-06-12 06:10:58'),
(14, 1, 'USR_MHND116', 'USR_MHND116', 4, 1, '2021-06-12 06:43:55'),
(15, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-06-12 06:46:00'),
(16, 1, 'USR_MHND116', 'USR_MHND116', 3, 0, '2021-06-12 06:48:49'),
(19, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-06-12 06:10:58'),
(20, 1, 'USR_MHND116', 'USR_MHND116', 4, 1, '2021-06-12 06:43:55'),
(21, 1, 'USR_MHND116', 'USR_MHND116', 2, 1, '2021-06-12 06:46:00'),
(28, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-06-12 10:19:24'),
(29, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-06-12 14:45:51'),
(30, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-06-13 05:58:53'),
(33, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-06-14 07:46:54'),
(34, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-06-14 13:49:02'),
(35, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-06-15 16:02:09'),
(36, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-01 06:54:48'),
(37, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-01 15:33:48'),
(38, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-02 15:15:48'),
(39, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-02 20:14:30'),
(40, 1, 'USR_MHND116', 'USR_MHND116', 4, 1, '2021-07-02 20:20:14'),
(41, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-02 20:24:21'),
(42, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-03 06:33:38'),
(44, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-03 09:16:33'),
(45, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-03 14:58:27'),
(46, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-03 19:32:50'),
(47, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-04 05:36:28'),
(48, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-04 09:49:40'),
(49, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-04 13:31:16'),
(50, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-05 07:45:53'),
(51, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-05 15:26:31'),
(52, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-05 20:11:40'),
(53, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-07 11:58:37'),
(55, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-07 13:10:34'),
(56, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-07 13:33:26'),
(57, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-07 13:51:51'),
(58, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-07 13:52:23'),
(59, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-07 13:54:24'),
(60, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-07 13:59:15'),
(61, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-07 14:19:15'),
(63, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-07 14:51:28'),
(65, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-07 15:13:59'),
(66, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-12 20:53:47'),
(67, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-12 20:55:31'),
(68, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-13 06:10:48'),
(70, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-13 06:44:14'),
(72, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-13 10:59:22'),
(74, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-13 14:40:50'),
(75, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-13 14:46:51'),
(77, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-13 15:30:01'),
(78, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-14 01:48:36'),
(80, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-15 16:12:16'),
(82, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-16 13:00:26'),
(84, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-17 12:17:26'),
(88, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-17 19:39:05'),
(100, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-18 11:49:31'),
(101, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-18 12:39:35'),
(102, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-18 13:13:15'),
(111, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-18 15:43:50'),
(117, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-18 16:01:10'),
(118, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-18 16:36:58'),
(119, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-19 07:20:30'),
(120, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-19 09:09:33'),
(125, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-20 05:31:29'),
(133, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-21 01:29:31'),
(134, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-21 01:30:07'),
(135, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-21 01:48:45'),
(136, 1, 'USR_MHND67b', 'USR_MHND67b', 2, 0, '2021-07-21 01:50:22'),
(137, 1, 'USR_MHND67b', 'USR_MHND67b', 3, 0, '2021-07-21 01:50:51'),
(139, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-07-21 01:54:16'),
(141, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-21 01:58:28'),
(145, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-23 05:52:10'),
(148, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-23 11:42:47'),
(151, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-24 11:45:25'),
(154, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-07-24 14:16:17'),
(160, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-07 13:04:44'),
(162, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-15 03:31:25'),
(165, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-16 06:32:41'),
(167, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-16 09:28:17'),
(170, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-17 05:17:15'),
(172, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-17 11:41:34'),
(178, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-17 16:04:11'),
(179, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-18 22:20:44'),
(181, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-18 23:06:29'),
(182, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-18 23:33:14'),
(183, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-18 23:34:40'),
(184, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-18 23:58:23'),
(185, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-19 00:05:00'),
(186, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-19 01:01:05'),
(187, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-19 04:21:08'),
(190, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-19 07:15:24'),
(194, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-20 10:25:41'),
(199, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-20 15:30:34'),
(202, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-21 01:59:25'),
(203, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-21 06:55:25'),
(209, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-21 09:25:01'),
(215, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-21 10:16:17'),
(222, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-21 11:32:24'),
(229, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-22 08:23:02'),
(230, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-22 08:36:55'),
(231, 1, 'USR_MHND116', 'USR_MHND116', 4, 0, '2021-08-22 09:17:31'),
(232, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-22 09:18:36'),
(233, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-08-22 09:34:24'),
(234, 4, 'event-online-charity', 'ADM_001', 12, 0, '2021-08-22 11:15:35'),
(235, 4, 'event-online-charity', 'ADM_001', 12, 0, '2021-08-22 11:29:56'),
(236, 4, 'event-online-charity', 'ADM_001', 12, 0, '2021-08-22 11:42:15'),
(237, 4, 'event-online-charity', 'ADM_001', 12, 0, '2021-08-22 11:43:05'),
(238, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-08-22 11:48:20'),
(239, 4, 'event-online-charity', 'ADM_001', 12, 0, '2021-08-22 11:48:41'),
(240, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-22 11:55:30'),
(241, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-08-22 12:10:56'),
(242, 3, 'ADMIN', 'ADM_001', 11, 0, '2021-08-22 12:28:02'),
(243, 1, 'ADM_001', 'ADM_001', 1, 0, '2021-08-22 23:10:59'),
(244, 4, 'event-online-charity', 'ADM_001', 12, 0, '2021-08-23 00:34:11'),
(245, 1, 'USR_MHND116', 'USR_MHND116', 1, 0, '2021-08-23 00:40:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_type`
--

CREATE TABLE `log_type` (
  `ID_TYPE` int(10) NOT NULL,
  `REFERENCES` varchar(50) DEFAULT NULL,
  `TYPE` varchar(50) DEFAULT NULL,
  `MESSAGE` text DEFAULT NULL,
  `LINK` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_type`
--

INSERT INTO `log_type` (`ID_TYPE`, `REFERENCES`, `TYPE`, `MESSAGE`, `LINK`) VALUES
(1, 'LOGIN', '0', 'telah login ke dalam sistem', NULL),
(2, 'PENDAFTARAN AKUN', '1', 'melakukan pendaftaran akun pada sistem', NULL),
(3, 'AKTIVASI AKUN', '0', 'melakukan aktivasi akun pada sistem', 'data-pengguna'),
(4, 'RECOVERY PASSWORD AKUN', '1', 'recovery password akun', NULL),
(5, 'PENGAJUAN AKSES PENYELENGGARA', '1', 'mengirim pengajuan hak akses penyelenggara', 'pengajuan-kpanel'),
(6, 'PROSES HAPUS AKUN', '1', 'meminta proses hapus data akun', NULL),
(7, 'PEMBATALAN PENGHAPUSAN AKUN', '0', 'membatalkan proses hapus data akun', NULL),
(8, 'HAPUS DATA PENGGUNA', '1', 'menghapus semua data terkait pengguna', NULL),
(9, 'VERIFIKASI PENGAJUAN HAK AKSES K-PANEL', '1', 'telah menerima pengajuan hak akses k-panel anda', 'pengguna/k-panel'),
(10, 'LOGIN K-Panel Penyelenggara', '0', 'telah login ke dalam k-panel penyelenggaranya', NULL),
(11, 'MEMBUAT EVENT', '1', 'berhasil membuat kegiatan event baru', NULL),
(12, 'Akses Panel EVENT', '0', 'mengakses panel event untuk memanagement', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_data`
--

CREATE TABLE `pendaftaran_data` (
  `ID_DATA` int(10) NOT NULL,
  `KODE_PENDAFTARAN` varchar(20) DEFAULT NULL,
  `ID_FORM` int(10) DEFAULT NULL,
  `JAWABAN` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendaftaran_data`
--

INSERT INTO `pendaftaran_data` (`ID_DATA`, `KODE_PENDAFTARAN`, `ID_FORM`, `JAWABAN`) VALUES
(165, 'usr_mhnd116-4c0d9d', 290, 'E-KTP_MahendraDwiPurwanto.jpg'),
(166, 'usr_mhnd116-4c0d9d', 287, 'mahendra.fathe'),
(167, 'usr_mhnd116-4c0d9d', 288, '22'),
(168, 'usr_mhnd116-4c0d9d', 289, 'D3'),
(173, 'usr_mhnd116-8b495d', 300, 'KNTL-ID_MINECRAFT_SERVER_INDONESIA.pdf'),
(174, 'usr_mhnd116-8b495d', 297, 'Nganggurs'),
(175, 'usr_mhnd116-8b495d', 298, 'Mahendra Dwi Purwanto'),
(176, 'usr_mhnd116-8b495d', 299, 'D3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_kegiatan`
--

CREATE TABLE `pendaftaran_kegiatan` (
  `KODE_PENDAFTARAN` varchar(20) NOT NULL,
  `KODE_KEGIATAN` varchar(100) NOT NULL,
  `KODE_USER` varchar(20) NOT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT 0,
  `ID_TIKET` int(10) DEFAULT NULL,
  `LOG_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendaftaran_kegiatan`
--

INSERT INTO `pendaftaran_kegiatan` (`KODE_PENDAFTARAN`, `KODE_KEGIATAN`, `KODE_USER`, `STATUS`, `ID_TIKET`, `LOG_TIME`) VALUES
('usr_mhnd116-4c0d9d', 'event-online-charity-seminar-series-2-629', 'USR_MHND116', 0, NULL, '2021-08-22 19:08:06');

--
-- Trigger `pendaftaran_kegiatan`
--
DELIMITER $$
CREATE TRIGGER `deL_pendaftaran` BEFORE DELETE ON `pendaftaran_kegiatan` FOR EACH ROW BEGIN

DELETE FROM PENDAFTARAN_DATA WHERE KODE_PENDAFTARAN = OLD.KODE_PENDAFTARAN;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_kompetisi`
--

CREATE TABLE `pendaftaran_kompetisi` (
  `KODE_PENDAFTARAN` varchar(20) NOT NULL,
  `KODE_USER` varchar(20) NOT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT 0,
  `ID_TIKET` int(10) DEFAULT NULL,
  `LOG_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendaftaran_kompetisi`
--

INSERT INTO `pendaftaran_kompetisi` (`KODE_PENDAFTARAN`, `KODE_USER`, `STATUS`, `ID_TIKET`, `LOG_TIME`) VALUES
('usr_mhnd116-8b495d', 'USR_MHND116', 0, NULL, '2021-08-23 07:42:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahap_penilaian`
--

CREATE TABLE `tahap_penilaian` (
  `ID_TAHAP` int(10) NOT NULL,
  `KODE_KOMPETISI` varchar(100) DEFAULT NULL,
  `NAMA_TAHAP` varchar(50) DEFAULT NULL,
  `KETERANGAN` text DEFAULT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT 0,
  `DATE_START` varchar(30) DEFAULT NULL,
  `TIME_START` varchar(20) DEFAULT NULL,
  `DATE_END` varchar(30) DEFAULT NULL,
  `TIME_END` varchar(20) DEFAULT NULL,
  `TEAM` int(10) DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahap_penilaian`
--

INSERT INTO `tahap_penilaian` (`ID_TAHAP`, `KODE_KOMPETISI`, `NAMA_TAHAP`, `KETERANGAN`, `STATUS`, `DATE_START`, `TIME_START`, `DATE_END`, `TIME_END`, `TEAM`) VALUES
(1, 'evnt-lo-kreatif-2021-c8b', 'Penyisihan', 'TEST', 0, '2021-07-21', '20:33', '2021-07-23', '18:30', 10),
(2, 'evnt-lo-kreatif-2021-c8b', 'FInal', 'Lorem ipsum', 0, '2021-07-31', '07:00', '2021-07-31', '18:00', 3);

--
-- Trigger `tahap_penilaian`
--
DELIMITER $$
CREATE TRIGGER `del_kriteriaPenilaian` BEFORE DELETE ON `tahap_penilaian` FOR EACH ROW BEGIN

DELETE FROM kriteria_penilaian WHERE ID_TAHAP = OLD.ID_TAHAP;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_artikel`
--

CREATE TABLE `tb_artikel` (
  `KODE_ARTIKEL` varchar(100) NOT NULL,
  `KODE_USER` varchar(20) NOT NULL,
  `JENIS` int(5) DEFAULT 1,
  `JUDUL` varchar(50) DEFAULT NULL,
  `CONTENT` text DEFAULT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_artikel_tag`
--

CREATE TABLE `tb_artikel_tag` (
  `ID_TAG` int(10) NOT NULL,
  `KODE_ARTIKEL` varchar(100) NOT NULL,
  `TAG` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_auth`
--

CREATE TABLE `tb_auth` (
  `KODE_USER` varchar(12) NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(200) DEFAULT NULL,
  `ROLE` int(2) DEFAULT NULL,
  `NONAKTIF` tinyint(1) DEFAULT 0,
  `DEADLINE` varchar(20) DEFAULT NULL,
  `JOIN_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `LOG_TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_auth`
--

INSERT INTO `tb_auth` (`KODE_USER`, `EMAIL`, `PASSWORD`, `ROLE`, `NONAKTIF`, `DEADLINE`, `JOIN_DATE`, `LOG_TIME`) VALUES
('ADM_001', 'admin@nestivent.org', '$2y$10$voeLDCmjARvwVqKZQvPQ3.SaFNpc15VuWtSrfXO9jg7FGdZyIegJS', 0, 0, NULL, '2021-06-02 09:07:23', '2021-08-19 01:05:10'),
('JRI_DDYHf85', 'dedyhermawan@gmail.com', '$2y$10$4iKwnbQ83qRRzYfZWaU43uvJZ2C78KNnn8p0xsSjBNXpIqnxu9j5G', 2, 0, NULL, '2021-07-19 15:37:27', '2021-08-19 01:05:12'),
('JRI_DMSPfad', '181221009@mhs.stiki.ac.id', '$2y$10$VYmEySYI5NgCwe3fv5isGOWAnn8YL3Svxc54HvJTGdubQ6HAMhW3y', 2, 0, NULL, '2021-07-19 15:39:14', '2021-08-22 13:05:52'),
('USR_MHND116', 'mahendradwipurwanto@gmail.com', '$2y$10$2xQcotKe1xzoi3kkt1BaF.NWW6UMhSbVtDpcnmRBhRQxfK8oFTPdm', 1, 0, NULL, '2021-06-12 09:07:23', '2021-08-22 09:17:31'),
('USR_MHND67b', '181221006@mhs.stiki.ac.id', '$2y$10$RqSAEUXwJm7I3u4HaHyqRuIyWK.6KvNVdwWp8Alt8Q8kg1KFG2vH2', 1, 0, NULL, '2021-07-21 01:50:21', '2021-08-19 01:05:14');

--
-- Trigger `tb_auth`
--
DELIMITER $$
CREATE TRIGGER `del_aktivitas` BEFORE DELETE ON `tb_auth` FOR EACH ROW BEGIN

DELETE FROM LOG_AKTIVITAS WHERE RECEIVER = OLD.KODE_USER AND TYPE != 8;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `del_token` BEFORE DELETE ON `tb_auth` FOR EACH ROW BEGIN

DELETE FROM tb_token WHERE KODE = OLD.KODE_USER;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `del_user` BEFORE DELETE ON `tb_auth` FOR EACH ROW BEGIN

DELETE FROM TB_PESERTA WHERE KODE_USER = OLD.KODE_USER;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_contact_person`
--

CREATE TABLE `tb_contact_person` (
  `ID_CP` int(10) NOT NULL,
  `TYPE` int(10) DEFAULT NULL,
  `KODE` varchar(50) DEFAULT NULL,
  `NAMA_CONTACT` varchar(50) DEFAULT NULL,
  `CONTACT` varchar(200) DEFAULT NULL,
  `CONTACT_MEDIA` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_contact_person`
--

INSERT INTO `tb_contact_person` (`ID_CP`, `TYPE`, `KODE`, `NAMA_CONTACT`, `CONTACT`, `CONTACT_MEDIA`) VALUES
(7, 1, 'evnt-stiki-technofest-2-0-2021-bc7', 'Dyah Ajeng Salsabilla', '085785111746', 'WHATSAPP'),
(8, 1, 'evnt-stiki-technofest-2-0-2021-bc7', 'Mahendra Dwi Purwanto', '085785111746', 'PHONE'),
(9, 2, 'evnt-lo-kreatif-2021-c8b', 'Vebry Eka Purwantoro', '085704302114', 'WHATSAPP'),
(10, 1, 'event-online-charity-seminar-series-2-629', 'Mahendra', '085785111746', 'WHATSAPP'),
(11, 1, 'event-online-charity-seminar-series-2-629', 'Dyah Ajeng Salsabilla', 'mahendra@gmail.com', 'EMAIL'),
(12, 1, 'kegiatan-hic-open-house-2021-9ce', 'Naflah Huwaida Hana', '085785111746', 'PHONE'),
(13, 1, 'kegiatan-hic-open-house-2021-9ce', 'Sustiyo Mohaimin', '085785111746', 'WHATSAPP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `ID_KATEGORI` int(10) NOT NULL,
  `KATEGORI` varchar(20) DEFAULT NULL,
  `TYPE` int(5) DEFAULT NULL,
  `DESC` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `KODE_KEGIATAN` varchar(50) CHARACTER SET latin1 NOT NULL,
  `JENIS` int(5) NOT NULL DEFAULT 0,
  `STATUS_KEGIATAN` tinyint(1) NOT NULL DEFAULT 0,
  `JUDUL` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `POSTER` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `TANGGAL` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `WAKTU` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `MEDIA` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `BAYAR` tinyint(1) NOT NULL DEFAULT 0,
  `ONLINE` tinyint(1) NOT NULL DEFAULT 0,
  `DESKRIPSI` text CHARACTER SET latin1 DEFAULT NULL,
  `LOG_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`KODE_KEGIATAN`, `JENIS`, `STATUS_KEGIATAN`, `JUDUL`, `POSTER`, `TANGGAL`, `WAKTU`, `MEDIA`, `BAYAR`, `ONLINE`, `DESKRIPSI`, `LOG_TIME`) VALUES
('event-online-charity-seminar-series-2-629', 0, 1, 'Online Charity Seminar Series #2', 'POSTER_-1626832911.png', '2021-07-21', '09:00', 'instagram', 0, 0, '<p>TEST</p>', '2021-07-21 09:01:51'),
('evnt-stiki-technofest-2-0-2021-bc7', 1, 0, 'STIKI TECHNOFEST 2.0 #2021', 'POSTER_-1626554133.png', '2021-07-21', '03:34', 'instagram', 1, 1, '<p style=\"text-align: justify;\"><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Lorem Ipsum</strong><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <!-- pagebreak -->It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/nestivent/berkas/tmp/post/1626551001.png\" alt=\"\" width=\"400\" height=\"250\" /></span><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.</span></p>\r\n<h4 style=\"margin: 10px 10px 5px; padding: 0px; font-weight: 400; font-size: 14px; line-height: 18px; text-align: center; font-style: italic; font-family: \'Open Sans\', Arial, sans-serif; background-color: #ffffff;\">\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"</h4>\r\n<h5 style=\"margin: 5px 10px 20px; padding: 0px; font-weight: 400; font-size: 12px; line-height: 14px; text-align: center; font-family: \'Open Sans\', Arial, sans-serif; background-color: #ffffff;\">\"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...\"</h5>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><iframe title=\"YouTube video player\" src=\"https://www.youtube.com/embed/7BCojznmtRE\" width=\"400\" height=\"225\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>', '2021-07-18 03:35:33');
INSERT INTO `tb_kegiatan` (`KODE_KEGIATAN`, `JENIS`, `STATUS_KEGIATAN`, `JUDUL`, `POSTER`, `TANGGAL`, `WAKTU`, `MEDIA`, `BAYAR`, `ONLINE`, `DESKRIPSI`, `LOG_TIME`) VALUES
('kegiatan-hic-open-house-2021-9ce', 1, 0, 'HIC OPEN HOUSE 2021', 'POSTER_-1629635281.png', '2021-08-31', '19:30', 'zoom', 1, 1, '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</span></p>\r\n<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"data:image/png;base64,data:image/png;base64,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', '2021-08-22 19:28:01');

--
-- Trigger `tb_kegiatan`
--
DELIMITER $$
CREATE TRIGGER `deL_cp` BEFORE DELETE ON `tb_kegiatan` FOR EACH ROW BEGIN

DELETE FROM tb_contact_person WHERE KODE = OLD.KODE_KEGIATAN AND TYPE = 1;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `del_sosmed` BEFORE DELETE ON `tb_kegiatan` FOR EACH ROW BEGIN

DELETE FROM tb_sosmed WHERE KODE = OLD.KODE_KEGIATAN AND TYPE = 1;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `del_tiket` BEFORE DELETE ON `tb_kegiatan` FOR EACH ROW BEGIN

DELETE FROM tb_tiket WHERE KODE = OLD.KODE_KEGIATAN AND TYPE = 1;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kompetisi`
--

CREATE TABLE `tb_kompetisi` (
  `KODE_KOMPETISI` varchar(100) CHARACTER SET latin1 NOT NULL,
  `KODE_PENYELENGGARA` varchar(20) CHARACTER SET latin1 NOT NULL,
  `STATUS_KOMPETISI` tinyint(1) NOT NULL DEFAULT 1,
  `JUDUL` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `POSTER` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `PANDUAN` varchar(50) DEFAULT NULL,
  `TANGGAL` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `WAKTU` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `MEDIA` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `BAYAR` tinyint(1) NOT NULL DEFAULT 0,
  `ONLINE` tinyint(1) NOT NULL DEFAULT 0,
  `DESKRIPSI` text CHARACTER SET latin1 DEFAULT NULL,
  `LOG_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kompetisi`
--

INSERT INTO `tb_kompetisi` (`KODE_KOMPETISI`, `KODE_PENYELENGGARA`, `STATUS_KOMPETISI`, `JUDUL`, `POSTER`, `PANDUAN`, `TANGGAL`, `WAKTU`, `MEDIA`, `BAYAR`, `ONLINE`, `DESKRIPSI`, `LOG_TIME`) VALUES
('evnt-lo-kreatif-2021-c8b', 'PYL-PK2-M0GM59VYNQ', 1, 'Lo Kreatif 2021', 'POSTER_-1626622519.png', NULL, '2021-09-01', '00:00', 'instagram', 1, 1, '<p>Front is an incredibly beautiful, fully responsive, and mobile-first projects on the web – it is the perfect starting point for any creative and professional sites. Get started with Front\'s components and options for laying out your Front project, including SVG components, powerful scripts, fully detailed documentation, and yet developer friendly code.</p><br><p><span style=\"font-size: 14pt;\"><strong>1. Ruang Lingkup</strong></span></p>\r\n<p>Berikut ini adalah ruang lingkup bisnis yang dapat diikutsertakan dalam Lomba Nasional Kreativitas Mahasiswa (LO KREATIF) 2021 kategori Ide Bisnis:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Mendukung salah satu program Sustainable Development Goals (SDG).</li>\r\n<li>Jenis usaha bebas sesuai minat, pasar dan keterampilan.</li>\r\n<li>Karakteristik usaha yang dikembangkan tergolong usaha mikro baik di bidang produksi barang dan/atau jasa, baik usaha baru atau usaha yang sudah ada.</li>\r\n<li>Proposal bisnis yang diajukan merupakan proposal bisnis yang belum pernah mendapatkan hibah atau memenangkan lomba apapun.</li>\r\n<li>Biaya alokasi untuk bisnis yaitu sebesar Rp 10.000.000 &ndash; Rp 20.000.000.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\"><strong>2. Format Proposal</strong></span></p>\r\n<div>\r\n<ul>\r\n<li>Naskah diketik dengan font style Times New Roman ukuran 12 dengan line spacing 1,5.</li>\r\n<li>Format kertas ukuran A4.</li>\r\n<li>Margin top, bottom, right dan left adalah 2,54 cm.</li>\r\n<li>Proposal maksimal 20 halaman dihitung mulai Latar Belakang Permasalahan sampai dengan Lampiran.</li>\r\n<li>Proposal dan Surat Pernyataan diunggah di web pada halaman &ldquo;Unggah Karya&rdquo; dengan format .pdf maksimal 10 MB.</li>\r\n</ul>\r\n</div>', '2021-07-18 22:35:19');

--
-- Trigger `tb_kompetisi`
--
DELIMITER $$
CREATE TRIGGER `del_contact_person_kompetisi` BEFORE DELETE ON `tb_kompetisi` FOR EACH ROW BEGIN

DELETE FROM tb_contact_person WHERE TYPE = 2 AND KODE = OLD.KODE_KOMPETISI;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `del_sosmed_kompetisi` BEFORE DELETE ON `tb_kompetisi` FOR EACH ROW BEGIN

DELETE FROM tb_sosmed WHERE TYPE = 2 AND KODE = OLD.KODE_KOMPETISI;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `del_tiket_kompetisi` BEFORE DELETE ON `tb_kompetisi` FOR EACH ROW BEGIN

DELETE FROM tb_tiket WHERE TYPE = 2 AND KODE = OLD.KODE_KOMPETISI;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `ID_PENGATURAN` int(10) NOT NULL,
  `KEY` varchar(50) DEFAULT NULL,
  `VALUE` text DEFAULT NULL,
  `DESC` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`ID_PENGATURAN`, `KEY`, `VALUE`, `DESC`) VALUES
(1, 'EM_HOST', 'ssl://smtp.gmail.com', NULL),
(2, 'EM_USERNAME', 'hic@stiki.ac.id', NULL),
(3, 'EM_PASSWORD', 'ITbanget96', NULL),
(4, 'LN_FACEBOOK', 'www.facebook.com', NULL),
(5, 'LN_INSTAGRAM', 'www.instagram.com', NULL),
(6, 'LN_TWITTER', 'www.twitter.com', NULL),
(7, 'LN_GITHUB', 'www.github.com', NULL),
(8, 'LOGO_FAV', 'icon-ts.png', NULL),
(9, 'LOGO_WHITE', 'logo-in.png', NULL),
(10, 'LOGO_BLACK', 'logo-ts.png', NULL),
(11, 'WEB_JUDUL', 'LO Kreatif', NULL),
(12, 'WEB_DESKRIPSI', 'Kelola kegiatan kompetisi dan event mulai dari pendaftaran hingga pembagian sertifikat secara mudah.', NULL),
(13, 'WEB_WA', '85785111746', NULL),
(14, 'WEB_HERO_BUTTON', '1', NULL),
(16, 'STATUS_PENDAFTARAN', '1', NULL),
(17, 'SMPT_GMAIL', '1', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `KODE_USER` varchar(12) NOT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `PROFIL` text DEFAULT NULL,
  `JK` char(1) DEFAULT NULL,
  `HP` varchar(20) DEFAULT NULL,
  `ALAMAT` text DEFAULT NULL,
  `INSTAGRAM` varchar(50) DEFAULT NULL,
  `INSTANSI` text DEFAULT NULL,
  `JABATAN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_peserta`
--

INSERT INTO `tb_peserta` (`KODE_USER`, `NAMA`, `PROFIL`, `JK`, `HP`, `ALAMAT`, `INSTAGRAM`, `INSTANSI`, `JABATAN`) VALUES
('USR_MHND116', 'MAHENDRA DWI PURWANTO', 'FOTO_-1629623600.jpg', 'L', '85785111746', 'Singosari\r\nCandirenggo', 'mahendradwipurwanto', 'STIKI Malang', '1|Pelajar / Mahasiswa'),
('ADM_001', 'ADMIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('JRI_DDYHf85', 'dedy hermawan', NULL, NULL, '', NULL, NULL, NULL, NULL),
('JRI_DMSPfad', 'Naflah Huwaida Hana', NULL, NULL, '085785', NULL, NULL, NULL, NULL),
('USR_MHND67b', 'MAHENDRA DWI PURWANTO', NULL, 'L', '85785111746', 'Singosari\r\nCandirenggo', '', 'STIKI Malang', '1|Pelajar / Mahasiswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sosmed`
--

CREATE TABLE `tb_sosmed` (
  `ID_SOSMED` int(10) NOT NULL,
  `TYPE` int(5) NOT NULL,
  `KODE` varchar(50) NOT NULL,
  `NAMA_SOSMED` varchar(50) DEFAULT NULL,
  `LINK_SOSMED` text DEFAULT NULL,
  `SOSMED` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sosmed`
--

INSERT INTO `tb_sosmed` (`ID_SOSMED`, `TYPE`, `KODE`, `NAMA_SOSMED`, `LINK_SOSMED`, `SOSMED`) VALUES
(18, 1, 'evnt-stiki-technofest-2-0-2021-bc7', 'stiki.technofest', 'www.instagram.com/stiki.technofest', 'INSTAGRAM'),
(19, 1, 'evnt-stiki-technofest-2-0-2021-bc7', 'STIKI MALANG', 'www.facebook.com/STIKI', 'FACEBOOK'),
(20, 2, 'evnt-lo-kreatif-2021-c8b', 'lo kreatif', 'www.instagram.com/lo.kreatif', 'INSTAGRAM'),
(21, 1, 'event-online-charity-seminar-series-2-629', 'STIKI', 'www.instagram.com/stiki', 'INSTAGRAM'),
(22, 1, 'kegiatan-hic-open-house-2021-9ce', 'hic.team', 'www.instagram.com/hic.team', 'INSTAGRAM'),
(23, 1, 'kegiatan-hic-open-house-2021-9ce', 'HIC TEAM', 'hic@stiki.ac.id', 'EMAIL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tiket`
--

CREATE TABLE `tb_tiket` (
  `ID_TIKET` int(10) NOT NULL,
  `TYPE` int(5) NOT NULL,
  `KODE` varchar(50) DEFAULT NULL,
  `NAMA_TIKET` varchar(50) DEFAULT NULL,
  `HARGA_TIKET` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tiket`
--

INSERT INTO `tb_tiket` (`ID_TIKET`, `TYPE`, `KODE`, `NAMA_TIKET`, `HARGA_TIKET`) VALUES
(17, 1, 'evnt-stiki-technofest-2-0-2021-bc7', 'MHS STIKI', 0),
(18, 1, 'evnt-stiki-technofest-2-0-2021-bc7', 'Luar STIKI', 25000),
(19, 2, 'evnt-lo-kreatif-2021-c8b', 'INDIVIDU', 50000),
(20, 2, 'evnt-lo-kreatif-2021-c8b', 'TEAM', 150000),
(21, 2, 'evnt-lo-kreatif-2021-c8b', 'MHS STIKI', 0),
(22, 1, 'event-online-charity-seminar-series-2-629', 'MHS STIKI', 25000),
(23, 1, 'event-online-charity-seminar-series-2-629', 'Luar Stiki', 50000),
(24, 1, 'kegiatan-hic-open-house-2021-9ce', 'MHS STIKI', 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_token`
--

CREATE TABLE `tb_token` (
  `id` int(10) NOT NULL,
  `KODE` varchar(12) NOT NULL,
  `KEY` text DEFAULT NULL,
  `TYPE` int(2) DEFAULT NULL,
  `STATUS` tinyint(1) DEFAULT 0,
  `DATE_CREATED` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_token`
--

INSERT INTO `tb_token` (`id`, `KODE`, `KEY`, `TYPE`, `STATUS`, `DATE_CREATED`) VALUES
(1, 'USR_MHND116', '84e24344b906df1a7664a6b12852e80a26dec5c1066eb0a43f7773fea6eaa00e1674f3de1a18810c95966e29dc1d0c17b760226cf9b3210c14ba40ba99790d24aP2biVoyC+CpyM7DjVZ0BuYfOxggqjaneAs0wRUDRLE=', 1, 1, '2021-05-10 04:00:02'),
(2, 'USR_5c4', '2f6156b5345dad697923c157207579b31db7a2344b289816453c8afe7edaef96edf77519bd719d1e0641c08e70c0556e7ab592ece7f798147533d7cf3b886570Tq4YxDqzQIZ3rANGJpZJuEyFGQ8oK+4SPNtxpaiRi6Y=', 1, 0, '1621581442'),
(4, 'USR_MHND116', '82d99c2027d0ca2061ea6f85cbe26c49fee941dc296d5b3daf293d81db261858', 2, 0, '1622367475'),
(5, 'USR_MHND116', 'cafae91fbf681be34b9bb3179156c430c09548a8b05213b69ab4fbf5e697c59a', 2, 0, '1623314290'),
(6, 'USR_MHND116', '7ccb74d0ac6deb670e5e4eadbf175001e4a8831bec5f9afdb2a5ca11d8a39dca', 2, 0, '1623480113'),
(8, 'USR_MHND116', 'a2a990c63ce5c58316af6fac66559524a6438167e8785966908b635440b99259', 2, 0, '1625257141'),
(9, 'USR_MHND116', '78272ce288c2ae3b92d79abfc407c831a638b959bb267d0826b91f4a9f6cf19a', 2, 0, '1625819547'),
(10, 'USR_MHND67b', '4ff9ecb1b2d40f2fa74439d4226ee235890cbf72fa1cbfe4518bb64bdf6476407eb2825aded7357d6da7ada44b2276d621c485de576ea77d3dd7a9c10bc6279aJkSG6OTYbfFjXpasC0UoNTO8bPsl+27aUT2FvTEgH58=', 1, 1, '1626832221'),
(11, 'USR_MHND116', '46162b9b8f29c304824ff223cffb884930aca6875538455842890ee00c9fdc64', 2, 0, '1629623752'),
(12, 'USR_MHND116', '7dd577f734a981e24603922bc6655232dc9b53a59c11ad347ab6ad6835bffafc', 2, 0, '1629674101');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_session`
--

CREATE TABLE `user_session` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_session`
--

INSERT INTO `user_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('2ij21mol651dvss48hkjisnpn2vbakmj', '::1', 1629679200, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637393230303b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b6d616e6167655f6b6567696174616e7c733a34313a226576656e742d6f6e6c696e652d636861726974792d73656d696e61722d7365726965732d322d363239223b6d616e6167655f6e616d614b6567696174616e7c733a33323a224f6e6c696e6520436861726974792053656d696e617220536572696573202332223b6d7374617475735f6b6567696174616e7c623a313b),
('2uq84u4aecakhenogn5ih6ap8fdb84ul', '::1', 1629677401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637373430313b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b),
('3v421vap3ol3asp6aco5kuoussk6arhl', '::1', 1629679739, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637393733393b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b6d616e6167655f6b6567696174616e7c733a34313a226576656e742d6f6e6c696e652d636861726974792d73656d696e61722d7365726965732d322d363239223b6d616e6167655f6e616d614b6567696174616e7c733a33323a224f6e6c696e6520436861726974792053656d696e617220536572696573202332223b6d7374617475735f6b6567696174616e7c623a313b),
('4cntcesmmo7jn3m6ph7lmr99ab02j4v0', '::1', 1629679740, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637393733393b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b6d616e6167655f6b6567696174616e7c733a34313a226576656e742d6f6e6c696e652d636861726974792d73656d696e61722d7365726965732d322d363239223b6d616e6167655f6e616d614b6567696174616e7c733a33323a224f6e6c696e6520436861726974792053656d696e617220536572696573202332223b6d7374617475735f6b6567696174616e7c623a313b),
('50ucjms4bg5cbrpuklvlg187ig0cggm8', '::1', 1629678898, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637383839383b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b6d616e6167655f6b6567696174616e7c733a34313a226576656e742d6f6e6c696e652d636861726974792d73656d696e61722d7365726965732d322d363239223b6d616e6167655f6e616d614b6567696174616e7c733a33323a224f6e6c696e6520436861726974792053656d696e617220536572696573202332223b6d7374617475735f6b6567696174616e7c623a313b),
('5nk51ra89pg2r0396ivr58gbaoocfu8d', '::1', 1629678584, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637383538343b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b),
('5qcssjqv858h49mcvqdhq9dj1hma54gb', '::1', 1629679693, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637393537313b6b6f64655f757365727c733a31313a225553525f4d484e44313136223b656d61696c7c733a32393a226d6168656e64726164776970757277616e746f40676d61696c2e636f6d223b6e616d617c733a32313a224d4148454e445241204457492050555257414e544f223b726f6c657c733a313a2231223b6c6f676765645f696e7c623a313b),
('8ghdhmin9asna3sv2oifd2r9hm8phn08', '::1', 1629679241, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637393234313b737563636573737c733a36363a22426572686173696c206d656e676972696d6b616e20656d61696c2c2063656b206b6f6e74616b206d6173756b206174617520666f6c646572207370616d20616e6461223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('ch6rc750u3tkj4ub2rufadllmrg40bi8', '::1', 1629677042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637373034323b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b),
('iekpd9h9uncr3q107hvbdoqruks3b1gq', '::1', 1629679571, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637393537313b6b6f64655f757365727c733a31313a225553525f4d484e44313136223b656d61696c7c733a32393a226d6168656e64726164776970757277616e746f40676d61696c2e636f6d223b6e616d617c733a32313a224d4148454e445241204457492050555257414e544f223b726f6c657c733a313a2231223b6c6f676765645f696e7c623a313b),
('n7isrbaagh89kp285040bo4lrs6b2v1b', '::1', 1629676740, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637363734303b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b),
('o2o29nujr89kkmrfcu5e5ccmvh43nl84', '::1', 1629673939, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637333933393b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b),
('vbqvpsk1dvgiq5p91pqnttus86n4q4fd', '::1', 1629678264, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632393637383236343b6b6f64655f757365727c733a373a2241444d5f303031223b656d61696c7c733a31393a2261646d696e406e6573746976656e742e6f7267223b6e616d617c733a353a2241444d494e223b726f6c657c733a313a2230223b6c6f676765645f696e7c623a313b);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidang_juri`
--
ALTER TABLE `bidang_juri`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `bidang_lomba`
--
ALTER TABLE `bidang_lomba`
  ADD PRIMARY KEY (`ID_BIDANG`);

--
-- Indeks untuk tabel `form_item`
--
ALTER TABLE `form_item`
  ADD PRIMARY KEY (`ID_ITEM`);

--
-- Indeks untuk tabel `form_meta`
--
ALTER TABLE `form_meta`
  ADD PRIMARY KEY (`ID_FORM`);

--
-- Indeks untuk tabel `kriteria_penilaian`
--
ALTER TABLE `kriteria_penilaian`
  ADD PRIMARY KEY (`ID_KRITERIA`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`ID_LOG`);

--
-- Indeks untuk tabel `log_type`
--
ALTER TABLE `log_type`
  ADD PRIMARY KEY (`ID_TYPE`);

--
-- Indeks untuk tabel `pendaftaran_data`
--
ALTER TABLE `pendaftaran_data`
  ADD PRIMARY KEY (`ID_DATA`);

--
-- Indeks untuk tabel `pendaftaran_kegiatan`
--
ALTER TABLE `pendaftaran_kegiatan`
  ADD PRIMARY KEY (`KODE_PENDAFTARAN`);

--
-- Indeks untuk tabel `pendaftaran_kompetisi`
--
ALTER TABLE `pendaftaran_kompetisi`
  ADD PRIMARY KEY (`KODE_PENDAFTARAN`);

--
-- Indeks untuk tabel `tahap_penilaian`
--
ALTER TABLE `tahap_penilaian`
  ADD PRIMARY KEY (`ID_TAHAP`);

--
-- Indeks untuk tabel `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD PRIMARY KEY (`KODE_ARTIKEL`);

--
-- Indeks untuk tabel `tb_artikel_tag`
--
ALTER TABLE `tb_artikel_tag`
  ADD PRIMARY KEY (`ID_TAG`);

--
-- Indeks untuk tabel `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD PRIMARY KEY (`KODE_USER`);

--
-- Indeks untuk tabel `tb_contact_person`
--
ALTER TABLE `tb_contact_person`
  ADD PRIMARY KEY (`ID_CP`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indeks untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`KODE_KEGIATAN`);

--
-- Indeks untuk tabel `tb_kompetisi`
--
ALTER TABLE `tb_kompetisi`
  ADD PRIMARY KEY (`KODE_KOMPETISI`);

--
-- Indeks untuk tabel `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`ID_PENGATURAN`);

--
-- Indeks untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD KEY `KODE_USER` (`KODE_USER`);

--
-- Indeks untuk tabel `tb_sosmed`
--
ALTER TABLE `tb_sosmed`
  ADD PRIMARY KEY (`ID_SOSMED`);

--
-- Indeks untuk tabel `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD PRIMARY KEY (`ID_TIKET`);

--
-- Indeks untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang_juri`
--
ALTER TABLE `bidang_juri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `bidang_lomba`
--
ALTER TABLE `bidang_lomba`
  MODIFY `ID_BIDANG` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `form_item`
--
ALTER TABLE `form_item`
  MODIFY `ID_ITEM` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2876;

--
-- AUTO_INCREMENT untuk tabel `form_meta`
--
ALTER TABLE `form_meta`
  MODIFY `ID_FORM` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT untuk tabel `kriteria_penilaian`
--
ALTER TABLE `kriteria_penilaian`
  MODIFY `ID_KRITERIA` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `ID_LOG` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT untuk tabel `log_type`
--
ALTER TABLE `log_type`
  MODIFY `ID_TYPE` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran_data`
--
ALTER TABLE `pendaftaran_data`
  MODIFY `ID_DATA` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT untuk tabel `tahap_penilaian`
--
ALTER TABLE `tahap_penilaian`
  MODIFY `ID_TAHAP` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_artikel_tag`
--
ALTER TABLE `tb_artikel_tag`
  MODIFY `ID_TAG` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_contact_person`
--
ALTER TABLE `tb_contact_person`
  MODIFY `ID_CP` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `ID_KATEGORI` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  MODIFY `ID_PENGATURAN` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_sosmed`
--
ALTER TABLE `tb_sosmed`
  MODIFY `ID_SOSMED` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_tiket`
--
ALTER TABLE `tb_tiket`
  MODIFY `ID_TIKET` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD CONSTRAINT `TB_PENGGUNA_ibfk_1` FOREIGN KEY (`KODE_USER`) REFERENCES `tb_auth` (`KODE_USER`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
