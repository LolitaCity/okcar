/**
 * 合同信息表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-21
 */
DROP TABLE IF EXISTS `contract`;
create table `contract`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned DEFAULT NULL COMMENT '订单Id',
`buyer_id` int(11) unsigned DEFAULT NULL COMMENT '买家id',
`seller_id` int(11) unsigned DEFAULT NULL COMMENT '卖家id',
`account_name` varchar(30)  NOT NULL DEFAULT '' COMMENT '账户名称',
`account_num` varchar(30)  NOT NULL DEFAULT '' COMMENT '账号',
`open_bank` varchar(30)  NOT NULL DEFAULT '' COMMENT '开户行名称',
`downpayment` float(10,2) DEFAULT NULL COMMENT '首付',
`remark` varchar(150) NOT NULL DEFAULT '' COMMENT '备注',
`status` tinyint(3)  DEFAULT NULL COMMENT '状态',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='合同信息表';
