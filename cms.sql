-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2022 at 07:00 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(48, 'PHP'),
(52, 'Javascript'),
(53, 'cars');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `message_id` int(11) NOT NULL,
  `message_content` text NOT NULL,
  `from_username` varchar(50) NOT NULL,
  `to_username` varchar(50) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`, `author_id`) VALUES
(12, 140, 'kamikadze', 'gralijus@gmail.com', 'hahah\r\n', 'approved', '2022-01-19', 5),
(13, 140, 'kamikadze', 'gralijus@gmail.com', 'fgjhgjhgjh\r\n', 'approved', '2022-01-20', 5),
(16, 154, 'greenfor', 'ramonas.nojus@gmail.com', 'sdsd', 'approved', '2022-02-19', 4);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `friend1_id` int(11) NOT NULL,
  `friend2_id` int(11) NOT NULL,
  `friend1_username` varchar(50) NOT NULL,
  `friend2_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `friend1_id`, `friend2_id`, `friend1_username`, `friend2_username`) VALUES
(17, 4, 13, 'greenfor', 'altaras'),
(19, 13, 14, 'altaras', 'Gintaryte');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(37, 5, 140),
(38, 5, 152);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_user_id` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_user_id`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(155, 48, 'sea of thieves', '', 'greenfor', 4, '2022-02-19', 'ExRfWcnWQAIH19H.jpg', 'sea of thieves twitch drops gilded phoenixsea of thieves twitch drops gilded phoenixsea of thieves twitch drops gilded phoenix', 'sea of thieves twitch drops gilded phoenix', '', 'published', 0, 0),
(156, 53, 'mercedes', '', 'greenfor', 4, '2022-02-19', 'BBG63AMG-Front.jpg', 'The numerous features like the AMG-specific radiator grille and 22-inch wheels lend this legendary figure its extrovert outward appearance.The numerous features like the AMG-specific radiator grille and 22-inch wheels lend this legendary figure its extrovert outward appearance.', 'The numerous features like the AMG-specific radiator grille and 22-inch wheels lend this legendary figure its extrovert outward appearance.', '', 'published', 0, 0),
(157, 48, 'sea of thieves', '', 'greenfor', 4, '2022-02-19', 'unknown2.png', 'sea of thievessea of thievessea of thievessea of thievessea of thievessea of thieves', 'sea of thieves', '', 'published', 0, 0),
(158, 48, 'something', '', 'greenfor', 4, '2022-02-19', 'product_SoT_getkraken_shirt_design1.png', 'Sea of Thieves Screenshot 2021.11.16 - 08.10.22.82.pngSea of Thieves Screenshot 2021.11.16 - 08.10.22.82.pngSea of Thieves Screenshot 2021.11.16 - 08.10.22.82.png', 'Sea of Thieves Screenshot 2021.11.16 - 08.10.22.82.png', '', 'published', 0, 0),
(159, 48, 'NFT', '', 'greenfor', 4, '2022-02-19', '1125.jpg', 'NFT monkey NFT monkey NFT monkey NFT monkey', 'NFT', '', 'published', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `reported_user` varchar(50) NOT NULL,
  `reported_user_id` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_username` varchar(50) NOT NULL,
  `to_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_full_name` text NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_full_name`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`, `date`) VALUES
(1, 'rico', '$2y$12$ZDTe8uO/LgY.q0tvqnv8KeoewOaC5bjh8mGWf.iFSuZl7VdIdQHdK', '', '', '', 'rico@gmail.com', 'BBG63AMG-Front.jpg', 'subscriber', '$2y$10$iusesomecrazystrings22', '', '2022-02-03'),
(2, 'suave', '$2y$12$jG3YUwNt3X39OB.YJd311O9akwOw17N4e1NQ79N2xrojC5NG3Na3S', '', '', '', 'edwin@gmail.com', 'BBG63AMG-Front.jpg', 'admin', '$2y$10$iusesomecrazystrings22', '', '2022-02-03'),
(4, 'greenfor', '$2y$12$NEnX5gOc0Py/NbLL/AGRL.l93wYep2DLOkxn/vCCumVTFxE/Y3a7a', 'Nojus', 'Ramonas', 'Nojus Ramonas', 'ramonas.nojus@gmail.com', 'Sea of Thieves Screenshot 2021.10.27 - 23.15.14.38.png', 'admin', '$2y$10$iusesomecrazystrings22', '', '2022-02-03'),
(5, 'kamikadze', '$2y$12$ykI.PKlW69VRXLfviO5Dl.m1gXz5UWo2R5cz5rMkJLX8ILJ/QG7tG', '', '', '', 'greenfor@gmail.com', 'person-placeholder.jpg', 'subscriber', '$2y$10$iusesomecrazystrings22', '', '2022-02-03'),
(13, 'altaras', '$2y$12$/yy2qK1ihXJJNsfvWvEZd.GR81cHuv9i/Q2TEpeC7xmvqqwqHqEIS', 'Gintaras', 'Ramonas', 'Gintaras Ramonas', 'gralijus@gmail.com', 'unnamed.png', 'subscriber', '$2y$10$iusesomecrazystrings22', '', '2022-02-04'),
(14, 'Gintaryte', '$2y$12$W1fJDJTswVvJNZktrOMt4OwK/rHNKOKVH4Xvozh38uvYXfVRKf8za', 'Gintare', 'Ramonaite', 'Gintare Ramonaite', 'gintare@gmail.com', 'person-placeholder.jpg', 'subscriber', '$2y$10$iusesomecrazystrings22', '', '2022-02-08'),
(15, 'asdasd', '$2y$12$LRJNziZ2WLT0a90rFD5veulY5bPZOt3ZrnLxnBEqc8/wgSLap3tmm', 'asdasd', 'asdasd', 'asdasd asdasd', 'asdasd.nojus@gmail.com', 'person-placeholder.jpg', 'banned', '$2y$10$iusesomecrazystrings22', '', '2022-02-19'),
(16, 'dfgdfg', '$2y$12$0EPdj2dOndF6uWIysS8ZI.t6XsO788zKczZspi7mCIdz/8FsjmWa6', 'dfg', 'dfgdfg', 'dfg dfgdfg', 'dfgdfg.nojus@gmail.com', 'person-placeholder.jpg', 'banned', '$2y$10$iusesomecrazystrings22', '', '2022-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(44, '', 1447434996),
(45, 's47g806mg6788i92u5ogm6kqi4', 1447441570),
(46, '72clfovqk7vo2p8fiii26tkmr4', 1447461586),
(47, '3gs3q67k5ntpma8tbp2kuvof23', 1447691896),
(48, 'bouqd4fslhn2b1nv20k559col1', 1447796024),
(49, 'tign71tbpar4di74k13f8nr022', 1447867949),
(50, 'ju0s1j019d1qlc1q4tb703rgm3', 1447880891),
(51, 'tp6khbvgo4hdlfueekpmaefcu0', 1447952096),
(52, 'kv0klvlajm8j50d3uqt6go4bm6', 1448174347),
(53, 'qsdv073j4c3lqd6m0rtdpg3615', 1448296313),
(54, 'tmliedhtcgvi8r96l6qplehos4', 1448292854),
(55, 'vrumjbdrjrauucdhg6cta8hhn6', 1448800892),
(56, 'eb1ae8996caf679d187c1037ec9620b1', 1478098539),
(57, '40780dfe8631b764c435168775d44432', 1479443689),
(58, '6d9081fbf0106e9bfef3e77f6fa68f8a', 1481004509),
(59, 'b57212ad3e92b65c05d8ddcd1805a370', 1481382178),
(60, '3cf8d2b7eb470cb635a6102868ae9bd6', 1481397855),
(61, 'c7e0ac8eeeaaf5d3ac4329af9bf4b777', 1481685807),
(62, 'b50a5d9ab4b00848c009d472c63ae2cd', 1485830805),
(63, '3ef98f25d1b1762dd799f33b1a2b2657', 1499988384),
(64, '229f256600c1d05e81bd5036d941069a', 1499993069),
(65, '34aea21ebd8d1ae1b572236a4783cbad', 1500065466),
(66, '09o25kcbcforltohdl4g7bka0n', 1630839842),
(67, 'mn1fjstkrcuq0j3s55n8p28do8', 1630959744),
(68, '25f4fq0a1uf0ppsavc2v3pob4n', 1631111098),
(69, 'tgvliadp0et89n9neh5gie8a8o', 1632156967),
(70, 'dbfi6n95a2d5revkdg4ipheuao', 1632217894),
(71, 'p5humj105m813r69adn81rqmq2', 1633638920),
(72, '1lvf6sfrbgkr00gpufcphf0duo', 1633777649),
(73, 'qaskip29pt4j7713dmgfsl9odp', 1633790004),
(74, 'vds7msdq8gh8tqk0sbnpd6tpvl', 1634331340),
(75, 'j8ap6dj3a23u3ll2jq7d7tkc4b', 1635279406),
(76, 'hv5t1hs56ncmoj2usqbb9ia676', 1635955442),
(77, '17r8aut25nq9c7tm92vhdt2elj', 1636664958),
(78, 'as65rkd07cfoad31g5daq5ntnc', 1637246010),
(79, 'b0rq5cd83e709rdgu9gbigtvpg', 1637696610),
(80, 'poqhk3nh86nrtt1sn9urrig598', 1637856671),
(81, '6iel1pvdvebdjhgggdlh7s328v', 1638048445),
(82, '8h9i889lotk8ku5c8gpl669mhj', 1638101232),
(83, '5tk4hrj2vciobpv0r603gfqofg', 1638132775),
(84, '9o5l36jjo49p9jfphjc43vnir3', 1638212433),
(85, 'a6v0vm7slpu4odsgm41g5ijif1', 1638307214),
(86, 'td49lb8m0n6eq4sq9pnaru569b', 1638474490),
(87, 'u74blgergavpp3c1rgn4dn6k2k', 1640882161),
(88, '0lrc9l8b2tb3o4qekbbgh6vcnp', 1641460860),
(89, 'kca7gigkt4i7kn6tfl81nav71d', 1641477754),
(90, 'ndkbhh0d67oplrj2it1gdpoiu8', 1642448599),
(91, 'fv6oo2c26qac6l47nn447idd1p', 1642627566),
(92, 'qb02vah1k6n8rlfo56bkj8m57n', 1642680236),
(93, 'mrnmn7padopm99sd38olu9frnu', 1642709446),
(94, 'jcc28a3t04vflir2o2a02ncilr', 1643179217),
(95, 'vqed8s0umb5lsvoqnbs10kkjj4', 1643208564),
(96, 'k4rnte1rt5tl7aumimulfdsge7', 1643302063),
(97, 'npasni31a1lbnve7rrm1tl5eet', 1643398137),
(98, 'admdm6f3cm48ld74qag6j86bnq', 1643407524),
(99, '0ptvcst1jli2h5md178vh8nbed', 1643467135),
(100, '7dmphm2tmmam3o71u8ld0ca23q', 1643729999),
(101, 'lebm02jhau7st91grsoklkre0g', 1643746982),
(102, 'rttfguuofvi0oqcemsnl11vs5o', 1643815262),
(103, '5iacj7rs45kblsc0ktjbe7mqbd', 1643923027),
(104, 'uajqk7sdfjsnf8kmf2lsp3ugqh', 1643998631),
(105, 'ua3qb3o4blek65efnt5hk6is6v', 1644052390),
(106, 'ku70fhpi25hv2p1runksv3vsu4', 1644156875),
(107, 'dgf1afpun0pulec78f0gs9sl6j', 1645275256),
(108, 'pbcnrsip67902pdrgd7m56220p', 1644177882),
(109, 'ria3cq0v699cl2t0k27f20q0od', 1644248979),
(110, 'h3hitjeth1k9hcv5kh6e1ft8dk', 1644329987),
(111, 'vd7lge50lininn6fmc09q2r0mc', 1644435844),
(112, '6ml9fvt55adefcemgb2mhl1tib', 1644527933),
(113, 'cl89ha41asohm1ribm3el7rd7e', 1644592783),
(114, '8bdcn3ovthkcq66qtm67fif96s', 1644611488),
(115, '1dtk7i24dneblk3h9vlijl9fe4', 1644670467),
(116, 'g1n82dchdsjl3pdf90usf658ib', 1644681296),
(117, 'bda58pmv23bcinhsoj8m24qe37', 1644707418),
(118, 'c8f3le39bkdrddv63kicse3gib', 1644781424),
(119, 'elmgnqas7dm98h6n7ef4dblf36', 1644966241),
(120, '9l1c02qiancaaedifpal5uepnu', 1645000475),
(121, 'r1tsp5137lcrt62gpfhqqq61q1', 1645097661),
(122, '2s3jjtmpqmtvn0ee2d89u2a3pi', 1645110229),
(123, '3ce6knko8fbkg3p9c2ouilpk1h', 1645209495),
(124, '4974pqmqp050m57810374r1ntb', 1645221167),
(125, 'd5sfgeo7cidf34dibfk7odcgmt', 1645293631);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
