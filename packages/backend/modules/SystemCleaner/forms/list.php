<?php
class SystemCleanerForm extends Form
{
	function SystemCleanerForm()
	{
		Form::Form('SystemCleanerForm');
	}
	function on_submit()
	{
		if($items=Url::get('selected_ids')){
			require_once 'packages/core/includes/utils/dir.php';
			foreach($items as $v){
				if($v==1){
					$this->cleaner_1(); // xóa cache css
				}elseif($v==2){
					$this->cleaner_2(); // xóa cache html
				}elseif($v==3){
					$this->cleaner_3(); // xóa cache db
				}elseif($v==4){
					$this->cleaner_4(); // xóa cache modules
				}elseif($v==5){
					$this->cleaner_5(); // xóa cache pages
				}elseif($v==6){
					$this->cleaner_6(); // xóa cache timthumb
				}
			}
		}
		Url::redirect_current();
	}
	function cleaner_1(){
		$folder='cache/css/';
		empty_all_dir($folder);
	}
	function cleaner_2(){
		$folder='cache/html/';
		empty_all_dir($folder);
	}
	function cleaner_3(){
		$folder='cache/db/';
		empty_all_dir($folder);
	}
	function cleaner_4(){
		$folder='cache/modules/';
		empty_all_dir($folder);
	}
	function cleaner_5(){
		$folder='cache/pages/';
		empty_all_dir($folder);
	}
	function cleaner_6(){
		$folder='timthumb/cache/';
		empty_all_dir($folder);
	}
	function draw()
	{
		$this->map = array();
		$this->parse_layout('list',$this->map);
	}
}
?>