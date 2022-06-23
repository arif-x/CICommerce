-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2022 at 01:10 PM
-- Server version: 10.3.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruan_ecommer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`) VALUES
(1, 'admin@admin.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_alamat`
--

CREATE TABLE `daftar_alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_alamat`
--

INSERT INTO `daftar_alamat` (`id_alamat`, `id_user`, `alamat`) VALUES
(1, 2, 'rumah'),
(2, 3, 'Jalan'),
(3, 5, 'jl. joyo suko'),
(4, 1, 'Alamat'),
(5, 10, 'jln. 01');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `slug`) VALUES
(1, 'Kategori 1', 'kategori-1'),
(3, 'kat hhaha', 'kat-hhaha');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `jumlah`, `id_produk`) VALUES
(2, 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `rating` int(11) NOT NULL,
  `diskon` double NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `stok` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_toko`, `nama_produk`, `deskripsi`, `rating`, `diskon`, `harga`, `kategori`, `gambar`, `stok`, `slug`) VALUES
(1, 1, 'Produk', 'Deskripsi', 0, 0, 0, 1, 'https://ecommerce.ruangbit.my.id/upload/toko/produk/2022-05-17-10-12-44.jpg', 5, 'Produk'),
(2, 3, 'Pensil', 'Pensil 2B', 0, 0, 1000, 1, 'https://ecommerce.ruangbit.my.id/upload/toko/produk/2022-05-18-16-57-15.jpg', 1000, 'Pensil'),
(3, 4, 'Pensil', 'Pensil 2B', 0, 0, 1100, 1, 'https://ecommerce.ruangbit.my.id/upload/toko/produk/2022-05-18-17-00-16.jpg', 976, 'Pensil-1'),
(4, 5, 'profuk1', 'ini deskripsi', 0, 0, 12000, 2, 'https://ecommerce.ruangbit.my.id/upload/toko/produk/no-image.jpg', 10, 'profuk1'),
(5, 10, 'Product01', 'deskription produk01', 0, 0, 1000, 2, 'https://ecommerce.ruangbit.my.id/upload/toko/produk/no-image.jpg', 100, 'Product01'),
(6, 10, 'Product01 HAHAHA', 'Deskription', 0, 0, 12, 1, 'https://ecommerce.ruangbit.my.id/upload/toko/produk/2022-05-20-12-45-58.jpg', 1222, 'Product01-HAHAHA'),
(7, 1, 'Hola', 'Desc', 0, 0, 500, 1, 'https://ecommerce.ruangbit.my.id/upload/toko/produk/2022-05-20-12-28-22.png', 5, 'Hola'),
(8, 10, 'klm', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa', 0, 0, 111, 1, 'https://ecommerce.ruangbit.my.id/upload/toko/produk/no-image.jpg', 100, 'klm');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `tanggal_lahir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `id_user`, `nama_lengkap`, `no_telp`, `alamat_lengkap`, `tanggal_lahir`) VALUES
(1, 1, 'Mbuh', '822222222', 'alamat', '2022-01-01'),
(2, 2, 'Cul', '2147483647', 'Alamat', '2022-01-01'),
(3, 3, 'Rural Badun', '0', 'Jalan', ''),
(4, 4, 'Rural Badun 2', '0', 'J', ''),
(5, 5, 'kerjamalam', '2147483647', 'jl. data', '1996-07-09'),
(6, 6, 'Aku', '8212222', 'Jl.Aku', '1996-07-09'),
(7, 7, NULL, NULL, NULL, NULL),
(8, 8, NULL, NULL, NULL, NULL),
(9, 9, NULL, NULL, NULL, NULL),
(10, 10, 'kerja', '082137241320', 'Jl. OKE', '1996-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `slider` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `slider`) VALUES
(1, 'https://ecommerce.ruangbit.my.id/upload/slider/2022-05-17-10-06-43.png'),
(2, 'https://ecommerce.ruangbit.my.id/upload/slider/2022-05-20-12-21-57.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL,
  `foto` text DEFAULT NULL,
  `banner` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `id_user`, `nama_toko`, `alamat`, `deskripsi`, `no_hp`, `foto`, `banner`, `slug`, `status`) VALUES
(1, 1, 'Campus', 'Alamat Lengkap', 'Deskripsi', '88888', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/no-image.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/no-image.png', 'Campus', '1'),
(2, 2, NULL, NULL, NULL, '', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/no-image.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/no-image.png', NULL, ''),
(3, 3, 'Kampus', 'Jalan', 'Toko', '', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/2022-05-18-16-55-06.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/2022-05-18-16-55-06.jpg', 'Kampus', '0'),
(4, 4, 'KampusX', 'J', 'Toko', '', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/2022-05-18-16-59-28.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/2022-05-18-16-59-28.jpg', 'KampusX', '1'),
(5, 5, 'TOKO5', 'jl. 5', 'ini toko 5', '', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/no-image.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/no-image.png', 'TOKO5', '0'),
(6, 6, NULL, NULL, NULL, '', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/no-image.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/no-image.png', NULL, ''),
(7, 7, NULL, NULL, NULL, '', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/no-image.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/no-image.png', NULL, ''),
(8, 8, NULL, NULL, NULL, '', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/no-image.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/no-image.png', NULL, ''),
(9, 9, NULL, NULL, NULL, '', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/no-image.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/no-image.png', NULL, ''),
(10, 10, 'Toko05', 'Alamat', 'Deskription', '082137241251', 'https://ecommerce.ruangbit.my.id/upload/toko/foto/no-image.jpg', 'https://ecommerce.ruangbit.my.id/upload/toko/banner/no-image.png', 'Toko05', '1');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_dibayar` int(11) NOT NULL,
  `dipesan_pada` varchar(255) NOT NULL,
  `dibayar_pada` varchar(255) DEFAULT NULL,
  `dikirim_pada` varchar(255) DEFAULT NULL,
  `diterima_pada` varchar(255) DEFAULT NULL,
  `bukti_bayar` text DEFAULT NULL,
  `resi` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_produk`, `alamat`, `jumlah`, `jumlah_dibayar`, `dipesan_pada`, `dibayar_pada`, `dikirim_pada`, `diterima_pada`, `bukti_bayar`, `resi`, `status`) VALUES
(1, 1, 3, 'Alamat', 10, 11000, '20-05-2022 18:00:57', '20-05-2022 18:03:49', NULL, NULL, 'https://ecommerce.ruangbit.my.id/upload/bukti-bayar/2022-05-20-18-03-49.png', NULL, 3),
(2, 10, 3, 'jln. 01', 1, 1100, '20-05-2022 19:18:27', NULL, NULL, NULL, NULL, NULL, 0),
(3, 10, 3, 'jln. 01', 2, 2200, '20-05-2022 19:18:53', '20-05-2022 19:19:05', NULL, NULL, 'https://ecommerce.ruangbit.my.id/upload/bukti-bayar/2022-05-20-19-19-05.png', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_key` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `email_key` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `password_key`, `active`, `email_key`) VALUES
(1, 'mbohweskono@gmail.com', '12345678', '', 1, 'awVRU6QOXLWz2hnS1ZIEbjBg9dx0HvCqfKDoMPmlc7Nr5FApti'),
(2, 'cul@gmail.com', '12345678', '', 0, NULL),
(3, 'ruralbadun@gmail.com', 'cobacoba', '', 0, NULL),
(4, 'ruralbadun2@gmail.com', 'cobacoba', '', 0, NULL),
(6, 'aku@gmail.com', '12345678', 'oAareEB8kYHjIuNCPwfD9y1M5tsQi2G4xRFcSdLgJhKTqvUZnW', 0, NULL),
(7, 'hua@gmail.com', '12345678', NULL, 0, '2K73Aa4nVE91mGW6te80sqCyN5zgcbxOMpJwTIRFHfuYPZjDUX'),
(10, 'kerjamalam5@gmail.com', '12345678', NULL, 1, 'SErph2vK07FT5Q8URVmJBH3DzyGdkCq9XnNjIYlWAPtOcuwoZa');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id_wishlist`, `id_user`, `id_produk`) VALUES
(2, 1, 1),
(14, 5, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `daftar_alamat`
--
ALTER TABLE `daftar_alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daftar_alamat`
--
ALTER TABLE `daftar_alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
