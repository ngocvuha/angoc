<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
        <form name="ListManageCustomerForm" method="post">
            <div class="clrfix pad-B5">
                <?php if(($this->map['paging'])){?><div class="fl pad-R10"><?php echo $this->map['paging'];?></div><?php } ?><div class="fl pad-T5">Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div>
                <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
            </div>
            <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
                <tr class="ht">
                    <td width="1%" title="<?php echo Portal::language('check_all');?>"><?php if((User::can_delete())){?><input type="checkbox" value="1" id="ListManageCustomerForm_all_checkbox" onclick="select_all_checkbox(this.form, 'ListManageCustomerForm',this.checked,'#FFFFEC','white');"><?php } ?></td>
                    <td nowrap><a href="<?php echo String::order_by('account.id');?>" class="orderby<?php echo String::order_by_active('account.id');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('account');?></a></td>
                    <td nowrap><a href="<?php echo String::order_by('account.email');?>" class="orderby<?php echo String::order_by_active('account.email');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('email');?></a></td>
                    <td nowrap width="100" align="left"><a href="<?php echo String::order_by('account.is_active');?>" class="orderby<?php echo String::order_by_active('account.is_active');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('active');?></a></td>
                    <td nowrap width="100" align="left"><a href="<?php echo String::order_by('account.is_block');?>" class="orderby<?php echo String::order_by_active('account.is_block');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('block');?></a></td>
                    <td nowrap width="150" align="left"><a href="<?php echo String::order_by('account.create_date');?>" class="orderby<?php echo String::order_by_active('account.create_date');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('create_date');?></a></td>
                    <td nowrap width="150" align="left"><a href="<?php echo String::order_by('account.last_online_time');?>" class="orderby<?php echo String::order_by_active('account.last_online_time');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('last_online');?></a></td>
                    <?php if((User::can_edit())){?>
                    <td nowrap width="1%" colspan="2" align="center"><?php echo Portal::language('action');?></td>
                    <?php } ?>
                </tr>
                <tr class="ht">
                    <td align="center"><img src="skins/default/images/buttons/search.gif" width="18px" /></td>
                    <td><input  name="search_id" id="search_id" class="search-field" autofocus / type ="text" value="<?php echo String::html_normalize(URL::get('search_id'));?>"></td>
                    <td><input  name="search_email" id="search_email" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_email'));?>"></td>
                    <td><select  name="search_is_active" id="search_is_active" class="search-field"><?php
					if(isset($this->map['search_is_active_list']))
					{
						foreach($this->map['search_is_active_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('search_is_active').value = "<?php echo addslashes(URL::get('search_is_active',isset($this->map['search_is_active'])?$this->map['search_is_active']:''));?>";</script></td>
                    <td><select  name="search_is_block" id="search_is_block" class="search-field"><?php
					if(isset($this->map['search_is_block_list']))
					{
						foreach($this->map['search_is_block_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('search_is_block').value = "<?php echo addslashes(URL::get('search_is_block',isset($this->map['search_is_block'])?$this->map['search_is_block']:''));?>";</script></td>
                    <td>
                        <input  name="search_create_date_f" id="search_create_date_f" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_create_date_f'));?>">
                        <input  name="search_create_date_t" id="search_create_date_t" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_create_date_t'));?>">
                    </td>
                    <td>
                        <input  name="search_last_online_time_f" id="search_last_online_time_f" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_last_online_time_f'));?>">
                        <input  name="search_last_online_time_t" id="search_last_online_time_t" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_last_online_time_t'));?>">
                    </td>
                    <?php if((User::can_edit())){?>
                    <td align="center"><?php echo Portal::language('edit');?></td>
                    <!--<td align="center"><?php echo Portal::language('grant_privilege');?></td>-->
                    <?php } ?>
                </tr><?php $i=1;?>
                <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
                <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="<?php if($i%2){echo 'background-color:#F9F9F9';} $i++;?>" id="ListManageCustomerForm_tr_<?php echo $this->map['items']['current']['id'];?>">
                    <td><?php if((User::can_delete())){?><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'ListManageCustomerForm',this,'#FFFFEC','white');" id="ListManageCustomerForm_checkbox"><?php } ?></td>
                    <td nowrap><?php echo $this->map['items']['current']['HoDem'];?> <?php echo $this->map['items']['current']['Ten'];?></td>
                    <td nowrap><?php echo $this->map['items']['current']['email'];?></td>
                    <td nowrap><?php echo $this->map['yesno'][$this->map['items']['current']['is_active']];?></td>
                    <td nowrap><?php echo $this->map['yesno'][$this->map['items']['current']['is_block']];?></td>
                    <td nowrap><?php echo date('h\h:i\':s\" - d/m/Y',$this->map['items']['current']['create_date']);?></td>
                    <td nowrap><?php echo date('h\h:i\':s\" - d/m/Y',$this->map['items']['current']['last_online_time']);?></td>
                    <?php if((User::can_edit())){?>
                    <td nowrap align="center"><a href="<?php echo Url::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>"><img src="<?php echo 'templates/admin/images/buttons/edit.jpg';?>" title="<?php echo Portal::language('edit');?>" /></a></td>
                    <!--<td nowrap align="center"><a href="<?php echo Url::build('grant_privilege',array('cmd'=>'grant','account_id'=>$this->map['items']['current']['id'],'type'=>'CUSTOMER'));?>"><img src="<?php echo 'templates/admin/images/buttons/list_button.gif';?>" title="<?php echo Portal::language('grant_privilege');?>" /></a></td>-->
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
        <div class="clrfix">
            <div class="fl">
                <?php echo Portal::language('select');?>:&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListManageCustomerForm,'ListManageCustomerForm',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListManageCustomerForm,'ListManageCustomerForm',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListManageCustomerForm,'ListManageCustomerForm',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
        </div>
	</div>
</div>
<script type="text/javascript">
jQuery(function() {
	jQuery("#search_create_date_f").datepicker({ dateFormat: "dd/mm/yy" });
	jQuery("#search_create_date_t").datepicker({ dateFormat: "dd/mm/yy" });
	jQuery("#search_last_online_time_f").datepicker({ dateFormat: "dd/mm/yy" });
	jQuery("#search_last_online_time_t").datepicker({ dateFormat: "dd/mm/yy" });
});
</script>