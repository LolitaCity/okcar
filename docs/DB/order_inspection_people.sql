/**
 * 验车员信息表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_inspection_people`;
create table `order_inspection_people`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned DEFAULT NULL COMMENT '订单Id',
`name` varchar(10)  NOT NULL DEFAULT '' COMMENT '验车员姓名',
`id_card` char(18) NOT NULL DEFAULT '' COMMENT '验车员身份证',
`phone_num` int(11) unsigned DEFAULT NULL COMMENT '验车员手机号码',
`type` tinyint(1) DEFAULT NULL COMMENT '验车员身份，1平台验车员，2买家验车员',
`deleted_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='验车员信息表';
