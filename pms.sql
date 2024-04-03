-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 07:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `org_address` varchar(255) NOT NULL,
  `tel_phone` int(11) DEFAULT NULL,
  `org_email` varchar(255) DEFAULT NULL,
  `phone_no` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `organization`, `org_address`, `tel_phone`, `org_email`, `phone_no`, `username`, `password`, `reg_date`) VALUES
(1, 'Amit Mahato', 'D.A.V. College', 'Dhobighat', 2147483647, 'dav@gmail.com', 2147483647, 'Admin', '$2y$10$W8GVOxU3IwryXV7DBGnUPuTq8KGAMtrRQ4qndPZxweXyLZc5m0f1m', '2024-03-12 16:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_member`
--

CREATE TABLE `assigned_member` (
  `Id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `project_id` int(11) DEFAULT 0,
  `foreman_id` int(11) DEFAULT 0,
  `main_task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assigned_member`
--

INSERT INTO `assigned_member` (`Id`, `user_id`, `project_id`, `foreman_id`, `main_task_id`) VALUES
(51, 0, 6, 29, 0),
(58, 31, 9, 0, 0),
(59, 34, 9, 0, 0),
(61, 0, 9, 35, 0),
(63, 39, 10, 0, 0),
(64, 34, 10, 0, 0),
(66, 39, 11, 0, 0),
(67, 0, 11, 38, 0),
(70, 32, 6, 0, 0),
(71, 0, 18, 42, 0),
(72, 39, 18, 0, 0),
(73, 39, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dpt_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dpt_id`, `department_name`, `created_date`) VALUES
(38, 'BCA Department ( Foreman )', '2024-03-21 09:30:12'),
(39, 'BCA ( 3rd Semester )', '2024-03-21 09:29:49'),
(40, 'BCA ( 4th Semester )', '2024-03-21 09:30:01'),
(41, 'IGNOU', '2024-03-21 18:11:10'),
(42, 'IT', '2024-03-22 15:15:44'),
(43, 'BIT', '2024-03-29 00:52:03'),
(46, 'BBA', '2024-03-31 10:43:54'),
(47, 'BSC DAV', '2024-04-03 01:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `main_task`
--

CREATE TABLE `main_task` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_task`
--

INSERT INTO `main_task` (`Id`, `name`, `project_id`, `user_id`, `deadline`, `created_date`) VALUES
(10, 'event management system', 6, 33, '2024-05-31 11:49:00', '2024-03-31 17:52:58'),
(12, 'Project Management System', 6, 31, '2024-05-30 21:59:00', '2024-03-31 17:52:58'),
(13, 'Designing', 9, 31, '2024-04-30 22:10:00', '2024-03-31 17:52:58'),
(14, 'Coding', 9, 34, '2024-04-30 22:12:00', '2024-03-31 17:52:58'),
(16, 'Planning', 10, 39, '2024-03-31 21:07:00', '2024-03-31 17:52:58'),
(17, 'Design', 10, 34, '2024-04-10 21:08:00', '2024-03-31 17:52:58'),
(19, 'coding part 2', 9, 31, '2024-03-31 22:44:00', '2024-03-31 17:52:58'),
(20, 'ovs', 6, 31, '2024-04-29 16:40:00', '2024-03-31 17:52:58'),
(28, 'ovs', 9, 31, '2024-04-29 16:58:00', '2024-03-31 17:52:58'),
(29, 'cmd', 6, 31, '2024-03-31 23:28:00', '2024-03-31 17:52:58'),
(30, 'routine microcopic check', 18, 39, '2024-05-22 07:43:00', '2024-04-03 01:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `file_type` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `cost` int(11) NOT NULL,
  `project_details` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deadline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `file_type`, `file`, `cost`, `project_details`, `created_date`, `deadline`) VALUES
(6, 'Project I', 2, '../project/file/Project I Details for BCA 4th sem.pdf', 0, 'this is the sample as a reference which is provided to you like format whose in which way to make a project and submit  for the BCA fourth semester students, project I details, hope this is most helpful for you bca fourth semester students.', '2024-03-12 17:55:48', '2024-05-31 23:28:00'),
(9, 'IT Club Management', 1, '../project/file/OIP.jpg', 0, 'within two weeks all work must be done.', '2024-03-21 04:54:13', '2024-03-31 10:38:00'),
(10, 'Infomation Technology Website', 2, '../project/file/5.JournalofInformationTechnologyandSciencesJITSMAT.pdf', 80000, 'Website is the best way for publishing information and branding an organization. So, I have designed the web site on Islamic University, Bangladesh to spread the name and frame of the same globally. For designing the website, I have used HTML and CSS for web designing, PHP and MySQL have been used for developing of this site. In addition, I have taken help from many online web designing and developing tools. In this site information about the CSE department has been given. There is a short portrayal in this website about the university itself, the administrative setup, the department of the university and their faculties academic information and simple database for retrieving result of the students. The site has been made in such a way so that anyone can get a throughout postulation about the said organization. In future the implementation of this project will be for all universities of Bangladesh and will be converted to WEB site rapidly growing browsing media.', '2024-03-22 15:20:43', '2024-08-31 21:05:00'),
(16, 'project 1', 1, '../project/file/', 0, '', '2024-03-31 10:52:41', '2024-04-23 16:37:00'),
(17, 'project 1', 1, '../project/file/', 0, '', '2024-03-31 10:53:03', '2024-04-29 16:37:00'),
(18, 'BSC Project I', 1, '../project/file/', 0, '', '2024-04-03 01:56:48', '2024-04-24 07:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_task_mgmt`
--

CREATE TABLE `sub_task_mgmt` (
  `Id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `main_task_id` int(11) DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `progress_percentage` varchar(5) NOT NULL,
  `progress` int(11) DEFAULT NULL,
  `remarks` varchar(255) NOT NULL DEFAULT 'None',
  `fileupload` varchar(255) NOT NULL,
  `completed` int(11) DEFAULT NULL,
  `review` int(11) NOT NULL,
  `suspend` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `isvarified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_task_mgmt`
--

INSERT INTO `sub_task_mgmt` (`Id`, `message`, `main_task_id`, `end_date_time`, `progress_percentage`, `progress`, `remarks`, `fileupload`, `completed`, `review`, `suspend`, `project_id`, `updated_date`, `isvarified`) VALUES
(9, 'login page', 10, '2024-04-30 11:51:00', '100', 0, '', './sub_task_file/OIP.jpg', 1, 2, 0, 6, '0000-00-00 00:00:00', 2),
(10, 'app', 10, '2024-03-31 11:55:00', '', NULL, 'None', '', NULL, 0, NULL, 6, '0000-00-00 00:00:00', 0),
(14, 'Logo design', 13, '2024-04-29 22:10:00', '0', 0, '', './sub_task_file/OIP.jpg', 1, 1, 0, 9, '0000-00-00 00:00:00', 1),
(15, 'Schedule desigh ', 13, '2024-04-29 17:48:00', '15', 0, '', '', 1, 1, 0, 9, '0000-00-00 00:00:00', 1),
(16, 'Back-end dashboard page', 14, '2024-03-29 22:13:00', '15', 0, '', '', 1, 1, 0, 9, '0000-00-00 00:00:00', 1),
(17, 'front-end login and session', 14, '2024-03-23 22:14:00', '100', 0, '', '', 1, 0, 0, 9, '0000-00-00 00:00:00', 0),
(18, 'Requirement Collection ', 16, '2024-03-31 21:09:00', '75', 1, 'None', '', 0, 1, 0, 10, '0000-00-00 00:00:00', 1),
(19, 'Existing systems', 16, '2024-03-31 21:10:00', '0', 1, 'None', '', 0, 0, 0, 10, '0000-00-00 00:00:00', 0),
(20, 'dashboard', 10, '2024-03-31 07:09:00', '', NULL, 'None', '', NULL, 0, NULL, 6, '0000-00-00 00:00:00', 0),
(21, 'lg', 29, '2024-04-30 23:26:00', '', NULL, 'None', '', NULL, 0, NULL, 6, '0000-00-00 00:00:00', 0),
(22, 'jjj', 10, '2024-04-19 09:18:00', '50', 1, '', '', 0, 1, 0, 6, '0000-00-00 00:00:00', 1),
(23, 'h', 30, '2024-04-12 07:45:00', '', NULL, 'None', '', NULL, 1, NULL, 18, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `address`, `username`, `password`, `department_id`, `role`, `created_date`) VALUES
(29, 'Sudip Adhikari', 'Sudip@gmail.com', 2147483647, 'Lagankhel', 'davsudip', '$2y$10$4GbI9.FR7OmRU5.V44zwh.XebqJ1/Fr.3I/SdmnwgB9K9.AxpuDUK', 38, 'foreman', '2024-03-21 04:33:38'),
(30, 'Ananta Adhikari', 'ananta@gmail.com', 2147483647, 'Imadole', 'davananta', '$2y$10$dEBYJDqrnK3870I75TvFaev9LYrcTuLYWA1yM3Oa71XqlB87xToe.', 38, 'foreman', '2024-03-21 03:09:34'),
(31, 'Amit Mahato', 'amit@gmail.com', 2147483647, 'dhobighat', 'davamit', '$2y$10$jDg.3xBhFzu9Ewp3GePESutar7TMSbC8PiIJ4Kfz9huM1cGO2lnYy', 40, 'user', '2024-03-21 03:46:57'),
(32, 'Rabindra sah', 'rabi@gmail.com', 2147483647, 'Pulchowk', 'davrabi', '$2y$10$Gx0dcWQEIPRsJeuWJ6rjCO8COlj.FgtWNG6OUxShLUgsdd/eiYuNW', 40, 'user', '2024-03-21 04:55:03'),
(33, 'Jyoti Yadav', 'jyoti@gmail.com', 2147483647, 'kupondole', 'davjyoti', '$2y$10$8xb47M.P0hG77KVoChT/ZO0LYA.aVYcN/tDJ2YHXZyvMTnB2Jzp9a', 40, 'user', '2024-03-21 03:48:38'),
(34, 'Prithvi Ghatani', 'prithvi@gmail.com', 2147483647, 'Ekantakuna', 'davprithvi', '$2y$10$tZCwQ2bl/zqYEzlCVxtPcOaKpW4Yjo3253L52gK0gqd/LvA6fO.Te', 40, 'user', '2024-03-21 03:50:25'),
(35, 'Anish Dangol', 'anish@gmail.com', 2147483647, 'Tripureshwor', 'davanish', '$2y$10$bjL/rBK.4T.w6j.UdM6RW.rVq8vhqFJTsNgnHdsjjKP34yHgMyn96', 40, 'foreman', '2024-03-21 04:35:05'),
(36, 'Anish Dangol', 'anish@gmail.com', 2147483647, 'Tripureshwor', 'davanishh', '$2y$10$8VujTV5Py6PX/PERlwvPLOQv9h1/5L.3ivSni.62420K7kEDeFOFe', 40, 'user', '2024-03-21 09:26:31'),
(37, 'ram', 'ram@gmail.com', 2147483647, 'dhobighat', 'ignouram', '$2y$10$x4NTl07LFfDf43ReyWtuQ.or6LmX4VM7uHwa1I3hEYo8yo/reYBxu', 41, 'foreman', '2024-03-21 18:12:06'),
(38, 'Foremanone', 'foremanone@gmail.com', 2147483647, 'lalitpur', 'Foremanone', '$2y$10$.T5b3aftKUhYNvZsIwSjx.RMajBWm04wADTgJhkilsJCD.Jpboyk2', 42, 'foreman', '2024-03-22 15:16:43'),
(39, 'Userone', 'userone@gmail.com', 2147483647, 'kathmandu', 'Userone', '$2y$10$FIDBvvx3Oo5BmYFulelGxO4PfRH1HbnBRfTkB7w7zz8C726plNAEK', 42, 'user', '2024-03-22 15:17:40'),
(41, 'md', 'm@gmail.com', 0, '', 'davmd', '$2y$10$r.R.J/.CUgXQ02m4a6JdDeijymcNqaszFhpe1rMNsCEss9YhYId7q', 43, 'user', '2024-03-31 10:46:12'),
(42, 'BSC', 'BSC@gmail.com', 0, '', 'BSC Teachers', '$2y$10$wZ7Xm1gDF596z4spKCBKae0.b4zQa3i2Bf7RrhG/JsM.4KkQvgB/a', 47, 'foreman', '2024-04-03 01:55:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`org_email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `assigned_member`
--
ALTER TABLE `assigned_member`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `foreman_id` (`foreman_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dpt_id`);

--
-- Indexes for table `main_task`
--
ALTER TABLE `main_task`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `p_id` (`project_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_task_mgmt`
--
ALTER TABLE `sub_task_mgmt`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk` (`main_task_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `users_ibfk_1` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assigned_member`
--
ALTER TABLE `assigned_member`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `main_task`
--
ALTER TABLE `main_task`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sub_task_mgmt`
--
ALTER TABLE `sub_task_mgmt`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `main_task`
--
ALTER TABLE `main_task`
  ADD CONSTRAINT `p_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_task_mgmt`
--
ALTER TABLE `sub_task_mgmt`
  ADD CONSTRAINT `fk` FOREIGN KEY (`main_task_id`) REFERENCES `main_task` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`dpt_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
