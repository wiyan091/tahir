-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Agu 2023 pada 04.14
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_atk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `atk`
--

CREATE TABLE `atk` (
  `id` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `atk`
--

INSERT INTO `atk` (`id`, `nama`, `jumlah`, `keterangan`, `tanggal`, `status`, `username`) VALUES
(43, 'Pensi', 12, 'Pack', '2023-08-20', 1, 'tahir'),
(50, 'Penggaris', 12, 'buah', '2023-08-25', 0, 'tahir'),
(51, 'Kertas A4', 3, 'dus', '2023-08-26', 0, 'dina'),
(52, 'Gunting', 3, 'Buha', '2023-08-26', 0, 'tahirku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `role`, `password`, `is_aktif`) VALUES
(4, 'tahir', 'bf2ead489ab1726ae9827454292bf987', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1),
(10, 'dina', '89a079908012ad60996b771d09e0fc0a', 'user', 'e10adc3949ba59abbe56e057f20f883e', 1),
(11, 'tahirku', 'd49a54b078af32b10c5380f7108a7eb8', 'admin', 'e4b4a652db300f8b24138068cdbf2ab9', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `atk`
--
ALTER TABLE `atk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `atk`
--
ALTER TABLE `atk`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
