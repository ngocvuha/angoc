<script type="text/javascript" src="packages/core/includes/js/table_multi_items.js"></script>
<script src="packages/core/includes/js/resize.js" type="text/javascript"></script>
<script language="javascript">
table_fields = {
	'':''
	,'id':''
	<!--LIST:languages-->
	,'value_[[|languages.id|]]':'text'
	<!--/LIST:languages-->
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
    	<div class="fl title">Quản lý biến ngôn ngữ{{' <span>[ '.([[=module_name=]]?[[=module_name=]].' | ':'').' <a href="package_word.html" style="color:#003399;">Tất cả</a> ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
		<form name="ListPackageWordForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div><!--/IF:cond-->
            <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC" id="main_table">
			<tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
				<td width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="PackageWord_all_checkbox" onclick="select_all_checkbox(this.form,'PackageWord',this.checked,'#FFFFEC','white');"></td>
				<td nowrap width="30%"><a href="{{String::order_by('word.id')}}" class="orderby{{String::order_by_active('word.id')}}" title="[[.sort.]]">Biến ngôn ngữ</a></td>
				<!--LIST:languages-->
				<td nowrap width="30%"><a href="{{String::order_by('word.value_'.[[=languages.id=]])}}" class="orderby{{String::order_by_active('word.value_'.[[=languages.id=]])}}" title="[[.sort.]]">[[|languages.name|]]</a></td>
				<!--/LIST:languages-->
			</tr>
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <td width="1%" align="center"><img src="templates/admin/images/buttons/search.gif" width="18px" /></td>
                <td><input name="search_by_id" type="text" id="search_by_id" class="search-field" /><script type="text/javascript">$('search_by_id').focus();</script></td>
				<!--LIST:languages-->
				<td><input name="search_by_value_[[|languages.id|]]" type="text" class="search-field" /></td>
				<!--/LIST:languages-->
            </tr>
			<!--LIST:items-->
			<tr valign="middle" id="PackageWord_tr_[[|items.id|]]" onclick="edit_row(this,'[[|items.id|]]');" title="Nhấn để sửa">
				<td><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" title="[[|items.i|]]" onclick="select_checkbox(this.form,'PackageWord',this,'#FFFFEC','white');" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
				<td nowrap ><div class="normal_input_text" id="id_[[|items.id|]]">[[|items.id|]]</div></td>
                <!--LIST:languages-->
                <td nowrap><div class="normal_input_text" id="value_[[|languages.id|]]_[[|items.id|]]"><?php echo [[=items=]]['current']['value_'.[[=languages.id=]]];?></div></td>
                <!--/LIST:languages-->
			</tr>
			<!--/LIST:items-->
		</table>
		<input type="hidden" name="edit_ids" value="0<?php foreach([[=items=]] as $id=>$item)echo ','.$id;?>"/>
		<input type="hidden" name="cmd" id="cmd" value="" />
		<input type="hidden" name="page_no" value="<?php echo URL::get('page_no');?>"/>
		<!--IF:delete(URL::get('cmd')=='delete')-->
		<input type="hidden" name="confirm" value="1" />
		<!--/IF:delete-->
		<input type="hidden" name="page_no" value="1"/>
		</form>
        <!--IF:cond([[=paging=]])-->
        <div class="clrfix pad-TB5">
            <div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div>
            <div class="fr"><button onclick="add_row(); window.scrollTo(0,5000);" class="blue-button">Thêm</button></div>
        </div>
        <!--/IF:cond-->
        <div class="clrfix">
        	<div class="fl">
			Lựa chọn:&nbsp;
			<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageWordForm,'PackageWord',true,'#FFFFEC','white');">Tất cả</a>&nbsp;
			<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageWordForm,'PackageWord',false,'#FFFFEC','white');">Bỏ chọn</a>
			<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageWordForm,'PackageWord',-1,'#FFFFEC','white');">Ngược lại</a>
            </div>
            <div class="fr"><a href="javascript:void(0)" onclick="window.scrollTo(0,0);"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]" /></a></div>
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
foreach([[=new_items=]] as $item)
{
echo 'add_row('.String::array2js(array_values($item)).');
';
}
?>
</script>