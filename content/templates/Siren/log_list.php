<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<h1 class="main-title">Posts</h1>
	<?php doAction('index_loglist_top'); ?>
<?php 
if (!empty($logs)):
foreach($logs as $value):
$logdes = blog_tool_purecontent($value['content'], 150);
?>	
	<article class="post post-list" itemscope="" itemtype="">
	<div class="post-entry">
		<div class="feature">
			<a href="<?php echo $value['log_url']; ?>">
			<div class="overlay">
				<i class="iconfont"></i>
			</div>
			<img src="<?php echo TEMPLATE_URL; ?>images/random/d-<?php echo rand(1,10)?>.jpg"></a>
		</div>
		<h1 class="entry-title"><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h1>
		<div class="p-time">
			<i class="iconfont"></i>发布于 <?php echo gmdate('Y-n-j', $value['date']); ?>
		</div>
		<p><?php echo $logdes; ?></p>
		<footer class="entry-footer">
		<div class="post-more">
			<a href="<?php echo $value['log_url']; ?>"><i class="iconfont"></i></a>
		</div>
		<div class="info-meta">
			<div class="comnum">
				<span><i class="iconfont"></i><?php echo $value['comnum']; ?></span>
			</div>
			<div class="views">
				<span><i class="iconfont"></i><?php echo $value['views'];?></span>
			</div>
		</div>
		</footer><!-- .entry-footer -->
	</div>
	<hr>
	</article><!-- #post-## -->
<?php 
endforeach;
else:
?>
	<li class="nothing">你找到的东西已飞宇宙黑洞去了！</li>
<?php endif;?>
	</main><!-- #main -->
	<nav class="navigator">
	<?php echo pjax_page($lognum,$index_lognum,$page,$pageurl); ?>
	</nav>
</div>
<?php include View::getView('footer');?>