<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="EditModuleAdminForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" enctype="multipart/form-data">
	        <.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
            <table width="100%" border="1" cellspacing="0" cellpadding="10" bordercolor="#cccccc">
                <tr>
                    <th width="1%" nowrap="nowrap">Tên Module:</th>
                    <td><input name="name" type="text" id="name" style="width:150" /><script type="text/javascript">$('name').focus();</script></td>
                </tr>
                <tr>
                    <th width="1%" nowrap="nowrap">Tiêu đề Module:</th>
                    <td><input name="title_1" type="text" id="title_1" style="width:150" /></td>
                </tr>
                <tr>
                    <th nowrap="nowrap">Nhóm Module:</th>
                    <td><select name="package_id" id="package_id"></select></td>
                </tr>
                <tr>
                    <th nowrap="nowrap">Tuỳ chọn:</th>
                    <td>
                        <label for="privilege">[[.privilege.]]:</label>
                        <input name="privilege" id="privilege" type="checkbox" value="1" <?php echo (URL::get('privilege')?'checked':'');?>>
                        <label for="fun_extend">[[.function_extend.]]:</label>
                        <input name="fun_extend" id="fun_extend" type="checkbox" value="1" <?php echo (URL::get('fun_extend')?'checked':'');?>>
                    </td>
                </tr>
                <tr>
                    <th nowrap="nowrap">Ảnh đại diện:</th>
                    <td>
                        <input name="image_url" type="file" id="image_url" />
                        <!--IF:cond(Url::get('cmd')=='edit' and Url::get('id') and [[=image_url=]] and file_exists([[=image_url=]]))-->
                        <img src="[[|image_url|]]" />
                        <a href="<?php echo Url::build_current(array('cmd'=>'delete_image','id'=>Url::nget('id')));?>">Xoá ảnh</a>
                        <!--/IF:cond-->
                    </td>
                </tr>
                <!--IF:cond([[=using_pages=]])-->
                <tr>
                	<th nowrap="nowrap">Các vùng hiện diện:</th>
                    <td>
                        <ol>
                        <!--LIST:using_pages-->
                        <li class="fl" style="width:30%;"><a target="_blank" href="{{Url::build([[=using_pages.name=]])}}" title="[[.page.]]">[[|using_pages.name|]]</a><span style="color:#999;" title="[[.region.]]">([[|using_pages.region|]])</span> [<a href="{{URL::build_current(array('cmd'=>'delete_block','block_id'=>[[=using_pages.id=]],'module_id'=>Url::nget('id')))}}">[[.delete.]]</a>]</li>
                        <!--/LIST:using_pages-->
                        </ol>
                    </td>
                </tr>
                <!--/IF:cond-->
            </table>
            <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
        </form>
    </div>
</div>
