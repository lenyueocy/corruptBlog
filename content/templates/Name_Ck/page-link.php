<?php 
/**
 * 友情链接
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="page-single">
    <div class="page-title" style="background-image:url(<?php echo TEMPLATE_URL; ?>img/page_bg.jpg);">
        <div class="container">
            <h1 class="title">
                友情链接
            </h1>
            <div class="page-dec"></div>
        </div>
    </div>
    <div class="container">
        <div class="page-content">
            <div class="link-title"><span>好基友</span></div>
            <ul class="link-items fontSmooth">
                <?php
                global $CACHE; 
                $link_cache = $CACHE->readCache('link');
                foreach($link_cache as $value): ?>
                <li class="link-item">
                    <a class="link-item-inner effect-apollo" href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank" rel="">
                        <img src="<?php echo $value['url']; ?>/favicon.ico" >
                        <span class="sitename"><?php echo $value['link']; ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php include View::getView('footer');?>