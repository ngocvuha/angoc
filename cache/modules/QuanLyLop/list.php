<!--<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
    <form name="ListCategoryForm" method="post">
        <table cellpadding="2" cellspacing="0" width="100%" border="1" bordercolor="<?php echo Portal::get_setting('crud_list_item_frame_color','#C3C3C3');?>">
            <tr class="ht">
                <th width="1%" title="<?php echo Portal::language('check_all');?>"><?php if((User::can_delete())){?><input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'#FFFFEC','white');"><?php } ?></th>
                <th align="left" nowrap><?php echo Portal::language('name');?></th>
                <th width="95" align="left" nowrap><?php echo Portal::language('status');?></th>
                <?php if((User::can_edit())){?>
                <th width="50" nowrap="nowrap"><?php echo Portal::language('edit');?></th>
                <th width="50" nowrap="nowrap"><?php echo Portal::language('up');?></th>
                <th width="50" nowrap="nowrap"><?php echo Portal::language('down');?></th>
                <?php } ?>
            </tr>
            <?php $i=0;?>
            <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
            <tr class="tr-item-content<?php echo $i%2?' tr-odd':''; $i++;?>" id="Category_tr_<?php echo $this->map['items']['current']['id'];?>">
                <td width="20" align="left"><?php if((User::can_delete() and $this->map['items']['current']['structure_id']!=ID_ROOT)){?><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'Category',this,'#FFFFEC','white');" id="Category_checkbox" /><?php } ?></td />
                <td align="left" nowrap>
                <?php echo $this->map['items']['current']['indent'];?>
                <?php echo $this->map['items']['current']['indent_image'];?>
                <span class="page_indent">&nbsp;</span>
                <?php echo $this->map['items']['current']['name'];?></td>
                <td align="left" nowrap><?php echo $this->map['items']['current']['status'];?></td>
                <?php if((User::can_edit())){?>
                <td align="center"><?php if(($this->map['items']['current']['structure_id']!=ID_ROOT)){?><a href="<?php echo Url::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));;?>"><img src="<?php echo 'templates/admin/images/buttons/edit.jpg';?>" title="<?php echo Portal::language('edit');?>" alt="<?php echo Portal::language('edit');?>" /></a><?php } ?></td>
                <td align="center"><a href="<?php echo Url::build_current(array('cmd'=>'move_up','id'=>$this->map['items']['current']['id']));?>" title="<?php echo Portal::language('up');?>"><?php echo $this->map['items']['current']['move_up'];?></a></td>
                <td align="center"><a href="<?php echo Url::build_current(array('cmd'=>'move_down','id'=>$this->map['items']['current']['id']));?>" title="<?php echo Portal::language('down');?>"><?php echo $this->map['items']['current']['move_down'];?></a></td>
                <?php } ?>
            </tr>
            <?php }}unset($this->map['items']['current']);} ?>
        </table>
        <input type="hidden" name="cmd" value="" id="cmd"/>
        <?php if((URL::get('cmd')=='delete')){?>
        <input type="hidden" name="confirm" value="1" />
        <?php } ?>
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
    <div class="clrfix pad-TB5">
        <div class="fl">
            <?php echo Portal::language('select');?>:&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
        </div>
        <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
    </div>
    </div>
</div>
-->
<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="add" class="red-button">Thêm mới</button><?php } ?>
        <?php if((User::can_delete())){?><button id="delete" class="gray-button">Xóa</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
    <form name="ListCategoryForm" method="post">
        <table cellpadding="2" cellspacing="0" width="100%" border="1" bordercolor="#cccccc">
            <tr class="ht">
                <th width="1%" title="<?php echo Portal::language('check_all');?>"><?php if((User::can_delete())){?><input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'#FFFFEC','white');"><?php } ?></th>
                <th align="left" nowrap><?php echo Portal::language('name');?></th>
                <!--<th width="200">structure_id</th>-->
                <th width="95" align="left" nowrap><?php echo Portal::language('status');?></th>
                <?php if((User::can_edit())){?>
                <th width="50" nowrap="nowrap"><?php echo Portal::language('edit');?></th>
                <th width="50" nowrap="nowrap"><?php echo Portal::language('up');?></th>
                <th width="50" nowrap="nowrap"><?php echo Portal::language('down');?></th>
                <?php } ?>
            </tr>
        </table>
        <ul id="sortable" class="ul-sortable"><?php $i=0;?>
            <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key2=>&$item2){ if($key2!='current'){$this->map['items']['current'] = &$item2;?>
            <li class="tr-item-content<?php echo $i%2?' tr-odd':''; $i++;?> parent-droppable" name="<?php echo $this->map['items']['current']['name'];?> (<?php echo $this->map['items']['current']['id'];?>)" id="<?php echo $this->map['items']['current']['id'];?>" structure_id="<?php echo $this->map['items']['current']['structure_id'];?>">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td width="20" align="left"><?php if((User::can_delete() and $this->map['items']['current']['structure_id']!=ID_ROOT)){?><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'Category',this,'#FFFFEC','white');" id="Category_checkbox" /><?php } ?></td />
                        <td align="left" nowrap>
                        <?php echo $this->map['items']['current']['indent'];?>
                        <?php echo $this->map['items']['current']['indent_image'];?>
                        <span class="page_indent">&nbsp;</span>
                        <?php echo $this->map['items']['current']['name'];?></td>
                        <!--<td width="200"><?php echo $this->map['items']['current']['structure_id'];?></td>-->
                        <td width="95" nowrap><?php echo $this->map['items']['current']['status'];?></td>
                        <?php if((User::can_edit())){?>
                        <td width="50" align="center"><?php if(($this->map['items']['current']['structure_id']!=ID_ROOT)){?><a href="<?php echo Url::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));;?>"><img src="<?php echo 'templates/admin/images/buttons/edit.jpg';?>" title="<?php echo Portal::language('edit');?>" alt="<?php echo Portal::language('edit');?>" /></a><?php } ?></td>
                        <td width="50" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'move_up','id'=>$this->map['items']['current']['id']));?>" title="<?php echo Portal::language('up');?>"><?php echo $this->map['items']['current']['move_up'];?></a></td>
                        <td width="50" align="center"><a href="<?php echo Url::build_current(array('cmd'=>'move_down','id'=>$this->map['items']['current']['id']));?>" title="<?php echo Portal::language('down');?>"><?php echo $this->map['items']['current']['move_down'];?></a></td>
                        <?php } ?>
                    </tr>
                </table>
            </li>
            <!--<li class="sort-droppable" structure_id="<?php echo $this->map['items']['current']['structure_id'];?>" style="padding-left:400px;">Dưới <?php echo $this->map['items']['current']['name'];?></li>-->
            <?php }}unset($this->map['items']['current']);} ?>
        </ul>
        <input type="hidden" name="cmd" id="cmd" />
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
    <div class="clrfix pad-TB5">
        <div class="fl">
            <?php echo Portal::language('select');?>:&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'#FFFFEC','white');"><?php echo Portal::language('select_all');?></a>&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'#FFFFEC','white');"><?php echo Portal::language('select_none');?></a>&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'#FFFFEC','white');"><?php echo Portal::language('select_invert');?></a>
        </div>
        <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
    </div>
    </div>
</div>
<script type="text/javascript">
jQuery(function(){
	var move_structure_id=0;
	var droppable_structure_id=0;
	jQuery('.tr-item-content').draggable({
		helper: function( event ) {
			return jQuery("<div class='draggable'>"+jQuery(this).attr('name')+"</div>");
		},
		revert: true,
		cursorAt: { top: 15, left: 20 },
		start: function() {
			jQuery(this).addClass('tr-move-active');
			move_structure_id=jQuery(this).attr('structure_id');
		},
		stop: function(){
			jQuery(this).removeClass('tr-move-active');
		}
	});
	jQuery('.parent-droppable').droppable({
		accept: '.tr-item-content',
		hoverClass: 'ui-state-active',
		drop: function( event, ui ) {
			droppable_structure_id=jQuery(this).attr('structure_id');
			//alert(move_structure_id);
			//alert(droppable_structure_id);
			var check = check_droppable('<?php echo Module::block_id();?>',move_structure_id,droppable_structure_id);
			if(check=='true'){
				window.location = '<?php echo Url::build_current(array("cmd"=>"change_parent"));?>&move_structure_id='+move_structure_id+'&droppable_structure_id='+droppable_structure_id;
			}
		}
	});
	jQuery('.sort-droppable').droppable({
		accept: '.tr-item-content',
		hoverClass: function(){
			structure_id=jQuery(this).attr('structure_id');
			if(move_structure_id!=structure_id){
				jQuery(this).addClass('ui-state-active');
			}
		},
		drop: function( event, ui ) {
			structure_id=jQuery(this).attr('structure_id');
			if(move_structure_id!=structure_id){
				window.location = '<?php echo Url::build_current(array("cmd"=>"move_position"));?>&move_structure_id='+move_structure_id+'&structure_id='+structure_id;
			}
		}
	});
	
	<?php if((Url::iget('move_id'))){?>
	jQuery('#<?php echo Url::iget("move_id");?>').css('background-color','#FFF0E1');
	var pos=jQuery('#<?php echo Url::iget("move_id");?>').position();
	window.scrollTo(0,pos.top-200);
	<?php } ?>
});
function check_droppable(block_id,move_structure_id,droppable_structure_id){
	return jQuery.ajax({
		method: "POST",
		async: false,
		url: 'form.php?block_id='+block_id,
		data : {
			'move_structure_id':move_structure_id,
			'droppable_structure_id':droppable_structure_id,
			'cmd':'check_droppable'
		},
		success: function(content){
			return content;
		}
	}).responseText;
}

</script>