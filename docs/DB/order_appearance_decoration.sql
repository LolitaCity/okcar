/**
 * 订单外观内饰记录表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_appearance_decoration`;
create table `order_appearance_decoration`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned DEFAULT  NULL COMMENT '订单id',
`appearance_decoration` varchar(150) NOT NULL DEFAULT  '' COMMENT '外观内饰',
`unit_price` float(10,2) DEFAULT NULL COMMENT '单价',
`num` int(11) unsigned NOT NULL DEFAULT 1 COMMENT '数量',
`total_price` float(10,2) DEFAULT NULL COMMENT '总价',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='订单外观内饰记录表';