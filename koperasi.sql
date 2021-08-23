-- phpMyAdmin SQL Dump
-- version 5.1.0-rc2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Jul 2021 pada 14.47
-- Versi server: 5.7.24
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga_modal` int(30) NOT NULL DEFAULT '0',
  `harga_jual` int(30) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `harga_modal`, `harga_jual`, `created_at`, `updated_at`) VALUES
('GP-0001', 'GULA PUTIH', 546871, 354687, '2021-04-12 04:05:58', NULL),
('GR-0001', 'GULA ROSE BRAND', 1235123, 1235123, '2021-04-11 15:13:09', '2021-04-11 15:17:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_stok`
--

CREATE TABLE `barang_stok` (
  `id` int(30) NOT NULL,
  `id_barang` varchar(15) NOT NULL,
  `id_tgl` varchar(15) NOT NULL,
  `stok_awal` int(30) NOT NULL DEFAULT '0',
  `pembelian` int(30) NOT NULL DEFAULT '0',
  `penjualan` int(30) NOT NULL DEFAULT '0',
  `sisa_stok` int(30) NOT NULL DEFAULT '0',
  `created_by` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_stok`
--

INSERT INTO `barang_stok` (`id`, `id_barang`, `id_tgl`, `stok_awal`, `pembelian`, `penjualan`, `sisa_stok`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'GP-0001', '46b6611b0ab04f6', 5, 5, 6, 6, 'AD-0001', '2021-04-19 15:16:47', NULL),
(2, 'GP-0001', '5eb0c45a8153419', 6, 7, 6, 7, 'AD-0001', '2021-04-21 14:30:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_stok_tgl`
--

CREATE TABLE `barang_stok_tgl` (
  `id` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_stok_tgl`
--

INSERT INTO `barang_stok_tgl` (`id`, `tanggal`, `created_by`, `created_at`, `updated_at`) VALUES
('46b6611b0ab04f6', '2021-04-19', 'AD-0001', '2021-04-19 14:33:55', NULL),
('5270a6663dc44f9', '2021-05-19', 'AD-0001', '2021-05-20 13:13:26', NULL),
('5eb0c45a8153419', '2021-04-20', 'AD-0001', '2021-04-21 14:29:03', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas`
--

CREATE TABLE `kas` (
  `id` int(30) NOT NULL,
  `keterangan` text NOT NULL,
  `uang_masuk` int(30) NOT NULL DEFAULT '0',
  `uang_keluar` int(30) NOT NULL DEFAULT '0',
  `penjualan` int(30) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` varchar(15) NOT NULL,
  `id_barang` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(30) NOT NULL DEFAULT '0',
  `harga_jual` int(30) NOT NULL DEFAULT '0',
  `total_jual` int(30) NOT NULL DEFAULT '0',
  `id_user` varchar(15) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_barang`, `tanggal`, `jumlah`, `harga_jual`, `total_jual`, `id_user`, `nama_user`, `created_at`, `updated_at`) VALUES
('PJ-00000001', 'GP-0001', '2021-07-09', 6, 354687, 2128122, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama_anak` varchar(100) DEFAULT NULL,
  `alamat` text,
  `nik` int(20) DEFAULT NULL,
  `pekerjaan` varchar(30) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `no_rek` varchar(30) DEFAULT NULL,
  `bank` varchar(30) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `no_ktp` int(20) DEFAULT NULL,
  `have_ktp` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `tipe`, `email`, `password`, `nama_anak`, `alamat`, `nik`, `pekerjaan`, `no_hp`, `no_rek`, `bank`, `photo`, `no_ktp`, `have_ktp`, `is_active`, `created_at`, `updated_at`) VALUES
('AD-0001', 'Bayu Hidayah', 'admin', 'bayhidmelandisaja@gmail.com', '$2y$10$RUCXN3y9VsUPIRpKFWWES.kUxs3WofhXi2aQWypO6kAiAKKGqx.we', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-04-07 14:35:29', NULL),
('AK-0001', 'Bayu Hidayah', 'anggota', 'bayoe@gmail.com', '$2y$10$/Xz08fwLOA7wmTzZjDeVjOMq1HXFPVh9qlEpBcshP81YSknfKIrc6', 'Anaka Bayu', 'sgsgdffd', 2147483647, 'asfassaffsa', '1241312234', '352523423', 'SDgreerferg', 'AK-0001_5fe38c8721bc42b397f1b9cd158951ce.png', 235234234, 1, 1, '2021-04-11 13:20:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_stok`
--
ALTER TABLE `barang_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `id_tgl` (`id_tgl`);

--
-- Indeks untuk tabel `barang_stok_tgl`
--
ALTER TABLE `barang_stok_tgl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_stok`
--
ALTER TABLE `barang_stok`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_stok`
--
ALTER TABLE `barang_stok`
  ADD CONSTRAINT `barang_created_by_foreign_key` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `barang_stok_id_barang_foreign_key` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_stok_id_tgl_foreign_key` FOREIGN KEY (`id_tgl`) REFERENCES `barang_stok_tgl` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_stok_tgl`
--
ALTER TABLE `barang_stok_tgl`
  ADD CONSTRAINT `barang_stok_tgl_created_by_foreign_key` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_barang_foreign_key` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_id_user_foreign_key` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
