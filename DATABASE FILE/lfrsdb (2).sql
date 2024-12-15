-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 05:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lfrsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `fullname`, `email`, `updationDate`) VALUES
(4, 'admin', 'd00f5d5217896fb7fd601412cb890830', 'K. T. T. Karunarathne', 'thamodhikarunarathnedvp@gmail.com', '2024-05-17 15:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `Subject` varchar(50) DEFAULT NULL,
  `Teacher` varchar(150) NOT NULL,
  `Sport` varchar(150) DEFAULT NULL,
  `Reason` mediumtext NOT NULL,
  `Date` varchar(120) NOT NULL,
  `FromTime` varchar(120) NOT NULL,
  `ToTime` varchar(120) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminActionDate` varchar(120) DEFAULT NULL,
  `AdminStatus` int(1) NOT NULL,
  `IsReadByAdmin` int(1) NOT NULL,
  `stuid` int(11) DEFAULT NULL,
  `TeacherRemark` mediumtext DEFAULT NULL,
  `TeacherActionDate` varchar(120) DEFAULT NULL,
  `TeacherStatus` int(1) NOT NULL,
  `IsReadByTeacher` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `Subject`, `Teacher`, `Sport`, `Reason`, `Date`, `FromTime`, `ToTime`, `PostingDate`, `AdminRemark`, `AdminActionDate`, `AdminStatus`, `IsReadByAdmin`, `stuid`, `TeacherRemark`, `TeacherActionDate`, `TeacherStatus`, `IsReadByTeacher`) VALUES
(30, 'CMIS 1113', 'Dr. B. Munasighe', 'Badminton', 'interfaculty', '2024-08-09', '08.30', '10.30', '2024-06-30 20:02:05', NULL, NULL, 0, 1, 1, NULL, '2024-07-01 2:00:50 ', 1, 1),
(32, 'CMIS 1113', 'Dr. B. Munasighe', 'Badminton', 'interfaculty', '2024-07-31', '08.30', '10.30', '2024-07-01 05:14:56', NULL, NULL, 0, 1, 1, NULL, '2024-07-01 11:34:38 ', 2, 1),
(34, 'CMIS 1113', 'Dr. B. Munasighe', 'Badminton', 'interr', '2024-08-09', '08.30', '10.30', '2024-07-01 07:18:28', NULL, NULL, 0, 1, 1, NULL, NULL, 0, 1),
(35, 'CMIS 1113', 'Dr. B. Munasighe', 'Badminton', 'interrr', '2024-07-25', '08.30', '10.30', '2024-07-01 07:49:01', NULL, '2024-07-01 13:22:54 ', 2, 1, 1, NULL, '2024-07-01 18:54:50 ', 1, 1),
(36, 'CMIS 1113', 'Mr. T. Arudchelvam', 'Badminton', 'interr', '2024-07-10', '08.30', '10.30', '2024-07-01 07:49:33', NULL, '2024-07-01 13:22:36 ', 1, 1, 1, NULL, NULL, 0, 0),
(37, 'CMIS 1113', 'Dr. B. Munasighe', 'Badminton', 'inter faculty matches', '2024-07-17', '08.30', '10.30', '2024-07-01 13:53:48', NULL, '2024-07-01 19:28:15 ', 2, 1, 1, NULL, '2024-07-01 19:26:33 ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `FullName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sport` varchar(150) DEFAULT NULL,
  `ProfilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `FullName`, `EmailId`, `Password`, `Phonenumber`, `Status`, `RegDate`, `Sport`, `ProfilePicture`) VALUES
(8, 'Ishan Dasanayake', 'ishandineth@gmail.com', '7645cd875dd8fa9e86014101094fcf70', '0771707879', 1, '2024-06-29 00:50:20', 'Badminton', 'profile_pictures/2384655.jpg'),
(9, 'Umesh Nanayakkarawasam', 'umesh.nanayakkarawasam@gmail.com', '7645cd875dd8fa9e86014101094fcf70', '0778225444', 1, '2024-06-29 12:32:58', 'Chess', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `SportName` varchar(150) DEFAULT NULL,
  `SportCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `SportName`, `SportCode`, `CreationDate`) VALUES
(1, 'Basketball', 'BB', '2024-05-16 19:35:03'),
(2, 'Vollyball', 'VB', '2024-05-18 09:28:58'),
(3, 'Netball', 'NB', '2024-05-18 09:29:10'),
(4, 'Cricket', 'CK', '2024-05-18 09:30:01'),
(5, 'Badminton', 'BD', '2024-06-30 20:01:14'),
(6, 'Chess', 'cs', '2024-07-01 12:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `StuId` varchar(100) NOT NULL,
  `FullName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `level` varchar(255) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ProfilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `StuId`, `FullName`, `EmailId`, `Password`, `Gender`, `Dob`, `level`, `Phonenumber`, `Status`, `RegDate`, `ProfilePicture`) VALUES
(1, '202087', 'K. T. T. Karunarathne', 'thamodhikarunarathnedvp@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', 'Female', '2000-01-13', '3 Year', '0760053544', 1, '2024-05-16 15:39:51', 'profile_pictures/Download Free Vectors, Images, Photos & Videos _ Vecteezy.jpg'),
(2, '202175', 'N. D. Weerakoon', 'nilmiweerakooon99@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', 'Female', '1999-04-15', '3 Year', '0711911444', 1, '2024-05-17 12:36:36', NULL),
(3, '202158', 'M. P. Sewwandi', '1999pershanisewwandi@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', 'Female', '1999-05-23', '3 Year', '0762954899', 1, '2024-05-17 15:23:37', NULL),
(4, '202166', 'W. N. M. C. Somarathne', 'manoj64chathuranga@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', 'Male', '1999-08-26', '3 Year', '0766160060', 1, '2024-05-17 15:36:11', NULL),
(5, '202265', 'M. S. M. N. Perera', 'shihanmiyuru@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', 'Male', '2000-12-23', '3 Year', '0718717494', 1, '2024-05-18 15:02:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_sports`
--

CREATE TABLE `student_sports` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_sports`
--

INSERT INTO `student_sports` (`id`, `student_id`, `sport_id`, `registration_date`) VALUES
(1, 1, 1, '2024-05-26 10:02:49'),
(2, 1, 4, '2024-05-26 10:09:34'),
(3, 4, 4, '2024-05-26 10:11:02'),
(4, 4, 2, '2024-05-26 10:49:58'),
(5, 4, 2, '2024-05-26 11:04:46'),
(6, 3, 3, '2024-05-26 16:27:13'),
(7, 5, 1, '2024-05-26 16:29:29'),
(8, 5, 4, '2024-05-26 16:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(150) DEFAULT NULL,
  `SubjectCode` varchar(50) DEFAULT NULL,
  `Department` varchar(100) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `SubjectName`, `SubjectCode`, `Department`, `CreationDate`) VALUES
(1, 'Computers and Opearating Systems', 'CMIS 1113', 'Computing & Informations Systems', '2024-05-16 19:07:44'),
(2, 'Database Management Systems', 'CMIS 2123', 'Computing & Informations Systems', '2024-09-18 13:50:15'),
(3, 'Introduction to Computing & Operating Systems', 'CMIS 1113', 'Computing & Informations Systems', '2024-09-18 14:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `TeaId` varchar(100) NOT NULL,
  `FullName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `department` varchar(255) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ProfilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `TeaId`, `FullName`, `EmailId`, `Password`, `department`, `Phonenumber`, `Status`, `RegDate`, `ProfilePicture`) VALUES
(1, 'CMIS01L', 'Mr. T. Arudchelvam', 'arul@wyb.ac.lk', 'e0c55d8fbd6cd87a3c2112ac0037ee61', 'Computing & Informations Systems', '0718076048', 1, '2024-05-16 18:05:14', NULL),
(2, 'CMIS02L', 'Prof. V. G. T. N. Vidanagama', 'tharinda@wyb.ac.lk', 'e0c55d8fbd6cd87a3c2112ac0037ee61', 'Computing & Informations Systems', '0711942467', 1, '2024-05-18 09:27:22', NULL),
(3, 'CMIS03L', 'Dr. B. Munasighe', 'bhagya@wyb.ac.lk', 'e0c55d8fbd6cd87a3c2112ac0037ee61', 'Computing & Informations Systems', '0372282759', 1, '2024-05-18 09:28:40', 'profile_pictures/2467403.jpg'),
(4, '', 'Mrs. W. M. L. N. Wanninayake', 'lakminiw@wyb.ac.lk', 'e0c55d8fbd6cd87a3c2112ac0037ee61', 'Computing & Informations Systems', '077 845448', 1, '2024-06-30 19:26:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `assigned_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `teacher_id`, `subject_id`, `assigned_date`, `method`) VALUES
(6, 4, 3, '2024-09-18 14:21:30', 'lecture');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`stuid`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_sports`
--
ALTER TABLE `student_sports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_sports`
--
ALTER TABLE `student_sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_sports`
--
ALTER TABLE `student_sports`
  ADD CONSTRAINT `student_sports_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `student_sports_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`);

--
-- Constraints for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD CONSTRAINT `teacher_subjects_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `teacher_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
