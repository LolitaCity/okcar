/**
 * 订单操作记录表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_option_record`;
create table `order_option_record`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned DEFAULT NULL COMMENT '订单人Id',
`user_id` int(11)  unsigned DEFAULT NULL COMMENT '操作人Id',
`step` tinyint(3)  DEFAULT NULL COMMENT '操作步骤',
`remark` varchar(150) NOT NULL DEFAULT '' COMMENT '操作说明',
`seller_flag` tinyint(3) DEFAULT NULL COMMENT '下一步骤是否为卖家操作，存在则为是，且与操作步骤相关',
`buy_flag` tinyint(3) DEFAULT NULL COMMENT'下一步骤是否为买家操作，存在则为是，且与操作步骤相关',
`platform_flag` tinyint(3) DEFAULT NULL COMMENT'下一步骤是否为平台操作，存在则为是，且与操作步骤相关',
`inspection_flag` tinyint(3) DEFAULT NULL COMMENT'下一步骤是否为验车员操作，存在则为是，且与操作步骤相关',
`investor_flag` tinyint(3) DEFAULT NULL COMMENT'下一步骤是否为资方操作，存在则为是，且与操作步骤相关',
`other_flag` tinyint(3) DEFAULT NULL COMMENT '下一步骤是否为第六方操作，存在则为是，且与操作步骤相关',
`flow` tinyint(3) NOT NULL DEFAULT 1 COMMENT '流程，用于断点',
`status` tinyint(1) DEFAULT NULL COMMENT '操作状态',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='订单操作记录表';