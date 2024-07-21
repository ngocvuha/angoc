<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
    	<form name="ListModuleSettingForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <div class="clrfix pad-B5">
            <?php if(($this->map['paging'])){?><div class="fl"><?php echo $this->map['paging'];?></div><div class="fl pad-T5">&nbsp;- Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div><?php } ?>
            <div class="fr">Module: <select  name="module_id" id="module_id" onchange="location='<?php echo URL::build_current();?>?module_id='+this.value;"><?php
					if(isset($this->map['module_id_list']))
					{
						foreach($this->map['module_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('module_id').value = "<?php echo addslashes(URL::get('module_id',isset($this->map['module_id'])?$this->map['module_id']:''));?>";</script></div>
        </div>
		<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
			<tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
				<th width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="ModuleSetting_all_checkbox" onclick="select_all_checkbox(this.form,'ModuleSetting',this.checked,'#FFFFEC','white');"></th>
				<th nowrap align="left" ><?php echo Portal::language('id');?></th>
				<th nowrap align="left" ><?php echo Portal::language('module_name');?></th>
				<th nowrap align="left" ><?php echo Portal::language('name');?></th>
                <th nowrap align="left" ><?php echo Portal::language('group_name');?></th>
                <th nowrap align="right" ><?php echo Portal::language('position');?></th>
			</tr>
			<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
			<tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="cursor:pointer;" id="ModuleSetting_tr_<?php echo $this->map['items']['current']['module_id'];?>_<?php echo $this->map['items']['current']['id'];?>">
				<td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['module_id'];?>_<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'ModuleSetting',this,'#FFFFEC','white');"></td>
				<td nowrap align="left" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['module_id'].'_'.$this->map['items']['current']['id']));?>';"><?php echo $this->map['items']['current']['id'];?></td>
				<td nowrap align="left" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['module_id'].'_'.$this->map['items']['current']['id']));?>';"><?php echo $this->map['items']['current']['module_name'];?></td>
				<td nowrap align="left" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['module_id'].'_'.$this->map['items']['current']['id']));?>';"><?php echo $this->map['items']['current']['name'];?></td>
                <td nowrap align="left" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['module_id'].'_'.$this->map['items']['current']['id']));?>';"><?php echo $this->map['items']['current']['group_name'];?></td>
                <td nowrap align="right" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['module_id'].'_'.$this->map['items']['current']['id']));?>';"><?php echo $this->map['items']['current']['position'];?></td>
			</tr>
			<?php }}unset($this->map['items']['current']);} ?>
		</table>
        <input type="hidden" name="cmd" id="cmd" value="" />
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
        <?php if(($this->map['paging'])){?>
        <div class="clrfix pad-B5">
            <div class="fl"><?php echo $this->map['paging'];?></div><div class="fl pad-T5">&nbsp;- Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div>
        </div>
        <?php } ?>
        <div class="clrfix pad-TB5">
        	<div class="fl">
                <?php echo Portal::language('select');?>:&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleSettingForm,'ModuleSetting',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleSettingForm,'ModuleSetting',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(ListModuleSettingForm,'ModuleSetting',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
            </div>
            <div class="fr"><a href="javascript:void(0)" onclick="window.scrollTo(0,0);"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
        </div>
    </div>
</div>