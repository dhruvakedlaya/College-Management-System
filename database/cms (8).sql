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
(1, 'BCA', 'BACHELORS OF COMPUTER SCIENCE', 45000, 'dsjhfbdskjbfvdskjvbdsv\r\ndwesfiohdsfvonivdsv\r\ndsgvosihvbdsoivndsfv', 'available'),
(2, 'BCOM', 'BACHELORS OF COMMERCE', 30000, 'Commerce Commerce', 'available'),
(3, 'BSC', 'BACHELORS OF SCIENCE', 38000, 'Science', 'available'),
(4, 'BBA', 'BACHELORS OF BUSINESS ADMINIST', 28000, 'BBA', 'available');

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
(9, 'STAF230005', '2023-06-25', 'fDgfdf', 'staff'),
(10, 'STUD230011', '2023-06-25', 'dgfbvvxcv', 'student'),
(11, 'STUD230011', '2023-06-25', 'RTJGHRH', 'student'),
(12, 'STAF230005', '2023-06-25', 'rthth', 'staff');

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
('staff', 'STAF230003', 'STAF230003'),
('staff', 'STAF230005', 'STAF230005'),
('student', 'STUD230006', 'Abcd@1234'),
('student', 'STUD230007', 'Abcd@1234'),
('student', 'STUD230008', 'Abcd@1234'),
('student', 'STUD230009', 'STUD230009'),
('student', 'STUD230011', 'Abcd@12345');

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
(3, 'STUD230010', 'BCA', '2', 88, 55, 44, 88, 77, 66, 418, 69.67, 'first class'),
(4, 'STUD230011', 'BCA', '1', 88, 55, 44, 88, 66, 77, 430, 71.6667, 'first class'),
(5, 'STUD230011', 'BCA', '2', 100, 100, 66, 99, 100, 55, 520, 86.6667, 'distinction');

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
(4, '2023-06-12', 'sxssss'),
(6, '2023-06-12', 'oqhdisud'),
(8, '2023-06-22', 'classes will be terminated early'),
(9, '2023-06-25', 'wqdfhSADFIKANBFF');

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
(4, 'STUD230011', 1, 'efeff', '2023-06-24', 'degfdsggdc'),
(5, 'STUD230011', 2, 'sadfQSADASD', '2023-06-24', 'zvdvcvv');

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
('STAF230001', 'Raj', 'images/1687501335_profile.png', 'Male', '2000-06-05', 'raj@email.com', 'BCA', 'BCOM', '9966335581', 'udupi 2', 'available', 'Abcd@1234', 0),
('STAF230002', 'Raj', 'images/profile.png', 'Male', '2000-05-09', 'raj@email.com', 'BCA', 'BBA', '9966335588', 'udupi', 'Not Availa', 'Abcd@1234', 13),
('STAF230003', 'Shreya', 'images/', 'Female', '2003-06-18', 'srjn@gmail.com', 'MCA', 'BCOM', '6789065432', 'Near Banashankari hardware', 'available', 'STAF230003', 15),
('STAF230005', 'Adarsh', 'images/IMG-20230214-WA0015.jpg', 'Male', '2003-06-11', 'a@gmail.com', 'MCOM', 'BCA', '8899887766', 'bdfjvcjbvc', 'available', 'STAF230005', 4);

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
(20, 'STAF230005', 'sick', '2023-06-25', 3, 'kujlikbh', 'rejected'),
(21, 'STAF230005', 'annual', '2023-06-09', 1, 'hgfvhjv', 'approved'),
(22, 'STAF230005', 'annual', '2023-06-23', 1, 'oihoh', 'approved'),
(23, 'STAF230005', 'annual', '2023-06-15', 5, '7fkjygfv', 'approved'),
(24, 'STAF230005', 'annual', '2023-06-23', 4, 'gfg', 'approved');

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
('STUD230001', 'riza', 'images/young-man.png', 'riza@gmail.com', '', '', '9944556688', '2023-06-13', 'Male', 88, 88, 'BCA', 'kundapura', 'Not Available', '123'),
('STUD230002', 'hello', 'images/woman.png', 'd@gmail.com', '', '', '6655886633', '2023-06-10', 'Male', 65, 87, 'BCA', 'udupi', 'Not Available', '777'),
('STUD230003', 'Rahul raju', 'images/1686840436_737400.jpg', 'ria@gmail.com', 'A', 'C', '5566889900', '1999-06-17', 'Male', 69, 79, 'BCA', 'Udupi', 'Not Available', 'Abcd@12345'),
('STUD230004', 'Kumar', 'images/profile.png', 'k@gmail.com', '', '', '9955668844', '2023-06-02', 'Male', 55, 56, 'BCA', 'Bvr', 'Not Available', 'Abc@12345'),
('STUD230005', 'vikas', 'images/profile.png', 'vikas@gmail.com', 'Bhoja', 'sujatha', '6655332244', '2003-06-11', 'Male', 45, 56, 'BSC', 'udupi', 'Not Available', 'Abcd@1234'),
('STUD230006', 'karthik', 'images/bussiness-man.png', 'kar@gmail.com', 'fn', 'mn', '8866559966', '2023-06-08', 'Male', 45, 55, 'BBA', 'bvr', 'available', 'Abcd@1234'),
('STUD230007', 'buddi', 'images/1687409251_woman (1).png', 'buddi@gmail.com', 'aaa', 'bbb', '5566889977', '2003-06-04', 'Female', 88, 76, 'BBA', 'kundapur', 'available', 'Abcd@1234'),
('STUD230008', 'raj', 'images/profile.png', 'raj@gmail.com', 'xxx', 'yyy', '7788996655', '2003-06-06', 'Male', 55, 45, 'BSC', 'udupi', 'available', 'Abcd@1234'),
('STUD230009', 'ayesha', 'images/woman.png', 'ayesha@gmail.com', 'Shekara', 'Shamala', '9966558844', '2001-06-14', 'Female', 45, 55, 'BSC', 'udupi', 'available', 'STUD230009'),
('STUD230010', '2233445566', 'images/young-man.png', 'dr@gmail.com', '', '', '9955668844', '2023-06-24', 'Male', 88, 56, 'BCA', 'udupi', 'Not Available', 'STUD230010'),
('STUD230011', 'Shrey', 'images/1687687435_peakpx.jpg', 'drv@gmail.com', '', '', '8899665588', '2023-06-23', 'Male', 88, 88, 'BCA', 'aaa', 'available', 'Abcd@12345');

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
