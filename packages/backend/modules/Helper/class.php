<?php
class Helper extends Module
{
	function Helper($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view())
		{
			if(Url::get('cmd')=='get_content'){
				$this->get_content(); exit();
			}
			require_once 'forms/list.php';
			$this->add_form(new HelperForm());
		}
		else
		{
			Url::access_denied();
		}
	}
	function get_content(){
		if($id=Url::iget('id') and $item=HelperDB::get_item('helper.category_id='.$id)){
			$content='<div class="helper-name">'.$item['name'].'</div><div class="helper-description">'.str_replace("\r\n","",$item['description']).'</div>';
			echo $content; exit();
		}
	}
	static function check_class($havechild,$total,$i){
		$class='';
		if($havechild){
			$class.='havechild-close';
			if($i==$total){
				$class.=' havechild-close-end';
			}
		}else{
			$class.='isfile';
			if($i==$total){
				$class.=' isfile-end';
			}
		}
		return $class;
	}
}
?>
