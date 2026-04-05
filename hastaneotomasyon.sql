-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: mysql
-- Üretim Zamanı: 05 Nis 2026, 11:48:27
-- Sunucu sürümü: 8.3.0
-- PHP Sürümü: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hastaneotomasyon`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `appointment`
--

CREATE TABLE `appointment` (
  `id` int NOT NULL,
  `doctor` int NOT NULL,
  `patient` int NOT NULL,
  `timeslot` datetime NOT NULL,
  `status` tinyint NOT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `appointment`
--

INSERT INTO `appointment` (`id`, `doctor`, `patient`, `timeslot`, `status`, `createdtime`) VALUES
(1, 1, 1, '2026-01-23 16:00:00', 1, '2026-01-21 06:13:13'),
(2, 1, 2, '2026-01-23 14:00:00', 1, '2026-01-21 06:19:47'),
(3, 2, 3, '2026-01-26 11:00:00', 1, '2026-01-21 06:29:47'),
(4, 1, 4, '2026-01-23 11:00:00', 1, '2026-01-21 08:58:13'),
(5, 2, 5, '2026-01-26 12:00:00', 1, '2026-01-21 09:01:26'),
(6, 1, 3, '2026-01-26 10:00:00', 1, '2026-01-21 10:41:38'),
(7, 2, 6, '2026-01-22 12:00:00', 1, '2026-01-21 10:57:34'),
(8, 1, 2, '2026-01-29 11:00:00', 1, '2026-01-27 22:37:45'),
(9, 2, 8, '2026-01-29 11:00:00', 1, '2026-01-27 22:46:14'),
(10, 4, 3, '2026-03-17 10:00:00', 1, '2026-03-15 23:28:07'),
(12, 4, 3, '2026-03-30 14:00:00', 1, '2026-03-28 11:13:34');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doctor`
--

CREATE TABLE `doctor` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'default.png',
  `specialization` int NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profilephoto` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `image`, `specialization`, `description`, `phone`, `profilephoto`, `status`, `createdtime`) VALUES
(1, 'Ahmet Yılmaz', 'dr_1_1773697721.jpg', 1, '', NULL, NULL, 1, '2026-03-16 20:31:26'),
(2, 'Ayşe Kaya', 'dr_2_1775389317.jpg', 2, '', '', NULL, 1, '2026-03-16 20:31:26'),
(3, 'Mehmet Demir', 'dr_3_1773697917.jpg', 3, '', NULL, NULL, 0, '2026-03-16 20:31:26'),
(4, 'Canan Aydın', 'dr_4_1775389187.jpg', 4, '', '', NULL, 0, '2026-03-16 20:31:26'),
(5, 'Ferman Eryiğit', 'dr_5_1775389127.jpg', 3, 'EğitimTrakya Üniversitesi Tıp FakültesiÇalıştığı Kurumlar Sinop Atatürk Devlet HastanesiEdirne Özel Ekol Hastanesi', '05338679010', NULL, 0, '2026-03-16 20:31:26'),
(6, 'Ali Vefa', 'dr_6_1773703097.jpg', 5, ' Eğitim: Ege Üniversitesi Tıp Fakültesi. Çalıştığı Kurumlar Berhayat Hastanesi', '053688910', 'doc_6_1773695164.jpg', 1, '2026-03-16 20:31:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthyear` int NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `relative` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `history` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `patient`
--

INSERT INTO `patient` (`id`, `name`, `email`, `password`, `phone`, `birthyear`, `address`, `relative`, `history`, `createdtime`) VALUES
(1, 'Dilfuza Karimova', 'dilfuza@karimova.com', '12345', '1234567', 2000, 'Girne', 'Malahat Karimova', NULL, '2026-01-21 06:11:12'),
(2, 'dilfuza', 'dilfuzakarimova0@gmail.com', '123456', '2324234', 1997, 'lefkoşa', 'bahram', NULL, '2026-01-21 06:18:28'),
(3, 'Bahram', '20222421@std.neu.edu.tr', '12345', '2131424', 1971, 'Girne', 'Malahat', NULL, '2026-01-21 06:25:26'),
(4, 'dilfuza', 'karimova13@gmail.com', '1234', '05338755001', 2001, 'Mağusa', 'Ahmet', NULL, '2026-01-21 08:57:38'),
(5, 'Zöhre', 'Zöhresertaş15@gmail.com', '12345', '05338775654', 1996, 'Lefkoşa', 'Mehmet', NULL, '2026-01-21 09:01:00'),
(6, 'İlgi', 'savasilgi67@gmail.com', '1234', '0533', 1974, 'Lefkoşa', 'Ayşe', NULL, '2026-01-21 10:55:37'),
(7, 'Tohtayeva', 'medina13@gmail.com', '123456', '05338764543', 2001, 'Lefkoşa Gönyeli', 'Şahnoza', NULL, '2026-01-27 22:34:33'),
(8, 'Turan', 'ayşe@10gmail.com', '123456', '05428769009', 2003, 'Girne Alsancak', 'Mehmet', NULL, '2026-01-27 22:44:07'),
(9, 'dilduza', 'thunderbloom13', '123456', '0564675476', 1900, 'xfgbxcbcxb', 'cbbbxbx', NULL, '2026-03-13 08:03:40'),
(10, 'Dilfuza', '20222421@Sstd.neu.edu.tr', '12345', '05676888', 2004, 'gİRNE', 'BEN', NULL, '2026-03-15 17:54:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `requests`
--

CREATE TABLE `requests` (
  `id` int NOT NULL,
  `doctor` int NOT NULL,
  `patient` int NOT NULL,
  `story` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `requests`
--

INSERT INTO `requests` (`id`, `doctor`, `patient`, `story`, `status`, `createdtime`) VALUES
(1, 2, 3, 'vizemiz yok', 0, '2026-03-17 19:20:33'),
(2, 2, 3, 'vizemiz yok', 0, '2026-03-17 19:20:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `specialization`
--

CREATE TABLE `specialization` (
  `id` int NOT NULL,
  `specialization` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `specialization`
--

INSERT INTO `specialization` (`id`, `specialization`, `description`, `status`, `createdtime`) VALUES
(1, 'KBB', NULL, 1, '2026-03-16 20:31:26'),
(2, 'Kadın Hastalıkları ve Doğum', NULL, 1, '2026-03-16 20:31:26'),
(3, 'Genel Cerrahi', NULL, 1, '2026-03-16 20:31:26'),
(4, 'Beyin Cerrahi', NULL, 1, '2026-03-16 20:31:26'),
(5, 'Kardiyoloji', NULL, 1, '2026-03-16 20:31:26'),
(6, 'Acil Tıp', NULL, 1, '2026-03-16 20:31:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `timeslot`
--

CREATE TABLE `timeslot` (
  `id` bigint NOT NULL,
  `doctor` int NOT NULL,
  `timeslot` datetime NOT NULL,
  `status` tinyint NOT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `timeslot`
--

INSERT INTO `timeslot` (`id`, `doctor`, `timeslot`, `status`, `createdtime`) VALUES
(1, 1, '2026-03-17 09:00:00', 1, '2026-03-16 20:32:27'),
(2, 1, '2026-03-17 10:00:00', 1, '2026-03-16 20:32:27'),
(3, 1, '2026-03-17 11:00:00', 1, '2026-03-16 20:32:27'),
(4, 2, '2026-03-17 09:00:00', 1, '2026-03-16 20:32:27'),
(5, 2, '2026-03-17 10:00:00', 1, '2026-03-16 20:32:27'),
(6, 2, '2026-03-17 11:00:00', 1, '2026-03-16 20:32:27'),
(7, 3, '2026-03-17 09:00:00', 1, '2026-03-16 20:32:27'),
(8, 3, '2026-03-17 10:00:00', 1, '2026-03-16 20:32:27'),
(9, 3, '2026-03-17 11:00:00', 1, '2026-03-16 20:32:27'),
(10, 4, '2026-03-17 09:00:00', 1, '2026-03-16 20:32:27'),
(11, 4, '2026-03-17 10:00:00', 1, '2026-03-16 20:32:27'),
(12, 4, '2026-03-17 11:00:00', 1, '2026-03-16 20:32:27'),
(13, 5, '2026-03-17 09:00:00', 2, '2026-03-16 20:32:27'),
(14, 5, '2026-03-17 10:00:00', 2, '2026-03-16 20:32:27'),
(15, 5, '2026-03-17 11:00:00', 1, '2026-03-16 20:32:27'),
(16, 6, '2026-03-17 09:00:00', 1, '2026-03-16 20:32:27'),
(17, 6, '2026-03-17 10:00:00', 1, '2026-03-16 20:32:27'),
(18, 6, '2026-03-17 11:00:00', 1, '2026-03-16 20:32:27'),
(19, 1, '2026-03-25 12:00:00', 1, '2026-03-18 11:56:42'),
(20, 1, '2026-03-23 15:00:00', 1, '2026-03-18 11:56:44'),
(21, 4, '2026-03-29 11:00:00', 0, '2026-03-28 11:11:28'),
(22, 4, '2026-03-30 11:00:00', 1, '2026-03-28 11:13:00'),
(23, 4, '2026-03-30 12:00:00', 1, '2026-03-28 11:13:15'),
(24, 4, '2026-03-30 14:00:00', 2, '2026-03-28 11:13:16'),
(25, 4, '2026-03-30 15:00:00', 1, '2026-03-28 11:13:16'),
(26, 4, '2026-03-30 16:00:00', 1, '2026-03-28 11:13:17'),
(27, 4, '2026-03-30 10:00:00', 1, '2026-03-28 11:13:20'),
(28, 4, '2026-03-31 10:00:00', 1, '2026-03-28 11:15:51'),
(29, 4, '2026-04-01 10:00:00', 1, '2026-03-28 11:16:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `status`, `createdtime`) VALUES
(1, 'Admin', 'admin', '12345', 1, '2026-01-21 06:06:19'),
(2, 'Dilfuza Karimova', 'dilfuza', '12345', 1, '2026-01-21 06:06:19');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctor` (`doctor`,`timeslot`),
  ADD UNIQUE KEY `patient` (`patient`,`timeslot`);

--
-- Tablo için indeksler `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Tablo için indeksler `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `specialization` (`specialization`);

--
-- Tablo için indeksler `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctor` (`doctor`,`timeslot`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `specialization`
--
ALTER TABLE `specialization`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
