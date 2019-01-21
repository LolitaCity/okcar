/**
 * 平台仓库表（四级联动使用）
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 */
DROP TABLE IF EXISTS `okcar_store_house`;
create table `okcar_store_house`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`area_id` int(10) unsigned DEFAULT NULL COMMENT '仓库所属地区id', 
`name` varchar(50) NOT NULL DEFAULT '' COMMENT '仓库名称',
`created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
`deleted_at` timestamp NULL DEFAULT NULL COMMENT '软删除时间',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='平台仓库表';
