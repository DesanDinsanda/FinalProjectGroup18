-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: May 16, 2025 at 03:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`) VALUES
(30),
(41);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `dob` date NOT NULL,
  `province` varchar(15) NOT NULL,
  `city` varchar(20) NOT NULL,
  `streetName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `dob`, `province`, `city`, `streetName`) VALUES
(29, '0000-00-00', '', '', ''),
(33, '0000-00-00', '', '', ''),
(40, '0000-00-00', '', '', ''),
(50, '0000-00-00', '', '', ''),
(51, '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `custom_package`
--

CREATE TABLE `custom_package` (
  `packageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_package`
--

INSERT INTO `custom_package` (`packageID`) VALUES
(22),
(23),
(24),
(26),
(27);

-- --------------------------------------------------------

--
-- Table structure for table `custom_package_item`
--

CREATE TABLE `custom_package_item` (
  `itemID` int(11) NOT NULL,
  `custom_packageID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `orderedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_package_item`
--

INSERT INTO `custom_package_item` (`itemID`, `custom_packageID`, `amount`, `orderedDate`) VALUES
(103, 22, 1, '2025-02-26'),
(103, 23, 2, '2025-02-26'),
(103, 24, 5, '2025-02-27'),
(104, 23, 1, '2025-02-26'),
(104, 24, 2, '2025-02-27'),
(121, 27, 1, '2025-03-04'),
(124, 27, 10, '2025-03-04'),
(127, 27, 2, '2025-03-04'),
(136, 26, 10, '2025-03-01'),
(137, 26, 20, '2025-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `eventmanager`
--

CREATE TABLE `eventmanager` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventmanager`
--

INSERT INTO `eventmanager` (`ID`) VALUES
(26);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faqID` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faqID`, `question`, `answer`) VALUES
(3, 'What services do you offer?', 'We specialize in floral arrangements and event decor, including wedding bouquets, reception and ceremony flowers, and custom decorations for any special occasion.'),
(4, ' Do you provide services outside Colombo?', 'Yes! We offer our services across Sri Lanka. However, additional transportation charges may apply for long-distance locations.'),
(5, 'How can I place an order?', 'You can place an order through our website by selecting a package or requesting a custom design. You can also contact us via phone or WhatsApp for personalized arrangements.'),
(6, 'How far in advance should I book my event decor?', 'We recommend booking at least 2–4 weeks in advance to ensure availability and proper customization.'),
(7, 'Do you offer custom floral arrangements?', 'Yes, we provide fully customized floral arrangements based on your preferences, event theme, and budget.'),
(8, ' What payment methods do you accept?', 'We accept bank transfers, credit/debit cards, and cash on delivery (for certain items).'),
(9, ' Can I modify or cancel my order?', 'You can modify your order up to 5 days before the event. Cancellations within 7 days of the event may result in a cancellation fee.'),
(10, 'Do you provide refunds?', 'Refunds are available only for cancellations made at least 7 days before the event. A small processing fee may apply.'),
(11, 'Do you provide delivery and setup?', 'Yes! Our team will deliver and set up all floral decorations at your venue as part of the service.'),
(12, 'What areas do you deliver to?', 'We deliver across Sri Lanka, including Colombo, Kandy, Galle, and other major cities. Additional charges may apply for distant locations.');

-- --------------------------------------------------------

--
-- Table structure for table `favorite_suppliers`
--

CREATE TABLE `favorite_suppliers` (
  `id` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite_suppliers`
--

INSERT INTO `favorite_suppliers` (`id`, `supplierID`) VALUES
(46, 5);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `itemPhoto` text NOT NULL,
  `itemPrice` decimal(10,2) NOT NULL,
  `itemStock` int(11) NOT NULL,
  `itemSource` varchar(15) NOT NULL,
  `itemPackageType` varchar(25) NOT NULL DEFAULT 'for all packages',
  `itemEventType` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `itemName`, `itemPhoto`, `itemPrice`, `itemStock`, `itemSource`, `itemPackageType`, `itemEventType`) VALUES
(19, 'Event Planning & Full day coordination', '', 0.00, 0, '', 'for all packages', ''),
(20, 'Bridal dressing package', '', 0.00, 0, '', 'for all packages', ''),
(21, 'Any type of groom’s dresses', '', 0.00, 0, '', 'for all packages', ''),
(22, 'Traditional Dancing or Dhol Drummers', '', 0.00, 0, '', 'for all packages', ''),
(23, 'Complete flower decorations', '', 0.00, 0, '', 'for all packages', ''),
(24, 'Wedding cakes', '', 0.00, 0, '', 'for all packages', ''),
(25, 'Wedding cake structure', '', 0.00, 0, '', 'for all packages', ''),
(26, 'Champaign fountain with bottle', '', 0.00, 0, '', 'for all packages', ''),
(27, 'Complete Photography package', '', 0.00, 0, '', 'for all packages', ''),
(28, 'Complete DJ Package', '', 0.00, 0, '', 'for all packages', ''),
(29, 'Wedding car with Decoration', '', 0.00, 0, '', 'for all packages', ''),
(30, 'Projector with screen', '', 0.00, 0, '', 'for all packages', ''),
(31, 'Invitations with envelopes', '', 0.00, 0, '', 'for all packages', ''),
(32, 'Complete floral decorations', '', 0.00, 0, '', 'for all packages', ''),
(33, 'Poruwa ceremony with goods', '', 0.00, 0, '', 'for all packages', ''),
(34, 'Shashrika table or Cake structure', '', 0.00, 0, '', 'for all packages', ''),
(35, 'Milk fount. or Champaign fountain (with bottle)', '', 0.00, 0, '', 'for all packages', ''),
(36, 'Wedding car with decorations', '', 0.00, 0, '', 'for all packages', ''),
(37, 'Two Best men dresses', '', 0.00, 0, '', 'for all packages', ''),
(38, 'Traditional dancing team', '', 0.00, 0, '', 'for all packages', ''),
(39, 'Shashrika table', '', 0.00, 0, '', 'for all packages', ''),
(40, 'Milk fountain with dry ice', '', 0.00, 0, '', 'for all packages', ''),
(41, 'Basic balloon decor', '', 0.00, 0, '', 'for all packages', ''),
(42, ' Simple backdrop', '', 0.00, 0, '', 'for all packages', ''),
(43, '1 kg birthday cake', '', 0.00, 0, '', 'for all packages', ''),
(44, 'Disposable tableware', '', 0.00, 0, '', 'for all packages', ''),
(45, 'Music system', '', 0.00, 0, '', 'for all packages', ''),
(46, ' Gift bags for 10 guests', '', 0.00, 0, '', 'for all packages', ''),
(47, 'Themed balloon arch & backdrop', '', 0.00, 0, '', 'for all packages', ''),
(48, '2 kg custom cake', '', 0.00, 0, '', 'for all packages', ''),
(49, 'Party favors for 20 guests', '', 0.00, 0, '', 'for all packages', ''),
(50, 'Photographer (3 hours)', '', 0.00, 0, '', 'for all packages', ''),
(51, 'DJ or live music', '', 0.00, 0, '', 'for all packages', ''),
(52, 'Venue lighting', '', 0.00, 0, '', 'for all packages', ''),
(53, 'Snacks & drinks for 20 guests', '', 0.00, 0, '', 'for all packages', ''),
(54, 'Themed centerpieces', '', 0.00, 0, '', 'for all packages', ''),
(55, 'Grand balloon wall & luxury backdrop', '', 0.00, 0, '', 'for all packages', ''),
(56, 'Multi-tier designer cake (3+ kg)', '', 0.00, 0, '', 'for all packages', ''),
(57, 'Personalized gift boxes (50 guests)', '', 0.00, 0, '', 'for all packages', ''),
(58, 'Photographer & videographer', '', 0.00, 0, '', 'for all packages', ''),
(59, 'Live DJ or performers', '', 0.00, 0, '', 'for all packages', ''),
(60, 'Dessert & buffet meal', '', 0.00, 0, '', 'for all packages', ''),
(61, 'LED wall displays', '', 0.00, 0, '', 'for all packages', ''),
(62, ' Red carpet entrance', '', 0.00, 0, '', 'for all packages', ''),
(63, 'Fireworks/sparklers', '', 0.00, 0, '', 'for all packages', ''),
(64, 'Luxury seating', '', 0.00, 0, '', 'for all packages', ''),
(65, 'Event coordinator', '', 0.00, 0, '', 'for all packages', ''),
(66, 'Full lighting setup', '', 0.00, 0, '', 'for all packages', ''),
(67, 'Standard stage & podium', '', 0.00, 0, '', 'for all packages', ''),
(68, 'Basic sound system', '', 0.00, 0, '', 'for all packages', ''),
(69, 'Simple table & seating decor', '', 0.00, 0, '', 'for all packages', ''),
(70, 'Basic photography', '', 0.00, 0, '', 'for all packages', ''),
(71, 'Traditional oil lamp lighting', '', 0.00, 0, '', 'for all packages', ''),
(72, 'Floral decor (Jasmine, Araliya)', '', 0.00, 0, '', 'for all packages', ''),
(73, 'Digital invitations', '', 0.00, 0, '', 'for all packages', ''),
(74, 'Basic backdrop branding', '', 0.00, 0, '', 'for all packages', ''),
(75, 'Tea & short eats', '', 0.00, 0, '', 'for all packages', ''),
(76, 'Premium stage with LED lights', '', 0.00, 0, '', 'for all packages', ''),
(77, 'Pro sound & audio', '', 0.00, 0, '', 'for all packages', ''),
(78, 'Themed decor & trophies', '', 0.00, 0, '', 'for all packages', ''),
(79, 'Full photography & videography', '', 0.00, 0, '', 'for all packages', ''),
(80, 'Sri Lankan buffet (Hoppers, Kiribath)', '', 0.00, 0, '', 'for all packages', ''),
(81, 'Kandyan drummers & dancers', '', 0.00, 0, '', 'for all packages', ''),
(82, 'Step-and-repeat banner', '', 0.00, 0, '', 'for all packages', ''),
(83, 'Custom lighting effects', '', 0.00, 0, '', 'for all packages', ''),
(84, 'Digital guest registration', '', 0.00, 0, '', 'for all packages', ''),
(85, 'Branded backdrop', '', 0.00, 0, '', 'for all packages', ''),
(86, 'Handcrafted souvenirs', '', 0.00, 0, '', 'for all packages', ''),
(87, 'Luxury stage with LED screen', '', 0.00, 0, '', 'for all packages', ''),
(88, 'Concert-level sound & lighting', '', 0.00, 0, '', 'for all packages', ''),
(89, 'VIP seating & red carpet', '', 0.00, 0, '', 'for all packages', ''),
(90, 'Celebrity host or live act', '', 0.00, 0, '', 'for all packages', ''),
(91, '360° video booth & drone', '', 0.00, 0, '', 'for all packages', ''),
(92, 'Kandyan drummers & fire dancers', '', 0.00, 0, '', 'for all packages', ''),
(93, 'Fine dining (Sri Lankan & international)', '', 0.00, 0, '', 'for all packages', ''),
(94, 'Fog machine & confetti blast', '', 0.00, 0, '', 'for all packages', ''),
(95, 'Custom engraved trophies', '', 0.00, 0, '', 'for all packages', ''),
(96, 'Live streaming', '', 0.00, 0, '', 'for all packages', ''),
(97, 'Lotus centerpiece decor', '', 0.00, 0, '', 'for all packages', ''),
(98, 'Luxury souvenirs (Batik, Ceylon tea)', '', 0.00, 0, '', 'for all packages', ''),
(99, 'Luxury souvenirs', '', 0.00, 0, '', 'for all packages', ''),
(100, 'Personalized gift hampers for VIPs', '', 0.00, 0, '', 'for all packages', ''),
(103, 'Poruwa', '../uploads/Poruwa Designs.jpg', 8000.00, 1, 'Company', 'for custom package', 'Wedding'),
(104, 'Wedding Entrance Flower Arch', '../uploads/Wedding Bridal Floral Background Arch.jpg', 4000.00, 3, 'Company', 'for custom package', 'Wedding'),
(105, 'Traditional Oil Lamp ', '../uploads/Brass Exquisite Peace of Artistic Oil Lamp.jpg', 1000.00, 15, 'Company', 'for custom package', 'Wedding'),
(106, 'Table Centerpieces', '../uploads/Use a red tablecloth as the base and layer with gold chargers for each place setting_.jpg', 500.00, 30, 'Company', 'for custom package', 'Wedding'),
(107, 'Jasmine and Rose Garland', '../uploads/Red Rose Petals With Jasmine.jpg', 300.00, 25, 'Company', 'for custom package', 'Wedding'),
(108, 'Kandyan Bridal Flower Bouquet', '../uploads/Bridal bouquet.jpg', 400.00, 25, 'Company', 'for custom package', 'Wedding'),
(109, 'Settee Back Flower Decoration', '../uploads/download (5).jpg', 1000.00, 5, 'Company', 'for custom package', 'Wedding'),
(110, 'Flower Chandelier', '../uploads/Marbella - Pink Flower Rose Crystal Hanging Ceiling Light Chandelier - 65cm _ Gold.jpg', 1200.00, 3, 'Company', 'for custom package', 'Wedding'),
(111, 'Floral Umbrellas for Bride & Groom', '../uploads/download (6).jpg', 600.00, 10, 'Company', 'for custom package', 'Wedding'),
(112, 'Betel Leaf Arrangement', '../uploads/download (7).jpg', 200.00, 30, 'Supplied', 'for custom package', 'Wedding'),
(113, 'Golden Tray for Wedding Rings', '../uploads/download (8).jpg', 1500.00, 20, 'Supplied', 'for custom package', 'Wedding'),
(115, 'Brass Wedding Kalasa', '../uploads/Vintage Collection.jpg', 500.00, 35, 'Supplied', 'for custom package', 'Wedding'),
(116, 'Table Runner', '../uploads/Blue White Porcelain Floral Table Runner.jpg', 200.00, 20, 'Supplied', 'for custom package', 'Wedding'),
(117, 'Hanging Clay Lanterns', '../uploads/Pottery Candle Warmer Lamp,.jpg', 350.00, 40, 'Supplied', 'for custom package', 'Wedding'),
(118, 'Coconut Husk Candle Holders', '../uploads/Handmade Natural Tea Light Candle Holder Set.jpg', 200.00, 50, 'Supplied', 'for custom package', 'Wedding'),
(119, 'Customized Wooden Name Boards', '../uploads/Personalized Family Tree w_Names.jpg', 2000.00, 5, 'Supplied', 'for custom package', 'Wedding'),
(120, 'Themed Birthday Cake', '../uploads/Best Ever Strawberry Cake.jpg', 5000.00, 10, 'Supplied', 'for custom package', 'Birthday'),
(121, 'Balloon Arch', '../uploads/White Gold Balloon Arch.jpg', 3000.00, 8, 'Company', 'for custom package', 'Birthday'),
(122, 'Birthday Backdrop', '../uploads/Birthday Balloon Studio Digital Backdrop.jpg', 3500.00, 15, 'Company', 'for custom package', 'Birthday'),
(123, 'LED Fairy Lights', '../uploads/rideau lumineux led glaçons guirlande.jpg', 2500.00, 20, 'Supplied', 'for custom package', 'Birthday'),
(124, 'Customized Party Hats', '../uploads/PixiPy Birthday Party Hats for Kids.jpg', 150.00, 90, 'Supplied', 'for custom package', 'Birthday'),
(125, 'Confetti Cannons', '../uploads/Gold Wedding Confetti Cannon By Little Big Party Co_.jpg', 200.00, 200, 'Company', 'for custom package', 'Birthday'),
(126, 'Piñata', '../uploads/Piñata en or 3d.jpg', 400.00, 40, 'Company', 'for custom package', 'Birthday'),
(127, 'Chocolate Fountain', '../uploads/STEAL!!  Chocolate Fondue Fountain, $45!  https___amzn_to_2C8k2p2.jpg', 5000.00, 7, 'Supplied', 'for custom package', 'Birthday'),
(128, 'Cupcake Tower', '../uploads/3-Tier Natural Wooden Cupcake Dessert.jpg', 3000.00, 20, 'Supplied', 'for custom package', 'Birthday'),
(129, 'Candy Table Setup', '../uploads/download (9).jpg', 5500.00, 20, 'Company', 'for custom package', 'Birthday'),
(130, 'Customized Birthday Banner', '../uploads/download (10).jpg', 1000.00, 20, 'Company', 'for custom package', 'Birthday'),
(131, 'Sound & DJ Setup', '../uploads/download (11).jpg', 10000.00, 3, 'Company', 'for custom package', 'Birthday'),
(132, 'Photo Booth with Props', '../uploads/YPLonon 30pcs Party Photo Booth Props Glitter Prom___.jpg', 1200.00, 30, 'Company', 'for custom package', 'Birthday'),
(133, 'Customized Invitation Cards', '../uploads/Customized Invitation Cards.jpg', 250.00, 300, 'Company', 'for custom package', 'Birthday'),
(134, 'Trophies (Gold/Silver/Bronze)', '../uploads/Trophy NN125 Pattern Bowling Gold _ Silver _ Bronze Trofi Souvenir Hadiah Cenderahati.jpg', 3000.00, 80, 'Supplied', 'for custom package', 'AwardCeramony'),
(135, 'Award Plaques & Shields', '../uploads/Personalised 8 Inch Perpetual Annual Shield Award.jpg', 2000.00, 100, 'Supplied', 'for custom package', 'AwardCeramony'),
(136, 'Medals with Ribbons', '../uploads/10pcs Award Medals 5cm Sports Rewards Gold_silver_bronze Medal For Sports Games.jpg', 1500.00, 100, 'Supplied', 'for custom package', 'AwardCeramony'),
(137, 'Certificates with Frames', '../uploads/Certificate _ Diploma Background.jpg', 600.00, 300, 'Supplied', 'for custom package', 'AwardCeramony'),
(138, 'Red Carpet', '../uploads/Hollywood Themed Event _ Feel Good Events.jpg', 800.00, 30, 'Company', 'for custom package', 'AwardCeramony'),
(139, 'Stage LED Screens', '../uploads/Riyali Shah and Akash Pandey.jpg', 20000.00, 4, 'Supplied', 'for custom package', 'AwardCeramony'),
(140, 'Professional Sound System', '../uploads/5 Essential Components of a High-Performance Professional Sound System.jpg', 6000.00, 8, 'Company', 'for custom package', 'AwardCeramony'),
(141, 'Spotlight & Decorative Lighting', '../uploads/ANWIO Kitchen Spot Lights Ceiling,6 Way Black Lounge.jpg', 1500.00, 40, 'Company', 'for custom package', 'AwardCeramony'),
(142, 'Event Backdrops & Banners', '../uploads/Temu｜Toile de Fond Élégante avec Ballons pour Décoration.jpg', 3000.00, 8, 'Company', 'for custom package', 'AwardCeramony'),
(143, 'Customized Invitation Cards', '../uploads/Customized Invitation Cards for award ceremony.jpg', 300.00, 300, 'Company', 'for custom package', 'AwardCeramony'),
(144, 'VIP Seating Arrangements', '../uploads/The Bridge Centerpiece - by Sarah Elkady, Loza Events.jpg', 3000.00, 10, 'Supplied', 'for custom package', 'AwardCeramony'),
(145, 'Confetti Cannons & Fireworks', '../uploads/Gold Wedding Confetti Cannon By Little Big Party Co_.jpg', 300.00, 100, 'Company', 'for custom package', 'AwardCeramony'),
(146, 'Floral Decorations for Stage', '../uploads/download (12).jpg', 700.00, 70, 'Company', 'for custom package', 'AwardCeramony'),
(147, 'flower', '', 0.00, 0, '', 'for all packages', ''),
(148, 'flowers', '', 0.00, 0, '', 'for all packages', '');

-- --------------------------------------------------------

--
-- Table structure for table `item_supplier`
--

CREATE TABLE `item_supplier` (
  `itemID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `addedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_supplier`
--

INSERT INTO `item_supplier` (`itemID`, `supplierID`, `amount`, `addedDate`) VALUES
(112, 6, 30, '2025-02-26'),
(113, 7, 20, '2025-02-26'),
(115, 7, 35, '2025-02-26'),
(116, 7, 20, '2025-02-26'),
(117, 6, 40, '2025-02-26'),
(118, 5, 50, '2025-02-28'),
(119, 8, 5, '2025-02-26'),
(120, 9, 10, '2025-02-26'),
(123, 10, 20, '2025-02-26'),
(124, 9, 100, '2025-02-26'),
(127, 9, 9, '2025-02-26'),
(128, 9, 20, '2025-02-26'),
(134, 11, 80, '2025-02-28'),
(135, 11, 100, '2025-02-28'),
(136, 11, 100, '2025-02-28'),
(137, 11, 300, '2025-02-28'),
(139, 10, 4, '2025-02-28'),
(144, 7, 10, '2025-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'pending',
  `eventDate` date NOT NULL,
  `eventTime` time NOT NULL,
  `eventLocation` varchar(30) NOT NULL,
  `customerID` int(11) NOT NULL,
  `pre_define_packageID` int(11) DEFAULT NULL,
  `custom_packageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `status`, `eventDate`, `eventTime`, `eventLocation`, `customerID`, `pre_define_packageID`, `custom_packageID`) VALUES
(10, '2025-02-26', 'accepted', '2025-02-28', '06:15:00', 'Homagama', 29, 15, NULL),
(14, '2025-02-26', 'rejected', '2025-02-27', '20:10:00', 'Colombo', 29, NULL, 22),
(15, '2025-02-26', 'accepted', '2025-02-28', '20:18:00', 'Colombo', 33, NULL, 23),
(16, '2025-02-27', 'accepted', '2025-02-28', '13:02:00', 'Gampaha', 29, NULL, 24),
(17, '2025-03-01', 'rejected', '2025-03-14', '06:15:00', 'Colombo', 29, NULL, 26),
(18, '2025-03-04', 'accepted', '2025-03-13', '01:02:00', 'Nuwara', 51, NULL, 27),
(19, '2025-03-05', 'pending', '2025-03-08', '10:34:00', 'Gampaha', 29, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `packageID` int(11) NOT NULL,
  `eventType` varchar(30) NOT NULL,
  `packageName` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`packageID`, `eventType`, `packageName`, `price`, `discount`) VALUES
(10, 'Wedding', 'SILVER PACKAGE', 550000.00, 0),
(11, 'Wedding', 'GOLD PACKAGE', 599000.00, 0),
(12, 'Wedding', 'ELITE PACKAGE', 690000.00, 0),
(13, 'Birthday', 'SILVER PACKAGE', 35000.00, 0),
(14, 'Birthday', 'GOLD PACKAGE', 50000.00, 0),
(15, 'Birthday', 'ELITE PACKAGE', 100000.00, 0),
(16, 'Award Ceramony ', 'SILVER PACKAGE', 150000.00, 0),
(17, 'Award Ceramony', 'GOLD PACKAGE', 180000.00, 0),
(18, 'Award Ceramony ', 'ELITE PACKAGE', 220000.00, 0),
(19, 'Wedding', 'Custom Package', 300.00, 0),
(20, 'Wedding', 'Custom Package', 950.00, 0),
(21, 'Wedding', 'Custom Package', 1900.00, 0),
(22, 'Wedding', 'Custom Package', 12000.00, 0),
(23, 'Wedding', 'Custom Package', 28000.00, 0),
(24, 'Wedding', 'Custom Package', 48000.00, 0),
(26, 'AwardCeramony', 'Custom Package', 27000.00, 0),
(27, 'Birthday', 'Custom Package', 14500.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pre_define_package`
--

CREATE TABLE `pre_define_package` (
  `packageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_define_package`
--

INSERT INTO `pre_define_package` (`packageID`) VALUES
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18);

-- --------------------------------------------------------

--
-- Table structure for table `pre_define_package_item`
--

CREATE TABLE `pre_define_package_item` (
  `itemID` int(11) NOT NULL,
  `pre_define_packageID` int(11) NOT NULL,
  `updatedDate` date DEFAULT NULL,
  `itemCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_define_package_item`
--

INSERT INTO `pre_define_package_item` (`itemID`, `pre_define_packageID`, `updatedDate`, `itemCount`) VALUES
(19, 10, '2025-03-04', 12),
(19, 11, '2025-02-25', 13),
(19, 12, '2025-02-25', 17),
(20, 10, '2025-03-04', 12),
(20, 11, '2025-02-25', 13),
(20, 12, '2025-02-25', 17),
(21, 10, '2025-03-04', 12),
(21, 11, '2025-02-25', 13),
(21, 12, '2025-02-25', 17),
(22, 10, '2025-03-04', 12),
(23, 10, '2025-03-04', 12),
(24, 10, '2025-03-04', 12),
(24, 11, '2025-02-25', 13),
(24, 12, '2025-02-25', 17),
(25, 10, '2025-03-04', 12),
(25, 12, '2025-02-25', 17),
(26, 10, '2025-03-04', 12),
(26, 12, '2025-02-25', 17),
(27, 10, '2025-03-04', 12),
(27, 11, '2025-02-25', 13),
(27, 12, '2025-02-25', 17),
(28, 10, '2025-03-04', 12),
(28, 11, '2025-02-25', 13),
(28, 12, '2025-02-25', 17),
(29, 10, '2025-03-04', 12),
(29, 12, '2025-02-25', 17),
(30, 10, '2025-03-04', 12),
(30, 11, '2025-02-25', 13),
(30, 12, '2025-02-25', 17),
(31, 11, '2025-02-25', 13),
(31, 12, '2025-02-25', 17),
(32, 11, '2025-02-25', 13),
(32, 12, '2025-02-25', 17),
(33, 11, '2025-02-25', 13),
(33, 12, '2025-02-25', 17),
(34, 11, '2025-02-25', 13),
(35, 11, '2025-02-25', 13),
(36, 11, '2025-02-25', 13),
(37, 12, '2025-02-25', 17),
(38, 12, '2025-02-25', 17),
(39, 12, '2025-02-25', 17),
(40, 12, '2025-02-25', 17),
(41, 13, '2025-02-25', 6),
(42, 13, '2025-02-25', 6),
(43, 13, '2025-02-25', 6),
(44, 13, '2025-02-25', 6),
(45, 13, '2025-02-25', 6),
(46, 13, '2025-02-25', 6),
(47, 14, '2025-02-25', 8),
(48, 14, '2025-02-25', 8),
(49, 14, '2025-02-25', 8),
(50, 14, '2025-02-25', 8),
(51, 14, '2025-02-25', 8),
(52, 14, '2025-02-25', 8),
(53, 14, '2025-02-25', 8),
(54, 14, '2025-02-25', 8),
(55, 15, '2025-02-25', 12),
(56, 15, '2025-02-25', 12),
(57, 15, '2025-02-25', 12),
(58, 15, '2025-02-25', 12),
(59, 15, '2025-02-25', 12),
(60, 15, '2025-02-25', 12),
(61, 15, '2025-02-25', 12),
(62, 15, '2025-02-25', 12),
(63, 15, '2025-02-25', 12),
(64, 15, '2025-02-25', 12),
(65, 15, '2025-02-25', 12),
(66, 15, '2025-02-25', 12),
(67, 16, '2025-02-25', 9),
(68, 16, '2025-02-25', 9),
(69, 16, '2025-02-25', 9),
(70, 16, '2025-02-25', 9),
(71, 16, '2025-02-25', 9),
(72, 16, '2025-02-25', 9),
(73, 16, '2025-02-25', 9),
(74, 16, '2025-02-25', 9),
(75, 16, '2025-02-25', 9),
(76, 17, '2025-02-26', 11),
(77, 17, '2025-02-26', 11),
(78, 17, '2025-02-26', 11),
(79, 17, '2025-02-26', 11),
(80, 17, '2025-02-26', 11),
(81, 17, '2025-02-26', 11),
(82, 17, '2025-02-26', 11),
(83, 17, '2025-02-26', 11),
(84, 17, '2025-02-26', 11),
(85, 17, '2025-02-26', 11),
(86, 17, '2025-02-26', 11),
(87, 18, '2025-02-26', 13),
(88, 18, '2025-02-26', 13),
(89, 18, '2025-02-26', 13),
(90, 18, '2025-02-26', 13),
(91, 18, '2025-02-26', 13),
(92, 18, '2025-02-26', 13),
(93, 18, '2025-02-26', 13),
(94, 18, '2025-02-26', 13),
(95, 18, '2025-02-26', 13),
(96, 18, '2025-02-26', 13),
(97, 18, '2025-02-26', 13),
(99, 18, '2025-02-26', 13),
(100, 18, '2025-02-26', 13);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(11) NOT NULL,
  `reviewDate` date NOT NULL,
  `reviewDiscription` text NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `reviewDate`, `reviewDiscription`, `customerID`) VALUES
(14, '2025-02-26', 'Wow, what an unforgettable experience! The Gold Wedding Package exceeded all my expectations. The event planning and coordination were flawless, allowing us to enjoy every moment without any stress. The bridal dressing package made me feel like royalty, and the groom’s outfits were perfect. The photography and DJ packages were incredible—our photos turned out beautiful, and the music kept everyone dancing all night. The floral decorations were stunning, and the wedding car with decorations added such a lovely touch. Everything was truly perfect. Thank you for making our special day so magical!', 29),
(15, '2025-02-27', 'Good Service', 33),
(17, '2025-03-04', 'Our wedding was a fairytale, thanks to this amazing team! Their attention to detail and personal touch made it perfect', 40),
(18, '2025-03-04', 'Professional, creative, and truly passionate about making weddings memorable. We are beyond grateful for their hard work!', 50),
(19, '2025-03-04', 'We felt so special on our big day, thanks to the wonderful team. Everything was smooth, elegant, and well-organized.\"', 51);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `province` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `streetName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `firstName`, `lastName`, `email`, `province`, `city`, `streetName`) VALUES
(5, 'Nisal', 'Sanjaya', 'nisal@gmail.com', 'Western', 'Colombo', 'Homagama'),
(6, 'Chaniru', 'Dewnith', 'chaniru@gmail.com', 'Kurunegala', 'Wandurugala', 'Colombo Road'),
(7, 'Gawranga', 'Fernando', 'gawranga@gmail.com', 'Central Provinc', ' Kandy City', 'Peradeniya Road'),
(8, 'Vidu', 'Nisalitha', 'vidu@gmail.com', 'Southern Provin', 'Galle City', 'Dutch Hospital Street'),
(9, 'Liana', 'Zulfik', 'liana@gmail.com', 'Western', 'Colombo', 'Maradana Road'),
(10, 'Jeevantha', 'Perera', 'jeevantha@gmail.com', 'Southern Provin', 'Galle', 'Wakwella Road'),
(11, 'Gihan', 'Chamod', 'gihan@gmail.com', 'Central Provinc', 'Kandy City', ' Peradeniya Road');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_telno`
--

CREATE TABLE `supplier_telno` (
  `supplierID` int(11) NOT NULL,
  `telNO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_telno`
--

INSERT INTO `supplier_telno` (`supplierID`, `telNO`) VALUES
(5, 714688992),
(6, 774527819),
(7, 712256732),
(8, 78332457),
(9, 712247859),
(10, 782347881),
(11, 712648993);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `password` varchar(70) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `password`, `firstName`, `lastName`, `email`) VALUES
(26, '$2y$10$SXxYgKtrAc/bkMTJ3Sg/TOJlyoPnlspBJgObnmSZ8w10AX8j/BYG2', 'Senan', 'Thenuka', 'senan@gmail.com'),
(29, '$2y$10$n95UtGjAHjpIxT9KU.3KHeKm3PxX1LTqzRvkwf8DjNOb6bLK39Ggu', 'Desan', 'Dinsanda', 'desandinsanda@gmail.com'),
(30, '$2y$10$JGNTCMct0dOa4oeWaFq66eN/VPoLjeihwsCwGI09tUyF7iSEafzeC', 'Dinistha', 'Ransilu', 'ransilu@gmail.com'),
(33, '$2y$10$/IzTC0fnJ7B0Q1cmfbS6i.uaDpXKFM8llo7E4iboq6933Si3zlYYm', 'Denura', 'Minulaka', 'denura.minulaka@gmail.com'),
(40, '$2y$10$XMuw3aTA6IYHpjG/CK4BEuCRFB9k8arWImXEVTHr86Qu/HFCZdO9C', 'Nethmi', 'Vidanapathirana', 'nethmi@gmail.com'),
(41, '$2y$10$JTa60/GqPE4YyTdfivImBOQmtlJPyhDfsjxF0cnDBrMRmGXV5SlUi', 'Hasindu', 'Eshan', 'hasindu@gmail.com'),
(50, '$2y$10$rdas4edCwHgOlk1uaU1peeuZAY0eJs2lPe0y76hIZsfuoZUoEMXfS', 'Hiruna', 'Dilmith', 'hiruna@gmail.com'),
(51, '$2y$10$faTixobSSParQ25dgjHAsOgD7nGKO5UkZP4T98ClOvU.n8JWLDnfK', 'Pasindu', 'Lakshan', 'pasindu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_telno`
--

CREATE TABLE `user_telno` (
  `ID` int(11) NOT NULL,
  `telNO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_telno`
--

INSERT INTO `user_telno` (`ID`, `telNO`) VALUES
(26, 784567992),
(29, 781455890),
(30, 772678330),
(33, 782277489),
(40, 87778987),
(41, 765839001),
(50, 7823673),
(51, 782455673);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `custom_package`
--
ALTER TABLE `custom_package`
  ADD PRIMARY KEY (`packageID`),
  ADD KEY `packageID` (`packageID`);

--
-- Indexes for table `custom_package_item`
--
ALTER TABLE `custom_package_item`
  ADD PRIMARY KEY (`itemID`,`custom_packageID`),
  ADD KEY `itemID` (`itemID`,`custom_packageID`),
  ADD KEY `custom_packageID` (`custom_packageID`);

--
-- Indexes for table `eventmanager`
--
ALTER TABLE `eventmanager`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faqID`);

--
-- Indexes for table `favorite_suppliers`
--
ALTER TABLE `favorite_suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplierID` (`supplierID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD PRIMARY KEY (`itemID`,`supplierID`),
  ADD KEY `itemID` (`itemID`,`supplierID`),
  ADD KEY `supplierID` (`supplierID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`,`pre_define_packageID`,`custom_packageID`),
  ADD KEY `pre_define_packageID` (`pre_define_packageID`),
  ADD KEY `custom_packageID` (`custom_packageID`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`packageID`);

--
-- Indexes for table `pre_define_package`
--
ALTER TABLE `pre_define_package`
  ADD PRIMARY KEY (`packageID`),
  ADD KEY `packageID` (`packageID`);

--
-- Indexes for table `pre_define_package_item`
--
ALTER TABLE `pre_define_package_item`
  ADD PRIMARY KEY (`itemID`,`pre_define_packageID`),
  ADD KEY `itemID` (`itemID`,`pre_define_packageID`),
  ADD KEY `pre_define_packageID` (`pre_define_packageID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `supplier_telno`
--
ALTER TABLE `supplier_telno`
  ADD PRIMARY KEY (`supplierID`,`telNO`),
  ADD KEY `supplierID` (`supplierID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_telno`
--
ALTER TABLE `user_telno`
  ADD PRIMARY KEY (`ID`,`telNO`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favorite_suppliers`
--
ALTER TABLE `favorite_suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `packageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `custom_package`
--
ALTER TABLE `custom_package`
  ADD CONSTRAINT `custom_package_ibfk_1` FOREIGN KEY (`packageID`) REFERENCES `package` (`packageID`);

--
-- Constraints for table `custom_package_item`
--
ALTER TABLE `custom_package_item`
  ADD CONSTRAINT `custom_package_item_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `item` (`itemID`),
  ADD CONSTRAINT `custom_package_item_ibfk_2` FOREIGN KEY (`custom_packageID`) REFERENCES `custom_package` (`packageID`);

--
-- Constraints for table `eventmanager`
--
ALTER TABLE `eventmanager`
  ADD CONSTRAINT `eventmanager_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `favorite_suppliers`
--
ALTER TABLE `favorite_suppliers`
  ADD CONSTRAINT `favorite_suppliers_ibfk_1` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE CASCADE;

--
-- Constraints for table `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD CONSTRAINT `item_supplier_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `item` (`itemID`),
  ADD CONSTRAINT `item_supplier_ibfk_2` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`pre_define_packageID`) REFERENCES `pre_define_package` (`packageID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`custom_packageID`) REFERENCES `custom_package` (`packageID`);

--
-- Constraints for table `pre_define_package`
--
ALTER TABLE `pre_define_package`
  ADD CONSTRAINT `pre_define_package_ibfk_1` FOREIGN KEY (`packageID`) REFERENCES `package` (`packageID`);

--
-- Constraints for table `pre_define_package_item`
--
ALTER TABLE `pre_define_package_item`
  ADD CONSTRAINT `pre_define_package_item_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `item` (`itemID`),
  ADD CONSTRAINT `pre_define_package_item_ibfk_2` FOREIGN KEY (`pre_define_packageID`) REFERENCES `pre_define_package` (`packageID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`);

--
-- Constraints for table `supplier_telno`
--
ALTER TABLE `supplier_telno`
  ADD CONSTRAINT `supplier_telno_ibfk_1` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

--
-- Constraints for table `user_telno`
--
ALTER TABLE `user_telno`
  ADD CONSTRAINT `user_telno_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
