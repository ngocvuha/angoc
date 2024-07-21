<script type="text/javascript">
function grant_privilege(block_id){
	var check_account = check_ajax(block_id,{'cmd':'grant','action':'check_account','account':$('account_id').value});
	if(jQuery('#account_id').val()==''){
		alert('Hãy nhập tên tài khoản.'); jQuery('#account_id').focus();
	}else if(check_account=='false'){
		alert('Tài khoản này không tồn tại.'); jQuery('#account_id').focus();
	}else if(!check_selected()){
		alert('Vui lòng chọn ít nhất một quyền.');
	}else{
		document.GrantPrivilege.submit();
	}
}
</script>
<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quyền của tài khoản{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button class="red-button" onclick="grant_privilege({{Module::block_id()}});">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="GrantPrivilege" method="post">
        <.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
        <table cellpadding="2" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7">
            <tr class="ht">
                <th width="20%" align="left">Tài khoản</th>
                <th align="left">Quyền</th>
          	</tr>
	        <tr>
                <td><input name="account_id" type="text" id="account_id" /></td>
                <td>
                    <ul style="list-style:none; line-height:20px;">
                    <!--LIST:privilege-->
                        <li>
                            <input name="privilege_id[[[|privilege.id|]]]" [[|privilege.checked|]] type="checkbox" value="[[|privilege.id|]]" id="privilege_id_[[|privilege.id|]]" class="privilege selected_ids" />
                            <label for="privilege_id_[[|privilege.id|]]">[[|privilege.title|]]</label>
                        </li>
                    <!--/LIST:privilege-->
                    </ul>
                 </td>
        	</tr>
        </table>
        <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
        </form>
	</div>
</div>