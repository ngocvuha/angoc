<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name');?></div>
    </div>
	<div class="form-content">
        <div class="helper-bound">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="18%" class="pad-R5">
                <ul class="helper-menu"><?php $i=1;?>
                    <?php if(isset($this->map['menu']) and is_array($this->map['menu'])){ foreach($this->map['menu'] as $key1=>&$item1){ if($key1!='current'){$this->map['menu']['current'] = &$item1;?>
                    <?php $class=Helper::check_class($this->map['menu']['current']['childs'],$this->map['total'],$i); $i++;?>
                    <li class="<?php echo $class;?>"<?php echo ($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.$this->map['menu']['current']['id'].')"':'';?>>
                        <div id="helper-<?php echo $this->map['menu']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['name'];?></div>
                        <?php if(($this->map['menu']['current']['childs'])){?>
                        <ul><?php $total1=sizeof($this->map['menu']['current']['childs']); $j=1;?>
                            <?php if(isset($this->map['menu']['current']['childs']) and is_array($this->map['menu']['current']['childs'])){ foreach($this->map['menu']['current']['childs'] as $key2=>&$item2){ if($key2!='current'){$this->map['menu']['current']['childs']['current'] = &$item2;?>
                            <?php $class=Helper::check_class($this->map['menu']['current']['childs']['current']['childs'],$total1,$j); $j++;?>
                            <li class="<?php echo $class;?>"<?php echo ($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.$this->map['menu']['current']['childs']['current']['id'].')"':'';?>>
                                <div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['name'];?></div>
                                <?php if(($this->map['menu']['current']['childs']['current']['childs'])){?>
                                <ul><?php $total2=sizeof($this->map['menu']['current']['childs']['current']['childs']); $k=1;?>
                                    <?php if(isset($this->map['menu']['current']['childs']['current']['childs']) and is_array($this->map['menu']['current']['childs']['current']['childs'])){ foreach($this->map['menu']['current']['childs']['current']['childs'] as $key3=>&$item3){ if($key3!='current'){$this->map['menu']['current']['childs']['current']['childs']['current'] = &$item3;?>
                                    <?php $class=Helper::check_class($this->map['menu']['current']['childs']['current']['childs']['current']['childs'],$total2,$k); $k++;?>
                                    <li class="<?php echo $class;?>"<?php echo ($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.$this->map['menu']['current']['childs']['current']['childs']['current']['id'].')"':'';?>>
                                        <div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['name'];?></div>
                                        <?php if(($this->map['menu']['current']['childs']['current']['childs']['current']['childs'])){?>
                                        <ul><?php $total3=sizeof($this->map['menu']['current']['childs']['current']['childs']['current']['childs']); $n=1;?>
                                            <?php if(isset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['menu']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['menu']['current']['childs']['current']['childs']['current']['childs'] as $key4=>&$item4){ if($key4!='current'){$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item4;?>
                                            <?php $class=Helper::check_class($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs'],$total3,$n); $n++;?>
                                            <li class="<?php echo $class;?>"<?php echo ($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['id'].')"':'';?>>
                                                <div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?></div>
                                                <?php if(($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){?>
                                                <ul><?php $total4=sizeof($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']); $q=1;?>
                                                    <?php if(isset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs'] as $key5=>&$item5){ if($key5!='current'){$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item5;?>
                                                    <?php $class=Helper::check_class($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'],$total4,$q); $q++;?>
                                                    <li class="<?php echo $class;?>"<?php echo ($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['id'].')"':'';?>>
                                                        <div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?></div>
                                                        
                                                    </li>
                                                    <?php }}unset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
                                                </ul>
                                                <?php } ?>
                                            </li>
                                            <?php }}unset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
                                        </ul>
                                        <?php } ?>
                                    </li>
                                    <?php }}unset($this->map['menu']['current']['childs']['current']['childs']['current']);} ?>
                                </ul>
                                <?php } ?>
                            </li>
                            <?php }}unset($this->map['menu']['current']['childs']['current']);} ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php }}unset($this->map['menu']['current']);} ?>
                </ul>
                </td>
                <td width="82%"><div id="helper-content"></div></td>
            </tr>
        </table>
        </div>
</div></div>
<script type="text/javascript">
jQuery(function(){
	jQuery('.havechild-close > div').click(function(){
		jQuery(this).next().toggle();
		if(jQuery(this).parent().hasClass('havechild-open')){
			jQuery(this).parent().removeClass('havechild-open');
		}else{
			jQuery(this).parent().addClass('havechild-open');
		}
		if(jQuery(this).hasClass('open')){
			jQuery(this).removeClass('open');
		}else{
			jQuery(this).addClass('open');
		}
	});
	jQuery('.isfile div').click(function(){
		jQuery('.isfile div').removeClass('active');
		jQuery(this).addClass('active');
	});
	
});
function get_helper(id){
	jQuery.ajax({
		method: "POST",url: 'form.php?block_id=<?php echo Module::block_id();?>',
		data : {
			'cmd':'get_content',
			'id':id
		},
		beforeSend: function(){
			jQuery('#helper-content').html('<img src="<?php echo Portal::template()."images/icon/lightbox-ico-loading.gif";?>" />');
		},
		success: function(content){
			jQuery('#helper-content').html(content);
		}
	});
}
</script>