<?php
/**
 * Created by 橙橙同学.
 * User: 橙橙同学
 * Date: 2017/10/27
 * Time: 上午11:51
 */
global $_W;
//获取活动数据
$activity = pdo_fetch("select * from ".tablename('happy_happyactivity_activity')."where `uniacid`=:uniacid
order by id desc",array(
    ':uniacid'=>$_W['uniacid']
));
//加载视图

include $this->template('entry');
