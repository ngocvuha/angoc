<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý quyền của tài khoản{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="GrantPrivilegeForm" method="post">
        	<.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding-right:20px;">
                        <strong>Tên quyền:&nbsp;</strong><input name="privilege_id" type="text" id="privilege_id" />&nbsp;
                        <div style="font-size:16px; font-weight:bold; margin:10px; text-align:center;">Chức năng chính</div>
                        <table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#cccccc">
                            <thead>
                            <tr bgcolor="#efefef">
                                <th>Chức năng</th>
                                <th>Xem</th>
                                <th>Chi tiết</th>
                                <th>Thêm</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                                <th>[[.Moderator.]]</th>
                                <th>[[.reserve.]]</th>
                                <th>[[.admin.]]</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--LIST:function-->
                            <!--IF:cond([[=function.m_id=]])-->
                            <tr align="center" id="function_[[|function.m_id|]]">
                                <td align="left" width="1%" nowrap="nowrap">[[|function.indent|]][[|function.indent_image|]]<span class="page_indent">&nbsp;</span>[[|function.name|]]</td>
                                <td><input  name="module[[[|function.m_id|]]][view]" type="checkbox" id="view_[[|function.m_id|]]" value="1"<?php echo [[=function.view=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function.m_id|]]][view_detail]" type="checkbox" id="view_detail_[[|function.m_id|]]" value="1"<?php echo [[=function.view_detail=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function.m_id|]]][add]" type="checkbox" id="add_[[|function.m_id|]]" value="1"<?php echo [[=function.add=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function.m_id|]]][edit]" type="checkbox" id="edit_[[|function.m_id|]]" value="1"<?php echo [[=function.edit=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function.m_id|]]][delete]" type="checkbox" id="delete_[[|function.m_id|]]" value="1"<?php echo [[=function.delete=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function.m_id|]]][special]" type="checkbox" id="special_[[|function.m_id|]]" value="1"<?php echo [[=function.special=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function.m_id|]]][reserve]" type="checkbox" id="reserve_[[|function.m_id|]]" value="1"<?php echo [[=function.reserve=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function.m_id|]]][admin]" type="checkbox" id="admin_[[|function.m_id|]]" function_id="[[|function.m_id|]]" class="function-admin" value="1"<?php echo [[=function.admin=]]?' checked':'';?> /></td>
                            </tr>
                            <!--ELSE-->
                            <tr align="center">
                                <td align="left" width="1%" nowrap="nowrap">[[|function.indent|]][[|function.indent_image|]]<span class="page_indent">&nbsp;</span>[[|function.name|]]</td>
                                <td><input  name="function[[[|function.id|]]][id]" type="checkbox" id="view_[[|function.id|]]" value="[[|function.id|]]"<?php echo [[=function.view=]]?' checked':'';?> /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <!--/IF:cond-->
                            <!--/LIST:function-->
                            </tbody>
                        </table>
                     </td>
                     <td width="50%" style="padding-left:20px;">
                        <div style="font-size:16px; font-weight:bold; margin:32px 10px 10px 10px; text-align:center;">Chức năng mở rộng</div>
                        <table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#cccccc">
                            <thead>
                            <tr bgcolor="#efefef">
                                <th>Chức năng</th>
                                <th>Xem</th>
                                <th>Chi tiết</th>
                                <th>Thêm</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                                <th>[[.Moderator.]]</th>
                                <th>[[.reserve.]]</th>
                                <th>[[.admin.]]</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--LIST:function_extend-->
                            <tr align="center" id="function_[[|function_extend.id|]]">
                                <td align="left" width="1%" nowrap="nowrap">[[|function_extend.title|]]</td>
                                <td><input  name="module[[[|function_extend.id|]]][view]" type="checkbox" id="view_[[|function_extend.id|]]" value="1"<?php echo [[=function_extend.view=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function_extend.id|]]][view_detail]" type="checkbox" id="view_detail_[[|function_extend.id|]]" value="1"<?php echo [[=function_extend.view_detail=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function_extend.id|]]][add]" type="checkbox" id="add_[[|function_extend.id|]]" value="1"<?php echo [[=function_extend.add=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function_extend.id|]]][edit]" type="checkbox" id="edit_[[|function_extend.id|]]" value="1"<?php echo [[=function_extend.edit=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function_extend.id|]]][delete]" type="checkbox" id="delete_[[|function_extend.id|]]" value="1"<?php echo [[=function_extend.delete=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function_extend.id|]]][special]" type="checkbox" id="special_[[|function_extend.id|]]" value="1"<?php echo [[=function_extend.special=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function_extend.id|]]][reserve]" type="checkbox" id="reserve_[[|function_extend.id|]]" value="1"<?php echo [[=function_extend.reserve=]]?' checked':'';?> /></td>
                                <td><input  name="module[[[|function_extend.id|]]][admin]" type="checkbox" id="admin_[[|function_extend.id|]]" function_id="[[|function_extend.id|]]" class="function-admin" value="1"<?php echo [[=function_extend.admin=]]?' checked':'';?> /></td>
                            </tr>
                            <!--/LIST:function_extend-->
                            </tbody>
                        </table>
                     </td>
                </tr>
            </table>
            <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
        </form>
	</div>
</div>
<script type="text/javascript">
$('privilege_id').focus();
jQuery(function(){
	jQuery('.function-admin').click(function(){
		var id=jQuery(this).attr('function_id');
		if(jQuery(this).is(':checked')){
			jQuery('#function_'+id+' input').attr('checked',true);
		}else{
			jQuery('#function_'+id+' input').attr('checked',false);
		}
	});
});
</script>
