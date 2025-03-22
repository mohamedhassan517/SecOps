-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10 يونيو 2024 الساعة 16:23
-- إصدار الخادم: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comscanner`
--

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `md5_pass` varchar(100) DEFAULT NULL,
  `repeat_pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `pass`, `md5_pass`, `repeat_pass`) VALUES
(2, 'lolo', 'lolyyy', 'lol@gmail.com', 'ola999', '', 'ola999'),
(3, 'oollaa', 'abodouh', 'olaabodouh@gmail.com', 'olaola', '236d1336e98985dce3a625d46aebfd02', 'olaola'),
(4, 'laella', 'mohmed', 'lalella@gmail.com', 'laella', '2316b4ce2c531334c5ca45aa6e314d24', 'f_name'),
(5, 'blablblaa', 'blablblaa', 'blablblaa@gmail.com', 'blablblaa', 'c00f11ade53f5f58c02b50e59ab967bc', 'blablblaa'),
(6, 'noooor', 'nooooor', 'noooor@gmail.com', 'noooor', 'b070d0fd75c7bee85a8f0d4e66da3888', 'noooor'),
(7, 'blablbla', 'blablbla', 'blablblaa@gmail.com', 'blablbla', '8cd8fa8abdb835301c18261a23242e69', 'blablbla'),
(8, 'nahal', 'nahal', 'nahal@gmail.com', 'nahal', '065833c6f7a57da7ecdc6600e589b0b1', 'nahal'),
(9, '123456', '', 'admin@xxx', '123456', 'e10adc3949ba59abbe56e057f20f883e', ''),
(10, 'mohmed', 'sayeed', 'mohmed@gmail.com', 'moh123', 'cf5adedbaa3ccf29d866375a16e37928', 'moh123'),
(11, 'aya ahmed', 'fouad', 'aya@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', '123456'),
(12, 'nahlaa', 'fathalla', 'nahlaa@gmail.com', 'nahlaa', '3d52da712cc4183d7dfa51cde9ef42e3', 'nahlaa'),
(13, 'mohmden', 'mohmden', 'mohmden@gmail.com', 'mohmden', '19a3d5310bb5180a6c847f519ce8a525', 'mohmden'),
(14, 'ola alsayed', 'abodouh abdelgalel', 'olaalsayed@gmail.com', 'abodouh abdelgalel', '5559609bb81b1fa2dc9969f897a0eea8', 'abodouh abdelgalel'),
(15, 'zienab', 'saaber', 'zienab@gmail.com', 'zienab', '068f1635c73cb08f4f42e3292ba2558f', 'zienab'),
(16, 'essraa', 'saaeed', 'essraa@gmail.com', 'essraa', 'de12e4a6c11bc2258c30fa576af2e36c', 'essraa'),
(17, 'fatma', 'ebrahem', 'fatma@gmail.com', 'fatma', '38ab93488e52710515c3095a83a92bcf', 'fatma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
