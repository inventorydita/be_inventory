-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 05:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail_pembelian` int(10) NOT NULL,
  `id_pembelian` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `harga_modal` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail_pembelian`, `id_pembelian`, `id_barang`, `harga_modal`, `harga_jual`, `quantity`) VALUES
(64, 1625926206, 16, 9000000, 10000000, 5),
(65, 1625926206, 17, 9000000, 10000000, 5),
(66, 1625926206, 16, 9000000, 10000000, 5),
(67, 1625926221, 16, 9000000, 10000000, 5),
(68, 1625926221, 17, 9000000, 10000000, 5),
(69, 1625926221, 16, 9000000, 10000000, 5),
(70, 1625926238, 16, 9000000, 10000000, 5),
(71, 1625926238, 17, 9000000, 10000000, 5),
(72, 1625926238, 16, 9000000, 10000000, 5),
(73, 1625928351, 16, 9000000, 10000000, 5),
(74, 1625928351, 17, 9000000, 10000000, 5),
(75, 1625928351, 16, 9000000, 10000000, 5),
(76, 1625928360, 16, 9000000, 10000000, 5),
(77, 1625928360, 17, 9000000, 10000000, 5),
(78, 1625928360, 16, 9000000, 10000000, 5),
(79, 1625928387, 16, 9000000, 10000000, 5),
(80, 1625928387, 17, 9000000, 10000000, 5),
(81, 1625928387, 16, 9000000, 10000000, 5),
(82, 1625928388, 16, 9000000, 10000000, 5),
(83, 1625928388, 17, 9000000, 10000000, 5),
(84, 1625928388, 16, 9000000, 10000000, 5),
(85, 1625928389, 16, 9000000, 10000000, 5),
(86, 1625928389, 17, 9000000, 10000000, 5),
(87, 1625928389, 16, 9000000, 10000000, 5),
(88, 1625928390, 16, 9000000, 10000000, 5),
(89, 1625928390, 17, 9000000, 10000000, 5),
(90, 1625928390, 16, 9000000, 10000000, 5),
(91, 1625928443, 16, 9000000, 10000000, 5),
(92, 1625928443, 17, 9000000, 10000000, 5),
(93, 1625928443, 16, 9000000, 10000000, 5),
(94, 1625928444, 16, 9000000, 10000000, 5),
(95, 1625928444, 17, 9000000, 10000000, 5),
(96, 1625928444, 16, 9000000, 10000000, 5),
(97, 1625928446, 16, 9000000, 10000000, 5),
(98, 1625928446, 17, 9000000, 10000000, 5),
(99, 1625928446, 16, 9000000, 10000000, 5),
(100, 1625928448, 16, 9000000, 10000000, 5),
(101, 1625928448, 17, 9000000, 10000000, 5),
(102, 1625928448, 16, 9000000, 10000000, 5),
(103, 1625928449, 16, 9000000, 10000000, 5),
(104, 1625928449, 17, 9000000, 10000000, 5),
(105, 1625928449, 16, 9000000, 10000000, 5),
(106, 1625928521, 16, 9000000, 10000000, 5),
(107, 1625928521, 17, 9000000, 10000000, 5),
(108, 1625928521, 16, 9000000, 10000000, 5),
(109, 1625928522, 16, 9000000, 10000000, 5),
(110, 1625928522, 17, 9000000, 10000000, 5),
(111, 1625928522, 16, 9000000, 10000000, 5),
(112, 1625928523, 16, 9000000, 10000000, 5),
(113, 1625928523, 17, 9000000, 10000000, 5),
(114, 1625928523, 16, 9000000, 10000000, 5),
(115, 1625928526, 16, 9000000, 10000000, 5),
(116, 1625928526, 17, 9000000, 10000000, 5),
(117, 1625928526, 16, 9000000, 10000000, 5),
(118, 1625928529, 16, 9000000, 10000000, 5),
(119, 1625928529, 17, 9000000, 10000000, 5),
(120, 1625928529, 16, 9000000, 10000000, 5),
(121, 1625928530, 16, 9000000, 10000000, 5),
(122, 1625928530, 17, 9000000, 10000000, 5),
(123, 1625928530, 16, 9000000, 10000000, 5);

--
-- Triggers `detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `update_stok_barang_dari_pembelian` AFTER INSERT ON `detail_pembelian` FOR EACH ROW BEGIN

       DECLARE ada integer;
       DECLARE id_stok integer;
       DECLARE quantity integer;

    
       		-- cek dan update stok ketika ada pembelian
       		SELECT COUNT(*),id_stok_barang,stok
       		INTO @ada,@id_stok,@quantity
       		FROM stok_barang
      		WHERE stok_barang.id_barang= NEW.id_barang;
       		IF @ada > 0
       			THEN
           		UPDATE stok_barang
           		SET stok = @quantity+NEW.quantity
           		WHERE id_stok_barang = @id_stok;
        	ELSE
        		INSERT INTO stok_barang(id_barang,harga_modal,harga_jual,stok) VALUES (NEW.id_barang,NEW.harga_modal,NEW.harga_jual,NEW.quantity);
       		END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` int(10) NOT NULL,
  `id_penjualan` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail_penjualan`, `id_penjualan`, `id_barang`, `harga_jual`, `quantity`) VALUES
(1, 1625927457, 16, 10000000, 5),
(2, 1625927457, 17, 10000000, 5),
(3, 1625927457, 16, 10000000, 5),
(4, 1625927476, 16, 10000000, 5),
(5, 1625927476, 17, 10000000, 5),
(6, 1625927476, 16, 10000000, 5),
(7, 1625927489, 16, 10000000, 5),
(8, 1625927489, 17, 10000000, 5),
(9, 1625927489, 16, 10000000, 5),
(10, 1625927503, 16, 10000000, 5),
(11, 1625927503, 17, 10000000, 5),
(12, 1625927503, 16, 10000000, 5),
(13, 1625928093, 16, 10000000, 5),
(14, 1625928093, 17, 10000000, 5),
(15, 1625928093, 16, 10000000, 5),
(16, 1625928114, 16, 10000000, 5),
(17, 1625928114, 17, 10000000, 5),
(18, 1625928114, 16, 10000000, 5),
(19, 1625928180, 16, 10000000, 5),
(20, 1625928180, 17, 10000000, 5),
(21, 1625928180, 16, 10000000, 5),
(22, 1625928371, 16, 10000000, 5),
(23, 1625928371, 17, 10000000, 5),
(24, 1625928371, 16, 10000000, 5),
(25, 1625928406, 16, 10000000, 5),
(26, 1625928406, 17, 10000000, 5),
(27, 1625928406, 16, 10000000, 5),
(28, 1625928459, 16, 10000000, 5),
(29, 1625928459, 17, 10000000, 5),
(30, 1625928459, 16, 10000000, 5),
(31, 1625928538, 16, 10000000, 5),
(32, 1625928538, 17, 10000000, 5),
(33, 1625928538, 16, 10000000, 5),
(34, 1625928562, 16, 10000000, 5),
(35, 1625928562, 17, 10000000, 5),
(36, 1625928562, 16, 10000000, 5),
(37, 1625928574, 16, 10000000, 5),
(38, 1625928574, 17, 10000000, 5),
(39, 1625928574, 16, 10000000, 5),
(40, 1625928581, 16, 10000000, 5),
(41, 1625928581, 17, 10000000, 5),
(42, 1625928581, 16, 10000000, 5),
(43, 1625928582, 16, 10000000, 5),
(44, 1625928582, 17, 10000000, 5),
(45, 1625928582, 16, 10000000, 5),
(46, 1625928585, 16, 10000000, 5),
(47, 1625928585, 17, 10000000, 5),
(48, 1625928585, 16, 10000000, 5),
(49, 1625928591, 16, 10000000, 5),
(50, 1625928591, 17, 10000000, 5),
(51, 1625928591, 16, 10000000, 5);

--
-- Triggers `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `update_stok_dari_penjualan` AFTER INSERT ON `detail_penjualan` FOR EACH ROW BEGIN

       DECLARE ada integer;
       DECLARE id_stok integer;
       DECLARE quantity integer;
       DECLARE total double;

    
       		-- cek apakah ada stoknya
       		SELECT COUNT(*),id_stok_barang,stok
       		INTO @ada,@id_stok,@quantity
       		FROM stok_barang
      		WHERE stok_barang.id_barang= NEW.id_barang;
       		IF @ada > 0
            THEN
            
                IF @quantity - NEW.quantity < 1
                THEN
                	SET @total =0;
                ELSE
                	SET @total = @quantity - NEW.quantity;
                END IF;
                
           		UPDATE stok_barang
           		SET stok = @total
           		WHERE id_stok_barang = @id_stok;
                
       		END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id_barang` int(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `id_satuan` int(10) NOT NULL,
  `harga_modal` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `nama_barang`, `id_satuan`, `harga_modal`, `harga_jual`, `kode_barang`) VALUES
(16, 'Stocking', 1, 9500, 20000, NULL),
(17, 'sepatuku', 1, 10000, 20000, 'TD00001');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` int(10) NOT NULL,
  `nama_pemasok` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama_pemasok`, `alamat`, `kota`, `telepon`) VALUES
(1, 'Hercules Toys', 'Kauman Lama', 'Purwokerto', '087678654678'),
(15, 'Baru Raya', 'Kauman Lama', 'Purwokerto', '085764255932'),
(16, 'Stuff Ootd', 'Kelapa Gading', 'Jakarta Utara', '087678654678'),
(17, 'Sakura Shop', 'Pinang', 'Tanggerang', '087678654678'),
(18, 'Fara Fastore', 'Bojong Loa ', 'Bandung', '087678654678'),
(19, 'Giri Wardhana', 'Bubutan', 'Surabaya', '087678654678');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` bigint(20) NOT NULL,
  `nomor_nota` int(10) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `subtotal` int(10) NOT NULL,
  `id_pemasok` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `nomor_nota`, `tanggal`, `subtotal`, `id_pemasok`) VALUES
(1625923739, 0, '2021-07-10', 10000000, 1),
(1625923882, 0, '2021-07-10', 10000000, 1),
(1625924061, 0, '2021-07-10', 10000000, 1),
(1625924508, 0, '2021-07-10', 10000000, 1),
(1625924617, 0, '2021-07-10', 10000000, 1),
(1625925000, 0, '2021-07-10', 10000000, 1),
(1625925089, 0, '2021-07-10', 10000000, 1),
(1625925113, 0, '2021-07-10', 10000000, 1),
(1625925211, 0, '2021-07-10', 10000000, 1),
(1625925289, 0, '2021-07-10', 10000000, 1),
(1625925496, 0, '2021-07-10', 10000000, 1),
(1625925517, 0, '2021-07-10', 10000000, 1),
(1625925670, 0, '2021-07-10', 10000000, 1),
(1625925686, 0, '2021-07-10', 10000000, 1),
(1625925735, 0, '2021-07-10', 10000000, 1),
(1625925788, 0, '2021-07-10', 10000000, 15),
(1625926185, 0, '2021-07-10', 10000000, 15),
(1625926206, 0, '2021-07-10', 10000000, 15),
(1625926221, 0, '2021-07-10', 10000000, 15),
(1625926238, 0, '2021-07-10', 10000000, 15),
(1625928351, 0, '2021-07-10', 10000000, 15),
(1625928360, 0, '2021-07-10', 10000000, 15),
(1625928387, 0, '2021-07-10', 10000000, 15),
(1625928388, 0, '2021-07-10', 10000000, 15),
(1625928389, 0, '2021-07-10', 10000000, 15),
(1625928390, 0, '2021-07-10', 10000000, 15),
(1625928443, 0, '2021-07-10', 10000000, 15),
(1625928444, 0, '2021-07-10', 10000000, 15),
(1625928446, 0, '2021-07-10', 10000000, 15),
(1625928448, 0, '2021-07-10', 10000000, 15),
(1625928449, 0, '2021-07-10', 10000000, 15),
(1625928521, 0, '2021-07-10', 10000000, 15),
(1625928522, 0, '2021-07-10', 10000000, 15),
(1625928523, 0, '2021-07-10', 10000000, 15),
(1625928526, 0, '2021-07-10', 10000000, 15),
(1625928529, 0, '2021-07-10', 10000000, 15),
(1625928530, 0, '2021-07-10', 10000000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(10) NOT NULL,
  `nomor_nota` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `nomor_nota`, `subtotal`, `tanggal`) VALUES
(2, 10, 100, '0000-00-00'),
(3, 999, 100, '0000-00-00'),
(1625927418, 0, 10000000, '2021-07-10'),
(1625927432, 0, 10000000, '2021-07-10'),
(1625927457, 0, 10000000, '2021-07-10'),
(1625927476, 0, 10000000, '2021-07-10'),
(1625927489, 0, 10000000, '2021-07-10'),
(1625927503, 0, 10000000, '2021-07-10'),
(1625928093, 0, 10000000, '2021-07-10'),
(1625928114, 0, 10000000, '2021-07-10'),
(1625928180, 0, 10000000, '2021-07-10'),
(1625928371, 0, 10000000, '2021-07-10'),
(1625928406, 0, 10000000, '2021-07-10'),
(1625928459, 0, 10000000, '2021-07-10'),
(1625928538, 0, 10000000, '2021-07-10'),
(1625928562, 0, 10000000, '2021-07-10'),
(1625928574, 0, 10000000, '2021-07-10'),
(1625928581, 0, 10000000, '2021-07-10'),
(1625928582, 0, 10000000, '2021-07-10'),
(1625928585, 0, 10000000, '2021-07-10'),
(1625928591, 0, 10000000, '2021-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(10) NOT NULL,
  `nama_satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Pcs'),
(3, 'Lusin'),
(4, 'Dus'),
(5, 'Kantong');

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_stok_barang` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `harga_modal` double NOT NULL,
  `harga_jual` double NOT NULL,
  `stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok_barang`, `id_barang`, `harga_modal`, `harga_jual`, `stok`) VALUES
(15, 16, 9000000, 10000000, 0),
(16, 17, 9000000, 10000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `level`) VALUES
(1, 'belatyara', 'bellatyaranf@gmail.com', 'belatyara1', 'admin'),
(2, 'sayaaaaa', 'saya@gmail.com', '11111', 'admin'),
(3, 'sayaaa', 'sayaaa@gmail.com', '1111111111', 'admin supe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail_pembelian`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail_penjualan`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_stok_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail_pembelian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail_penjualan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id_pemasok` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1625928531;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1625928592;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stok_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
