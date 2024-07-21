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
    	<div class="fl title">Quyền của tài khoản<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button class="red-button" onclick="grant_privilege(<?php echo Module::block_id();?>);">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="GrantPrivilege" method="post">
        <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
        <table cellpadding="2" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7">
            <tr class="ht">
                <th width="20%" align="left">Tài khoản</th>
                <th align="left">Quyền</th>
          	</tr>
	        <tr>
                <td><input  name="account_id" id="account_id" / type ="text" value="<?php echo String::html_normalize(URL::get('account_id'));?>"></td>
                <td>
                    <ul style="list-style:none; line-height:20px;">
                    <?php if(isset($this->map['privilege']) and is_array($this->map['privilege'])){ foreach($this->map['privilege'] as $key1=>&$item1){ if($key1!='current'){$this->map['privilege']['current'] = &$item1;?>
                        <li>
                            <input name="privilege_id[<?php echo $this->map['privilege']['current']['id'];?>]" <?php echo $this->map['privilege']['current']['checked'];?> type="checkbox" value="<?php echo $this->map['privilege']['current']['id'];?>" id="privilege_id_<?php echo $this->map['privilege']['current']['id'];?>" class="privilege selected_ids" />
                            <label for="privilege_id_<?php echo $this->map['privilege']['current']['id'];?>"><?php echo $this->map['privilege']['current']['title'];?></label>
                        </li>
                    <?php }}unset($this->map['privilege']['current']);} ?>
                    </ul>
                 </td>
        	</tr>
        </table>
        <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	</div>
</div>