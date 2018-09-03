<?php if (!defined('EMLOG_ROOT')) {exit('error!');}?>

<a name="tpllib"></a>
<?php if(isset($_GET['activate_install'])):?>
  <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      模板上传成功!
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
                                      删除模板成功!
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
                                      删除失败，请检查模板文件权限!
                                  </h4>

                              </div>

<?php endif;?>

              <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">模板管理</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>

        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-trello"></i> 模板选择
                </div>

                          <div class="panel-body">
                              <div class="tab-content">
<div class="tpl  containertitle2"  id="container">

<table cellspacing="0" cellpadding="0" width="99%" border="0" class="adm_tpl_list">

<?php 
$i = 0;
foreach($tpls as $key=>$value):
if($i % 3 == 0){echo "<tr>";}
$i++;
?>


   <td align="center" width="300">
	  <a href="template.php?action=usetpl&tpl=<?php echo $value['tplfile']; ?>&side=<?php echo $value['sidebar']; ?>&token=<?php echo LoginAuth::genToken(); ?>">
	  <img alt="点击使用该模板" src="<?php echo TPLS_URL.$value['tplfile']; ?>/preview.jpg" width="180" height="150" border="0" />
	  </a><br />
	      <li class="title <?php if($nonce_templet == $value['tplfile']){echo "active";} ?>">
	  
      <?php echo $value['tplname']; ?>
      <span> | <a href="javascript: em_confirm('<?php echo $value['tplfile']; ?>', 'tpl', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a></span></li>
      </td>
      


<?php 
if($i > 0 && $i % 3 == 0){echo " </tr>";}
endforeach; 
?>       

        <td class="add">
            <a href="template.php?action=install">
                <div class="theme-screenshot"><span></span></div>
                <h3 class="theme-name">添加模板</h3>
            </a>
        </td>
        </table>
        
        
</div>
</div>
</div>

<script>
setTimeout(function(){$(".hideActived").remove();},2600);

$("#menu_tpl").addClass('sidebarsubmenu1');
</script>