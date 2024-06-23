-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 22, 2024 at 11:41 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt1`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `classes`
--

CREATE TABLE `classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`) VALUES
(1, '1a'),
(2, '1b'),
(3, '1c'),
(4, '2a'),
(5, '2b'),
(6, '2c'),
(7, '3a'),
(8, '3b'),
(9, '3c');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `grade` tinyint(6) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `grade`, `subject_id`, `student_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, 1, '2024-06-19 14:43:19', '2024-06-19 14:43:19'),
(2, 2, 1, 1, 1, '2024-06-19 14:43:56', '2024-06-19 14:43:56'),
(3, 6, 2, 1, 2, '2024-06-19 14:44:13', '2024-06-19 14:44:13'),
(4, 3, 1, 2, 1, '2024-06-19 14:44:59', '2024-06-19 14:44:59'),
(5, 2, 1, 2, 1, '2024-06-19 14:44:59', '2024-06-19 14:44:59'),
(6, 4, 2, 2, 2, '2024-06-19 14:45:25', '2024-06-19 14:45:25'),
(7, 2, 2, 2, 2, '2024-06-19 14:45:25', '2024-06-19 14:45:25'),
(8, 3, 1, 3, 1, '2024-06-19 14:46:04', '2024-06-19 14:46:04'),
(9, 4, 1, 3, 1, '2024-06-19 14:46:04', '2024-06-19 14:46:04'),
(10, 5, 2, 3, 2, '2024-06-19 14:46:19', '2024-06-19 14:46:19'),
(17, 3, 1, 2, 1, '2024-06-21 20:09:58', '2024-06-21 20:09:58'),
(18, 3, 1, 2, 1, '2024-06-21 20:14:54', '2024-06-21 20:14:54'),
(19, 5, 1, 2, 1, '2024-06-21 20:15:06', '2024-06-21 20:15:06'),
(20, 5, 1, 2, 1, '2024-06-21 20:19:06', '2024-06-21 20:19:06'),
(21, 1, 1, 2, 1, '2024-06-21 20:19:21', '2024-06-21 20:19:21'),
(22, 0, 1, 2, 1, '2024-06-22 14:09:24', '2024-06-22 14:09:24'),
(23, 1, 1, 2, 1, '2024-06-22 14:09:39', '2024-06-22 18:48:22');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `class_id`) VALUES
(1, 3, 1),
(2, 4, 1),
(3, 6, 2),
(6, 19, 1),
(7, 19, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Matematyka'),
(2, 'Język Polski'),
(3, 'Język Angielski'),
(4, 'Język Niemiecki'),
(5, 'Geografia'),
(6, 'Biologia'),
(7, 'Chemia'),
(8, 'Fizyka'),
(9, 'Plastyka'),
(10, 'Muzyka'),
(11, 'Informatyka'),
(12, 'Wychowanie Fizyczne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `subject_id`) VALUES
(1, 2, 1),
(3, 2, 10),
(2, 5, 2),
(27, 18, 8),
(26, 19, 1),
(21, 19, 2),
(28, 19, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `dateofbirth` datetime NOT NULL,
  `role` enum('user','admin','teacher','student') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `dateofbirth`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Andrju', 'Andrju@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$c1JLb2NaUHYzTkNyeFh5Lg$Nm5URZlq+yZFjH8HBwamFpECnzH4UmIqheQm3QwMowY', 'Andrzej', 'Deczko', '1988-07-23 00:00:00', 'admin', '2024-06-19 12:19:08', '2024-06-19 12:33:47'),
(2, 'Mateo', 'Mateo@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$cEVGdlBkeUlPMXViT2lxMQ$N7kCXpy6M7HXlix0CLlSSEK698xZZEWmMfVkFhQFF+k', 'Mateusz', 'Grucha', '2008-05-01 00:00:00', 'teacher', '2024-06-19 12:19:34', '2024-06-19 12:33:55'),
(3, 'Filipo', 'Filipo@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$ME9TMUN6cUZxUFlhdGZwTA$KV8yKgkxGRFjgTMWnfR0iMzunoOGOMiPGnCK1bVFcho', 'Filip', 'Morczyński', '2000-07-12 00:00:00', 'student', '2024-06-19 12:20:07', '2024-06-19 12:34:01'),
(4, 'Gregory', 'Gregory@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YXZVRkJRbGhmZk1CekticA$TdO3xIq1eoR8ogq0CN2960r8npc8UywUPTEmZ84Z9w8', 'Grzegorz', 'Duszyński', '2005-12-17 00:00:00', 'student', '2024-06-19 12:20:48', '2024-06-19 12:34:07'),
(5, 'Orion', 'Orion@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$U1VPdWRKRlRXbzJNWUdQRw$17adTH84NZc0hN9zZP/qah0c4wLZG/+AMnSb2YCVe9U', 'Olaf', 'DiriDiri', '1980-04-21 00:00:00', 'teacher', '2024-06-19 12:21:21', '2024-06-19 12:21:21'),
(6, 'Kapaty', 'Kapaty@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NklmTlFZVUp0eHFMU3lucA$dELTV6g2E+ZwhdNr5u0VwNzmLNjnqeIh1b6CoNyxDjY', 'Kacper', 'Bednarek', '2004-06-09 00:00:00', 'student', '2024-06-19 12:21:49', '2024-06-19 12:21:49'),
(18, 'HopHope', 'hopehope@wp.pl', '$argon2id$v=19$m=65536,t=4,p=1$eUUwRDhkTWp1ZGp1L3VubA$P8MAt2+QaDWOkG1lmViUqmAWD5sdggXc+FOJ8gh/XNk', 'Hopus', 'Pokus', '1995-06-05 00:00:00', 'teacher', '2024-06-20 21:59:01', '2024-06-22 11:48:33'),
(19, 'Julkotronix', 'Julkotronix@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bExaZnlTMnlBckN0dWxlQw$iTYfo9vWUV71JH7TkFKbxGdRy5/bqB42Vj1VRQHNtCY', 'Julka', 'Kulka', '1990-02-20 00:00:00', 'student', '2024-06-22 09:38:26', '2024-06-22 14:02:07'),
(21, 'Margaryniarz', 'Margaryniarz@onet.pl', '$argon2id$v=19$m=65536,t=4,p=1$Tk1nT1FtM0NVU083Y2JhWA$heXy9VRgfRGSDP5Cb1Gd1UwQsIhlFATJ5vL70iciOZo', 'Marek', 'Marynarz', '2008-06-10 00:00:00', 'user', '2024-06-22 14:43:31', '2024-06-22 21:36:53');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`,`student_id`,`teacher_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indeksy dla tabeli `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indeksy dla tabeli `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `grades_ibfk_5` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `teachers_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
