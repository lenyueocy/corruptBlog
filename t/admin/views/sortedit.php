<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

<?php if(isset($_GET['error_a'])):?>
        <div class="alert alert-success alert-block fade in hideActived">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <h4>
                                      <i class="icon icon-ok-sign"></i>
分类名称不能为空!
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
别名格式错误!
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
别名不能重复
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
别名不得包含系统保留关键字
                                  </h4>

                              </div>

<?php endif;?>

     <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-list"></i> 分类编辑
                </div>

                          <div class="panel-body">
                              <div class="tab-content">


<form action="sort.php?action=update" method="post" class="form-inline">
<div class="form-group">
    <li>
    <label>名称</label><br/>
        <input style="width:200px;" value="<?php echo $sortname; ?>" name="sortname" id="sortname" class="form-control" />
        
    </li>
    <li>
    <label>别名</label><br/>
        <input style="width:200px;" value="<?php echo $alias; ?>" name="alias" id="alias" class="form-control" />
        
    </li>
    <?php if (empty($sorts[$sid]['children'])): ?>
    <li>
            <label>父分类</label><br/>
        <select name="pid" id="pid" class="form-control" style="width:200px;">
            <option value="0"<?php if($pid == 0):?> selected="selected"<?php endif; ?>>无</option>
            <?php
                foreach($sorts as $key=>$value):
                    if ($key == $sid || $value['pid'] != 0) continue;
            ?>
            <option value="<?php echo $key; ?>"<?php if($pid == $key):?> selected="selected"<?php endif; ?>><?php echo $value['sortname']; ?></option>
            <?php endforeach; ?>
        </select>

    </li>
    <?php endif; ?>
    <label>模板 (用于自定义分类页面模板，对应模板目录下.php文件)</label><br/>
    <li><input maxlength="200" style="width:200px;" class="form-control" name="template" id="template" value="<?php echo $template; ?>" /> </li>
    <br/>
    <li>
        <textarea name="description" type="text" style="width:360px;height:80px;overflow:auto;" class="form-control" placeholder="分类描述"><?php echo $description; ?></textarea>
    </li><br/>
    <li>
   
    <input type="hidden" value="<?php echo $sid; ?>" name="sid" />
    <input type="submit" value="保 存" class="btn btn-primary" id="save"  />
    <input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" />
    <span id="alias_msg_hook"></span>
    </li>
</div>
</form>


</div>

</div></div>
<script>
$("#menu_sort").addClass('active');
$("#alias").keyup(function(){checksortalias();});
function issortalias(a){
    var reg1=/^[\w-]*$/;
    var reg2=/^[\d]+$/;
    if(!reg1.test(a)) {
        return 1;
    }else if(reg2.test(a)){
        return 2;
    }else if(a=='post' || a=='record' || a=='sort' || a=='tag' || a=='author' || a=='page'){
        return 3;
    } else {
        return 0;
    }
}
function checksortalias(){
    var a = $.trim($("#alias").val());
    if (1 == issortalias(a)){
        $("#save").attr("disabled", "disabled");
        $("#alias_msg_hook").html('<span id="input_error">别名错误，应由字母、数字、下划线、短横线组成</span>');
    }else if (2 == issortalias(a)){
        $("#save").attr("disabled", "disabled");
        $("#alias_msg_hook").html('<span id="input_error">别名错误，不能为纯数字</span>');
    }else if (3 == issortalias(a)){
        $("#save").attr("disabled", "disabled");
        $("#alias_msg_hook").html('<span id="input_error">别名错误，与系统链接冲突</span>');
    }else {
        $("#alias_msg_hook").html('');
        $("#msg").html('');
        $("#save").attr("disabled", false);
    }
}
setTimeout(function(){$(".hideActived").remove();},2600);
</script>