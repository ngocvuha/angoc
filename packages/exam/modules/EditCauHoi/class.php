<?php 
//ini_set('display_errors',1);
class EditCauHoi extends Module
{
	function EditCauHoi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY)){			
			if(Url::nget('cmd')=='update'){
				$this->update();
			}else{
				require_once 'forms/list.php';
				$this->add_form(new ListEditCauHoi());
			}
		}else{
			Url::access_denied();
		}
	}
	function update(){
		
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
