<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>


<?php if(isset($_GET['error_a'])):?>
     <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
只支持zip压缩格式的模板包
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
                                      上传失败，模板目录(content/templates)不可写!
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
                                      空间不支持zip模块，请按照提示手动安装模板!
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
                                      请选择一个zip模板安装包!
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
                                      安装失败，模板安装包不符合标准!
                                  </h4>

                              </div>

<?php endif;?>
</div>
<?php if(isset($_GET['error_c'])): ?>

     <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
<div style="margin:20px 20px;">
<div class="des">
手动安装模板： <br />
1、把解压后的模板文件夹上传到 content/templates目录下。 <br />
2、登录后台换模板，模板库中已经有了你刚才添加的模板，点击使用即可。 <br />
</div>
</div>

                              </div>

<?php endif; ?>


  <section class="panel">
                          <header class="panel-heading tab-bg-dark-navy-blue ">
                              <ul class="nav nav-tabs">
                                  <li>
                                      <a  href="./template.php">当前模板</a>
                                  </li>
                                    <li class="active">
                                      <a href="./template.php?action=install">安装模板</a>
                                  </li>

                                  </ul>
                                                            </header>
                          <div class="panel-body">
                              <div class="tab-content ">
                                  

<form action="./template.php?action=upload_zip" method="post" enctype="multipart/form-data" >
<div style="margin:50px 0px 50px 20px;">
    <p>上传一个zip压缩格式的模板安装包</p>
    <p>
    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
    <input name="tplzip" type="file" />
    </p>
    <p>
    <input type="submit" value="上传安装" class="btn btn-primary" />
    </p>
</div>
</form>

<div style="margin:10px 20px;">获取更多模板：<a href="store.php">应用中心&raquo;</a></div>

</div></div></section>

<script>
setTimeout(function(){$(".hideActived").remove();},2600);
$("#menu_tpl").addClass('sidebarsubmenu1');
</script>