<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quyền của tài khoản<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button class="red-button" onclick="goto('<?php echo Url::build_current(array('cmd'=>'grant'));?>');">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
        <form name="ListModeratorForm" method="post">
            <div class="clrfix pad-B5">
                <?php if(($this->map['paging'])){?><div class="fl pad-R10"><?php echo $this->map['paging'];?></div><?php } ?><div class="fl pad-T5">Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div>
                <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
            </div>
            <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
                <tr class="ht">
                    <td width="1%" title="<?php echo Portal::language('check_all');?>"><?php if((User::can_delete())){?><input type="checkbox" value="1" id="ListUserAdminForm_all_checkbox" onclick="select_all_checkbox(this.form, 'ListUserAdminForm',this.checked,'#FFFFEC','white');"><?php } ?></td>
                    <td nowrap align="left"><a href="<?php echo String::order_by('account_privilege.id');?>" class="orderby<?php echo String::order_by_active('account_privilege.id');?>" title="<?php echo Portal::language('sort');?>">Tài khoản</a></td>
                    <td nowrap width="150" align="left">Quyền</td>
                    <?php if((User::can_edit())){?>
                    <td nowrap width="1%" align="center">Hành động</td>
                    <?php } ?>
                </tr>
                <tr class="ht">
                    <td align="center"><img src="skins/default/images/buttons/search.gif" width="18px" /></td>
                    <td><input  name="search_id" id="search_id" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_id'));?>"><script type="text/javascript">$('search_id').focus();</script></td>
                    <td><select  name="search_privilege" id="search_privilege" class="search-field"><?php
					if(isset($this->map['search_privilege_list']))
					{
						foreach($this->map['search_privilege_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('search_privilege').value = "<?php echo addslashes(URL::get('search_privilege',isset($this->map['search_privilege'])?$this->map['search_privilege']:''));?>";</script></td>
                    <?php if((User::can_edit())){?>
                    <td align="center">Sửa</td>
                    <?php } ?>
                </tr><?php $i=1;?>
                <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
                <tr <?php Draw::hover('E2F1DF');?> style="<?php if($i%2){echo 'background-color:#F9F9F9';} $i++;?>" id="Moderator_tr_<?php echo $this->map['items']['current']['id'];?>">
                    <td width="1%" align="center"><?php if((User::can_delete())){?><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'Moderator',this,'#FFFFEC','white');" id="Moderator_checkbox"><?php } ?></td />
                    <td width="29%"><?php echo $this->map['items']['current']['account_id'];?></td />
                    <td width="23%" align="left" nowrap><?php echo $this->map['items']['current']['title'];?></td>
                	<?php if((User::can_edit())){?>
                    <td width="1%" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'grant','account_id'=>$this->map['items']['current']['account_id']));?>"><img src="templates/adminimages/buttons/edit.jpg" title="<?php echo Portal::language('edit');?>" /></a></td />
                    <?php } ?>
                </tr>
                <?php }}unset($this->map['items']['current']);} ?>
            </table>		
            <input type="hidden" name="cmd" id="cmd" />
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
        <div class="clrfix pad-B5">
            <?php if(($this->map['paging'])){?><div class="fl pad-R10"><?php echo $this->map['paging'];?></div><?php } ?><div class="fl pad-T5">Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div>
        </div>
	</div>
</div>
