/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost
 Source Database       : okaycar_dev

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : utf-8

 Date: 01/21/2019 00:44:23 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录名',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `auth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '具有的权限',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录凭证',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_user_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `advice`
-- ----------------------------
DROP TABLE IF EXISTS `advice`;
CREATE TABLE `advice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `content` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '建议内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advice_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `appearance`
-- ----------------------------
DROP TABLE IF EXISTS `appearance`;
CREATE TABLE `appearance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(10) unsigned DEFAULT NULL,
  `color` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `model_color_unique` (`model_id`,`color`),
  KEY `appearance_model_fk_idx` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24232 DEFAULT CHARSET=utf8mb4 COMMENT='car appearance';

-- ----------------------------
--  Table structure for `appearance_decoration`
-- ----------------------------
DROP TABLE IF EXISTS `appearance_decoration`;
CREATE TABLE `appearance_decoration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `model_id` int(11) NOT NULL DEFAULT '0' COMMENT '车型id',
  `appearance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外观',
  `decoration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '内饰',
  PRIMARY KEY (`id`),
  KEY `appearance_decoration_model_id_index` (`model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='车型内外饰描述表';

-- ----------------------------
--  Table structure for `brand_info`
-- ----------------------------
DROP TABLE IF EXISTS `brand_info`;
CREATE TABLE `brand_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '品牌名称',
  `logo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '品牌图标',
  `pinyin` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '品牌拼音',
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `flag_index` (`flag`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `china_area`
-- ----------------------------
DROP TABLE IF EXISTS `china_area`;
CREATE TABLE `china_area` (
  `id` mediumint(6) unsigned NOT NULL,
  `state` varchar(20) DEFAULT 'CN' COMMENT '国家简称|名称，默认：CN|中国',
  `area` varchar(20) DEFAULT NULL COMMENT '大中华区',
  `province` varchar(20) DEFAULT '' COMMENT '省',
  `city` varchar(20) DEFAULT '' COMMENT '市',
  `district` varchar(20) DEFAULT '' COMMENT '区',
  `sort` smallint(5) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地区表';

-- ----------------------------
--  Table structure for `decoration`
-- ----------------------------
DROP TABLE IF EXISTS `decoration`;
CREATE TABLE `decoration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(10) unsigned NOT NULL,
  `color` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `model_color_unique` (`model_id`,`color`),
  KEY `decoration_model_fk_idx` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9318 DEFAULT CHARSET=utf8mb4 COMMENT='car decoration';

-- ----------------------------
--  Table structure for `electronic_auth_err`
-- ----------------------------
DROP TABLE IF EXISTS `electronic_auth_err`;
CREATE TABLE `electronic_auth_err` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `auth_id` int(10) DEFAULT NULL COMMENT '授权Id',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '拒绝说明',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='电子公章授权失败记录表';

-- ----------------------------
--  Table structure for `electronic_seal`
-- ----------------------------
DROP TABLE IF EXISTS `electronic_seal`;
CREATE TABLE `electronic_seal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `en_crc32` int(11) DEFAULT NULL COMMENT '企业名称转crc32',
  `status` tinyint(1) DEFAULT '1' COMMENT '电子公章注册状态,1注册成功，2注册失败',
  `remark` varchar(120) NOT NULL COMMENT '注册失败原因',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '申请时间',
  `created_id` int(10) DEFAULT NULL COMMENT '申请人Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='电子公章表';

-- ----------------------------
--  Table structure for `electronic_seal_auth`
-- ----------------------------
DROP TABLE IF EXISTS `electronic_seal_auth`;
CREATE TABLE `electronic_seal_auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态,1申请提交成功待审核，2审核通过，3审核未通过',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '拒绝说明',
  `created_id` int(10) DEFAULT NULL COMMENT '创建人id（申请人id）',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_id` int(10) DEFAULT NULL COMMENT '修改人Id',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='电子公章表授权申请记录表';

-- ----------------------------
--  Table structure for `enterprise_authentication`
-- ----------------------------
DROP TABLE IF EXISTS `enterprise_authentication`;
CREATE TABLE `enterprise_authentication` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `enterprise_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '企业名称',
  `enterprise_type` int(11) NOT NULL DEFAULT '0' COMMENT '企业类型',
  `legal_person_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '法人名字',
  `area` int(11) NOT NULL DEFAULT '0' COMMENT '所在城市',
  `pic1` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片1',
  `pic2` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片2',
  `pic3` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片3',
  `pic4` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片4',
  `pic5` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片5',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '失败原因',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enterprise_authentication_status_created_at_index` (`status`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `enterprise_temp`
-- ----------------------------
DROP TABLE IF EXISTS `enterprise_temp`;
CREATE TABLE `enterprise_temp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `area_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7427 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `lime_china_area`
-- ----------------------------
DROP TABLE IF EXISTS `lime_china_area`;
CREATE TABLE `lime_china_area` (
  `id` mediumint(6) unsigned NOT NULL,
  `state` varchar(20) DEFAULT 'CN' COMMENT '国家简称|名称，默认：CN|中国',
  `area` varchar(20) DEFAULT NULL COMMENT '大中华区',
  `province` varchar(20) DEFAULT '' COMMENT '省',
  `city` varchar(20) DEFAULT '' COMMENT '市',
  `district` varchar(20) DEFAULT '' COMMENT '区',
  `sort` smallint(5) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地区表';

-- ----------------------------
--  Table structure for `manufacture_info`
-- ----------------------------
DROP TABLE IF EXISTS `manufacture_info`;
CREATE TABLE `manufacture_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `brand_id` int(10) unsigned DEFAULT NULL,
  `priority` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `brand_id_key_idx` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `model_info`
-- ----------------------------
DROP TABLE IF EXISTS `model_info`;
CREATE TABLE `model_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `brand_id` int(11) NOT NULL DEFAULT '0' COMMENT '品牌id',
  `series_id` int(10) unsigned DEFAULT NULL,
  `series` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '车系名称',
  `model` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '车型详细名称',
  `produce_year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '生产年限',
  `guide_price` int(11) NOT NULL DEFAULT '0' COMMENT '指导价',
  `manufactures` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '生产厂家',
  `rule` int(11) NOT NULL DEFAULT '0' COMMENT '规格',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manufacture_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29986 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `okcar_store_house`
-- ----------------------------
DROP TABLE IF EXISTS `okcar_store_house`;
CREATE TABLE `okcar_store_house` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `area_id` int(10) DEFAULT NULL COMMENT '仓库所属地区id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '仓库名称',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '软删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='平台仓库表';

-- ----------------------------
--  Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `buyer_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `seller_id` int(11) unsigned DEFAULT NULL COMMENT '卖家id',
  `publish_id` int(11) NOT NULL DEFAULT '0' COMMENT '发布id',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `address` int(11) NOT NULL DEFAULT '0' COMMENT '编号',
  `pay_mode_id` int(11) NOT NULL DEFAULT '0' COMMENT '金融方案',
  `ratio` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '垫资比例',
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` int(11) unsigned DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `order_address`
-- ----------------------------
DROP TABLE IF EXISTS `order_address`;
CREATE TABLE `order_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `order_id` int(10) DEFAULT NULL COMMENT '订单Id',
  `province` varchar(15) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(15) NOT NULL DEFAULT '' COMMENT '市',
  `area` varchar(15) NOT NULL DEFAULT '' COMMENT '地区',
  `type` varchar(10) NOT NULL DEFAULT '0' COMMENT '仓库类型，集中仓，经销商仓',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '仓库名称',
  `address` varchar(150) NOT NULL DEFAULT '' COMMENT '详细地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单收货地址表';

-- ----------------------------
--  Table structure for `order_info`
-- ----------------------------
DROP TABLE IF EXISTS `order_info`;
CREATE TABLE `order_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单id',
  `type` varchar(10) NOT NULL DEFAULT '' COMMENT '发布者类型，自发布，爬虫',
  `enterprise_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '公司名称',
  `custom_model` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '自定义车型',
  `appearance` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外观',
  `decoration` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '内饰',
  `stock` char(1) NOT NULL DEFAULT '0' COMMENT '是否现车',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `sale_price` int(11) NOT NULL DEFAULT '0' COMMENT '销售价',
  `source` int(11) NOT NULL DEFAULT '0' COMMENT '区域',
  `sale_area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '可售区域',
  `formalities` int(11) NOT NULL DEFAULT '0' COMMENT '手续情况',
  `ticket_type` int(11) NOT NULL DEFAULT '0' COMMENT '票据来源',
  `comment` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `pics` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片',
  `brand_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '品牌名称',
  `brand_pinyin` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '品牌拼音',
  `series_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '车系名称',
  `model` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '车型详细名称',
  `produce_year` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '生产年限',
  `guide_price` int(11) NOT NULL DEFAULT '0' COMMENT '指导价',
  `manufactures` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '生产厂家',
  `rule` int(11) NOT NULL DEFAULT '0' COMMENT '规格',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `public_info_type_index` (`type`),
  KEY `public_info_enterprise_name_index` (`enterprise_name`),
  KEY `public_info_custom_model_index` (`custom_model`(191)),
  KEY `public_info_appearance_index` (`appearance`),
  KEY `public_info_decoration_index` (`decoration`),
  KEY `public_info_sale_area_index` (`sale_area`(191)),
  KEY `public_info_formalities_index` (`formalities`),
  KEY `public_info_ticket_type_index` (`ticket_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单详情表';

-- ----------------------------
--  Table structure for `order_option_record`
-- ----------------------------
DROP TABLE IF EXISTS `order_option_record`;
CREATE TABLE `order_option_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(10) DEFAULT NULL COMMENT '操作人Id',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '操作说明',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单操作记录表';

-- ----------------------------
--  Table structure for `order_record`
-- ----------------------------
DROP TABLE IF EXISTS `order_record`;
CREATE TABLE `order_record` (
  `field1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `pay_mode`
-- ----------------------------
DROP TABLE IF EXISTS `pay_mode`;
CREATE TABLE `pay_mode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mode` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='支付方式';

-- ----------------------------
--  Table structure for `public_info`
-- ----------------------------
DROP TABLE IF EXISTS `public_info`;
CREATE TABLE `public_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '发布用户id',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '发布者类型，0:自发布，1:爬虫',
  `enterprise_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '公司名称',
  `model_info_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '车型id',
  `custom_model` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '自定义车型',
  `appearance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外观',
  `decoration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '内饰',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '是否现车',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `sale_price` int(11) NOT NULL DEFAULT '0' COMMENT '销售价',
  `source` int(11) NOT NULL DEFAULT '0' COMMENT '区域',
  `sale_area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '可售区域',
  `formalities` int(11) NOT NULL DEFAULT '0' COMMENT '手续情况',
  `ticket_type` int(11) NOT NULL DEFAULT '0' COMMENT '票据来源',
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `pics` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `access_count` int(11) NOT NULL DEFAULT '0' COMMENT '访问次数',
  `expire` datetime NOT NULL DEFAULT '0000-01-01 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `public_info_model_info_id_index` (`model_info_id`),
  KEY `public_info_user_id_index` (`user_id`),
  KEY `public_info_type_index` (`type`),
  KEY `public_info_enterprise_name_index` (`enterprise_name`),
  KEY `public_info_custom_model_index` (`custom_model`(191)),
  KEY `public_info_appearance_index` (`appearance`),
  KEY `public_info_decoration_index` (`decoration`),
  KEY `public_info_sale_area_index` (`sale_area`(191)),
  KEY `public_info_formalities_index` (`formalities`),
  KEY `public_info_ticket_type_index` (`ticket_type`)
) ENGINE=InnoDB AUTO_INCREMENT=187381 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `question`
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `weight` int(11) NOT NULL COMMENT '排序权重',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `realname_authentication`
-- ----------------------------
DROP TABLE IF EXISTS `realname_authentication`;
CREATE TABLE `realname_authentication` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `idcard_front_pic` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份证正面照片',
  `idcard_back_pic` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份证背面照片',
  `card_pic` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名片照片',
  `idcard_num` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份证号码',
  `realname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '失败原因',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `realname_authentication_status_created_at_index` (`status`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `series_info`
-- ----------------------------
DROP TABLE IF EXISTS `series_info`;
CREATE TABLE `series_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '车系名称',
  `brand_id` int(11) unsigned NOT NULL,
  `manufacture` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `priority` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_idx` (`name`),
  KEY `brand_id_fk_idx` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3762 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `store_house`
-- ----------------------------
DROP TABLE IF EXISTS `store_house`;
CREATE TABLE `store_house` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `province_code` int(10) DEFAULT NULL COMMENT '地区省编码',
  `city_code` int(10) DEFAULT NULL COMMENT '城市编码',
  `area_code` int(10) DEFAULT NULL COMMENT '地区编码',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '仓库类型，0集中仓，1经销商仓',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '仓库名称',
  `address` varchar(150) NOT NULL DEFAULT '' COMMENT '详细地址',
  `default_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为默认仓库，0否，1是',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `created_id` int(10) DEFAULT NULL COMMENT '创建人Id（买家用户id）',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  `updated_id` int(10) DEFAULT NULL COMMENT '修改人Id',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '软删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仓库表';

-- ----------------------------
--  Table structure for `update_order`
-- ----------------------------
DROP TABLE IF EXISTS `update_order`;
CREATE TABLE `update_order` (
  `field1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `head_img` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `sale_brand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '销售品牌',
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '公司名称',
  `area` int(11) NOT NULL DEFAULT '0' COMMENT '地区',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录凭证',
  `selfdesc` varchar(1024) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '简介',
  `huanxin_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `huanxin_password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `user_favour`
-- ----------------------------
DROP TABLE IF EXISTS `user_favour`;
CREATE TABLE `user_favour` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `publish_id` int(11) NOT NULL DEFAULT '0' COMMENT '发布车源id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_favour_user_id_publish_id_unique` (`user_id`,`publish_id`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
