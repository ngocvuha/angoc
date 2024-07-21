<div class="header"><img src="<?php echo Portal::get_setting('logo');?>" /></div>
<div class="menutop-bound">
	<ul class="clrfix">
    	<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
        <li>
        	<a href="<?php echo $this->map['items']['current']['url'];?>" class="<?php echo $this->map['items']['current']['childs']?'have-child':'';?><?php echo $this->map['items']['current']['structure_id']==Url::get('active_structure_id')?' active':'';?>"><?php echo $this->map['items']['current']['name'];?></a>
            <?php if(($this->map['items']['current']['childs'])){?>
            <ul>
	            <?php if(isset($this->map['items']['current']['childs']) and is_array($this->map['items']['current']['childs'])){ foreach($this->map['items']['current']['childs'] as $key2=>&$item2){ if($key2!='current'){$this->map['items']['current']['childs']['current'] = &$item2;?>
            	<li>
                	<a href="<?php echo $this->map['items']['current']['childs']['current']['url'];?>"<?php echo $this->map['items']['current']['childs']['current']['childs']?' class="have-child"':'';?>><?php echo $this->map['items']['current']['childs']['current']['name'];?></a>
                    <?php if(($this->map['items']['current']['childs']['current']['childs'])){?>
                    <ul>
                        <?php if(isset($this->map['items']['current']['childs']['current']['childs']) and is_array($this->map['items']['current']['childs']['current']['childs'])){ foreach($this->map['items']['current']['childs']['current']['childs'] as $key3=>&$item3){ if($key3!='current'){$this->map['items']['current']['childs']['current']['childs']['current'] = &$item3;?>
                        <li>
                            <a href="<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['url'];?>"<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']?' class="have-child"':'';?>><?php echo $this->map['items']['current']['childs']['current']['childs']['current']['name'];?></a>
                            <?php if(($this->map['items']['current']['childs']['current']['childs']['current']['childs'])){?>
                            <ul>
                                <?php if(isset($this->map['items']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['items']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['items']['current']['childs']['current']['childs']['current']['childs'] as $key4=>&$item4){ if($key4!='current'){$this->map['items']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item4;?>
                                <li>
                                    <a href="<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['url'];?>"<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']?' class="have-child"':'';?>><?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?></a>
                                    <?php if(($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){?>
                                    <ul>
                                        <?php if(isset($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs'] as $key5=>&$item5){ if($key5!='current'){$this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item5;?>
                                        <li>
                                            <a href="<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['url'];?>"<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']?' class="have-child"':'';?>><?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?></a>
                                            <?php if(($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){?>
                                            <ul>
                                                <?php if(isset($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'] as $key6=>&$item6){ if($key6!='current'){$this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item6;?>
                                                <li>
                                                    <a href="<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['url'];?>"<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']?' class="have-child"':'';?>><?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?></a>
                                                    <?php if(($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){?>
                                                    <ul>
                                                        <?php if(isset($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'] as $key7=>&$item7){ if($key7!='current'){$this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item7;?>
                                                        <li>
                                                        	<a href="<?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['url'];?>"><?php echo $this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?></a>
                                                        </li>
                                                        <?php }}unset($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
                                                    </ul>
                                                    <?php } ?>
                                                </li>
                                                <?php }}unset($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
                                            </ul>
                                            <?php } ?>
                                        </li>
                                        <?php }}unset($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
                                    </ul>
                                    <?php } ?>
                                </li>
                                <?php }}unset($this->map['items']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
                            </ul>
                            <?php } ?>
                        </li>
                        <?php }}unset($this->map['items']['current']['childs']['current']['childs']['current']);} ?>
                    </ul>
                    <?php } ?>
                </li>
    	        <?php }}unset($this->map['items']['current']['childs']['current']);} ?>
            </ul>
            <?php } ?>
        </li>
    	<?php }}unset($this->map['items']['current']);} ?>
    	<li class="menutop-link-extra">
            <span>Xin chào : </span><b><?php echo User::id();?></b><span> | </span>
            <a style="color:#000;" href="<?php echo Url::build('change_password');?>">Đổi mật khẩu</a><span>|</span>
            <a style="color:#000;" href="<?php echo Url::build('helper');?>">Trợ giúp</a><span>|</span>
            <a style="color:#000;" href="<?php echo Url::build('sign_out');?>">Thoát</a>
        </li>
    </ul>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery('.menutop-bound li').hover(
		function(){
			jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show();
		},function(){
			jQuery(this).find('ul:first').css({visibility: "hidden"});
		}
	);
	jQuery('a.have-child').attr('href','javascript:void(0)');
});
</script>