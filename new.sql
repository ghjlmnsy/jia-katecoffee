-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 12:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `coffee_products`
--

CREATE TABLE `coffee_products` (
  `id` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `serving_size` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `recommended_pairings` varchar(255) DEFAULT NULL,
  `popularity` varchar(300) NOT NULL,
  `availability` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffee_products`
--

INSERT INTO `coffee_products` (`id`, `product_image`, `product_name`, `type`, `description`, `serving_size`, `price`, `recommended_pairings`, `popularity`, `availability`) VALUES
(16, 'uploads/cappu.jpg', 'Vanilla Cappuccino', 'hot drinks', 'The best combination of coffee and vanilla flavours.', '120 ml', 150.00, 'Croissant', '☆☆☆☆☆', 'Available'),
(17, 'uploads/hotchoc.jpg', 'Hot Chocolate', 'hot drinks', 'A heated drink that tastes rich and chocolatey', '120 ml', 150.00, 'Sponge Cake', '☆☆☆☆', 'Available'),
(18, 'uploads/macc.jpg', 'Caramel Macchiato', 'hot drinks', 'Freshly steamed milk with vanilla-flavored syrup marked with espresso', '120 ml', 150.00, 'Bagel', '☆☆☆☆☆', 'Available'),
(19, 'uploads/americano.jpg', 'Caffe Americano', 'hot drinks', 'Espresso shots topped with hot water create a light layer of crema', '120 ml', 150.00, 'Red Velvet', '☆☆☆☆', 'Available'),
(20, 'uploads/Hazelnut Bianco.png', 'Hazelnut Bianco Latte', 'hot drinks', 'A wonderfully light-colored espresso drink with accents of hazelnut flavors', '120 ml', 180.00, 'Glazed Donut', '☆☆☆☆☆', 'Available'),
(21, 'uploads/matcha.jpg', 'Matcha Latte', 'hot drinks', 'A tea-based beverage combining vivid green matcha tea powder and milk', '120 ml', 180.00, 'Glazed Donut', '☆☆☆☆', 'Available'),
(22, 'uploads/dolcelatte.png', 'Cinnamon Latte', 'hot drinks', 'Cinnamon dolce-flavored with sweetened whipped cream', '120 ml', 180.00, 'Alcapone', '☆☆☆☆', 'Available'),
(23, 'uploads/blonde.jpg', 'Blonde Vanilla Latte', 'hot drinks', 'A  fluffy frothed milk and delicious vanilla syrup come together', '120 ml', 180.00, 'Sponge Cake', '☆☆☆', 'Not Available'),
(24, 'uploads/bento rose.jpg', 'Strawberry Bento Cake', 'cake', 'A mini cakes that are perfect for individual serving', '2x4 inch', 270.00, 'Javachip Frappuccino', '☆☆☆', 'Not Available'),
(25, 'uploads/redvelvet.jpg', 'Red Velvet Cake', 'cake', 'Tastes like very mild cocoa with a slightly tart edge.', '1 slice', 180.00, 'Pink Drink Beverage', '☆☆☆', 'Not Available'),
(26, 'uploads/blueberry.png', 'Blueberry Cheesecake', 'cake', 'A layered blue berry dessert set in a graham cracker crust.', '1 slice', 180.00, 'Mocha Crumble Frappuccino', '☆☆☆☆', 'Available'),
(27, 'uploads/sw2.jpg', 'Strawberry Shortcake', 'cake', 'A biscuit-like cake or scone that is split and filled with strawberries.', '2x4 inch', 250.00, 'Strawberry Acai Lemonade', '☆☆☆☆', 'Available'),
(28, 'uploads/sans.jpg', 'Sans Rival', 'cake', 'A Filipino dessert cake made of layers of buttercream, meringue and chopped cashews', '1 slice', 140.00, 'Javachip Frappuccino', '☆☆☆☆☆', 'Available'),
(29, 'uploads/smores.jpg', 'Smores Cake', 'cake', 'This captures that delicious roasted marshmallow, chocolate bar, and graham cracker taste to perfection.', '1 slice', 160.00, 'Iced Caffe Mocha', '☆☆☆☆☆', 'Available'),
(30, 'uploads/sponge.jpg', 'Sponge Cake', 'cake', 'A delicate, spongy cake with a uniform crumb that is made with eggs, sugar, and flour. ', '1 slice', 120.00, 'Mocha Crumble Frappuccino', '☆☆☆', 'Available'),
(31, 'uploads/snickers.png', 'Snickers Cake', 'cake', 'This snickers cake is a layered moist chocolate cake. It is filled with peanut butter frosting and chopped snickers.', '1 slice', 180.00, 'Blonde Vanilla Latte', '☆☆☆☆', 'Available'),
(32, 'uploads/jav frap.jpg', 'Java Chips \r\nFrappuccino', 'frappe', 'Rich, chocolatey chips punctuate a cool, refreshing blend of coffee.', '354 ml', 160.00, 'Pork Floss Buns', '☆☆☆', 'Available'),
(33, 'uploads/chai frap.jpg', 'Chai Creme Frappuccino', 'frappe', 'A creamy blend of spicy classic chai, milk and ice. ', '354 ml', 160.00, 'Dark Almond Doughnut', '☆☆☆', 'Not Available'),
(34, 'uploads/car frap.jpg', 'Caramel Ribbon Frappuccino', 'frappe', 'Buttery caramel syrup blended with coffee, milk and ice.', '354 ml', 160.00, 'Caramel Cinnamon Roll', '☆☆☆☆☆', 'Available'),
(35, 'uploads/moc frap.jpg', 'Mocha Crumble Frappuccino', 'frappe', 'Roast coffee, mocha sauce, and Frappuccino chips', '354 ml', 160.00, 'Strawberry Shortcake', '☆☆☆☆', 'Not Available'),
(36, 'uploads/flossbun.jpg', 'Pink Floss Buns', 'bread', 'A soft and fluffy bread topped with pork floss.', '1 piece', 65.00, 'Iced Maple', '☆☆☆', 'Not Available'),
(37, 'uploads/cross.jpg', 'Croissant', 'bread', 'Chocolate wrapped with soft, flaky layers and a golden-brown crust.', '1 piece', 80.00, 'Hot Chocolate', '☆☆☆☆', 'Available'),
(38, 'uploads/bagel.jpg', 'Bagel', 'bread', 'Classic soft, chewy and thick New York–style bagel. ', '1 piece', 55.00, 'Iced Flat White', '☆☆☆', 'Not Available'),
(39, 'uploads/cinna.png', 'Caramel Cinnamon Roll', 'bread', 'A sweet baked dough filled with a cinnamon-sugar filling.', '1 piece', 110.00, 'Paradise Drink', '☆☆☆☆☆', 'Available'),
(40, 'uploads/oreo.png', 'White Oreo Dougnut', 'bread', 'A pillowy fried Oreo studded dough topped with cream cheese icing.', '1 piece', 80.00, 'Hazelnut Bianco Latte', '☆☆☆☆☆', 'Available'),
(41, 'uploads/donut.jpg', 'Glazed Donut', 'bread', 'Old-fashioned cake doughnut glazed with sweet icing.', '1 piece', 80.00, 'Mocha Crumble Frappuccino', '☆☆☆☆☆', 'Available'),
(42, 'uploads/alca.png', 'Alcapone', 'bread', 'A soft bite donut topped with Belgian white chocolate and roasted slices', '1 piece', 80.00, 'Pineapple Passionfruit', '☆☆☆☆', 'Not Available'),
(43, 'uploads/chodonut.png', 'Dark Almond Doughnut', 'bread', 'Dark Chocolate Icing topped with almond slices.', '1 piece', 80.00, 'Pink Drink Beverage', '☆☆☆☆☆', 'Available'),
(44, 'uploads/pinkd.png', 'Pink Drink Beverage', 'cold drinks', 'A bold fruit flavor of strawberry combined with coconut milk', '200 ml', 160.00, 'Sans Rival', '☆☆☆☆', 'Not Available'),
(45, 'uploads/paradise.png', 'Paradise Drink', 'cold drinks', 'Tropical flavors of diced pineapple and creamy coconut milk', '200 ml', 160.00, 'Smores Cake', '☆☆☆☆☆', 'Not Available'),
(46, 'uploads/passion.png', 'Pineapple Passionfruit', 'cold drinks', 'A tangy, fruit-forward blend of passionfruit and pineapple juices', '200 ml', 160.00, 'Glazed Donut', '☆☆☆☆', 'Available'),
(47, 'uploads/sal.png', 'Strawberry Lemonade', 'cold drinks', 'Strawberry flavors and açaí notes with the delightful zing of lemonade.', '200 ml', 160.00, 'Snickers Cake', '☆☆☆☆☆', 'Available'),
(48, 'uploads/maple.jpg', 'Iced Maple', 'cold drinks', '100% pure maple syrup and non-dairy/vegan creamer', '160 ml', 195.00, 'Strawberry Bento Cake', '☆☆☆☆', 'Available'),
(49, 'uploads/flatwhite.png', 'Iced Flat White', 'cold drinks', 'A type of espresso-based drink that is made with less milk than an iced latte.', '160 ml', 195.00, 'Dark Almond Doughnut', '☆☆☆', 'Available'),
(50, 'uploads/imocha.png', 'Iced Caffe Mocha', 'cold drinks', 'The classic iced coffee drink that always sweetly satisfies.', '160 ml', 195.00, 'Caramel Cinnamon Roll', '☆☆☆☆', 'Not Available'),
(51, 'uploads/ssespresson.png', 'Iced Shaken Espresso', 'cold drinks', 'Made with the rich, full-bodied espresso you love—then shaken.', '160 ml', 195.00, 'White Oreo Doughnut', '☆☆☆☆☆', 'Not Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffee_products`
--
ALTER TABLE `coffee_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffee_products`
--
ALTER TABLE `coffee_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
