<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
    <div class="form-content">
        <form name="addLayout" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
	        <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	        <table width="100%" border="1" cellspacing="0" cellpadding="10" bordercolor="#cccccc">
            	<tr>
                	<td width="1%" nowrap="nowrap" align="right">Trang gốc:</td>
                    <td><?php echo $this->map['name'];?></td>
                </tr>
                <tr>
                    <td width="1%" nowrap="nowrap" align="right">Tên trang:</td>
                    <td><input  name="name" id="name" / type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>"><script type="text/javascript">$('name').focus();</script></td>
                </tr>
                <tr>
                    <td width="1%" nowrap="nowrap" align="right">Tiêu đề trang:</td>
                    <td><input  name="title_1" id="title_1" / type ="text" value="<?php echo String::html_normalize(URL::get('title_1'));?>"></td>
                </tr>
                <tr>
                    <td width="1%" nowrap="nowrap" align="right">Theme:</td>
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
            </table>
        	<?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
    </div>
</div>