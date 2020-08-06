-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Jul 2020 pada 08.47
-- Versi server: 10.3.23-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u8846868_umroh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_super`
--

CREATE TABLE `dokumen_super` (
  `id_dokumen` int(100) NOT NULL,
  `nomor_id` char(10) NOT NULL,
  `name_customer` varchar(200) NOT NULL,
  `pas_image` varchar(100) NOT NULL,
  `pas_status` varchar(100) NOT NULL,
  `kk_image` varchar(100) NOT NULL,
  `kk_status` varchar(100) NOT NULL,
  `nik_image` varchar(100) NOT NULL,
  `nik_status` varchar(100) NOT NULL,
  `akt_image` varchar(100) NOT NULL,
  `akt_status` varchar(100) NOT NULL,
  `kun_image` varchar(100) NOT NULL,
  `kun_status` varchar(100) NOT NULL,
  `ktp_image` varchar(100) NOT NULL,
  `ktp_status` varchar(100) NOT NULL,
  `bkh_image` varchar(100) NOT NULL,
  `bkh_status` varchar(100) NOT NULL,
  `fu_image` varchar(100) NOT NULL,
  `fu_status` varchar(100) NOT NULL,
  `petugas` varchar(100) NOT NULL,
  `date_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokumen_super`
--

INSERT INTO `dokumen_super` (`id_dokumen`, `nomor_id`, `name_customer`, `pas_image`, `pas_status`, `kk_image`, `kk_status`, `nik_image`, `nik_status`, `akt_image`, `akt_status`, `kun_image`, `kun_status`, `ktp_image`, `ktp_status`, `bkh_image`, `bkh_status`, `fu_image`, `fu_status`, `petugas`, `date_input`) VALUES
(6, 'ID00000011', 'RULLYAWAN MOCHAMAD SUTISNA', '../upload/dokumen/paket_berkah/2017-07-29686Penguins.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29733Lighthouse.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29320Koala.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29226Hydrangeas.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29393Chrysanthemum.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29329Tulips.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29109Desert.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29625Jellyfish.jpg', 'Documents submitted to operational center', 'Rully', '2017-07-29 00:00:00'),
(7, 'ID00000011', 'RULLYAWAN MOCHAMAD SUTISNA', '../upload/dokumen/paket_berkah/2017-07-29337Penguins.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29357Lighthouse.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29749Koala.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29456Hydrangeas.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-2941Chrysanthemum.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29102Tulips.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-2992Desert.jpg', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-07-29343Jellyfish.jpg', 'Documents submitted to operational center', 'Rully', '2017-07-29 00:00:00'),
(10, '536701', 'dummy agent  ristian', '../upload/dokumen/paket_berkah/2017-08-10893arbalogin.png', 'Documents submitted to the marketing department', '../upload/dokumen/paket_berkah/2017-08-10368app_27_previo.jpg', 'Documents submitted to the marketing department', '../upload/dokumen/paket_berkah/2017-08-10518app_27_previo.jpg', 'Documents submitted back to marketing department', '../upload/dokumen/paket_berkah/2017-08-10240About (1).png', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-08-103543.PNG', 'Documents submitted to operational center', '../upload/dokumen/paket_berkah/2017-08-102882.PNG', 'Documents are handed back to the representative center', '../upload/dokumen/paket_berkah/2017-08-1078arbasys.jpg', 'Documents submitted back to marketing department', '../upload/dokumen/paket_berkah/2017-08-10627arbalogin.png', 'Documents submitted back to marketing department', 'agent', '2017-08-10 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `equipment`
--

CREATE TABLE `equipment` (
  `id_equipment` int(20) NOT NULL,
  `equipment_name` varchar(100) NOT NULL,
  `stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `equipment`
--

INSERT INTO `equipment` (`id_equipment`, `equipment_name`, `stock`) VALUES
(9, 'KOPER 2 RODA', 73),
(10, 'KOPER 4 RODA GOLD ', 48),
(11, 'KOPER 4RODA COKLAT', 100),
(12, 'SYAL ARBA', 16),
(13, 'MUKENA ', 62),
(14, 'BUKU DOA', 117),
(15, 'SERAGAM BATIK', 52),
(16, 'KAIN IHRAM', 60),
(17, 'PIN ARBA ', 56),
(18, 'test 234', 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `equipment_jamaah`
--

CREATE TABLE `equipment_jamaah` (
  `id_item` int(20) NOT NULL,
  `nomor_id` char(100) NOT NULL,
  `id_equipment` int(20) NOT NULL,
  `qty_item` int(20) NOT NULL,
  `input_item_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `equipment_jamaah`
--

INSERT INTO `equipment_jamaah` (`id_item`, `nomor_id`, `id_equipment`, `qty_item`, `input_item_date`) VALUES
(11, '', 10, 13, '2020-03-17 20:28:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `no_invoice` int(10) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `nomor_id` char(10) NOT NULL,
  `kd_umroh` int(10) NOT NULL,
  `trax_umroh` char(10) NOT NULL,
  `pay_umroh1` int(100) NOT NULL,
  `pay_umroh2` int(100) NOT NULL,
  `pay_umroh3` int(100) NOT NULL,
  `trax_perlengkapan` char(10) NOT NULL,
  `pay_perlengkapan1` int(100) NOT NULL,
  `pay_perlengkapan2` int(100) NOT NULL,
  `pay_perlengkapan3` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jamaah`
--

CREATE TABLE `jamaah` (
  `nomor_id` char(10) NOT NULL,
  `date_input` datetime NOT NULL,
  `foto_jamaah` varchar(100) NOT NULL,
  `title` varchar(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `status_jamaah` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `family_name` varchar(100) NOT NULL,
  `family_contact` varchar(100) NOT NULL,
  `family_relationship` varchar(100) NOT NULL,
  `packages_program` varchar(100) NOT NULL,
  `depart` date NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `room` varchar(20) NOT NULL,
  `nomor_room` int(10) DEFAULT NULL,
  `no_pass` varchar(100) NOT NULL,
  `poi` varchar(100) NOT NULL,
  `doi` date DEFAULT NULL,
  `expired` varchar(100) DEFAULT NULL,
  `mahrom` varchar(100) NOT NULL,
  `mahrom_status` varchar(100) NOT NULL,
  `kd_umroh` int(100) NOT NULL,
  `petugas` varchar(100) NOT NULL,
  `travel` varchar(100) NOT NULL,
  `metode_status` varchar(20) NOT NULL,
  `ristian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jamaah_cancel`
--

CREATE TABLE `jamaah_cancel` (
  `nomor_id` varchar(100) NOT NULL,
  `packages_program` varchar(100) NOT NULL,
  `First_Name` varchar(100) NOT NULL,
  `Travel` varchar(100) NOT NULL,
  `Reason` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jamaah_daftar`
--

CREATE TABLE `jamaah_daftar` (
  `nomor_id` char(10) NOT NULL,
  `date_daftar` datetime NOT NULL,
  `title` varchar(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `status_jamaah` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `family_name` varchar(100) NOT NULL,
  `family_contact` varchar(100) NOT NULL,
  `family_relationship` varchar(100) NOT NULL,
  `no_pass` varchar(100) NOT NULL,
  `poi` varchar(100) NOT NULL,
  `doi` date NOT NULL,
  `expired` varchar(50) NOT NULL,
  `petugas` varchar(100) NOT NULL,
  `travel` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jamaah_daftar`
--

INSERT INTO `jamaah_daftar` (`nomor_id`, `date_daftar`, `title`, `first_name`, `last_name`, `surname`, `gender`, `place_of_birth`, `birthdate`, `status_jamaah`, `phone`, `alamat`, `email`, `kota`, `family_name`, `family_contact`, `family_relationship`, `no_pass`, `poi`, `doi`, `expired`, `petugas`, `travel`) VALUES
('891448', '2019-07-16 12:37:13', 'MR.', 'ristian', 'tes', '', 'MALE', 'JAKARTA', '2008-02-07', 'MARRIAGE', '68790', 'ser', 'garisdev.developer@gmail.com', 'Jakarta', '', '', '', '', '', '2019-07-05', ' 05-07-2024', 'ristian', 'garisdev'),
('816388', '2020-02-24 09:58:53', 'MR.', 'Jaggernaut', 'Kili Kili', 'BangBang', 'MALE', 'Moskow', '1995-03-09', 'MARRIAGE', '081123456789', 'jakarta 48', 'hk1302@me.com', 'jakarta', 'bucharat', 'magneto', 'OTHERS', 'A1234567866', 'Jakarta', '2020-01-03', ' 03-01-2025', 'ristian', 'garisdev'),
('764420', '2020-02-26 15:09:59', 'MR.', 'hendra', 'kurniawan', 'kurniawan', 'MALE', 'Moskow', '1980-02-12', 'MARRIAGE', '081932002425', 'Perum Pearl Garden Blok B 33 Jl Pekapuran Raya Cimanggis Depok', 'hk130280@gmail.com', 'Depok', '', '', '', '', '', '0000-00-00', ' 01-01-1975', 'ristian', 'garisdev'),
('690108', '2020-02-26 15:10:41', 'MRS.', 'jhgj', '', '', 'MALE', 'kkk', '0011-01-01', 'MARRIAGE', 'hjvj', 'hvjhvjmv', 'jbjk,', 'jbjk,', 'bhjmbkj', '6896798', 'MOTHER', 'r6u7', 'gvjhgvuj', '0001-09-09', ' 09-09-0006', 'ristian', 'garisdev'),
('749357', '2020-03-17 20:24:21', 'MISS.', 'gkj', 'mvjmv', 'b hjm', 'FEMALE', 'lhio', '0002-09-09', 'MARRIAGE', 'jbkj', 'vhjm', 'n,', 'jbkj', 'hgjk', 'hgj', 'OTHERS', 'itgui', 'yufujg', '2020-02-18', ' 18-02-2025', 'ristian', 'garisdev');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_umroh`
--

CREATE TABLE `paket_umroh` (
  `kd_umroh` int(10) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `desc_umroh` varchar(100) NOT NULL,
  `hari_umroh` int(10) NOT NULL,
  `depart_umroh` date NOT NULL,
  `arrival_umroh` date DEFAULT NULL,
  `hotel_umroh_mekkah` varchar(100) NOT NULL,
  `hotel_umroh_madinah` varchar(100) NOT NULL,
  `pesawat_umroh` varchar(100) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `harga_umroh` varchar(100) DEFAULT NULL,
  `harga_triple` varchar(100) DEFAULT NULL,
  `harga_double` varchar(100) DEFAULT NULL,
  `harga_perlengkapan` varchar(100) NOT NULL,
  `kuota` int(10) NOT NULL,
  `itinenary` varchar(200) NOT NULL,
  `daftar` int(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_umroh`
--

INSERT INTO `paket_umroh` (`kd_umroh`, `nama_paket`, `desc_umroh`, `hari_umroh`, `depart_umroh`, `arrival_umroh`, `hotel_umroh_mekkah`, `hotel_umroh_madinah`, `pesawat_umroh`, `currency`, `harga_umroh`, `harga_triple`, `harga_double`, `harga_perlengkapan`, `kuota`, `itinenary`, `daftar`, `keterangan`) VALUES
(68, 'Incentive', 'H Atusludin', 10, '2019-09-08', '0000-00-00', 'Rehab Al Khair / Setaraf', 'Al Salihiyah Golden / Setaraf', 'Air Asia & Saudi Arabia', 'IDR', '21500000', '23000000', '24500000', '0', 12, '../upload/itenenary/paket/2017-09-05329H Atus.docx', 0, ''),
(69, 'Safwa', '', 9, '2019-09-06', '0000-00-00', 'Olayan Ajyad / Nawazi Ajyad / Majestic / Setaraf', 'Shourfah / Concorde / Mukhtara / Setaraf', 'Saudi Arabia', 'USD', '1850', '1925', '2000', '1500000', 41, '../upload/itenenary/paket/2017-11-20407Program Umrah Safwa.pdf', 4, ''),
(70, 'Safwa', '', 9, '2019-09-17', '0000-00-00', 'Olayan Ajyad / Nawazi Ajyad / Majestic / Setaraf', 'Shourfah / Concorde / Mukhtara / Setaraf', 'Saudi Arabia', 'USD', '1850', '2000', '1925', '1500000', 44, '../upload/itenenary/paket/2017-11-20335Program Umrah Safwa.pdf', 1, ''),
(71, 'Safwa', '', 9, '2020-03-17', '0000-00-00', 'Olayan Ajyad / Nawazi Ajyad / Majestic / Setaraf', 'Shourfah / Concorde / Mukhtara / Setaraf', 'Saudi Arabia', 'USD', '1850', '1925', '2000', '1500000', 45, '../upload/itenenary/paket/2017-11-20245Program Umrah Safwa.pdf', 0, ''),
(72, 'Safwa', '', 9, '2020-04-14', '0000-00-00', 'Olayan Ajyad / Nawazi Ajyad / Majestic / Setaraf', 'Shourfah / Concorde / Mukhtara / Setaraf', 'Saudi Arabia', 'USD', '1850', '1925', '2000', '1500000', 45, '../upload/itenenary/paket/2017-11-20443Program Umrah Safwa.pdf', 0, ''),
(73, 'Safwa', '', 9, '2020-04-28', '0000-00-00', 'Olayan Ajyad / Nawazi Ajyad / Majestic / Setaraf', 'Shourfah / Concorde / Mukhtara / Setaraf', 'Saudi Arabia', 'USD', '1850', '1925', '2000', '1500000', 45, '../upload/itenenary/paket/2017-11-20381Program Umrah Safwa.pdf', 0, ''),
(74, 'Marwa', '', 9, '2020-01-20', '0000-00-00', 'Hyatt Regency / Hilton / Safwa Royal Orchid / Setaraf', 'Anwar Movenpick / Al Haram / Millenium / Setaraf', 'Saudi Arabia', 'USD', '2475', '2575', '2675', '1500000', 45, '../upload/itenenary/paket/2017-11-20540Program Umrah MARWA.pdf', 0, ''),
(75, 'Marwa', '', 9, '2019-08-17', '0000-00-00', 'Hyatt Regency / Hilton / Safwa Royal Orchid / Setaraf', 'Anwar Movenpick / Al Haram / Millenium / Setaraf', 'Saudi Arabia', 'USD', '2475', '2575', '2675', '1500000', 45, '../upload/itenenary/paket/2017-11-20540Program Umrah MARWA.pdf', 0, ''),
(76, 'Marwa', '', 9, '2019-08-17', '0000-00-00', 'Hyatt Regency / Hilton / Safwa Royal Orchid / Setaraf', 'Anwar Movenpick / Al Haram / Millenium / Setaraf', 'Saudi Arabia', 'USD', '2475', '2575', '2675', '1500000', 45, '../upload/itenenary/paket/2017-11-20540Program Umrah MARWA.pdf', 0, ''),
(77, 'Marwa', '', 9, '2019-08-14', '0000-00-00', 'Hyatt Regency / Hilton / Safwa Royal Orchid / Setaraf', 'Anwar Movenpick / Al Haram / Millenium / Setaraf', 'Saudi Arabia', 'USD', '2475', '2575', '2675', '1500000', 45, '../upload/itenenary/paket/2017-11-20540Program Umrah MARWA.pdf', 0, ''),
(78, 'Marwa', '', 9, '2019-08-28', '0000-00-00', 'Hyatt Regency / Hilton / Safwa Royal Orchid / Setaraf', 'Anwar Movenpick / Al Haram / Millenium / Setaraf', 'Saudi Arabia', 'USD', '2475', '2575', '2675', '1500000', 45, '../upload/itenenary/paket/2017-11-20540Program Umrah MARWA.pdf', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perlengkapan_list`
--

CREATE TABLE `perlengkapan_list` (
  `id_perlengkapan` int(20) NOT NULL,
  `koper_super` int(20) NOT NULL,
  `koper_silver` int(20) NOT NULL,
  `koper_gold` int(20) NOT NULL,
  `kain_ihram` int(20) NOT NULL,
  `mukena` int(20) NOT NULL,
  `tas_kabin` int(20) NOT NULL,
  `tas_sendal` int(20) NOT NULL,
  `seragam` int(20) NOT NULL,
  `buku_doa` int(20) NOT NULL,
  `pin_arba` int(20) NOT NULL,
  `sabuk` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `push_news`
--

CREATE TABLE `push_news` (
  `id_news` int(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `created` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `push_news`
--

INSERT INTO `push_news` (`id_news`, `title`, `content`, `image`, `created`, `date_created`) VALUES
(10, 'arbasys welcome', ' Arbasys V.5 /2017 siap untuk online \r\ndirancang untuk manajemen travel haji dan umroh  ', '../upload/news/2017-07-29364arbasys.jpg', 'ristian', '2017-07-29 21:31:53'),
(15, 'Paket Milad ', 'Mohon di Upsale', '../upload/news/2017-08-10446Flyer Umroh Milad-1.jpg', 'Rully', '2017-08-10 12:08:11'),
(17, 'Paket Hemat Umrah', '<p>Umrah dan tour</p>\r\n', '../upload/news/2020-03-172464.png', 'ristian', '2020-03-17 16:44:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_equipment`
--

CREATE TABLE `tmp_equipment` (
  `id_tmp` int(100) NOT NULL,
  `nomor_id` char(100) NOT NULL,
  `id_equipment` int(20) NOT NULL,
  `qty_item` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `track_jamaah`
--

CREATE TABLE `track_jamaah` (
  `id_track` int(100) NOT NULL,
  `nomor_id` char(10) NOT NULL,
  `kd_umroh` int(100) NOT NULL,
  `packages_program` varchar(100) NOT NULL,
  `depart` date NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `room` varchar(20) NOT NULL,
  `nomor_room` int(10) DEFAULT NULL,
  `mahrom` varchar(100) NOT NULL,
  `mahrom_status` varchar(100) NOT NULL,
  `status_pay` varchar(50) NOT NULL,
  `staff` varchar(100) NOT NULL,
  `travel_agent` varchar(100) NOT NULL,
  `input_track` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `track_jamaah`
--

INSERT INTO `track_jamaah` (`id_track`, `nomor_id`, `kd_umroh`, `packages_program`, `depart`, `arrival`, `room`, `nomor_room`, `mahrom`, `mahrom_status`, `status_pay`, `staff`, `travel_agent`, `input_track`) VALUES
(1, '891448', 70, 'Safwa', '2019-09-17', '25 September 2019', 'Double', 0, '', '', 'Unpaid', 'ristian', 'garisdev', '2019-07-16 12:37:13'),
(2, '816388', 69, 'Safwa', '2019-09-06', '14 September 2019', 'Double', 0, 'Storm', 'WIFE', 'Unpaid', 'ristian', 'garisdev', '2020-02-24 09:58:53'),
(3, '764420', 69, 'Safwa', '2019-09-06', '14 September 2019', '', 0, '', '', 'Unpaid', 'ristian', 'garisdev', '2020-02-26 15:09:59'),
(4, '690108', 69, 'Safwa', '2019-09-06', '14 September 2019', 'Double', 0, 'bj,', 'SINGLE', 'PAID', 'ristian', 'garisdev', '2020-02-26 15:10:41'),
(5, '749357', 69, 'Safwa', '2019-09-06', '14 September 2019', 'Triple', 0, 'jhfvjh', 'SINGLE', 'Unpaid', 'ristian', 'garisdev', '2020-03-17 20:24:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `travel`
--

CREATE TABLE `travel` (
  `travel_id` int(20) NOT NULL,
  `travel_name` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `phone_travel` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `travel`
--

INSERT INTO `travel` (`travel_id`, `travel_name`, `alamat`, `phone_travel`) VALUES
(1, 'AL Faiz', 'Cimahi', '022154676'),
(2, 'Arba', 'Jl. Buah Batu 201 E', '0227332220'),
(3, 'Garisdev maintenance', 'maintenance', '1111'),
(4, 'Test 1', 'Jl Buah Batu', '0987763'),
(5, 'Test 2', 'buah batu', '9802898');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trax_perlengkapan`
--

CREATE TABLE `trax_perlengkapan` (
  `trax_perlengkapan_id` char(12) NOT NULL,
  `trax_umroh_id` char(12) NOT NULL,
  `kd_umroh` varchar(100) NOT NULL,
  `input_traxp` date NOT NULL,
  `nomor_id` char(10) NOT NULL,
  `payment_perlengkapan` varchar(100) NOT NULL,
  `metode_pay_perlengkapan` varchar(100) NOT NULL,
  `staff` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trax_perlengkapan`
--

INSERT INTO `trax_perlengkapan` (`trax_perlengkapan_id`, `trax_umroh_id`, `kd_umroh`, `input_traxp`, `nomor_id`, `payment_perlengkapan`, `metode_pay_perlengkapan`, `staff`) VALUES
('trxp-0000001', '', '', '2020-02-26', '690108', '10000', 'Transfer', 'ristian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trax_umroh`
--

CREATE TABLE `trax_umroh` (
  `trax_umroh_id` char(12) NOT NULL,
  `trax_perlengkapan_id` char(12) NOT NULL,
  `input_traxu` date NOT NULL,
  `nomor_id` char(10) NOT NULL,
  `kd_umroh` int(100) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `metode_pay` varchar(100) NOT NULL,
  `metode_status` varchar(20) NOT NULL,
  `bukti` varchar(100) NOT NULL,
  `staff` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trax_umroh`
--

INSERT INTO `trax_umroh` (`trax_umroh_id`, `trax_perlengkapan_id`, `input_traxu`, `nomor_id`, `kd_umroh`, `payment`, `metode_pay`, `metode_status`, `bukti`, `staff`) VALUES
('trxu-0000001', '', '2020-02-26', '690108', 69, '1', 'Cash', '', '', 'ristian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `upload`
--

CREATE TABLE `upload` (
  `id_file` int(11) NOT NULL,
  `nama_file` varchar(200) NOT NULL,
  `tanggal_file` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `upload`
--

INSERT INTO `upload` (`id_file`, `nama_file`, `tanggal_file`) VALUES
(61, '../upload/itenenary/2017-07-28417ibm-new-generation-storage-badge.png', '2017-07-28 00:00:00'),
(60, '../upload/itenenary2017-07-28413', '2017-07-28 00:00:00'),
(59, '../upload/itenenary/2017-07-2810', '2017-07-28 00:00:00'),
(58, '/upload/itenenary/2017-07-2866', '2017-07-28 00:00:00'),
(57, '../../upload/itenenary/2017-07-28407', '2017-07-28 00:00:00'),
(56, '../upload/itenenary/2017-07-26381', '2017-07-26 00:00:00'),
(55, '../upload/itenenary/2017-07-2567', '2017-07-25 00:00:00'),
(54, '../upload/itenenary/2017-07-25357', '2017-07-25 00:00:00'),
(52, '../upload/itenenary/2017-07-25289', '2017-07-25 00:00:00'),
(53, '../upload/itenenary/2017-07-25475', '2017-07-25 00:00:00'),
(50, 'upload/itenenary/2017-07-2536', '2017-07-25 00:00:00'),
(51, '../upload/itenenary/2017-07-25362', '2017-07-25 00:00:00'),
(49, '../../modul/upload/2017-07-25226', '2017-07-25 00:00:00'),
(62, '../upload/itenenary/2017-07-28372ibm-linuxone-sales-v1.png', '2017-07-28 00:00:00'),
(63, '../upload/itenenary/2017-07-28247Bill Helena Caroline.pdf', '2017-07-28 00:00:00'),
(64, '../upload/itenenary/2017-07-28396build-chatbots-with-watson-conversation.png', '2017-07-28 00:00:00'),
(65, '../upload/itenenary/2017-07-28477https___kemenagdki.ppdbonline nadine.pdf', '2017-07-28 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `UserID` int(10) NOT NULL,
  `TravelName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `RoleID` int(10) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Salutation` varchar(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `photoURL` blob DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Phone` varchar(20) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Dummy` int(2) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Lastlogin` datetime DEFAULT NULL,
  `ExpirationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`UserID`, `TravelName`, `Email`, `Password`, `RoleID`, `Status`, `Salutation`, `FirstName`, `LastName`, `photoURL`, `BirthDate`, `Phone`, `Gender`, `Dummy`, `CreatedDate`, `Lastlogin`, `ExpirationDate`) VALUES
(1, 'garisdev', 'ristian.abie@gmail.com', '351ec1a8762958831b45481c148b153f', 6, 'Active', 'Mr.', 'ristian', 'febri', NULL, NULL, '12345678', 'Male', 0, '2020-02-10 14:07:28', NULL, '2021-10-20'),
(2, 'garisdev', 'info@garisdev.com', '6fd14cc30400094d50950f16878df094', 2, 'Active', 'Mrs.', 'Fitria', 'Akbar', NULL, NULL, '', 'Female', 0, '2017-07-23 14:18:17', NULL, '2019-02-22'),
(3, 'garisdev', 'fitria', 'ef208a5dfcfc3ea9941d7a6c43841784', 6, 'Active', 'Mrs', 'fitria', 'akbar', NULL, NULL, '', 'female', 0, '2017-07-23 14:22:14', NULL, '2021-11-26'),
(4, 'arba', 'rully_reaper@yahoo.co.id', 'b66ae2475b36baa58286113683fe89a8', 6, 'Active', 'Mr.', 'Rully', '-', NULL, NULL, '123', 'Male', 0, '2017-07-23 14:22:44', NULL, '2019-02-14'),
(6, 'ArbaTour', 'sulis_latifa@yahoo.com', 'd21d3fae55b9690748a9500a950e471b', 6, 'Active', 'MR.', 'SULIS', '-', NULL, NULL, '123', 'Male', 0, '2017-07-23 14:23:01', NULL, '2018-04-26'),
(7, 'ArbaTour', 'mrizqifabianto@gmail.com', 'b66ae2475b36baa58286113683fe89a8', 6, 'Active', 'MR.', 'Rizqi', 'fabianto', NULL, NULL, '1234', 'Male', 0, '2017-07-23 14:23:15', NULL, '2020-02-07'),
(8, 'garisdev', 'agent', 'b33aed8f3134996703dc39f9a7c95783', 1, 'Active', 'Mr.', 'agent', '', NULL, NULL, '123', 'MALE', 0, '2019-07-11 04:16:41', NULL, '2019-07-25'),
(9, 'garisdev', 'fitria.akbar15@gmail.com', '6fd14cc30400094d50950f16878df094', 6, 'Active', 'MRS.', 'fitria', 'akbar', NULL, NULL, '12345', 'Female', 0, '2017-08-25 06:01:46', NULL, '2022-02-10'),
(11, 'Arba', 'apriyantiseli@gmail.com', 'b66ae2475b36baa58286113683fe89a8', 2, 'Active', 'MISS.', 'SELI', 'APRIYANTI', NULL, NULL, '08112288884', 'Female', 0, '2017-07-23 14:24:41', NULL, '2021-01-31'),
(12, 'AL Faiz', 'dsadas@fsdfds.sfds', '83bec07142435dc3a07016c66b68232b', 2, 'Active', 'MRS.', 'fdsfsd', 'fsdf', NULL, NULL, 'fsdfsfs', 'Male', 0, '2017-08-16 10:04:39', NULL, '2017-08-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `waiting`
--

CREATE TABLE `waiting` (
  `waiting_id` int(30) NOT NULL,
  `date_input` datetime NOT NULL,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kd_umroh` int(30) NOT NULL,
  `packages_program` varchar(100) NOT NULL,
  `depart` date NOT NULL,
  `arrival` varchar(100) NOT NULL,
  `travel` varchar(100) NOT NULL,
  `petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokumen_super`
--
ALTER TABLE `dokumen_super`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indeks untuk tabel `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id_equipment`);

--
-- Indeks untuk tabel `equipment_jamaah`
--
ALTER TABLE `equipment_jamaah`
  ADD PRIMARY KEY (`id_item`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indeks untuk tabel `jamaah`
--
ALTER TABLE `jamaah`
  ADD PRIMARY KEY (`nomor_id`);

--
-- Indeks untuk tabel `jamaah_cancel`
--
ALTER TABLE `jamaah_cancel`
  ADD PRIMARY KEY (`nomor_id`);

--
-- Indeks untuk tabel `jamaah_daftar`
--
ALTER TABLE `jamaah_daftar`
  ADD PRIMARY KEY (`nomor_id`);

--
-- Indeks untuk tabel `paket_umroh`
--
ALTER TABLE `paket_umroh`
  ADD PRIMARY KEY (`kd_umroh`);

--
-- Indeks untuk tabel `perlengkapan_list`
--
ALTER TABLE `perlengkapan_list`
  ADD PRIMARY KEY (`id_perlengkapan`);

--
-- Indeks untuk tabel `push_news`
--
ALTER TABLE `push_news`
  ADD PRIMARY KEY (`id_news`);

--
-- Indeks untuk tabel `tmp_equipment`
--
ALTER TABLE `tmp_equipment`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indeks untuk tabel `track_jamaah`
--
ALTER TABLE `track_jamaah`
  ADD PRIMARY KEY (`id_track`);

--
-- Indeks untuk tabel `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`travel_id`);

--
-- Indeks untuk tabel `trax_perlengkapan`
--
ALTER TABLE `trax_perlengkapan`
  ADD PRIMARY KEY (`trax_perlengkapan_id`);

--
-- Indeks untuk tabel `trax_umroh`
--
ALTER TABLE `trax_umroh`
  ADD PRIMARY KEY (`trax_umroh_id`);

--
-- Indeks untuk tabel `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indeks untuk tabel `waiting`
--
ALTER TABLE `waiting`
  ADD PRIMARY KEY (`waiting_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokumen_super`
--
ALTER TABLE `dokumen_super`
  MODIFY `id_dokumen` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id_equipment` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `equipment_jamaah`
--
ALTER TABLE `equipment_jamaah`
  MODIFY `id_item` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `no_invoice` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `paket_umroh`
--
ALTER TABLE `paket_umroh`
  MODIFY `kd_umroh` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `perlengkapan_list`
--
ALTER TABLE `perlengkapan_list`
  MODIFY `id_perlengkapan` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `push_news`
--
ALTER TABLE `push_news`
  MODIFY `id_news` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tmp_equipment`
--
ALTER TABLE `tmp_equipment`
  MODIFY `id_tmp` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `track_jamaah`
--
ALTER TABLE `track_jamaah`
  MODIFY `id_track` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `travel`
--
ALTER TABLE `travel`
  MODIFY `travel_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `upload`
--
ALTER TABLE `upload`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `waiting`
--
ALTER TABLE `waiting`
  MODIFY `waiting_id` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
