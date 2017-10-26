<?php
/**
 * 会员中心模块微站定义
 *
 * @author 橙橙同学
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Member_centerModuleSite extends WeModuleSite {

	public function doMobileZheshi() {
		//这个操作被定义用来呈现 功能封面
		echo 1;
	}
	public function doWebManageCard() {
		//这个操作被定义用来呈现 管理中心导航菜单
		echo 1;
	}
	public function doWebManageGroup() {
		//这个操作被定义用来呈现 管理中心导航菜单
		echo 1;
	}
	public function doWebManageCenter() {
		echo 1;
		//这个操作被定义用来呈现 管理中心导航菜单
	}
	public function doMobileZheshisha() {
		echo 1;
		//这个操作被定义用来呈现 微站首页导航图标
	}
	public function doMobileWhatfuck() {
		//这个操作被定义用来呈现 微站个人中心导航
		echo 1;
	}
	public function doMobilePolaji() {
		//这个操作被定义用来呈现 微站快捷功能导航
		echo 1;
	}
	public function doWebAigfule() {
		//这个操作被定义用来呈现 微站独立功能
		echo 1;
	}

}