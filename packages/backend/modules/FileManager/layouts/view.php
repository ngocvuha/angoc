<form method="post" name="data" id="data" enctype="multipart/form-data">
<div class="fm-bound">
	<div class="fm-menu-bound">
    	<div class="pad-5 clrfix" style="border-bottom:1px solid #ccc;">
        	<span class="fl">{{User::id()}}[[|current|]]</span>
            <span class="fr bold">Khu vực quản lý tệp của "{{User::id()}}"</span>
        </div>
        <table width="100%" class="fm-menu" border="0">
            <tr>
                <td colspan="2" align="center">
                    <div style="float:left; width:100px;" id="back">
                        <img style="height:25px;" src="templates/admin/images/tree_files/back.png" /><br />
                        Quay lại
                    </div>
                    <div style="float:left; width:100px;">
                        <div id="create_folder" rel="[[|current|]]">
                            <img style="height:25px;" src="{{'templates/admin/images/icons/middle_folder.png'}}" /><br />
                            Tạo thư mục
                        </div>					
                    </div>
                    <div style="float:left; width:100px;display:none;" class="fm-create-folder">
                        <input type="text" name="folder_name" id="folder_name" />
                    </div>
                </td>
                <td align="right" class="fm-upload">
                    <input type="file" name="upload[]" id="upload" multiple />
                    <button type="button" id="upload-btn">[[.upload.]]</button>
                </td>
            </tr>
        </table>
	</div>
	<div class="fm-list-bound clrfix">
	<!--LIST:list-->
		<!--IF:folder([[=list.type=]]=='folder')-->
			<div class="fm-folder" rel="[[|list.name|]]">
				<img src="templates/admin/images/tree_files/new_folder.jpeg" />
				<div class="fm-name">[[|list.name|]]</div>
			</div>
		<!--/IF:folder-->
		<!--IF:file([[=list.type=]]=='file')-->
			<div class="fm-file" path="[[|list.src|]]" rel="[[|list.name|]]">
				<!--IF:image([[=list.ext=]]=='image')-->
				<img src="[[|list.src|]]" />
				<!--ELSE-->
				<img src="templates/admin/images/tree_files/[[|list.ext|]].png" />
				<!--/IF:image-->
				<div class="fm-name">[[|list.name|]]</div>
			</div>
		<!--/IF:file-->
	<!--/LIST:list-->
	</div>
</div>
<div class="fm-menu-command" id="fm-menu-command">
	<div id="delete">[[.delete.]]</div>
	<div id="rename">[[.rename.]]</div>
</div>
	<input type="hidden" readonly="true" style="width:70%" id="url" />
	<input type="hidden" value="[[|current|]]" name="currentFolder" id="currentFolder" />
	<input type="hidden" value="" name="selectedFolder" id="selectedFolder" />
	<input type="hidden" value="" name="type" id="type" />
	<input type="hidden" value="" name="cmd" id="cmd" />
	<input type="submit" style="display:none" />
</form>
<script>
jQuery(document).ready(function(){
	var FileBrowserDialogue = {
		init : function () {

		},
		mySubmit : function () {
			var URL = document.data.url.value;
			var win = tinyMCEPopup.getWindowArg("window");
			win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;	
			if (typeof(win.ImageDialog) != "undefined") {
				if (win.ImageDialog.getImageData)
					win.ImageDialog.getImageData();
				if (win.ImageDialog.showPreviewImage)
					win.ImageDialog.showPreviewImage(URL);
			}
			tinyMCEPopup.close();
		}
	}
	jQuery('#returnValue').click(function(){
		FileBrowserDialogue.mySubmit();
	});
	jQuery('.fm-folder *').click(function(){
		jQuery('#selectedFolder').val(jQuery(this).parent().attr('rel'));
		jQuery('#type').val('folder');
		if(jQuery(this).parent().hasClass('fm-folder-selected'))
		{
			jQuery(this).parent().removeClass('fm-folder-selected');
		}else
		{
			jQuery('.fm-folder').removeClass('fm-folder-selected');
			jQuery(this).parent().addClass('fm-folder-selected');
		}
	}).dblclick(function(){
		jQuery('#selectedFolder').val(jQuery(this).parent().attr('rel'));
		jQuery('#type').val('folder');
		jQuery('#cmd').val('view');
		Submit();
	}).bind("contextmenu", function(e){
		jQuery('#rename').show();
		jQuery('.fm-menu-command').css({
			'top':e.pageY,'left':e.pageX
		}).show().mouseout(function(){
			jQuery(this).hide();
		}).children().mouseover(function(){
			jQuery(this).parent().show();
		});		
		jQuery('#selectedFolder').val(jQuery(this).parent().attr('rel'));
		jQuery('#type').val('folder');
		return false;
	});
	jQuery('#back').click(function(){
		jQuery('#cmd').val('back');
		Submit();
	});
	jQuery('#delete').click(function(){
		jQuery('#cmd').val('delete');
		Submit();
	});
	jQuery('#rename').click(function(){
		jQuery('#cmd').val('rename');
		var input = '<input type="text" style="width:60px" name="new_name" id="new_name" value="'+jQuery('#selectedFolder').val()+'" />';
		jQuery('*[rel='+jQuery('#selectedFolder').val()+'] .fm-name').html(input);
		jQuery(this).parent().hide();
		jQuery('#new_name').focus().keyup(function(e){
			if(e.which==27)
			{
				jQuery('.fm-folder[rel='+jQuery('#selectedFolder').val()+'] .fm-folder-name').html(jQuery('#selectedFolder').val());
			}
		}).blur(function(){
			Submit();
		});
	});
	jQuery('#create_folder').toggle(
		function(){
			jQuery('.fm-create-folder').fadeIn('500');
			jQuery('#cmd').val(jQuery(this).attr('id'));
			jQuery('#folder_name').focus();
		},
		function()
		{
			jQuery('.fm-create-folder').fadeOut('500');
		}
	);
	jQuery('#upload-btn').click(function(){
		if(jQuery('#upload').val())
		{
			jQuery('#cmd').val('upload');
			Submit();
		}else
		{
			alert('Vui lòng chọn file');
		}
	});
	jQuery('.fm-file *').click(function(){
		jQuery('#url').val('http://<?php echo $_SERVER['SERVER_NAME']; ?>/'+jQuery(this).parent().attr('path'));
	}).bind("contextmenu", function(e){
		jQuery('#rename').hide();
		jQuery('.fm-menu-command').css({
			'top':e.pageY,'left':e.pageX
		}).show().mouseout(function(){
			jQuery(this).hide();
		}).children().mouseover(function(){
			jQuery(this).parent().show();
		});
		jQuery('#selectedFolder').val(jQuery(this).parent().attr('rel'));
		jQuery('#type').val('file');
		return false;
	}).dblclick(function(){
		FileBrowserDialogue.mySubmit();
	});
});
function Submit()
{
	jQuery('#data').submit();
}
</script>