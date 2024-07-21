<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý quyền của tài khoản{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form name="ListPrivilegeForm" method="post">
            <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
                <tr class="ht">
                        <th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="ListPrivilegeForm_all_checkbox" onclick="select_all_checkbox(this.form, 'ListPrivilegeForm',this.checked,'#FFFFEC','white');"></th>
                        <th nowrap align="left" >Tên quyền</th>
                        <!--IF:can(User::can_edit())-->
                        <th nowrap="nowrap" width="1%">Cấp quyền</th>
                        <!--/IF:can-->
                    </tr><.$i=1;.>
                    <!--LIST:items-->
                    <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="<.if($i%2){echo 'background-color:#F9F9F9';} $i++;.>" id="ListPrivilegeForm_tr_[[|items.id|]]">
                        <td><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'ListPrivilegeForm',this,'#FFFFEC','white');"></td>
                        <td align="left" nowrap>[[|items.name|]]</td>
                        <!--IF:can(User::can_edit())-->
                        <td align="center"><a href="{{Url::build_current(array('cmd'=>'grant','id'=>[[=items.id=]]))}}"><img src="templates/adminimages/buttons/add.jpg" title="[[.add.]]" /></a></td>
                        <!--/IF:can-->
                    </tr>
                    <!--/LIST:items-->
                </table>
                <input type="hidden" name="cmd" id="cmd" />
                </td>
                </tr>
            </table>	
        </form>
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl pad-R10">[[|paging|]]</div><!--/IF:cond--><div class="fl pad-T5">Tổng: <strong>[[|total|]]</strong> bản ghi</div>
        </div>
        <div class="clrfix">
            <div class="fl">
                Lựa chọn:&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPrivilegeForm,'ListPrivilegeForm',true,'#FFFFEC','white');">Tất cả</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPrivilegeForm,'ListPrivilegeForm',false,'#FFFFEC','white');">Bỏ chọn</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPrivilegeForm,'ListPrivilegeForm',-1,'#FFFFEC','white');">Ngược lại</a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
        </div>
	</div>
</div>
