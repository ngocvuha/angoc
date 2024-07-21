<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
		<form name="EditModuleSettingForm" method="post"  action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
            <div class="form_input_label">[[.id.]]:</div>
            <div class="form_input">
                <input name="id" type="text" id="id" style="width:300" ></div>
            <div class="form_input_label">[[.name.]]:</div>
            <div class="form_input">
                <input name="name" type="text" id="name" style="width:300" >
            </div><div class="form_input_label">[[.module_id.]]:</div>
            <div class="form_input">
                    <select name="module_id" id="module_id" ></select>
            </div>
            <div class="form_input">
                    <select name="style" id="style" ></select>
            </div>
            <div class="form_input_label">[[.description.]]:</div>
            <div class="form_input">
                <textarea name="description" id="description" style="width:100%" rows="20" ></textarea>
            </div><div class="form_input_label">[[.type.]]:</div>
            <div class="form_input">
            <select  name="type" id="type">
                <option value="TEXT">TEXT</option><option value="INT">INT</option><option value="FLOAT">FLOAT</option><option value="EMAIL">EMAIL</option><option value="COLOR">COLOR</option><option value="FONT_FAMILY">FONT_FAMILY</option><option value="FONT_SIZE">FONT_SIZE</option><option value="FONT_WEIGHT">FONT_WEIGHT</option><option value="TEXTAREA">TEXTAREA</option><option value="RICH_EDITOR">RICH_EDITOR</option><option value="TABLE">TABLE</option><option value="SELECT">SELECT</option><option value="IMAGELIST">IMAGELIST</option><option value="DATE">DATE</option><option value="DATETIME">DATETIME</option><option value="CHECKBOX">CHECKBOX</option><option value="RADIO">RADIO</option><option value="FILE">FILE</option><option value="IMAGE">IMAGE</option><option value="YESNO">YESNO</option>
            </select>
                    <script language="javascript">
                        selects = document.getElementsByTagName('select');
                        selects[selects.length-1].value = '<?php echo URL::get('type');?>';
                    </script>
            </div><div class="form_input_label">[[.default_value.]]:</div>
            <div class="form_input">
                <textarea name="default_value" id="default_value" style="width:100%" rows="3" ></textarea>
            </div><div class="form_input_label">[[.value_list.]]:</div>
            <div class="form_input">
                <textarea name="value_list" id="value_list" style="width:100%" rows="15" ></textarea>
            </div><div class="form_input_label">[[.edit_condition.]]:</div>
            <div class="form_input">
                <textarea name="edit_condition" id="edit_condition" style="width:100%" rows="3" ></textarea>
            </div><div class="form_input_label">[[.view_condition.]]:</div>
            <div class="form_input">
                <textarea name="view_condition" id="view_condition" style="width:100%" rows="3" ></textarea>
            </div><div class="form_input_label">[[.extend.]]:</div>
            <div class="form_input">
                <textarea name="extend" id="extend" style="width:100%" rows="3" ></textarea>
            </div><div class="form_input_label">[[.group_name.]]:</div>
            <div class="form_input">
                <input name="group_name" type="text" id="group_name" style="width:300" >
            </div><div class="form_input_label">[[.position.]]:</div>
            <div class="form_input">
                <input name="position" type="text" id="position" style="width:100" >
            </div><div class="form_input_label">[[.group_column.]]:</div>
            <div class="form_input">
                <input name="group_column" type="text" id="group_column" style="width:100" >
            </div><div class="form_input_label">[[.meta.]]:</div>
            <div class="form_input">
                <textarea name="meta" id="meta" style="width:100%" rows="3" ></textarea>
            </div><div class="form_input_label">[[.update_code.]]:</div>
            <div class="form_input">
                <textarea name="update_code" id="update_code" style="width:100%" rows="5" ></textarea>
            </div>
            <input type="hidden" value="1" name="confirm_edit"/>
        <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
        </form>
	</div>
</div>