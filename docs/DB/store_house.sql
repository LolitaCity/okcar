/**
 * 仓库表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `store_house`;
create table `store_house`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`area` varchar(30) NOT NULL DEFAULT '' COMMENT '仓库地区（省市区）', 
`type` varchar(10) NOT NULL DEFAULT 0 COMMENT '仓库类型，集中仓，经销商仓',
`name` varchar(50) NOT NULL DEFAULT '' COMMENT '仓库名称',
`address` varchar(150) NOT NULL DEFAULT '' COMMENT '详细地址',
`default_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否为默认仓库，0否，1是',
`created_id` int(11) unsigned DEFAULT NULL COMMENT '创建人Id（买家用户id）',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '软删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='仓库表';
