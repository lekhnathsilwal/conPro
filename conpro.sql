-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2020 at 10:14 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organizations_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `organizations_id`, `company`, `location`, `email`, `contact`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 1, 'Abbott-McClure', '79243 Mack Isle Suite 398\nHarbermouth, IN 18815', 'shayna20@example.net', '(738) 280-8901 x9410', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(2, 1, 'Ledner, Adams and Johnson', '401 Reed Divide\nGleasonside, CO 26640', 'jaskolski.mozelle@example.org', '+1 (226) 447-5860', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(3, 1, 'Emard LLC', '5730 Bechtelar Springs\nSaraishire, SD 92150', 'feil.pearline@example.org', '+1-825-458-3926', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(4, 1, 'Cormier Inc', '632 Conn River Suite 433\nLake Margaretteshire, WV 75689-2098', 'consuelo.west@example.com', '+1.641.589.9559', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(5, 1, 'Eichmann, Grady and Jacobs', '840 Hamill Springs\nEast Columbuston, AL 60892-6572', 'tgutmann@example.net', '(974) 746-5555', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(6, 1, 'Shanahan-Kuphal', '26815 Corrine Dale\nBoyerside, TX 46685', 'wbashirian@example.org', '(508) 683-3586 x647', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(7, 1, 'O\'Conner Group', '35478 Nicola Common\nEast Deloresburgh, WY 91127-1002', 'bsporer@example.net', '373.612.7204 x81389', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(8, 1, 'Sauer-Reichel', '458 Schuster Rapids\nKellihaven, WV 98914-7396', 'mbruen@example.net', '1-396-647-6593', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(9, 1, 'Rau-Berge', '192 Lori Street\nKatelynnland, DC 09525', 'akihn@example.net', '385-848-0815 x334', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(10, 1, 'Sanford, Kautzer and Hegmann', '6980 Wilkinson Viaduct\nDietrichtown, MO 96490-5401', 'donnelly.joanny@example.net', '654.885.1882 x4055', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(11, 1, 'Braun-Wilderman', '793 Riley Isle\nWest Roxanneburgh, CO 94860', 'okuneva.ottilie@example.com', '+1-479-624-4318', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(12, 1, 'Krajcik, Fisher and Breitenberg', '13325 Dax Club\nEast Erichtown, FL 36224-8300', 'spinka.dorcas@example.com', '706.953.8197', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(13, 1, 'Ziemann-Bashirian', '24773 Reichel Row Apt. 504\nProhaskaville, NY 88016', 'celestino50@example.net', '646-282-1772 x363', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(14, 1, 'Mayer Group', '6962 Maggio Union Apt. 941\nPort Lydia, OH 41118-5662', 'schmidt.alva@example.net', '1-849-861-3399 x0628', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(15, 1, 'Zboncak LLC', '15767 Kailey Lake\nAnnabelbury, KS 86917-1630', 'jonas.nitzsche@example.net', '394.780.4808', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(16, 1, 'Reichel, Boehm and Gusikowski', '7249 Sporer Inlet\nIsomchester, GA 79543', 'lafayette67@example.org', '(754) 858-7921', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(17, 1, 'Gerlach PLC', '9123 Marquardt Lakes Apt. 575\nJarvisland, SC 76288', 'pschaefer@example.net', '1-607-689-3774 x790', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(18, 1, 'Reynolds-Boyer', '348 Willms Roads Suite 721\nNorth Roman, MN 74836', 'reuben71@example.com', '(869) 945-2035 x1863', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(19, 1, 'Kuvalis-Gleason', '454 Oma Lodge\nCandidoton, MN 67631', 'lamar.murphy@example.com', '1-897-973-3737 x6459', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(20, 1, 'Turcotte, Muller and Leuschke', '89705 Lockman Squares\nNorth Aliyahmouth, TN 15052', 'ncummerata@example.net', '1-512-493-6250', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(21, 1, 'Grimes, O\'Conner and Harvey', '437 Abbigail Locks\nEast Leoneborough, GA 33255-1071', 'akuhlman@example.org', '452.558.1215 x3663', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(22, 1, 'Lueilwitz Ltd', '2696 Lou View\nBoyerborough, MN 13218-5059', 'hallie92@example.net', '621-363-5597 x4849', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(23, 1, 'Jacobi, Russel and Johns', '57145 Cremin Divide Suite 366\nOdaside, MI 91789-4123', 'kendra.herzog@example.org', '313.889.5975', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(24, 1, 'Adams PLC', '6960 Abbott Parkways\nOndrickaberg, AZ 90479', 'demetris.nikolaus@example.org', '+1-732-486-8947', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(25, 1, 'Simonis, Aufderhar and Torp', '4766 Imelda Corner Suite 366\nEast Dangeloberg, DE 78581-8066', 'treutel.lonie@example.org', '1-228-295-5928 x821', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(26, 1, 'Steuber, Becker and Stark', '2616 Reichert Branch Apt. 258\nWest Destiney, OK 08461', 'sophia.casper@example.net', '790.721.4503 x097', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(27, 1, 'King-Dach', '4111 Fisher Estates Suite 990\nLake Kamrenborough, AL 51188-6152', 'odie59@example.com', '670-226-0264 x41356', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(28, 1, 'Koepp, Hyatt and Funk', '41657 Lurline Stravenue\nSchaefertown, AL 30680', 'fadel.jamison@example.org', '1-253-607-5804 x405', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(29, 1, 'Pfeffer, Maggio and Hudson', '8332 Virgil Curve Apt. 122\nWernerberg, CA 56610-7221', 'zbahringer@example.com', '359-394-7684', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(30, 1, 'Wintheiser Group', '4469 Ramiro Avenue\nNew Kalefort, GA 55344', 'isom17@example.org', '393.341.2306', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(31, 1, 'White Ltd', '67192 Ethan Neck Apt. 846\nPort Myrl, UT 86655', 'bernadine.pouros@example.org', '514-535-4360', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(32, 1, 'Hamill PLC', '8619 Mittie Parkway\nRebekashire, MT 91371', 'vkonopelski@example.net', '969.384.5323', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(33, 1, 'Vandervort-Langosh', '9822 Schowalter Locks Suite 705\nFramitown, AL 76939-2785', 'renner.tatyana@example.com', '356.491.0632 x219', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(34, 1, 'Cruickshank, Mills and Wolf', '4266 Labadie Bypass\nKochburgh, AZ 22333-5695', 'celestino.jacobi@example.com', '565-457-4822', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(35, 1, 'Dach-Hagenes', '610 Isaias Wall Apt. 961\nPort Jaydenstad, CT 13464-8266', 'qwyman@example.org', '1-460-443-2488 x3688', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(36, 1, 'Schiller-Heller', '18715 Hoppe Station\nZackeryfort, NV 03354', 'felicita71@example.org', '+1.995.264.5676', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(37, 1, 'Schuppe and Sons', '12505 Johns Overpass\nLake Bethelberg, MS 39679', 'emaggio@example.net', '1-764-866-4175', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(38, 1, 'Rosenbaum Group', '511 Cristian Streets Apt. 445\nAnaisbury, MA 08362', 'crawford.padberg@example.net', '(809) 449-7380', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(39, 1, 'McLaughlin Ltd', '9683 Winifred Skyway Apt. 960\nNorth Adaline, MA 46658-7904', 'ksmitham@example.net', '595.732.4666', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(40, 1, 'O\'Keefe, Predovic and Crooks', '69192 Nathen Brook Apt. 749\nEast Ethel, WY 11330-1166', 'upton.jasen@example.com', '763.757.3538 x449', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(41, 1, 'Langosh, Moore and Vandervort', '73192 Leffler Loop Apt. 378\nWest Meredithberg, MT 88924-4675', 'quinton76@example.org', '631.620.5339 x91227', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(42, 1, 'Will, Hauck and Keeling', '17495 Gulgowski Canyon\nNorth Lawrence, IL 95773', 'wisoky.malcolm@example.com', '968-718-6843 x71603', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(43, 1, 'Kutch, Macejkovic and Abernathy', '6557 Flatley Roads Suite 444\nPort Destineybury, AL 66605', 'okon.marietta@example.com', '(216) 901-6216 x89498', 1, '2020-01-02 23:19:23', '2020-01-02 23:19:23', NULL, NULL, NULL),
(44, 1, 'Runolfsson Ltd', '1614 Eliza Throughway\nWest Zoiemouth, IN 87167', 'madilyn48@example.org', '956.564.3162', 1, '2020-01-02 23:19:24', '2020-01-02 23:19:24', NULL, NULL, NULL),
(45, 1, 'Champlin-Nolan', '82670 McClure Forges Apt. 517\nNew Murphytown, NH 04324-3268', 'darien95@example.net', '(937) 555-0917 x89919', 1, '2020-01-02 23:19:24', '2020-01-02 23:19:24', NULL, NULL, NULL),
(46, 1, 'Greenfelder, Daniel and Homenick', '7051 Melba Walk Suite 662\nWest Lillafort, HI 33101-2124', 'rene55@example.net', '(575) 350-5462', 1, '2020-01-02 23:19:24', '2020-01-02 23:19:24', NULL, NULL, NULL),
(47, 1, 'Stracke-Casper', '14450 Reichel Plaza Suite 453\nStaceyberg, AL 87061', 'dimitri55@example.org', '910-843-9601', 1, '2020-01-02 23:19:24', '2020-01-02 23:19:24', NULL, NULL, NULL),
(48, 1, 'Green-Fadel', '3196 Telly Manor Suite 192\nEast Bernie, KS 84809-5484', 'grant.tia@example.com', '1-610-909-8185', 1, '2020-01-02 23:19:24', '2020-01-02 23:19:24', NULL, NULL, NULL),
(49, 1, 'Weissnat PLC', '60544 Reese Station\nLake Elsa, CA 75171-1272', 'sophie88@example.org', '908-997-9846 x185', 1, '2020-01-02 23:19:24', '2020-01-02 23:19:24', NULL, NULL, NULL),
(50, 1, 'Prosacco, Ebert and Schuster', '681 Reilly Isle\nKemmerchester, IA 01707', 'cory.ortiz@example.net', '1-579-607-2743', 1, '2020-01-02 23:19:24', '2020-01-02 23:19:24', NULL, NULL, NULL),
(51, 1, 'Shiran Technologies Pvt.Ltd.', 'Hattisar,Kathmandu', 'info@shirantech.com', '0151999221', 1, '2020-01-08 03:23:19', '2020-01-08 03:23:19', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_details`
--

CREATE TABLE `client_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clients_id` bigint(20) UNSIGNED DEFAULT NULL,
  `authorized_person` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_details`
--

INSERT INTO `client_details` (`id`, `clients_id`, `authorized_person`, `designation`, `contact`, `email`, `created_at`, `updated_at`) VALUES
(1, 10, 'Green Olson', 'd', '1-765-401-6130', 'nhane@example.org', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(2, 25, 'Theresia Schaefer', 's', '+1 (339) 679-6341', 'reuben.kirlin@example.com', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(3, 35, 'Helene Collier', 'r', '552.500.7852', 'dorian48@example.org', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(4, 14, 'Madelynn Watsica', 'o', '+15939629216', 'oscar.walker@example.org', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(5, 30, 'Mrs. Selena Ortiz', 'g', '1-980-965-3396', 'green.chris@example.com', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(6, 50, 'Freeda Marquardt', 'l', '959.869.4072', 'zhand@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(7, 31, 'Dr. Jakayla Rogahn', 'm', '+1-369-391-8337', 'scarlett.denesik@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(8, 21, 'Aiyana Runolfsson', 'n', '809-242-6406 x018', 'teresa.blanda@example.org', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(9, 27, 'Miss Alverta Bartoletti', 'k', '629.335.4006 x1089', 'bbartell@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(10, 29, 'Prof. Fermin Pacocha', 'h', '+1-582-699-2081', 'schuster.lina@example.com', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(11, 38, 'Prof. Lera Metz', 'r', '+1 (380) 973-7387', 'chelsea05@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(12, 5, 'Dr. Soledad Marks', 'f', '618-727-7655 x2477', 'tfisher@example.org', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(13, 14, 'Mrs. Dena Rowe', 'd', '+1 (708) 601-6603', 'jstracke@example.com', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(14, 8, 'Lauren Berge', 'h', '(708) 963-7051', 'mraz.jaqueline@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(15, 13, 'Lauretta Kulas', 'd', '(378) 647-1700 x3050', 'bfritsch@example.com', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(16, 28, 'Dangelo Effertz', 'r', '848-659-6394 x70255', 'paxton77@example.org', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(17, 49, 'Mr. Ephraim Graham', 'v', '557-248-6359 x42848', 'wsatterfield@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(18, 27, 'Dr. Gloria Hill DVM', 'm', '+14404592410', 'vilma.considine@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(19, 3, 'Mrs. Justine Bins', 't', '894-392-2455 x86341', 'bradtke.valentin@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(20, 47, 'Haskell Hirthe', 'q', '815.503.6292', 'blick.isabell@example.org', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(21, 34, 'Bonnie Weissnat', 'o', '+15518279606', 'isabel05@example.net', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(22, 25, 'Desiree Abernathy', 'k', '(284) 976-2575 x9804', 'howell.gunnar@example.com', '2020-01-03 01:01:58', '2020-01-03 01:01:58'),
(23, 45, 'Candelario Breitenberg', 'r', '(598) 494-5871 x008', 'leffler.virgil@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(24, 5, 'Wilford O\'Conner DDS', 'b', '780-965-4640 x111', 'promaguera@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(25, 49, 'Dr. Michel Gusikowski', 'q', '+1 (643) 375-4459', 'vschmidt@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(26, 1, 'Lulu Kris', 'z', '+1-827-452-7130', 'ines98@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(27, 17, 'Ayla Lebsack', 'a', '(529) 676-6351', 'michael88@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(28, 18, 'Francesco Walter', 't', '(594) 884-3474', 'collins.rylee@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(29, 40, 'Prof. Buddy Veum Sr.', 'w', '(834) 804-7168', 'ucormier@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(30, 34, 'Prof. Johnnie Connelly III', 'n', '373-677-0344', 'delpha58@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(31, 34, 'Gabe Gerhold', 'i', '+1-880-868-3058', 'kilback.ozella@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(32, 2, 'Weldon Steuber', 'd', '+1 (213) 885-6163', 'smitham.maggie@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(33, 45, 'Dr. Wilbert Goodwin', 'e', '(331) 443-0659 x48669', 'cbruen@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(34, 27, 'Skye Aufderhar', 'c', '530-664-0772', 'reynolds.willis@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(35, 17, 'Kennedi Treutel', 's', '(338) 829-4119 x333', 'fahey.florida@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(36, 48, 'Mason Feest IV', 'y', '(312) 928-3372', 'mwuckert@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(37, 13, 'Ms. Cristal Huels IV', 'e', '1-671-373-0802', 'wisoky.elyse@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(38, 17, 'Daija Christiansen', 'v', '465.529.8451 x9896', 'marquis21@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(39, 19, 'Danielle Hudson', 'r', '675-705-3990', 'alyce44@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(40, 7, 'Miss Gilda Schulist', 'h', '349.354.8772 x681', 'icie.donnelly@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(41, 46, 'Onie Hayes', 't', '+14599747699', 'bhudson@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(42, 40, 'Yasmin Hyatt', 'y', '332.991.7781', 'tania.quigley@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(43, 10, 'Douglas Roob', 'e', '609.626.7750 x28229', 'rau.grayce@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(44, 43, 'Lindsey Konopelski', 'd', '(643) 528-0147', 'conner73@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(45, 13, 'Kiera Paucek', 'p', '(604) 755-4247 x21007', 'uvonrueden@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(46, 5, 'Dr. Keshawn Treutel', 's', '+1-604-710-0124', 'doug63@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(47, 49, 'Alford Abshire', 'a', '(247) 566-6986 x0289', 'schmeler.jerad@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(48, 41, 'Prof. Madisen Ryan PhD', 'd', '545.346.8534 x032', 'xwill@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(49, 41, 'Prof. Granville Hoeger', 'q', '(615) 775-0192', 'moshe.lindgren@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(50, 24, 'Eino Shields', 'w', '372.562.4631', 'jameson29@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(51, 46, 'Dr. Lempi Upton V', 'k', '+1-492-424-1367', 'guillermo.kautzer@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(52, 40, 'Miss Laisha Farrell PhD', 'e', '(435) 504-3999', 'rebeca.harber@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(53, 10, 'Prof. Nils Ryan', 'a', '1-386-324-9837 x361', 'evelyn.christiansen@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(54, 9, 'Miguel Feeney', 'k', '1-457-412-4037 x246', 'otilia30@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(55, 36, 'Woodrow Gislason', 'x', '575.505.7724 x921', 'wintheiser.asia@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(56, 26, 'Drake Aufderhar III', 'e', '1-934-251-9797', 'pfannerstill.skylar@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(57, 17, 'Anita Hegmann', 'k', '+12969189440', 'callie.goldner@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(58, 8, 'Dr. Colt Fritsch V', 'e', '378-531-3790 x8733', 'zlarson@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(59, 30, 'Estel Weber', 'v', '+1-982-921-4402', 'ankunding.marlen@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(60, 43, 'Lue Orn', 'y', '+1.316.741.9738', 'konopelski.heidi@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(61, 21, 'Miss Thora Langworth DDS', 'm', '+1-618-449-9764', 'ybartell@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(62, 46, 'Einar Keebler PhD', 't', '(916) 605-8064 x5591', 'jade41@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(63, 3, 'Colten Conroy', 'v', '535-624-6588', 'wwaters@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(64, 29, 'Novella Okuneva', 'c', '1-282-819-1608', 'edythe.stehr@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(65, 41, 'Prof. Rosanna Treutel', 'z', '+1 (368) 351-1217', 'aankunding@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(66, 31, 'Mrs. Magali Huel MD', 'd', '815-722-9685', 'jacobi.ellis@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(67, 32, 'Davon Von', 'l', '+1 (936) 421-1686', 'quincy.russel@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(68, 21, 'Joan Ritchie', 'z', '813.891.6124 x1503', 'wglover@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(69, 6, 'Edward Murray', 'r', '202.700.6470 x76067', 'raegan.cormier@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(70, 49, 'Anderson Deckow', 'k', '286-256-6631', 'felicia.conn@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(71, 31, 'Jacynthe Baumbach', 'f', '534-942-0886 x451', 'reanna23@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(72, 40, 'Oliver Dickens', 'z', '608.396.2107 x129', 'ckerluke@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(73, 21, 'Jacklyn Vandervort', 'e', '1-445-994-2448 x97267', 'gerald77@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(74, 6, 'Nora Mraz', 'i', '868.315.5740 x938', 'scrona@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(75, 40, 'Emilie Reichert III', 'a', '1-724-478-9941 x2485', 'crunolfsdottir@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(76, 19, 'Green Hickle', 'd', '1-753-821-0412 x27887', 'xgusikowski@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(77, 10, 'Catharine Cronin', 'i', '665.528.2899 x122', 'fadel.heath@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(78, 7, 'Prof. Lee Schmeler V', 'c', '+1 (521) 508-0665', 'kohler.abbey@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(79, 7, 'Carson Cummings', 'a', '627.307.8446', 'cyrus.johnson@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(80, 28, 'Dr. Jace Rice', 'q', '743.251.5842 x082', 'nikita.hoeger@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(81, 47, 'Ms. Margie Muller', 'u', '+1-985-663-3544', 'fharber@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(82, 45, 'Bennie Bode', 'f', '739-856-7106 x73569', 'schumm.christy@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(83, 29, 'Ms. Elvie Hackett Jr.', 'o', '995.586.4328', 'hdietrich@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(84, 36, 'Prof. Eldora Hudson', 'y', '794-826-1778 x747', 'ikoch@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(85, 9, 'Emma Hamill', 'r', '+1.453.224.8879', 'cassin.alan@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(86, 25, 'Marlen Grant', 'g', '(637) 547-7323', 'hammes.nathen@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(87, 23, 'Madonna Padberg', 'q', '238.521.8028', 'upton.jacky@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(88, 33, 'Bianka Reynolds', 'f', '207.990.9453 x2579', 'emie36@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(89, 3, 'Prof. Yolanda Collins MD', 'e', '1-260-359-1350', 'monahan.johnnie@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(90, 37, 'Osbaldo Hamill III', 'b', '1-282-916-9170 x7719', 'abigale20@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(91, 4, 'Vella Mohr', 'y', '776.874.1807', 'abaumbach@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(92, 5, 'Miss Jewel Towne', 'v', '959.919.7951 x9858', 'triston94@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(93, 39, 'Prof. Toni Kemmer PhD', 'o', '850-546-0286 x97284', 'ubaldo.dubuque@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(94, 48, 'Ms. Emily Rosenbaum', 'r', '1-869-431-2380', 'kelli94@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(95, 13, 'Lupe Stehr', 'o', '+1 (534) 620-9921', 'schumm.fletcher@example.net', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(96, 16, 'Lilliana Kutch', 'm', '1-725-739-2929', 'stehr.loyal@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(97, 8, 'Lorenz Treutel', 's', '(746) 300-9545', 'fay76@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(98, 24, 'Gretchen Towne', 'a', '(379) 343-2425 x4059', 'jkirlin@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(99, 19, 'Mr. Clark Hirthe MD', 'y', '1-302-260-4509', 'green.laurel@example.org', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(100, 20, 'Miss Brooke Bergstrom III', 'u', '629.399.2063', 'ola.luettgen@example.com', '2020-01-03 01:01:59', '2020-01-03 01:01:59'),
(101, 51, 'Prajwal Shretstha', 'General Manager', '9810000010', 'prajwal@shirantech.com', '2020-01-08 03:23:19', '2020-01-08 03:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `daily_report`
--

CREATE TABLE `daily_report` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organizations_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departments_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_task`
--

CREATE TABLE `daily_task` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `daily_report_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_nature` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizations_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `organizations_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Human Resoruce', 1, 1, NULL, NULL, NULL, '2020-01-08 04:07:42', '2020-01-08 04:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organizations_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departments_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL,
  `joined_date` date DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `organizations_id`, `departments_id`, `name`, `email`, `contact`, `address`, `password`, `dob`, `gender`, `joined_date`, `verified`, `status`, `designation`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`, `remember_token`) VALUES
(5, 1, 1, 'asdasd', 'asdasd@sadasd.com', '222342344232', 'Kalanki-14,kashibazar,Kathmandu', '$2y$10$t41ASiAggdE2wGgtaoN1u.K5xQV7Pk5yoBEXWaVjdoWQ6cK5ldm1y', '1988-01-12', 1, '2020-01-02', 1, 1, 'Developer', '2020_01_07_06_19_23_sulkeha.jpg', '2020-01-02 05:07:44', '2020-01-08 04:51:32', NULL, NULL, NULL, 'JVYeTupDOArd1bL7zzBh8gLOqTNH9bThhxg9xHuBYhfcmvlsYA1SdSC4yAW8');

-- --------------------------------------------------------

--
-- Table structure for table `manuals`
--

CREATE TABLE `manuals` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manuals`
--

INSERT INTO `manuals` (`id`, `content`, `url`, `created_at`, `updated_at`) VALUES
(1, 'demo content', NULL, '2020-01-01 01:38:25', '2020-01-01 01:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_05_062214_create_users_table', 1),
(2, '2019_12_30_085510_create_organizations_table', 1),
(3, '2019_12_30_085620_create_roles_table', 1),
(4, '2019_12_30_085658_create_user_roles_table', 1),
(5, '2019_12_30_085742_create_modules_table', 1),
(6, '2019_12_30_085816_create_permissions_table', 1),
(7, '2019_12_30_085918_create_role_permissions_table', 1),
(8, '2019_12_30_085957_create_department_table', 1),
(9, '2019_12_30_090229_create_trash_table', 1),
(10, '2019_12_30_100228_add_organization_department_to_users', 1),
(11, '2019_12_30_105658_create_manuals_table', 1),
(12, '2020_01_01_041751_create_clients_table', 1),
(13, '2020_01_01_043430_create_client_details_table', 1),
(14, '2020_01_01_044159_create_employee_table', 1),
(15, '2020_01_01_053042_create_daily_report_table', 1),
(16, '2020_01_01_053214_create_daily_task_table', 1),
(17, '2020_01_01_055007_create_task_module_meeting_table', 1),
(18, '2020_01_01_055036_create_task_module_call_table', 1),
(19, '2020_01_01_055059_create_task_module_operation_table', 1),
(20, '2020_01_01_055117_create_task_module_documentation_table', 1),
(21, '2020_01_01_055133_create_task_module_other_table', 1),
(22, '2020_01_02_070029_add_remember_to_employee', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `status`, `position`, `created_at`, `updated_at`, `created_by`) VALUES
(18, 'Client', 1, 1, '2020-01-01 03:44:06', NULL, NULL),
(19, 'Department', 1, 2, '2020-01-01 03:44:06', NULL, NULL),
(20, 'Group', 1, 3, '2020-01-01 03:44:06', NULL, NULL),
(21, 'User', 1, 4, '2020-01-01 03:44:06', NULL, NULL),
(22, 'Employee', 1, 5, '2020-01-01 03:44:06', NULL, NULL),
(23, 'Trash', 1, 6, '2020-01-01 03:44:06', NULL, NULL),
(24, 'project', 1, 7, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `email`, `image`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Shiran Technology Pvt.Ltd.', 'info@shirantech.com', '2020_01_01_10_05_56_shiran_logo.png', 1, '2020-01-01 04:20:56', '2020-01-01 04:20:56', NULL, NULL, NULL),
(2, 'Lohani & Brothers Pvt.Ltd.', 'info@lohaninbrothers.com', '2020_07_05_09_46_14_500_F_229585999_nfj9ywZdIrcWIInK2psM1us0cKGu9lnn.jpg', 1, '2020-07-05 04:01:14', '2020-07-05 04:01:14', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modules_id` bigint(20) UNSIGNED NOT NULL,
  `create` tinyint(1) NOT NULL DEFAULT '0',
  `view` tinyint(1) NOT NULL DEFAULT '0',
  `edit` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `modules_id`, `create`, `view`, `edit`, `delete`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 18, 1, 1, 1, 1, '2020-01-01 03:45:04', '2020-01-01 03:45:04', NULL, NULL, NULL),
(2, 19, 1, 1, 1, 1, '2020-01-01 03:45:04', '2020-01-01 03:45:04', NULL, NULL, NULL),
(3, 20, 1, 1, 1, 1, '2020-01-01 03:45:04', '2020-01-01 03:45:04', NULL, NULL, NULL),
(4, 21, 1, 1, 1, 1, '2020-01-01 03:45:04', '2020-01-01 03:45:04', NULL, NULL, NULL),
(5, 22, 1, 1, 1, 1, '2020-01-01 03:45:04', '2020-01-01 03:45:04', NULL, NULL, NULL),
(6, 23, 0, 0, 1, 1, '2020-01-01 03:45:04', '2020-01-01 03:45:04', NULL, NULL, NULL),
(7, 18, 0, 0, 1, 1, '2020-01-01 03:45:38', '2020-01-01 03:45:38', NULL, NULL, NULL),
(8, 19, 1, 1, 1, 1, '2020-01-01 03:45:38', '2020-01-01 03:45:38', NULL, NULL, NULL),
(9, 20, 1, 1, 1, 1, '2020-01-01 03:45:38', '2020-01-01 03:45:38', NULL, NULL, NULL),
(10, 21, 1, 1, 1, 1, '2020-01-01 03:45:38', '2020-01-01 03:45:38', NULL, NULL, NULL),
(11, 22, 1, 1, 1, 1, '2020-01-01 03:45:38', '2020-01-01 03:45:38', NULL, NULL, NULL),
(12, 23, 0, 0, 1, 1, '2020-01-01 03:45:38', '2020-01-01 03:45:38', NULL, NULL, NULL),
(13, 18, 1, 1, 1, 1, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(14, 19, 1, 1, 1, 1, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(15, 20, 1, 1, 1, 1, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(16, 21, 1, 1, 1, 1, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(17, 22, 1, 1, 1, 1, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(18, 23, 0, 0, 1, 1, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(19, 18, 1, 1, 1, 1, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(20, 19, 1, 1, 1, 1, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(21, 20, 1, 1, 1, 1, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(22, 21, 1, 1, 1, 1, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(23, 22, 1, 1, 1, 1, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(24, 23, 0, 0, 1, 1, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizations_id` bigint(20) UNSIGNED NOT NULL,
  `agreement_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `position` tinyint(1) NOT NULL DEFAULT '1',
  `deadline` date NOT NULL,
  `agreement_duration` int(11) DEFAULT NULL,
  `duration_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_cost` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projects_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_ext` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_parties`
--

CREATE TABLE `project_parties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projects_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `contact_person_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_designation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_contact` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizations_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `group`, `organizations_id`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Admin', NULL, 1, '2020-01-01 03:45:04', '2020-01-01 03:45:04', NULL, NULL, NULL),
(2, 'Admin', 1, 1, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roles_id` bigint(20) UNSIGNED NOT NULL,
  `permissions_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `roles_id`, `permissions_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(13, 1, 13, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(14, 1, 14, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(15, 1, 15, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(16, 1, 16, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(17, 1, 17, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(18, 1, 18, '2020-01-01 03:45:52', '2020-01-01 03:45:52', NULL, NULL, NULL),
(19, 2, 19, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(20, 2, 20, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(21, 2, 21, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(22, 2, 22, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(23, 2, 23, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL),
(24, 2, 24, '2020-01-02 00:11:24', '2020-01-02 00:11:24', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_module_call`
--

CREATE TABLE `task_module_call` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `call_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorizedPerson` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_conclusion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `duration` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_module_documentation`
--

CREATE TABLE `task_module_documentation` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorizedPerson` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_conclusion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daily_task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_module_documentation`
--

INSERT INTO `task_module_documentation` (`id`, `client_name`, `authorizedPerson`, `client_id`, `task`, `task_conclusion`, `date_time`, `duration`, `daily_task_id`, `created_at`, `updated_at`) VALUES
(1, 'Ledner, Adams and Johnson', NULL, 2, 'Product Related', 'sadas', '2020-01-13 01:00:00', '2:2', 20, '2020-01-06 05:07:28', '2020-01-06 05:07:28'),
(2, 'Ledner, Adams and Johnson', NULL, 2, 'Product Related', 'sadas', '2020-01-06 01:00:00', '2:22', 25, '2020-01-06 05:12:18', '2020-01-06 05:12:18'),
(3, 'Ledner, Adams and Johnson', NULL, 2, 'Product Related', 'asdas', '2020-01-08 01:00:00', '1:23', 33, '2020-01-07 23:32:48', '2020-01-07 23:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `task_module_meeting`
--

CREATE TABLE `task_module_meeting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_conclusion` longtext COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorizedPerson` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `daily_task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_module_operation`
--

CREATE TABLE `task_module_operation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorizedPerson` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_conclusion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daily_task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_module_other`
--

CREATE TABLE `task_module_other` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorizedPerson` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_conclusion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_module_other`
--

INSERT INTO `task_module_other` (`id`, `client_name`, `authorizedPerson`, `task`, `task_conclusion`, `daily_task_id`, `created_at`, `updated_at`, `client_id`, `date_time`, `duration`) VALUES
(1, 'Eichmann, Grady and Jacobs', NULL, 'sdfsdf', 'dsfds', 29, '2020-01-06 05:15:42', '2020-01-06 05:15:42', 5, '2020-01-21 01:00:00', '12:212');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modules` bigint(20) UNSIGNED DEFAULT NULL,
  `data_id` bigint(20) UNSIGNED DEFAULT NULL,
  `organizations_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `organizations_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `designation`, `image`, `type`, `status`, `verified`, `remember_token`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`, `organizations_id`, `department_id`) VALUES
(5, 'Super Admin', 'super@admin.com', '$2y$10$k6pSfLACEEivYTGVzn0OCO/yF7pyge9s4nK4bf7nxNbIKuRrkQXIO', '9843526424', NULL, NULL, 0, 1, 1, NULL, '2020-07-05 03:13:43', '2020-07-05 03:13:43', NULL, NULL, NULL, NULL, NULL),
(6, 'Sandip Silwal', 'sandeshninbox@gmail.com', '$2y$10$/kbfLPUpUpvX.pvlmYRtZOTA2OMJWsd4S2ZMn7vnQA03HtBpqTVxO', '9843526424', 'Developer', NULL, 1, 1, 0, NULL, '2020-07-05 04:24:07', '2020-07-05 04:24:07', 5, NULL, NULL, 2, NULL),
(7, 'sandip silwal', 'sandip.silwal.ss@gmail.com', '$2y$10$7w7PzsDjuvtouzi8gxCfUO56lTHxKSU/V7bNdf5hNemOqCYSPBoWa', '9846456765', 'developer', NULL, 1, 1, 1, NULL, '2020-07-05 05:26:36', '2020-07-05 05:29:07', 5, NULL, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roles_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `roles_id`, `users_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(4, 1, 6, '2020-07-05 04:24:07', '2020-07-05 04:24:07', 5, NULL, NULL),
(5, 1, 7, '2020-07-05 05:26:36', '2020-07-05 05:26:36', 5, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_created_by_foreign` (`created_by`),
  ADD KEY `clients_updated_by_foreign` (`updated_by`),
  ADD KEY `clients_deleted_by_foreign` (`deleted_by`),
  ADD KEY `clients_organizations_id_foreign` (`organizations_id`);

--
-- Indexes for table `client_details`
--
ALTER TABLE `client_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_details_clients_id_foreign` (`clients_id`);

--
-- Indexes for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daily_report_deleted_by_foreign` (`deleted_by`),
  ADD KEY `daily_report_organizations_id_foreign` (`organizations_id`),
  ADD KEY `daily_report_departments_id_foreign` (`departments_id`),
  ADD KEY `daily_report_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `daily_task`
--
ALTER TABLE `daily_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daily_task_daily_report_id_foreign` (`daily_report_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_organizations_id_foreign` (`organizations_id`),
  ADD KEY `department_created_by_foreign` (`created_by`),
  ADD KEY `department_updated_by_foreign` (`updated_by`),
  ADD KEY `department_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_created_by_foreign` (`created_by`),
  ADD KEY `employee_updated_by_foreign` (`updated_by`),
  ADD KEY `employee_deleted_by_foreign` (`deleted_by`),
  ADD KEY `employee_organizations_id_foreign` (`organizations_id`),
  ADD KEY `employee_departments_id_foreign` (`departments_id`);

--
-- Indexes for table `manuals`
--
ALTER TABLE `manuals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_created_by_foreign` (`created_by`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organizations_email_unique` (`email`),
  ADD KEY `organizations_created_by_foreign` (`created_by`),
  ADD KEY `organizations_updated_by_foreign` (`updated_by`),
  ADD KEY `organizations_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_modules_id_foreign` (`modules_id`),
  ADD KEY `permissions_created_by_foreign` (`created_by`),
  ADD KEY `permissions_updated_by_foreign` (`updated_by`),
  ADD KEY `permissions_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_created_by_foreign` (`created_by`),
  ADD KEY `projects_deleted_by_foreign` (`deleted_by`),
  ADD KEY `projects_updated_by_foreign` (`updated_by`),
  ADD KEY `organizations_id` (`organizations_id`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_files_created_by_foreign` (`created_by`),
  ADD KEY `project_files_deleted_by_foreign` (`deleted_by`),
  ADD KEY `project_files_projects_id_foreign` (`projects_id`),
  ADD KEY `project_files_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `project_parties`
--
ALTER TABLE `project_parties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_parties_created_by_foreign` (`created_by`),
  ADD KEY `project_parties_deleted_by_foreign` (`deleted_by`),
  ADD KEY `project_parties_projects_id_foreign` (`projects_id`),
  ADD KEY `project_parties_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_created_by_foreign` (`created_by`),
  ADD KEY `roles_updated_by_foreign` (`updated_by`),
  ADD KEY `roles_deleted_by_foreign` (`deleted_by`),
  ADD KEY `roles_organizations_id_foreign` (`organizations_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_roles_id_foreign` (`roles_id`),
  ADD KEY `role_permissions_permissions_id_foreign` (`permissions_id`),
  ADD KEY `role_permissions_created_by_foreign` (`created_by`),
  ADD KEY `role_permissions_updated_by_foreign` (`updated_by`),
  ADD KEY `role_permissions_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `task_module_call`
--
ALTER TABLE `task_module_call`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_module_call_daily_task_id_foreign` (`daily_task_id`),
  ADD KEY `with_id` (`client_id`);

--
-- Indexes for table `task_module_documentation`
--
ALTER TABLE `task_module_documentation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `task_module_meeting`
--
ALTER TABLE `task_module_meeting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_module_meeting_with_id_foreign` (`client_id`),
  ADD KEY `task_module_meeting_daily_task_id_foreign` (`daily_task_id`);

--
-- Indexes for table `task_module_operation`
--
ALTER TABLE `task_module_operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_module_operation_daily_task_id_foreign` (`daily_task_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `task_module_other`
--
ALTER TABLE `task_module_other`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trash_modules_foreign` (`modules`),
  ADD KEY `trash_organizations_id_foreign` (`organizations_id`),
  ADD KEY `trash_created_by_foreign` (`created_by`),
  ADD KEY `trash_restored_by_foreign` (`restored_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`),
  ADD KEY `users_updated_by_foreign` (`updated_by`),
  ADD KEY `users_deleted_by_foreign` (`deleted_by`),
  ADD KEY `users_organizations_id_foreign` (`organizations_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_roles_id_foreign` (`roles_id`),
  ADD KEY `user_roles_users_id_foreign` (`users_id`),
  ADD KEY `user_roles_created_by_foreign` (`created_by`),
  ADD KEY `user_roles_updated_by_foreign` (`updated_by`),
  ADD KEY `user_roles_deleted_by_foreign` (`deleted_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `client_details`
--
ALTER TABLE `client_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_task`
--
ALTER TABLE `daily_task`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manuals`
--
ALTER TABLE `manuals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_parties`
--
ALTER TABLE `project_parties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `task_module_call`
--
ALTER TABLE `task_module_call`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_module_documentation`
--
ALTER TABLE `task_module_documentation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_module_meeting`
--
ALTER TABLE `task_module_meeting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_module_operation`
--
ALTER TABLE `task_module_operation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_module_other`
--
ALTER TABLE `task_module_other`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `clients_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `clients_organizations_id_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clients_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `client_details`
--
ALTER TABLE `client_details`
  ADD CONSTRAINT `client_details_clients_id_foreign` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD CONSTRAINT `daily_report_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `daily_report_departments_id_foreign` FOREIGN KEY (`departments_id`) REFERENCES `department` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `daily_report_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daily_report_organizations_id_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daily_task`
--
ALTER TABLE `daily_task`
  ADD CONSTRAINT `daily_task_daily_report_id_foreign` FOREIGN KEY (`daily_report_id`) REFERENCES `daily_report` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `department_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `department_organizations_id_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `department_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_departments_id_foreign` FOREIGN KEY (`departments_id`) REFERENCES `department` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_organizations_id_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `organizations_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `organizations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permissions_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permissions_modules_id_foreign` FOREIGN KEY (`modules_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `permissions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_ibfk_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_files`
--
ALTER TABLE `project_files`
  ADD CONSTRAINT `project_files_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_files_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_files_projects_id_foreign` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_files_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_parties`
--
ALTER TABLE `project_parties`
  ADD CONSTRAINT `project_parties_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_parties_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_parties_projects_id_foreign` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_parties_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `roles_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `roles_organizations_id_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `role_permissions_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `role_permissions_permissions_id_foreign` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `task_module_call`
--
ALTER TABLE `task_module_call`
  ADD CONSTRAINT `task_module_call_daily_task_id_foreign` FOREIGN KEY (`daily_task_id`) REFERENCES `daily_task` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_module_call_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `task_module_meeting`
--
ALTER TABLE `task_module_meeting`
  ADD CONSTRAINT `task_module_meeting_daily_task_id_foreign` FOREIGN KEY (`daily_task_id`) REFERENCES `daily_task` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_module_meeting_with_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `client_details` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `task_module_operation`
--
ALTER TABLE `task_module_operation`
  ADD CONSTRAINT `task_module_operation_daily_task_id_foreign` FOREIGN KEY (`daily_task_id`) REFERENCES `daily_task` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_module_operation_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trash`
--
ALTER TABLE `trash`
  ADD CONSTRAINT `trash_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trash_modules_foreign` FOREIGN KEY (`modules`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trash_organizations_id_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trash_restored_by_foreign` FOREIGN KEY (`restored_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_organizations_id_foreign` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_roles_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_roles_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_roles_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
