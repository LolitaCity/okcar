/**
 * 订单收货地址表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_address`;
create table `order_address`(
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(10) default null COMMENT '订单Id',
`province` varchar(15) NOT NULL DEFAULT '' COMMENT '省',
`city` varchar(15)  NOT NULL DEFAULT '' COMMENT '市',
`area` varchar(15)  NOT NULL DEFAULT '' COMMENT '地区',
`type` varchar(10) NOT NULL DEFAULT '0' COMMENT '仓库类型，集中仓，经销商仓',
`name` varchar(50) NOT NULL DEFAULT '' COMMENT '仓库名称',
`address` varchar(150) NOT NULL DEFAULT '' COMMENT '详细地址',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='订单收货地址表';