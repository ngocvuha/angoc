<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
		<form name="ListModuleAdminForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div><!--/IF:cond-->
            <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="ModuleAdmin_all_checkbox" onclick="select_all_checkbox(this.form,'ModuleAdmin',this.checked,'#FFFFEC','white');"></th>
                <th nowrap align="left"><a href="{{String::order_by('module.name')}}" class="orderby{{String::order_by_active('module.name')}}" title="[[.sort.]]">[[.name.]]</a></th>
                <th width="30%" nowrap align="left"><a href="{{String::order_by('module.title_1')}}" class="orderby{{String::order_by_active('module.title_1')}}" title="[[.sort.]]">[[.title.]]</a></th>
                <th width="30%" nowrap align="left"><a href="{{String::order_by('package.name')}}" class="orderby{{String::order_by_active('package.name')}}" title="[[.sort.]]">[[.package.]]</a></th>
                <!--IF:can(User::can_edit())-->
                <th colspan="2" nowrap="nowrap">[[.action.]]</th>
                <!--/IF:can-->
            </tr>
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <td width="1%" align="center"><img src="templates/admin/images/buttons/search.gif" width="18px" /></td>
                <td><input name="search_name" type="text" id="search_name" class="search-field" /><script type="text/javascript">$('search_name').focus();</script></td>
                <td><input name="search_title_1" type="text" class="search-field" /></td>
                <td><select name="package_id" id="package_id" class="search-field"></select></td>
                <td></td>
                <td></td>
            </tr>
            <!--LIST:items-->
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="cursor:pointer;" id="ModuleAdmin_tr_[[|items.id|]]">
                <td><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'ModuleAdmin',this,'#FFFFEC','white');"></td>
                <td nowrap align="left" onclick="location='[[|items.href|]]';">[[|items.name|]]</td>
                <td align="left" onclick="location='[[|items.href|]]';">[[|items.title|]]</td>
                <td nowrap align="left" onclick="location='[[|items.href|]]';">[[|items.package_id|]]</td>
                <!--IF:can(User::can_edit())-->
                <td width="1%" align="center"><a href="{{Url::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]))}}"><img src="templates/admin/images/buttons/edit.gif" title="[[.edit.]]" alt="[[.edit.]]" width="12" height="12" border="0"></a></td>
                <td width="1%" align="center"><a href="{{Url::build('module_setting',array('module_id'=>[[=items.id=]]))}}"><img src="templates/admin/images/buttons/information.png" title="[[.setting.]]" alt="[[.setting.]]" width="12" height="12" border="0"></a></td>
                <!--/IF:can-->
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
        <div class="clrfix">
        	<div class="fl">
				[[.select.]]:&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleAdminForm,'ModuleAdmin',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleAdminForm,'ModuleAdmin',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleAdminForm,'ModuleAdmin',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
            </div>
            <div class="fr"><a href="javascript:void(0)" onclick="window.scrollTo(0,0);"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
        </div>
    </div>
</div>