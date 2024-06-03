-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 03 2024 г., 10:26
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tz_dsbt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attachmentable`
--

CREATE TABLE `attachmentable` (
  `id` int(10) UNSIGNED NOT NULL,
  `attachmentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachmentable_id` int(10) UNSIGNED NOT NULL,
  `attachment_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attachments`
--

INSERT INTO `attachments` (`id`, `name`, `original_name`, `mime`, `extension`, `size`, `sort`, `path`, `description`, `alt`, `hash`, `disk`, `user_id`, `group`, `created_at`, `updated_at`) VALUES
(1, '0c1c88e0c2cb08fbf4112b9c445beada8e5a43fb', 'blob', 'image/png', 'png', 140235, 0, '2024/01/15/', NULL, NULL, '8c9ced0451be8d71442e3fbe60c9c4fc1e12244b', 'local', 2, NULL, '2024-01-15 10:35:49', '2024-01-15 10:35:49'),
(2, '13b4f5ea5617c8e75886eded0a7ee04975ba761c', 'Фото - Мисюра А.png', 'image/png', 'png', 1552457, 0, '2024/01/15/', NULL, NULL, '1ba07ae668221cc205d7b79e85aab09aa0b2713c', 'local', 2, NULL, '2024-01-15 10:36:07', '2024-01-15 10:36:07');

-- --------------------------------------------------------

--
-- Структура таблицы `cpcn_lang`
--

CREATE TABLE `cpcn_lang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cpcn_lang`
--

INSERT INTO `cpcn_lang` (`id`, `code`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'ua', 'Українська', 1, '2023-09-08 11:18:51', '2023-09-08 11:18:51'),
(4, 'en', 'English', 1, '2024-05-30 23:51:05', '2024-05-31 05:59:44');

-- --------------------------------------------------------

--
-- Структура таблицы `cpcn_tables`
--

CREATE TABLE `cpcn_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localization` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'json. lang location - name, description.' CHECK (json_valid(`localization`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cpcn_tables`
--

INSERT INTO `cpcn_tables` (`id`, `name`, `localization`, `created_at`, `updated_at`) VALUES
(8, 'structural_unit', '{\"name\":{\"ua\":\"\\u0421\\u0442\\u0440\\u0443\\u043a\\u0442\\u0443\\u0440\\u043d\\u0438\\u0439 \\u043f\\u0456\\u0434\\u0440\\u043e\\u0437\\u0434\\u0456\\u043b\",\"en\":\"Structural unit\"},\"description\":{\"ua\":\"\\u0421\\u0442\\u0440\\u0443\\u043a\\u0442\\u0443\\u0440\\u043d\\u0438\\u0439 \\u043f\\u0456\\u0434\\u0440\\u043e\\u0437\\u0434\\u0456\\u043b\",\"en\":\"Structural unit\"}}', '2024-05-31 00:25:44', '2024-05-31 00:25:44'),
(9, 'equipment_type', '{\"name\":{\"ua\":\"\\u0422\\u0438\\u043f \\u043e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"Type of equipment\"},\"description\":{\"ua\":\"\\u0422\\u0438\\u043f \\u043e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"Type of equipment\"}}', '2024-05-31 01:00:53', '2024-05-31 01:00:53'),
(11, 'equipment_list', '{\"name\":{\"ua\":\"\\u041f\\u0435\\u0440\\u0435\\u043b\\u0456\\u043a \\u043e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"List of equipment\"},\"description\":{\"ua\":\"\\u041f\\u0435\\u0440\\u0435\\u043b\\u0456\\u043a \\u043e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"List of equipment\"}}', '2024-05-31 01:46:11', '2024-05-31 01:46:11'),
(12, 'job_title', '{\"name\":{\"ua\":\"\\u041f\\u043e\\u0441\\u0430\\u0434\\u0438\",\"en\":\"Job titles\"},\"description\":{\"ua\":\"\\u041f\\u0435\\u0440\\u0435\\u043b\\u0456\\u043a \\u043f\\u043e\\u0441\\u0430\\u0434\",\"en\":\"Job title list\"}}', '2024-05-31 03:13:44', '2024-05-31 03:13:44'),
(14, 'employee', '{\"name\":{\"ua\":\"\\u0421\\u043f\\u0456\\u0432\\u0440\\u043e\\u0431\\u0456\\u0442\\u043d\\u0438\\u043a\\u0438\",\"en\":\"Employees\"},\"description\":{\"ua\":\"\\u0421\\u043f\\u0456\\u0432\\u0440\\u043e\\u0431\\u0456\\u0442\\u043d\\u0438\\u043a\\u0438\",\"en\":\"Employees\"}}', '2024-05-31 03:46:27', '2024-05-31 03:46:27'),
(15, 'register_events', '{\"name\":{\"ua\":\"\\u0420\\u0435\\u0454\\u0441\\u0442\\u0440 \\u043f\\u043e\\u0434\\u0456\\u0439\",\"en\":\"Register of events\"},\"description\":{\"ua\":\"\\u0420\\u0435\\u0454\\u0441\\u0442\\u0440 \\u043f\\u043e\\u0434\\u0456\\u0439\",\"en\":\"Register of events\"}}', '2024-05-31 06:52:38', '2024-05-31 06:52:38');

-- --------------------------------------------------------

--
-- Структура таблицы `cpcn_table_fields`
--

CREATE TABLE `cpcn_table_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localization` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'json. Lang localization. (name, description...)' CHECK (json_valid(`localization`)),
  `type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'XML. Type field, display format. (str, int, another table...)',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cpcn_table_fields`
--

INSERT INTO `cpcn_table_fields` (`id`, `table_id`, `name`, `localization`, `type`, `created_at`, `updated_at`) VALUES
(45, 8, 'name', '{\"name\":{\"ua\":\"\\u041d\\u0430\\u0437\\u0432\\u0430 \\u043f\\u0456\\u0434\\u0440\\u043e\\u0437\\u0434\\u0456\\u043b\\u0443\",\"en\":\"Name\"},\"description\":{\"ua\":\"\\u041d\\u0430\\u0437\\u0432\\u0430 \\u043f\\u0456\\u0434\\u0440\\u043e\\u0437\\u0434\\u0456\\u043b\\u0456\\u0432 \\u043f\\u043e \\u043e\\u0431\\u043b\\u0430\\u0441\\u0442\\u044f\\u043c\",\"en\":\"Name unit\"}}', '{\"displayFormat\":\"text\",\"dataListTable\":\"0\",\"nullable\":\"0\"}', '2024-05-31 00:26:50', '2024-05-31 00:26:50'),
(46, 9, 'name', '{\"name\":{\"ua\":\"\\u041d\\u0430\\u0437\\u0432\\u0430 \\u043e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"Type of equipment\"},\"description\":{\"ua\":\"\\u041d\\u0430\\u0437\\u0432\\u0430 \\u043e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"Type of equipment\"}}', '{\"displayFormat\":\"text\",\"dataListTable\":\"0\",\"nullable\":\"0\"}', '2024-05-31 01:04:14', '2024-05-31 01:04:14'),
(51, 11, 'equipment_type_id', '{\"name\":{\"ua\":\"\\u041d\\u0430\\u0437\\u0432\\u0430 \\u043e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"Name\"},\"description\":{\"ua\":\"\\u041d\\u0430\\u0437\\u0432\\u0430 \\u043e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"name\"}}', '{\"displayFormat\":\"datalist_One\",\"dataListTable\":\"equipment_type\",\"nullable\":\"0\"}', '2024-05-31 02:43:04', '2024-05-31 02:43:04'),
(52, 11, 'serial_number', '{\"name\":{\"ua\":\"\\u0421\\u0435\\u0440\\u0456\\u0439\\u043d\\u0438\\u0439 \\u043d\\u043e\\u043c\\u0435\\u0440\",\"en\":\"Serial number\"},\"description\":{\"ua\":\"\\u0421\\u0435\\u0440\\u0456\\u0439\\u043d\\u0438\\u0439 \\u043d\\u043e\\u043c\\u0435\\u0440\",\"en\":\"Serial number\"}}', '{\"displayFormat\":\"text\",\"dataListTable\":\"0\",\"nullable\":\"0\"}', '2024-05-31 02:44:35', '2024-05-31 02:44:35'),
(53, 11, 'inventory_number', '{\"name\":{\"ua\":\"\\u0406\\u043d\\u0432\\u0435\\u043d\\u0442\\u0430\\u0440\\u043d\\u0438\\u0439 \\u043d\\u043e\\u043c\\u0435\\u0440\",\"en\":\"Inventory number\"},\"description\":{\"ua\":\"\\u0406\\u043d\\u0432\\u0435\\u043d\\u0442\\u0430\\u0440\\u043d\\u0438\\u0439 \\u043d\\u043e\\u043c\\u0435\\u0440\",\"en\":\"Inventory number\"}}', '{\"displayFormat\":\"text\",\"dataListTable\":\"0\",\"nullable\":\"0\"}', '2024-05-31 02:47:24', '2024-05-31 02:47:24'),
(54, 12, 'name', '{\"name\":{\"ua\":\"\\u041f\\u043e\\u0441\\u0430\\u0434\\u0430\",\"en\":\"job title\"},\"description\":{\"ua\":\"\\u041f\\u043e\\u0441\\u0430\\u0434\\u0430\",\"en\":\"job title\"}}', '{\"displayFormat\":\"text\",\"dataListTable\":\"0\",\"nullable\":\"0\"}', '2024-05-31 03:14:42', '2024-05-31 03:14:42'),
(55, 14, 'structural_unit_id', '{\"name\":{\"ua\":\"\\u041f\\u0456\\u0434\\u0440\\u043e\\u0437\\u0434\\u0456\\u043b\",\"en\":\"Unit\"},\"description\":{\"ua\":\"\\u041f\\u0456\\u0434\\u0440\\u043e\\u0437\\u0434\\u0456\\u043b\",\"en\":\"Unit\"}}', '{\"displayFormat\":\"datalist_One\",\"dataListTable\":\"structural_unit\",\"nullable\":\"0\"}', '2024-05-31 03:47:43', '2024-05-31 03:47:43'),
(57, 14, 'job_title_id', '{\"name\":{\"ua\":\"\\u041f\\u043e\\u0441\\u0430\\u0434\\u0430\",\"en\":\"Job title\"},\"description\":{\"ua\":\"\\u041f\\u043e\\u0441\\u0430\\u0434\\u0430\",\"en\":\"Job title\"}}', '{\"displayFormat\":\"datalist_One\",\"dataListTable\":\"job_title\",\"nullable\":\"0\"}', '2024-05-31 05:57:55', '2024-05-31 05:57:55'),
(58, 14, 'name', '{\"name\":{\"ua\":\"\\u0424\\u0406\\u041e\",\"en\":\"Name\"},\"description\":{\"ua\":\"\\u0424\\u0406\\u041e\",\"en\":\"name\"}}', '{\"displayFormat\":\"text\",\"dataListTable\":\"0\",\"nullable\":\"0\"}', '2024-05-31 05:59:12', '2024-05-31 05:59:12'),
(59, 15, 'date', '{\"name\":{\"ua\":\"\\u0414\\u0430\\u0442\\u0430\",\"en\":\"Dtate\"},\"description\":{\"ua\":\"\\u0414\\u0430\\u0442\\u0430\",\"en\":\"Date\"}}', '{\"displayFormat\":\"date\",\"dataListTable\":\"0\",\"nullable\":\"0\"}', '2024-05-31 06:54:33', '2024-05-31 06:54:33'),
(60, 15, 'from', '{\"name\":{\"ua\":\"\\u041f\\u0435\\u0440\\u0435\\u0434\\u0430\\u0432\",\"en\":\"From\"},\"description\":{\"ua\":\"\\u041f\\u0435\\u0440\\u0435\\u0434\\u0430\\u0432\",\"en\":\"From\"}}', '{\"displayFormat\":\"datalist_One\",\"dataListTable\":\"employee\",\"nullable\":\"0\"}', '2024-05-31 06:56:32', '2024-05-31 06:56:32'),
(61, 15, 'accepted', '{\"name\":{\"ua\":\"\\u041f\\u0440\\u0438\\u0439\\u043d\\u044f\\u0432\",\"en\":\"Accepted\"},\"description\":{\"ua\":\"\\u041f\\u0440\\u0438\\u0439\\u043d\\u044f\\u0432\",\"en\":\"Accepted\"}}', '{\"displayFormat\":\"datalist_One\",\"dataListTable\":\"employee\",\"nullable\":\"0\"}', '2024-05-31 06:59:12', '2024-05-31 06:59:12'),
(62, 15, 'equipment_id', '{\"name\":{\"ua\":\"\\u041e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"Equipment\"},\"description\":{\"ua\":\"\\u041e\\u0431\\u043b\\u0430\\u0434\\u043d\\u0430\\u043d\\u043d\\u044f\",\"en\":\"Equipment\"}}', '{\"displayFormat\":\"datalist_One\",\"dataListTable\":\"equipment_list\",\"nullable\":\"0\"}', '2024-05-31 07:02:22', '2024-05-31 07:02:22');

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `structural_unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `job_title_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`id`, `structural_unit_id`, `job_title_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Косменко Василь Васильович', '2024-05-31 06:00:50', '2024-06-03 01:35:56'),
(2, 1, 2, 'Дешко Андрій Володимирович', '2024-05-31 06:01:35', '2024-05-31 06:01:35');

-- --------------------------------------------------------

--
-- Структура таблицы `equipment_list`
--

CREATE TABLE `equipment_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `equipment_list`
--

INSERT INTO `equipment_list` (`id`, `equipment_type_id`, `serial_number`, `inventory_number`, `created_at`, `updated_at`) VALUES
(2, 1, '241797270', '111302281', '2024-05-31 02:49:03', '2024-05-31 02:49:03'),
(3, 2, '241797271', '111302282', '2024-05-31 02:49:57', '2024-05-31 03:08:24'),
(4, 3, '0000001', '001', '2024-06-02 03:47:20', '2024-06-02 03:47:20');

-- --------------------------------------------------------

--
-- Структура таблицы `equipment_type`
--

CREATE TABLE `equipment_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `equipment_type`
--

INSERT INTO `equipment_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Бодікамера', '2024-05-31 01:05:48', '2024-05-31 01:05:48'),
(2, 'Планшет', '2024-05-31 01:06:13', '2024-05-31 01:06:13'),
(3, 'Відеореєстратор', '2024-05-31 01:06:46', '2024-05-31 01:06:46');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `job_title`
--

CREATE TABLE `job_title` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `job_title`
--

INSERT INTO `job_title` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Головний спеціаліст', '2024-05-31 03:17:30', '2024-05-31 03:17:30'),
(2, 'Старший інспектор', '2024-05-31 03:17:50', '2024-05-31 03:17:50'),
(3, 'Головний спеціаліст', '2024-06-03 01:42:20', '2024-06-03 01:42:20');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_04_12_000000_create_orchid_users_table', 1),
(4, '2015_10_19_214424_create_orchid_roles_table', 1),
(5, '2015_10_19_214425_create_orchid_role_users_table', 1),
(6, '2016_08_07_125128_create_orchid_attachmentstable_table', 1),
(7, '2017_09_17_125801_create_notifications_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_01_24_082605_create_cpcn_tables_table', 1),
(11, '2023_01_24_105113_create_cpcn_table_fields', 1),
(12, '2023_03_11_070612_create_cpcn_lang_table', 1),
(13, '2024_05_31_081948_create_structural_unit_table', 48),
(14, '2024_05_31_080032_create_equipment_type_table', 52),
(15, '2024_05_31_080548_create_equipment_list_table', 54),
(16, '2024_05_31_081341_create_job_title_table', 62),
(17, '2024_05_31_082144_create_employee_table', 64),
(18, '2024_05_31_095232_create_register_events_table', 70);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `register_events`
--

CREATE TABLE `register_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `from` bigint(20) UNSIGNED DEFAULT NULL,
  `accepted` bigint(20) UNSIGNED DEFAULT NULL,
  `equipment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `register_events`
--

INSERT INTO `register_events` (`id`, `date`, `from`, `accepted`, `equipment_id`, `created_at`, `updated_at`) VALUES
(1, '2024-06-01', 1, 2, 2, '2023-09-08 11:18:51', '2023-09-08 11:18:51'),
(2, '2024-06-01', 2, 1, 3, '2023-09-08 11:18:51', '2023-09-08 11:18:51');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'crmAdmin', 'crmAdmin', '{\"platform.systems.attachment\":\"1\",\"platform.systems.DBM\":\"1\",\"platform.systems.lang\":\"1\",\"platform.systems.roles\":\"1\",\"platform.structural_unit\":\"1\",\"platform.equipment_type\":\"1\",\"platform.systems.users\":\"1\",\"platform.index\":\"1\"}', '2023-12-15 08:55:27', '2024-05-31 01:01:37'),
(2, 'Client', 'Client', '{\"platform.systems.attachment\":\"0\",\"platform.systems.DBM\":\"0\",\"platform.TEST_Table_date_list\":\"0\",\"platform.systems.lang\":\"0\",\"platform.systems.roles\":\"0\",\"platform.TEST_Table_1\":\"1\",\"platform.TEST_Table_2\":\"1\",\"platform.systems.users\":\"0\",\"platform.index\":\"0\"}', '2024-01-15 22:11:08', '2024-01-15 22:11:08');

-- --------------------------------------------------------

--
-- Структура таблицы `role_users`
--

CREATE TABLE `role_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`) VALUES
(2, 1),
(2, 2),
(4, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `structural_unit`
--

CREATE TABLE `structural_unit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `structural_unit`
--

INSERT INTO `structural_unit` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Відділ у Вінницькій області', '2024-05-31 00:38:47', '2024-05-31 00:38:47'),
(2, 'Відділ у Волинській області', '2024-05-31 00:39:20', '2024-05-31 00:39:20'),
(3, 'Відділ у Дніпропетровській області', '2024-05-31 00:40:41', '2024-05-31 00:40:41'),
(4, 'Відділ у Донецькій області', '2024-05-31 00:41:08', '2024-05-31 00:41:08'),
(5, 'Відділ у Житомирській області', '2024-05-31 00:41:35', '2024-05-31 00:41:35'),
(6, 'Відділ у Закарпатській області', '2024-05-31 00:42:47', '2024-05-31 00:42:47'),
(7, 'Відділ у Запорізькій області', '2024-05-31 00:44:28', '2024-05-31 00:44:28'),
(8, 'Відділ у Івано-Франківській області', '2024-05-31 00:45:11', '2024-05-31 00:45:11'),
(9, 'Відділ у Київській області', '2024-05-31 00:45:55', '2024-05-31 00:45:55'),
(10, 'Відділ у Кіровоградській області', '2024-05-31 00:46:26', '2024-05-31 00:46:26'),
(11, 'Відділ у Луганській області', '2024-05-31 00:46:54', '2024-05-31 00:46:54'),
(12, 'Відділ у Львівській області', '2024-05-31 00:47:44', '2024-05-31 00:47:44'),
(13, 'Відділ у Миколаївській області', '2024-05-31 00:48:23', '2024-05-31 00:48:23'),
(14, 'Відділ у Одеській області', '2024-05-31 00:49:30', '2024-05-31 00:49:30'),
(15, 'Відділ у Полтавській області', '2024-05-31 00:50:30', '2024-05-31 00:50:30'),
(16, 'Відділ у Рівненській області', '2024-05-31 00:51:00', '2024-05-31 00:51:00'),
(17, 'Відділ у Сумській області', '2024-05-31 00:51:27', '2024-05-31 00:51:27'),
(18, 'Відділ у Тернопільській області', '2024-05-31 00:52:06', '2024-05-31 00:52:06'),
(19, 'Відділ у Харківській області', '2024-05-31 00:52:47', '2024-05-31 00:52:47'),
(20, 'Відділ у Херсонській області', '2024-05-31 00:53:20', '2024-05-31 00:53:20'),
(21, 'Відділ у Черкаській області', '2024-05-31 00:53:43', '2024-05-31 00:53:43'),
(22, 'Відділ у Чернівецькій області', '2024-05-31 00:54:32', '2024-05-31 00:54:32'),
(23, 'Відділ у Чернігівській області', '2024-05-31 00:55:13', '2024-05-31 00:55:13');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `permissions`) VALUES
(2, 'admin', 'admin@admin.com', '2023-12-14 02:30:29', '$2y$10$pd.avzfVPzR0Mn/KojzhHOLZTna13f0FwFRgW8B1scAfhO663TRSm', 'TQZ8PPAimCqQxASX5lXNgm9QivJFHpUf9Fpey8McGSQCrF6jntBseawyyIrp', '2023-09-08 08:22:37', '2024-05-31 07:03:53', '{\"platform.systems.attachment\":\"1\",\"platform.systems.DBM\":\"1\",\"platform.job_title\":\"1\",\"platform.systems.lang\":\"1\",\"platform.equipment_list\":\"1\",\"platform.register_events\":\"1\",\"platform.systems.roles\":\"1\",\"platform.structural_unit\":\"1\",\"platform.equipment_type\":\"1\",\"platform.systems.users\":\"1\",\"platform.employee\":\"1\",\"platform.index\":\"1\"}'),
(4, 'User', 'mes_s@ukr.net', NULL, '$2y$10$cENFGjIJ32TCsZFZweYBTeVLaAbMmCEbSkqabrGIG3oV5/srq/fdW', NULL, '2024-05-28 04:47:48', '2024-05-28 04:47:48', '{\"platform.systems.attachment\":\"0\",\"platform.systems.DBM\":\"0\",\"platform.TEST_Table_date_list\":\"0\",\"platform.systems.lang\":\"0\",\"platform.systems.roles\":\"0\",\"platform.TEST_Table_1\":\"1\",\"platform.TEST_Table_3\":\"0\",\"platform.TEST_Table_4\":\"0\",\"platform.TEST_Table_2\":\"1\",\"platform.systems.users\":\"0\",\"platform.index\":\"0\"}'),
(5, 'Client', 'cl_s@ukr.net', NULL, '$2y$10$Vp0TCd15Q2o1PM6BSTs9Zem4Iw.0ll.7DYb634kLrmQG04hLxO2EW', NULL, '2024-05-28 04:48:22', '2024-05-28 04:48:22', '{\"platform.systems.attachment\":\"0\",\"platform.systems.DBM\":\"0\",\"platform.TEST_Table_date_list\":\"0\",\"platform.systems.lang\":\"0\",\"platform.systems.roles\":\"0\",\"platform.TEST_Table_1\":\"0\",\"platform.TEST_Table_3\":\"1\",\"platform.TEST_Table_4\":\"0\",\"platform.TEST_Table_2\":\"0\",\"platform.systems.users\":\"0\",\"platform.index\":\"0\"}');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachmentable_attachmentable_type_attachmentable_id_index` (`attachmentable_type`,`attachmentable_id`),
  ADD KEY `attachmentable_attachment_id_foreign` (`attachment_id`);

--
-- Индексы таблицы `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cpcn_lang`
--
ALTER TABLE `cpcn_lang`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cpcn_tables`
--
ALTER TABLE `cpcn_tables`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cpcn_table_fields`
--
ALTER TABLE `cpcn_table_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpcn_table_fields_table_id_foreign` (`table_id`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_structural_unit_id_foreign` (`structural_unit_id`),
  ADD KEY `employee_job_title_id_foreign` (`job_title_id`);

--
-- Индексы таблицы `equipment_list`
--
ALTER TABLE `equipment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_list_equipment_type_id_foreign` (`equipment_type_id`);

--
-- Индексы таблицы `equipment_type`
--
ALTER TABLE `equipment_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `job_title`
--
ALTER TABLE `job_title`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `register_events`
--
ALTER TABLE `register_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `register_events_from_foreign` (`from`),
  ADD KEY `register_events_accepted_foreign` (`accepted`),
  ADD KEY `register_events_equipment_id_foreign` (`equipment_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Индексы таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `structural_unit`
--
ALTER TABLE `structural_unit`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cpcn_lang`
--
ALTER TABLE `cpcn_lang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `cpcn_tables`
--
ALTER TABLE `cpcn_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `cpcn_table_fields`
--
ALTER TABLE `cpcn_table_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `equipment_list`
--
ALTER TABLE `equipment_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `equipment_type`
--
ALTER TABLE `equipment_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `job_title`
--
ALTER TABLE `job_title`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `register_events`
--
ALTER TABLE `register_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `structural_unit`
--
ALTER TABLE `structural_unit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  ADD CONSTRAINT `attachmentable_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cpcn_table_fields`
--
ALTER TABLE `cpcn_table_fields`
  ADD CONSTRAINT `cpcn_table_fields_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `cpcn_tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_job_title_id_foreign` FOREIGN KEY (`job_title_id`) REFERENCES `job_title` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_structural_unit_id_foreign` FOREIGN KEY (`structural_unit_id`) REFERENCES `structural_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `equipment_list`
--
ALTER TABLE `equipment_list`
  ADD CONSTRAINT `equipment_list_equipment_type_id_foreign` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `register_events`
--
ALTER TABLE `register_events`
  ADD CONSTRAINT `register_events_accepted_foreign` FOREIGN KEY (`accepted`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `register_events_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `register_events_from_foreign` FOREIGN KEY (`from`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
