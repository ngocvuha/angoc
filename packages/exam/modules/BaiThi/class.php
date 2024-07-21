<?php
/******************************
WRITTEN BY minhtc
******************************/
class BaiThi extends Module
{
	function BaiThi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new BaiThiForm);
	}
}
?>
