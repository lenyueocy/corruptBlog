<?php if (!defined('EMLOG_ROOT')) {exit('error!');}?>
<script charset="utf-8" src="./editor/kindeditor.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script charset="utf-8" src="./editor/lang/zh_CN.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>

<span id="msg_2"></span>
<div id="msg"></div>

              <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">添加文章</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>
<form action="save_log.php?action=add" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
<!--文章内容-->

    <div class="containertitle">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-pencil"></i> 发表文章
                </div>

                          <div class="panel-body">
                              <div class="tab-content">

                      
                      

        

                             

                  
    

        <div id="post" class="form-group">
            <div>
                <input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-control" placeholder="文章标题" />
            </div>
            <div id="post_bar">
                <div class="show_advset">
                    <span onclick="displayToggle('FrameUpload', 0);autosave(1);">上传插入<i class="fa fa-caret-right fa-fw"></i></span>
	    <?php doAction('adm_writelog_head'); ?>
                    <span id="asmsg"></span>
	    <input type="hidden" name="as_logid" id="as_logid" value="-1">
                </div>
    <div id="FrameUpload" style="display: none;">
        <iframe width="860" height="330" frameborder="0" src="attachment.php?action=selectFile"></iframe>
    </div>
            </div>
            <div>
                <textarea id="content" name="content" style="width:100%; height:360px;"><?php echo $content; ?></textarea>
            </div>
            <div class="show_advset" onclick="displayToggle('advset', 1);">高级选项<i class="fa fa-caret-right fa-fw"></i></div>
            <div id="advset">
                <div>文章摘要：</div>
                <div><textarea id="excerpt" name="excerpt" style="width:100%; height:260px;"><?php echo $excerpt; ?></textarea></div>
            </div>
        </div>
   </div>
</div>
</div>
<!--文章侧边栏-->

        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-gear "></i> 设置项
                </div>

                          <div class="panel-body">
                              <div class="tab-content">
<div class=" container-side">



            <div class="form-group">
            <select name="sort" id="sort" class="form-control">
                    <option value="-1">选择分类...</option>
                    <?php
                    foreach ($sorts as $key => $value):
                        if ($value['pid'] != 0) {
                            continue;
                        }
                        $flg = $value['sid'] == $sortid ? 'selected' : '';
                        ?>
                        <option value="<?php echo $value['sid']; ?>" <?php echo $flg; ?>><?php echo $value['sortname']; ?></option>
                        <?php
                        $children = $value['children'];
                        foreach ($children as $key):
                            $value = $sorts[$key];
                            $flg = $value['sid'] == $sortid ? 'selected' : '';
                            ?>
                            <option value="<?php echo $value['sid']; ?>" <?php echo $flg; ?>>&nbsp; &nbsp; &nbsp; <?php echo $value['sortname']; ?></option>
                            <?php
                        endforeach;
                    endforeach;
                    ?>
            </select>
            </div>
            
            <div class="form-group">
            <label>标签：</label>
            <input name="tag" id="tag" class="form-control" value="<?php echo $tagStr; ?>" placeholder="文章标签，使用逗号分隔" />
            <span style="color:#2A9DDB;cursor:pointer;margin-right: 40px;"><a href="javascript:displayToggle('tagbox', 0);">已有标签+</a></span>
            <div id="tagbox" style="display: none;">
                <?php
                if ($tags) {
                    foreach ($tags as $val) {
                        echo " <a href=\"javascript: insertTag('{$val['tagname']}','tag');\">{$val['tagname']}</a> ";
                    }
                } else {
                    echo '还没有设置过标签！';
                }
                ?>
            </div>
            </div>

            <div class="form-group">
            <label>发布时间：</label>
            <input maxlength="200" name="postdate" id="postdate" value="<?php echo $postDate; ?>" class="form-control" />
            </div>
            
            <div class="form-group">
                <label>链接别名：</label>
                <input name="alias" id="alias" class="form-control" value="<?php echo $alias;?>" />
            </div>
            
            <div class="form-group">
                <label>访问密码：</label>
                <input type="text" name="password" id="password" class="form-control" value="<?php echo $password; ?>" />
            </div>
            
            <div class="form-group"  id="post_options">
        <input type="checkbox" value="y" name="top" id="top" />
            <label for="top">首页置顶</label>
		<input type="checkbox" value="y" name="sortop" id="sortop" />
            <label for="sortop">分类置顶</label>
        <input type="checkbox" value="y" name="allow_remark" id="allow_remark" checked="checked" />
            <label for="allow_remark">允许评论</label>
            </div>
        </div>
    </div>

    <div id="post_button">
    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
    <input type="hidden" name="ishide" id="ishide" value="">
       <input type="hidden" name="author" id="author" value=<?php echo UID; ?> />
       
        <input type="submit" value="发布文章" onclick="return checkform();" class="btn btn-primary" />
        <input type="button" name="savedf" id="savedf" value="保存草稿" onclick="autosave(2);" class="btn btn-success" />

        
    </div>
</div></div></div></div>
</form>
<script>
loadEditor('content');
loadEditor('excerpt');
$("#menu_wt").addClass('sidebarsubmenu1');
$("#advset").css('display', $.cookie('em_advset') ? $.cookie('em_advset') : '');
$("#alias").keyup(function(){checkalias();});
$("#title").focus(function(){$("#title_label").hide();});
$("#title").blur(function(){if($("#title").val() == '') {$("#title_label").show();}});
$("#tag").focus(function(){$("#tag_label").hide();});
$("#tag").blur(function(){if($("#tag").val() == '') {$("#tag_label").show();}});
setTimeout("autosave(0)",60000);
</script>