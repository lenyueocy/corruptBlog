<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<section class="posts main-load">
    <div class="container">
        <div class="imgList">
            <?php
            $id = _g('album_sort');
            $db = MySql::getInstance();
            $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE sortid=$id and hide='n' ORDER BY 'date' DESC";
            $list = $db->query($sql);
            while($row = $db->fetch_array($list)){ 
            ?>

            <div class="imgShow">
            <a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title'];?>">
                <img src="<?php imgsrc($row['content']); ?>" alt="" width="210px" height="215px">
                <div class="mask transition3"><?php echo $row['title']?></div>
            </a>
            </div>
            <?php }?>
    <?php if($row = ''):?>
    <h3 class="searchNo">未找到</h3>
	<p>抱歉，没有符合您查询条件的结果。</p>
	<?php endif;?>
                <nav class="reade_more">
                   	<?php echo diyPageUrl($lognum,$index_lognum,$page,$pageurl);?>
                </nav>
          
        </div>
    </div>
    </section>
<?php
 include View::getView('footer');
?>