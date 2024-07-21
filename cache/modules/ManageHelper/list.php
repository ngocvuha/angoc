<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
	<form name="ManageHelper" method="post">
        <div class="clrfix pad-B5">
            <?php if(($this->map['paging'])){?><div class="fl"><?php echo $this->map['paging'];?></div><div class="fl pad-T5">&nbsp;- Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div><?php } ?>
            <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr class="ht">
                <td width="1%" title="<?php echo Portal::language('check_all');?>"><?php if((User::can_delete())){?><input type="checkbox" value="1" id="ManageHelper_all_checkbox" onclick="select_all_checkbox(this.form, 'ManageHelper',this.checked,'#FFFFEC','white');"><?php } ?></td>
                <td nowrap align="left"><a href="<?php echo String::order_by('helper.name_'.Portal::get_setting('default_language'));?>" class="orderby<?php echo String::order_by_active('helper.name_'.Portal::get_setting('default_language'));?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('name');?></a></td>
                <td nowrap width="200"><a href="<?php echo String::order_by('function.name_'.Portal::get_setting('default_language'));?>" class="orderby<?php echo String::order_by_active('funtion.name_'.Portal::get_setting('default_language'));?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('category');?></a></td>
                <td nowrap width="50" align="left"><a href="<?php echo String::order_by('helper.id');?>" class="orderby<?php echo String::order_by_active('helper.id');?>" title="<?php echo Portal::language('sort');?>"><?php echo Portal::language('id');?></a></td>
                <?php if((User::can_edit())){?>
                <td nowrap width="1%"><?php echo Portal::language('action');?></td>
                <?php } ?>
            </tr>
            <tr class="ht">
                <td align="center"><img src="<?php echo 'templates/admin/images/buttons/search.gif';?>" width="18px" /></td>
                <td><input  name="search_name" id="search_name" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_name'));?>"><script type="text/javascript">$('search_name').focus();</script></td>
                <td><select  name="category_id" id="category_id" class="search-field"><option value=""></option><?php echo String::get_select_list($this->map['category_id'],'category_id');?></select></td>
                <td>
                	<input  name="search_id_f" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_id_f'));?>">
                    <input  name="search_id_t" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_id_t'));?>">
                </td>
                <?php if((User::can_edit())){?>
                <td></td>
                <?php } ?>
            </tr><?php $i=0;?>
            <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="<?php if($i%2){echo 'background-color:#F9F9F9';} $i++;?>" id="ManageHelper_tr_<?php echo $this->map['items']['current']['id'];?>">
                <td align="center">
                	<?php if((User::can_delete())){?>
                    <input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'ManageHelper',this,'#FFFFEC','white');" id="ManageHelper_checkbox">
                     <?php }else{ ?>--<?php } ?>
                </td >
                <td><?php echo $this->map['items']['current']['name'];?></td>
                <td><?php echo $this->map['items']['current']['category_name'];?></td>
                <td align="right"><?php echo $this->map['items']['current']['id'];?></td>
                <?php if((User::can_edit())){?>
                <td align="center"><a href="<?php echo Url::build_current(array('id'=>$this->map['items']['current']['id'],'cmd'=>'edit'));?>"><img src="<?php echo 'templates/admin/images/buttons/edit.jpg';?>"></a></td>
                <?php } ?>
            </tr>
            <?php }}unset($this->map['items']['current']);} ?>
		</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
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
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ManageHelper,'ManageHelper',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ManageHelper,'ManageHelper',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ManageHelper,'ManageHelper',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
        </div>
	</div>
</div>