<div style="background-color:#fff;" class="item-region" region="<?php echo $this->map['name'];?>">
	<div style="text-transform:uppercase;text-align:left;">&nbsp;&nbsp;::&nbsp;&nbsp;&nbsp;<b><?php echo $this->map['name'];?></b>&nbsp;&nbsp;&nbsp;&nbsp;::</div>
	<div style="border:1px solid #ccc; padding:5px;">
        <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
        <div class="module-item">
        	<div align="center">
                <a href="<?php echo $this->map['items']['current']['href'];?>" class="new-module" block_id="<?php echo $this->map['items']['current']['id'];?>" module_name="<?php echo $this->map['items']['current']['name'];?>" region_current="<?php echo $this->map['items']['current']['region'];?>">
                <?php if(($this->map['items']['current']['image_url'] and file_exists($this->map['items']['current']['image_url']))){?>
                <img src="<?php echo $this->map['items']['current']['image_url'];?>" style="max-width:100%;" />
                 <?php }else{ ?>
                <div align="left"><strong><?php echo $this->map['items']['current']['name'];?></strong></div>
                <?php } ?>
                </a>
            </div>
            <div class="controls clrfix">
                <a style="float:left; padding-right:10px;" href="<?php echo URL::build_current(array('cmd'=>'delete','id'=>$this->map['items']['current']['id']));?>"><strong><img src="templates/admin/images/buttons/delete.gif" width="12" border="0" title="Xóa" alt="Xóa" ></strong></a>
                <a style="float:left; padding-right:10px;" href="<?php echo URL::build('package_word',array('module_id'=>$this->map['items']['current']['module_id']));?>" target="_blank"><strong><img src="templates/admin/images/buttons/language.jpg" width="17" border="0" title="Ngôn ngữ" alt="Ngôn ngữ" ></strong></a>
                <div style="float:left; width:30px; text-align:left;">
                    <strong><?php echo $this->map['items']['current']['move_up'];?></strong>
                    <strong><?php echo $this->map['items']['current']['move_down'];?></strong>
                </div>
            </div>
        </div>
        <?php if(($this->map['items']['current']['regions'])){?>
        <div><?php echo $this->map['items']['current']['regions'];?></div>
        <?php } ?>
        <?php }}unset($this->map['items']['current']);} ?>
        <div align="left" style="padding:5px;">[ <a href="<?php echo Url::build('module',array('page_id'=>$_REQUEST['id'],'region'=>$this->map['name'],'container_id'));?>"><img src="templates/admin/images/buttons/add.jpg" title="Thêm module" alt="Thêm module" /></a> ]</div>
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