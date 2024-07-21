<?php
class Iframe extends Module
{
	function Iframe($row)
	{
		Module::Module($row);
		require_once 'forms/list.php';
		$this->add_form(new IframeForm());
	}
}
?>
