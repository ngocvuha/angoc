<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
    <form name="EditCategoryForm" method="post">
    <.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
        <table width="100%" border="1" cellspacing="0" cellpadding="10" bordercolor="#efefef">
            <tr>
                <td width="20%" nowrap="nowrap"><label>[[.name.]]:</label></td>
                <td><input name="name" type="text" id="name" autofocus /></td>
            </tr>
            <tr>
                <td><label>[[.parent_name.]]:</label></td>
                <td><select name="parent_id" id="parent_id"></select></td>
            </tr>
            <tr>
                <td><label>[[.status.]]:</label></td>
                <td><select name="status" id="status"></select></td>
            </tr>
        </table>
    <input type="hidden" name="confirm_edit" value="1" />
    <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
    </form>
    </div>
</div>
