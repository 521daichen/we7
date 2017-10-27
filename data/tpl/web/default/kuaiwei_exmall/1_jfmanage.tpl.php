<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
		<li<?php  if($_GPC['do'] == 'spmanage') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('spmanage');?>">商品管理</a></li>
        <li<?php  if($_GPC['do'] == 'jfmanage' || $_GPC['do'] == '' ) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('jfmanage');?>">积分兑换管理</a></li>
		<li<?php  if($_GPC['do'] == 'admanage') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('admanage');?>">广告管理</a></li>
		<li<?php  if($_GPC['do'] == 'baseset') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('baseset');?>">基础设置</a></li>
    </ul>

    <div class="panel panel-primary">
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:100px;">兑换人头像</th>
                    <th style="width:120px;">兑换人姓名</th>
                    <th style="width:120px;">兑换人手机号</th>
                    <th style="width:300px">兑换人地址</th>
                    <th style="width:100px">兑换人积分数</th>
                    <th style="width:300px;">商品名称</th>
                    <th style="width:100px">商品兑换积分</th>
                    <th style="width:160px">状态</th>
                    <th style="width:100px;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>

                    <td><img src="<?php  echo tomedia($row['avatar'])?>" alt="" style="width: 60px;height: 60px;margin-left:5px;border-radius:50%;background:#CDCDCD;font-size:0"></td>
                    <td><?php  echo $row['fname'];?></td>
                    <td><?php  echo $row['tel'];?></td>
                    <td><?php  echo $row['faddr'];?></td>
                    <td><?php  echo $row['sharenum'] - $row['todaycredit']?></td>
                    <td><?php  echo $row['spname'];?></td>
                    <td><?php  echo $row['sp_integrals'];?></td>

                    <td><?php  if($row['states'] == 1) { ?>未确认<?php  } else if($row['states'] == 2) { ?>已确认<?php  } ?></td>
                    <td>
                        <a class="btn btn-default" <?php  if($row['states'] == 2) { ?>disabled="true"<?php  } ?>  title="确认" style="background-color: #00aeef" data-placement="top" href="#" onclick="drop_confirm('您确定兑换商品吗!', '<?php  echo $this->createWebUrl('setdhconf',array('id'=>$row['id'],'fansID'=>$row['fansID'],'states'=>2))?>');"><i >确认</i></a>
                    </td>
                </tr>
                <?php  } } ?>

                </tbody>
            </table>
        </div>
    </div>
    <?php  echo $pager;?>
</div>




<script>
    require(['bootstrap'],function($){
        $('.btn').tooltip();
    });
    $(function(){

        $(".check_all").click(function(){
            var checked = $(this).get(0).checked;
            $(':checkbox').each(function(){this.checked = checked});
        });
        $("input[name=deleteall]").click(function(){

            var check = $("input:checked");
            if(check.length<1){
                err('请选择要删除的记录!');
                return false;
            }
            if( confirm("确认要删除选择的记录?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                $.post('<?php  echo $this->createWebUrl('deleteAll')?>', {idArr:id},function(data){
                    if (data.errno ==0)
                    {
                        location.reload();
                    } else {
                        alert(data.error);
                    }


                },'json');
            }

        });
    });
</script>
<script>





    function drop_confirm(msg, url){
        if(confirm(msg)){
            window.location = url;
        }
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>