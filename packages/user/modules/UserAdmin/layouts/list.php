<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý tài khoản{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form name="ListUserAdminForm" method="post">
            <div class="clrfix pad-B5">
                <!--IF:cond([[=paging=]])--><div class="fl pad-R10">[[|paging|]]</div><!--/IF:cond--><div class="fl pad-T5">Tổng: <strong>[[|total|]]</strong> bản ghi</div>
                <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
            </div>
            <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
                <tr class="ht">
                    <td width="1%" title="[[.check_all.]]"><!--IF:can(User::can_delete())--><input type="checkbox" value="1" id="ListUserAdminForm_all_checkbox" onclick="select_all_checkbox(this.form, 'ListUserAdminForm',this.checked,'#FFFFEC','white');"><!--/IF:can--></td>
                    <td nowrap><a href="{{String::order_by('account.id')}}" class="orderby{{String::order_by_active('account.id')}}" title="[[.sort.]]">Tài khoản</a></td>
                    <td nowrap><a href="{{String::order_by('account.email')}}" class="orderby{{String::order_by_active('account.email')}}" title="[[.sort.]]">Email</a></td>
                    <td nowrap width="100" align="left"><a href="{{String::order_by('account.is_active')}}" class="orderby{{String::order_by_active('account.is_active')}}" title="[[.sort.]]">Kích hoạt</a></td>
                    <td nowrap width="100" align="left"><a href="{{String::order_by('account.is_block')}}" class="orderby{{String::order_by_active('account.is_block')}}" title="[[.sort.]]">Khóa</a></td>
                    <td nowrap width="150" align="left"><a href="{{String::order_by('account.create_date')}}" class="orderby{{String::order_by_active('account.create_date')}}" title="[[.sort.]]">Ngày tạo</a></td>
                    <td nowrap width="150" align="left"><a href="{{String::order_by('account.last_online_time')}}" class="orderby{{String::order_by_active('account.last_online_time')}}" title="[[.sort.]]">Trực tuyến lần cuối</a></td>
                    <!--IF:can(User::can_edit())-->
                    <td nowrap width="1%" colspan="2" align="center">Hành động</td>
                    <!--/IF:can-->
                </tr>
                <tr class="ht">
                    <td align="center"><img src="templates/admin/images/buttons/search.gif" width="18px" /></td>
                    <td><input name="search_id" type="text" id="search_id" class="search-field" autofocus /></td>
                    <td><input name="search_email" type="text" id="search_email" class="search-field" /></td>
                    <td><select name="search_is_active" id="search_is_active" class="search-field"></select></td>
                    <td><select name="search_is_block" id="search_is_block" class="search-field"></select></td>
                    <td>
                        <input name="search_create_date_f" type="text" id="search_create_date_f" class="search-field" />
                        <input name="search_create_date_t" type="text" id="search_create_date_t" class="search-field" />
                    </td>
                    <td>
                        <input name="search_last_online_time_f" type="text" id="search_last_online_time_f" class="search-field" />
                        <input name="search_last_online_time_t" type="text" id="search_last_online_time_t" class="search-field" />
                    </td>
                    <!--IF:can(User::can_edit())-->
                    <td align="center">Sửa</td>
                    <td align="center">Phân quyền</td>
                    <!--/IF:can-->
                </tr><.$i=1;.>
                <!--LIST:items-->
                <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="<.if($i%2){echo 'background-color:#F9F9F9';} $i++;.>" id="ListUserAdminForm_tr_[[|items.id|]]">
                    <td><!--IF:can(User::can_delete())--><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'ListUserAdminForm',this,'#FFFFEC','white');" id="ListUserAdminForm_checkbox"><!--/IF:can--></td>
                    <td nowrap>[[|items.id|]]</td>
                    <td nowrap>[[|items.email|]]</td>
                    <td nowrap>{{[[=yesno=]][[[=items.is_active=]]]}}</td>
                    <td nowrap>{{[[=yesno=]][[[=items.is_block=]]]}}</td>
                    <td nowrap>{{date('h\h:i\':s\" - d/m/Y',[[=items.create_date=]])}}</td>
                    <td nowrap>{{date('h\h:i\':s\" - d/m/Y',[[=items.last_online_time=]])}}</td>
                    <!--IF:can(User::can_edit())-->
                    <td nowrap align="center"><a href="{{Url::build_current(array('cmd'=>'edit','account_id'=>[[=items.id=]]))}}"><img src="templates/admin/images/buttons/edit.jpg" title="[[.edit.]]" /></a></td>
                    <td nowrap align="center"><a href="{{Url::build('grant_privilege',array('cmd'=>'grant','account_id'=>[[=items.id=]]))}}"><img src="templates/admin/images/buttons/list_button.gif" title="[[.grant_privilege.]]" /></a></td>
                    <!--/IF:can-->
                </tr>
                <!--/LIST:items-->
            </table>		
            <input type="hidden" name="cmd" id="cmd" />
        </form>
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl pad-R10">[[|paging|]]</div><!--/IF:cond--><div class="fl pad-T5">Tổng: <strong>[[|total|]]</strong> bản ghi</div>
        </div>
        <div class="clrfix">
            <div class="fl">
                Lựa chọn:&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListUserAdminForm,'ListUserAdminForm',true,'#FFFFEC','white');">Tất cả</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListUserAdminForm,'ListUserAdminForm',false,'#FFFFEC','white');">Bỏ chọn</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListUserAdminForm,'ListUserAdminForm',-1,'#FFFFEC','white');">Ngược lại</a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
        </div>
	</div>
</div>
<script type="text/javascript">
jQuery(function() {
	jQuery("#search_create_date_f").datepicker({ dateFormat: "dd/mm/yy" });
	jQuery("#search_create_date_t").datepicker({ dateFormat: "dd/mm/yy" });
	jQuery("#search_last_online_time_f").datepicker({ dateFormat: "dd/mm/yy" });
	jQuery("#search_last_online_time_t").datepicker({ dateFormat: "dd/mm/yy" });
});
</script>