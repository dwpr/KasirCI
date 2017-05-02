-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2017 at 10:48 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpl_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kdbuku` varchar(10) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `stock` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kdbuku`, `judul`, `pengarang`, `harga`, `stock`) VALUES
('1124', 'Belajar Membuat Kue Keranjang', 'Surahmi Kusbiyanti', '10000', '20'),
('113', 'Mengarang Indah', 'Andi Eko', '12000', '4'),
('12345', 'Meracik Teh Ala Chef Bara', 'Bara Dwi Utama', '30000', '3'),
('34556', 'Tips Memancing Belut / Unagi', 'Singga Aunt', '10000', '5'),
('4431', 'Membelah Lautan', 'R. Singgit', '50000', '10'),
('54321', 'Belajar Bahasa Jepang', 'Ketsuke Kobayashi', '50000', '3');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `kdbuku` varchar(10) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `jumlah` varchar(5) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `ke` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian2`
--

CREATE TABLE `pembelian2` (
  `kdbuku` varchar(10) NOT NULL,
  `jumlah` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(4) NOT NULL,
  `lv` varchar(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(40) NOT NULL COMMENT 'Nama Pengguna Sistem'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `lv`, `username`, `password`, `nama`) VALUES
('1', '1', 'mimin', '03f7f7198958ffbda01db956d15f134a', 'Administrator [Pemilik Utama]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kdbuku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
