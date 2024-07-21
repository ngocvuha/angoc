<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form name="ListPackageAdminForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <div class="clrfix pad-B5">
            <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="PackageAdmin_all_checkbox" onclick="select_all_checkbox(this.form, 'PackageAdmin',this.checked,'#FFFFEC','white');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
                <th nowrap align="left"><b>[[.name.]]</b></th>
                <th width="50%" nowrap align="left"><b>[[.title.]]</b></th>
                <!--IF:can(User::can_edit())-->
                <th colspan="2" nowrap="nowrap">[[.action.]]</th>
                <!--/IF:can-->
            </tr>
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <td width="1%" align="center"><img src="templates/admin/images/buttons/search.gif" width="18px" /></td>
                <td><input name="search_name" type="text" id="search_name" class="search-field" /><script type="text/javascript">$('search_name').focus();</script></td>
                <td><input name="search_title_1" type="text" class="search-field" /></td>
                <td></td>
                <td></td>
            </tr>
            <!--LIST:items-->
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="cursor:pointer;" id="PackageAdmin_tr_[[|items.id|]]">
                <td><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'PackageAdmin',this,'#FFFFEC','white'\);" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
                <td nowrap align="left" onclick="location='{{URL::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]))}}';">[[|items.indent|]] [[|items.indent_image|]] <span class="page_indent">&nbsp;</span> [[|items.name|]]</td>
                <td nowrap align="left" onclick="location='{{URL::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]))}}';">[[|items.title|]]</td>
                <!--IF:can(User::can_edit())-->
                <td width="1%" align="center" title="[[.up.]]"><a href="{{Url::build_current(array('cmd'=>'move_up','id'=>[[=items.id=]]))}}">[[|items.move_up|]]</a></td>
                <td width="1%" align="center" title="[[.down.]]"><a href="{{Url::build_current(array('cmd'=>'move_down','id'=>[[=items.id=]]))}}">[[|items.move_down|]]</a></td>
                <!--/IF:can-->
            </tr>
            <!--/LIST:items-->
        </table>
        <input type="hidden" name="cmd" id="cmd" value="" />
        </form>
        <div class="clrfix pad-TB5">
        	<div class="fl">
				[[.select.]]:&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageAdminForm,'PackageAdmin',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageAdminForm,'PackageAdmin',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageAdminForm,'PackageAdmin',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
        </div>
    </div>
</div>