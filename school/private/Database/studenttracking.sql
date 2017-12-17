-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2017 at 06:33 AM
-- Server version: 5.5.45
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studenttracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountId` int(11) NOT NULL,
  `UserName` varchar(15) NOT NULL,
  `PassWord` varchar(100) NOT NULL,
  `CreateDate` date NOT NULL,
  `Role` varchar(20) NOT NULL,
  `accountstate` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountId`, `UserName`, `PassWord`, `CreateDate`, `Role`, `accountstate`) VALUES
(1, 'Paul001', '$2y$10$cq4BMoV2OpYPXBCmrYt2bupWqW.RkEqJCLO/OB726oNQyr0I9ExEG', '2017-11-20', 'teacher', 1),
(2, 'Caral', '$2y$10$G1I3uVLcV0p1.WnghaDw6OjSF2E8/vq1MbFXEk8g46/BUBeWz.hR2', '2017-11-20', 'teacher', 1),
(4, 'fffff', '$2y$10$G1I3uVLcV0p1.WnghaDw6OjSF2E8/vq1MbFXEk8g46/BUBeWz.hR2', '2017-11-20', 'teacher', 1),
(5, 'Dunham', '$2y$10$XUBuEwVAlYrQACiC3pv0PeZV.ksnCl0DQnWXBt4pyQnWEu22YhADm', '2017-11-20', 'teacher', 1),
(6, 'Howell0011', '$2y$10$Nm300PbN5hh3bxzXvsL8F.KJugcPOAMbYk2fiFL63WLxI9hOak5uq', '2017-11-21', 'teacher', 1),
(7, '', '', '2017-11-21', 'teacher', 0),
(8, '', '', '2017-11-21', 'teacher', 0),
(9, 'mustafa', '$2y$10$XmiRiomAtev2GASGHmeBb.g5pdf/aAaZfDncUWdLyNMaSr0xw.zsm', '2017-11-22', 'parent', 1),
(10, 'Mary001', '$2y$10$G1I3uVLcV0p1.WnghaDw6OjSF2E8/vq1MbFXEk8g46/BUBeWz.hR2', '2017-11-22', 'parent', 1),
(11, 'Ashley001', '$2y$10$G1I3uVLcV0p1.WnghaDw6OjSF2E8/vq1MbFXEk8g46/BUBeWz.hR2', '2017-11-22', 'parent', 1),
(12, 'Brandon', '$2y$10$B5UncrrTOxzKn//NU6jl9.PJLgLnwRvckLJYnExSWEBtcmUDKNNb6', '2017-11-24', 'teacher', 1),
(13, 'Algornon001', '$2y$10$G1I3uVLcV0p1.WnghaDw6OjSF2E8/vq1MbFXEk8g46/BUBeWz.hR2', '2017-11-24', 'parent', 1),
(14, 'admin', '$2y$10$DvEyTdvostfuy/IZmKtykO9YCFgWzRPgt24xlETIULYp0eumpTeKm', '2017-11-25', 'superadmin', 1),
(15, 'Lisa', '$2y$10$gX3rY68IQhAv1eRW4o1uI.vmXpzuR3gIxiqRL5HQ78sn6FDI9gwW.', '2017-12-08', 'parent', 1),
(24, 'Adam', '$2y$10$PVTeUaADhOfGr2l8vjVCbOWptSZVWl.4DhbejtYdWt5CpkigsJw62', '2017-12-10', 'schooladmin', 1),
(27, 'salama', '$2y$10$miiaFd2HcdbGFVbIo8fWh.hFWw6PSibXusG5RhV7ah3UHjqzx8X6O', '2017-12-10', 'schooladmin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `busstops`
--

CREATE TABLE `busstops` (
  `StopId` int(11) NOT NULL,
  `BusStopDesc` varchar(100) NOT NULL,
  `inTime` time NOT NULL,
  `ouTime` time NOT NULL,
  `Latitude` double NOT NULL,
  `Longtitude` double NOT NULL,
  `BusNo` int(11) NOT NULL,
  `NextStop` int(11) NOT NULL,
  `PreviousStope` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `classattendance`
--

CREATE TABLE `classattendance` (
  `Attendance_ser` int(11) NOT NULL,
  `Time_attendance` time DEFAULT NULL,
  `Date_ttendance` date DEFAULT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL,
  `studentsessionNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classattendance`
--

INSERT INTO `classattendance` (`Attendance_ser`, `Time_attendance`, `Date_ttendance`, `StudentId`, `SchoolNo`, `studentsessionNo`) VALUES
(1, '11:23:50', '2017-11-03', 144301, 1, 1),
(2, '12:24:54', '2017-11-04', 144301, 1, 1),
(3, '12:25:25', '2017-11-04', 144301, 1, 1),
(4, '09:49:37', '2017-11-05', 144302, 1, 2),
(5, '08:44:06', '2017-11-06', 144301, 1, 1),
(6, '08:48:02', '2017-11-06', 144302, 1, 2),
(7, '08:48:14', '2017-11-06', 144301, 1, 1),
(8, '04:47:49', '2017-11-06', 144301, 1, 1),
(9, '07:36:02', '2017-11-06', 144301, 1, 1),
(10, '07:36:57', '2017-11-06', 144302, 1, 2),
(11, '10:29:58', '2017-11-06', 144308, 1, 8),
(12, '08:29:56', '2017-11-07', 144303, 1, 3),
(13, '08:30:52', '2017-11-07', 144304, 1, 4),
(14, '11:40:18', '2017-11-11', 144301, 1, 1),
(15, '09:59:05', '2017-11-12', 144301, 1, 1),
(16, '09:59:37', '2017-11-12', 144305, 1, 5),
(17, '10:00:54', '2017-11-12', 144307, 1, 7),
(18, '10:21:05', '2017-11-12', 144301, 1, 1),
(19, '05:57:10', '2017-11-13', 144301, 1, 1),
(20, '05:57:24', '2017-11-13', 144302, 1, 2),
(21, '09:50:59', '2017-11-14', 144303, 1, 3),
(22, '01:01:21', '2017-11-15', 144307, 1, 7),
(23, '01:01:55', '2017-11-15', 144308, 1, 8),
(24, '01:08:10', '2017-11-15', 144308, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `classperiod`
--

CREATE TABLE `classperiod` (
  `PeriodNo` int(11) NOT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL,
  `TypeCode` char(2) NOT NULL DEFAULT 'P1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classperiod`
--

INSERT INTO `classperiod` (`PeriodNo`, `StartTime`, `EndTime`, `SchoolNo`, `TypeCode`) VALUES
(1, '07:58:00', '08:56:00', 1, 'P1'),
(2, '08:57:00', '09:58:00', 1, 'P2'),
(3, '10:00:00', '10:40:00', 1, 'E1'),
(4, '11:15:00', '11:54:00', 1, 'E2'),
(5, '12:00:00', '12:56:00', 1, 'P3'),
(6, '12:58:00', '13:58:00', 1, 'P4'),
(7, '14:00:00', '14:40:00', 1, 'T1');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `SessionNo` int(11) NOT NULL,
  `RoomNo` varchar(6) DEFAULT NULL,
  `ClassGrade` tinyint(4) DEFAULT NULL,
  `TeacherID` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `PeriodNo` int(11) DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL,
  `Term_ser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`SessionNo`, `RoomNo`, `ClassGrade`, `TeacherID`, `SubjectId`, `PeriodNo`, `SchoolNo`, `Term_ser`) VALUES
(1, '405', 6, 1016, 1, 1, 1, 2),
(2, '405', 6, 1016, 1, 2, 1, 2),
(3, '405', 6, 1016, 1, 5, 1, 2),
(4, '405', 6, 1016, 1, 6, 1, 2),
(5, '605', 6, 1020, 5, 3, 1, 2),
(6, '601', 6, 1021, 7, 3, 1, 2),
(7, '605', 6, 1020, 5, 4, 1, 2),
(8, '310', 6, 1022, 6, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `encore`
--

CREATE TABLE `encore` (
  `Sessions_ser` int(11) NOT NULL,
  `RoomNo` varchar(6) DEFAULT NULL,
  `EncoreTitle` varchar(100) DEFAULT NULL,
  `Timein` time DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `studentRFIDTag` varchar(20) DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parentinfo`
--

CREATE TABLE `parentinfo` (
  `studentParentNo` int(11) NOT NULL,
  `studentParentName` varchar(100) NOT NULL,
  `Relationship` tinyint(4) NOT NULL,
  `parentPhone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `AccountId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parentinfo`
--

INSERT INTO `parentinfo` (`studentParentNo`, `studentParentName`, `Relationship`, `parentPhone`, `Email`, `AccountId`) VALUES
(1, 'Lisa RL', 0, NULL, 'test@gmail.com', 15),
(2, 'Mary Ba', 0, NULL, 'Mary001@yahoo.com', 10),
(3, 'Ashley As', 0, NULL, 'test@gmail.com', 11),
(4, 'Abraham Abr', 1, NULL, 'mostaphagabaj1@gmail.com', 9),
(5, 'Algernon Alger', 1, NULL, 'example11@yahoo.com', 13),
(6, 'Archibald Arc', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roundtripbusattendance`
--

CREATE TABLE `roundtripbusattendance` (
  `Attendance_ser` int(11) NOT NULL,
  `Time_attendance` time NOT NULL,
  `Date_attendance` date NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL,
  `BusNo` int(11) DEFAULT NULL,
  `StopId` int(11) DEFAULT NULL,
  `Trip_State` tinyint(4) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roundtripbusattendance`
--

INSERT INTO `roundtripbusattendance` (`Attendance_ser`, `Time_attendance`, `Date_attendance`, `StudentId`, `SchoolNo`, `BusNo`, `StopId`, `Trip_State`, `lat`, `lon`) VALUES
(1, '03:52:44', '2017-11-12', 144301, 1, 36, NULL, 2, NULL, NULL),
(2, '03:53:26', '2017-11-12', 144303, 1, 36, NULL, 2, NULL, NULL),
(3, '03:53:39', '2017-11-12', 144305, 1, 36, NULL, 2, NULL, NULL),
(4, '03:53:45', '2017-11-12', 144307, 1, 36, NULL, 2, NULL, NULL),
(5, '03:57:14', '2017-11-12', 144301, 1, 36, NULL, 2, NULL, NULL),
(6, '03:59:45', '2017-11-12', 144301, 1, 36, NULL, 2, NULL, NULL),
(7, '04:02:18', '2017-11-12', 144305, 1, 36, NULL, 2, NULL, NULL),
(8, '05:49:46', '2017-11-12', 144301, 1, 36, NULL, 2, NULL, NULL),
(9, '05:51:51', '2017-11-12', 144307, 1, 36, NULL, 2, NULL, NULL),
(10, '05:52:05', '2017-11-12', 144303, 1, 36, NULL, 2, NULL, NULL),
(11, '06:14:31', '2017-11-12', 144307, 1, 36, NULL, 2, NULL, NULL),
(12, '09:08:10', '2017-11-14', 144301, 1, 36, NULL, 2, NULL, NULL),
(13, '09:15:36', '2017-11-14', 144303, 1, 36, NULL, 2, NULL, NULL),
(14, '12:44:30', '2017-11-15', 144307, 1, 36, NULL, 2, NULL, NULL),
(15, '12:46:56', '2017-11-15', 144301, 1, 36, NULL, 2, NULL, NULL),
(16, '12:48:57', '2017-11-15', 144301, 1, 36, NULL, 1, NULL, NULL),
(17, '11:09:07', '2017-12-07', 144301, 1, 36, NULL, 0, NULL, NULL),
(18, '11:09:19', '2017-12-07', 144303, 1, 36, NULL, 0, NULL, NULL),
(19, '11:09:22', '2017-12-07', 144307, 1, 36, NULL, 0, NULL, NULL),
(20, '11:51:00', '2017-12-07', 144301, 1, 36, NULL, 0, NULL, NULL),
(21, '11:51:03', '2017-12-07', 144301, 1, 36, NULL, 0, NULL, NULL),
(22, '11:51:12', '2017-12-07', 144301, 1, 36, NULL, 0, NULL, NULL),
(23, '12:21:18', '2017-12-08', 144301, 1, 36, NULL, 1, NULL, NULL),
(24, '12:27:24', '2017-12-08', 144301, 1, 36, NULL, 1, NULL, NULL),
(25, '12:27:24', '2017-12-08', 144301, 1, 36, NULL, 1, NULL, NULL),
(26, '12:28:41', '2017-12-08', 144307, 1, 36, NULL, 1, NULL, NULL),
(27, '12:30:23', '2017-12-08', 144301, 1, 36, NULL, 1, NULL, NULL),
(28, '12:30:23', '2017-12-08', 144301, 1, 36, NULL, 1, NULL, NULL),
(29, '12:30:29', '2017-12-08', 144301, 1, 36, NULL, 1, NULL, NULL),
(30, '12:30:34', '2017-12-08', 144301, 1, 36, NULL, 1, NULL, NULL),
(31, '07:10:44', '2017-12-08', 144301, 1, 36, NULL, 1, 42.097355, -80.02396),
(32, '07:11:43', '2017-12-08', 144303, 1, 36, NULL, 1, 42.097355, -80.02396);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `SchoolNo` int(11) NOT NULL,
  `SchoolName` varchar(100) NOT NULL,
  `schoolAddress` varchar(100) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL,
  `schoolPresident` varchar(60) NOT NULL,
  `schooldistrict` varchar(100) NOT NULL,
  `Email_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`SchoolNo`, `SchoolName`, `schoolAddress`, `PhoneNo`, `schoolPresident`, `schooldistrict`, `Email_address`) VALUES
(1, 'James S. Wilson Middle School', '901 W 54th St, Erie, PA 16509', '(814) 835-5500', 'Terrence Costello', 'Millcreek Township School District', 'NoMail'),
(2, 'EAST MIDDLE SCHOOL (6-8)', '1001 Atkins Street Erie, PA, 16503 ', ' (814) 874-6400', 'Scherry Prater', 'Erie School District', 'NoEmail');

-- --------------------------------------------------------

--
-- Table structure for table `schoolbus`
--

CREATE TABLE `schoolbus` (
  `BusNo` int(11) NOT NULL,
  `DriverName` varchar(60) NOT NULL,
  `SchoolNo` int(11) NOT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `latlondate` date DEFAULT NULL,
  `latlontime` time DEFAULT NULL,
  `TripState` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schoolbus`
--

INSERT INTO `schoolbus` (`BusNo`, `DriverName`, `SchoolNo`, `lat`, `lon`, `latlondate`, `latlontime`, `TripState`) VALUES
(36, 'Jeffrey', 1, 42.097355, -80.02396, '2017-12-08', '07:12:37', 1),
(74, 'Jimmy', 1, 42.10246, -80.02677, '2017-12-04', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schoolyears`
--

CREATE TABLE `schoolyears` (
  `SchoolYearNo` int(11) NOT NULL,
  `SchoolYear` varchar(10) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `SchoolNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schoolyears`
--

INSERT INTO `schoolyears` (`SchoolYearNo`, `SchoolYear`, `StartDate`, `EndDate`, `SchoolNo`) VALUES
(1, '2017-2018', '2017-08-24', '2018-06-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stdbelong`
--

CREATE TABLE `stdbelong` (
  `StudentID` int(11) NOT NULL DEFAULT '0',
  `StudentParentNo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stdbelong`
--

INSERT INTO `stdbelong` (`StudentID`, `StudentParentNo`) VALUES
(144301, 4),
(144302, 1),
(144303, 2),
(144304, 3),
(144305, 4),
(144306, 5),
(144307, 6),
(144308, 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentactivity`
--

CREATE TABLE `studentactivity` (
  `StudentActivity_ser` int(11) NOT NULL,
  `placeName` varchar(100) NOT NULL,
  `ActivityTime` time DEFAULT NULL,
  `ActivityDate` date DEFAULT NULL,
  `TimeState` tinyint(4) DEFAULT NULL,
  `studentRFIDTag` varchar(20) DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentactivity`
--

INSERT INTO `studentactivity` (`StudentActivity_ser`, `placeName`, `ActivityTime`, `ActivityDate`, `TimeState`, `studentRFIDTag`, `SchoolNo`) VALUES
(1, 'Rest Room', '12:35:18', '2017-12-01', 0, '76bc259', 1),
(2, 'Gate No 4', '12:40:11', '2017-12-01', 5, '76bc259', 1),
(3, 'Gate No 04', '07:41:29', '2017-12-01', 1, '76bc259', 1),
(4, 'Gate No 4', '12:43:22', '2017-12-01', 5, '44db7e2d04f80', 1),
(5, 'Gate No 4', '07:49:27', '2017-12-01', 2, '419b7e2d04f80', 1),
(6, 'Rest Room', '08:18:31', '2017-12-01', 0, '42cb7e2d04f80', 1),
(7, 'Nurse Room', '10:56:25', '2017-12-01', 0, '44db7e2d04f80', 1),
(8, 'Library', '10:57:02', '2017-12-01', 0, '76bc259', 1),
(9, 'Rest Room', '10:59:40', '2017-12-01', 0, '0', 1),
(10, 'Rest Room', '11:09:22', '2017-12-01', 0, '76bc259', 1),
(11, 'Rest Room', '11:20:42', '2017-12-01', 0, '76bc259', 1),
(12, 'Rest Room', '11:23:16', '2017-12-01', 0, '76bc259', 1),
(13, 'Library', '11:23:23', '2017-12-01', 0, '42cb7e2d04f80', 1),
(14, 'Rest Room', '11:23:26', '2017-12-01', 0, '42cb7e2d04f80', 1),
(15, 'Rest Room', '11:23:32', '2017-12-01', 0, '44db7e2d04f80', 1),
(16, 'Rest Room', '11:23:39', '2017-12-01', 0, '419b7e2d04f80', 1),
(17, 'Library', '11:23:43', '2017-12-01', 0, '42cb7e2d04f80', 1),
(18, 'Rest Room', '11:28:42', '2017-12-01', 0, '76bc259', 1),
(19, 'Rest Room', '11:28:48', '2017-12-01', 0, '76bc259', 1),
(20, 'Rest Room', '11:28:54', '2017-12-01', 0, '76bc259', 1),
(21, 'Rest Room', '11:28:58', '2017-12-01', 0, '76bc259', 1),
(22, 'Rest Room', '11:29:03', '2017-12-01', 0, '76bc259', 1),
(23, 'Rest Room', '12:07:49', '2017-12-01', 0, '76bc259', 1),
(24, 'Rest Room', '12:07:53', '2017-12-01', 0, '76bc259', 1),
(25, 'Rest Room', '12:08:43', '2017-12-01', 0, '76bc259', 1),
(26, 'Rest Room', '12:08:48', '2017-12-01', 0, '43bb7e2d04f80', 1),
(27, 'Rest Room', '12:08:50', '2017-12-01', 0, '44db7e2d04f80', 1),
(28, 'Rest Room', '12:08:53', '2017-12-01', 0, '419b7e2d04f80', 1),
(29, 'Rest Room', '12:08:56', '2017-12-01', 0, '41bb7e2d04f80', 1),
(30, 'Rest Room', '12:09:01', '2017-12-01', 0, '42cb7e2d04f80', 1),
(31, 'Rest Room', '12:15:27', '2017-12-01', 0, '76bc259', 1),
(32, 'Rest Room', '12:15:31', '2017-12-01', 0, '76bc259', 1),
(33, 'Rest Room', '12:15:34', '2017-12-01', 0, '76bc259', 1),
(34, 'Rest Room', '12:15:37', '2017-12-01', 0, '76bc259', 1),
(35, 'Rest Room', '12:15:47', '2017-12-01', 0, '6b699ac', 1),
(36, 'Rest Room', '12:15:54', '2017-12-01', 0, '42cb7e2d04f80', 1),
(37, 'Rest Room', '12:15:59', '2017-12-01', 0, '42cb7e2d04f80', 1),
(38, 'Rest Room', '12:16:01', '2017-12-01', 0, '419b7e2d04f80', 1),
(39, 'Rest Room', '12:16:07', '2017-12-01', 0, '44db7e2d04f80', 1),
(40, 'Rest Room', '12:16:10', '2017-12-01', 0, '43bb7e2d04f80', 1),
(41, 'Gate No 4', '12:21:13', '2017-12-01', 5, '76bc259', 1),
(42, 'Gate No 4', '12:21:19', '2017-12-01', 5, '42cb7e2d04f80', 1),
(43, 'Gate No 4', '12:21:21', '2017-12-01', 5, '41bb7e2d04f80', 1),
(44, 'Gate No 4', '12:21:26', '2017-12-01', 5, '44db7e2d04f80', 1),
(45, 'Gate No 4', '12:21:38', '2017-12-01', 5, '44db7e2d04f80', 1),
(46, 'Gate No 4', '12:21:48', '2017-12-01', 5, '6b699ac', 1),
(47, 'Gate No 4', '12:21:56', '2017-12-01', 5, '419b7e2d04f80', 1),
(48, 'Gate No 4', '12:22:03', '2017-12-01', 5, '44db7e2d04f80', 1),
(49, 'Gate No 4', '12:42:04', '2017-12-01', 5, '76bc259', 1),
(50, 'Gate No 4', '12:42:10', '2017-12-01', 5, '76bc259', 1),
(51, 'Gate No 4', '12:42:18', '2017-12-01', 5, '42cb7e2d04f80', 1),
(52, 'Gate No 4', '12:42:20', '2017-12-01', 5, '41bb7e2d04f80', 1),
(53, 'Gate No 4', '12:42:26', '2017-12-01', 5, '419b7e2d04f80', 1),
(54, 'Gate No 4', '12:46:35', '2017-12-01', 5, '76bc259', 1),
(55, 'Gate No 4', '12:46:37', '2017-12-01', 5, '76bc259', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentclass`
--

CREATE TABLE `studentclass` (
  `studentsessionNo` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `SessionNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentclass`
--

INSERT INTO `studentclass` (`studentsessionNo`, `StudentId`, `SessionNo`) VALUES
(1, 144301, 1),
(2, 144302, 1),
(3, 144303, 2),
(4, 144304, 2),
(5, 144305, 3),
(6, 144306, 3),
(7, 144307, 4),
(8, 144308, 4),
(9, 144301, 5),
(10, 144302, 5),
(11, 144303, 6),
(12, 144304, 6),
(13, 144305, 7),
(14, 144306, 7),
(15, 144307, 8),
(16, 144308, 8);

-- --------------------------------------------------------

--
-- Table structure for table `studentinfo`
--

CREATE TABLE `studentinfo` (
  `studentID` int(11) NOT NULL,
  `studentName` varchar(60) NOT NULL,
  `studentAddress` varchar(100) NOT NULL,
  `studentBirth` date NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `currentGrade` tinyint(4) NOT NULL,
  `studentRFIDTag` varchar(20) DEFAULT NULL,
  `SchoolNo` int(11) NOT NULL,
  `BusNo` int(11) DEFAULT NULL,
  `StopId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentinfo`
--

INSERT INTO `studentinfo` (`studentID`, `studentName`, `studentAddress`, `studentBirth`, `gender`, `currentGrade`, `studentRFIDTag`, `SchoolNo`, `BusNo`, `StopId`) VALUES
(144301, 'Jackson', 'No Address', '2001-01-01', 1, 6, '76bc259', 1, 36, NULL),
(144302, 'Aiden', 'No Address', '2001-01-02', 1, 6, '6b699ac', 1, 74, NULL),
(144303, 'Lucas', 'No Address', '2001-01-03', 1, 6, '43bb7e2d04f80', 1, 36, NULL),
(144304, 'Liam', 'No Address', '2001-01-04', 1, 6, '44db7e2d04f80', 1, 74, NULL),
(144305, 'Noah', 'No Address', '2001-01-05', 1, 6, '419b7e2d04f80', 1, 74, NULL),
(144306, 'Ethan', 'No Address', '2001-01-06', 1, 6, '41bb7e2d04f80', 1, 74, NULL),
(144307, 'Caden', 'No Address', '2001-01-07', 1, 6, '42cb7e2d04f80', 1, 36, NULL),
(144308, 'Oliver', 'No Address', '2001-01-08', 1, 6, '76bc259', 1, 74, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectId` int(11) NOT NULL,
  `SubjectName` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectId`, `SubjectName`) VALUES
(1, '8140-1 English 2nd Language'),
(2, '8321-3 Physical Science'),
(3, '8401-3 Social Studies'),
(4, '8211-3 Pre-Algebra'),
(5, '8500-3 Art'),
(6, '8801-4 Health/Phys Ed'),
(7, '8940-2 Chorus'),
(8, 'No Subject');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TeacherId` int(11) NOT NULL,
  `TeacherName` varchar(60) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `AccountId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TeacherId`, `TeacherName`, `Email`, `SchoolNo`, `SubjectId`, `AccountId`) VALUES
(1016, 'Paul Bamberger', 'example1@exp.com', 1, 1, 1),
(1017, 'Carol Bohman', 'Bohman001@gmail.com', 1, 3, 2),
(1018, 'Brandon Fox', 'example313@exp.com', 1, 4, 12),
(1019, 'John Hinman', 'example4@exp.com', 1, 2, NULL),
(1020, 'Dunham, Jennier L', 'Dunham@yahoo.com', 1, 5, 5),
(1021, 'Howell, Seth C', 'example61@hotmail.com', 1, 7, 6),
(1022, 'Stahon, John P', 'example7@exp.com', 1, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `Term_ser` int(11) NOT NULL,
  `TermNo` int(11) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL,
  `SchoolYearNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`Term_ser`, `TermNo`, `StartDate`, `EndDate`, `SchoolNo`, `SchoolYearNo`) VALUES
(1, 1, '2017-08-24', '2017-10-27', 1, 1),
(2, 2, '2017-10-31', '2018-01-17', 1, 1),
(3, 3, '2018-01-18', '2018-03-23', 1, 1),
(4, 4, '2018-04-03', '2018-06-07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `stdID` int(11) DEFAULT NULL,
  `StdName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`stdID`, `StdName`) VALUES
(40, 'Zayid'),
(40, 'Gabaj'),
(40, 'OkOK'),
(40, 'Gabaj'),
(40, 'Gabaj'),
(40, 'Gabaj'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test'),
(40, 'test1'),
(40, 'test2'),
(40, 'test3'),
(40, 'test4'),
(40, 'test5'),
(40, 'test6'),
(40, 'test7'),
(40, 'test8'),
(40, 'test9'),
(18, '76bc259'),
(18, '76bc259'),
(18, '76bc259'),
(18, '76bc259'),
(18, '76bc259'),
(18, '76bc259'),
(18, '42cb7e2d04f80'),
(18, '42cb7e2d04f80'),
(18, '419b7e2d04f80'),
(18, '44db7e2d04f80'),
(18, '43bb7e2d04f80'),
(18, '43bb7e2d04f80');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `User_Name` varchar(60) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `AccountId` int(11) DEFAULT NULL,
  `SchoolNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `User_Name`, `Email`, `AccountId`, `SchoolNo`) VALUES
(1, 'Mustafa  Mohamed Gabaj', 'mustafa_t_g@yahoo.com', 14, NULL),
(2, 'Adam K.', 'Adamk001@gmail.com', 24, 1),
(4, 'Ali Salama', 'Salama002@gmail.com', 27, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountId`);

--
-- Indexes for table `busstops`
--
ALTER TABLE `busstops`
  ADD PRIMARY KEY (`StopId`),
  ADD KEY `BusNo` (`BusNo`),
  ADD KEY `NextStop` (`NextStop`),
  ADD KEY `PreviousStope` (`PreviousStope`);

--
-- Indexes for table `classattendance`
--
ALTER TABLE `classattendance`
  ADD PRIMARY KEY (`Attendance_ser`),
  ADD KEY `StudentId` (`StudentId`),
  ADD KEY `SchoolNo` (`SchoolNo`),
  ADD KEY `studentsessionNo` (`studentsessionNo`);

--
-- Indexes for table `classperiod`
--
ALTER TABLE `classperiod`
  ADD PRIMARY KEY (`PeriodNo`),
  ADD KEY `SchoolNo` (`SchoolNo`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`SessionNo`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `SubjectId` (`SubjectId`),
  ADD KEY `PeriodNo` (`PeriodNo`),
  ADD KEY `SchoolNo` (`SchoolNo`),
  ADD KEY `Term_ser` (`Term_ser`);

--
-- Indexes for table `encore`
--
ALTER TABLE `encore`
  ADD PRIMARY KEY (`Sessions_ser`),
  ADD KEY `SchoolNo` (`SchoolNo`);

--
-- Indexes for table `parentinfo`
--
ALTER TABLE `parentinfo`
  ADD PRIMARY KEY (`studentParentNo`),
  ADD KEY `AccountId` (`AccountId`);

--
-- Indexes for table `roundtripbusattendance`
--
ALTER TABLE `roundtripbusattendance`
  ADD PRIMARY KEY (`Attendance_ser`),
  ADD KEY `StudentId` (`StudentId`),
  ADD KEY `SchoolNo` (`SchoolNo`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`SchoolNo`),
  ADD UNIQUE KEY `SchoolName` (`SchoolName`),
  ADD UNIQUE KEY `schoolAddress` (`schoolAddress`),
  ADD UNIQUE KEY `PhoneNo` (`PhoneNo`),
  ADD UNIQUE KEY `schoolPresident` (`schoolPresident`),
  ADD UNIQUE KEY `Email_address` (`Email_address`);

--
-- Indexes for table `schoolbus`
--
ALTER TABLE `schoolbus`
  ADD PRIMARY KEY (`BusNo`),
  ADD UNIQUE KEY `DriverName` (`DriverName`),
  ADD KEY `SchoolNo` (`SchoolNo`);

--
-- Indexes for table `schoolyears`
--
ALTER TABLE `schoolyears`
  ADD PRIMARY KEY (`SchoolYearNo`),
  ADD UNIQUE KEY `SchoolYear` (`SchoolYear`),
  ADD KEY `SchoolNo` (`SchoolNo`);

--
-- Indexes for table `stdbelong`
--
ALTER TABLE `stdbelong`
  ADD PRIMARY KEY (`StudentID`,`StudentParentNo`);

--
-- Indexes for table `studentactivity`
--
ALTER TABLE `studentactivity`
  ADD PRIMARY KEY (`StudentActivity_ser`),
  ADD KEY `SchoolNo` (`SchoolNo`);

--
-- Indexes for table `studentclass`
--
ALTER TABLE `studentclass`
  ADD PRIMARY KEY (`studentsessionNo`),
  ADD KEY `StudentId` (`StudentId`),
  ADD KEY `SessionNo` (`SessionNo`);

--
-- Indexes for table `studentinfo`
--
ALTER TABLE `studentinfo`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `SchoolNo` (`SchoolNo`),
  ADD KEY `BusNo` (`BusNo`),
  ADD KEY `StopId` (`StopId`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SubjectId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TeacherId`),
  ADD KEY `SchoolNo` (`SchoolNo`),
  ADD KEY `SubjectId` (`SubjectId`),
  ADD KEY `AccountId` (`AccountId`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`Term_ser`,`SchoolYearNo`),
  ADD KEY `SchoolNo` (`SchoolNo`),
  ADD KEY `SchoolYearNo` (`SchoolYearNo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `AccountId` (`AccountId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `AccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `busstops`
--
ALTER TABLE `busstops`
  MODIFY `StopId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classattendance`
--
ALTER TABLE `classattendance`
  MODIFY `Attendance_ser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `classperiod`
--
ALTER TABLE `classperiod`
  MODIFY `PeriodNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `SessionNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `encore`
--
ALTER TABLE `encore`
  MODIFY `Sessions_ser` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parentinfo`
--
ALTER TABLE `parentinfo`
  MODIFY `studentParentNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roundtripbusattendance`
--
ALTER TABLE `roundtripbusattendance`
  MODIFY `Attendance_ser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `SchoolNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schoolbus`
--
ALTER TABLE `schoolbus`
  MODIFY `BusNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `schoolyears`
--
ALTER TABLE `schoolyears`
  MODIFY `SchoolYearNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `studentactivity`
--
ALTER TABLE `studentactivity`
  MODIFY `StudentActivity_ser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `studentclass`
--
ALTER TABLE `studentclass`
  MODIFY `studentsessionNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `studentinfo`
--
ALTER TABLE `studentinfo`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144309;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `SubjectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `TeacherId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;
--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `Term_ser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `busstops`
--
ALTER TABLE `busstops`
  ADD CONSTRAINT `busstops_ibfk_1` FOREIGN KEY (`BusNo`) REFERENCES `schoolbus` (`BusNo`),
  ADD CONSTRAINT `busstops_ibfk_2` FOREIGN KEY (`NextStop`) REFERENCES `busstops` (`StopId`),
  ADD CONSTRAINT `busstops_ibfk_3` FOREIGN KEY (`PreviousStope`) REFERENCES `busstops` (`StopId`);

--
-- Constraints for table `classattendance`
--
ALTER TABLE `classattendance`
  ADD CONSTRAINT `classattendance_ibfk_1` FOREIGN KEY (`StudentId`) REFERENCES `studentinfo` (`studentID`),
  ADD CONSTRAINT `classattendance_ibfk_2` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`),
  ADD CONSTRAINT `classattendance_ibfk_3` FOREIGN KEY (`studentsessionNo`) REFERENCES `studentclass` (`studentsessionNo`);

--
-- Constraints for table `classperiod`
--
ALTER TABLE `classperiod`
  ADD CONSTRAINT `classperiod_ibfk_1` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`);

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teacher` (`TeacherId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classroom_ibfk_2` FOREIGN KEY (`SubjectId`) REFERENCES `subject` (`SubjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classroom_ibfk_3` FOREIGN KEY (`PeriodNo`) REFERENCES `classperiod` (`PeriodNo`),
  ADD CONSTRAINT `classroom_ibfk_4` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`),
  ADD CONSTRAINT `classroom_ibfk_5` FOREIGN KEY (`Term_ser`) REFERENCES `term` (`Term_ser`);

--
-- Constraints for table `encore`
--
ALTER TABLE `encore`
  ADD CONSTRAINT `encore_ibfk_1` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`);

--
-- Constraints for table `parentinfo`
--
ALTER TABLE `parentinfo`
  ADD CONSTRAINT `parentinfo_ibfk_2` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`);

--
-- Constraints for table `roundtripbusattendance`
--
ALTER TABLE `roundtripbusattendance`
  ADD CONSTRAINT `roundtripbusattendance_ibfk_1` FOREIGN KEY (`StudentId`) REFERENCES `studentinfo` (`studentID`),
  ADD CONSTRAINT `roundtripbusattendance_ibfk_2` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`);

--
-- Constraints for table `schoolbus`
--
ALTER TABLE `schoolbus`
  ADD CONSTRAINT `schoolbus_ibfk_1` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`);

--
-- Constraints for table `schoolyears`
--
ALTER TABLE `schoolyears`
  ADD CONSTRAINT `schoolyears_ibfk_1` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`);

--
-- Constraints for table `studentactivity`
--
ALTER TABLE `studentactivity`
  ADD CONSTRAINT `studentactivity_ibfk_1` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`);

--
-- Constraints for table `studentclass`
--
ALTER TABLE `studentclass`
  ADD CONSTRAINT `studentclass_ibfk_1` FOREIGN KEY (`StudentId`) REFERENCES `studentinfo` (`studentID`),
  ADD CONSTRAINT `studentclass_ibfk_2` FOREIGN KEY (`SessionNo`) REFERENCES `classroom` (`SessionNo`);

--
-- Constraints for table `studentinfo`
--
ALTER TABLE `studentinfo`
  ADD CONSTRAINT `studentinfo_ibfk_1` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`),
  ADD CONSTRAINT `studentinfo_ibfk_2` FOREIGN KEY (`BusNo`) REFERENCES `schoolbus` (`BusNo`),
  ADD CONSTRAINT `studentinfo_ibfk_3` FOREIGN KEY (`StopId`) REFERENCES `busstops` (`StopId`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`),
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`SubjectId`) REFERENCES `subject` (`SubjectId`),
  ADD CONSTRAINT `teacher_ibfk_3` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`);

--
-- Constraints for table `term`
--
ALTER TABLE `term`
  ADD CONSTRAINT `term_ibfk_1` FOREIGN KEY (`SchoolNo`) REFERENCES `school` (`SchoolNo`),
  ADD CONSTRAINT `term_ibfk_2` FOREIGN KEY (`SchoolYearNo`) REFERENCES `schoolyears` (`SchoolYearNo`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
