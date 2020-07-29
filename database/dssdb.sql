-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2020 pada 13.34
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6
-- Tinggal import

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dssdb`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_penilaian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_penilaian` (
`id` int(11)
,`tgl_penilaian` date
,`nip` bigint(20)
,`nama_karyawan` varchar(30)
,`kriteria` varchar(30)
,`bobot` int(11)
,`subkriteria` varchar(30)
,`nilai` int(11)
,`hasil_penilaian` double
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `nilaimpe`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `nilaimpe` (
`tgl_penilaian` date
,`nip` bigint(20)
,`nama_karyawan` varchar(30)
,`nilai_mpe` double
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `nilai_alternatifmpe`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `nilai_alternatifmpe` (
`tgl_penilaian` date
,`nip` bigint(20)
,`nama_karyawan` varchar(30)
,`nilai_alternatif_MPE` double(20,3)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbladmin`
--

CREATE TABLE `tbladmin` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbladmin`
--

INSERT INTO `tbladmin` (`nip`, `nama`, `pass`, `foto`) VALUES
('102233445566778890', 'Abi Firmansyah', 'e10adc3949ba59abbe56e057f20f883e', '102233445566778890.png'),
('102233445566778891', 'Ahmad Andrian Syah', 'd8578edf8458ce06fbc5bb76a58c5ca4', '102233445566778891.png'),
('123456789', 'administrator', '21232f297a57a5a743894a0e4a801fc3', '123456789.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblkaryawan`
--

CREATE TABLE `tblkaryawan` (
  `nip` bigint(20) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblkaryawan`
--

INSERT INTO `tblkaryawan` (`nip`, `nama_karyawan`, `jenis_kelamin`, `alamat`, `email`, `no_telp`) VALUES
(343543244167107, 'Qori Uyainah', 'P', 'Psr. Aceh No. 817, Sukabumi 73917, NTB', 'sadina75@yahoo.co.id', '+627939970408'),
(2472442705931151, 'Ina Kusmawati', 'P', 'Kpg. Kali No. 890, Palu 69739, Papua', 'zusada@gmail.com', '02684971744'),
(4485768968466969, 'Rika Yessi Astuti S.IP', 'P', 'Ds. Teuku Umar No. 478, Bengkulu 52329, Gorontalo', 'qwacana@suryono.id', '+629973931478'),
(5236051435906191, 'Satya Damu Nainggolan', 'L', 'Dk. Gajah No. 636, Jambi 28850, SulBar', 'vicky79@yahoo.com', '08445950735'),
(5290202532927555, 'Eli Mardhiyah M.Kom.', 'P', 'Jln. Cikutra Barat No. 344, Surakarta 21548, SumUt', 'lukita90@prasasta.net', '+622325614919');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblkriteria`
--

CREATE TABLE `tblkriteria` (
  `kode_kriteria` varchar(7) NOT NULL,
  `kriteria` varchar(30) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblkriteria`
--

INSERT INTO `tblkriteria` (`kode_kriteria`, `kriteria`, `bobot`) VALUES
('KTR001', 'Pendidikan', 3),
('KTR002', 'Disiplin', 3),
('KTR003', 'Target Pencapaian Hasil', 5),
('KTR004', 'Kerjasama', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblpenilaian`
--

CREATE TABLE `tblpenilaian` (
  `id` int(11) NOT NULL,
  `tgl_penilaian` date DEFAULT NULL,
  `nip` bigint(20) DEFAULT NULL,
  `kode_kriteria` varchar(7) DEFAULT NULL,
  `kode_subkriteria` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblpenilaian`
--

INSERT INTO `tblpenilaian` (`id`, `tgl_penilaian`, `nip`, `kode_kriteria`, `kode_subkriteria`) VALUES
(49, '2020-06-26', 343543244167107, 'KTR001', 'SUB003'),
(50, '2020-06-26', 343543244167107, 'KTR002', 'SUB009'),
(51, '2020-06-26', 343543244167107, 'KTR003', 'SUB013'),
(52, '2020-06-26', 343543244167107, 'KTR004', 'SUB018'),
(53, '2020-06-26', 2472442705931151, 'KTR001', 'SUB002'),
(54, '2020-06-26', 2472442705931151, 'KTR002', 'SUB009'),
(55, '2020-06-26', 2472442705931151, 'KTR003', 'SUB014'),
(56, '2020-06-26', 2472442705931151, 'KTR004', 'SUB019'),
(57, '2020-06-26', 4485768968466969, 'KTR001', 'SUB003'),
(58, '2020-06-26', 4485768968466969, 'KTR002', 'SUB008'),
(59, '2020-06-26', 4485768968466969, 'KTR003', 'SUB014'),
(60, '2020-06-26', 4485768968466969, 'KTR004', 'SUB019'),
(61, '2020-06-26', 5236051435906191, 'KTR001', 'SUB001'),
(62, '2020-06-26', 5236051435906191, 'KTR002', 'SUB008'),
(63, '2020-06-26', 5236051435906191, 'KTR003', 'SUB013'),
(64, '2020-06-26', 5236051435906191, 'KTR004', 'SUB018'),
(65, '2020-06-26', 5290202532927555, 'KTR001', 'SUB004'),
(66, '2020-06-26', 5290202532927555, 'KTR002', 'SUB008'),
(67, '2020-06-26', 5290202532927555, 'KTR003', 'SUB013'),
(68, '2020-06-26', 5290202532927555, 'KTR004', 'SUB018');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsubkriteria`
--

CREATE TABLE `tblsubkriteria` (
  `kode_kriteria` varchar(7) DEFAULT NULL,
  `kode_subkriteria` varchar(7) NOT NULL,
  `subkriteria` varchar(30) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblsubkriteria`
--

INSERT INTO `tblsubkriteria` (`kode_kriteria`, `kode_subkriteria`, `subkriteria`, `nilai`) VALUES
('KTR001', 'SUB001', 'SMA/SMK', 1),
('KTR001', 'SUB002', 'D3', 2),
('KTR001', 'SUB003', 'S1', 3),
('KTR001', 'SUB004', 'S2', 4),
('KTR002', 'SUB005', '0-7 hari', 1),
('KTR002', 'SUB006', '8-14 hari', 2),
('KTR002', 'SUB007', '14-21 hari', 3),
('KTR002', 'SUB008', '22-26 hari', 4),
('KTR002', 'SUB009', '>26 hari', 5),
('KTR003', 'SUB010', '0-20%', 1),
('KTR003', 'SUB011', '21-40%', 2),
('KTR003', 'SUB012', '41-60%', 3),
('KTR003', 'SUB013', '61-80%', 4),
('KTR003', 'SUB014', '81-100%', 5),
('KTR004', 'SUB015', 'Sangat Kurang', 1),
('KTR004', 'SUB016', 'Kurang', 2),
('KTR004', 'SUB017', 'Cukup', 3),
('KTR004', 'SUB018', 'Baik', 4),
('KTR004', 'SUB019', 'Sangat Baik', 5);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `totalmpe`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `totalmpe` (
`tgl_penilaian` date
,`total_mpe` double
);

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_penilaian`
--
DROP TABLE IF EXISTS `detail_penilaian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_penilaian`  AS  select `tblpenilaian`.`id` AS `id`,`tblpenilaian`.`tgl_penilaian` AS `tgl_penilaian`,`tblpenilaian`.`nip` AS `nip`,`tblkaryawan`.`nama_karyawan` AS `nama_karyawan`,`tblkriteria`.`kriteria` AS `kriteria`,`tblkriteria`.`bobot` AS `bobot`,`tblsubkriteria`.`subkriteria` AS `subkriteria`,`tblsubkriteria`.`nilai` AS `nilai`,pow(`tblsubkriteria`.`nilai`,`tblkriteria`.`bobot`) AS `hasil_penilaian` from (((`tblpenilaian` join `tblkaryawan` on(`tblpenilaian`.`nip` = `tblkaryawan`.`nip`)) join `tblkriteria` on(`tblpenilaian`.`kode_kriteria` = `tblkriteria`.`kode_kriteria`)) join `tblsubkriteria` on(`tblpenilaian`.`kode_subkriteria` = `tblsubkriteria`.`kode_subkriteria`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `nilaimpe`
--
DROP TABLE IF EXISTS `nilaimpe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nilaimpe`  AS  select `detail_penilaian`.`tgl_penilaian` AS `tgl_penilaian`,`detail_penilaian`.`nip` AS `nip`,`detail_penilaian`.`nama_karyawan` AS `nama_karyawan`,sum(`detail_penilaian`.`hasil_penilaian`) AS `nilai_mpe` from `detail_penilaian` group by `detail_penilaian`.`tgl_penilaian`,`detail_penilaian`.`nip` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `nilai_alternatifmpe`
--
DROP TABLE IF EXISTS `nilai_alternatifmpe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nilai_alternatifmpe`  AS  select `nilaimpe`.`tgl_penilaian` AS `tgl_penilaian`,`nilaimpe`.`nip` AS `nip`,`nilaimpe`.`nama_karyawan` AS `nama_karyawan`,round(`nilaimpe`.`nilai_mpe` / `totalmpe`.`total_mpe`,3) AS `nilai_alternatif_MPE` from (`nilaimpe` join `totalmpe` on(`nilaimpe`.`tgl_penilaian` = `totalmpe`.`tgl_penilaian`)) group by `nilaimpe`.`tgl_penilaian`,`nilaimpe`.`nip` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `totalmpe`
--
DROP TABLE IF EXISTS `totalmpe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `totalmpe`  AS  select `nilaimpe`.`tgl_penilaian` AS `tgl_penilaian`,sum(`nilaimpe`.`nilai_mpe`) AS `total_mpe` from `nilaimpe` group by `nilaimpe`.`tgl_penilaian` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indeks untuk tabel `tblkaryawan`
--
ALTER TABLE `tblkaryawan`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `nip` (`nip`,`email`);

--
-- Indeks untuk tabel `tblkriteria`
--
ALTER TABLE `tblkriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indeks untuk tabel `tblpenilaian`
--
ALTER TABLE `tblpenilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblpenilaian_ibfk_1` (`nip`),
  ADD KEY `tblpenilaian_ibfk_2` (`kode_kriteria`),
  ADD KEY `tblpenilaian_ibfk_3` (`kode_subkriteria`);

--
-- Indeks untuk tabel `tblsubkriteria`
--
ALTER TABLE `tblsubkriteria`
  ADD PRIMARY KEY (`kode_subkriteria`),
  ADD KEY `kode_kriteria` (`kode_kriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tblpenilaian`
--
ALTER TABLE `tblpenilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tblpenilaian`
--
ALTER TABLE `tblpenilaian`
  ADD CONSTRAINT `fk_kriteria` FOREIGN KEY (`kode_kriteria`) REFERENCES `tblkriteria` (`kode_kriteria`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nip` FOREIGN KEY (`nip`) REFERENCES `tblkaryawan` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sub` FOREIGN KEY (`kode_subkriteria`) REFERENCES `tblsubkriteria` (`kode_subkriteria`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tblsubkriteria`
--
ALTER TABLE `tblsubkriteria`
  ADD CONSTRAINT `kode_kriteria` FOREIGN KEY (`kode_kriteria`) REFERENCES `tblkriteria` (`kode_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
