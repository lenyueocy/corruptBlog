<?php 
/* 
Custom:page-music
Description:音乐歌单
*/  
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<link href="<?php echo TEMPLATE_URL; ?>static/music.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/theia-sticky-sidebar.js?ver=v1.2.9'></script>

<?php
$id = _g('music_id');
$arr = file_get_contents('https://music.163.com/api/playlist/detail?id='.$id);
$arr = json_decode($arr,true);
$arr['result']['tracks'] = array_slice($arr['result']['tracks'],0,30);
?>
<section class="container main-load">
    <div id="rollstart"></div>  
            <div class="jAudio--player">
            <div class="grid-3">
                <div class="music-left">
                    <audio></audio>
                    <div class="jAudio--ui">
                        <div class="sinkey-thumb">
                            <div class="jAudio--thumb"></div>
                        </div>
                        <div class="sinkey-status">
                            <div class="jAudio--status-bar">
                                <div class="jAudio--details"></div>
                                <div class="jAudio--progress-bar">
                                    <div class="jAudio--progress-bar-wrapper">
                                        <div class="jAudio--progress-bar-played">
                                            <span class="jAudio--progress-bar-pointer"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="jAudio--time">
                                    <span class="jAudio--time-elapsed">00:00</span>
                                    <span class="jAudio--time-total">00:00</span>
                                </div>

                                <div class="jAudio--controls">
                                    <ul>
                                        <li><button class="btn" data-action="prev" id="btn-prev"><span></span></button></li>
                                        <li><button class="btn" data-action="play" id="btn-play"><span></span></button></li>
                                        <li><button class="btn" data-action="next" id="btn-next"><span></span></button></li>
                                    </ul>
                                </div>

                                <div class="jAudio--volume-bar">
                                    <div class="jAudio--volume-bar-wrapper">
                                        <div class="jAudio--volume-bar-played">
                                            <span class="jAudio--volume-bar-pointer"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-9">
                <div id="jAudio_right">
                    <div class="jAudio--playlist"></div>

                </div>
            </div>
        </div>

</section>
<?php
$list   = array();
foreach($arr['result']['tracks'] as $v){
    $list[] = array(
        "file"          => "https://xxser.cn/api/music.php?vid=".$v['id'],
        "thumb"         => str_replace('http://', 'https://', $v['album']['picUrl']),
        "trackName"     => $v['name'],
        "trackArtist"   => '',
        "trackAlbum"    => $v['artists'][0]['name'],
        "trackTime"         => str_replace('.',':',sprintf("%.2f", $v['duration']/1000/60))
    );
}
$list   = json_encode($list);
?>
<script type="text/javascript">
    jQuery('.grid-3').theiaStickySidebar({
      // Settings
      additionalMarginTop: 60
    });
  <?php if (is_mobile() ): ?>
  <?php else: ?>
  $('.grid-3').css("position","absolute");
  <?php endif ;?>
</script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/music.js'></script>
<script>
  
    var t = {
        playlist:<?=$list?>,
        autoPlay:false
    }

    $(".jAudio--player").jAudio(t);
    $("#btn-play").trigger("click");

</script>

<?php
 include View::getView('footer');
?>