<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
	<form name="EditManageHelper" id="EditManageHelper" method="post">
    <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
    	<div class="mar-B5"><label>Chọn tính năng: </label><select  name="category_id" id="category_id"><?php
					if(isset($this->map['category_id_list']))
					{
						foreach($this->map['category_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('category_id').value = "<?php echo addslashes(URL::get('category_id',isset($this->map['category_id'])?$this->map['category_id']:''));?>";</script></div>
        <div id="tabs" class="option-bound">
            <ul>
            <?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key1=>&$item1){ if($key1!='current'){$this->map['languages']['current'] = &$item1;?>
                <li><a href="#tabs-<?php echo $this->map['languages']['current']['id'];?>"><?php echo $this->map['languages']['current']['name'];?></a></li>
            <?php }}unset($this->map['languages']['current']);} ?>
            </ul>
            <?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key2=>&$item2){ if($key2!='current'){$this->map['languages']['current'] = &$item2;?>
            <div id="tabs-<?php echo $this->map['languages']['current']['id'];?>">
                <div><label for="name_<?php echo $this->map['languages']['current']['id'];?>"><?php echo Portal::language('name');?></label><?php if(($this->map['languages']['current']['main'])){?><span class="require">(*)</span><?php } ?></div>
                <div><input  name="name_<?php echo $this->map['languages']['current']['id'];?>" id="name_<?php echo $this->map['languages']['current']['id'];?>" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('name_'.$this->map['languages']['current']['id']));?>"></div>
                <div class="pad-TB5"><label><?php echo Portal::language('description');?></label></div>
                <div><textarea  name="description_<?php echo $this->map['languages']['current']['id'];?>" id="description_<?php echo $this->map['languages']['current']['id'];?>" cols="75" rows="20" class="search-field" style="width:100%;height:600px;overflow:hidden;"><?php echo String::html_normalize(URL::get('description_'.$this->map['languages']['current']['id'],''));?></textarea><span class="mce-button" onclick="advance_mce('description_<?php echo $this->map['languages']['current']['id'];?>');">Soạn thảo văn bản</span></div>
            </div>
            <?php }}unset($this->map['languages']['current']);} ?>
        </div>
    <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	</div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery("#tabs").tabs();
});
</script>