-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 10 Jun 2020 pada 07.30
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

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
-- Stand-in struktur untuk tampilan `alternatifMPE`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `alternatifMPE` (
`tgl_penilaian` date
,`nip` bigint(20)
,`nama_karyawan` varchar(30)
,`nilai_aternatif_MPE` double(20,3)
);

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
,`kriteria` varchar(15)
,`bobot` int(11)
,`nilai` int(11)
,`hasil_penilaian` double
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `nilaiMPE`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `nilaiMPE` (
`tgl_penilaian` date
,`nip` bigint(20)
,`nama_karyawan` varchar(30)
,`nilai_mpe` double
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
('102233445566778891', 'Ahmad Andrian Syah', 'd8578edf8458ce06fbc5bb76a58c5ca4', '102233445566778891.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblkaryawan`
--

CREATE TABLE `tblkaryawan` (
  `nip` bigint(20) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(25) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblkaryawan`
--

INSERT INTO `tblkaryawan` (`nip`, `nama_karyawan`, `jenis_kelamin`, `alamat`, `email`, `no_telp`) VALUES
(112233445566778899, 'Indri Nur Indraswari', 'P', 'Kebogadung RT 05 / RW 02, Kec. Jatibarang, Kab. Brebes, Jawa Tengah, Indonesia', 'indriwari@gmail.com', '083109661544'),
(123456789123456789, 'Ahmad Andrian Syah', 'L', 'Kebogadung RT 05 / RW 02, Kec. Jatibarang, Kab. Brebes, Jawa Tengah, Indonesia', 'syah.andri1406@gmail.com', '087788445012');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblkriteria`
--

CREATE TABLE `tblkriteria` (
  `kode_kriteria` varchar(7) NOT NULL,
  `kriteria` varchar(15) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblkriteria`
--

INSERT INTO `tblkriteria` (`kode_kriteria`, `kriteria`, `bobot`) VALUES
('KTR001', 'Kinerja', 5);

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
(7, '2020-06-10', 123456789123456789, 'KTR001', 'SUB001'),
(8, '2020-06-10', 112233445566778899, 'KTR001', 'SUB003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsubkriteria`
--

CREATE TABLE `tblsubkriteria` (
  `kode_kriteria` varchar(7) DEFAULT NULL,
  `kode_subkriteria` varchar(7) NOT NULL,
  `subkriteria` varchar(20) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblsubkriteria`
--

INSERT INTO `tblsubkriteria` (`kode_kriteria`, `kode_subkriteria`, `subkriteria`, `nilai`) VALUES
('KTR001', 'SUB001', 'Baik', 3),
('KTR001', 'SUB002', 'Buruk', 1),
('KTR001', 'SUB003', 'Cukup', 2);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `totalMPE`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `totalMPE` (
`tgl_penilaian` date
,`total_mpe` double
);

-- --------------------------------------------------------

--
-- Struktur untuk view `alternatifMPE`
--
DROP TABLE IF EXISTS `alternatifMPE`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alternatifMPE`  AS  select `nilaiMPE`.`tgl_penilaian` AS `tgl_penilaian`,`nilaiMPE`.`nip` AS `nip`,`nilaiMPE`.`nama_karyawan` AS `nama_karyawan`,round(`nilaiMPE`.`nilai_mpe` / `totalMPE`.`total_mpe`,3) * 100 AS `nilai_aternatif_MPE` from (`nilaiMPE` join `totalMPE` on(`nilaiMPE`.`tgl_penilaian` = `totalMPE`.`tgl_penilaian`)) group by `nilaiMPE`.`tgl_penilaian`,`nilaiMPE`.`nip` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_penilaian`
--
DROP TABLE IF EXISTS `detail_penilaian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_penilaian`  AS  select `tblpenilaian`.`id` AS `id`,`tblpenilaian`.`tgl_penilaian` AS `tgl_penilaian`,`tblpenilaian`.`nip` AS `nip`,`tblkaryawan`.`nama_karyawan` AS `nama_karyawan`,`tblkriteria`.`kriteria` AS `kriteria`,`tblkriteria`.`bobot` AS `bobot`,`tblsubkriteria`.`nilai` AS `nilai`,pow(`tblsubkriteria`.`nilai`,`tblkriteria`.`bobot`) AS `hasil_penilaian` from (((`tblpenilaian` join `tblkaryawan` on(`tblpenilaian`.`nip` = `tblkaryawan`.`nip`)) join `tblkriteria` on(`tblpenilaian`.`kode_kriteria` = `tblkriteria`.`kode_kriteria`)) join `tblsubkriteria` on(`tblpenilaian`.`kode_subkriteria` = `tblsubkriteria`.`kode_subkriteria`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `nilaiMPE`
--
DROP TABLE IF EXISTS `nilaiMPE`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nilaiMPE`  AS  select `detail_penilaian`.`tgl_penilaian` AS `tgl_penilaian`,`detail_penilaian`.`nip` AS `nip`,`detail_penilaian`.`nama_karyawan` AS `nama_karyawan`,sum(`detail_penilaian`.`hasil_penilaian`) AS `nilai_mpe` from `detail_penilaian` group by `detail_penilaian`.`tgl_penilaian`,`detail_penilaian`.`nip` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `totalMPE`
--
DROP TABLE IF EXISTS `totalMPE`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `totalMPE`  AS  select `nilaiMPE`.`tgl_penilaian` AS `tgl_penilaian`,sum(`nilaiMPE`.`nilai_mpe`) AS `total_mpe` from `nilaiMPE` group by `nilaiMPE`.`tgl_penilaian` ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tblpenilaian`
--
ALTER TABLE `tblpenilaian`
  ADD CONSTRAINT `tblpenilaian_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tblkaryawan` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblpenilaian_ibfk_2` FOREIGN KEY (`kode_kriteria`) REFERENCES `tblkriteria` (`kode_kriteria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblpenilaian_ibfk_3` FOREIGN KEY (`kode_subkriteria`) REFERENCES `tblsubkriteria` (`kode_subkriteria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tblsubkriteria`
--
ALTER TABLE `tblsubkriteria`
  ADD CONSTRAINT `kode_kriteria` FOREIGN KEY (`kode_kriteria`) REFERENCES `tblkriteria` (`kode_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
