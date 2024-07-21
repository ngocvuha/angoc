<?php
class HeaderForm extends Form
{
	function HeaderForm($row)
	{
		Form::Form('HeaderForm');
		$this->link_js('lib/js/jquery/jquery.min.js');
		$this->link_js('lib/js/jquery/jqueryui.js');
		$this->link_js('lib/js/jquery/jquery.downCount.js');
		$this->link_js('lib/js/jquery/jquery.line.js');
		$this->link_js('lib/js/jquery/mediaelement-and-player.min.js');
		$this->link_css('templates/web/css/bootstrap.min.css');
		$this->link_css('templates/web/css/bootstrap-theme.min.css');
		$this->link_css('templates/web/css/styles.css');
		$this->link_css('templates/web/css/navbar.css');
		$this->link_css('templates/web/css/mediaelementplayer.min.css');
	}
	function draw()
	{
		$this->map = array();
		$this->parse_layout('list',$this->map);
	}
}
?>