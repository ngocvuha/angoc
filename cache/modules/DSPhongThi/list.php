<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">
        	Chọn Phòng Thi
        </div>
    </div>
	<div class="form-content">
        <form name="DSPhongThi" id="DSPhongThi" method="post">
        <div class="clrfix pad-B5">
            <?php if(($this->map['paging'])){?><div class="fl"><?php echo $this->map['paging'];?></div><div class="fl pad-T5">&nbsp;- Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div><?php } ?>
            <div class="fr"><label for="item_per_page">items/page</label><input  name="item_per_page" id="item_per_page" size="10" / type ="text" value="<?php echo String::html_normalize(URL::get('item_per_page'));?>"><button id="search" class="blue-button">Tìm kiếm</button></div>
        </div>
        <table width="100%" cellpadding="6" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
            <tr class="ht">
                <td nowrap align="left"><a href="<?php echo String::order_by('tblphongthi.Ten');?>" class="orderby<?php echo String::order_by_active('tblphongthi.Ten');?>" title="<?php echo Portal::language('sort');?>">Tên</a></td>
                <td nowrap width="250"><a href="<?php echo String::order_by('tblphongthi.T_BatDau');?>" class="orderby<?php echo String::order_by_active('tblphongthi.T_BatDau');?>" title="<?php echo Portal::language('sort');?>">Thời gian Thi</a></td>
                <td nowrap width="200" align="left"><a href="<?php echo String::order_by('tblphongthi.IDCauTrucDeThi');?>" class="orderby<?php echo String::order_by_active('tblphongthi.IDCauTrucDeThi');?>" title="<?php echo Portal::language('sort');?>">Cấu trúc đề thi</a></td>
                <td nowrap width="100" align="left">Giám Thị</td>
				<td nowrap width="100" align="left">Trạng Thái</td>
				<td nowrap width="100" align="left">Tổng số thí sinh</td>
				<td nowrap width="100" align="left">Số Đã thi</td>
                <?php if((User::can_edit())){?>
                <td nowrap width="1%">Chi tiết</td>
                <?php } ?>
            </tr>
            <tr class="ht">
                <td><input  name="search_name" id="search_name" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_name'));?>"><script type="text/javascript">$('search_name').focus();</script></td>
                <td>                	
                </td>
				<td><input  name="search_time_f" id="search_time_f" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_time_f'));?>">
                    <input  name="search_time_t" id="search_time_t" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_time_t'));?>"></td>
                <td><input  name="search_GiamThi" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('search_GiamThi'));?>"></td>
				<td><select  name="search_status" id="search_status" type="text" class="search-field"><?php
					if(isset($this->map['search_status_list']))
					{
						foreach($this->map['search_status_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('search_status').value = "<?php echo addslashes(URL::get('search_status',isset($this->map['search_status'])?$this->map['search_status']:''));?>";</script></td>
                <td colspan="2"></td>
                <td></td>
            </tr><?php $index=$this->map['index']?>
            <?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
            <tr valign="middle" <?php Draw::hover('#E2F1DF');?> style="<?php if($index++%2){echo 'background-color:#F9F9F9';}?>" id="DSPhongThi_tr_<?php echo $this->map['items']['current']['id'];?>">
                <td>
                    <label for="DSPhongThi_checkbox_<?php echo $this->map['items']['current']['id'];?>"><?php echo $this->map['items']['current']['Ten'];?></label>
                </td>                
                <td><?php echo date('d/m/Y H:i',$this->map['items']['current']['T_BatDau']).'h - '.date('d/m/Y H:i',$this->map['items']['current']['T_KetThuc']).'h';?></td>
				<td><?php echo $this->map['items']['current']['IDCauTrucDeThi'];?></td>
                <td><?php echo $this->map['items']['current']['HoDem'];?> <?php echo $this->map['items']['current']['GiamThi'];?></td>
				<td nowrap><?php echo $this->map['status'][$this->map['items']['current']['TrangThai']];?></td>
				<td nowrap align="right"><?php echo $this->map['items']['current']['TongSoThiSinh'];?></td>
				<td nowrap align="right"><?php echo $this->map['items']['current']['DaThi'];?></td>
                <td align="center"><a href="<?php echo Url::build_current(array('id'=>$this->map['items']['current']['id'],'cmd'=>'view'));?>"><img width="16px" src="templates/admin/images/buttons/search.gif"></a></td>
            </tr>
            <?php }}unset($this->map['items']['current']);} ?>
        </table>
        <input type="hidden" name="cmd" id="cmd" value="" />
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
        <?php if(($this->map['paging'])){?>
        <div class="clrfix pad-B5">
            <div class="fl"><?php echo $this->map['paging'];?></div><div class="fl pad-T5">&nbsp;- Tổng: <strong><?php echo $this->map['total'];?></strong> bản ghi</div>
        </div>
        <?php } ?>
        <div class="clrfix">
            <div class="fl">
                Lựa chọn:&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.DSPhongThi,'DSPhongThi',true,'#FFFFEC','white');">Tất cả</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.DSPhongThi,'DSPhongThi',false,'#FFFFEC','white');">Bỏ chọn</a>&nbsp;
                <a href="javascript:void(0)" onclick="select_all_checkbox(document.DSPhongThi,'DSPhongThi',-1,'#FFFFEC','white');">Ngược lại</a>
            </div>
            <div class="fr"><a onclick="window.scrollTo(0,0);" href="javascript:void(0)"><img src="templates/admin/images/buttons/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a></div>
        </div>
    </div>
</div>
<script type="text/javascript">
jQuery(function() {
	jQuery("#search_time_f").datepicker({ dateFormat: "dd/mm/yy" });
	jQuery("#search_time_t").datepicker({ dateFormat: "dd/mm/yy" });
});
</script>