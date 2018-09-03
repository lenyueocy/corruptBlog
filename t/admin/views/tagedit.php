<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

<?php if(isset($_GET['error_a'])):?>

     <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
标签不能为空
                                  </h4>

                              </div>


<?php endif;?>




     <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-tag "></i> 标签编辑
                </div>

                          <div class="panel-body">
                              <div class="tab-content">


<form  method="post" action="tag.php?action=update_tag" class="form-inline">
<div class="form-group">
    <li><input size="40" value="<?php echo $tagname; ?>" name="tagname" class="form-control" /></li>
    <li style="margin:10px 0px">
    <input type="hidden" value="<?php echo $tagid; ?>" name="tid" />
    <input type="submit" value="保 存" class="btn btn-primary" />
    <input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.location='tag.php';"/>
    </li>
</div>
</form>
                              </div>
                          </div>
                          </div>

<script>
$("#menu_tag").addClass('active');
setTimeout(function(){$(".hideActived").remove();},2600);
</script>
