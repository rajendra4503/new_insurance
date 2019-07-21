-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2019 at 11:42 PM
-- Server version: 5.6.29
-- PHP Version: 5.5.9-1ubuntu4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `planpiper_insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_code`
--

CREATE TABLE IF NOT EXISTS `diagnosis_code` (
`Diagnosis_ID` int(11) NOT NULL,
  `ICD10_CM_CODE` varchar(255) NOT NULL,
  `ICD10_CM_CODE_DESCRIPTION` varchar(255) NOT NULL,
  `ICD10_CM_DISPLAY_STRING` varchar(255) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CreatedBy` varchar(25) NOT NULL DEFAULT 'System ',
  `UpdatedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UpdatedBy` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72457 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_procedure_code`
--

CREATE TABLE IF NOT EXISTS `diagnosis_procedure_code` (
`Procedure_ID` int(11) NOT NULL,
  `ICD10_PCS_CODE` varchar(10) NOT NULL,
  `ICD10_PCS_CODE_DESCRIPTION` varchar(255) NOT NULL,
  `ICD10_PCS_CODE_DISPLAY_STRING` varchar(255) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CreatedBy` varchar(25) NOT NULL,
  `UpdatedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UpdatedBy` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79767 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosis_code`
--
ALTER TABLE `diagnosis_code`
 ADD PRIMARY KEY (`Diagnosis_ID`), ADD KEY `ICD10_CM_CODE` (`ICD10_CM_CODE`,`ICD10_CM_CODE_DESCRIPTION`), ADD KEY `ICD10_CM_CODE_2` (`ICD10_CM_CODE`,`ICD10_CM_DISPLAY_STRING`);

--
-- Indexes for table `diagnosis_procedure_code`
--
ALTER TABLE `diagnosis_procedure_code`
 ADD PRIMARY KEY (`Procedure_ID`), ADD KEY `ICD10_PCS_CODE` (`ICD10_PCS_CODE`), ADD KEY `ICD10_PCS_CODE_DESCRIPTION` (`ICD10_PCS_CODE_DESCRIPTION`), ADD KEY `ICD10_PCS_CODE_2` (`ICD10_PCS_CODE`,`ICD10_PCS_CODE_DESCRIPTION`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnosis_code`
--
ALTER TABLE `diagnosis_code`
MODIFY `Diagnosis_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72457;
--
-- AUTO_INCREMENT for table `diagnosis_procedure_code`
--
ALTER TABLE `diagnosis_procedure_code`
MODIFY `Procedure_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79767;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
