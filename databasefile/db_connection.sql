-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 10:52 PM
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
(8, '1169-21', 'Rogel R Gerodiaz', 'gerodiazrogel0@gmail.com', 'Noncompliance of Academic Requirements - Truancy or cutting classes', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Ongoing', '2024-09-23', '../fileattachment/Assignment #2 IAS.pdf', '', '../fileattachment/hjk.pdf', '0923322545', 'Faculty', '2024-2025', 'Helen Patalbo'),
(9, '6934-32', 'Reymundo Braeden Ha Schaden', 'your.email+fakedata90144@gmail.com', 'Attitude inside the Classroom - Disturbing other classes/activities through excessive noise', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Ongoing', '2024-09-23', '../fileattachment/IAS.pdf', '', '', '0923322545', 'Faculty', '2024-2025', 'Helen Patalbo'),
(10, '1169-21', 'Rogel R Gerodiaz', 'gerodiazrogel0@gmail.com', 'Behavior in Campus - Not wearing the prescribed uniform', 'Minor', 'Second offense - Written reprimand', 'Phillip Andro G. Banag', 'Resolved', '2024-09-23', '../fileattachment/Contract_.pdf', '../fileattachment/The_Business_Process_Model.pdf', '', '0923322545', 'Faculty', '2024-2025', 'Helen Patalbo');

-- --------------------------------------------------------

--
-- Table structure for table `tblcases(original)`
--

CREATE TABLE `tblcases(original)` (
  `CaseID` int(11) NOT NULL,
  `StudentID` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `tblcases(original)`
--

INSERT INTO `tblcases(original)` (`CaseID`, `StudentID`, `FullName`, `Email`, `Offense`, `OffenseCategory`, `Sanction`, `Complainant`, `Status`, `Date`, `ReportAttachment`, `WrittenReprimandAttachment`, `SanctionLetterAttachment`, `ComplainantNumber`, `Affiliation`, `SchoolYear`, `FiledBy`) VALUES
(45, '1169-21', 'Rogel R Gerodiaz', 'gerodiazrogel0@gmail.com', 'Noncompliance of Academic Requirements - Attendance (exceeded allowable absences)', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Ongoing', '2024-09-22', '../fileattachment/Panitikan_Prelim Assignment.docx', '', '', NULL, NULL, NULL, NULL);

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
(1, '1111-24', 'Helen', 'Patalbo', 'patalbohelen', '123456789', 'OSA Staff');

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
(1, '1169-21', 'Rogel', 'Gerodiaz', 'R', 'N/A', 'Bachelor of Science in Information Technology', '4', 'Regular', 'gerodiazrogel0@gmail.com', 2147483647, '2001-06-10', 'T.S CRUZ Cruz Subdivision, Almanza Dos', 'Male', 'Filipino', 321, 'Single', 'Evelyn Gerodiaz', 2147483647, 'gerodiazrogel', '123456789', 'student', 'active', NULL),
(2, '6934-32', 'Reymundo', 'Schaden', 'Braeden Ha', 'IV', 'Bachelor of Science in Education', '1', 'Irregular', 'your.email+fakedata90144@gmail.com', 951, '2023-12-24', '535 Andre Squares', 'Other', 'Burleson', 203, 'Widowed', 'Marilyne Mante', 37, 'Audrey_OHara68', 'FEHI3k_sFD3d35O', 'student', 'inactive', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers_student(original)`
--

CREATE TABLE `tblusers_student(original)` (
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
-- Dumping data for table `tblusers_student(original)`
--

INSERT INTO `tblusers_student(original)` (`UserID`, `StudentID`, `FirstName`, `LastName`, `MiddleName`, `Suffix`, `Course`, `YearLevel`, `StudentType`, `Email`, `PhoneNumber`, `DateBirth`, `Address`, `Gender`, `Nationality`, `EmergencyContact`, `MaritalStatus`, `GuardiansName`, `GuardiansContact`, `Username`, `Password`, `Role`, `Status`, `profile_picture`) VALUES
(1, '1169-21', 'Rogel', 'Gerodiaz', 'R', 'N/A', 'Bachelor of Science in Information Technology', '4', 'Regular', 'gerodiazrogel0@gmail.com', 909313675, '06/10/2001', 'Laspinas City', 'Male', 'Filipino', 909313675, 'Single', 'Evelyn Gerodiaz', 909313675, 'gerodiazrogel', '123456789', 'student', 'Active', '../uploads/joshua.jpg'),
(50, '69', 'Laurine', 'Cummings', 'Hettie Her', 'Sr', 'Bachelor of Science in Psychology', '2', 'Regular', 'your.email+fakedata46525@gmail.com', 957, '2024-09-14', '6309 Joaquin Via', 'Female', 'Suffolk', 838, 'Single', 'Rowena Thiel', 586, 'Florian_Gislason32', 'r1YzGYOwBc6rqrv', 'student', 'active', NULL),
(51, '4526-24', 'Zackery', 'Bogisich', 'Giovanna B', 'IV', 'Bachelor of Science in Computer Science', '5', 'Regular', 'your.email+fakedata15617@gmail.com', 585, '2024-01-04', '9978 Kailey Brook', 'Male', 'Levittown', 799, 'Single', 'Madelyn Rau', 499, 'Adella_Bergnaum54', 'ob8UTR7KGOwhrVD', 'student', 'active', NULL),
(52, '4723-24', 'Sterling', 'Rodriguez', 'Alberto Ca', 'Sr', 'Bachelor of Science in Education', '2', 'Regular', 'your.email+fakedata30695@gmail.com', 778, '2024-06-11', '8564 Bryon Mission', 'Female', 'Elkhart', 482, 'Widowed', 'Shaylee Runolfsdottir-Parisian', 608, 'Reba_Marvin-Pagac73', 'VuGk12S07b5hXG4', 'student', 'active', NULL),
(53, '6472-24', 'Kailey', 'Jacobson', 'Concepcion', 'N/A', 'Bachelor of Science in Education', '4', 'Regular', 'your.email+fakedata63894@gmail.com', 597, '2023-12-25', '4367 Ashtyn Knoll', 'Other', 'Cleveland Heights', 479, 'Married', 'Myra Murray', 90, 'Erica.Hagenes40', 'L_BAKD7Y8iUwNg5', 'student', 'inactive', NULL),
(54, '4383-21', 'Bill', 'Schuster', 'Alec Kirli', 'Sr', 'Bachelor of Science in Business Administration', '1', 'Regular', 'your.email+fakedata80010@gmail.com', 941, '2023-10-26', '7672 Bertha Keys', 'Male', 'Sarasota', 366, 'Divorced', 'Osborne Sporer', 938, 'Bruce_Wintheiser35', 'pUCdj8aEboB7XlQ', 'student', 'inactive', NULL),
(55, '6932-24', 'Jerrod', 'Jacobs', 'Alessandro', 'III', 'Bachelor of Science in Business Administration', '4', 'Regular', 'your.email+fakedata75239@gmail.com', 493, '2024-10-28', '2463 Roberts Islands', 'Male', 'Dubuque', 598, 'Single', 'Laisha Pacocha', 862, 'Chelsie.Hand', 'iZI3axay4eUdYeA', 'student', 'active', NULL),
(56, '6892-24', 'Reyna', 'Gleichner', 'Leora Stam', 'III', 'Bachelor of Science in Information Technology', '5', 'Regular', 'your.email+fakedata75714@gmail.com', 778, '2025-06-24', '6151 Garnett Falls', 'Female', 'Woodland', 99, 'Married', 'Kyler Reichert', 658, 'Oliver_Mills79', '5RF_8yCK5V9BahS', 'student', 'inactive', NULL),
(57, '5493-24', 'Brandt', 'Ledner', 'Casimer Ko', 'III', 'Bachelor of Science in Business Administration', '1', 'Irregular', 'your.email+fakedata90988@gmail.com', 919, '2025-08-25', '995 Alberto Parkway', 'Female', 'Santa Cruz', 181, 'Divorced', 'Sandrine Dach-Bailey', 310, 'Sophia.Skiles33', '3ur8oJjmugo0B1g', 'student', 'inactive', NULL),
(58, '3489-24', 'Breanne', 'Ledner', 'Lottie War', 'Jr', 'Bachelor of Science in Information Technology', '2', 'Irregular', 'your.email+fakedata81826@gmail.com', 57, '2025-03-14', '589 Ike Landing', 'Female', 'Hawthorne', 267, 'Divorced', 'Elvie Buckridge-Wolff', 831, 'Favian_Feest27', 'JTo7TUbSDz0QJjw', 'student', 'inactive', NULL),
(59, '4389-24', 'Ethyl', 'Schaefer', 'Meagan Koe', 'N/A', 'Bachelor of Science in Computer Science', '5', 'Irregular', 'your.email+fakedata53524@gmail.com', 454, '2025-02-12', '56242 Sadie Lights', 'Female', 'Reno', 222, 'Single', 'Lera Jakubowski', 978, 'Aryanna.Rosenbaum3', 'lpo9mpgzBD6zgej', 'student', 'active', NULL),
(60, '4378-24', 'Marcelle', 'Schuppe', 'Roy Koepp', 'Jr', 'Bachelor of Science in Engineering', '1', 'Irregular', 'your.email+fakedata20300@gmail.com', 931, '2024-06-24', '506 Wilderman Bypass', 'Other', 'Winston-Salem', 185, 'Single', 'Raphael Labadie', 221, 'Seth35', 'iA4siJ1YjEU5YIV', 'student', 'active', NULL),
(61, '6782-24', 'Marisol', 'Gerhold', 'Cicero Leh', 'IV', 'Bachelor of Science in Computer Science', '4', 'Regular', 'your.email+fakedata80889@gmail.com', 140, '2024-03-08', '7677 Langworth Cape', 'Other', 'Edina', 28, 'Divorced', 'Marilou Emard', 695, 'Jordy.Gulgowski', 'B7_tTGT2TvGFgsJ', 'student', 'active', NULL),
(62, '4382-24', 'Shyanne', 'Cummings', 'Maximilian', 'II', 'Bachelor of Science in Computer Science', '2', 'Irregular', 'your.email+fakedata54907@gmail.com', 783, '2025-08-31', '149 Leffler Crossroad', 'Other', 'Provo', 623, 'Single', 'Vincenza Farrell', 827, 'Meredith.Hettinger', 'lT8nr6gd56rVzHE', 'student', 'active', NULL),
(63, '7290-24', 'Jeromy', 'Bogan-Koss', 'Adelbert R', 'III', 'Bachelor of Science in Tourism Management', '2', 'Irregular', 'your.email+fakedata13877@gmail.com', 528, '2023-11-11', '24467 Denesik Overpass', 'Other', 'Palm Beach Gardens', 973, 'Widowed', 'Nicholaus Weissnat', 760, 'Porter17', 'KPR6XgwOGNTsk8J', 'student', 'active', NULL),
(64, '6965-24', 'Darius', 'Marks', 'Marques Be', 'N/A', 'Bachelor of Science in Information Technology', '4', 'Irregular', 'your.email+fakedata22066@gmail.com', 416, '2025-06-11', '240 Deshawn Parks', 'Other', 'Skokie', 478, 'Divorced', 'Elias Sipes', 258, 'Kip_Littel48', '4TvO7LK2rnNbks4', 'student', 'active', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcases`
--
ALTER TABLE `tblcases`
  ADD PRIMARY KEY (`CaseID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `tblcases(original)`
--
ALTER TABLE `tblcases(original)`
  ADD PRIMARY KEY (`CaseID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `tblusers_osa`
--
ALTER TABLE `tblusers_osa`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `tblusers_student`
--
ALTER TABLE `tblusers_student`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `StudentID` (`StudentID`);

--
-- Indexes for table `tblusers_student(original)`
--
ALTER TABLE `tblusers_student(original)`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `StudentID` (`StudentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcases`
--
ALTER TABLE `tblcases`
  MODIFY `CaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcases(original)`
--
ALTER TABLE `tblcases(original)`
  MODIFY `CaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tblusers_osa`
--
ALTER TABLE `tblusers_osa`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers_student`
--
ALTER TABLE `tblusers_student`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers_student(original)`
--
ALTER TABLE `tblusers_student(original)`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcases`
--
ALTER TABLE `tblcases`
  ADD CONSTRAINT `tblcases_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `tblusers_student` (`StudentID`);

--
-- Constraints for table `tblcases(original)`
--
ALTER TABLE `tblcases(original)`
  ADD CONSTRAINT `tblcases(original)_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `tblusers_student(original)` (`StudentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
