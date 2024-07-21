<?php 
class Language extends Module
{
	function Language($row)
	{
		if(User::can_admin(MODULE_LANGUAGE,ANY_CATEGORY))
		{
			Module::Module($row);
			require_once 'db.php';
			if(URL::nget('cmd')=='delete' and $field=Url::get('field') and $id=Url::iget('id')){
				$this->delete($field,$id);
				Url::redirect_current(array('cmd'=>'edit','id'=>$id));
			}else{
				switch(URL::get('cmd'))
				{
					case 'edit':
					case 'add':
						require_once 'forms/edit.php';
						$this->add_form(new EditLanguageForm());break;
					default: 
						require_once 'forms/list.php';
						$this->add_form(new ListLanguageForm());
						break;
				}
			}
		}
		else
		{
			URL::access_denied();
		}
	}
	function delete($field,$id){
		if($item=DB::exists_id('language',$id) and isset($item[$field])){
			if(file_exists($item[$field])){
				@unlink($item[$field]);
			}
			if($item[$field]!=''){
				DB::update_id('language',array($field=>''),$id);
			}
		}
	}
	function update_portal_language()
	{
		@unlink('cache/tables/language.cache.php');
		$query = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($query))
		{
			Language::update_table_language($row[0]);
		}
		Portal::make_word_cache();
	}
	function update_table_language($table)
	{
		$query = mysql_query('DESCRIBE `'.$table.'`');
		$fields = array();
		while($row = mysql_fetch_row($query))
		{
			if(preg_match('/(\w+)\_(\d+)$/',$row[0], $patterns))
			{
				$fields[$patterns[1]][$patterns[2]] = $row[1];
			}
		}
		if($fields){
			foreach($fields as $name=>$field)
			{
				Language::update_row_language($table,$name,$field);
			}
		}
	}
	function update_row_language($table, $field, $language_ids)
	{
		$languages = DB::fetch_all('SELECT id,status FROM language where status');
		foreach($languages as $language)
		{
			if(!isset($language_ids[$language['id']]))
			{
				DB::query('ALTER TABLE `'.$table.'` ADD `'.$field.'_'.$language['id'].'` '.$language_ids[1].' NOT NULL AFTER `'.$field.'_1` ;');
			}
		}
		foreach($language_ids as $language_id=>$type)
		{
			if(!isset($languages[$language_id]) and $table<>'word')
			{
				DB::query('ALTER TABLE `'.$table.'` DROP `'.$field.'_'.$language_id.'`');
			}
		}
	}
	function make_cache_language(){
		$language = DB::fetch_all('
			select 
				*
			from 
			 	language
			where
				status
			order by
				language.main desc,status desc,position desc
		');
		$path='cache/tables/language.cache.php';
		File::export_file($path,'cache_language',$language);
	}
}
?>