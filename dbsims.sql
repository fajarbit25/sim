-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 04:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsims`
--

-- --------------------------------------------------------

--
-- Table structure for table `absens`
--

CREATE TABLE `absens` (
  `idabsen` bigint(20) UNSIGNED NOT NULL,
  `kode_absen` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `siswa_id` varchar(255) NOT NULL,
  `absensi` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal_absen` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `absen_charts`
--

CREATE TABLE `absen_charts` (
  `idabsen_chart` bigint(20) UNSIGNED NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `tanggal_absen` varchar(255) NOT NULL,
  `hari_absen` varchar(255) NOT NULL,
  `izin` varchar(255) NOT NULL,
  `sakit` varchar(255) NOT NULL,
  `alfa` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absen_charts`
--

INSERT INTO `absen_charts` (`idabsen_chart`, `campus_id`, `tanggal_absen`, `hari_absen`, `izin`, `sakit`, `alfa`, `created_at`, `updated_at`) VALUES
(1, '1', '2023-11-22', 'Senin', '2', '3', '4', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(2, '1', '2023-11-22', 'Selasa', '1', '1', '2', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(3, '1', '2023-11-22', 'Rabu', '2', '5', '4', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(4, '1', '2023-11-22', 'Kamis', '3', '2', '1', '2023-11-22 07:20:09', '2023-11-22 07:20:09'),
(5, '1', '2023-11-22', 'Jumat', '4', '2', '3', '2023-11-22 07:20:09', '2023-11-22 07:20:09'),
(6, '1', '2023-11-22', 'Sabtu', '5', '3', '3', '2023-11-22 07:20:09', '2023-11-22 07:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `alamats`
--

CREATE TABLE `alamats` (
  `idalamat` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `idprovinsi` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `idkota` varchar(255) DEFAULT NULL,
  `kec` varchar(255) DEFAULT NULL,
  `idkec` varchar(255) DEFAULT NULL,
  `kel` varchar(255) DEFAULT NULL,
  `idkel` varchar(255) DEFAULT NULL,
  `rt` varchar(255) DEFAULT NULL,
  `rw` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `jalan` varchar(255) DEFAULT NULL,
  `status_tempat_tinggal` varchar(255) DEFAULT NULL,
  `moda_transportasi` varchar(255) DEFAULT NULL,
  `lintang` varchar(255) DEFAULT NULL,
  `bujur` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `idbanner` bigint(20) UNSIGNED NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `idcampus` bigint(20) UNSIGNED NOT NULL,
  `campus_name` varchar(255) NOT NULL,
  `campus_initial` varchar(255) NOT NULL,
  `campus_tingkat` varchar(255) NOT NULL,
  `campus_contact` varchar(255) NOT NULL,
  `email_campus` varchar(255) NOT NULL,
  `campus_kepsek` varchar(255) NOT NULL,
  `campus_alamat` varchar(255) NOT NULL,
  `yt` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `tele` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`idcampus`, `campus_name`, `campus_initial`, `campus_tingkat`, `campus_contact`, `email_campus`, `campus_kepsek`, `campus_alamat`, `yt`, `fb`, `ig`, `tele`, `created_at`, `updated_at`) VALUES
(1, 'Yayasan Ibnul Qayyim Makassar', 'IQIS', '0', '08000000000', 'info@iqis.sch.id', 'Ketua Yayasan', 'Kantor Yayasan Iqis Makassar', 'www.youtube.com', 'www.facebook.com', 'www.instagram.com', 't.me', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(2, 'TKIT Ibnul Qayyim Makassar', 'TKIT IQIS', '1', '082193976158', 'tkit@iqis.sch.id', 'Nama Kepala Sekolah', 'Jl. Goa Ria Taman Bunga 2 No.17B, Sudiang Raya, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90552', 'www.youtube.com', 'www.facebook.com', 'www.instagram.com', 't.me', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(3, 'SDIT Ibnul Qayyim Makassar', 'SDIT IQIS', '2', '081341311314', 'sdit@iqis.sch.id', 'Nama Kepala Sekolah', 'Jl. Taman Bunga Sudiang Kel No.2, Laikang, Biringkanaya, Makassar City, South Sulawesi 90242', 'www.youtube.com', 'www.facebook.com', 'www.instagram.com', 't.me', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(4, 'SMPIT Ibnul Qayyim Makassar', 'SMPIT IQIS', '3', '08114455432', 'smpit@iqis.sch.id', 'Nama Kepala Sekolah', 'JL. Perintis Kemerdekaan KM. 15, Komp. Manggala Junction Blok B 11, Pai, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90243', 'www.youtube.com', 'www.facebook.com', 'www.instagram.com', 't.me', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(5, 'SMKIT Ibnul Qayyim Makassar', 'SMKIT IQIS', '4', '8114411432', 'smkit@iqis.sch.id', 'Nama Kepala Sekolah', 'JL. Perintis Kemerdekaan KM. 15, Komp. Manggala Junction Blok B 11, Pai, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90243', 'www.youtube.com', 'www.facebook.com', 'www.instagram.com', 't.me', '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `confirmpayments`
--

CREATE TABLE `confirmpayments` (
  `idcp` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `confirm_status` varchar(255) NOT NULL,
  `confirm_by` varchar(255) DEFAULT NULL,
  `evidence` varchar(255) NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `iddocs` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `akta_lahir` varchar(255) DEFAULT NULL,
  `ktp` varchar(255) DEFAULT NULL,
  `kk` varchar(255) DEFAULT NULL,
  `ijazah` varchar(255) DEFAULT NULL,
  `transkrip_nilai` varchar(255) DEFAULT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `ktp_ortu` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formulirinformations`
--

CREATE TABLE `formulirinformations` (
  `idformulir` bigint(20) UNSIGNED NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `pesan` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formulirinformations`
--

INSERT INTO `formulirinformations` (`idformulir`, `campus_id`, `pesan`, `created_at`, `updated_at`) VALUES
(1, '5', 'Isi Pesan SMKIT', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(2, '4', 'Isi Pesan SMPIT', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(3, '3', 'Isi Pesan SDIT', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(4, '2', 'Isi Pesan TKIT', '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `idiv` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `jenis_transaksi` varchar(255) NOT NULL,
  `tipe_transaksi` varchar(255) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `nomor_invoice` varchar(255) NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `invoice_status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenjangs`
--

CREATE TABLE `jenjangs` (
  `idjenjang` bigint(20) UNSIGNED NOT NULL,
  `jenjang_pendidikan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenjangs`
--

INSERT INTO `jenjangs` (`idjenjang`, `jenjang_pendidikan`, `created_at`, `updated_at`) VALUES
(1, 'TK', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(2, 'SD', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(3, 'SMP', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(4, 'SMA', '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `kesejahterans`
--

CREATE TABLE `kesejahterans` (
  `idks` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `nomor_kartu` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `idlevel` bigint(20) UNSIGNED NOT NULL,
  `kode_level` varchar(255) NOT NULL,
  `nama_level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`idlevel`, `kode_level`, `nama_level`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Administrator', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(2, 'Guru', 'Guru', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(3, 'Staf', 'Staff', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(4, 'User', 'Siswa/Orang Tua', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(5, 'Finance', 'Bendahara', '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `mapels`
--

CREATE TABLE `mapels` (
  `idmapel` bigint(20) UNSIGNED NOT NULL,
  `kode_mapel` varchar(255) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `mapel_campus` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_08_100000_create_telescope_entries_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_02_151734_create_news_table', 1),
(7, '2023_09_03_161907_create_rooms_table', 1),
(8, '2023_09_10_100834_create_levels_table', 1),
(9, '2023_09_17_115400_create_students_table', 1),
(10, '2023_09_18_110316_create_mapels_table', 1),
(11, '2023_09_18_111013_create_nilais_table', 1),
(12, '2023_09_27_170921_create_absens_table', 1),
(13, '2023_09_28_155546_create_semesters_table', 1),
(14, '2023_10_03_131518_create_scores_table', 1),
(15, '2023_10_07_160309_create_campus_table', 1),
(16, '2023_10_10_154301_create_jenjangs_table', 1),
(17, '2023_10_21_180028_create_absen_charts_table', 1),
(18, '2023_10_22_173800_create_banners_table', 1),
(19, '2023_10_28_052104_create_documents_table', 1),
(20, '2023_10_30_160057_create_special_needs_table', 1),
(21, '2023_11_02_101042_create_alamats_table', 1),
(22, '2023_11_03_112259_create_walis_table', 1),
(23, '2023_11_04_061637_create_priodiks_table', 1),
(24, '2023_11_04_112027_create_prestasis_table', 1),
(25, '2023_11_04_112613_create_scholarships_table', 1),
(26, '2023_11_04_112902_create_kesejahterans_table', 1),
(27, '2023_11_06_080554_create_registers_table', 1),
(28, '2023_11_08_051948_create_ppdbs_table', 1),
(29, '2023_11_11_042447_create_invoices_table', 1),
(30, '2023_11_11_045841_create_confirmpayments_table', 1),
(31, '2023_11_15_054602_create_teachers_table', 1),
(32, '2023_11_19_161901_create_mutations_table', 1),
(33, '2023_11_19_164944_create_tipetransactions_table', 1),
(34, '2023_11_21_090344_create_teams_table', 1),
(35, '2023_11_22_044300_create_formulirinformations_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mutations`
--

CREATE TABLE `mutations` (
  `idmt` bigint(20) UNSIGNED NOT NULL,
  `inv_id` varchar(255) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `saldo_awal` varchar(255) NOT NULL,
  `saldo_akhir` varchar(255) NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `trx_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mutations`
--

INSERT INTO `mutations` (`idmt`, `inv_id`, `nominal`, `saldo_awal`, `saldo_akhir`, `campus_id`, `trx_by`, `created_at`, `updated_at`) VALUES
(1, '10001', '0', '0', '0', '5', '1', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(2, '10002', '0', '0', '0', '4', '1', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(3, '10002', '0', '0', '0', '3', '1', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(4, '10002', '0', '0', '0', '2', '1', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(5, '10002', '0', '0', '0', '1', '1', '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `idnews` bigint(20) UNSIGNED NOT NULL,
  `poster` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `berita` longtext NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `posted` varchar(255) NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilais`
--

CREATE TABLE `nilais` (
  `idnilai` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) NOT NULL,
  `mapel_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppdbs`
--

CREATE TABLE `ppdbs` (
  `idppdb` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `nomor_pendaftaran` varchar(255) NOT NULL,
  `nomor_formulir` varchar(255) NOT NULL,
  `lokasi_pendaftaran` varchar(255) NOT NULL,
  `jalur` varchar(255) NOT NULL,
  `jenjang` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prestasis`
--

CREATE TABLE `prestasis` (
  `idprestasi` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `nama_prestasi` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `tingkat` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priodiks`
--

CREATE TABLE `priodiks` (
  `idpriodik` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `tinggi` varchar(255) DEFAULT NULL,
  `berat` varchar(255) DEFAULT NULL,
  `lingkar_kepala` varchar(255) DEFAULT NULL,
  `jarak_per_1km` varchar(255) DEFAULT NULL,
  `jarak` varchar(255) DEFAULT NULL,
  `jam` varchar(255) DEFAULT NULL,
  `menit` varchar(255) DEFAULT NULL,
  `saudara` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `idrg` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `kompetensi` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `tanggal_masuk` varchar(255) DEFAULT NULL,
  `sekolah_asal` varchar(255) DEFAULT NULL,
  `nomor_ujian` varchar(255) DEFAULT NULL,
  `nomor_ijazah` varchar(255) DEFAULT NULL,
  `nomor_skhu` varchar(255) DEFAULT NULL,
  `bahasa_indonesia` varchar(255) DEFAULT NULL,
  `matematika` varchar(255) DEFAULT NULL,
  `ipa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `idkelas` bigint(20) UNSIGNED NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `wali_kelas` varchar(255) NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `idss` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `tahun_mulai` varchar(255) NOT NULL,
  `tahun_selesai` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `idscore` bigint(20) UNSIGNED NOT NULL,
  `kode_score` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `siswa_id` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `tanggal_penilaian` varchar(255) NOT NULL,
  `bulan_penilaian` varchar(255) NOT NULL,
  `grouping` varchar(255) NOT NULL,
  `tag_lock` varchar(255) NOT NULL,
  `tag_final` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `idsm` bigint(20) UNSIGNED NOT NULL,
  `semester_kode` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`idsm`, `semester_kode`, `tahun_ajaran`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '1', '2022-2023', 'false', '2023-11-22 07:20:08', '2023-11-22 07:20:08'),
(2, '2', '2023-2024', 'true', '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `special_needs`
--

CREATE TABLE `special_needs` (
  `idsn` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `segment` varchar(255) NOT NULL,
  `special_needs` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `idstudents` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `kk` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` varchar(255) DEFAULT NULL,
  `akta_lahir` varchar(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `kewarganegaraan` varchar(255) DEFAULT NULL,
  `negara` varchar(255) DEFAULT NULL,
  `anak_ke` varchar(255) DEFAULT NULL,
  `pekerjaan_pelajar` varchar(255) DEFAULT NULL,
  `kip` varchar(255) DEFAULT NULL,
  `need_kip` varchar(255) DEFAULT NULL,
  `nook_pip` varchar(255) DEFAULT NULL,
  `public_token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `idtc` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` varchar(255) DEFAULT NULL,
  `ibu_kandung` varchar(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`idtc`, `user_id`, `nip`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `ibu_kandung`, `agama`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'Laki-laki', NULL, NULL, NULL, NULL, '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `idteam` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `linked` varchar(255) NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries`
--

CREATE TABLE `telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `batch_id` char(36) NOT NULL,
  `family_hash` varchar(255) DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `telescope_entries`
--

INSERT INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) VALUES
(1, '9aacba2f-ff69-45fc-b378-34670d9e976e', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `news` where `posted` = 1\",\"time\":\"9.06\",\"slow\":false,\"file\":\"D:\\\\apps\\\\sims\\\\app\\\\Http\\\\Controllers\\\\HomeController.php\",\"line\":27,\"hash\":\"277b3a7070458b28c1b9e82bf985b3ae\",\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(2, '9aacba30-0bb7-4d02-af78-0bc18424e967', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `banners` where `campus_id` = 1\",\"time\":\"1.36\",\"slow\":false,\"file\":\"D:\\\\apps\\\\sims\\\\app\\\\Http\\\\Controllers\\\\HomeController.php\",\"line\":28,\"hash\":\"5b641459b4fdeccd524e8e2e226e5c27\",\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(3, '9aacba30-0c5a-4439-b7f4-90e8a36b7758', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `campus` where `idcampus` = 1 limit 1\",\"time\":\"0.46\",\"slow\":false,\"file\":\"D:\\\\apps\\\\sims\\\\app\\\\Http\\\\Controllers\\\\HomeController.php\",\"line\":29,\"hash\":\"0f0f2dbe4bb7b66520aed0391edd41fc\",\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(4, '9aacba30-0c87-499f-a671-eb41ea15e638', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"App\\\\Models\\\\Campu\",\"count\":1,\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(5, '9aacba30-0ccc-411c-8d6b-e0007c3ac31d', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select count(*) as aggregate from `campus`\",\"time\":\"0.28\",\"slow\":false,\"file\":\"D:\\\\apps\\\\sims\\\\app\\\\Http\\\\Controllers\\\\HomeController.php\",\"line\":30,\"hash\":\"a806d227cb92d0b8a99f67efe98a5307\",\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(6, '9aacba30-0de9-45c7-a635-3de7130aeee2', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select count(*) as aggregate from `users` where `status` = 1 and `level` = 1\",\"time\":\"0.38\",\"slow\":false,\"file\":\"D:\\\\apps\\\\sims\\\\app\\\\Http\\\\Controllers\\\\HomeController.php\",\"line\":31,\"hash\":\"23114c66068d7f9b990ee7108a1146ab\",\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(7, '9aacba30-0e40-4e16-8399-87cb67d94987', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select count(*) as aggregate from `users` where `status` = 1 and `level` < 4\",\"time\":\"0.36\",\"slow\":false,\"file\":\"D:\\\\apps\\\\sims\\\\app\\\\Http\\\\Controllers\\\\HomeController.php\",\"line\":32,\"hash\":\"bef1f29ab27fd64b46d0d547ef6e882b\",\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(8, '9aacba30-0ee2-4ed8-b7bd-89275bacbd99', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `teams` where `campus_id` = 0\",\"time\":\"0.77\",\"slow\":false,\"file\":\"D:\\\\apps\\\\sims\\\\app\\\\Http\\\\Controllers\\\\HomeController.php\",\"line\":33,\"hash\":\"180d5ba1d5c9bbf4c67e74548872ba74\",\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(9, '9aacba30-12f5-43ba-bf02-e917a61bf1e2', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'view', '{\"name\":\"welcome\",\"path\":\"\\\\resources\\\\views\\/welcome.blade.php\",\"data\":[\"title\",\"news\",\"banner\",\"contact\",\"count_campus\",\"count_siswa\",\"count_guru\",\"team\"],\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(10, '9aacba30-13db-4660-94fc-3d0eaf6c1ccf', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'view', '{\"name\":\"template.layoutHome\",\"path\":\"\\\\resources\\\\views\\/template\\/layoutHome.blade.php\",\"data\":[\"title\",\"news\",\"banner\",\"contact\",\"count_campus\",\"count_siswa\",\"count_guru\",\"team\",\"__currentLoopData\",\"loop\"],\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27'),
(11, '9aacba30-46a6-4c6d-83a6-68c5820a6a6b', '9aacba30-47e4-4bf1-b768-015bce7c9d56', NULL, 1, 'request', '{\"ip_address\":\"127.0.0.1\",\"uri\":\"\\/\",\"method\":\"GET\",\"controller_action\":\"App\\\\Http\\\\Controllers\\\\HomeController@index\",\"middleware\":[\"web\"],\"headers\":{\"host\":\"127.0.0.1:8000\",\"user-agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko\\/20100101 Firefox\\/119.0\",\"accept\":\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,*\\/*;q=0.8\",\"accept-language\":\"en-US,en;q=0.5\",\"accept-encoding\":\"gzip, deflate, br\",\"referer\":\"http:\\/\\/127.0.0.1:8000\\/dashboard\",\"connection\":\"keep-alive\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6IlpCT09Wcys4YklCNjVxcTYydGM5SlE9PSIsInZhbHVlIjoiK0YrN1F4N2RBUHovcTBsRy9ieERBcGw1WnAyZThYZTVvMnpTNm0zSHRhTTRackhVOGtwMFBvbkgwd0xLUmVsRitQWjlaQ0x2bWlYTjFFMmVLREk3THpJZzRRTG1ZSFJFY1Y2bkg5ckF2N0Rnd1h6WVJ1TXIvNW9mem5TYjBybjEiLCJtYWMiOiJhNDBlMmVjYmRmOWNlNmVkNWFjNjI0ZjEyNjBhYjM2NjQ3OWU2NTAzMTc4MDAyYTEwY2IxNTI5OTgxZjgyYzM5IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjJ4Z0lwWWJqM3FTWDZMcTRiMGROdWc9PSIsInZhbHVlIjoiWE1BWmFIYnExMENFcEU1STlpYjN1OVY5V1E5b0h5dmRVL2I0YlVwb2Vpc0ZaWDVjOXc4cVJVbG0xdlR1KzJjMGlGUFpIdnFaaXFISEN6U014R3BTRXFlL3QzNDBWZVRXNERRbkYrU2hyOFpCME1LNk1udERRZzlIQTJGNWhwOGEiLCJtYWMiOiI2OTM4MDUyYmQyOGVhMzc1OTYzZWZmNzRiYTc3ZTQxYTc5NmU4ZjAzN2NiZGRiMDllMTA4ZDkxOGI5OTBhMDUxIiwidGFnIjoiIn0%3D\",\"upgrade-insecure-requests\":\"1\",\"sec-fetch-dest\":\"document\",\"sec-fetch-mode\":\"navigate\",\"sec-fetch-site\":\"same-origin\",\"sec-fetch-user\":\"?1\"},\"payload\":[],\"session\":{\"_token\":\"G5p0lhKt29TV6MymHhnW8XFXXkmykpllhqehqMbx\",\"_previous\":{\"url\":\"http:\\/\\/127.0.0.1:8000\"},\"_flash\":{\"old\":[],\"new\":[]}},\"response_status\":200,\"response\":{\"view\":\"D:\\\\apps\\\\sims\\\\resources\\\\views\\/welcome.blade.php\",\"data\":{\"title\":\"Ibnu Qayyim Islamic School\",\"news\":{\"class\":\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\",\"properties\":[]},\"banner\":{\"class\":\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\",\"properties\":[]},\"contact\":\"App\\\\Models\\\\Campu:\",\"count_campus\":5,\"count_siswa\":0,\"count_guru\":1,\"team\":{\"class\":\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\",\"properties\":[]}}},\"duration\":640,\"memory\":24,\"hostname\":\"WIN-1FDPI6Q1GNL\"}', '2023-11-22 15:21:27');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries_tags`
--

CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `telescope_entries_tags`
--

INSERT INTO `telescope_entries_tags` (`entry_uuid`, `tag`) VALUES
('9aacba30-0c87-499f-a671-eb41ea15e638', 'App\\Models\\Campu');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_monitoring`
--

CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipetransactions`
--

CREATE TABLE `tipetransactions` (
  `idtt` bigint(20) UNSIGNED NOT NULL,
  `campus_id` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipetransactions`
--

INSERT INTO `tipetransactions` (`idtt`, `campus_id`, `tipe`, `created_at`, `updated_at`) VALUES
(1, '0', 'PPDB', '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `campus_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `kelas` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `level`, `status`, `phone`, `telephone`, `photo`, `campus_id`, `email_verified_at`, `kelas`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'sa@iqis.sch.id', '0', '1', '0895330078690', NULL, 'user.png', '0', '2023-09-01 16:00:00', '0', '$2y$10$4pynHtr20RIyoawMQ69UHOFaiB9JKn0eraYxgZxKNVzPg3C9OeGdS', NULL, '2023-11-22 07:20:08', '2023-11-22 07:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `walis`
--

CREATE TABLE `walis` (
  `idwali` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `segment` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `tahun_lahir` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `penghasilan` varchar(255) DEFAULT NULL,
  `keb_khusus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absens`
--
ALTER TABLE `absens`
  ADD PRIMARY KEY (`idabsen`);

--
-- Indexes for table `absen_charts`
--
ALTER TABLE `absen_charts`
  ADD PRIMARY KEY (`idabsen_chart`);

--
-- Indexes for table `alamats`
--
ALTER TABLE `alamats`
  ADD PRIMARY KEY (`idalamat`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`idbanner`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`idcampus`);

--
-- Indexes for table `confirmpayments`
--
ALTER TABLE `confirmpayments`
  ADD PRIMARY KEY (`idcp`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`iddocs`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `formulirinformations`
--
ALTER TABLE `formulirinformations`
  ADD PRIMARY KEY (`idformulir`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`idiv`);

--
-- Indexes for table `jenjangs`
--
ALTER TABLE `jenjangs`
  ADD PRIMARY KEY (`idjenjang`);

--
-- Indexes for table `kesejahterans`
--
ALTER TABLE `kesejahterans`
  ADD PRIMARY KEY (`idks`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`idlevel`);

--
-- Indexes for table `mapels`
--
ALTER TABLE `mapels`
  ADD PRIMARY KEY (`idmapel`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutations`
--
ALTER TABLE `mutations`
  ADD PRIMARY KEY (`idmt`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`idnews`);

--
-- Indexes for table `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`idnilai`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ppdbs`
--
ALTER TABLE `ppdbs`
  ADD PRIMARY KEY (`idppdb`);

--
-- Indexes for table `prestasis`
--
ALTER TABLE `prestasis`
  ADD PRIMARY KEY (`idprestasi`);

--
-- Indexes for table `priodiks`
--
ALTER TABLE `priodiks`
  ADD PRIMARY KEY (`idpriodik`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`idrg`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`idkelas`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`idss`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`idscore`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`idsm`);

--
-- Indexes for table `special_needs`
--
ALTER TABLE `special_needs`
  ADD PRIMARY KEY (`idsn`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`idstudents`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`idtc`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`idteam`);

--
-- Indexes for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `telescope_entries_created_at_index` (`created_at`),
  ADD KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`);

--
-- Indexes for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `tipetransactions`
--
ALTER TABLE `tipetransactions`
  ADD PRIMARY KEY (`idtt`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `walis`
--
ALTER TABLE `walis`
  ADD PRIMARY KEY (`idwali`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absens`
--
ALTER TABLE `absens`
  MODIFY `idabsen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `absen_charts`
--
ALTER TABLE `absen_charts`
  MODIFY `idabsen_chart` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `alamats`
--
ALTER TABLE `alamats`
  MODIFY `idalamat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `idbanner` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `idcampus` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `confirmpayments`
--
ALTER TABLE `confirmpayments`
  MODIFY `idcp` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `iddocs` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formulirinformations`
--
ALTER TABLE `formulirinformations`
  MODIFY `idformulir` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `idiv` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenjangs`
--
ALTER TABLE `jenjangs`
  MODIFY `idjenjang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kesejahterans`
--
ALTER TABLE `kesejahterans`
  MODIFY `idks` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `idlevel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mapels`
--
ALTER TABLE `mapels`
  MODIFY `idmapel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `mutations`
--
ALTER TABLE `mutations`
  MODIFY `idmt` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `idnews` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilais`
--
ALTER TABLE `nilais`
  MODIFY `idnilai` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppdbs`
--
ALTER TABLE `ppdbs`
  MODIFY `idppdb` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prestasis`
--
ALTER TABLE `prestasis`
  MODIFY `idprestasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priodiks`
--
ALTER TABLE `priodiks`
  MODIFY `idpriodik` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `idrg` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `idkelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `idss` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `idscore` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `idsm` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `special_needs`
--
ALTER TABLE `special_needs`
  MODIFY `idsn` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `idstudents` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `idtc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `idteam` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  MODIFY `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tipetransactions`
--
ALTER TABLE `tipetransactions`
  MODIFY `idtt` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `walis`
--
ALTER TABLE `walis`
  MODIFY `idwali` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
