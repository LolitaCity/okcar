/**
 * 订单上传图片存储表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `order_pic`;
create table `order_pic`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`order_id` int(11) unsigned DEFAULT NULL COMMENT '订单Id',
`step` tinyint(4)  DEFAULT NULL COMMENT '步骤',
`order_pic1` varchar(150) NOT NULL DEFAULT '' COMMENT '材料1',
`order_pic2` varchar(150) NOT NULL DEFAULT '' COMMENT '材料2',
`order_pic3` varchar(150) NOT NULL DEFAULT '' COMMENT '材料3',
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
`deleted_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='订单上传图片存储表';