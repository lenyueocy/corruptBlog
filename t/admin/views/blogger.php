<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

        <?php if(isset($_GET['active_edit'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
个人资料修改成功!
</h4>
</div>
        
<?php endif;?>
    <?php if(isset($_GET['active_del'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
                                      头像删除成功!
</h4>
</div>
    
<?php endif;?>
    <?php if(isset($_GET['error_a'])):?>
     <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
昵称不能太长!
</h4>
</div>
    
<?php endif;?>
    <?php if(isset($_GET['error_b'])):?>
     <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
电子邮件格式错误
</h4>
</div>
    
<?php endif;?>
    <?php if(isset($_GET['error_c'])):?>
     <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
                                      密码长度不得小于6位!
</h4>
</div>
    
<?php endif;?>
    <?php if(isset($_GET['error_d'])):?>
     <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
两次输入的密码不一致!
</h4>
</div>
    
<?php endif;?>
    <?php if(isset($_GET['error_e'])):?>
    
     <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
                                      该登录名已存在!
</h4>
</div>
<?php endif;?>
    <?php if(isset($_GET['error_f'])):?>
     <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
                                      该昵称已存在!
</h4>
</div>
    
<?php endif;?>



            <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">个人设置</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>
        <section class="panel">
                          <header class="panel-heading tab-bg-dark-navy-blue ">
<?php if (ROLE == ROLE_ADMIN):?>


                              <ul class="nav nav-tabs">
                                  <li >
<a href="./configure.php">基本设置</a></li>
                                  <li>
<a href="./seo.php">SEO设置</a></li>
                                  
                                                                    <li class="active">
<a href="./blogger.php">个人设置</a></li>
                                  
                                  </ul>






<?php else:?>
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="./blogger.php">个人设置</a></li>
</ul>
<?php endif;?>


                                                            </header>
                          <div class="panel-body">
                              <div class="tab-content">



<form action="blogger.php?action=update" method="post" name="blooger" id="blooger" enctype="multipart/form-data">
<div class="form-group" style="margin-left:30px;">
    <li><?php echo $icon; ?><input type="hidden" name="photo" value="<?php echo $photo; ?>"/></li>
    <li>
    <label>头像(支持JPG、PNG格式图片)</label>
    <input name="photo" type="file" />
    </li>
    <li><label>昵称</label><input maxlength="50" style="width:200px;" class="form-control" value="<?php echo $nickname; ?>" name="name" /> </li>
    <li><label>邮箱</label><input name="email" class="form-control" value="<?php echo $email; ?>" style="width:200px;" maxlength="200" /></li>

    <li><label>个人描述</label><textarea name="description" class="form-control" style="width:300px; height:65px;" type="text" maxlength="500"><?php echo $description; ?></textarea></li>
    <li><label>登陆名</label><input maxlength="200" style="width:200px;" class="form-control" value="<?php echo $username; ?>" name="username" /></li>
    <li><label>新密码（不小于6位，不修改请留空）</label><input type="password" maxlength="200" class="form-control" style="width:200px;" value="" name="newpass" /></li>
    <li><label>再输入一次新密码</label><input type="password" maxlength="200" class="form-control" style="width:200px;" value="" name="repeatpass" /></li><br/>
    <li>
        <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
        <input type="submit" value="保存资料" class="btn btn-primary" />
    </li>
</div>
</form>
</div>
</div></section><script>
$("#chpwd").css('display', $.cookie('em_chpwd') ? $.cookie('em_chpwd') : 'none');
setTimeout(hideActived, 2600);
$("#menu_category_sys").addClass('active');
$("#menu_sys").addClass('in');
$("#menu_setting").addClass('active');
</script>