<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<img src="<?php  echo tomedia();?>" alt="">


<div class="panel panel-default">
    <div class="panel-heading">活动名称</div>
    <div class="panel-body">
        <?php  echo $activity['title'];?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">活动时间</div>
    <div class="panel-body">
        <?php  echo $activity['start_time'];?> ~ <?php  echo $activity['end_time'];?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">详细内容</div>
    <div class="panel-body">
        <?php  echo $activity['desc'];?>
    </div>
</div>

<a href="<?php  echo $this->createMobileUrl('join');?>" class="btn btn-danger btn-block">报名</a>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>