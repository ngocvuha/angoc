<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
        <form name="ListPackageAdminForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <div class="clrfix pad-B5">
            <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <th width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="PackageAdmin_all_checkbox" onclick="select_all_checkbox(this.form, 'PackageAdmin',this.checked,'#FFFFEC','white');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th>
                <th nowrap align="left"><b><?php echo Portal::language('name');?></b></th>
                <th width="50%" nowrap align="left"><b><?php echo Portal::language('title');?></b></th>
                <?php if((User::can_edit())){?>
                <th colspan="2" nowrap="nowrap"><?php echo Portal::language('action');?></th>
                <?php } ?>
            </tr>
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <td width="1%" align="center"><img src="templates/admin/images/buttons/search.gif" width="18px" /></td>
                <td><input  name="search_name" id="search_name" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_name'));?>"><script type="text/javascript">$('search_name').focus();</script></td>
                <td><input  name="search_title_1" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_title_1'));?>"></td>
                <td></td>
                <td></td>
            </tr>
            <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="cursor:pointer;" id="PackageAdmin_tr_<?php echo $this->map['items']['current']['id'];?>">
                <td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'PackageAdmin',this,'#FFFFEC','white'\);" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
                <td nowrap align="left" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>';"><?php echo $this->map['items']['current']['indent'];?> <?php echo $this->map['items']['current']['indent_image'];?> <span class="page_indent">&nbsp;</span> <?php echo $this->map['items']['current']['name'];?></td>
                <td nowrap align="left" onclick="location='<?php echo URL::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>';"><?php echo $this->map['items']['current']['title'];?></td>
                <?php if((User::can_edit())){?>
                <td width="1%" align="center" title="<?php echo Portal::language('up');?>"><a href="<?php echo Url::build_current(array('cmd'=>'move_up','id'=>$this->map['items']['current']['id']));?>"><?php echo $this->map['items']['current']['move_up'];?></a></td>
                <td width="1%" align="center" title="<?php echo Portal::language('down');?>"><a href="<?php echo Url::build_current(array('cmd'=>'move_down','id'=>$this->map['items']['current']['id']));?>"><?php echo $this->map['items']['current']['move_down'];?></a></td>
                <?php } ?>
            </tr>
            <?php }}unset($this->map['items']['current']);} ?>
        </table>
        <input type="hidden" name="cmd" id="cmd" value="" />
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
        <div class="clrfix pad-TB5">
        	<div class="fl">
				<?php echo Portal::language('select');?>:&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageAdminForm,'PackageAdmin',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageAdminForm,'PackageAdmin',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>&nbsp;
				<a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPackageAdminForm,'PackageAdmin',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
        </div>
    </div>
</div>