-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2015 at 09:31 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `book_sharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `db_user_id` int(10) NOT NULL,
  `isbn` char(13) NOT NULL,
  `book_name` varchar(84) NOT NULL,
  `author` varchar(32) NOT NULL,
  `subject` varchar(18) NOT NULL,
  `edition` decimal(4,0) NOT NULL DEFAULT '1',
  `rent` int(5) NOT NULL DEFAULT '0',
  `sell` int(5) NOT NULL DEFAULT '0',
  `note_one` varchar(52) NOT NULL,
  `note_one_path` int(4) NOT NULL,
  `note_two` varchar(52) NOT NULL,
  `note_two_path` int(4) NOT NULL,
  KEY `isbn` (`isbn`),
  KEY `author` (`author`),
  KEY `book_name` (`book_name`),
  KEY `db_user_id` (`db_user_id`),
  KEY `rent` (`rent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`db_user_id`, `isbn`, `book_name`, `author`, `subject`, `edition`, `rent`, `sell`, `note_one`, `note_one_path`, `note_two`, `note_two_path`) VALUES
(4481, '1234', 'bookname', 'author', 'maths', '1', 0, 0, 'one', 1111, 'two', 2222),
(4481, 'none', 'best seller', 'paras', 'none', '1', 0, 0, 'none', 0, 'AkerlofMarketforLemons (1).pdf', 173),
(4481, 'none', 'apa style sheet', 'apa', 'none', '1', 0, 0, 'APA style checklist from psi chi', 196, 'apa.sample.docx', 364),
(4481, '1234', 'Deva ki kahani', 'Deva surya', 'none', '1', 0, 0, 'none', 0, 'none', 0),
(4481, '15', 'Koishore ka shore', 'Deva Surya', 'mohit publishers', '10', 0, 0, 'none', 0, 'none', 0),
(4481, '15', 'Koishore ka shore', 'Deva Surya', 'mohit publishers', '10', 0, 0, 'none', 0, 'none', 0),
(4481, '1234548', 'Ashokas ashok', 'Student govt', 'mohit publishers', '15', 0, 0, 'none', 0, 'none', 0),
(4481, '456', 'Computer Science', 'abc', 'abc', '12', 0, 0, 'none', 0, 'none', 0),
(5997, '4242', 'Autobio', 'Deva surya', 'Mohit ', '10', 0, 0, 'none', 0, 'none', 0),
(752, '1212', 'Harry Potter', 'J.K Rowling', 'Bloomsbury', '10', 100, 100, 'none', 0, 'none', 0),
(752, '101', 'cs', 'cs', 'cs society', '1', 100, 120, '01 (1).jpg', 909, 'none', 0),
(7378, '123', 'abc', 'abc', 'abc', '2', 100, 100, 'none', 0, 'none', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE IF NOT EXISTS `rent` (
  `db_user_id` int(10) NOT NULL,
  `book_id` int(5) NOT NULL,
  `price_rent` int(5) NOT NULL,
  KEY `db_user_id` (`db_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE IF NOT EXISTS `sell` (
  `db_user_id` int(10) NOT NULL,
  `book_id` int(5) NOT NULL,
  `price_sell` int(5) NOT NULL,
  KEY `db_user_id` (`db_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `db_user_id` int(6) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(130) NOT NULL,
  PRIMARY KEY (`db_user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`db_user_id`, `firstname`, `surname`, `email`, `password`) VALUES
(752, 'Anavi', 'Kajla', 'anavi1235@gmail.com', '123'),
(5997, 'Deva ', 'Surya', 'vivek.madala@gmail.com', '44'),
(7378, 'Paras', 'Bhattrai', 'paras.bhattrai@ashoka.edu.in', '08856a9022cc1f4b7c90b2d059e64acb6f6c5ac11da907d86db6a3072e9d821c59603c1ea94a2e537bea0a38320d678c482a66eaaf1a79c4d3432ea41e51b721');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
