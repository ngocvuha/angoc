<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý quyền của tài khoản<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="GrantPrivilegeForm" method="post">
        	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding-right:20px;">
                        <strong>Tên quyền:&nbsp;</strong><input  name="privilege_id" id="privilege_id" / type ="text" value="<?php echo String::html_normalize(URL::get('privilege_id'));?>">&nbsp;
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
                                <th><?php echo Portal::language('Moderator');?></th>
                                <th><?php echo Portal::language('reserve');?></th>
                                <th><?php echo Portal::language('admin');?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($this->map['function']) and is_array($this->map['function'])){ foreach($this->map['function'] as $key1=>&$item1){ if($key1!='current'){$this->map['function']['current'] = &$item1;?>
                            <?php if(($this->map['function']['current']['m_id'])){?>
                            <tr align="center" id="function_<?php echo $this->map['function']['current']['m_id'];?>">
                                <td align="left" width="1%" nowrap="nowrap"><?php echo $this->map['function']['current']['indent'];?><?php echo $this->map['function']['current']['indent_image'];?><span class="page_indent">&nbsp;</span><?php echo $this->map['function']['current']['name'];?></td>
                                <td><input  name="module[<?php echo $this->map['function']['current']['m_id'];?>][view]" type="checkbox" id="view_<?php echo $this->map['function']['current']['m_id'];?>" value="1"<?php echo $this->map['function']['current']['view']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function']['current']['m_id'];?>][view_detail]" type="checkbox" id="view_detail_<?php echo $this->map['function']['current']['m_id'];?>" value="1"<?php echo $this->map['function']['current']['view_detail']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function']['current']['m_id'];?>][add]" type="checkbox" id="add_<?php echo $this->map['function']['current']['m_id'];?>" value="1"<?php echo $this->map['function']['current']['add']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function']['current']['m_id'];?>][edit]" type="checkbox" id="edit_<?php echo $this->map['function']['current']['m_id'];?>" value="1"<?php echo $this->map['function']['current']['edit']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function']['current']['m_id'];?>][delete]" type="checkbox" id="delete_<?php echo $this->map['function']['current']['m_id'];?>" value="1"<?php echo $this->map['function']['current']['delete']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function']['current']['m_id'];?>][special]" type="checkbox" id="special_<?php echo $this->map['function']['current']['m_id'];?>" value="1"<?php echo $this->map['function']['current']['special']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function']['current']['m_id'];?>][reserve]" type="checkbox" id="reserve_<?php echo $this->map['function']['current']['m_id'];?>" value="1"<?php echo $this->map['function']['current']['reserve']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function']['current']['m_id'];?>][admin]" type="checkbox" id="admin_<?php echo $this->map['function']['current']['m_id'];?>" function_id="<?php echo $this->map['function']['current']['m_id'];?>" class="function-admin" value="1"<?php echo $this->map['function']['current']['admin']?' checked':'';?> /></td>
                            </tr>
                             <?php }else{ ?>
                            <tr align="center">
                                <td align="left" width="1%" nowrap="nowrap"><?php echo $this->map['function']['current']['indent'];?><?php echo $this->map['function']['current']['indent_image'];?><span class="page_indent">&nbsp;</span><?php echo $this->map['function']['current']['name'];?></td>
                                <td><input  name="function[<?php echo $this->map['function']['current']['id'];?>][id]" type="checkbox" id="view_<?php echo $this->map['function']['current']['id'];?>" value="<?php echo $this->map['function']['current']['id'];?>"<?php echo $this->map['function']['current']['view']?' checked':'';?> /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php }}unset($this->map['function']['current']);} ?>
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
                                <th><?php echo Portal::language('Moderator');?></th>
                                <th><?php echo Portal::language('reserve');?></th>
                                <th><?php echo Portal::language('admin');?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($this->map['function_extend']) and is_array($this->map['function_extend'])){ foreach($this->map['function_extend'] as $key2=>&$item2){ if($key2!='current'){$this->map['function_extend']['current'] = &$item2;?>
                            <tr align="center" id="function_<?php echo $this->map['function_extend']['current']['id'];?>">
                                <td align="left" width="1%" nowrap="nowrap"><?php echo $this->map['function_extend']['current']['title'];?></td>
                                <td><input  name="module[<?php echo $this->map['function_extend']['current']['id'];?>][view]" type="checkbox" id="view_<?php echo $this->map['function_extend']['current']['id'];?>" value="1"<?php echo $this->map['function_extend']['current']['view']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function_extend']['current']['id'];?>][view_detail]" type="checkbox" id="view_detail_<?php echo $this->map['function_extend']['current']['id'];?>" value="1"<?php echo $this->map['function_extend']['current']['view_detail']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function_extend']['current']['id'];?>][add]" type="checkbox" id="add_<?php echo $this->map['function_extend']['current']['id'];?>" value="1"<?php echo $this->map['function_extend']['current']['add']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function_extend']['current']['id'];?>][edit]" type="checkbox" id="edit_<?php echo $this->map['function_extend']['current']['id'];?>" value="1"<?php echo $this->map['function_extend']['current']['edit']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function_extend']['current']['id'];?>][delete]" type="checkbox" id="delete_<?php echo $this->map['function_extend']['current']['id'];?>" value="1"<?php echo $this->map['function_extend']['current']['delete']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function_extend']['current']['id'];?>][special]" type="checkbox" id="special_<?php echo $this->map['function_extend']['current']['id'];?>" value="1"<?php echo $this->map['function_extend']['current']['special']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function_extend']['current']['id'];?>][reserve]" type="checkbox" id="reserve_<?php echo $this->map['function_extend']['current']['id'];?>" value="1"<?php echo $this->map['function_extend']['current']['reserve']?' checked':'';?> /></td>
                                <td><input  name="module[<?php echo $this->map['function_extend']['current']['id'];?>][admin]" type="checkbox" id="admin_<?php echo $this->map['function_extend']['current']['id'];?>" function_id="<?php echo $this->map['function_extend']['current']['id'];?>" class="function-admin" value="1"<?php echo $this->map['function_extend']['current']['admin']?' checked':'';?> /></td>
                            </tr>
                            <?php }}unset($this->map['function_extend']['current']);} ?>
                            </tbody>
                        </table>
                     </td>
                </tr>
            </table>
            <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
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
