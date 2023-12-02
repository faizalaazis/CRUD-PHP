-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2021 pada 13.23
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uasku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('adminganteng', 'lenteramerah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master`
--

CREATE TABLE `master` (
  `ID` int(11) NOT NULL,
  `Nama_Lengkap` varchar(100) DEFAULT NULL,
  `Jenis_Kelamin` varchar(30) DEFAULT NULL,
  `Tempat_Lahir` varchar(50) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Alamat` varchar(100) DEFAULT NULL,
  `Provinsi` varchar(100) DEFAULT NULL,
  `Kabupaten` varchar(100) DEFAULT NULL,
  `Kecamatan` varchar(100) DEFAULT NULL,
  `Kode_Pos` int(10) DEFAULT NULL,
  `No_HP` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master`
--

INSERT INTO `master` (`ID`, `Nama_Lengkap`, `Jenis_Kelamin`, `Tempat_Lahir`, `Tanggal_Lahir`, `Alamat`, `Provinsi`, `Kabupaten`, `Kecamatan`, `Kode_Pos`, `No_HP`, `Email`) VALUES
(1001, 'Putri Anna', 'Perempuan', 'Sragen', '1999-11-08', 'kampung baru', 'Jawa Tengah', 'Sragen', 'Kedawung', 57292, '0895800258', 'Riana01@gmail.com'),
(1002, 'Bagus Pambudi', 'Laki-laki', 'Karanganyar', '2000-08-10', 'Dagen', 'Jawa Tengah', 'Karanganyar', 'Jaten', 57771, '0895829159', 'Bagus88@gmail.com'),
(1003, 'Dandi Pranowo', 'Laki-laki', 'Surakarta', '2001-01-27', 'kauman', 'Jawa Tengah', 'Surakarta', 'Pasar Kliwon', 57110, '0817776120', 'Dragdi@gmail.com'),
(1004, 'Ayu Ningrum', 'Perempuan', 'Karanganyar', '2001-09-12', 'Bulu', 'Jawa Tengah', 'Karanganyar', 'Jaten', 57771, '0890077112', 'Arwndt@gmail.com'),
(1005, 'Banafsa Zumna', 'Perempuan', 'Surakarta', '2002-05-10', 'Joyotakan', 'Jawa Tengah', 'Surakarta', 'Serengan', 57150, '0890012030', 'Banafsa09@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
