/**
 * 物流信息表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-21
 */
DROP TABLE IF EXISTS `order_logistics`;
create table `order_logistics`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned DEFAULT NULL COMMENT '订单Id',
`logistics_name` varchar(50) NOT NULL DEFAULT '' COMMENT '物流公司名称',
`logistics_num` varchar(50) NOT NULL DEFAULT '' COMMENT '物流单号',
`logistics_price` float(10,3) NOT NULL DEFAULT '0' COMMENT '物流费用',
`logistics_statr` varchar(20) NOT NULL DEFAULT '' COMMENT '物流始发地',
`logistics_end` varchar(20) NOT NULL DEFAULT '' COMMENT '物流终止地',
`status` tinyint(1) DEFAULT NULL COMMENT '物流状态',
`created_at` timestamp NULL DEFAULT NULL COMMENT '物流开始时间',
`end_at` timestamp NULL DEFAULT NULL COMMENT '物流结束时间',
`deleted_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='物流信息表';
