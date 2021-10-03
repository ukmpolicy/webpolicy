-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Okt 2021 pada 12.54
-- Versi server: 5.7.24
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_webpolicy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hightlight` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'umum', '2021-10-03 04:10:40', '2021-10-03 04:10:40', NULL),
(2, 'hubungan masyarakat', '2021-10-03 04:10:49', '2021-10-03 04:10:49', NULL),
(3, 'pengembangan', '2021-10-03 04:10:54', '2021-10-03 04:10:54', NULL),
(4, 'kaderisasi', '2021-10-03 04:11:03', '2021-10-03 04:11:03', NULL),
(5, 'jaringan', '2021-10-03 04:11:09', '2021-10-03 04:11:09', NULL),
(6, 'pemrograman', '2021-10-03 04:11:14', '2021-10-03 04:11:14', NULL),
(7, 'multimedia', '2021-10-03 04:11:19', '2021-10-03 04:11:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeries`
--

CREATE TABLE `galeries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `highlights`
--

CREATE TABLE `highlights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` bigint(20) UNSIGNED DEFAULT NULL,
  `text_button` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_button` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mails`
--

CREATE TABLE `mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `born_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interested_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study_program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joined_at` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `profile_picture`, `name`, `nim`, `address`, `birth_place`, `born_at`, `phone_number`, `email`, `major`, `interested_in`, `study_program`, `joined_at`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'furqan siddiq', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:05:10', '2021-10-03 04:05:10'),
(2, NULL, 'muhammad imam gumilang', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:05:27', '2021-10-03 04:05:27'),
(3, NULL, 'annisa rizka aulia', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:05:52', '2021-10-03 04:05:52'),
(4, NULL, 'haris fakhrian', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:06:04', '2021-10-03 04:06:04'),
(5, NULL, 'dinda aulia thosi segara', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:06:19', '2021-10-03 04:06:19'),
(6, NULL, 'khairunnisa', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:06:30', '2021-10-03 04:06:30'),
(7, NULL, 'saiful kamil', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:06:42', '2021-10-03 04:06:42'),
(8, NULL, 'zulfahmi', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:06:49', '2021-10-03 04:06:49'),
(9, NULL, 'irwansyah', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-03 04:06:58', '2021-10-03 04:06:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2021_09_02_124022_create_members_table', 1),
(4, '2021_09_02_125140_create_divisions_table', 1),
(5, '2021_09_02_125207_create_sources_table', 1),
(6, '2021_09_02_125545_create_categories_table', 1),
(7, '2021_09_02_125843_create_officers_table', 1),
(8, '2021_09_02_130328_create_programs_table', 1),
(9, '2021_09_02_130552_create_articles_table', 1),
(10, '2021_09_02_130812_create_galeries_table', 1),
(11, '2021_10_02_092553_create_highlights_table', 1),
(12, '2021_10_02_094556_create_or_documents_table', 1),
(13, '2021_10_03_070307_create_mails_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `officers`
--

CREATE TABLE `officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` int(11) NOT NULL,
  `period_start_at` int(11) NOT NULL,
  `period_end_at` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `officers`
--

INSERT INTO `officers` (`id`, `member_id`, `division_id`, `role`, `period_start_at`, `period_end_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 2021, 2022, '2021-10-03 04:14:31', '2021-10-03 04:14:31'),
(2, 2, 1, 1, 2021, 2022, '2021-10-03 04:14:40', '2021-10-03 04:14:40'),
(3, 3, 1, 2, 2021, 2022, '2021-10-03 04:14:56', '2021-10-03 04:14:56'),
(4, 4, 2, 0, 2021, 2022, '2021-10-03 04:15:15', '2021-10-03 04:15:15'),
(5, 5, 3, 0, 2021, 2022, '2021-10-03 04:15:26', '2021-10-03 04:15:26'),
(6, 6, 4, 0, 2021, 2022, '2021-10-03 04:15:34', '2021-10-03 04:15:34'),
(7, 7, 5, 0, 2021, 2022, '2021-10-03 04:15:51', '2021-10-03 04:15:51'),
(8, 8, 6, 0, 2021, 2022, '2021-10-03 04:16:01', '2021-10-03 04:16:01'),
(9, 9, 7, 0, 2021, 2022, '2021-10-03 04:16:07', '2021-10-03 04:38:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `or_documents`
--

CREATE TABLE `or_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `certificate` bigint(20) UNSIGNED DEFAULT NULL,
  `proof_pkkmb` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `or_documents`
--

INSERT INTO `or_documents` (`id`, `member_id`, `certificate`, `proof_pkkmb`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 5, 4, NULL, '2021-10-03 05:10:44', '2021-10-03 05:10:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `start_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sources`
--

CREATE TABLE `sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sources`
--

INSERT INTO `sources` (`id`, `path`, `author_id`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'uploads/library/163325904680373.jpg', NULL, 0, 'IMG-20210714-WA0006.jpg', '2021-10-03 04:04:06', '2021-10-03 04:04:06'),
(2, 'uploads/library/163326293261776.jpg', NULL, 0, 'Photo 4x6.jpg', '2021-10-03 05:08:52', '2021-10-03 05:08:52'),
(3, 'uploads/library/163326294554920.jpg', NULL, 0, 'Piagam - 0003.jpg', '2021-10-03 05:09:05', '2021-10-03 05:09:05'),
(4, 'uploads/library/16332629737585.jpg', NULL, 0, 'Mahasiswa.jpg', '2021-10-03 05:09:33', '2021-10-03 05:09:33'),
(5, 'uploads/library/163326298917464.jpg', NULL, 0, 'Piagam - 0003.jpg', '2021-10-03 05:09:49', '2021-10-03 05:09:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'pemrograman', '$2y$10$Sw..62UkeAcBOSdBVX2cY.pCrt6H5vecTVZ2HW8lsfvuIdayT4.C2', 3, '2021-10-01 07:32:14', '2021-10-01 07:32:14'),
(2, 'kaderisasi', '$2y$10$4Z94g30OQhQse50CdhVBW.2G0RS1hxHN/GsK7sM1se0Ee.Z0OdJhG', 2, '2021-10-03 04:04:33', '2021-10-03 04:04:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_creator_id_foreign` (`creator_id`),
  ADD KEY `articles_thumbnail_foreign` (`thumbnail`),
  ADD KEY `articles_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeries`
--
ALTER TABLE `galeries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeries_source_id_foreign` (`source_id`),
  ADD KEY `galeries_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `highlights`
--
ALTER TABLE `highlights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `highlights_thumbnail_foreign` (`thumbnail`);

--
-- Indeks untuk tabel `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `officers_member_id_foreign` (`member_id`),
  ADD KEY `officers_division_id_foreign` (`division_id`);

--
-- Indeks untuk tabel `or_documents`
--
ALTER TABLE `or_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `or_documents_member_id_foreign` (`member_id`),
  ADD KEY `or_documents_certificate_foreign` (`certificate`),
  ADD KEY `or_documents_proof_pkkmb_foreign` (`proof_pkkmb`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_division_id_foreign` (`division_id`);

--
-- Indeks untuk tabel `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sources_author_id_foreign` (`author_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `galeries`
--
ALTER TABLE `galeries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `highlights`
--
ALTER TABLE `highlights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mails`
--
ALTER TABLE `mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `officers`
--
ALTER TABLE `officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `or_documents`
--
ALTER TABLE `or_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sources`
--
ALTER TABLE `sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `articles_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `articles_thumbnail_foreign` FOREIGN KEY (`thumbnail`) REFERENCES `sources` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `galeries`
--
ALTER TABLE `galeries`
  ADD CONSTRAINT `galeries_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `galeries_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `sources` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `highlights`
--
ALTER TABLE `highlights`
  ADD CONSTRAINT `highlights_thumbnail_foreign` FOREIGN KEY (`thumbnail`) REFERENCES `sources` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `officers`
--
ALTER TABLE `officers`
  ADD CONSTRAINT `officers_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `officers_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `or_documents`
--
ALTER TABLE `or_documents`
  ADD CONSTRAINT `or_documents_certificate_foreign` FOREIGN KEY (`certificate`) REFERENCES `sources` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `or_documents_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `or_documents_proof_pkkmb_foreign` FOREIGN KEY (`proof_pkkmb`) REFERENCES `sources` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`);

--
-- Ketidakleluasaan untuk tabel `sources`
--
ALTER TABLE `sources`
  ADD CONSTRAINT `sources_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
