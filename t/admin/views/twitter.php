<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>




<?php if(isset($_GET['active_t'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
                                      发布成功!
</h4>
</div>



<?php endif;?>
<?php if(isset($_GET['active_set'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
设置保存成功!
</h4>
</div>



<?php endif;?>
<?php if(isset($_GET['active_del'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
                                      微语删除成功!
</h4>
</div>



<?php endif;?>
<?php if(isset($_GET['error_a'])):?>
 <div class="alert alert-success alert-block fade in hideActived">
<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i>
</button>
<h4>
<i class="icon icon-ok-sign"></i>
                                      微语内容不能为空!
</h4>
</div>



<?php endif;?>









              <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">微语</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>



    <section class="panel">

                          <div class="panel-body">
                              <div class="tab-content">


                                        <div id="tw">
    <div class="main_img"><a href="./blogger.php"><img src="<?php echo $avatar; ?>" height="52" width="52" /></a></div>
    <div class="right">
    <form method="post" action="twitter.php?action=post">

    <input type="hidden" name="img" id="imgPath" />

    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />

    <div class="msg">你还可以输入140字</div>

    <div class="box_1">
    <textarea  class="form-control  box" rows="3" placeholder="输入你想说的话" name="t" ></textarea>
    </div>
    <div class="tbutton btn ">
    <input type="submit"  value="发布" onclick="return checkt();"/> 
</div>
	<img class="twImg" id="face" style="margin-right: 10px;cursor: pointer;" src="./views/images/face.png">

    <div class="twImg" id="img_select"><input width="120" type="file" height="30" name="Filedata" id="custom_file_upload" style="display: none;"></div>

    <div id="img_name" class="twImg" style="display:none;">

        <a id="img_name_a" class="imgicon" href="javascript:;" onmouseover="$('#img_pop').show();" onmouseout="$('#img_pop').hide();">{图片名称}</a>

        <a href="javascript:;" onclick="unSelectFile()"> [取消]</a>

        <div id="img_pop"></div>



    <?php doAction('twitter_form'); ?>
</div>


    </form>
</div>                              
</div>                              
</div>    </section>                          

                      
               <div class="panel panel-default">




                          <div class="panel-body">
                              <div class="timeline-messages">
                                <?php
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? './views/images/avatar.jpg' : '../' . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $replynum = $Reply_Model->getReplyNum($tid);
    $hidenum = $replynum - $val['replynum'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?>  
                              
                                  <!-- Comment -->
                                  <div class="msg-time-chat">
                                      <a href="#" class="message-img"><img class="avatar" src="<?php echo $avatar; ?>" alt=""></a>
                                      <div class="message-body msg-in">
                                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"><a href="#"><?php echo $author; ?></a>在<?php echo $val['date'];?><a href="javascript: em_confirm(<?php echo $tid;?>, 'tw', '<?php echo LoginAuth::genToken(); ?>');" class="care" style="float:right">删除</a></p>
                                              <p><?php echo $val['t'];?> <br/><?php echo $img;?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /comment -->
    <?php endforeach;?>

                             


                              </div>
                          </div>                              </div>
                     
                  
            
                              </div>

                      <section class="panel">
                          <div class="panel-body">
                              <div class="pagination">
                                  <ul ><?php echo $pageurl;?> (有<?php echo $twnum; ?>条微语)
                               </ul>
                              </div>
                          </div>
                      </section>


    <div id="faceWraps"></div>

<script type="text/javascript" src="../include/lib/js/uploadify/jquery.uploadify.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript" src="./views/js/emo.js?v=<?php echo Option::EMLOG_VERSION; ?>""></script>
<script>
$(document).ready(function(){
    $(".post a").toggle(
      function () {
        tid = $(this).parent().attr('id');
        $("#r_" + tid).html('<p class="loading"></p>');
        $.get("twitter.php?action=getreply&tid="+tid+"&stamp="+timestamp(), function(data){
        $("#r_" + tid).html(data);
        $("#rp_"+tid).show();
      })},
      function () {
        tid = $(this).parent().attr('id');
        $("#r_" + tid).html('');
        $("#rp_"+tid).hide();
    });
    $(".box").keyup(function(){
       var t=$(this).val();
       var n = 140 - t.length;
       if (n>=0){
         $(".msg").html("你还可以输入"+n+"字");
       }else {
         $(".msg").html("<span style=\"color:#FF0000\">已超出"+Math.abs(n)+"字</span>");
       }
    });
    setTimeout(function(){$(".hideActived").remove();},2600);
    $("#sz_box").css('display', $.cookie('em_sz_box') ? $.cookie('em_sz_box') : '');
    $("#menu_tw").addClass('sidebarsubmenu1');
    $(".box").focus();
	
	$("#custom_file_upload").uploadify({
		id              : jQuery(this).attr('id'),
		swf             : '../include/lib/js/uploadify/uploadify.swf',
		uploader        : 'attachment.php?action=upload_tw_img',
		cancelImage     : './views/images/cancel.png',
		buttonText      : '选择图片',
		checkExisting   : "/",
		auto            : true,
		multi           : false,
		buttonCursor    : 'pointer',
		fileTypeExts    : '*.jpg;*.png;*.gif;*.jpeg',
		queueID         : 'custom-queue',
		queueSizeLimit	: 100,
		removeCompleted : false,
		fileSizeLimit	: 20971520,
		fileObjName     : 'attach',
		postData		: {<?php echo AUTH_COOKIE_NAME;?>:'<?php echo $_COOKIE[AUTH_COOKIE_NAME];?>'},
		onUploadSuccess : onUploadSuccess,
		onUploadError   : onUploadError
	});
	
	$("#face").click(function(e){
		var wrap = $("#faceWraps");
		if(!wrap.html()){
			var emotionsStr = [];
			$.each(emo,function(k,v){
				emotionsStr.push('<img style="cursor: pointer;padding: 3px;" title="'+k+'" src="./editor/plugins/emoticons/images/'+v+'"/>');
			});
			wrap.html(emotionsStr.join(""));
		}
		
		wrap.children().unbind('click').click(function () {
			var val= $("textarea").val();
			$("textarea").val((val||"")+$(this).attr("title"));
			$("textarea").focus();
		});

		var offset = $(this).offset();
		wrap.css({
			left : offset.left,
			top : offset.top
		});
		wrap.show();
		e.stopPropagation();
		e.preventDefault();
		$(document.body).unbind('click').click(function (e) {
			wrap.hide();
		});
		$(document).unbind('click').scroll(function (e) {
			wrap.hide();
		});
	});
});

function onUploadSuccess(file, data, response){
	var data = eval("("+data+")");
	if(data.filePath){
		$("#imgPath").val(data.filePath);
		$("#img_select").hide();
		$("#img_name").show();
		$("#img_name_a").text(file.name);
		$("#img_pop").html("<img src='"+data.filePath+"'/>");
	}else{
		alert("上传失败！");	
	}
}
function onUploadError(file, errorCode, errorMsg, errorString){
	alert(errorString);
}
function unSelectFile(){
	$.get("attachment.php?action=del_tw_img",{filepath:$("#imgPath").val()});
	$("#imgPath").val("");
	$("#img_select").show();
	$("#img_name").hide();
	$("#img_name_a").text("{图片名称}");
	$("#img_pop").empty();
}
function reply(tid, rp){
    $("#rp_"+tid+" textarea").val(rp);
    $("#rp_"+tid+" textarea").focus();
}
function doreply(tid){
    var r = $("#rp_"+tid+" textarea").val();
    var post = "r="+encodeURIComponent(r);
	$.post('twitter.php?action=reply&tid='+tid+"&stamp="+timestamp(), post, function(data){
		data = $.trim(data);
		if (data == 'err1'){
            $(".huifu span").text('回复长度需在140个字内');
		}else if(data == 'err2'){
		    $(".huifu span").text('该回复已经存在');
		}else{
    		$("#r_"+tid).append(data);
    		var rnum = Number($("#"+tid+" span").text());
    		$("#"+tid+" span").html(rnum+1);
    		$(".huifu span").text('')
    	}
	});
}
function delreply(rid,tid){
    if(confirm('你确定要删除该条回复吗？')){
        $.get("twitter.php?action=delreply&rid="+rid+"&tid="+tid+"&stamp="+timestamp(), function(data){
            var tid = Number(data);
            var rnum = Number($("#"+tid+" span").text());
            $("#"+tid+" span").text(rnum-1);
            if ($("#reply_"+rid+" span a").text() == '审核'){
                var rnum = Number($("#"+tid+" small").text());
                if(rnum == 1){$("#"+tid+" small").text('');}else{$("#"+tid+" small").text(rnum-1);}
            }
            $("#reply_"+rid).hide("slow");
        })}else {return;}
}
function hidereply(rid,tid){
    $.get("twitter.php?action=hidereply&rid="+rid+"&tid="+tid+"&stamp="+timestamp(), function(){
        $("#reply_"+rid).css('background-color','#FEE0E4');
        $("#reply_"+rid+" span a").text('审核');
        $("#reply_"+rid+" span a").attr("href","javascript: pubreply("+rid+","+tid+")");
        var rnum = Number($("#"+tid+" small").text());
        $("#"+tid+" small").text(rnum+1);
        });
}
function pubreply(rid,tid){
    $.get("twitter.php?action=pubreply&rid="+rid+"&tid="+tid+"&stamp="+timestamp(), function(){
        $("#reply_"+rid).css('background-color','#FFF');
        $("#reply_"+rid+" span a").text('隐藏');
        $("#reply_"+rid+" span a").attr("href","javascript: hidereply("+rid+","+tid+")");
        var rnum = Number($("#"+tid+" small").text());
        if(rnum == 1){$("#"+tid+" small").text('');}else{$("#"+tid+" small").text(rnum-1);}
        });
}
function checkt(){
	var t=$(".box").val();
    if (t.length > 140){return false;}
}
</script>
     
	   