<?php 
class PhucTra extends Module
{
	function PhucTra($row)
	{
		Module::Module($row);
		require_once 'db.php';
		$cmd = Url::get('cmd');
		switch($cmd){
			case 'view': $this->view(); break;
			default: $this->view();
		}
	}
	function _list(){
		require_once 'forms/list.php';
		$this->add_form(new PhucTraListForm());	
	}
	function view(){
		require_once 'forms/thi.php';
		$this->add_form(new PhucTraTestForm());	
	}
}
?>