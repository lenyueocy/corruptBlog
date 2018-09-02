<?php 
/**
 * 给我留言
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="page-single">
    <div class="page-title" style="background-image:url(<?php echo TEMPLATE_URL; ?>img/page_bg.jpg);">
        <div class="container">
            <h1 class="title">
                给我留言
            </h1>
            <div class="page-dec"></div>
        </div>
    </div>
    <div class="container">
        <div class="page-content">
            <div class="link-title"><span>个人介绍</span></div>
            <ul class="link-items fontSmooth">
              <?php echo $log_content; ?>
            </ul>
        </div>
        	<div id="comments" class="clearfix">
	<div class="comments-box">
	<h3 class="comments-title">全部评论：</h3>
	<div id="loading-comments"><span><i class="icon-spin6 animate-spin"></i> 加载中...</span></div>
	<?php echo blog_comments($comments); ?>
	</div>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	</div>
</div>
    </div>

</div>
<?php include View::getView('footer');?>