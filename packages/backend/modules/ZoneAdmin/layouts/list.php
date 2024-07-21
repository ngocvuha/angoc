<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form name="ListCategoryForm" id="ListCategoryForm" method="post">
           <fieldset style="background-color:#f9f9f9; margin:0; border:1px dashed #ccc; margin-bottom:5px;">
                <legend><strong>Thêm khu vực</strong></legend>
                <div class="fl">
                <label for="name" style="display:block;"><em class="require">(*)</em>Tên khu vực</label><input name="name" type="text" id="name" autofocus />
                </div>
                <div class="fl mar-LR10">
                <label for="parent_id" style="display:block;">Khu vực cha:</label><select name="parent_id" id="parent_id" onchange="window.location='{{Url::build_current()}}?parent_id='+this.value"></select>
                </div>
                <div class="fl" style="margin-top:15px;">
                <input type="submit" class="red-button" value="Ghi lại" style="padding:0;" />
                </div>
            </fieldset>	
            <table width="100%" cellpadding="2" cellspacing="0" border="1" bordercolor="#CCCCCC">
                <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                    <th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'#FFFFEC','white');" /></th>
                    <th nowrap align="left">[[.name.]]</th>
                    <!--IF:can(User::can_edit())-->
                    <th colspan="3" nowrap="nowrap" style="text-align:center;">[[.action.]]</th>
                    <!--/IF:can-->
                </tr><.$i=0;.>
                <!--LIST:items-->
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?> style="<.if($i%2){echo 'background-color:#F9F9F9';} $i++;.>" id="Category_tr_[[|items.id|]]">
                    <td align="center">
                    <!--IF:cond(User::can_delete() and [[=items.structure_id=]]!=ID_ROOT)-->
                    <input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'Category',this,'#FFFFEC','white');" id="Category_checkbox" />
                    <!--ELSE-->
                    --
                    <!--/IF:cond-->
                    </td>
                    <td nowrap>
                            [[|items.indent|]]
                            [[|items.indent_image|]]
                            <span class="page_indent">&nbsp;</span>
                            <strong style="color:#F00">[[|items.id|]].</strong> [[|items.name|]]</td>
                    <!--IF:can(User::can_edit())-->
                    <td width="24" align="center" title="[[.edit.]]">
                        <!--IF:cond([[=items.structure_id=]]<>ID_ROOT and IDStructure::level([[=items.structure_id=]])>1)-->
                        <a href="{{Url::build_current(array('parent_id'=>[[=items.parent_id=]],'id'=>[[=items.id=]]))}}"><img src="{{'templates/admin/images/buttons/edit.jpg'}}" /></a>
                        <!--/IF:cond-->
                    </td>
                    <td width="24" align="center" title="[[.up.]]"><a href="{{Url::build_current(array('cmd'=>'move_up','parent_id'=>[[=items.parent_id=]],'id'=>[[=items.id=]]))}}">[[|items.move_up|]]</a></td>
                    <td width="24" align="center" title="[[.down.]]"><a href="{{Url::build_current(array('cmd'=>'move_down','parent_id'=>[[=items.parent_id=]],'id'=>[[=items.id=]]))}}">[[|items.move_down|]]</a></td>
                    <!--/IF:can-->
                </tr>
                <!--/LIST:items-->
            </table>
            <div class="clrfix pad-TB5">
                <div class="fl">
                    [[.select.]]:&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
                </div>
                <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
            </div>
            <input type="hidden" name="cmd" value="" id="cmd"/><input type="hidden" name="block_id" value="{{Module::block_id()}}" id="block_id"/>
        </form>
    </div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery('#ListCategoryForm').submit(function(){
		var block_id=$('block_id').value;
		return saveZone(block_id);
	});
});
function saveZone(block_id){
	var check=true;
	__valid('name');
	if(jQuery('#name').val()==''){
		__validate('name','Hãy nhập tên khu vực');check=false;
	}else{
		var check_duplicate=check_ajax(block_id,{'cmd':'duplicate','name':jQuery('#name').val(),'parent_id':jQuery('#parent_id').val()});
		if(check_duplicate=='true'){
			__validate('name','Tên khu vực bị trùng');check=false;
		}
	}
	return check;
}
</script>