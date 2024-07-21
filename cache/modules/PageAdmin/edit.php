<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
	<form name="EditPageAdminForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
        <table width="100%" border="1" cellspacing="0" cellpadding="10" bordercolor="#cccccc">
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Tên trang:</th>
                <td><input  name="name" id="name" / type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>"><script type="text/javascript">$('name').focus();</script></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Tiêu đề trang:</th>
                <td><input  name="title_1" id="title_1" / type ="text" value="<?php echo String::html_normalize(URL::get('title_1'));?>"></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Package:</th>
                <td><select  name="package_id" id="package_id"><?php
					if(isset($this->map['package_id_list']))
					{
						foreach($this->map['package_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('package_id').value = "<?php echo addslashes(URL::get('package_id',isset($this->map['package_id'])?$this->map['package_id']:''));?>";</script></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Layout:</th>
                <td><select  name="layout" id="layout"><?php
					if(isset($this->map['layout_list']))
					{
						foreach($this->map['layout_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('layout').value = "<?php echo addslashes(URL::get('layout',isset($this->map['layout'])?$this->map['layout']:''));?>";</script></td>
            </tr>
            <tr>
                <th width="1%" nowrap="nowrap" align="right">Theme:</th>
                <td><select  name="theme" id="theme"><?php
					if(isset($this->map['theme_list']))
					{
						foreach($this->map['theme_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('theme').value = "<?php echo addslashes(URL::get('theme',isset($this->map['theme'])?$this->map['theme']:''));?>";</script></td>
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
        <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	</div>
</div>