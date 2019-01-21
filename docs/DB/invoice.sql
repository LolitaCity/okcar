/**
 * 发票记录表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-21
 */
DROP TABLE IF EXISTS `invoice`;
create table `invoice`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned DEFAULT NULL COMMENT '订单Id',
`invoice_type` varchar(20)  NOT NULL DEFAULT '' COMMENT '普通发票，增值税专用发票',
`invoice_title` varchar(30)  NOT NULL DEFAULT '' COMMENT '发票抬头',
`duty_num` varchar(30)  NOT NULL DEFAULT '' COMMENT '发票税号',
`total_sum` float(10,2) DEFAULT NULL COMMENT '发票总金额',
`remark` varchar(150) NOT NULL DEFAULT '' COMMENT '备注',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='发票记录表';
