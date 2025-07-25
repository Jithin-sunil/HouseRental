-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 11:52 AM
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
-- Database: `db_miniproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(25) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(5, 'mary archana pj', 'maryarcahan@gamil.com', 'jungkook');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_amount` varchar(400) NOT NULL,
  `booking_date` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `house_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_amount`, `booking_date`, `booking_status`, `house_id`, `user_id`) VALUES
(1, '', '2025-07-17', 1, 1, 3),
(4, '', '2025-07-24', 2, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(2, 'bba'),
(3, 'mca');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE `tbl_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_content` varchar(500) NOT NULL,
  `chat_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `from_uid` varchar(40) NOT NULL,
  `to_uid` varchar(40) NOT NULL,
  `from_oid` varchar(40) NOT NULL,
  `to_oid` varchar(40) NOT NULL,
  `chat_file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_titile` varchar(225) NOT NULL,
  `complaint_reply` varchar(400) NOT NULL,
  `complaint_status` int(11) NOT NULL,
  `complaint_date` varchar(11) NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `complaint_content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_titile`, `complaint_reply`, `complaint_status`, `complaint_date`, `user_id`, `owner_id`, `complaint_content`) VALUES
(8, 'hello', '', 0, '2025-07-17', 3, 0, 'hkgjv'),
(9, '', 'jhgfhjfhku', 0, '2025-07-24', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(3, 'Kottayam'),
(5, 'Ernakulam'),
(6, 'Idukki'),
(7, 'Kannur'),
(8, 'Thrissur ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(400) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_content`, `user_id`, `owner_id`) VALUES
(6, 'gyutuy', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `gallery_photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`gallery_id`, `house_id`, `gallery_photo`) VALUES
(1, 1, '5a86a43d-4345-4314-b0c6-eece6067ccfe.jpg'),
(2, 1, '16c2b34d-66ab-48d1-93f7-e3b15b867c3f.jpg'),
(3, 1, '48eeb2c3-51f0-419a-ad37-f43fcf935ebb.jpg'),
(5, 4, ''),
(6, 5, 'Ai Generated House decoration living room photo.jpg'),
(7, 5, 'ca02f6c6-b6be-4cc1-88a0-1bbca53cde64.jpg'),
(8, 5, '29 Trendy Contemporary Modern Living Room Elements.jpg'),
(9, 6, ''),
(10, 9, '6eb57ed2-ffee-4217-8caa-d83e7d688431.jpg'),
(11, 9, '36336ce0-a12f-4e71-b23e-b157d023af42.jpg'),
(12, 3, '18bb51e0-0f40-4bf6-900d-9bfd2d76fe3a.jpg'),
(13, 3, '7b2d3aa8-5a37-489b-8a92-4f20c606702d.jpg'),
(14, 5, '18bb51e0-0f40-4bf6-900d-9bfd2d76fe3a.jpg'),
(15, 5, 'b27347b1-1f10-4a85-9ae1-faec86739e73.jpg'),
(16, 7, '5d18019b-c3f4-4454-a222-474e121ee080.jpg'),
(18, 0, '7b2d3aa8-5a37-489b-8a92-4f20c606702d.jpg'),
(21, 8, '7b2d3aa8-5a37-489b-8a92-4f20c606702d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_house`
--

CREATE TABLE `tbl_house` (
  `house_id` int(11) NOT NULL,
  `house_description` varchar(200) NOT NULL,
  `house_photo` varchar(500) NOT NULL,
  `house_amount` varchar(56) NOT NULL,
  `house_postdate` varchar(20) NOT NULL,
  `house_status` int(70) NOT NULL DEFAULT 0,
  `owner_id` int(11) NOT NULL,
  `housetype_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_house`
--

INSERT INTO `tbl_house` (`house_id`, `house_description`, `house_photo`, `house_amount`, `house_postdate`, `house_status`, `owner_id`, `housetype_id`, `place_id`, `type_id`) VALUES
(1, 'Luxury Living Redefined: Exquisite Waterfront Estate With Private Dock', 'Didier Assogba.jpg', '5098765', '2025-07-16', 0, 0, 4, 5, 1),
(2, 'Serenity Awaits: Secluded Mountain Retreat With Panoramic Views', '5b3acb6a-3307-4208-8291-6eca7fd851b5.jpg', '900000', '2025-07-16', 0, 0, 7, 6, 2),
(3, 'Don’t Miss Out! Rare Opportunity: Stunning Beachfront Property at Unbeatable Price', 'Discover luxury and extraordinary house exteriors… (1).jpg', '89000000', '2025-07-16', 0, 0, 8, 7, 3),
(4, 'Embrace the epitome of luxury living with this exquisite 4 boasting unparalleled views and world-class amenities', '78 Stunning Modern Rich Houses That Redefine Luxury.jpg', '88888888', '2025-07-16', 0, 0, 8, 7, 3),
(6, 'Schedule your private tour today and experience the beauty of this home firsthand', '3f876207-3af3-44b6-b923-75c6cf6ce961.jpg', '998898889', '2025-07-16', 0, 3, 9, 5, 1),
(7, 'bgkjbik', 'Discover luxury and extraordinary house exteriors….jpg', '9998889', '2025-07-17', 0, 3, 8, 5, 2),
(8, 'giygkgukj', 'Wood and glass house interior _ Glass house interior design _ House inside glass house _ Home decor (1).jpg', '4000', '2025-07-17', 0, 3, 8, 5, 3),
(9, 'iuoyjt8gi7yg76uyijh', 'Wood and glass house interior _ Glass house interior design _ House inside glass house _ Home decor (1).jpg', '4000', '2025-07-24', 0, 3, 6, 5, 2),
(10, '9ky97yj879jykh8tj86j7y', '13c994aa-9f55-4195-b52e-4dca2d674889.jpg', '5558', '2025-07-24', 0, 3, 6, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_housetype`
--

CREATE TABLE `tbl_housetype` (
  `housetype_id` int(11) NOT NULL,
  `housetype_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_housetype`
--

INSERT INTO `tbl_housetype` (`housetype_id`, `housetype_name`) VALUES
(6, 'gvfyt');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owner`
--

CREATE TABLE `tbl_owner` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `owner_email` varchar(60) NOT NULL,
  `owner_password` int(20) NOT NULL,
  `owner_contact` int(10) NOT NULL,
  `owner_address` varchar(56) NOT NULL,
  `owner_photo` varchar(76) NOT NULL,
  `owner_proof` varchar(87) NOT NULL,
  `owner_status` int(11) NOT NULL DEFAULT 0,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_owner`
--

INSERT INTO `tbl_owner` (`owner_id`, `owner_name`, `owner_email`, `owner_password`, `owner_contact`, `owner_address`, `owner_photo`, `owner_proof`, `owner_status`, `place_id`) VALUES
(2, 'mary archana pj', 'maryarcahana@gamil.com', 7896, 546765467, 'puliyampalli(h)', 'skcms7.jpg', 'skcms2.jpg', 2, 7),
(3, 'Mary Anjaly PJ', 'maryanjaly456@gmail.com', 786, 2147483647, 'vazhapilli', 'download (3).jpg', 'pinkish wallpaper for new year 2024 girls.jpg', 1, 5),
(4, 'John pj', 'john32@gmail.com', 890, 2147483647, 'mundur', '𝙿𝚞𝚛𝚙𝚕𝚎 𝚆𝚊𝚕𝚕𝚙𝚊𝚙𝚎𝚛.jpg', 'download (4).jpg', 1, 6),
(5, 'Sebastian Arun', 'sebastianarun765@gamil.com', 674, 2147483647, 'killikuttil', 'IMG-20231231-WA0048.jpg', 'IMG-20231127-WA0038.jpg', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `rent_id` int(11) NOT NULL,
  `payment_amount` varchar(50) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(80) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(1, 'kochi', 1),
(4, 'vagamon', 3),
(5, 'muzhavatupuzha', 5),
(6, 'thodupuzha', 6),
(7, 'kochi', 5),
(8, 'Perumbavoor ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_count` varchar(40) NOT NULL,
  `rating_review` varchar(50) NOT NULL,
  `rating_datetime` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rent`
--

CREATE TABLE `tbl_rent` (
  `rent_id` int(11) NOT NULL,
  `rent_description` varchar(400) NOT NULL,
  `rent_tokenamount` varchar(50) NOT NULL,
  `rent_date` varchar(40) NOT NULL,
  `rent_fromdate` varchar(40) NOT NULL,
  `rent_todate` varchar(40) NOT NULL,
  `house_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rent_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rent`
--

INSERT INTO `tbl_rent` (`rent_id`, `rent_description`, `rent_tokenamount`, `rent_date`, `rent_fromdate`, `rent_todate`, `house_id`, `user_id`, `rent_status`) VALUES
(1, 'dfgdgehg', '', '2025-07-17', '2025-07-17', '2025-08-08', 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(80) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(1, 'bigkjcbaj,bd', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(1, 'sell'),
(2, 'rent');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_contact` varchar(56) NOT NULL,
  `user_address` varchar(76) NOT NULL,
  `user_photo` varchar(87) NOT NULL,
  `user_gender` varchar(56) NOT NULL,
  `user_password` varchar(67) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_address`, `user_photo`, `user_gender`, `user_password`, `place_id`, `user_dob`) VALUES
(1, 'Mariya Ruth', 'mariyaruth12@gmail.com', '8848235400', 'jhhjkjkjkj', 'skcms11.jpg', 'female', '123', 4, '2025-06-19'),
(3, 'Jesta', 'mariyaruth123@gmail.com', '      8848235400', ' piliyy', 'Snapchat-887859288.jpg', 'female', '456', 4, '2025-06-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_house`
--
ALTER TABLE `tbl_house`
  ADD PRIMARY KEY (`house_id`);

--
-- Indexes for table `tbl_housetype`
--
ALTER TABLE `tbl_housetype`
  ADD PRIMARY KEY (`housetype_id`);

--
-- Indexes for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_rent`
--
ALTER TABLE `tbl_rent`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_house`
--
ALTER TABLE `tbl_house`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_housetype`
--
ALTER TABLE `tbl_housetype`
  MODIFY `housetype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rent`
--
ALTER TABLE `tbl_rent`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
