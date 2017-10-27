<?php
/**
 * Happy 活动报名模块微站定义
 *
 * @author 橙橙同学
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Happy_activityModuleSite extends WeModuleSite {

	public function doMobileEntry() {
		//这个操作被定义用来呈现 功能封面
	}
	public function doWebRule1() {
		//这个操作被定义用来呈现 规则列表
	}
	public function doWebRule2() {
		//这个操作被定义用来呈现 规则列表
	}
	public function doWebAvtivityManage() {
		//这个操作被定义用来呈现 管理中心导航菜单
        include $this->template('avtivityManage');
	}
	public function doWebActivityLog() {
		//这个操作被定义用来呈现 管理中心导航菜单
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