-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-01-09 15:11:14
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `3a932053`
--

-- --------------------------------------------------------

--
-- 資料表結構 `class`
--

CREATE TABLE `class` (
  `classnameid` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `classname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `INSTRUCTORS` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `assignments` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `class`
--

INSERT INTO `class` (`classnameid`, `classname`, `year`, `INSTRUCTORS`, `assignments`) VALUES
('張藝興1', 'Dancing Course', '2022', '張藝興', 3),
('張藝興2', 'Singing Course', '2022', '張藝興', 0),
('', 'Talk Show Course', '2022', '王勉', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `homework`
--

CREATE TABLE `homework` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `classname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `homeworkname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `RELEASED` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `DUE` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link3` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link4` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link5` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link6` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link7` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link8` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link9` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link10` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `homework`
--

INSERT INTO `homework` (`id`, `classname`, `homeworkname`, `RELEASED`, `DUE`, `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `link9`, `link10`) VALUES
('Dancing Course1', 'Dancing Course', 'Homework01', '2022-01-02T00:00', '2022-01-06T23:23', '1.1', '1.2', '1.3', '1.4', '2.1', '2.2', '', '', '', ''),
('Dancing Course2', 'Dancing Course', 'Homework02', '2022-01-01T00:00', '2022-03-11T23:23', '', '', '', '', '', '', '', '', '', ''),
('Dancing Course3', 'Dancing Course', 'homework3', '2022-01-07T21:00', '2022-01-18T13:03', '1.1', '1.2', '2.1', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `instructors`
--

CREATE TABLE `instructors` (
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `instructors`
--

INSERT INTO `instructors` (`email`, `name`, `password`) VALUES
('z001@gmail.com', '張藝興', 'abc'),
('z002@gmail.com', '王勉', 'abc');

-- --------------------------------------------------------

--
-- 資料表結構 `link`
--

CREATE TABLE `link` (
  `ech` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `iflink` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link1` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link2` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link3` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link4` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link5` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link6` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link7` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link8` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link9` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link10` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `link`
--

INSERT INTO `link` (`ech`, `iflink`, `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `link9`, `link10`) VALUES
('aaa@gmail.comDancing Coursehomework3', '1', '', '', '', '', '', '', '', '', '', ''),
('abc@gmail.comDancing CourseHomework01', '1', 'abc@gmail.comDancingCourseHomework011.jp', 'abc@gmail.comDancingCourseHomework012.jp', 'abc@gmail.comDancingCourseHomework013.jp', 'abc@gmail.comDancingCourseHomework014.jp', 'abc@gmail.comDancingCourseHomework015.jp', 'abc@gmail.comDancingCourseHomework016.jp', '', '', '', ''),
('abc@gmail.comDancing CourseHomework02', '1', '', '', '', '', '', '', '', '', '', ''),
('abc@gmail.comDancing Coursehomework3', '1', 'abc@gmail.comDancingCoursehomework31.jpg', 'abc@gmail.comDancingCoursehomework32.jpg', 'abc@gmail.comDancingCoursehomework33.jpg', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `student`
--

INSERT INTO `student` (`email`, `password`) VALUES
('aaa@gmail.com', 'abc'),
('abc@gmail.com', 'abc');

-- --------------------------------------------------------

--
-- 資料表結構 `studentclass`
--

CREATE TABLE `studentclass` (
  `Coursenumber` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `classname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `classnameid` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `studentclass`
--

INSERT INTO `studentclass` (`Coursenumber`, `email`, `classname`, `classnameid`) VALUES
('aaa@gmail.com1', 'aaa@gmail.com', 'Dancing Course', 'Dancing Course2'),
('aaa@gmail.com2', 'aaa@gmail.com', 'Talk Show Course', 'Talk Show Course2'),
('abc@gmail.com1', 'abc@gmail.com', 'Dancing Course', 'Dancing Course1'),
('abc@gmail.com2', 'abc@gmail.com', 'Talk Show Course', 'Talk Show Course1');

-- --------------------------------------------------------

--
-- 資料表結構 `studenthomework`
--

CREATE TABLE `studenthomework` (
  `homeworkid` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `studentemail` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `classname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `homeworkname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `STATUS` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `studenthomework`
--

INSERT INTO `studenthomework` (`homeworkid`, `studentemail`, `classname`, `homeworkname`, `STATUS`) VALUES
('aaa@gmail.comDancing Course1', 'aaa@gmail.com', 'Dancing Course', 'Homework01', '0'),
('aaa@gmail.comDancing Course2', 'aaa@gmail.com', 'Dancing Course', 'Homework02', 'Unsubmitted'),
('aaa@gmail.comDancing Course3', 'aaa@gmail.com', 'Dancing Course', 'homework3', 'Unsubmitted'),
('abc@gmail.comDancing Course1', 'abc@gmail.com', 'Dancing Course', 'Homework01', '99'),
('abc@gmail.comDancing Course2', 'abc@gmail.com', 'Dancing Course', 'Homework02', 'Unsubmitted'),
('abc@gmail.comDancing Course3', 'abc@gmail.com', 'Dancing Course', 'homework3', 'Submitted');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classname`);

--
-- 資料表索引 `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`email`);

--
-- 資料表索引 `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`ech`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`email`);

--
-- 資料表索引 `studentclass`
--
ALTER TABLE `studentclass`
  ADD PRIMARY KEY (`Coursenumber`);

--
-- 資料表索引 `studenthomework`
--
ALTER TABLE `studenthomework`
  ADD PRIMARY KEY (`homeworkid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
