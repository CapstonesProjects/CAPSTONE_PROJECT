-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 05:42 PM
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
-- Database: `db_connection`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `FullNameSender` varchar(120) NOT NULL,
  `receiver` varchar(255) DEFAULT NULL,
  `FullNameReceiver` varchar(120) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `sender`, `FullNameSender`, `receiver`, `FullNameReceiver`, `subject`, `body`, `status`, `created_at`) VALUES
(16, '1422-21', 'Helen Patalbo', '1169-21', 'Rogel Ramos Gerodiaz', 'Summon', '\r\n            Dear [Recipient Name],\r\n\r\n            I hope this message finds you well. I am writing to inform you about [Subject].\r\n\r\n            [Body of the letter]\r\n\r\n            Best regards,\r\n            [Your Name]\r\n        ', 'sent', '2024-09-30 10:41:01'),
(17, '1422-21', 'Helen Patalbo', '6911-21', 'Devante Hilton Arm Tillman', 'Summon', '\r\n            Dear [Recipient Name],\r\n\r\n            I hope this message finds you well. I am writing to inform you about [Subject].\r\n\r\n            [Body of the letter]\r\n\r\n            Best regards,\r\n            [Your Name]\r\n        ', 'sent', '2024-09-30 11:01:15'),
(18, '1422-21', 'Helen Patalbo', '1169-21', 'Rogel Ramos Gerodiaz', 'Summon', '\r\n            Dear [Recipient Name],\r\n\r\n            I hope this message finds you well. I am writing to inform you about [Subject].\r\n\r\n            [Body of the letter]\r\n\r\n            Best regards,\r\n            [Your Name]\r\n        ', 'sent', '2024-09-30 15:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `tblcases`
--

CREATE TABLE `tblcases` (
  `CaseID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Offense` varchar(220) NOT NULL,
  `OffenseCategory` varchar(255) DEFAULT NULL,
  `Sanction` varchar(255) DEFAULT NULL,
  `Complainant` varchar(120) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `ReportAttachment` varchar(255) DEFAULT NULL,
  `WrittenReprimandAttachment` varchar(255) DEFAULT NULL,
  `SanctionLetterAttachment` varchar(255) DEFAULT NULL,
  `ComplainantNumber` varchar(255) DEFAULT NULL,
  `Affiliation` varchar(255) DEFAULT NULL,
  `SchoolYear` varchar(255) DEFAULT NULL,
  `FiledBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcases`
--

INSERT INTO `tblcases` (`CaseID`, `StudentID`, `FullName`, `Email`, `Offense`, `OffenseCategory`, `Sanction`, `Complainant`, `Status`, `Date`, `ReportAttachment`, `WrittenReprimandAttachment`, `SanctionLetterAttachment`, `ComplainantNumber`, `Affiliation`, `SchoolYear`, `FiledBy`) VALUES
(11, '1169-21', 'Rogel Ramos Gerodiaz', 'gerodiazrogel0@gmail.com', 'Attitude inside the Classroom - Classroom mischief, failure to turn off or put on silent the mobile phone', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Ongoing', '2024-09-28', '../fileattachment/Rogel Gerodiaz Resume.pdf', '', '../fileattachment/Untitled (Poster).pdf', '0923322545', 'Faculty', '2024-2025', 'Helen Patalbo'),
(12, '1169-21', 'Rogel Ramos Gerodiaz', 'gerodiazrogel0@gmail.com', 'Violation with Legal Implications - Smoking within the school premises or approved off-campus activities (100 meters from perimeter to any point, RA 9211)', 'Major', 'First offense - Suspension for a period of not less than five (5) days.', 'Phillip Andro G. Banag', 'Ongoing', '2024-09-30', '../fileattachment/4503-1871-0548-0651.pdf', '', '', '0923322545', 'Faculty', '2024-2025', 'Helen Patalbo');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers_osa`
--

CREATE TABLE `tblusers_osa` (
  `UserID` int(11) NOT NULL,
  `OSA_number` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers_osa`
--

INSERT INTO `tblusers_osa` (`UserID`, `OSA_number`, `FirstName`, `LastName`, `Username`, `Password`, `Role`) VALUES
(1, '1422-21', 'Helen', 'Patalbo', 'patalbohelen', '123456789', 'OSA'),
(2, '1223-41', 'Rogel', 'Gerodiaz', 'rogelgerodiaz', '123456789', 'OSA');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers_student`
--

CREATE TABLE `tblusers_student` (
  `UserID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `MiddleName` varchar(10) NOT NULL,
  `Suffix` varchar(12) NOT NULL,
  `Course` varchar(52) NOT NULL,
  `YearLevel` varchar(52) NOT NULL,
  `StudentType` varchar(52) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `PhoneNumber` int(22) NOT NULL,
  `DateBirth` varchar(24) NOT NULL,
  `Address` varchar(99) NOT NULL,
  `Gender` varchar(24) NOT NULL,
  `Nationality` varchar(32) NOT NULL,
  `EmergencyContact` int(22) NOT NULL,
  `MaritalStatus` varchar(24) NOT NULL,
  `GuardiansName` varchar(32) NOT NULL,
  `GuardiansContact` int(22) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Status` varchar(12) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers_student`
--

INSERT INTO `tblusers_student` (`UserID`, `StudentID`, `FirstName`, `LastName`, `MiddleName`, `Suffix`, `Course`, `YearLevel`, `StudentType`, `Email`, `PhoneNumber`, `DateBirth`, `Address`, `Gender`, `Nationality`, `EmergencyContact`, `MaritalStatus`, `GuardiansName`, `GuardiansContact`, `Username`, `Password`, `Role`, `Status`, `profile_picture`) VALUES
(1, '6911-21', 'Devante', 'Tillman', 'Hilton Arm', 'V', 'Bachelor of Science in Psychology', '4', 'Regular', 'your.email+fakedata96535@gmail.com', 425, '2024-08-21', '295 Corwin Run', 'Female', 'Utica', 421, 'Married', 'Adan Buckridge', 295, 'Gust.Kshlerin-Gleichner', 'f8MDbl_LfpUy7Nq', 'student', 'active', NULL),
(2, '1169-21', 'Rogel', 'Gerodiaz', 'Ramos', 'N/A', 'Bachelor of Science in Information Technology', '4', 'Regular', 'gerodiazrogel0@gmail.com', 2147483647, '2001-06-10', 'JASMIN', 'Male', 'Filipino', 321, 'Single', 'Evelyn Gerodiaz', 174, 'gerodiazrogel', '123456789', 'student', 'active', NULL),
(3, '4084-21', 'Toney', 'Towne', 'Bette Absh', 'III', 'Bachelor of Science in Engineering', '5', 'Irregular', 'your.email+fakedata43820@gmail.com', 841, '2025-02-01', '5517 Gusikowski Ford', 'Other', 'Catonsville', 822, 'Widowed', 'Shane Gorczany', 587, 'Dixie_Franecki', '39tTrYeVmpGkV8H', 'student', 'inactive', NULL),
(4, '3234-21', 'Allan', 'Bashirian-Goodwin', 'Cecile Cas', 'III', 'Bachelor of Science in Computer Science', '4', 'Irregular', 'your.email+fakedata12001@gmail.com', 596, '2023-10-29', '782 Angel Glens', 'Other', 'Rancho Palos Verdes', 548, 'Single', 'George Bode', 991, 'Alayna_Cole', 'YZ2ccyvghAJezBF', 'student', 'active', NULL),
(5, '7742-32', 'Jamir', 'Kohler', 'Sanford Bo', 'Sr', 'Bachelor of Science in Psychology', '3', 'Irregular', 'your.email+fakedata72573@gmail.com', 952, '2024-11-13', '682 Stacy Stream', 'Male', 'Palm Harbor', 488, 'Married', 'Julie Carroll', 232, 'Tomas25', 'Z3jFV6QXelqX_Rp', 'student', 'active', NULL),
(6, '4232-21', 'Jamey', 'Bosco', 'Dandre Bre', 'Sr', 'Bachelor of Science in Business Administration', '1', 'Irregular', 'your.email+fakedata42530@gmail.com', 921, '2024-06-27', '8369 Hodkiewicz Route', 'Other', 'Spring Valley', 243, 'Divorced', 'Everett Beier', 616, 'General.Legros', 'AQMX6GobitT3KKh', 'student', 'active', NULL),
(7, '4372-31', 'Ronny', 'Gibson', 'Bette Wind', 'Sr', 'Bachelor of Science in Engineering', '2', 'Regular', 'your.email+fakedata57452@gmail.com', 307, '2024-04-26', '8566 Ken Fields', 'Male', 'Porterville', 69, 'Divorced', 'Kamille McLaughlin', 752, 'Isom26', 'OpBJWExaCgdKy68', 'student', 'inactive', NULL),
(8, '3272-21', 'Mable', 'Swaniawski', 'Meaghan Re', 'Sr', 'Bachelor of Science in Education', '5', 'Irregular', 'your.email+fakedata76110@gmail.com', 919, '2025-07-20', '51807 Beaulah Creek', 'Female', 'Lompoc', 67, 'Divorced', 'Casandra Hoppe', 444, 'Vida.Williamson66', 'Ql1TGov1AzrMyPe', 'student', 'active', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`);

--
-- Indexes for table `tblcases`
--
ALTER TABLE `tblcases`
  ADD PRIMARY KEY (`CaseID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `tblusers_osa`
--
ALTER TABLE `tblusers_osa`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `OSA_number` (`OSA_number`);

--
-- Indexes for table `tblusers_student`
--
ALTER TABLE `tblusers_student`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `StudentID` (`StudentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblcases`
--
ALTER TABLE `tblcases`
  MODIFY `CaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblusers_osa`
--
ALTER TABLE `tblusers_osa`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers_student`
--
ALTER TABLE `tblusers_student`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `tblusers_osa` (`OSA_number`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `tblusers_student` (`StudentID`);

--
-- Constraints for table `tblcases`
--
ALTER TABLE `tblcases`
  ADD CONSTRAINT `tblcases_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `tblusers_student` (`StudentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
