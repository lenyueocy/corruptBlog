<?php 
/**
 * 默认模版
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div id="page-content">
<div class="container">
<div class="row">
<div class="article col-xs-12 col-sm-8 col-md-8">
<div class="post-timthumb" style="background-image: url(<?php echo TEMPLATE_URL."img/ap".rand(0,10).".jpg"; ?>);"><h1><?php topflg($top); ?><?php echo $log_title; ?></h1></div><div class="post">

<div class="post-content">
<?php echo $log_content; ?>

</div>
</div>
  </div>
<div class="article col-xs-12 col-sm-8 col-md-4 sidebar">
<?php require_once View::getView('side');?>
</div></div></div>
</div>


<?php
 include View::getView('footer');
?>