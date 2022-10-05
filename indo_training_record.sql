-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 04:50 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indo_training_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_training`
--

CREATE TABLE `detail_training` (
  `ID_DetailTraining` int(11) NOT NULL,
  `ID_Training` int(11) DEFAULT NULL,
  `NamaMateri` varchar(255) DEFAULT NULL,
  `Trainer` varchar(255) DEFAULT NULL,
  `Lokasi` varchar(255) DEFAULT NULL,
  `ReportBy` varchar(255) DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_training`
--

INSERT INTO `detail_training` (`ID_DetailTraining`, `ID_Training`, `NamaMateri`, `Trainer`, `Lokasi`, `ReportBy`, `Duration`) VALUES
(2, 2, 'QP-HRD-01, QP-HRD-02, QP-HRD-03,', 'Mr. Nurding A-Wae', 'HR Room', 'Angga K P ', 1),
(4, 4, 'Understanding GMP & Development HACCP ', 'Angga Kristiyan P', 'Training Room', 'Angga K P ', 1),
(5, 4, 'Personal hygiene and Company regulation', 'Angga Kristiyan P', 'Training Room', 'Angga K P ', 1),
(6, 4, 'BRC Issue 8 Standart and EU Allergen List', 'Angga Kristiyan P	', 'Training Room	', 'Angga K P	', 1),
(7, 4, 'Site Security, Food Defense, Pest Control, First Aid', 'Aden Aditya', 'Training Room	', 'Angga K P	', 1),
(8, 4, 'Site Security, Food Defense, Safety induction', 'Aden Aditya	', 'Training Room	', 'Angga K P	', 1),
(9, 4, 'Pest Control Management', 'Aden Aditya	', 'Training Room	', 'Angga K P	', 1),
(10, 4, 'Halal Assurance System (HAS 23000)', 'Angga Kristiyan P', 'Training Room	', 'Angga K P	', 1),
(11, 5, 'QP-HRD-01, QP-HRD-02, QP-HRD-03, ', 'Mr. Nurding A-Wae', 'HR Room', 'Angga K P ', 1),
(13, 11, 'Basic Training', 'Siska Amalia', 'Online Zoom', 'Rika', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_checker`
--

CREATE TABLE `m_checker` (
  `ID_Checker` int(11) NOT NULL,
  `NamaChecker` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_checker`
--

INSERT INTO `m_checker` (`ID_Checker`, `NamaChecker`) VALUES
(1, 'Angga K P'),
(3, 'Mr. Nurding A');

-- --------------------------------------------------------

--
-- Table structure for table `m_department`
--

CREATE TABLE `m_department` (
  `ID_Dept` int(11) NOT NULL,
  `NamaDept` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_department`
--

INSERT INTO `m_department` (`ID_Dept`, `NamaDept`) VALUES
(4, 'Enginering'),
(5, 'HR'),
(6, 'Production'),
(7, 'Accounting'),
(8, 'Maintenance'),
(10, 'QC');

-- --------------------------------------------------------

--
-- Table structure for table `m_education`
--

CREATE TABLE `m_education` (
  `ID_Education` int(11) NOT NULL,
  `NamaEducation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_education`
--

INSERT INTO `m_education` (`ID_Education`, `NamaEducation`) VALUES
(2, 'Senior High School'),
(3, 'Diploma'),
(4, 'Sekolah Menengah Atas'),
(5, 'Junior High School'),
(6, 'Bachelor');

-- --------------------------------------------------------

--
-- Table structure for table `m_karyawan`
--

CREATE TABLE `m_karyawan` (
  `ID_Karyawan` int(11) NOT NULL,
  `NikKaryawan` varchar(255) DEFAULT NULL,
  `NamaKaryawan` varchar(255) DEFAULT NULL,
  `ID_Dept` int(11) DEFAULT NULL,
  `ID_Subs` int(11) DEFAULT NULL,
  `ID_Position` int(11) DEFAULT NULL,
  `TglKerja` date DEFAULT NULL,
  `ID_Education` int(11) DEFAULT NULL,
  `ImageKaryawan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_karyawan`
--

INSERT INTO `m_karyawan` (`ID_Karyawan`, `NikKaryawan`, `NamaKaryawan`, `ID_Dept`, `ID_Subs`, `ID_Position`, `TglKerja`, `ID_Education`, `ImageKaryawan`) VALUES
(11, '27110002', 'YANAS PRABUANA', 4, 5, 5, '2012-06-04', 3, '50512ec3d0d28c5fec293d42b45960ed.jpg'),
(12, '27110003', 'YUDI HARTONO', 7, 5, 5, '2013-05-14', 2, 'dabb0ad9db90bd5f741b2f97555fca5e.jpg'),
(13, '27210001', 'ISDIYAH WATI', 5, 4, 7, '2013-01-04', 5, NULL),
(14, '27110004', 'WULYO UTOMO', 4, 6, 5, '2013-04-15', 2, NULL),
(15, '27110005', 'MAS AMIN SYAFI''I', 4, 2, 2, '2013-04-15', 2, NULL),
(16, '27110006', 'MUHAMMAD ARIP HUDA', 4, 2, 2, '2013-04-22', 2, NULL),
(17, '27110007', 'DEDI IRAWAN', 4, 2, 2, '2013-04-22', 2, NULL),
(18, '27110008', 'RANDI PRASTIYA FITRIANTO', 4, 2, 2, '2013-07-01', 2, NULL),
(19, '27110009', 'MUCHAMAD ADI PUTRANTO', 4, 2, 2, '2013-07-01', 2, NULL),
(20, '27110010', 'WIDANARKO', 4, 2, 2, '2013-07-01', 2, NULL),
(21, '27110011', 'HAFID ZUNAIDI', 4, 2, 2, '2013-07-01', 2, NULL),
(22, '27110012', 'EKO SUSILO', 6, 3, 3, '2013-07-01', 2, NULL),
(23, '27210003', 'SUTIYONO', 5, 4, 4, '2013-07-01', 2, NULL),
(24, '27210004', 'SUGENG PRASETYA', 5, 4, 4, '2013-07-01', 2, NULL),
(25, '27110013', 'LUKMANNUL HAKIM', 6, 3, 5, '2013-08-22', 2, NULL),
(26, '27110014', 'ARIS KUNCORO', 6, 3, 5, '2013-10-08', 2, NULL),
(27, '27110015', 'ZAINUDDIN', 6, 8, 9, '2013-08-10', 3, NULL),
(28, '27110016', 'VENNY NOVARINA', 7, 9, 9, '2013-08-10', 3, NULL),
(29, '27110320', 'MOHAMMAD BUDI  ARIANTO', 10, 10, 10, '2013-08-10', 2, NULL),
(30, '27210006', 'SEPTIANA IKA WATI', 6, 11, 11, '2013-08-10', 2, NULL),
(31, '27210008', 'DIAN CHOIRONI', 6, 12, 11, '2013-08-10', 2, NULL),
(32, '27110017', 'SITI AMELIA', 7, 13, 12, '2013-11-10', 6, NULL),
(33, '27110018', 'MULYADI', 6, 14, 13, '2022-10-07', 2, NULL),
(34, '27110019', 'SETYA WAWAN', 6, 15, 14, '2022-09-28', 2, NULL),
(35, '27110020', 'ACHMAD BAGUS BUDIARSHO', 6, 16, 5, '2022-10-05', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_position`
--

CREATE TABLE `m_position` (
  `ID_Position` int(11) NOT NULL,
  `NamaPosition` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_position`
--

INSERT INTO `m_position` (`ID_Position`, `NamaPosition`) VALUES
(2, 'Technician'),
(3, 'Supervisor'),
(4, 'Cleaner Worker'),
(5, 'Foreman'),
(6, 'Kelistrikan'),
(7, 'Kitchen Worker'),
(8, 'Admin Officer'),
(9, 'Store Officer'),
(10, 'Quality Control Inspector'),
(11, 'Production Worker (DL)'),
(12, 'Accounting Officer'),
(13, 'Production Leader'),
(14, 'Production Technician');

-- --------------------------------------------------------

--
-- Table structure for table `m_subsection`
--

CREATE TABLE `m_subsection` (
  `ID_Subs` int(11) NOT NULL,
  `NamaSubs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_subsection`
--

INSERT INTO `m_subsection` (`ID_Subs`, `NamaSubs`) VALUES
(2, 'Utility IW1'),
(3, 'Maintenance  IW1'),
(4, 'Administrator IW1'),
(5, 'Water & WasteWater Treatment IW1'),
(6, 'Electrical IW1'),
(7, 'Extract CU IW1'),
(8, 'Prepare Ingredient & Packaging  IW1'),
(9, 'Store IW1'),
(10, 'Quality Plant CU (Seamer CM) IW1'),
(11, 'Packing Half VCO IW1'),
(12, 'Process Dessicated CU IW1'),
(13, 'Payable IW1'),
(14, 'IW1 Packing Half CU'),
(15, 'Process UHT IW1'),
(16, 'Packing Half CM IW1');

-- --------------------------------------------------------

--
-- Table structure for table `m_training`
--

CREATE TABLE `m_training` (
  `ID_Training` int(11) NOT NULL,
  `NamaTraining` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_training`
--

INSERT INTO `m_training` (`ID_Training`, `NamaTraining`) VALUES
(4, 'Basic Course'),
(5, 'OJT` HR'),
(7, 'OJT Production'),
(8, 'OJT QC'),
(9, 'OJT Engineering'),
(10, 'OJT Warehouse'),
(11, 'OJT Basic');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `ID_User` int(11) NOT NULL,
  `NamaUser` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `PassUser` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`ID_User`, `NamaUser`, `Username`, `PassUser`) VALUES
(1, 'administrator', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad'),
(3, 'bagas', 'bagas', 'adcd7048512e64b48da55b027577886ee5a36350'),
(6, 'user', 'user', 'adcd7048512e64b48da55b027577886ee5a36350');

-- --------------------------------------------------------

--
-- Table structure for table `training_record`
--

CREATE TABLE `training_record` (
  `ID_TrainingRecord` int(11) NOT NULL,
  `TglPelatihan` date DEFAULT NULL,
  `TglNow` date DEFAULT NULL,
  `ID_DetailTraining` int(11) DEFAULT NULL,
  `ID_Karyawan` int(11) DEFAULT NULL,
  `Pelapor` varchar(255) DEFAULT NULL,
  `Pemeriksa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_record`
--

INSERT INTO `training_record` (`ID_TrainingRecord`, `TglPelatihan`, `TglNow`, `ID_DetailTraining`, `ID_Karyawan`, `Pelapor`, `Pemeriksa`) VALUES
(5, '2022-11-10', '2022-10-05', 13, 28, 'saswito', 'sastrono');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_training`
--
ALTER TABLE `detail_training`
  ADD PRIMARY KEY (`ID_DetailTraining`);

--
-- Indexes for table `m_checker`
--
ALTER TABLE `m_checker`
  ADD PRIMARY KEY (`ID_Checker`);

--
-- Indexes for table `m_department`
--
ALTER TABLE `m_department`
  ADD PRIMARY KEY (`ID_Dept`);

--
-- Indexes for table `m_education`
--
ALTER TABLE `m_education`
  ADD PRIMARY KEY (`ID_Education`);

--
-- Indexes for table `m_karyawan`
--
ALTER TABLE `m_karyawan`
  ADD PRIMARY KEY (`ID_Karyawan`);

--
-- Indexes for table `m_position`
--
ALTER TABLE `m_position`
  ADD PRIMARY KEY (`ID_Position`);

--
-- Indexes for table `m_subsection`
--
ALTER TABLE `m_subsection`
  ADD PRIMARY KEY (`ID_Subs`);

--
-- Indexes for table `m_training`
--
ALTER TABLE `m_training`
  ADD PRIMARY KEY (`ID_Training`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`ID_User`);

--
-- Indexes for table `training_record`
--
ALTER TABLE `training_record`
  ADD PRIMARY KEY (`ID_TrainingRecord`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_training`
--
ALTER TABLE `detail_training`
  MODIFY `ID_DetailTraining` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `m_checker`
--
ALTER TABLE `m_checker`
  MODIFY `ID_Checker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_department`
--
ALTER TABLE `m_department`
  MODIFY `ID_Dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `m_education`
--
ALTER TABLE `m_education`
  MODIFY `ID_Education` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `m_karyawan`
--
ALTER TABLE `m_karyawan`
  MODIFY `ID_Karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `m_position`
--
ALTER TABLE `m_position`
  MODIFY `ID_Position` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `m_subsection`
--
ALTER TABLE `m_subsection`
  MODIFY `ID_Subs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `m_training`
--
ALTER TABLE `m_training`
  MODIFY `ID_Training` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `training_record`
--
ALTER TABLE `training_record`
  MODIFY `ID_TrainingRecord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
