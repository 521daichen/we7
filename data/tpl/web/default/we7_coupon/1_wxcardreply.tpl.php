<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('wxcardreply')?>">管理微信卡券回复</a></li>
	<li <?php  if($op == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('wxcardreply', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加微信卡券回复</a></li>
</ul>
<?php  if($op == 'display') { ?>
<div class="clearfix">
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site">
			<input type="hidden" name="a" value="entry">
			<input type="hidden" name="m" value="we7_coupon" />
			<input type="hidden" name="do" value="wxcardreply">
			<input type="hidden" name="status" value="<?php  echo $status;?>" />
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<div class="btn-group">
							<a href="<?php  echo filter_url('status:-1');?>"  class="btn <?php  if($_GPC['status'] == '-1'|| $_GPC['status'] == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">所有</a>
							<a href="<?php  echo filter_url('status:1');?>"  class="btn <?php  if($_GPC['status']== '1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">启用</a>
							<a href="<?php  echo filter_url('status:0');?>"  class="btn <?php  if($_GPC['status'] == '0') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">禁用</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">规则名称</label>
					<div class="col-sm-8 col-xs-12">
							<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
					</div>
					<div class="col-xs-12 col-sm-2 col-lg-1 text-right">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<form action="<?php  echo $this->createWebUrl('wxcardreply', array('op' => 'delete'));?>" method="post" class="form-horizontal" role="form" id="form1">
	<input type="hidden" name="m" value="we7_coupon"/>
	<?php  if(!empty($replies)) { ?>
	<div>
		<?php  if(is_array($replies)) { foreach($replies as $row) { ?>
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<label class="checkbox-inline" style="padding-top:0"><input type="checkbox" name="rid[]" value="<?php  echo $row['id'];?>"/> <?php  echo $row['name'];?></label>
				<span class="pull-right">
					<?php  if($row['displayorder'] > 0) { ?>
						<?php  if($row['displayorder'] == '255') { ?>
							<span class="label label-primary">置顶</span>
						<?php  } else { ?>
							<span class="label label-info">优先级 <?php  echo $row['displayorder'];?></span>
						<?php  } ?>
					<?php  } ?>
					<?php  if($row['status'] == '0') { ?><span class="label label-danger">已禁用</span><?php  } ?>
				</span>
			</div>
			<div class="panel-body">
				<?php  if(is_array($row['keywords'])) { foreach($row['keywords'] as $kw) { ?>
				<span class="label label-default" data-toggle="tooltip" data-placement="top" title="<?php  if($kw['type']==1) { ?>等于<?php  } else if($kw['type']==2) { ?>包含<?php  } else if($kw['type']==3) { ?>正则<?php  } ?>"><?php  echo $kw['content'];?></span>&nbsp;
				<?php  if($kw['type'] == 4) { ?><span class="label label-info" data-toggle="tooltip" data-placement="top" title="托管">优先级在<?php  echo $row['displayorder'];?>之下直接生效</span><?php  } ?>
				<?php  } } ?>
			</div>
			<div class="panel-footer clearfix">
				<div class="btn-group pull-right">
					<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('wxcardreply', array('op' => 'post', 'rid' => $row['id']))?>"><i class="fa fa-edit"></i> 编辑</a>
					<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('wxcardreply', array('op' => 'delete', 'rid' => $row['id']))?>" onclick="return confirm('删除规则将同时删除关键字与回复，确认吗？');return false;"><i class="fa fa-times"></i> 删除</a>
					<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('wxcardreply', array('id' => $row['id'], 'op' => 'stat-trend'))?>"><i class="fa fa-bar-chart-o"></i> 使用率走势</a>
					<?php  if($row['options']) { ?>
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
							功能选项
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" style="min-width:0px;">
							<?php  if(is_array($row['options'])) { foreach($row['options'] as $opt) { ?>
								<li><a href="<?php  echo $opt['url'];?>"><?php  echo $opt['title'];?></a></li>
							<?php  } } ?>
						</ul>
					</div>
					<?php  } ?>
				</div>
			</div>
		</div>
		<?php  } } ?>
	</div>
	<div>
		<label class="checkbox-inline" style="margin-top:-30px;margin-left:17px"><input type="checkbox" name="select_all" id="select_all" value="1"/></label>
		<input type="submit" class="btn btn-danger" value="删除" onclick="if(!confirm('确定删除选中的规则吗？')) return false;"/>
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
	</div>
	<?php  } ?>
	</form>
	<?php  echo $pager;?>
</div>
<script>
require(['bootstrap'], function($){
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
		$('#select_all').click(function(){
			$('#form1 :checkbox').prop('checked', $(this).prop('checked'));
		});
		$('#form1 :checkbox').click(function(){
			if(!$(this).prop('checked')) {
				$('#select_all').prop('checked', false);
			} else {
				var flag = 0;
				$('#form1 :checkbox[name="rid[]"]').each(function(){
					if(!$(this).prop('checked') && !flag) {
						flag = 1;
					}
				});
				if(flag) {
					$('#select_all').prop('checked', false);
				} else {
					$('#select_all').prop('checked', true);
				}
			}
		});
	})
});
</script>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div class="clearfix ng-cloak" id="js-reply-form" ng-controller="replyForm">
	<form id="reply-form" class="form-horizontal form" action="<?php  echo $this->createWebUrl('wxcardreply', array('op' => 'post', 'rid' => $rid))?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?php  if(empty($rid)) { ?>添加<?php  } else { ?>修改<?php  } ?>回复规则 <span class="text-muted">删除，修改规则、关键字以及回复后，请提交以保存操作。</span></div>
					<ul class="list-group">
						<li class="list-group-item">
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">回复规则名称</label>
								<div class="col-sm-6 col-md-8 col-xs-12">
									<input type="text" class="form-control" placeholder="请输入回复规则的名称" name="name" value="<?php  if(empty($reply['name']) && !empty($_GPC['name'])) { ?><?php  echo $_GPC['name'];?><?php  } else { ?><?php  echo $reply['name'];?><?php  } ?>" />
									<span class="help-block">
										您可以给这条规则起一个名字, 方便下次修改和查看. <br/>
										<strong class="text-danger">选择高级设置: 将会提供一系列的高级选项供专业用户使用.</strong>
									</span>
								</div>
								<div class="col-sm-3 col-md-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" ng-model="reply.advSetting" /> 高级设置
										</label>
									</div>
								</div>
							</div>
							<div class="form-group" ng-show="reply.advSetting">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="status" value="1" <?php  if($reply['status'] == 1 || empty($reply['status'])) { ?> checked="checked"<?php  } ?> /> 启用
									</label>
									<label class="radio-inline">
										<input type="radio" name="status" value="0" <?php  if(!empty($reply) && $reply['status'] == 0) { ?> checked="checked"<?php  } ?> /> 禁用
									</label>
									<span class="help-block">您可以临时禁用这条回复.</span>
								</div>
							</div>
							<div class="form-group" ng-show="reply.advSetting">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">置顶回复</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="1" value="1" <?php  if(intval($reply['displayorder'] >= 255)) { ?> checked="checked"<?php  } ?> /> 置顶
									</label>
									<label class="radio-inline">
										<input type="radio" name="istop" ng-model="reply.entry.istop" ng-value="0" value="0" <?php  if(intval($reply['displayorder'] < 255)) { ?> checked="checked"<?php  } ?> /> 普通
									</label>
									<span class="help-block">“置顶”时无论在什么情况下均能触发且使终保持最优先级</span>
								</div>
							</div>
							<div class="form-group" ng-show="reply.advSetting && !reply.entry.istop">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">优先级</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" placeholder="输入这条回复规则优先级" name="displayorder_rule" value="<?php  echo $reply['displayorder'];?>">
									<span class="help-block">规则优先级，越大则越靠前，最大不得超过254</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
								<div class="col-sm-6 col-md-8 col-xs-12">
									<input type="hidden" name="rid" value="<?php  echo $rid;?>" />
									<input type="text" class="form-control keyword" placeholder="请输入触发关键字" ng-model="trigger.items.default" id="keywordinput" onblur="checkKeyWord($(this));" />
									<span class="help-block"></span>
									<input type="hidden" name="keywords"/>
									<span class="help-block">
										当用户的对话内容符合以上的关键字定义时，会触发这个回复定义。多个关键字请使用逗号隔开。<a href="javascript:;" id="keyword"><i class="fa fa-github-alt"></i> 表情</a> <br />
										<strong class="text-danger">选择高级触发: 将会提供一系列的高级触发方式供专业用户使用(注意: 如果你不了解, 请不要使用). </strong>
									</span>
								</div>
								<div class="col-sm-3 col-md-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" ng-model="reply.advTrigger" /> 高级触发
										</label>
									</div>
								</div>
							</div>
							<div class="form-group" ng-show="reply.advTrigger">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">高级触发列表</label>
								<div class="col-sm-9">
									<div class="panel panel-default tab-content">
										<div class="panel-heading">
											<ul class="nav nav-pills">
												<li class="active"><a href="#contains" data-toggle="tab">包含关键字</a></li>
												<li><a href="#regexp" data-toggle="tab">正则表达式模式匹配</a></li>
												<li><a href="#trustee" data-toggle="tab">直接接管</a></li>
											</ul>
										</div>
										<ul class="tab-pane list-group active" id="contains">
											<li class="list-group-item row" ng-repeat="entry in trigger.items.contains">
												<div class="col-xs-12 col-sm-8">
													<input type="text" class="form-control keyword" ng-hide="entry.saved" placeholder="{{entry.label}}" ng-model="entry.content" onblur="checkKeyWord($(this));" />
													<span class="help-block"></span>
													<p class="form-control-static" ng-show="entry.saved" ng-bind="entry.content"></p>
												</div>
												<div class="col-sm-4">
													<div class="btn-group">
														<a href="javascript:;" class="btn btn-default" ng-click="trigger.saveItem(entry);">{{entry.saved ? '编辑' : '保存'}}</a>
														<a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">删除</a>
													</div>
												</div>
											</li>
										</ul>
										<ul class="tab-pane list-group" id="regexp">
											<li class="list-group-item row" ng-repeat="entry in trigger.items.regexp">
												<div class="col-xs-12 col-sm-8">
													<input type="text" class="form-control keyword" ng-hide="entry.saved" placeholder="{{entry.label}}" ng-model="entry.content" onblur="checkKeyWord($(this));" />
													<span class="help-block"></span>
													<p class="form-control-static" ng-show="entry.saved" ng-bind="entry.content"></p>
												</div>
												<div class="col-sm-4">
													<div class="btn-group">
														<a href="javascript:;" class="btn btn-default" ng-click="trigger.saveItem(entry);">{{entry.saved ? '编辑' : '保存'}}</a>
														<a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">删除</a>
													</div>
												</div>
											</li>
										</ul>
										<ul class="tab-pane list-group" id="trustee">
											<li class="list-group-item row" ng-repeat="entry in trigger.items.trustee">
												<div class="col-xs-12 col-sm-8">
													<p class="form-control-static">符合优先级条件时, 这条回复将直接生效</p>
												</div>
												<div class="col-sm-4">
													<a href="javascript:;" class="btn btn-default" ng-click="trigger.removeItem(entry);">取消接管</a>
												</div>
											</li>
										</ul>
										<div class="panel-footer">
											<a href="javascript:;" class="btn btn-default" ng-click="trigger.addItem();" ng-bind="'添加' + trigger.labels[trigger.active]">添加</a>
											<span class="help-block" ng-bind-html="trigger.descriptions[trigger.active]"></span>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div> 
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-12">
				<?php  echo module_build_form('wxcard', $rid);?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
</div>
<script>
require(['angular.sanitize', 'bootstrap', 'underscore', 'util'], function(angular, $, _, util){
	angular.module('app', ['ngSanitize']).controller('replyForm', function($scope, $http){
		$scope.reply = {
			advSetting: false,
			advTrigger: false,
			entry: <?php  echo json_encode($reply)?> 
		};
		$scope.trigger = {};
		$scope.trigger.descriptions = {};
		$scope.trigger.descriptions.contains = '用户进行交谈时，对话中包含上述关键字就执行这条规则。';
		$scope.trigger.descriptions.regexp = '用户进行交谈时，对话内容符合述关键字中定义的模式才会执行这条规则。<br/><strong>注意：如果你不明白正则表达式的工作方式，请不要使用正则匹配</strong> <br/><strong>注意：正则匹配使用MySQL的匹配引擎，请使用MySQL的正则语法</strong> <br /><strong>示例: </strong><br/><em>^微信</em>匹配以“微信”开头的语句<br /><em>微信$</em>匹配以“微信”结尾的语句<br /><em>^微信$</em>匹配等同“微信”的语句<br /><em>微信</em>匹配包含“微信”的语句<br /><em>[0-9\.\-]</em>匹配所有的数字，句号和减号<br /><em>^[a-zA-Z_]$</em>所有的字母和下划线<br /><em>^[[:alpha:]]{3}$</em>所有的3个字母的单词<br /><em>^a{4}$</em>aaaa<br /><em>^a{2,4}$</em>aa，aaa或aaaa<br /><em>^a{2,}$</em>匹配多于两个a的字符串';
		$scope.trigger.descriptions.trustee = '如果没有比这条回复优先级更高的回复被触发，那么直接使用这条回复。<br/><strong>注意：如果你不明白这个机制的工作方式，请不要使用直接接管</strong>';
		$scope.trigger.labels = {};
		$scope.trigger.labels.contains = '包含关键字';
		$scope.trigger.labels.regexp = '正则表达式模式';
		$scope.trigger.labels.trustee = '直接接管操作';
		$scope.trigger.active = 'contains';
		$scope.trigger.items = {};
		$scope.trigger.items.default = '';
		$scope.trigger.items.contains = [];
		$scope.trigger.items.regexp = [];
		$scope.trigger.items.trustee = [];
		if($scope.reply.entry) {
			$scope.reply.entry.istop = $scope.reply.entry.displayorder >= 255 ? 1 : 0;
			//$scope.reply.advSetting = $scope.reply.entry.displayorder!=0 || !$scope.reply.entry.status;
			if($scope.reply.entry.keywords) {
				angular.forEach($scope.reply.entry.keywords, function(v, k){
					if(v.type == '1') {
						this.default += (v.content + ',');
					}
					if(v.type == '2') {
						this.contains.push({content: v.content, label: '请输入' + $scope.trigger.labels.contains, saved: true});
					}
					if(v.type == '3') {
						this.regexp.push({content: v.content, label: '请输入' + $scope.trigger.labels.regexp, saved: true});
					}
					if(v.type == '4') {
						this.trustee.push({});
					}
				}, $scope.trigger.items);
				if($scope.trigger.items.default.length > 1) {
					$scope.trigger.items.default = $scope.trigger.items.default.slice(0, $scope.trigger.items.default.length - 1);
				}
				if($scope.trigger.items.contains.length > 0 || $scope.trigger.items.regexp.length > 0 || $scope.trigger.items.trustee.length > 0) {
					$scope.reply.advTrigger = true;
				}
				if($scope.trigger.items.contains.length > 0) {
					$('a[data-toggle="tab"]').eq(0).tab('show');
					$scope.trigger.active = 'contains';
				} else if($scope.trigger.items.regexp.length > 0) {
					$('a[data-toggle="tab"]').eq(1).tab('show');
					$scope.trigger.active = 'regexp';
				} else if($scope.trigger.items.trustee.length > 0) {
					$('a[data-toggle="tab"]').eq(2).tab('show');
					$scope.trigger.active = 'trustee';
				}
			}
		}
		$scope.trigger.addItem = function(){
			var type = $scope.trigger.active;
			if(type != 'trustee') {
				$scope.trigger.items[type].push({content: '', label: '请输入' + $scope.trigger.labels[type], saved: false});
			} else {
				if($scope.trigger.items.trustee.length == 0) {
					$scope.trigger.items.trustee.push({type:4, content:''});
				}
			}
		};
		
		$scope.trigger.saveItem = function(item){
			item.saved = !item.saved;
		};
		$scope.trigger.removeItem = function(item) {
			var type = $scope.trigger.active;
			$scope.trigger.items[type] = _.without($scope.trigger.items[type], item);
			$scope.$digest();
		};
		$scope.trigger.test = function(item) {
		}
		if($.isFunction(window.initReplyController)) {
			window.initReplyController($scope, $http);
		}
		$('#reply-form').submit(function(){
			if($.trim($(':text[name="name"]').val()) == '') {
				util.message('必须输入回复规则名称');
				return false;
			}
			var val = [];
			$scope.$digest();
			if($scope.trigger.items.default != '') {
				var kws = $scope.trigger.items.default.replace('，', ',').split(',');
				kws = _.union(kws);
				angular.forEach(kws, function(v){
					if(v != '') {
						val.push({type: 1, content: v});
					}
				}, val);
			}
			angular.forEach($scope.trigger.items, function(v, name){
				var flag = true;
				if(name != 'default' && v.length > 0) {
					if(name == 'contains' || name == 'regexp'){
						angular.forEach(v, function(value){
							if(value.content.trim() != '') {
								this.push({
									content: value.content,
									type: name == 'contains' ? 2 : 3
								});
							}
						}, val);
					}
					if(name == 'trustee'){
						angular.forEach(v, function(value){
							this.push({type:4, content:''});
						}, val);
					}
				}
			}, val);
			if(val.length == 0 && $scope.trigger.active != 'trustee') {
				util.message('请输入有效的触发关键字.');
				return false;
			}
			$scope.$digest();
			val = angular.toJson(val);
			$(':hidden[name=keywords]').val(val);
			if($.isFunction(window.validateReplyForm)) {
				return window.validateReplyForm(this, $, _, util, $scope, $http);
			}
			return true;
		});
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			$scope.trigger.active = e.target.hash.replace(/#/, '');
			$scope.$digest();
		})
		util.emotion($("#keyword"), $("#keywordinput")[0], function(txt, elm, target){
			$scope.trigger.items.default = $(target).val();
			$scope.$digest();
		});
	}).filter('nl2br', function($sce){
		return function(text) {
			return text ? $sce.trustAsHtml(text.replace(/\n/g, '<br/>')) : '';
		};
	}).directive('ngInvoker', function($parse){
		return function (scope, element, attr) {
			scope.$eval(attr.ngInvoker);
		};
	}).directive('ngMyEditor', function(){
		var editor = {
			'scope' : {
				'value' : '=ngMyValue'
			},
			'template' : '<textarea id="editor" style="height:600px;width:100%;"></textarea>',
			'link' : function ($scope, element, attr) {
				if(!element.data('editor')) {
					editor = UE.getEditor('editor', ueditoroption);
					element.data('editor', editor);
					editor.addListener('contentChange', function() {
						$scope.value = editor.getContent().replace(/\&quot\;/g, '"');
						$scope.$root.$$phase || $scope.$apply('value');
					});
					$(element).parents('form').submit(function() {
						if (editor.queryCommandState('source')) {
							editor.execCommand('source');
						}
					});
					editor.addListener('ready', function(){
						if (editor && editor.getContent() != $scope.value) {
							editor.setContent($scope.value);
						}
						$scope.$watch('value', function (value) {
							if (editor && editor.getContent() != value) {
								editor.setContent(value ? value : '');
							}
						});
					});
				}
			}
		};
		return editor;
	});
	angular.bootstrap($('#js-reply-form')[0], ['app']);


	// 检测规则是否已经存在
	window.checkKeyWord = function(key) {
		var keyword = key.val().trim();
		if (keyword == '') {
			return false;
		}
		var type = key.attr('data-type');
		var wordIndex = key.index('.keyword');
		var isLeagl = true;
		$('.keyword').each(function(index) {
			var currentWord = $(this).val().trim();
			if (keyword == currentWord && wordIndex != index) {
				isLeagl = false;
				return false;
			}
		});
		if (isLeagl === false) {
			key.next().text('');
			util.message('该关键字已重复存在于当前规则中.');
			return false;
		}

		$.post(location.href, {keyword:keyword}, function(resp){
			if(resp != 'success') {
				var rid = $('input[name="rid"]').val();
				var rules = JSON.parse(resp);
				var url = "<?php  echo $this->createWebUrl('wxcardreply', array('op' => 'post'));?>";
				var ruleurl = '';
				for (rule in rules) {
					if (rid != rules[rule].id) {
						ruleurl += "<a href='" + url + "&rid=" + rules[rule].id + "' target='_blank'><strong class='text-danger'>" + rules[rule].name + "</strong></a>&nbsp;";
					}
				}
				if (ruleurl != '') {
					key.next().html('该关键字已存在于 ' + ruleurl + ' 规则中.');
				}
			} else {
				key.next().text('');
			}
		});
	}

	$('.keyword').each(function() {
		$(this).attr('data-type', 'keyword');
	});
});
</script>
<?php  } ?>

<?php  if($op == 'stat-trend') { ?>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;">关键指标详解</a></li>
</ul>
<div class="clearfix" id="clear">
	<div class="pull-left">
		<form action="" id="form1">
			<input type="hidden" name="c" value="site">
			<input type="hidden" name="a" value="entry">
			<input type="hidden" name="do" value="wxcardreply">
			<input type="hidden" name="op" value="stat-trend">
			<input type="hidden" name="id" value=<?php  echo $id;?>>
			<input type="hidden" name="m" value="we7_coupon">
			<?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d', $starttime),'endtime'=>date('Y-m-d', $endtime)));?>
		</form>
	</div>
	<div class="clearfix"></div>
	<br>
	<div class="panel panel-default" style="padding:1em">
		<nav role="navigation" class="navbar navbar-default navbar-static-top" style="margin: -1em -1em 1em -1em;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="javascript:;" class="navbar-brand">规则使用趋势图</a>
				</div>
			</div>
		</nav>
		<div style="margin-top:20px;">
			<canvas id="myChart" height="80"></canvas>
		</div>
	</div>
	<?php  if(is_array($keywords)) { foreach($keywords as $id => $row) { ?>
	<div class="panel panel-default" style="padding:1em">
		<nav role="navigation" class="navbar navbar-default navbar-static-top" style="margin: -1em -1em 1em -1em;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="javascript:;" class="navbar-brand">所属关键字使用趋势图&nbsp;&nbsp;&nbsp;<small>(关键字：<?php  echo $keywordnames[$id]['content'];?>)</small></a>
				</div>
			</div>
		</nav>
		<div style="margin-top:20px">
			<canvas id="trend_keyword_<?php  echo $id;?>" height="80"></canvas>
		</div>
	</div>
	<?php  } } ?>
</div>
<script>
	require({
		paths: {
			'chart': '../../../../addons/we7_coupon/template/style/js/chart.min'
		}
	})
	require(['chart', 'daterangepicker'], function(c){
		$('.daterange').on('apply.daterangepicker', function(ev, picker) {
			$('#form1')[0].submit();
		});
		var label = <?php  echo json_encode($day)?>;
		var datasets =  <?php  echo json_encode($hit)?>;
		var lineChartData = {
			labels : label,
			datasets : [
				{
					fillColor : "rgba(36,165,222,0.1)",
					strokeColor : "rgba(36,165,222,1)",
					pointColor : "rgba(36,165,222,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(36,165,222,1)",
					data : datasets
				}
			]
		}

		var myLine = new Chart(document.getElementById("myChart").getContext("2d")).Line(lineChartData, {responsive : true});

		<?php  if(is_array($keywords)) { foreach($keywords as $id => $row) { ?>
			var label = <?php  echo json_encode($row['day'])?>;
			var datasets = <?php  echo json_encode($row['hit'])?>;
			var lineChartData = {
				labels : label,
				datasets : [
					{
						fillColor : "rgba(149,192,0,0.1)",
						strokeColor : "rgba(149,192,0,1)",
						pointColor : "rgba(149,192,0,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(149,192,0,1)",
						data : datasets
					}
				]

			}

			var myLine = new Chart(document.getElementById("trend_keyword_<?php  echo $id;?>").getContext("2d")).Line(lineChartData, {responsive : true});
		<?php  } } ?>
	});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>