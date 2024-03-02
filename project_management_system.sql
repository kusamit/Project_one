-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 05:29 PM
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
(1, 'amit', '', '', 0, 'a@gmail.com', 0, 'amit', '$2y$10$NVDDkscgEtu0/1.MWFlsQuH3e2opy/Dkf732x7RSi2J5Q8tQ9VbEG', '2023-12-14 09:02:49'),
(2, '', '', '', 0, 'aa@gmail.com', 0, 'a', '$2y$10$3yOKxP2E4kEWwjqZggIMgOu3RBSrVTRrdyGgga9FQGyOIWG54JdGC', '2023-12-14 09:37:22'),
(3, '', '', '', 0, 'aaa@gmail.com', 0, 'b', '$2y$10$EC4zkQXnkHLHxP87V9mpNuOAL9czfDrHEka3gQHgUkJQ31JCPUGIS', '2023-12-14 09:37:30'),
(4, 'k', '', 'k', 987539898, 'k@gmail.com', 0, 'k', '$2y$10$durAw/Yt.x4W2r0w.MUmouK23T0adSr9tfD.c3nVMQvCgtLx2hG.q', '2024-01-02 01:07:02'),
(6, 'satwik', 'DAV', 'dhobighat', 198765443, 'dav@gmail.com', 2147483647, 'ss', '$2y$10$ouupc373MHzTPa42ULuSQuA0MJ.h4ik/Su66.2x5exkuXl9I0FQqi', '2024-01-24 03:30:29');

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
(7, 6, 3, 0, 0),
(8, 0, 3, 11, 0),
(16, 4, 3, 0, 0),
(21, 3, 2, 0, 0),
(22, 4, 2, 0, 0),
(23, 2, 5, 0, 0);

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
(34, 'BCA 1st Semester', '2024-02-29 14:04:53'),
(35, 'BCA 2nd Semester', '2024-02-29 14:07:26'),
(36, 'BCA 3rd Semester', '2024-02-29 14:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `main_task`
--

CREATE TABLE `main_task` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_task`
--

INSERT INTO `main_task` (`Id`, `name`, `project_id`, `user_id`, `deadline`) VALUES
(2, 'the project topic is temporary email regestration', 21, 6, '2024-02-22 17:13:00'),
(3, '1st task', 21, 5, '2024-02-08 19:08:00'),
(4, '2nd', 21, 5, '2024-02-23 19:08:00'),
(8, '4th', 21, 5, '2024-02-23 19:10:00'),
(9, '5th', 21, 5, '2024-02-23 19:11:00'),
(10, '6h', 21, 5, '0000-00-00 00:00:00'),
(11, '7th', 21, 5, '2024-02-23 19:12:00'),
(12, '8', 21, 5, '2024-03-01 19:12:00'),
(13, '88', 21, 5, '2024-02-24 21:46:00'),
(20, '1st topic', 18, 1, '2024-02-23 07:45:00'),
(22, '7thz', 17, 9, '2024-02-23 23:11:00'),
(23, '1st project topics', 20, 9, '2024-02-29 11:41:00'),
(24, 'academica', 16, 5, '2024-02-29 09:34:00'),
(25, 'webdesign', 35, 11, '2024-02-29 09:01:00'),
(26, 'esdrtfgyhujik', 36, 1, '2019-10-08 22:42:00'),
(27, 'Advanced computing Topic', 2, 4, '2024-03-31 20:01:00'),
(31, 'knowledge of education', 2, 0, '0000-00-00 00:00:00'),
(36, 'mm', 5, 2, '2024-03-29 20:30:00');

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
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `file_type`, `file`, `cost`, `project_details`, `created_date`) VALUES
(2, 'demo project 1', 2, '../project/file/4412-Article Text-20762-1-10-20220131 (1) (1).pdf', 0, '', '2024-02-29 14:13:30'),
(3, 'demo project 3', 1, '../project/file/Screenshot (27).png', 0, '', '2024-02-29 14:14:07'),
(4, 'demo project 1', 1, '../project/file/Untitled.png', 0, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, distinctio modi ea, odio amet fuga est alias itaque ducimus accusantium hic explicabo praesentium earum iusto nisi. Quis obcaecati cumque ad dolore odit placeat impedit, laudantium officiis inventore excepturi suscipit aliquam, earum debitis nam repellat corporis consectetur, molestias tempora quasi quaerat iste atque eveniet. Fuga ducimus voluptatem magni quos iure molestiae placeat, maxime ipsum aspernatur culpa doloremque. Possimus impedit adipisci, ab reprehenderit asperiores architecto laudantium sit nemo tenetur voluptas harum voluptatum saepe molestias molestiae non minima tempore est delectus iusto veritatis cum numquam. Laborum dolore quod, quaerat officiis voluptates aliquid mollitia.\r\n', '2024-02-29 14:29:00'),
(5, 'p', 1, '../project/file/', 0, '', '2024-03-02 14:22:30');

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
  `completed` int(11) DEFAULT NULL,
  `review` int(11) NOT NULL,
  `suspend` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_task_mgmt`
--

INSERT INTO `sub_task_mgmt` (`Id`, `message`, `main_task_id`, `end_date_time`, `progress_percentage`, `progress`, `remarks`, `completed`, `review`, `suspend`, `project_id`, `updated_date`) VALUES
(99, 'eded', 42, '2024-02-07 10:44:00', '', 0, 'd', 0, 1, 0, 20, '0000-00-00 00:00:00'),
(100, 'eded', 42, '2024-02-07 10:44:00', '', 1, 'd', 0, 0, 0, 20, '0000-00-00 00:00:00'),
(101, 'eded', 42, '2024-02-07 10:44:00', '', 1, 'd', 0, 0, 0, 20, '0000-00-00 00:00:00'),
(102, 'n', 45, '2024-02-07 12:00:00', '', 0, 'n', 0, 0, 1, 19, '0000-00-00 00:00:00'),
(103, 'ededtt', 42, '2024-02-24 15:34:00', '', NULL, 'd', NULL, 0, NULL, 20, '0000-00-00 00:00:00'),
(104, 'worktomorrow', 42, '2024-02-16 15:34:00', '', NULL, 'd', NULL, 0, NULL, 20, '0000-00-00 00:00:00'),
(105, 'a', 42, '2024-02-22 15:35:00', '', NULL, 'd', NULL, 0, NULL, 20, '0000-00-00 00:00:00'),
(106, 'shyam', 42, '2024-02-01 17:03:00', '', NULL, 'None', NULL, 0, NULL, 20, '0000-00-00 00:00:00'),
(107, 'shyam', 41, '2024-02-23 10:29:00', '', NULL, 'None', NULL, 0, NULL, 20, '0000-00-00 00:00:00'),
(108, 'work today', 47, '2024-02-13 10:42:00', '25', 1, 'ddd', 0, 0, 0, 16, '0000-00-00 00:00:00'),
(109, 'abcd', 47, '2024-02-16 19:55:00', '100', 0, 'aaaaaaaaaaaaaaaaa', 0, 1, 0, 16, '0000-00-00 00:00:00'),
(110, 'shyam', 47, '2024-02-24 19:55:00', '15', 0, 'nnnnnnnnnnnnnnn', 0, 1, 0, 16, '0000-00-00 00:00:00'),
(117, '1st Task', 20, '2024-02-24 07:47:00', '25', 1, '', 0, 0, 0, 18, '0000-00-00 00:00:00'),
(121, 'shyam', 23, '2024-02-29 11:41:00', '', NULL, 'None', NULL, 0, NULL, 20, '0000-00-00 00:00:00'),
(125, 'login page create', 25, '2024-02-29 09:09:00', '0', 0, 'completed', 0, 1, 0, 35, '0000-00-00 00:00:00'),
(127, 'ramt', 24, '2024-03-28 10:53:00', '', NULL, 'None', NULL, 0, NULL, 16, '0000-00-00 00:00:00'),
(128, 'hari', 22, '2024-03-28 11:08:00', '', NULL, 'None', NULL, 0, NULL, 17, '0000-00-00 00:00:00'),
(129, 'abcd', 23, '2024-03-29 11:09:00', '', NULL, 'None', NULL, 0, NULL, 20, '0000-00-00 00:00:00'),
(132, 'app', 27, '2024-03-09 20:35:00', '25', 0, '', 0, 1, 0, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
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
(2, 'user1', 'u1@gmail.com', 0, '', 'u1', '$2y$10$1oHlgVX5bZ3ig37p2tJf7eH8VyJ38umNf12UngrGB35zf2bXftR.K', 34, 'user', '2024-02-29 14:06:40'),
(3, 'user2', 'u2@gmail.com', 0, '', 'u2', '$2y$10$H1iyEKuFoenK1BTF1PmXDulALXZWRC5/qBPF3j3i0KgfGeZV57Xd2', 34, 'user', '2024-02-29 14:07:13'),
(4, 'user3', '', 0, '', 'u3', '$2y$10$9knGz3ddEqtn8x2WM.N0ueUF2ch6VQP4O1ogelMXoyWVSMIsKpgw6', 35, 'user', '2024-02-29 14:08:12'),
(5, 'u4', 'u4@gmail.com', 0, '', 'u4', '$2y$10$s.SHPLfxzRWqpdel4pGWFeRfRh8SR5N6LGeV5zx0cIY48W4YT6K3W', 35, 'user', '2024-02-29 14:08:39'),
(6, 'u5', 'u5@gmail.com', 0, '', 'u5', '$2y$10$ropRaph7PR3Y9asAxqSXKeU4qdFqUKo6RS2WlatkUH/kH.C2fpDrK', 36, 'user', '2024-02-29 14:09:07'),
(9, 'foreman1', 'f@gmail.com', 0, '', 'f1', '$2y$10$3tocKXilnYq8YRIfORYqW.lTKWoza7AZcTax9QiDbwrrISTuv37Ym', 34, 'foreman', '2024-02-29 14:11:18'),
(10, 'foreman2', 'f2@gmail.com', 0, '', 'f2', '$2y$10$ncYPy9OKHiUHc7A.dycLku0hYgCLYX0uBMF5hXOvGZvyYWIuOR56O', 35, 'foreman', '2024-02-29 14:11:46'),
(11, 'foreman3', 'f3@gmail.com', 0, '', 'f3', '$2y$10$VjdOhpRl6U2vUTxEpOvL/eKeznB7Yj/ock4RtYKocL9xGcIYFZTSO', 36, 'foreman', '2024-02-29 14:12:19');

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
  ADD UNIQUE KEY `name` (`name`);

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
  ADD KEY `fk` (`main_task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `users_ibfk_1` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assigned_member`
--
ALTER TABLE `assigned_member`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `main_task`
--
ALTER TABLE `main_task`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_task_mgmt`
--
ALTER TABLE `sub_task_mgmt`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_task_mgmt`
--
ALTER TABLE `sub_task_mgmt`
  ADD CONSTRAINT `fk` FOREIGN KEY (`main_task_id`) REFERENCES `main_task` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`dpt_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
