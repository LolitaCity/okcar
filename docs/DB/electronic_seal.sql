/**
 * 电子公章注册表 @Lee 废弃此表，数据存储到企业表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `electronic_seal`;
create table `electronic_seal`(
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`en_crc32` int(11)  default null  COMMENT '企业名称转crc32',
`status` tinyint(1) default 1 COMMENT '电子公章注册状态,1注册成功，2注册失败',
`remark` varchar(120) not null COMMENT '注册失败原因',
`created_at` timestamp NULL DEFAULT NULL COMMENT '申请时间',
`created_id` int(10) default null COMMENT '申请人Id',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='电子公章表';