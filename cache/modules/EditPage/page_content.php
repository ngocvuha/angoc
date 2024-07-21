<script language="javascript">
packages = {
'':''
<?php if(isset($this->map['packages']) and is_array($this->map['packages'])){ foreach($this->map['packages'] as $key1=>&$item1){ if($key1!='current'){$this->map['packages']['current'] = &$item1;?>
,<?php echo $this->map['packages']['current']['id'];?>:{
	'':''
	<?php if(isset($this->map['packages']['current']['modules']) and is_array($this->map['packages']['current']['modules'])){ foreach($this->map['packages']['current']['modules'] as $key2=>&$item2){ if($key2!='current'){$this->map['packages']['current']['modules']['current'] = &$item2;?>
	,<?php echo $this->map['packages']['current']['modules']['current']['id'];?>:'<?php echo $this->map['packages']['current']['modules']['current']['name'];?>'
	<?php }}unset($this->map['packages']['current']['modules']['current']);} ?>
}
<?php }}unset($this->map['packages']['current']);} ?>
};
function change_layout(id)
{
	window.location='<?php echo URL::build_current(array('id'=>$this->map['id'],'cmd'=>'change_layout'));?>&new_layout='+id;
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
				window.location = '<?php echo Url::build_current(array("id"));?>&container_id='+container_id+'&region='+region+'&module_id='+module_id;
			}
			if(block_id>0){
				window.location = '<?php echo Url::build_current(array("id","cmd"=>"move_block"));?>&container_id='+container_id+'&region='+region+'&block_id='+block_id;
			}
		}
	});
});
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr>
        <td align="left">
            <a href="<?php echo URL::build($this->map['name']);?>"><?php echo $this->map['name'];?></a> - 
            <b>Layout:</b>
            <select  name="layout" id="layout" onchange="change_layout(this.value);"><?php
					if(isset($this->map['layout_list']))
					{
						foreach($this->map['layout_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('layout').value = "<?php echo addslashes(URL::get('layout',isset($this->map['layout'])?$this->map['layout']:''));?>";</script>
            Package:
            <select  name="package_id" id="package_id" onchange="change_package(this.value);"><?php
					if(isset($this->map['package_id_list']))
					{
						foreach($this->map['package_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('package_id').value = "<?php echo addslashes(URL::get('package_id',isset($this->map['package_id'])?$this->map['package_id']:''));?>";</script>
            &nbsp;
            <a id="set_module_id" class="new-module" module_id="0" module_name="" href="javascript:void(0);">Modules</a>
            : 
            <select  name="module_id" id="module_id" onchange="get_module_id(this.value);"><?php
					if(isset($this->map['module_id_list']))
					{
						foreach($this->map['module_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('module_id').value = "<?php echo addslashes(URL::get('module_id',isset($this->map['module_id'])?$this->map['module_id']:''));?>";</script>
            <script language="javascript">
            change_package(<?php echo $this->map['package_id'];?>);
            </script>
        </td>
	</tr>
    <tr>
    	<td><strong>Modules:</strong> <?php $i=1;?>
        <?php if(isset($this->map['new_modules']) and is_array($this->map['new_modules'])){ foreach($this->map['new_modules'] as $key3=>&$item3){ if($key3!='current'){$this->map['new_modules']['current'] = &$item3;?>
        <?php echo $i!=1?'<span> - </span>':'&nbsp;';?><a class="new-module<?php echo $i%2!=0?' module-odd':'';?>" module_id="<?php echo $this->map['new_modules']['current']['id'];?>" module_name="<?php echo $this->map['new_modules']['current']['name'];?>" href="javascript:void(0);"><?php echo $this->map['new_modules']['current']['name'];?></a><?php $i++;?>
        <?php }}unset($this->map['new_modules']['current']);} ?>
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo $this->map['regions'];?></td>
    </tr>
    <tr>
    	<td><strong>Modules:</strong> <?php $i=1;?>
        <?php if(isset($this->map['new_modules']) and is_array($this->map['new_modules'])){ foreach($this->map['new_modules'] as $key4=>&$item4){ if($key4!='current'){$this->map['new_modules']['current'] = &$item4;?>
        <?php echo $i!=1?'<span> - </span>':'&nbsp;';?><a class="new-module<?php echo $i%2!=0?' module-odd':'';?>" module_id="<?php echo $this->map['new_modules']['current']['id'];?>" module_name="<?php echo $this->map['new_modules']['current']['name'];?>" href="javascript:void(0);"><?php echo $this->map['new_modules']['current']['name'];?></a><?php $i++;?>
        <?php }}unset($this->map['new_modules']['current']);} ?>
        </td>
    </tr>
</table>
