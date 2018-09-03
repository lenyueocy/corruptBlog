<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>



<?php if(isset($_GET['error_login'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
用户名不能为空
</h4>
</div>
<?php endif;?>
<?php if(isset($_GET['error_exist'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
该用户名已存在!
</h4>
</div>
<?php endif;?>
<?php if(isset($_GET['error_pwd_len'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
密码长度不得小于6位!
</h4>
</div>
<?php endif;?>
<?php if(isset($_GET['error_pwd2'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
两次输入密码不一致
</h4>
</div>
<?php endif;?>




     <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-user "></i> 修改资料
                </div>

                          <div class="panel-body">
                              <div class="tab-content">

<form action="user.php?action=update" method="post">
<div class="form-group">
	<li><label>用户名</label><input type="text" value="<?php echo $username; ?>" name="username" style="width:200px;" class="form-control" /></li>
	<li><label>昵称</label><input type="text" value="<?php echo $nickname; ?>" name="nickname" style="width:200px;" class="form-control" /></li>
	<li><label>新密码(不修改请留空)</label><input type="password" value="" name="password" style="width:200px;" class="form-control" /> </li>
	<li><label>重复新密码</label><input type="password" value="" name="password2" style="width:200px;" class="form-control" /> </li>
	<li><label>电子邮件</label><input type="text"  value="<?php echo $email; ?>" name="email" style="width:200px;" class="form-control" /> </li>
        <li><label>QQ号</label><input type="text"  value="<?php echo $qq; ?>" name="qq" style="width:200px;" class="form-control"  /> </li>
    <li><label>网站</label><input type="text"  value="<?php echo $url1; ?>" name="url1" style="width:300px;" class="form-control"  /> </li>
    <li><label>QQ微博</label><input type="text"  value="<?php echo $url2; ?>" name="url2" style="width:300px;" class="form-control"  /></li>
    <li><label> 新浪微博</label><input type="text"  value="<?php echo $url3; ?>" name="url3" style="width:300px;" class="form-control"  /></li>
   <br/> <li>
	<select name="role" id="role" class="form-control">
		<option value="writer" <?php echo $ex1; ?>>作者</option>
		<option value="admin" <?php echo $ex2; ?>>管理员</option>
	</select>
	</li><br/>
    <li id="ischeck">
	<select name="ischeck" class="form-control">
        <option value="n" <?php echo $ex3; ?>>文章不需要审核</option>
		<option value="y" <?php echo $ex4; ?>>文章需要审核</option>
	</select>
	</li><br/>
	<li><label>个人描述</label><br />
	<textarea name="description" rows="5" style="width:260px;" class="form-control"><?php echo $description; ?></textarea></li>
	<li><br/>
    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
	<input type="hidden" value="<?php echo $uid; ?>" name="uid" />
	<input type="submit" value="保 存" class="btn btn-primary" />
	<input type="button" value="取 消" class="btn btn-default" onclick="window.location='user.php';" /></li>
</div>
</form>
<script>
setTimeout(function(){$(".hideActived").remove();},2600);
$("#menu_user").addClass('active');
if($("#role").val() == 'admin') $("#ischeck").hide();
$("#role").change(function(){$("#ischeck").toggle()})
</script>