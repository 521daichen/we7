<?php
/**
 * Created by 橙橙同学.
 * User: 橙橙同学
 * Date: 2017/10/27
 * Time: 下午12:12
 */
global $_W,$_GPC;
load()->func('tpl');

if(checksubmit('submit')){

    var_dump($_GPC);
    exit();
    $data['openid'] = $_W['openid'];
    $data['uniacid'] = $_W['uniacid'];
    $data['name'] = $_GPC['username'];
    $data['sex'] = $_GPC['sex'];
    $data['mobile'] = $_GPC['mobile'];
    $data['pic'] = $_GPC['thumb'];
    $data['msg'] = $_GPC['msg'];
    $res = pdo_insert("happy_happyactivity_join",$data);
    if($res){
        message('编辑活动成功',$this->createMobileUrl('join',array()),'success');
    }else{
        message('保存失败','','error');
    }
}

include $this->template('join');