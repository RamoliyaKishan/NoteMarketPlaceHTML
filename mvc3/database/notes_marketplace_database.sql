-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 05:14 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `note_marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `CountryID` int(11) NOT NULL,
  `CountryName` varchar(100) NOT NULL,
  `CountryCode` varchar(10) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This is master table. Super Admin or Admin can define.';

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`CountryID`, `CountryName`, `CountryCode`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Australia', '040', '2021-02-11 00:11:45', 25, NULL, NULL, 1),
(2, 'Bhutan', '064', '2021-04-06 00:11:53', 25, NULL, NULL, 1),
(3, 'Brazil', '076', '2021-03-16 00:11:58', 20, '2021-04-09 01:20:05', 25, 1),
(4, 'Canada', '124', '2021-02-25 00:12:09', 20, '2021-04-09 01:30:48', 25, 1),
(5, 'India', '91', '2021-03-02 00:12:03', 20, '2021-04-09 01:20:24', 25, 1),
(6, 'UK', '500', '2021-03-17 00:12:23', 20, NULL, NULL, 1),
(7, 'USA', '789', '2021-03-15 00:12:31', 25, NULL, NULL, 1),
(13, 'Pakistan', '62', '2021-04-09 01:28:25', 25, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `DownloadID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `DownloaderID` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(1) NOT NULL DEFAULT b'0',
  `AttachmentPath` mediumtext DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL DEFAULT b'0',
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` bit(1) NOT NULL,
  `PurchasedPrice` decimal(10,0) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`DownloadID`, `NoteID`, `SellerID`, `DownloaderID`, `IsSellerHasAllowedDownload`, `AttachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 13, 32, 29, b'1', '../uploaded files/sample1.pdf', b'1', '2021-04-01 16:22:35', b'1', '50', 'Account', 'IT', '2021-03-12 14:50:46', NULL, '2021-03-13 21:45:57', NULL),
(12, 3, 32, 29, b'1', '../uploaded files/sample2.pdf', b'1', '2021-04-04 16:22:23', b'0', '0', 'bda', 'IT', '2021-03-12 14:50:46', NULL, '2021-03-13 21:46:23', NULL),
(19, 3, 32, 33, b'0', NULL, b'0', NULL, b'1', '80', 'Vanaspati Jivan', 'Biology', '2021-03-12 22:46:02', NULL, '2021-03-22 14:35:19', 32),
(20, 13, 32, 33, b'1', NULL, b'0', NULL, b'1', '80', 'Vanaspati Jivan', 'Biology', '2021-03-12 22:53:24', NULL, '2021-03-27 18:06:47', 32),
(24, 3, 32, 35, b'1', '../uploaded files/sample2.pdf', b'1', '2021-04-10 18:40:20', b'1', '80', 'Vanaspati Jivan', 'Biology', '2021-04-10 17:57:32', 35, '2021-04-10 18:35:41', 32);

-- --------------------------------------------------------

--
-- Table structure for table `note_categories`
--

CREATE TABLE `note_categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Description` mediumtext NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This is master table. Super Admin or Admin can define.';

--
-- Dumping data for table `note_categories`
--

INSERT INTO `note_categories` (`CategoryID`, `CategoryName`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'IT', 'it is a notes of it brnach', '2021-03-05 21:31:50', 25, '2021-04-08 22:52:48', 25, 1),
(2, 'CA', 'it is a notes of CA brnach', '2021-03-04 21:31:50', 25, NULL, 25, 1),
(3, 'MBA', 'it is a notes of MBA brnach', NULL, NULL, NULL, 25, 1),
(4, 'B.Sc', 'it is a notes of B.Sc brnach for gujarat university', NULL, NULL, '2021-04-08 20:20:01', 25, 0),
(5, 'Biology', 'it is a notes of Biology brnach', NULL, NULL, NULL, 25, 1),
(6, 'B.Phaarm', 'it is a notes of B.Phaarm brnach', NULL, NULL, NULL, 25, 1),
(7, 'Other Categories', 'it is a notes of other brnach', NULL, NULL, NULL, 25, 1),
(14, '12th science', 'it is a book of 12th standerd.', '2021-04-08 20:56:45', 25, NULL, NULL, 1),
(15, '10th science', 'it is a book of 10th standerd.', '2021-04-08 21:02:41', 25, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `note_types`
--

CREATE TABLE `note_types` (
  `TypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL,
  `Description` mediumtext NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note_types`
--

INSERT INTO `note_types` (`TypeID`, `TypeName`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Hand written', 'It is Hand written.', '2021-04-01 22:44:24', 25, NULL, NULL, 1),
(2, 'Story Book', 'It is Story Book.', '2021-02-10 22:44:30', 25, NULL, NULL, 1),
(3, 'University notes', 'It is a Univrdity Notes.', '2021-03-12 22:44:37', 25, '2021-04-08 23:51:58', 25, 1),
(4, 'Other Notes', 'other notes', '2021-03-25 22:44:43', NULL, NULL, NULL, 1),
(5, 'Soft Copy', 'it is a pdf of book', '2021-04-08 23:53:45', 25, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reference_data`
--

CREATE TABLE `reference_data` (
  `ReferenceID` int(11) NOT NULL,
  `Value` varchar(100) NOT NULL,
  `DataValue` varchar(100) NOT NULL,
  `RefCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes`
--

CREATE TABLE `seller_notes` (
  `NoteID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'draft',
  `ActionedBy` int(11) DEFAULT NULL,
  `AdminRemarks` mediumtext DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `Category` int(11) NOT NULL DEFAULT 5,
  `DisplayPicture` varchar(500) DEFAULT NULL,
  `Note` varchar(255) NOT NULL,
  `NoteType` int(11) DEFAULT NULL,
  `NumberOfPages` int(11) DEFAULT NULL,
  `Description` mediumtext NOT NULL,
  `UniversityName` varchar(200) DEFAULT NULL,
  `Country` int(11) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseCode` varchar(100) DEFAULT NULL,
  `Professor` varchar(100) DEFAULT NULL,
  `IsPaid` bit(1) NOT NULL DEFAULT b'0',
  `SellingPrice` decimal(10,0) DEFAULT 0,
  `NotesPreview` varchar(500) DEFAULT NULL,
  `CreatedDate` timestamp NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table is for all seller added notes to our portal (Draft,Submitted for Review, In Review, Approved/Published, Rejected or  Removed). ';

--
-- Dumping data for table `seller_notes`
--

INSERT INTO `seller_notes` (`NoteID`, `SellerID`, `Status`, `ActionedBy`, `AdminRemarks`, `PublishedDate`, `Title`, `Category`, `DisplayPicture`, `Note`, `NoteType`, `NumberOfPages`, `Description`, `UniversityName`, `Country`, `Course`, `CourseCode`, `Professor`, `IsPaid`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 32, 'In Review', 25, NULL, '2021-03-01 16:19:44', 'bda', 1, '4K_1Kxnq8pD4fior0h.jpg', 'sample1.pdf', 3, 100, 'It is a very nice book.', 'Tatvasoft', 5, 'Trainee', '2021', 'Prof. Dayanand', b'0', '0', 'preview2.pdf\r\n', '2021-03-02 19:32:38', NULL, '2021-04-03 00:03:17', 25, 1),
(3, 32, 'Published', 25, 'i have receive spam reports', '2021-03-04 18:11:49', 'Vanaspati Jivan', 5, '4K_1Kxnq8pD4fior0h.jpg', 'sample2.pdf', 1, 100, 'it is a very good book', 'collage', 5, 'engineering', '2021', 'Prof. Dayanand', b'1', '80', 'preview1.pdf', '2021-03-06 05:34:14', NULL, '2021-03-31 10:42:03', 25, 1),
(9, 32, 'Draft', NULL, NULL, '2021-03-01 16:19:44', 'Account', 1, '4K_1Kxnq8pD4fior0h.jpg', 'sample1.pdf', 3, 100, 'It is a very nice book.', 'Tatvasoft', 5, 'Trainee', '2021', 'Prof. Dayanand', b'1', '50', 'preview2.pdf', NULL, NULL, '2021-04-02 23:48:13', 25, 0),
(10, 32, 'Rejected', 25, 'copy book', '2021-04-04 20:07:02', 'Vanaspati Jivan', 5, '4K_1Kxnq8pD4fior0h.jpg', 'sample2.pdf', 1, 100, 'it is a very good book', 'collage', 5, 'engineering', '2021', 'Prof. Dayanand', b'1', '80', 'preview1.pdf', '2021-03-06 05:34:14', NULL, '2021-04-04 20:07:02', 25, 0),
(13, 29, 'Published', 25, NULL, '2021-02-10 22:52:30', 'computer science', 2, 'computer-science.png', 'sample1.pdf', 3, 25, 'it is a really very nice book.', 'collage', 5, 'B.E.', '2141005', 'unknown', b'1', '100', 'preview2.pdf', '2021-03-19 17:35:10', 29, '2021-04-02 23:48:13', 25, 1),
(14, 29, 'Rejected', 25, 'copy book', NULL, 'computer science', 2, 'computer-science.png', 'sample2.pdf', 3, 25, 'It is a really very nice book', 'collage', 1, 'B.E.', '2141005', 'unknown', b'1', '100', 'preview1.pdf', '2021-03-19 17:39:07', 29, '2021-04-02 23:58:30', 25, 0),
(17, 29, 'Submited for Review', 25, NULL, '2021-03-22 23:02:23', 'Python', 5, '', '', 1, 100, 'it is a very good book', 'MTU', 5, 'engineering', '2021', 'Prof. Ramlal', b'1', '80', 'preview2.pdf', '2021-03-27 14:29:40', 32, '2021-04-02 23:48:13', 25, 1),
(35, 35, 'Published', 25, 'last 2 yeasr paper is missing', '2021-04-10 21:38:36', 'Current Afair', 14, 'images.jpg', 'sample3.pdf', 5, 503, 'good for exam', 'none', 5, 'GPSC', '', '', b'1', '390', 'preview3.pdf', '2021-04-10 16:06:38', 35, '2021-04-10 21:43:55', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes_reported_issues`
--

CREATE TABLE `seller_notes_reported_issues` (
  `ReportedIssuesID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReportedBYID` int(11) NOT NULL,
  `DownloadID` int(11) NOT NULL,
  `Remarks` mediumtext NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table is for managing the inappropriate issues raised for each notes. ';

--
-- Dumping data for table `seller_notes_reported_issues`
--

INSERT INTO `seller_notes_reported_issues` (`ReportedIssuesID`, `NoteID`, `ReportedBYID`, `DownloadID`, `Remarks`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(13, 13, 29, 1, 'it is oldest version book.', '2021-03-27 09:38:56', 29, NULL, NULL),
(14, 3, 29, 12, 'it is old version book', '2021-03-27 09:57:00', 29, NULL, NULL),
(26, 3, 35, 24, 'last chapte is missing', '2021-04-10 20:01:22', 35, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes_reviews`
--

CREATE TABLE `seller_notes_reviews` (
  `NoteReviewID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReviewedByID` int(11) NOT NULL,
  `DownloadID` int(11) NOT NULL,
  `Ratings` decimal(10,0) NOT NULL,
  `Comments` mediumtext NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table is for managing the reviews for each notes. ';

--
-- Dumping data for table `seller_notes_reviews`
--

INSERT INTO `seller_notes_reviews` (`NoteReviewID`, `NoteID`, `ReviewedByID`, `DownloadID`, `Ratings`, `Comments`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 9, 29, 12, '4', 'it is good book', '2021-03-27 10:06:58', 29, NULL, NULL, b'1'),
(2, 3, 29, 12, '5', 'good book', '2021-03-27 10:08:39', 29, NULL, NULL, b'1'),
(26, 3, 35, 24, '4', 'good for quick exam preparation', '2021-04-11 08:39:50', 35, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `system_configurations`
--

CREATE TABLE `system_configurations` (
  `SystemConfigID` int(11) NOT NULL,
  `KeyName` varchar(100) NOT NULL,
  `Value` mediumtext NOT NULL,
  `CreatedDate` mediumtext DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_configurations`
--

INSERT INTO `system_configurations` (`SystemConfigID`, `KeyName`, `Value`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'AdminEmail', 'notemarketplace01@gmail.com', '', NULL, NULL, NULL, b'1'),
(2, 'SupportEmail', 'notemarketplace00@gmail.com', '', NULL, NULL, NULL, b'1'),
(3, 'FromSupportEmail', 'notemarketplace01@gmail.com', '2021-04-10 21:50:22', 25, NULL, NULL, b'1'),
(4, 'SupportPhoneNo', '9549453412', '2021-04-10 21:50:22', 25, NULL, NULL, b'1'),
(5, 'ToSupportEmail', 'notemarketplace00@gmail.com', '2021-04-10 21:50:22', 25, NULL, NULL, b'1'),
(6, 'FacebookUrl', '', '2021-04-10 21:50:22', 25, NULL, NULL, b'1'),
(7, 'TwitterUrl', '', '2021-04-10 21:50:22', 25, NULL, NULL, b'1'),
(8, 'LinkdinUrl', '', '2021-04-10 21:50:22', 25, NULL, NULL, b'1'),
(9, 'DefaultProfilePicture', 'customer-2.png', '2021-04-10 21:50:22', 25, NULL, NULL, b'1'),
(10, 'DefaultNotePicture', 'default_profile.png', '2021-04-10 21:50:22', 25, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UsersID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL DEFAULT 1,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `IsEmailVerified` bit(1) NOT NULL DEFAULT b'0',
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `IsEmailVerified`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(2, 1, 'jay', 'patel', 'jaypatel123@gmail.com', 'f0e7d0d17cff891edbc9cdf92dcd9297', b'0', '2021-03-13 21:36:29', NULL, NULL, NULL, 1),
(3, 1, 'ram', 'kumar', 'ramkumar123@gmail.com', '6a557ed1005dddd940595b8fc6ed47b2', b'0', '2021-04-03 21:36:35', NULL, '2021-04-09 18:02:59', 25, 0),
(4, 2, 'raj', 'kumar', 'rajkumar123@gmail.com', 'cac5ff630494aa784ce97b9fafac2500', b'0', '2021-03-04 21:36:19', NULL, '2021-04-08 12:41:45', 25, 0),
(20, 2, 'priya', 'patel', 'priyapatel123@gmail.com', '48467d2cc726e8847fbc51f5b0bdc1d1', b'0', '2021-04-02 21:36:14', NULL, '2021-04-08 12:44:54', 25, 1),
(23, 3, 'pinal', 'billa', 'pinalbilla123@gmail.com', '2d428fd9df10e95e650fc965df6a21a6', b'0', '2021-04-01 21:35:43', NULL, NULL, NULL, 0),
(25, 2, 'abhi', 'shah', 'abhishah123@gmail.com', '167784d36ab99e49738fe6a6a98798b7', b'1', '2021-04-01 21:35:27', NULL, '2021-04-06 23:52:52', 25, 1),
(29, 1, 'soham', 'gajera', 'sohamgajera123@gmail.com', 'a0a8416e386c7bf4e5cae1c362106e95', b'1', '2021-03-31 21:35:14', NULL, NULL, NULL, 1),
(32, 1, 'kishan', 'ramoliya', 'kishanramoliya543@gmail.com', 'c53545c8c3ef8fd26bfd00f23d1bd995', b'1', '2021-03-17 21:35:07', NULL, NULL, NULL, 1),
(33, 1, 'ankur', 'chovatiya', 'ankur.chovatiya1856@gmail.com', 'e104c000ba2bf871deada58d00203f70', b'0', '2021-04-02 21:35:01', NULL, NULL, NULL, 1),
(35, 1, 'virat', 'kohli', 'theviratkohli123@gmail.com', 'c40465f02b7642fada5c8acd79440141', b'1', '2021-03-26 12:48:59', 35, '2021-03-26 19:04:48', 35, 1),
(46, 2, 'lokesh', 'rahul', 'lokeshrahul123@gmail.com', '30b584ad37b973e0b4beda3f49093431', b'0', '2021-04-10 17:06:50', 25, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `UserProfileID` int(11) NOT NULL,
  `UsersID` int(11) NOT NULL,
  `SecondEmailID` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` varchar(11) DEFAULT NULL,
  `PhoneCountryCode` varchar(10) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `ProfilePicture` varchar(500) DEFAULT NULL,
  `Address1` varchar(100) NOT NULL,
  `Address2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(50) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `Collage` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`UserProfileID`, `UsersID`, `SecondEmailID`, `DOB`, `Gender`, `PhoneCountryCode`, `PhoneNumber`, `ProfilePicture`, `Address1`, `Address2`, `City`, `State`, `ZipCode`, `Country`, `University`, `Collage`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 29, NULL, '2000-01-01', 'male', '+91', '9786453120', 'customer-1.png', 'SG Highway', 'Ahmedabad', 'Ahmedabad', 'Gujarat', '382500', '5', 'GTU', 'any', '2021-03-20 18:23:12', 29, '2021-03-21 10:26:23', 29),
(3, 25, '', NULL, NULL, '91', '9786453111', 'profile1.jpg', '', '', '', '', '', '', NULL, NULL, '2021-04-06 22:44:19', 25, '2021-04-08 16:14:35', 25),
(22, 20, '', NULL, NULL, '064', '9756453061', '', '', '', '', '', '', '', NULL, NULL, '2021-04-06 22:44:19', 25, '2021-04-08 16:13:27', 25),
(26, 46, NULL, NULL, NULL, '124', '9549453654', NULL, '', '', '', '', '', '', NULL, NULL, '2021-04-10 17:06:50', 25, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `RoleID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`RoleID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'member', NULL, NULL, NULL, NULL, NULL, b'1'),
(2, 'admin', NULL, NULL, NULL, NULL, NULL, b'1'),
(3, 'super admin', NULL, NULL, NULL, NULL, NULL, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`DownloadID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `DownloaderID` (`DownloaderID`),
  ADD KEY `NoteID` (`NoteID`);

--
-- Indexes for table `note_categories`
--
ALTER TABLE `note_categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `note_types`
--
ALTER TABLE `note_types`
  ADD PRIMARY KEY (`TypeID`);

--
-- Indexes for table `reference_data`
--
ALTER TABLE `reference_data`
  ADD PRIMARY KEY (`ReferenceID`);

--
-- Indexes for table `seller_notes`
--
ALTER TABLE `seller_notes`
  ADD PRIMARY KEY (`NoteID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `ActionedBy` (`ActionedBy`),
  ADD KEY `Category` (`Category`),
  ADD KEY `NoteType` (`NoteType`),
  ADD KEY `Country` (`Country`);

--
-- Indexes for table `seller_notes_reported_issues`
--
ALTER TABLE `seller_notes_reported_issues`
  ADD PRIMARY KEY (`ReportedIssuesID`),
  ADD KEY `ReportedBYID` (`ReportedBYID`),
  ADD KEY `DownloadID` (`DownloadID`),
  ADD KEY `NoteID` (`NoteID`);

--
-- Indexes for table `seller_notes_reviews`
--
ALTER TABLE `seller_notes_reviews`
  ADD PRIMARY KEY (`NoteReviewID`),
  ADD KEY `ReviewedByID` (`ReviewedByID`),
  ADD KEY `DownloadID` (`DownloadID`),
  ADD KEY `NoteID` (`NoteID`);

--
-- Indexes for table `system_configurations`
--
ALTER TABLE `system_configurations`
  ADD PRIMARY KEY (`SystemConfigID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UsersID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`UserProfileID`),
  ADD KEY `userprofile_ibfk_1` (`UsersID`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `DownloadID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `note_categories`
--
ALTER TABLE `note_categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `note_types`
--
ALTER TABLE `note_types`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reference_data`
--
ALTER TABLE `reference_data`
  MODIFY `ReferenceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_notes`
--
ALTER TABLE `seller_notes`
  MODIFY `NoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `seller_notes_reported_issues`
--
ALTER TABLE `seller_notes_reported_issues`
  MODIFY `ReportedIssuesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `seller_notes_reviews`
--
ALTER TABLE `seller_notes_reviews`
  MODIFY `NoteReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `system_configurations`
--
ALTER TABLE `system_configurations`
  MODIFY `SystemConfigID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `UserProfileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`UsersID`),
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`DownloaderID`) REFERENCES `users` (`UsersID`),
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`NoteID`) REFERENCES `seller_notes` (`NoteID`);

--
-- Constraints for table `seller_notes`
--
ALTER TABLE `seller_notes`
  ADD CONSTRAINT `ActionedBy` FOREIGN KEY (`ActionedBy`) REFERENCES `users` (`UsersID`),
  ADD CONSTRAINT `Country` FOREIGN KEY (`Country`) REFERENCES `countries` (`CountryID`),
  ADD CONSTRAINT `NoteType` FOREIGN KEY (`NoteType`) REFERENCES `note_types` (`TypeID`);

--
-- Constraints for table `seller_notes_reported_issues`
--
ALTER TABLE `seller_notes_reported_issues`
  ADD CONSTRAINT `DownloadID` FOREIGN KEY (`DownloadID`) REFERENCES `downloads` (`DownloadID`),
  ADD CONSTRAINT `ReportedBYID` FOREIGN KEY (`ReportedBYID`) REFERENCES `users` (`UsersID`),
  ADD CONSTRAINT `seller_notes_reported_issues_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller_notes` (`NoteID`);

--
-- Constraints for table `seller_notes_reviews`
--
ALTER TABLE `seller_notes_reviews`
  ADD CONSTRAINT `seller_notes_reviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`UsersID`),
  ADD CONSTRAINT `seller_notes_reviews_ibfk_3` FOREIGN KEY (`DownloadID`) REFERENCES `downloads` (`DownloadID`),
  ADD CONSTRAINT `seller_notes_reviews_ibfk_4` FOREIGN KEY (`NoteID`) REFERENCES `seller_notes` (`NoteID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `user_roles` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
