<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="page-single">
	<div class="page-title" style="background-image:url(<?php echo TEMPLATE_URL; ?>/img/page_bg.jpg);">
		<div class="container">
			<h1 class="title">
				微语
			</h1>
			<div class="page-dec"></div>
		</div>
	</div>
</div>
<div id="page-content">
	<div class="container">
		<div class="row">
			<div class="article col-xs-12 col-sm-8 col-md-8">
				<div class="art-content">
					<div id="tw">
						<ul>
							<?php 
							foreach($tws as $val):
								$author = $user_cache[$val['author']]['name'];
								$avatar = empty($user_cache[$val['author']]['avatar']) ? 
								BLOG_URL . 'admin/views/images/avatar.jpg' : 
								BLOG_URL . $user_cache[$val['author']]['avatar'];
								$tid = (int)$val['id'];
								$img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img src="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" class="tp" /></a>';
								?> 
								<li class="ajax-load-con art-contentca wow fadeInUp">
									<div class="tupic"><img src="<?php echo $avatar; ?>" /></div>
									<div class="tpost f14">
										<?php echo $val['t'].$img;?>
										<?php blog_comments($comments); ?>
										<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
										<div class="twter f12">
											<?php echo '#'.$tid.'#&emsp;'.$author.'&emsp;'.$val['date'];?>
										</div>	
									</div>
								</li>
							<?php endforeach;?>
						</ul>
						<div class="pagination box">
							<?php echo $pageurl;?>
						</div>
					</div>
				</div>
			</div>
			<div class="article col-xs-12 col-sm-8 col-md-4">
				<?php include View::getView('side');?>
			</div>
		</div>
	</div>
</div>
<?php include View::getView('footer');?>