<?php
class ListQuestion extends Module
{
	function ListQuestion($row)
	{
		Module::Module($row);		
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new ListQuestionForm);
	}
}
?>