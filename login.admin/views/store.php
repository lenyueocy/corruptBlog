<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
        <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="./"><i class="icon icon-home"></i> 首页</a></li>

                          <li class="active">应用中心</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>
<iframe src="<?php echo OFFICIAL_SERVICE_HOST;?>store/<?php echo Option::EMLOG_VERSION; ?>/<?php echo $site_url_encode; ?>" id="main external-frame" onload="setIframeHeight(this)" name="main" width="100%" height="910" frameborder="0" scrolling="yes" style="overflow: visible;display:"></iframe>
<script>

function setIframeHeight(iframe) {
if (iframe) {
var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
if (iframeWin.document.body) {
iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
}
}
};

window.onload = function () {
setIframeHeight(document.getElementById('external-frame'));
};
$("#menu_store").addClass('sidebarsubmenu1');
</script>