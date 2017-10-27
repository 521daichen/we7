<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
	.table>thead>tr>th{border-bottom:0;}
	.table>thead>tr>th .checkbox label{font-weight:bold;}
	.table>tbody>tr>td{border-top:0;}
	.table .checkbox{padding-top:4px;}
</style>
<ul class="nav nav-tabs">
	<li<?php  if($op == 'display') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWeburl('clerklist');?>">店员管理</a></li>
	<li<?php  if($op == 'post') { ?> class="active"<?php  } ?>><a href="javascript:;" data-toggle="modal" data-target="#clerk-modal"><?php  if($id > 0) { ?>编辑店员<?php  } else { ?>添加店员<?php  } ?></a></li>
</ul>
<div class="modal fade" id="clerk-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">选择你要创建店员</h4>
			</div>
			<div class="modal-body clearfix form-horizontal">
				<?php  if(!empty($available_user)) { ?>
				<?php  if(is_array($available_user)) { foreach($available_user as $user) { ?>
				<div class="form-group marbot0">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="uid" value="<?php  echo $user['uid'];?>"/><?php  echo $user['user_info']['username'];?>
						</label>
						<div class="help-block">
							<?php  if(is_array($user['permission'])) { foreach($user['permission'] as $permission) { ?>
							<span class="label label-success"><?php  echo $permission;?></span>
							<?php  } } ?>
						</div>
					</div>
				</div>
				<?php  } } ?>
				<?php  } else { ?>
				<div class="form-group marbot0 text-center">
					暂无可用操作员(<a style="color:blue" href="<?php  echo url('module/permission', array('m' => 'we7_coupon'))?>">点击进入权限设置，添加操作员</a>)
				</div>
				<?php  } ?>
			</div>
			<?php  if(!empty($available_user)) { ?>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href='<?php  echo $this->createWeburl('clerklist', array('op' => 'post'))?>&uid=' + $('#clerk-modal input[type=radio]:checked').val()">确定</button>
			</div>
			<?php  } ?>
		</div>
	</div>
</div>
<?php  if($op == 'display') { ?>
<div class="alert alert-info">
	<p>1、系统中所有的店员信息不可重复</p>
	<p>2、添加店员可以设置店员操作的权限</p>
	<p>3、店员可以登录系统后台（工作台）来进行相应的操作</p>
	<p>4、门店已删除的店员将无法登陆系统后台（工作台）,可通过编辑重新设置门店以后登陆</p>
	<p>5、绑定操作员操作将会把积分、余额统计，现金消费统计，收银台收款统计中的店员信息全部替换为要绑定的操作员</p>
</div>

<div class="main">
<div class="main table-responsive">
	<form method="post" class="form-horizontal" id="form1">
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead>
					<tr>
						<th>店员姓名</th>
						<th>所在门店</th>
						<th>登陆账号</th>
						<th>手机号</th>
						<th>微信昵称</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody id="list">
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr>
						<td>
							<?php  echo $item['name'];?>
							<?php  if(empty($item['password'])) { ?>
							<span class="text-danger" style="cursor:pointer" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="该店员尚未设置密码,请重新编辑店员信息密码"><i class="fa fa-info-circle"></i></span>
							<?php  } ?>
						</td>
						<td>
							<?php  if($item['storeid'] > 0) { ?>
								<?php  if(!empty($stores[$item['storeid']])) { ?>
									<span class="label label-success"><?php  echo $stores[$item['storeid']]['business_name'];?>-<?php  echo $stores[$item['storeid']]['branch_name'];?></span>
								<?php  } else { ?>
									<span class="label label-warning">门店已删除</span>
								<?php  } ?>
							<?php  } else { ?>
								<span class="label label-danger">未设置</span>
							<?php  } ?>
						</td>
						<td><?php  echo $users[$item['uid']]['username'];?></td>
						<td><?php  echo $item['mobile'];?></td>
						<td><?php  echo $item['nickname'];?></td>
						<td>
							<?php  if($item['new'] == 2) { ?>
							<a href="javascript:;" class="js-bind-clerk" data-clerkid="<?php  echo $item['id'];?>" data-olduid="<?php  echo $item['uid'];?>">绑定操作员</a>
							<?php  } ?>
							<?php  if(!empty($stores[$item['storeid']])) { ?>
							<a onclick="if (confirm('使用该店员帐号后，会更改您当前登录的用户，是否继续？')) {alert('使用完毕后，您退出店员帐号重新登录管理帐号即可。')} else { return false;}" href="<?php  echo $this->createWeburl('clerklist',array('op' => 'switch', 'id' => $item['id']));?>" title="编辑">使用该店员帐号</a>&nbsp;-&nbsp;
							<?php  } ?>

							<a href="<?php  echo $this->createWeburl('clerklist',array('op' => 'post', 'id' => $item['id'], 'uid' => $item['uid']));?>" title="编辑">编辑</a>&nbsp;-&nbsp;
							<a href="<?php  echo $this->createWeburl('clerklist', array('op' => 'delete', 'id' => $item['id']))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除">删除</a>
						</td>
					</tr>
					<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php  echo $pager;?>
	</form>
</div>
</div>
<div class="modal fade" id="bindclerk-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">选择你要创建店员</h4>
			</div>
			<div class="modal-body clearfix form-horizontal">
				<?php  if(!empty($available_user)) { ?>
				<?php  if(is_array($available_user)) { foreach($available_user as $user) { ?>
				<div class="form-group marbot0">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="uid" value="<?php  echo $user['uid'];?>"/><?php  echo $user['user_info']['username'];?>
						</label>
						<div class="help-block">
							<?php  if(is_array($user['permission'])) { foreach($user['permission'] as $permission) { ?>
							<span class="label label-success"><?php  echo $permission;?></span>
							<?php  } } ?>
						</div>
					</div>
				</div>
				<?php  } } ?>
				<?php  } else { ?>
				<div class="form-group marbot0 text-center">
					暂无可用操作员(<a style="color:blue" href="<?php  echo url('module/permission', array('m' => 'we7_coupon'))?>">点击进入权限设置，添加操作员</a>)
				</div>
				<?php  } ?>
			</div>
			<?php  if(!empty($available_user)) { ?>
			<div class="modal-footer">
				<input type="hidden" name="clerkid">
				<input type="hidden" name="olduid">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary js-bind-submit" data-dismiss="modal" >确定</button>
			</div>
			<?php  } ?>
		</div>
	</div>
</div>
<script>
	$('.js-bind-clerk').click(function(data) {
		$('#bindclerk-modal').modal('show');
		clerkid = $(this).data('clerkid');
		olduid = $(this).data('olduid');
		$('input[name="clerkid"]').val(clerkid);
		$('input[name="olduid"]').val(olduid);
	});
	$('.js-bind-submit').click(function(data) {
		if (confirm('此操作将会把积分、余额统计，现金消费统计，收银台收款统计中的店员信息全部替换为绑定的操作员，确定吗')) {
			uid = $('#bindclerk-modal input[type=radio]:checked').val();
			clerkid =  $('input[name=clerkid]').val();
			olduid = $('input[name=olduid]').val();
			url = "<?php  echo $this->createWeburl('clerklist', array('op' => 'bind'))?>";
			url += '&uid=' + uid + '&clerkid=' + clerkid + '&olduid=' + olduid;
			location.href = url;
		};
		return false;
	});
	require(['bootstrap'],function($){
		$('[data-toggle="popover"]').popover()
	});
</script>
<?php  } ?>
<?php  if($op == 'post') { ?>
<?php  if(empty($stores)) { ?>
<div class="alert alert-info">
	<p style="color : black;">您还没有<a href="<?php  echo $this->createWeburl('clerklist', array('op' => 'post'))?>" >添加门店</a>，请先添加门店再进行操作。</p>
</div>
<?php  } else { ?>
<div class="alert alert-info">
	1、 添加微信店员需要您的公众号号为: 认证订阅号 或 认证服务号<br>
	2、因为添加店员是通过粉丝昵称搜索相应店员的信息,所以添加店员之前,需要 <a href="<?php  echo url('mc/fans');?>" target="_blank">下载粉丝列表</a> & <a href="<?php  echo url('mc/fans');?>" target="_blank">更新粉丝信息</a> & <a href="<?php  echo url('mc/fangroup');?>" target="_blank">更新粉丝分组</a><br>
	3、如果您不想使用昵称来搜索粉丝，可通过粉丝id进行搜索
</div>
<div class="clearfix">
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $id;?>">
		<div class="panel panel-default">
			<div class="panel-heading">基本信息</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>店员姓名</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="name"  value="<?php  echo $clerk['name'];?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>登陆账号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="username"  value="<?php  echo $user_info['username'];?>" class="form-control" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>核销密码</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="password"  value="<?php  echo $clerk['password'];?>" class="form-control">
						<div class="help-block"><strong class="text-danger">核销密码是用户核销卡券时使用的密码</strong></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>手机号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="mobile" value="<?php  echo $clerk['mobile'];?>" class="form-control" placeholder="请填写店员手机号">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>所属门店</label>
					<div class="col-sm-9 col-xs-12">
						<select name="storeid" class="form-control">
							<option value="">==选择所属门店==</option>
							<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
							<option value="<?php  echo $store['id'];?>" <?php  if($store['id'] == $clerk['storeid']) { ?>selected<?php  } ?>><?php  echo $store['business_name'];?>-<?php  echo $store['branch_name'];?></option>
							<?php  } } ?>
						</select>
						<div class="help-block"><strong class="text-danger">如果您不选门店，员工账号登录进来将可以看见所有的支付订单和卡券，会员卡. <a href="<?php  echo url('activity/store');?>">创建门店</a></strong></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>店员微信昵称</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="text" name="nickname" value="<?php  echo $clerk['nickname'];?>" class="form-control">
							<div class="input-group-btn">
								<span class="btn btn-success btn-openid">检 测</span>
							</div>
						</div>
						<div class="help-block">请填写微信昵称。系统根据微信昵称获取该商家对应公众号的openid</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span> 或 店员粉丝编号</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="text" name="openid" value="<?php  echo $clerk['openid'];?>" class="form-control">
							<div class="input-group-btn">
								<span class="btn btn-success btn-openid">检 测</span>
							</div>
						</div>
						<div class="help-block">请填写微信编号。系统根据微信编号获取该商家对应公众号的openid</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">权限清单</div>
			<div class="panel-body table-responsive">
				<?php  if(!empty($user_permissions[$uid]['permission'])) { ?>
				<?php  if(is_array($user_permissions[$uid]['permission'])) { foreach($user_permissions[$uid]['permission'] as $permission) { ?>
					<div class="col-sm-3">
						<span class=""><?php  echo $permission;?></span>
					</div>
				<?php  } } ?>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input name="uid"  type="hidden" value="<?php  echo $uid;?>" >
			<input name="id" type="hidden" value="<?php  echo $clerk['id'];?>" >
			<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<script>
	<?php  if($clerk['name'] == $clerk['username']) { ?>
		$('[name="same"]').attr('checked', true);
		$('#username').hide();
	<?php  } ?>
	$('[name="name"]').change(function () {
		if ($('[name="same"]').is(':checked')) {
			$('[name="username"]').val($(this).val());
		}
	});
	var id = '<?php  echo $id;?>';
	$('[name="same"]').click(function() {
		if ($(this).is(':checked')) {
			$('#username').hide();
			$('[name="username"]').val($('[name="name"]').val());
		}else {
			$('#warning').hide();
			$('#username').show();
		}
	});
	$('[name="name"]').blur(function () {
		if ($('[name="same"]').is(':checked')) {
			var username = $.trim($(':text[name="name"]').val());
			var uid = $('[name="uid"]').val();
			$.post("<?php  echo $this->createWeburl('clerklist', array('op' => 'checkname'))?>", {'uid' : uid, 'username' : username}, function(data) {
				var data = $.parseJSON(data);
				if (data.message.errno == '0') {
					$(':text[name="username"]').data('type', 0);
					$('#warning').show();
				}else {
					$(':text[name="username"]').data('type', 1);
					$('#warning').hide();
				}
			});
		}
	});
	$('[name="username"]').blur(function () {
		if (!$('[name="same"]').is(':checked')) {
			var username = $.trim($(':text[name="username"]').val());
			var uid = $('[name="uid"]').val();
			$.post("<?php  echo $this->createWeburl('clerklist', array('op' => 'checkname'))?>", {'uid' : uid, 'username' : username}, function(data) {
				var data = $.parseJSON(data);
				if (data.message.errno == '0') {
					$(':text[name="username"]').data('type', 0);
					$('#warning').hide();
					$('#u_warning').show();
				}else {
					$(':text[name="username"]').data('type', 1);
					$('#warning').hide();
					$('#u_warning').hide();
				}
			});
		}
	});
	$('#form1').submit(function(){

		var name = $.trim($(':text[name="name"]').val());
		if (!name) {
			util.message('请填写店员名称');
			return false;
		}
		var password = $.trim($('input[name="password"]').val());
		<?php  if(!$clerk['uid']) { ?>
			if (!password || password.length < 8) {
				util.message('核销密码不能小于8位数');
				return false;
			}
		<?php  } else { ?>
			if (password != '' && password.length < 8) {
				util.message('密码不能小于8位数');
				return false;
			}
		<?php  } ?>
		var mobile = $.trim($(':text[name="mobile"]').val());
		if (!mobile) {
			util.message('请填写店员手机号');
			return false;
		}

		var store_id = $.trim($('select[name="storeid"]').val());
		if (!store_id) {
			util.message('请选择店员所在的门店.<br>');
			return false;
		}
		var phone = /^\d{11}$/;
		if(!phone.test(mobile)) {
			util.message('请填写正确的手机格式');
			return false;
		}
		return true;
	});

	$('.btn-openid').click(function(){
		var nickname = $.trim($(':text[name="nickname"]').val());
		var openid = $.trim($(':text[name="openid"]').val());
		if(!nickname && !openid) {
			util.message('请输入昵称或者openid');
			return false;
		}
		var param = {
			'nickname':nickname,
			'openid':openid
		};
		$.post("<?php  echo $this->createWeburl('clerklist', array('op' => 'verify'))?>", param, function(data){
			var data = $.parseJSON(data);
			if(data.message.errno < 0) {
				util.message(data.message.message);
				return false;
			}
			$(':text[name="openid"]').val(data.message.message.openid);
			$(':text[name="nickname"]').val(data.message.message.nickname);
		});
		return false;
	});

	$('.permission').click(function(){
		var name = $(this).data('name');
		$('.permission-child-' + name).find(':checkbox').prop('checked', $(this).find(':checkbox').prop('checked'));
	});
	$('.permission-child').click(function() {
		var name = $(this).data('name');
		if (!$(this).find(':checkbox').prop('checked')) {
			$('.permission-' + name).find(':checkbox').prop('checked', false);
		} else {
			if ($('.permission-child-' + name).find(':checkbox:not(:checked)').size()) {
				$('.permission-' + name).find(':checkbox').prop('checked', false);
			} else {
				$('.permission-' + name).find(':checkbox').prop('checked', true);
			}
		}
	});
</script>
<?php  } ?>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>