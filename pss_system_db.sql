-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-02 08:57:00
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
(1, 1, 6, 788, 1, ''),
(2, 1, 7, 566, 2, ''),
(3, 2, 8, 350, 1, ''),
(4, 2, 9, 120, 1, ''),
(5, 3, 10, 21, 1, ''),
(6, 4, 8, 350, 1, ''),
(7, 4, 9, 120, 1, ''),
(8, 5, 11, 211, 1, '');

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
(1, 3, '1920.00', NULL, NULL, NULL),
(2, 1, '470.00', NULL, NULL, NULL),
(3, 2, '21.00', NULL, NULL, NULL),
(4, 1, '470.00', '2017-12-30 09:20:31', '2017-12-04 00:00:00', '哈哈哈哈哈'),
(5, 2, '211.00', '2017-12-30 09:20:31', '2017-12-04 00:00:00', '哈哈哈哈哈');

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
(1, '王大锤', '13566603839', '测试地址abc大的'),
(2, '孔连顺', '14544565532', '孔连顺的联系地址');

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
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `order_detail_tbl`
--

INSERT INTO `order_detail_tbl` (`order_detail_id`, `order_id`, `product`, `amount`) VALUES
(1, 1, 6, 1),
(2, 1, 7, 1),
(3, 2, 6, 1),
(4, 2, 7, 1),
(5, 3, 10, 1),
(6, 3, 11, 1);

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
  `delivery_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `customer`, `custom_info`, `total_fee`, `discount`, `create_time`, `create_time_unix`, `creator`, `remark`, `delivery_time`) VALUES
(1, 2, NULL, '3120.00', '0.00', '2017-12-30 09:04:34', 1514624674, -1, '', '0000-00-00 00:00:00'),
(2, 2, NULL, '3120.00', '0.00', '2017-12-30 09:04:54', 1514624694, -1, '', '0000-00-00 00:00:00'),
(3, 1, NULL, '835.00', '0.00', '2017-12-30 09:06:07', 1514624767, -1, '要 加大号', '2018-01-15 00:00:00');

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
(6, 3, 1, '淋浴高杆', 'CNA2950', 0, '', 'sdfs', '1360.00', '788.00', '套', 6),
(7, 3, 1, '淋浴高杆', 'CNA31230', 0, '', '', '1760.00', '566.00', '套', 5),
(8, 1, 26, '测试艺术盆', 'ys2232', 0, '../files/0786f2d280ecb54cd0f0185be2d070c9.jpg', '', '700.00', '350.00', '个', 0),
(9, 1, 26, '测试艺术盆2', 'ysp22121', 0, '', '', '500.00', '120.00', '个', 0),
(10, 2, 25, '拖把池a', 'tbc1221', 0, '', '', '300.00', '21.00', '个', -1),
(11, 2, 25, '拖把池b', 'tbc4343', 0, '', '', '550.00', '211.00', '个', -1),
(12, 2, 23, '洗菜盆a', 'xcp23211', 0, '', '', '345.00', '0.00', '个', 0);

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
(1, '测试供应商', 'XX路OO号', '王大锤', '12345544', '121233', '2341', '232134sdf', '', '', 0, 1),
(2, '测试供应商2', '供应商地址', '测试', '233322332323', '', '', '', '', '', NULL, 1),
(3, '供应商3', '啊手动阀手动阀', 'abc', '123232323', '', '', '', '', '', NULL, 1);

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
  `provider` int(11) NOT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_time_unix` int(11) NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 1, 0, '6', -1, '2017-12-30 09:04:34', 1514624674),
(2, 1, 0, '7', -1, '2017-12-30 09:04:34', 1514624674),
(3, 2, 0, '6', -1, '2017-12-30 09:04:54', 1514624694),
(4, 2, 0, '7', -1, '2017-12-30 09:04:54', 1514624694),
(5, 3, 0, '10', -1, '2017-12-30 09:06:07', 1514624767),
(6, 3, 0, '11', -1, '2017-12-30 09:06:07', 1514624767);

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
,`sn` varchar(32)
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
(25, 114, 'caigou_detail', '采购单详情');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_detail_view`  AS  select `a`.`order_detail_id` AS `order_detail_id`,`a`.`order_id` AS `order_id`,`a`.`product` AS `product`,`a`.`amount` AS `amount`,`b`.`name` AS `product_name`,`b`.`sn` AS `product_sn`,`b`.`default_price` AS `price`,`b`.`unit` AS `unit` from (`order_detail_tbl` `a` left join `product_tbl` `b` on((`a`.`product` = `b`.`product_id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `order_view`
--
DROP TABLE IF EXISTS `order_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view`  AS  select `a`.`order_id` AS `order_id`,`a`.`customer` AS `customer`,`a`.`custom_info` AS `custom_info`,`a`.`total_fee` AS `total_fee`,`a`.`discount` AS `discount`,`a`.`create_time` AS `create_time`,`a`.`delivery_time` AS `delivery_time`,`a`.`create_time_unix` AS `create_time_unix`,`a`.`creator` AS `creator`,`a`.`remark` AS `remark`,`b`.`customer_id` AS `customer_id`,`b`.`customer_name` AS `customer_name`,`b`.`customer_tel` AS `customer_tel`,`b`.`customer_address` AS `customer_address`,`c`.`name` AS `operator`,`c`.`nick_name` AS `operator_nickname` from ((`order_tbl` `a` left join `customer_tbl` `b` on((`a`.`customer` = `b`.`customer_id`))) left join `operator_tbl` `c` on((`a`.`creator` = `c`.`id`))) ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock_detail_view`  AS  select `a`.`stock_id` AS `stock_id`,`a`.`order_id` AS `order_id`,`a`.`purchase` AS `purchase`,`a`.`product` AS `product`,`a`.`amount` AS `amount`,`a`.`create_time` AS `create_time`,`a`.`create_time_unix` AS `create_time_unix`,`b`.`sn` AS `sn` from (`stock_detail_tbl` `a` left join `product_tbl` `b` on((`a`.`product` = `b`.`product_id`))) ;

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
  MODIFY `caigou_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `caigou_tbl`
--
ALTER TABLE `caigou_tbl`
  MODIFY `caigou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `pms_tbl`
--
ALTER TABLE `pms_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- 使用表AUTO_INCREMENT `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `provider_tbl`
--
ALTER TABLE `provider_tbl`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `purchase_detail_tbl`
--
ALTER TABLE `purchase_detail_tbl`
  MODIFY `purchase_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `purchase_tbl`
--
ALTER TABLE `purchase_tbl`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `stock_detail_tbl`
--
ALTER TABLE `stock_detail_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `sub_menu_tbl`
--
ALTER TABLE `sub_menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
