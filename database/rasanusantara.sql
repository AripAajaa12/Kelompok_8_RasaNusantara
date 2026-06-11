-- ============================================================
-- RasaNusantara - Database SQL untuk phpMyAdmin
-- Laravel 12 | PHP 8.2+
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS `rasanusantara` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `rasanusantara`;

-- ============================================================
-- Tabel: users
-- ============================================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`name`, `email`, `role`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
('Admin RasaNusantara', 'admin@rasanusantara.id', 'admin', NOW(), '$2y$12$PtUm0I6Dp0B7aOIPl4C7TudmEf2eZJ3m3vQN/g1HLsABX9kYsFuOu', NOW(), NOW()),
('Budi Santoso', 'budi@example.com', 'user', NOW(), '$2y$12$PtUm0I6Dp0B7aOIPl4C7TudmEf2eZJ3m3vQN/g1HLsABX9kYsFuOu', NOW(), NOW()),
('Siti Rahayu', 'siti@example.com', 'user', NOW(), '$2y$12$PtUm0I6Dp0B7aOIPl4C7TudmEf2eZJ3m3vQN/g1HLsABX9kYsFuOu', NOW(), NOW()),
('Dewi Lestari', 'dewi@example.com', 'user', NOW(), '$2y$12$PtUm0I6Dp0B7aOIPl4C7TudmEf2eZJ3m3vQN/g1HLsABX9kYsFuOu', NOW(), NOW());
-- Password semua akun: password

-- ============================================================
-- Tabel: kategoris
-- ============================================================
CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategoris_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kategoris` (`nama`, `slug`, `icon`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
('Jawa', 'jawa', '🏛️', 'Masakan khas Jawa dengan cita rasa manis dan gurih', '/images/cat/jawa.jpg', NOW(), NOW()),
('Padang', 'padang', '🌶️', 'Masakan Minang dengan bumbu rempah kaya dan pedas', '/images/cat/padang.jpg', NOW(), NOW()),
('Bali', 'bali', '🌺', 'Masakan Bali dengan aroma rempah khas dan segar', '/images/cat/bali.jpg', NOW(), NOW()),
('Sulawesi', 'sulawesi', '🐟', 'Masakan Sulawesi dengan dominasi seafood dan rempah', NULL, NOW(), NOW()),
('Kalimantan', 'kalimantan', '🌿', 'Masakan Kalimantan dengan bahan-bahan alam khas hutan tropis', NULL, NOW(), NOW()),
('Sumatera', 'sumatera', '🥘', 'Masakan Sumatera dengan bumbu kuat dan kaya rempah', NULL, NOW(), NOW());

-- ============================================================
-- Tabel: reseps
-- ============================================================
CREATE TABLE IF NOT EXISTS `reseps` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `judul` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `bahan` json DEFAULT NULL,
  `langkah` json DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `asal_daerah` varchar(100) DEFAULT NULL,
  `waktu_memasak` int(11) DEFAULT NULL,
  `porsi` int(11) DEFAULT NULL,
  `tingkat_kesulitan` enum('mudah','sedang','sulit') NOT NULL DEFAULT 'sedang',
  `views` int(11) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reseps_slug_unique` (`slug`),
  KEY `reseps_kategori_id_foreign` (`kategori_id`),
  KEY `reseps_user_id_foreign` (`user_id`),
  CONSTRAINT `reseps_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reseps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reseps` (`kategori_id`,`user_id`,`judul`,`slug`,`deskripsi`,`bahan`,`langkah`,`gambar`,`asal_daerah`,`waktu_memasak`,`porsi`,`tingkat_kesulitan`,`views`,`published`,`created_at`,`updated_at`) VALUES
(2,1,'Rendang Daging Sapi','rendang-daging-sapi','Rendang adalah masakan daging sapi yang dimasak perlahan dengan santan dan rempah hingga kering dan berwarna coklat kehitaman. Merupakan salah satu masakan terlezat di dunia.','["1 kg daging sapi","500 ml santan kental","5 lembar daun jeruk","3 batang serai","2 cm lengkuas","10 cabai merah keriting","8 bawang merah","5 bawang putih","2 cm jahe","1 sdt kunyit","garam secukupnya"]','["Haluskan bumbu: cabai, bawang merah, bawang putih, jahe, kunyit.","Tumis bumbu halus hingga harum bersama serai, lengkuas, daun jeruk.","Masukkan daging sapi, aduk rata.","Tuangkan santan kental, masak dengan api sedang sambil terus diaduk.","Masak hingga santan meresap dan daging berwarna coklat kehitaman, sekitar 2-3 jam.","Koreksi rasa, angkat dan sajikan."]','/images/menu/rendang.jpg','Padang, Sumatera Barat',180,6,'sulit',245,1,NOW(),NOW()),
(1,1,'Nasi Goreng Spesial','nasi-goreng-spesial','Nasi goreng adalah masakan nasi yang digoreng dan diaduk dalam minyak goreng panas, biasanya dengan bumbu kecap manis, bawang putih, dan kecap asin.','["2 piring nasi putih","2 butir telur","3 siung bawang putih","5 bawang merah","2 sdm kecap manis","1 sdm saus tiram","cabai sesuai selera","garam dan merica","minyak goreng"]','["Haluskan bawang merah, bawang putih, dan cabai.","Tumis bumbu halus hingga harum.","Masukkan telur, orak-arik.","Masukkan nasi, aduk rata.","Bumbui dengan kecap manis, saus tiram, garam, dan merica.","Aduk rata, masak hingga nasi sedikit kering.","Sajikan dengan pelengkap."]','/images/menu/nasi_goreng.jpg','Jakarta, DKI Jakarta',20,2,'mudah',310,1,NOW(),NOW()),
(1,1,'Soto Ayam Lamongan','soto-ayam-lamongan','Soto ayam khas Lamongan dengan kuah bening kekuningan yang segar, dilengkapi suwiran ayam, telur, dan lontong.','["1 ekor ayam kampung","8 bawang merah","5 bawang putih","2 cm kunyit","2 cm jahe","2 batang serai","3 lembar daun salam","4 lembar daun jeruk","2 liter air","garam dan penyedap"]','["Rebus ayam hingga empuk, angkat dan suwir daging.","Tumis bumbu halus hingga harum.","Masukkan bumbu ke kaldu ayam.","Tambahkan serai, daun salam, daun jeruk.","Masak hingga mendidih, koreksi rasa.","Sajikan dengan suwiran ayam, telur, dan pelengkap."]','/images/menu/soto.jpg','Lamongan, Jawa Timur',60,4,'sedang',189,1,NOW(),NOW()),
(3,1,'Ayam Betutu Bali','ayam-betutu-bali','Ayam betutu adalah masakan khas Bali berupa ayam utuh yang dibumbui dengan base genep (bumbu lengkap) khas Bali kemudian dipanggang atau dikukus.','["1 ekor ayam utuh","10 cabai merah","8 bawang merah","6 bawang putih","3 cm kunyit","2 cm jahe","2 cm kencur","1 cm lengkuas","5 kemiri","daun salam","serai"]','["Haluskan semua bumbu base genep.","Lumuri ayam dengan bumbu, masukkan juga ke dalam rongga ayam.","Diamkan minimal 2 jam agar bumbu meresap.","Bungkus ayam dengan daun pisang.","Panggang atau kukus selama 3-4 jam hingga matang.","Sajikan dengan nasi dan sambal matah."]','/images/menu/ayam_betutu.jpg','Gianyar, Bali',240,4,'sulit',156,1,NOW(),NOW()),
(1,1,'Gado-Gado Jakarta','gado-gado-jakarta','Gado-gado adalah salad Indonesia dengan berbagai macam sayuran rebus, tahu, tempe, dan telur yang disiram saus kacang yang khas.','["2 ikat kangkung","1 buah tahu","1 papan tempe","2 butir telur","100g tauge","1 buah timun","150g kacang tanah","5 cabai merah","3 bawang putih","2 sdm gula merah","garam dan air jeruk limau"]','["Rebus sayuran, tahu, tempe, dan telur masing-masing.","Goreng kacang tanah hingga keemasan, haluskan.","Tumis cabai dan bawang putih, haluskan bersama kacang.","Tambahkan gula merah, garam, dan air jeruk, masak kental.","Tata semua bahan di piring.","Siram dengan saus kacang."]','/images/menu/gado_gado.jpg','Jakarta, DKI Jakarta',30,4,'mudah',134,1,NOW(),NOW()),
(1,1,'Sate Ayam Madura','sate-ayam-madura','Sate ayam khas Madura dengan bumbu kacang manis gurih yang kental dan lontong hangat.','["500g daging ayam","50 tusuk sate","150g kacang tanah","5 bawang merah","3 bawang putih","5 cabai merah","2 sdm kecap manis","gula merah","air jeruk limau","garam"]','["Potong daging ayam dadu kecil, tusuk ke tusukan sate.","Bumuri dengan bumbu dasar, marinasi 30 menit.","Bakar sate di atas bara api sambil dikipas.","Haluskan kacang, tumis dengan bumbu.","Tambahkan kecap manis dan air, masak kental.","Sajikan sate dengan bumbu kacang dan lontong."]','/images/menu/sate.jpg','Madura, Jawa Timur',45,4,'sedang',198,1,NOW(),NOW()),
(6,1,'Rawon Surabaya','rawon-surabaya','Rawon adalah sup daging khas Surabaya dengan kuah hitam dari kluwek yang kaya rempah dan berasa dalam.','["500g daging sandung lamur","4 buah kluwek","8 bawang merah","5 bawang putih","3 cm lengkuas","2 batang serai","4 lembar daun jeruk","2 cm kunyit","1 sdt ketumbar","garam dan merica"]','["Rebus daging hingga empuk, potong dadu.","Sangrai dan haluskan kluwek bersama bumbu lainnya.","Tumis bumbu halus hingga harum.","Masukkan bumbu ke kaldu daging.","Masak hingga mendidih dan kuah berubah gelap.","Koreksi rasa, sajikan dengan tauge dan telur asin."]','/images/menu/rawon.jpg','Surabaya, Jawa Timur',90,4,'sedang',167,1,NOW(),NOW()),
(1,1,'Bakso Malang','bakso-malang','Bakso Malang adalah mi bakso khas dengan kuah bening segar, bakso kenyal, dan berbagai pelengkap.','["500g daging sapi giling","100g tepung tapioka","2 putih telur","5 siung bawang putih","1 sdt merica","garam","1 liter kaldu sapi"]','["Haluskan bawang putih dan merica.","Campurkan daging giling dengan tepung, putih telur, dan bumbu.","Bentuk adonan menjadi bulatan-bulatan.","Rebus dalam air mendidih hingga mengapung.","Buat kuah dari kaldu sapi dengan bumbu.","Sajikan bakso dengan mie, kuah, dan pelengkap."]','/images/menu/bakso.jpg','Malang, Jawa Timur',60,6,'sedang',211,1,NOW(),NOW());

-- ============================================================
-- Tabel: ratings
-- ============================================================
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `resep_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` tinyint(3) UNSIGNED NOT NULL,
  `komentar` text DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ratings_user_resep_unique` (`user_id`,`resep_id`),
  KEY `ratings_resep_id_foreign` (`resep_id`),
  CONSTRAINT `ratings_resep_id_foreign` FOREIGN KEY (`resep_id`) REFERENCES `reseps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ratings` (`user_id`,`resep_id`,`nilai`,`komentar`,`approved`,`created_at`,`updated_at`) VALUES
(2,1,5,'Rendang terbaik! Sudah saya coba dan hasilnya luar biasa. Bumbu meresap sempurna.',1,NOW(),NOW()),
(3,1,5,'Resep yang sangat detail dan mudah diikuti. Rendangnya enak sekali!',1,NOW(),NOW()),
(2,2,4,'Nasi goreng simple tapi enak. Cocok untuk sarapan praktis.',1,NOW(),NOW()),
(3,3,5,'Soto Lamongan favoritku! Resepnya persis seperti yang dijual di warung.',1,NOW(),NOW()),
(2,4,4,'Ayam betutu yang autentik. Perlu kesabaran tapi hasilnya worth it.',1,NOW(),NOW()),
(4,5,5,'Gado-gado paling enak! Sausnya pas sekali.',1,NOW(),NOW()),
(3,6,5,'Sate Maduranya juara! Bumbu kacangnya bikin nagih.',1,NOW(),NOW()),
(4,7,4,'Rawon pertama saya berhasil! Terima kasih resepnya.',1,NOW(),NOW()),
(2,8,5,'Bakso Malang enak, kenyal dan segar kuahnya.',1,NOW(),NOW());

-- ============================================================
-- Tabel: favorit_reseps_new
-- ============================================================
CREATE TABLE IF NOT EXISTS `favorit_reseps_new` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `resep_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favorit_user_resep_unique` (`user_id`,`resep_id`),
  KEY `favorit_resep_id_foreign` (`resep_id`),
  CONSTRAINT `favorit_resep_id_foreign` FOREIGN KEY (`resep_id`) REFERENCES `reseps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorit_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `favorit_reseps_new` (`user_id`,`resep_id`,`created_at`,`updated_at`) VALUES
(2,1,NOW(),NOW()),(2,2,NOW(),NOW()),(2,6,NOW(),NOW()),
(3,1,NOW(),NOW()),(3,3,NOW(),NOW()),(3,7,NOW(),NOW()),
(4,4,NOW(),NOW()),(4,5,NOW(),NOW());

-- ============================================================
-- Tabel: cache, cache_locks, jobs, job_batches, failed_jobs
-- (diperlukan Laravel)
-- ============================================================
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;

-- ============================================================
-- PETUNJUK PENGGUNAAN
-- ============================================================
-- 1. Buka phpMyAdmin
-- 2. Buat database baru bernama: rasanusantara
-- 3. Import file SQL ini (Import > Browse file)
-- 4. Update file .env Laravel:
--    DB_DATABASE=rasanusantara
--    DB_USERNAME=root  (atau username phpMyAdmin Anda)
--    DB_PASSWORD=      (password Anda)
-- 5. Jalankan: php artisan key:generate
-- 6. Akses: http://localhost/rasanusantara/public
--
-- AKUN LOGIN:
--   Admin : admin@rasanusantara.id  | password: password
--   User 1: budi@example.com        | password: password
--   User 2: siti@example.com        | password: password
-- ============================================================
