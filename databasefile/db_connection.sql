-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 02:19 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminNumber` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `MiddleName` varchar(10) NOT NULL,
  `Suffix` varchar(12) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `PhoneNumber` int(22) NOT NULL,
  `DateBirth` varchar(24) NOT NULL,
  `Gender` varchar(24) NOT NULL,
  `Nationality` varchar(32) NOT NULL,
  `MaritalStatus` varchar(24) NOT NULL,
  `Status` varchar(12) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `lock_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminNumber`, `FirstName`, `LastName`, `Username`, `Password`, `Role`, `MiddleName`, `Suffix`, `Email`, `PhoneNumber`, `DateBirth`, `Gender`, `Nationality`, `MaritalStatus`, `Status`, `profile_picture`, `failed_attempts`, `lock_time`) VALUES
(1, '123-456', 'Rogel', 'Gerodiaz', 'admin', '123456789', 'Admin', 'R', 'N/A', 'admin2@gmail.com', 909313675, '06/10/2001', 'Male', 'Filipino', 'Single', 'Active', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `event_date`, `description`, `location`, `category`, `created_at`) VALUES
(10, 'Lead Optimization Consultant', '2024-11-28', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Last Saturday, the Lorem Ipsum University witnessed a transformative event at the Main Hall. The initiative, led by Chairman and President Dr. John Doe, aimed to prepare the institution for the challenges of Industry 4.0.\r\n\r\nThe Basic Education faculty, Department Heads, and Vice President Engr. Jane Smith attended the orientation, where TechCorp’s Albert Ipsum and Romeo Lorem, as well as RoboTech’s Dr. Ipsum Dolor and Dr. Sit Amet, showcased the latest technologies in automation, artificial intelligence, and robotics.\r\n\r\nThe presentations underscored the commitment of Lorem Ipsum University to align education with the evolving demands of the industry. Dr. John Doe emphasized the importance of staying ahead in technological advancements to prepare students for the dynamic global landscape.\r\n\r\nNotably, the event provided a hands-on experience, with one teacher having the unique opportunity to try DroneSoccer. This exemplifies Lorem Ipsum University’s commitment to integrating technology into education in a practical manner.\r\n\r\nHosted by Ms. Virginia Ipsum, future collaboration between Lorem Ipsum University, TechCorp, and RoboTech signifies a strategic move towards fostering an innovative learning environment. As the institution embraces these advancements, it positions itself as a forward-thinking entity dedicated to preparing students for the challenges and opportunities of the Fourth Industrial Revolution.\r\n\r\nLIU for Industry 4.0\r\n\r\nLIU Cares', 'Laudantium quibusdam atque eaque.', 'workshop', '2024-10-28 15:41:54'),
(11, 'Investor Assurance Executive', '2025-02-28', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Last Saturday, the Lorem Ipsum University witnessed a transformative event at the Main Hall. The initiative, led by Chairman and President Dr. John Doe, aimed to prepare the institution for the challenges of Industry 4.0.\r\n\r\nThe Basic Education faculty, Department Heads, and Vice President Engr. Jane Smith attended the orientation, where TechCorp’s Albert Ipsum and Romeo Lorem, as well as RoboTech’s Dr. Ipsum Dolor and Dr. Sit Amet, showcased the latest technologies in automation, artificial intelligence, and robotics.\r\n\r\nThe presentations underscored the commitment of Lorem Ipsum University to align education with the evolving demands of the industry. Dr. John Doe emphasized the importance of staying ahead in technological advancements to prepare students for the dynamic global landscape.\r\n\r\nNotably, the event provided a hands-on experience, with one teacher having the unique opportunity to try DroneSoccer. This exemplifies Lorem Ipsum University’s commitment to integrating technology into education in a practical manner.\r\n\r\nHosted by Ms. Virginia Ipsum, future collaboration between Lorem Ipsum University, TechCorp, and RoboTech signifies a strategic move towards fostering an innovative learning environment. As the institution embraces these advancements, it positions itself as a forward-thinking entity dedicated to preparing students for the challenges and opportunities of the Fourth Industrial Revolution.\r\n\r\nLIU for Industry 4.0\r\n\r\nLIU Cares', 'Soluta tempora impedit repellendus.', 'conference', '2024-10-28 15:42:11'),
(12, 'Investor Intranet Analyst', '2024-09-25', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Last Saturday, the Lorem Ipsum University witnessed a transformative event at the Main Hall. The initiative, led by Chairman and President Dr. John Doe, aimed to prepare the institution for the challenges of Industry 4.0.\r\n\r\nThe Basic Education faculty, Department Heads, and Vice President Engr. Jane Smith attended the orientation, where TechCorp’s Albert Ipsum and Romeo Lorem, as well as RoboTech’s Dr. Ipsum Dolor and Dr. Sit Amet, showcased the latest technologies in automation, artificial intelligence, and robotics.\r\n\r\nThe presentations underscored the commitment of Lorem Ipsum University to align education with the evolving demands of the industry. Dr. John Doe emphasized the importance of staying ahead in technological advancements to prepare students for the dynamic global landscape.\r\n\r\nNotably, the event provided a hands-on experience, with one teacher having the unique opportunity to try DroneSoccer. This exemplifies Lorem Ipsum University’s commitment to integrating technology into education in a practical manner.\r\n\r\nHosted by Ms. Virginia Ipsum, future collaboration between Lorem Ipsum University, TechCorp, and RoboTech signifies a strategic move towards fostering an innovative learning environment. As the institution embraces these advancements, it positions itself as a forward-thinking entity dedicated to preparing students for the challenges and opportunities of the Fourth Industrial Revolution.\r\n\r\nLIU for Industry 4.0\r\n\r\nLIU Cares', 'Sunt veritatis vero unde soluta.', 'seminar', '2024-10-28 15:42:28'),
(13, 'Dynamic Assurance Representative', '2025-04-26', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Last Saturday, the Lorem Ipsum University witnessed a transformative event at the Main Hall. The initiative, led by Chairman and President Dr. John Doe, aimed to prepare the institution for the challenges of Industry 4.0.\r\n\r\nThe Basic Education faculty, Department Heads, and Vice President Engr. Jane Smith attended the orientation, where TechCorp’s Albert Ipsum and Romeo Lorem, as well as RoboTech’s Dr. Ipsum Dolor and Dr. Sit Amet, showcased the latest technologies in automation, artificial intelligence, and robotics.\r\n\r\nThe presentations underscored the commitment of Lorem Ipsum University to align education with the evolving demands of the industry. Dr. John Doe emphasized the importance of staying ahead in technological advancements to prepare students for the dynamic global landscape.\r\n\r\nNotably, the event provided a hands-on experience, with one teacher having the unique opportunity to try DroneSoccer. This exemplifies Lorem Ipsum University’s commitment to integrating technology into education in a practical manner.\r\n\r\nHosted by Ms. Virginia Ipsum, future collaboration between Lorem Ipsum University, TechCorp, and RoboTech signifies a strategic move towards fostering an innovative learning environment. As the institution embraces these advancements, it positions itself as a forward-thinking entity dedicated to preparing students for the challenges and opportunities of the Fourth Industrial Revolution.\r\n\r\nLIU for Industry 4.0\r\n\r\nLIU Cares', 'Unde nisi rerum.', 'meetup', '2024-10-28 15:42:48'),
(14, 'Investor Factors Director', '2024-08-13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Last Saturday, the Lorem Ipsum University witnessed a transformative event at the Main Hall. The initiative, led by Chairman and President Dr. John Doe, aimed to prepare the institution for the challenges of Industry 4.0.\r\n\r\nThe Basic Education faculty, Department Heads, and Vice President Engr. Jane Smith attended the orientation, where TechCorp’s Albert Ipsum and Romeo Lorem, as well as RoboTech’s Dr. Ipsum Dolor and Dr. Sit Amet, showcased the latest technologies in automation, artificial intelligence, and robotics.\r\n\r\nThe presentations underscored the commitment of Lorem Ipsum University to align education with the evolving demands of the industry. Dr. John Doe emphasized the importance of staying ahead in technological advancements to prepare students for the dynamic global landscape.\r\n\r\nNotably, the event provided a hands-on experience, with one teacher having the unique opportunity to try DroneSoccer. This exemplifies Lorem Ipsum University’s commitment to integrating technology into education in a practical manner.\r\n\r\nHosted by Ms. Virginia Ipsum, future collaboration between Lorem Ipsum University, TechCorp, and RoboTech signifies a strategic move towards fostering an innovative learning environment. As the institution embraces these advancements, it positions itself as a forward-thinking entity dedicated to preparing students for the challenges and opportunities of the Fourth Industrial Revolution.\r\n\r\nLIU for Industry 4.0\r\n\r\nLIU Cares', 'Cum dignissimos magnam explicabo nobis.', 'conference', '2024-10-28 15:43:02'),
(15, 'Human Solutions Associate', '2024-11-18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Last Saturday, the Lorem Ipsum University witnessed a transformative event at the Main Hall. The initiative, led by Chairman and President Dr. John Doe, aimed to prepare the institution for the challenges of Industry 4.0.\r\n\r\nThe Basic Education faculty, Department Heads, and Vice President Engr. Jane Smith attended the orientation, where TechCorp’s Albert Ipsum and Romeo Lorem, as well as RoboTech’s Dr. Ipsum Dolor and Dr. Sit Amet, showcased the latest technologies in automation, artificial intelligence, and robotics.\r\n\r\nThe presentations underscored the commitment of Lorem Ipsum University to align education with the evolving demands of the industry. Dr. John Doe emphasized the importance of staying ahead in technological advancements to prepare students for the dynamic global landscape.\r\n\r\nNotably, the event provided a hands-on experience, with one teacher having the unique opportunity to try DroneSoccer. This exemplifies Lorem Ipsum University’s commitment to integrating technology into education in a practical manner.\r\n\r\nHosted by Ms. Virginia Ipsum, future collaboration between Lorem Ipsum University, TechCorp, and RoboTech signifies a strategic move towards fostering an innovative learning environment. As the institution embraces these advancements, it positions itself as a forward-thinking entity dedicated to preparing students for the challenges and opportunities of the Fourth Industrial Revolution.\r\n\r\nLIU for Industry 4.0\r\n\r\nLIU Cares', 'Commodi quidem at molestias consequuntur soluta ratione ad quis temporibus.', 'conference', '2024-10-28 15:44:08'),
(16, 'Investor Marketing Administrator', '2025-07-28', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Last Saturday, the Lorem Ipsum University witnessed a transformative event at the Main Hall. The initiative, led by Chairman and President Dr. John Doe, aimed to prepare the institution for the challenges of Industry 4.0.\r\n\r\nThe Basic Education faculty, Department Heads, and Vice President Engr. Jane Smith attended the orientation, where TechCorp’s Albert Ipsum and Romeo Lorem, as well as RoboTech’s Dr. Ipsum Dolor and Dr. Sit Amet, showcased the latest technologies in automation, artificial intelligence, and robotics.\r\n\r\nThe presentations underscored the commitment of Lorem Ipsum University to align education with the evolving demands of the industry. Dr. John Doe emphasized the importance of staying ahead in technological advancements to prepare students for the dynamic global landscape.\r\n\r\nNotably, the event provided a hands-on experience, with one teacher having the unique opportunity to try DroneSoccer. This exemplifies Lorem Ipsum University’s commitment to integrating technology into education in a practical manner.\r\n\r\nHosted by Ms. Virginia Ipsum, future collaboration between Lorem Ipsum University, TechCorp, and RoboTech signifies a strategic move towards fostering an innovative learning environment. As the institution embraces these advancements, it positions itself as a forward-thinking entity dedicated to preparing students for the challenges and opportunities of the Fourth Industrial Revolution.\r\n\r\nLIU for Industry 4.0\r\n\r\nLIU Cares', 'Aspernatur explicabo odit sequi architecto quia nihil facere unde voluptatibus.', 'workshop', '2024-10-28 15:44:22'),
(17, 'Forward Program Agent', '2001-06-10', 'With the theme of “Building a legacy of learning: celebrating 20 years of education,” Lyceum of Alabang (LoA) conducts Employees’ Day at the Danilo V. Ayap (DVA) gymnasium on Saturday, October 28.\r\n\r\nHighlights of the day include various games played by all faculty and staff of LoA, including: Kiwkiw, T-Shirt Relay, Dodgeball, Toilet Paper Challenge, and Egg throw. A zumba dance led by P.E. teachers and presentation of teams in their respective colors, and a photo opportunity and prayer led by Ms. Virginia Santos.\r\n\r\nThe newly elected Supreme Student Council (SSC) and Commission on Student Election (COMSELEC) facilitated the entire day.\r\n\r\nCaption by Roxy Esmores and Junimar Trazares\r\n\r\nPhotos by Kyla Athena Ambuya and Keith Ambuya', 'Doloribus minima nesciunt explicabo repellat suscipit at.', 'seminar', '2024-11-04 01:59:57'),
(18, 'Regional Program Manager', '2024-12-26', 'Nostrum suscipit vel est perferendis nam.', 'Dolores officia minus quae temporibus numquam itaque.', 'workshop', '2024-11-13 01:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `event_images`
--

CREATE TABLE `event_images` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_images`
--

INSERT INTO `event_images` (`id`, `event_id`, `image_path`) VALUES
(14, 10, 'uploads-events/image_slider1.jpg'),
(15, 10, 'uploads-events/image_slider2.jpg'),
(16, 10, 'uploads-events/image_slider3.jpg'),
(17, 11, 'uploads-events/image_slider3.jpg'),
(18, 11, 'uploads-events/image_slider4.jpg'),
(19, 11, 'uploads-events/image_slider5.jpg'),
(20, 12, 'uploads-events/image_slider6.jpg'),
(21, 12, 'uploads-events/image_slider7.jpg'),
(22, 12, 'uploads-events/image_slider8.jpg'),
(23, 13, 'uploads-events/image_slider4.jpg'),
(24, 13, 'uploads-events/image_slider5.jpg'),
(25, 14, 'uploads-events/image_slider2.jpg'),
(26, 14, 'uploads-events/image_slider8.jpg'),
(27, 14, 'uploads-events/index-background.png'),
(28, 15, 'uploads-events/image_slider2.jpg'),
(29, 15, 'uploads-events/image_slider3.jpg'),
(30, 15, 'uploads-events/image_slider5.jpg'),
(31, 16, 'uploads-events/image_slider4.jpg'),
(32, 16, 'uploads-events/image_slider5.jpg'),
(33, 16, 'uploads-events/image_slider6.jpg'),
(34, 17, 'uploads-events/image_slider1.jpg'),
(35, 17, 'uploads-events/image_slider2.jpg'),
(36, 17, 'uploads-events/image_slider3.jpg'),
(37, 18, 'uploads-events/stud - Copy.png'),
(38, 18, 'uploads-events/stud.png');

-- --------------------------------------------------------

--
-- Table structure for table `event_likes`
--

CREATE TABLE `event_likes` (
  `event_id` int(11) NOT NULL,
  `likes_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_likes`
--

INSERT INTO `event_likes` (`event_id`, `likes_count`) VALUES
(10, 2),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `FullNameSender` varchar(120) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `FullNameReceiver` varchar(120) NOT NULL,
  `receiverType` enum('Admin','student','OSA','Organization') NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `sender`, `FullNameSender`, `receiver`, `FullNameReceiver`, `receiverType`, `subject`, `body`, `status`, `created_at`, `seen`) VALUES
(1, '123-456', 'Rogel Gerodiaz', '1422-21', 'Helen R Patalbo', 'OSA', 'Summon', 'adminnn toooo', 'sent', '2024-11-01 22:38:28', 0),
(2, '1422-21', 'Helen Patalbo', '123-456', 'Rogel R Gerodiaz', 'Admin', 'Summon', 'osaa tooo', 'sent', '2024-11-01 22:46:12', 1),
(5, '123-456', 'Rogel Gerodiaz', '1422-21', 'Helen R Patalbo', 'OSA', 'Summon', '\r\n        Dear [Recipient Name],\r\n\r\n        I hope this message finds you well. I am writing to inform you about [Subject].\r\n\r\n        [Body of the letter]\r\n\r\n        Best regards,\r\n        [Your Name]\r\n    ', 'sent', '2024-11-01 23:45:53', 0),
(6, '1422-21', 'Helen Patalbo', '123-456', 'Rogel R Gerodiaz', 'Admin', 'Summon', '\r\n        Dear [Recipient Name],\r\n\r\n        I hope this message finds you well. I am writing to inform you about [Subject].\r\n\r\n        [Body of the letter]\r\n\r\n        Best regards,\r\n        [Your Name]\r\n    ', 'sent', '2024-11-01 23:46:46', 1),
(7, '1422-21', 'Helen Patalbo', '1169-21', 'Rogel Ramos Gerodiaz', 'student', 'Summon', 'student ka from osa', 'sent', '2024-11-01 23:50:37', 0),
(8, '123-456', 'Rogel R Gerodiaz', '1169-21', 'Rogel Ramos Gerodiaz', 'student', 'Summon', 'student ka admin ako', 'sent', '2024-11-01 23:51:07', 1),
(9, '543-21', 'Lebron James', '1169-21', 'Rogel Ramos Gerodiaz', 'student', 'Summon', 'org to student kaaaaa', 'sent', '2024-11-02 20:31:59', 1),
(10, '543-21', 'Lebron James', '1422-21', 'Helen R Patalbo', 'OSA', 'Summon', 'osa ka org akooo', 'sent', '2024-11-02 20:34:50', 1),
(11, '543-21', 'Lebron James', '123-456', 'Rogel R Gerodiaz', 'Admin', 'Summon', 'admin ka org akoooo', 'sent', '2024-11-02 20:35:06', 1),
(12, '123-456', 'Rogel R Gerodiaz', '543-21', 'Lebron R James', 'Organization', 'Summon', 'org ka admin akoooo', 'sent', '2024-11-02 20:46:57', 0),
(13, '1422-21', 'Helen Patalbo', '543-21', 'Lebron R James', 'Organization', 'Summon', 'org ka osa akoooo', 'sent', '2024-11-02 20:50:33', 0),
(14, '1422-21', 'Helen Patalbo', '1169-21', 'Rogel Ramos Gerodiaz', 'student', 'Summon', 'for alerts test', 'sent', '2024-11-09 05:30:17', 1),
(15, '1422-21', 'Helen Patalbo', '1169-21', 'Rogel Ramos Gerodiaz', 'student', 'Summon', 'for alerts test', 'sent', '2024-11-09 05:30:17', 0),
(32, '1422-21', 'Helen Patalbo', '1169-21', 'Rogel Ramos Gerodiaz', 'student', 'Testing', 'test', 'sent', '2024-11-11 11:58:33', 1),
(36, '1422-21', 'Helen Patalbo', '123-456', 'Rogel R Gerodiaz', 'Admin', 'test', 'testing', 'sent', '2024-11-11 14:28:30', 1),
(37, '123-456', 'Rogel R Gerodiaz', '1422-21', 'Helen R Patalbo', 'OSA', 'Testing', 'testttt', 'sent', '2024-11-11 14:35:36', 1),
(38, '123-456', 'Rogel R Gerodiaz', '543-21', 'Lebron R James', 'Organization', 'test', 'test', 'sent', '2024-11-11 15:30:46', 1),
(39, '543-21', 'Lebron James', '1169-21', 'Rogel Ramos Gerodiaz', 'student', 'TESTIN', 'ORG FILE TESTING', 'sent', '2024-11-11 15:39:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_attachments`
--

CREATE TABLE `message_attachments` (
  `AttachmentID` int(11) NOT NULL,
  `MessageID` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_attachments`
--

INSERT INTO `message_attachments` (`AttachmentID`, `MessageID`, `file_path`) VALUES
(6, 32, 'uploads-messages/e8e2a415-753d-464a-8970-2896e692909e - Copy.jpg'),
(7, 32, 'uploads-messages/e8e2a415-753d-464a-8970-2896e692909e.jpg'),
(8, 32, 'uploads-messages/botooo.png'),
(9, 32, 'uploads-messages/Progress-Report-10.docx'),
(10, 36, 'uploads-messages/Progress-Report-10 (1).docx'),
(11, 36, 'uploads-messages/stud - Copy.png'),
(12, 36, 'uploads-messages/stud.png'),
(13, 37, 'uploads-messages/Bloggers-Freedom-of-Expression-and-Libel-Law-Group-1.pdf'),
(14, 37, 'uploads-messages/OSA_SendMessage (3).php'),
(15, 37, 'uploads-messages/OSA_SendMessage (2).php'),
(16, 38, 'uploads-messages/boto.jpg'),
(17, 38, 'uploads-messages/Group-1_20241106_231809_0000.pptx'),
(18, 38, 'uploads-messages/Bloggers-Freedom-of-Expression-and-Libel-Law-Group-1.pdf'),
(19, 39, 'uploads-messages/Group-1_20241106_231809_0000.pptx'),
(20, 39, 'uploads-messages/Bloggers-Freedom-of-Expression-and-Libel-Law-Group-1.pdf'),
(21, 39, 'uploads-messages/IMG20230819121825 (1) (1).jpg'),
(22, 39, 'uploads-messages/IMG20230819121825 (1).jpg'),
(23, 39, 'uploads-messages/OSA_SendMessage (3).php'),
(24, 39, 'uploads-messages/OSA_SendMessage (2).php');

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `SchoolYearID` int(11) NOT NULL,
  `Year` varchar(20) NOT NULL,
  `IsCurrent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`SchoolYearID`, `Year`, `IsCurrent`) VALUES
(1, '2022-2023', 0),
(2, '2023-2024', 0),
(4, '2024-2025', 1);

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
  `FiledDate` date DEFAULT NULL,
  `ReportAttachment` varchar(255) DEFAULT NULL,
  `WrittenReprimandAttachment` varchar(255) DEFAULT NULL,
  `SanctionLetterAttachment` varchar(255) DEFAULT NULL,
  `ComplainantNumber` varchar(255) DEFAULT NULL,
  `Affiliation` varchar(255) DEFAULT NULL,
  `SchoolYear` varchar(255) DEFAULT NULL,
  `Semester` varchar(120) NOT NULL,
  `FiledBy` varchar(255) DEFAULT NULL,
  `CaseResolution` varchar(255) DEFAULT NULL,
  `Remarks` text DEFAULT NULL,
  `ResolutionAttachment` varchar(255) DEFAULT NULL,
  `ResolutionDate` date DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `LiftLetter` varchar(255) DEFAULT NULL,
  `StartLetter` varchar(255) DEFAULT NULL,
  `LiftingRemark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcases`
--

INSERT INTO `tblcases` (`CaseID`, `StudentID`, `FullName`, `Email`, `Offense`, `OffenseCategory`, `Sanction`, `Complainant`, `Status`, `FiledDate`, `ReportAttachment`, `WrittenReprimandAttachment`, `SanctionLetterAttachment`, `ComplainantNumber`, `Affiliation`, `SchoolYear`, `Semester`, `FiledBy`, `CaseResolution`, `Remarks`, `ResolutionAttachment`, `ResolutionDate`, `StartDate`, `EndDate`, `LiftLetter`, `StartLetter`, `LiftingRemark`) VALUES
(27, '1169-21', 'Rogel Ramos Gerodiaz', 'gerodiazrogel0@gmail.com', 'Violation with Legal Implications - Possession use, or sale of illegal drugs (RA 9165) inside the school premises and entering the school while intoxicated', 'Major', 'First offense - Suspension for a period of not less than five (5) days.', 'Phillip Andro G. Banag', 'Resolved', '2024-10-14', '../fileattachment/Febuary-Contract.pdf', NULL, NULL, '0923322545', 'Faculty', '2024-2025', '1st Semester', 'Helen Patalbo', 'Resolved - Suspension 5 Days', 'asdvcvbccasvdvxc', '../fileattachment/Midterm - Assignment 1 - Gerodiaz Rogel R.pdf', '2024-10-14', '2024-10-11', '2024-10-14', NULL, '../suspensionfiles/WEBCRAFT-Final-Manuscript.pdf', NULL),
(28, '6911-21', 'Devante Hilton Arm Tillman', 'your.email+fakedata96535@gmail.com', 'Violation with Legal Implications - Violation of RA 8049 (Anti-Hazing Act)', 'Major', 'First offense - Suspension for a period of not less than five (5) days.', 'Phillip Andro G. Banag', 'Ongoing', '2024-10-14', '../fileattachment/Untitled (Poster).pdf', NULL, NULL, '0923322545', 'Faculty', '2024-2025', '1st Semester', 'Helen Patalbo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '4372-31', 'Ronny Bette Wind Gibson', 'your.email+fakedata57452@gmail.com', 'Violation with Legal Implications - Violation of RA 7877 (Anti-sexual Harassment)', 'Major', 'First offense - Suspension for a period of not less than five (5) days.', 'Phillip Andro G. Banag', 'Pending Suspension', '2024-10-14', '../fileattachment/my-resume.pdf', NULL, NULL, '0923322545', 'Faculty', '2024-2025', '1st Semester', 'Helen Patalbo', 'Resolved - Suspension 5 Days', 'axzxcszxcczx', '../fileattachment/4503-1871-0548-0651.pdf', '2024-10-14', NULL, NULL, '', '', ''),
(33, '1169-21', 'Rogel Ramos Gerodiaz', 'gerodiazrogel0@gmail.com', 'Noncompliance of Academic Requirements - Truancy or cutting classes', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Resolved - Verbal Reprimand', '2024-10-15', '../fileattachment/4503-1871-0548-0651.pdf', NULL, NULL, '0923322545', 'Faculty', '2021-2022', '2nd Semester', 'Helen Patalbo', 'Resolved - Verbal Reprimand', 'mnbdakjbsjkanxcjk mkadmakw', '../fileattachment/Untitled (Poster).pdf', '2024-10-19', NULL, NULL, NULL, NULL, NULL),
(34, '7742-32', 'Jamir Sanford Bo Kohler', 'your.email+fakedata72573@gmail.com', 'Behavior in Campus - Violation on ID - Lending one\'s ID', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Resolved - Verbal Reprimand', '2024-09-19', '../fileattachment/RESUME.pdf', NULL, NULL, '0923322545', 'Faculty', '2024-2025', '2nd Semester', 'Helen Patalbo', 'Resolved - Verbal Reprimand', 'edads', '../fileattachment/Febuary-Contract.pdf', '2024-09-19', NULL, NULL, NULL, NULL, NULL),
(35, '1932-21', 'Kyleigh Ethelyn Zi Bailey', 'your.email+fakedata33120@gmail.com', 'Behavior in Campus - Violation on ID - Tampering with ID', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Resolved - Verbal Reprimand', '2024-09-19', '../fileattachment/RANIEL PLATE - update.pdf', NULL, NULL, '0923322545', 'Faculty', '2024-2025', '1st Semester', 'Helen Patalbo', 'Resolved - Verbal Reprimand', 'adsgghjn', '../fileattachment/Pragmatic Programmer.pdf', '2024-08-19', NULL, NULL, NULL, NULL, NULL),
(36, '3234-21', 'Allan Cecile Cas Bashirian-Goodwin', 'your.email+fakedata12001@gmail.com', 'Behavior in Campus - Engaging in bullying', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Resolved - Verbal Reprimand', '2024-07-19', '../fileattachment/SKYO 2024 TEAM GALLERY BASKETBALL TOURNAMENT.pdf', NULL, NULL, '0923322545', 'Faculty', '2024-2025', '1st Semester', 'Helen Patalbo', 'Resolved - Verbal Reprimand', 'ggbcvesfdf', '../fileattachment/Grey And White Neutral Modern Professional Teacher Resume.pdf', '2024-07-19', NULL, NULL, NULL, NULL, NULL),
(38, '4084-21', 'Toney Bette Absh Towne', 'your.email+fakedata43820@gmail.com', 'Attitude inside the Classroom - Classroom mischief, failure to turn off or put on silent the mobile phone', 'Minor', 'First offense - Verbal reprimand or censure', 'Phillip Andro G. Banag', 'Resolved - Verbal Reprimand', '2024-06-19', '', NULL, NULL, '0923322545', 'Faculty', '2021-2022', '1st Semester', 'Helen Patalbo', 'Resolved - Verbal Reprimand', 'fsdgwasdfsada', '../fileattachment/Coloring Book - Animal.pdf', '2024-09-19', NULL, NULL, NULL, NULL, NULL),
(39, '3234-21', 'Allan Cecile Cas Bashirian-Goodwin', 'your.email+fakedata12001@gmail.com', 'Noncompliance of Academic Requirements - Truancy or cutting classes', 'Minor', 'Second offense - Written reprimand', 'Phillip Andro G. Banag', 'Resolved - Written Reprimand', '2024-10-19', '../fileattachment/Garry Resume.pdf', NULL, NULL, '0923322545', 'Faculty', '2024-2025', '1st Semester', 'Helen Patalbo', 'Resolved - Written Reprimand', 'dawdasdsawdadsz', '../fileattachment/Grey And White Neutral Modern Professional Teacher Resume.pdf', '2024-10-19', NULL, NULL, NULL, NULL, NULL),
(40, '1169-21', 'Rogel Ramos Gerodiaz', 'gerodiazrogel0@gmail.com', 'Violation with Legal Implications - Possession, use, or sale of cigarettes (RA 9211) / e-cigarettes (Vape). Possession of alcoholic beverages or reporting inside the campus while intoxicated', 'Major', 'Second offense - Suspension for a period of one (1) - two (2) weeks.', 'Phillip Andro G. Banag', 'Suspended', '2024-10-22', '../fileattachment/Rogel Gerodiaz Resume.pdf', NULL, NULL, '0923322545', 'Faculty', '2021-2022', '1st Semester', 'Helen Patalbo', 'Resolved - Suspension 1-2 Weeks', 'ndajndnkawbnmslz,c;aw,;,l', '../fileattachment/4503-1871-0548-0651.pdf', '2024-10-22', '2024-10-22', '2024-11-27', NULL, '../suspensionfiles/Simple_email_inbox_page.html', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers_organization`
--

CREATE TABLE `tblusers_organization` (
  `OrgID` int(11) NOT NULL,
  `Org_number` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `MiddleName` varchar(10) NOT NULL,
  `Suffix` varchar(12) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `PhoneNumber` int(22) NOT NULL,
  `DateBirth` varchar(24) NOT NULL,
  `Gender` varchar(24) NOT NULL,
  `Nationality` varchar(32) NOT NULL,
  `MaritalStatus` varchar(24) NOT NULL,
  `Status` varchar(12) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `lock_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers_organization`
--

INSERT INTO `tblusers_organization` (`OrgID`, `Org_number`, `FirstName`, `LastName`, `Username`, `Password`, `Role`, `MiddleName`, `Suffix`, `Email`, `PhoneNumber`, `DateBirth`, `Gender`, `Nationality`, `MaritalStatus`, `Status`, `profile_picture`, `failed_attempts`, `lock_time`) VALUES
(1, '543-21', 'Lebron', 'James', 'organization', '987654321', 'Organization', 'R', 'N/A', 'org1@gmail.com', 909313675, '06/10/2001', 'Male', 'Filipino', 'Single', 'Active', NULL, 1, NULL);

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
  `Role` varchar(255) NOT NULL,
  `MiddleName` varchar(10) NOT NULL,
  `Suffix` varchar(12) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `PhoneNumber` int(22) NOT NULL,
  `DateBirth` varchar(24) NOT NULL,
  `Gender` varchar(24) NOT NULL,
  `Nationality` varchar(32) NOT NULL,
  `MaritalStatus` varchar(24) NOT NULL,
  `Status` varchar(12) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `lock_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers_osa`
--

INSERT INTO `tblusers_osa` (`UserID`, `OSA_number`, `FirstName`, `LastName`, `Username`, `Password`, `Role`, `MiddleName`, `Suffix`, `Email`, `PhoneNumber`, `DateBirth`, `Gender`, `Nationality`, `MaritalStatus`, `Status`, `profile_picture`, `failed_attempts`, `lock_time`) VALUES
(1, '1422-21', 'Helen', 'Patalbo', 'patalbohelen', '123456789', 'OSA', 'R', 'N/A', 'rogelgerodiaz@gmail.com', 925251254, '06/24/1995', 'Female', 'Filipino', 'Married', 'Active', '../osa_profiles_upload/4.png', 1, NULL),
(2, '1223-41', 'Rogel', 'Gerodiaz', 'rogelgerodiaz', '123456789', 'OSA', '', '', 'osa@gmail.com', 0, '', '', '', '', '', NULL, 0, NULL);

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
  `profile_picture` varchar(255) DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `lock_time` datetime DEFAULT NULL,
  `SchoolYearID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers_student`
--

INSERT INTO `tblusers_student` (`UserID`, `StudentID`, `FirstName`, `LastName`, `MiddleName`, `Suffix`, `Course`, `YearLevel`, `StudentType`, `Email`, `PhoneNumber`, `DateBirth`, `Address`, `Gender`, `Nationality`, `EmergencyContact`, `MaritalStatus`, `GuardiansName`, `GuardiansContact`, `Username`, `Password`, `Role`, `Status`, `profile_picture`, `failed_attempts`, `lock_time`, `SchoolYearID`) VALUES
(1, '6911-21', 'Devante', 'Tillman', 'Hilton Arm', 'V', 'Bachelor of Science in Psychology', '3rd Year', 'Regular', 'patalbo@gmail.com', 425, '2024-08-21', '295 Corwin Run', 'Female', 'Utica', 421, 'Married', 'Adan Buckridge', 295, 'Gust.Kshlerin-Gleichner', 'f8MDbl_LfpUy7Nq', 'student', 'active', NULL, 1, NULL, NULL),
(2, '1169-21', 'Rogel', 'Gerodiaz', 'Ramos', 'N/A', 'Bachelor of Science in Information Technology', '3rd Year', 'Regular', 'gerodiazrogel1@gmail.com', 2147483647, '2001-06-10', 'JASMIN', 'Male', 'Filipino', 321, 'Single', 'Evelyn Gerodiaz', 174, 'gerodiazrogel', '123456789', 'student', 'active', '../uploads/me.jpg', 2, NULL, NULL),
(3, '4084-21', 'Toney', 'Towne', 'Bette Absh', 'III', 'Bachelor of Science in Engineering', '3rd Year', 'Irregular', 'your.email+fakedata43820@gmail.com', 841, '2025-02-01', '5517 Gusikowski Ford', 'Other', 'Catonsville', 822, 'Widowed', 'Shane Gorczany', 587, 'Dixie_Franecki', '39tTrYeVmpGkV8H', 'student', 'inactive', NULL, 1, NULL, NULL),
(4, '3234-21', 'Allan', 'Bashirian-Goodwin', 'Cecile Cas', 'III', 'Bachelor of Science in Computer Science', '3rd Year', 'Irregular', 'your.email+fakedata12001@gmail.com', 596, '2023-10-29', '782 Angel Glens', 'Other', 'Rancho Palos Verdes', 548, 'Single', 'George Bode', 991, 'Alayna_Cole', 'YZ2ccyvghAJezBF', 'student', 'active', NULL, 0, NULL, NULL),
(5, '7742-32', 'Jamir', 'Kohler', 'Sanford Bo', 'Sr', 'Bachelor of Science in Psychology', '3rd Year', 'Irregular', 'your.email+fakedata72573@gmail.com', 952, '2024-11-13', '682 Stacy Stream', 'Male', 'Palm Harbor', 488, 'Married', 'Julie Carroll', 232, 'Tomas25', 'Z3jFV6QXelqX_Rp', 'student', 'active', NULL, 0, NULL, NULL),
(6, '4232-21', 'Jamey', 'Bosco', 'Dandre Bre', 'Sr', 'Bachelor of Science in Business Administration', '3rd Year', 'Irregular', 'your.email+fakedata42530@gmail.com', 921, '2024-06-27', '8369 Hodkiewicz Route', 'Other', 'Spring Valley', 243, 'Divorced', 'Everett Beier', 616, 'General.Legros', 'AQMX6GobitT3KKh', 'student', 'active', NULL, 0, NULL, NULL),
(7, '4372-31', 'Ronny', 'Gibson', 'Bette Wind', 'Sr', 'Bachelor of Science in Engineering', '3rd Year', 'Regular', 'your.email+fakedata57452@gmail.com', 307, '2024-04-26', '8566 Ken Fields', 'Male', 'Porterville', 69, 'Divorced', 'Kamille McLaughlin', 752, 'Isom26', 'OpBJWExaCgdKy68', 'student', 'inactive', NULL, 0, NULL, NULL),
(8, '3272-21', '', 'Swaniawski', 'Meaghan Re', 'Sr', 'Bachelor of Science in Education', '2nd Year', 'Irregular', 'your.email+fakedata76110@gmail.com', 919, '2025-07-20', '51807 Beaulah Creek', 'Female', 'Lompoc', 67, 'Divorced', 'Casandra Hoppe', 444, 'Vida.Williamson66', 'Ql1TGov1AzrMyPe', 'student', 'active', NULL, 0, NULL, NULL),
(9, '1932-21', 'Kyleigh', 'Bailey', 'Ethelyn Zi', 'Jr', 'Bachelor of Science in Information Technology', '2nd Year', 'Irregular', 'your.email+fakedata33120@gmail.com', 237, '2024-06-10', '606 Brittany Hollow', 'Female', 'Miami Gardens', 849, 'Single', 'Berry Wyman', 683, 'Jaleel4', 'ktGJiHEmnoAP18V', 'student', 'active', NULL, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `idx_admin_number` (`AdminNumber`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_images`
--
ALTER TABLE `event_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `event_likes`
--
ALTER TABLE `event_likes`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `message_attachments`
--
ALTER TABLE `message_attachments`
  ADD PRIMARY KEY (`AttachmentID`),
  ADD KEY `MessageID` (`MessageID`);

--
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
  ADD PRIMARY KEY (`SchoolYearID`);

--
-- Indexes for table `tblcases`
--
ALTER TABLE `tblcases`
  ADD PRIMARY KEY (`CaseID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `tblusers_organization`
--
ALTER TABLE `tblusers_organization`
  ADD PRIMARY KEY (`OrgID`);

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
  ADD UNIQUE KEY `StudentID` (`StudentID`),
  ADD KEY `SchoolYearID` (`SchoolYearID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `event_images`
--
ALTER TABLE `event_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `message_attachments`
--
ALTER TABLE `message_attachments`
  MODIFY `AttachmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `SchoolYearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcases`
--
ALTER TABLE `tblcases`
  MODIFY `CaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tblusers_organization`
--
ALTER TABLE `tblusers_organization`
  MODIFY `OrgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers_osa`
--
ALTER TABLE `tblusers_osa`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers_student`
--
ALTER TABLE `tblusers_student`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_images`
--
ALTER TABLE `event_images`
  ADD CONSTRAINT `event_images_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_likes`
--
ALTER TABLE `event_likes`
  ADD CONSTRAINT `event_likes_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `message_attachments`
--
ALTER TABLE `message_attachments`
  ADD CONSTRAINT `message_attachments_ibfk_1` FOREIGN KEY (`MessageID`) REFERENCES `messages` (`MessageID`);

--
-- Constraints for table `tblcases`
--
ALTER TABLE `tblcases`
  ADD CONSTRAINT `tblcases_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `tblusers_student` (`StudentID`);

--
-- Constraints for table `tblusers_student`
--
ALTER TABLE `tblusers_student`
  ADD CONSTRAINT `tblusers_student_ibfk_1` FOREIGN KEY (`SchoolYearID`) REFERENCES `school_years` (`SchoolYearID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
