-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.18-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for rcdb
DROP DATABASE IF EXISTS `rcdb`;
CREATE DATABASE IF NOT EXISTS `rcdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `rcdb`;

-- Dumping structure for table rcdb.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(40) NOT NULL,
  `fullname` varchar(80) DEFAULT NULL,
  `contact` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table rcdb.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`username`, `password`, `fullname`, `contact`, `email`) VALUES
	('mai', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', ''),
	('rick', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', '');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table rcdb.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(60) NOT NULL,
  PRIMARY KEY (`catid`),
  FULLTEXT KEY `catname` (`catname`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table rcdb.category: ~3 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`catid`, `catname`) VALUES
	(7, 'calendar'),
	(8, 'diary'),
	(9, 'other');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table rcdb.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `dimension` varchar(1000) DEFAULT NULL,
  `material` varchar(1000) DEFAULT NULL,
  `price` varchar(20) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `catid` int(11) NOT NULL,
  PRIMARY KEY (`productid`),
  KEY `catid` (`catid`),
  FULLTEXT KEY `name` (`name`,`dimension`,`material`,`price`,`description`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `category` (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table rcdb.product: ~14 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`productid`, `name`, `dimension`, `material`, `price`, `description`, `image`, `catid`) VALUES
	(1, 'Female Art Calendar 2021 | New 2021 Illustration Wall Calendar | Modern Calendar 2021 | Printable Calendar | Monday And Sunday Starts', '13 x A4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) JPEG format 1 x A4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) PDF ready to print. 1 x A3 (11,7&quot; x 16.5&quot;; 29,7 x 42cm) PDF ready to print. Sunday starts calendar (Cover Page + Jan 2021 - Dec 2021): 13xA4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) JPEG format 1 x A4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) PDF ready to print. 1 x A3 (11,7&quot; x 16.5&quot;; 29,7 x 42cm) PDF ready to print.', '', '1.99', '13 x A4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) JPEG format 1 x A4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) PDF ready to print. 1 x A3 (11,7&quot; x 16.5&quot;; 29,7 x 42cm) PDF ready to print. Sunday starts calendar (Cover Page + Jan 2021 - Dec 2021): 13xA4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) JPEG format 1 x A4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) PDF ready to print. 1 x A3 (11,7&quot; x 16.5&quot;; 29,7 x 42cm) PDF ready to print.', '../img/il_794xN.2653531562_e3kn.jpg ../img/il_794xN.2653534158_9tow.jpg ../img/il_794xN.2701202513_ljrr.jpg ../img/il_794xN.2701202779_2ci1.jpg', 7),
	(2, 'Printable 2021 Monthly calendar planner, Neutral Boho Calendar, Modern Abstract Planner, Minimalist Calendar 2021 download, wall planner', '13 x A4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) JPEG format 1 x A4 (8,3&quot; x 11,7&quot;; 21 x 29,7cm) PDF ready to print. 1 x A3 (11,7&quot; x 16.5&quot;; 29,7 x 42cm) PDF ready to print.', '', '2.99', '', '../img/il_794xN.2746329532_ot9f.jpg ../img/il_794xN.2746329538_asxr.jpg ../img/il_794xN.2746329542_1c9t.jpg ../img/il_794xN.2794033375_skii.jpg', 7),
	(3, '2021 Wall Calendar | Abstract Rainbow Monthly Calendar | 2021 Illustrated Art Calendar', 'Size: A4 - 21 × 29.7 cm or 8.3 × 11.7 inches (similar to Letter size)', ' Printed on 200 gsm matt paper (easy to write on), with 300gsm covers.', '7.6', 'Each month features a grid with the dates with room to write notes, appointments etc. with beautiful abstract designs at the top of each page.\r\n\r\nThis is an A4 size wall calendar for 2021, which runs from January 2021 - December 2021.\r\n\r\nPrinted on recycled and recyclable paper.\r\n\r\nMakes for a lovely &amp; practical Birthday gift or Christmas gift.\r\n\r\nSize: A4 - 21 × 29.7 cm or 8.3 × 11.7 inches (similar to Letter size)\r\n\r\nQuality: Printed on 200 gsm matt paper (easy to write on), with 300gsm covers.\r\n\r\nMade in the UK.', '../img/il_794xN.2507802300_fzxv.jpg ../img/il_794xN.2507802398_kpup.jpg ../img/il_794xN.2507802716_pqq6.jpg ../img/il_794xN.2555477201_pts8.jpg', 7),
	(4, 'Ink and Watercolor Spiral-bound Floral Calendar - Desk or Wall', '8 1/2&quot; x 11&quot; or 11&quot; x 17&quot;', '-Original hand-drawn ink and watercolor floral print calendar, each month displaying it&#039;s own unique display of wildflowers. -Made with quality paper and spiral-bound with brass wiring.', '4.6', 'Brighten up your day with this beautiful and eye-catching ink and watercolor calendar! A perfect addition to your office, bedroom, dorm room, kitchen, or anywhere else!\r\n\r\nThis versatile calendar can either be used as a desk calendar or hung on the wall.', '../img/il_794xN.2455227610_kghw.jpg ../img/il_794xN.2502890353_biz6.jpg ../img/il_794xN.2821896589_24fo.jpg ../img/il_794xN.2821905651_ijv1.jpg', 7),
	(5, 'Lunar Calendar 2021', '10&quot; x 15&quot;', 'black and white print on ivory card stock', '5.99', 'This hand drawn lunar calendar print gives you an at-a-glance reference for the moon phase of each day of the year.\r\n\r\n-artist&#039;s original design\r\n-10&quot; x 15&quot;\r\n-black and white print on ivory card stock\r\n-individually wrapped in butcher paper with gold foil seal and tied with natural twine\r\n-perfect for the office, kitchen, bedroom, or apartment', '../img/il_794xN.2585219002_5njr.jpg ../img/il_794xN.2632875447_qt7c.jpg ../img/il_794xN.2632955895_qiqt.jpg', 7),
	(6, '2021 Calendar Printable, Desk Calendar Monthly, Flowers Watercolor, Botanical Floral Wall, PDF, Letter Size, A4, Elegant Pretty', 'Letter Size (8.5 x 11 in) and A4 in PDF Format', '', '8.9', 'PRINTABLE 2021 CALENDAR - Botanical Floral Style', '../img/il_794xN.2736364444_8mow.jpg ../img/il_794xN.2736364500_hoic.jpg ../img/il_794xN.2782553807_pyxr.jpg ../img/il_794xN.2782553845_fp4o.jpg ../img/il_794xN.2811597707_1zpg.jpg', 7),
	(7, 'Printable 2021 Calendar with To Do List, Notes | Desk Calendar, Letter Size, A4, Monday &amp; Sunday Start Monthly | Instant Download', ' Letter Size (8.5 x 11 in) and A4', '', '7.5', '', '../img/il_794xN.2784154895_lcnq.jpg ../img/il_794xN.2784154999_qm15.jpg ../img/il_794xN.2784159277_aepg.jpg', 7),
	(8, 'NEW! 2021 2022 Monthly Calendar Printable, Two 2 Page Planner Insert, Lined, Sunday Monday Start, A4 A5 Letter Half Size PDF CLP01-02', '• A4 (210 mm x 297 mm) • A5 (148 mm x 210 mm) • Half-letter (5.5&quot; x 8.5&quot;) • Letter (8.5&quot; x 11&quot;)', '', '1.99', '', '../img/il_794xN.2415934456_s1as.jpg ../img/il_794xN.2453144365_9y7u.jpg ../img/il_794xN.2736861468_julg.jpg ../img/il_794xN.3017470012_ipjd.jpg', 7),
	(9, 'Printable Calendar 2021-2022 Calendar for Frame Planner Calendar Planner Insert Calendar Refills Minimalist Calendar PDF Monthly Calendar', '• US Letter (8.5 x 11 in, 216 x 279 mm) • A4 (8.3 x 11.7 in, 210 x 297 mm) (You can use this version for printing any other ', '', '2.86', '2021-2022 Printable Calendar.', '../img/il_794xN.2664893336_ip61.jpg ../img/il_794xN.2712577159_ami7.jpg ../img/il_794xN.2717679605_dwj3.jpg', 7),
	(10, 'May 2021 Calendar, Minimal Planner Printable, Blank Calendar, Sunday Start, US Letter Size', 'US letter size (8.5 in. x 11 in.)', '', '5.1', 'A minimal 2021 monthly calendar printable to help you set your plans for May', '../img/il_794xN.2962502134_juog.jpg ../img/il_794xN.2962502136_t96f.jpg', 7),
	(11, 'Matilda Myres 2021-22 Rose Gold A6 Day a Page Diaries - JULY &#039;21 TO JULY&#039;22', '', 'Handmade Materials: Hardback, Rose Gold Wiro, Ivory Paper, Rose Gold Foil', '12.9', '- Flexible card covers\r\n- Matt finish with detailed rose gold foiling\r\n- Day a Page layout - Sat/Sun shared page\r\n- Diary pages from 30th June 2021 to 31st July 2022 (13 months)\r\n- UK &amp; International public holidays (Europe, Australia, NZ, USA &amp; Canada)\r\n- &#039;Go-To&#039; pages - a one point destination for all your vital info\r\n- Quick view reference calendars\r\n- 80gsm ivory paper', '../img/il_794xN.2920052198_r9wf.jpg ../img/il_794xN.2920052534_qsba.jpg ../img/il_794xN.2920054666_jxrt.jpg ../img/il_794xN.2967742617_s51f.jpg ../img/il_794xN.2967748371_pc7b.jpg', 8),
	(12, '2021 - 2022 Academic A5 Day to View Diary Hand Covered in a Beautiful Vintage Indian Elephant Fabric', '', 'Handmade Materials: Hardback, Rose Gold Wiro, Ivory Paper, Rose Gold Foil', '21.97', 'This A5 Academic 2021 - 2022 Day to View Diary has been hand covered with a vintage Indian Fabric. Every day has it&#039;s own page, except for Saturday and Sunday share a page.\r\n\r\nThis striking fabric features a beautiful pattern of elephants and flowers on a black background. The fabric was found in an Antiques Shop on the edge of the Yorkshire Dales. The diary has been lined in a complimentary card and has a black satin marker ribbon.\r\n\r\nThe diary features a section for personal details, holidays &amp; festivals, conversions, timetables, addresses and telephone numbers, personal expenses and notes.', '../img/il_794xN.3066655164_8dku.jpg ../img/il_794xN.3066655248_hmyk.jpg ../img/il_794xN.3114388841_6xai.jpg ../img/il_794xN.3114388953_q1t3.jpg', 8),
	(13, 'The perfect goal setting diary planner 2021', '', '', '29.38', 'You know what they say: A failure to plan is a plan to fail. Stay on track for your #goals for the year with these super cute and helpful planners. There is not a single white page in our planner, every single page is filled with color to inspire! Packed with the typical calendar, daily lists, and holiday dates, they also feature some not so typical pages like extra focused goal-setting guides, vision boards, and of course, cute illustrations throughout! Of course there is a sticker sheet, and a folder, a detailed instruction guide, and tons of prompts and guides to help you set your goals. Take a page from our book and plan to succeed with a dated planner!', '../img/il_794xN.3030609522_a31u.jpg ../img/il_794xN.3030609558_6ktx.jpg ../img/il_794xN.3078325123_3e6s.jpg ../img/il_794xN.3078325199_clog.jpg', 8),
	(14, 'Travel Journal A5 Diary Notebook', '', 'Handmade Materials: Hardback, Rose Gold Wiro, Ivory Paper, Rose Gold Foil', '30.86', 'A perfect A5 journal for documenting all your magical adventures in one place. This journal is a great purchase for yourself if you are a keen traveller or a wonderful gift for a friend or family. Pages include; bucket list, inspirational ideas, colour-in map, travel quotes, space to stick in photos, and lots of note pages to write down all your unforgettable memories.', '../img/il_794xN.2965123374_dvvw.jpg ../img/il_794xN.2965123388_4tqq.jpg ../img/il_794xN.2965123726_lgld.jpg ../img/il_794xN.3074313574_r1n8.jpg', 8);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
testtest