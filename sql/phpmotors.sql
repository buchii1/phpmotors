-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 03:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'John', 'Doe', 'johndoe@example.com', '$2y$10$xlAh7oV1irzbL5PNdH4bXOEkYynad0Fv2YIYKnDvmfgblAf3QGVsa', '1', NULL),
(2, 'Admin', 'User', 'admin@cse340.net', '$2y$10$XeZBFEvH7YJetp5HCQ.SberZalFoT6SmRHWvnXX3UD2N3Ef/kLszC', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(7, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2023-11-29 14:27:18', 1),
(8, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2023-11-29 14:27:18', 1),
(9, 16, 'audi-a4.jpeg', '/phpmotors/images/vehicles/audi-a4.jpeg', '2023-11-29 14:27:42', 1),
(10, 16, 'audi-a4-tn.jpeg', '/phpmotors/images/vehicles/audi-a4-tn.jpeg', '2023-11-29 14:27:42', 1),
(11, 17, 'avalon-022.jpeg', '/phpmotors/images/vehicles/avalon-022.jpeg', '2023-11-29 14:28:06', 1),
(12, 17, 'avalon-022-tn.jpeg', '/phpmotors/images/vehicles/avalon-022-tn.jpeg', '2023-11-29 14:28:06', 1),
(13, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2023-11-29 14:28:24', 1),
(14, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2023-11-29 14:28:24', 1),
(15, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2023-11-29 14:28:42', 1),
(16, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2023-11-29 14:28:42', 1),
(17, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2023-11-29 14:28:59', 1),
(18, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2023-11-29 14:28:59', 1),
(19, 15, 'dog.jpeg', '/phpmotors/images/vehicles/dog.jpeg', '2023-11-29 14:29:40', 1),
(20, 15, 'dog-tn.jpeg', '/phpmotors/images/vehicles/dog-tn.jpeg', '2023-11-29 14:29:40', 1),
(21, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2023-11-29 14:30:46', 1),
(22, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2023-11-29 14:30:46', 1),
(23, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2023-11-29 14:31:45', 1),
(24, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2023-11-29 14:31:45', 1),
(25, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2023-11-29 14:32:08', 1),
(26, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2023-11-29 14:32:08', 1),
(27, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2023-11-29 14:32:55', 1),
(28, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2023-11-29 14:32:55', 1),
(29, 18, 'hilux-023.png', '/phpmotors/images/vehicles/hilux-023.png', '2023-11-29 14:33:16', 1),
(30, 18, 'hilux-023-tn.png', '/phpmotors/images/vehicles/hilux-023-tn.png', '2023-11-29 14:33:16', 1),
(31, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2023-11-29 14:33:35', 1),
(32, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2023-11-29 14:33:35', 1),
(33, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2023-11-29 14:33:54', 1),
(34, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2023-11-29 14:33:54', 1),
(35, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2023-11-29 14:34:35', 1),
(36, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2023-11-29 14:34:35', 1),
(37, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2023-11-29 14:34:49', 1),
(38, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2023-11-29 14:34:49', 1),
(39, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2023-11-29 14:35:04', 1),
(40, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2023-11-29 14:35:04', 1),
(41, 1, 'wrangler.jpeg', '/phpmotors/images/vehicles/wrangler.jpeg', '2023-11-29 14:35:21', 1),
(42, 1, 'wrangler-tn.jpeg', '/phpmotors/images/vehicles/wrangler-tn.jpeg', '2023-11-29 14:35:21', 1),
(43, 20, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2023-11-29 14:44:37', 1),
(44, 20, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2023-11-29 14:44:37', 1),
(51, 17, 'avalon2.JPG', '/phpmotors/images/vehicles/avalon2.JPG', '2023-11-29 15:12:46', 0),
(52, 17, 'avalon2-tn.JPG', '/phpmotors/images/vehicles/avalon2-tn.JPG', '2023-11-29 15:12:46', 0),
(53, 16, 'audi.jpeg', '/phpmotors/images/vehicles/audi.jpeg', '2023-11-29 15:19:59', 0),
(54, 16, 'audi-tn.jpeg', '/phpmotors/images/vehicles/audi-tn.jpeg', '2023-11-29 15:19:59', 0),
(55, 18, 'hilux-23.png', '/phpmotors/images/vehicles/hilux-23.png', '2023-11-29 15:29:06', 0),
(56, 18, 'hilux-23-tn.png', '/phpmotors/images/vehicles/hilux-23-tn.png', '2023-11-29 15:29:06', 0),
(57, 17, 'avalon01.jpeg', '/phpmotors/images/vehicles/avalon01.jpeg', '2023-11-30 12:47:33', 0),
(58, 17, 'avalon01-tn.jpeg', '/phpmotors/images/vehicles/avalon01-tn.jpeg', '2023-11-30 12:47:33', 0),
(59, 1, 'jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '2023-11-30 13:03:33', 0),
(60, 1, 'jeep-wrangler-tn.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '2023-11-30 13:03:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicle/wrangler.jpeg', '/phpmotors/images/vehicle/wrangler-tn.jpeg', '28045.00', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicle/ford-modelt.jpg', '/phpmotors/images/vehicle/ford-modelt-tn.jpg', '30000.00', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicle/lambo-Adve.jpg', '/phpmotors/images/vehicle/lambo-Adve-tn.jpg', '417650.00', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicle/monster.jpg', '/phpmotors/images/vehicle/monster-tn.jpg', '150000.00', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicle/ms.jpg', '/phpmotors/images/vehicle/ms-tn.jpg', '100.00', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicle/bat.jpg', '/phpmotors/images/vehicle/bat-tn.jpg', '65000.00', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicle/mm.jpg', '/phpmotors/images/vehicle/mm-tn.jpg', '10000.00', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicle/fire-truck.jpg', '/phpmotors/images/vehicle/fire-truck-tn.jpg', '50000.00', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicle/crown-vic.jpg', '/phpmotors/images/vehicle/crown-vic-tn.jpg', '10000.00', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicle/camaro.jpg', '/phpmotors/images/vehicle/camaro-tn.jpg', '25000.00', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicle/escalade.jpg', '/phpmotors/images/vehicle/escalade-tn.jpg', '75195.00', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicle/hummer.jpg', '/phpmotors/images/vehicle/hummer-tn.jpg', '58800.00', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicle/aerocar.jpg', '/phpmotors/images/vehicle/aerocar-tn.jpg', '1000000.00', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/vehicle/fbi.jpg', '/phpmotors/images/vehicle/fbi-tn.jpg', '20000.00', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicle/dog.jpeg', '/phpmotors/images/vehicle/dog-tn.jpeg', '35000.00', 1, 'Brown', 2),
(16, 'Audi', 'A4', 'A very fast car suitable for classic people like you and I.', '/phpmotors/images/vehicle/audi-a4.jpeg', '/phpmotors/images/vehicle/audi-a4-tn.jpeg', '15000.00', 2, 'White', 2),
(17, 'Toyota', 'Avalon 2022', 'A very cozy and exquisite car.', '/phpmotors/images/vehicle/avalon-022.jpeg', '/phpmotors/images/vehicle/avalon-022-tn.jpeg', '7500.00', 2, 'Ash', 2),
(18, 'Toyota', 'Hilux 2023', 'Heavy duty vehicle.', '/phpmotors/images/vehicle/hilux-023.png', '/phpmotors/images/vehicle/hilux-023-tn.png', '14700.56', 6, 'Black', 1),
(20, 'DMC', 'DeLorean', 'Known for its spectacular and cozy look. Delorean is now a rare brand which is highly sought after, and very rare to find.', '/phpmotors/vehicle/images/no-image.png', '/phpmotors/vehicle/images/no-image.png', '9600.00', 3, 'Grey', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(4, 'I prefer the bigger ones.', '2023-12-02 10:39:50', 13, 2),
(6, 'Literally among the very best!', '2023-12-02 17:20:27', 17, 1),
(7, 'Who will gift me?? In love... :)', '2023-12-02 21:03:38', 17, 2),
(12, 'I hope it is fast enough?', '2023-12-08 14:31:41', 8, 2),
(13, 'King of the jungle!', '2023-12-08 14:43:23', 18, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
