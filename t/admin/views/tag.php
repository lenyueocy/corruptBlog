<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>


<?php if(isset($_GET['active_del'])):?>

<div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
                                      删除标签成功
                                  </h4>

                              </div>




<?php endif;?>
<?php if(isset($_GET['active_edit'])):?>
<div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
修改标签成功
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
                                      请选择要删除的标签
                                  </h4>

                              </div>




<?php endif;?>

              <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">标签管理</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>
            
            
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-tag"></i> 标签管理
                </div>

                          <div class="panel-body">
                              <div class="tab-content">
                                  
<form action="tag.php?action=dell_all_tag" method="post" name="form_tag" id="form_tag">


<ul class="tagx">
<li  >
<?php 
if($tags):
foreach($tags as $key=>$value): ?>	
<input type="checkbox" name="tag[<?php echo $value['tid']; ?>]" class="ids" value="1" >
<a href="tag.php?action=mod_tag&tid=<?php echo $value['tid']; ?>"><?php echo $value['tagname']; ?></a> &nbsp;&nbsp;&nbsp;
<?php endforeach; ?>
</li>
</ul>

<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
<div style="margin:20px 0px">
<a href="javascript:void(0);" id="select_all">全选</a> 选中项：
<a href="javascript:deltags();" class="care">删除</a>
</div>
<?php else:?>
<li style="margin:20px 30px">还没有标签，写文章的时候可以给文章打标签</li>
<?php endif;?>
</div>
</form>
</div>
</div></div><script>
$("#select_all").toggle(function () {$(".ids").attr("checked", "checked");},function () {$(".ids").removeAttr("checked");});
function deltags(){
	if (getChecked('ids') == false) {
		alert('请选择要删除的标签');
		return;
	}
	if(!confirm('你确定要删除所选标签吗？')){return;}
	$("#form_tag").submit();
}
setTimeout(function(){$(".hideActived").remove();},2600);
$("#menu_tag").addClass('sidebarsubmenu1');
</script>