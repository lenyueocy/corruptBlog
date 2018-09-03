<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

          <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon icon-location-arrow"></i> 编辑导航
                </div>

                          <div class="panel-body">
                              <div class="tab-content">

<form action="navbar.php?action=update" method="post">
<div class="form-group form-inline">
    <li>
    <label>导航名称</label><br/>
        <input size="20" class="form-control" value="<?php echo $naviname; ?>" name="naviname" /> 

        
        
    </li>
    <li>
    <label>导航地址</label><br/>
        <input size="40" class="form-control" value="<?php echo $url; ?>" name="url" <?php echo $conf_isdefault; ?> /> 
    </li>
    <li class="checkbox">
        <label><input type="checkbox" value="y" name="newtab" <?php echo $conf_newtab; ?> /> 在新窗口打开</label>
    </li>
    <?php if ($type == Navi_Model::navitype_custom && $pid != 0): ?>
    <li>
            <select name="pid" id="pid" class="form-control">
                <option value="0">无</option>
                <?php
                    foreach($navis as $key=>$value):
                        if($value['type'] != Navi_Model::navitype_custom || $value['pid'] != 0) {
                            continue;
                        }
                        $flg = $value['id'] == $pid ? 'selected' : '';
                ?>
                <option value="<?php echo $value['id']; ?>" <?php echo $flg;?>><?php echo $value['naviname']; ?></option>
                <?php endforeach; ?>
            </select>
            父导航
    </li>
    <?php endif; ?>
    <li>
    <input type="hidden" value="<?php echo $naviId; ?>" name="navid" />
    <input type="hidden" value="<?php echo $isdefault; ?>" name="isdefault" />
    <input type="submit" value="保 存" class="btn btn-primary" />
    <input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" />
    </li>
</div>
</form>
</div></div></div>
<script>
$("#menu_navbar").addClass('active');
</script>