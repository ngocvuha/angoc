<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
        <form name="ListPageAdminForm" method="post">
        <div class="clrfix pad-B5">
            <?php if(($this->map['paging'])){?><div class="fl"><?php echo $this->map['paging'];?></div><div class="fl pad-T5">&nbsp;- Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div><?php } ?>
            <div class="fr">
            <button id="search" class="blue-button">Tìm kiếm</button>
            </div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <th width="1%" title="<?php echo Portal::language('check_all');?>"><input type="checkbox" value="1" id="PageAdmin_all_checkbox" onclick="select_all_checkbox(this.form, 'PageAdmin',this.checked,'#FFFFEC','white');"></th>
                <th width="1%" nowrap="nowrap"><?php echo Portal::language('view');?></th>
                <th nowrap align="left"><a href="<?php echo String::order_by('page.name');?>" class="orderby<?php echo String::order_by_active('page.name');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('name');?></a></th>
                <th width="30%" nowrap align="left"><a href="<?php echo String::order_by('page.title_1');?>" class="orderby<?php echo String::order_by_active('page.title_1');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('title');?></a></th>
                <th width="30%" nowrap align="left"><a href="<?php echo String::order_by('page.package_id');?>" class="orderby<?php echo String::order_by_active('page.package_id');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('package');?></a></th>
                <th nowrap="nowrap" style="text-align:center;">THEME</th>
                <?php if((User::can_edit())){?>
                <th colspan="5" nowrap="nowrap" style="text-align:center;"><?php echo Portal::language('action');?></th>
                <?php } ?>
            </tr>
            <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                <td width="1%" align="center"><img src="templates/admin/images/buttons/search.gif" width="18px" /></td>
                <td></td>
                <td><input  name="search_name" id="search_name" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_name'));?>"><script type="text/javascript">$('search_name').focus();</script></td>
                <td><input  name="search_title_1" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_title_1'));?>"></td>
                <td><select  name="package_id" id="package_id" class="search-field"><?php
					if(isset($this->map['package_id_list']))
					{
						foreach($this->map['package_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('package_id').value = "<?php echo addslashes(URL::get('package_id',isset($this->map['package_id'])?$this->map['package_id']:''));?>";</script></td>
                <td align="center"><select  name="theme" id="theme" class="search-field"><?php
					if(isset($this->map['theme_list']))
					{
						foreach($this->map['theme_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('theme').value = "<?php echo addslashes(URL::get('theme',isset($this->map['theme'])?$this->map['theme']:''));?>";</script></td>
                <td align="center">Hide</td>
                <td align="center">Cache</td>
                <td align="center">Edit</td>
                <td align="center">Structure</td>
                <td align="center">Copy</td>
            </tr>
            <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> id="PageAdmin_tr_<?php echo $this->map['items']['current']['id'];?>">
                <td><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'PageAdmin',this,'#FFFFEC','white');"></td>
                <td align="center"><a target="_blank" href="<?php echo URL::build($this->map['items']['current']['name']);?>"><img src="templates/admin/images/buttons/select.jpg" title="<?php echo Portal::language('view');?>" alt="<?php echo Portal::language('edit');?>" /></a></td>
                <td nowrap align="left"><?php echo $this->map['items']['current']['name'];?></td>
                <td align="left"><?php echo $this->map['items']['current']['title'];?></td>
                <td nowrap align="left"><?php echo $this->map['items']['current']['package_id'];?></td>
                <td nowrap align="left"><?php echo $this->map['items']['current']['theme'];?></td>
                <?php if((User::can_edit())){?>
                <td width="60"  nowrap align="center"><input type="checkbox" name="hide" onclick="ajaxForm({'cmd':'update_hide','id':<?php echo $this->map['items']['current']['id'];?>,'hide':this.checked},<?php echo Module::block_id();?>);"<?php echo $this->map['items']['current']['hide']?' checked':'';?> /></td>
                <td width="60"  nowrap align="center"><input type="checkbox" name="cache" onclick="ajaxForm({'cmd':'update_cache','id':<?php echo $this->map['items']['current']['id'];?>,'cache':this.checked},<?php echo Module::block_id();?>);"<?php echo $this->map['items']['current']['cachable']?' checked':'';?> /></td>
                <td width="60" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>"><img src="templates/admin/images/buttons/edit.gif" title="<?php echo Portal::language('edit');?>" alt="<?php echo Portal::language('edit');?>" width="12" height="12" border="0"></a></td>
                <td width="60" align="center"><a href="<?php echo Url::build('edit_page',array('id'=>$this->map['items']['current']['id']));?>"><img src="templates/admin/images/icons/generate_button.gif" title="<?php echo Portal::language('page_structure');?>" alt="<?php echo Portal::language('page_structure');?>" width="13" height="13" border="0"></a></td>
                <td width="60" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'duplicate','id'=>$this->map['items']['current']['id']));?>"><img src="templates/admin/images/buttons/copy.png" title="<?php echo Portal::language('copy');?>" alt="<?php echo Portal::language('copy');?>" width="13" height="13" border="0"></a></td>
                <?php } ?>
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
        <div class="clrfix">
        	<div class="fl">
                <?php echo Portal::language('select');?>:&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPageAdminForm,'PageAdmin',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPageAdminForm,'PageAdmin',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListPageAdminForm,'PageAdmin',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
        </div>
	</div>
</div>