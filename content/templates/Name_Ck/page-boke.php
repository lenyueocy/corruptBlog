<?php 
/**
 * 人气文章排行榜
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="page-single">
    <div class="page-title" style="background-image:url(<?php echo TEMPLATE_URL; ?>img/page_bg.jpg);">
        <div class="container">
            <h1 class="title">
                人气文章排行榜
            </h1>
            <div class="page-dec"></div>
        </div>
    </div>
    <div class="likepage clearfix">
        <div class="container">
            <?php
            $db = MySql::getInstance();
            $time = time();
            $sql = "SELECT gid,title,views FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC";
            $list = $db->query($sql);
            while($row = $db->fetch_array($list)){ ?>
                        <div class="like-post col-xs-6 col-sm-4 col-md-3">
                        <div class="like-post-box">
                            <a href="<?php echo Url::log($row['gid']); ?>" target="_blank">
                                <div class="views">
                                    <span class="icon s-like">喜欢 |  </span>
                                    <span class="count num"><?php echo $row['views'];?></span>
                                </div>
                                <div class="image" style="background-image:url(<?php img_name_ck($row['gid'])?>)"></div>
                                <div class="title">
                                    <h2><?php echo $row['title']; ?></h2>
                                    
                                </div>
                            </a>
                        </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
<?php include View::getView('footer');?>