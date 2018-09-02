<?php
/*  
Theme Name:Name_ck
Theme URI:https://www.yankj.com
Description:The best theme is Name_ck.
Version:1.2
Author:Miss.Tao && young(杨小杰)
Author URI:https://www.yankj.com
*/
if (!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="Shortcut Icon" href="<?php echo TEMPLATE_URL; ?>img/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE;chrome=1">
<title><?php echo $site_title; ?><?php echo page_tit($page); ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<link rel="stylesheet" id="carousel-css" href="<?php echo TEMPLATE_URL; ?>css/owl.css" type="text/css" media="all">
<link rel="stylesheet" id="animate-css" href="<?php echo TEMPLATE_URL; ?>css/aos.css" type="text/css" media="all">
<link rel="stylesheet" id="bootstrap-css" href="<?php echo TEMPLATE_URL; ?>css/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" id="fontello-css" href="<?php echo TEMPLATE_URL; ?>css/fontello.css" type="text/css" media="all">
<link rel="stylesheet" id="reset-css" href="<?php echo TEMPLATE_URL; ?>css/reset.css" type="text/css" media="all">
<link rel="stylesheet" id="style-css" href="<?php echo TEMPLATE_URL; ?>css/style.css" type="text/css" media="all">
<link rel="stylesheet" id="style-css" href="<?php echo TEMPLATE_URL; ?>css/animate.min.css" type="text/css" media="all">
<link rel="stylesheet" id="style-css" href="<?php echo TEMPLATE_URL; ?>images/OwO/OwO.min.css" type="text/css" media="all">
<script type="text/javascript" src="<?php echo BLOG_URL; ?>include/lib/js/jquery/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery-migrate.js"></script>
<!--<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/ajax.js"></script>!-->
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
<style id="theia-sticky-sidebar-stylesheet-TSS">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>
<style>#header,#header .toggle-tougao,.two-s-footer .footer-box{background-color:#fff}
#header .js-toggle-message button,#header .js-toggle-search,#header .primary-menu ul>li>a,#header .toggle-login,#header .toggle-tougao,#menu-mobile a{color:#9c9c9c}
.navbar-toggle .icon-bar{background-color:#bdbdbd}
#header .primary-menu ul>li.current-menu-ancestor>a,#header .primary-menu ul>li.current-menu-item>a,#header .primary-menu ul>li:hover>a,#header .primary-menu ul>li>a:hover{color:#000}
#header .primary-menu ul>li .sub-menu li a:hover,#header .primary-menu ul>li .sub-menu li.current-menu-item>a,#header .toggle-tougao:hover{color:#000}
#header .toggle-tougao,#header .toggle-tougao:hover{border-color:#9c9c9c}
</style>
</head>
 <body class="home blog off-canvas-nav-left" id="body">
<?php if(_g('loding_y')=="y"): ?>
<div class="loader-mask">
	<div class="loader">
	  	<div></div>
	  	<div></div>
	</div>
</div>
   <?php endif; ?>
  <div id="header" class="navbar-fixed-top">
   <div class="container">
	<?php if (_g('logo') == image) :?>
    <h1 class="logo"> <a href=".." title="GRACE" style="background-image: url(<?php echo _g('logopic'); ?>);"> </a> </h1>
	<?php else: ?>
	<h1 class="logoa"><a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a></h1>
    <?php endif;?>
<div role="navigation" class="site-nav  primary-menu">
    <div class="menu-fix-box">
        <ul id="menu-navigation" class="menu">
            <?php blog_navi();?>
        </ul>
    </div>
</div>
<div class="right-nav pull-right">
  <button class="js-toggle-search"><i class=" icon-search"></i></button>
<?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
<a href="<?php echo BLOG_URL; ?>admin/" class="toggle-login hidden-xs hidden-sm">管理</a>
<span class="line  hidden-xs hidden-sm"></span>
<a href="<?php echo BLOG_URL; ?>admin/?action=logout" class="toggle-login hidden-xs hidden-sm">退出</a>
<?php else: ?><?php if (_g('admin') == y) :?>
<a href="<?php echo BLOG_URL; ?>admin/" class="toggle-login hidden-xs hidden-sm">登录后台</a>
<?php endif;endif; ?></div>

<div class="navbar-mobile hidden-md hidden-lg">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	</button>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible;">
			<div id="mCSB_1" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0">
				<div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
					<?php m_blog_navi();?>
				</div>
			</div>
			<div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: none;">
				<div class="mCSB_draggerContainer">
					<div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 0px; height: 0px; top: 0px;">
						<div class="mCSB_dragger_bar" style="line-height: 0px;">
						</div>
					</div>
					<div class="mCSB_draggerRail">
					</div>
				</div>
			</div>
		</ul>
	</div>
</div>
</div>
</div>
<!-- 
<script>XlchKey="2o3fxabtt6";</script>
<link href="http://lib.baomitu.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="http://lib.baomitu.com/jquery-mousewheel/3.1.9/jquery.mousewheel.min.js"></script>
<script src="http://static.badapple.top/BadApplePlayer/js/scrollbar.js"></script>
<script src="http://static.badapple.top/BadApplePlayer/Player.js"></script>-->
<div id="ajaxcontent">
<script type='text/javascript'>
/* <![CDATA[ */
var Name_ck = {"slidestyle":"index_slide_sytle_2","wow":"1","sideroll":"1","duang":"1"};
/* ]]> */
</script>