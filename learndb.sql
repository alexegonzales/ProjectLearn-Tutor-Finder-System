-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 11:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learndb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(9) NOT NULL,
  `lock_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `status`, `lock_date`) VALUES
(1, 'alex', 'admin@gmail.com', '86c55a234778e71faf6cbf9bbae6418a', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(9) NOT NULL,
  `tmsg_id` int(9) NOT NULL,
  `smsg_id` int(9) NOT NULL,
  `incoming_msg_id` int(50) NOT NULL,
  `outgoing_msg_id` int(50) NOT NULL,
  `msg` varchar(999) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `tmsg_id`, `smsg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `datetime`) VALUES
(1, 35, 39, 971300531, 447188662, 'hi', '2022-11-04 09:47:45'),
(2, 35, 39, 447188662, 971300531, 'hello', '2022-11-04 09:47:56'),
(3, 7, 26, 632492334, 430475623, 'fsfsdf', '2022-11-06 13:45:09'),
(4, 7, 26, 632492334, 430475623, 'hello', '2022-11-06 13:50:23'),
(5, 7, 26, 632492334, 430475623, 'sdasdsdasdasdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2022-11-06 13:51:48'),
(6, 35, 26, 971300531, 430475623, 'sdfsdfs', '2022-11-06 13:56:19'),
(7, 8, 26, 430475623, 234953453, 'dsfdfsdf', '2022-11-06 13:58:19'),
(10, 8, 26, 234953453, 430475623, 's', '2022-11-26 13:32:35'),
(11, 8, 44, 234953453, 1237129842, 'yo', '2023-09-27 02:22:25'),
(12, 8, 44, 1237129842, 234953453, 'waddap', '2023-09-27 02:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(9) NOT NULL,
  `notif_sid` int(9) NOT NULL,
  `notif_tid` int(9) NOT NULL,
  `notif_subj` varchar(250) NOT NULL,
  `notif_msg` text NOT NULL,
  `notif_status` int(1) NOT NULL,
  `req_status` int(1) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notif_id`, `notif_sid`, `notif_tid`, `notif_subj`, `notif_msg`, `notif_status`, `req_status`, `req_date`) VALUES
(1, 26, 8, 'alex gonzales', 'i would like to enroll', 1, 3, '2022-11-26 13:08:40'),
(2, 8, 26, 'alexa gonzales', 'Your request has been approved.', 1, 0, '2022-11-26 13:06:06'),
(3, 8, 26, 'alexa gonzales ', 'Session Complete.', 1, 0, '2022-11-26 13:08:47'),
(4, 39, 8, 'Iya Villania', 'i would like to enroll', 1, 3, '2022-12-01 13:03:17'),
(5, 8, 39, 'alexa gonzales', 'Your request has been approved.', 1, 0, '2022-11-26 13:17:38'),
(6, 42, 8, 'taylor swift', 'i would like to enroll', 1, 0, '2022-12-01 12:15:44'),
(7, 8, 26, 'alexa gonzales ', 'Session Complete.', 1, 0, '2023-06-11 01:51:56'),
(8, 44, 8, 'andy cantalejo', 'i would like to enroll', 1, 1, '2023-09-27 02:19:52'),
(9, 8, 44, 'alexa gonzales', 'Your request has been approved.', 1, 0, '2023-09-27 02:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(9) NOT NULL,
  `tutor_id` int(9) NOT NULL,
  `transaction_id` int(9) NOT NULL,
  `payment_option` varchar(15) NOT NULL,
  `income` decimal(9,2) NOT NULL,
  `toPay` decimal(9,2) NOT NULL,
  `pay_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `tutor_id`, `transaction_id`, `payment_option`, `income`, `toPay`, `pay_date`) VALUES
(1, 8, 245437308, 'PayMaya', '3452.00', '345.20', '2022-11-26 13:08:08'),
(2, 8, 968229784, 'GCash', '3700.00', '370.00', '2022-12-01 13:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(9) NOT NULL,
  `rev_sender_id` int(9) NOT NULL,
  `rev_receiver_id` int(9) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `rev_sender_id`, `rev_receiver_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 0, 0, 'EEJ3F', 3, 'asdasd', '2022-11-15 05:20:31'),
(2, 0, 0, 'EEJ3F', 4, 'fdsfsdf', '2022-11-15 06:38:16'),
(3, 0, 0, 'EEJ3Fczxczxcz', 1, 'fdsfsdfczxczxc', '2022-11-15 06:38:48'),
(4, 0, 0, 'EEJ3F', 2, 'asdasd', '2022-11-15 07:35:37'),
(5, 0, 0, 'sdfsdf', 1, 'dfsdf', '2022-11-15 07:38:43'),
(6, 0, 0, 'sdfsdf', 2, 'dfdf', '2022-11-15 07:46:24'),
(7, 0, 0, 'sdfsdf', 1, 'dfg', '2022-11-15 07:48:37'),
(8, 26, 0, 'assa', 1, '1', '2022-11-15 07:55:32'),
(9, 26, 0, 'saas', 0, '0', '2022-11-15 07:55:49'),
(10, 26, 0, 'saas', 1, '1', '2022-11-15 08:00:11'),
(11, 26, 0, 'sdfsdf', 1, '1', '2022-11-15 08:02:09'),
(12, 26, 0, 'ZUJ7Q', 5, '5', '2022-11-15 08:09:56'),
(13, 26, 8, 'asdasd', 2, '2', '2022-11-15 08:14:14'),
(14, 26, 8, 'EEJ3F', 5, '5', '2022-11-15 11:30:51'),
(15, 26, 0, 'asdasd', 3, '3', '2022-11-15 11:32:53'),
(16, 26, 8, 'asdasd', 1, '1', '2022-11-15 11:34:07'),
(17, 26, 8, 'sdfsdf', 4, '4', '2022-11-15 11:37:07'),
(18, 26, 5, 'dfsd', 5, '5', '2022-11-15 11:40:09'),
(19, 26, 5, 'dsfsdf', 2, '2', '2022-11-15 12:31:53'),
(20, 26, 5, 'asdasd', 2, 'sdfsdf', '2022-11-15 12:42:06'),
(21, 26, 5, '26', 5, 'ahuh', '2022-11-15 12:46:08'),
(22, 26, 5, 'alex gonzales', 1, 'asasas', '2022-11-15 12:46:55'),
(23, 26, 5, 'alex gonzales(Me)', 1, 'isa pa', '2022-11-15 12:47:35'),
(24, 26, 5, 'alex gonzales (Me)', 2, 'asdasd', '2022-11-15 12:47:55'),
(25, 39, 5, 'Iya Villania', 4, 'dfssdf', '2022-11-15 13:07:01'),
(26, 26, 5, 'alex gonzales', 1, 'dfsdfsd', '2022-11-15 13:08:52'),
(27, 39, 5, 'Iya Villania', 5, 'gghfg', '2022-11-15 13:11:59'),
(28, 26, 8, 'alex gonzales', 3, 'buloks\n', '2022-11-16 10:02:23'),
(31, 44, 8, 'andy cantalejo', 1, 'di marunong guise', '2023-09-27 02:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(9) NOT NULL,
  `unique_id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `contact` varchar(18) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `status` int(10) NOT NULL,
  `student_status` varchar(12) NOT NULL,
  `verification_status` varchar(18) NOT NULL,
  `credential` varchar(50) NOT NULL,
  `lock_date` varchar(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `unique_id`, `firstname`, `lastname`, `email`, `profile`, `contact`, `password`, `sex`, `status`, `student_status`, `verification_status`, `credential`, `lock_date`, `reg_date`) VALUES
(26, 430475623, 'alex', 'gonzales', 'alexi@gmail.com', 'beast.png - 2022.11.06 - 02.09.25pm.png', '09782490904', '86c55a234778e71faf6cbf9bbae6418a', 'female', 3, 'Offline now', 'Verified', '', '', '2024-02-12 05:57:33'),
(39, 447188662, 'Iya', 'Villania', 'Iya@gmail.com', 'iya.jpg - 2022.11.04 - 08.51.30am.jpg', '09352407108', '6b66d618a87aab0584632d32bcdb3279', 'female', 3, 'Offline now', 'Verified', '', '', '2022-12-01 12:44:59'),
(42, 1188029330, 'taylor', 'swift', 'tay@gmail.com', 'avatar.png', 'No input', '86c55a234778e71faf6cbf9bbae6418a', 'female', 3, 'Offline now', 'Verified', 'PHP_CURL.pdf', '', '2022-12-01 12:15:19'),
(43, 1027768330, 'nicholas', 'hault', 'nich@gmail.com', 'avatar.png', 'No input', '86c55a234778e71faf6cbf9bbae6418a', 'male', 3, 'Offline now', 'Verified', 'CURL.pdf', '', '2022-12-01 13:10:02'),
(44, 1237129842, 'andy', 'cantalejo', 'andy@gmail.com', 'Alexe_9-23-2023_28182999.png - 2023.09.27 - 04.23.59am.png', 'No input', '093553a06e667518be143b8c64077b31', 'male', 3, 'Offline now', 'Verified', 'ITS-OD-306-HTML-App-Develop-0922.pdf', '', '2023-09-27 02:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `student_schedule`
--

CREATE TABLE `student_schedule` (
  `id` int(9) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_schedule`
--

INSERT INTO `student_schedule` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(44, 'math', 'asdasdasda', '2023-09-27 00:24:00', '2023-09-28 00:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(9) NOT NULL,
  `tutor_id` int(9) NOT NULL,
  `topic_name` varchar(50) NOT NULL,
  `tutor_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `tutor_id`, `topic_name`, `tutor_name`) VALUES
(1, 8, 'algebra', 'alexa gonzales'),
(2, 5, 'inference', 'rachel green'),
(3, 7, 'chemistry', 'haley dunphy'),
(4, 18, 'biology', 'ross geller'),
(5, 19, 'poetry', 'phoebe buffay'),
(6, 19, 'vocabulary', 'phoebe buffay'),
(8, 39, 'music', 'dominic fike');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` int(9) NOT NULL,
  `unique_id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(18) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `tutor_status` varchar(12) NOT NULL,
  `verification_status` varchar(18) NOT NULL,
  `credential` varchar(50) NOT NULL,
  `education` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `lock_date` varchar(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `unique_id`, `firstname`, `lastname`, `email`, `contact`, `password`, `sex`, `profile`, `status`, `tutor_status`, `verification_status`, `credential`, `education`, `bio`, `lock_date`, `reg_date`) VALUES
(5, 709348538, 'Rachel', 'Green', 'rach@gmail.com', '09785312550', '4e2fe6dc5c296a7a548a7fd4eaf3ad07', 'Female', 'rach.jpg', 3, 'Offline now', 'Verified', '', ' College Graduate', 'Hi, I\'m Rachel I have the knowledge to assist you in becoming more knowledgeable regarding the course that I\'ve taught, especially since I have lots of knowledge and experience that will help you.', '', '2022-12-01 12:09:25'),
(7, 632492334, 'haley', 'dunphy', 'haley@gmail.com', '09233480164', 'ea1f561f66865449781748a4f95fa030', 'Female', 'haley.png', 3, 'Offline now', 'Verified', '', ' College Graduate', 'Hi, I\'m Haley Dunphy, a newly passed teacher, educator. A highly motivated, enthusiastic and a dedicated educator who wants all children to be successful learners.', '', '2022-12-01 12:09:32'),
(8, 234953453, 'alexa', 'gonzales', 'alexi20122012@gmail.com', '09352407108', '86c55a234778e71faf6cbf9bbae6418a', 'female', 'meh.jpg - 2022.10.22 - 03.12.15pm.jpg', 3, 'Active now', 'Verified', '', ' College Graduate', 'Hi Im Alex. I have years of experience in tutoring people as it is my passion so I can help you to improve your knowledge.', '', '2024-02-12 05:57:45'),
(17, 379969600, 'rocky', 'boi', 'rockyboi00@gmail.com', 'No input', '86c55a234778e71faf6cbf9bbae6418a', 'No input', 'rocky.jpg - 2022.10.08 - 03.04.35pm.jpg', 3, 'Offline now', 'Declined', '', ' College Graduate', '', '', '2022-12-01 12:32:47'),
(18, 409758238, 'ross', 'geller', 'rossg@gmail.com', '09758051729', '27e0caa6f506745bcc4ce8eebd342221', 'Male', 'ross.jpg - 2022.10.09 - 06.30.34am.jpg', 3, 'Offline now', 'Verified', '', ' College Graduate', ' Hi, my name is Ross Geller. I\'ve taught Science subject for three years. Teaching the students how to study is my guiding principle.', '', '2022-12-01 12:09:42'),
(19, 336306657, 'phoebe', 'buffay', 'pheebs@gmail.com', '09474967126', '01710480324631518d54eb58430379a9', 'Female', 'peebs.jpg - 2022.10.09 - 06.38.35am.jpg', 3, 'Offline now', 'Verified', '', ' College Graduate', 'Hello! My name is Phoebe. I am very passionate in teaching as I want to help the younger generation be more knowledgeable especially in the subjects that I teach.', '', '2022-12-01 12:09:47'),
(35, 971300531, 'Drew', 'Arellano', 'drew@gmail.com', '09846738693', '6b66d618a87aab0584632d32bcdb3279', 'male', 'drew.jpg - 2022.11.04 - 08.42.02am.jpg', 3, 'Offline now', 'Verified', '', 'College Graduate', 'Hi Im Drew. I have years of experience in tutoring people as it is my passion so I can help you to improve your knowledge.', '', '2022-12-01 12:09:53'),
(39, 1515894681, 'dominic', 'fike', 'dom@gmail.com', 'No input', '86c55a234778e71faf6cbf9bbae6418a', 'male', 'avatar.png', 3, 'Offline now', 'Verified', 'resume.pdf', 'No input', 'No input', '', '2022-12-01 13:03:40'),
(40, 1225356903, 'elizabeth', 'olsen', 'lizzy@gmail.com', 'No input', '86c55a234778e71faf6cbf9bbae6418a', 'female', 'avatar.png', 3, 'Offline now', 'Verified', 'resume.pdf', 'No input', 'No input', '', '2022-12-01 13:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_schedule`
--

CREATE TABLE `tutor_schedule` (
  `id` int(9) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`) USING BTREE,
  ADD KEY `tmsg_id` (`tmsg_id`),
  ADD KEY `smsg_id` (`smsg_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `notif_sid` (`notif_sid`,`notif_tid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD KEY `id` (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutor_schedule`
--
ALTER TABLE `tutor_schedule`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD CONSTRAINT `student_schedule_ibfk_1` FOREIGN KEY (`id`) REFERENCES `students` (`id`);

--
-- Constraints for table `tutor_schedule`
--
ALTER TABLE `tutor_schedule`
  ADD CONSTRAINT `tutor_schedule_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tutors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
