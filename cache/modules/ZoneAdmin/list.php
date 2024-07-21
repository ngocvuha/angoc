<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
        <form name="ListCategoryForm" id="ListCategoryForm" method="post">
           <fieldset style="background-color:#f9f9f9; margin:0; border:1px dashed #ccc; margin-bottom:5px;">
                <legend><strong>Thêm khu vực</strong></legend>
                <div class="fl">
                <label for="name" style="display:block;"><em class="require">(*)</em>Tên khu vực</label><input  name="name" id="name" autofocus / type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>">
                </div>
                <div class="fl mar-LR10">
                <label for="parent_id" style="display:block;">Khu vực cha:</label><select  name="parent_id" id="parent_id" onchange="window.location='<?php echo Url::build_current();?>?parent_id='+this.value"><?php
					if(isset($this->map['parent_id_list']))
					{
						foreach($this->map['parent_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('parent_id').value = "<?php echo addslashes(URL::get('parent_id',isset($this->map['parent_id'])?$this->map['parent_id']:''));?>";</script>
                </div>
                <div class="fl" style="margin-top:15px;">
                <input type="submit" class="red-button" value="Ghi lại" style="padding:0;" />
                </div>
            </fieldset>	
            <table width="100%" cellpadding="2" cellspacing="0" border="1" bordercolor="#CCCCCC">
                <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                    <th width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'#FFFFEC','white');" /></th>
                    <th nowrap align="left"><?php echo Portal::language('name');?></th>
                    <?php if((User::can_edit())){?>
                    <th colspan="3" nowrap="nowrap" style="text-align:center;"><?php echo Portal::language('action');?></th>
                    <?php } ?>
                </tr><?php $i=0;?>
                <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?> style="<?php if($i%2){echo 'background-color:#F9F9F9';} $i++;?>" id="Category_tr_<?php echo $this->map['items']['current']['id'];?>">
                    <td align="center">
                    <?php if((User::can_delete() and $this->map['items']['current']['structure_id']!=ID_ROOT)){?>
                    <input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'Category',this,'#FFFFEC','white');" id="Category_checkbox" />
                     <?php }else{ ?>
                    --
                    <?php } ?>
                    </td>
                    <td nowrap>
                            <?php echo $this->map['items']['current']['indent'];?>
                            <?php echo $this->map['items']['current']['indent_image'];?>
                            <span class="page_indent">&nbsp;</span>
                            <strong style="color:#F00"><?php echo $this->map['items']['current']['id'];?>.</strong> <?php echo $this->map['items']['current']['name'];?></td>
                    <?php if((User::can_edit())){?>
                    <td width="24" align="center" title="<?php echo Portal::language('edit');?>">
                        <?php if(($this->map['items']['current']['structure_id']<>ID_ROOT and IDStructure::level($this->map['items']['current']['structure_id'])>1)){?>
                        <a href="<?php echo Url::build_current(array('parent_id'=>$this->map['items']['current']['parent_id'],'id'=>$this->map['items']['current']['id']));?>"><img src="<?php echo 'templates/admin/images/buttons/edit.jpg';?>" /></a>
                        <?php } ?>
                    </td>
                    <td width="24" align="center" title="<?php echo Portal::language('up');?>"><a href="<?php echo Url::build_current(array('cmd'=>'move_up','parent_id'=>$this->map['items']['current']['parent_id'],'id'=>$this->map['items']['current']['id']));?>"><?php echo $this->map['items']['current']['move_up'];?></a></td>
                    <td width="24" align="center" title="<?php echo Portal::language('down');?>"><a href="<?php echo Url::build_current(array('cmd'=>'move_down','parent_id'=>$this->map['items']['current']['parent_id'],'id'=>$this->map['items']['current']['id']));?>"><?php echo $this->map['items']['current']['move_down'];?></a></td>
                    <?php } ?>
                </tr>
                <?php }}unset($this->map['items']['current']);} ?>
            </table>
            <div class="clrfix pad-TB5">
                <div class="fl">
                    <?php echo Portal::language('select');?>:&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
                </div>
                <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
            </div>
            <input type="hidden" name="cmd" value="" id="cmd"/><input type="hidden" name="block_id" value="<?php echo Module::block_id();?>" id="block_id"/>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
    </div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery('#ListCategoryForm').submit(function(){
		var block_id=$('block_id').value;
		return saveZone(block_id);
	});
});
function saveZone(block_id){
	var check=true;
	__valid('name');
	if(jQuery('#name').val()==''){
		__validate('name','Hãy nhập tên khu vực');check=false;
	}else{
		var check_duplicate=check_ajax(block_id,{'cmd':'duplicate','name':jQuery('#name').val(),'parent_id':jQuery('#parent_id').val()});
		if(check_duplicate=='true'){
			__validate('name','Tên khu vực bị trùng');check=false;
		}
	}
	return check;
}
</script>