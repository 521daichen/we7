<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="pane panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h1>报名记录</h1>
        </div>
    </div>
    <div class="panel-body">


        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>姓名</th>
                <th>性别</th>
                <th>图片</th>
                <th>手机号</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($res)) { foreach($res as $key => $item) { ?>
            <tr>
                <th scope="row"><?php  echo $item['id'];?></th>
                <td><?php  echo $item['name'];?></td>
                <td><?php  echo $item['sex'];?></td>
                <td><img src="<?php  echo tomedia($item['pic']);?>" alt=""></td>
                <td><?php  echo $item['mobile'];?></td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>