<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-uncategorized">
	<header class="entry-header">
	<h1 class="entry-title"><?php echo $log_title; ?></h1>
	<p class="entry-census">
		发布于 <?php echo date('Y,m,d', $date);?>&nbsp;&nbsp;<?php echo $views; ?> 次阅读
	</p>
	<hr>
	</header><!-- .entry-header -->
	<div class="entry-content">
<?php echo $log_content; ?>
<?php doAction('log_related', $logData); ?>
	</div>
	<!-- .entry-content -->
	<footer class="post-footer">
	<div class="post-lincenses"><a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank" rel="nofollow">知识共享署名-非商业性使用-相同方式共享 4.0 国际许可协议</a></div>
	<?php blog_tag($logid) ?> 		
<div class="post-share">
<ul class="sharehidden">
	
	<li><a href="//connect.qq.com/widget/shareqq/index.html?url=<?php echo Url::log($logid);?>" onclick="window.open(this.href, 'weibo-share', 'width=730,height=500');return false;" class="s-qq"><img src="<?php echo TEMPLATE_URL; ?>images/sns/qzone.png"></a></li>
	<li><a href="//service.weibo.com/share/share.php?url=<?php echo Url::log($logid);?>&appkey=<?php echo $blogname; ?>&title=<?php echo $log_title; ?>&ralateUid=&language=zh_cn" onclick="window.open(this.href, 'weibo-share', 'width=550,height=235');return false;" class="s-sina"><img src="<?php echo TEMPLATE_URL; ?>images/sns/sina.png"></a></li>
	<li><a href="//shuo.douban.com/!service/share?href=<?php echo Url::log($logid);?>&name=<?php echo $log_title; ?>&text=" onclick="window.open(this.href, 'renren-share', 'width=490,height=600');return false;" class="s-douban"><img src="<?php echo TEMPLATE_URL; ?>images/sns/douban.png"></a></li>
	</ul>
	<i class="iconfont show-share"></i>
</div>
	</footer>
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