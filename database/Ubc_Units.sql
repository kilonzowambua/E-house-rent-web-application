-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2021 at 10:23 AM
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
-- Table structure for table `Ubc_Units`
--

CREATE TABLE `Ubc_Units` (
  `unit_id` varchar(200) NOT NULL,
  `unit_code` varchar(200) DEFAULT NULL,
  `unit_name` varchar(200) DEFAULT NULL,
  `unit_credit_hours` varchar(200) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ubc_Units`
--

INSERT INTO `Ubc_Units` (`unit_id`, `unit_code`, `unit_name`, `unit_credit_hours`) VALUES
('038cd8a09695efc3ff115022fb932b7dfd2ef33f', 'B221', 'Act Rev.', '3'),
('038cd8a09695efc3ff11502tfhsdyukasdlweui', 'B1222', 'Spirit Format', '3'),
('050cbeec56ddb112b1c6e32956cf23f237b8dc27', 'M342', 'Counseling II', '3'),
('0cb51520f725516f308e1cc39044785559f78762', 'B540', 'Bible Critic', '3'),
('1749a3c13d95f67181d9107948172fee8c02ceb2', 'M113', 'Hom. II', '3'),
('20902266625de5cbef306278a81d0e930ff7d0f4', 'B311', 'Appl. Hermenu', '3'),
('33747c1b523c9b3f5ddc8f61df3b9cb85d5f8c66', 'B210', 'Gospel I', '3'),
('34a7ca998527c626a3f106854d5d7cb4e74387e1', 'B420', 'Greek III', '3'),
('35f10ccfea68ae617c44e90482d9fb88a2f3ee76', 'B120', 'Prophets', '3'),
('3647b7c77490222d1986207c41f66306150a0978', 'C221', 'Africa Ch. History II', '3'),
('3811a45b9e1e38460aeb3227492dec0cf848da12', 'B510', 'Bib. Introd.', '3'),
('3984571c06ac9235bfc19ae17e06c5b90d1d53b8', 'T530', 'African Trad. Religion', '3'),
('3d3664c0accfe7e4dc6e00edd4a253cdc6b479fc', 'C130', 'World Ch. History II', '3'),
('3e302a95bf7ecf65b4bc89b2f5dd346d24456b4f', 'T420', 'Biblical Ethics', '3'),
('3f714a39283777378389601ba8a53d2e3f6dde61', 'B11 ', 'Pentateuch', '3'),
('4077a8625d356d35752fd1ef7e889cb085302a947a', 'B1222', 'Intro C EDU', '3'),
('425296041ea6bfd3dbae8a3fffe2436378372333', 'M413', 'Christian Home', '3'),
('4585fd36d6b6378c59218fe0913433193a8dd9da', 'B412', 'Research Writing', '3'),
('482cec5f9823fbc46cdbdbd2d3e0f9acf560f07f', 'B112', 'Psalms', '3'),
('4b0029f83e095157a50a2784539a5907f8059ebb', 'T131', 'Soteriology', '3'),
('4bc904ec5e90e586043910a11a94170b1b10508d', 'M210', 'Public Speaking', '3'),
('4c6abb7f375dff51dbc8601b1aa9f1737925af9a', 'T142', 'Eschatology', '3'),
('537f408d6faf5d25c3023fae39a5492dc9e52b5f', 'B435', 'Greek EX. III', '3'),
('59d459439db47fbee4adc568f313fa4dddbf0c7b', 'M120', 'Prin. Of Teach I', '3'),
('5a23852ea16648cff357cf7994acde5217db7f4c', 'M122', 'Prin. Of Teach II', '3'),
('5dbd21e3bd1e1a30c694d4ebb1884288565af297', 'M330', 'Pastoral', '3'),
('5e4f051ce5a19f910dd1817e09f1bd320cf69b37', 'T423', 'Apologetics', '3'),
('5e58f9cb171a7fc0f4b8c19c8f27c5ee97cca919', 'M120', 'Children & Youth', '3'),
('5e69c2cbfaf960157fc7744ac7e134a62e3f9884', 'B433', 'GK EXE. I', '3'),
('6118cf11ac2de72e1b4654cb1e51d54bc592fac5', 'B411', 'Study Skills', '3'),
('63f46002c9e8aefa00792ddc51f55aa3ac1ed6ef', 'C220', 'Af. Ch. History 1', '3'),
('666f0c185c499a8e3c9a719b10ac9fbac3964739', 'C213', 'Church Growth', '3'),
('66b3fdf172b3c70e4752e23d2344d7b58ab6436d', 'T120', 'Theism', '3'),
('6cc7ea66639720c0ab09391777b256a409908235', 'B434', 'Greek EX. II', '3'),
('7179747e9de1dfa6881c3ffa912941e667b6c368', 'M211', 'Homiletics I', '3'),
('738e3c626b0b6119560d6d63b29eb6564d126bd9', 'T141', 'Ecclesiology', '3'),
('7a294f4bc99d18fea623912228593af9ee8adf3a', 'B241', 'NT Seminar II . (Past. Epistel)', '3'),
('874fe4c92d19a8a973c39cf63fde0406b2fceeeb', 'T140', 'Pneumatology', '3'),
('8d370fc7d4a3e7771e7c4f8e79b6e7f5119bc852', 'T 54', 'Cults', '3'),
('99365a4219f7477ca3eddf16c3b6e8984efc5a19', 'B220', 'Covenat II', '3'),
('9a7871ea15a5352454e5bb10a195af28bfca5d9c', 'T30', 'Contemporary Theo', '3'),
('9efda4a9d9e8e05da76afbea15d210832592f2d4', 'M341', 'Intro. To Counsel', '3'),
('a017eb954df050e5df5be420cdc8da11eeabc569', 'B310 ', 'Hermenu', '3'),
('a16eade17827c0a4dfa37bdea1ef4993a93c859a', 'B122', 'Isaiah', '3'),
('a1cab0377d6b8d882576132799414777750f5009', 'T330', 'Contextualization', '3'),
('a415a58fc05086d199158274379fe0ebc13fcbdf', 'B240 ', 'NT Seminar II', '3'),
('a8d708dce5f32630bdcc14e0a773323d7a3a751d', 'C441', 'Missions', '3'),
('ad1cbe8c3497c95cb3775bfd4569d003ef9aa314', 'M331', 'Pastoral II', '3'),
('b0b6844e9331e8f2f896401313904844c50e70af', 'B413', 'Greek I', '3'),
('b55fd991e40d0f547fe9d6bb5d0fd45bde2b74eb', 'C120', 'World Ch. Hist I', '3'),
('b8ff72bee1b271d377b2591c1413947ae83de6af', 'M340', 'Pastoral III', '3'),
('baa4350893977190922ddd63ef9e1b0629507973', 'M343', 'Admi. Management', '3'),
('bc07bffd14d85bd6717a4d3da8e646edc91498f6', 'M22', 'Applied Homiletics', '3'),
('c04a3911481cc28633092b046ffef94df1347dd9', 'T410', 'Christian Living', '3'),
('c38c2f829bf7e90df5fad646d32379db9e2eb528', 'M310.P', 'Evangelism', '3'),
('c4e6a4b90f2a1fc26a905b8b1c6668f49a567b60', 'T 121', 'Man & Sin', '3'),
('ca515242f6eba7de56e105f435d848475b318211', 'B230 ', 'Romans', '3'),
('d321a7bcae433609251e26be1bdfcd6fe819ae52', 'M322', 'Homiletic III Elective', '3'),
('d5ee58235a74be75d2ef0f9cbb2f48d', 'UC', 'Computer Studies', '3'),
('d6a47a91ef71dc90a23bfb1b540fa5523c2ad794', 'B414', 'Greek II', '3'),
('ddfbe0b173594731c9dd643a2af293df616570cc', 'B211', 'Gospel II', '3'),
('e1d23f800b3ebac0bfb5406bcac78d53c8b34611', 'T540', 'Major World Religion', '3'),
('e39f68230565383bcaabf034fd66c25d9a343e03', 'B121', 'Genesis', '3'),
('e3ef9a0d15fa9c0f2ffc134f12c8e177051ca2b6', 'T122', 'Bibliology', '3'),
('e72ba96b6086b94d99ca6b93981d7a50835051f3', 'B432', 'Gree Gram IV', '3'),
('e9334e9aacfc45a325df9a1d0d88890aca8da93d', 'B113', 'Covenat I ', '3'),
('ead0ba6137f5e8b370b93665405d51e66f7e638e', 'M440', 'Book Keeping', '3'),
('f26742ffc8b516401d998f7076fd4ccb7d326d5b', 'B410', 'English Comp', '3'),
('f48d2a76c0d7e978089c117ca05f455453b65878', 'M112', 'C. E In The Church Elective', '3'),
('f651c42a90a3e22a73098e1fda0f22f27172b855', 'B111', 'History Books', '3'),
('fe0f2a3de4e1932809d2e1e7ef0bb242bda485e2', 'T130', 'Christology', '3'),
('ff3a53974d538249c6da4f42b323b87b349a8582', 'B231', 'NT Sem . (Pri. Epistel)', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ubc_Units`
--
ALTER TABLE `Ubc_Units`
  ADD PRIMARY KEY (`unit_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
