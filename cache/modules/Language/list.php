<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý ngôn ngữ<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
        <form name="ListLanguageForm" method="post">
            <table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7" align="center">
                <tr class="ht">
                    <td nowrap><b>ID</b></td>
                    <td nowrap><b>Mã</b></td>
                    <td nowrap><b>Tên</b></td>
                    <td><b>Ảnh đại diện</b></td>
                    <td><b>Trạng thái</b></td>
                    <td><b>Vị trí</b></td>
                    <?php if((User::can_edit())){?>
                    <td nowrap width="1%">Hành động</td>
                    <?php } ?>
                </tr>
                <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?>>
                    <td nowrap><?php echo $this->map['items']['current']['id'];?></td>
                    <td nowrap><?php echo $this->map['items']['current']['code'];?></td>
                    <td nowrap><?php echo $this->map['items']['current']['name'];?><?php echo $this->map['items']['current']['main']?' - <span style="color:red;">[ Mặc định ]</span>':'';?></td>
                    <td><img src="<?php echo $this->map['items']['current']['icon_url'];?>" width="34" /></td>
                    <td><?php echo $this->map['items']['current']['status']?'<span style="color:red;">Hiển thị</span>':'Ẩn';?></td>
                    <td><?php echo $this->map['items']['current']['position'];?></td>
                    <?php if((User::can_edit())){?>
                    <td align="center"><a href="<?php echo Url::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>"><img src="<?php echo 'templates/admin/images/buttons/edit.jpg';?>" title="<?php echo Portal::language('edit');?>" /></a></td>
                    <?php } ?>
                </tr>
                <?php }}unset($this->map['items']['current']);} ?>
            </table>
            <div align="right"><a href="javascript:void(0);" onclick="window.scrollTo(0,0);"><img src="templates/admin/images/buttons/top.gif" alt="<?php echo Portal::language('top');?>" width="49" height="23" border="0" title="<?php echo Portal::language('top');?>"></a></div>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	</div>
</div>
