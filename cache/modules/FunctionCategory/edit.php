<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
    <form name="EditCategoryForm" method="post">
    <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
        <table width="100%" border="1" cellspacing="0" cellpadding="10" bordercolor="#efefef">
            <tr>
                <td width="20%" nowrap="nowrap"><label><?php echo Portal::language('name');?>:</label></td>
                <td><input  name="name" id="name" autofocus / type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>"></td>
            </tr>
            <tr>
                <td><label><?php echo Portal::language('parent_name');?>:</label></td>
                <td><select  name="parent_id" id="parent_id"><?php
					if(isset($this->map['parent_id_list']))
					{
						foreach($this->map['parent_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('parent_id').value = "<?php echo addslashes(URL::get('parent_id',isset($this->map['parent_id'])?$this->map['parent_id']:''));?>";</script></td>
            </tr>
            <tr>
                <td><label><?php echo Portal::language('url');?>:</label></td>
                <td><input  name="url" id="url" / type ="text" value="<?php echo String::html_normalize(URL::get('url'));?>"></td>
            </tr>
            <tr>
                <td><label><?php echo Portal::language('status');?>:</label></td>
                <td><select  name="status" id="status"><?php
					if(isset($this->map['status_list']))
					{
						foreach($this->map['status_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('status').value = "<?php echo addslashes(URL::get('status',isset($this->map['status'])?$this->map['status']:''));?>";</script></td>
            </tr>
            <tr>
                <td><label>Module tính năng:</label></td>
                <td><select  name="m_id" id="m_id" size="20" style="width:350px;"><?php
					if(isset($this->map['m_id_list']))
					{
						foreach($this->map['m_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('m_id').value = "<?php echo addslashes(URL::get('m_id',isset($this->map['m_id'])?$this->map['m_id']:''));?>";</script></td>
            </tr>
        </table>
    <input type="hidden" name="confirm_edit" value="1" />
    <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
    </div>
</div>
