<?php
class ListLanguageForm extends Form
{
	function ListLanguageForm()
	{
		Form::Form('ListLanguageForm');
	}
	function on_submit()
	{
		if(URL::get('confirm'))
		{
			require_once 'detail.php';
			foreach(URL::get('selected_ids') as $id)
			{
				if($item = DB::exists_id('language',$id))
				{
					save_recycle_bin('language',$item);
					LanguageForm::delete($this,$id);
					save_log($id);
				}	
			}
			Url::redirect_current(array());
		}
	}
	function draw()
	{
		$items = DB::select_all('language','1','language.main desc,status desc,position desc');
		$this->parse_layout('list',array(
			'items'=>$items
		));
	}
}
?>