<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý ngôn ngữ{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form name="ListLanguageForm" method="post">
            <table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7" align="center">
                <tr class="ht">
                    <td nowrap><b>ID</b></td>
                    <td nowrap><b>Mã</b></td>
                    <td nowrap><b>Tên</b></td>
                    <td><b>Ảnh đại diện</b></td>
                    <td><b>Trạng thái</b></td>
                    <td><b>Vị trí</b></td>
                    <!--IF:can(User::can_edit())-->
                    <td nowrap width="1%">Hành động</td>
                    <!--/IF:can-->
                </tr>
                <!--LIST:items-->
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?>>
                    <td nowrap>[[|items.id|]]</td>
                    <td nowrap>[[|items.code|]]</td>
                    <td nowrap>[[|items.name|]]{{[[=items.main=]]?' - <span style="color:red;">[ Mặc định ]</span>':''}}</td>
                    <td><img src="[[|items.icon_url|]]" width="34" /></td>
                    <td>{{[[=items.status=]]?'<span style="color:red;">Hiển thị</span>':'Ẩn'}}</td>
                    <td>[[|items.position|]]</td>
                    <!--IF:can(User::can_edit())-->
                    <td align="center"><a href="{{Url::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]))}}"><img src="{{'templates/admin/images/buttons/edit.jpg'}}" title="[[.edit.]]" /></a></td>
                    <!--/IF:can-->
                </tr>
                <!--/LIST:items-->
            </table>
            <div align="right"><a href="javascript:void(0);" onclick="window.scrollTo(0,0);"><img src="templates/admin/images/buttons/top.gif" alt="[[.top.]]" width="49" height="23" border="0" title="[[.top.]]"></a></div>
        </form>
	</div>
</div>
