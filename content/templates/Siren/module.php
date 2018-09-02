<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 

?>
<?php
function index_tag(){global $CACHE;$tag_cache = $CACHE->readCache('tags');
?>
<p class="tag">
    <?php shuffle ($tag_cache);foreach($tag_cache as $value):?>
    <a href="<?php echo Url::tag($value['tagurl']); ?>"   title="<?php echo $value['usenum']; ?>篇文章">
    <?php if(empty($value['tagname'])){ echo "无标签";}else{echo $value['tagname'];}?>
    </a>
    <?php endforeach; ?>
</p>
<?php }?>
<?php 
/**
 * 设置页面
 */

//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}

//获取文章图片数量
function pic($content){
	if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $content, $img) && !empty($img[1])){
		echo $imgNum = count($img[1]);
	}else{
		echo "0";
	}
}

//获取附件第一张图片
function getThumbnail($blogid){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
    //die($sql);
    $imgs = $db->query($sql);
    $img_path = "";
    while($row = $db->fetch_array($imgs)){
         $img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));
    }
    return $img_path;
}

//格式化內容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('繼續閱讀&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
// 分页函数
function pjax_page($count,$perlogs,$page,$url,$anchor=''){
	$pnums = @ceil($count / $perlogs);
	$page = @min($pnums,$page);
	$prepg=$page-1;
	$nextpg=($page==$pnums ? 0 : $page+1);
	$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
	if($pnums<=1){
		return false;
	}
	if($prepg){
		$re .="<a href=\"$url$prepg$anchor\"><i class=\"iconfont\"></i></a>";
	}
	if($nextpg){
		$re .="<a href=\"$url$nextpg$anchor\"><i class=\"iconfont\"></i></a>";
	}
	return $re;
}
?>
<?php
//获取文章首张图片 内容用
function getpostimagetop($gid){
$db = MySql::getInstance();
$sql = "SELECT * FROM ".DB_PREFIX."blog WHERE gid=".$gid."";
//die($sql);
$imgs = $db->query($sql);
$img_path = "";
while($row = $db->fetch_array($imgs)){
preg_match('|<img.*src=[\"](.*?)[\"]|', $row['content'], $img);
$rand_img = TEMPLATE_URL.'images/bg.jpg';
$imgsrc = !empty($img[0]) ? $img[1] : $rand_img;
    }
    return $imgsrc;
}
?>

<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	<div class="previous">&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a></div>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		
	<?php endif;?>
	<?php if($nextLog):?>
		 <div class="next"><a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;</div>
	<?php endif;?>

<?php }?>

<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul>
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li class="item <?php echo $current_tab;?>">
			<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
			<?php if (!empty($value['children'])) :?>
            <ul>
                <?php foreach ($value['children'] as $row){
                        echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

            <?php if (!empty($value['childnavi'])) :?>
            <ul>
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

		</li>
	<?php endforeach; ?>
	</ul>
<?php }?>

<?php
//首页微语调用
function index_t($num){
	$t = MySql::getInstance();
	?>
	<?php
	$sql = "SELECT id,content,img,author,date,replynum FROM ".DB_PREFIX."twitter ORDER BY `date` DESC LIMIT $num";
	$list = $t->query($sql);
	while($row = $t->fetch_array($list)){
	?>
	 	<div class="notice">
	   <i class="iconfont icon-write"></i> : 
		<div class="notice-content">
		<?php echo $row['content'];?></div>
	</div>
	<?php }?>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	shuffle($link_cache);$link_cache = array_slice($link_cache,0,6);
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
    <ul>
	<?php foreach($link_cache as $value): ?>
	<li><i class="icon-close" style="padding-left: 10px;"></i>
	<a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>

<?php }?> 
<?php
//widget：友情链接页面
function link_box($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	shuffle($link_cache);$link_cache = array_slice($link_cache,0,20);
	?>
	<?php foreach($link_cache as $value): ?>
	<a href="<?php echo $value['url']; ?>" target="_blank" class="no-underline">
	<div class="thumb">
		<img width="200" height="200" src="<?php echo $value['des']; ?>" alt="Chris">
	</div>
	<div class="link-content">
		<div class="link-title">
			<h3><?php echo $value['link']; ?></h3>
		</div>
	</div>
	</a>
	<?php endforeach; ?>
<?php }?> 
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '<i class="iconfont"></i> ';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo '<div class="post-tags">'.$tag.'</div>';
	}
}
?>

<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//widget：搜索
function widget_search($title){ ?>
			<form class="m-search-form" method="get" name="keyform" action="<?php echo BLOG_URL; ?>index.php" role="search">
				<input class="m-search-input" type="text" name="keyword" placeholder="搜索" required>
			</form>
<?php } ?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>

		<div id="loading-comments"><span></span></div>
			
				<ul class="commentwrap">
	<?php endif; ?>
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
<li class="comment even thread-even depth-<?php echo $comment['cid']; ?>" id="comment-<?php echo $comment['cid']; ?>">
			<div class="contents">
				<div class="comment-arrow">
					<div class="main shadow">
						<div class="profile">
							<img src="<?php echo getGravatar($comment['mail']); ?>" class="avatar avatar-80 photo" height="80" width="80">
						</div>
						<div class="commentinfo">
							<section class="commeta">
								<div class="left">
									<h4 class="author"><?php echo $comment['poster']; ?></h4>
								</div>
								<a rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
								<div class="right">
									<div class="info"><time datetime="2018-07-18">发布于 <?php echo $comment['date']; ?></time></div>
								</div>
							</section>
						</div>
						<div class="body">
							<p><?php echo $comment['content']; ?></p>
						</div>
					</div>
					<div class="arrow-left"></div>
				</div>
			</div>
			<hr>
<ul class="children">
<?php blog_comments_children($comments, $comment['children']); ?>
</ul><!-- .children -->
</li><!-- #comment-## -->
	<?php endforeach; ?>
</ul>

          <nav id="comments-navi"><?php echo $commentPageUrl;?></nav>

<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
		<li class="comment byuser comment-author-admin bypostauthor odd alt depth-<?php echo $comment['cid']; ?>" id="comment-<?php echo $comment['cid']; ?>">
			<div class="contents">
				<div class="comment-arrow">
					<div class="main shadow">
						<div class="profile">
							<img src="<?php echo getGravatar($comment['mail']); ?>" srcset="<?php echo getGravatar($comment['mail']); ?>" class="avatar avatar-80 photo" height="80" width="80">
							
						</div>
						<div class="commentinfo">
							<section class="commeta">
								<div class="left">
									<h4 class="author"><?php echo $comment['poster']; ?></h4>
								</div>
								<a rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
								<div class="right">
									<div class="info"><time datetime="2018-08-08">发布于 <?php echo $comment['date']; ?></time></div>
								</div>
							</section>
						</div>
						<div class="body">
							<p><?php echo $comment['content']; ?></p>
						</div>
					</div>
					<div class="arrow-left"></div>
				</div>
			</div>
			<hr>
		</li><!-- #comment-## -->
		<?php blog_comments_children($comments, $comment['children']); ?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
<div id="respond" class="comment-respond">
	<h3 id="reply-title" class="comment-reply-title"><small><a rel="nofollow" id="cancel-comment-reply-link" href="javascript:void(0);" onclick="cancelReply()" style="display:none;">Cancel Reply</a></small></h3>
	<form action="<?php echo BLOG_URL; ?>index.php?action=addcom" method="post" id="commentform" class="comment-form" novalidate="">
	    <input type="hidden" name="gid" value="<?php echo $logid; ?>" />
		<textarea placeholder="Type in your comments ..." name="comment" rows="10" tabindex="4" class="commentbody" id="comment" rows="5"></textarea>
		<?php if(ROLE == ROLE_VISITOR): ?>
		<input type="text" placeholder="昵称 (必须)" id="author" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1" aria-required="true">
		<input type="text" placeholder="邮箱 (必须)" name="commail" id="email" value="<?php echo $ckmail; ?>" maxlength="128" size="22" tabindex="1" aria-required="true">
		<input type="text" placeholder="网站" name="comurl" id="url" value="<?php echo $ckurl; ?>" maxlength="128" size="22" tabindex="1">
		<?php endif; ?>
		<p class="form-submit">
			<input type="submit" id="comment_submit" class="submit" value="Post Comment">
             <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</p>
	</form>
</div>
</div>
	<?php endif; ?>
<?php }?>
<?php 
		 function isMobile(){ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
} 
?>