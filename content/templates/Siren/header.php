<?php
/*
Template Name:Siren
Description:一个单栏模板
Version:1.0
Author:瑾忆
Author Url:http://www.ianiu.cn
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title itemprop="name"><?php echo $site_title; ?></title>
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico"/>
<link rel='dns-prefetch' href='//s.w.org'/>
<link rel='stylesheet' id='siren-css' href='<?php echo TEMPLATE_URL; ?>style.css' type='text/css' media='all'/>
<style type="text/css">
.author-profile i , .post-like a , .post-share .show-share , .sub-text , .we-info a , span.sitename , .post-more i:hover , #pagination a:hover , .post-content a:hover , .float-content i:hover{ color: #FE9600 }
.feature i , .feature-title span , .download , .navigator i:hover , .links ul li:before , .ar-time i , span.ar-circle , .object , .comment .comment-reply-link , .siren-checkbox-radio:checked + .siren-checkbox-radioInput:after { background: #FE9600 }
::-webkit-scrollbar-thumb { background: #FE9600 }
.download , .navigator i:hover , .link-title , .links ul li:hover , #pagination a:hover , .comment-respond input[type='submit']:hover { border-color: #FE9600 }
.entry-content a:hover , .site-info a:hover , .comment h4 a , #comments-navi a.prev , #comments-navi a.next , .comment h4 a:hover , .site-top ul li a:hover , .entry-title a:hover , #archives-temp h3 , span.page-numbers.current , .sorry li a:hover , .site-title a:hover , i.iconfont.js-toggle-search.iconsearch:hover , .comment-respond input[type='submit']:hover { color: #FE9600 }
</style>
<script type="text/javascript">
if (!!window.ActiveXObject || "ActiveXObject" in window) { //is IE?
  alert('请抛弃万恶的IE系列浏览器吧。');
}
</script>
<?php doAction('index_head'); ?>
</head>
<body class="home blog hfeed">
<section id="main-container">
<div class="headertop filter-nothing">
	<figure id="centerbg" class="centerbg" style="">
	<div class="focusinfo">
		<div class="header-tou">
			<a href="<?php echo BLOG_URL; ?>"><img src="<?php echo _g("Siren_tx");?>"></a>
		</div>
		<div class="header-info">
			<p>
				<?php echo _g("Siren_qm");?>
			</p>
		</div>
		<div class="top-social">
		</div>
	</div>
	</figure>
	<div id="video-container" style="display:none;">
		<video id="bgvideo" class="video" video-name="" src="" width="auto" preload="auto"></video>
		<div id="video-btn" class="loadvideo videolive">
		</div>
		<div id="video-add">
		</div>
		<div class="video-stu">
		</div>
	</div>
</div>
<div id="page" class="site wrapper">
	<header class="site-header" role="banner">
	<div class="site-top">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a></h1>
			<!-- logo end -->
		</div>
		<!-- .site-branding -->
		<div class="searchbox">
			<i class="iconfont js-toggle-search iconsearch">&#xe65c;</i>
		</div>
		<div class="lower">
			<div id="show-nav" class="showNav">
				<div class="line line1">
				</div>
				<div class="line line2">
				</div>
				<div class="line line3">
				</div>
			</div>
			<nav>
			<div class="menu">
				<?php blog_navi() ?>
			</div>
			</nav><!-- #site-navigation -->
		</div>
	</div>
	</header><!-- #masthead -->
	<div class="blank">
	</div>
	<div id="content" class="site-content">