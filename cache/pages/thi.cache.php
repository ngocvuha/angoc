<?php
Module::invoke_event('ONLOAD',System::$false,System::$false);
global $blocks;
$blocks = array (
  78655 => 
  array (
    0 => 78655,
    'id' => 78655,
    1 => 6259,
    'module_id' => 6259,
    2 => '10714',
    'page_id' => '10714',
    3 => 0,
    'container_id' => 0,
    4 => 'main',
    'region' => 'main',
    5 => 1,
    'position' => 1,
    6 => 'default',
    'skin_name' => 'default',
    7 => 'default',
    'layout' => 'default',
    8 => '',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => 6259,
      'name' => 'Thi',
      'path' => 'packages/exam/modules/Thi/',
      'type' => '',
      'action_module_id' => 0,
      'use_dblclick' => 0,
      'package_id' => 344,
    ),
  ),
  78657 => 
  array (
    0 => 78657,
    'id' => 78657,
    1 => 6147,
    'module_id' => 6147,
    2 => '10714',
    'page_id' => '10714',
    3 => 0,
    'container_id' => 0,
    4 => 'header',
    'region' => 'header',
    5 => 1,
    'position' => 1,
    6 => 'default',
    'skin_name' => 'default',
    7 => 'default',
    'layout' => 'default',
    8 => '',
    'name' => '',
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => 6147,
      'name' => 'Header',
      'path' => 'packages/frontend/modules/Header/',
      'type' => '',
      'action_module_id' => 0,
      'use_dblclick' => 0,
      'package_id' => 331,
    ),
  ),
  78674 => 
  array (
    0 => 78674,
    'id' => 78674,
    1 => 6263,
    'module_id' => 6263,
    2 => '10714',
    'page_id' => '10714',
    3 => 0,
    'container_id' => 0,
    4 => 'panel',
    'region' => 'panel',
    5 => 1,
    'position' => 1,
    6 => 'default',
    'skin_name' => 'default',
    7 => 'default',
    'layout' => 'default',
    8 => NULL,
    'name' => NULL,
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => 6263,
      'name' => 'Personal',
      'path' => 'packages/user/modules/Personal/',
      'type' => '',
      'action_module_id' => NULL,
      'use_dblclick' => 0,
      'package_id' => 338,
    ),
  ),
  78675 => 
  array (
    0 => 78675,
    'id' => 78675,
    1 => 6122,
    'module_id' => 6122,
    2 => '10714',
    'page_id' => '10714',
    3 => 0,
    'container_id' => 0,
    4 => 'footer',
    'region' => 'footer',
    5 => 1,
    'position' => 1,
    6 => 'default',
    'skin_name' => 'default',
    7 => 'default',
    'layout' => 'default',
    8 => NULL,
    'name' => NULL,
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => 6122,
      'name' => 'Footer',
      'path' => 'packages/frontend/modules/Footer/',
      'type' => '',
      'action_module_id' => 0,
      'use_dblclick' => 0,
      'package_id' => 331,
    ),
  ),
  78676 => 
  array (
    0 => 78676,
    'id' => 78676,
    1 => 6264,
    'module_id' => 6264,
    2 => '10714',
    'page_id' => '10714',
    3 => 0,
    'container_id' => 0,
    4 => 'panel',
    'region' => 'panel',
    5 => 2,
    'position' => 2,
    6 => 'default',
    'skin_name' => 'default',
    7 => 'default',
    'layout' => 'default',
    8 => NULL,
    'name' => NULL,
    'settings' => 
    array (
    ),
    'module' => 
    array (
      'id' => 6264,
      'name' => 'ListQuestion',
      'path' => 'packages/exam/modules/ListQuestion/',
      'type' => '',
      'action_module_id' => NULL,
      'use_dblclick' => 0,
      'package_id' => 344,
    ),
  ),
);
		Portal::$page = array (
  'id' => 10714,
  'package_id' => 342,
  'layout' => 'packages/frontend/layouts/thi.php',
  'name' => 'thi',
  'title_1' => 'Làm bài thi',
  'cachable' => 0,
  'params' => '',
  'hide' => 0,
  'theme' => '',
  'title' => 'Làm bài thi',
);
		foreach($blocks as $id=>$block)
		{
			require_once $block['module']['path'].'class.php';
			$blocks[$id]['object'] = new $block['module']['name']($block);
			if(URL::get('form_block_id')==$id)
			{
				$blocks[$id]['object']->submit();
			}
		}
		require_once 'packages/core/includes/utils/draw.php';
		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo (Portal::$document_title?trim(strip_tags(Portal::$document_title)):Portal::get_setting('website_title'));?></title>
<meta name="description" content="<?php echo Portal::$meta_description?preg_replace(array("'\r\n'","'\t'"),array(" ",""),trim(strip_tags(Portal::$meta_description))):Portal::get_setting('website_description');?>" />
<meta name="keywords" content="<?php echo Portal::$meta_keywords?str_replace(array('&quot;','"','\\'),array('\'','\'',''),trim(strip_tags(Portal::$meta_keywords))):Portal::get_setting('website_keywords');?>" />
<meta name="robots" content="NOINDEX, NOFOLLOW" />
<meta name="google-site-verification" content="<?php echo Portal::get_setting('google-site-verification');?>" />
<meta name="generator" content="Nova 1.0" />
<meta name="copyright" content="<?php echo Portal::get_setting('copyright');?>">
<meta name="author" content="<?php echo Portal::get_setting('author');?>">
<meta property="fb:app_id" content="<?php echo Portal::get_setting('AppId');?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo Seo::$extra_meta;?>
<?php echo Portal::$js_header;?>
<script src="<?php echo BASE;?>packages/core/includes/js/common.js" type="text/javascript"></script>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php echo Portal::$css_header;?>
<?php if(Portal::get_setting('site_icon') and file_exists(Portal::get_setting('site_icon'))){ ?><link rel="shortcut icon" href="<?php echo Portal::get_setting('site_icon');?>" /><?php }?>
<?php echo Portal::$extra_header;?>
</head>
<body>
<?php if($appId = Portal::get_setting('AppId')){ ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=<?php echo $appId;?>&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php } ?><div class="container">
	<header>
		<div class="header">
<?php $blocks[78657]['object']->on_draw();?></div>
		<span class="glyphicon glyphicon-th" id="openPanel"></span>
	</header>
	<div class="content clearfix" data-spy="scroll" data-target=".question-list" data-offset="200">		
		<div id="panel" data-spy="affix" data-offset-top="100">
			
<?php $blocks[78674]['object']->on_draw();?>
<?php $blocks[78676]['object']->on_draw();?>
		</div>
		<div class="panelOut">
<?php $blocks[78655]['object']->on_draw();?></div>
		
	</div>
	<footer id="footer">
		<div class="footer">
<?php $blocks[78675]['object']->on_draw();?></div></div>
	</footer>
</div>
<script>
	jQuery(function(){
		jQuery('#panel').css('height',jQuery('#panel').height()+100);
		jQuery('#openPanel').click(function()
		{
			if(jQuery("#panel").is(':visible')===true){
				jQuery("#panel").animate({'width':'toggle'},300,function(){
					jQuery('.panelOut').addClass('panelOutFull');
				});
			}else{
				jQuery('.panelOut').removeClass('panelOutFull');
				jQuery("#panel").animate({'width':'toggle'},500);
			}			
		});
		jQuery('.content').scrollspy({ target: '#question-list' })		
	})
</script><?php echo Portal::$extra_footer; echo Portal::get_setting('google_analytics');?>
</body>
</html>
<?php Module::invoke_event('ONUNLOAD',System::$false,System::$false);?>