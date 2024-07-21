<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý ngôn ngữ{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
		<form name="EditLanguageForm" method="post" enctype="multipart/form-data">
        <.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
            <table width="100%" border="1" cellspacing="0" cellpadding="10" bordercolor="#cccccc">
                <tr>
	                <td class="m-label"><label>Mã:</label></td>
                    <td><input name="code" type="text" id="code" /><script>$('code').focus();</script></td>
                </tr>
                <tr>
	                <td class="m-label"><label>Tên:</label></td>
                    <td><input name="name" type="text" id="name" /></td>
                </tr>
                <tr>
	                <td class="m-label"><label>Vị trí:</label></td>
                    <td><input name="position" type="text" id="position" /></td>
                </tr>
                <tr>
	                <td class="m-label" nowrap="nowrap"><label for="main" style="color:red;">Ngôn ngữ mặc định:</label></td>
                    <td><input type="checkbox" name="main" id="main" value="1"<?php echo Url::get('main')?' checked="checked"':'';?> /></td>
                </tr>
                <tr>
	                <td class="m-label"><label>Trạng thái:</label></td>
                    <td>
                        <label for="status_show">Hiển thị</label>
                        <input  name="status" type="radio" id="status_show" value="1"<?php echo Url::get('status')?' checked="checked"':'';?> />
                        <label for="status_hide">Ẩn</label>
                        <input  name="status" type="radio" id="status_hide" value="0"<?php echo !Url::get('status')?' checked="checked"':'';?> />
                    </td>
                </tr>
                <tr>
	                <td class="m-label"><label>Ảnh đại diện:</label></td>
                    <td>
                        <input name="icon_url" type="file"  id="icon_url" />
                    	<!--IF:cond(Url::get('icon_url'))-->
                        <img src="{{Url::get('icon_url')}}" style="max-width:100px;" align="absmiddle" id="image_url" />
                        <a href="{{Url::build_current(array('cmd'=>'delete','field'=>'icon_url','id'=>Url::iget('id')))}}"><img src="{{'templates/admin/images/buttons/delete.gif'}}" title="[[.delete.]]" align="absbottom" /></a>
                        <!--/IF:cond-->
                    </td>
                </tr>
            </table>
        <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
        </form>
	</div>
</div>