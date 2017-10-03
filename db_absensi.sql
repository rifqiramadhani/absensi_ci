-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 03:54 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_absen_susulan`
--

CREATE TABLE `t_absen_susulan` (
  `id_absen_susulan` int(11) NOT NULL,
  `nomor_induk` int(11) NOT NULL,
  `id_atasan` int(11) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `id_alasan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `approval_atasan` enum('0','1') NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_user` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_absen_susulan`
--

INSERT INTO `t_absen_susulan` (`id_absen_susulan`, `nomor_induk`, `id_atasan`, `tanggal_absen`, `id_alasan`, `keterangan`, `approval_atasan`, `created_date`, `created_user`, `updated_date`, `updated_user`, `active`) VALUES
(1, 4, 1, '2014-11-03', 1, 'Sakit', '1', '2014-11-25', 4, '2014-11-26', 1, '1'),
(2, 4, 1, '2014-11-04', 1, 'Sakit', '1', '2014-11-25', 4, '2014-11-26', 1, '1'),
(3, 3, 1, '2014-10-11', 2, 'cuti', '1', '2014-11-25', 3, '2014-11-26', 1, '1'),
(4, 3, 1, '2014-11-11', 2, 'Cuti', '1', '2014-11-25', 3, '2014-11-26', 1, '1'),
(5, 2, 5, '2014-07-11', 6, 'Lupa absen', '0', '2014-11-26', 2, '0000-00-00', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_alasan`
--

CREATE TABLE `t_alasan` (
  `id_alasan` int(11) NOT NULL,
  `nama_alasan` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_user` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_alasan`
--

INSERT INTO `t_alasan` (`id_alasan`, `nama_alasan`, `created_date`, `created_user`, `updated_date`, `updated_user`, `active`) VALUES
(1, 'Sakit', '2014-11-04', 1, '2014-11-04', 1, '1'),
(2, 'Cuti', '2014-11-04', 1, '0000-00-00', 0, '1'),
(3, 'Ijin', '2014-11-04', 1, '0000-00-00', 0, '1'),
(4, 'Lainnya', '2014-11-04', 1, '0000-00-00', 0, '1'),
(5, 'Masuk', '2014-11-24', 1, '0000-00-00', 0, '1'),
(6, 'Lupa Absen', '2014-11-26', 1, '0000-00-00', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_divisi`
--

CREATE TABLE `t_divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_user` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_divisi`
--

INSERT INTO `t_divisi` (`id_divisi`, `nama_divisi`, `created_date`, `created_user`, `updated_date`, `updated_user`, `active`) VALUES
(1, 'Divisi HR', '2014-11-04', 1, '0000-00-00', 0, '1'),
(2, 'Divisi IT', '2014-11-04', 1, '0000-00-00', 0, '1'),
(3, 'Divisi Finance', '2014-11-04', 1, '2014-11-04', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_golongan`
--

CREATE TABLE `t_golongan` (
  `id_golongan` int(11) NOT NULL,
  `nama_golongan` varchar(50) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_user` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_golongan`
--

INSERT INTO `t_golongan` (`id_golongan`, `nama_golongan`, `created_date`, `created_user`, `updated_date`, `updated_user`, `active`) VALUES
(1, 'Golongan 1', '2014-11-04', 1, '2014-11-04', 1, '1'),
(2, 'Golongan 2', '2014-11-04', 1, '0000-00-00', 0, '1'),
(3, 'Golongan 3', '2014-11-04', 1, '2014-11-04', 1, '1'),
(4, 'Golongan 4', '2014-11-04', 1, '0000-00-00', 0, '1'),
(5, 'Golongan 5', '2014-11-04', 1, '0000-00-00', 0, '1'),
(6, 'Golongan 6', '2014-11-04', 1, '0000-00-00', 0, '1'),
(7, 'Golongan 7', '2014-11-04', 1, '0000-00-00', 0, '1'),
(8, 'Golongan 8', '2014-11-04', 1, '0000-00-00', 0, '1'),
(9, 'Golongan 9', '2014-11-04', 1, '0000-00-00', 0, '1'),
(10, 'Golongan 10', '2014-11-04', 1, '0000-00-00', 0, '1'),
(11, 'Golongan 11', '2014-11-04', 1, '0000-00-00', 0, '1'),
(12, 'Golongan 12', '2014-11-04', 1, '0000-00-00', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_jabatan`
--

CREATE TABLE `t_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_user` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_jabatan`
--

INSERT INTO `t_jabatan` (`id_jabatan`, `nama_jabatan`, `created_date`, `created_user`, `updated_date`, `updated_user`, `active`) VALUES
(1, 'administrator', '2014-11-04', 1, '2014-11-04', 1, '1'),
(2, 'Dekan', '2014-11-04', 1, '2017-08-03', 1, '1'),
(3, 'Wakil Dekan Akademik dan Kemahasiswaan', '2014-11-04', 1, '2017-08-03', 1, '1'),
(4, 'Wakil Dekan Sumber Daya dan Inovasi', '2014-11-04', 1, '2017-08-03', 1, '1'),
(5, 'Kepala Bagian Tata Usaha', '2014-11-04', 1, '2017-08-03', 1, '1'),
(6, 'Kasubbag Akademik', '2017-08-03', 1, '0000-00-00', 0, '1'),
(7, 'Kasubbag Keuangan & Kekaryawanan', '2017-08-03', 1, '0000-00-00', 0, '1'),
(8, 'Kasubbag Umum & Pengelolaan Aset ', '2017-08-03', 1, '0000-00-00', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_jam_kerja`
--

CREATE TABLE `t_jam_kerja` (
  `id_jam_kerja` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_user` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_jam_kerja`
--

INSERT INTO `t_jam_kerja` (`id_jam_kerja`, `jam_masuk`, `jam_keluar`, `keterangan`, `active`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(1, '08:00:00', '17:00:00', '08.00 - 17.00', '1', 1, '2014-11-13', 1, '2014-11-13'),
(2, '08:30:00', '17:30:00', '08.30 - 17.30', '1', 1, '2014-11-13', 0, '0000-00-00'),
(3, '09:00:00', '18:00:00', '09:00 - 18:00', '1', 1, '2014-11-13', 1, '2014-11-13'),
(4, '07:30:00', '16:30:00', '07:30 - 16:30', '1', 1, '2014-11-18', 1, '2014-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `t_pegawai`
--

CREATE TABLE `t_pegawai` (
  `nomor_induk` int(11) NOT NULL,
  `nik` char(6) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('1','2') NOT NULL DEFAULT '1',
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL DEFAULT '-',
  `no_handphone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status_perkawinan` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `id_jabatan` int(11) NOT NULL,
  `id_golongan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_jam_kerja` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pegawai`
--

INSERT INTO `t_pegawai` (`nomor_induk`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_telp`, `no_handphone`, `email`, `status_perkawinan`, `id_jabatan`, `id_golongan`, `id_divisi`, `id_jam_kerja`, `tanggal_masuk`, `password`, `created_date`, `created_user`, `updated_date`, `updated_user`, `active`) VALUES
(1, '000001', 'Administrator', 'Brebes', '2014-11-04', '1', 'Jalan Cemara No 41', '0', '081220493870', 'email1@gmail.com', '1', 1, 1, 1, 3, '2014-11-04', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-11-04 00:00:00', 1, '2014-11-24 05:03:23', 1, '1'),
(2, '000002', 'Ramadhani', 'Semarang', '1990-09-06', '1', 'Jalan Rereongan Sarupi No 41 Ungaran Semarang ', '0', '081220493870', 'email1@gmail.com', '1', 3, 7, 2, 3, '2014-09-01', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-11-05 08:49:13', 1, '2017-08-07 02:56:24', 1, '1'),
(3, '000003', 'Muhammad', 'Bandung', '1989-10-18', '2', 'Jalan Raya Cibeureum Bandung', '0', '085635355321', 'email2@gmail.com', '1', 5, 7, 3, 1, '2012-01-01', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-11-05 08:51:05', 1, '2017-08-07 02:57:18', 1, '1'),
(4, '000004', 'Rifqi', 'Jakarta', '1990-01-06', '1', 'Jalan Turangga Jakarta', '0', '0857181718171', 'email3@gmail.com', '1', 5, 7, 1, 1, '2014-01-05', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-11-05 08:53:14', 1, '2017-08-07 02:57:01', 1, '1'),
(5, '000005', 'Prof. Dr. Ir. Purwanto, DEA', 'Surabaya', '1980-03-01', '1', 'Jalan Pengangsaan No 55', '0', '088716616521', 'email4@absensi.com', '2', 4, 8, 2, 3, '2010-02-09', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-11-26 09:14:16', 1, '2017-08-07 02:47:02', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_kehadiran`
--

CREATE TABLE `t_kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `nomor_induk` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_keluar` datetime NOT NULL,
  `hadir` enum('1','2') NOT NULL DEFAULT '2',
  `id_alasan` int(11) NOT NULL,
  `id_absen_susulan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_user` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kehadiran`
--

INSERT INTO `t_kehadiran` (`id_kehadiran`, `nomor_induk`, `tanggal`, `jam_masuk`, `jam_keluar`, `hadir`, `id_alasan`, `id_absen_susulan`, `keterangan`, `created_date`, `created_user`, `updated_date`, `updated_user`, `active`) VALUES
(1, 1, '2015-10-01', '2014-10-01 08:40:00', '2014-11-24 18:09:00', '1', 5, 0, '', '2014-10-24', 1, '2014-11-24', 1, '1'),
(3, 3, '2015-11-24', '2014-11-24 07:18:45', '2014-11-24 17:20:02', '1', 5, 0, '', '2014-11-24', 3, '2014-11-24', 3, '1'),
(4, 2, '2015-11-25', '2014-11-25 04:27:12', '0000-00-00 00:00:00', '1', 5, 0, '', '2014-11-25', 2, '0000-00-00', 0, '1'),
(8, 3, '2015-11-25', '2014-11-25 08:31:37', '2014-11-25 17:36:11', '1', 5, 0, '', '2014-11-25', 3, '2014-11-25', 3, '1'),
(10, 4, '2015-11-25', '2014-11-25 04:38:16', '0000-00-00 00:00:00', '1', 5, 0, '', '2014-11-25', 4, '0000-00-00', 0, '1'),
(11, 4, '2015-11-26', '2014-11-26 04:53:23', '0000-00-00 00:00:00', '1', 5, 0, '', '2014-11-26', 4, '0000-00-00', 0, '1'),
(12, 3, '2015-11-26', '2014-11-26 04:54:10', '0000-00-00 00:00:00', '1', 5, 0, '', '2014-11-26', 3, '0000-00-00', 0, '1'),
(13, 5, '2015-11-26', '2014-11-26 09:14:56', '0000-00-00 00:00:00', '1', 5, 0, '', '2014-11-26', 5, '0000-00-00', 0, '1'),
(14, 3, '2015-10-11', '2014-10-11 08:00:00', '2014-10-11 18:00:00', '1', 2, 3, '(Absen Susulan Approved on 26-11-2014 09:41:17)', '2014-11-26', 1, '2014-11-26', 1, '1'),
(15, 3, '2015-11-11', '2014-11-11 08:00:00', '2014-11-11 18:00:00', '1', 2, 4, '(Absen Susulan Approved on 26-11-2014 09:41:25)', '2014-11-26', 1, '2014-11-26', 1, '1'),
(16, 4, '2015-11-03', '2014-11-03 08:00:00', '2014-11-03 18:00:00', '1', 1, 1, '(Absen Susulan Approved on 26-11-2014 09:42:35)', '2014-11-26', 1, '2014-11-26', 1, '1'),
(17, 4, '2015-11-04', '2014-11-04 08:00:00', '2014-11-04 18:00:00', '1', 1, 2, '(Absen Susulan Approved on 26-11-2014 09:42:38)', '2014-11-26', 1, '2014-11-26', 1, '1'),
(18, 1, '2017-06-18', '2017-06-18 10:18:42', '0000-00-00 00:00:00', '1', 5, 0, '', '2017-06-18', 1, '0000-00-00', 0, '1'),
(19, 1, '2017-08-02', '2017-08-07 02:13:24', '2017-08-07 02:13:44', '1', 5, 0, '', '2017-08-07', 1, '2017-08-07', 1, '1'),
(20, 1, '2017-08-03', '2017-08-07 02:20:31', '2017-08-07 02:20:38', '1', 5, 0, '', '2017-08-07', 1, '2017-08-07', 1, '1'),
(21, 1, '2017-08-04', '2017-08-07 02:21:39', '0000-00-00 00:00:00', '1', 5, 0, '', '2017-08-07', 1, '0000-00-00', 0, '1'),
(22, 1, '2017-08-07', '2017-08-07 02:28:18', '0000-00-00 00:00:00', '1', 5, 0, '', '2017-08-07', 1, '0000-00-00', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_perencanaan_harikerja`
--

CREATE TABLE `t_perencanaan_harikerja` (
  `id_perencanaan` int(11) NOT NULL,
  `tanggal` varchar(2) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `keterangan` varchar(50) NOT NULL DEFAULT '1',
  `created_date` date NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_perencanaan_harikerja`
--

INSERT INTO `t_perencanaan_harikerja` (`id_perencanaan`, `tanggal`, `bulan`, `tahun`, `status`, `keterangan`, `created_date`, `created_user`, `updated_user`, `updated_date`, `active`) VALUES
(1, '1', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(2, '2', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(3, '3', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(4, '4', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(5, '5', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(6, '6', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(7, '7', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(8, '8', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(9, '9', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(10, '10', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(11, '11', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(12, '12', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(13, '13', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(14, '14', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(15, '15', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(16, '16', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(17, '17', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(18, '18', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(19, '19', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(20, '20', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(21, '21', '11', '2014', '1', '', '2014-11-11', 1, 1, '2014-11-12', '1'),
(22, '22', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(23, '23', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(24, '24', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(25, '25', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(26, '26', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(27, '27', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(28, '28', '11', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(29, '29', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(30, '30', '11', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-12', '1'),
(31, '1', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(32, '2', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(33, '3', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(34, '4', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(35, '5', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(36, '6', '12', '2014', '0', 'weekend', '2014-11-11', 1, 1, '2014-11-18', '1'),
(37, '7', '12', '2014', '0', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(38, '8', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(39, '9', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(40, '10', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(41, '11', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(42, '12', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(43, '13', '12', '2014', '0', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(44, '14', '12', '2014', '0', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(45, '15', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(46, '16', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(47, '17', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(48, '18', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(49, '19', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(50, '20', '12', '2014', '0', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(51, '21', '12', '2014', '0', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(52, '22', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(53, '23', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(54, '24', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(55, '25', '12', '2014', '0', 'Hari Natal', '2014-11-11', 1, 0, '0000-00-00', '1'),
(56, '26', '12', '2014', '0', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(57, '27', '12', '2014', '0', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(58, '28', '12', '2014', '0', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(59, '29', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(60, '30', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(61, '31', '12', '2014', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(62, '1', '1', '2015', '0', 'Tahun Baru 2015', '2014-11-11', 1, 0, '0000-00-00', '1'),
(63, '2', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(64, '3', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(65, '4', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(66, '5', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(67, '6', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(68, '7', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(69, '8', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(70, '9', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(71, '10', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(72, '11', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(73, '12', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(74, '13', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(75, '14', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(76, '15', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(77, '16', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(78, '17', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(79, '18', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(80, '19', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(81, '20', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(82, '21', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(83, '22', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(84, '23', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(85, '24', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(86, '25', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(87, '26', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(88, '27', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(89, '28', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(90, '29', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(91, '30', '1', '2015', '1', '', '2014-11-11', 1, 0, '0000-00-00', '1'),
(92, '31', '1', '2015', '0', 'weekend', '2014-11-11', 1, 0, '0000-00-00', '1'),
(93, '1', '2', '2015', '0', 'weekend', '2014-11-12', 1, 0, '0000-00-00', '1'),
(94, '2', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(95, '3', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(96, '4', '2', '2015', '1', 'tetete', '2014-11-12', 1, 0, '0000-00-00', '1'),
(97, '5', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(98, '6', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(99, '7', '2', '2015', '0', 'weekend', '2014-11-12', 1, 0, '0000-00-00', '1'),
(100, '8', '2', '2015', '0', 'weekend', '2014-11-12', 1, 0, '0000-00-00', '1'),
(101, '9', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(102, '10', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(103, '11', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(104, '12', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(105, '13', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(106, '14', '2', '2015', '0', 'weekend', '2014-11-12', 1, 0, '0000-00-00', '1'),
(107, '15', '2', '2015', '0', 'weekend', '2014-11-12', 1, 0, '0000-00-00', '1'),
(108, '16', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(109, '17', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(110, '18', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(111, '19', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(112, '20', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(113, '21', '2', '2015', '0', 'weekend', '2014-11-12', 1, 0, '0000-00-00', '1'),
(114, '22', '2', '2015', '0', 'weekend', '2014-11-12', 1, 0, '0000-00-00', '1'),
(115, '23', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(116, '24', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(117, '25', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(118, '26', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(119, '27', '2', '2015', '1', '', '2014-11-12', 1, 0, '0000-00-00', '1'),
(120, '28', '2', '2015', '0', 'weekend', '2014-11-12', 1, 0, '0000-00-00', '1'),
(121, '1', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(122, '2', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(123, '3', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(124, '4', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(125, '5', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(126, '6', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(127, '7', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(128, '8', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(129, '9', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(130, '10', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(131, '11', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(132, '12', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(133, '13', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(134, '14', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(135, '15', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(136, '16', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(137, '17', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(138, '18', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(139, '19', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(140, '20', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(141, '21', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(142, '22', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(143, '23', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(144, '24', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(145, '25', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(146, '26', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(147, '27', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(148, '28', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(149, '29', '3', '2015', '0', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(150, '30', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1'),
(151, '31', '3', '2015', '1', '', '2017-08-07', 1, 0, '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_type`
--

CREATE TABLE `t_user_type` (
  `id_user_type` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama_user_type` varchar(50) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_user` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_type`
--

INSERT INTO `t_user_type` (`id_user_type`, `id_jabatan`, `nama_user_type`, `created_date`, `created_user`, `updated_date`, `updated_user`, `active`) VALUES
(1, 1, 'administrator', '2014-11-04', 1, '2014-11-04', 1, '1'),
(2, 2, 'Dekan', '2014-11-04', 1, '2017-08-07', 1, '1'),
(3, 3, 'Wakil Dekan I', '2014-11-04', 1, '2017-08-07', 1, '1'),
(4, 4, 'Wakil Dekan II', '2014-11-04', 1, '2017-08-07', 1, '1'),
(5, 5, 'Kabag TU', '2014-11-04', 1, '2017-08-07', 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_absen_susulan`
--
ALTER TABLE `t_absen_susulan`
  ADD PRIMARY KEY (`id_absen_susulan`);

--
-- Indexes for table `t_alasan`
--
ALTER TABLE `t_alasan`
  ADD PRIMARY KEY (`id_alasan`);

--
-- Indexes for table `t_divisi`
--
ALTER TABLE `t_divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `t_golongan`
--
ALTER TABLE `t_golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `t_jabatan`
--
ALTER TABLE `t_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `t_jam_kerja`
--
ALTER TABLE `t_jam_kerja`
  ADD PRIMARY KEY (`id_jam_kerja`);

--
-- Indexes for table `t_pegawai`
--
ALTER TABLE `t_pegawai`
  ADD PRIMARY KEY (`nomor_induk`);

--
-- Indexes for table `t_kehadiran`
--
ALTER TABLE `t_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indexes for table `t_perencanaan_harikerja`
--
ALTER TABLE `t_perencanaan_harikerja`
  ADD PRIMARY KEY (`id_perencanaan`);

--
-- Indexes for table `t_user_type`
--
ALTER TABLE `t_user_type`
  ADD PRIMARY KEY (`id_user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_absen_susulan`
--
ALTER TABLE `t_absen_susulan`
  MODIFY `id_absen_susulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_alasan`
--
ALTER TABLE `t_alasan`
  MODIFY `id_alasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `t_divisi`
--
ALTER TABLE `t_divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_golongan`
--
ALTER TABLE `t_golongan`
  MODIFY `id_golongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `t_jabatan`
--
ALTER TABLE `t_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `t_jam_kerja`
--
ALTER TABLE `t_jam_kerja`
  MODIFY `id_jam_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_pegawai`
--
ALTER TABLE `t_pegawai`
  MODIFY `nomor_induk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_kehadiran`
--
ALTER TABLE `t_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `t_perencanaan_harikerja`
--
ALTER TABLE `t_perencanaan_harikerja`
  MODIFY `id_perencanaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `t_user_type`
--
ALTER TABLE `t_user_type`
  MODIFY `id_user_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
