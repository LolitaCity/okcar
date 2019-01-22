/**
 * 企业信息表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `enterprise`;
create table `enterprise`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`enterprise_name` varchar(200)  NOT NULL DEFAULT '' COMMENT '企业名称',
`legal_person_name` varchar(50)  NOT NULL DEFAULT '' COMMENT '法人名字',
`legal_person_id_card` char(18) NOT NULL DEFAULT '' COMMENT '法人身份证号码',
`legal_preson_phone` char(11) NOT NULL DEFAULT '' COMMENT '法人手机号码',
`expire` int(11) unsigned DEFAULT NUll COMMENT '过期时间戳',
`remark` varchar(150) NOT NULL DEFAULT '' COMMENT '备注（失败说明）',
`status` tinyint(1) NOT NUll DEFAULT 0 COMMENT '电子公章状态,0未申请，1已申请审核中，2申请失败，3申请成功',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='企业信息表';
