-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2015 at 05:02 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartcity`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_date` varchar(20) NOT NULL,
  `post_id` varchar(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `comment_content` varchar(10000) NOT NULL,
  `comment_likes` int(5) NOT NULL DEFAULT '0',
  `comment_dislikes` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_date`, `post_id`, `user`, `comment_content`, `comment_likes`, `comment_dislikes`) VALUES
(1, '19 December 2015', 'TR-1', 'zuhri2395', '123', 0, 0),
(2, '19 December 2015', 'TR-1', 'zuhri2395', '1234', 0, 0),
(3, '19 December 2015', 'IC-1', 'zuhri2395', 'tes', 0, 0),
(4, '19 December 2015', 'IC-1', 'zuhri2395', 'tes12', 0, 0),
(5, '19 December 2015', 'IC-1', 'zuhri2395', 'tes123', 0, 0),
(6, '19 December 2015', 'IC-1', 'zuhri2395', 'tes1234', 0, 0),
(7, '19 December 2015', 'IC-1', 'zuhri2395', 'tes12345', 0, 0),
(8, '19 December 2015', 'IC-1', 'zuhri2395', 'abc', 0, 0),
(9, '19 December 2015', 'IC-1', 'zuhri2395', 'tyur', 0, 0),
(10, '19 December 2015', 'TR-1', 'zuhri2395', 'coba ya', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT 'user.png',
  `description` varchar(100) NOT NULL DEFAULT 'Agan ini masih malu-malu nyeritain tentang dirinya.'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`user_id`, `name`, `username`, `password`, `email`, `picture`, `description`) VALUES
(1, 'Muhammad Zuhri Hanifullah', 'zuhri2395', 'fd77dcd859284dcb1cdf57aa3f46ce45', 'zuhri2395@gmail.com', 'Bimantoro', ''),
(2, 'Bimantoro Yudhi Prasetyo', 'Bimantoro', 'f6401aeaea1e310b7bdb50d83b848efe', 'deadlybarn@live.com', 'Bimantoro', ''),
(3, 'ridlo putuismaya', 'ridlo', '1e958998622f273964fd4d0034dfcf22', 'ridlo.putu@gmail.com', 'user.png', 'Agan ini masih malu-malu nyeritain tentang dirinya.'),
(4, 'Auliedika Sukyzuh', 'sukyzuh', 'f6401aeaea1e310b7bdb50d83b848efe', 'deadlybarn8484@gmail.com', 'user.png', 'Agan ini masih malu-malu nyeritain tentang dirinya.');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` varchar(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `post_author` varchar(50) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_content` varchar(1000) NOT NULL,
  `post_category` varchar(14) NOT NULL,
  `post_type` varchar(10) NOT NULL,
  `post_tag` varchar(50) NOT NULL,
  `post_inCharge` varchar(50) NOT NULL,
  `pictures` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `date`, `post_author`, `post_title`, `post_content`, `post_category`, `post_type`, `post_tag`, `post_inCharge`, `pictures`) VALUES
('EC-1', '19 December 201', 'zuhri2395', 'Masih Ditemukan Makanan Berjamur dan Kadaluarsa di Semarang', 'Ada beberapa temuan makanan berjamur dan sudah kedaluwarsa ini ditumpuk dengan yang masih baru', 'Economy', 'Complaint', '#MakananKadaluarsa', 'Disperindag', '["EC-1-1.png","EC-1-2.jpg"]'),
('IC-1', '16 December 2015', 'Bimantoro', 'Jalur Mranggen Sering macet', 'Mohon aparat terkait untuk dapat membenahi jalur semarang mranggen yang setiap pagi dan sore hari terjadi kemacetan parah di sepanjang lampu merah pucang gading sampai dengan perbatasan mranggen macet parah....kalo perlu lampu merah di depan terminal penggaron di aktifkan lagi untuk dapat mengatur arus lalu lintasnya agar tidak terjadi saling serobot untuk jalan. terutama angkot dan taksi yang mangkal dan putar balik seenaknya di kawasan tersebut....tolong segera di tindak lanjuti. terima kasih', 'Infrastructure', 'Complaint', '#mranggenMacet', 'Dinhubkominfo', '[]'),
('IC-2', '16 December 2015', 'Bimantoro', 'Jalur Mranggen Sering macet', 'Mohon aparat terkait untuk dapat membenahi jalur semarang mranggen yang setiap pagi dan sore hari terjadi kemacetan parah di sepanjang lampu merah pucang gading sampai dengan perbatasan mranggen macet parah....kalo perlu lampu merah di depan terminal penggaron di aktifkan lagi untuk dapat mengatur arus lalu lintasnya agar tidak terjadi saling serobot untuk jalan. terutama angkot dan taksi yang mangkal dan putar balik seenaknya di kawasan tersebut....tolong segera di tindak lanjuti. terima kasih\r\n', 'Infrastructure', 'Complaint', '#mranggenMacet', 'Dinhubkominfo', '[]'),
('IC-3', '16 December 2015', 'ridlo', 'Jalan rusak parah, Dusun Ngrapah', 'Lapor Pak Gubernur, saya warga Dusun Ngrapah Desa Mlowokarangtalun Kec. Pulokulon Kab. Grobogan (dusun terpencil yang jarang terjamah pembangunan). Jalan di dusun kami rusak parah, mohon perhatian dari Pak Gubernur, mengingat Bantuan Dana Desa tahun anggaran 2015 tidak sampai di dusun kami, entah berhenti dimana kami tidak tahu.\r\n', 'Infrastructure', 'Complaint', '', 'Dinas Bina Marga (PU)', '[]'),
('SC-1', '16 December 2015', 'ridlo', 'Jalan rusak parah, Dusun Ngrapah', 'Lapor Pak Gubernur, saya warga Dusun Ngrapah Desa Mlowokarangtalun Kec. Pulokulon Kab. Grobogan (dusun terpencil yang jarang terjamah pembangunan). Jalan di dusun kami rusak parah, mohon perhatian dari Pak Gubernur, mengingat Bantuan Dana Desa tahun anggaran 2015 tidak sampai di dusun kami, entah berhenti dimana kami tidak tahu.\r\n', 'Social', 'Complaint', '', 'Dinas Bina Marga (PU)', '[]'),
('SC-2', '16 December 2015', 'ridlo', 'Pengamen Preman', 'Pak ganjar, saya mulai terancam dengan keberadaan pengamen yang ada di tembalang suka berkata kasar dan masuk kos-kosan seperti preman\r\n', 'Social', 'Complaint', '#premanPengamen', 'Satpol PP', '[]'),
('SC-3', '16 December 2015', 'bimantoro', 'Pro kontra Go Jek', 'Tolong tolak Go Jek masuk di semarang. karena adanya kasus yang sudah terjadi di kota-kota lain dengan adanya suspensi masal 10.000 pegawai Go Jek namun dari pihak Go Jek tidak sanggup memberikan transparansi terhadap mitra nya yaitu driver Go jek atas kasus yang terjadi dan justru di denda berkali kali lipat ada yang sampai 92juta loh,motor disita, surat berharga disita loh pak dan Go jek sendiri yang hanya mengantongi ijin teknologi.Jika hal ini terjadi di semarang,sangat disayangkan, mereka driver akan mengadu kemana,karena tidak ada landasan hukum yang kuat,jadi sebelum hal itu terjadi. TOLONGTOLAK GO JEK DI SEMARANG', 'Social', 'Complaint', '#gojekSemarang', 'Dinhubkominfo', '[]'),
('SC-4', '16 December 2015', 'sukyzuh', 'Galian berijin atau tidak', 'Lapor Pak Gubernur, apakah galian C di Rowosari Tembalang ada ijin, kalau sudah kenapa harus beroperasi malam hari, bukankah lebih berbahaya, kalau belum berijin tolong dicek sudah berbulan bulan beroperasi lagi dimalam hari namun tidak ada tindakan, info dari para Sopir dijadikan ATM oknum polisi dan Pemprov. Fauzi pucanggading.\r\n', 'Social', 'Complaint', '', 'Dinas ESDM', '[]'),
('SC-5', '16 December 2015', 'sukyzuh', 'Antara gemes dan kasihan', ' Antara gemes dan kasihan bila melihat anak-anak jalanan yang ada di sekitar Tugu Muda Semarang, Pak. Gemes karena seringkali disambi ngemis, tangan mereka nggrathil mau ambil barang-barang milik pengendara motor. Tapi jg kasihan, anak-anak umur segitu kok masih di jalanan malam2. Bagaimana masa depan mereka kelak? Adakah yang memperhatikan? Mohon perhatian pemerintah untuk menindaklanjuti.. sebab sudah lama hal ini dibiarkan saja. Hellooo... Di manakah pemerintah.. kok diam saja membiarkan semua itu..\r\n', 'Social', 'Complaint', '#anakjalananSemarang', 'Biro Bina Sosial', '[]'),
('TR-1', '16 December 2015', 'ridlo', 'Semarang Night Carnival', 'vent  Semarang Night Carnival merupakan acara tahunan di kota Semarang yang diadakan dalam rangka memperingati HUT kota Semarang. Karnaval yang rencananya digelar mulai pukul 19.00 ini akan diikuti 500 orang peserta. Rutenya berbeda dengan biasanya, kali ini dimulai dari Gereja Blendug, Kawasan Kota Lama â€“ Jembatan Mberog â€“ Jalan Pemuda â€“ finish di Balaikota Semarang. Karnaval akan dibagi dalam 5 defile, yaitu etnis Jawa, Arab, Cina, Belanda dan Melayu.\r\nBerbagai kostum yang menarik dan konsep acara yang berdasar perpaduan budaya etnis yang hidup rukun di Semarang, diharapkan mampu menarik wisatawan untuk datang menyaksikan Semarang Night Carnival. Jika menengok gelaran-gelaran sebelumnya, event ini sangat dinantikan dan selalu penuh dengan pengunjung yang datang. Suasana seru dan meriah selalu mewarnai karnaval ini.', 'Tourism', 'Review', '#semarangnightcarnival', 'disbudpar', '[]'),
('TR-2', '16 December 2015', 'bimantoro', 'Lawang Sewu, Icon Seamarang', '"Salah satu iconnya Semarang yg paling terkenal, pastilah Lawang Sewu. Bangunan ini konon katanya angker, dan beberapa kali pernah masuk tv untuk dibahas keseremannya. Waktu ke Semarang kemarin, tujuan utama gue pastinya adalah ke Lawang Sewu. Karena pikiran, pasti keren buat foto-foto di sana. Arsitekturnya kan jadul, and gue emang seneng yang berbau vintage vintage gitu.\r\n\r\nTiket masuk untuk dewasa adalah 10 ribu rupiah. Plus bayar guide 30 ribu (wajib), 20 ribu untuk fee guide, dan 10 ribu lagi untuk tiket masuk guide. Jadi total buat ke Lawang Sewu keluar duit 40 ribu. Awalnya gue mikir, lumayan mahal nih, berhubung gue sendiri."\r\n', 'Tourism', 'Review', '#lawangsewusemarang', 'disbudpar', '[]'),
('TR-3', '16 December 2015', 'sukyzuh', 'Vihara Budhagaya Watugong', '"diresmikan pada 2006 lalu dan dinyatakan MURI sebagai pagoda tertinggi di Indonesia. Vihara Buddhagaya Watugong terletak 45 menit dari pusat Kota Semarang. Vihara ini memiliki banyak bangunan dan berada di area yang luas.\n\nSalah satu ikon yang paling terkenal di vihara ini adalah Pagoda Avalokitesvara (Metta Karuna), dimana didalamnya terdapat Buddha Rupang yang besar. Pagoda Avalokitesvara yang memiliki tinggi bangunan setinggi 45 meter dengan 7 tingkat, yang bermakna bahwa seorang pertapa akan mencapai kesucian dalam tingkat ketujuh.\n\nBagian dalam pagoda berbentuk segi delapan dengan ukuran 15 x 15 meter. Mulai tingkat kedua hingga keenam dipasang patung Dewi Kwan Im (Dewi Welas Asih) yang menghadap empat penjuru angin. Hal ini bertujuan agar sang dewi memancarkan kasih sayangnya ke segala arah mata angin."\n', 'Tourism', 'Review', '#ViharaBudhagayaWatugong', 'disbudpar', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(11) NOT NULL,
  `idioms` varchar(500) NOT NULL,
  `author` varchar(160) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `idioms`, `author`) VALUES
(1, '"Kita memiliki banyak masalah itu bukan karena semata orang jahat banyak, tapi juga karena orang-orang baik yang ada hanya diam dan mendiamkan kejahatan yang terjadi."', 'Anies Baswedan - Menteri Pendidikan dan Kebudayaan '),
(2, 'Do your creativity to change your Society', '@ridwankamil - Mayor of West Java'),
(3, 'A great city is not to be confounded with a populous one.', 'Aristotle - Greek Philosopher'),
(4, 'A city is a place where there is no need to wait for next week to get the answer to a question, to taste the food of any country, to find new voices to listen to and familiar ones to listen to again.', 'Margaret Mead - American Anthropologist'),
(5, 'A great city is that which has the greatest men and women.', 'Walt Whitman - American Poet');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
