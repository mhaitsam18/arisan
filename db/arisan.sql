-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 12:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arisan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `nama_barang` varchar(225) NOT NULL,
  `volume` varchar(225) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `terpenuhi` int(11) NOT NULL DEFAULT 0,
  `id_penyelenggara` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `gambar`, `nama_barang`, `volume`, `harga`, `harga_beli`, `terpenuhi`, `id_penyelenggara`, `deleted_at`) VALUES
(1, 'daging1.jpg', 'Daging', '2 Kg', 1400, 300000, 0, 0, NULL),
(2, 'bumbu.jpg', 'Bumbu (Lada, Kemiri, Bawang Putih)', '1 Kg', 300, 150000, 0, 0, NULL),
(3, 'berass1.jpg', 'Beras', '20 Kg', 1100, 250000, 0, 0, NULL),
(4, 'emping.jpg', 'Emping, Kecap Bangau, Sirup ABC', '1 Kg-1 Botol-2 Botol', 650, 30000, 0, 0, NULL),
(5, 'kacang_tanah.jpg', 'Kacang Tanah Kupas', '2 Kg', 450, 250000, 0, 0, NULL),
(6, 'bimoli1.jpg', 'Minyak Bimoli', '5 Liter', 500, 60000, 0, 0, NULL),
(7, 'coca_cola.jpg', 'Coca Cola, Fanta, Sprite', '6 Botol', 400, 80000, 0, 0, NULL),
(9, 'monde1.jpg', 'Monde Besar dan Kecil', '2 Kaleng', 700, 0, 0, 0, NULL),
(10, 'mede.jpg', 'Kacang Mede', '2 Kg', 1400, 0, 0, 0, NULL),
(11, 'khong_guan.jpg', 'Khong Guan Besar dan Kecil', '2 Kaleng', 650, 0, 0, 0, NULL),
(12, 'nissin.jpg', 'Nissin Wafer dan Good Time', '3 Kaleng', 550, 0, 0, 0, NULL),
(13, 'indomie_goreng.jpg', 'Indomie Goreng', '1 Dus', 500, 0, 0, 0, NULL),
(14, 'indomie_kari.jpg', 'Indomie Kari Ayam', '1 Dus', 500, 0, 0, 0, NULL),
(15, 'indomie_soto.jpg', 'Indomie Soto', '1 Dus', 450, 0, 0, 0, NULL),
(16, 'indomie_ayam_bawang.jpg', 'Indomie Ayam Bawang', '1 Dus', 450, 0, 0, 0, NULL),
(17, 'sprei.jpg', 'Sprei My Love', '1 Pcs', 700, 0, 0, 0, NULL),
(18, 'lemonilo.jpg', 'Mie Lemonilo Goreng', '1 Dus', 550, 0, 0, 0, NULL),
(19, 'beras_ketan.jpg', 'Beras Ketan', '5 Kg', 350, 0, 0, 0, NULL),
(20, 'gula.jpg', 'Gula Putih', '3 Kg', 300, 0, 0, 0, NULL),
(21, 'terigu.jpg', 'Terigu Segitiga Biru', '3 Kg', 250, 0, 0, 0, NULL),
(22, 'kacang_telur.jpg', 'Kacang Telur', '2 Kg', 400, 0, 0, 0, NULL),
(23, 'nastar.jpg', 'Kue Nastar', '1 Kg', 600, 0, 0, 0, NULL),
(24, 'keju.jpg', 'Kue Keju', '1 Kg', 550, 0, 0, 0, NULL),
(25, 'sagu.jpg', 'Kue Sagu', '1 Kg', 550, 0, 0, 0, NULL),
(26, 'putri_salju.jpeg', 'Kue Putri Salju', '1 Kg', 550, 0, 0, 0, NULL),
(27, 'kue_kacang.jpg', 'Kue Kacang', '1 Kg', 550, 0, 0, 0, NULL),
(28, 'kue_semprit.jpg', 'Kue Semprit', '1 Kg', 550, 0, 0, 0, NULL),
(29, 'pop_mie_kuah.jpg', 'Pop Mie Kuah', '1 Dus', 500, 0, 0, 0, NULL),
(30, 'pocari.jpg', 'Pocari Sweat', '1 Dus', 600, 0, 0, 0, NULL),
(31, 'teh_botol.jpg', 'Teh Botol Kotak', '2 Dus', 500, 0, 0, 0, NULL),
(32, 'blue_band.jpg', 'Blue Band', '2 Kg', 450, 0, 0, 0, NULL),
(33, 'astor.jpg', 'Astor', '2 Toples', 350, 0, 0, 0, NULL),
(34, 'anggur.jpg', 'Anggur', '2 Kg', 600, 0, 0, 0, NULL),
(35, 'pir.jpg', 'Pir Hijau', '2 Kg', 400, 0, 0, 0, NULL),
(36, 'apel.jpg', 'Apel', '2 Kg', 400, 0, 0, 0, NULL),
(37, 'jeruk.jpg', 'Jeruk Medan', '2 Kg', 250, 0, 0, 0, NULL),
(38, 'susu.jpg', 'Susu Kaleng ', '6 Kaleng', 450, 0, 0, 0, NULL),
(39, 'ale_ale.jpg', 'Ale-Ale', '2 Dus', 200, 0, 0, 0, NULL),
(40, 'bandeng.jpg', 'Ikan Bandeng', '2 Kg', 450, 0, 0, 0, NULL),
(41, 'fanta_kaleng.jpg', 'Coca Cola, Fanta, Sprite', '12 Kaleng', 350, 0, 0, 0, NULL),
(42, 'sprei_my_love.jpg', 'Bed Cover No.1', '1 Pcs', 1800, 0, 0, 0, NULL),
(43, 'vit_gelas.jpg', 'Vit Gelas', '2 Dus', 250, 0, 0, 0, NULL),
(44, 'marjan.jpg', 'Sirup Marjan', '2 Botol', 200, 0, 0, 0, NULL),
(45, 'ayam.jpg', 'Ayam Potong', '1 Ekor', 400, 0, 0, 0, NULL),
(46, 'dodol_cina.jpg', 'Dodol Cina', '2 Pcs', 800, 0, 0, 0, NULL),
(47, 'dodol_tenong.jpg', 'Dodol Tenong', '2 Pcs', 650, 0, 0, 0, NULL),
(48, 'karpet.jpg', 'Karpet Kecil', '1 Pcs', 1500, 0, 0, 0, NULL),
(49, 'karpet_j.jpg', 'Karpet Jumbo', '1 Pcs', 2500, 0, 0, 0, NULL),
(50, 'susu_beruang.jpg', 'Susu Beruang', '1 Dus', 1100, 0, 0, 0, NULL),
(51, 'kue_bawang.jpg', 'Kue Bawang', '2 Kg', 500, 0, 0, 0, NULL),
(52, 'susu_ultra.jpg', 'Susu Ultra', '1 Dus', 450, 0, 0, 0, NULL),
(53, 'aqua_gelas1.jpg', 'Aqua Gelas', '2 Dus', 300, 0, 0, 0, NULL),
(54, 'larutan_kaleng.jpg', 'Larutan Kaleng', '1 Dus', 600, 0, 0, 0, NULL),
(55, 'beras_pandan.jpg', 'Beras Pandan Wangi', '20 Kg', 1250, 0, 0, 0, NULL),
(56, 'larutan_cincau.jpg', 'Larutan Cincau Kaleng', '1 Dus', 600, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `bukti` varchar(225) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_user`, `nama_lengkap`, `tanggal`, `nominal`, `bukti`, `status`) VALUES
(70, 105, 'Sanirah', '2022-05-15', '6000.00', 'bukti_6000.jpeg', 'sukses'),
(71, 105, 'Sanirah', '2022-05-16', '6000.00', 'bukti_60001.jpeg', 'sukses'),
(72, 105, 'Sanirah', '2022-05-17', '6000.00', 'bukti_60002.jpeg', 'sukses'),
(73, 105, 'Sanirah', '2022-05-18', '6000.00', 'bukti_60003.jpeg', 'sukses'),
(74, 105, 'Sanirah', '2022-05-19', '6000.00', 'bukti_60004.jpeg', 'sukses'),
(75, 105, 'Sanirah', '2022-05-20', '6000.00', 'bukti_60005.jpeg', 'sukses'),
(76, 105, 'Sanirah', '2022-05-21', '6000.00', 'bukti_60006.jpeg', 'sukses'),
(77, 105, 'Sanirah', '2022-05-22', '6000.00', 'bukti_60007.jpeg', 'sukses'),
(78, 105, 'Sanirah', '2022-05-23', '6000.00', 'bukti_60008.jpeg', 'sukses'),
(79, 105, 'Sanirah', '2022-05-24', '6000.00', 'bukti_60009.jpeg', 'sukses'),
(80, 105, 'Sanirah', '2022-05-25', '6000.00', 'bukti_600010.jpeg', 'sukses'),
(81, 105, 'Sanirah', '2022-05-26', '6000.00', 'bukti_600011.jpeg', 'sukses'),
(82, 105, 'Sanirah', '2022-05-27', '6000.00', 'bukti_600012.jpeg', 'sukses'),
(83, 105, 'Sanirah', '2022-05-28', '6000.00', 'bukti_600013.jpeg', 'sukses'),
(84, 105, 'Sanirah', '2022-05-29', '6000.00', 'bukti_600014.jpeg', 'sukses'),
(85, 105, 'Sanirah', '2022-05-30', '6000.00', 'bukti_600015.jpeg', 'sukses'),
(86, 105, 'Sanirah', '2022-05-31', '6000.00', 'bukti_600016.jpeg', 'sukses'),
(87, 105, 'Sanirah', '2022-06-01', '6000.00', 'bukti_600017.jpeg', 'sukses'),
(88, 105, 'Sanirah', '2022-06-02', '6000.00', 'bukti_600018.jpeg', 'sukses'),
(89, 105, 'Sanirah', '2022-06-03', '6000.00', 'bukti_600019.jpeg', 'sukses'),
(90, 105, 'Sanirah', '2022-06-04', '6000.00', 'bukti_600020.jpeg', 'sukses'),
(91, 105, 'Sanirah', '2022-06-05', '6000.00', 'bukti_600021.jpeg', 'sukses'),
(92, 105, 'Sanirah', '2022-06-06', '6000.00', 'bukti_600022.jpeg', 'sukses'),
(93, 105, 'Sanirah', '2022-06-07', '6000.00', 'bukti_600023.jpeg', 'sukses'),
(94, 105, 'Sanirah', '2022-06-08', '6000.00', 'bukti_600024.jpeg', 'sukses'),
(95, 105, 'Sanirah', '2022-06-09', '6000.00', 'bukti_600025.jpeg', 'sukses'),
(96, 105, 'Sanirah', '2022-06-10', '6000.00', 'bukti_600026.jpeg', 'sukses'),
(97, 105, 'Sanirah', '2022-06-11', '6000.00', 'bukti_600027.jpeg', 'sukses'),
(98, 105, 'Sanirah', '2022-06-12', '6000.00', 'bukti_600028.jpeg', 'sukses'),
(99, 105, 'Sanirah', '2022-06-13', '6000.00', 'bukti_600029.jpeg', 'sukses'),
(100, 105, 'Sanirah', '2022-06-14', '6000.00', 'bukti_600030.jpeg', 'sukses'),
(101, 105, 'Sanirah', '2022-06-15', '6000.00', 'bukti_600031.jpeg', 'sukses'),
(102, 105, 'Sanirah', '2022-06-16', '6000.00', 'bukti_600032.jpeg', 'sukses'),
(103, 105, 'Sanirah', '2022-06-17', '6000.00', 'bukti_600033.jpeg', 'sukses'),
(104, 105, 'Sanirah', '2022-06-18', '6000.00', 'bukti_600034.jpeg', 'sukses'),
(105, 105, 'Sanirah', '2022-06-19', '6000.00', 'bukti_600035.jpeg', 'sukses'),
(106, 105, 'Sanirah', '2022-06-20', '6000.00', 'bukti_600036.jpeg', 'sukses'),
(107, 105, 'Sanirah', '2022-06-21', '6000.00', 'bukti_600037.jpeg', 'sukses'),
(108, 105, 'Sanirah', '2022-06-22', '6000.00', 'bukti_600038.jpeg', 'sukses'),
(109, 105, 'Sanirah', '2022-06-23', '6000.00', 'bukti_600039.jpeg', 'sukses'),
(110, 105, 'Sanirah', '2022-06-24', '6000.00', 'bukti_600040.jpeg', 'sukses'),
(111, 105, 'Sanirah', '2022-06-25', '6000.00', 'bukti_600041.jpeg', 'sukses'),
(112, 105, 'Sanirah', '2022-06-26', '6000.00', 'bukti_600042.jpeg', 'sukses'),
(113, 105, 'Sanirah', '2022-06-27', '6000.00', 'bukti_600043.jpeg', 'sukses'),
(114, 105, 'Sanirah', '2022-06-28', '6000.00', 'bukti_600044.jpeg', 'sukses'),
(115, 105, 'Sanirah', '2022-06-29', '6000.00', 'bukti_600045.jpeg', 'sukses'),
(116, 105, 'Sanirah', '2022-06-30', '6000.00', 'bukti_600046.jpeg', 'sukses'),
(117, 105, 'Sanirah', '2022-07-01', '6000.00', 'bukti_600047.jpeg', 'sukses'),
(118, 105, 'Sanirah', '2022-07-02', '6000.00', 'bukti_600048.jpeg', 'sukses'),
(119, 105, 'Sanirah', '2022-07-03', '6000.00', 'bukti_600049.jpeg', 'sukses'),
(120, 105, 'Sanirah', '2022-07-04', '6000.00', 'bukti_600050.jpeg', 'sukses'),
(121, 105, 'Sanirah', '2022-07-05', '6000.00', 'bukti_600051.jpeg', 'sukses'),
(122, 105, 'Sanirah', '2022-07-06', '6000.00', 'bukti_600052.jpeg', 'sukses'),
(123, 105, 'Sanirah', '2022-07-07', '6000.00', 'bukti_600053.jpeg', 'sukses'),
(124, 105, 'Sanirah', '2022-07-08', '6000.00', 'bukti_600054.jpeg', 'sukses'),
(125, 105, 'Sanirah', '2022-07-09', '6000.00', 'bukti_600055.jpeg', 'sukses'),
(126, 105, 'Sanirah', '2022-07-10', '6000.00', 'bukti_600056.jpeg', 'sukses'),
(127, 105, 'Sanirah', '2022-07-11', '6000.00', 'bukti_600057.jpeg', 'sukses'),
(128, 105, 'Sanirah', '2022-07-12', '6000.00', 'bukti_600058.jpeg', 'sukses'),
(129, 105, 'Sanirah', '2022-07-13', '6000.00', 'bukti_600059.jpeg', 'sukses'),
(130, 105, 'Sanirah', '2022-07-14', '6000.00', 'bukti_600060.jpeg', 'sukses'),
(131, 105, 'Sanirah', '2022-07-15', '6000.00', 'bukti_600061.jpeg', 'sukses'),
(132, 105, 'Sanirah', '2022-07-16', '6000.00', 'bukti_600062.jpeg', 'sukses'),
(133, 105, 'Sanirah', '2022-07-17', '6000.00', 'bukti_600063.jpeg', 'sukses'),
(134, 105, 'Sanirah', '2022-07-18', '6000.00', 'bukti_600064.jpeg', 'sukses'),
(135, 106, 'Dede', '2022-05-15', '10000.00', 'bukti_10000.jpeg', 'cancel'),
(136, 106, 'Dede', '2022-05-16', '10000.00', 'bukti_100001.jpeg', 'sukses'),
(137, 106, 'Dede', '2022-05-17', '10000.00', 'bukti_100002.jpeg', 'sukses'),
(138, 106, 'Dede', '2022-05-18', '10000.00', 'bukti_100003.jpeg', 'sukses'),
(139, 106, 'Dede', '2022-05-19', '10000.00', 'bukti_100004.jpeg', 'sukses'),
(140, 106, 'Dede', '2022-05-20', '10000.00', 'bukti_100005.jpeg', 'sukses'),
(141, 106, 'Dede', '2022-05-21', '10000.00', 'bukti_100006.jpeg', 'sukses'),
(142, 106, 'Dede', '2022-05-22', '10000.00', 'bukti_100007.jpeg', 'sukses'),
(143, 106, 'Dede', '2022-05-23', '10000.00', 'bukti_100008.jpeg', 'sukses'),
(144, 106, 'Dede', '2022-05-24', '10000.00', 'bukti_100009.jpeg', 'sukses'),
(145, 106, 'Dede', '2022-05-25', '10000.00', 'bukti_1000010.jpeg', 'sukses'),
(146, 106, 'Dede', '2022-05-26', '10000.00', 'bukti_1000011.jpeg', 'sukses'),
(147, 106, 'Dede', '2022-05-27', '10000.00', 'bukti_1000012.jpeg', 'sukses'),
(148, 106, 'Dede', '2022-05-28', '10000.00', 'bukti_1000013.jpeg', 'sukses'),
(149, 106, 'Dede', '2022-05-29', '10000.00', 'bukti_1000014.jpeg', 'sukses'),
(150, 106, 'Dede', '2022-05-30', '10000.00', 'bukti_1000015.jpeg', 'sukses'),
(151, 106, 'Dede', '2022-05-31', '10000.00', 'bukti_1000016.jpeg', 'sukses'),
(152, 106, 'Dede', '2022-06-01', '10000.00', 'bukti_1000017.jpeg', 'sukses'),
(153, 106, 'Dede', '2022-06-02', '10000.00', 'bukti_1000018.jpeg', 'sukses'),
(154, 106, 'Dede', '2022-06-03', '10000.00', 'bukti_1000019.jpeg', 'sukses'),
(155, 106, 'Dede', '2022-06-04', '10000.00', 'bukti_1000020.jpeg', 'sukses'),
(156, 106, 'Dede', '2022-06-05', '10000.00', 'bukti_1000021.jpeg', 'sukses'),
(157, 106, 'Dede', '2022-06-06', '10000.00', 'bukti_1000022.jpeg', 'sukses'),
(158, 106, 'Dede', '2022-06-07', '10000.00', 'bukti_1000023.jpeg', 'sukses'),
(159, 106, 'Dede', '2022-06-08', '10000.00', 'bukti_1000024.jpeg', 'sukses'),
(160, 106, 'Dede', '2022-06-09', '10000.00', 'bukti_1000025.jpeg', 'sukses'),
(161, 106, 'Dede', '2022-06-10', '10000.00', 'bukti_1000026.jpeg', 'sukses'),
(162, 106, 'Dede', '2022-06-11', '10000.00', 'bukti_1000027.jpeg', 'sukses'),
(163, 106, 'Dede', '2022-06-12', '10000.00', 'bukti_1000028.jpeg', 'sukses'),
(164, 106, 'Dede', '2022-06-13', '10000.00', 'bukti_1000029.jpeg', 'sukses'),
(165, 106, 'Dede', '2022-06-14', '10000.00', 'bukti_1000030.jpeg', 'sukses'),
(166, 106, 'Dede', '2022-06-15', '10000.00', 'bukti_1000031.jpeg', 'sukses'),
(167, 106, 'Dede', '2022-06-16', '10000.00', 'bukti_1000032.jpeg', 'sukses'),
(168, 106, 'Dede', '2022-06-17', '10000.00', 'bukti_1000033.jpeg', 'sukses'),
(169, 106, 'Dede', '2022-06-18', '10000.00', 'bukti_1000034.jpeg', 'sukses'),
(170, 106, 'Dede', '2022-06-19', '10000.00', 'bukti_1000035.jpeg', 'sukses'),
(171, 106, 'Dede', '2022-06-20', '10000.00', 'bukti_1000036.jpeg', 'sukses'),
(172, 106, 'Dede', '2022-06-21', '10000.00', 'bukti_1000037.jpeg', 'sukses'),
(173, 106, 'Dede', '2022-06-22', '10000.00', 'bukti_1000038.jpeg', 'sukses'),
(174, 106, 'Dede', '2022-06-23', '10000.00', 'bukti_1000039.jpeg', 'sukses'),
(175, 106, 'Dede', '2022-06-24', '10000.00', 'bukti_1000040.jpeg', 'sukses'),
(176, 106, 'Dede', '2022-06-25', '10000.00', 'bukti_1000041.jpeg', 'sukses'),
(177, 106, 'Dede', '2022-06-26', '10000.00', 'bukti_1000042.jpeg', 'sukses'),
(178, 106, 'Dede', '2022-06-27', '10000.00', 'bukti_1000043.jpeg', 'sukses'),
(179, 106, 'Dede', '2022-06-28', '10000.00', 'bukti_1000044.jpeg', 'sukses'),
(180, 106, 'Dede', '2022-06-29', '10000.00', 'bukti_1000045.jpeg', 'sukses'),
(181, 106, 'Dede', '2022-06-30', '10000.00', 'bukti_1000046.jpeg', 'sukses'),
(182, 106, 'Dede', '2022-07-01', '10000.00', 'bukti_1000047.jpeg', 'sukses'),
(183, 106, 'Dede', '2022-07-02', '10000.00', 'bukti_1000048.jpeg', 'sukses'),
(184, 106, 'Dede', '2022-07-03', '10000.00', 'bukti_1000049.jpeg', 'sukses'),
(185, 106, 'Dede', '2022-07-04', '10000.00', 'bukti_1000050.jpeg', 'sukses'),
(186, 106, 'Dede', '2022-07-05', '10000.00', 'bukti_1000051.jpeg', 'sukses'),
(187, 106, 'Dede', '2022-07-06', '10000.00', 'bukti_1000052.jpeg', 'sukses'),
(188, 106, 'Dede', '2022-07-07', '10000.00', 'bukti_1000053.jpeg', 'sukses'),
(189, 106, 'Dede', '2022-07-08', '10000.00', 'bukti_1000054.jpeg', 'sukses'),
(190, 106, 'Dede', '2022-07-09', '10000.00', 'bukti_1000055.jpeg', 'sukses'),
(191, 106, 'Dede', '2022-07-10', '10000.00', 'bukti_1000056.jpeg', 'sukses'),
(192, 106, 'Dede', '2022-07-11', '10000.00', 'bukti_1000057.jpeg', 'sukses'),
(193, 106, 'Dede', '2022-07-12', '10000.00', 'bukti_1000058.jpeg', 'sukses'),
(194, 106, 'Dede', '2022-07-13', '10000.00', 'bukti_1000059.jpeg', 'sukses'),
(195, 106, 'Dede', '2022-07-14', '10000.00', 'bukti_1000060.jpeg', 'sukses'),
(196, 106, 'Dede', '2022-07-15', '10000.00', 'bukti_1000061.jpeg', 'sukses'),
(197, 106, 'Dede', '2022-07-16', '10000.00', 'bukti_1000062.jpeg', 'sukses'),
(198, 106, 'Dede', '2022-07-17', '10000.00', 'bukti_1000063.jpeg', 'sukses'),
(199, 106, 'Dede', '2022-07-18', '10000.00', 'bukti_1000064.jpeg', 'sukses'),
(200, 106, 'Dede', '2022-07-19', '10000.00', 'bukti_1000065.jpeg', 'sukses'),
(201, 108, 'Riri', '2022-05-15', '5350.00', 'bukti16.jpg', 'sukses'),
(202, 108, 'Riri', '2022-05-16', '5350.00', 'Diinput oleh petugas', 'sukses'),
(203, 111, 'Juju', '2022-05-15', '10000.00', 'bukti_1000066.jpeg', 'sukses'),
(204, 111, 'Juju', '2022-05-16', '10000.00', 'bukti_1000067.jpeg', 'sukses'),
(205, 111, 'Juju', '2022-05-17', '10000.00', 'bukti_1000068.jpeg', 'sukses'),
(206, 111, 'Juju', '2022-05-18', '10000.00', 'bukti_1000069.jpeg', 'sukses'),
(207, 111, 'Juju', '2022-05-19', '10000.00', 'bukti_1000070.jpeg', 'sukses'),
(208, 111, 'Juju', '2022-05-20', '10000.00', 'bukti_1000071.jpeg', 'sukses'),
(209, 111, 'Juju', '2022-05-21', '10000.00', 'bukti_1000072.jpeg', 'sukses'),
(210, 111, 'Juju', '2022-05-22', '10000.00', 'bukti_1000073.jpeg', 'sukses'),
(211, 111, 'Juju', '2022-05-23', '10000.00', 'bukti_1000074.jpeg', 'sukses'),
(212, 111, 'Juju', '2022-05-24', '10000.00', 'bukti_1000075.jpeg', 'sukses'),
(213, 111, 'Juju', '2022-05-25', '10000.00', 'bukti_1000076.jpeg', 'sukses'),
(214, 111, 'Juju', '2022-05-26', '10000.00', 'bukti_1000077.jpeg', 'sukses'),
(215, 111, 'Juju', '2022-05-27', '10000.00', 'bukti_1000078.jpeg', 'sukses'),
(216, 111, 'Juju', '2022-05-28', '10000.00', 'bukti_1000079.jpeg', 'sukses'),
(217, 111, 'Juju', '2022-05-29', '10000.00', 'bukti_1000080.jpeg', 'sukses'),
(218, 111, 'Juju', '2022-05-30', '10000.00', 'bukti_1000081.jpeg', 'sukses'),
(219, 111, 'Juju', '2022-05-31', '10000.00', 'bukti_1000082.jpeg', 'sukses'),
(220, 111, 'Juju', '2022-06-01', '10000.00', 'bukti_1000083.jpeg', 'sukses'),
(221, 111, 'Juju', '2022-06-02', '10000.00', 'bukti_1000084.jpeg', 'sukses'),
(222, 111, 'Juju', '2022-06-03', '10000.00', 'bukti_1000085.jpeg', 'sukses'),
(223, 111, 'Juju', '2022-06-30', '270000.00', 'bukti_270.jpeg', 'sukses'),
(224, 111, 'Juju', '2022-07-01', '10000.00', 'bukti_1000086.jpeg', 'sukses'),
(225, 111, 'Juju', '2022-07-02', '10000.00', 'bukti_1000087.jpeg', 'sukses'),
(226, 111, 'Juju', '2022-07-03', '10000.00', 'bukti_1000088.jpeg', 'sukses'),
(227, 111, 'Juju', '2022-07-10', '70000.00', 'bukti_70.jpeg', 'sukses'),
(228, 111, 'Juju', '2022-07-17', '70000.00', 'bukti_701.jpeg', 'sukses'),
(229, 111, 'Juju', '2022-07-18', '10000.00', 'bukti_702.jpeg', 'sukses'),
(230, 111, 'Juju', '2022-07-19', '10000.00', 'bukti_703.jpeg', 'sukses'),
(231, 111, 'Juju', '2022-07-20', '10000.00', 'bukti_1000089.jpeg', 'sukses'),
(232, 112, 'Diana', '2022-05-15', '5000.00', 'bukti_5000.jpeg', 'sukses'),
(233, 112, 'Diana', '2022-05-22', '35000.00', 'bukti_35rb.jpeg', 'sukses'),
(234, 112, 'Diana', '2022-05-29', '35000.00', 'bukti_35rb1.jpeg', 'sukses'),
(235, 112, 'Diana', '2022-06-05', '35000.00', 'bukti_35rb2.jpeg', 'sukses'),
(236, 112, 'Diana', '2022-06-12', '35000.00', 'bukti_35rb3.jpeg', 'sukses'),
(237, 112, 'Diana', '2022-06-19', '35000.00', 'bukti_35rb4.jpeg', 'sukses'),
(238, 112, 'Diana', '2022-06-26', '35000.00', 'bukti_35rb5.jpeg', 'sukses'),
(239, 112, 'Diana', '2022-07-03', '35000.00', 'bukti_35rb6.jpeg', 'sukses'),
(240, 112, 'Diana', '2022-07-10', '35000.00', 'bukti_35rb7.jpeg', 'sukses'),
(241, 112, 'Diana', '2022-07-17', '35000.00', 'bukti_35rb8.jpeg', 'sukses'),
(242, 113, 'Asri', '2022-05-15', '5000.00', 'bukti_5rb.jpeg', 'sukses'),
(243, 113, 'Asri', '2022-05-16', '5000.00', 'bukti_5rb1.jpeg', 'sukses'),
(244, 113, 'Asri', '2022-05-17', '5000.00', 'bukti_5rb2.jpeg', 'sukses'),
(245, 113, 'Asri', '2022-05-18', '5000.00', 'bukti_5rb3.jpeg', 'sukses'),
(246, 113, 'Asri', '2022-05-19', '5000.00', 'bukti_5rb4.jpeg', 'sukses'),
(247, 113, 'Asri', '2022-05-20', '5000.00', 'bukti_5rb5.jpeg', 'sukses'),
(248, 113, 'Asri', '2022-05-21', '5000.00', 'bukti_5rb6.jpeg', 'sukses'),
(249, 113, 'Asri', '2022-05-22', '5000.00', 'bukti_5rb7.jpeg', 'sukses'),
(250, 113, 'Asri', '2022-05-23', '5000.00', 'bukti_5rb8.jpeg', 'sukses'),
(251, 113, 'Asri', '2022-05-24', '5000.00', 'bukti_5rb9.jpeg', 'sukses'),
(252, 113, 'Asri', '2022-05-25', '5000.00', 'bukti_5rb10.jpeg', 'sukses'),
(253, 113, 'Asri', '2022-05-26', '5000.00', 'bukti_5rb11.jpeg', 'sukses'),
(254, 113, 'Asri', '2022-05-27', '5000.00', 'bukti_5rb12.jpeg', 'sukses'),
(255, 113, 'Asri', '2022-05-28', '5000.00', 'bukti_5rb13.jpeg', 'sukses'),
(256, 113, 'Asri', '2022-05-29', '5000.00', 'bukti_5rb14.jpeg', 'sukses'),
(257, 113, 'Asri', '2022-05-30', '5000.00', 'bukti_5rb15.jpeg', 'sukses'),
(258, 113, 'Asri', '2022-05-31', '5000.00', 'bukti_5rb16.jpeg', 'sukses'),
(259, 113, 'Asri', '2022-06-30', '150000.00', 'bukti_150rb.jpeg', 'sukses'),
(260, 113, 'Asri', '2022-07-01', '5000.00', 'bukti_5rb17.jpeg', 'sukses'),
(261, 113, 'Asri', '2022-07-02', '5000.00', 'bukti_5rb18.jpeg', 'sukses'),
(262, 113, 'Asri', '2022-07-03', '5000.00', 'bukti_5rb19.jpeg', 'sukses'),
(263, 113, 'Asri', '2022-07-10', '35000.00', 'bukti_35rb9.jpeg', 'sukses'),
(264, 113, 'Asri', '2022-07-17', '35000.00', 'bukti_35rb10.jpeg', 'sukses'),
(265, 113, 'Asri', '2022-07-18', '5000.00', 'bukti_5rb20.jpeg', 'sukses'),
(266, 113, 'Asri', '2022-07-19', '5000.00', 'bukti_5rb21.jpeg', 'sukses'),
(267, 113, 'Asri', '2022-07-20', '5000.00', 'bukti_5rb22.jpeg', 'sukses'),
(268, 113, 'Asri', '2022-07-21', '5000.00', 'bukti_5rb23.jpeg', 'sukses'),
(269, 114, 'Nina', '2022-05-15', '7000.00', 'bukti_7rb.jpeg', 'sukses'),
(270, 114, 'Nina', '2022-05-16', '7000.00', 'bukti_7rb1.jpeg', 'sukses'),
(271, 114, 'Nina', '2022-05-17', '7000.00', 'bukti_7rb2.jpeg', 'sukses'),
(272, 114, 'Nina', '2022-05-18', '7000.00', 'bukti_7rb3.jpeg', 'sukses'),
(273, 114, 'Nina', '2022-05-19', '7000.00', 'bukti_7rb4.jpeg', 'sukses'),
(274, 114, 'Nina', '2022-05-20', '7000.00', 'bukti_7rb5.jpeg', 'sukses'),
(275, 114, 'Nina', '2022-05-21', '7000.00', 'bukti_7rb6.jpeg', 'sukses'),
(276, 114, 'Nina', '2022-05-22', '7000.00', 'bukti_7rb7.jpeg', 'sukses'),
(277, 114, 'Nina', '2022-05-23', '7000.00', 'bukti_7rb8.jpeg', 'sukses'),
(278, 114, 'Nina', '2022-05-24', '7000.00', 'bukti_7rb9.jpeg', 'sukses'),
(279, 114, 'Nina', '2022-05-25', '7000.00', 'bukti_7rb10.jpeg', 'sukses'),
(280, 114, 'Nina', '2022-05-26', '7000.00', 'bukti_7rb11.jpeg', 'sukses'),
(281, 114, 'Nina', '2022-05-27', '7000.00', 'bukti_7rb12.jpeg', 'sukses'),
(282, 114, 'Nina', '2022-05-28', '7000.00', 'bukti_7rb13.jpeg', 'sukses'),
(283, 114, 'Nina', '2022-05-29', '7000.00', 'bukti_7rb14.jpeg', 'sukses'),
(284, 114, 'Nina', '2022-05-30', '7000.00', 'bukti_7rb15.jpeg', 'sukses'),
(285, 114, 'Nina', '2022-05-31', '7000.00', 'bukti_7rb16.jpeg', 'sukses'),
(286, 114, 'Nina', '2022-06-01', '7000.00', 'bukti_7rb17.jpeg', 'sukses'),
(287, 114, 'Nina', '2022-06-02', '7000.00', 'bukti_7rb18.jpeg', 'sukses'),
(288, 114, 'Nina', '2022-06-03', '7000.00', 'bukti_7rb19.jpeg', 'sukses'),
(289, 114, 'Nina', '2022-06-04', '7000.00', 'bukti_7rb20.jpeg', 'sukses'),
(290, 114, 'Nina', '2022-06-05', '7000.00', 'bukti_7rb21.jpeg', 'sukses'),
(291, 114, 'Nina', '2022-06-12', '49000.00', 'bukti_49rb.jpeg', 'sukses'),
(292, 114, 'Nina', '2022-06-19', '49000.00', 'bukti_49rb1.jpeg', 'sukses'),
(293, 114, 'Nina', '2022-06-26', '49000.00', 'bukti_49rb2.jpeg', 'sukses'),
(294, 114, 'Nina', '2022-06-27', '7000.00', 'bukti_7rb22.jpeg', 'sukses'),
(295, 114, 'Nina', '2022-06-28', '7000.00', 'bukti_7rb23.jpeg', 'sukses'),
(296, 114, 'Nina', '2022-06-29', '7000.00', 'bukti_7rb24.jpeg', 'sukses'),
(297, 114, 'Nina', '2022-06-30', '7000.00', 'bukti_7rb25.jpeg', 'sukses'),
(298, 114, 'Nina', '2022-07-01', '7000.00', 'bukti_7rb26.jpeg', 'sukses'),
(299, 114, 'Nina', '2022-07-02', '7000.00', 'bukti_7rb27.jpeg', 'sukses'),
(300, 114, 'Nina', '2022-07-03', '7000.00', 'bukti_7rb28.jpeg', 'sukses'),
(301, 114, 'Nina', '2022-07-10', '49000.00', 'bukti_49rb3.jpeg', 'sukses'),
(302, 114, 'Nina', '2022-07-17', '49000.00', 'bukti_49rb4.jpeg', 'sukses'),
(303, 114, 'Nina', '2022-07-18', '7000.00', 'bukti_7rb29.jpeg', 'sukses'),
(304, 114, 'Nina', '2022-07-19', '7000.00', 'bukti_7rb30.jpeg', 'sukses'),
(305, 114, 'Nina', '2022-07-20', '7000.00', 'bukti_7rb31.jpeg', 'sukses'),
(306, 114, 'Nina', '2022-07-21', '7000.00', 'bukti_7rb32.jpeg', 'sukses'),
(307, 115, 'Melan', '2022-05-15', '5450.00', 'buktibayar.jpeg', 'sukses'),
(308, 115, 'Melan', '2022-05-16', '5450.00', 'buktibayar1.jpeg', 'sukses'),
(309, 115, 'Melan', '2022-05-31', '81750.00', 'bukti_1bulan.jpeg', 'sukses'),
(310, 115, 'Melan', '2022-06-30', '163500.00', 'bukti_163500.jpeg', 'sukses'),
(311, 115, 'Melan', '2022-07-01', '5450.00', 'buktibayar2.jpeg', 'sukses'),
(312, 115, 'Melan', '2022-07-02', '5450.00', 'buktibayar3.jpeg', 'sukses'),
(313, 115, 'Melan', '2022-07-03', '5450.00', 'buktibayar4.jpeg', 'sukses'),
(314, 115, 'Melan', '2022-07-04', '5450.00', 'buktibayar5.jpeg', 'sukses'),
(315, 115, 'Melan', '2022-07-05', '5450.00', 'buktibayar6.jpeg', 'sukses'),
(316, 115, 'Melan', '2022-07-06', '5450.00', 'buktibayar7.jpeg', 'sukses'),
(317, 115, 'Melan', '2022-07-07', '5450.00', 'buktibayar8.jpeg', 'sukses'),
(318, 115, 'Melan', '2022-07-08', '5450.00', 'buktibayar9.jpeg', 'sukses'),
(319, 115, 'Melan', '2022-07-09', '5450.00', 'buktibayar10.jpeg', 'sukses'),
(320, 115, 'Melan', '2022-07-10', '5450.00', 'buktibayar11.jpeg', 'sukses'),
(321, 115, 'Melan', '2022-07-11', '5450.00', 'buktibayar12.jpeg', 'sukses'),
(322, 115, 'Melan', '2022-07-12', '5450.00', 'buktibayar13.jpeg', 'sukses'),
(323, 115, 'Melan', '2022-07-13', '5450.00', 'buktibayar14.jpeg', 'sukses'),
(324, 115, 'Melan', '2022-07-14', '5450.00', 'buktibayar15.jpeg', 'sukses'),
(325, 115, 'Melan', '2022-07-15', '5450.00', 'buktibayar16.jpeg', 'sukses'),
(326, 115, 'Melan', '2022-07-16', '5450.00', 'buktibayar17.jpeg', 'sukses'),
(327, 115, 'Melan', '2022-07-17', '5450.00', 'buktibayar18.jpeg', 'sukses'),
(328, 115, 'Melan', '2022-07-18', '5450.00', 'buktibayar19.jpeg', 'sukses'),
(329, 115, 'Melan', '2022-07-19', '5450.00', 'buktibayar20.jpeg', 'sukses'),
(330, 115, 'Melan', '2022-07-20', '5450.00', 'buktibayar21.jpeg', 'sukses'),
(331, 115, 'Melan', '2022-07-21', '5450.00', 'buktibayar22.jpeg', 'sukses'),
(335, 105, 'Sanirah', '2022-07-20', '12000.00', 'logo2.jpg', 'cancel'),
(336, 119, 'idham', '2022-05-16', '2800.00', 'logo4.jpg', 'cancel'),
(337, 105, 'Sanirah', '2022-07-19', '6000.00', 'bukti17.jpg', 'sukses');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_bulanan`
--

CREATE TABLE `pembayaran_bulanan` (
  `id` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `bukti` varchar(225) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran_bulanan`
--

INSERT INTO `pembayaran_bulanan` (`id`, `id_petugas`, `nama_lengkap`, `tanggal`, `nominal`, `bukti`, `status`) VALUES
(36, 18, 'Kokom', '2022-07-20', 300000, 'bukti15.jpg', 'sukses');

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggara`
--

CREATE TABLE `penyelenggara` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tanggal_mulai` date DEFAULT current_timestamp(),
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyelenggara`
--

INSERT INTO `penyelenggara` (`id`, `nama_lengkap`, `alamat`, `no_hp`, `username`, `image`, `password`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(0, 'Imas', 'Jl. Rawa Bebek RT02/01 No.108', '6285890006338', 'penyelenggara123', 'avatar3.png', '$2y$10$gG1nIjN3m9MSiA3twQbr0u0til0mxcnY6AMF3VHyeXlgbG7QovTmG', '2022-05-15', '2023-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `id_penyelenggara` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_lengkap`, `alamat`, `no_hp`, `username`, `image`, `password`, `status`, `id_penyelenggara`, `created_at`) VALUES
(18, 'Kokom', 'Jl. Rawa Bebek RT02/01 No.17', '6282284284815', 'kokom', 'default.png', '$2y$10$LVGLMm7cvS/iBC0F2Q0elu9sGG1IIMd4jsCcqDczcRXjrp9EOxR1.', 'aktif', 0, NULL),
(29, 'Surnani', 'Jl. Penggilingan No.12', '6282284284815', 'surnani', 'default.png', '$2y$10$HUo6IcKId.qOfD3cBS2NlOOqvLB8VeHBPWCveFZ32brKPJrSqoi/S', 'aktif', 0, NULL),
(30, 'Supriyati', 'Jl. Rawa Bebek RT02/01 No.46', '6282284284815', '', 'default.png', '', 'nonaktif', 0, NULL),
(31, 'Muti', 'Jl. Rawa Bebek RT10/01 No.78', '6282284284815', '', 'default.png', '', 'nonaktif', 0, NULL),
(32, 'Yeni', 'Jl. Rawa Bebek RT03/01 No.90', '6282284284815', '', 'default.png', '', 'nonaktif', 0, NULL),
(33, 'Wiwit', 'Jl. Kepisangan RT07/04 No. 67', '6282284284815', '', 'default.png', '', 'nonaktif', 0, NULL),
(34, 'Yayan', 'Jl. Rawa Bebek RT11/01 No.43', '6282284284815', '', 'default.png', '', 'nonaktif', 0, NULL),
(35, 'Misih', 'Jl. Rawa Bebek RT02/01 No.18', '6282284284815', '', 'default.png', '', 'nonaktif', 0, NULL),
(36, 'Novi', 'Jl. Penggilingan RT08/02 No.28', '6282284284815', '', 'default.png', '', 'nonaktif', 0, NULL),
(37, 'Warni', 'Jl. Rawa Bebek RT04/10 No.48', '6282284284815', '', 'default.png', '', 'nonaktif', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `target_barang`
--

CREATE TABLE `target_barang` (
  `id_target_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target_barang`
--

INSERT INTO `target_barang` (`id_target_barang`, `id_user`, `id_barang`) VALUES
(99, 99, 1),
(100, 99, 1),
(101, 99, 6),
(102, 99, 6),
(103, 99, 20),
(104, 99, 55),
(105, 105, 1),
(106, 105, 3),
(107, 105, 6),
(108, 105, 10),
(109, 106, 1),
(110, 106, 9),
(111, 106, 24),
(112, 102, 1),
(113, 102, 3),
(114, 102, 6),
(115, 102, 10),
(116, 102, 11),
(117, 102, 12),
(118, 102, 20),
(119, 102, 44),
(120, 108, 1),
(121, 108, 3),
(122, 108, 5),
(123, 108, 5),
(124, 108, 6),
(125, 108, 52),
(126, 103, 1),
(127, 103, 1),
(128, 103, 3),
(129, 103, 3),
(130, 103, 6),
(131, 103, 45),
(132, 104, 1),
(133, 104, 1),
(134, 104, 3),
(135, 104, 3),
(136, 104, 6),
(137, 104, 45),
(138, 109, 1),
(139, 109, 1),
(140, 110, 1),
(141, 110, 1),
(142, 110, 3),
(143, 110, 3),
(144, 110, 6),
(145, 110, 45),
(146, 111, 1),
(147, 111, 1),
(148, 111, 3),
(149, 111, 3),
(150, 111, 6),
(151, 111, 45),
(152, 112, 1),
(153, 112, 3),
(154, 112, 6),
(155, 113, 3),
(156, 113, 9),
(157, 113, 36),
(158, 114, 3),
(159, 114, 6),
(160, 114, 20),
(161, 114, 21),
(162, 114, 31),
(163, 114, 32),
(164, 114, 34),
(165, 115, 1),
(166, 115, 1),
(167, 115, 1),
(168, 115, 34),
(169, 115, 37),
(170, 115, 45),
(174, 117, 1),
(175, 119, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `tabungan` varchar(225) DEFAULT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `alamat`, `no_hp`, `username`, `image`, `password`, `status`, `tabungan`, `nama_petugas`, `id_petugas`, `created_at`) VALUES
(105, 'Sanirah', 'Jl. Rawa Bebek RT02/01 No.110', '6282284284815', 'Sanirah', 'default.png', '$2y$10$lyEJ0nvRrozKr4/lVFyI8.drDawQXYeF5McAIzVswiC8tZ.mjbxuO', 'aktif', '1600', 'Kokom', 18, '2022-07-17 17:00:00'),
(106, 'Dede', 'Jl. Rawa Bebek RT02/01 No. 89', '6282284284815', 'Dede', 'default.png', '$2y$10$kj.T29wNlH6kKYQjH2RaE.I98hENvDM7WqHmfzpBckSxRSalFplR.', 'aktif', '7350', 'Kokom', 18, '2022-07-17 19:30:23'),
(111, 'Juju', 'Jl. Rawa Bebek RT02/01 No.40', '6282284284815', 'Juju', 'default.png', '$2y$10$KuS2ZDU0EE32.VcceFpJvOQDe87Jt4t6Bvsv5WXa3pmcbXOfMqwO.', 'aktif', '4100', 'Kokom', 18, '2022-07-18 18:00:00'),
(112, 'Diana', 'Jl. Rawa Bebek RT02/01 No.67', '6282284284815', 'Diana', 'default.png', '$2y$10$qoQ8vb41DyWSqxSll17VJutsVdhPWu6BtBDJcDBQoP7p/zSqcc1tq', 'aktif', '2000', 'Kokom', 18, '2022-07-18 19:20:30'),
(113, 'Asri', 'Jl. Rawa Bebek RT03/01 No.76', '6282284284815', 'Asri', 'default.png', '$2y$10$DUUfFhxszntEL27SXb8MEehcetTF7ItL0KftyuAHiH0RUIeDsdWGu', 'aktif', '2800', 'Kokom', 18, '2022-07-19 19:30:54'),
(114, 'Nina', 'Jl. Rawa Bebek RT02/01 No.29', '6282284284815', 'Nina', 'default.png', '$2y$10$cp9/fmlrl8gLBUJ9P7sPDOtT/hTPEhSwEESaBo7MP0HpByubAC.Pm', 'aktif', '3300', 'Kokom', 18, '2022-07-19 20:30:32'),
(115, 'Melan', 'Jl. Penggilingan No.78', '6282284284815', 'Melan', 'default.png', '$2y$10$E6u3Dq5/.Wdr2bjz/4QBC.TYTdsBryfOMNSfWdzpqJrfP47W/PyGq', 'aktif', NULL, 'Surnani', 29, '2022-07-20 21:30:12'),
(117, 'coba', 'kuningan', '6282284284815', 'coba', 'default.png', '$2y$10$wXTCXWS2Cp4n7tT0O8kLDe36GPCln7q1cpHQdBYCeLyrR.rjy2J3m', 'aktif', '1000', 'Kokom', 18, '2022-07-25 18:30:34'),
(119, 'idham', 'jakarta', '6285603306', 'idham', 'default.png', '$2y$10$lyEJ0nvRrozKr4/lVFyI8.drDawQXYeF5McAIzVswiC8tZ.mjbxuO', 'aktif', NULL, 'Kokom', 18, '2022-07-26 17:03:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran_bulanan`
--
ALTER TABLE `pembayaran_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target_barang`
--
ALTER TABLE `target_barang`
  ADD PRIMARY KEY (`id_target_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT for table `pembayaran_bulanan`
--
ALTER TABLE `pembayaran_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `target_barang`
--
ALTER TABLE `target_barang`
  MODIFY `id_target_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
