<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

         <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">安装应用</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>


       <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-plus"></i> 安装<?php echo $source_typename;?>
                </div>

                          <div class="panel-body">
                              <div class="tab-content">


<div id="addon_ins"><span class="ajaxload"><?php echo $source_typename;?>正在下载安装中</span></div>
</div>
</div>
</div>
<script>
$("#menu_store").addClass('sidebarsubmenu1');
$(document).ready(function(){
    $.get('./store.php', {action:'addon', source:"<?php echo $source;?>", type:"<?php echo $source_type;?>" },
      function(data){
        if (data.match("succ")) {
            $("#addon_ins").html('<span id="addonsucc"><?php echo $source_typename;?>安装成功，<?php echo $source_typeurl;?></span>');
        } else if(data.match("error_down")){
            $("#addon_ins").html('<span id="addonerror"><?php echo $source_typename;?>下载失败，可能是服务器网络问题，请手动下载安装，<a href="store.php">返回应用中心</a></span>');
        } else if(data.match("error_zip")){
            $("#addon_ins").html('<span id="addonerror"><?php echo $source_typename;?>安装失败，可能是你的服务器空间不支持zip模块，请手动下载安装，<a href="store.php">返回应用中心</a></span>');
        } else if(data.match("error_dir")){
            $("#addon_ins").html('<span id="addonerror"><?php echo $source_typename;?>安装失败，可能是应用目录不可写，<a href="store.php">返回应用中心</a></span>');
        }else{
            $("#addon_ins").html('<span id="addonerror"><?php echo $source_typename;?>安装失败，<a href="store.php">返回应用中心</a></span>');
        }
      });
})
</script>