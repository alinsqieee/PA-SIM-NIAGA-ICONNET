-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2025 pada 08.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim-niaga-iconnet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tadmin`
--

CREATE TABLE `tadmin` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `hp_admin` varchar(100) NOT NULL,
  `pass_admin` varchar(100) NOT NULL,
  `foto_admin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tadmin`
--

INSERT INTO `tadmin` (`id_admin`, `nama_admin`, `email_admin`, `hp_admin`, `pass_admin`, `foto_admin`) VALUES
(1, 'ICONNET', 'admin@admin.com', '082178024794', '21232f297a57a5a743894a0e4a801fc3', 'wajah1.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbank`
--

CREATE TABLE `tbank` (
  `id_bank` int(10) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `norek_bank` varchar(100) NOT NULL,
  `bank_bank` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbank`
--

INSERT INTO `tbank` (`id_bank`, `nama_bank`, `norek_bank`, `bank_bank`) VALUES
(1, 'Hasan', '123456789', 'BCA'),
(2, 'Hasan', '123456789', 'BCA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbantuan`
--

CREATE TABLE `tbantuan` (
  `id_bantuan` int(10) NOT NULL,
  `kode_bantuan` varchar(100) NOT NULL,
  `jenis_layanan` varchar(100) NOT NULL,
  `id_user` int(10) NOT NULL,
  `tanggal_bantuan` varchar(100) NOT NULL,
  `jam_bantuan` varchar(100) NOT NULL,
  `keterangan_bantuan` text NOT NULL,
  `prioritas_bantuan` varchar(100) NOT NULL,
  `status_bantuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tchat`
--

CREATE TABLE `tchat` (
  `id_chat` int(10) NOT NULL,
  `id_bantuan` varchar(100) NOT NULL,
  `jenis_chat` varchar(100) NOT NULL,
  `tanggal_chat` varchar(200) NOT NULL,
  `isi_chat` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `id_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tchat`
--

INSERT INTO `tchat` (`id_chat`, `id_bantuan`, `jenis_chat`, `tanggal_chat`, `isi_chat`, `status`, `id_user`) VALUES
(2, '5', 'User', '22/07/2025 - 21:51:39', 'sssas', 'read', '1'),
(3, '5', 'Admin', '22/07/2025 - 21:52:29', 'ffggfg', 'unread', '1'),
(4, '5', 'User', '22/07/2025 - 21:56:49', 'f', 'read', '1'),
(5, '5', 'User', '22/07/2025 - 21:56:58', 'll', 'read', '1'),
(6, '5', 'User', '22/07/2025 - 21:57:50', 'halo', 'read', '1'),
(7, '4', 'User', '22/07/2025 - 21:58:35', 'KAu', 'read', '1'),
(8, '5', 'Admin', '22/07/2025 - 22:17:20', 'aku aadmin', 'unread', '1'),
(9, '6', 'Admin', '23/07/2025 - 19:03:54', 'baik proses maintenance segera dilakukan', 'unread', '4'),
(10, '6', 'User', '23/07/2025 - 19:04:10', 'terimakasih', 'read', '4'),
(11, '7', 'Admin', '31/08/2025 - 23:23:49', 'hello pantek', 'read', '5'),
(12, '7', 'Admin', '31/08/2025 - 23:29:00', 'woe', 'read', '5'),
(13, '7', 'Admin', '31/08/2025 - 23:33:58', 'lancang', 'read', '5'),
(14, '7', 'Admin', '31/08/2025 - 23:46:55', 'hai', 'read', '5'),
(15, '7', 'User', '31/08/2025 - 23:56:23', 'apa se', 'read', '5'),
(16, '7', 'Admin', '01/09/2025 - 12:13:12', 'hai', 'read', '5'),
(17, '7', 'User', '03/09/2025 - 12:43:23', 'fakyu', 'read', '5'),
(18, '7', 'User', '03/09/2025 - 12:58:03', 'helo', 'read', '5'),
(19, '7', 'User', '03/09/2025 - 13:02:41', 'halllojirjgkjgk', 'read', '5'),
(20, '7', 'User', '03/09/2025 - 13:06:48', 'wee bodo ee', 'read', '5'),
(21, '7', 'Admin', '03/09/2025 - 13:11:49', 'weee', 'read', '5'),
(22, '7', 'Admin', '03/09/2025 - 13:12:39', 'wee adam kontol', 'read', '5'),
(23, '8', 'User', '15/09/2025 - 10:44:46', 'halo admin', 'read', '9'),
(24, '8', 'Admin', '15/09/2025 - 10:46:46', 'iya hallo', 'unread', '9'),
(25, '11', 'Admin', '17/09/2025 - 11:38:33', 'oke kami segera mengirim teknisi', 'read', '26'),
(26, '11', 'User', '17/09/2025 - 11:38:45', 'oke', 'read', '26'),
(27, '15', 'User', '21/09/2025 - 14:09:26', 'woi pantek', 'read', '26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tlayanan`
--

CREATE TABLE `tlayanan` (
  `id_layanan` int(10) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `keterangan_layanan` text NOT NULL,
  `harga_layanan` varchar(100) NOT NULL,
  `gambar_layanan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tlayanan`
--

INSERT INTO `tlayanan` (`id_layanan`, `nama_layanan`, `keterangan_layanan`, `harga_layanan`, `gambar_layanan`) VALUES
(9, 'PLTS ATAP', 'fakkkk', '200000', 'PLTS ATAP.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpemesanan`
--

CREATE TABLE `tpemesanan` (
  `id_pemesanan` int(10) NOT NULL,
  `kode_pemesanan` varchar(100) NOT NULL,
  `id_user` int(10) NOT NULL,
  `harga_pemesanan` varchar(100) NOT NULL,
  `unik_pemesanan` varchar(100) NOT NULL,
  `total_pemesanan` varchar(100) NOT NULL,
  `status_pemesanan` varchar(100) NOT NULL,
  `jam_pemesanan` varchar(100) NOT NULL,
  `tanggal_pemesanan` varchar(100) NOT NULL,
  `bayar_pemesanan` varchar(100) NOT NULL,
  `keterangan_pemesanan` text NOT NULL,
  `id_layanan` varchar(100) NOT NULL,
  `notif_pemesanan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tpemesanan`
--

INSERT INTO `tpemesanan` (`id_pemesanan`, `kode_pemesanan`, `id_user`, `harga_pemesanan`, `unik_pemesanan`, `total_pemesanan`, `status_pemesanan`, `jam_pemesanan`, `tanggal_pemesanan`, `bayar_pemesanan`, `keterangan_pemesanan`, `id_layanan`, `notif_pemesanan`) VALUES
(32, 'MCN3297WGA', 33, '200000', '245', '200245', 'Menunggu Pembayaran', '13:08:23', '2025-09-23', 'Menunggu Pembayaran', '', '9', 'Dibaca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tuser`
--

CREATE TABLE `tuser` (
  `id_user` int(10) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `hp_user` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `alamat_user` varchar(100) NOT NULL,
  `pass_user` varchar(100) NOT NULL,
  `foto_user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tuser`
--

INSERT INTO `tuser` (`id_user`, `nama_user`, `hp_user`, `email_user`, `alamat_user`, `pass_user`, `foto_user`) VALUES
(33, 'ALI RINALDY', '082198344074', 'alirinaldy0@gmail.com', 'Ambon', 'aldy123', 'foto.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tadmin`
--
ALTER TABLE `tadmin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbank`
--
ALTER TABLE `tbank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `tbantuan`
--
ALTER TABLE `tbantuan`
  ADD PRIMARY KEY (`id_bantuan`),
  ADD KEY `fk_bantuan_user` (`id_user`);

--
-- Indeks untuk tabel `tchat`
--
ALTER TABLE `tchat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indeks untuk tabel `tlayanan`
--
ALTER TABLE `tlayanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `tpemesanan`
--
ALTER TABLE `tpemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `fk_pemesanan_user` (`id_user`);

--
-- Indeks untuk tabel `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tadmin`
--
ALTER TABLE `tadmin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbank`
--
ALTER TABLE `tbank`
  MODIFY `id_bank` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbantuan`
--
ALTER TABLE `tbantuan`
  MODIFY `id_bantuan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tchat`
--
ALTER TABLE `tchat`
  MODIFY `id_chat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tlayanan`
--
ALTER TABLE `tlayanan`
  MODIFY `id_layanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tpemesanan`
--
ALTER TABLE `tpemesanan`
  MODIFY `id_pemesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbantuan`
--
ALTER TABLE `tbantuan`
  ADD CONSTRAINT `fk_bantuan_user` FOREIGN KEY (`id_user`) REFERENCES `tuser` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tpemesanan`
--
ALTER TABLE `tpemesanan`
  ADD CONSTRAINT `fk_pemesanan_user` FOREIGN KEY (`id_user`) REFERENCES `tuser` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
