<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
$avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
?>
<div class="top-content">
<div class="container">
<div class="row">
<?php if (!empty($logs)): ?>
 <?php if(_g('listjq')=="y"){?>
<div class="owl-carousel top-slide-two owl-loaded owl-drag">
<?php cmsHdp(_g('slidepid'),_g('slidepnum'));?>
</div>
<div class="top-singles hidden-xs hidden-sm">
<?php if(_g('index_logs')=="y"){index_logs(2);}else{index_logs_sj(2);} ?>
</div>
</div>
<?php }else{ ?>
<div id="wowslider-container1" style="margin-bottom:20px">
	<div class="ws_images"><ul>
      <?php cmsHdpck(_g('slidepid'),_g('slidepnum'))?>
	</ul></div>
	<div class="ws_shadow"></div>
</div>	
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/wowslider.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/script.js"></script>
<?php
}
?>
</div>
</div>
<?php if(_g('list_foot')=='y'){echo list_cms(_g('list_url'),_g('list_name'),_g('list_img'));}else{if (_g('hdpbottomcms') == "y"){ echo hdpbottomcms();}}?>
<div class="main-content">
<div class="container" id="container">

<div class="row">
<div class="article col-xs-12 col-sm-8 col-md-8">
<div class="ajax-load-box posts-con">
<?php doAction('index_loglist_top'); ?>
<?php 
foreach($logs as $value): 
?>
<div class="ajax-load-con content wow fadeInUp">
<div class="content-box posts-gallery-box">
    <?php  
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $match);
    if(count($match[1]) >=3){?>
    <div class="posts-default-title">
		<h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?><?php topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:''); ?></a></h2>
	</div>
	<div class="post-images-item">
			<ul>
				<li>
                    <div class="image-item">
                        <a href="<?php echo $value['log_url']; ?>">
                            <div class="overlay"></div>
                            <img class="lazy thumbnail" data-original="<?php echo TEMPLATE_URL; ?>/timthumb.php?src=<?php echo $match[1][0]; ?>&h=174&w=232&zc=1" src="<?php echo TEMPLATE_URL; ?>/images/lazyload.gif" alt="<?php echo $value['log_url']; ?>" style="display: block;">
                        </a>
                    </div>
                </li>
                <li>
                    <div class="image-item">
                        <a href="<?php echo $value['log_url']; ?>">
                            <div class="overlay"></div>
                            <img class="lazy thumbnail" data-original="<?php echo TEMPLATE_URL; ?>/timthumb.php?src=<?php echo $match[1][1]; ?>&h=174&w=232&zc=1" src="<?php echo TEMPLATE_URL; ?>/images/lazyload.gif" alt="<?php echo $value['log_url']; ?>" style="display: block;">
                        </a>
                    </div>
                </li>
                <li>
                    <div class="image-item">
                        <a href="<?php echo $value['log_url']; ?>">
                            <div class="overlay"></div>
                            <img class="lazy thumbnail" data-original="<?php echo TEMPLATE_URL; ?>/timthumb.php?src=<?php echo $match[1][2]; ?>&h=174&w=232&zc=1" src="<?php echo TEMPLATE_URL; ?>/images/lazyload.gif" alt="<?php echo $value['log_url']; ?>" style="display: block;">
                        </a>
                    </div>
                </li>
                </ul>
		</div>
		<div class="posts-default-content">
			<div class="posts-text"><?php echo subString(strip_tags($value['log_description']),0,200,"..."); ?></div>
		</div>
		<div class="posts-default-info">
				<ul>
					 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><img alt="" src="//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo _g('qq');?>&src_uin=www.yankj.com&fid=blog&spec=100" class="avatar avatar-96 photo" height="96" width="96" style="display: block;"></div><?php blog_author($value['author']); ?></li>
											<li class="ico-cat"><i class="icon-list-2"></i> <?php blog_sort($value['logid']); ?></li>
											<li class="ico-time"><i class="icon-clock-1"></i> <?php echo gmdate('Y-n-j', $value['date']); ?></li>
											<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php echo $value['views']; ?></li>
					<li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php echo $value['comnum']; ?></li>				</ul>
			</div>
    <?php }else{if($value['gid'] % 3 == 0){?><div class="posts-default-img">
			<a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>">
				<div class="overlay"></div>	
									<img class="lazy thumbnail" data-original="<?php echo TEMPLATE_URL; ?>/timthumb.php?src=<?php img_name_ck($value['gid']); ?>&h=284&w=710&zc=1" src="<?php echo TEMPLATE_URL; ?>/images/lazyload.gif" alt="<?php echo $value['log_title']; ?>" style="display: block;">	
											</a> 
		</div>
		<div class="posts-default-box">
			<div class="posts-default-title">
								<h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a></h2>
			</div>
			<div class="posts-default-content">
				
				<div class="posts-text"><?php echo subString(strip_tags($value['log_description']),0,200,"..."); ?></div>
				<div class="posts-default-info">
					<ul>
						 
												<li class="ico-cat"><i class="icon-list-2"></i> <?php blog_sort($value['logid']); ?></li>
													<li class="ico-time"><i class="icon-clock-1"></i> <?php echo gmdate('Y-n-j', $value['date']); ?></li>
													<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php echo $value['views']; ?></li>
						<li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php echo $value['comnum']; ?></li>
											</ul>
				</div>
			</div>
		</div><?php }else{
    ?>
<div class="posts-gallery-img">
<a href="<?php echo $value['log_url']; ?>" title="">
<img class="lazy thumbnail" data-original="<?php echo TEMPLATE_URL; ?>/timthumb.php?src=<?php img_name_ck($value['gid']); ?>&h=174&w=232&zc=1" src="<?php echo TEMPLATE_URL; ?>/images/lazyload.gif" alt="<?php echo $value['log_title']; ?>" style="display: block;">
</a> 
</div>
<div class="posts-gallery-content">
<h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a><?php topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:''); ?></h2>
<div class="posts-gallery-text"><?php echo subString(strip_tags($value['log_description']),0,200,"..."); ?></div>
<div class="posts-default-info posts-gallery-info">
<ul>
<li class="post-author hidden-xs hidden-sm"><div class="avatar"><img alt="" src="//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo _g('qq');?>&src_uin=www.yankj.com&fid=blog&spec=100" class="avatar avatar-96 photo" width="96" height="96"></div><?php blog_author($value['author']); ?> </li>
<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i>原创</span></li>
<li class="ico-cat"><i class="icon-list-2"></i><?php blog_sort($value['logid']); ?></li>
<li class="ico-time"><i class="icon-clock-1"></i> <?php echo gmdate('Y-n-j', $value['date']); ?></li>
<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php echo $value['views']; ?></li>
<li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php echo $value['comnum']; ?></li></ul>
  </div></div>
<?php 
}}?></div></div><?php endforeach;?>
</div>
<div class="pagnation">
<?php echo $page_url;?>
</div>
</div>
<div class="article col-xs-12 col-sm-8 col-md-4 sidebar">
<?php require_once View::getView('side');?>
</div>
  <?php
else:
?>
<div class="blog-emtry">
					<i class="icon-frown"></i>
					<p>没有你要搜索的关键词</p></div>
<?php endif;?>
</div>
</div>
</div>
</div>
</div>
<?php
require_once View::getView('footer');
?>