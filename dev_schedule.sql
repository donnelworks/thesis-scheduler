-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 03, 2024 at 04:16 AM
-- Server version: 8.0.35
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` double NOT NULL,
  `name` varchar(100) NOT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` double DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` double DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `colleger`
--

CREATE TABLE `colleger` (
  `id` double NOT NULL,
  `nim` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `study_program_id` double NOT NULL,
  `classroom_id` double NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` double DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` double DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `id` double NOT NULL,
  `nidn` varchar(100) NOT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `study_program_id` double NOT NULL,
  `job_position` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` double DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` double DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` double NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `number` varchar(100) NOT NULL,
  `lead_tester` double NOT NULL,
  `main_tester` double NOT NULL,
  `secondary_tester` double NOT NULL,
  `submission_id` double NOT NULL,
  `created_date` timestamp NOT NULL,
  `created_by` double NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` double DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `study_program`
--

CREATE TABLE `study_program` (
  `id` double NOT NULL,
  `name` varchar(100) NOT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` double DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` double DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` double NOT NULL,
  `colleger_id` double NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `main_lecturer` double NOT NULL,
  `secondary_lecturer` double NOT NULL,
  `phone` varchar(20) NOT NULL,
  `submission_form` varchar(200) NOT NULL,
  `submission_form_status` int NOT NULL,
  `ktm` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `ktm_status` int NOT NULL,
  `ktp` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `ktp_status` int NOT NULL,
  `krs` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `krs_status` int NOT NULL,
  `ta_guide_book` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `ta_guide_book_status` int NOT NULL,
  `temp_transcripts` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `temp_transcripts_status` int NOT NULL,
  `comprehensive_exam_ba` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `comprehensive_exam_ba_status` int NOT NULL,
  `seminar_result_ba` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `seminar_result_ba_status` int NOT NULL,
  `pbak_certificate` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `pbak_certificate_status` int NOT NULL,
  `toefl_certificate` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `toefl_certificate_status` int NOT NULL,
  `toafl_certificate` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `toafl_certificate_status` int NOT NULL,
  `proof_of_memorization` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `proof_of_memorization_status` int NOT NULL,
  `it_certificate` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `it_certificate_status` int NOT NULL,
  `kukerta_certificate` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `kukerta_certificate_status` int NOT NULL,
  `free_lab` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `free_lab_status` int NOT NULL,
  `turnitin` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `turnitin_status` int NOT NULL,
  `draft_ta` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `draft_ta_status` int NOT NULL,
  `loa_thesis` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `loa_thesis_status` int NOT NULL,
  `loa_non_thesis` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `loa_non_thesis_status` int NOT NULL,
  `publication_journal` varchar(200) DEFAULT NULL,
  `status` int NOT NULL COMMENT '0=Progress;\r\n1=Confirmed;\r\n2=Revised;\r\n3=Rejected;',
  `status_notes` varchar(200) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` double DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` double DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` double NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(200) NOT NULL,
  `role` int NOT NULL COMMENT '1=Admin;\r\n2=Colleger;',
  `colleger_id` double DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` double DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` double DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `name`, `role`, `colleger_id`, `created_date`, `created_by`, `updated_date`, `updated_by`, `deleted_date`) VALUES
(1, 'admin', '$2y$10$DM7N.x1wknps99bfCL8Euu1jf2YICCiepC3qka77PJgB0MbTmb2nq', 'Operator', 1, NULL, '2024-10-29 03:10:37', 1, '2024-10-30 08:29:51', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleger`
--
ALTER TABLE `colleger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_program`
--
ALTER TABLE `study_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colleger`
--
ALTER TABLE `colleger`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `study_program`
--
ALTER TABLE `study_program`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
