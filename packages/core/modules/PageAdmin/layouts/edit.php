<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
	<form name="EditPageAdminForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
        <table width="100%" border="1" cellspacing="0" cellpadding="10" bordercolor="#cccccc">
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Tên trang:</th>
                <td><input name="name" type="text" id="name" /><script type="text/javascript">$('name').focus();</script></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Tiêu đề trang:</th>
                <td><input name="title_1" type="text" id="title_1" /></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Package:</th>
                <td><select name="package_id" id="package_id"></select></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Layout:</th>
                <td><select name="layout" id="layout"></select></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Theme:</th>
                <td><select name="theme" id="theme"></select></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Sử dụng cache trang:</th>
                <td><input  name="cachable" id="cachable" type="checkbox" value="1" <?php echo (URL::get('cachable')?'checked':'');?>></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Ẩn với người dùng:</th>
                <td><input  name="hide" id="hide" type="checkbox" value="1" <?php echo (URL::get('hide')?'checked':'');?>></td>
            </tr>
        </table>
        <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
	</form>
	</div>
</div>