/**
 * 订单详情表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_info`;
CREATE TABLE `order_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单id',
  `type` varchar(10) NOT NULL DEFAULT '' COMMENT '发布者类型，自发布，爬虫',
  `enterprise_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '公司名称',  
  `custom_model` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '自定义车型',
  `appearance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外观',
  `decoration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '内饰',
  `stock` char(1) NOT NULL DEFAULT '0' COMMENT '是否现车',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `sale_price` int(11) NOT NULL DEFAULT '0' COMMENT '销售价',
  `source` int(11) NOT NULL DEFAULT '0' COMMENT '区域',
  `sale_area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '可售区域',
  `formalities` int(11) NOT NULL DEFAULT '0' COMMENT '手续情况',
  `ticket_type` int(11) NOT NULL DEFAULT '0' COMMENT '票据来源',
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `pics` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片',
  `brand_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '品牌名称',
  `brand_pinyin` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '品牌拼音',
  `series_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '车系名称',
  `model` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '车型详细名称',
  `produce_year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '生产年限',
  `guide_price` int(11) NOT NULL DEFAULT '0' COMMENT '指导价',
  `manufactures` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '生产厂家',
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