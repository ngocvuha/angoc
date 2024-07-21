<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quyền của tài khoản{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button class="red-button" onclick="goto('{{Url::build_current(array('cmd'=>'grant'))}}');">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form name="ListModeratorForm" method="post">
            <div class="clrfix pad-B5">
                <!--IF:cond([[=paging=]])--><div class="fl pad-R10">[[|paging|]]</div><!--/IF:cond--><div class="fl pad-T5">Tổng: <strong>[[|total|]]</strong> bản ghi</div>
                <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
            </div>
            <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
                <tr class="ht">
                    <td width="1%" title="[[.check_all.]]"><!--IF:can(User::can_delete())--><input type="checkbox" value="1" id="ListUserAdminForm_all_checkbox" onclick="select_all_checkbox(this.form, 'ListUserAdminForm',this.checked,'#FFFFEC','white');"><!--/IF:can--></td>
                    <td nowrap align="left"><a href="{{String::order_by('account_privilege.id')}}" class="orderby{{String::order_by_active('account_privilege.id')}}" title="[[.sort.]]">Tài khoản</a></td>
                    <td nowrap width="150" align="left">Quyền</td>
                    <!--IF:can(User::can_edit())-->
                    <td nowrap width="1%" align="center">Hành động</td>
                    <!--/IF:can-->
                </tr>
                <tr class="ht">
                    <td align="center"><img src="skins/default/images/buttons/search.gif" width="18px" /></td>
                    <td><input name="search_id" type="text" id="search_id" class="search-field" /><script type="text/javascript">$('search_id').focus();</script></td>
                    <td><select name="search_privilege" id="search_privilege" class="search-field"></select></td>
                    <!--IF:can(User::can_edit())-->
                    <td align="center">Sửa</td>
                    <!--/IF:can-->
                </tr><.$i=1;.>
                <!--LIST:items-->
                <tr <?php Draw::hover('E2F1DF');?> style="<.if($i%2){echo 'background-color:#F9F9F9';} $i++;.>" id="Moderator_tr_[[|items.id|]]">
                    <td width="1%" align="center"><!--IF:can(User::can_delete())--><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'Moderator',this,'#FFFFEC','white');" id="Moderator_checkbox"><!--/IF:can--></td />
                    <td width="29%">[[|items.account_id|]]</td />
                    <td width="23%" align="left" nowrap>[[|items.title|]]</td>
                	<!--IF:can(User::can_edit())-->
                    <td width="1%" align="center"><a href="{{Url::build_current(array('cmd'=>'grant','account_id'=>[[=items.account_id=]]))}}"><img src="templates/adminimages/buttons/edit.jpg" title="[[.edit.]]" /></a></td />
                    <!--/IF:can-->
                </tr>
                <!--/LIST:items-->
            </table>		
            <input type="hidden" name="cmd" id="cmd" />
        </form>
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl pad-R10">[[|paging|]]</div><!--/IF:cond--><div class="fl pad-T5">Tổng: <strong>[[|total|]]</strong> bản ghi</div>
        </div>
	</div>
</div>
