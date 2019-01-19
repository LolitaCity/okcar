/**
 * 仓库表
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `store_house`;
create table `store_house`(
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`province_code` int(10) default null COMMENT '地区省编码', 
`city_code` int(10) default null COMMENT '城市编码', 
`area_code` int(10) default null COMMENT '地区编码', 
`type` tinyint(1) NOT NULL default 0 COMMENT '仓库类型，0集中仓，1经销商仓',
`name` varchar(50) NOT NULL default '' COMMENT '仓库名称',
`address` varchar(150) NOT NULL default '' COMMENT '详细地址',
`default_flag` tinyint(1) NOT NULL default 1 COMMENT '是否为默认仓库，0否，1是',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`created_id` int(10) default null COMMENT '创建人Id（买家用户id）',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
`updated_id` int(10) default null COMMENT '修改人Id',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '软删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='仓库表';
