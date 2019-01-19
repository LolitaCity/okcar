/**
 * 订单操作记录表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_option_record`;
create table `order_option_record`(
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`user_id` int(10) default null COMMENT '操作人Id',
`remark` varchar(150) not null default '' COMMENT '操作说明',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='订单操作记录表';