-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2020 at 03:31 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hypertec_venky`
--

-- --------------------------------------------------------

--
-- Table structure for table `slot_booking`
--

CREATE TABLE `slot_booking` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `date_slot` text NOT NULL,
  `time_slot` text NOT NULL,
  `book_type` text NOT NULL,
  `package` text NOT NULL,
  `reg_val` text NOT NULL,
  `persons` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` varchar(20) NOT NULL,
  `payment_response` text NOT NULL,
  `unique_id` text NOT NULL,
  `payment_success` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot_booking`
--

INSERT INTO `slot_booking` (`id`, `name`, `email`, `phone`, `date_slot`, `time_slot`, `book_type`, `package`, `reg_val`, `persons`, `created_at`, `price`, `payment_response`, `unique_id`, `payment_success`) VALUES
(1, 'Dharun Aashick', 'rdharunravi@gmail.com', 918248607223, '2020-06-08', '10:00 - 11:30', 'Student', 'mj', '', 2, '2020-06-07 10:21:53', '9', '{\n    \"success\": true,\n    \"payment_request\": {\n        \"id\": \"31f96a9347ee453b9674e438b6bf2487\",\n        \"phone\": \"+918248607223\",\n        \"email\": \"rdharunravi@gmail.com\",\n        \"buyer_name\": \"Dharun Aashick\",\n        \"amount\": \"9.00\",\n        \"purpose\": \"mj_5edcbfc14bd40\",\n        \"expires_at\": null,\n        \"status\": \"Completed\",\n        \"send_sms\": true,\n        \"send_email\": true,\n        \"sms_status\": \"Sent\",\n        \"email_status\": \"Sent\",\n        \"shorturl\": \"https://imjo.in/NqGrkW\",\n        \"longurl\": \"https://www.instamojo.com/@dharunaashick/31f96a9347ee453b9674e438b6bf2487\",\n        \"redirect_url\": \"http://hypertechno.in/success.php\",\n        \"webhook\": \"http://hypertechno.in/webhook.php\",\n        \"payments\": [\n            {\n                \"payment_id\": \"MOJO0607605D03845849\",\n                \"status\": \"Credit\",\n                \"currency\": \"INR\",\n                \"amount\": \"12.86\",\n                \"buyer_name\": \"Dharun Aashick\",\n                \"buyer_phone\": \"+918248607223\",\n                \"buyer_email\": \"rdharunravi@gmail.com\",\n                \"shipping_address\": null,\n                \"shipping_city\": null,\n                \"shipping_state\": null,\n                \"shipping_zip\": null,\n                \"shipping_country\": null,\n                \"quantity\": 1,\n                \"unit_price\": \"9.00\",\n                \"fees\": \"3.27\",\n                \"variants\": [],\n                \"custom_fields\": {},\n                \"affiliate_commission\": \"0\",\n                \"payment_request\": \"https://www.instamojo.com/api/1.1/payment-requests/31f96a9347ee453b9674e438b6bf2487/\",\n                \"instrument_type\": \"UPI\",\n                \"billing_instrument\": \"UPI\",\n                \"tax_invoice_id\": \"\",\n                \"failure\": null,\n                \"payout\": null,\n                \"created_at\": \"2020-06-07T10:22:24.836982Z\"\n            }\n        ],\n        \"allow_repeated_payments\": true,\n        \"customer_id\": null,\n        \"created_at\": \"2020-06-07T10:21:54.384647Z\",\n        \"modified_at\": \"2020-06-07T10:23:00.647672Z\"\n    }\n}\n', 'mj_5edcbfc14bd40', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slot_booking`
--
ALTER TABLE `slot_booking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slot_booking`
--
ALTER TABLE `slot_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
