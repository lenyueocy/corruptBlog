<?php 
/* 
Custom:page-albnum
Description:个人相册
*/  
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container main-load">
    <article class="post_article" itemscope="" itemtype="https://schema.org/Article">
    	<?php echo $log_content; ?>
    </article>
</section>
<section class="comments">
<div class="container" data-no-instant="">
<?php blog_comments($comments); ?>
<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
</div>
</section>
<?php
 include View::getView('footer');
?>