<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
	.account-stat-num > div{width:25%; float:left; font-size:16px; text-align:center;}
	.account-stat-num > div span{display:block; font-size:30px; font-weight:bold;}
</style>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'index') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWeburl('statpaycenter', array('op' => 'index'))?>">收款记录</a></li>
	<li <?php  if($op == 'chart') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWeburl('statpaycenter', array('op' => 'chart'))?>">收款统计</a></li>
</ul>
<?php  if($op == 'index') { ?>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="do" value="statpaycenter">
				<input type="hidden" name="op" value="index">
				<input type="hidden" name="m" value="we7_coupon">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">操作人</label>
				<div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
					<select class="form-control" name="clerk_id">
						<option value="">不限</option>
						<?php  if(is_array($clerks)) { foreach($clerks as $clerk) { ?>
						<option value="<?php  echo $clerk['id'];?>" <?php  if($_GPC['clerk_id'] == $clerk['id']) { ?>selected<?php  } ?>><?php  echo $clerk['name'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">消费门店</label>
				<div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
					<select class="form-control" name="store_id">
						<option value="">不限</option>
						<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
						<option value="<?php  echo $store['id'];?>" <?php  if($_GPC['store_id'] == $store['id']) { ?>selected<?php  } ?>><?php  echo $store['business_name'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>&nbsp;&nbsp;
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="clearfix">
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-hover table-center table-responsive">
				<thead>
				<tr>
					<th style="text-align:left">编号</th>
					<th>付款人</th>
					<th>付款理由</th>
					<th>应付金额(元)</th>
					<th>实付金额(元)</th>
					<th>操作人</th>
					<th>消费门店</th>
					<th>付款时间</th>
					<th>操作</th>
				</tr>
				</thead>
				<?php  if(!empty($orders)) { ?>
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
				<tr>
					<td style="text-align:left"><?php  echo $order['id'];?></td>
					<td><?php  if(!empty($order['nickname'])) { ?><?php  echo $order['nickname'];?><?php  } else { ?><?php  echo $order['openid'];?><?php  } ?></td>
					<td><?php  echo $order['body'];?></td>
					<td><?php  echo $order['fee'];?></td>
					<td><?php  echo $order['final_fee'];?></td>
					<td><?php  echo $order['clerk_cn'];?></td>
					<td><?php  echo $order['store_cn'];?></td>
					<td><?php  echo date('Y-m-d H:i', $order['paytime']);?></td>
					<td>
						<a href="javascript:;" class="btn btn-success btn-sm pay-info" data-id="<?php  echo $order['id'];?>">支付详情</a>
					</td>
				</tr>
				<?php  } } ?>
				<?php  } ?>
			</table>
		</div>
	</div>
	<?php  echo $pager;?>
</div>
<?php  } ?>

<?php  if($op == 'chart') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		收款统计
	</div>
	<div class="panel-body">
		<div class="account-stat-num row">
			<div>昨日收款总额<span><?php  echo $yesterday_fee;?></span></div>
			<div>今日收款总额<span><?php  echo $today_fee;?></span></div>
			<div>本月收款总额<span><?php  echo $month_fee;?></span></div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		商家支付数据统计
	</div>
	<div class="panel-body">
		<div class="clearfix">
			<div id="date" class="pull-left">
				<?php  echo tpl_form_field_daterange('time', array('start' => date('Y-m-d', strtotime(date('Y-m-d')) - 30*86400),'end' => date('Y-m-d', strtotime(date('Y-m-d')) + 86399)), '')?>
			</div>
		</div>
		<h4>总收入: ￥<span class="text-success" id="date-total">0.00</span></h4>
		<div style="margin-top:20px" id="canvas-date">
			<canvas id="dateChart" width="1200" height="300"></canvas>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		商家支付数据统计(月份统计)
	</div>
	<div class="panel-body">
		<div class="clearfix">
			<div id="month" class="pull-left">
				<div class="input-group" style="width:300px;">
					<input type="text" class="form-control datetime" readonly name="time[start]" value="<?php  echo date('Y-m', strtotime('-6months'));?>">
					<span class="input-group-addon">到</span>
					<input type="text" class="form-control datetime" readonly name="time[end]" value="<?php  echo date('Y-m');?>">
					<div class="input-group-btn">
						<button class="btn btn-primary" id="search">查询</button>
					</div>
				</div>
			</div>
		</div>
		<h4>总收入: ￥<span class="text-success" id="month-total">0.00</span></h4>
		<div style="margin-top:20px" id="canvas-month">
			<canvas id="monthChart" width="1200" height="300"></canvas>
		</div>
	</div>
</div>
<script>
	require({
		paths: {
			'chart': '../../../../addons/we7_coupon/template/style/js/chart.min'
		}
	})
	require(['chart', 'daterangepicker', 'datetimepicker'], function(c) {
		$(".datetime").each(function(){
			var option = {
				lang : "zh",
				step : "10",
				timepicker : false,
				closeOnDateSelect : true,
				format : "Y-m"
			};
			$(this).datetimepicker(option);
		});

		var chart = null;
		var templates = {
			flow1: {
				label: '总收入',
				fillColor : "rgba(149,192,0,0.1)",
				strokeColor : "rgba(149,192,0,1)",
				pointColor : "rgba(149,192,0,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(149,192,0,1)"
			}
		};

		function GetChartData(type) {
			var start = $('#' + type + ' input[name="time[start]"]').val();
			var end = $('#' + type + ' input[name="time[end]"]').val();
			var params = {
				type: type,
				start: start,
				end: end
			};
			if(type == 'date') {
				$('#canvas-date').html('<canvas height="100" id="dateChart"></canvas>');
				$.post("<?php  echo $this->createWeburl('statpaycenter', array('type' => 'date', 'op' => 'chart'));?>", params, function(data){
					var data = $.parseJSON(data);
					var ds = $.extend(true, {}, templates);
					ds.flow1.data = data.datasets.flow1;
					var lineChartData = {
						labels : data.label,
						datasets : [ds.flow1]
					};
					var ctx = document.getElementById("dateChart").getContext("2d");
					chart = new Chart(ctx).Line(lineChartData, {
						responsive: true
					});
					$('#date-total').html(data.total);
				});
			} else {
				$('#canvas-month').html('<canvas height="100" id="monthChart"></canvas>');
				$.post("<?php  echo $this->createWeburl('statpaycenter', array('type' => 'month', 'op' => 'chart'));?>", params, function(data){
					var data = $.parseJSON(data);
					var ds = $.extend(true, {}, templates);
					ds.flow1.data = data.datasets.flow1;
					var lineChartData = {
						labels : data.label,
						datasets : [ds.flow1]
					};
					var ctx = document.getElementById("monthChart").getContext("2d");
					chart = new Chart(ctx).Line(lineChartData, {
						responsive: true
					});
					$('#month-total').html(data.total);
				});
			}
		}
		GetChartData('date');
		GetChartData('month');
		$('.daterange').on('apply.daterangepicker', function(ev, picker) {
			GetChartData('date');
		});
		$('#search').click(function(){
			GetChartData('month');
		});
	});
</script>
<?php  } ?>

<div class="modal fade" id="payinfo-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">支付详情</h3>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-heading">订单信息</div>
					<div class="panel-body">
						<table class="table table-hover table-none-border">
							<tbody>
							<tr>
								<th width="145">商品名称：</th>
								<td class="js-order-body"></td>
							</tr>
							<tr>
								<th>订单编号：</th>
								<td class="js-order-uniontid"></td>
							</tr>
							<tr>
								<th>支付方式：</th>
								<td class="js-order-tradetype"></td>
							</tr>
							<tr>
								<th>第三方支付订单id：</th>
								<td class="js-order-transaction-id"></td>
							</tr>
							<tr>
								<th>支付者：</th>
								<td class="js-order-nickname"></td>
							</tr>
							<tr>
								<th>支付者openid：</th>
								<td class="js-order-openid"></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<table class="table table-hover table-bordered table-center">
					<thead>
					<tr>
						<th>支付金额(元)</th>
						<th>支付人</th>
						<th width="180">支付时间</th>
						<th>状态</th>
					</tr>
					</thead>
					<tr>
						<td class="js-order-fee"></td>
						<td class="js-order-nickname"></td>
						<td class="js-order-paytime"></td>
						<td><span class="js-order-status"></span></td>
					</tr>
					<tr>
						<td colspan="4" style="text-align:right">
							应收总价：<span class="text-success js-order-fee"></span>
						</td>
					</tr>
				</table>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<script>
	require(['jquery.qrcode'], function(){
		$('.pay-info').click(function(){
			var id = $(this).data('id');
			if(!id) {
				util.message('订单编号错误', '', 'error');
				return false;
			}
			$.post("<?php  echo $this->createWeburl('statpaycenter', array('op' => 'detail'));?>", {id: id}, function(data) {
				var data = $.parseJSON(data);
				console.dir(data);
				if(data.message.errno == -1) {
					util.message(data.message.message, '', 'error');
					return false;
				} else {
					$('.js-order-body').html(data.message.message.order.body);
					$('.js-order-uniontid').html(data.message.message.order.uniontid);
					if (data.message.message.order.type == 'credit') {
						tradetype = data.message.message.types.credit;
					} else if (data.message.message.order.type == 'alipay') {
						tradetype = data.message.message.types.alipay;
					} else if (data.message.message.order.type == 'baifubao') {
						tradetype = data.message.message.types.baifubao;
					} else if (data.message.message.order.type == 'wechat') {
						tradetype = data.message.message.types.wechat;
					}
					if (data.message.message.order.trade_type == 'jsapi') {
						tradetype = tradetype + '-' + data.message.message.trade_types.jsapi + 'jsapi';
					} else if (data.message.message.order.trade_type == 'micropay') {
						tradetype = tradetype + '-' + data.message.message.trade_types.micropay + 'micropay';
					} else if (data.message.message.order.trade_type == 'native') {
						tradetype = tradetype + '-' + data.message.message.trade_types.native + 'native';
					}
					$('.js-order-tradetype').html(tradetype);
					if (data.message.message.order.status == '0') {
						status_class = 'text-danger';
						status_text = '未支付';
					} else if (data.message.message.order.status == '1') {
						status_class = 'text-success';
						status_text = '已支付';
					} else if (data.message.message.order.status == '2') {
						status_class = 'text-default';
						status_text = '已支付,退款中...';
					}
					$('.js-order-status').addClass(status_class);
					$('.js-order-status').html(status_text);
					$('.js-order-paytime').html(data.message.message.order.paytime_text);
					$('.js-order-transaction-id').html(data.message.message.order.transaction_id);
					$('.js-order-nickname').html(data.message.message.order.nickname);
					$('.js-order-openid').html(data.message.message.order.openid);
					$('.js-order-fee').html('¥ ' + data.message.message.order.fee);
					$('#payinfo-modal').modal('show');
					return false;
				}
			});
		});
	});
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>