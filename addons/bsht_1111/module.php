<?php
/**
 * 牛贝-淘宝客111111111~~~
 *
 * @author tonnyc
 * @url 
 */
defined('IN_IA') or exit('Access Denied');
class Bsht_1111Module extends WeModule
{
    public function fieldsFormDisplay($rid = 0)
    {
        //要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
    }
    public function fieldsFormValidate($rid = 0)
    {
        //规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
        return '';
    }
    public function fieldsFormSubmit($rid)
    {
        //规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
    }
    public function ruleDeleted($rid)
    {
        //删除规则时调用，这里 $rid 为对应的规则编号
    }
    public function settingsDisplay($settings)
    {
        global $_W, $_GPC;
		
		if (checksubmit()) {
            $dat = array();
			$dat['isnbshop'] = intval($_GPC['isnbshop']);
			$dat['tb_appkey'] = trim($_GPC['tb_appkey']);
			$dat['tb_secret'] = trim($_GPC['tb_secret']);
			$dat['tb_pid'] = trim($_GPC['tb_pid']);
			$dat['tb_tit'] = trim($_GPC['tb_tit']);
			$dat['tb_txt'] = trim($_GPC['tb_txt']);
			$dat['tb_end'] = trim($_GPC['tb_end']);
            $this->saveSettings($dat);
            message('保存成功', 'refresh');
        }
        $settings = $this->module['config'];
        include $this->template('settings');
    }

}