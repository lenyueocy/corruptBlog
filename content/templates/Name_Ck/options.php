<?php
/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
  'qq' => array(
  		'type' => 'text',
    	'name' => '联系QQ：',
		'default' => '123456789'
	),
  'slidepid' => array(
		'type' => 'text',
		'name' => '首页幻灯片分类ID',
		'default' => '1,2',
		'description' => '用英文逗号隔开可同时指定多个分类',
	),
	'slidepnum' => array(
		'type' => 'text',
		'name' => '首页幻灯片显示数量',
		'default' => '4',
		'description' => '建议为偶数不超过8为宜',
	),
	'hdpbottomcms' => array(
		'type' => 'radio',
		'values' => array(
			'y' => '是',
			'n' => '否'
		),
		'default' => 'y',
		'name' => '首页幻灯片下分类是否显示',
		'description' => '建议为偶数不超过8为宜',
	),
 	 'loding_y' => array(
		'type' => 'radio',
		'values' => array(
			'y' => '是',
			'n' => '否'
		),
		'default' => 'n',
		'name' => '是否开启预加载',
		'description' => '按照个人喜欢来开启',
	),
	'logo' => array(
		'type' => 'radio',
		'name' => '设置LOGO类型',
		'values' => array(
			'image' => '图片',
			'text' => '文字'
		),
		'default' => 'image',
		'description' => '',
	),
	'logopic' => array(
        'type' => 'image',
        'name' => '上传LOGO图片',
        'values' => array(
            TEMPLATE_URL . '/img/logo.png',
        ),
		'description' => '默认尺寸为220X80像素透明PNG图片',
    ),
	'admin' => array(
		'type' => 'radio',
		'name' => '是否显示后台入口',
		'values' => array(
			'y' => '是',
			'n' => '否'
		),
		'default' => 'y',
		'description' => '设置是否显示后台登录入口',
	),
	'index_logs' => array(
		'type' => 'radio',
		'name' => '热门文章或者随机文章',
		'values' => array(
			'y' => '热门文章',
			'n' => '随机文章'
		),
		'default' => 'y',
		'description' => '设置前台侧边两显示热门文章或者随机文章',
	),
  'list_foot' => array(
		'type' => 'radio',
		'name' => '幻灯片下分类是否自定义',
		'values' => array(
			'y' => '是',
			'n' => '否'
		),
		'default' => 'n',
		'description' => '设置幻灯片下的分类',
	),
  'list_url' => array(
		'type' => 'text',
		'name' => '分类链接',
		'default' => 'http://www.yankj.com/,http://www.yankj.com/,http://www.yankj.com/',
		'description' => '用英文逗号隔开指定多个分类链接,不填写三个将会报错',
	),
   'list_name' => array(
		'type' => 'text',
		'name' => '分类名称',
		'default' => '分类一,分类二,分类三',
		'description' => '用英文逗号隔开指定多个分类名称，与上方对应,不填写三个将会报错',
	),
  'list_img' => array(
		'type' => 'text',
		'name' => '分类图片',
		'default' => 'https://www.yankj.com/content/templates/Name_Ck/img/ap4.jpg,https://www.yankj.com/content/templates/Name_Ck/img/ap4.jpg,https://www.yankj.com/content/templates/Name_Ck/img/ap4.jpg',
		'description' => '用英文逗号隔开指定多个分类图片，与上方对应,不填写三个将会报错',
	),
  'qqcomment' => array(
		'type' => 'radio',
		'name' => '是否使用QQ快速资料评论',
		'values' => array(
			'y' => '是',
			'n' => '否'
		),
		'default' => 'y',
		'description' => '设置是否使用QQ快速资料评论',
	),
  'author-img' => array(
		'type' => 'radio',
		'name' => '是否使用QQ头像显示',
		'values' => array(
			'y' => '是',
			'n' => '否'
		),
		'default' => 'y',
		'description' => '设置是否使用QQ头像显示，不是默认显示avatar头像',
	),
  'pretty' => array(
		'type' => 'radio',
		'name' => '是否开启主题自带高亮',
		'values' => array(
			'y' => '是',
			'n' => '否'
		),
		'default' => 'y',
		'description' => '设置是否开启主题自带高亮',
	),
  'listjq' => array(
		'type' => 'radio',
		'name' => '首页幻灯片样式',
		'values' => array(
			'y' => '样式1',
			'n' => '样式2'
		),
		'default' => 'y',
		'description' => '设置首页幻灯片样式',
	),
);