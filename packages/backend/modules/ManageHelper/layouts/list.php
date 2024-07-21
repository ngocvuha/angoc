<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="add" class="red-button">Thêm mới</button><!--/IF:can-->
        <!--IF:can(User::can_delete())--><button id="delete" class="gray-button">Xóa</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
	<form name="ManageHelper" method="post">
        <div class="clrfix pad-B5">
            <!--IF:cond([[=paging=]])--><div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div><!--/IF:cond-->
            <div class="fr"><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr class="ht">
                <td width="1%" title="[[.check_all.]]"><!--IF:can(User::can_delete())--><input type="checkbox" value="1" id="ManageHelper_all_checkbox" onclick="select_all_checkbox(this.form, 'ManageHelper',this.checked,'#FFFFEC','white');"><!--/IF:can--></td>
                <td nowrap align="left"><a href="{{String::order_by('helper.name_'.Portal::get_setting('default_language'))}}" class="orderby{{String::order_by_active('helper.name_'.Portal::get_setting('default_language'))}}" title="[[.sort.]]">[[.name.]]</a></td>
                <td nowrap width="200"><a href="{{String::order_by('function.name_'.Portal::get_setting('default_language'))}}" class="orderby{{String::order_by_active('funtion.name_'.Portal::get_setting('default_language'))}}" title="[[.sort.]]">[[.category.]]</a></td>
                <td nowrap width="50" align="left"><a href="{{String::order_by('helper.id')}}" class="orderby{{String::order_by_active('helper.id')}}" title="[[.sort.]]">[[.id.]]</a></td>
                <!--IF:can(User::can_edit())-->
                <td nowrap width="1%">[[.action.]]</td>
                <!--/IF:can-->
            </tr>
            <tr class="ht">
                <td align="center"><img src="{{'templates/admin/images/buttons/search.gif'}}" width="18px" /></td>
                <td><input name="search_name" type="text" id="search_name" class="search-field" /><script type="text/javascript">$('search_name').focus();</script></td>
                <td><select  name="category_id" id="category_id" class="search-field"><option value=""></option>{{String::get_select_list([[=category_id=]],'category_id')}}</select></td>
                <td>
                	<input name="search_id_f" type="text" class="search-field" />
                    <input name="search_id_t" type="text" class="search-field" />
                </td>
                <!--IF:can(User::can_edit())-->
                <td></td>
                <!--/IF:can-->
            </tr><.$i=0;.>
            <!--LIST:items-->
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="<.if($i%2){echo 'background-color:#F9F9F9';} $i++;.>" id="ManageHelper_tr_[[|items.id|]]">
                <td align="center">
                	<!--IF:can(User::can_delete())-->
                    <input name="selected_ids[]" type="checkbox" value="[[|items.id|]]" onclick="select_checkbox(this.form,'ManageHelper',this,'#FFFFEC','white');" id="ManageHelper_checkbox">
                    <!--ELSE-->--<!--/IF:can-->
                </td >
                <td>[[|items.name|]]</td>
                <td>[[|items.category_name|]]</td>
                <td align="right">[[|items.id|]]</td>
                <!--IF:can(User::can_edit())-->
                <td align="center"><a href="{{Url::build_current(array('id'=>[[=items.id=]],'cmd'=>'edit'))}}"><img src="{{'templates/admin/images/buttons/edit.jpg'}}"></a></td>
                <!--/IF:can-->
            </tr>
            <!--/LIST:items-->
		</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
        </form>
        <!--IF:cond([[=paging=]])-->
        <div class="clrfix pad-B5">
            <div class="fl">[[|paging|]]</div><div class="fl pad-T5">&nbsp;- Tổng: <strong>[[|total|]]</strong> bản ghi</div>
        </div>
        <!--/IF:cond-->
        <div class="clrfix">
            <div class="fl">
                [[.select.]]:&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ManageHelper,'ManageHelper',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ManageHelper,'ManageHelper',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.ManageHelper,'ManageHelper',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
        </div>
	</div>
</div>