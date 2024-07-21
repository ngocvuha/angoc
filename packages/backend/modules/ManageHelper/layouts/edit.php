<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
	<form name="EditManageHelper" id="EditManageHelper" method="post">
    <.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
    	<div class="mar-B5"><label>Chọn tính năng: </label><select name="category_id" id="category_id"></select></div>
        <div id="tabs" class="option-bound">
            <ul>
            <!--LIST:languages-->
                <li><a href="#tabs-[[|languages.id|]]">[[|languages.name|]]</a></li>
            <!--/LIST:languages-->
            </ul>
            <!--LIST:languages-->
            <div id="tabs-[[|languages.id|]]">
                <div><label for="name_[[|languages.id|]]">[[.name.]]</label><!--IF:cond([[=languages.main=]])--><span class="require">(*)</span><!--/IF:cond--></div>
                <div><input name="name_[[|languages.id|]]" type="text" id="name_[[|languages.id|]]" class="search-field" /></div>
                <div class="pad-TB5"><label>[[.description.]]</label></div>
                <div><textarea name="description_[[|languages.id|]]" id="description_[[|languages.id|]]" cols="75" rows="20" class="search-field" style="width:100%;height:600px;overflow:hidden;"></textarea><span class="mce-button" onclick="advance_mce('description_[[|languages.id|]]');">Soạn thảo văn bản</span></div>
            </div>
            <!--/LIST:languages-->
        </div>
    <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
	</form>
	</div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery("#tabs").tabs();
});
</script>