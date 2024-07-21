<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name')}}</div>
        <div class="fr">
        <button id="save_add" class="red-button">Thực hiện</button>
        </div>
    </div>
	<div class="form-content">
        <form name="cleanerForm" id="cleanerForm" method="post">
            <table width="100%" cellpadding="2" cellspacing="0" border="1" bordercolor="#CCCCCC">
                <tr valign="middle" bgcolor="#EFEFEF" style="line-height:20px">
                    <th width="1%" title="[[.check_all.]]"><input type="checkbox" value="1" id="item_all_checkbox" onclick="select_all_checkbox(this.form,'item',this.checked,'#FFFFEC','white');" /></th>
                    <th nowrap align="left">Khu vực dọn dẹp</th>
                </tr><.$i=0;.>
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?>>
                    <td align="center"><input name="selected_ids[]" type="checkbox" value="1" onclick="select_checkbox(this.form,'item',this,'#FFFFEC','white');" id="cache_css" class="selected_ids" /></td>
                    <td nowrap><label for="cache_css" style="display:block;">Cache CSS</label></td>
                </tr>
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?>>
                    <td align="center"><input name="selected_ids[]" type="checkbox" value="2" onclick="select_checkbox(this.form,'item',this,'#FFFFEC','white');" id="cache_html" class="selected_ids" /></td>
                    <td nowrap><label for="cache_html" style="display:block;">Cache HTML</label></td>
                </tr>
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?>>
                    <td align="center"><input name="selected_ids[]" type="checkbox" value="3" onclick="select_checkbox(this.form,'item',this,'#FFFFEC','white');" id="cache_db" class="selected_ids" /></td>
                    <td nowrap><label for="cache_db" style="display:block;">Cache DB</label></td>
                </tr>
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?>>
                    <td align="center"><input name="selected_ids[]" type="checkbox" value="4" onclick="select_checkbox(this.form,'item',this,'#FFFFEC','white');" id="cache_modules" class="selected_ids" /></td>
                    <td nowrap><label for="cache_modules" style="display:block;">Cache MODULES</label></td>
                </tr>
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?>>
                    <td align="center"><input name="selected_ids[]" type="checkbox" value="5" onclick="select_checkbox(this.form,'item',this,'#FFFFEC','white');" id="cache_pages" class="selected_ids" /></td>
                    <td nowrap><label for="cache_pages" style="display:block;">Cache PAGES</label></td>
                </tr>
                <tr valign="middle" <?php Draw::hover('#FFFFDD');?>>
                    <td align="center"><input name="selected_ids[]" type="checkbox" value="6" onclick="select_checkbox(this.form,'item',this,'#FFFFEC','white');" id="cache_thumb" class="selected_ids" /></td>
                    <td nowrap><label for="cache_thumb" style="display:block;">Cache TIMTHUMB</label></td>
                </tr>
            </table>
            <div class="clrfix pad-TB5">
                <div class="fl">
                    [[.select.]]:&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.cleanerForm,'item',true,'#FFFFEC','white');">[[.select_all.]]</a>&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.cleanerForm,'item',false,'#FFFFEC','white');">[[.select_none.]]</a>&nbsp;
                    <a href="javascript:void(0)" onclick="select_all_checkbox(document.cleanerForm,'item',-1,'#FFFFEC','white');">[[.select_invert.]]</a>
                </div>
                <div class="fr"><a href="javascript:void(window.scrollTo(0,0))"><img src="templates/admin/images/buttons/top.gif" title="[[.top.]]" border="0" alt="[[.top.]]"></a></div>
            </div>
            <input type="hidden" name="cmd" id="cmd" />
        </form>
    </div>
</div>