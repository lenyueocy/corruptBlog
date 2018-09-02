<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
</div>
	<!-- #content -->
</div>
<!-- #page Pjax container--><footer id="colophon" class="site-footer" role="contentinfo">
<div class="site-info">
	<div class="footertext">
		<p class="foo-logo" style="background-image: url('<?php echo TEMPLATE_URL; ?>images/f-logo.png');">
		</p>
		<p>
			&copy; 2016-2018
		</p>
	</div>
	<div class="footer-device">
	<a href="<?php echo BLOG_URL; ?>" target="_blank"><?php echo $blogname; ?></a>
			 &nbsp; 
		<a href="https://github.com/louie-senpai/Siren" rel="designer" target="_blank" rel="nofollow">Theme Siren</a> &nbsp; <a href="https://www.ianiu.cn/" target="_blank" rel="nofollow">IANIU</a> &nbsp;
	</div>
</div>
<!-- .site-info --></footer><!-- #colophon -->
<div class="openNav">
	<div class="iconflat">
		<div class="icon">
		</div>
	</div>
	<div class="site-branding">
		<h1 class="site-title"><a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a></h1>
	</div>
</div>
<!-- m-nav-bar --></section><!-- #section --><!-- m-nav-center -->
<div id="mo-nav">
	<div class="m-avatar">
		<img src="<?php echo TEMPLATE_URL; ?>images/avatar.jpg">
	</div>
	<div class="m-search">
		<form class="m-search-form" method="get" action="<?php echo BLOG_URL; ?>" role="search">
			<input class="m-search-input" type="search" name="keyword" placeholder="搜索..." required>
		</form>
	</div>
	<div class="menu">
<?php blog_navi() ?>
	</div>
</div>
<!-- m-nav-center end --><a href="#" class="cd-top"></a><!-- search start -->
<form class="js-search search-form search-form--modal" method="get" action="<?php echo BLOG_URL; ?>" role="search">
	<div class="search-form__inner">
		<div>
			<p class="micro mb-">
				输入后按回车搜索 ...
			</p>
			<i class="iconfont">&#xe65c;</i>
			<input class="text-input" type="search" name="keyword" placeholder="Search" required>
		</div>
	</div>
	<div class="search_close">
	</div>
</form>
<!-- search end -->
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>js/jquery.min.js?ver=2.0.6.170420'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>js/jquery.pjax.js?ver=2.0.6.170420'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>js/input.min.js?ver=2.0.6.170420'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var Poi = {"pjax":"1","movies":"close","windowheight":"auto","codelamp":"close","ajaxurl":"","order":"asc","formpostion":"bottom"};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>js/app.js?ver=2.0.6.170420'></script>
<?php doAction('index_footer'); ?>
</body>
</html>
