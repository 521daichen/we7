<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix" ng-controller="memberProperty" id="memberProperty">
	<form action="" method="post" class="form-horizontal">
		<div class="panel panel-default">
			<div class="panel-heading">
				设置优惠券派发活动中的会员属性
			</div>
			<div class="panel-body">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">新用户</label>
				<div class="col-sm-9 col-xs-12">
					<select ng-model="newmember" class="form-control">
						<option value="{{num}}" ng-repeat="num in nums" ng-bind="num" ng-hide="oldmember <= num"></option>
					</select>
					<span class="help-block">单位为月，成为会员不超过该月，并且只消费过一次或没消费的用户。</span>
				</div>
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">老用户</label>
				<div class="col-sm-9 col-xs-12">
					<select ng-model="oldmember" class="form-control">
						<option value="{{num}}" ng-repeat="num in nums" ng-bind="num" ng-hide="newmember >= num"></option>
					</select>
					<span class="help-block">单位为月，成为会员超过该月的用户。</span>
				</div>
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">沉寂用户</label>
				<div class="col-sm-9 col-xs-12">
					<select ng-model="activitymember" class="form-control">
						<option value="{{num}}" ng-repeat="num in nums" ng-bind="num"></option>
					</select>
					<span class="help-block">单位为月，在月份内没有消费的用户。</span>
				</div>
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">活跃用户</label>
				<div class="col-sm-9 col-xs-12">
					<select ng-model="quietmember" class="form-control">
						<option value="{{num}}" ng-repeat="num in nums" ng-bind="num"></option>
					</select>
					<span class="help-block">单位为月，在月份内消费超过2次的用户。</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="button" name="submit" value="提交" class="btn btn-primary" ng-click="submit()"/>
			</div>
		</div>
	</form>
</div>
<script>
var nums = '<?php  echo $nums?>';
var property = '<?php  echo $property?>';
property = $.parseJSON(property);
nums = $.parseJSON(nums);
require(['angular'], function(angular){
	angular.module('app', []).controller('memberProperty', function($scope, $http){
		$scope.nums = nums;
		$scope.newmember = property.newmember;
		$scope.oldmember = property.oldmember;
		$scope.activitymember = property.activitymember;
		$scope.quietmember = property.quietmember;
		// $scope.$watch('oldmember', function(newVal, oldVal) {
		// 	console.log(newVal)
		// });
		$scope.submit = function() {
			if (!$scope.newmember || !$scope.oldmember || !$scope.activitymember || !$scope.quietmember) {
				util.message('请填写完整信息');
				return;
			}
			$http.post(location.href, {newmember : $scope.newmember, oldmember : $scope.oldmember, activitymember : $scope.activitymember, quietmember : $scope.quietmember}).success(function(data) {
				if (data.message.errno == 0) {
					util.message('设置成功', '', 'success');
				} else {
					util.message(data.message.message, '', 'error');
				}
			});
		}
	});

	angular.bootstrap($('#memberProperty')[0], ['app']);	
});

</script>
