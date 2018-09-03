<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-comment"></i> 评论编辑                </div>

                          <div class="panel-body">
                              <div class="tab-content">

<form action="comment.php?action=doedit" method="post">
<div class="item_edit">
<label>评论人</label>
    <li><input type="text" value="<?php echo $poster; ?>" name="name" style="width:200px;" class="form-control" /> </li>
    <label>电子邮件</label>
    <li><input type="text"  value="<?php echo $mail; ?>" name="mail" style="width:200px;" class="form-control" /> </li>
    <label>主页</label>
    <li><input type="text"  value="<?php echo $url; ?>" name="url" style="width:200px;" class="form-control" /> </li><br/>
    
    <li>
    

    <textarea name="comment" rows="8" cols="60" class="form-control"><?php echo $comment; ?></textarea></li>
    <input type="hidden" value="<?php echo $cid; ?>" name="cid" />
    <br/>
    <input type="submit" value="保 存" class="btn btn-primary" />
    <input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" /></li>
</div>
</form>
</div></div></div>
<script>
$("#menu_cm").addClass('active');
</script>
