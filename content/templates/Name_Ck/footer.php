<div id="footer" class="two-s-footer clearfix">
	<div class="footer-box">
		<div class="container">
          <div class="social-footer">
            <a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo _g('qq'); ?>&site=qq&menu=yes" title="QQ联系" target="_blank"><i class="icon-qq"></i></a>
          </div>
			<div class="copyright-footer">
				<p>
					Copyright © 2017 <a class="site-link" href="<?php echo BLOG_URL; ?>" title="<?php echo $blogname; ?>" rel="home"><?php echo $blogname; ?>   
					</a>· Powered By Emlog · Yankj · Youngxj Theme By <a href="<?php echo BLOG_URL; ?>" target="_blank"><?php blog_author($value['author']); ?>
					</a>
				</p>
              <?php doAction('index_footer'); ?>
			</div>
			<div class="links">
				<dl class="clearfix">
                           	友情链接：
					<?php ilinks(); ?>
				</dl>
			</div>
			<p>
					<?php echo $icp; ?>
					<?php echo $footer_info;?>
			</p>
		</div>
	</div>
</div>
<div class="search-form">
	<form method="get" action="<?php echo BLOG_URL; ?>index.php" role="search" name="keyform">       
		<div class="search-form-inner">
			<div class="search-form-box">
				 <input class="form-search" type="text" name="keyword" placeholder="键入搜索关键词">
				 <button type="submit" id="btn-search"><i class="icon-search"></i> </button>
				 
			</div>
					</div>                
	</form> 
	<div class="close-search">
		<span class="close-top"></span>
			<span class="close-bottom"></span>
    </div>
</div>
<div class="loader-mask" style="display:none;">
	<div class="loader" style="display:none;">
	  	<div></div>
	  	<div></div>
	</div>
</div>
<script type="text/javascript">
var pjax_id ='#page-content-ajax';
</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/plugins.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/owl.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/lazyload.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/wow.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/Name_ck.js"></script>
<?php   if(_g('pretty')=='y'){echo "<link rel=\"stylesheet\" id=\"style-css\" href=\"".TEMPLATE_URL."css/preff.css\" type=\"text/css\" media=\"all\"><script type=\"text/javascript\" src=\"".TEMPLATE_URL."js/prettify.js\"></script><script type=\"text/javascript\">
$(function() {
$('pre').addClass('prettyprint linenums').attr('style', 'overflow:auto');
window.prettyPrint && prettyPrint();
});
</script>";}   ?>
<?php echo '<script src="'.TEMPLATE_URL.'js/fancybox.js" type="text/javascript"></script><script src="'.TEMPLATE_URL.'fancybox.php" type="text/javascript"></script><link href="'.TEMPLATE_URL.'css/fancybox.css" rel="stylesheet" type="text/css" />'; ?>
<a class="to-top" style="cursor: pointer; display: none; position: fixed; right: 38px; bottom: 38px;"><i class="icon-up-small"></i></a>
<?php echo bdPushData($logid);?>
</body></html>