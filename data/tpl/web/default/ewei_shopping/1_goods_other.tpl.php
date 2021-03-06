<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品类型</label>
	<div class="col-sm-9 col-xs-12">
		<label for="isshow3" class="radio-inline"><input type="radio" name="type" value="1" id="isshow3" <?php  if(empty($item['type']) || $item['type'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#product').show()" /> 实体商品</label>&nbsp;&nbsp;&nbsp;<label for="isshow4" class="radio-inline"><input type="radio" name="type" value="2" id="isshow4"  <?php  if($item['type'] == 2) { ?>checked="true"<?php  } ?>  onclick="$('#product').hide()" /> 虚拟商品</label>
	</div>
</div>
<div class="form-group">
	<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否上架</label>
	<div class="col-sm-9 col-xs-12">
		<label for="isshow1" class="radio-inline"><input type="radio" name="status" value="1" id="isshow1" <?php  if($item['status'] == 1 || !$item['status']) { ?>checked="true"<?php  } ?> /> 是</label>
		&nbsp;&nbsp;&nbsp;
		<label for="isshow2" class="radio-inline"><input type="radio" name="status" value="0" id="isshow2"  <?php  if($item['status'] && $item['status'] === 0) { ?>checked="true"<?php  } ?> /> 否</label>
		<span class="help-block"></span>
	</div>
</div>
<div class="form-group">
	<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
	<div class="col-sm-9 col-xs-12">
		<input type="text" name="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
	</div>
</div>