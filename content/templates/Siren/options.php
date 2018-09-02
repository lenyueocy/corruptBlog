<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
	'Siren_bg' => array(
		'type' => 'image',
		'name' => '默认头图',
		'description' => '背景图',
		'values' => array(
            TEMPLATE_URL . 'images/hd.jpg',
        ),
    ),
	'Siren_tx' => array(
		'type' => 'image',
		'name' => '头像',
		'values' => array(
            TEMPLATE_URL . 'images/avatar.jpg',
        ),
    ),
	'Siren_name' =>array(
		'type' => 'text',
		'name' => '昵称',
		'description' => '',
		'values' => array(
			'瑾忆',
		),
	),
	'Siren_qm' => array(
		'type' => 'text',
		'name' => '个性签名',
		'description' => '建议不要太多字',
		'default' => '公交车司机终于在众人的指责中将座位让给了老太太',
    ),




);