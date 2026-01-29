-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 02:18 PM
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
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `sno` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`sno`, `id`, `image`) VALUES
(2, 'STUD230009', 'uploads/matthieu-comoy-koo_vYrlU_U-unsplash.jpg'),
(3, 'STUD230011', 'uploads/young-man.png');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `sno` int(11) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `full` varchar(30) NOT NULL,
  `fees` int(10) NOT NULL,
  `des` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`sno`, `cname`, `full`, `fees`, `des`, `status`) VALUES
(1, 'BCA', 'BACHELORS OF COMPUTER SCIENCE', 45000, 'dsjhfbdskjbfvdskjvbdsv\r\ndwesfiohdsfvonivdsv\r\ndsgvosihvbdsoivndsfv', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fid` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fid`, `id`, `date`, `feedback`, `type`) VALUES
(9, 'STAF230005', '2023-06-25', 'fDgfdf', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `type` varchar(10) NOT NULL,
  `id` varchar(10) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`type`, `id`, `pass`) VALUES
('admin', 'admin', 'pass'),
('staff', 'STAF230001', 'Abcd@1234'),
('student', 'STUD230006', 'Abcd@1234');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `sno` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `course` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '1',
  `s1` int(11) NOT NULL,
  `s2` int(11) NOT NULL,
  `s3` int(11) NOT NULL,
  `s4` int(11) NOT NULL,
  `s5` int(11) NOT NULL,
  `s6` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `avg` float NOT NULL,
  `grade` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`sno`, `id`, `course`, `type`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `total`, `avg`, `grade`) VALUES
(3, 'STUD230010', 'BCA', '2', 88, 55, 44, 88, 77, 66, 418, 69.67, 'first class');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `sno` int(11) NOT NULL,
  `date` date NOT NULL,
  `notice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`sno`, `date`, `notice`) VALUES
(4, '2023-06-12', 'sxssss');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `qid` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `response` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`qid`, `id`, `type`, `query`, `date`, `response`) VALUES
(4, 'STUD230011', 1, 'efeff', '2023-06-24', 'degfdsggdc');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(400) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `qual` varchar(50) NOT NULL,
  `depart` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `total_leave` int(11) NOT NULL DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `image`, `gender`, `dob`, `email`, `qual`, `depart`, `phone`, `address`, `status`, `pass`, `total_leave`) VALUES
('STAF230001', 'Raj', 'images/1687501335_profile.png', 'Male', '2000-06-05', 'raj@email.com', 'BCA', 'BCOM', '9966335581', 'udupi 2', 'available', 'Abcd@1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave`
--

CREATE TABLE `staff_leave` (
  `leave_id` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `num` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_leave`
--

INSERT INTO `staff_leave` (`leave_id`, `id`, `type`, `date`, `num`, `reason`, `status`) VALUES
(20, 'STAF230005', 'sick', '2023-06-25', 3, 'kujlikbh', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` varchar(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(500) NOT NULL,
  `email` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `tenth` int(11) NOT NULL,
  `twlth` int(11) NOT NULL,
  `course` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `image`, `email`, `fname`, `mname`, `phone`, `dob`, `gender`, `tenth`, `twlth`, `course`, `address`, `status`, `pass`) VALUES
('STUD230001', 'riza', 'images/young-man.png', 'riza@gmail.com', '', '', '9944556688', '2023-06-13', 'Male', 88, 88, 'BCA', 'kundapura', 'Not Available', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_leave`
--
ALTER TABLE `staff_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_leave`
--
ALTER TABLE `staff_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
