-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2015 at 01:32 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imagescontest`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CommentImageID` int(11) NOT NULL,
  `CommentUserID` int(11) NOT NULL,
  `CommentParentID` int(11) NOT NULL DEFAULT '0',
  `CommentContent` text COLLATE utf8_unicode_ci NOT NULL,
  `CommentLikes` int(11) NOT NULL DEFAULT '0',
  `CommentShares` int(11) NOT NULL DEFAULT '0',
  `CommentIsHidden` int(11) NOT NULL DEFAULT '0',
  `CommentCreatedDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `CommentUpdatedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_image` (`CommentImageID`),
  KEY `comment_user` (`CommentUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Store user comments information' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `CommentImageID`, `CommentUserID`, `CommentParentID`, `CommentContent`, `CommentLikes`, `CommentShares`, `CommentIsHidden`, `CommentCreatedDate`, `CommentUpdatedDate`) VALUES
(1, 2, 12, 0, 'What are images contest?', 0, 0, 0, '2015-02-13 10:30:24', NULL),
(2, 4, 12, 0, 'abc', 0, 0, 0, '2015-02-13 11:15:49', NULL),
(3, 3, 16, 0, '12233', 0, 0, 0, '2015-02-13 11:15:49', NULL),
(4, 13, 18, 0, '123123413123', 0, 0, 0, '2015-02-13 14:05:40', NULL),
(5, 3, 18, 0, '123123', 0, 0, 0, '2015-02-13 14:05:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ImageName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ImageTitle` text COLLATE utf8_unicode_ci,
  `ImageDescription` text COLLATE utf8_unicode_ci,
  `ImageAuthor` int(11) DEFAULT NULL COMMENT 'User id, whom the image belong to',
  `ImageIsHidden` int(11) DEFAULT '0' COMMENT 'Image is hidden or not. Value is 0 if not hidden, otherwise, 1. Default value is 0',
  `ImageLikes` int(11) NOT NULL DEFAULT '0',
  `ImageShares` int(11) NOT NULL DEFAULT '0',
  `ImageComments` int(11) NOT NULL DEFAULT '0',
  `ImageCreatedDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `ImageUpdatedDate` datetime DEFAULT NULL,
  `ImageOrigin` int(11) NOT NULL COMMENT 'The origin of image. 0 if image is uploaded by user, 1 if image is get from instagram, 2 if image is get from twitter',
  `ImageAppId` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '[twitter or instagram] Id of image. Null if image is uploaded by user. Default value is null',
  PRIMARY KEY (`id`),
  KEY `image_user_idx` (`ImageAuthor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Store images' AUTO_INCREMENT=73 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `ImageName`, `ImageTitle`, `ImageDescription`, `ImageAuthor`, `ImageIsHidden`, `ImageLikes`, `ImageShares`, `ImageComments`, `ImageCreatedDate`, `ImageUpdatedDate`, `ImageOrigin`, `ImageAppId`) VALUES
(2, '20150126_082850_0V9iso.jpg', NULL, NULL, 12, 0, 1, 0, 22, '2015-01-26 14:28:51', NULL, 1, '906282107127398619_1598306983'),
(3, '20150126_082850_1O0FPY.jpg', NULL, NULL, 13, 0, 44, 0, 100, '2015-01-26 14:28:54', NULL, 1, '906255025578533884_25725343'),
(4, '20150126_082850_20nYSR.jpg', NULL, NULL, 14, 0, 75, 0, 11, '2015-01-26 14:28:56', NULL, 1, '785682327652067529_1197980057'),
(5, '20150126_082850_3aVKmv.jpg', NULL, NULL, 15, 0, 113, 0, 542, '2015-01-26 14:28:57', NULL, 1, '906280006433904458_647555516'),
(6, '20150126_082850_4BSyJ0.jpg', NULL, NULL, 16, 0, 412, 0, 1245, '2015-01-26 14:28:59', NULL, 1, '793224954510144271_1203180859'),
(7, '20150126_082850_5xarG8.jpg', NULL, NULL, 17, 0, 541, 0, 41, '2015-01-26 14:29:00', NULL, 1, '906276617264667149_1613499965'),
(8, '20150126_082850_6Z2F6r.jpg', NULL, NULL, 18, 0, 67423, 0, 522121, '2015-01-26 14:29:02', NULL, 1, '906279284368266339_1450891076'),
(9, '20150126_082850_7js6S2.jpg', NULL, NULL, 17, 0, 511, 0, 42, '2015-01-26 14:29:04', NULL, 1, '906276164296612358_1613499965'),
(10, '20150126_082850_8X5TrY.jpg', NULL, NULL, 19, 0, 123, 0, 563, '2015-01-26 14:29:05', NULL, 1, '906279202958165584_244162384'),
(11, '20150126_082850_9tQMjG.jpg', NULL, NULL, 20, 0, 432, 0, 653, '2015-01-26 14:29:07', NULL, 1, '906204824822218855_1629249479'),
(12, '20150126_082850_10QY8T0.jpg', NULL, NULL, 21, 0, 224, 0, 341, '2015-01-26 14:29:08', NULL, 1, '906277203803632684_49034092'),
(13, '20150126_082850_11yd4wi.jpg', NULL, NULL, 22, 0, 42, 0, 310, '2015-01-26 14:29:10', NULL, 1, '906278172805057517_691488857'),
(14, '20150126_082850_127pnlO.jpg', NULL, NULL, 18, 0, 2524, 0, 2441, '2015-01-26 14:29:11', NULL, 1, '831164709870259247_1440912578'),
(15, '20150126_082850_13NEirT.jpg', NULL, NULL, 24, 0, 0, 0, 0, '2015-01-26 14:29:13', NULL, 1, '906277869923452372_391496392'),
(16, '20150126_082850_143PYIl.jpg', NULL, NULL, 25, 0, 0, 0, 0, '2015-01-26 14:29:14', NULL, 1, '906277741788871208_1637972765'),
(17, '20150126_082850_15ELUhM.jpg', NULL, NULL, 26, 0, 0, 0, 0, '2015-01-26 14:29:16', NULL, 1, '906277336104915644_1432890339'),
(18, '20150126_082850_16VHOzE.jpg', NULL, NULL, 27, 1, 0, 0, 0, '2015-01-26 14:29:17', NULL, 1, '906277318751802785_1643348188'),
(19, '20150126_082850_17RHwu1.jpg', NULL, NULL, 28, 0, 0, 0, 0, '2015-01-26 14:29:19', NULL, 1, '906277101719764757_1487531262'),
(20, '20150126_082850_18dSYEx.jpg', NULL, NULL, 29, 0, 0, 0, 0, '2015-01-26 14:29:21', NULL, 1, '906277001444044128_773662922'),
(21, '20150126_082850_192Km9I.jpg', NULL, NULL, 30, 0, 0, 0, 0, '2015-01-26 14:29:22', NULL, 1, '906276665268843447_29706227'),
(22, '20150126_084832_0TtS9D.jpg', NULL, NULL, 31, 0, 0, 0, 0, '2015-01-26 14:48:33', NULL, 1, '906292182719443065_31323371'),
(23, '20150126_084832_17mbEW.jpg', NULL, NULL, 32, 0, 0, 0, 0, '2015-01-26 14:48:35', NULL, 1, '906292144509464358_314978498'),
(24, '20150126_084832_2pfan4.jpg', NULL, NULL, 33, 0, 0, 0, 0, '2015-01-26 14:48:36', NULL, 1, '906292117806319823_522566345'),
(25, '20150126_084832_37e8GI.jpg', NULL, NULL, 34, 0, 0, 0, 0, '2015-01-26 14:48:38', NULL, 1, '906290534667840492_307602873'),
(26, '20150126_084832_4JUmaL.jpg', NULL, NULL, 35, 0, 0, 0, 0, '2015-01-26 14:48:39', NULL, 1, '906290464863334738_188590043'),
(27, '20150126_084832_5p2wf9.jpg', NULL, NULL, 36, 0, 0, 0, 0, '2015-01-26 14:48:41', NULL, 1, '906289801736510251_443341045'),
(28, '20150126_084832_6zYfxS.jpg', NULL, NULL, 37, 0, 0, 0, 0, '2015-01-26 14:48:42', NULL, 1, '906289503213959580_1258983821'),
(29, '20150126_084832_7wCWjg.jpg', NULL, NULL, 38, 0, 0, 0, 0, '2015-01-26 14:48:43', NULL, 1, '906289498739283060_387330356'),
(30, '20150126_084832_8aR8Zm.jpg', NULL, NULL, 39, 0, 0, 0, 0, '2015-01-26 14:48:44', NULL, 1, '905790650829520264_565511038'),
(31, '20150126_084832_9MAKqY.jpg', NULL, NULL, 40, 0, 0, 0, 0, '2015-01-26 14:48:46', NULL, 1, '906288502492825041_814881728'),
(32, '20150126_084832_10Tp0Ru.jpg', NULL, NULL, 41, 0, 0, 0, 0, '2015-01-26 14:48:47', NULL, 1, '906288242813789685_319935472'),
(33, '20150126_084832_11E8Xl9.jpg', NULL, NULL, 42, 0, 0, 0, 0, '2015-01-26 14:48:49', NULL, 1, '906287751652671211_1350315734'),
(34, '20150126_084832_12rq3ZW.jpg', NULL, NULL, 43, 0, 0, 0, 0, '2015-01-26 14:48:50', NULL, 1, '906282665161056322_194265311'),
(35, '20150126_084832_13Hg7Rs.jpg', NULL, NULL, 44, 0, 0, 0, 0, '2015-01-26 14:48:51', NULL, 1, '906287199271394955_736525902'),
(36, '20150126_084832_14swaCi.jpg', NULL, NULL, 45, 0, 0, 0, 0, '2015-01-26 14:48:53', NULL, 1, '906287168721592316_857407374'),
(37, '20150126_084832_15sGROZ.jpg', NULL, NULL, 46, 0, 0, 0, 0, '2015-01-26 14:48:54', NULL, 1, '802181669413788992_926208910'),
(38, '20150126_084832_16xmWlp.jpg', NULL, NULL, 47, 0, 0, 0, 0, '2015-01-26 14:48:56', NULL, 1, '906285967229541983_1559372262'),
(39, '20150126_084832_17f7Yut.jpg', NULL, NULL, 48, 0, 0, 0, 0, '2015-01-26 14:48:57', NULL, 1, '906285898636322375_215722680'),
(40, '20150126_084832_18ZKkcL.jpg', NULL, NULL, 49, 0, 0, 0, 0, '2015-01-26 14:48:59', NULL, 1, '906284060534749369_1673549461'),
(41, '20150126_084832_19UuLTC.jpg', NULL, NULL, 50, 0, 0, 0, 0, '2015-01-26 14:49:00', NULL, 1, '906284645135615816_1363038264'),
(42, '20150126_084832_0TjoUv.jpg', NULL, NULL, 51, 0, 0, 0, 0, '2015-01-26 14:49:01', NULL, 2, '559618631043002368'),
(43, '20150126_084832_1WHy15.jpg', NULL, NULL, 52, 0, 100, 0, 0, '2015-01-26 14:49:01', NULL, 2, '559618315438395392'),
(44, '20150126_084832_27VjMY.jpg', NULL, NULL, 53, 0, 0, 0, 0, '2015-01-26 14:49:02', NULL, 2, '559618247301951490'),
(45, '20150126_084832_3rc5DM.jpg', NULL, NULL, 54, 0, 0, 0, 0, '2015-01-26 14:49:02', NULL, 2, '559618012295069696'),
(46, '20150126_084832_4Has2h.jpg', NULL, NULL, 55, 0, 0, 0, 0, '2015-01-26 14:49:02', NULL, 2, '559617971207692288'),
(47, '20150126_084832_5Hs6pB.jpg', NULL, NULL, 56, 0, 0, 0, 0, '2015-01-26 14:49:03', NULL, 2, '559617947623104512'),
(48, '20150126_084832_690bgm.jpg', NULL, NULL, 57, 0, 0, 0, 0, '2015-01-26 14:49:03', NULL, 2, '559617944796139520'),
(49, '20150126_084832_7pq6w2.jpg', NULL, NULL, 58, 0, 0, 0, 0, '2015-01-26 14:49:04', NULL, 2, '559617931705720832'),
(50, '20150126_084832_8LsQIb.jpg', NULL, NULL, 59, 0, 0, 0, 0, '2015-01-26 14:49:04', NULL, 2, '559617840194408449'),
(51, '20150126_084832_9wJbXv.jpg', NULL, NULL, 60, 0, 0, 0, 0, '2015-01-26 14:49:04', NULL, 2, '559616773465468928'),
(52, '20150126_084832_10KWbjJ.jpg', NULL, NULL, 61, 0, 0, 0, 0, '2015-01-26 14:49:05', NULL, 2, '559615444064403456'),
(53, '20150126_084832_118m6WF.jpg', NULL, NULL, 62, 0, 0, 0, 0, '2015-01-26 14:49:06', NULL, 2, '559614212020776960'),
(54, '20150126_084832_12TpAvW.jpg', NULL, NULL, 63, 0, 0, 0, 0, '2015-01-26 14:49:06', NULL, 2, '559613572398198784'),
(55, '20150126_084832_13pDXFj.jpg', NULL, NULL, 64, 0, 0, 0, 0, '2015-01-26 14:49:07', NULL, 2, '559613192280625152'),
(56, '20150126_084832_14Fuysb.jpg', NULL, NULL, 65, 0, 0, 0, 0, '2015-01-26 14:49:07', NULL, 2, '559613178229690368'),
(57, '20150126_084832_15liy0E.jpg', NULL, NULL, 66, 0, 0, 0, 0, '2015-01-26 14:49:07', NULL, 2, '559613005223055360'),
(58, '20150126_084832_16QWHrC.jpg', NULL, NULL, 67, 0, 0, 0, 0, '2015-01-26 14:49:08', NULL, 2, '559612526019624960'),
(59, '20150126_084832_17SPJag.jpg', NULL, NULL, 68, 0, 0, 0, 0, '2015-01-26 14:49:08', NULL, 2, '559612391189532673'),
(60, '20150126_084832_18a2Nw5.jpg', NULL, NULL, 69, 0, 0, 0, 0, '2015-01-26 14:49:09', NULL, 2, '559612065669582848'),
(61, '20150126_084832_19RnV6W.jpg', NULL, NULL, 70, 0, 0, 0, 0, '2015-01-26 14:49:09', NULL, 2, '559611702858092545'),
(62, '20150126_084832_20r1IcN.jpg', NULL, NULL, 71, 0, 0, 0, 0, '2015-01-26 14:49:09', NULL, 2, '559611297981923328'),
(63, '20150126_084832_21ZTbRO.jpg', NULL, NULL, 72, 0, 0, 0, 0, '2015-01-26 14:49:10', NULL, 2, '559610567078322176'),
(64, '20150126_084832_22ZbqBk.jpg', NULL, NULL, 73, 0, 0, 0, 0, '2015-01-26 14:49:10', NULL, 2, '559610208331112448'),
(65, '20150126_084832_23AynFR.jpg', NULL, NULL, 74, 0, 0, 0, 0, '2015-01-26 14:49:10', NULL, 2, '559609940868743169'),
(66, '20150126_084832_240fI8T.jpg', NULL, NULL, 75, 0, 0, 0, 0, '2015-01-26 14:49:11', NULL, 2, '559609733007425537'),
(67, '20150126_084832_25R2MYK.jpg', NULL, NULL, 76, 0, 0, 0, 0, '2015-01-26 14:49:11', NULL, 2, '559609471140245505'),
(68, '20150126_084832_26T9nxX.jpg', NULL, NULL, 77, 0, 0, 0, 0, '2015-01-26 14:49:11', NULL, 2, '559608291651620864'),
(69, '20150126_084832_27Y8w4M.jpg', NULL, NULL, 78, 0, 0, 0, 0, '2015-01-26 14:49:12', NULL, 2, '559605659499380736'),
(70, '20150126_084832_28fzXI7.jpg', NULL, NULL, 79, 0, 0, 0, 0, '2015-01-26 14:49:12', NULL, 2, '559605333140574208'),
(71, '20150126_084832_29Ievf6.jpg', NULL, NULL, 80, 0, 0, 0, 0, '2015-01-26 14:49:12', NULL, 2, '559604291002847233'),
(72, '20150126_084832_300W4g6.png', NULL, NULL, 81, 0, 0, 0, 0, '2015-01-26 14:49:14', NULL, 2, '559603946248241153');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ManagerAccountName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ManagerPassword` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ManagerName` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ManagerEmail` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ManagerAddress` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ManagerPhone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Admin information' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `ManagerAccountName`, `ManagerPassword`, `ManagerName`, `ManagerEmail`, `ManagerAddress`, `ManagerPhone`) VALUES
(1, 'admin', 'Dq9oF8pjBDYp25WITKpkATVSkGloWQUEc9Kl8MWJMvy2HG8ehq9ZUgobDPEqvvKUkYk/xEVUc6WdphIgHsvYYg==', 'Administrator', 'linh_vh@vietvang.net', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserAppId` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Application (facebook, instagram or twitter ID)',
  `UserName` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User name',
  `UserAvatar` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User avatar',
  `UserPhone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User phone number',
  `UserEmail` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserKind` int(11) NOT NULL COMMENT 'User kind. 0 if user is facebook user, 1 if instagram user, 2 if twitter user',
  `UserAddress` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User address',
  `UserIDCard` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User identity card',
  `UserBirthDate` date DEFAULT NULL,
  `UserGender` int(11) DEFAULT NULL COMMENT 'User gender. 1 if male, 2 if female, 0 is others',
  `UserIsBan` int(11) DEFAULT NULL COMMENT 'Check if user is banned or not. 0 if use is banned. Otherwise, 1',
  `UserCreatedDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `UserUpdatedDate` datetime DEFAULT NULL,
  `UserAppUserName` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'username if it is twitter of instagram user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `FID_UNIQUE` (`UserAppId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Store user information' AUTO_INCREMENT=82 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `UserAppId`, `UserName`, `UserAvatar`, `UserPhone`, `UserEmail`, `UserKind`, `UserAddress`, `UserIDCard`, `UserBirthDate`, `UserGender`, `UserIsBan`, `UserCreatedDate`, `UserUpdatedDate`, `UserAppUserName`) VALUES
(12, '1598306983', 'tiger_the_bunny', 'https://igcdn-photos-h-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10838380_279942628796399_445459442_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, '2015-01-26 14:28:50', NULL, 'tiger_the_bunny'),
(13, '25725343', 'Phromsit Sittichumroenkhun(A)', 'https://igcdn-photos-g-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10860208_744422518975934_1572555320_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, '2015-01-26 14:28:52', NULL, 'abbatwins'),
(14, '1197980057', 'Jon', 'https://igcdn-photos-d-a.akamaihd.net/hphotos-ak-xap1/t51.2885-19/1538511_735985306469939_1033927568_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, '2015-01-26 14:28:54', NULL, 'fishindogs'),
(15, '647555516', 'Ferdinand Goller', 'https://igcdn-photos-b-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10899013_1518490828438969_221405502_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, '2015-01-26 14:28:56', NULL, 'ferdinandgoller'),
(16, '1203180859', 'Muhammad Danial Ariff', 'https://igcdn-photos-h-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10890744_743183479092551_1589658033_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:28:58', NULL, 'daniverse456'),
(17, '1613499965', 'JENNIFER THY', 'https://igcdn-photos-g-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10948939_400170246822846_1683420746_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:28:59', NULL, 'jtartiste'),
(18, '1450891076', 'Cecilia', 'https://igcdn-photos-f-a.akamaihd.net/hphotos-ak-xap1/t51.2885-19/923745_1468610080055317_469318214_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:01', NULL, 'pr3cious_86'),
(19, '244162384', 'Victoria Jannuzzi Baker', 'https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/914798_603785229734400_837256912_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:04', NULL, 'victoriajannuzzibaker'),
(20, '1629249479', '賣東西 MY EASTWEST', 'https://igcdn-photos-c-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/10919699_835651426497930_1753822258_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:05', NULL, 'myeastwest'),
(21, '49034092', 'Apurva', 'https://instagramimages-a.akamaihd.net/profiles/profile_49034092_75sq_1367196783.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, '2015-01-26 14:29:07', NULL, 'apple_why'),
(22, '691488857', 'Tiger Shroff Fan Page', 'https://igcdn-photos-h-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10899378_397746673727703_375678587_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:08', NULL, 'tigershroff_lovers'),
(23, '1440912578', 'ファイン', 'https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xpa1/t51.2885-19/10724114_830051207039752_749167032_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:10', NULL, 'fineztbw'),
(24, '391496392', 'Janeen', 'https://igcdn-photos-h-a.akamaihd.net/hphotos-ak-xfp1/t51.2885-19/10611061_911264968883903_632308055_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:11', NULL, 'missjray'),
(25, '1637972765', 'stop.hunting.and.save.animals', 'https://igcdn-photos-g-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/10903250_399873660190910_1761431184_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:13', NULL, 'stop.hunting.and.save.animals'),
(26, '1432890339', 'Rushi Tank', 'https://igcdn-photos-f-a.akamaihd.net/hphotos-ak-xpf1/t51.2885-19/10502684_1503382233213125_876011456_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:14', NULL, 'tanky.rushi'),
(27, '1643348188', 'Eleazar Carreon AlZ', 'https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10914550_596844523782752_1498998517_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:16', NULL, 'eleazarcarreon'),
(28, '1487531262', 'Santillan  ', 'https://igcdn-photos-c-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10894959_1583351555236042_487651097_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:17', NULL, 'nattsantty'),
(29, '773662922', 'Mattéo Mchn', 'https://igcdn-photos-d-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10932313_1544355619167411_1181267035_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:19', NULL, 'matteo_ukt'),
(30, '29706227', 'marco_gastoldi', 'https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xpf1/t51.2885-19/10810019_1549826841928584_858449047_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:29:21', NULL, 'marco_gastoldi'),
(31, '31323371', 'Alistair Hayward', 'https://igcdn-photos-h-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/10848335_537006866441055_1715291645_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:32', NULL, 'alistairhayward'),
(32, '314978498', 'Anna Conejos', 'https://instagramimages-a.akamaihd.net/profiles/profile_314978498_75sq_1389943263.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:34', NULL, 'anneta1515'),
(33, '522566345', 'cissidubber', 'https://instagramimages-a.akamaihd.net/profiles/profile_522566345_75sq_1397904759.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:35', NULL, 'cissidubber'),
(34, '307602873', 'Paul Arrogancia W', 'https://igcdn-photos-e-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10914633_887224074632236_591630551_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:37', NULL, 'pau_ly20'),
(35, '188590043', 'PG avel ruzdov', 'https://igcdn-photos-g-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10919109_336259573237030_2107109233_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:38', NULL, 'pavelgruzdov'),
(36, '443341045', '☆YARED☆', 'https://igcdn-photos-f-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/10919312_594408974023869_347828797_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:40', NULL, 'juanayala__'),
(37, '1258983821', 'Kc King Lorilla', 'https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10881952_410848209084208_1028806848_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:41', NULL, 'kckingtr34'),
(38, '387330356', 'Abbie...', 'https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10932330_1037735056240360_790789592_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:42', NULL, '_abbieleighx'),
(39, '565511038', 'Marta sangalli', 'https://igcdn-photos-c-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/10643896_584537055002834_797160912_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:43', NULL, 'marta_sangalli'),
(40, '814881728', 'Mikaylah Bouchard', 'https://igcdn-photos-h-a.akamaihd.net/hphotos-ak-xpa1/t51.2885-19/10808488_347918962047815_2122941368_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:44', NULL, 'maebouchard'),
(41, '319935472', 'Marisol Antúnez Reyes', 'https://instagramimages-a.akamaihd.net/profiles/profile_319935472_75sq_1367568121.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:46', NULL, 'china11doll'),
(42, '1350315734', '', 'https://igcdn-photos-e-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10919215_825988004107316_361347564_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:47', NULL, 'salmankhannation'),
(43, '194265311', 'eleinst_b612', 'https://instagramimages-a.akamaihd.net/profiles/profile_194265311_75sq_1391954051.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:49', NULL, 'eleinst_b612'),
(44, '736525902', '', 'https://instagramimages-a.akamaihd.net/profiles/profile_736525902_75sq_1386301756.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:50', NULL, 'kong1515'),
(45, '857407374', 'Kristin', 'https://igcdn-photos-h-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10903470_575415245894375_4659650_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:52', NULL, 'ladylikestory'),
(46, '926208910', 'Irene Arieputri', 'https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10864819_1559666284272240_1772165250_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:53', NULL, 'riinns'),
(47, '1559372262', 'chindy_arieska', 'https://igcdn-photos-g-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10895467_1524100047878382_630861876_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:54', NULL, 'chindy_arieska'),
(48, '215722680', 'Bruce Morris', 'https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xfp1/t51.2885-19/10449073_1433082310289488_270969768_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:56', NULL, 'morris_84'),
(49, '1673549461', 'New Acc 1/26/15', 'https://igcdn-photos-f-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/10932281_835657216473653_1816672581_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:57', NULL, 'bollywoodmen'),
(50, '1363038264', 'bidunyaparti', 'https://igcdn-photos-g-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/10914562_1600915503477766_1390796695_a.jpg', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2015-01-26 14:48:59', NULL, 'bidunyaparti'),
(51, '112624230', 'Chances', 'http://pbs.twimg.com/profile_images/689098050/newentrance_normal.jpg', NULL, NULL, 2, 'Osaka', NULL, NULL, NULL, NULL, '2015-01-26 14:49:00', NULL, 'ChancesHorie'),
(52, '2680729040', 'Farm Fairy Crafts', 'http://pbs.twimg.com/profile_images/553762671565082625/1RiWKHfB_normal.jpeg', NULL, NULL, 2, 'Austin, Texas', NULL, NULL, NULL, NULL, '2015-01-26 14:49:01', NULL, 'FarmFairyCrafts'),
(53, '2183849126', 'ayaka♡⃛', 'http://pbs.twimg.com/profile_images/547737384100454401/bLpfqXTw_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:01', NULL, 'Rin0614mei'),
(54, '2269608073', '信賀@数原君♡', 'http://pbs.twimg.com/profile_images/557126838208585728/zoPT6mf2_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:02', NULL, 'shinga3137'),
(55, '2366591790', 'とこまる', 'http://pbs.twimg.com/profile_images/512158345289932800/msLDzVgc_normal.jpeg', NULL, NULL, 2, 'Aichi Prefecture', NULL, NULL, NULL, NULL, '2015-01-26 14:49:02', NULL, 'toko_maru_'),
(56, '1376205260', 'モグラのおっさん', 'http://pbs.twimg.com/profile_images/452213454821011456/1K5n_kvG_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:03', NULL, 'mogura_ossan'),
(57, '2985323990', 'ひろみ♡', 'http://pbs.twimg.com/profile_images/555998750326284289/YIG7I9Eh_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:03', NULL, 'T0730Hiromi'),
(58, '2766974556', 'E-girlsLoveひでっしー', 'http://pbs.twimg.com/profile_images/504586405209591808/AP7wsBAT_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:03', NULL, '6517Yutaman'),
(59, '2603626794', 'E-girlsエンタテイメント@LDH', 'http://pbs.twimg.com/profile_images/528477879776985088/W_1Badxz_normal.jpeg', NULL, NULL, 2, 'TOKYO・JAPAN', NULL, NULL, NULL, NULL, '2015-01-26 14:49:04', NULL, 'EgTRIBE_ldh'),
(60, '2943846146', '修太', 'http://pbs.twimg.com/profile_images/549093750228516865/i_K6jPIE_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:04', NULL, 'shuta630'),
(61, '2561508260', 'Tata Ruta', 'http://pbs.twimg.com/profile_images/476836002296639488/dGA8jPc6_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:04', NULL, 'Tata_Ruta'),
(62, '2983057658', 'CoverGap', 'http://pbs.twimg.com/profile_images/555964243271356416/I5fbNODY_normal.jpeg', NULL, NULL, 2, 'Canada', NULL, NULL, NULL, NULL, '2015-01-26 14:49:05', NULL, 'CoverGap'),
(63, '71496508', 'STRASBURGO', 'http://pbs.twimg.com/profile_images/378800000737802862/090c3bc087decc712d87a713b1204be3_normal.jpeg', NULL, NULL, 2, '東京都港区', NULL, NULL, NULL, NULL, '2015-01-26 14:49:06', NULL, 'stras_burgo'),
(64, '1585429818', 'Anna Yanti', 'http://pbs.twimg.com/profile_images/550978473615839233/ReIZtFSG_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:06', NULL, 'Yan0383'),
(65, '2274398414', '暴威(`へ´*)ノ', 'http://pbs.twimg.com/profile_images/553206824061513728/H9UF13Q1_normal.jpeg', NULL, NULL, 2, '海の近く', NULL, NULL, NULL, NULL, '2015-01-26 14:49:07', NULL, 'i19193298'),
(66, '2994922087', 'Rumya Handmade', 'http://pbs.twimg.com/profile_images/559045099036741632/TMOz6m-y_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:07', NULL, 'RumyaHandmade'),
(67, '2343086545', 'Lea', 'http://pbs.twimg.com/profile_images/554449506616348674/UmEmc5fL_normal.png', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:07', NULL, 'Leayrkb'),
(68, '2873043632', 'ココロ', 'http://pbs.twimg.com/profile_images/552721752694849536/NnfEBI9l_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:08', NULL, '_cotoba'),
(69, '1628650519', '花風景 BOT', 'http://pbs.twimg.com/profile_images/378800000407157344/afbf2fc8da88ba2fbfbbf5c52de6e988_normal.jpeg', NULL, NULL, 2, '花のあるところ', NULL, NULL, NULL, NULL, '2015-01-26 14:49:08', NULL, 'hanafukei'),
(70, '2695354392', '*さくら*', 'http://pbs.twimg.com/profile_images/494793549842370560/AxOkRnKL_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:09', NULL, 'sakura_t818'),
(71, '454084932', 'chomo♡♪', 'http://pbs.twimg.com/profile_images/553660469659987969/Tz09J8IU_normal.jpeg', NULL, NULL, 2, '♔ @aizu put it back on ♔', NULL, NULL, NULL, NULL, '2015-01-26 14:49:09', NULL, 'tyomo11'),
(72, '2210438863', 'あいあい', 'http://pbs.twimg.com/profile_images/548306365391699968/Uy4hJc3N_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:09', NULL, 'Rencoco528'),
(73, '1678708982', 'Surreal Fine Art', 'http://pbs.twimg.com/profile_images/378800000345542462/040f6bc7ff431465ce78231d6931b391_normal.jpeg', NULL, NULL, 2, 'Worldwide', NULL, NULL, NULL, NULL, '2015-01-26 14:49:10', NULL, 'SurrealFineArt'),
(74, '820910882', 'water ゆっくり♪', 'http://pbs.twimg.com/profile_images/551971213048680448/bj6XLHxF_normal.jpeg', NULL, NULL, 2, '横浜 Men', NULL, NULL, NULL, NULL, '2015-01-26 14:49:10', NULL, 'mizuoto086'),
(75, '2892290408', 'Meg｡･*･:♪(リプ遅くなります)', 'http://pbs.twimg.com/profile_images/544293208113430529/z60az8cQ_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:10', NULL, 'Meg_innocent'),
(76, '2684693982', 'RM Home Decor', 'http://pbs.twimg.com/profile_images/494506960260055041/4g7D6iLi_normal.png', NULL, NULL, 2, 'USA', NULL, NULL, NULL, 1, '2015-01-26 14:49:11', NULL, 'rmhomedecor'),
(77, '28812824', 'Sipo Liimatainen', 'http://pbs.twimg.com/profile_images/378800000497669344/5c6af83db80ca0eba0a83846ba9afff6_normal.jpeg', NULL, NULL, 2, 'Worldwide', NULL, NULL, NULL, NULL, '2015-01-26 14:49:11', NULL, 'SipoArt'),
(78, '2420647723', 'ゆーと', 'http://pbs.twimg.com/profile_images/554226168547643393/30Y7fj1f_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, 1, '2015-01-26 14:49:12', NULL, 'KurokoYuto'),
(79, '1484473176', 'Ayuna', 'http://pbs.twimg.com/profile_images/558567111312683008/M8UobYvB_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, 0, '2015-01-26 14:49:12', NULL, '0601_ayu'),
(80, '2982542454', 'AOI@LDH垢', 'http://pbs.twimg.com/profile_images/558027697910075392/GvYz7wmi_normal.jpeg', NULL, NULL, 2, '', NULL, NULL, NULL, NULL, '2015-01-26 14:49:12', NULL, 'ldhksgy'),
(81, '2529826236', 'RedRiverValley', 'http://pbs.twimg.com/profile_images/471620411038261249/JMAq-UYe_normal.jpeg', NULL, NULL, 2, 'Iowa', NULL, NULL, NULL, 1, '2015-01-26 14:49:12', NULL, 'RedRiverValley2');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `VoteImageId` int(11) NOT NULL,
  `VoteUserId` int(11) NOT NULL,
  PRIMARY KEY (`VoteImageId`,`VoteUserId`),
  KEY `vote_user` (`VoteUserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_image` FOREIGN KEY (`CommentImageID`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`CommentUserID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `image_user` FOREIGN KEY (`ImageAuthor`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `vote_image` FOREIGN KEY (`VoteImageId`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_user` FOREIGN KEY (`VoteUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `reset_votes` ON SCHEDULE EVERY 1 DAY STARTS '2015-02-12 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO TRUNCATE TABLE `votes`$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
