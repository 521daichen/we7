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
}

include $this->template('join');