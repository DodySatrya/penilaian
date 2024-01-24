-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 04:36 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'site administration'),
(2, 'wali_kelas', 'Walikelas');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(1, 8),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'admin@exaple.com', 1, '2022-06-11 22:42:19', 1),
(2, '::1', 'admin@exaple.com', 1, '2022-06-11 22:47:56', 1),
(3, '::1', 'admin@exaple.com', 1, '2022-06-11 22:48:18', 1),
(4, '::1', 'walikelas@example.com', 2, '2022-06-11 22:49:07', 1),
(5, '::1', 'admin@exaple.com', 1, '2022-06-11 22:56:39', 1),
(6, '::1', 'walikelas@example.com', 2, '2022-06-11 23:29:29', 1),
(7, '::1', 'admin@exaple.com', 1, '2022-06-11 23:29:50', 1),
(8, '::1', 'walikelas@example.com', 2, '2022-06-12 02:19:49', 1),
(9, '::1', 'admin@exaple.com', 1, '2022-06-12 09:44:56', 1),
(10, '::1', 'wali kelas', NULL, '2022-06-12 09:52:11', 0),
(11, '::1', 'walik', NULL, '2022-06-12 09:55:12', 0),
(12, '::1', 'admin@exaple.com', 1, '2022-06-12 09:55:23', 1),
(13, '::1', 'walikelas@example.com', 2, '2022-06-12 09:58:51', 1),
(14, '::1', 'admin@exaple.com', 1, '2022-06-12 10:23:51', 1),
(15, '::1', 'admin@exaple.com', 1, '2022-06-13 19:45:47', 1),
(16, '::1', 'admin@exaple.com', 1, '2022-06-13 19:53:45', 1),
(17, '::1', 'anis@gmail.com', 2, '2022-06-13 20:05:15', 1),
(18, '::1', 'siska@gmail.com', 1, '2022-06-13 20:08:50', 1),
(19, '::1', 'siska@gmail.com', 1, '2022-06-13 21:50:33', 1),
(20, '::1', 'siska@gmail.com', 1, '2022-06-20 20:29:31', 1),
(21, '::1', 'siska@gmail.com', 1, '2022-06-27 19:19:17', 1),
(22, '::1', 'Asyifa Rifta', NULL, '2022-06-27 21:44:35', 0),
(23, '::1', 'anis@gmail.com', 2, '2022-06-27 21:44:59', 1),
(24, '::1', 'nurhandayani@gmail.com', 4, '2022-06-27 21:45:58', 1),
(25, '::1', 'anis@gmail.com', 2, '2022-06-27 21:47:03', 1),
(26, '::1', 'asyifa@gmail.com', 1, '2022-06-27 21:56:35', 1),
(27, '::1', 'anis@gmail.com', 2, '2022-06-27 21:59:18', 1),
(28, '::1', 'asyifa@gmail.com', 1, '2022-06-28 10:10:36', 1),
(29, '::1', 'walik', NULL, '2022-06-28 10:27:43', 0),
(30, '::1', 'walik', NULL, '2022-06-28 10:28:05', 0),
(31, '::1', 'admin', NULL, '2022-07-02 10:04:53', 0),
(32, '::1', 'asyifa@gmail.com', 1, '2022-07-02 10:04:59', 1),
(33, '::1', 'anis@gmail.com', 2, '2022-07-02 10:06:39', 1),
(34, '::1', 'asyifa@gmail.com', 1, '2022-07-02 12:18:07', 1),
(35, '::1', 'asyifa@gmail.com', 1, '2022-07-02 12:18:22', 1),
(36, '::1', 'anis@gmail.com', 2, '2022-07-02 13:13:02', 1),
(37, '::1', 'asyifa@gmail.com', 1, '2022-07-02 13:13:29', 1),
(38, '::1', 'asyifa@gmail.com', 1, '2022-07-02 13:16:58', 1),
(39, '::1', 'anis@gmail.com', 2, '2022-07-02 13:17:22', 1),
(40, '::1', 'asyifa@gmail.com', 1, '2022-07-02 13:19:48', 1),
(41, '::1', 'asyifa@gmail.com', 1, '2022-07-02 13:21:13', 1),
(42, '::1', 'walik', NULL, '2022-07-02 13:22:01', 0),
(43, '::1', 'walik', NULL, '2022-07-02 13:22:26', 0),
(44, '::1', 'anis@gmail.com', 2, '2022-07-02 13:22:55', 1),
(45, '::1', 'asyifa@gmail.com', 1, '2022-07-02 13:23:26', 1),
(46, '::1', 'anis@gmail.com', 2, '2022-07-02 13:26:58', 1),
(47, '::1', 'asyifa@gmail.com', 1, '2022-07-04 22:20:05', 1),
(48, '::1', 'walik', NULL, '2022-07-04 22:46:34', 0),
(49, '::1', 'walik1', NULL, '2022-07-04 22:47:53', 0),
(50, '::1', 'walik1', NULL, '2022-07-04 22:48:25', 0),
(51, '::1', 'walik', NULL, '2022-07-04 22:48:49', 0),
(52, '::1', 'walik', NULL, '2022-07-04 22:49:13', 0),
(53, '::1', 'asyifa@gmail.com', 1, '2022-07-04 22:49:18', 1),
(54, '::1', 'nurhandayani@gmail.com', 4, '2022-07-04 22:50:45', 1),
(55, '::1', 'asyifa@gmail.com', 1, '2022-07-04 22:51:29', 1),
(56, '::1', 'anis@gmail.com', 2, '2022-07-04 22:52:15', 1),
(57, '::1', 'yusufhamdan@gmail.com', 3, '2022-07-04 22:53:10', 1),
(58, '::1', 'noerharjadi@gmail.com', 5, '2022-07-04 22:53:56', 1),
(59, '::1', 'asyifa@gmail.com', 1, '2022-07-04 22:54:16', 1),
(60, '::1', 'anis@gmail.com', 2, '2022-07-04 22:59:56', 1),
(61, '::1', 'yusufhamdan@gmail.com', 3, '2022-07-04 23:01:19', 1),
(62, '::1', 'nurhandayani@gmail.com', 4, '2022-07-04 23:02:10', 1),
(63, '::1', 'anis@gmail.com', 2, '2022-07-05 07:18:31', 1),
(64, '::1', 'asyifa@gmail.com', 1, '2022-07-05 07:37:49', 1),
(65, '::1', 'anis@gmail.com', 2, '2022-07-05 07:41:21', 1),
(66, '::1', 'asyifa@gmail.com', 1, '2022-07-05 07:45:26', 1),
(67, '::1', 'anis@gmail.com', 2, '2022-07-05 07:49:53', 1),
(68, '::1', 'asyifa@gmail.com', 1, '2022-07-05 08:10:12', 1),
(69, '::1', 'asyifa@gmail.com', 1, '2022-07-05 08:16:54', 1),
(70, '::1', 'asyifa@gmail.com', 1, '2022-07-05 08:17:04', 1),
(71, '::1', 'asyifa@gmail.com', 1, '2022-07-05 08:19:01', 1),
(72, '::1', 'anis@gmail.com', 2, '2022-07-05 08:45:30', 1),
(73, '::1', 'asyifa@gmail.com', 1, '2022-07-05 08:49:55', 1),
(74, '::1', 'walik5', NULL, '2022-07-05 08:59:14', 0),
(75, '::1', 'walik5', NULL, '2022-07-05 08:59:31', 0),
(76, '::1', 'walik5', NULL, '2022-07-05 08:59:52', 0),
(77, '::1', 'Taufikhidayat@gmail.com', 7, '2022-07-05 09:00:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'MM', 'Jurusan Multimedia', '2022-06-20 21:43:25', '2022-06-20 21:43:25', NULL),
(5, 'PS', 'jurusan Perbankan Syariah', '2022-06-20 21:57:01', '2022-06-27 20:09:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) UNSIGNED NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AKADEMIK', '2022-06-11 22:13:01', '2022-06-11 22:13:01', NULL),
(2, 'NON AKADEMIK', '2022-06-11 22:13:01', '2022-06-11 22:13:01', NULL),
(3, 'EKSTRA KURIKULER', '2022-06-11 22:13:01', '2022-06-11 22:13:01', NULL),
(4, 'KEHADIRAN', '2022-06-11 22:13:01', '2022-06-11 22:13:01', NULL),
(9, 'DASAR BIDANG KEAHLIAN', '2022-06-27 20:58:31', '2022-06-27 20:58:31', NULL),
(12, 'DASAR PROGRAM KEAHLIAN', '2022-06-27 21:00:47', '2022-06-27 21:00:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `wali` varchar(255) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `nomor` int(5) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `wali`, `kelas`, `jurusan`, `nomor`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(26, 'Anis Wahdati', 'XII', 'PS', 1, NULL, '2022-07-02 13:25:03', '2022-07-02 13:25:03', NULL),
(27, 'Nur Handayani', 'XII', 'MM', 1, NULL, '2022-07-04 22:23:11', '2022-07-04 22:23:11', NULL),
(28, 'Yusuf Hamdani', 'XI', 'PS', 1, NULL, '2022-07-04 22:55:24', '2022-07-04 22:55:24', NULL),
(29, 'Noer Harjadi', 'XI', 'MM', 1, NULL, '2022-07-04 22:57:18', '2022-07-04 22:57:18', NULL),
(30, 'Elly Susiawati', 'X', 'PS', 1, NULL, '2022-07-04 22:57:48', '2022-07-04 22:57:48', NULL),
(31, 'Taufik Hidayat', 'X', 'MM', 1, NULL, '2022-07-04 22:58:23', '2022-07-04 22:58:23', NULL),
(32, 'Anis Wahdati', 'X', 'MM', 2, NULL, '2022-07-04 22:59:05', '2022-07-04 22:59:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) UNSIGNED NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `has_kkm` tinyint(1) NOT NULL DEFAULT 1,
  `nama` varchar(255) NOT NULL,
  `kkm` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `tipe`, `has_kkm`, `nama`, `kkm`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'KEHADIRAN', 0, 'IZIN', 0, '', '2022-06-11 23:22:56', '2022-06-11 23:22:56', NULL),
(2, 'KEHADIRAN', 0, 'ALPHA', 0, '', '2022-06-11 23:23:07', '2022-06-11 23:23:07', NULL),
(3, 'KEHADIRAN', 0, 'SAKIT', 0, '', '2022-06-11 23:23:21', '2022-06-11 23:23:21', NULL),
(16, 'AKADEMIK', 1, 'Pendidikan Agama dan Budi Pekerti', 75, '', '2022-06-27 20:44:51', '2022-06-27 20:44:51', NULL),
(17, 'AKADEMIK', 1, 'Pendidikan Pancasila dan Kewarganegaraan', 75, '', '2022-06-27 20:46:35', '2022-06-27 20:46:35', NULL),
(18, 'AKADEMIK', 1, 'Bahasa Indonesia', 75, '', '2022-06-27 20:47:20', '2022-06-27 20:47:20', NULL),
(19, 'AKADEMIK', 1, 'Matematika', 75, '', '2022-06-27 20:48:27', '2022-06-27 20:48:27', NULL),
(20, 'AKADEMIK', 1, 'Bahasa Inggris', 75, '', '2022-06-27 20:48:51', '2022-06-27 20:48:51', NULL),
(21, 'AKADEMIK', 1, 'Aswaja', 75, '', '2022-06-27 20:49:26', '2022-06-27 20:49:26', NULL),
(22, 'AKADEMIK', 1, 'Hadist', 75, '', '2022-06-27 20:49:58', '2022-06-27 20:49:58', NULL),
(23, 'AKADEMIK', 1, 'Fiqih Taqrib', 75, '', '2022-06-27 20:50:21', '2022-06-27 20:50:21', NULL),
(24, 'DASAR BIDANG KEAHLIAN', 1, 'Akuntansi Perbankan Syariah', 75, '', '2022-06-27 21:04:21', '2022-06-27 21:04:21', NULL),
(25, 'DASAR BIDANG KEAHLIAN', 1, 'Komputer Akuntansi', 75, '', '2022-06-27 21:04:52', '2022-06-27 21:04:52', NULL),
(26, 'DASAR BIDANG KEAHLIAN', 1, 'Ekonomi Islam', 75, '', '2022-06-27 21:05:22', '2022-06-27 21:05:22', NULL),
(27, 'DASAR PROGRAM KEAHLIAN', 1, 'Layanan Lembaga Keuangan Syariah', 75, '', '2022-06-27 21:06:34', '2022-06-27 21:06:34', NULL),
(28, 'DASAR PROGRAM KEAHLIAN', 1, 'Administrasi Pajak ', 75, '', '2022-06-27 21:07:22', '2022-06-27 21:07:22', NULL),
(29, 'DASAR PROGRAM KEAHLIAN', 1, 'Produk Kreatif Kewirausahaan', 75, '', '2022-06-27 21:08:06', '2022-06-27 21:08:06', NULL),
(30, 'NON AKADEMIK', 1, 'SIKAP', 75, '', '2022-06-27 21:10:13', '2022-06-27 21:10:13', NULL),
(31, 'NON AKADEMIK', 1, 'KETRAMPILAN', 75, '', '2022-06-27 21:10:59', '2022-06-27 21:10:59', NULL),
(32, 'EKSTRA KURIKULER', 1, 'PRAMUKA', 75, '', '2022-06-27 21:13:09', '2022-06-27 21:13:09', NULL),
(33, 'EKSTRA KURIKULER', 1, 'PECINTA ALAM', 75, '', '2022-06-27 21:21:06', '2022-06-27 21:21:06', NULL),
(34, 'EKSTRA KURIKULER', 1, 'SILAT', 75, '', '2022-06-27 21:22:48', '2022-06-27 21:22:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(95, '2017-11-20-223112', 'App\\Database\\Migrations\\CreateAuthTables', 'default', 'App', 1655003557, 1),
(96, '2022-06-06-081028', 'App\\Database\\Migrations\\SiswaMigrate', 'default', 'App', 1655003557, 1),
(97, '2022-06-06-081038', 'App\\Database\\Migrations\\JurusanMigrate', 'default', 'App', 1655003557, 1),
(98, '2022-06-06-081059', 'App\\Database\\Migrations\\KelasMigrate', 'default', 'App', 1655003557, 1),
(99, '2022-06-07-113431', 'App\\Database\\Migrations\\MapelMigrate', 'default', 'App', 1655003557, 1),
(100, '2022-06-07-192235', 'App\\Database\\Migrations\\NilaiMigrate', 'default', 'App', 1655003557, 1),
(101, '2022-06-09-033716', 'App\\Database\\Migrations\\KategoriMigrate', 'default', 'App', 1655003557, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) UNSIGNED NOT NULL,
  `semester` int(5) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `nilai` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `semester`, `id_siswa`, `nama`, `kelas`, `jurusan`, `nilai`, `created_at`, `updated_at`) VALUES
(8, 2, 8, 'WAHYUDI', 'XII PS 1', 'PS', '{\"AKADEMIK\":[{\"mapel\":\"Pendidikan Agama dan Budi Pekerti\",\"nilai\":\"82\"},{\"mapel\":\"Pendidikan Pancasila dan Kewarganegaraan\",\"nilai\":\"80\"},{\"mapel\":\"Bahasa Indonesia\",\"nilai\":\"80\"},{\"mapel\":\"Matematika\",\"nilai\":\"81\"},{\"mapel\":\"Bahasa Inggris\",\"nilai\":\"78\"},{\"mapel\":\"Aswaja\",\"nilai\":\"77\"},{\"mapel\":\"Hadist\",\"nilai\":\"77\"},{\"mapel\":\"Fiqih Taqrib\",\"nilai\":\"77\"}],\"DASAR BIDANG KEAHLIAN\":[{\"mapel\":\"Akuntansi Perbankan Syariah\",\"nilai\":\"70\"},{\"mapel\":\"Komputer Akuntansi\",\"nilai\":\"70\"},{\"mapel\":\"Ekonomi Islam\",\"nilai\":\"85\"}],\"DASAR PROGRAM KEAHLIAN\":[{\"mapel\":\"Layanan Lembaga Keuangan Syariah\",\"nilai\":\"84\"},{\"mapel\":\"Administrasi Pajak \",\"nilai\":\"70\"},{\"mapel\":\"Produk Kreatif Kewirausahaan\",\"nilai\":\"77\"}],\"EKSTRA KURIKULER\":[{\"mapel\":\"PRAMUKA\",\"nilai\":\"0\"},{\"mapel\":\"PECINTA ALAM\",\"nilai\":\"0\"},{\"mapel\":\"SILAT\",\"nilai\":\"0\"}],\"KEHADIRAN\":[{\"mapel\":\"IZIN\",\"nilai\":\"0\"},{\"mapel\":\"ALPHA\",\"nilai\":\"0\"},{\"mapel\":\"SAKIT\",\"nilai\":\"0\"}],\"NON AKADEMIK\":[{\"mapel\":\"SIKAP\",\"nilai\":\"85\"},{\"mapel\":\"KETRAMPILAN\",\"nilai\":\"75\"}]}', '2022-07-02 13:35:05', '2022-07-02 13:35:05'),
(9, 2, 9, 'Asyifa Rifta Nur Haliza', 'XII PS 1', 'PS', '{\"AKADEMIK\":[{\"mapel\":\"Pendidikan Agama dan Budi Pekerti\",\"nilai\":\"80\"},{\"mapel\":\"Pendidikan Pancasila dan Kewarganegaraan\",\"nilai\":\"90\"},{\"mapel\":\"Bahasa Indonesia\",\"nilai\":\"89\"},{\"mapel\":\"Matematika\",\"nilai\":\"87\"},{\"mapel\":\"Bahasa Inggris\",\"nilai\":\"90\"},{\"mapel\":\"Aswaja\",\"nilai\":\"90\"},{\"mapel\":\"Hadist\",\"nilai\":\"90\"},{\"mapel\":\"Fiqih Taqrib\",\"nilai\":\"90\"}],\"DASAR BIDANG KEAHLIAN\":[{\"mapel\":\"Akuntansi Perbankan Syariah\",\"nilai\":\"90\"},{\"mapel\":\"Komputer Akuntansi\",\"nilai\":\"90\"},{\"mapel\":\"Ekonomi Islam\",\"nilai\":\"90\"}],\"DASAR PROGRAM KEAHLIAN\":[{\"mapel\":\"Layanan Lembaga Keuangan Syariah\",\"nilai\":\"90\"},{\"mapel\":\"Administrasi Pajak \",\"nilai\":\"90\"},{\"mapel\":\"Produk Kreatif Kewirausahaan\",\"nilai\":\"90\"}],\"EKSTRA KURIKULER\":[{\"mapel\":\"PRAMUKA\",\"nilai\":\"90\"},{\"mapel\":\"PECINTA ALAM\",\"nilai\":\"0\"},{\"mapel\":\"SILAT\",\"nilai\":\"0\"}],\"KEHADIRAN\":[{\"mapel\":\"IZIN\",\"nilai\":\"1\"},{\"mapel\":\"ALPHA\",\"nilai\":\"2\"},{\"mapel\":\"SAKIT\",\"nilai\":\"0\"}],\"NON AKADEMIK\":[{\"mapel\":\"SIKAP\",\"nilai\":\"90\"},{\"mapel\":\"KETRAMPILAN\",\"nilai\":\"90\"}]}', '2022-07-05 08:39:50', '2022-07-05 08:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `kelas`, `jurusan`, `nama`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, '213133', 'XII PS 1', 'PS', 'WAHYUDI', 'jalan jlamprang', '2005-01-02', 'L', 'Islam', '2022-07-02 13:26:27', '2022-07-05 07:38:37', NULL),
(9, '12345', 'XII PS 1', 'PS', 'Asyifa Rifta Nur Haliza', 'jalan raya cepagan', '2002-06-22', 'P', 'Islam', '2022-07-05 08:20:39', '2022-07-05 08:21:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `nama`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'asyifa@gmail.com', 'Admin', 'Asyifa Rifta', '$2y$10$kWhUBxcSqVxRogiT18XFhe2VWoQzuEF1RgZCw9vo4pAyV4cMe01zO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-11 22:13:01', '2022-06-27 19:35:19', NULL),
(2, 'anis@gmail.com', 'walik', 'Anis Wahdati', '$2y$10$QAMrlIetVK9Jck.DnzjL0OLjmO83pv1IHyY0QwpLlH.F.T0f4UkO2', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-11 22:49:00', '2022-06-27 20:14:08', NULL),
(3, 'yusufhamdan@gmail.com', 'walik1', 'Yusuf Hamdani', '$2y$10$zj3rW43X6nmZguGOE7zFoO76y4sZYt1VXHwzGtzxHTb3IivR1t2Vu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-11 23:31:16', '2022-06-27 19:36:28', NULL),
(4, 'nurhandayani@gmail.com', 'walik2', 'Nur Handayani', '$2y$10$cFG9mqjgCC/Eu.3gC9oUxuMBxbiNtGaSIJJ5G3PAtaUbbIUnjELcK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-20 22:07:44', '2022-06-27 19:37:06', NULL),
(5, 'noerharjadi@gmail.com', 'walik3', 'Noer Harjadi', '$2y$10$1Mg3724mV3U8sOtf2FHrQeOBbSx9MxYmNZvyCBZ0w1GMg/kcVAgka', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-20 22:08:46', '2022-06-27 19:38:04', NULL),
(6, 'ellysusi@gmail.com', 'walik4', 'Elly Susiawati', '$2y$10$PC631dUQfBDifBwfjZHM2O4GqaMJIO6VV3xr/JcggD53mbyKlWVku', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-20 22:15:11', '2022-06-27 19:38:39', NULL),
(7, 'Taufikhidayat@gmail.com', 'walik5', 'Taufik Hidayat', '$2y$10$lOHHwgiAs8ifd/uY791w7uEXS.HuAx26Uwq2jo2D7kq6UceyEa.hG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-20 22:17:10', '2022-07-05 09:00:13', NULL),
(8, 'Hasyimfahmi@gmail.com', 'Hasyim Fahmi', 'Hasyim Fahmi', '$2y$10$wPvInZfgW5kwb4rx.3lPq.E/JKD3vXPR2KBND0m/nfXqgJyb2efXu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-27 19:41:42', '2022-06-27 19:41:42', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
