/**
 * 订单验车地址表 
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_check_address`;
create table `order_check_address`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(10) DEFAULT NULL COMMENT '订单Id',
`check_area` varchar(15)  NOT NULL DEFAULT '' COMMENT '地区',
`check_address` varchar(150) NOT NULL DEFAULT '' COMMENT '详细地址',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='订单验车地址表';