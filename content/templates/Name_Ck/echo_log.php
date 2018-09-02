<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div id="page-content">
<div class="container">
<div class="row">
<div class="article col-xs-12 col-sm-8 col-md-8">
<div class="post-timthumb" style="background-image: url(<?php echo TEMPLATE_URL."img/ap".rand(0,10).".jpg"; ?>);"><h1><?php topflg($top); ?><?php echo $log_title; ?></h1></div><div class="post">
<div class="post-title">
<div class="post-entry-categories"><?php echo blog_tag($logid); ?></div><div class="post_icon">
<span class="postauthor"><img alt="" src="//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo _g('qq');?>&src_uin=www.yankj.com&fid=blog&spec=100" class="avatar avatar-96 photo" style="display: inline-block;" width="96" height="96"><?php blog_author($author); ?></span> 
<span class="postoriginal"><i class="icon-cc-1"></i>原创</span>
<span class="postcat"><i class=" icon-list-2"></i> <?php blog_sort($logid); ?></span>
<span class="postclock"><i class="icon-clock-1"></i> <?php echo gmdate('Y-n-j', $date); ?></span>
<span class="posteye"><i class="icon-eye-4"></i><?php echo $views; ?></span>
<span class="postcomment"><a href="#comments" title="评论"><i class="icon-comment-4"></i> </a><a href="#comments"><?php echo $comnum; ?></a></span>
<?php echo checkbaidu($logid);?>
</div>
</div>
<div class="post-content">
<?php echo $log_content; ?>
<?php doAction('log_related', $logData); ?>
</div>
</div>
  <div class="post-declare">
                    <p>原创文章，作者：<?php blog_author($author); ?>，如若转载，请注明出处：<a href="<?php echo Name_curPageURL(); ?>">《<?php echo $log_title; ?>》</a></p>
                </div>
<div class="next-prev-posts clearfix">
<div class="prev-post" style="width:100%;">

<?php neighbor_log($neighborLog); ?>
</div> 
</div>
<div id="comments" class="clearfix">
<?php if($comnum){ ?>
<div class="comments-box">
<h3 class="comments-title">全部评论：</h3>
<div id="loading-comments"><span><i class="icon-spin6 animate-spin"></i> 加载中...</span></div> 
<?php echo blog_comments($comments); ?>
</div>
 <?php } ?> 
<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
</div>
</div>
<div class="article col-xs-12 col-sm-8 col-md-4 sidebar">
<?php require_once View::getView('side');?>
</div></div></div>
</div>
</div>
</div>
<?php $output = ob_get_clean();$output = preg_replace("|\[:([^#]+)#(\d+):\]|i",'<img border="0" src="'.TEMPLATE_URL.'images/face/$1/$2.gif" />',$output);ob_start();echo $output;?>
<?php
 include View::getView('footer');
?>