/**
 * 订单操作记录表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_option_record`;
create table `order_option_record`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned default null COMMENT '操作人Id',
`user_id` int(11) unsigned default null COMMENT '操作人Id',
`step` tinyint(3)  default null COMMENT '操作步骤',
`remark` varchar(150) not null default '' COMMENT '操作说明',
`created_at` timestamp DEFAULT NULL COMMENT '创建时间',
`seller_flag` tinyint(3) DEFAULT NULL '下一步骤是否为卖家操作，存在则为是，且与操作步骤相关',
`buy_flag` tinyint(3) DEFAULT NULL '下一步骤是否为买家操作，存在则为是，且与操作步骤相关'
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='订单操作记录表';