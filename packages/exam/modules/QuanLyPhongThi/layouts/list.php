<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">
        	Quản lý Phòng Thi{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}
        </div>
        <div class="fr">
		<!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
		<!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form name="QuanLyPhongThi" id="QuanLyPhongThi" method="post">
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div><!--/IF:cond-->
            <div class="fr"><label for="item_per_page">items/page</label><input name="item_per_page" type="text" id="item_per_page" size="10" /><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr class="ht">
                <td width="1%" title="[[.check_all.]]"><!--IF:can(User::can_delete())--><input type="checkbox" value="1" id="QuanLyPhongThi_all_checkbox" onclick="select_all_checkbox(this.form, 'QuanLyPhongThi',this.checked,'#FFFFEC','white');"><!--/IF:can--></td>
                <td nowrap align="left"><a href="{{String::order_by('tblphongthi.Ten')}}" class="orderby{{String::order_by_active('tblphongthi.Ten')}}" title="[[.sort.]]">Tên</a></td>
                <td nowrap width="250"><a href="{{String::order_by('tblphongthi.T_BatDau')}}" class="orderby{{String::order_by_active('tblphongthi.T_BatDau')}}" title="[[.sort.]]">Thời gian Thi</a></td>
                <td nowrap width="200" align="left"><a href="{{String::order_by('tblphongthi.IDCauTrucDeThi')}}" class="orderby{{String::order_by_active('tblphongthi.IDCauTrucDeThi')}}" title="[[.sort.]]">Cấu trúc đề thi</a></td>
                <td nowrap width="100" align="left">Giám Thị</td>
				<td nowrap width="100" align="left">Trạng Thái</td>
                <!--IF:can(User::can_edit())-->
                <td nowrap width="1%">Hành động</td>
                <!--/IF:can-->
				<!--IF:can(User::can_moderator())-->
                <td nowrap width="1%" rowspan="2">Cập nhật giờ thi</td>
                <!--/IF:can-->
            </tr>
            <tr class="ht">
                <td align="center"><img src="{{'templates/admin/images/buttons/search.gif'}}" width="18px" /></td>
                <td><input name="search_name" type="text" id="search_name" class="search-field" /><script type="text/javascript">$('search_name').focus();</script></td>
                <td>                	
                </td>
				<td><input name="search_time_f" type="text" id="search_time_f" class="search-field" />
                    <input name="search_time_t" type="text" id="search_time_t" class="search-field" /></td>
                <td><input name="search_GiamThi" type="text" class="search-field" /></td>
				<td><select name="search_status" id="search_status" type="text" class="search-field"></select></td>
                <!--IF:can(User::can_edit())-->
                <td></td>
                <!--/IF:can-->
            </tr><.$index=[[=index=]].>
            <!--LIST:items-->
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="<.if($index++%2){echo 'background-color:#F9F9F9';}.>" id="QuanLyPhongThi_tr_[[|items.id|]]">
                <td align="center"><!--IF:can(User::can_delete())-->
                    <input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'NewsAdmin',this,'#FFFFEC','white');" id="NewsAdmin_checkbox_[[|items.id|]]">
                    <!--ELSE-->--<!--/IF:can--></td>
                <td>
                    <label for="QuanLyPhongThi_checkbox_[[|items.id|]]">[[|items.Ten|]]</label>
                </td>                
                <td>{{date('d/m/Y H:i',[[=items.T_BatDau=]]).'h - '.date('d/m/Y H:i',[[=items.T_KetThuc=]]).'h'}}</td>
				<td>[[|items.IDCauTrucDeThi|]]</td>
                <td>[[|items.HoDem|]] [[|items.GiamThi|]]</td>
				<td nowrap>{{[[=status=]][[[=items.TrangThai=]]]}}</td>
                <!--IF:can(User::can_edit())-->
                <td align="center"><a href="{{Url::build_current(array('id'=>[[=items.id=]],'cmd'=>'edit'))}}"><img src="{{'templates/admin/images/buttons/edit.jpg'}}"></a></td>
                <!--/IF:can-->
				<!--IF:can(User::can_moderator())-->
                <td align="center"><a href="{{Url::build_current(array('id'=>[[=items.id=]],'cmd'=>'update'))}}"><img src="{{'templates/admin/images/buttons/edit.jpg'}}"></a></td>
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
                Lựa chọn:&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.QuanLyPhongThi,'QuanLyPhongThi',true,'#FFFFEC','white');">Tất cả</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.QuanLyPhongThi,'QuanLyPhongThi',false,'#FFFFEC','white');">Bỏ chọn</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.QuanLyPhongThi,'QuanLyPhongThi',-1,'#FFFFEC','white');">Ngược lại</a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
        </div>
    </div>
</div>
<script type="text/javascript">
jQuery(function() {
	jQuery("#search_time_f").datepicker({ dateFormat: "dd/mm/yy" });
	jQuery("#search_time_t").datepicker({ dateFormat: "dd/mm/yy" });
});
</script>