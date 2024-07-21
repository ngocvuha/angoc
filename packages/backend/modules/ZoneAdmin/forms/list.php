<?php
class ListZoneAdminForm extends Form
{
	function ListZoneAdminForm()
	{
		Form::Form('ListZoneAdminForm');
	}
	function on_submit()
	{
		if(Url::get('form_block_id')==Module::block_id() and $parent_id=Url::iget('parent_id'))
		{
			require_once 'packages/core/includes/system/si_database.php';
			if($id=Url::iget('id') and $zone=DB::exists_id('zone',$id)){
				$arr=array('name'=>Url::sget('name'));
				if(IDStructure::parent($zone['structure_id'])<>DB::structure_id('zone',Url::iget('parent_id'))){
					$arr+=array('structure_id'=>si_child('zone',structure_id('zone',$parent_id)));
				}
				$id=DB::update_id('zone',$arr,$id);
			}else{
				$id = DB::insert('zone',array(
					'name'=>Url::sget('name')
					,'structure_id'=>si_child('zone',structure_id('zone',$parent_id))
				));
			}
			if(isset($id))
			{
				ZoneAdmin::export_cache();
				Url::redirect_current(array('parent_id'));
			}
		}
	}
	function draw()
	{	
		$cond=IDStructure::child_cond(DB::structure_id('zone',Url::iget('parent_id',1)));
		$this->map['items'] = ZoneAdminDB::get_zone($cond);
		require_once 'packages/core/includes/system/si_database.php';
		foreach($this->map['items'] as $key=>$value){
			$this->map['items'][$key]['parent_id']=si_parent_id('zone',$value['structure_id']);
		}
		require_once 'packages/core/includes/utils/category.php';
		category_indent($this->map['items']);
		$this->map['parent_id_list']=String::get_list(ZoneAdminDB::get_zone(IDStructure::child_cond(ID_ROOT).' and structure_id<>'.ID_ROOT));
		if($id=Url::iget('id') and $zone=DB::exists_id('zone',$id)){
			foreach($zone as $key=>$value)
			{
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
		}
		$this->parse_layout('list',$this->map);
	}	
}
?>