<?php
//Gravatar头像
function Gravatar($email, $s = 40, $d = 'monsterid', $r = 'x') {
	$hash = md5($email);
	$avatar = "//cn.gravatar.com/avatar/$hash?s=$s&d=$d&r=$r";
	return $avatar;
}
?>
<?php
//30天按点击率排行文章
function index_logs($log_num) {
$db = MySql::getInstance();
$time = time();
$sql = "SELECT gid,title,sortid FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT 0,$log_num";
$list = $db->query($sql);
$i=0;
while($row = $db->fetch_array($list)){ 
    $i++;
    if($i==3){
        break;
    }
?>
<div class="single-item">
    <div class="image" style="background-image:url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($row['gid']); ?>&h=210&w=360&zc=1)">
    <a href="<?php echo Url::log($row['gid']); ?>">
    <div class="overlay"></div>
    <div class="title"><span><?php sort_c($row['sortid']);?></span><h3><?php echo $row['title']; ?></h3></div>
    </a>
    </div>
    </div>
<?php } ?>
<?php } ?>
<?php
//30天按点击率排行随机文章
function index_logs_sj($log_num) {
$db = MySql::getInstance();
$time = time();
$cacca=rand(0,10);
$sql = "SELECT gid,title,sortid FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT $cacca,$log_num";
$list = $db->query($sql);
$i=0;
while($row = $db->fetch_array($list)){ 
    $i++;
    if($i==3){
        break;
    }
?>
<div class="single-item">
    <div class="image" style="background-image:url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($row['gid']); ?>&h=210&w=360&zc=1)">
    <a href="<?php echo Url::log($row['gid']); ?>">
    <div class="overlay"></div>
    <div class="title"><span><?php sort_c($row['sortid']); ?></span><h3><?php echo $row['title']; ?></h3></div>
    </a>
    </div>
    </div>
<?php } ?>
<?php } ?>

<?php
//获取分类名称
function sort_c($sdi_c){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort');
	foreach($sort_cache as $value):
        if($sdi_c==$value['sid']){
            echo $value['sortname'];
            break;
        }
	endforeach;
}
?>

<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：导航
function blog_navi() {
global $CACHE;
$navi_cache = $CACHE->readCache('navi');
foreach ($navi_cache as $value):
if ($value['pid'] != 0) {
continue;
}
$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
$current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current-menu-ancestor current-menu-parent' : 'current-menu';
?>
<?php if (!empty($value['childnavi'])){ ?>
<li class="<?php echo $current_tab; ?> menu-item-has-children">
<a><?php echo $value['naviname']; ?></a>
<ul class="sub-menu">
<?php foreach ($value['childnavi'] as $row) {
$newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'] . '</a></li>';
}?>
</ul>
</li>
<?php }else{?>
<li class="<?php echo $current_tab; ?>"><a href="<?php echo $value['url']; ?>"><?php echo $value['naviname']; ?></a></li>
<?php }?>
<?php endforeach;}?>

<?php
//blog：手机导航
function m_blog_navi() {
global $CACHE;
$navi_cache = $CACHE->readCache('navi');
foreach ($navi_cache as $value):
if ($value['pid'] != 0) {
continue;
}
$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
?>
<?php if (!empty($value['childnavi'])){ ?>
<li class="menu-item-has-children has-children">
<span class="toggle-submenu"></span>
<a><?php echo $value['naviname']; ?></a>
<ul class="sub-menu">
<?php foreach ($value['childnavi'] as $row) {
$newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'] . '</a></li>';
}?>
</ul>
</li>
<?php }else{?>
<li><a href="<?php echo $value['url']; ?>"><?php echo $value['naviname']; ?></a></li>
<?php }?>
<?php endforeach;}?>

<?php
//getimage
function picthumb($blogid) {
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
//    die($sql);
    $imgs = $db->query($sql);
    while($row = $db->fetch_array($imgs)){
        $pict.= ''.BLOG_URL.substr($row['filepath'],3,strlen($row['filepath'])).'';
    }
    return $pict;
}
?>
<?php
//getimageurl
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
    if($imgsrc):
        return $imgsrc;
    endif;
}
?>
<?php
//获取文章缩略图，先是自定义指定，然后是查找附件图片，最后是随机图片
function img_name_ck($logid){
    $db = MySql::getInstance();
    $where = "hide='n'";
    $where .= " AND date>='".(time()-$lastday*86400)."'";
    $sql = "SELECT gid,title,excerpt,content FROM ".DB_PREFIX."blog WHERE `gid` ='". $logid."' ORDER BY `date` DESC";
    $go = $db->query($sql);
    while($row = $db->fetch_array($go)){
        $img_url = '';
        if(pic_thumb($row['content'])){
            $img_url = pic_thumb($row['content']);
        }
        elseif(picthumb($row['gid'])){
            $img_url = picthumb($row['gid']);
        }else{
            $img_url = TEMPLATE_URL.'img/ap'.rand(0,10).'.jpg';
        }
}echo $img_url;};
?>
<?php
//首页c幻灯片
function cmsHdp($sort, $num,$lastday=0) {
    $db = MySql::getInstance();    
    $where = "hide='n'";
    if($sort){
        $sort = explode(',',$sort);
        $sort = array_map("intval",$sort);
        $where .= " AND sortid IN(".join(',',$sort).") ";
    }
    if($lastday){
        $where .= " AND date>='".(time()-$lastday*86400)."'";
    }
    $sql = "SELECT gid,title,excerpt,content,sortid FROM ".DB_PREFIX."blog WHERE $where ORDER BY `date` DESC LIMIT 0,$num";
    $go = $db->query($sql);
    while($row = $db->fetch_array($go)){
        $img_url = '';
        if(pic_thumb($row['content'])){
            $img_url = pic_thumb($row['content']);
        }
        elseif(picthumb($row['gid'])){
            $img_url = picthumb($row['gid']);
        }else{
            $img_url = TEMPLATE_URL.'img/ap'.rand(0,10).'.jpg';
        }?>
<div class="owl-item" style="width: 750px;">
<div class="item">
<a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>">
<div class="slider-content" style="background-image: url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo $img_url;?>&h=450&w=750&zc=1); ">
<div class="slider-content-item">
<div class="slider-cat clearfix">
<?php sort_c($row['sortid']); ?>
</div>
<h2>
<?php echo $row['title']; ?>
</h2>
</div>
</div>
</a>
</div>
</div>
<?php }}?>



<?php
//首页c幻灯片样式2
function cmsHdpck($sort, $num,$lastday=0) {
    $db = MySql::getInstance();    
    $where = "hide='n'";
    if($sort){
        $sort = explode(',',$sort);
        $sort = array_map("intval",$sort);
        $where .= " AND sortid IN(".join(',',$sort).") ";
    }
    if($lastday){
        $where .= " AND date>='".(time()-$lastday*86400)."'";
    }
    $sql = "SELECT gid,title,excerpt,content,sortid FROM ".DB_PREFIX."blog WHERE $where ORDER BY `date` DESC LIMIT 0,$num";
    $go = $db->query($sql);
    while($row = $db->fetch_array($go)){
        $img_url = '';
        if(pic_thumb($row['content'])){
            $img_url = pic_thumb($row['content']);
        }
        elseif(picthumb($row['gid'])){
            $img_url = picthumb($row['gid']);
        }else{
            $img_url = TEMPLATE_URL.'img/ap'.rand(0,10).'.jpg';
        }?>
<li><img src="<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo $img_url;?>&h=450&w=750&zc=1" id="wows1_0" height="330px"/></li>
<?php }}?>


<?php
//blog：相邻文章
function neighbor_log($neighborLog){
extract($neighborLog);?>
<?php if($prevLog):?>
<a href="<?php echo Url::log($prevLog['gid']) ?>" title="<?php echo $prevLog['title'];?>" target="_blank" class="prev has-background" style="background-image: url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($prevLog['gid']);?>&h=195&w=330&zc=1)" alt="<?php echo $prevLog['title'];?>">	
	<span>上一篇</span><h4><?php echo $prevLog['title'];?></h4>
</a>
<?php endif;?>
<?php if($nextLog):?>
<a href="<?php echo Url::log($nextLog['gid']) ?>" title="<?php echo $nextLog['title'];?>" target="_blank" class="next has-background" style="background-image: url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($nextLog['gid']);?>&h=195&w=330&zc=1)" alt="<?php echo $nextLog['title'];?>">	
	<span>下一篇</span><h4><?php echo $nextLog['title'];?></h4>
</a>
	<?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
      	$i=0;
		foreach ($log_cache_tags[$blogid] as $value){
          $i++;
          if($i==21){
          	break;
          }
			$tag .= "<a href=\"".Url::tag($value['tagurl'])."\" rel=\"tag\" >".$value['tagname'].'</a>';
		}
		return $tag;
	}
}
?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<span class=\"tit2\"><img src=\"".TEMPLATE_URL."img/top.gif\"</span> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<span class=\"tit2\"><img src=\"".TEMPLATE_URL."img/top.gif\"</span> " : '';
    }
}
?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>


<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
	$isGravatar = Option::get('isgravatar');
	?><ol class="commentlist"><?php
  foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
<li class="comment even thread-even depth-1" id="comment-<?php echo $comment['cid']; ?>">
	<a name="<?php echo $comment['cid']; ?>"></a>
    <div class="comment-list" id="comment-<?php echo $comment['cid']; ?>" >
        <div class="comment-avatar"><img src="<?php if(_g('author-img')=='n'){echo Gravatar($comment['mail']);}else{$a=$comment['mail'];echo "//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=".str_replace("@qq.com","",$a)."&src_uin=www.yankj.com&fid=blog&spec=100";}?>" height="40px" width="40px" /></div>
        <div class="comment-body">
            <div class="comment_author">
                <span class="name"><?php echo $comment['poster']; ?></span>
				<em><?php echo $comment['date']; ?></em>
            </div>
            <div class="comment-text">
            <p><?php echo comment_add_owo($comment['content']); ?></p>
                        </div>
      		<div class="comment_reply">         
                <span>
				<a rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick='commentReply(<?php echo $comment['cid']; ?>,this)' aria-label="回复给">回复</a>
				</span>
            </div>  
        </div>
    </div>
    <?php blog_comments_children($comments, $comment['children']); ?>
</li>
<?php endforeach;?>
</ol>
<div class="pagnation">
	    <?php echo $commentPageUrl;?>
</div>
<?php } ?>


<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	?><ul class="children"><?php
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
<li class="comment byuser comment-author-suxing bypostauthor even depth-2" id="li-comment-<?php echo $comment['cid']; ?>">
    <div id="comment-233">
        <div class="comment-avatar"><img src="<?php if(_g('author-img')=='n'){echo Gravatar($comment['mail']);}else{$a=$comment['mail'];echo "//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=".str_replace("@qq.com","",$a)."&src_uin=www.yankj.com&fid=blog&spec=100";}?>" height="40px" width="40px" /></div>
        <div class="comment-body">
            <div class="comment_author">
                <span class="name"><?php echo $comment['poster']; ?></span>
                                <em><?php echo $comment['date']; ?></em>
            </div>
            <div class="comment-text">
            <p><?php echo comment_add_owo($comment['content']); ?></p>
                        </div>
      	<div class="comment_reply">         
                <span>
				<a rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick='commentReply(<?php echo $comment['cid']; ?>,this)' aria-label="回复给">回复</a>
				</span>
            </div></div>
        <?php blog_comments_children($comments, $comment['children']); ?>
    </div>
</li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
if($allow_remark == 'y'): ?>	
<div id="comment-place">
	<div id="comment-post" class="respond-box" name="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none">
			<a href="javascript:void(0);" onclick="cancelReply()">取消回复</a>
		</div>
		<h3 class="comments-title">发表评论</h3>
      <div title="OwO" class="OwO"></div>
		<form action="<?php echo BLOG_URL; ?>index.php?action=addcom" method="post" id="commentform" name="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == ROLE_VISITOR): ?>
			<div id="comment-author-info" class="clearfix">
              	<?php if(_g('qqcomment')=="y"){echo '<div class="comment-md-4"><input name="u" id="qqinfo" class="comment-md-9" size="22" tabindex="1" type="text" placeholder="QQ" onblur="qiuye()"></div>';} ?>
				<div class="comment-md-3">
					<input name="comname" id="comname" class="comment-md-9" size="22" tabindex="1" type="text" placeholder="昵称">
				</div>
				<div class="comment-md-3">
					<input name="commail" id="commail" class="comment-md-9" size="22" tabindex="2" type="email" placeholder="邮箱">
				</div>
				<div class="comment-md-3 comment-form-url">
					<input name="comurl" id="comurl" class="comment-md-9" size="22" tabindex="3" type="text" placeholder="网址">
				</div>
			</div>
      		<?php endif; ?>
			<div class="comment-from-main clearfix">
				<div class="comment-form-textarea">
					<div class="comment-textarea-box">
						<textarea class="comment-textarea OwO-textarea" name="comment" id="comment" placeholder="说点什么吧..." tabindex="4"></textarea>
						<div id="comment_message" style="display:none;">
						</div>
					</div>
				</div>
				<?php echo $verifyCode; ?>
				<div class="form-submit">
					<input class="btn-comment pull-right" name="submit" id="submit" tabindex="5" title="发表评论" value="发表评论" type="submit">
				</div>
              <div id="error"></div><div id="ajaxloading"></div>
			<div id="error1"></div><div id="ajaxloading1"></div>
			</div>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
</div>
<?php endif; ?>
<script type="text/javascript">var loaded = false, blog_url = "<?php echo TEMPLATE_URL; ?>";$(function(){$("textarea[name=comment]").bind('focus click',function() {if (!loaded) {$.getScript(blog_url + "images/face/face.js");loaded = true;}});});</script>
<?php }?>
<?php
//widget：友情链接
function ilinks(){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
    <?php foreach($link_cache as $value): ?>
	<a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a>
      <?php endforeach; ?>
<?php }?> 

<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<div class="ajax-load-box posts-con">
<div class="ajax-load-con content  wow fadeInUp">

	<div class="content-box posts-gallery-box">
	<div class="widget suxingme_social"><h3><span><?php echo $title; ?></span></h3>	<div class="attentionus">
		<ul class="items clearfix">
<div class="post-entry-categories">
		<?php $i=0;foreach($tag_cache as $value): $i++;if($i==21){break;}?>
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a>
	<?php endforeach; ?>
		</div>				
		</ul>
	</div></div></div></div>
</div>
<?php }?>

<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
		<div class="ajax-load-box posts-con">
		<div class="ajax-load-con content  wow fadeInUp">
	<div class="content-box posts-gallery-box">
	<div class="widget suxingme_social"><h3><span><?php echo $title; ?></span></h3>	<div class="attentionus">
		<ul class="items clearfix">
			<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	<?php if (!empty($value['children'])): ?>
		<ul>
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
		<li>
			<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
		</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>			
		</ul>
	</div></div></div></div>
</div>
<?php }?>

<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
		<div class="ajax-load-box posts-con">
		<div class="ajax-load-con content wow fadeInUp">
	<div class="content-box posts-gallery-box">
	<div class="widget suxingme_social"><h3><span><?php echo $title; ?></span></h3>	<div class="attentionus">
		<ul>
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
		</ul>
	</div></div></div></div>
</div>
<?php }?>

<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<div class="ajax-load-box posts-con">
		<div class="ajax-load-con content wow fadeInUp">
	<div class="content-box posts-gallery-box">
	<div class="widget suxingme_social"><h3><span><?php echo $title; ?></span></h3>	<div class="attentionus">
		<ul class="recent-posts-widget">
		<?php $i=0;foreach($newLogs_cache as $value):$i++;if($i==1){?><li class="one">
						<a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>">
							<div class="overlay"></div>	
															<img class="lazy thumbnail" data-original="<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($value['gid']); ?>&h=195&w=260&zc=1" src="<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($value['gid']); ?>&h=195&w=260&zc=1" alt="<?php echo $value['title']; ?>" />	
																					<div class="title">
								<h4><?php echo $value['title']; ?></h4>
							</div>
						</a>
					</li><?php }else{?>
			<li class="others">
				<div class="image">
					<a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>">
					<img class="lazy thumbnail" src="<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($value['gid']); ?>&h=75&w=100&zc=1" alt="<?php echo $value['title']; ?>" style="display: block;">
					</a>
				</div>
				<div class="title">
					<h4><a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a></h4>
				</div>
			</li>
	<?php }endforeach; ?>
	</ul>
	</div></div></div></div>
</div>
<?php }?>

<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<div class="widget suxingme_topic wow fadeInUp"><h3><span><?php echo $title; ?></span></h3>
      <?php foreach($randLogs as $value): ?>
  	<ul class="widget_suxingme_topic">
	<li>
		<a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>">
			<div class="overlay"></div>	
			<div class="image" style="background-image: url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($value['gid']); ?>&h=180&w=300&zc=1);"></div>	
			<div class="title">
				<h4><?php echo $value['title']; ?></h4>
				<div class="meta"><span>查看文章</span></div>
			</div>
		</a>
	</li>
	</ul>
      <?php endforeach; ?>
    </div>
<?php }?>

<?php
//widget：热门文章
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<div class="widget suxingme_topic wow fadeInUp"><h3><span><?php echo $title; ?></span></h3>
      <?php foreach($randLogs as $value): ?>
  	<ul class="widget_suxingme_topic">
	<li>
		<a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>">
			<div class="overlay"></div>	
			<div class="image" style="background-image: url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo img_name_ck($value['gid']); ?>&h=180&w=300&zc=1);"></div>	
			<div class="title">
				<h4><?php echo $value['title']; ?></h4>
				<div class="meta"><span>查看文章</span></div>
			</div>
		</a>
	</li>
	</ul>
      <?php endforeach; ?>
    </div>
<?php }?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
<div class="widget suxingme_post_author wow fadeInUp">
	<div class="authors_profile">
		<div class="avatar-panel">
			<a class="author_pic">
				<img alt="" src="<?php echo TEMPLATE_URL; ?>/images/lazyload.gif" data-original="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>"  class="avatar avatar-80 photo" height="80" width="80" style="display: inline;">				</a>
		</div>	
		<div class="author_name"><?php echo $name; ?><span>官方</span></div>
		<p class="author_dec"><?php echo $user_cache[1]['des']; ?></p>
	</div>
</div>
<?php }?>
<?php
//Blog：首页幻灯片下分类
function hdpbottomcms(){
	global $CACHE;
	$hdpbottomcms_cache = $CACHE->readCache('sort');
	?><div class="recommend-content"><div class="container"><div class="row"><div class="cat"><div class="thumbnail-cat"><?php
	$i=0;
	foreach($hdpbottomcms_cache as $value):
		$i++;
		if($i===4){
			break;
		}
	if ($value['pid'] != 0){break;}
  	$tmp = range(0,10);
  	$a = array_rand($tmp,5);
	?>
	<div class="image col-xs-12 col-sm-4 col-md-4"><div class="index-cat-box" style="background-image:url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo TEMPLATE_URL.'img/ap'.$a[$i-1].'.jpg';?>&h=200&w=360&zc=1)"><a class="iscat" href="<?php echo Url::sort($value['sid']); ?>"><div class="promo-overlay"><?php echo $value['sortname']; ?></div><div class="modulo_line"></div></a></div></div>
	<?php endforeach; ?>	
	</div></div></div></div></div>
<?php }?>

<?php
//Blog：首页幻灯片下分类,自定义
function list_cms($url,$name,$img){
  	$url_list = explode(",",$url);
  	$name_list = explode(",",$name);
  $img_list = explode(",",$img);
	?>
<div class="recommend-content"><div class="container"><div class="row"><div class="cat"><div class="thumbnail-cat">
<div class="image col-xs-12 col-sm-4 col-md-4"><div class="index-cat-box" style="background-image:url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo $img_list[0];?>&h=200&w=360&zc=1)"><a class="iscat" href="<?php echo $url_list[0]; ?>"><div class="promo-overlay"><?php echo $name_list[0]; ?></div><div class="modulo_line"></div></a></div></div>
  <div class="image col-xs-12 col-sm-4 col-md-4"><div class="index-cat-box" style="background-image:url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo $img_list[1];?>&h=200&w=360&zc=1)"><a class="iscat" href="<?php echo $url_list[1]; ?>"><div class="promo-overlay"><?php echo $name_list[1]; ?></div><div class="modulo_line"></div></a></div></div>
  <div class="image col-xs-12 col-sm-4 col-md-4"><div class="index-cat-box" style="background-image:url(<?php echo TEMPLATE_URL; ?>timthumb.php?src=<?php echo $img_list[2];?>&h=200&w=360&zc=1)"><a class="iscat" href="<?php echo $url_list[2]; ?>"><div class="promo-overlay"><?php echo $name_list[2]; ?></div><div class="modulo_line"></div></a></div></div>
</div></div></div></div></div>
<?php }?>

<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<div class="ajax-load-box posts-con">
		<div class="ajax-load-con content wow fadeInUp">
	<div class="content-box posts-gallery-box">
	<div class="widget suxingme_social"><h3><span><?php echo $title; ?></span></h3>	<div class="attentionus">
		<ul class="recent-posts-widget-commer">
	<?php
	$i=0;
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	$i++;
	if($i==6){
	    break;
	}
	?>
	<li class="others">
				<div class="image">
					<a href="<?php echo $url; ?>" title="<?php echo $value['title']; ?>">
					<img class="lazy thumbnail" src="<?php if(_g('author-img')=='n'){echo Gravatar($value['mail']);}else{$a=$value['mail'];echo "//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=".str_replace("@qq.com","",$a)."&src_uin=www.yankj.com&fid=blog&spec=100";}?>" height="40px" width="40px" alt="<?php echo $value['title']; ?>" style="display: block;">
					</a>
				</div>
				<div class="title">
					<h4><a href="<?php echo $url; ?>" title="<?php echo $value['title']; ?>"><?php echo comment_add_owo($value['content']); ?></a></h4>
					<span><?php echo $value['name']; ?></span>
				</div>
	</li>
	<?php endforeach; ?>
	</ul>
	</div></div></div></div>
</div>
<?php }?>

<?php
//widget：自定义组件
function widget_custom_text($title, $content){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<div class="ajax-load-box posts-con">
		<div class="ajax-load-con content wow fadeInUp">
	<div class="content-box posts-gallery-box">
	<div class="widget suxingme_social"><h3><span><?php echo $title; ?></span></h3>	<div class="attentionus">
		<ul class="recent-posts-widget">
		<?php echo $content; ?>
	</ul>
	</div></div></div></div>
</div>
<?php }?>
<?php
//分页标题后面加 - 第几页
function page_tit($page) { if ($page>=2){ echo '_第'.$page.'页'; }}
?>
<?php
/**
*替换OwO表情
*by 兰陵 
*https://blog.thkira.com/
*/
function comment_add_owo($comment_text) {
	$data_OwO = array(
		'@(暗地观察)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/暗地观察.png" alt="暗地观察" class="OwO-img">',
		'@(便便)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/便便.png" alt="便便" class="OwO-img">',
		'@(不出所料)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/不出所料.png" alt="不出所料" class="OwO-img">',
		'@(不高兴)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/不高兴.png" alt="不高兴" class="OwO-img">',
		'@(不说话)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/不说话.png" alt="不说话" class="OwO-img">',
		'@(抽烟)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/抽烟.png" alt="抽烟" class="OwO-img">',
		'@(呲牙)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/呲牙.png" alt="呲牙" class="OwO-img">',
		'@(大囧)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/大囧.png" alt="大囧" class="OwO-img">',
		'@(得意)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/得意.png" alt="得意" class="OwO-img">',
		'@(愤怒)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/愤怒.png" alt="愤怒" class="OwO-img">',
		'@(尴尬)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/尴尬.png" alt="尴尬" class="OwO-img">',
		'@(高兴)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/高兴.png" alt="高兴" class="OwO-img">',
		'@(鼓掌)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/鼓掌.png" alt="鼓掌" class="OwO-img">',
		'@(观察)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/观察.png" alt="观察" class="OwO-img">',
		'@(害羞)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/害羞.png" alt="害羞" class="OwO-img">',
		'@(汗)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/汗.png" alt="汗" class="OwO-img">',
		'@(黑线)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/黑线.png" alt="黑线" class="OwO-img">',
		'@(欢呼)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/欢呼.png" alt="欢呼" class="OwO-img">',
		'@(击掌)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/击掌.png" alt="击掌" class="OwO-img">',
		'@(惊喜)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/惊喜.png" alt="惊喜" class="OwO-img">',
		'@(看不见)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/看不见.png" alt="看不见" class="OwO-img">',
		'@(看热闹)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/看热闹.png" alt="看热闹" class="OwO-img">',
		'@(抠鼻)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/抠鼻.png" alt="抠鼻" class="OwO-img">',
		'@(口水)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/口水.png" alt="口水" class="OwO-img">',
		'@(哭泣)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/哭泣.png" alt="哭泣" class="OwO-img">',
		'@(狂汗)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/狂汗.png" alt="狂汗" class="OwO-img">',
		'@(蜡烛)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/蜡烛.png" alt="蜡烛" class="OwO-img">',
		'@(脸红)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/脸红.png" alt="脸红" class="OwO-img">',
		'@(内伤)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/内伤.png" alt="内伤" class="OwO-img">',
		'@(喷水)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/喷水.png" alt="喷水" class="OwO-img">',
		'@(喷血)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/喷血.png" alt="喷血" class="OwO-img">',
		'@(期待)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/期待.png" alt="期待" class="OwO-img">',
		'@(亲亲)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/亲亲.png" alt="亲亲" class="OwO-img">',
		'@(傻笑)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/傻笑.png" alt="傻笑" class="OwO-img">',
		'@(扇耳光)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/扇耳光.png" alt="扇耳光" class="OwO-img">',
		'@(深思)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/深思.png" alt="深思" class="OwO-img">',
		'@(锁眉)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/锁眉.png" alt="锁眉" class="OwO-img">',
		'@(投降)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/投降.png" alt="投降" class="OwO-img">',
		'@(吐)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/吐.png" alt="吐" class="OwO-img">',
		'@(吐舌)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/吐舌.png" alt="吐舌" class="OwO-img">',
		'@(吐血倒地)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/吐血倒地.png" alt="吐血倒地" class="OwO-img">',
		'@(无奈)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/无奈.png" alt="无奈" class="OwO-img">',
		'@(无所谓)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/无所谓.png" alt="无所谓" class="OwO-img">',
		'@(无语)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/无语.png" alt="无语" class="OwO-img">',
		'@(喜极而泣)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/喜极而泣.png" alt="喜极而泣" class="OwO-img">',
		'@(献花)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/献花.png" alt="献花" class="OwO-img">',
		'@(献黄瓜)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/献黄瓜.png" alt="献黄瓜" class="OwO-img">',
		'@(想一想)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/想一想.png" alt="想一想" class="OwO-img">',
		'@(小怒)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/小怒.png" alt="小怒" class="OwO-img">',
		'@(小眼睛)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/小眼睛.png" alt="小眼睛" class="OwO-img">',
		'@(邪恶)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/邪恶.png" alt="邪恶" class="OwO-img">',
		'@(咽气)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/咽气.png" alt="咽气" class="OwO-img">',
		'@(阴暗)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/阴暗.png" alt="阴暗" class="OwO-img">',
		'@(赞一个)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/赞一个.png" alt="赞一个" class="OwO-img">',
		'@(长草)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/长草.png" alt="长草" class="OwO-img">',
		'@(中刀)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/中刀.png" alt="中刀" class="OwO-img">',
		'@(中枪)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/中枪.png" alt="中枪" class="OwO-img">',
		'@(中指)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/中指.png" alt="中指" class="OwO-img">',
		'@(肿包)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/肿包.png" alt="肿包" class="OwO-img">',
		'@(皱眉)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/皱眉.png" alt="皱眉" class="OwO-img">',
		'@(装大款)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/装大款.png" alt="装大款" class="OwO-img">',
		'@(坐等)' => '<img src="'.TEMPLATE_URL.'images/OwO/alu/坐等.png" alt="坐等" class="OwO-img">',
		'@[啊]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/啊.png" alt="啊" class="OwO-img">',
		'@[爱心]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/爱心.png" alt="爱心" class="OwO-img">',
		'@[鄙视]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/鄙视.png" alt="鄙视" class="OwO-img">',
		'@[便便]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/便便.png" alt="便便" class="OwO-img">',
		'@[不高兴]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/不高兴.png" alt="不高兴" class="OwO-img">',
		'@[彩虹]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/彩虹.png" alt="彩虹" class="OwO-img">',
		'@[茶杯]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/茶杯.png" alt="茶杯" class="OwO-img">',
		'@[吃瓜]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/吃瓜.png" alt="吃瓜" class="OwO-img">',
		'@[吃翔]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/吃翔.png" alt="吃翔" class="OwO-img">',
		'@[大拇指]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/大拇指.png" alt="大拇指" class="OwO-img">',
		'@[蛋糕]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/蛋糕.png" alt="蛋糕" class="OwO-img">',
		'@[嘚瑟]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/嘚瑟.png" alt="嘚瑟" class="OwO-img">',
		'@[灯泡]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/灯泡.png" alt="灯泡" class="OwO-img">',
		'@[乖]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/乖.png" alt="乖" class="OwO-img">',
		'@[哈哈]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/哈哈.png" alt="哈哈" class="OwO-img">',
		'@[汗]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/汗.png" alt="汗" class="OwO-img">',
		'@[呵呵]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/呵呵.png" alt="呵呵" class="OwO-img">',
		'@[黑线]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/黑线.png" alt="黑线" class="OwO-img">',
		'@[红领巾]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/红领巾.png" alt="红领巾" class="OwO-img">',
		'@[呼]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/呼.png" alt="呼" class="OwO-img">',
		'@[花心]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/花心.png" alt="花心" class="OwO-img">',
		'@[滑稽]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/滑稽.png" alt="滑稽" class="OwO-img">',
		'@[惊恐]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/惊恐.png" alt="惊恐" class="OwO-img">',
		'@[惊哭]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/惊哭.png" alt="惊哭" class="OwO-img">',
		'@[惊讶]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/惊讶.png" alt="惊讶" class="OwO-img">',
		'@[开心]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/开心.png" alt="开心" class="OwO-img">',
		'@[酷]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/酷.png" alt="酷" class="OwO-img">',
		'@[狂汗]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/狂汗.png" alt="狂汗" class="OwO-img">',
		'@[蜡烛]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/蜡烛.png" alt="蜡烛" class="OwO-img">',
		'@[懒得理]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/懒得理.png" alt="懒得理" class="OwO-img">',
		'@[泪]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/泪.png" alt="泪" class="OwO-img">',
		'@[冷]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/冷.png" alt="冷" class="OwO-img">',
		'@[礼物]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/礼物.png" alt="礼物" class="OwO-img">',
		'@[玫瑰]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/玫瑰.png" alt="玫瑰" class="OwO-img">',
		'@[勉强]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/勉强.png" alt="勉强" class="OwO-img">',
		'@[你懂的]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/你懂的.png" alt="你懂的" class="OwO-img">',
		'@[怒]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/怒.png" alt="怒" class="OwO-img">',
		'@[喷]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/喷.png" alt="喷" class="OwO-img">',
		'@[钱]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/钱.png" alt="钱" class="OwO-img">',
		'@[钱币]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/钱币.png" alt="钱币" class="OwO-img">',
		'@[弱]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/弱.png" alt="弱" class="OwO-img">',
		'@[三道杠]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/三道杠.png" alt="三道杠" class="OwO-img">',
		'@[沙发]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/沙发.png" alt="沙发" class="OwO-img">',
		'@[生气]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/生气.png" alt="生气" class="OwO-img">',
		'@[胜利]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/胜利.png" alt="胜利" class="OwO-img">',
		'@[手纸]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/手纸.png" alt="手纸" class="OwO-img">',
		'@[睡觉]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/睡觉.png" alt="睡觉" class="OwO-img">',
		'@[酸爽]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/酸爽.png" alt="酸爽" class="OwO-img">',
		'@[太开心]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/太开心.png" alt="太开心" class="OwO-img">',
		'@[太阳]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/太阳.png" alt="太阳" class="OwO-img">',
		'@[吐]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/吐.png" alt="吐" class="OwO-img">',
		'@[吐舌]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/吐舌.png" alt="吐舌" class="OwO-img">',
		'@[挖鼻]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/挖鼻.png" alt="挖鼻" class="OwO-img">',
		'@[委屈]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/委屈.png" alt="委屈" class="OwO-img">',
		'@[捂嘴笑]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/捂嘴笑.png" alt="捂嘴笑" class="OwO-img">',
		'@[犀利]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/犀利.png" alt="犀利" class="OwO-img">',
		'@[香蕉]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/香蕉.png" alt="香蕉" class="OwO-img">',
		'@[小乖]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/小乖.png" alt="小乖" class="OwO-img">',
		'@[小红脸]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/小红脸.png" alt="小红脸" class="OwO-img">',
		'@[笑尿]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/笑尿.png" alt="笑尿" class="OwO-img">',
		'@[笑眼]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/笑眼.png" alt="笑眼" class="OwO-img">',
		'@[心碎]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/心碎.png" alt="心碎" class="OwO-img">',
		'@[星星月亮]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/星星月亮.png" alt="星星月亮" class="OwO-img">',
		'@[呀咩爹]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/呀咩爹.png" alt="呀咩爹" class="OwO-img">',
		'@[药丸]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/药丸.png" alt="药丸" class="OwO-img">',
		'@[咦]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/咦.png" alt="咦" class="OwO-img">',
		'@[疑问]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/疑问.png" alt="疑问" class="OwO-img">',
		'@[阴险]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/阴险.png" alt="阴险" class="OwO-img">',
		'@[音乐]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/音乐.png" alt="音乐" class="OwO-img">',
		'@[真棒]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/真棒.png" alt="真棒" class="OwO-img">',
		'@[nico]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/nico.png" alt="nico" class="OwO-img">',
		'@[OK]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/OK.png" alt="OK" class="OwO-img">',
		'@[what]' => '<img src="'.TEMPLATE_URL.'images/OwO/paopao/what.png" alt="what" class="OwO-img">',
		'@[doge]' => '<img src="'.TEMPLATE_URL.'images/OwO/doge.png" alt="doge" class="OwO-img">',
		'@[原谅她]' => '<img src="'.TEMPLATE_URL.'images/OwO/原谅她.png" alt="原谅她" class="OwO-img">'
	);
	return strtr($comment_text,$data_OwO);
}
?>
<?php
//获取文章链接
function Name_curPageURL(){
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on"){
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80"){
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }else{
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;}
?>

<?php
/* EMLOG百度搜索自动推送、主动收录JS优化 By AE博客
 * 文章地址：http://www.aeink.com/210.html
 * 转载请保留出处，谢谢合作！
 */
function bdPushData($id){
 $url=Url::log($id);
 if(baidu($url)==1){
 echo '<!--本文已收录，不输出推送代码-->';
 }else{
    	echo "<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    } else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>";
    }
}
?>
<?php
/*
 * 判断内容页是否百度收录,并且以博主和或者理员身份访问博客文章时自动向百度提交未收录的文章
 *
 */
function baidu($url){
 $url='http://www.baidu.com/s?wd='.$url;
 $curl=curl_init();
 curl_setopt($curl,CURLOPT_URL,$url);
 curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
 $rs=curl_exec($curl);
 curl_close($curl);
 if(!strpos($rs,'没有找到')){
     return 1;
   }
 else{
     return 0;
  }   
     }
  function checkbaidu($id){
  $url=Url::log($id);
  if(baidu($url)==1){
   echo "百度已收录";
  } else {
   if (ROLE == 'admin' || ROLE == 'writer') {
    $urls = array($url,);
 $api = 'http://data.zz.baidu.com/urls?site=www.aeink.com&token=DbHncVZJcV3FzstQ';
 $ch = curl_init();
 $options =  array(
     CURLOPT_URL => $api,
     CURLOPT_POST => true,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_POSTFIELDS => implode("\n", $urls),
     CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),);
 curl_setopt_array($ch, $options);
 $result = curl_exec($ch);
 echo '已自动提交给度娘';
   }
     echo "<a style=\"color:red;\" rel=\"external nofollow\" title=\"点击提交收录\" target=\"_blank\" href=\"http://zhanzhang.baidu.com/sitesubmit/index?sitename=$url\">坐等收录</a>";
  }
 }
?>