<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.thumbadimg{border:1px;}
.nav_1,.nav_2,.nav_3,.nav_4{display:none}
.thumbnail>img{width:120px;height:120px;}
    .context-menu-list {
        color: #000;
    }

    .btn-warning .fa-remove {
        margin-right: 0;
    }
	.nav_8{display:none}
	.tanchuad img,.adimgbox img{background: url(../attachment/images/global/nopic.jpg);
    background-size: 100% 100%;}
</style>
<style>
.settings{
	display: none;
}
</style>

<ul class="nav nav-tabs" id="snav">
	<li><a>1、本模块链接页面在2017年10月20日0点以后生效<br>2、本模块适用于所有用户，NB淘宝客模块非必须安装<br>3、本模块需使用阿里妈妈账户信息，请自行申请</a></li>
</ul>

<?php  load()->func('tpl')?>




<form id="reply-form" class="form-horizontal form"  method="post" enctype="multipart/form-data">

<div class="panel panel-default settings" style="display: block;">
	<div class="panel-heading">双11来啦，赚钱设置</div>
	<div class="panel-body">


<div class="form-group">
        <label class="col-xs-2 col-sm-2 col-md-2 control-label"><font color="blue">页面访问路径</font></label>
        <div class="col-xs-10 col-sm-10 col-md-10">
          <input type="text" value="<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=index&m=bsht_1111" class="form-control" readonly/>
		  <div class="help-block">1、请自行复制<br>2、可加参数&tb_pid=mm_xx_xx_xx，或加参数&shopid=XXX，shopid优先级高于tb_pid<br>3、开启自动匹配NB分店功能，shopid会自动对应<br>4、新增参数&auto=1可以自动提示超级红包</div>
        </div>
</div>


<div class="form-group" >
		<label class="col-xs-2 col-sm-2 col-md-2 control-label"><font color="red">自动匹配NB分店</font></label>
		<div class="col-xs-10 col-sm-10 col-md-10">
			
			 <label class="radio-inline"><input type="radio" name="isnbshop"
			 value="0" <?php  if($settings['isnbshop'] == 0 || empty($settings['isnbshop'])) { ?>checked="checked" <?php  } ?>>关闭</label>

			 <label class="radio-inline"><input type="radio" name="isnbshop"
			 value="1" <?php  if($settings['isnbshop'] == 1) { ?>checked="checked" <?php  } ?>>开启</label>

		<div class="help-block">默认关闭（需安装NB微信淘宝客模块）</div>
		</div>
</div>


<div class="form-group">
        <label class="col-xs-2 col-sm-2 col-md-2 control-label"><span style='color:red'>淘宝客 - App Key</span></label>
        <div class="col-xs-10 col-sm-10 col-md-10">
          <input type="text" name="tb_appkey" value="<?php  echo $settings['tb_appkey'];?>" class="form-control"/>
		  <div class="help-block">申请地址 http://pub.alimama.com/</div>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-2 col-sm-2 col-md-2 control-label"><span style='color:red'>淘宝客 - App Secret</span></label>
        <div class="col-xs-10 col-sm-10 col-md-10">
          <input type="text" name="tb_secret" value="<?php  echo $settings['tb_secret'];?>" class="form-control"/>
		  <div class="help-block">申请地址 http://pub.alimama.com/</div>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-2 col-sm-2 col-md-2 control-label"><span style='color:red'>淘宝客 - 默认PID</span></label>
        <div class="col-xs-10 col-sm-10 col-md-10">
          <input type="text" name="tb_pid" value="<?php  echo $settings['tb_pid'];?>" class="form-control"/>
		  <div class="help-block">申请地址 http://pub.alimama.com/</div>
        </div>
</div>


<div class="form-group">
        <label class="col-xs-2 col-sm-2 col-md-2 control-label">页面标题</label>
        <div class="col-xs-10 col-sm-10 col-md-10">
          <input type="text" name="tb_tit" value="<?php  echo $settings['tb_tit'];?>" class="form-control"/>
		  <div class="help-block"></div>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-2 col-sm-2 col-md-2 control-label">浏览器分享前缀</label>
        <div class="col-xs-10 col-sm-10 col-md-10">
          <input type="text" name="tb_txt" value="<?php  echo $settings['tb_txt'];?>" class="form-control"/>
		  <div class="help-block">请使用QQ或UC浏览器页面分享功能</div>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-2 col-sm-2 col-md-2 control-label">浏览器分享后缀</label>
        <div class="col-xs-10 col-sm-10 col-md-10">
          <input type="text" name="tb_end" value="<?php  if(!empty($settings['tb_end'])) { ?><?php  echo $settings['tb_end'];?><?php  } else { ?>【手慢无】<?php  } ?>" class="form-control"/>
		  <div class="help-block"></div>
        </div>
</div>





<div class="form-group">		
<label class="col-xs-2 col-sm-3 col-md-2 control-label"></label>			
<div class="col-xs-4 col-sm-4 col-md-4"><input name="submit" type="submit" value="保存设置" class="btn btn-success btn-block" />
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />			
</div>		
</div>



</div>	
</div>


</form>



<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>