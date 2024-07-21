<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
    	<form name="ListModuleSettingForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div><!--/IF:cond-->
            <div class="fr">Module: <select name="module_id" id="module_id" onchange="location='<?php echo URL::build_current();?>?module_id='+this.value;"></select></div>
        </div>
		<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
			<tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
				<th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="ModuleSetting_all_checkbox" onclick="select_all_checkbox(this.form,'ModuleSetting',this.checked,'#FFFFEC','white');"></th>
				<th nowrap align="left" >[[.id.]]</th>
				<th nowrap align="left" >[[.module_name.]]</th>
				<th nowrap align="left" >[[.name.]]</th>
                <th nowrap align="left" >[[.group_name.]]</th>
                <th nowrap align="right" >[[.position.]]</th>
			</tr>
			<!--LIST:items-->
			<tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="cursor:pointer;" id="ModuleSetting_tr_[[|items.module_id|]]_[[|items.id|]]">
				<td><input name="selected_ids[]" type="checkbox" value="[[|items.module_id|]]_[[|items.id|]]" onclick="select_checkbox(this.form,'ModuleSetting',this,'#FFFFEC','white');"></td>
				<td nowrap align="left" onclick="location='{{URL::build_current(array('cmd'=>'edit','id'=>[[=items.module_id=]].'_'.[[=items.id=]]))}}';">[[|items.id|]]</td>
				<td nowrap align="left" onclick="location='{{URL::build_current(array('cmd'=>'edit','id'=>[[=items.module_id=]].'_'.[[=items.id=]]))}}';">[[|items.module_name|]]</td>
				<td nowrap align="left" onclick="location='{{URL::build_current(array('cmd'=>'edit','id'=>[[=items.module_id=]].'_'.[[=items.id=]]))}}';">[[|items.name|]]</td>
                <td nowrap align="left" onclick="location='{{URL::build_current(array('cmd'=>'edit','id'=>[[=items.module_id=]].'_'.[[=items.id=]]))}}';">[[|items.group_name|]]</td>
                <td nowrap align="right" onclick="location='{{URL::build_current(array('cmd'=>'edit','id'=>[[=items.module_id=]].'_'.[[=items.id=]]))}}';">[[|items.position|]]</td>
			</tr>
			<!--/LIST:items-->
		</table>
        <input type="hidden" name="cmd" id="cmd" value="" />
        </form>
        <!--IF:cond([[=paging=]])-->
        <div class="clrfix pad-B5">
            <div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div>
        </div>
        <!--/IF:cond-->
        <div class="clrfix pad-TB5">
        	<div class="fl">
                [[.select.]]:&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleSettingForm,'ModuleSetting',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleSettingForm,'ModuleSetting',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleSettingForm,'ModuleSetting',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
            </div>
            <div class="fr"><a href="javascript:void(0)" onclick="window.scrollTo(0,0);"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
        </div>
    </div>
</div>