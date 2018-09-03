<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

<div id="msg"></div>
<?php if(isset($_GET['error_a'])):?>

 <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
只支持zip压缩格式的插件包!
                                  </h4>

                              </div>

<?php endif;?>
<?php if(isset($_GET['error_b'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      上传失败，插件目录(content/plugins)不可写!
                                  </h4>

                              </div>


<?php endif;?>
<?php if(isset($_GET['error_c'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      空间不支持zip模块，请按照提示手动安装插件!
                                  </h4>

                              </div>

<?php endif;?>
<?php if(isset($_GET['error_d'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
请选择一个zip插件安装包
                                  </h4>

                              </div>
<?php endif;?>
<?php if(isset($_GET['error_e'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      安装失败，插件安装包不符合标准!
                                  </h4>

                              </div>

<?php endif;?>

<?php if(isset($_GET['error_c'])): ?>

 <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
   <div style="margin:20px 10px;">
<div class="des">
手动安装插件： <br />
1、把解压后的插件文件夹上传到 content/plugins 目录下。<br />
2、登录后台进入插件管理,插件管理里已经有了该插件，点击激活即可。<br />
</div>
</div>

                              </div>


<?php endif; ?>

          <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-plus"></i> 插件安装
                </div>

                          <div class="panel-body">
                              <div class="tab-content">

<form action="./plugin.php?action=upload_zip" method="post" enctype="multipart/form-data" >
<div style="margin:50px 0px 50px 20px;">
	<li>
    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
	<input name="pluzip" type="file" />
	<br/>
            <input type="submit" value="上传安装" class="btn btn-primary" />（上传一个zip压缩格式的插件安装包）
	</li>
</div>
</form>
<div style="margin:10px 20px;">获取更多插件：<a href="store.php">应用中心&raquo;</a></div>


</div></div></div>
<script>
setTimeout(function(){$(".hideActived").remove();},2600);
$("#menu_plug").addClass('sidebarsubmenu1');
</script>