<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-uncategorized">
	<header class="entry-header">
	<h1 class="entry-title"><?php echo $log_title; ?></h1>
	<p class="entry-census">
		发布于 <?php echo date('Y,m,d', $date);?>
	</p>
	<hr>
	</header><!-- .entry-header -->
	<div class="entry-content">
<?php echo $log_content; ?>
<?php doAction('log_related', $logData); ?>
	</div>
	<!-- .entry-content -->

	</article><!-- #post-## -->
	<section class="author-profile">
	<div class="info" itemprop="author" itemscope="" itemtype="">
		<a href="<?php echo BLOG_URL; ?>" class="profile gravatar"><img src="<?php echo _g("Siren_tx");?>" itemprop="image" alt="admin" height="70" width="70"></a>
		<div class="meta">
			<span class="title">Author</span>
			<h3 itemprop="name">
			<a href="<?php echo BLOG_URL; ?>" itemprop="url" rel="author"><?php echo _g("Siren_name");?></a>
			</h3>
		</div>
	</div>
	<hr>
	<p>
		<i class="iconfont"></i><?php echo _g("Siren_qm");?>
	</p>
	</section>
	</main><!-- #main -->
</div>

<section id="comments" class="comments">

		<div class="commentwrap comments-hidden" style="display: block;">
			<div class="notification"><i class="iconfont"></i>查看评论 -
			<span class="noticom"><?php echo $comnum; ?> 条评论 </span>
			</div>
		</div>

		<div class="comments-main" style="display: none;">
		<h3 id="comments-list-title">Comments | <span class="noticom"><?php echo $comnum; ?> 条评论 </span></h3> 
<?php blog_comments($comments,$params); ?>		 
							
	

<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>

	
		</div>


	</section>
<?php
 include View::getView('footer');
?>