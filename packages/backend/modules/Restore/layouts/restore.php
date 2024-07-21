<script>
	function check_selected()
	{
		var status = false;
		jQuery('form :radio').each(function(e){
			if(this.checked)
			{
				status = true;
			}
		});	
		return status;
	}
	function make_cmd(cmd)
	{
		jQuery('#cmd').val(cmd);
		document.TableRestore.submit();
	}
</script>
<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button type="button" class="red-button" onclick="if(check_selected()){make_cmd('restore')}else{alert('Hãy chọn file backup');}">Restore</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
    <form name="TableRestore" method="post">
    <table cellpadding="6" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7">
        <tr class="ht">
            <th width="3%" align="center"></th>
            <th width="26%" align="left">[[.name.]]</th>
            <th align="left" nowrap >[[.file_size.]]</th>
            <th width="1%" nowrap="nowrap">Xóa</th>
          </tr>
          <?php $i=0; ?>
            <?php foreach([[=items=]] as $value){?>
              <?php $i++;?>
            <tr valign="middle">
                <td align="center"><input  name="selected_id" type="radio" value="<?php echo $value;?>" /></td>
                <td><a href="<?php echo [[=path=]].'/'.$value;?>" style="font-weight:bold"><?php echo $value;?></a></td>
                <td align="left" nowrap><?php echo File::getfilesize(filesize([[=path=]].'/'.$value));?></td>
                <td align="center"><a href="<?php echo Url::build_current(array('cmd'=>'delete','id'=>[[=path=]].'/'.$value));?>" onclick="if(!confirm('Bạn muốn xóa bản backup này?')) return false;">Xóa</a></td>
          </tr>
          <?php }?>			
    </table>
    <input name="cmd" type="hidden" id="cmd" value="restore" />
    </form>	
</div></div>
