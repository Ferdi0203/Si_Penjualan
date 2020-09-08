-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Sep 2020 pada 10.42
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `keterangan` text NOT NULL,
  `satuan_id` int(1) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `kode_barang`, `nama_barang`, `keterangan`, `satuan_id`, `stock`, `harga`, `harga_jual`, `date_created`) VALUES
(1, 'B-P-0001', 'Marlboro', 'Rokok', 4, 60, 150000, 170000, 1599461971),
(3, 'B-P-0003', 'Dunhill Hitam', 'Rokok', 4, 40, 110000, 140000, 1599463350),
(4, 'B-P-0004', 'Hp', 'Barang Elektronik', 3, 23, 100000, 900000, 1599472169),
(5, 'B-P-0005', 'Gudang Garam', 'Rokok', 4, 23, 120000, 300000, 1599472257),
(6, 'B-P-0006', 'Umild', 'Rokok', 4, 32, 100000, 200000, 1599472749),
(7, 'B-P-0007', 'Laptop', 'Elektronik', 6, 30, 3000000, 4000000, 1599539566);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`satuan_id`, `satuan`) VALUES
(1, 'Lusin'),
(2, 'Bungkus'),
(3, 'Pak'),
(4, 'Slop'),
(5, 'Dus'),
(6, 'Unit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sub_transaksi`
--

CREATE TABLE `tb_sub_transaksi` (
  `id` int(11) NOT NULL,
  `no_resi` varchar(100) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sub_transaksi`
--

INSERT INTO `tb_sub_transaksi` (`id`, `no_resi`, `barang_id`, `qty`) VALUES
(1, 'BRX-0001', 1, 20),
(2, 'BRX-0002', 3, 20),
(3, 'BRX-0003', 2, 10),
(4, 'BRX-0004', 5, 2),
(5, 'BRX-0005', 1, 20),
(6, 'BRX-0006', 3, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_resi` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_resi`, `total`, `date_created`) VALUES
('BRX-0001', 3000000, '2020-09-07'),
('BRX-0002', 2200000, '2020-09-07'),
('BRX-0003', 1000000, '2020-09-07'),
('BRX-0004', 240000, '2020-09-07'),
('BRX-0005', 3000000, '2020-09-07'),
('BRX-0006', 1100000, '2020-09-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(248) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Ferdi', 'ferdi@gmail.com', 'default.png', '$2y$10$SzbKNK2dDTZ8jzV9QLwHy.XxL6V/zS2R89r8b5hwD7v01UXwr5txC', 1, 1, 1599462625),
(2, 'Mr. Ardian', 'ardian@gmail.com', 'default.png', '$2y$10$EJUMlOijwhSvwEPbsGZtKem4kN3fp.xYmiEP1YZSS5XcYYY76Hby2', 2, 1, 1599462625),
(3, 'Abdul', 'kasir@gmail.com', 'default.png', '$2y$10$r.FTSfqKaGAsKy4J4cGf0.4ila8g9u04G8beOwkMsZp6PFu9xTR7u', 3, 1, 1599462655);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user_role`
--

INSERT INTO `tb_user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Pimpinan'),
(3, 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indeks untuk tabel `tb_sub_transaksi`
--
ALTER TABLE `tb_sub_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_resi` (`no_resi`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_resi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_sub_transaksi`
--
ALTER TABLE `tb_sub_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user_role`
--
ALTER TABLE `tb_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_sub_transaksi`
--
ALTER TABLE `tb_sub_transaksi`
  ADD CONSTRAINT `no_resi` FOREIGN KEY (`no_resi`) REFERENCES `tb_transaksi` (`no_resi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
