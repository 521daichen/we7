<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>


<div class="panel panel-default">
    <div class="panel-heading">活动时间:<?php  echo $activity['start_time'];?> ~ <?php  echo $activity['end_time'];?></div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" onsubmit="return validForm();">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="请输入姓名">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">性别</label>
                <div class="col-sm-10">
                    <select name="sex" id="" class="form-control">
                        <option value="1">男</option>
                        <option value="0">女</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3"  class="col-sm-2 control-label">手机号</label>
                <div class="col-sm-10">
                    <input type="text" name="mobile" class="form-control" id="inputPassword3" placeholder="请输入手机号">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">照片</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('thumb', $a);?>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">留言</label>
                <div class="col-sm-10">
                    <textarea name="msg" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <input name="submit" type="submit" value="点击报名">
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
        </form>
    </div>


</div>

<script>
    function validForm(){

    }
</script>



<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>