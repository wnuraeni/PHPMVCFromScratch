-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2013 at 10:51 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tesonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'YWRtaW4=');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `NIP` varchar(10) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`NIP`, `nama_lengkap`, `email`, `password`) VALUES
('1111', 'dosen1', 'dosen1@gmail.com', 'MTExMQ=='),
('1234', 'dosen', 'dosen@gmail.com', 'MTIzNA=='),
('5555', 'tika', 'wulantika@gmail.com', 'c27cd12c8034c739304c22a3a3748e39');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_tes`
--

CREATE TABLE IF NOT EXISTS `hasil_tes` (
  `id_hasil` int(20) NOT NULL AUTO_INCREMENT,
  `NIM` varchar(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `poin` int(10) NOT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `hasil_tes`
--

INSERT INTO `hasil_tes` (`id_hasil`, `NIM`, `nama_kategori`, `poin`) VALUES
(99, '1234', 'B.Ing1', 0),
(100, '1234', 'quiz', 0),
(101, '1234', 'PHP', 20),
(102, '1234', 'kate4', 20),
(103, '', 'quiz', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_tes`
--

CREATE TABLE IF NOT EXISTS `kategori_tes` (
  `id_kategori` int(10) NOT NULL AUTO_INCREMENT,
  `nama_matkul` varchar(50) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  `tanggal_tes` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_tes` int(4) NOT NULL,
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `nama_kategori` (`nama_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `kategori_tes`
--

INSERT INTO `kategori_tes` (`id_kategori`, `nama_matkul`, `nama_kategori`, `tanggal_tes`, `waktu_mulai`, `waktu_tes`) VALUES
(12, 'mk1', 'kate1', '1970-01-01', '10:00:00', 50),
(17, 'mk2', 'kate2', '2012-10-10', '08:45:00', 100),
(18, 'mk3', 'kate3', '2012-04-01', '09:30:00', 50),
(19, 'mk4', 'kate4', '2012-06-27', '22:00:00', 120),
(20, 'mk4', 'kate5', '2012-12-20', '09:30:00', 50),
(21, 'Nihongo', 'chuukan', '2012-04-22', '13:00:00', 50),
(22, 'WebProgramming', 'PHP', '2012-06-27', '22:00:00', 50),
(23, 'Bahasa Inggris', 'B.Ing1', '2012-06-27', '22:00:00', 120),
(24, 'J2ME', 'quiz', '2012-06-14', '14:20:00', 98),
(25, '2012-12-12', 'quiz1', '0000-00-00', '09:30:00', 50);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `NIM` varchar(10) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`NIM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `nama_lengkap`, `email`, `password`) VALUES
('1234', 'tika', 'wulantika@gmail.com', 'MTIzNA=='),
('5555', 'tika', 'wulantika@gmail.com', 'MTIzNA==');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `id_mk` int(10) NOT NULL AUTO_INCREMENT,
  `nama_mk` varchar(20) NOT NULL,
  `id_dosen` varchar(10) NOT NULL,
  PRIMARY KEY (`id_mk`),
  UNIQUE KEY `nama_mk` (`nama_mk`),
  UNIQUE KEY `nama_mk_2` (`nama_mk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id_mk`, `nama_mk`, `id_dosen`) VALUES
(40, 'mk1', '1234'),
(45, 'mk2', '5555'),
(46, 'mk3', '5555'),
(47, 'mk4', '1234'),
(48, 'Nihongo', '1234'),
(49, 'WebProgramming', '1234'),
(50, 'Bahasa Inggris', '1234'),
(51, 'J2ME', '1234'),
(52, 'Bahasa Indonesia', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `soal_tes`
--

CREATE TABLE IF NOT EXISTS `soal_tes` (
  `id_soal` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `soal` varchar(250) NOT NULL,
  `pilihan1` varchar(250) NOT NULL,
  `pilihan2` varchar(250) NOT NULL,
  `pilihan3` varchar(250) NOT NULL,
  `pilihan4` varchar(250) NOT NULL,
  `pilihan5` varchar(250) NOT NULL,
  `kunci_jawaban` varchar(100) NOT NULL,
  `poin` int(5) NOT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `soal_tes`
--

INSERT INTO `soal_tes` (`id_soal`, `nama_kategori`, `deskripsi`, `soal`, `pilihan1`, `pilihan2`, `pilihan3`, `pilihan4`, `pilihan5`, `kunci_jawaban`, `poin`) VALUES
(1, 'kate1', 'Pilih salah satu jawaban yang benar', 'apakah a sama dengan b?', 'ya', 'tidak', 'tidak tahu', '', '', 'tidak', 10),
(2, 'kate1', '', 'bila a sama dengan c dan c sama dengan b, apakah a sama dengan b?', 'ya ', 'tidak', 'semua salah', '', '', 'ya', 10),
(3, 'kate4', 'Pilih salah satu jawaban yang benar', 'PHP singkatan dari?', 'hypertext processor', 'pre hypertext processor', '', '', '', 'hypertext processor', 10),
(4, 'kate4', 'Pilih salah satu jawaban yang benar', 'CSS singkatan dari', 'cascading style sheet', 'code style sheet', 'color style sheet', 'cascade style sheet', '', 'cascading style sheet', 10),
(5, 'kate4', 'pilih dua jawaban yang benar', 'a untuk b, c untuk', 'a', 'b', 'c', 'd', '', 'a b', 10),
(6, 'chuukan', 'Pilih salah satu yang benar', 'Iraira suru wa indonesiago de nani?', 'kesal', 'sebel', 'marah', 'senang', '', 'kesal sebel', 10),
(7, 'PHP', 'Pilih dua jawaban yang benar', 'Tipe untuk atribut method dalam form html', 'post', 'method', 'get', 'send', 'gets', 'post get', 10),
(8, 'PHP', 'Pilih tiga jawaban yang benar', 'Jenis atribut Type dari tag input html ', 'submit', 'text', 'password', 'post', 'get', 'submit text password', 10),
(12, 'B.Ing1', 'pilih salah satu jawaban yang benar', 'Apa arti dari ADJOURNED?', 'menunda', 'bersebelahan', 'juri', 'sidang', 'dihakimi', 'menunda', 10),
(13, 'B.Ing1', 'pilih salah satu jawaban yang benar', 'Apa arti dari VERDICT?', 'saluran pembuangan air', 'putusan juri', 'imbalan', 'jalan buntu', '', 'putusan juri', 10),
(14, 'B.Ing1', 'pilih salah satu jawaban yang benar', 'Apa arti dari ABETTOR?', 'nama film baru stephen spielberg', 'kaki tangan dalam kejahatan', 'pengkhianat', '', '', 'kaki tangan dalam kejahatan', 10),
(16, 'quiz1', 'pilih satu jawaban', 'apa?', 'ya', 'tidak', 'tidak tahu', '', '', 'ya', 10),
(17, 'zzzz', 'qqqq', 'qqqq', 'q', 'w', 'e', 'r', 't', 'q', 10),
(18, 'zzzz', '', 'aaaa', 'a', 'b', 'c', 'd', '', 'a b', 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
