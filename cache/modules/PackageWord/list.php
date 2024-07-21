<script type="text/javascript" src="packages/core/includes/js/table_multi_items.js"></script>
<script src="packages/core/includes/js/resize.js" type="text/javascript"></script>
<script language="javascript">
table_fields = {
	'':''
	,'id':''
	<?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key1=>&$item1){ if($key1!='current'){$this->map['languages']['current'] = &$item1;?>
	,'value_<?php echo $this->map['languages']['current']['id'];?>':'text'
	<?php }}unset($this->map['languages']['current']);} ?>
};
field_error_messages = {};
define_select_fields = {
'':''
}
define_field_actions = {
'':''
}
function update_row(index)
{
}
</script>
<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý biến ngôn ngữ<?php echo ' <span>[ '.($this->map['module_name']?$this->map['module_name'].' | ':'').' <a href="package_word.html" style="color:#003399;">Tất cả</a> ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
		<form name="ListPackageWordForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <div class="clrfix pad-B5">
            <?php if(($this->map['paging'])){?><div class="fl"><?php echo $this->map['paging'];?></div><div class="fl pad-T5">&nbsp;- Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div><?php } ?>
            <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC" id="main_table">
			<tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
				<td width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="PackageWord_all_checkbox" onclick="select_all_checkbox(this.form,'PackageWord',this.checked,'#FFFFEC','white');"></td>
				<td nowrap width="30%"><a href="<?php echo String::order_by('word.id');?>" class="orderby<?php echo String::order_by_active('word.id');?>" title="<?php echo Portal::language('sort');?>">Biến ngôn ngữ</a></td>
				<?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key2=>&$item2){ if($key2!='current'){$this->map['languages']['current'] = &$item2;?>
				<td nowrap width="30%"><a href="<?php echo String::order_by('word.value_'.$this->map['languages']['current']['id']);?>" class="orderby<?php echo String::order_by_active('word.value_'.$this->map['languages']['current']['id']);?>" title="<?php echo Portal::language('sort');?>"><?php echo $this->map['languages']['current']['name'];?></a></td>
				<?php }}unset($this->map['languages']['current']);} ?>
			</tr>
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <td width="1%" align="center"><img src="templates/admin/images/buttons/search.gif" width="18px" /></td>
                <td><input  name="search_by_id" id="search_by_id" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_by_id'));?>"><script type="text/javascript">$('search_by_id').focus();</script></td>
				<?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key3=>&$item3){ if($key3!='current'){$this->map['languages']['current'] = &$item3;?>
				<td><input  name="search_by_value_<?php echo $this->map['languages']['current']['id'];?>" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_by_value_'.$this->map['languages']['current']['id']));?>"></td>
				<?php }}unset($this->map['languages']['current']);} ?>
            </tr>
			<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key4=>&$item4){ if($key4!='current'){$this->map['items']['current'] = &$item4;?>
			<tr valign="middle" id="PackageWord_tr_<?php echo $this->map['items']['current']['id'];?>" onclick="edit_row(this,'<?php echo $this->map['items']['current']['id'];?>');" title="Nhấn để sửa">
				<td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" title="<?php echo $this->map['items']['current']['i'];?>" onclick="select_checkbox(this.form,'PackageWord',this,'#FFFFEC','white');" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
				<td nowrap ><div class="normal_input_text" id="id_<?php echo $this->map['items']['current']['id'];?>"><?php echo $this->map['items']['current']['id'];?></div></td>
                <?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key5=>&$item5){ if($key5!='current'){$this->map['languages']['current'] = &$item5;?>
                <td nowrap><div class="normal_input_text" id="value_<?php echo $this->map['languages']['current']['id'];?>_<?php echo $this->map['items']['current']['id'];?>"><?php echo $this->map['items']['current']['value_'.$this->map['languages']['current']['id']];?></div></td>
                <?php }}unset($this->map['languages']['current']);} ?>
			</tr>
			<?php }}unset($this->map['items']['current']);} ?>
		</table>
		<input type="hidden" name="edit_ids" value="0<?php foreach($this->map['items'] as $id=>$item)echo ','.$id;?>"/>
		<input type="hidden" name="cmd" id="cmd" value="" />
		<input type="hidden" name="page_no" value="<?php echo URL::get('page_no');?>"/>
		<?php if((URL::get('cmd')=='delete')){?>
		<input type="hidden" name="confirm" value="1" />
		<?php } ?>
		<input type="hidden" name="page_no" value="1"/>
		<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
        <?php if(($this->map['paging'])){?>
        <div class="clrfix pad-TB5">
            <div class="fl"><?php echo $this->map['paging'];?></div><div class="fl pad-T5">&nbsp;- Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div>
            <div class="fr"><button onclick="add_row(); window.scrollTo(0,5000);" class="blue-button">Thêm</button></div>
        </div>
        <?php } ?>
        <div class="clrfix">
        	<div class="fl">
			Lựa chọn:&nbsp;
			<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageWordForm,'PackageWord',true,'#FFFFEC','white');">Tất cả</a>&nbsp;
			<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageWordForm,'PackageWord',false,'#FFFFEC','white');">Bỏ chọn</a>
			<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageWordForm,'PackageWord',-1,'#FFFFEC','white');">Ngược lại</a>
            </div>
            <div class="fr"><a href="javascript:void(0)" onclick="window.scrollTo(0,0);"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>" /></a></div>
        </div>
    </div>
</div>
<div id="suggest_box" style="position:absolute; border:1px solid black;background-color:white;display:none;"></div>
<script type="text/javascript">
document.body.onkeydown = function(evt){
	if(!evt)evt=event;
	if(default_onkeydown(evt))
	{
		if(document.all)evt.returnValue=false;
		else return false;
	}
};
function check_error()
{
	var tr = $('main_table').firstChild.nextSibling.firstChild;
	while(tr)
	{
		var div = tr.childNodes[1];
		if(div.firstChild.firstChild&&div.firstChild.firstChild.tagname)
		{
			for(var i in table_fields)
			{
				if(i)
				{
					var value = div.firstChild.firstChild.value;
					if(value!='')
					{
						if(!field_check_error(i,value,table_fields[i]))
						{
							div.firstChild.firstChild.focus();
							if(field_error_messages[i])
							{
								alert(field_error_messages[i]);
							}
							else
							{
								alert('Invalid '+i);
							}
							return false;
						}
					}
					div = div.nextSibling;
				}
			}
		}
		tr = tr.nextSibling;
	}
	return true;
}
<?php 
foreach($this->map['new_items'] as $item)
{
echo 'add_row('.String::array2js(array_values($item)).');
';
}
?>
</script>