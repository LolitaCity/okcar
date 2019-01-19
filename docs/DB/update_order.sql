/**
 * 订单表修改
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 * @see 新增卖家id，仓库id
 */

alter table `order` add `seller_id` int(11) unsigned DEFAULT NULL COMMENT '卖家id' after buyer_id;
alter table `order` add `deleted_at` int(11) unsigned DEFAULT NULL COMMENT '删除时间' after updated_at;
alter table `order` add `ratio` varchar(20) not null DEFAULT '' COMMENT '垫资比例' after pay_mode_id;
/**
 * @Lee 2019-01-19
 */