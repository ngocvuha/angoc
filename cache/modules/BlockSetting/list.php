<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Setting của module <span style="text-transform:uppercase; font-size:16px;"><?php echo $this->map['name'];?></span> - Vùng <span style="text-transform:uppercase; font-size:16px;"><?php echo $this->map['region'];?></span> của trang <span style="text-transform:uppercase; font-size:16px;"><?php echo $this->map['page_name'];?></span></div>
        <div class="fr">
        <?php if((User::can_add())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
    <form id="ListBlockSettingForm" name="ListBlockSettingForm" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <td width="1%" nowrap="nowrap" class="pad-R10"><label><strong>Tên: </strong></label><input  name="name" id="name" autofocus / type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>"></td>
                <?php if((sizeof($this->map['copy_setting_id_list'])>1)){?>
                <td><label><strong>Copy: </strong></label><select  name="copy_setting_id" id="copy_setting_id"><?php
					if(isset($this->map['copy_setting_id_list']))
					{
						foreach($this->map['copy_setting_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('copy_setting_id').value = "<?php echo addslashes(URL::get('copy_setting_id',isset($this->map['copy_setting_id'])?$this->map['copy_setting_id']:''));?>";</script>&nbsp;<button onclick="make_cmd('copy_setting');" class="blue-button">Copy</button></td>
                <?php } ?>
                <td align="right"><a target="_blank" href="<?php echo URL::build('module_setting',array('module_id'=>$this->map['module_id']));?>"><?php echo Portal::language('module_setting');?></a></td>
            </tr>
        </table>
        <div id="tabs">
            <ul>
            <?php if(isset($this->map['groups']) and is_array($this->map['groups'])){ foreach($this->map['groups'] as $key1=>&$item1){ if($key1!='current'){$this->map['groups']['current'] = &$item1;?>
                <li><a href="#tabs-<?php echo $this->map['groups']['current']['code'];?>"><?php echo $this->map['groups']['current']['name'];?></a></li>
            <?php }}unset($this->map['groups']['current']);} ?>
            </ul>
            <?php if(isset($this->map['groups']) and is_array($this->map['groups'])){ foreach($this->map['groups'] as $key2=>&$item2){ if($key2!='current'){$this->map['groups']['current'] = &$item2;?>
            <div id="tabs-<?php echo $this->map['groups']['current']['code'];?>">
				<?php $first = true;?>
                <table cellpadding="5" cellspacing="0" width="100%">
                    <tr valign="top"><td>
                    <?php if(isset($this->map['groups']['current']['items']) and is_array($this->map['groups']['current']['items'])){ foreach($this->map['groups']['current']['items'] as $key3=>&$item3){ if($key3!='current'){$this->map['groups']['current']['items']['current'] = &$item3;?>
                    <?php if($this->map['groups']['current']['items']['current']['group_column'] != 1){
                        echo '</td><td>';
                    }else
                    if(!$first){
                        echo '</td></tr></table>';
                        echo '<table cellpadding="5" cellspacing="0" width="100%">
                            <tr valign="top"><td>';
                    }else{
                        $first = false;
                    }
                    ?>
                    <p>
                    <?php if(($this->map['groups']['current']['items']['current']['style']==1)){?>
                    <div style="display:inline;width:250px;" title="<?php echo $this->map['groups']['current']['items']['current']['id'];?>">
                            <strong><?php echo $this->map['groups']['current']['items']['current']['name'];?></strong>
                    </div>
                     <?php }else{ ?>
                        <span style="font-weight:bold;font-size:14px" title="<?php echo $this->map['groups']['current']['items']['current']['id'];?>"><?php echo $this->map['groups']['current']['items']['current']['name'];?></span><br />
                        <?php if(($this->map['groups']['current']['items']['current']['description']!="")){?>
                        <p><?php echo $this->map['groups']['current']['items']['current']['description'];?></p>
                        <?php } ?>
                    <?php } ?>
                    <?php echo $this->map['groups']['current']['items']['current']['value'];?>
                    <?php if(($this->map['groups']['current']['items']['current']['style']==1)){?>
                        <?php if(($this->map['groups']['current']['items']['current']['description']!="")){?>
                        <p><?php echo $this->map['groups']['current']['items']['current']['description'];?></p>
                        <?php } ?>
                    <?php } ?>
                    </p>
                    <?php }}unset($this->map['groups']['current']['items']['current']);} ?>
                    </td></tr>
                </table>
            </div>
            <?php }}unset($this->map['groups']['current']);} ?>
        </div>
        <input type="hidden" value="" name="cmd" id="cmd" />
        <input type="hidden" value="1" name="confirm" />
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	</div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery("#tabs").tabs();
});
</script>