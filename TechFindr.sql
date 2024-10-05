-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2023 at 12:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TechFindr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_detail`
--

CREATE TABLE `admin_detail` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_detail`
--

INSERT INTO `admin_detail` (`id`, `admin_name`, `admin_password`) VALUES
(1, 'admin', '$2y$10$6d3BB2zEDouiltkXTqrUU.G75o64bow.vwTuMkyh.9BPq5OBJ2KFK');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `applicant_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `resume` varchar(1024) DEFAULT NULL,
  `cover_letter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`applicant_id`, `user_id`, `job_id`, `applicant_name`, `contact_number`, `email`, `resume`, `cover_letter`) VALUES
(15, 0, 1, 'Sushil', '9863794096', 'fadfa@gmail.com', 'partials/images/resume_648bb97f885ac5.94996762.pdf', 'aaaaaaaaaa'),
(16, 0, 11, 'bikal', '98898', 'fadfa@gmail.com', 'partials/images/resume_648bc399346b49.64292344.pdf', 'i am ready for this job'),
(17, NULL, 1, 'name', '98898', 'fadfa@gmil.com', 'partials/images/resume_648fabdf8e3c06.59438402.docx', 'hello'),
(18, NULL, 1, 'name', '9863794096', 'fadfa@gmail.com', 'partials/images/resume_648fac032e77a9.18400341.docx', 'asdfghj'),
(19, NULL, 1, 'Gaurav Kandel', '987546412', 'gk@gmail.com', 'partials/images/resume_648fae9ae2f856.15822244.docx', 'kdjfhoajdh'),
(20, NULL, 15, 'Sushil', '9863794096', 'admin@admin.com', 'partials/images/resume_64a38161caacd2.29816791.docx', 'i am fit for the job');

-- --------------------------------------------------------

--
-- Table structure for table `company_detail`
--

CREATE TABLE `company_detail` (
  `comapny_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo` varbinary(1000) DEFAULT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_detail`
--

INSERT INTO `company_detail` (`comapny_id`, `company_name`, `logo`, `contact_number`, `email`) VALUES
(1, 'Facebook', '', '9876543210', 'facebook@gmail.com'),
(2, 'Instagram', '', '9865324578', 'insta@gram.com'),
(3, 'ARPA', '', '', ''),
(4, 'Nepal Adarsha', '', '9876543210', 'mailnass@gmail.com'),
(5, 'SpaceX', '', '9865321478', 'Space.X@gmail.com'),
(6, 'darshan Tape', NULL, '9865321478', 'darshantape@mail.com'),
(7, 'darshan Tape', NULL, '98898', 'fadfa@gmil.com'),
(8, 'darshan Tape', 0x7061727469616c732f696d616765732f6c6f676f5f36343865366633626137373531342e32353833363139312e706e67, '989898', 'fadfa@gmil.com'),
(9, 'sungava', 0x7061727469616c732f696d616765732f73756e676176612e706e67, '9854654', 'fadfa@gmail.com'),
(10, 'New Academy', 0x7061727469616c732f696d616765732f4e65772041636164656d792e6a7067, '989898', 'fadfa@gmil.com'),
(11, 'taja', 0x7061727469616c732f696d616765732f74616a612e706e67, '9863794096', 'sushil@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `job_detail`
--

CREATE TABLE `job_detail` (
  `job_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `req1` varchar(255) NOT NULL,
  `req2` varchar(255) NOT NULL,
  `req3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_detail`
--

INSERT INTO `job_detail` (`job_id`, `company_name`, `designation`, `detail`, `req1`, `req2`, `req3`) VALUES
(1, 'Tata', 'Designer', 'Hello', 'HTML', 'PHP', 'Java'),
(6, 'Nass', 'Teacher', 'hello', 'computer', 'nepali', 'maths'),
(10, 'SpaceX', 'Developer', 'We need a tester for our company', 'perl', 'java', 'python'),
(11, 'Darshan Tape', 'Manager', 'Darshan Tape Requires a manager', 'marketing', 'managing', 'accounting'),
(12, 'sungava', 'Manager', 'sdagasdg', 'car', 'maths', 'bike'),
(13, 'New Academy', 'Manager', 'adfasdf', 'fdg', 'bus', 'literate'),
(14, 'nova', 'manager', 'we are looking a manager', 'html', 'php', 'literate'),
(15, 'taja', 'manager', 'we are looking a manager', 'html', 'css', 'js');

-- --------------------------------------------------------

--
-- Table structure for table `job_offers`
--

CREATE TABLE `job_offers` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `req1` varchar(255) NOT NULL,
  `req2` varchar(255) NOT NULL,
  `req3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_offers`
--

INSERT INTO `job_offers` (`id`, `company_name`, `job_title`, `description`, `contact_number`, `email`, `req1`, `req2`, `req3`) VALUES
(16, 'taja', 'designer', 'we are looking a designer', '9863794096', 'sushil@gmail.com', 'html', 'perl', 'js');

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`user_id`, `username`, `contact_number`, `email`, `password`, `user_type`) VALUES
(5, 'suds_mac', '23986613243', 'admin@admin.com', '$2y$10$QBTeJZy3a6yicxC0663Wqu3f819xo9.VwUiSCCn1io8IS8UIh52jm', 'Seeker'),
(10, '123', '', '', '$2y$10$qwTw9VSHhgrO3qBLQp.0SOesPv8LxD2Qmx1FtvdPSj3jTGyi7k1qK', ''),
(11, 'sushil', '', '', '$2y$10$Zp3xNn5h5Mp4AvvpYGu9Y..ftQeV.NXGNnj.CFd656fHg9Hf.d2Wm', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_detail`
--
ALTER TABLE `admin_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`applicant_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `company_detail`
--
ALTER TABLE `company_detail`
  ADD PRIMARY KEY (`comapny_id`);

--
-- Indexes for table `job_detail`
--
ALTER TABLE `job_detail`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_offers`
--
ALTER TABLE `job_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetail`
--
ALTER TABLE `userdetail`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_detail`
--
ALTER TABLE `admin_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `company_detail`
--
ALTER TABLE `company_detail`
  MODIFY `comapny_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_detail`
--
ALTER TABLE `job_detail`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `job_offers`
--
ALTER TABLE `job_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `userdetail`
--
ALTER TABLE `userdetail`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_detail` (`job_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
