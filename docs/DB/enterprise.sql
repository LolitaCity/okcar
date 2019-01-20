/**
 * 企业信息表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `enterprise`;
create table `enterprise`(
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`name` int(10) default null COMMENT '企业名称',
`seal_ex` tinyint(1) not NUll default 0 COMMENT '是否注册电子公章',
`remark` varchar(150) not null default '' COMMENT '拒绝说明',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='电子公章授权失败记录表';
