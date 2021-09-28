-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 15, 2021 at 08:11 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `UBC_MIS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Academic_Calendar`
--

CREATE TABLE `Ubc_Academic_Calendar` (
  `academic_calendar_id` varchar(200) NOT NULL,
  `academic_calendar_year` varchar(200) DEFAULT NULL,
  `academic_calendar_term` varchar(200) DEFAULT NULL,
  `academic_calendar_status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_Academic_Calendar`
--

INSERT INTO `Ubc_Academic_Calendar` (`academic_calendar_id`, `academic_calendar_year`, `academic_calendar_term`, `academic_calendar_status`) VALUES
('a71c4af4800bea7786399f16834505be894d17a69b', '2021/2022', 'Term 1', 'Current');

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Billings`
--

CREATE TABLE `Ubc_Billings` (
  `billing_id` int(200) NOT NULL,
  `billing_student_id` varchar(200) DEFAULT NULL,
  `billing_academic_calendar_id` varchar(200) DEFAULT '1',
  `billing_date` varchar(200) DEFAULT NULL,
  `billing_ref` varchar(200) DEFAULT NULL,
  `billing_desc` longtext DEFAULT NULL,
  `billing_amount` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Exam_Timetable`
--

CREATE TABLE `Ubc_Exam_Timetable` (
  `exam_tt_id` varchar(200) NOT NULL,
  `exam_tt_unit_id` varchar(200) NOT NULL,
  `exam_tt_exam_time` varchar(200) NOT NULL,
  `exam_tt_room` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Fee_Payment`
--

CREATE TABLE `Ubc_Fee_Payment` (
  `fee_payment_id` varchar(200) NOT NULL,
  `fee_payment_student_id` varchar(200) DEFAULT NULL,
  `fee_payment_amount` varchar(200) DEFAULT NULL,
  `fee_payment_mode` varchar(200) DEFAULT NULL,
  `fee_date_paid` varchar(200) DEFAULT NULL,
  `fee_payment_receipt_number` varchar(200) DEFAULT NULL,
  `fee_payment_confirmation_codes` varchar(200) DEFAULT NULL,
  `fee_payment_academic_calendar_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Mailer_Settings`
--

CREATE TABLE `Ubc_Mailer_Settings` (
  `mailer_host` varchar(200) DEFAULT NULL,
  `mailer_port` varchar(200) DEFAULT NULL,
  `mailer_protocol` varchar(200) DEFAULT NULL,
  `mailer_username` varchar(200) DEFAULT NULL,
  `mailer_mail_from_name` varchar(200) DEFAULT NULL,
  `mailer_mail_from_email` varchar(200) DEFAULT NULL,
  `mailer_password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_Mailer_Settings`
--

INSERT INTO `Ubc_Mailer_Settings` (`mailer_host`, `mailer_port`, `mailer_protocol`, `mailer_username`, `mailer_mail_from_name`, `mailer_mail_from_email`, `mailer_password`) VALUES
('smtp.gmail.com', '465', 'ssl', 'devlaninc18@gmail.com', 'Ukamba Bible College', 'devlaninc18@gmail.com', '20Devlan@');

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Notices`
--

CREATE TABLE `Ubc_Notices` (
  `notice_id` varchar(200) NOT NULL,
  `notice_posted_by_id` varchar(200) DEFAULT NULL,
  `notice_details` longblob DEFAULT NULL,
  `notice_to` varchar(200) NOT NULL,
  `notice_posted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Staff`
--

CREATE TABLE `Ubc_Staff` (
  `staff_id` varchar(200) NOT NULL,
  `staff_number` varchar(200) DEFAULT NULL,
  `staff_name` varchar(200) DEFAULT NULL,
  `staff_email` varchar(200) DEFAULT NULL,
  `staff_password` varchar(200) DEFAULT NULL,
  `staff_phone_no` varchar(200) DEFAULT NULL,
  `staff_idno` varchar(200) DEFAULT NULL,
  `staff_profile_image` varchar(200) DEFAULT NULL,
  `staff_access_level` varchar(200) DEFAULT NULL,
  `staff_status` varchar(200) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_Staff`
--

INSERT INTO `Ubc_Staff` (`staff_id`, `staff_number`, `staff_name`, `staff_email`, `staff_password`, `staff_phone_no`, `staff_idno`, `staff_profile_image`, `staff_access_level`, `staff_status`) VALUES
('0740a1648154b36d7dc0e8f5b65959c0673dc691', 'STF-8532', 'Mukiti Pius  Mukmo ', 'pmukiti19@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', '0727844158', '698517', NULL, 'Teacher', 'Active'),
('099dff1575e74241839fd71d3c6ba83991cc63ec5e', 'UBC-001', 'Super Administrator', 'admin@ubc.co.ke', 'a69681bcf334ae130217fea4505fd3c994f5683f', '+2547123456789', '35090012', 'Staff1631603475.png', 'Super Admin', ' Active '),
('099dff1575e74241839fd71d3c6ba83991cc63ec68', 'STF-7619', 'Academic 001', 'academic@ubc.co.ke', 'a69681bcf334ae130217fea4505fd3c994f5683f', '0727844158', '698517', NULL, 'Academic', 'Active'),
('114b7e123b88bb3cf92814bea0311b24b7f5d861', 'STF-3571', 'Daniel Benjamin  Mualuko ', 'finance@ubc.co.ke', 'a69681bcf334ae130217fea4505fd3c994f5683f', '0745587042', '26428110', NULL, 'Finance', 'Active'),
('149a4a119678571d06afc4751c587c34f775d9dc', 'STF-0274', 'Mbuta  Moses Muasya ', 'teacher@ubc.co.ke', 'a69681bcf334ae130217fea4505fd3c994f5683f', '0769671407', '20031570', NULL, 'Teacher', 'Active'),
('27737c681b0891e8b2a93c3556022350ed958f18', 'STF-1874', 'Mumo Rose Mukiti ', '', '9874971b1768e56f4d9e7b90b9ae6ead02738cda', '0711111053', '87907620', NULL, 'Teacher', 'Active'),
('2ec05132481f7d00ecf5228a4f583d19920453b3', 'STF-9865', 'Muindi Ndolo  Peter ', '', '2b7773fb3f40a0050ef13f3028629195009e393f', '0701075804', '11861220', NULL, 'Teacher', 'Active'),
('4781542daf6dc6984229b65535fe986deac139c130', 'STF-1273', 'Dorothy  Muoki', '', '1cb156256cbbbd7abdb219ca9e6b36c820b63b7a', '34567890-', '345678', 'Staff1631602874.png', 'Teacher', 'Active'),
('4dd12458fea6ffd1c46747e22ed29dd6950c96a4', 'STF-7854', 'Kibwaa Thomas  Kieti ', '', '41aa90acf6faf914b8c92a2f77a35f917bfa5142', '0702721424', '7953495', NULL, 'Teacher', 'Active'),
('588def1e2d4f7e18ed345d2376d70d475f99b9c9', 'STF-9415', 'Mwania Marrieta  Mueni ', '', 'd28791b867454379cfab1a37adfadfed93f60019', '0729433922', '9225732', NULL, 'Teacher', 'Active'),
('59c70a66b915c10b36c2fcacb3560e13d64066a6', 'STF-6783', 'Mwanzia   Jonathan  Philip ', '', 'f8a14d60e1b181d766131289776223e16d5e9a19', '0704836537', '13544320', NULL, 'Teacher', 'Active'),
('6ac25e51cc9a37725e443c014c61780b2de3b6d7', 'STF-2468', 'Mutisya Priscah Syowai ', '', '7924e1aa5ff809095856b1f5c02c374a877a646c', '0724472031', '11623985', NULL, 'Teacher', 'Active'),
('c02f8fdcad92aa3b7b1b6f5c1d56f237e3aa1e59', 'STF-6248', 'Matiku Jeremiah  Kioko ', '', '4c5a4e3110cd686f85de886fefb5a3b1fcf079fd', '0720808910', '13638397', NULL, 'Teacher', 'Active'),
('cb1858c9894d3ab65fa715174d42b7c694a3061c', 'STF-5730', 'Ivuku Patrick  Mutunga ', '', '0becff9fec6fcee96652b44b07cfdb84cccddfa3', '0716791066', '10587674', NULL, 'Teacher', 'Active'),
('ce4e90d05cb4fadf6e01388a87069659468ee205fd', 'STF-0691', 'Antony  Kilonzo', 'kilonzowambua254@gmail.com', 'ac3078e0cd717ae2682146577b738dd027975b1a', '0799155770', '234567890', 'Staff1631513966.png', 'Teacher', 'Active'),
('cf1a9baa5ad53cc9d3b2c28d51742707dd331dee', 'STF-2405', 'Jimmy Constance  Mbithe ', '', '9573edfaf0380a3c4a0f3ada085ad30a17c80745', '0716795859', '12723598', NULL, 'Teacher', 'Active'),
('cf7120fb14ded4687cfbc9b9bd2c2507ce491a52', 'STF-2856', 'Mukoma  Millie Muthike ', '', '8635d4027dcb9f9ce7a0d3cf5b008d285b4ff224', '0710867166', '8861348', NULL, 'Teacher', 'Active'),
('d006148b58bd64473c6c831f915ecf937c755960', 'STF-1923', 'Makonge Peninnah Kalekye', 'peninnahngonge@gmail.com', 'fcc990f2429886e881ecaade62de726e8fc7b307', '0701055361', '28858470', NULL, 'Teacher', 'Active'),
('e3de39801756811b02089935bdd2f861452af0d3', 'STF-9803', 'Muinde Daniel Ngovu ', 'danielmuinde2016@gmail.com', '1a93e39646aae584a781c23474e35f843591d1bc', '0727459365', '8827846', NULL, 'Teacher', 'Active'),
('e4a3a6a53b58b6735b83cd976c7c0f679ffb0269', 'STF-7028', 'Kiilu Dickson  Musyoka ', '', '2aa784c8fbd6b032de52c37a0e45fd96850c2590', '0758771363', '14470469', NULL, 'Teacher', 'Active'),
('f3a6fb02f67f94770286dec6fe16e2cdbf5e8958', 'STF-9610', 'Mutua Boniface  Willy ', '', '6715f650c64590bfb3ddfab9645c0f5889f427a3', '0728179051', '23979413', NULL, 'Teacher', 'Active'),
('f8a1c11e6aa57ff2a8d8b10454a0e6658b951b1d', 'STF-9457', 'Ndambuki David  Mutua ', '', '1d3cf60904f57ce10e90af8a872d35b9cfa85d79', '0725095201', '11725809', NULL, 'Teacher', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Student`
--

CREATE TABLE `Ubc_Student` (
  `student_id` varchar(200) NOT NULL,
  `student_admission_no` varchar(200) DEFAULT NULL,
  `student_name` varchar(200) DEFAULT NULL,
  `student_email` varchar(200) DEFAULT NULL,
  `student_password` varchar(200) DEFAULT NULL,
  `student_phone_no` varchar(200) DEFAULT NULL,
  `student_gender` varchar(200) DEFAULT NULL,
  `student_dob` varchar(200) DEFAULT NULL,
  `student_area` varchar(200) DEFAULT NULL,
  `student_region` varchar(200) DEFAULT NULL,
  `student_dcc` varchar(200) DEFAULT NULL,
  `student_local_church` varchar(200) DEFAULT NULL,
  `student_residential_type` varchar(200) DEFAULT NULL,
  `student_address` varchar(200) DEFAULT NULL,
  `student_national_id` varchar(200) DEFAULT NULL,
  `student_profile` varchar(200) DEFAULT NULL,
  `student_father_name` varchar(200) DEFAULT NULL,
  `student_father_national_id` varchar(200) DEFAULT NULL,
  `student_father_phone` varchar(200) DEFAULT NULL,
  `student_mother_name` varchar(200) DEFAULT NULL,
  `student_mother_phone` varchar(200) DEFAULT NULL,
  `student_mother_idno` varchar(200) DEFAULT NULL,
  `student_academic_level` varchar(200) DEFAULT NULL,
  `student_account_status` varchar(200) DEFAULT 'Active',
  `student_date_admitted` varchar(200) DEFAULT NULL,
  `student_academic_caledar_id` varchar(200) DEFAULT NULL,
  `student_additional_fee` varchar(200) DEFAULT '0',
  `student_extra_fee` varchar(200) DEFAULT '0',
  `student_outstanding_fee_bal` varchar(200) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_Student`
--

INSERT INTO `Ubc_Student` (`student_id`, `student_admission_no`, `student_name`, `student_email`, `student_password`, `student_phone_no`, `student_gender`, `student_dob`, `student_area`, `student_region`, `student_dcc`, `student_local_church`, `student_residential_type`, `student_address`, `student_national_id`, `student_profile`, `student_father_name`, `student_father_national_id`, `student_father_phone`, `student_mother_name`, `student_mother_phone`, `student_mother_idno`, `student_academic_level`, `student_account_status`, `student_date_admitted`, `student_academic_caledar_id`, `student_additional_fee`, `student_extra_fee`, `student_outstanding_fee_bal`) VALUES
('09c9491e493fad83ffb084c9205a96923d5ba16da3', 'UBC/3902/21', 'Nancy  Wanza  Muema', 'nancywanza2@gmail.com', 'd9c63ebc03d4010a38a9f747c7efe5d9aaf793ab', '0713604241', 'Female', '1/1/1986', 'Mukaa', 'Mukaa', 'Matiani', 'Vumbu', 'Boarder', 'P.o.box 82 Nunguni', '25830440', 'Student1631603073.png', 'Dishon  Muema', 'Null', '0717520678', 'Magaline  Ng\'atumbi', '0721992512', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('0cf4f2c9e212a18ea3b00f01b7f0ccc38f1b8cd7c7', 'UBC/8067/21', 'Esther   Mukolya', 'esthermukolya@gmail.com', '981925af990e1468429cfa5d58e6071a12bdbdc6', '0741760274', 'Female', '30/3/1998', 'Machakos', 'Mwala', 'Miu', 'Kithoia', 'Boarder', 'Null', '0741760274', 'Student1631622668.png', 'Mukolya  Musyoka', 'Null', 'Null', 'Peninnah  Mukolya', '0716383784', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('1add8b918645521343b6774553d05d57a96600f588', 'UBC/1984/21', 'Dennis Kiilu Mweu', 'pastordih011@gmail.com', 'c3d8b1bed83a430f1a67b1c2c767a3ed61ed95b3', '0748459098', 'Male', '07-04-1999', 'Machakos', 'Machakos', 'Mumbuni', 'Ikokani', 'Boarder', '1043 Machakos', '37588301', 'Student1631603006.png', 'James Mweu', 'Null', '0723309337', 'Stella Mweu', '0726822280', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('2a1f82bbdfd1cb578a36723f29b8a775b15ef0602e', 'UBC/7490/21', 'Stephen  Mulu  Muthusi', 'mulustv599@gmail.com', '0c322c3d8e8aafb6ff08f0711a1252e3c4bfacdd', '0743813590', 'Male', '28/08/1998', 'Kitui', 'Kitui Central', 'Kilawani', 'Maviani', 'Boarder', '91100 Kitui', '39098799', 'Student1631627167.png', 'Julius  Muthusi Mueke', 'Null', 'Null', 'Frolence   Muthusi  Mueke', '0728062397', '4414831', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('335b9b5a1434356d070b644edea4223b21b9fc5bdd', 'UBC/1627/21', 'Festus Vetha Kanini', 'festusvethakanini@gmail.com', '379986819eeb691268f0e6134d765a4214ecc71d', '0700238131', 'Male', '10-12-1999', 'Mwala', 'Mwala', 'Mango', 'Aic Wetaa', 'Boarder', '81 - Mwala', '37760465', 'Student1631602956.png', 'Null', 'Null', 'Null', 'Mary Kanini Nzioki', '0705489100', '23125108', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('5d1ff9e1d44ce6c0146ccc1e319e2eaa2d49e50947', 'UBC/7526/21', 'Ndanu Makovu ', 'elizandanu80@gmail.com', 'bf20d32d3af9c5ec9ab34ff08c53e2fada44dcc4', '0746469964', 'Female', '05-02-1991', 'Machakos', 'Machakos', 'Kitengela', 'Aic Kitengela', 'Boarder', '230 - Kitengela', '29562396', 'Student1631603114.png', 'Isaac Makovu Malombe', 'Null', 'Null', 'Francisca Kanini Makovu', '0712346168', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('5dbe4bcf4aad7cdb64cdf54de0d1094af5a05aba1b', 'UBC/5493/21', 'Damaris  Nduku Mutunga', 'damarisnduku770@gmail.com', 'ed6fb3c0b01a47ca8cb31c9e5df277206ae491c8', '0768655631', 'Female', '7/6/2002', 'Kathozweni', 'Kathozweni', 'Mbuvo south', 'Mbusyani', 'Boarder', 'Null', '39831274', 'Student1631621454.png', 'Isaac  Mukiti', 'Null', '0728563246', 'Ruth  Mutunga', '0795963425', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('5efbce3fa2b5e9d26275110fa14f008cb38b887044', 'UBC/8947/21', 'Naomi  Nguvi', 'naominguvi254@gmail.com', '951ecb39a72850966076f15ffee7c9e1834b3693', '0111388878', 'Female', '6/10/1998', 'Machakos', 'Kaliluni', 'Muvuti', 'Ikiwe', 'Boarder', 'P.O.BOX 264  Muvuti', '0111388878', 'Student1631620928.png', 'Null', 'Null', 'Null', 'Peninnah  Muthiani', '0795460757', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('61b007eec055ff20b040c34cc51034850f9f7dd812', 'UBC/2631/21', 'Alex Mutinda Kithambu', 'alexkithambu@gmail.com', '664e96ad38c1205a9073acfcf4f288318829bcf8', '0791864805', 'Male', '26-01-1999', 'Matuu', 'Ndithini', 'Mananja', 'AIC Kasuvilo', 'Boarder', '59 -10226 Kambiti', '38353985', 'Student1631619542.png', 'Francis Kithambu', 'Null', '0722541476', 'Jane Kithambu', '0721203841', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('6af4b25366e5f3d5ec78164ad759d110c7647a221d', 'UBC/8207/21', 'Josephat Mutuku Katungii', 'jmutuku867@gmail.com', '022026735832469f756b7ed42130d2b26b9f18c1', '0748345539', 'Male', '10-07-1998', 'Mbooni', 'Mbooni', 'Kikima', 'AIC Kyaavua', 'Boarder', '120 Kikima', '36983375', 'Student1631625669.png', 'Joseph Kivuva', 'Null', '0706273134', 'Alice Katungi', 'Null', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('7445626313149d38c3a1344acfeb5660650e22fb54', 'UBC/8534/21', 'Anatoli', 'academic@ubc.co.ke', '4d882ccebeeeba66139640c8ca1c364be15a9711', 'studentavatars', 'Male', 'studentavatars', 'studentavatars', 'studentavatars', 'studentavatars', 'studentavatars', 'Boarder', 'studentavatars', 'studentavatars', 'Student1631602702.png', 'studentavatars', 'studentavatars', 'studentavatars', 'studentavatars', 'studentavatars', 'studentavatars', 'Class 1', 'Active', '2021-09-14', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('7a043fc460efdaa9914d4cefd494796b07c43129ec', 'UBC/8906/21', 'Moses Mwoloi Kilonzo', 'kilonzomoses01@gmail.com', 'eee5784977f730d10dcb9a9e4f0c006b51a53748', '0112394057', 'Male', '27-05-2000', 'Makueni', 'Mutweamboo', 'Mutweamboo', 'AIC Kalatine', 'Boarder', '234 Kalatine', '39851743', 'Student1631629115.png', 'Albanus Kilonzo', 'Null', '0726305205', 'Rosemary Kilonzo', '0726434656', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('896bb89cff3d81614177d9a03c41017e6a52111ca8', 'UBC/1420/21', 'Eunice Kanoti Mulyungi', 'eunicemulyungi19@gmail.com', '6c583a3a9541f8135e93a368c1c6e230d3f82f4a', '0795780291', 'Female', '14-03-1995', 'Machakos', 'Mwingi', 'Mumbuni', 'Nzalae', 'Boarder', 'Null', '31979115', 'Student1631602845.png', 'David Mulyungi', 'Null', '0789764540', 'Annastacia Mulyungi', '0732353461', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('8fb9f4c72b7cc9f03ea9b13588f0cbfe8ca5ff47c8', 'UBC/4805/21', 'Stephen Muoki Kiio', 'kiiomuoki906@gmail.com', '241ca2d8a66e48dd3e600c5fdef357e93c411059', '0708131615', 'Male', '26-10-1992', 'Katoloni', 'Machakos ', 'Katoloni', 'AIC Katoloni', 'Day Scholar', '23 Ithanga', '30738562', 'Student1631624578.png', 'Bernard Kiio', 'Null', 'Null', 'Rose Kiio', '0718923024', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('90457c34858792eb8ceac494dbc39200b0c772e2a4', 'UBC/3596/21', 'Peter Muuo Koti', 'petermuuo2002@gmail.com', 'c4340b1162f5269b4bee8fc946f383ad638b3d1d', '0111529377', 'Male', '18-05-2002', 'Kitui', 'Central', 'Kilawani', 'Imale AIC', 'Boarder', 'Null', '39428746', 'Student1631603038.png', 'Benson Mbuvi Makau', 'Null', 'Null', 'Elizabeth Maria Koti', '0799728784', '11539091', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('9e081e223a31f1ee310185c7683df20a971b36c896', 'UBC/3490/21', 'Benjamin Musembi Kioko', 'kiokobenjamin088@gmail.com', '00a0b166f9edac6ea696c66c05ebe724025cc63c', '0769520594', 'Male', '26-05-1998', 'Machakos', 'Kangundo', 'Itheuni', 'AIC Katulye', 'Boarder', 'Null', '37128434', 'Student1631626294.png', 'Joseph Kioko Musembi', 'Null', 'Null', 'Elizabeth Mwikali', '0702830831', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('a33bd10f25d6e4a863d5233ca35970b221224d9d6b', 'UBC/1467/21', 'Sylvester  Mutunga  Monah', 'sylvestermutunga254@gmail.com', '60da06077f3df534d1b11d908730ca0061a93862', '0705292114', 'Male', '2/1/1995', 'Kitui', 'Kitui Central', 'Mangina', 'Mangina', 'Boarder', 'P.O.BOX 104 -90200 Kitui', '34575597', 'Student1631602921.png', 'Null', 'Null', 'Null', 'Promina  Mona', '0725514234', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('a78f0ec9c751533e0a614f966eea70e8e28e1278ee', 'UBC/8691/21', 'Alexis  Tiku  Kamunzyu', 'alexistiku254@gmail.com', 'b153dc2a905f5c9b285469807ff4bc75c08ccb16', '0708256085', 'Male', '7/7/2001', 'Kitui', 'Lower Yatta', 'Kalivini', 'Kalima', 'Boarder', '91100-Kitui', '0708256085', 'Student1631628040.png', 'Kamunzyu  Kilonzi', 'Null', 'Null', 'Francicas  Kavuu', 'Null', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('a9976b0f72ad74648fa287666e20be6baedc0b1153', 'UBC/1509/21', 'Jackson  Mumo Mwaka', 'Jmwaka714@gmail.com', '8b2b99c8ce52a680125ec5e06eef885ce407ca8a', '0723391090', 'Male', '07/11/1984', 'Machakos', 'Machakos', 'Bomani', 'Mukalala', 'Boarder', '2357-90100 Machakos', '24083840', 'Student1631625033.png', 'Johnstone  Mwaka Ngundo', 'Null', 'Null', 'Jospine Wayua  Mwaka ', '0724453508', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('a9ec74ce6769d5852fc2c7cb266090c7029da28ae3', 'UBC/1683/21', 'Samuel  Ndambuki  Wambua', 'mambosamuel586@gmail.com', 'ad320838599413d175e4d174191b0241218e1d7a', '0715163869', 'Male', '3/3/2001', 'Yatta', 'Matuu', 'Mutwamwaki', 'Mutwamwaki', 'Boarder', 'P.O.BOX 77  MATUU', '38765657', 'Student1631602988.png', 'Philip  Wambua  Nyamai', 'Null', '0720295949', 'Eunice  Nyiva  Kimeu', '0112538231', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('abf7ce69db60957f9a43d5163ee4a24b76ae4c6a88', 'UBC/8637/21', 'Leah Mueni Muasya', 'leahmueni40@gmail.com', '535cbe270eed388dac0c8d7be6de7936f486ae1e', '0701451104', 'Female', '28-02-1978', 'Machakos', 'Mwala', 'Masii', 'AIC Muthei', 'Boarder', '72 Masii', '21238899', 'Student1631624054.png', 'John Muthama', 'Null', 'Null', 'Veta Martha Muthama', '0713524317', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('ad17d25984ae4d9d827161045d469993ddd25d580a', 'UBC/2150/21', 'Bernard  Arap  Mutisya', 'bernardarap33@gmail.com', 'd34481b70fd87b4a4a044c3e3a66b542b56102cc', '0705895858', 'Male', '5/11/1998', 'Kitui', 'Mulango', 'Yumbisye', 'Yumbisye Township', 'Boarder', 'Null', '39046109', 'Student1631617772.png', 'Mutisya  Ndambuki', 'Null', '0720476980', 'Tabitha   Mutisya  ', '0717125062', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('b14fd60a9bcb5cc06f25678e82e8509c08b7e17d5d', 'UBC/0265/21', 'Purity  Mwende  Kavemba', 'kavembapurity4@gmail.com', 'b84ff97f0ab54ccc73f6ab4fc1b66de05d642066', '0793670291', 'Female', '18/9/1997', 'Matuu', 'Yatta', 'Ikombe', 'Ikombe', 'Boarder', 'P.O.BOX 82 Kivunga', '38560292', 'Student1631602753.png', 'Null', 'Null', 'Null', 'Annasicia  Kavemba  Wambua', 'Null', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('b6ac4de1d0b885b9f173cd428bf47c696937d4a433', 'UBC/6478/21', 'Paul  Muli Mutinda', 'paulmuli125@gmail.com', 'c282318bef85c8071b56da0c68cfcb2d7cf2b781', '0768121326', 'Male', '4/1/1999', 'Upendo Worship Centre -Athi river', 'Upendo Worship Centre -Athi river', 'Upendo Worship Centre -Athi river', 'Upendo Worship Centre -Gategi', 'Boarder', 'P.O.Box 17 Karaba', '38114839', 'Student1631603090.png', 'John  Mutinda  Muli', '10641030', '0715623801', 'Agnes  Nzisa Mutinda', '0726605182', '24735878', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('b886f8ee6a23d78662f13caa371bec73ffeaff9799', 'UBC/0934/21', 'Josephine Ngusye Mutungi', 'josphinengusya@gmail.com', '83c3f26054d41adba54a5371c3d34106bf703aad', '0729569063', 'Female', '20-12-1998', 'Makueni', 'Nunguni', 'Inyokoni', 'Nyaani', 'Boarder', 'Null', 'Null', 'Student1631602816.png', 'Mutungi Malelu', 'Null', 'Null', 'Jennifer Mutungi', '0708067177', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('baf8972a06fd48a31c657932c883f2ff297c206df1', 'UBC/9285/21', 'Michael Munyao Kasyoki', 'michaelkasyoki982@gmail.com', '5580d4ee5ce14f903e1fa5e5b0b3ba47caf9a037', '0711225096', 'Male', '31-01-1999', 'Mukaa', 'Mukaa', 'Tangu', 'Aic Ivia Itune', 'Boarder', '57 Yoani', '35920783', 'Student1631606744.png', 'Kasyoki Reuben', 'Null', '0714587913', 'Mary Kasyoki', 'Null', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('bdb266548419d7fcb99b24263db992522d3e9be157', 'UBC/9342/21', 'Joel  Wambua', 'joelwambua673@gmail.com', 'af60c4884dcdf0073e66de9d21702fbc91e26f94', '0717101283', 'Male', '19/8/2002', 'Machakos', 'Mbooni', 'Kikima', 'Mitamboni', 'Boarder', 'P.O.BOX.120 Kikima', '39908407', 'Student1631603202.png', 'Null', 'Null', 'Null', 'Joyce  Joel  Nthiwa', '0726818846', '0693631', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('cbcdd7761033cd4a9578bf01cdb59af57109b5bcb9', 'UBC/4715/21', 'Mary  Mueni  Muinde', 'marymuinde552@gmail.com', '33e56a4d5ac266e099ad97d627837063d5820afd', '0769378375', 'Female', '26/8/2001', 'Machakos', 'Machakos', 'Misakwani', 'Misakwani', 'Boarder', 'P.O.BOX 2503 Misakwani', '39629710', 'Student1631618302.png', 'Richard  Muinde Peter', 'Null', 'Null', 'Naumi  Mwikali', '0792534473', '31512334', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('d17b0ad5746c5fd97ff42489754977c54667262cf5', 'UBC/0647/21', 'Josphat Mwendwa Muema', 'joshpatmwendwa@gmail.com', '3ad3679dad8cdf3b2dbb71e49533f16f9c517446', '0745650859', 'Male', '01-04-1999', 'Makueni', 'Makueni', 'Kathonzweni', 'AIC Kwa Muthusi', 'Boarder', 'Null', '37296537', 'Student1631618855.png', 'Muema Kilungu', 'Null', '0701946023', 'Catherine Muema', '0703290436', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('d17df816d0fb82d4b1ec2f70459f89f72e9edc3210', 'UBC/6950/21', 'Benson Mwangi Kihara', 'benzmwangi886@gmail.com', 'ba8a6e6eaa8b6e4503e7e3c3411720865d0ac241', '0704068864', 'Male', '10-10-1998', 'North Nyandarua', 'Nyandarua', 'Nyahururu', 'Mairo-Inya', 'Boarder', '289 Nyahururu', '37995330', 'Student1631617731.png', 'Michael Kihara', 'Null', '0705807568', 'Grace Wangari Kihara', '0712230672', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('df0ac12afbe1184d8c645c4494926497ac5d640266', 'UBC/2036/21', 'Patrick   Kilonzo  Mailu', 'patrickkilonzo536@gmail.com', '85de49c02c7aa676de4e922f222695c66e3d77b7', '0796914625', 'Male', '12/12/1998', 'Makueni', 'Nunguni', 'Nunguni', 'Kwa nduti', 'Boarder', '90130 Nunguni', '36970760', 'Student1631625971.png', 'Francis  Mailu  Mutune', 'Null', '0706872395', 'Agnes  Mukaya   Kitela', '0718633474', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('e20bafb554a41a5203b60640e8276c722a71f35660', 'UBC/9576/21', 'Celestine Mueni Muema', 'celestinemuema1@gmail.com', '1876eaefdf5cdf00b4481bcbbe970997780329a0', '0745924864', 'Male', '01--08-2002', 'Machakos', 'Kalama', 'Katanga', 'AIC Wanzauni', 'Boarder', '37 Aic Wanzauni', '39717444', 'Student1631627670.png', 'Josphat Muema Kyaa', 'Null', '0712266539', 'Alice Ndinda Muema', '0726145359', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('e649cf09db59ee5fecd4651bd2d57f414ebd6c3f31', 'UBC/4215/21', 'Benjamin  Musili  Kimwele', 'bentraxer2019@gmail.com', '80f2bc994efe308211f17a62c0c6f2f2560a06fe', '0796635120', 'Male', '6/10/1994', 'Machakos', 'machakos', 'Kasina', 'Baraka', 'Boarder', 'P.o.box 660 Mwingi', '33659610', 'Student1631606851.png', 'Wilson  Kimwele', 'Null', '0733499517', 'Grace   Muli', '0789332251', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('e730c71e830e61f24a1d6365fda5067f3a30375a93', 'UBC/2831/21', 'Samuel Mwongela Mulwa', 'mwongelablessam@gmail.com', '992689119ae8abc4f0a9d52bcd161591ace7eda9', '0742739657', 'Male', '05-08-2000', 'Null', 'Null', 'Null', 'Light Christian Center - Kenya Israel', 'Day Scholar', 'Null', '39745644', 'Student1631620001.png', 'Joseph Mulwa', '10739696', 'Null', 'Anna Kanini', '0705860386', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('e9a0d22b8584dd3c62ccd88a2a1e9ce116f2f7488f', 'UBC/1247/21', 'Festus  Mutua', 'ffestusmutua27@gmail.com', 'a24707db16da92a747b06bfcd9d702ceb83d4d73', '0707142605', 'Male', '26/4/1996', 'Machakos', 'Kaliluni', 'Muvuti', 'Ngomano', 'Boarder', '71 Machakos', '34289415', 'Student1631619686.png', 'Mutua  Maithya', 'Null', 'Null', 'Milicah  Kalekye Mutua', '0716804297', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('e9d45c46645bc45d9ef88071b98894349153fe3d99', 'UBC/2076/21', 'Lydia  Mutiso', 'lydiamutiso4@gmail.com', '389e84f6b17a5ae95c5639c4b1dded05753245a6', '0794852116', 'Female', '18/3/1999', 'Machakos', 'Mwala', 'Muthetheni', 'Kiliku', 'Boarder', 'Null', '39461233', 'Student1631619057.png', 'Julius  Mutiso', 'Null', '0713000842', 'Mary  Nduku', 'Null', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('ebe8d20dee840aa349f3512041e23b8a734b695d93', 'UBC/4798/21', 'Grace   Ndete  Ithau', 'Null@gmail.com', 'd3ba6efa3021d35d24fb737118fa8e8f6c86189e', '0769638084', 'Female', '13/1/2000', 'Machakos', 'Kalama', 'Katanga', 'Katanga', 'Boarder', 'Null', '39886955', 'Student1631629017.png', 'Paul  Ithau', 'Null', '0702939172', 'Frolence   Mwikali', '0713189028', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('ee7ea1714b769618bf1186fa8ddab153584aa63d78', 'UBC/8964/21', 'Esther Ndunge Mutuku', 'esthermutuku149@gmail.com', '3ab5e642f4f1a5ba1fd7dec1a6823d6b5e3766f9', '0792175214', 'Female', '03-05-1998', 'Machakos', 'Kangundo', 'Itheuni', 'AIC Katulye', 'Boarder', 'Null', '37158878', 'Student1631603178.png', 'Jackson Mutuku', 'Null', '0712104999', 'Null', 'Null', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('f168249d192ea3dde1f7322e8052c2559a14701595', 'UBC/4075/21', 'Pauline Mbula Meshack', 'paulinemeshack186@gmail.com', '479b44e0bd53de8aad2497d5842ce4312fb99473', '0741866163', 'Female', '08-01-1993', 'Machakos', 'Mbooni', 'Mbooni', 'Uuta', 'Boarder', '67 Tawa', '31497989', 'Student1631621727.png', 'Benjamin Mule', 'Null', '0720666294', 'Mary Mwanza', '0794019960', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('f4acbc4c44148fab7c7a4da2dda4e3e0a2c863d4da', 'UBC/9273/21', 'Grace Wanza Musyoki', 'gracewanza077@gmail.com', '572e4dbd018db384411ccc2e3253275ad7719ea1', '0111438798', 'Female', '07-02-2002', 'Matuu', 'Yatta', 'Kikesa', 'AIC Katutuni', 'Boarder', 'Null', '39541927', 'Student1631628575.png', 'Stanley Musyoki', 'Null', '0708807260', 'Alice Mwongeli', '0707335511', '28403903', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('f537ad855fce8c302ce134525674d8d20c896f41a3', 'UBC/5072/21', 'Gideon Wambua Peter', 'wawerugiddy5@gmail.com', '2e4618229cb1222ed7b888bb388ee05d9c1bc5ba', '0708091544', 'Male', '14-12-1996', 'Makueni', 'Nunguni', 'Nunguni', 'Aic Katitu', 'Boarder', '200 Nunguni', '35352161', 'Student1631624952.png', 'Kioko Peter Muthoka', 'Null', '0745670174', 'Catherine Syokwaa Munywoki', '0719603533', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('fd5bc026b8a0420cd3aabb2c1b2ec3154e39c76b36', 'UBC/5324/21', 'Samuel Mwanzia Nzioka', 'nziokas602@gmail.com', '95e8b09b7b195bc68acb7c4c8202349e0de15962', '0794551335', 'Male', '19-05-1998', 'Machakos', 'Kaliluni', 'Kombu', 'AIC Kalandini', 'Boarder', 'Null', '38384643', 'Student1631620909.png', 'Philip Nzioka Nganga', '1690948', '0717156466', 'Josephine Katulu', 'Null', '1691417', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0'),
('ff9e943fc511a4623f1e7b91bbb9824b0df6e3ae05', 'UBC/2589/21', 'Gabriel Mutiso Nzinza', 'gabrielmutiso640@gmail.com', '68795f6dd46c8947e03a603a6c96c135ca4b189f', '0707441766', 'Male', '23-03-1993', 'Machakos', 'Mwala', 'Makutano', 'Utithini', 'Boarder', '462 Masii', '30251620', 'Student1631626923.png', 'Simon Nzinza', 'Null', '0790782337', 'Beth Nzinza', 'Null', 'Null', 'Class 1', 'Active', '2021-09-13', 'a71c4af4800bea7786399f16834505be894d17a69b', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Student_Marks`
--

CREATE TABLE `Ubc_Student_Marks` (
  `marks_id` varchar(200) NOT NULL,
  `marks_allocation_id` varchar(200) DEFAULT NULL,
  `marks_midterm_exam` varchar(200) DEFAULT NULL,
  `marks_assignments` varchar(200) DEFAULT NULL,
  `marks_final` varchar(200) DEFAULT NULL,
  `marks_student_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_System_Settings`
--

CREATE TABLE `Ubc_System_Settings` (
  `Ubc_System_Setting_system_name` varchar(200) DEFAULT NULL,
  `Ubc_System_Setting_po_box` varchar(200) DEFAULT NULL,
  `Ubc_System_Setting_contact` varchar(200) DEFAULT NULL,
  `Ubc_System_Setting_mail` varchar(200) DEFAULT NULL,
  `Ubc_System_Setting_website` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_System_Settings`
--

INSERT INTO `Ubc_System_Settings` (`Ubc_System_Setting_system_name`, `Ubc_System_Setting_po_box`, `Ubc_System_Setting_contact`, `Ubc_System_Setting_mail`, `Ubc_System_Setting_website`) VALUES
('Ukamba Bible College', 'P.O BOX 1271 - 90100 Machakos, Kenya', '0727459365 / 0716795859', 'ukambabc@yahoo.com', 'https://ubc.co.ke');

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Teaching_Allocations`
--

CREATE TABLE `Ubc_Teaching_Allocations` (
  `teaching_allocation_id` varchar(200) NOT NULL,
  `teaching_allocation_academic_calendar_id` varchar(200) NOT NULL,
  `teaching_allocation_staff_id` varchar(200) NOT NULL,
  `teaching_allocation_unit_id` varchar(200) NOT NULL,
  `teaching_allocation_class_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_Teaching_Allocations`
--

INSERT INTO `Ubc_Teaching_Allocations` (`teaching_allocation_id`, `teaching_allocation_academic_calendar_id`, `teaching_allocation_staff_id`, `teaching_allocation_unit_id`, `teaching_allocation_class_name`) VALUES
('044f0761ae57f31fc330ae6392323f0379061fbd68', 'a71c4af4800bea7786399f16834505be894d17a69b', 'cf7120fb14ded4687cfbc9b9bd2c2507ce491a52', '4585fd36d6b6378c59218fe0913433193a8dd9da', 'Class 1'),
('1174faaf28ba8b4b3df6dfeeb2d1c35fe0dd2106e5', 'a71c4af4800bea7786399f16834505be894d17a69b', 'cf7120fb14ded4687cfbc9b9bd2c2507ce491a52', '34a7ca998527c626a3f106854d5d7cb4e74387e1', 'Class 2'),
('2072a02ccdcc5e23e370b5a409b82a31610c950110', 'a71c4af4800bea7786399f16834505be894d17a69b', '0740a1648154b36d7dc0e8f5b65959c0673dc691', 'bc07bffd14d85bd6717a4d3da8e646edc91498f6', 'Class 2'),
('3a5f39add12a72b6eb6e26fb22513c6c2770bf5105', 'a71c4af4800bea7786399f16834505be894d17a69b', 'c02f8fdcad92aa3b7b1b6f5c1d56f237e3aa1e59', '4077a8625d356d35752fd1ef7e889cb085302a947a', 'Class 2'),
('4eaf682b6bdb85f4065dacaeffcd6b0beddb810f08', 'a71c4af4800bea7786399f16834505be894d17a69b', '4dd12458fea6ffd1c46747e22ed29dd6950c96a4', 'fe0f2a3de4e1932809d2e1e7ef0bb242bda485e2', 'Class 2'),
('5598fda2eefa574a445f727c35d8d58d16a320db4c', 'a71c4af4800bea7786399f16834505be894d17a69b', 'ce4e90d05cb4fadf6e01388a87069659468ee205fd', 'd5ee58235a74be75d2ef0f9cbb2f48d', 'Class 1'),
('58bcd33ee9c9ee03b9335aec668b241690601174d3', 'a71c4af4800bea7786399f16834505be894d17a69b', '4dd12458fea6ffd1c46747e22ed29dd6950c96a4', '4bc904ec5e90e586043910a11a94170b1b10508d', 'Class 2'),
('60ae34ff36dbb2aeb3551aaba8ccc8f0ab636077b3', 'a71c4af4800bea7786399f16834505be894d17a69b', '4781542daf6dc6984229b65535fe986deac139c130', '59d459439db47fbee4adc568f313fa4dddbf0c7b', 'Class 2'),
('62253facf10577534bfa6eebe12b48ebdcc364c7d6', 'a71c4af4800bea7786399f16834505be894d17a69b', 'cf7120fb14ded4687cfbc9b9bd2c2507ce491a52', '038cd8a09695efc3ff11502tfhsdyukasdlweui', 'Class 1'),
('85c190a04c4c2e5de5609ca6a234104ecd3f9e13c8', 'a71c4af4800bea7786399f16834505be894d17a69b', '4dd12458fea6ffd1c46747e22ed29dd6950c96a4', '33747c1b523c9b3f5ddc8f61df3b9cb85d5f8c66', 'Class 1'),
('a53adfceed4a5eb590d7370d4e88c60a1244f4a162', 'a71c4af4800bea7786399f16834505be894d17a69b', 'c02f8fdcad92aa3b7b1b6f5c1d56f237e3aa1e59', 'c38c2f829bf7e90df5fad646d32379db9e2eb528', 'Class 1'),
('c5c8ecab05ee643b0ce236ff962cda77e9e14fdba0', 'a71c4af4800bea7786399f16834505be894d17a69b', '4dd12458fea6ffd1c46747e22ed29dd6950c96a4', 'e3ef9a0d15fa9c0f2ffc134f12c8e177051ca2b6', 'Class 2'),
('c9851c76764ea0b62c1d810bf03ca8440fbc6188d8', 'a71c4af4800bea7786399f16834505be894d17a69b', 'ce4e90d05cb4fadf6e01388a87069659468ee205fd', 'd5ee58235a74be75d2ef0f9cbb2f48d', 'Class 2'),
('ca9c32db41bb438d6df649f7766ed4c17f9a0466ef', 'a71c4af4800bea7786399f16834505be894d17a69b', '0740a1648154b36d7dc0e8f5b65959c0673dc691', '3f714a39283777378389601ba8a53d2e3f6dde61', 'Class 1'),
('d37e1e9a83e1569b650f6d51cbf0e92417757b5f99', 'a71c4af4800bea7786399f16834505be894d17a69b', 'e3de39801756811b02089935bdd2f861452af0d3', 'b55fd991e40d0f547fe9d6bb5d0fd45bde2b74eb', 'Class 2'),
('dc0b35bf8e146c9c4e49a309d34a9f98087cf23a37', 'a71c4af4800bea7786399f16834505be894d17a69b', 'c02f8fdcad92aa3b7b1b6f5c1d56f237e3aa1e59', '4bc904ec5e90e586043910a11a94170b1b10508d', 'Class 1'),
('f6db3f5ca8770389ffe00363cfc3e76dbdaf2d83cf', 'a71c4af4800bea7786399f16834505be894d17a69b', '0740a1648154b36d7dc0e8f5b65959c0673dc691', '3811a45b9e1e38460aeb3227492dec0cf848da12', 'Class 1');

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Timetable`
--

CREATE TABLE `Ubc_Timetable` (
  `timetable_id` varchar(200) NOT NULL,
  `timetable_class_time` varchar(200) DEFAULT NULL,
  `timetable_day` varchar(200) DEFAULT NULL,
  `timetable_allocation_id` varchar(200) DEFAULT NULL,
  `timetable_break` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_Timetable`
--

INSERT INTO `Ubc_Timetable` (`timetable_id`, `timetable_class_time`, `timetable_day`, `timetable_allocation_id`, `timetable_break`) VALUES
('015a0334da280b0f443abb122d42e0b2d12a7b041a', '10', 'Tuesday', '5598fda2eefa574a445f727c35d8d58d16a320db4c', NULL),
('04e590ac94716249d28dad0472cfc50f43ac3ba1f9', '6', 'Tuesday', '3a5f39add12a72b6eb6e26fb22513c6c2770bf5105', NULL),
('07816e1791d6c09d73d5aa675cbf8d0a48e6e7c8a3', '7', 'Monday', NULL, 'Lunch'),
('0f4919a9cf08ad6a736e68f00cf7cbc3e474adc7ab', '5', 'Tuesday', '60ae34ff36dbb2aeb3551aaba8ccc8f0ab636077b3', NULL),
('122ceeb60cadc09099f0a11b2089bf96394fd8e6fc', '5', 'Thursday', '044f0761ae57f31fc330ae6392323f0379061fbd68', NULL),
('1406d5f4d984f84f0b6a0b5b898fa1d6bfa5f31c91', '2', 'Tuesday', '044f0761ae57f31fc330ae6392323f0379061fbd68', NULL),
('16afb696e0c6a6dc46d82f5ebeb277f311af9a8351', '2', 'Thursday', 'ca9c32db41bb438d6df649f7766ed4c17f9a0466ef', NULL),
('1d6d1de16fe0fb090a1b555643759b0122b89b0637', '8', 'Wednesday', '2072a02ccdcc5e23e370b5a409b82a31610c950110', NULL),
('1f867243b5a23fc69b6d2e6fabe8b0cd62e015616e', '3', 'Tuesday', NULL, 'Chapel'),
('22ea2f24c2d105b893a64cacdc9924571b39d13867', '4', 'Friday', NULL, 'Tea Break'),
('26c7e20579f19f9b9ffd7fe4905342d435ce8b0e19', '2', 'Wednesday', '3a5f39add12a72b6eb6e26fb22513c6c2770bf5105', NULL),
('26e33f70b59b94f4452adad55dec09b3311edd4716', '6', 'Monday', 'a53adfceed4a5eb590d7370d4e88c60a1244f4a162', NULL),
('287d7077d1fc68bf0b08dc62197e1dc1da16b29462', '5', 'Monday', '044f0761ae57f31fc330ae6392323f0379061fbd68', NULL),
('2d45cbaa6ff3588878cfe324b1763b08d706e7f49b', '5', 'Friday', '62253facf10577534bfa6eebe12b48ebdcc364c7d6', NULL),
('2d69dc503c39f45d5c7515d241649cdce08a391ad7', '6', 'Wednesday', '4eaf682b6bdb85f4065dacaeffcd6b0beddb810f08', NULL),
('3923964d0ef349dab88ecf103f1113bfe1a46cf914', '2', 'Tuesday', 'c5c8ecab05ee643b0ce236ff962cda77e9e14fdba0', NULL),
('3da755698daf2fa1192f0eb15d23fdc60d72170cae', '6', 'Tuesday', '85c190a04c4c2e5de5609ca6a234104ecd3f9e13c8', NULL),
('43a486cdef4835a737fcb0d25891b3b3f020882fe4', '8', 'Thursday', '2072a02ccdcc5e23e370b5a409b82a31610c950110', NULL),
('43dac8e6d4414cfc5e97343d50017a5b46b5f4f12c', '5', 'Thursday', '60ae34ff36dbb2aeb3551aaba8ccc8f0ab636077b3', NULL),
('4960abc2fe8cdd03da818c54a20fb3a913bfe2782b', '6', 'Friday', '4eaf682b6bdb85f4065dacaeffcd6b0beddb810f08', NULL),
('4ae30a1739a6793c68798b2b2841272fc11812ecbd', '10', 'Thursday', 'c9851c76764ea0b62c1d810bf03ca8440fbc6188d8', NULL),
('4c1aad8ebc5eb364af89b3d7cac21f2cf66362534e', '1', 'Tuesday', 'dc0b35bf8e146c9c4e49a309d34a9f98087cf23a37', NULL),
('58f890e7a2132535af41e77e141ad3040a6ac49eec', '1', 'Monday', 'c5c8ecab05ee643b0ce236ff962cda77e9e14fdba0', NULL),
('5b9055b34be6e53b0083f69b183dde65222dc657b9', '4', 'Thursday', NULL, 'Tea Break'),
('5e79a9bc1575e30a12311d6aaf9fe42fc49445bbe0', '8', 'Tuesday', 'a53adfceed4a5eb590d7370d4e88c60a1244f4a162', NULL),
('5ea5ec2c7eb2fa24d438c1f648127e44b948bfe33b', '6', 'Monday', '1174faaf28ba8b4b3df6dfeeb2d1c35fe0dd2106e5', NULL),
('6255f2bfa65c39ff6cad2ce43fdcb249dba5b85b7a', '8', 'Wednesday', '62253facf10577534bfa6eebe12b48ebdcc364c7d6', NULL),
('64709af9fa5c2844b3497290e2ab15778a84adbfde', '5', 'Tuesday', '62253facf10577534bfa6eebe12b48ebdcc364c7d6', NULL),
('6b09c51c60500bb1abb96ad3352617d64af3f53d2d', '5', 'Monday', '2072a02ccdcc5e23e370b5a409b82a31610c950110', NULL),
('6c50f628f9f8853e74abfd0d64c86947e3d35749df', '8', 'Monday', 'd37e1e9a83e1569b650f6d51cbf0e92417757b5f99', NULL),
('6e46fe14aa0aadfbd4b158cde602a522d1da31edf7', '7', 'Wednesday', NULL, 'Lunch'),
('6e516944542d5422d2a76a9ad9f4b068c5df2121a0', '2', 'Wednesday', 'f6db3f5ca8770389ffe00363cfc3e76dbdaf2d83cf', NULL),
('705bb0633846eaf18350cb7a99d1a73395a21eda4a', '1', 'Wednesday', 'a53adfceed4a5eb590d7370d4e88c60a1244f4a162', NULL),
('751b8a701a146ca2cd9170571cbba97e0bc36568e2', '3', 'Thursday', NULL, 'Chapel'),
('7d960c315ee4a957658f4c5065b431f541acab1be3', '3', 'Wednesday', NULL, 'Chapel'),
('821f15e4d678a3b04af0c141b3919f5db209fd8a08', '6', 'Wednesday', 'dc0b35bf8e146c9c4e49a309d34a9f98087cf23a37', NULL),
('82edf0ab7175c01b50f0395ed01e70b60d37d1e592', '7', 'Thursday', NULL, 'Lunch'),
('89cdc2e60fb2ca27084e530fec6fe4a632fbd06ae2', '5', 'Friday', '60ae34ff36dbb2aeb3551aaba8ccc8f0ab636077b3', NULL),
('91a7484555bb2c4774308cf26e291b488712de5814', '5', 'Wednesday', 'c5c8ecab05ee643b0ce236ff962cda77e9e14fdba0', NULL),
('9213382759eceed831f154b994fa20b480c7f9b9c8', '1', 'Thursday', '2072a02ccdcc5e23e370b5a409b82a31610c950110', NULL),
('a527ef174a58a12889cfebcc32e91371f130be6761', '9', 'Tuesday', '5598fda2eefa574a445f727c35d8d58d16a320db4c', NULL),
('ac41f2411e4c90c68dbe15a2a4aec0d87846685f34', '7', 'Tuesday', NULL, 'Lunch'),
('acad8002a2b00085b270a129d4bad0665093f455c4', '7', 'Friday', NULL, 'Lunch'),
('add95989b78e5c67f92a00f3b8422558b767a3b8f2', '4', 'Wednesday', NULL, 'Tea Break'),
('ade92e765d0534fa9fbf311feec8632edd2964a264', '2', 'Monday', '60ae34ff36dbb2aeb3551aaba8ccc8f0ab636077b3', NULL),
('aee0df9c8c318071c4e0f99519ce8bc0d95539bc08', '5', 'Wednesday', 'ca9c32db41bb438d6df649f7766ed4c17f9a0466ef', NULL),
('b7e9bd8dfd6960db2dc270b8891470211333745d76', '3', 'Friday', NULL, 'Chapel'),
('ba89ea2e4d7a4e9148ccb42a185701198cbfa47438', '1', 'Monday', 'ca9c32db41bb438d6df649f7766ed4c17f9a0466ef', NULL),
('bf849cada0785edff62a296ad65404680a7554600f', '1', 'Friday', '85c190a04c4c2e5de5609ca6a234104ecd3f9e13c8', NULL),
('c588f5c498add8b071da25d28e70e86e143780c6b2', '9', 'Thursday', 'c9851c76764ea0b62c1d810bf03ca8440fbc6188d8', NULL),
('c6876d2a148299fa2035b66b0c4289a168e5cc4222', '4', 'Tuesday', NULL, 'Tea Break'),
('c6d4d945d5bcb8cf19b2732a3da7877aa96553aa2b', '6', 'Thursday', 'f6db3f5ca8770389ffe00363cfc3e76dbdaf2d83cf', NULL),
('c6e394bfda6efd1c3da9e186ff7487ea4b7cb511a8', '2', 'Thursday', 'd37e1e9a83e1569b650f6d51cbf0e92417757b5f99', NULL),
('c7f40832f11eac66c675d57a16d4d49445497f2347', '6', 'Friday', 'ca9c32db41bb438d6df649f7766ed4c17f9a0466ef', NULL),
('cd843770a780efe8362d67ed0d471f7fc3d2550ea8', '1', 'Tuesday', '4eaf682b6bdb85f4065dacaeffcd6b0beddb810f08', NULL),
('d226bc3a9649bf6ffc794af59249473f0fec502c7c', '6', 'Thursday', '1174faaf28ba8b4b3df6dfeeb2d1c35fe0dd2106e5', NULL),
('d4d1c593b742877bce2dfd93ab4e2f0516e1f3a0ae', '8', 'Tuesday', 'd37e1e9a83e1569b650f6d51cbf0e92417757b5f99', NULL),
('dad977618228241a6b01f00a4d57ce84d8768bbb21', '1', 'Friday', '3a5f39add12a72b6eb6e26fb22513c6c2770bf5105', NULL),
('e9d57ef8a3f4fe0286417f860f8875b99d1c325ec8', '3', 'Monday', NULL, 'Chapel'),
('f3922680e1b254bf00b75dcea64d2d7e3ea8045604', '1', 'Wednesday', '1174faaf28ba8b4b3df6dfeeb2d1c35fe0dd2106e5', NULL),
('f71f7519eb1966a59e4022e14969b6ab983b87fd46', '4', 'Monday', NULL, 'Tea Break'),
('f8258ea15cebcaba15e3c168982a5592230f816327', '8', 'Monday', 'f6db3f5ca8770389ffe00363cfc3e76dbdaf2d83cf', NULL),
('f9f5ba3cc2bf7813e3d186051cd92f606beb849248', '2', 'Monday', '85c190a04c4c2e5de5609ca6a234104ecd3f9e13c8', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Ubc_Units`
--

CREATE TABLE `Ubc_Units` (
  `unit_id` varchar(200) NOT NULL,
  `unit_code` varchar(200) DEFAULT NULL,
  `unit_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_Units`
--

INSERT INTO `Ubc_Units` (`unit_id`, `unit_code`, `unit_name`) VALUES
('038cd8a09695efc3ff115022fb932b7dfd2ef33f', 'B221', 'Act Rev.'),
('038cd8a09695efc3ff11502tfhsdyukasdlweui', 'B1222', 'Spirit Format'),
('050cbeec56ddb112b1c6e32956cf23f237b8dc27', 'M342', 'Counseling II'),
('0cb51520f725516f308e1cc39044785559f78762', 'B540', 'Bible Critic'),
('1749a3c13d95f67181d9107948172fee8c02ceb2', 'M113', 'Hom. II'),
('20902266625de5cbef306278a81d0e930ff7d0f4', 'B311', 'Appl. Hermenu'),
('33747c1b523c9b3f5ddc8f61df3b9cb85d5f8c66', 'B210', 'Gospel I'),
('34a7ca998527c626a3f106854d5d7cb4e74387e1', 'B420', 'Greek III'),
('35f10ccfea68ae617c44e90482d9fb88a2f3ee76', 'B120', 'Prophets'),
('3647b7c77490222d1986207c41f66306150a0978', 'C221', 'Africa Ch. History II'),
('3811a45b9e1e38460aeb3227492dec0cf848da12', 'B510', 'Bib. Introd.'),
('3984571c06ac9235bfc19ae17e06c5b90d1d53b8', 'T530', 'African Trad. Religion'),
('3d3664c0accfe7e4dc6e00edd4a253cdc6b479fc', 'C130', 'World Ch. History II'),
('3e302a95bf7ecf65b4bc89b2f5dd346d24456b4f', 'T420', 'Biblical Ethics'),
('3f714a39283777378389601ba8a53d2e3f6dde61', 'B11 ', 'Pentateuch'),
('4077a8625d356d35752fd1ef7e889cb085302a947a', 'B1222', 'Intro C EDU'),
('425296041ea6bfd3dbae8a3fffe2436378372333', 'M413', 'Christian Home'),
('4585fd36d6b6378c59218fe0913433193a8dd9da', 'B412', 'Research Writing'),
('482cec5f9823fbc46cdbdbd2d3e0f9acf560f07f', 'B112', 'Psalms'),
('4b0029f83e095157a50a2784539a5907f8059ebb', 'T131', 'Soteriology'),
('4bc904ec5e90e586043910a11a94170b1b10508d', 'M210', 'Public Speaking'),
('4c6abb7f375dff51dbc8601b1aa9f1737925af9a', 'T142', 'Eschatology'),
('537f408d6faf5d25c3023fae39a5492dc9e52b5f', 'B435', 'Greek EX. III'),
('59d459439db47fbee4adc568f313fa4dddbf0c7b', 'M120', 'Prin. Of Teach I'),
('5a23852ea16648cff357cf7994acde5217db7f4c', 'M122', 'Prin. Of Teach II'),
('5dbd21e3bd1e1a30c694d4ebb1884288565af297', 'M330', 'Pastoral'),
('5e4f051ce5a19f910dd1817e09f1bd320cf69b37', 'T423', 'Apologetics'),
('5e58f9cb171a7fc0f4b8c19c8f27c5ee97cca919', 'M120', 'Children & Youth'),
('5e69c2cbfaf960157fc7744ac7e134a62e3f9884', 'B433', 'GK EXE. I'),
('6118cf11ac2de72e1b4654cb1e51d54bc592fac5', 'B411', 'Study Skills'),
('63f46002c9e8aefa00792ddc51f55aa3ac1ed6ef', 'C220', 'Af. Ch. History 1'),
('666f0c185c499a8e3c9a719b10ac9fbac3964739', 'C213', 'Church Growth'),
('66b3fdf172b3c70e4752e23d2344d7b58ab6436d', 'T120', 'Theism'),
('6cc7ea66639720c0ab09391777b256a409908235', 'B434', 'Greek EX. II'),
('7179747e9de1dfa6881c3ffa912941e667b6c368', 'M211', 'Homiletics I'),
('738e3c626b0b6119560d6d63b29eb6564d126bd9', 'T141', 'Ecclesiology'),
('7a294f4bc99d18fea623912228593af9ee8adf3a', 'B241', 'NT Seminar II . (Past. Epistel)'),
('874fe4c92d19a8a973c39cf63fde0406b2fceeeb', 'T140', 'Pneumatology'),
('8d370fc7d4a3e7771e7c4f8e79b6e7f5119bc852', 'T 54', 'Cults'),
('99365a4219f7477ca3eddf16c3b6e8984efc5a19', 'B220', 'Covenat II'),
('9a7871ea15a5352454e5bb10a195af28bfca5d9c', 'T30', 'Contemporary Theo'),
('9efda4a9d9e8e05da76afbea15d210832592f2d4', 'M341', 'Intro. To Counsel'),
('a017eb954df050e5df5be420cdc8da11eeabc569', 'B310 ', 'Hermenu'),
('a16eade17827c0a4dfa37bdea1ef4993a93c859a', 'B122', 'Isaiah'),
('a1cab0377d6b8d882576132799414777750f5009', 'T330', 'Contextualization'),
('a415a58fc05086d199158274379fe0ebc13fcbdf', 'B240 ', 'NT Seminar II'),
('a8d708dce5f32630bdcc14e0a773323d7a3a751d', 'C441', 'Missions'),
('ad1cbe8c3497c95cb3775bfd4569d003ef9aa314', 'M331', 'Pastoral II'),
('b0b6844e9331e8f2f896401313904844c50e70af', 'B413', 'Greek I'),
('b55fd991e40d0f547fe9d6bb5d0fd45bde2b74eb', 'C120', 'World Ch. Hist I'),
('b8ff72bee1b271d377b2591c1413947ae83de6af', 'M340', 'Pastoral III'),
('baa4350893977190922ddd63ef9e1b0629507973', 'M343', 'Admi. Management'),
('bc07bffd14d85bd6717a4d3da8e646edc91498f6', 'M22', 'Applied Homiletics'),
('c04a3911481cc28633092b046ffef94df1347dd9', 'T410', 'Christian Living'),
('c38c2f829bf7e90df5fad646d32379db9e2eb528', 'M310.P', 'Evangelism'),
('c4e6a4b90f2a1fc26a905b8b1c6668f49a567b60', 'T 121', 'Man & Sin'),
('ca515242f6eba7de56e105f435d848475b318211', 'B230 ', 'Romans'),
('d321a7bcae433609251e26be1bdfcd6fe819ae52', 'M322', 'Homiletic III Elective'),
('d5ee58235a74be75d2ef0f9cbb2f48d', 'UC', 'Computer Studies'),
('d6a47a91ef71dc90a23bfb1b540fa5523c2ad794', 'B414', 'Greek II'),
('ddfbe0b173594731c9dd643a2af293df616570cc', 'B211', 'Gospel II'),
('e1d23f800b3ebac0bfb5406bcac78d53c8b34611', 'T540', 'Major World Religion'),
('e39f68230565383bcaabf034fd66c25d9a343e03', 'B121', 'Genesis'),
('e3ef9a0d15fa9c0f2ffc134f12c8e177051ca2b6', 'T122', 'Bibliology'),
('e72ba96b6086b94d99ca6b93981d7a50835051f3', 'B432', 'Gree Gram IV'),
('e9334e9aacfc45a325df9a1d0d88890aca8da93d', 'B113', 'Covenat I '),
('ead0ba6137f5e8b370b93665405d51e66f7e638e', 'M440', 'Book Keeping'),
('f26742ffc8b516401d998f7076fd4ccb7d326d5b', 'B410', 'English Comp'),
('f48d2a76c0d7e978089c117ca05f455453b65878', 'M112', 'C. E In The Church Elective'),
('f651c42a90a3e22a73098e1fda0f22f27172b855', 'B111', 'History Books'),
('fe0f2a3de4e1932809d2e1e7ef0bb242bda485e2', 'T130', 'Christology'),
('ff3a53974d538249c6da4f42b323b87b349a8582', 'B231', 'NT Sem . (Pri. Epistel)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ubc_Academic_Calendar`
--
ALTER TABLE `Ubc_Academic_Calendar`
  ADD PRIMARY KEY (`academic_calendar_id`);

--
-- Indexes for table `Ubc_Billings`
--
ALTER TABLE `Ubc_Billings`
  ADD PRIMARY KEY (`billing_id`);

--
-- Indexes for table `Ubc_Exam_Timetable`
--
ALTER TABLE `Ubc_Exam_Timetable`
  ADD PRIMARY KEY (`exam_tt_id`),
  ADD KEY `Allocated_Unit_Time` (`exam_tt_unit_id`);

--
-- Indexes for table `Ubc_Fee_Payment`
--
ALTER TABLE `Ubc_Fee_Payment`
  ADD PRIMARY KEY (`fee_payment_id`),
  ADD KEY `Student_ID` (`fee_payment_student_id`);

--
-- Indexes for table `Ubc_Notices`
--
ALTER TABLE `Ubc_Notices`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `Notice_Posted_By` (`notice_posted_by_id`);

--
-- Indexes for table `Ubc_Staff`
--
ALTER TABLE `Ubc_Staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `Ubc_Student`
--
ALTER TABLE `Ubc_Student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `Ubc_Student_Marks`
--
ALTER TABLE `Ubc_Student_Marks`
  ADD PRIMARY KEY (`marks_id`),
  ADD KEY `AllocationID` (`marks_allocation_id`),
  ADD KEY `StudentID` (`marks_student_id`);

--
-- Indexes for table `Ubc_Teaching_Allocations`
--
ALTER TABLE `Ubc_Teaching_Allocations`
  ADD PRIMARY KEY (`teaching_allocation_id`),
  ADD KEY `Academic_Calendar` (`teaching_allocation_academic_calendar_id`),
  ADD KEY `Staff_id` (`teaching_allocation_staff_id`),
  ADD KEY `Unit_Id` (`teaching_allocation_unit_id`);

--
-- Indexes for table `Ubc_Timetable`
--
ALTER TABLE `Ubc_Timetable`
  ADD PRIMARY KEY (`timetable_id`),
  ADD KEY `Allocation_ID` (`timetable_allocation_id`);

--
-- Indexes for table `Ubc_Units`
--
ALTER TABLE `Ubc_Units`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ubc_Billings`
--
ALTER TABLE `Ubc_Billings`
  MODIFY `billing_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Ubc_Exam_Timetable`
--
ALTER TABLE `Ubc_Exam_Timetable`
  ADD CONSTRAINT `Allocated_Unit_Time` FOREIGN KEY (`exam_tt_unit_id`) REFERENCES `Ubc_Teaching_Allocations` (`teaching_allocation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ubc_Notices`
--
ALTER TABLE `Ubc_Notices`
  ADD CONSTRAINT `Notice_Posted_By` FOREIGN KEY (`notice_posted_by_id`) REFERENCES `Ubc_Staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ubc_Student_Marks`
--
ALTER TABLE `Ubc_Student_Marks`
  ADD CONSTRAINT `AllocationID` FOREIGN KEY (`marks_allocation_id`) REFERENCES `Ubc_Teaching_Allocations` (`teaching_allocation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `StudentID` FOREIGN KEY (`marks_student_id`) REFERENCES `Ubc_Student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ubc_Teaching_Allocations`
--
ALTER TABLE `Ubc_Teaching_Allocations`
  ADD CONSTRAINT `Academic_Calendar` FOREIGN KEY (`teaching_allocation_academic_calendar_id`) REFERENCES `Ubc_Academic_Calendar` (`academic_calendar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Staff_id` FOREIGN KEY (`teaching_allocation_staff_id`) REFERENCES `Ubc_Staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Unit_Id` FOREIGN KEY (`teaching_allocation_unit_id`) REFERENCES `Ubc_Units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ubc_Timetable`
--
ALTER TABLE `Ubc_Timetable`
  ADD CONSTRAINT `Allocation_ID` FOREIGN KEY (`timetable_allocation_id`) REFERENCES `Ubc_Teaching_Allocations` (`teaching_allocation_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
