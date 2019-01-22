/**
 * 电子公章表授权申请记录表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `electronic_seal_auth`;
create table `electronic_seal_auth`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`status` tinyint(1) NOT NULL DEFAULT 1  COMMENT '状态,1申请提交成功待审核，2审核未通过，3审核通过',
`remark` varchar(150) NOT NULL DEFAULT '' COMMENT '拒绝说明',
`created_id` int(10) unsigned DEFAULT NULL COMMENT '创建人id（申请人id）',
`expire` int(11) unsigned DEFAULT NULL COMMENT '过期时间戳',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='电子公章表授权申请记录表';