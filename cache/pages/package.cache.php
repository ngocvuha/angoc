<?php
Module::invoke_event('ONLOAD',System::$false,System::$false);
global $blocks;
$blocks = array (
  77417 => 
  array (
    0 => 77417,
    'id' => 77417,
    1 => 5897,
    'module_id' => 5897,
    2 => '10193',
    'page_id' => '10193',
    3 => 0,
    'container_id' => 0,
    4 => 'content',
    'region' => 'content',
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
      'id' => 5897,
      'name' => 'Menu',
      'path' => 'packages/backend/modules/Menu/',
      'type' => '',
      'action_module_id' => 0,
      'use_dblclick' => 0,
      'package_id' => 332,
    ),
  ),
  71436 => 
  array (
    0 => 71436,
    'id' => 71436,
    1 => 5896,
    'module_id' => 5896,
    2 => '10193',
    'page_id' => '10193',
    3 => 0,
    'container_id' => 0,
    4 => 'content',
    'region' => 'content',
    5 => 2,
    'position' => 2,
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
      'id' => 5896,
      'name' => 'PackageAdmin',
      'path' => 'packages/core/modules/PackageAdmin/',
      'type' => '',
      'action_module_id' => 0,
      'use_dblclick' => 0,
      'package_id' => 2,
    ),
  ),
);
		Portal::$page = array (
  'id' => 10193,
  'package_id' => 2,
  'layout' => 'packages/core/layouts/simple.php',
  'name' => 'package',
  'title_1' => 'Quản lý Package',
  'cachable' => 0,
  'params' => '',
  'hide' => 0,
  'theme' => 'web',
  'title' => 'Quản lý Package',
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
<?php } ?>
<?php $blocks[77417]['object']->on_draw();?>
<?php $blocks[71436]['object']->on_draw();?><?php echo Portal::$extra_footer; echo Portal::get_setting('google_analytics');?>
</body>
</html>
<?php Module::invoke_event('ONUNLOAD',System::$false,System::$false);?>