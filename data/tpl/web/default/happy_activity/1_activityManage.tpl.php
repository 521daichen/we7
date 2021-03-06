<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="/web/resource/components/ueditor/themes/default/css/ueditor.css">
<div class="panel panel-default">
    <div class="panel-heading">编辑活动</div>
    <div class="panel-body">
        <form class="form-horizontal" action="" method="POST">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">活动名称</label>
                <div class="col-sm-10">
                    <input type="text" name="title" value="<?php  echo $activity['title'];?>" class="form-control" id="inputEmail3" placeholder="请输入活动名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">活动图片</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('thumb',$activity['thumb']);?>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">活动时间</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_daterange('activity_time',array('start'=>$activity['start_time'],'end'=>'end_time'));?>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">活动介绍</label>
                <div class="col-sm-10">

                    <input type="text" name="info" value="<?php  echo $activity['info'];?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <input name="submit" type="submit" class="btn btn-default">Sign in</input>
                </div>
            </div>
        </form>
    </div>
</div>



<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>