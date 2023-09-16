-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Sep 2023 pada 19.38
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
  `username` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `atk`
--

INSERT INTO `atk` (`id`, `nama`, `jumlah`, `keterangan`, `tanggal`, `status`, `username`, `id_user`) VALUES
(44, 'Spidol', 1, 'Pack', '2023-09-17', 0, 'umum1', 6),
(45, 'Stopmap', 3, 'Buah', '2023-09-17', 0, 'dina', 4),
(46, 'Bulpoin', 1, 'Pack', '2023-09-17', 0, 'keuangan1', 8),
(47, 'Kertas A4', 3, 'Dus', '2023-09-17', 0, 'humas1', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE `detail` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_atk` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail`
--

INSERT INTO `detail` (`id`, `id_user`, `id_atk`, `tanggal`) VALUES
(14, 6, 44, '2023-09-17'),
(15, 4, 45, '2023-09-17'),
(16, 8, 46, '2023-09-17'),
(17, 5, 47, '2023-09-17');

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
(3, 'tahir', 'bf2ead489ab1726ae9827454292bf987', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1),
(4, 'dina', '89a079908012ad60996b771d09e0fc0a', 'user', 'e10adc3949ba59abbe56e057f20f883e', 1),
(5, 'humas1', '2e5c32bead9e4331256f6e708a893640', 'user', '466d5509d2c838e8134d5a8fc76e2012', 1),
(6, 'umum1', '53ee90d825a811d9c22073052f063624', 'user', 'e10adc3949ba59abbe56e057f20f883e', 1),
(8, 'keuangan1', '5935ef559c8f1b4f8563ffaecc17c882', 'user', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `atk`
--
ALTER TABLE `atk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_atk`),
  ADD KEY `id_atk` (`id_atk`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `atk`
--
ALTER TABLE `atk`
  ADD CONSTRAINT `atk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`id_atk`) REFERENCES `atk` (`id`),
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
