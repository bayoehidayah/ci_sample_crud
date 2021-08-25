-- phpMyAdmin SQL Dump
-- version 5.1.0-rc2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Agu 2021 pada 12.56
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `harga`, `created_at`, `updated_at`) VALUES
('01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 132123, '2021-08-23 17:21:07', '2021-08-23 17:23:11'),
('07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 65575, '2021-08-25 10:24:32', NULL),
('ace95a1ac55043beabd9ca42114b0e1f', 'GULA ROSE BRAND', 543, '2021-08-25 10:24:22', NULL);

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
CREATE TRIGGER `when_nama_barang_change` BEFORE UPDATE ON `barang` FOR EACH ROW IF(old.nama <> new.nama) THEN
	UPDATE faktur_items 
    SET nama_barang=new.nama 
    WHERE id_barang=old.id;
END IF
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

--
-- Dumping data untuk tabel `faktur`
--

INSERT INTO `faktur` (`id`, `nama_pelanggan`, `total_items`, `total_harga`, `created_at`, `updated_at`) VALUES
('1df3033f2cb64f85a6d6e87257f5a5e6', 'ASdsagfdss asdsa', 330, 21639750, '2021-08-25 11:27:55', NULL),
('5c026410ef4349c6987dcd9de2f9a939', 'Tes update', 66, 4327950, '2021-08-25 11:30:55', NULL),
('65a47282bdbf44809ddcaba489e1291c', 'ASdsa', 198, 12983850, '2021-08-25 11:26:31', NULL),
('68f1bc698c8745c09d24554169663b36', 'ASdsagfdss asdsa', 264, 17311800, '2021-08-25 11:29:47', NULL),
('6a1f6b6a049c40e7b383e0e2876c0fbe', 'ASdsagfdss', 330, 21639750, '2021-08-25 10:39:38', NULL),
('73b1ab8d5c7c49d0aa7d5b36ce1e3093', 'Tes update', 143, 4434793, '2021-08-25 11:28:39', '2021-08-25 11:43:45'),
('88042a688d9a4e578e3852b9f6b7dc34', 'ASdsagfdss', 330, 21639750, '2021-08-25 10:39:17', NULL),
('8b5d68fc102d416c81b69f7eb62c38b6', '', 330, 21639750, '2021-08-25 10:38:59', NULL),
('94734edd55c941df8eba068e4e9bcf87', 'ASdsa', 0, 0, '2021-08-25 10:35:37', NULL),
('e69c51d82cd84889ba1467a905c97194', 'Jasdas', 330, 21639750, '2021-08-25 10:40:13', NULL);

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
-- Dumping data untuk tabel `faktur_items`
--

INSERT INTO `faktur_items` (`id`, `id_faktur`, `id_barang`, `nama_barang`, `total_barang`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, '8b5d68fc102d416c81b69f7eb62c38b6', '07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 132, 8655900, '2021-08-25 10:38:59', NULL),
(2, '8b5d68fc102d416c81b69f7eb62c38b6', '01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 66, 4327950, '2021-08-25 10:38:59', NULL),
(3, '8b5d68fc102d416c81b69f7eb62c38b6', 'ace95a1ac55043beabd9ca42114b0e1f', 'GULA ROSE BRAND', 132, 8655900, '2021-08-25 10:38:59', NULL),
(4, '88042a688d9a4e578e3852b9f6b7dc34', '07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 132, 8655900, '2021-08-25 10:39:17', NULL),
(5, '88042a688d9a4e578e3852b9f6b7dc34', '01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 66, 4327950, '2021-08-25 10:39:17', NULL),
(6, '88042a688d9a4e578e3852b9f6b7dc34', 'ace95a1ac55043beabd9ca42114b0e1f', 'GULA ROSE BRAND', 132, 8655900, '2021-08-25 10:39:17', NULL),
(7, '6a1f6b6a049c40e7b383e0e2876c0fbe', '07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 132, 8655900, '2021-08-25 10:39:38', NULL),
(8, '6a1f6b6a049c40e7b383e0e2876c0fbe', '01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 66, 4327950, '2021-08-25 10:39:38', NULL),
(9, '6a1f6b6a049c40e7b383e0e2876c0fbe', 'ace95a1ac55043beabd9ca42114b0e1f', 'GULA ROSE BRAND', 132, 8655900, '2021-08-25 10:39:38', NULL),
(10, 'e69c51d82cd84889ba1467a905c97194', '07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 132, 8655900, '2021-08-25 10:40:13', NULL),
(11, 'e69c51d82cd84889ba1467a905c97194', '01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 66, 4327950, '2021-08-25 10:40:13', NULL),
(12, 'e69c51d82cd84889ba1467a905c97194', 'ace95a1ac55043beabd9ca42114b0e1f', 'GULA ROSE BRAND', 132, 8655900, '2021-08-25 10:40:13', NULL),
(13, '65a47282bdbf44809ddcaba489e1291c', '07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 132, 8655900, '2021-08-25 11:26:31', NULL),
(14, '65a47282bdbf44809ddcaba489e1291c', '01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 66, 4327950, '2021-08-25 11:26:31', NULL),
(15, '1df3033f2cb64f85a6d6e87257f5a5e6', '07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 132, 8655900, '2021-08-25 11:27:55', NULL),
(16, '1df3033f2cb64f85a6d6e87257f5a5e6', '01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 66, 4327950, '2021-08-25 11:27:55', NULL),
(17, '1df3033f2cb64f85a6d6e87257f5a5e6', 'ace95a1ac55043beabd9ca42114b0e1f', 'GULA ROSE BRAND', 132, 8655900, '2021-08-25 11:27:55', NULL),
(20, '68f1bc698c8745c09d24554169663b36', '07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 132, 8655900, '2021-08-25 11:29:47', NULL),
(21, '68f1bc698c8745c09d24554169663b36', 'ace95a1ac55043beabd9ca42114b0e1f', 'GULA ROSE BRAND', 132, 8655900, '2021-08-25 11:29:47', NULL),
(22, '5c026410ef4349c6987dcd9de2f9a939', '01b353e2ccda459cac137812096ced10', 'Bayu Hidayah Melasadsa', 66, 4327950, '2021-08-25 11:30:55', NULL),
(23, '73b1ab8d5c7c49d0aa7d5b36ce1e3093', '07870c6a526d41e2bdf638bc617c0e9c', 'Default Sekolah', 67, 4393525, '2021-08-25 11:43:22', '2021-08-25 11:43:45'),
(24, '73b1ab8d5c7c49d0aa7d5b36ce1e3093', 'ace95a1ac55043beabd9ca42114b0e1f', 'GULA ROSE BRAND', 76, 41268, '2021-08-25 11:43:45', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
