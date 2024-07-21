<div style="background-color:#fff;" class="item-region" region="[[|name|]]">
	<div style="text-transform:uppercase;text-align:left;">&nbsp;&nbsp;::&nbsp;&nbsp;&nbsp;<b>[[|name|]]</b>&nbsp;&nbsp;&nbsp;&nbsp;::</div>
	<div style="border:1px solid #ccc; padding:5px;">
        <!--LIST:items-->
        <div class="module-item">
        	<div align="center">
                <a href="[[|items.href|]]" class="new-module" block_id="[[|items.id|]]" module_name="[[|items.name|]]" region_current="[[|items.region|]]">
                <!--IF:name([[=items.image_url=]] and file_exists([[=items.image_url=]]))-->
                <img src="[[|items.image_url|]]" style="max-width:100%;" />
                <!--ELSE-->
                <div align="left"><strong>[[|items.name|]]</strong></div>
                <!--/IF:name-->
                </a>
            </div>
            <div class="controls clrfix">
                <a style="float:left; padding-right:10px;" href="{{URL::build_current(array('cmd'=>'delete','id'=>[[=items.id=]]))}}"><strong><img src="templates/admin/images/buttons/delete.gif" width="12" border="0" title="Xóa" alt="Xóa" ></strong></a>
                <a style="float:left; padding-right:10px;" href="{{URL::build('package_word',array('module_id'=>[[=items.module_id=]]))}}" target="_blank"><strong><img src="templates/admin/images/buttons/language.jpg" width="17" border="0" title="Ngôn ngữ" alt="Ngôn ngữ" ></strong></a>
                <div style="float:left; width:30px; text-align:left;">
                    <strong>[[|items.move_up|]]</strong>
                    <strong>[[|items.move_down|]]</strong>
                </div>
            </div>
        </div>
        <!--IF:regions([[=items.regions=]])-->
        <div>[[|items.regions|]]</div>
        <!--/IF:regions-->
        <!--/LIST:items-->
        <div align="left" style="padding:5px;">[ <a href="{{Url::build('module',array('page_id'=>$_REQUEST['id'],'region'=>[[=name=]],'container_id'))}}"><img src="templates/admin/images/buttons/add.jpg" title="Thêm module" alt="Thêm module" /></a> ]</div>
     </div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery('.module-item').hover(
		function(){
			jQuery(this).children('.controls').show();
		},
		function(){
			jQuery(this).children('.controls').hide();
		}
	);
});
</script>