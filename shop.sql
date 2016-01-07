-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 06 Sty 2016, 21:14
-- Wersja serwera: 5.5.21-log
-- Wersja PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(4) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Odzież męska'),
(2, 'Odzież damska'),
(3, 'Obuwie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_page`
--

CREATE TABLE IF NOT EXISTS `category_page` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `category_page`
--

INSERT INTO `category_page` (`id`, `category_name`) VALUES
(1, 'Pasek główny'),
(2, 'O sklepie'),
(3, 'Informacje dodatkowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `product_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `comment` text NOT NULL,
  `rate` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `comment`, `rate`, `date`) VALUES
(21, 25, 82, 'Super buty', 5, '2016-01-06 21:04:10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `d_product`
--

CREATE TABLE IF NOT EXISTS `d_product` (
  `id` int(11) NOT NULL,
  `product_id` int(8) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `d_product`
--

INSERT INTO `d_product` (`id`, `product_id`) VALUES
(0, 25);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `last_ordered`
--

CREATE TABLE IF NOT EXISTS `last_ordered` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `user_id` int(8) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(4) NOT NULL,
  `active` int(8) NOT NULL,
  `status` enum('złożono','przyjęto','wysłano') CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `product_id` int(8) NOT NULL,
  `order_details_id` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=262 ;

--
-- Zrzut danych tabeli `last_ordered`
--

INSERT INTO `last_ordered` (`id`, `price`, `user_id`, `product_name`, `quantity`, `active`, `status`, `date`, `product_id`, `order_details_id`) VALUES
(261, 300, 82, 'Reebok', 1, 1, 'złożono', '2016-01-06 21:03:08', 29, 180);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `logo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `logo`
--

INSERT INTO `logo` (`id`, `logo`) VALUES
(1, 'img/logo/logo.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `readed` tinyint(1) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `date` datetime NOT NULL,
  `seller` tinyint(1) NOT NULL,
  `display_user` tinyint(1) NOT NULL,
  `display_seller` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=377 ;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `readed`, `message`, `date`, `seller`, `display_user`, `display_seller`) VALUES
(375, 82, 0, 'Wiadomość testowa 1', '2016-01-06 21:02:56', 0, 1, 1),
(376, 82, 0, 'Ok!', '2016-01-06 21:05:05', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `$product_id` int(11) NOT NULL,
  PRIMARY KEY (`$product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `product_id` int(8) NOT NULL,
  `quantity` int(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_method_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `order_nr` varchar(20) NOT NULL,
  `status` enum('złożono','przyjęto','wysłano','') CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `display_seller` tinyint(1) NOT NULL,
  `display_user` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=181 ;

--
-- Zrzut danych tabeli `order_details`
--

INSERT INTO `order_details` (`id`, `shipping_method_id`, `address`, `order_nr`, `status`, `date`, `display_seller`, `display_user`) VALUES
(180, 1, 'Imie: Adam Nazwisko: Stanulewicz Kraj: Polska Kod-Pocztowy: 14-100 Miasto: Ostróda Ulica : Gizewiusza Nr domu: 13 Nr mieszkania: 2', '8214521106033', 'złożono', '2016-01-06 21:03:23', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(30) NOT NULL,
  `title` text NOT NULL,
  `header` text NOT NULL,
  `style` longtext NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `title`, `header`, `style`, `content`) VALUES
(1, 'Kontakt', 'Kontakt', '<script src="https://maps.googleapis.com/maps/api/js"></script>\r\n<script>\r\n\r\nfunction initialize() {\r\n\r\nvar myLatlng = \r\nnew google.maps.LatLng(53.706507, 19.968904);\r\n\r\n        var mapCanvas = document.getElementById(''map'');\r\n        var mapOptions = {\r\n          center: myLatlng,\r\n          zoom: 15,\r\n          mapTypeId: google.maps.MapTypeId.ROADMAP\r\n        }\r\n        var map = new google.maps.Map(mapCanvas, mapOptions);\r\n\r\nvar marker = new google.maps.Marker({\r\n    position: myLatlng,\r\n    title:"Mój sklep"\r\n});\r\n\r\nmarker.setMap(map);\r\n\r\n      }\r\n      google.maps.event.addDomListener(window, ''load'', initialize);\r\n\r\n\r\n    </script>', '      #map {\r\n        width: 100%;\r\n        height: 400px;\r\n      }\r\n      h3 {\r\n        border-bottom:1px solid #494E57; \r\n        padding-bottom:5px;\r\n      }\r\n      ul.address {\r\n        padding-left:0;\r\n      }\r\n      ul.address li {\r\n        font-size:0.8em;\r\n        list-style:none;\r\n      }\r\n', '<h3>Jak dotrzeć</h3>\r\n<ul class="address">\r\n<li><strong>Adres:</strong><br /> 14-100 Ostr&oacute;da <br /> Gizewiusza 13/2</li>\r\n<li><strong>E-mail:</strong><br /> adam.stanulewicz@wp.pl</li>\r\n<li><strong>Telefon:</strong> 513196308</li>\r\n</ul>\r\n<div id="map">&nbsp;</div>'),
(2, 'Strona testowa', '', '', 'h3 {color:green;}', '<h3>To jest strona testowa !</h3>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_id_category_id`
--

CREATE TABLE IF NOT EXISTS `page_id_category_id` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(4) NOT NULL,
  `page_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Zrzut danych tabeli `page_id_category_id`
--

INSERT INTO `page_id_category_id` (`id`, `category_id`, `page_id`) VALUES
(79, 1, 1),
(80, 3, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(8) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(3) NOT NULL,
  `product_sub_category_id` int(3) NOT NULL,
  `product_name` varchar(140) NOT NULL,
  `product_description` longtext NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_quantity` int(8) NOT NULL,
  `product_price` float NOT NULL,
  `product_added` datetime NOT NULL,
  `product_sold` int(6) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`product_id`, `product_category_id`, `product_sub_category_id`, `product_name`, `product_description`, `product_image`, `product_quantity`, `product_price`, `product_added`, `product_sold`) VALUES
(24, 1, 1, 'Bluza Nike', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales nisi massa, nec tristique massa malesuada sit amet. Aenean eget congue dui. Ut vitae justo ipsum. Nunc hendrerit est non arcu dapibus, eget vestibulum ligula lacinia. Nulla tristique ullamcorper blandit. Etiam pharetra facilisis odio eu varius.', 'img/produkty/14521084124942bluza_nike.png', 10, 199, '2016-01-06 20:26:52', 0),
(25, 3, 3, 'Buty adidas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales nisi massa, nec tristique massa malesuada sit amet. Aenean eget congue dui. Ut vitae justo ipsum. Nunc hendrerit est non arcu dapibus, eget vestibulum ligula lacinia. Nulla tristique ullamcorper blandit. Etiam pharetra facilisis odio eu varius.', 'img/produkty/14521085404328adidas_1.jpg', 4, 250, '2016-01-06 20:29:00', 0),
(26, 3, 3, 'Buty adidas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales nisi massa, nec tristique massa malesuada sit amet. Aenean eget congue dui. Ut vitae justo ipsum. Nunc hendrerit est non arcu dapibus, eget vestibulum ligula lacinia. Nulla tristique ullamcorper blandit. Etiam pharetra facilisis odio eu varius.', 'img/produkty/14521087015296adidas_zx_750.png', 3, 299, '2016-01-06 20:31:41', 0),
(27, 2, 1, 'Bluza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales nisi massa, nec tristique massa malesuada sit amet. Aenean eget congue dui. Ut vitae justo ipsum. Nunc hendrerit est non arcu dapibus, eget vestibulum ligula lacinia. Nulla tristique ullamcorper blandit. Etiam pharetra facilisis odio eu varius.', 'img/produkty/14521088491832bluza_1.jpg', 1, 100, '2016-01-06 20:34:09', 0),
(29, 3, 3, 'Reebok', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales nisi massa, nec tristique massa malesuada sit amet. Aenean eget congue dui.', 'img/produkty/14521090087333reebok_1.jpg', 2, 300, '2016-01-06 20:36:48', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_additional_images`
--

CREATE TABLE IF NOT EXISTS `product_additional_images` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `product_id` int(8) NOT NULL,
  `product_image` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_additional_info`
--

CREATE TABLE IF NOT EXISTS `product_additional_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Zrzut danych tabeli `product_additional_info`
--

INSERT INTO `product_additional_info` (`id`, `product_id`, `name`, `value`) VALUES
(80, 24, 'Rozmiar', 'XXL'),
(81, 25, 'rozmiar', '47'),
(82, 26, 'rozmiar', '42'),
(83, 27, 'rozmiar S', ''),
(85, 29, 'rozmiar', '42'),
(86, 29, 'kolor', 'czarny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `promotions`
--

CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `product_id` int(5) NOT NULL,
  `percent` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shippment_methods`
--

CREATE TABLE IF NOT EXISTS `shippment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cost` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `shippment_methods`
--

INSERT INTO `shippment_methods` (`id`, `name`, `cost`) VALUES
(1, 'Za pobraniem', 15),
(2, 'Przelew', 25);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `slider`
--

INSERT INTO `slider` (`id`, `product_id`) VALUES
(5, 27),
(6, 24);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `sub_categories`
--

INSERT INTO `sub_categories` (`category_id`, `category_name`) VALUES
(1, 'bluzy'),
(2, 'spodnie'),
(3, 'sportowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `login` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `activated` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `activated`) VALUES
(82, 'adam88', '605595cba3f6171df2e1a804c8264e15', 'adam.stanulewicz@wp.pl', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_extensions`
--

CREATE TABLE IF NOT EXISTS `users_extensions` (
  `user_id` int(8) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `house_nr` int(5) DEFAULT NULL,
  `appart_nr` int(5) DEFAULT NULL,
  `registration_date` datetime NOT NULL,
  `last_visit` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone_nr` varchar(12) DEFAULT NULL,
  `zip_code` varchar(10) NOT NULL,
  `street` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_extensions`
--

INSERT INTO `users_extensions` (`user_id`, `firstname`, `surname`, `country`, `city`, `house_nr`, `appart_nr`, `registration_date`, `last_visit`, `photo`, `phone_nr`, `zip_code`, `street`) VALUES
(70, 'Adam', 'Stanulewicz', 'Polska', 'Ostróda', 13, 2, '2015-10-11 23:57:04', '2016-01-06 19:56:07', '', '513196308', '14-100', 'Gizewiusza'),
(82, 'Adam', 'Stanulewicz', 'Polska', 'Ostróda', 13, 2, '2016-01-06 20:55:59', '2016-01-06 21:04:29', '', '513196308', '14-100', 'Gizewiusza'),
(83, '', '', '', '', 0, 0, '2016-01-06 21:00:38', '0000-00-00 00:00:00', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_to_change`
--

CREATE TABLE IF NOT EXISTS `users_to_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rand` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
