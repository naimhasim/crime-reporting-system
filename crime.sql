
--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `report_title` varchar(255) DEFAULT NULL,
  `report_desc` varchar(255) DEFAULT NULL,
  `report_media` blob,
  `crime_category` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `crime_date` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `user_id`, `report_title`, `report_desc`, `report_media`, `crime_category`, `latitude`, `longitude`, `district`, `crime_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'My motorcycle is missing!', 'I wake up in the morning realised that my motorcycle is missing. I did not hear anything last night.', '028534252.jpeg', 'Motor vehicle theft', '6.05450818424263', '102.29729264974596', 'Kota Bharu', '2021-11-12 16:00:00', '2021-11-12 22:40:39', '2021-11-12 22:40:39'),
(2, 2, 'Armed Gold Robbery', 'CCTV footage of robbery at Seng Heng gold shop', '1638728377.png', 'Robbery', '6.136099841368498', '102.23902434110643', 'Kota Bharu', '2022-01-31 16:00:00', '2021-11-13 11:10:52', '2021-11-13 11:10:52'),
(3, 3, 'School office\'s door broke', 'Reported by guard at 6am. door is broken and opened. There are attempts on property thefts. Robbery may be planned by individual.', '1636605414.jpeg\r\n', 'Housebreak', '6.168502095177555', '102.2883488237858\r\n', 'Kota Bharu', '2021-11-13 16:00:00', '2021-11-14 02:40:02', '2021-11-14 02:40:02'),
(5, 7, 'Child missing!', 'Reported missing from her home neighbourhood at Ulu Sat, Machang between 8.20 and 11.30 in the morning of November 12th. She may have been abused and kidnapped referring to residents\'s talking.', '1636871890.jpeg', 'Assault', '5.756118244155488', '102.19818435609342', 'Machang', '2021-11-13 16:00:00', '2021-11-13 22:38:10', '2021-11-13 22:38:10'),
(6, 4, 'Suspicious Vellfire', 'Vellfire spotted with broken door. It is to believed it was stolen.', '8272722.jpeg', 'Theft', '6.118414', '102.305717', 'Kota Bharu', '2021-11-26 16:00:00', '2022-01-31 12:52:34', '2022-01-31 12:39:58'),
(7, 5, 'Owner lost almost RM159,000 after robbed', 'I (owner) have lost 20 necklaces and jewelries after fighting life with robber.', '20200806.jpeg', 'Robbery', '6.040200', '102.211947', 'Kota Bharu', '2021-12-01 16:00:00', '2022-01-31 12:39:53', '2022-01-31 12:39:58'),
(8, 6, 'Hit and run crash', 'Hit and run has cause two families involved in a tragedy accidents. Perpetrator is a man with long curly hair. Witness believed he was outsider.', '23125123.jpeg', 'Assault', '6.046504', '102.240143', 'Kota Bharu', '2021-12-01 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(9, 8, 'Planned Robbery by five men', 'I found possible robbery plan with full detail when I accidentally entered their shop at the back.', '115465723.jpeg', 'Robbery', '5.970043', '102.293701', 'Melor', '2021-12-01 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(10, 9, 'Food Panda rider lose sponsored motorcycle', 'Food Panda rider lost his transport after 5 minutes delivering to a nearby destination.', '123356538.jpeg', 'Motor vehicle theft', '6.063905', '102.252502', 'Kota Bharu', '2022-01-10 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(11, 10, 'Smartphone snatched from back', 'More than RM1000 worth of smartphone is snatched from a thief while riding his motorcycle. Victim identified the plate number as DIN3923', '823823723.jpeg', 'Robbery', '4.869311', '101.933523', 'Gua Musang', '2021-12-10 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(12, 11, 'Motorcycle robbed in front of shop', 'Owner going back to his motorcycle after a short trip of buying at shop are robbed by three men in helmet', '865267891.png', 'Robbery', '4.937724', '102.079103', 'Gua Musang', '2021-12-23 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(13, 12, 'Armed and masked robbery in Bank Islam', 'Three men wearing black hood with mask are holding gun to rob the bank during lunch hour', '00883832431.jpeg', 'Robbery', '4.810919', '102.479289', 'Gua Musang', '2021-12-14 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(14, 13, 'Lorry turned out to be stolen', 'A group of man following a lorry that is potentially stolen a few weeks ago. They believed plate number are already changed', '1042018414.jpeg', 'Motor vehicle theft', '5.999054', '102.104527', 'Pasir Mas', '2021-12-14 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(15, 14, 'Unkown motive robbery at Kuala Krai', 'A man robbing an office possibly to gather money. Motive of the robber is unclear since he took other stuff too.', '1636605161.png', 'Robbery', '5.502869', '102.216509', 'Kuala Krai', '2021-12-15 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(16, 15, 'CCTV record car theft operation', 'CCTV recorded a possible man ranging from 20 to 30 years old is stealing a black car during the day.', '1636605269.jpeg', 'Motor vehicle theft', '5.359202', '102.271167', 'Kuala Krai', '2021-12-16 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(17, 16, 'Neighbour footage of someone housebreaking', 'Witness had time to record the whole incident of housebreaking their neighbour houses. It is to believed the man is armed', '1636605555.png', 'Housebreak', '5.752778', '102.283216', 'Machang', '2021-12-15 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(18, 17, 'A man robbing jewelry store', 'a man coming through the shop entrance suddenly assaulted the person in charge for some jewelleries', '1636830652.jpeg', 'Robbery', '5.835736', '102.403092', 'Pasir Puteh', '2021-12-15 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(19, 18, 'Man arrested for housebreaking by day', 'Man is arrested for housebreaking by day. Villagers found him getting out from the house window', '1637767533.jpeg', 'Housebreak', '4.967824', '101.976943', 'Gua Musang', '2021-12-13 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(20, 19, 'man in hood arrested for theft attempt', 'Man in hoodies was caught red handed by owner trying to snuck some stuff from the car', '1637696652.jpeg', 'Theft', '5.907046', '102.101463', 'Pasir Mas', '2021-12-31 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(21, 20, 'Two men caught on homemade CCTV', 'Owner recorded two men are searching all over the place to find valuable stuff in the house', '1637768019.jpeg', 'Theft', '4.975008', '102.191627', 'Gua Musang', '2022-01-02 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(22, 21, 'Harrasment by superior', 'Superior display gesture of workplace harrassment towards my friend who just gone through traumatic incident', '1639649336.jpeg', 'Assault', '5.776559', '102.168816', 'Machang', '2022-01-30 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(23, 22, 'Child potentially abused', 'Kids found  at playground with bruises all over the body.', '1639730385.jpeg', 'Assault', '5.793461', '102.073648', 'Tanah Merah', '2022-01-30 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(24, 23, 'Television missing', 'My television was missing after I left it outside my house for two consecutive days', '1639731491.jpeg', 'Theft', '5.254341', '101.881714', 'Gua Musang', '2022-01-23 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58'),
(25, 24, 'Robbery in bank', 'Men with hats and armed with pistols are robbing a bank', '1639738968.jpeg', 'Robbery', '5.609152', '101.881456', 'Kuala Balah', '2022-01-23 16:00:00', '2022-01-31 12:39:58', '2022-01-31 12:39:58');

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

insert into `users` (`contact_no`, `created_at`, `email`, `fullname`, `id`, `updated_at`)
values  ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 1, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 2, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 3, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 4, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 5, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 6, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 7, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 8, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 9, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 10, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 11, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 12, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 13, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 14, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 15, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 16, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 17, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 18, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 19, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 20, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 21, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 22, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 23, '2023-03-23 17:00:10'),
        ('0123922239', '2023-03-23 17:00:10', 'sdas@gmail.com', '123', 24, '2023-03-23 17:00:10');
