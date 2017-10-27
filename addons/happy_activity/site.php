<?php
/**
 * Happy 活动报名模块微站定义
 *
 * @author 橙橙同学
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Happy_activityModuleSite extends WeModuleSite {

//	public function doMobileEntry() {
//		//这个操作被定义用来呈现 功能封面
//        echo 1;
//	}
	public function doWebRule1() {
		//这个操作被定义用来呈现 规则列表
	}
	public function doWebRule2() {
		//这个操作被定义用来呈现 规则列表
	}
	public function doWebAvtivityManage() {
		//这个操作被定义用来呈现 管理中心导航菜单
        global $_W,$_GPC;
        load()->func('tpl');
        if(checksubmit('submit')){
            $data['uniacid'] = $_W['uniacid'];
            $data['title'] = $_GPC['title'];
            $data['start_time'] = $_GPC['activity_time']['start'];
            $data['end_time'] = $_GPC['activity_time']['end'];
            $data['desc'] = $_GPC['info'];
            $data['thumb'] = $_GPC['thumb'];
            $res = pdo_insert('happy_happyactivity_activity',$data);
            if($res){
                message('编辑活动成功',$this->createWebUrl('AvtivityManage',array()),'success');
            }else{
                error('编辑活动失败','refresh','error');
            }
        }
        $activity = pdo_fetch(
            "select * from ".tablename(happy_happyactivity_activity)."where `uniacid`=:uniacid
            order by id desc"
            ,array(':uniacid'=>$_W['uniacid'])
        );
        include $this->template('activityManage');
	}
	public function doWebActivityLog() {
	    global $_W,$_GPC;
        load()->func('tpl');
        $pindex = max(1, intval($_GPC["page"]));
        $psize = 2;
        $res = pdo_fetchall("SELECT * FROM " . tablename('happy_happyactivity_join') . " 
        WHERE `uniacid`=:uniacid ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(':uniacid'=>$_W['uniacid']));
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('happy_happyactivity_join') . " 
        WHERE uniacid = '{$_W['uniacid']}'");
//        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('happy_happyactivity_join') . " WHERE uniacid = '{$_W['uniacid']}'");
        $pager = pagination($total, $pindex, $psize, $url = '', $context = array('before' => 0, 'after' => 0, 'ajaxcallback' => ''));
        include $this->template('ActivityLog');
	}
	public function doMobileIndexNav() {
		//这个操作被定义用来呈现 微站首页导航图标
	}
	public function doMobilePersonNav() {
		//这个操作被定义用来呈现 微站个人中心导航
	}
	public function doMobileQuicklyNav() {
		//这个操作被定义用来呈现 微站快捷功能导航
	}
	public function doWebDuli() {
		//这个操作被定义用来呈现 微站独立功能
	}

}