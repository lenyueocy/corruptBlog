<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Language" content="zh-CN" />
<meta name="author" content="emlog" />
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=8" />
    <title>管理中心 - <?php echo Option::get('blogname'); ?></title>
    <!-- Bootstrap core CSS -->
    <link href="./views/css/bootstrap.min.css" rel="stylesheet">
    <link href="./views/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="./views/assets/font-awesome/css/font-awesome.css" rel="stylesheet">




    <!-- Custom styles for this template -->

    <link href="./views/css/style.css" rel="stylesheet">
    <link href="./views/css/style-responsive.css" rel="stylesheet">


    <!--[if lt IE 9]>
      <script src="./views/js/html5shiv.js"></script>
      <script src="./views/js/respond.min.js"></script>
    <![endif]-->
    


    
    
<script type="text/javascript" src="../include/lib/js/jquery/jquery-1.7.1.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript" src="../include/lib/js/jquery/plugin-cookie.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript" src="./views/js/common.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>

   

<?php doAction('adm_head');?>
</head>


<body>
  <section id="containerx" >
      <!--header start-->
   <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div  class="icon-reorder tooltips"></div>
            </div>
            
            <!--logo start-->
            
            <a href="./" title="返回管理首页" class="logo">EM<span>LOG</span></a>
            <!--logo end-->
            
            
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                
                <ul class="nav top-menu">
                    <!-- settings start -->
                     <?php

        $checknum = $sta_cache['checknum'];

		if (ROLE == ROLE_ADMIN && $checknum > 0):

		$n = $checknum > 999 ? '...' : $checknum;

		?>
                    <li class="dropdown">
                        <a href="./admin_log.php?checked=n" title="<?php echo $checknum; ?>篇文章待审">
                            <i class="icon-tasks"></i>
                            <span class="badge bg-success"><?php echo $n; ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <?php

		$hidecmnum = ROLE == ROLE_ADMIN ? $sta_cache['hidecomnum'] : $sta_cache[UID]['hidecommentnum'];

		if ($hidecmnum > 0):

		$n = $hidecmnum > 999 ? '...' : $hidecmnum;

		?>
                    <li id="header_inbox_bar" class="dropdown">
                        <a href="./comment.php?hide=y" title="<?php echo $hidecmnum; ?>条评论待审">
                            <i class="icon-envelope-alt"></i>
                            <span class="badge bg-important"><?php echo $n; ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    
                    <li id="header_notification_bar" class="dropdown">
                        <a href="admin_log.php?pid=draft">

                            <i class="icon-bell-alt"></i>
                            <span class="badge bg-warning"><?php 

		if (ROLE == ROLE_ADMIN){

			echo $sta_cache['draftnum'] == 0 ? '' : '('.$sta_cache['draftnum'].')'; 

		}else{

			echo $sta_cache[UID]['draftnum'] == 0 ? '' : '('.$sta_cache[UID]['draftnum'].')';

		}

		?></span>
                        </a>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                            <form action="admin_log.php" method="get">
            <input type="text" name="keyword" class="form-control search" placeholder="搜索文章">
        <?php if($pid):?>
        <input type="hidden" id="pid" name="pid" value="draft">
        <?php endif;?>
        </form>
                    

                        
                        
                        
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img src="<?php echo empty($user_cache[UID]['avatar']) ? './views/images/avatar.jpg' : '../' . $user_cache[UID]['avatar'] ?>" align="top" width="29" height="29" >
                            <span class="username"><?php echo subString($user_cache[UID]['name'], 0, 12) ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="../"><i class=" icon-reply"></i>返回首页</a></li>
                            <?php if (ROLE == ROLE_ADMIN):?>
                            <li><a href="configure.php"><i class="icon-cog"></i>基本设置</a></li>
                            <li><a href="seo.php"><i class="icon-user-md"></i>SEO设置</a></li>
                            <?php endif;?>
                            <li><a href="./?action=logout"><i class="icon-key"></i>退出</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      
      
      <!--sidebar start-->
     <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="active">
                      <a class="" href="./">
                          <i class="icon-dashboard"></i>
                          <span>管理面板</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>文章管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                                                 <li><a class="" href="admin_log.php">所有文章</a></li>

                           <li><a class="" href="twitter.php">微语</a></li>
                          <li><a class="" href="admin_log.php?pid=draft">草稿</a></li>
                          <li><a class="" href="write_log.php">写文章</a></li>
                      </ul>
                  </li>
                                      <li>
                      <a class="" href="comment.php">
                          <i class="icon-comments"></i>
                          <span>博客评论 </span>
                      </a>
                  </li>
                  
                        <?php if (ROLE == ROLE_ADMIN):?>     
                                    <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-cogs"></i>
                          <span>相关设置</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="widgets.php">侧边栏</a></li>
                          <li><a class="" href="navbar.php">导航</a></li>
                          <li><a class="" href="page.php">页面</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-tasks"></i>
                          <span>文章设置</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="tag.php">标签</a></li>
                          <li><a class="" href="sort.php">分类</a></li>
                      </ul>
                  </li>
                  

                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-gear"></i>
                          <span>系统设置</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="data.php">数据</a></li>
                          <li><a class="" href="link.php">链接</a></li>
                          <li><a  class="" href="plugin.php">插件</a></li>
                          <li><a  class="" href="template.php">模板</a></li>
                      </ul>
                  </li>
                  
                                    <?php endif;?>
                
                   <?php if (ROLE == ROLE_ADMIN):?>

                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-ticket"></i>
                          <span>扩展功能</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub" id="extend_mg">


		
                  <?php doAction('adm_sidebar_ext'); ?>


    
                      </ul>
                  </li>

                  <li>
                      <a class="" href="user.php">
                          <i class="icon-group"></i>
                          <span>用户管理</span>
                      </a>
                  </li>
                  
                                    <?php endif;?>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>

  <script src="./views/js/common-scripts.js"></script>        
      <!--sidebar end-->
      <section id="main-content" ">

          <section class="wrapper" >

<?php doAction('adm_main_top'); ?>

            

