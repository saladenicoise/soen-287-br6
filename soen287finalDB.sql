-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2020 at 12:59 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soen287final`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `Book_ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `due_date` datetime NOT NULL,
  `reminder_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`Book_ID`, `username`, `creation_date`, `due_date`, `reminder_date`) VALUES
(27, 'soen287Dev', '2020-12-07 18:23:35', '2020-12-26 18:23:00', '2020-12-24 18:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `contactforms`
--

CREATE TABLE `contactforms` (
  `Form_ID` smallint(6) NOT NULL COMMENT 'Primary Key',
  `contactName` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of the writer',
  `contactNumber` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Phone number of writer',
  `contactEmail` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email of writer',
  `contactAddress` varchar(400) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Address of writer',
  `contactSubject` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Subject of message',
  `contactMessage` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customizationoptions`
--

CREATE TABLE `customizationoptions` (
  `customId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customOption1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customOption2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customOption3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customOption4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customOption5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customOption6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customizationoptions`
--

INSERT INTO `customizationoptions` (`customId`, `customOption1`, `customOption2`, `customOption3`, `customOption4`, `customOption5`, `customOption6`) VALUES
('_1c5d0d53fd3cf19abf', 'Tomatoes', 'Onions', NULL, 'Bacon', NULL, NULL),
('_6fb102f8b43edc3bee', 'Tomatoes', 'Onions', 'Ham', 'Cheese', 'Peppers', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `productID` int(11) NOT NULL COMMENT 'ID of Product',
  `productName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double NOT NULL,
  `isVeg` int(4) NOT NULL,
  `isGf` int(4) NOT NULL,
  `customId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Category of Product',
  `subcategory` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The sub category, main category is like: menu or categring, whilst sub is like salad',
  `imagePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Path to image',
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`productID`, `productName`, `cost`, `isVeg`, `isGf`, `customId`, `category`, `subcategory`, `imagePath`, `description`) VALUES
(1, 'Fish Dish', 12.55, 0, 0, '_1c5d0d53fd3cf19abf', 'Shop', 'Main', 'fish.png', 'Atlantic Haddock Fish Cakes wit boiled sea-salted baby potatoes, buttery carrots & edamame, garlic, onion, peppers, and sour cream dill dipping sauce on the side'),
(3, 'Chicken Dish', 12.55, 0, 0, '_d4d08999e2421fe7b4', 'Shop', 'Main', 'chicken.png', 'Indian Butter Chicken w/ masala, tumeric, cumin, chili powder, ginger, garlic, caramelized onions, crushed tomatoes, kasoori methi, and basmati rice, topped with fresh coriander'),
(5, 'Guest Choice', 12.55, 0, 0, NULL, 'Shop', 'Main', 'tao.png', 'Kung Pao Pork | Corn Starch Dredged Pork Chunks | Deep Fried | Carrot | Onion | Celery | Peas | Fried Rice | Soy | Sesame | Topped With Peanuts ***Can be done without nuts'),
(7, ' Pasta Primavera', 12.55, 1, 0, NULL, 'Shop', 'Main', 'pasta.png', 'Our Linguine Primavera With Creamy Lemon Sauce | Lemon Zest | Asparagus | Peppers | Cherry Tomatoes | Peas'),
(9, 'Chefs Choice', 12.55, 0, 0, NULL, 'Shop', 'Main', 'burrito.png', 'Despacito Cooked Beef & Pork Burritos | Brown Rice | Black Beans | Corn | Mexican Seasoning | Chipotle | Lime | Tex Mex Cheese | Tortillas | Salsa On The Side'),
(11, 'Andalouse Soup', 11.55, 1, 0, NULL, 'Shop', 'Entree', 'tomsoup.png', 'Chef\'s Creamy Andalouse Soup | Tomato | Carrot | Onion | Celery | Chicken Broth | Cream | Corn Niblets | Diced Peppers\r\n'),
(13, 'Onion Soup', 11.55, 1, 0, NULL, 'Shop', 'Entree', 'onion.png', 'Our Onion Soup | Caramelized Onion | Dry White Wine | Thyme | Bay Leaf | Beef Broth | Garlic Crostinis On The Side '),
(15, 'Thai Buddha Bowl ', 11.75, 1, 0, NULL, 'Shop', 'Entree', 'thaisalad.png', 'Thai Quinoa & Tofu Buddha Bowl | Canadian Quinoa | Grilled Seasoned Tofu | Pineapple | Chopped Radicchio | Snow Peas | Bean Sprouts | Peppers | Sweet Thai Chili Dressing'),
(17, 'Broccoli Salad', 11.75, 1, 0, NULL, 'Shop', 'Entree', 'broccoli.png', 'Creamy Broccoli Salad | Fresh Grapes | Toasted Almonds | Sun dried Craisins | Pomegranates | Apples | Creamy Poppy Seed Dressing'),
(19, 'Choco Cheesecake', 6.55, 0, 0, NULL, 'Shop', 'Dessert', 'choco.png', 'Hot Chocolate Marshmallow Cheesecake In A Mason Jar'),
(21, 'Candy Cane Bark', 6.55, 0, 0, NULL, 'Shop', 'Dessert', 'bark.png', 'Festive Peppermint Candy Cane Bark'),
(23, 'Pasta Sauce', 11.55, 1, 0, NULL, 'Shop', 'New', 'sauce.png', 'Vongole Sauce | Clams | White Wine | San Marzano Tomatoes | Green Onions | Garlic | Touch Of Chili Flakes'),
(25, 'Smoothie Bowl', 13.75, 1, 0, NULL, 'Shop', 'New', 'smoothie.png', 'Weekly Smoothie Bowl'),
(26, 'Chad Omelet', 150, 1, 0, NULL, 'Catering', 'Appetizers', 'a.png', 'CHAD'),
(27, 'Cheeseburger Not From Macdonalds', 1000, 0, 1, '_a26c83119e6de1ccf8', 'Catering', 'Platters', 'i.png', 'HAPPY MEAL'),
(28, 'Spaghetti', 150, 1, 0, NULL, 'Catering', 'Pastas', 'k.png', 'Cloudy with a chance of meatballs'),
(29, 'Apple', 7485, 1, 1, NULL, 'Catering', 'Salads', 'r.png', 'Honey Crisp is best!'),
(30, 'Watermelon', 88888888, 1, 0, NULL, 'Catering', 'Desserts', 'f.png', 'IDK'),
(33, 'Chicken Sandwich', 1000000, 1, 0, '_c1a7efd3bcf7b1eced', 'Catering', 'Grazing', 'j.png', 'A THICK chicken sandwich'),
(34, 'Napolitan', 1500, 1, 1, '', 'Catering', 'Buffet', 'h.png', 'Fun Fact: Pizza grows on trees in italy!');

-- --------------------------------------------------------

--
-- Table structure for table `orderitemtable`
--

CREATE TABLE `orderitemtable` (
  `Order_Item_ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `cost` double NOT NULL,
  `username` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitemtable`
--

INSERT INTO `orderitemtable` (`Order_Item_ID`, `Order_ID`, `productName`, `cost`, `username`, `product_size`, `quantity`) VALUES
(19, 29, 'Smoothie Bowl', 13.75, 'soen287Dev', 'Single Size', 2),
(20, 30, 'Onion Soup', 11.55, 'soen287Dev', 'Single Size', 1),
(21, 30, 'Thai Buddha Bowl ', 11.75, 'soen287Dev', 'Single Size', 1),
(22, 31, 'Watermelon', 88888888, 'TheDevAccount2', 'Single Size', 1),
(23, 31, 'Chad Omelet', 150, 'TheDevAccount2', 'Single Size', 1),
(24, 31, 'Fish Dish', 12.55, 'TheDevAccount2', 'Single Size', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE `ordertable` (
  `Order_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Username to keep track of who performed the order',
  `totalItems` int(11) NOT NULL COMMENT 'total number of items in order',
  `totalCost` double NOT NULL COMMENT 'total cost of items in order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordertable`
--

INSERT INTO `ordertable` (`Order_ID`, `username`, `totalItems`, `totalCost`) VALUES
(29, 'soen287Dev', 2, 27.5),
(30, 'soen287Dev', 2, 23.3),
(31, 'TheDevAccount2', 3, 88889050.55);

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` int(4) NOT NULL,
  `resetToken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resetTimer` time DEFAULT NULL COMMENT 'The current time at which the reset token was issued, time limit of 30 mins'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`username`, `password`, `isAdmin`, `resetToken`, `email`, `resetTimer`) VALUES
('liamc', '$2y$10$rtGd/cziQO36q3Lo3rgrVefoBpn.n9ARYIducT5RWt45XEwemPyeC', 1, NULL, '', NULL),
('ra_shang', '$2y$12$0/QpwACJvZMo3fn1bPBYVOT47HqN6qFQ4e66d1qAC7BRsxJY1Y.82', 1, NULL, '', NULL),
('jpatel02', '$2y$12$Z1vz8w5.MVDEBud0HuDktuL0SmFRS3NIe.60/moiAbGAwQhGXeAiG', 1, NULL, '', NULL),
('TheCeaserSalad', '$2y$12$BhUO1diOlx9aGBopHrbbVuN4AiB9UYMlTzgtH5nHv/Asp3qzQ2VZ6', 1, NULL, '', NULL),
('lcat11', '$2y$12$WK9kiiBtjWeaLOxTwi7kv.HHYMSPabJXLeCiPHin/699C5Ulu03yu', 1, NULL, '', NULL),
('TheDevAccount2', '$2y$12$UrbGrX1rcu8QntoiXh3foeaEoGtT66PZ7xJ9spbgM3AQ5my6D6ga6', 1, '5muloRo4uBzjX6uTxt3E3Io7N65dTemACzuoOs0n7g=', 'happygero7@gmail.com', NULL),
('TheTestAccount', '$2y$12$Vd281WIaJM2tR3njH0cx6.Pk6pO2z5Mhp/54ZWPvXx8CYpyZUW58a', 0, 'HXbgti9lFd9lsQh0lXEEmqIR6k1xQlyVBbIRCZdprY=', 'jules.laptop@gmail.com', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`Book_ID`);

--
-- Indexes for table `contactforms`
--
ALTER TABLE `contactforms`
  ADD PRIMARY KEY (`Form_ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `orderitemtable`
--
ALTER TABLE `orderitemtable`
  ADD PRIMARY KEY (`Order_Item_ID`);

--
-- Indexes for table `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`Order_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `Book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contactforms`
--
ALTER TABLE `contactforms`
  MODIFY `Form_ID` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of Product', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `orderitemtable`
--
ALTER TABLE `orderitemtable`
  MODIFY `Order_Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
