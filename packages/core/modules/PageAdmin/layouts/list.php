<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form name="ListPageAdminForm" method="post">
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div><!--/IF:cond-->
            <div class="fr">
            <button id="search" class="blue-button">Tìm kiếm</button>
            </div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="PageAdmin_all_checkbox" onclick="select_all_checkbox(this.form, 'PageAdmin',this.checked,'#FFFFEC','white');"></th>
                <th width="1%" nowrap="nowrap">[[.view.]]</th>
                <th nowrap align="left"><a href="{{String::order_by('page.name')}}" class="orderby{{String::order_by_active('page.name')}}" title="[[.sort.]]">[[.name.]]</a></th>
                <th width="30%" nowrap align="left"><a href="{{String::order_by('page.title_1')}}" class="orderby{{String::order_by_active('page.title_1')}}" title="[[.sort.]]">[[.title.]]</a></th>
                <th width="30%" nowrap align="left"><a href="{{String::order_by('page.package_id')}}" class="orderby{{String::order_by_active('page.package_id')}}" title="[[.sort.]]">[[.package.]]</a></th>
                <th nowrap="nowrap" style="text-align:center;">THEME</th>
                <!--IF:can(User::can_edit())-->
                <th colspan="5" nowrap="nowrap" style="text-align:center;">[[.action.]]</th>
                <!--/IF:can-->
            </tr>
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <td width="1%" align="center"><img src="templates/admin/images/buttons/search.gif" width="18px" /></td>
                <td></td>
                <td><input name="search_name" type="text" id="search_name" class="search-field" /><script type="text/javascript">$('search_name').focus();</script></td>
                <td><input name="search_title_1" type="text" class="search-field" /></td>
                <td><select name="package_id" id="package_id" class="search-field"></select></td>
                <td align="center"><select name="theme" id="theme" class="search-field"></select></td>
                <td align="center">Hide</td>
                <td align="center">Cache</td>
                <td align="center">Edit</td>
                <td align="center">Structure</td>
                <td align="center">Copy</td>
            </tr>
            <!--LIST:items-->
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> id="PageAdmin_tr_[[|items.id|]]">
                <td><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'PageAdmin',this,'#FFFFEC','white');"></td>
                <td align="center"><a target="_blank" href="{{URL::build([[=items.name=]])}}"><img src="templates/admin/images/buttons/select.jpg" title="[[.view.]]" alt="[[.edit.]]" /></a></td>
                <td nowrap align="left">[[|items.name|]]</td>
                <td align="left">[[|items.title|]]</td>
                <td nowrap align="left">[[|items.package_id|]]</td>
                <td nowrap align="left">[[|items.theme|]]</td>
                <!--IF:can(User::can_edit())-->
                <td width="60"  nowrap align="center"><input type="checkbox" name="hide" onclick="ajaxForm({'cmd':'update_hide','id':[[|items.id|]],'hide':this.checked},{{Module::block_id()}});"{{[[=items.hide=]]?' checked':''}} /></td>
                <td width="60"  nowrap align="center"><input type="checkbox" name="cache" onclick="ajaxForm({'cmd':'update_cache','id':[[|items.id|]],'cache':this.checked},{{Module::block_id()}});"{{[[=items.cachable=]]?' checked':''}} /></td>
                <td width="60" align="center"><a href="{{Url::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]))}}"><img src="templates/admin/images/buttons/edit.gif" title="[[.edit.]]" alt="[[.edit.]]" width="12" height="12" border="0"></a></td>
                <td width="60" align="center"><a href="{{Url::build('edit_page',array('id'=>[[=items.id=]]))}}"><img src="templates/admin/images/icons/generate_button.gif" title="[[.page_structure.]]" alt="[[.page_structure.]]" width="13" height="13" border="0"></a></td>
                <td width="60" align="center"><a href="{{Url::build_current(array('cmd'=>'duplicate','id'=>[[=items.id=]]))}}"><img src="templates/admin/images/buttons/copy.png" title="[[.copy.]]" alt="[[.copy.]]" width="13" height="13" border="0"></a></td>
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
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPageAdminForm,'PageAdmin',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPageAdminForm,'PageAdmin',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPageAdminForm,'PageAdmin',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
        </div>
	</div>
</div>