<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="EditModuleAdminForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" enctype="multipart/form-data">
	        <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
            <table width="100%" border="1" cellspacing="0" cellpadding="10" bordercolor="#cccccc">
                <tr>
                    <th width="1%" nowrap="nowrap">Tên Module:</th>
                    <td><input  name="name" id="name" style="width:150" / type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>"><script type="text/javascript">$('name').focus();</script></td>
                </tr>
                <tr>
                    <th width="1%" nowrap="nowrap">Tiêu đề Module:</th>
                    <td><input  name="title_1" id="title_1" style="width:150" / type ="text" value="<?php echo String::html_normalize(URL::get('title_1'));?>"></td>
                </tr>
                <tr>
                    <th nowrap="nowrap">Nhóm Module:</th>
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
                    <th nowrap="nowrap">Tuỳ chọn:</th>
                    <td>
                        <label for="privilege"><?php echo Portal::language('privilege');?>:</label>
                        <input name="privilege" id="privilege" type="checkbox" value="1" <?php echo (URL::get('privilege')?'checked':'');?>>
                        <label for="fun_extend"><?php echo Portal::language('function_extend');?>:</label>
                        <input name="fun_extend" id="fun_extend" type="checkbox" value="1" <?php echo (URL::get('fun_extend')?'checked':'');?>>
                    </td>
                </tr>
                <tr>
                    <th nowrap="nowrap">Ảnh đại diện:</th>
                    <td>
                        <input  name="image_url" id="image_url" / type ="file" value="<?php echo String::html_normalize(URL::get('image_url'));?>">
                        <?php if((Url::get('cmd')=='edit' and Url::get('id') and $this->map['image_url'] and file_exists($this->map['image_url']))){?>
                        <img src="<?php echo $this->map['image_url'];?>" />
                        <a href="<?php echo Url::build_current(array('cmd'=>'delete_image','id'=>Url::nget('id')));?>">Xoá ảnh</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php if(($this->map['using_pages'])){?>
                <tr>
                	<th nowrap="nowrap">Các vùng hiện diện:</th>
                    <td>
                        <ol>
                        <?php if(isset($this->map['using_pages']) and is_array($this->map['using_pages'])){ foreach($this->map['using_pages'] as $key1=>&$item1){ if($key1!='current'){$this->map['using_pages']['current'] = &$item1;?>
                        <li class="fl" style="width:30%;"><a target="_blank" href="<?php echo Url::build($this->map['using_pages']['current']['name']);?>" title="<?php echo Portal::language('page');?>"><?php echo $this->map['using_pages']['current']['name'];?></a><span style="color:#999;" title="<?php echo Portal::language('region');?>">(<?php echo $this->map['using_pages']['current']['region'];?>)</span> [<a href="<?php echo URL::build_current(array('cmd'=>'delete_block','block_id'=>$this->map['using_pages']['current']['id'],'module_id'=>Url::nget('id')));?>"><?php echo Portal::language('delete');?></a>]</li>
                        <?php }}unset($this->map['using_pages']['current']);} ?>
                        </ol>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
    </div>
</div>
