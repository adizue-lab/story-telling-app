-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 01:51 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storylac`
--

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `category` text COLLATE utf8_unicode_ci,
  `story_title` text COLLATE utf8_unicode_ci NOT NULL,
  `story_body` text COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `posted_on` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `category`, `story_title`, `story_body`, `location`, `photo`, `user_id`, `name`, `posted_on`) VALUES
(2, 'Tragedy', 'The fox and the hen', 'This is a story about a hen and a fox, which is a lesson to everyone that not all that glitter are gold!! Mind you we are all pilgrims on this earth', 'Lagos', 'uploads/python.jpeg', '1', '0', 'July 19, 2021, 2:01 pm'),
(4, 'Comedy', 'New Title', 'I have this code and need the code to add a I have this code and need the code to add a I have this code and need the code to add a I have this code and need the code to add a I have this code and need the code to add a I have this code and need the code to add a I have this code and need the code to add a I have this code and need the code to add a I have this code and need the code to add a I have this code and need the code to add a ', 'Lagos', 'uploads/avatar_ps.png', '1', 'Victor Maduka', 'July 19, 2021, 5:58 pm'),
(5, 'Horror', 'the title is here', 'I have this code and need the code to add a ', 'Abuja', 'uploads/AvatarMaker.png', '1', 'Victor Maduka', 'July 19, 2021, 5:59 pm'),
(6, 'Rebirth', 'Lorem ipsum academy', 'this is a I have this code and need the code to add a .....\r\nI have this code and need the code to add a .....\r\nI have this code and need the code to add a .....\r\nI have this code and need the code to add a .....\r\n', 'Atlanta', 'uploads/avatar_ps.png', '1', 'Victor Maduka', 'July 19, 2021, 9:26 pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `role` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `username`, `password`) VALUES
(1, 'Victor Maduka', 'storyteller', 'victormaduka7@gmail.com', 'vickson'),
(3, 'Admin Cyril', 'admin', 'admin@storylac.com', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
