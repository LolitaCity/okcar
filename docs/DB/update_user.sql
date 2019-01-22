/**
 * 用户表修改
 *
 * @author   Lee<a605333742@gmail.com>
 * @date     20109-01-18
 * @see 新增卖家id，仓库id
 */
alter table `user` add `en_id` int(11) unsigned DEFAULT NULL COMMENT '用户所属企业id' after huanxin_password;