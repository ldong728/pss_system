-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-21 11:04:40
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pss_system_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `caigou_detail_tbl`
--

CREATE TABLE `caigou_detail_tbl` (
  `caigou_detail_id` int(11) NOT NULL,
  `caigou` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `caigou_detail_tbl`
--

INSERT INTO `caigou_detail_tbl` (`caigou_detail_id`, `caigou`, `product`, `price`, `amount`, `type`) VALUES
(1, 1, 1, 10, 3, ''),
(2, 2, 10, 0, 1, '');

-- --------------------------------------------------------

--
-- 替换视图以便查看 `caigou_detail_view`
--
CREATE TABLE `caigou_detail_view` (
`caigou_detail_id` int(11)
,`caigou` int(11)
,`product` int(11)
,`price` int(11)
,`amount` int(11)
,`type` varchar(100)
,`sn` varchar(32)
,`img` varchar(50)
,`name` varchar(40)
,`unit` varchar(3)
);

-- --------------------------------------------------------

--
-- 表的结构 `caigou_tbl`
--

CREATE TABLE `caigou_tbl` (
  `caigou_id` int(11) NOT NULL,
  `provider` int(11) NOT NULL,
  `total_fee` decimal(8,2) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_time` datetime DEFAULT NULL,
  `remark` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `caigou_tbl`
--

INSERT INTO `caigou_tbl` (`caigou_id`, `provider`, `total_fee`, `create_time`, `delivery_time`, `remark`) VALUES
(1, 1, '30.00', '2018-01-03 06:17:20', '2018-01-18 00:00:00', ''),
(2, 2, '0.00', '2018-01-09 11:07:51', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- 替换视图以便查看 `caigou_view`
--
CREATE TABLE `caigou_view` (
`caigou_id` int(11)
,`provider` int(11)
,`total_fee` decimal(8,2)
,`create_time` timestamp
,`delivery_time` datetime
,`remark` text
,`provider_name` varchar(30)
,`address` varchar(50)
,`contact` varchar(5)
,`tel` varchar(12)
);

-- --------------------------------------------------------

--
-- 表的结构 `category_tbl`
--

CREATE TABLE `category_tbl` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(15) NOT NULL,
  `p_category` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category_tbl`
--

INSERT INTO `category_tbl` (`category_id`, `category_name`, `p_category`) VALUES
(19, '三角阀', 0),
(27, '全铜下水器', 0),
(18, '地漏', 0),
(24, '小便斗', 0),
(25, '拖把池', 0),
(4, '梳妆台', 0),
(6, '毛巾架', 0),
(23, '洗菜盆', 0),
(16, '洗衣柜', 0),
(21, '浴缸', 0),
(1, '淋浴升降', 0),
(26, '艺术盆', 0),
(22, '连体盆', 0),
(20, '马桶', 0),
(17, '龙头', 0);

-- --------------------------------------------------------

--
-- 表的结构 `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(7) NOT NULL,
  `customer_tel` varchar(12) NOT NULL,
  `customer_address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `customer_tbl`
--

INSERT INTO `customer_tbl` (`customer_id`, `customer_name`, `customer_tel`, `customer_address`) VALUES
(1, '测试客户', '12121212121', '测试客户地址'),
(2, '钱建红', '13216684550', '相公殿村');

-- --------------------------------------------------------

--
-- 表的结构 `operator_tbl`
--

CREATE TABLE `operator_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `nick_name` varchar(14) DEFAULT NULL,
  `pwd` varchar(40) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` varchar(20) NOT NULL DEFAULT 'admin',
  `md5` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `operator_tbl`
--

INSERT INTO `operator_tbl` (`id`, `name`, `nick_name`, `pwd`, `create_time`, `creator`, `md5`) VALUES
(1, 'test1', NULL, 'test2', '2017-12-25 04:44:54', '-1', 'ad0234829205b9033196ba818f7a872b');

-- --------------------------------------------------------

--
-- 表的结构 `op_pms_tbl`
--

CREATE TABLE `op_pms_tbl` (
  `o_id` int(11) NOT NULL,
  `pms_id` varchar(20) NOT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `remark2` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `op_pms_tbl`
--

INSERT INTO `op_pms_tbl` (`o_id`, `pms_id`, `remark`, `remark2`) VALUES
(1, '113', NULL, NULL);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `op_pms_view`
--
CREATE TABLE `op_pms_view` (
`pms_id` varchar(20)
,`id` int(11)
,`name` varchar(20)
,`pwd` varchar(40)
,`create_time` timestamp
,`creator` varchar(20)
,`md5` varchar(40)
);

-- --------------------------------------------------------

--
-- 表的结构 `order_detail_tbl`
--

CREATE TABLE `order_detail_tbl` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `order_detail_tbl`
--

INSERT INTO `order_detail_tbl` (`order_detail_id`, `order_id`, `product`, `amount`, `status`) VALUES
(8, 4, 11, 3, 1),
(9, 4, 72, 1, 1),
(10, 4, 84, 1, 1),
(11, 4, 101, 1, 1),
(12, 4, 110, 1, 1),
(13, 4, 123, 1, 1),
(14, 4, 124, 1, 1),
(15, 5, 8, 1, 1),
(16, 5, 9, 1, 1),
(17, 6, 6, 1, 1),
(18, 6, 7, 1, 1);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `order_detail_view`
--
CREATE TABLE `order_detail_view` (
`order_detail_id` int(11)
,`order_id` int(11)
,`product` int(11)
,`amount` int(11)
,`product_name` varchar(40)
,`product_sn` varchar(32)
,`price` decimal(8,2)
,`unit` varchar(3)
,`status` tinyint(4)
);

-- --------------------------------------------------------

--
-- 表的结构 `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL DEFAULT '0',
  `custom_info` varchar(60) DEFAULT NULL,
  `total_fee` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_time_unix` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `remark` text,
  `delivery_time` datetime DEFAULT NULL,
  `delivery_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `customer`, `custom_info`, `total_fee`, `discount`, `create_time`, `create_time_unix`, `creator`, `remark`, `delivery_time`, `delivery_status`) VALUES
(4, 2, NULL, '14149.60', '3537.40', '2018-01-09 10:28:22', 1515493702, -1, '', '0000-00-00 00:00:00', 1),
(5, 1, NULL, '440.00', '100.00', '2018-01-09 11:16:28', 1515496588, -1, '折扣100， H-800 1.2M 红色', '2018-01-17 00:00:00', 1),
(6, 2, NULL, '3980.00', '0.00', '2017-12-27 16:00:00', 1514390400, -1, '测试', '2018-01-31 00:00:00', 1);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `order_view`
--
CREATE TABLE `order_view` (
`order_id` int(11)
,`customer` int(11)
,`custom_info` varchar(60)
,`total_fee` decimal(8,2)
,`discount` decimal(8,2)
,`create_time` timestamp
,`delivery_time` datetime
,`create_time_unix` int(11)
,`creator` int(11)
,`remark` text
,`customer_id` int(11)
,`customer_name` varchar(7)
,`customer_tel` varchar(12)
,`customer_address` varchar(40)
,`operator` varchar(20)
,`operator_nickname` varchar(14)
,`delivery_status` tinyint(4)
);

-- --------------------------------------------------------

--
-- 表的结构 `pms_tbl`
--

CREATE TABLE `pms_tbl` (
  `id` int(11) NOT NULL,
  `key_word` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pms_tbl`
--

INSERT INTO `pms_tbl` (`id`, `key_word`, `name`, `remark`) VALUES
(108, 'pms1234', '权限管理', NULL),
(109, 'rSPUdTFXGP', '供应商管理', NULL),
(110, 'WLtOnSSnCo', '产品管理', NULL),
(111, 'dMuAULNExF', '库存管理', NULL),
(112, 'nMQJKYKfPk', '客户管理', NULL),
(113, 'HgYTISEJXV', '销售管理', NULL),
(114, 'kVsMNdHEPY', '采购管理', NULL);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `pms_view`
--
CREATE TABLE `pms_view` (
`f_id` int(11)
,`f_key` varchar(20)
,`f_name` varchar(20)
,`s_id` int(11)
,`s_key` varchar(30)
,`s_name` varchar(30)
);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `product_provider_view`
--
CREATE TABLE `product_provider_view` (
`product_id` int(11)
,`provider` int(11)
,`category` int(11)
,`name` varchar(40)
,`sn` varchar(32)
,`brand` int(11)
,`img` varchar(50)
,`description` varchar(60)
,`default_price` decimal(8,2)
,`purchase_price` decimal(8,2)
,`unit` varchar(3)
,`stock` int(11)
,`provider_name` varchar(30)
,`address` varchar(50)
,`contact` varchar(5)
,`tel` varchar(12)
,`fax` varchar(12)
);

-- --------------------------------------------------------

--
-- 表的结构 `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(11) NOT NULL,
  `provider` int(11) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `sn` varchar(32) NOT NULL,
  `brand` int(11) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `description` varchar(60) NOT NULL,
  `default_price` decimal(8,2) DEFAULT NULL,
  `purchase_price` decimal(8,2) DEFAULT NULL,
  `unit` varchar(3) NOT NULL DEFAULT '',
  `stock` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `provider`, `category`, `name`, `sn`, `brand`, `img`, `description`, `default_price`, `purchase_price`, `unit`, `stock`) VALUES
(2, 2, 25, '拖把池', 'CN061-01', 0, '../files/73aa2ab44b78ffc718db3118e51495ef.jpg', '陶瓷', '360.00', '0.00', '个', 2),
(3, 2, 24, '感应小便斗', 'CN042-01', 0, '../files/44075d85f5e8ef21723778e3e504113b.jpg', '感应，陶瓷', '1260.00', '0.00', '个', 4),
(4, 2, 24, '悬挂式感应小便斗', 'CN048-02', 0, '../files/c6ba04af039162fa24777c50a5f5bbb5.jpg', '感应，陶瓷', '1290.00', '0.00', '个', 1),
(6, 2, 22, '连体柱盆', 'CN021-01', 0, '../files/e4fbf6c71f02fc44b5911f7d60f0df88.jpg', '陶瓷  规格470*510*850', '1980.00', '0.00', '个', -1),
(7, 2, 22, '连体柱盆', 'CN022-01', 0, '../files/9fd999cc1ec8da1c7f66d750f0d8ece5.jpg', '陶瓷  规格 470*510*850', '2000.00', '0.00', '个', -1),
(8, 2, 28, '蹲便器', 'CN055S-01', 0, '../files/75831202f56ca1a1b3324e4b2362151f.jpg', '陶瓷  规格560*440*290', '260.00', '0.00', '个', -1),
(9, 2, 28, '蹲便器', 'CN058S-02', 0, '../files/5e31eeb9ad2716db9793dc9f24e377d5.jpg', '陶瓷  规格 560*440*290', '280.00', '0.00', '个', -1),
(10, 2, 20, '虹吸式座便器', 'CN1008-02', 0, '../files/6ac5d7253759e9ce58d4688eeaf1578c.jpg', '陶瓷  规格 680*390*780', '1099.00', '0.00', '个', 6),
(11, 2, 20, '智能马桶', 'CN006-08', 0, '../files/40ce94bd05e4d826eaa5075b2f1a689c.jpg', '陶瓷  规格 690*380*790', '4880.00', '0.00', '个', 0),
(12, 2, 20, '虹吸式座便器', 'CN1020-04', 0, '../files/d626c660235c360f1a80629f21e3f3e9.jpg', '陶瓷  规格 680*375*760', '1040.00', '0.00', '个', 6),
(13, 2, 20, '虹吸式座便器', 'CN1053-05', NULL, '../files/860e079a4df06332aa483839a27a97ad.jpg', '陶瓷  规格 700*430*620', '1290.00', NULL, '个', 5),
(14, 2, 20, '虹吸式座便器', 'CN1054-06', NULL, '../files/46fd0d0db5da6d3de1daccaa73f031f4.jpg', '陶瓷  规格 720*425*770', '1050.00', NULL, '个', 5),
(15, 2, 20, '虹吸式座便器', 'CN1056-01', NULL, '../files/5f49be7f3778a14c39b58ed760f6eaf4.jpg', '陶瓷  规格 700*360*740', '1080.00', NULL, '个', 0),
(16, 2, 20, '虹吸式座便器', 'CN1058-03', NULL, '../files/9dfc7819c21bbf909a1008350be65c95.jpg', '陶瓷  规格 710*390*780', '1060.00', NULL, '个', 0),
(17, 2, 20, '智能马桶', 'CN8002A-07', NULL, '../files/6bbda9b50f0047facc5122f18addc7b0.jpg', '陶瓷  规格 690*400*487', '5080.00', NULL, '个', 0),
(18, 2, 20, '智能马桶', 'CN8005A-09', NULL, '../files/2843213593c02b33be493b2620bc6d3b.jpg', '陶瓷  规格 685*397*525', '5280.00', NULL, '个', 0),
(19, 4, 32, '浴室柜', 'CNY646-07', 0, '../files/07f397170a41831cf584bf4a69f85a5d.png', '多层实木，1200*550*550', '8800.00', '0.00', '个', 0),
(20, 4, 32, '侧柜', 'CNY646Z-08', 0, '../files/2aef1d994883261943646644e2326934.png', '多层实木，485*180*1500', '4800.00', '0.00', '个', 0),
(21, NULL, 19, '三角阀', 'CNJF-01-03', NULL, '../files/703fd193ab941e49d6d212f581064321.jpg', '铜', '50.00', NULL, '个', 1),
(22, NULL, 19, '三角阀', 'CNJF-02-04', NULL, '../files/eeeda0dd88664c39760701ece2a4de95.jpg', '铜', '60.00', NULL, '个', 1),
(23, NULL, 19, '三角阀', 'CNXYS01-01', NULL, '../files/b99d9230113639749d0a65000445f2b4.jpg', '不锈钢', '39.00', NULL, '个', 0),
(24, NULL, 19, '三角阀', 'CNXYS02-02', NULL, '../files/0e4a6f357adceb1028b322f99c2bf9fa.jpg', '不锈钢', '30.00', NULL, '个', 0),
(25, 9, 27, '全铜下水器', 'CN181M-01', NULL, '../files/2594eb91c23f8cee5d7dd372e2a88d68.jpg', '玫瑰金  铜', '80.00', NULL, '个', 0),
(26, NULL, 0, '主柜', 'CNY619-05', NULL, '../files/2a53175b040517638e0a322cc7f3fec7.png', '1000*520*850', '8800.00', NULL, '个', 0),
(27, 9, 27, '全铜下水器', 'CN182M-02', NULL, '../files/9e9463efcf14b10bf836c79365f40774.jpg', '镀金 铜', '80.00', NULL, '个', 0),
(28, 4, 32, '侧柜', 'CNYZ619-06', 0, '../files/effbc28b5bdcd6306570b78906d08914.png', '350*355*1600', '3300.00', '0.00', '个', 0),
(29, 9, 27, '全铜下水器', 'CN183M-03', NULL, '../files/d57965065e4a10808ed567eb4581202e.jpg', '仿青铜  铜', '86.00', NULL, '个', 0),
(30, 9, 27, '全铜下水器', 'CN184m-04', NULL, '../files/53472de56a79f23dedfa8bb8955d6919.jpg', '电镀 铜', '60.00', NULL, '个', 0),
(31, 4, 32, '主柜', 'CNY636-09', 0, '../files/bb89d3f9ffe1662556996073fa182126.png', '800*540*850', '8600.00', '0.00', '个', 0),
(33, 4, 32, '侧柜', 'CNYZ636-10', NULL, '../files/4367af54107844ff126912a7ae12c1e5.png', '780*180*780', '3600.00', NULL, '个', 0),
(34, 9, 18, '地漏', 'CN185M-01', NULL, '../files/bd3b377887c909cc14ff6926fbf9f811.jpg', '不锈钢  规格：98mm*98mm', '40.00', NULL, '个', 0),
(35, 9, 18, '地漏', 'CN186M-02', NULL, '../files/3d2c750aed3dc02a39201b8b800e523a.jpg', '不锈钢  规格：98mm*98mm', '30.00', NULL, '个', 0),
(36, 1, 32, '浴室柜', 'CNG-1200-11', NULL, '../files/cd0da2416fce70b4ec6d9767d1c00c57.png', '1194*476*450', '13600.00', NULL, '个', 0),
(37, 9, 18, '地漏', 'CN187M-03', NULL, '../files/b125b4a0e03e7041525447b4c4c174a5.jpg', '不锈钢  规格：98mm*98mm', '30.00', NULL, '个', 0),
(38, NULL, 18, '地漏', 'CN20105-04', NULL, '../files/3c2f3d3a64e60c81d60a1d5b72b5c9b0.jpg', '铜  规格：101mm*101mm', '80.00', NULL, '个', 0),
(39, NULL, 18, '地漏', 'CN20111-05', NULL, '../files/0cafca18c3571fac5fd5287a01b53487.jpg', '铜  规格：101mm*101mm', '90.00', NULL, '个', 0),
(40, NULL, 18, '地漏', 'CN20112-06', NULL, '../files/878b1c49a396a6f6af719963099f30b5.jpg', '铜  规格：101mm*101mm', '80.00', NULL, '个', 0),
(41, NULL, 18, '地漏', 'CN80211-07', NULL, '../files/e2e9ee2f2252872e61f0a74c1c3dd570.jpg', '铜   规格：210mm*83mm', '180.00', NULL, '个', 0),
(42, 1, 32, '浴室柜', 'CNS-900-04', NULL, '../files/1839377004eac82f5104ee284286a6da.png', '994*476*450', '6800.00', NULL, '个', 0),
(43, NULL, 18, '地漏', 'CN80311-08', NULL, '../files/d36f11022181b9f17bd1223f9fd1c3b0.jpg', '铜   规格：310mm*83mm', '280.00', NULL, '个', 0),
(44, NULL, 18, '地漏', 'CNMX01-09', NULL, '../files/b733b22e2176929bb28717ecd1b50109.jpg', '不锈钢  规格：98mm*98mm', '30.00', NULL, '个', 0),
(45, NULL, 18, '地漏', 'CNMX02-10', NULL, '../files/a8dc17323c5ceb7a36c3b4a019d55a33.jpg', '不锈钢  规格：98mm*98mm', '39.00', NULL, '个', 0),
(46, NULL, 18, '地漏', 'CNZD-11', NULL, '../files/fa32d535c68afffc6463561c0c354d87.jpg', '铜   规格：600mm*50mm', '560.00', NULL, '个', 0),
(47, NULL, 18, '地漏', 'CNZD-12', NULL, '../files/0faab60e18fbd6a92ae538b284c8474b.jpg', '铜  规格：600mm*50mm', '520.00', NULL, '个', 0),
(48, 1, 32, '浴室柜', 'CNW-800-12', NULL, '../files/ad219a9ca33d26a5eb1b058fc4566188.png', '800*540*850', '5200.00', NULL, '个', 0),
(49, 1, 32, '浴室柜', 'CNH-900-03', NULL, '../files/f5ca8ad2515730287bb04436c99295e8.png', '900*478*450', '7300.00', NULL, '个', 0),
(50, 7, 32, '浴室柜', 'CN3006-01', 0, '../files/f698cec7f7e2800c68810c393cbe157c.png', '红橡木，1000*580*830', '8200.00', '0.00', '个', 0),
(51, NULL, 17, '洗衣机龙头', 'CNBXG01-01', NULL, '../files/01285fd1ffa6e360fce72250afeb731d.jpg', '拉丝不锈钢', '56.00', NULL, '个', 0),
(52, NULL, 17, '洗衣机龙头', 'CNSZ-01-03', NULL, '../files/975b44bf6b4dd16bb092c3211d0e97c1.jpg', '仿古 黄铜', '86.00', NULL, '个', 0),
(53, NULL, 17, '洗衣机龙头', 'CNSZ-03-04', NULL, '../files/005bf715b42b83801d6170fde5c5e0b1.jpg', '仿古 黄铜', '90.00', NULL, '个', 0),
(54, NULL, 17, '洗衣机龙头', 'CNSZ11-05', NULL, '../files/4b85015d85d8bb7efb9996df83776e3a.jpg', '仿古 黄铜', '90.00', NULL, '个', 0),
(55, NULL, 17, '洗衣机龙头', 'CNSZ15-06', NULL, '../files/7ab0dcdefe491c67448828aeabaaf862.jpg', '仿古黄铜', '99.00', NULL, '个', 0),
(56, NULL, 17, '洗衣机龙头', 'CNXYX01-07', NULL, '../files/e2b87bc46c15cea2f62ed84462a3f13e.jpg', '电镀 铜', '56.00', NULL, '个', 0),
(57, 11, 16, '洗衣柜', 'CNXYG-02', NULL, '../files/abef1d2b4bf7a3eb1d177bf9cc1aaacc.png', ' 石英石，1200mm', '1800.00', NULL, '个', 1),
(58, 13, 17, '面盆龙头', 'CN01DB-01', NULL, '../files/fe9934f12d838646f51945dd74df26c1.jpg', '拉丝 铜', '380.00', NULL, '个', 0),
(59, 13, 17, '面盆龙头', 'CN03DB-02', NULL, '../files/2ae9f807122e6bc32f8216e130cae2b8.jpg', '拉丝 铜', '380.00', NULL, '个', 0),
(60, 13, 17, '面盆龙头', 'CN07DB-03', NULL, '../files/e6dc4fa358a8eba078c8cfeadaf968a0.jpg', '拉丝 铜', '380.00', NULL, '个', 0),
(61, NULL, 17, '面盆龙头', 'CN2101-04', NULL, '../files/b73a275fa94e654520cdbdfc168c1ddd.jpg', '拉丝 铜', '320.00', NULL, '个', 0),
(62, NULL, 17, '菜盆龙头', 'CN2102-05', NULL, '../files/91279af9b6a1feeee4203bc0763b706a.jpg', '拉丝 铜', '360.00', NULL, '个', 0),
(63, NULL, 17, '面盆龙头', 'CN2301-06', NULL, '../files/e2b0b6af11f3ddceef82ce765d49fe80.jpg', '拉丝 铜', '360.00', NULL, '个', 0),
(64, NULL, 17, '面盆龙头', 'CN2302-07', NULL, '../files/1a89188162c05540c8b6c013d475f68e.jpg', '电镀 铜', '340.00', NULL, '个', 0),
(65, NULL, 17, '菜盆龙头', 'CN2303-08', NULL, '../files/eb1b95639f59b3171eaf87d0d90a905d.jpg', '电镀 铜', '380.00', NULL, '个', 0),
(66, NULL, 17, '菜盆龙头', 'CN2304-09', NULL, '../files/925753bd458ca59b060a268039d4c993.jpg', '拉丝 铜', '380.00', NULL, '个', 0),
(67, NULL, 17, '菜盆龙头', 'CNAL9010-01-10', NULL, '../files/ee0a21f97b55f7f03058c68ad8a87ff8.jpg', '电镀 铜', '540.00', NULL, '个', 0),
(68, NULL, 17, '面盆龙头', 'CNB8006-12', NULL, '../files/c2d6410c97f60dc9c8f00101e9b50736.jpg', '电镀 铜', '620.00', NULL, '个', 0),
(69, NULL, 17, '面盆龙头', 'CNB8011-13', NULL, '../files/c674b1fa89924ac78f1dd3784af8664b.jpg', '电镀 铜', '360.00', NULL, '个', 0),
(70, NULL, 17, '面盆龙头', 'CNB8012-14', NULL, '../files/3ecdc73e382b642f2765ba9185adfe0d.jpg', '电镀 铜', '430.00', NULL, '个', 0),
(71, NULL, 17, '面盆龙头', 'CNB8016-15', NULL, '../files/2cca39b2977fd339da44e0c719689568.jpg', '电镀 铜', '660.00', NULL, '个', 0),
(72, NULL, 17, '菜盆龙头', 'CNBS07-17', NULL, '../files/1be891c7e19af53ff4b9745332179354.jpg', '电镀 铜', '280.00', NULL, '个', -2),
(73, NULL, 17, '菜盆龙头', 'CNBS08-18', NULL, '../files/392e8c9e37bb9d86a4ae7f8a0413d9ed.jpg', '电镀 铜', '290.00', NULL, '个', 0),
(74, NULL, 17, '菜盆龙头', 'CNNH01-19', NULL, '../files/d8173af7987790b1281875ac1024fd8d.jpg', '电镀 铜', '860.00', NULL, '个', 0),
(75, NULL, 17, '面盆龙头', 'CNS02-20', NULL, '../files/9982e817fba510ae8125192ea59cb21a.jpg', '电镀 铜', '300.00', NULL, '个', 0),
(76, NULL, 17, '菜盆龙头', 'CNTZ-01-21', NULL, '../files/5ae55ee170fa0f1cc00b08c11f4191ff.jpg', '电镀 铜', '320.00', NULL, '个', 0),
(77, NULL, 17, '菜盆龙头', 'CNYZ-07-23', NULL, '../files/8e852d75a970268c84ea407fc74f2f68.jpg', '电镀 铜', '290.00', NULL, '个', 0),
(78, NULL, 17, '浴缸龙头', 'CN61014-03', NULL, '../files/c3427d6eb589a8c4d5726e0241aa9f83.jpg', '黑+铬，铜', '2000.00', NULL, '个', 0),
(79, NULL, 17, '浴缸龙头', 'CN61014-04', NULL, '../files/3c968908c9504562b933dc924675a6f5.jpg', '白+铬，铜', '2300.00', NULL, '个', 0),
(80, 13, 1, '淋浴高杆', 'CN01-1M-03', NULL, '../files/c17f0aaee77473b25f262c524af16329.png', '铜', '1560.00', NULL, '个', 5),
(81, 13, 1, '淋浴高杆', 'CN03B-04', NULL, '../files/a2919d11063111304e6137672bb4d014.png', '', '1360.00', NULL, '个', 1),
(82, 13, 0, '淋浴高杆', 'CN07B-05', NULL, '../files/4fa8b2324ecead2686ef8370e0944ccb.png', '', '1300.00', NULL, '个', 0),
(83, 10, 0, '淋浴高杆', 'CN180006PW-02', NULL, '../files/b9ceaa865574599508bc826a71fea7b8.png', '', '1160.00', NULL, '个', 0),
(84, 10, 1, '淋浴高杆', 'CN180007PA-01', NULL, '../files/b536a1a17c3a619960871fa102578b59.png', '', '1360.00', NULL, '个', -1),
(85, 8, 0, '淋浴高杆', 'CN298-08', NULL, '../files/39472d2dab361c6dcfc539ada039bbe1.png', '', '980.00', NULL, '个', 0),
(86, 8, 0, '淋浴高杆', 'CN557-09', NULL, '../files/0c7408f77a14994ce2bcd899f16ebe99.png', '', '1090.00', NULL, '个', 0),
(87, 8, 0, '淋浴高杆', 'CN558-10', NULL, '../files/e5d18306ed378d7eeb4819da14e8341f.png', '', '1060.00', NULL, '个', 0),
(88, 8, 1, '淋浴高杆', 'CN998-12', NULL, '../files/ecca9ab3aa8fe9ec3e8903e973d97d34.png', '', '1200.00', NULL, '个', 0),
(89, 8, 1, '淋浴高杆', 'CN999-13', NULL, '../files/b08f86330ec0ec802b901c05af32e1f0.png', '', '1240.00', NULL, '个', 1),
(90, 3, 0, '淋浴高杆', 'CNA2-06', NULL, '../files/26798c40f216c4599b2779649bbd5788.png', '', '1360.00', NULL, '个', 0),
(91, 3, 0, '淋浴高杆', 'CNA3-07', NULL, '../files/c9cf534e30914d0694aa66f4f2a22368.png', '', '1860.00', NULL, '个', 0),
(92, 3, 0, '淋浴高杆', 'CNZ1-14', NULL, '../files/ed581d640e1e47e0837d25105039b749.png', '', '2600.00', NULL, '个', 0),
(93, 12, 26, '艺术盆', 'CNSE1220-04', NULL, '../files/9b193049add92e2c6aa8e68818884cd9.png', '', '1960.00', NULL, '个', 0),
(94, 12, 22, '连体柱盆', 'CNSE1103-03', NULL, '../files/ac54b7bd482dfe130f2fb35daa906826.png', '陶瓷  规格：600*425*885', '5800.00', NULL, '个', 0),
(95, 12, 0, '艺术盆', 'CNSE1244-05', NULL, '../files/7defbffadb201360e4073ad5b54c7de9.png', '590*390*128', '2360.00', NULL, '个', 0),
(96, 12, 0, '艺术盆', 'CNSE1245-06', NULL, '../files/68bf5a84597b05c3e33aac3001bc9bd0.png', '543*391*132', '2280.00', NULL, '个', 0),
(97, NULL, 4, '淋浴房', 'CNPT1865-01', NULL, '../files/9c09e4c8a1c83beed6a6a0d0c50515c5.jpg', '', '680.00', NULL, '个', 0),
(98, NULL, 4, '淋浴房', 'CNPT1865-02', NULL, '../files/24f280512484475d8cfb5f37525c317d.jpg', '', '680.00', NULL, '个', 0),
(99, NULL, 4, '淋浴房', 'CNPT1865-03', NULL, '../files/618badf9ebac83b7f9dcb2e02525409c.jpg', '', '580.00', NULL, '个', 0),
(100, 15, 6, '哑黑六件套', 'CN7038-15', 0, '../files/6bb97d21d9ae0eb900f093e0c6847d6f.png', '', '660.00', '0.00', '个', 0),
(101, NULL, 6, '亮光六件套', 'CN7048-11', NULL, '../files/a44366922b945eadb3f410707f9153e4.png', '', '580.00', NULL, '个', -2),
(102, 16, 6, '浴巾架', 'CN171-16', NULL, '../files/dd811a9eefa509716c70991e15973a3f.png', '', '580.00', NULL, '个', 0),
(103, 16, 6, '双杆', 'CN172-17', NULL, '../files/2c6ae4ce6e9c6d9ed56ac0d29aaeb0b3.png', '', '400.00', NULL, '个', 0),
(104, 16, 6, '单杆', 'CN173-18', NULL, '../files/a9f4d6ab61b4b3a8883dde74223064f7.png', '', '320.00', NULL, '个', 0),
(105, 16, 0, '马桶刷', 'CN174-19', NULL, '../files/03e3175cbb53f50b5cc1a4ded767ac62.png', '', '230.00', NULL, '个', 0),
(106, 16, 0, '纸巾盒', 'CN175-20', NULL, '../files/135c0037920153a627598eb438a8dbd1.png', '', '230.00', NULL, '个', 0),
(107, 16, 0, '双杯', 'CN176-21', NULL, '../files/97741d83f41bac7d5c6ac131c4d8a1f6.png', '', '260.00', NULL, '个', 0),
(108, 16, 0, '毛巾环', 'CN177-22', NULL, '../files/61b35bf938cc1afe3f9d2037209f3b19.png', '', '200.00', NULL, '个', 0),
(109, 8, 0, '浴巾架', 'CN178-14', NULL, '../files/8090301aa540e1b9b7e55b5cc1f0e476.png', '', '380.00', NULL, '个', 0),
(110, 8, 6, '纸巾盒', 'CN179-13', NULL, '../files/ce9809e5473020396df6da36c9210586.png', '', '40.00', NULL, '个', -2),
(111, 8, 0, '马桶刷', 'CN180-12', NULL, NULL, '', '70.00', NULL, '个', 0),
(112, NULL, 6, '三层角架', 'CN181-23', NULL, '../files/2d5835495b4406abe7f24ed9ae1ee41d.png', '', '200.00', NULL, '个', 0),
(113, NULL, 0, '毛巾环', 'CN6504-01', NULL, '../files/597e1af8643c749386db2e603a914e4b.png', '', '80.00', NULL, '个', 0),
(114, 17, 6, '纸巾架', 'CN6505-02', NULL, '../files/2ca00d3570fb1af27a58ecff2ab858db.png', '', '88.00', NULL, '个', 0),
(115, 17, 6, '马桶刷', 'CN6506-03', NULL, NULL, '', '90.00', NULL, '个', 0),
(116, 17, 6, '单杆', 'CN6507-04', NULL, '../files/191969b602fa2205177013b9ad7700ba.png', '', '90.00', NULL, '个', 0),
(117, 17, 6, '双杆', 'CN6508-05', NULL, '../files/9c81393ef4d799ce71e957f68f7a3a4b.png', '', '120.00', NULL, '个', 0),
(118, 17, 6, '浴巾架', 'CN6509-06', NULL, '../files/39d19ee3dfaf18956b20224ad0480269.png', '', '210.00', NULL, '个', 0),
(119, 17, 6, '双层角架', 'CN6562-07', NULL, '../files/9aa7fff4c57018db99fd6f30130c74b5.png', '', '210.00', NULL, '个', 0),
(120, 17, 6, '双层方篮', 'CN6564-08', NULL, '../files/4561a4a44609626d7c5055143f223631.png', '', '230.00', NULL, '个', 0),
(121, 17, 6, '双层角架', 'CN6566-09', NULL, '../files/aa59b85e89ba2e371e13e01a95c4da24.png', '', '210.00', NULL, '个', 0),
(122, 17, 6, '双层方篮', 'CN6568-10', NULL, '../files/e52f3e5dfdac4e85949e60629d81041f.png', '', '230.00', NULL, '个', 0),
(123, 2, 20, '', 'CN1038', NULL, NULL, '', '199.00', NULL, '个', -1),
(124, 7, 1, '', '爱浪', NULL, NULL, '', '588.00', NULL, '个', -1),
(125, 8, 6, '', '玻璃台盆', NULL, NULL, '', NULL, NULL, '个', 0);

-- --------------------------------------------------------

--
-- 表的结构 `provider_tbl`
--

CREATE TABLE `provider_tbl` (
  `provider_id` int(11) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contact` varchar(5) DEFAULT NULL,
  `tel` varchar(12) DEFAULT NULL,
  `fax` varchar(12) DEFAULT NULL,
  `QQ` varchar(13) DEFAULT NULL,
  `mail` varchar(20) DEFAULT NULL,
  `account_bank` varchar(15) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `provider_tbl`
--

INSERT INTO `provider_tbl` (`provider_id`, `unit`, `address`, `contact`, `tel`, `fax`, `QQ`, `mail`, `account_bank`, `account`, `creator`, `status`) VALUES
(1, '朵纳卫浴有限公司', '浙江台州临海市', '钱海燕', '13757616910', '', '', '', '中国银行临海支行', '376658335574', 0, 1),
(2, '冠珠瓷尚卫浴', '广东潮州市潮安区登塘镇开发区冠珠瓷尚陶瓷厂', '李佳亮', '13827348323', '', '', '', '农行 622 848 118 ', '  工行 622 202 200 287', NULL, 1),
(3, '波士顿', '广东江门鹤山市', '张雨钱', '13902552505', '', '', '', '工商 6222 0820 12', '农业 6228 4806 1298 96', NULL, 1),
(4, '金柏丽雅', '广东省佛山市禅城区季华二路智慧新城T10栋703号', '', '0757-8259758', '0757-8259758', '', '', '中国建设银行深圳机场支行', '6214667205502862', NULL, 1),
(5, '久洁卫浴', '浙江省余姚市陆埠镇五马工业区创新西路5号', '唐垚奎', '13376881108', '', '', '', '浙江省余姚陆埠支行', '6228480316140672668', NULL, 1),
(6, '埃飞灵', '', '', '', '', '', '', '', '', NULL, 1),
(7, '爱浪卫浴', '', '', '', '', '', '', '', '', NULL, 1),
(8, '佳义洁具', '', '', '', '', '', '', '', '', NULL, 1),
(9, '马长桥', '', '', '', '', '', '', '', '', NULL, 1),
(10, '麦步', '', '', '', '', '', '', '', '', NULL, 1),
(11, '孟天明洗衣柜', '', '', '', '', '', '', '', '', NULL, 1),
(12, '圣尼特', '', '', '', '', '', '', '', '', 0, 1),
(13, '王莲法', '', '', '', '', '', '', '', '', NULL, 1),
(14, '翔鹰卫浴', '', '', '', '', '', '', '', '', NULL, 1),
(15, '炎环卫浴', '', '', '', '', '', '', '', '', NULL, 1),
(16, '杨茂卫浴', '', '', '', '', '', '', '', '', NULL, 1),
(17, '郑旭枝', '', '', '', '', '', '', '', '', NULL, 1),
(18, '秦月', '', '', '', '', '', '', '', '', NULL, 1),
(19, '陈带刚', '', '', '', '', '', '', '', '', NULL, 1),
(20, '法罗思', '', '', '', '', '', '', '', '', NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `purchase_detail_tbl`
--

CREATE TABLE `purchase_detail_tbl` (
  `purchase_detail_id` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `product` varchar(32) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `purchase_detail_tbl`
--

INSERT INTO `purchase_detail_tbl` (`purchase_detail_id`, `purchase`, `product`, `amount`) VALUES
(2, 2, '3', 4),
(3, 2, '4', 1),
(4, 3, '80', 5),
(5, 3, '81', 1),
(6, 3, '89', 1),
(7, 4, '10', 5),
(8, 4, '13', 5),
(9, 5, '2', 2),
(10, 5, '21', 1),
(11, 5, '22', 1),
(12, 5, '57', 1),
(13, 6, '10', 1),
(14, 6, '11', 3),
(15, 7, '12', 6),
(16, 7, '14', 6);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `purchase_detail_view`
--
CREATE TABLE `purchase_detail_view` (
`purchase_detail_id` int(11)
,`purchase` int(11)
,`product` varchar(32)
,`amount` int(11)
,`product_name` varchar(40)
,`product_sn` varchar(32)
,`price` decimal(8,2)
,`unit` varchar(3)
,`provider` int(11)
);

-- --------------------------------------------------------

--
-- 表的结构 `purchase_tbl`
--

CREATE TABLE `purchase_tbl` (
  `purchase_id` int(11) NOT NULL,
  `provider` int(11) DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_time_unix` int(11) NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `purchase_tbl`
--

INSERT INTO `purchase_tbl` (`purchase_id`, `provider`, `total_price`, `create_time`, `create_time_unix`, `creator`) VALUES
(2, NULL, '0.00', '2018-01-23 16:00:00', 1516348842, -1),
(3, NULL, '0.00', '2018-01-21 00:46:26', 1516495586, -1),
(4, NULL, '0.00', '2017-12-31 16:00:00', 1516495989, -1),
(5, NULL, '0.00', '2018-01-02 16:00:00', 1514908800, -1),
(6, NULL, '0.00', '2017-12-31 16:00:00', 1514736000, -1),
(7, NULL, '0.00', '2018-01-02 16:00:00', 1514908800, -1);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `purchase_view`
--
CREATE TABLE `purchase_view` (
`purchase_id` int(11)
,`provider` int(11)
,`total_price` decimal(8,2)
,`create_time` timestamp
,`create_time_unix` int(11)
,`creator` int(11)
,`unit` varchar(30)
,`operator_name` varchar(20)
);

-- --------------------------------------------------------

--
-- 表的结构 `stock_detail_tbl`
--

CREATE TABLE `stock_detail_tbl` (
  `stock_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `purchase` int(11) NOT NULL DEFAULT '0',
  `product` varchar(32) NOT NULL,
  `amount` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time_unix` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `stock_detail_tbl`
--

INSERT INTO `stock_detail_tbl` (`stock_id`, `order_id`, `purchase`, `product`, `amount`, `create_time`, `create_time_unix`) VALUES
(9, 4, 0, '11', -3, '2018-01-19 06:51:15', 1516344675),
(10, 4, 0, '72', -1, '2018-01-19 06:51:16', 1516344676),
(11, 4, 0, '84', -1, '2018-01-19 06:51:16', 1516344676),
(12, 4, 0, '101', -1, '2018-01-19 06:51:17', 1516344677),
(13, 5, 0, '8', -1, '2018-01-19 07:02:05', 1516345325),
(14, 5, 0, '9', -1, '2018-01-19 07:02:05', 1516345325),
(15, 4, 0, '110', -1, '2018-01-19 07:05:16', 1516345516),
(16, 4, 0, '123', -1, '2018-01-19 07:05:16', 1516345516),
(17, 4, 0, '124', -1, '2018-01-19 07:05:17', 1516345517),
(18, 0, 2, '3', 4, '2018-01-19 08:00:42', 1516348842),
(19, 0, 2, '4', 1, '2018-01-19 08:00:42', 1516348842),
(20, 0, 3, '80', 5, '2018-01-21 00:46:26', 1516495586),
(21, 0, 3, '81', 1, '2018-01-21 00:46:26', 1516495586),
(22, 0, 3, '89', 1, '2018-01-21 00:46:26', 1516495586),
(23, 0, 4, '10', 5, '2018-01-21 00:53:09', 1516495989),
(24, 0, 4, '13', 5, '2018-01-21 00:53:09', 1516495989),
(25, 0, 5, '2', 2, '2018-01-21 01:01:20', 1514908800),
(26, 0, 5, '21', 1, '2018-01-21 01:01:20', 1514908800),
(27, 0, 5, '22', 1, '2018-01-21 01:01:20', 1514908800),
(28, 0, 5, '57', 1, '2018-01-21 01:01:20', 1514908800),
(29, 0, 6, '10', 1, '2018-01-21 01:02:18', 1514736000),
(30, 0, 6, '11', 3, '2018-01-21 01:02:18', 1514736000),
(31, 0, 7, '12', 6, '2018-01-21 01:04:33', 1514908800),
(32, 0, 7, '14', 6, '2018-01-21 01:04:33', 1514908800),
(33, 6, 0, '6', -1, '2018-01-21 02:19:13', 1516501153),
(34, 6, 0, '7', -1, '2018-01-21 02:19:14', 1516501154);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `stock_detail_view`
--
CREATE TABLE `stock_detail_view` (
`stock_id` int(11)
,`order_id` int(11)
,`purchase` int(11)
,`product` varchar(32)
,`amount` int(11)
,`create_time` timestamp
,`create_time_unix` int(11)
,`product_name` varchar(40)
,`sn` varchar(32)
,`unit` varchar(3)
);

-- --------------------------------------------------------

--
-- 表的结构 `sub_menu_tbl`
--

CREATE TABLE `sub_menu_tbl` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '-1',
  `key_word` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sub_menu_tbl`
--

INSERT INTO `sub_menu_tbl` (`id`, `parent_id`, `key_word`, `name`) VALUES
(7, 108, 'operator', '管理员'),
(8, 108, 'options', '控制选项'),
(9, 109, 'provider_edit', '添加供应商'),
(10, 109, 'provider_list', '供应商列表'),
(11, 110, 'category_edit', '分类编辑'),
(12, 110, 'product_edit', '添加产品'),
(13, 110, 'product_list', '产品列表'),
(14, 111, 'purchase_add', '入库操作'),
(15, 111, 'purchase_list', '入库历史'),
(16, 111, 'purchase_detail', '入库详情'),
(17, 113, 'order_add', '销售录入'),
(18, 112, 'customer_list', '客户列表'),
(19, 112, 'customer_edit', '新建客户'),
(20, 113, 'order_detail', '销售详情'),
(21, 113, 'order_list', '销售列表'),
(22, 111, 'stock_detail', '库存明细'),
(23, 114, 'caigou_edit', '采购录入'),
(24, 114, 'caigou_list', '采购历史'),
(25, 114, 'caigou_detail', '采购单详情'),
(26, 111, 'stock_out_add', '出库操作'),
(27, 111, 'stock_out_list', '出库记录');

-- --------------------------------------------------------

--
-- 替换视图以便查看 `sub_menu_view`
--
CREATE TABLE `sub_menu_view` (
`f_id` int(11)
,`f_key` varchar(20)
,`f_name` varchar(20)
,`s_id` int(11)
,`s_key` varchar(30)
,`s_name` varchar(30)
);

-- --------------------------------------------------------

--
-- 视图结构 `caigou_detail_view`
--
DROP TABLE IF EXISTS `caigou_detail_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `caigou_detail_view`  AS  select `a`.`caigou_detail_id` AS `caigou_detail_id`,`a`.`caigou` AS `caigou`,`a`.`product` AS `product`,`a`.`price` AS `price`,`a`.`amount` AS `amount`,`a`.`type` AS `type`,`b`.`sn` AS `sn`,`b`.`img` AS `img`,`b`.`name` AS `name`,`b`.`unit` AS `unit` from (`caigou_detail_tbl` `a` left join `product_tbl` `b` on((`a`.`product` = `b`.`product_id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `caigou_view`
--
DROP TABLE IF EXISTS `caigou_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `caigou_view`  AS  select `a`.`caigou_id` AS `caigou_id`,`a`.`provider` AS `provider`,`a`.`total_fee` AS `total_fee`,`a`.`create_time` AS `create_time`,`a`.`delivery_time` AS `delivery_time`,`a`.`remark` AS `remark`,`b`.`unit` AS `provider_name`,`b`.`address` AS `address`,`b`.`contact` AS `contact`,`b`.`tel` AS `tel` from (`caigou_tbl` `a` left join `provider_tbl` `b` on((`a`.`provider` = `b`.`provider_id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `op_pms_view`
--
DROP TABLE IF EXISTS `op_pms_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `op_pms_view`  AS  select `a`.`pms_id` AS `pms_id`,`b`.`id` AS `id`,`b`.`name` AS `name`,`b`.`pwd` AS `pwd`,`b`.`create_time` AS `create_time`,`b`.`creator` AS `creator`,`b`.`md5` AS `md5` from (`operator_tbl` `b` left join `op_pms_tbl` `a` on((`a`.`o_id` = `b`.`id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `order_detail_view`
--
DROP TABLE IF EXISTS `order_detail_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_detail_view`  AS  select `a`.`order_detail_id` AS `order_detail_id`,`a`.`order_id` AS `order_id`,`a`.`product` AS `product`,`a`.`amount` AS `amount`,`b`.`name` AS `product_name`,`b`.`sn` AS `product_sn`,`b`.`default_price` AS `price`,`b`.`unit` AS `unit`,`a`.`status` AS `status` from (`order_detail_tbl` `a` left join `product_tbl` `b` on((`a`.`product` = `b`.`product_id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `order_view`
--
DROP TABLE IF EXISTS `order_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view`  AS  select `a`.`order_id` AS `order_id`,`a`.`customer` AS `customer`,`a`.`custom_info` AS `custom_info`,`a`.`total_fee` AS `total_fee`,`a`.`discount` AS `discount`,`a`.`create_time` AS `create_time`,`a`.`delivery_time` AS `delivery_time`,`a`.`create_time_unix` AS `create_time_unix`,`a`.`creator` AS `creator`,`a`.`remark` AS `remark`,`b`.`customer_id` AS `customer_id`,`b`.`customer_name` AS `customer_name`,`b`.`customer_tel` AS `customer_tel`,`b`.`customer_address` AS `customer_address`,`c`.`name` AS `operator`,`c`.`nick_name` AS `operator_nickname`,`a`.`delivery_status` AS `delivery_status` from ((`order_tbl` `a` left join `customer_tbl` `b` on((`a`.`customer` = `b`.`customer_id`))) left join `operator_tbl` `c` on((`a`.`creator` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `pms_view`
--
DROP TABLE IF EXISTS `pms_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pms_view`  AS  select `f`.`id` AS `f_id`,`f`.`key_word` AS `f_key`,`f`.`name` AS `f_name`,`s`.`id` AS `s_id`,`s`.`key_word` AS `s_key`,`s`.`name` AS `s_name` from (`pms_tbl` `f` left join `sub_menu_tbl` `s` on((`s`.`parent_id` = `f`.`id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `product_provider_view`
--
DROP TABLE IF EXISTS `product_provider_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_provider_view`  AS  select `a`.`product_id` AS `product_id`,`a`.`provider` AS `provider`,`a`.`category` AS `category`,`a`.`name` AS `name`,`a`.`sn` AS `sn`,`a`.`brand` AS `brand`,`a`.`img` AS `img`,`a`.`description` AS `description`,`a`.`default_price` AS `default_price`,`a`.`purchase_price` AS `purchase_price`,`a`.`unit` AS `unit`,`a`.`stock` AS `stock`,`b`.`unit` AS `provider_name`,`b`.`address` AS `address`,`b`.`contact` AS `contact`,`b`.`tel` AS `tel`,`b`.`fax` AS `fax` from (`product_tbl` `a` left join `provider_tbl` `b` on((`a`.`provider` = `b`.`provider_id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `purchase_detail_view`
--
DROP TABLE IF EXISTS `purchase_detail_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_detail_view`  AS  select `a`.`purchase_detail_id` AS `purchase_detail_id`,`a`.`purchase` AS `purchase`,`a`.`product` AS `product`,`a`.`amount` AS `amount`,`b`.`name` AS `product_name`,`b`.`sn` AS `product_sn`,`b`.`default_price` AS `price`,`b`.`unit` AS `unit`,`b`.`provider` AS `provider` from (`purchase_detail_tbl` `a` left join `product_tbl` `b` on((`a`.`product` = `b`.`product_id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `purchase_view`
--
DROP TABLE IF EXISTS `purchase_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_view`  AS  select `a`.`purchase_id` AS `purchase_id`,`a`.`provider` AS `provider`,`a`.`total_price` AS `total_price`,`a`.`create_time` AS `create_time`,`a`.`create_time_unix` AS `create_time_unix`,`a`.`creator` AS `creator`,`b`.`unit` AS `unit`,`c`.`name` AS `operator_name` from ((`purchase_tbl` `a` left join `provider_tbl` `b` on((`a`.`provider` = `b`.`provider_id`))) left join `operator_tbl` `c` on((`a`.`creator` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `stock_detail_view`
--
DROP TABLE IF EXISTS `stock_detail_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock_detail_view`  AS  select `a`.`stock_id` AS `stock_id`,`a`.`order_id` AS `order_id`,`a`.`purchase` AS `purchase`,`a`.`product` AS `product`,`a`.`amount` AS `amount`,`a`.`create_time` AS `create_time`,`a`.`create_time_unix` AS `create_time_unix`,`b`.`name` AS `product_name`,`b`.`sn` AS `sn`,`b`.`unit` AS `unit` from (`stock_detail_tbl` `a` left join `product_tbl` `b` on((`a`.`product` = `b`.`product_id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `sub_menu_view`
--
DROP TABLE IF EXISTS `sub_menu_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sub_menu_view`  AS  select `f`.`id` AS `f_id`,`f`.`key_word` AS `f_key`,`f`.`name` AS `f_name`,`s`.`id` AS `s_id`,`s`.`key_word` AS `s_key`,`s`.`name` AS `s_name` from (`sub_menu_tbl` `s` left join `pms_tbl` `f` on((`s`.`parent_id` = `f`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caigou_detail_tbl`
--
ALTER TABLE `caigou_detail_tbl`
  ADD PRIMARY KEY (`caigou_detail_id`);

--
-- Indexes for table `caigou_tbl`
--
ALTER TABLE `caigou_tbl`
  ADD PRIMARY KEY (`caigou_id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`,`p_category`);

--
-- Indexes for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `operator_tbl`
--
ALTER TABLE `operator_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `op_pms_tbl`
--
ALTER TABLE `op_pms_tbl`
  ADD PRIMARY KEY (`o_id`,`pms_id`);

--
-- Indexes for table `order_detail_tbl`
--
ALTER TABLE `order_detail_tbl`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pms_tbl`
--
ALTER TABLE `pms_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sn` (`sn`);

--
-- Indexes for table `provider_tbl`
--
ALTER TABLE `provider_tbl`
  ADD PRIMARY KEY (`provider_id`);

--
-- Indexes for table `purchase_detail_tbl`
--
ALTER TABLE `purchase_detail_tbl`
  ADD PRIMARY KEY (`purchase_detail_id`);

--
-- Indexes for table `purchase_tbl`
--
ALTER TABLE `purchase_tbl`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `stock_detail_tbl`
--
ALTER TABLE `stock_detail_tbl`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `sub_menu_tbl`
--
ALTER TABLE `sub_menu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `caigou_detail_tbl`
--
ALTER TABLE `caigou_detail_tbl`
  MODIFY `caigou_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `caigou_tbl`
--
ALTER TABLE `caigou_tbl`
  MODIFY `caigou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- 使用表AUTO_INCREMENT `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `operator_tbl`
--
ALTER TABLE `operator_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `order_detail_tbl`
--
ALTER TABLE `order_detail_tbl`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `pms_tbl`
--
ALTER TABLE `pms_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- 使用表AUTO_INCREMENT `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- 使用表AUTO_INCREMENT `provider_tbl`
--
ALTER TABLE `provider_tbl`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `purchase_detail_tbl`
--
ALTER TABLE `purchase_detail_tbl`
  MODIFY `purchase_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `purchase_tbl`
--
ALTER TABLE `purchase_tbl`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `stock_detail_tbl`
--
ALTER TABLE `stock_detail_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- 使用表AUTO_INCREMENT `sub_menu_tbl`
--
ALTER TABLE `sub_menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
