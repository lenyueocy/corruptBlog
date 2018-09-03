<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
 
<?php if(isset($_GET['activate_install'])):?>

           <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
插件上传成功，请激活使用!
                                  </h4>

                              </div>

<?php endif;?>
<?php if(isset($_GET['active'])):?>
           <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      插件激活成功!
                                  </h4>

                              </div>

<?php endif;?>
<?php if(isset($_GET['activate_del'])):?>
           <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      删除成功!
                                  </h4>

                              </div>

<?php endif;?>
<?php if(isset($_GET['active_error'])):?>
           <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      插件激活失败!
                                  </h4>

                              </div>

<?php endif;?>
<?php if(isset($_GET['inactive'])):?>
           <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
插件禁用成功!
                                  </h4>

                              </div>
<?php endif;?>
<?php if(isset($_GET['error_a'])):?>
           <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      删除失败，请检查插件文件权限!
                                  </h4>

                              </div>
<?php endif;?>
              <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">插件管理</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>

                      <section class="panel">
                          <header class="panel-heading tab-bg-dark-navy-blue ">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#">插件管理</a>
                                  </li>
                                  </ul>
                                                            </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  
    <table class="table table-striped table-bordered table-hover dataTable no-footer">
  <thead>
      <tr>
        <th width="200">名称</th>
        <th width="40" class="tdcenter"><b>状态</b></th>
        <th width="60" class="tdcenter"><b>版本</b></th>
        <th width="450" class="tdcenter"><b>描述</b></th>
        <th width="60" class="tdcenter">操作</th>
      </tr>
  </thead>
  <tbody>                    

               <?php 
    if($plugins):
    $i = 0;
    foreach($plugins as $key=>$val):
        $plug_state = 'inactive';
        $plug_action = 'active';
        $plug_state_des = '点击激活插件';
        if (in_array($key, $active_plugins))
        {
            $plug_state = 'active';
            $plug_action = 'inactive';
            $plug_state_des = '点击禁用插件';
        }
        $i++;
        if (TRUE === $val['Setting']) {
            $val['Name'] = "<a href=\"./plugin.php?plugin={$val['Plugin']}\" title=\"点击设置插件\">{$val['Name']} <img src=\"./views/images/set.png\" border=\"0\" /></a>";
        }
    ?>	
      <tr>
      
          <td class="tdcenter"><?php echo $val['Name']; ?></td>
        <td class="tdcenter" id="plugin_<?php echo $i;?>">
        <a href="./plugin.php?action=<?php echo $plug_action;?>&plugin=<?php echo $key;?>&token=<?php echo LoginAuth::genToken(); ?>"><img src="./views/images/plugin_<?php echo $plug_state; ?>.gif" title="<?php echo $plug_state_des; ?>" align="absmiddle" border="0"></a>
        </td>



        <td class="tdcenter">
        <?php echo $val['Version']; ?></td>
        <td>
        <?php echo $val['Description']; ?>
        <?php if ($val['Url'] != ''):?><a href="<?php echo $val['Url'];?>" target="_blank">更多信息&raquo;</a><?php endif;?>
        <div style="margin-top:5px;">
        <?php if ($val['ForEmlog'] != ''):?>适用于emlog：<?php echo $val['ForEmlog'];?>&nbsp | &nbsp<?php endif;?>
        <?php if ($val['Author'] != ''):?>
        作者：<?php if ($val['AuthorUrl'] != ''):?>
            <a href="<?php echo $val['AuthorUrl'];?>" target="_blank"><?php echo $val['Author'];?></a>
            <?php else:?>
            <?php echo $val['Author'];?>
            <?php endif;?>
        <?php endif;?>
        </div>



        </td>
        <td class="tdcenter">
            <a href="javascript: em_confirm('<?php echo $key; ?>', 'plu', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a>
        </td>


      </tr>
      
      
      
      
    
    <?php endforeach;else: ?>
      <tr>
        <td class="tdcenter" colspan="5">还没有安装插件</td>
      </tr>
    <?php endif;?>






    </tbody>
      </table>      
                      
           
<a href="./plugin.php?action=install" class="btn btn-success">安装插件+</a>           


</div></div></section>


<script>
$("#adm_plugin_list tbody tr:odd").addClass("tralt_b");
$("#adm_plugin_list tbody tr")
	.mouseover(function(){$(this).addClass("trover")})
	.mouseout(function(){$(this).removeClass("trover")})
setTimeout(function(){$(".hideActived").remove();},2000);
$("#menu_plug").addClass('sidebarsubmenu1');
</script>
