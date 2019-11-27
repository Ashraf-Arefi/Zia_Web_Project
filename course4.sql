-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2019 at 07:29 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course4`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(10) UNSIGNED NOT NULL,
  `book_name` varchar(40) NOT NULL,
  `book_price` float UNSIGNED NOT NULL,
  `book_edition` varchar(10) NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_price`, `book_edition`, `department_id`, `status`) VALUES
(1, 'فزیک', 400, '2', 2, 0),
(2, 'فزیک', 400, '2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(10) UNSIGNED NOT NULL,
  `card_name` varchar(40) NOT NULL,
  `card_price` float UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `certificate_id` int(11) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(11) UNSIGNED NOT NULL,
  `payment` float UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`certificate_id`, `student_id`, `class_id`, `payment`, `date`, `description`, `status`) VALUES
(2, 1, 1, 600, '1398-07-24', 'certificate این کلاس به عبدالرحمن رضایی داده شد', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `room_name` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `fees` float UNSIGNED NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `course_percentage` float NOT NULL,
  `certificate` varchar(10) NOT NULL,
  `class_status` varchar(30) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `subject_id`, `room_name`, `start_time`, `end_time`, `start_date`, `fees`, `class_name`, `course_percentage`, `certificate`, `class_status`, `status`) VALUES
(1, 1, 'اتاق A', '16:45:00', '14:45:00', '1398-08-20', 600, 'ریاضی صنف 10', 40, 'ندارد', 'قراره شروع شود', 0),
(2, 1, 'اتاق A', '14:45:00', '14:45:00', '1398-08-07', 7000, 'ریاضی صنف 10', 40, 'ندارد', 'قراره شروع شود', 0),
(4, 2, 'اتاق A', '15:00:00', '14:00:00', '1398-08-08', 600, 'cornner1', 40, 'دارد', 'قراره شروع شود', 0),
(8, 3, 'اتاق B', '16:30:00', '14:30:00', '1398-08-08', 900, 'جغرافیه صنف 12', 40, 'ندارد', 'قراره شروع شود', 0),
(9, 4, 'اتاق A', '16:15:00', '14:15:00', '1398-08-09', 600, 'هندسه و مثلثات', 40, 'ندارد', 'قراره شروع شود', 0),
(12, 5, 'اتاق A', '10:30:00', '09:30:00', '1398-08-14', 500, 'starter1', 40, 'دارد', 'درحال جریان', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `class_teacher_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_teacher`
--

INSERT INTO `class_teacher` (`class_teacher_id`, `teacher_id`, `class_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 1, 2),
(5, 2, 6),
(6, 3, 7),
(7, 1, 8),
(8, 2, 8),
(9, 3, 8),
(10, 3, 10),
(11, 6, 11),
(12, 3, 10),
(13, 6, 11),
(14, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `status`) VALUES
(1, 'ساینس', 0),
(2, 'انگلیسی', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `address` varchar(128) NOT NULL,
  `gender` enum('آقا','خانم') DEFAULT 'آقا',
  `hire_date` date NOT NULL,
  `marital_status` enum('single','marry') NOT NULL DEFAULT 'single',
  `salary` float UNSIGNED NOT NULL,
  `salary_type` varchar(50) NOT NULL,
  `shift` varchar(32) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `agreement_paper` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `position_id`, `phone`, `email`, `address`, `gender`, `hire_date`, `marital_status`, `salary`, `salary_type`, `shift`, `photo`, `agreement_paper`, `status`) VALUES
(1, 'محمد ضیا', 'محمدی', 3, '0785882148', 'ziayamin8@gmail.com', 'Herat-jebraiel', 'آقا', '1398-08-09', 'single', 40, 'فیصدی', 'قبل ازظهر', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(2, 'سید محمد اشرف', 'عارفی', 3, '0785882147', 'hasinyasa4@gmail.com', 'Herat-jebraiel', 'آقا', '1398-08-07', 'single', 60, 'فیصدی', 'قبل ازظهر', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(3, 'راضیه', 'وفایی', 3, '0731234568', 'razia@gmail.com', 'Herat-jebraiel', 'آقا', '1398-08-08', 'single', 50, 'فیصدی', 'قبل ازظهر', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(4, 'علی', 'احمدی', 3, '0732456795', 'ali@gmail.com', 'Herat-jebraiel', 'آقا', '1398-08-11', 'single', 60, 'ساعتی', 'بعدازظهر', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(5, 'رضا', 'رضایی', 1, '0785446987', 'reza@gmail.com', 'Herat-jebraiel', 'آقا', '1398-08-11', 'single', 20000, 'ثابت', 'تمام وقت', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(6, 'ضامن علی', 'حسینی', 3, '0799852364', 'zaminali@gmail.com', 'Herat-jebraiel', 'آقا', '1398-08-12', 'single', 20000, 'ثابت', 'تمام وقت', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(7, 'مهرناز', 'سروش', 2, '0785002148', 'mehrNazm@gmail.com', 'Herat-jebraiel', 'خانم', '1398-08-23', 'single', 15000, '', 'تمام وقت', 'image/1573715011.jpg', 'image/agreement.jpg', 0),
(8, 'ahmad', 'ali zada', 1, '0780082148', 'aliAhmady12@gamil.com', 'Herat-jebraiel', 'آقا', '1398-08-23', 'single', 20000, 'معاش ثابت', 'تمام وقت', 'image/1573715138.jpg', 'image/agreement.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_book`
--

CREATE TABLE `employee_book` (
  `emp_bk_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `payment_status` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_position`
--

CREATE TABLE `employee_position` (
  `position_id` int(11) UNSIGNED NOT NULL,
  `position_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_position`
--

INSERT INTO `employee_position` (`position_id`, `position_name`) VALUES
(1, 'مدیر'),
(2, 'منشی'),
(3, 'استاد');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) UNSIGNED NOT NULL,
  `expense_reason_id` int(10) UNSIGNED NOT NULL,
  `description` text,
  `amount` float NOT NULL,
  `currency` char(20) NOT NULL,
  `pay_date` date NOT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_reason_id`, `description`, `amount`, `currency`, `pay_date`, `employee_id`, `user_id`, `status`) VALUES
(1, 1, NULL, 6000, 'افغانی', '1398-08-11', 1, 1, 0),
(2, 2, NULL, 4000, 'افغانی', '1398-08-01', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense_reason`
--

CREATE TABLE `expense_reason` (
  `expense_reason_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_reason`
--

INSERT INTO `expense_reason` (`expense_reason_id`, `title`, `status`) VALUES
(1, 'کرایه آب', 0),
(2, 'مصارف دفتر', 0);

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `book_library_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(100) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`book_library_id`, `book_id`, `quantity`) VALUES
(1, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `percentage_salary_payment`
--

CREATE TABLE `percentage_salary_payment` (
  `percentage_salary_payment_id` int(11) NOT NULL,
  `payment_amount` float UNSIGNED NOT NULL,
  `payment_borrow` float UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `payment_month` varchar(10) NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `percentage_salary_payment`
--

INSERT INTO `percentage_salary_payment` (`percentage_salary_payment_id`, `payment_amount`, `payment_borrow`, `payment_date`, `payment_month`, `employee_id`, `class_id`, `user_id`, `status`) VALUES
(1, 288, 0, '1398-08-09', 'ســرطان', 1, 9, 1, 0),
(2, 540, 0, '1398-08-09', 'عقــرب', 3, 8, 1, 0),
(3, 532, 0, '1398-08-09', 'عقــرب', 1, 8, 1, 0),
(4, 300, 132, '1398-08-09', 'عقــرب', 1, 8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(10) UNSIGNED NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(10) UNSIGNED NOT NULL,
  `room_floor` varchar(20) NOT NULL,
  `room_name` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_floor`, `room_name`, `status`) VALUES
(1, 'طبقه اول', 'اتاق A', 0),
(2, 'طبقه اول', 'اتاق B', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_payment`
--

CREATE TABLE `salary_payment` (
  `payment_id` int(11) NOT NULL,
  `payment_amount` float UNSIGNED NOT NULL,
  `payment_borrow` float UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `payment_month` varchar(30) NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary_payment`
--

INSERT INTO `salary_payment` (`payment_id`, `payment_amount`, `payment_borrow`, `payment_date`, `payment_month`, `employee_id`, `user_id`, `status`) VALUES
(1, 10000, 5000, '1398-08-06', 'عقــرب', 2, 1, 0),
(2, 20000, 0, '1398-08-07', 'عقــرب', 1, 1, 0),
(3, 10000, 2000, '1398-08-07', 'عقــرب', 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `father_name` varchar(20) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `phone` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `agreement_paper` varchar(255) DEFAULT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `first_name`, `last_name`, `father_name`, `gender`, `age`, `phone`, `date`, `address`, `photo`, `agreement_paper`, `status`) VALUES
(1, 'عبدالرحمن', 'رضایی', 'عبدول', 'male', 21, '0788885247', '1398-07-23', 'Herat-jebraiel', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(2, 'محمد ضیا', 'یمین', 'عبدالمجید', 'male', 24, '0785882147', '1398-07-23', 'Herat-jebraiel', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(3, 'حامد', 'محمدی', 'اسحق', 'male', 15, '0732586974', '1398-08-08', 'Herat-jebraiel', 'image/empty_profile.jpg', 'image/agreement.jpg', 0),
(4, 'zia', 'mohammadi', 'rohan', 'male', 45, '0785882147', '1398-06-11', 'Herat-jebraiel', 'image/1572767479.PNG', 'image/per_1572767479.PNG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_book`
--

CREATE TABLE `student_book` (
  `st_bk_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `payment` int(10) UNSIGNED NOT NULL,
  `borrow` float UNSIGNED NOT NULL,
  `discount` float UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_book`
--

INSERT INTO `student_book` (`st_bk_id`, `student_id`, `book_id`, `quantity`, `payment`, `borrow`, `discount`, `date`, `user_id`, `status`) VALUES
(1, 1, 1, 5, 2000, 0, 0, '1398-08-11', 1, 0),
(2, 1, 1, 2, 800, 0, 0, '1398-08-15', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_card`
--

CREATE TABLE `student_card` (
  `student_card_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `payment` float UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `st_cl_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `c_payment` int(11) NOT NULL,
  `c_discount` int(11) NOT NULL,
  `c_borrow` float UNSIGNED NOT NULL,
  `c_reason` varchar(255) DEFAULT NULL,
  `c_date` date NOT NULL,
  `bill_number` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`st_cl_id`, `class_id`, `student_id`, `c_payment`, `c_discount`, `c_borrow`, `c_reason`, `c_date`, `bill_number`, `status`) VALUES
(1, 1, 1, 500, 0, 0, NULL, '1398-07-23', 1, 0),
(2, 2, 1, 600, 0, 0, NULL, '1398-07-23', 1, 0),
(3, 3, 2, 900, 0, 0, NULL, '1398-07-23', 1, 0),
(4, 8, 1, 900, 0, 0, NULL, '1398-08-08', 1, 0),
(5, 8, 2, 900, 0, 0, NULL, '1398-08-08', 2, 0),
(6, 8, 3, 900, 0, 0, NULL, '1398-08-08', 3, 0),
(7, 9, 1, 600, 0, 0, NULL, '1398-08-09', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_score`
--

CREATE TABLE `student_score` (
  `score_id` int(11) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `midterm_exam` float NOT NULL,
  `final_exam` float UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_score`
--

INSERT INTO `student_score` (`score_id`, `student_id`, `class_id`, `midterm_exam`, `final_exam`, `status`) VALUES
(1, 1, 1, 45, 46, 0),
(12, 2, 9, 45, 46, 0),
(13, 4, 11, 40, 60, 0),
(14, 3, 10, 40, 55, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(10) UNSIGNED NOT NULL,
  `subject_name` varchar(30) NOT NULL,
  `subject_payment` int(11) NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `subject_payment`, `department_id`, `status`) VALUES
(1, 'ریاضی صنف 10', 400, 1, 0),
(2, 'cornner1', 500, 2, 0),
(3, 'جغرافیه صنف 12', 400, 1, 0),
(4, 'هندسه و مثلثات', 600, 1, 0),
(5, 'starter1', 5000, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `user_level` tinyint(4) NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `last_name`, `username`, `remember_token`, `password`, `user_level`, `status`) VALUES
(10, 'zia', 'yamin', 'mostafa@gmail.com', 'HNTeV6roa4jgF7yRRvhW01dh55vkDxOa8S1uUs6WYK4GqLwZn6S16Vjcukkl', '$2y$10$/NsAbFRqq50/SbeH80lc6u7hGebfVRUTTtdBw/.QEV82AJktjbfvy', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_name_index` (`book_name`),
  ADD KEY `book_department_fk` (`department_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `card_department_fk` (`department_id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `class_subject_fk` (`subject_id`);

--
-- Indexes for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD PRIMARY KEY (`class_teacher_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `department_name_index` (`department_name`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_EmployeePosition` (`position_id`);

--
-- Indexes for table `employee_book`
--
ALTER TABLE `employee_book`
  ADD PRIMARY KEY (`emp_bk_id`),
  ADD KEY `user_id_index` (`user_id`),
  ADD KEY `employee_book` (`employee_id`),
  ADD KEY `book_id_fk` (`book_id`);

--
-- Indexes for table `employee_position`
--
ALTER TABLE `employee_position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `employee_expense_fk` (`employee_id`),
  ADD KEY `FK_ExpensReason` (`expense_reason_id`),
  ADD KEY `expense_userfk` (`user_id`);

--
-- Indexes for table `expense_reason`
--
ALTER TABLE `expense_reason`
  ADD PRIMARY KEY (`expense_reason_id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`book_library_id`);

--
-- Indexes for table `percentage_salary_payment`
--
ALTER TABLE `percentage_salary_payment`
  ADD PRIMARY KEY (`percentage_salary_payment_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_name_index` (`room_name`);

--
-- Indexes for table `salary_payment`
--
ALTER TABLE `salary_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `student_book`
--
ALTER TABLE `student_book`
  ADD PRIMARY KEY (`st_bk_id`),
  ADD KEY `book_id_index` (`book_id`),
  ADD KEY `student_id_index` (`student_id`),
  ADD KEY `student_book_ufk` (`user_id`);

--
-- Indexes for table `student_card`
--
ALTER TABLE `student_card`
  ADD PRIMARY KEY (`student_card_id`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`st_cl_id`);

--
-- Indexes for table `student_score`
--
ALTER TABLE `student_score`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `subject_name_index` (`subject_name`),
  ADD KEY `department_reference_index` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `class_teacher`
--
ALTER TABLE `class_teacher`
  MODIFY `class_teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_book`
--
ALTER TABLE `employee_book`
  MODIFY `emp_bk_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_position`
--
ALTER TABLE `employee_position`
  MODIFY `position_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_reason`
--
ALTER TABLE `expense_reason`
  MODIFY `expense_reason_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `book_library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `percentage_salary_payment`
--
ALTER TABLE `percentage_salary_payment`
  MODIFY `percentage_salary_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary_payment`
--
ALTER TABLE `salary_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `st_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_book`
--
ALTER TABLE `student_book`
  MODIFY `st_bk_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_card`
--
ALTER TABLE `student_card`
  MODIFY `student_card_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `st_cl_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_score`
--
ALTER TABLE `student_score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
