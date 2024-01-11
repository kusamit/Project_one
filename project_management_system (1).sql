-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 07:05 PM
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
-- Database: `project_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_registration`
--

CREATE TABLE `admin_registration` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_registration`
--

INSERT INTO `admin_registration` (`id`, `full_name`, `address`, `phone`, `email`, `username`, `password`, `reg_date`) VALUES
(1, 'amit', '', 0, 'a@gmail.com', 'amit', '$2y$10$NVDDkscgEtu0/1.MWFlsQuH3e2opy/Dkf732x7RSi2J5Q8tQ9VbEG', '2023-12-14 09:02:49'),
(2, '', '', 0, 'aa@gmail.com', 'a', '$2y$10$3yOKxP2E4kEWwjqZggIMgOu3RBSrVTRrdyGgga9FQGyOIWG54JdGC', '2023-12-14 09:37:22'),
(3, '', '', 0, 'aaa@gmail.com', 'b', '$2y$10$EC4zkQXnkHLHxP87V9mpNuOAL9czfDrHEka3gQHgUkJQ31JCPUGIS', '2023-12-14 09:37:30'),
(4, 'k', 'k', 987539898, 'k@gmail.com', 'k', '$2y$10$durAw/Yt.x4W2r0w.MUmouK23T0adSr9tfD.c3nVMQvCgtLx2hG.q', '2024-01-02 01:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_member`
--

CREATE TABLE `assigned_member` (
  `Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `isAssigned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assigned_member`
--

INSERT INTO `assigned_member` (`Id`, `user_id`, `project_id`, `manager_id`, `isAssigned`) VALUES
(16, 19, 13, 0, 0),
(17, 18, 11, 0, 0),
(18, 17, 10, 0, 0),
(19, 20, 16, 0, 0),
(20, 4545, 14, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dpt_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `log_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dpt_id`, `department_name`, `log_id`, `created_date`) VALUES
(9, 'simba', 0, '2023-12-14 10:46:41'),
(10, 'aa', 2, '2023-12-14 10:53:25'),
(11, 'rr', 2, '2023-12-14 10:55:56'),
(12, 'ff', 2, '2023-12-14 10:57:14'),
(13, 'gg', 2, '2023-12-14 10:58:41'),
(14, 'kj', 3, '2023-12-14 11:15:04'),
(15, 'official', 4, '2024-01-02 01:11:07'),
(16, 'diyadept', 2, '2024-01-06 02:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `assigned_id` int(11) DEFAULT NULL,
  `log_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `fullname`, `email`, `phone`, `address`, `username`, `password`, `project_id`, `assigned_id`, `log_id`, `created_date`) VALUES
(5, 'manager1', 'n@gmail.com', 0, '', 'manager1', '$2y$10$6Rf2B07yVC4T8qVjju', NULL, NULL, 2, '2024-01-04 14:29:42'),
(6, 'manager2', 'nn@gmail.com', 0, '', 'manager2', '$2y$10$.t3H7ly0g3LfegajCX', NULL, NULL, 2, '2024-01-04 14:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `log_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `file`, `message`, `log_id`, `created_date`) VALUES
(2, 'yube', NULL, NULL, 0, '2024-01-04 05:16:12'),
(5, 'Diya Project', NULL, NULL, 0, '2024-01-06 02:25:41'),
(6, 'prithvo kp project', NULL, NULL, 0, '2024-01-06 03:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `sub_task_mgmt`
--

CREATE TABLE `sub_task_mgmt` (
  `Id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `completed` int(11) DEFAULT NULL,
  `review` int(11) NOT NULL,
  `suspend` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_task_mgmt`
--

INSERT INTO `sub_task_mgmt` (`Id`, `message`, `cat_id`, `end_date_time`, `progress`, `completed`, `review`, `suspend`) VALUES
(65, 'worktomorrow', 35, '2024-01-20 21:09:00', 0, 0, 1, 0),
(66, 'worktomorrow', 35, '2024-01-19 21:09:00', 0, 0, 1, 0),
(67, 'worktomorrow', 35, '2024-01-19 21:09:00', 0, 0, 0, 1),
(68, 'worktomorrow', 35, '2024-01-19 21:09:00', 0, 1, 1, 0),
(69, 'eded', 35, '2024-01-19 23:06:00', 0, 1, 1, 0),
(70, 'eded', 35, '2024-01-19 23:06:00', 0, 1, 1, 0),
(71, 'eded', 35, '2024-01-19 23:06:00', 0, 1, 1, 0),
(72, 'hhhhh', 35, '2024-01-09 11:52:00', 1, 0, 0, 0),
(73, 'hhhhh', 35, '2024-01-09 11:52:00', 1, 0, 0, 0),
(75, 'work today', 35, '2024-01-11 11:59:00', 1, 0, 0, 0),
(76, 'work today', 35, '2024-01-11 11:59:00', 0, 0, 0, 1),
(78, 'work today', 35, '2024-01-11 11:59:00', 0, 0, 0, 1),
(81, 'qqewqwe', 35, '2024-01-18 20:01:00', 0, 1, 1, 0),
(82, 'qqewqwe', 35, '2024-01-18 20:01:00', 0, 0, 0, 1),
(83, 'qqewqwe', 35, '2024-01-18 20:01:00', 0, 1, 1, 0),
(88, 'ram', 35, '2024-01-12 23:04:00', NULL, NULL, 0, NULL),
(89, 'kajsfglcsjgfldjf sfmsdlkjgldskfdmlecjgf eslgjmdldjcgflrdsjf sdgkfjldjcgoidjtrldjf sdsjfjiuegjourhjmeglfjexr,fgjf ergjfmoeirjgtofirgtclfj,eodgij erotfoerrgtfoeriigtfoerig, sugiomergtifmpe', 35, '2024-01-20 23:18:00', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `todo_c`
--

CREATE TABLE `todo_c` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todo_c`
--

INSERT INTO `todo_c` (`Id`, `name`) VALUES
(35, 'aa'),
(37, 'p1'),
(32, 'project 1'),
(33, 'project2'),
(36, 'q'),
(34, 'sw'),
(30, 'today'),
(31, 'tomorrow');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `log_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone`, `address`, `username`, `password`, `department_id`, `log_id`, `created_date`) VALUES
(9, 'test', 'yy@gmail.com', 12345678, 'ss', 's', 's', NULL, 0, '2024-01-08 05:48:48'),
(17, 'user1', 'a@gmail.com', 0, '', 'user1', '$2y$10$adi4hy8sj2.JY74QVD', 10, 2, '2024-01-04 14:28:47'),
(18, 'user2', 'ab@gmail.com', 0, '', 'user2', '$2y$10$P/h0f30OJrUTASeldb', 11, 2, '2024-01-04 14:29:13'),
(19, 'user3', 'au@gamil.com', 0, '', 'user3', '$2y$10$hU7l2RjhyjUXwmClsx', 13, 2, '2024-01-04 14:55:17'),
(20, 'diya', 'diya@gmail.com', 0, '', 'd', '$2y$10$tWG0L5.IW7BmHTY7Am', 16, 2, '2024-01-06 02:25:21'),
(21, 'test', 'sc', NULL, '', NULL, NULL, NULL, 0, '2024-01-08 05:45:30'),
(4545, 'test', 'yysdff@gmail.com', 12345678, 'sdcs', 'sscd', '2', 14, 2, '2024-01-08 05:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_room`
--

CREATE TABLE `user_room` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` int(13) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_room`
--

INSERT INTO `user_room` (`id`, `name`, `username`, `password`, `email`, `gender`, `contact`, `Address`) VALUES
(1, 'amit', 'admin', '1', 'a@gmail.com', 'Male', 1234567890, 'dhobighat'),
(7, 'hari', 'a', 'a', 'ram123@gmail.com', 'Male', 2147483647, 'dhobighat'),
(11, 'Ram', 'Ram', '1', 'ram1234@gmail.com', 'Male', 987654321, 'Lalitpur'),
(12, 'Ramu', 'Ramu', '123', 'Ramu1@gmail.com', 'Male', 2147483647, 'Dhobighat'),
(13, 'shyam', 'shyam gi', 's', 'sym@gamil.com', 'Male', 2147483647, 'Nakkhu'),
(14, 'amit1', 'amit1', '1', 'ab@gmail.com', 'Male', 2147483647, 'dhobighat'),
(15, 'raj', 'raj', '1', 'raj@gmail.com', 'Male', 123, 'dhobighat'),
(16, 'suju', 'suju', '2', 'suju@gmail.com', 'Male', 1234567890, 'dhobighat'),
(17, 'amit', 'amit@1', '123', 'aa@gmail.com', 'Male', 123456789, 'dhobighat'),
(19, 'amit', 'aaa', '', 'aaz@gmail.com', 'Male', 3, 'dhobighat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_registration`
--
ALTER TABLE `admin_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `assigned_member`
--
ALTER TABLE `assigned_member`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dpt_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `fk` (`cat_id`);

--
-- Indexes for table `todo_c`
--
ALTER TABLE `todo_c`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `user_room`
--
ALTER TABLE `user_room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_registration`
--
ALTER TABLE `admin_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assigned_member`
--
ALTER TABLE `assigned_member`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_task_mgmt`
--
ALTER TABLE `sub_task_mgmt`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `todo_c`
--
ALTER TABLE `todo_c`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4546;

--
-- AUTO_INCREMENT for table `user_room`
--
ALTER TABLE `user_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `sub_task_mgmt`
--
ALTER TABLE `sub_task_mgmt`
  ADD CONSTRAINT `fk` FOREIGN KEY (`cat_id`) REFERENCES `todo_c` (`Id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`dpt_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
