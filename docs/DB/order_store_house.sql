/**
 * 订单收货地址表 
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-21
 */
DROP TABLE IF EXISTS `order_store_house`;
create table `order_store_house`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned DEFAULT NULL COMMENT '订单Id',
`area` varchar(15)  NOT NULL DEFAULT '' COMMENT '地区',
`type` varchar(10) NOT NULL DEFAULT '0' COMMENT '仓库类型，集中仓，经销商仓',
`name` varchar(50) NOT NULL DEFAULT '' COMMENT '仓库名称',
`address` varchar(150) NOT NULL DEFAULT '' COMMENT '详细地址',
`store_house_price` float(10,3)  DEFAULT '0' COMMENT '仓库使用费用',
`start_at` timestamp NULL DEFAULT NULL COMMENT '仓库开始使用时间',
`end_at` timestamp NULL DEFAULT NULL COMMENT '仓库结束使用时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='订单收货地址表';