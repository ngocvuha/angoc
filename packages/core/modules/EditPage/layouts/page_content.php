<script language="javascript">
packages = {
'':''
<!--LIST:packages-->
,[[|packages.id|]]:{
	'':''
	<!--LIST:packages.modules-->
	,[[|packages.modules.id|]]:'[[|packages.modules.name|]]'
	<!--/LIST:packages.modules-->
}
<!--/LIST:packages-->
};
function change_layout(id)
{
	window.location='{{URL::build_current(array('id'=>[[=id=]],'cmd'=>'change_layout'))}}&new_layout='+id;
}
function change_package(id)
{
	while ($('module_id').length> 0) {
		$('module_id').remove(0);
	}
	
	if(packages[id])
	{
		for(var i in packages[id])
		{
			$('module_id').add(new Option(packages[id][i],i));
		}
	}
}
function get_module_id(id){
	jQuery('#set_module_id').attr('module_id',id);
	var module_name=jQuery('#module_id option[value='+id+']').html();
	jQuery('#set_module_id').attr('module_name',module_name);
}
jQuery(function(){
	var module_id=0;
	var block_id=0;
	var region_current='';
	jQuery(".new-module").draggable({
		opacity: 0.7,
		helper: function( event ) {
			return jQuery("<div class='ui-widget-header'>"+jQuery(this).attr('module_name')+"</div>");
		},
		cursorAt: { top: 15, left: 20 },
		start: function() {
			module_id=jQuery(this).attr('module_id');
			block_id=jQuery(this).attr('block_id');
			region_current=jQuery(this).attr('region_current');
		}
	});
	jQuery(".item-region").droppable({
		drop: function( event, ui ) {
			var region = jQuery(this).attr('region');
			var container_id = 0;
			if(jQuery(this).attr('container_id')){
				var container_id = jQuery(this).attr('container_id');
			}
			if(region_current && region==region_current){
				return;
			}
			if(module_id>0){
				window.location = '{{Url::build_current(array("id"))}}&container_id='+container_id+'&region='+region+'&module_id='+module_id;
			}
			if(block_id>0){
				window.location = '{{Url::build_current(array("id","cmd"=>"move_block"))}}&container_id='+container_id+'&region='+region+'&block_id='+block_id;
			}
		}
	});
});
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr>
        <td align="left">
            <a href="{{URL::build([[=name=]])}}">[[|name|]]</a> - 
            <b>Layout:</b>
            <select name="layout" id="layout" onchange="change_layout(this.value);"></select>
            Package:
            <select name="package_id" id="package_id" onchange="change_package(this.value);"></select>
            &nbsp;
            <a id="set_module_id" class="new-module" module_id="0" module_name="" href="javascript:void(0);">Modules</a>
            : 
            <select name="module_id" id="module_id" onchange="get_module_id(this.value);"></select>
            <script language="javascript">
            change_package([[|package_id|]]);
            </script>
        </td>
	</tr>
    <tr>
    	<td><strong>Modules:</strong> <.$i=1;.>
        <!--LIST:new_modules-->
        {{$i!=1?'<span> - </span>':'&nbsp;'}}<a class="new-module{{$i%2!=0?' module-odd':''}}" module_id="[[|new_modules.id|]]" module_name="[[|new_modules.name|]]" href="javascript:void(0);">[[|new_modules.name|]]</a><.$i++;.>
        <!--/LIST:new_modules-->
        </td>
    </tr>
    <tr>
        <td align="center">[[|regions|]]</td>
    </tr>
    <tr>
    	<td><strong>Modules:</strong> <.$i=1;.>
        <!--LIST:new_modules-->
        {{$i!=1?'<span> - </span>':'&nbsp;'}}<a class="new-module{{$i%2!=0?' module-odd':''}}" module_id="[[|new_modules.id|]]" module_name="[[|new_modules.name|]]" href="javascript:void(0);">[[|new_modules.name|]]</a><.$i++;.>
        <!--/LIST:new_modules-->
        </td>
    </tr>
</table>
