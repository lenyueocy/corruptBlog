<?php 
/**
 * 读者墙
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="page-single">
    <div class="page-title" style="background-image:url(<?php echo TEMPLATE_URL; ?>img/page_bg.jpg);">
        <div class="container">
            <h1 class="title">
                读者墙 & 读者墙
            </h1>
            <div class="page-dec"></div>
        </div>
    </div>
    <div class="likepage clearfix">
        <div class="container">
            <?php
            $db = MySql::getInstance();
            $time = time();
            $sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='".$name ."' and url!='' and hide ='n' group by poster order by comment_nums DESC limit 0,200";
            $list = $db->query($sql);
            while($row = $db->fetch_array($list)){ ?>
                        <div class="like-post col-xs-6 col-sm-4 col-md-3">
                        <div class="like-post-box">
                            <a href="<?php echo $row['url']; ?>" target="_blank">
                                <div class="views">
                                    <span class="sealik">评论数 |  </span>
                                    <span class="count num"><?php echo $row['comment_nums'];?>条</span>
                                </div>
                                <div class="title">
                                    <img class="lazy thumbnail" style="float:left;" src="<?php echo Gravatar($row['mail']); ?>" alt="<?php echo $value['title']; ?>" style="display: block;"><h2><?php echo $row['poster']; ?></h2>
                                </div>
                            </a>
                        </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
<?php include View::getView('footer');?>