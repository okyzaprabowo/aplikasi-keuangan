-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 23, 2015 at 04:15 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contoh_akuntansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1c9fa2060818860dba4869d96ccdb996', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:35.0) Gecko/20100101 Firefox/35.0', 1424661277, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:22:"aingLoginAkuntansiYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:5:"level";s:11:"super admin";s:4:"foto";s:7:"252.jpg";}'),
('280723397293ff6c71126083bf13950a', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:35.0) Gecko/20100101 Firefox/35.0', 1424602799, ''),
('e494918b5d064010d1b8aed0a74a10ea', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:35.0) Gecko/20100101 Firefox/35.0', 1424599424, 'a:4:{s:9:"user_data";s:0:"";s:9:"logged_in";s:22:"aingLoginAkuntansiYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:12:"Administator";}');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_penyesuaian`
--

CREATE TABLE `jurnal_penyesuaian` (
  `no_jurnal` varchar(20) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `no_rek` char(10) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_penyesuaian`
--

INSERT INTO `jurnal_penyesuaian` (`no_jurnal`, `tgl_jurnal`, `no_rek`, `debet`, `kredit`, `username`, `tgl_insert`) VALUES
('041300001', '2013-04-30', '1102', 250000, 0, 'admin', '2013-04-11 07:04:32'),
('041300001', '2013-04-30', '1103', 0, 300000, 'admin', '2013-04-11 07:04:48'),
('041300001', '2013-04-30', '1104', 0, 600000, 'admin', '2013-04-12 03:04:41'),
('041300001', '2013-04-30', '2102', 0, 200000, 'admin', '2013-04-11 07:04:31'),
('041300001', '2013-04-30', '4101', 0, 250000, 'admin', '2013-04-11 07:04:45'),
('041300001', '2013-04-30', '5101', 200000, 0, 'admin', '2013-04-11 07:04:03'),
('041300001', '2013-04-30', '5102', 300000, 0, 'admin', '2013-04-11 07:04:34'),
('041300001', '2013-04-30', '5104', 600000, 0, 'admin', '2013-04-12 03:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `no_jurnal` varchar(20) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `ket` varchar(255) NOT NULL,
  `no_bukti` varchar(100) NOT NULL,
  `no_rek` char(10) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`no_jurnal`, `tgl_jurnal`, `ket`, `no_bukti`, `no_rek`, `debet`, `kredit`, `username`, `tgl_insert`) VALUES
('041300001', '2013-04-16', 'Pembayaran dari Klien', '001', '1101', 4000000, 0, 'admin', '2013-04-11 07:04:18'),
('041300001', '2013-04-16', 'Pembayaran dari Klien', '001', '1102', 0, 4000000, 'admin', '2013-04-12 03:04:11'),
('041300002', '2013-04-17', 'Pembayaran dari Klien', '002', '1102', 1700000, 0, 'admin', '2013-04-11 07:04:31'),
('041300002', '2013-04-17', 'Pembayaran dari Klien', '002', '4101', 0, 1700000, 'admin', '2013-04-11 07:04:43'),
('041300003', '2013-04-19', 'Biaya lain-lain', '003', '1101', 0, 200000, 'admin', '2013-04-11 07:04:01'),
('041300003', '2013-04-19', 'Biaya lain-lain', '003', '5103', 200000, 0, 'admin', '2013-04-11 07:04:22'),
('041300004', '2013-04-21', 'membayar kewajiban jatuh tempo', '004', '1101', 0, 2600000, 'admin', '2013-04-11 07:04:01'),
('041300004', '2013-04-21', 'membayar kewajiban jatuh tempo', '004', '2101', 2600000, 0, 'admin', '2013-04-11 07:04:28'),
('041300005', '2013-04-22', 'beli perlengkapan secara kredit', '005', '1104', 200000, 0, 'admin', '2013-04-11 07:04:23'),
('041300005', '2013-04-22', 'beli perlengkapan secara kredit', '005', '2101', 0, 200000, 'admin', '2013-04-11 07:04:54'),
('041300006', '2013-04-23', 'menggunakan uang untuk keperluan pribadi', '006', '1101', 0, 2100000, 'admin', '2013-04-11 07:04:37'),
('041300006', '2013-04-23', 'menggunakan uang untuk keperluan pribadi', '006', '3102', 2100000, 0, 'admin', '2013-04-11 07:04:28'),
('041300007', '2013-04-25', 'pendapatan jasa ', '007', '1101', 1900000, 0, 'admin', '2013-04-11 07:04:21'),
('041300007', '2013-04-25', 'pendapatan jasa ', '007', '4101', 0, 1900000, 'admin', '2013-04-11 07:04:32'),
('041300008', '2013-04-30', 'Membayar gaji karyawan', '008', '1101', 0, 1800000, 'admin', '2013-04-11 07:04:03'),
('041300008', '2013-04-30', 'Membayar gaji karyawan', '008', '5101', 1800000, 0, 'admin', '2013-04-11 07:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `no_rek` char(10) NOT NULL DEFAULT '',
  `induk` char(10) NOT NULL DEFAULT '0',
  `level` smallint(6) DEFAULT '0',
  `nama_rek` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`no_rek`, `induk`, `level`, `nama_rek`) VALUES
('1101', '0', 0, 'KAS'),
('1102', '0', 0, 'Piutang '),
('1103', '0', 0, 'Piutang Sewa'),
('1104', '0', 0, 'Perlengkapan'),
('1201', '0', 0, 'Tanah'),
('2101', '0', 0, 'Hutang'),
('2102', '0', 0, 'Hutang Gaji'),
('3101', '0', 0, 'Modal Deddy'),
('3102', '0', 0, 'Prive Deddy'),
('4101', '0', 0, 'Pendapatan Jasa'),
('5101', '0', 0, 'Beban Gaji'),
('5102', '0', 0, 'Beban Sewa'),
('5103', '0', 0, 'Beban Lain-lain'),
('5104', '0', 0, 'Beban Perlengkapan');

-- --------------------------------------------------------

--
-- Table structure for table `saldo_awal`
--

CREATE TABLE `saldo_awal` (
  `periode` year(4) NOT NULL,
  `no_rek` char(10) NOT NULL,
  `debet` int(11) NOT NULL DEFAULT '0',
  `kredit` int(11) NOT NULL DEFAULT '0',
  `tgl_insert` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo_awal`
--

INSERT INTO `saldo_awal` (`periode`, `no_rek`, `debet`, `kredit`, `tgl_insert`, `username`) VALUES
(2012, '1101', 5000000, 0, '2013-04-11', 'admin'),
(2012, '1102', 8000000, 0, '2013-04-11', 'admin'),
(2012, '1103', 1200000, 0, '2013-04-11', 'admin'),
(2012, '1104', 600000, 0, '2013-04-11', 'admin'),
(2012, '1201', 35000000, 0, '2013-04-11', 'admin'),
(2012, '2101', 0, 4400000, '2013-04-11', 'admin'),
(2012, '2102', 0, 0, '2013-04-11', 'admin'),
(2012, '3101', 0, 42500000, '2013-04-11', 'admin'),
(2012, '3102', 2100000, 0, '2013-04-11', 'admin'),
(2012, '4101', 0, 7100000, '2013-04-11', 'admin'),
(2012, '5101', 1800000, 0, '2013-04-11', 'admin'),
(2012, '5102', 0, 0, '2013-04-11', 'admin'),
(2012, '5103', 300000, 0, '2013-04-11', 'admin'),
(2012, '5104', 0, 0, '2013-04-11', 'admin'),
(2015, '1101', 20000, 0, '2015-02-23', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` enum('super admin','admin','user') COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `foto` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `level`, `foto`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'super admin', '252.jpg'),
('deddy', 'e10adc3949ba59abbe56e057f20f883e', 'Deddy Rusdiansyah', 'admin', ''),
('danish', '827ccb0eea8a706c4c34a16891f84e7b', 'Danish Putra Pramudya', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `jurnal_penyesuaian`
--
ALTER TABLE `jurnal_penyesuaian`
 ADD PRIMARY KEY (`no_jurnal`,`no_rek`);

--
-- Indexes for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
 ADD PRIMARY KEY (`no_jurnal`,`no_rek`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
 ADD PRIMARY KEY (`no_rek`);

--
-- Indexes for table `saldo_awal`
--
ALTER TABLE `saldo_awal`
 ADD PRIMARY KEY (`periode`,`no_rek`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
