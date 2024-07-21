<!--<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
    <form name="ListCategoryForm" method="post">
        <table cellpadding="2" cellspacing="0" width="100%" border="1" bordercolor="<?php echo Portal::get_setting('crud_list_item_frame_color','#C3C3C3');?>">
            <tr class="ht">
                <th width="1%" title="[[.check_all.]]"><!--IF:can(User::can_delete())--><input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'#FFFFEC','white');"><!--/IF:can--></th>
                <th align="left" nowrap>[[.name.]]</th>
                <th width="95" align="left" nowrap>[[.status.]]</th>
                <!--IF:can(User::can_edit())-->
                <th width="50" nowrap="nowrap">[[.edit.]]</th>
                <th width="50" nowrap="nowrap">[[.up.]]</th>
                <th width="50" nowrap="nowrap">[[.down.]]</th>
                <!--/IF:can-->
            </tr>
            <.$i=0;.>
            <!--LIST:items-->
            <tr class="tr-item-content<.echo $i%2?' tr-odd':''; $i++;.>" id="Category_tr_[[|items.id|]]">
                <td width="20" align="left"><!--IF:can(User::can_delete() and [[=items.structure_id=]]!=ID_ROOT)--><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'Category',this,'#FFFFEC','white');" id="Category_checkbox" /><!--/IF:can--></td />
                <td align="left" nowrap>
                [[|items.indent|]]
                [[|items.indent_image|]]
                <span class="page_indent">&nbsp;</span>
                [[|items.name|]]</td>
                <td align="left" nowrap>[[|items.status|]]</td>
                <!--IF:can(User::can_edit())-->
                <td align="center"><!--IF:can([[=items.structure_id=]]!=ID_ROOT)--><a href="{{Url::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]));}}"><img src="{{'templates/admin/images/buttons/edit.jpg'}}" title="[[.edit.]]" alt="[[.edit.]]" /></a><!--/IF:can--></td>
                <td align="center"><a href="{{Url::build_current(array('cmd'=>'move_up','id'=>[[=items.id=]]))}}" title="[[.up.]]">[[|items.move_up|]]</a></td>
                <td align="center"><a href="{{Url::build_current(array('cmd'=>'move_down','id'=>[[=items.id=]]))}}" title="[[.down.]]">[[|items.move_down|]]</a></td>
                <!--/IF:can-->
            </tr>
            <!--/LIST:items-->
        </table>
        <input type="hidden" name="cmd" value="" id="cmd"/>
        <!--IF:delete(URL::get('cmd')=='delete')-->
        <input type="hidden" name="confirm" value="1" />
        <!--/IF:delete-->
    </form>
    <div class="clrfix pad-TB5">
        <div class="fl">
            [[.select.]]:&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
        </div>
        <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
    </div>
    </div>
</div>
-->
<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
    <form name="ListCategoryForm" method="post">
        <table cellpadding="2" cellspacing="0" width="100%" border="1" bordercolor="#cccccc">
            <tr class="ht">
                <th width="1%" title="[[.check_all.]]"><!--IF:can(User::can_delete())--><input type="checkbox" value="1" id="Category_all_checkbox" onclick="select_all_checkbox(this.form,'Category',this.checked,'#FFFFEC','white');"><!--/IF:can--></th>
                <th align="left" nowrap>[[.name.]]</th>
                <!--<th width="200">structure_id</th>-->
                <th width="95" align="left" nowrap>[[.status.]]</th>
                <!--IF:can(User::can_edit())-->
                <th width="50" nowrap="nowrap">[[.edit.]]</th>
                <th width="50" nowrap="nowrap">[[.up.]]</th>
                <th width="50" nowrap="nowrap">[[.down.]]</th>
                <!--/IF:can-->
            </tr>
        </table>
        <ul id="sortable" class="ul-sortable"><.$i=0;.>
            <!--LIST:items-->
            <li class="tr-item-content<.echo $i%2?' tr-odd':''; $i++;.> parent-droppable" name="[[|items.name|]] ([[|items.id|]])" id="[[|items.id|]]" structure_id="[[|items.structure_id|]]">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td width="20" align="left"><!--IF:can(User::can_delete() and [[=items.structure_id=]]!=ID_ROOT)--><input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'Category',this,'#FFFFEC','white');" id="Category_checkbox" /><!--/IF:can--></td />
                        <td align="left" nowrap>
                        [[|items.indent|]]
                        [[|items.indent_image|]]
                        <span class="page_indent">&nbsp;</span>
                        [[|items.name|]]</td>
                        <!--<td width="200">[[|items.structure_id|]]</td>-->
                        <td width="95" nowrap>[[|items.status|]]</td>
                        <!--IF:can(User::can_edit())-->
                        <td width="50" align="center"><!--IF:can([[=items.structure_id=]]!=ID_ROOT)--><a href="{{Url::build_current(array('cmd'=>'edit','id'=>[[=items.id=]]));}}"><img src="{{'templates/admin/images/buttons/edit.jpg'}}" title="[[.edit.]]" alt="[[.edit.]]" /></a><!--/IF:can--></td>
                        <td width="50" align="center"><a href="{{Url::build_current(array('cmd'=>'move_up','id'=>[[=items.id=]]))}}" title="[[.up.]]">[[|items.move_up|]]</a></td>
                        <td width="50" align="center"><a href="{{Url::build_current(array('cmd'=>'move_down','id'=>[[=items.id=]]))}}" title="[[.down.]]">[[|items.move_down|]]</a></td>
                        <!--/IF:can-->
                    </tr>
                </table>
            </li>
            <!--<li class="sort-droppable" structure_id="[[|items.structure_id|]]" style="padding-left:400px;">Dưới [[|items.name|]]</li>-->
            <!--/LIST:items-->
        </ul>
        <input type="hidden" name="cmd" id="cmd" />
    </form>
    <div class="clrfix pad-TB5">
        <div class="fl">
            [[.select.]]:&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
            <a href="javascript:void(0)" onclick="select_all_checkbox(document.ListCategoryForm,'Category',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
        </div>
        <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
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
			var check = check_droppable('{{Module::block_id()}}',move_structure_id,droppable_structure_id);
			if(check=='true'){
				window.location = '{{Url::build_current(array("cmd"=>"change_parent"))}}&move_structure_id='+move_structure_id+'&droppable_structure_id='+droppable_structure_id;
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
				window.location = '{{Url::build_current(array("cmd"=>"move_position"))}}&move_structure_id='+move_structure_id+'&structure_id='+structure_id;
			}
		}
	});
	
	<!--IF:cond(Url::iget('move_id'))-->
	jQuery('#{{Url::iget("move_id")}}').css('background-color','#FFF0E1');
	var pos=jQuery('#{{Url::iget("move_id")}}').position();
	window.scrollTo(0,pos.top-200);
	<!--/IF:cond-->
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