/**
 * 订单表修改
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 * @see 新增卖家id，仓库id
 */

alter table `order` add `seller_id` int(11) unsigned DEFAULT NULL COMMENT '卖家id' after buyer_id;
alter table `order` add `deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间' after updated_at;
alter table `order` add `ratio` tinyint(4) DEFAULT NULL COMMENT '垫资比例' after pay_mode_id;
alter table `order` add `enterprise_name` varchar(30) NOT NULL DEFAULT '' COMMENT '企业名称' after ratio;
alter table `order` add `total_price` varchar(30) NOT NULL DEFAULT '' COMMENT '订单总价' after enterprise_name;
alter table `order` add `earnest_ratio` varchar(10) NOT NULL  DEFAULT ""  COMMENT '预支定金比例' after total_price;
alter table `order` add `custom_earnest` float(10,2) DEFAULT NULL COMMENT '自定义定金' after earnest_ratio;
alter table `order` add `service_earnest` float(10,2) DEFAULT NULL  COMMENT '平台服务定金' after custom_earnest;
alter table `order` add `service_price` float(10,2) DEFAULT NULL COMMENT '平台服务费用' after service_earnest;
alter table `order` add `receiving_num` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '车辆已验收数量' after service_price;
alter table `order` add `unreceived_num` int(11) unsigned DEFAULT NULL COMMENT '车辆未验收数量' after receiving_num;
