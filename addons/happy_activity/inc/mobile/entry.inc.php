<?php
/**
 * Created by 橙橙同学.
 * User: 橙橙同学
 * Date: 2017/10/27
 * Time: 上午11:51
 */
global $_W;
//获取活动数据
$activity = pdo_fetch('select * from '.tablename().'where `uniacid`=:uniacid',array(
    ':uniacid'=>$_W['uniacid']
));
var_dump($activity);
//加载视图

include $this->template('entry');
