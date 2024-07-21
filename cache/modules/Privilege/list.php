<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý quyền của tài khoản<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
        <form name="ListPrivilegeForm" method="post">
            <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
                <tr class="ht">
                        <th width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="ListPrivilegeForm_all_checkbox" onclick="select_all_checkbox(this.form, 'ListPrivilegeForm',this.checked,'#FFFFEC','white');"></th>
                        <th nowrap align="left" >Tên quyền</th>
                        <?php if((User::can_edit())){?>
                        <th nowrap="nowrap" width="1%">Cấp quyền</th>
                        <?php } ?>
                    </tr><?php $i=1;?>
                    <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
                    <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="<?php if($i%2){echo 'background-color:#F9F9F9';} $i++;?>" id="ListPrivilegeForm_tr_<?php echo $this->map['items']['current']['id'];?>">
                        <td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'ListPrivilegeForm',this,'#FFFFEC','white');"></td>
                        <td align="left" nowrap><?php echo $this->map['items']['current']['name'];?></td>
                        <?php if((User::can_edit())){?>
                        <td align="center"><a href="<?php echo Url::build_current(array('cmd'=>'grant','id'=>$this->map['items']['current']['id']));?>"><img src="templates/adminimages/buttons/add.jpg" title="<?php echo Portal::language('add');?>" /></a></td>
                        <?php } ?>
                    </tr>
                    <?php }}unset($this->map['items']['current']);} ?>
                </table>
                <input type="hidden" name="cmd" id="cmd" />
                </td>
                </tr>
            </table>	
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
        <div class="clrfix pad-B5">
            <?php if(($this->map['paging'])){?><div class="fl pad-R10"><?php echo $this->map['paging'];?></div><?php } ?><div class="fl pad-T5">Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div>
        </div>
        <div class="clrfix">
            <div class="fl">
                Lựa chọn:&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPrivilegeForm,'ListPrivilegeForm',true,'#FFFFEC','white');">Tất cả</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPrivilegeForm,'ListPrivilegeForm',false,'#FFFFEC','white');">Bỏ chọn</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPrivilegeForm,'ListPrivilegeForm',-1,'#FFFFEC','white');">Ngược lại</a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
        </div>
	</div>
</div>
