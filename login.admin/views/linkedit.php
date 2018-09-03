<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
      <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-link"></i> 编辑链接
                </div>

                          <div class="panel-body">
                              <div class="tab-content">
<form action="link.php?action=update_link" method="post">
<div class="item_edit">
<label>名称<span class="required">*</span><label><br/>
	<li>
	<input size="40" value="<?php echo $sitename; ?>" class="form-control" name="sitename" /></li><br/>
	<label>地址<span class="required">*</span><label><br/>
	<li>
	
	<input size="40" value="<?php echo $siteurl; ?>" class="form-control" name="siteurl" /> </li>
	<br/>
	
	<label>图标<span class="required">*</span></label><br/><br/>
		<li><input size="40" value="<?php echo $sitepic; ?>" class="form-control" name="sitepic" /> </li><br/>
		
		<label>链接描述</label><br />
	<li><br/>
	<textarea name="description" rows="3" class="form-control" cols="42"><?php echo $description; ?></textarea></li>
	<li><br/>
	<input type="hidden" value="<?php echo $linkId; ?>" name="linkid" />
	<input type="submit" value="保 存" class="btn btn-primary" />
	<input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" /></li>
</div>
</form>
</div>
</div></div><script>
$("#menu_link").addClass('active');
</script>
