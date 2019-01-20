/**
 * 电子公章授权失败记录表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `electronic_auth_err`;
create table `electronic_auth_err`(
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`auth_id` int(10) default null COMMENT '授权Id',
`remark` varchar(150) not null default '' COMMENT '拒绝说明',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='电子公章授权失败记录表';