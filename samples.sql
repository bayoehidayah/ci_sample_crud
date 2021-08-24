-- phpMyAdmin SQL Dump
-- version 5.1.0-rc2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Agu 2021 pada 17.04
-- Versi server: 5.7.24
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samples`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `last_stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `harga`, `last_stok`, `created_at`, `updated_at`) VALUES
('01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 132123, 232123, '2021-08-23 17:21:07', '2021-08-23 17:23:11');

--
-- Trigger `barang`
--
DELIMITER $$
CREATE TRIGGER `when_barang_delete` BEFORE DELETE ON `barang` FOR EACH ROW UPDATE faktur_items
SET
nama_barang=old.nama
WHERE id_barang=old.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `when_nama_barang_change` AFTER UPDATE ON `barang` FOR EACH ROW UPDATE faktur_items 
SET 
nama_barang=new.nama
WHERE id_barang=old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktur`
--

CREATE TABLE `faktur` (
  `id` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `total_items` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktur_items`
--

CREATE TABLE `faktur_items` (
  `id` int(11) NOT NULL,
  `id_faktur` varchar(50) NOT NULL,
  `id_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `total_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indeks untuk tabel `faktur_items`
--
ALTER TABLE `faktur_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faktur` (`id_faktur`),
  ADD KEY `id_barang` (`id_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `faktur_items`
--
ALTER TABLE `faktur_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `faktur_items`
--
ALTER TABLE `faktur_items`
  ADD CONSTRAINT `faktur_items_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `faktur_items_id_faktur_foreign` FOREIGN KEY (`id_faktur`) REFERENCES `faktur` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
