/**
 * 订单表修改
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 * @see 新增卖家id，仓库id
 */

alter table order add `seller_id` int(11) unsigned DEFAULT NULL COMMENT '卖家id' after buyer_id;
alter table order add `store_id` int(11) unsigned DEFAULT NULL COMMENT '仓库id' after bus_id;