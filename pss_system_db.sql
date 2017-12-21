-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-12-21 16:14:16
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
(13, '不带浴缸', 10),
(5, '卫生间用', 4),
(12, '带浴缸型', 10),
(11, '开关', 6),
(1, '淋浴房', 0),
(8, '淋浴房类型1', 1),
(9, '淋浴房类型2', 1),
(10, '淋浴房类型3', 1),
(6, '电工产品', 0),
(4, '集成吊顶', 0);

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
(1, '王大锤', '13566603839', '测试地址abc大的');

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
-- 表的结构 `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` int(11) NOT NULL,
  `custom` int(11) NOT NULL DEFAULT '0',
  `custom_info` varchar(60) DEFAULT NULL,
  `total_fee` decimal(8,2) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_time_unix` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(113, 'HgYTISEJXV', '销售管理', NULL);

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
-- 表的结构 `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `sn` varchar(32) NOT NULL,
  `brand` int(11) DEFAULT NULL,
  `description` varchar(60) NOT NULL,
  `default_price` decimal(8,2) DEFAULT NULL,
  `unit` varchar(3) NOT NULL DEFAULT '',
  `stock` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `category`, `name`, `sn`, `brand`, `description`, `default_price`, `unit`, `stock`) VALUES
(2, 13, '测试商品123', '123123321', 0, '这里是描述', '2345.00', '个', 2),
(3, 13, '新测试', '6534534', NULL, '啊手动阀手动阀', '12332.00', '个', 1);

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
(1, '测试供应商', 'XX路OO号', '王大锤', '12345544', '121233', '2341', '232134sdf', '', '', 0, 1);

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
(17, 11, '2', 2),
(18, 11, '3', 1);

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

--
-- 转存表中的数据 `purchase_tbl`
--

INSERT INTO `purchase_tbl` (`purchase_id`, `provider`, `total_price`, `create_time`, `create_time_unix`, `creator`) VALUES
(11, 1, '0.00', '2017-12-20 09:59:35', 1513763975, -1);

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
  `order` int(11) NOT NULL DEFAULT '0',
  `purchase` int(11) NOT NULL DEFAULT '0',
  `product` varchar(32) NOT NULL,
  `amount` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time_unix` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `stock_detail_tbl`
--

INSERT INTO `stock_detail_tbl` (`stock_id`, `order`, `purchase`, `product`, `amount`, `create_time`, `create_time_unix`) VALUES
(10, 0, 11, '2', 2, '2017-12-20 09:59:35', 1513763975),
(11, 0, 11, '3', 1, '2017-12-20 09:59:35', 1513763975);

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
(14, 111, 'purchase_add', '进货录入'),
(15, 111, 'purchase_list', '进货历史'),
(16, 111, 'purchase_detail', '进货详情'),
(17, 113, 'order_add', '销售录入'),
(18, 112, 'customer_list', '客户列表'),
(19, 112, 'customer_edit', '新建客户');

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
-- 视图结构 `op_pms_view`
--
DROP TABLE IF EXISTS `op_pms_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `op_pms_view`  AS  select `a`.`pms_id` AS `pms_id`,`b`.`id` AS `id`,`b`.`name` AS `name`,`b`.`pwd` AS `pwd`,`b`.`create_time` AS `create_time`,`b`.`creator` AS `creator`,`b`.`md5` AS `md5` from (`operator_tbl` `b` left join `op_pms_tbl` `a` on((`a`.`o_id` = `b`.`id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `pms_view`
--
DROP TABLE IF EXISTS `pms_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pms_view`  AS  select `f`.`id` AS `f_id`,`f`.`key_word` AS `f_key`,`f`.`name` AS `f_name`,`s`.`id` AS `s_id`,`s`.`key_word` AS `s_key`,`s`.`name` AS `s_name` from (`pms_tbl` `f` left join `sub_menu_tbl` `s` on((`s`.`parent_id` = `f`.`id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `purchase_detail_view`
--
DROP TABLE IF EXISTS `purchase_detail_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_detail_view`  AS  select `a`.`purchase_detail_id` AS `purchase_detail_id`,`a`.`purchase` AS `purchase`,`a`.`product` AS `product`,`a`.`amount` AS `amount`,`b`.`name` AS `product_name`,`b`.`sn` AS `product_sn` from (`purchase_detail_tbl` `a` left join `product_tbl` `b` on((`a`.`product` = `b`.`product_id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `purchase_view`
--
DROP TABLE IF EXISTS `purchase_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_view`  AS  select `a`.`purchase_id` AS `purchase_id`,`a`.`provider` AS `provider`,`a`.`total_price` AS `total_price`,`a`.`create_time` AS `create_time`,`a`.`create_time_unix` AS `create_time_unix`,`a`.`creator` AS `creator`,`b`.`unit` AS `unit`,`c`.`name` AS `operator_name` from ((`purchase_tbl` `a` left join `provider_tbl` `b` on((`a`.`provider` = `b`.`provider_id`))) left join `operator_tbl` `c` on((`a`.`creator` = `c`.`id`))) ;

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
-- 使用表AUTO_INCREMENT `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `operator_tbl`
--
ALTER TABLE `operator_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pms_tbl`
--
ALTER TABLE `pms_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- 使用表AUTO_INCREMENT `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `provider_tbl`
--
ALTER TABLE `provider_tbl`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `purchase_detail_tbl`
--
ALTER TABLE `purchase_detail_tbl`
  MODIFY `purchase_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `purchase_tbl`
--
ALTER TABLE `purchase_tbl`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `stock_detail_tbl`
--
ALTER TABLE `stock_detail_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `sub_menu_tbl`
--
ALTER TABLE `sub_menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;