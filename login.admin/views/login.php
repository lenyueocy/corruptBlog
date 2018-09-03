<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<title>后台登录</title> 
<link href="views/css/login.css" type="text/css" rel="stylesheet"> 
</head> 
<body> 

<div class="login">
    <div class="message">后台管理登录界面</div>
    <div id="darkbannerwrap"></div>
    
    <form name="f" method="post" action="./index.php?action=login">
		<input name="action" value="login" type="hidden">
		<input name="user" placeholder="用户名" id="user" type="text">
		<hr class="hr15">
		<input name="pw" placeholder="密码" id="pw" type="password">
		<?php echo $ckcode; ?>
		<hr class="hr15">
		<input value="登录" style="width:100%;" type="submit" class="submit">
		<hr class="hr20">
		<center>«<a href="/">网站首页</a>&nbsp|&nbsp<a href="http://wiki.emlog.net/doku.php?id=chpwd">忘记密码</a>?
		<!-- 帮助 <a onClick="alert('请联系管理员')">忘记密码</a> -->
		<?php doAction('login_ext'); ?>
		<?php if ($error_msg): ?>
<div class="login-error"><?php echo $error_msg; ?></div>
<?php endif;?></center>
	</form>
	

	
</div>

<br/><div class="copyright">© 博客后台管理系统 By <a href="http://www.cnhack.me/" target="_blank">CnHack.Me</a></div>

</body>
</html>