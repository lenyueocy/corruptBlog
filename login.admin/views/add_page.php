<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script charset="utf-8" src="./editor/kindeditor.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script charset="utf-8" src="./editor/lang/zh_CN.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./tinymce/js/tinymce.min.js" type="text/javascript"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 460,
        theme: 'modern',
        language: 'zh_CN',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true,
    });
</script>
<span id="msg_2"></span>
<div id="msg"></div>



              <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">添加页面</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>

                      
                      
<form action="page.php?action=save" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
<!--文章内容-->
    <div class="containertitle">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-pencil "></i> 新建页面
                </div>

                          <div class="panel-body">
                              <div class="tab-content">

        <div id="post" class="form-group">
            <div>
                <input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-control" placeholder="页面标题" />
            </div>
            <div id="post_bar">
                <div>
                    <span onclick="displayToggle('FrameUpload', 0);autosave(4);" class="show_advset">上传插入</span>
	    <?php doAction('adm_writelog_head'); ?>
	    <span id="asmsg"></span>
	    <input type="hidden" name="as_logid" id="as_logid" value="-1">
    </div>
    <div id="FrameUpload" style="display: none;">
        <iframe width="860" height="330" frameborder="0" src="attachment.php?action=selectFile"></iframe>
    </div>
            </div>
            <div>
                <textarea id="content" name="content" style="width:100%; height:460px;"><?php echo $content; ?></textarea>
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
                <label>链接别名：</label>
                <input name="alias" id="alias" class="form-control" value="<?php echo $alias;?>" />
            </div>
            
            <div class="form-group">
                <label>页面模板：</label>
                <input name="template" id="template" class="form-control" value="<?php echo $template;?>" />
            </div>
            
            <div class="form-group"  id="page_options">
        <input type="checkbox" value="y" name="allow_remark" id="allow_remark" />
            <label for="allow_remark">允许评论</label>
            </div>
           
        </div>
    </div>

    <div id="post_button">
    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
    <input type="hidden" name="ishide" id="ishide" value="">
        <input type="submit" value="发布页面" onclick="return checkform();" class="btn btn-primary" />
        <input type="button" name="savedf" id="savedf" value="保存" onclick="autosave(3);" class="btn btn-success" />

        
    </div>
</div>
</form>
<script>
//loadEditor('content');
$("#menu_page").addClass('sidebarsubmenu1');
$("#alias").keyup(function(){checkalias();});
$("#title").focus(function(){$("#title_label").hide();});
$("#title").blur(function(){if($("#title").val() == '') {$("#title_label").show();}});
</script>