<div class="middle" style="padding-bottom:50px;">
	<div class="content-header clrfix">
    	<div class="fl title">Bảng điểm</div>
        <div class="fr">
        <a target="_blank" href="<?php echo $this->map['path_xlsx'];?>" class="red-button">Danh sách thi (excel)</a>
		<a target="_blank" href="<?php echo $this->map['bangdiem_t10_xlsx'];?>" class="red-button">Bảng điểm (excel hệ số 10)</a>
		<a target="_blank" href="<?php echo $this->map['bangdiem_total_xlsx'];?>" class="red-button">Bảng điểm (excel tổng điểm)</a>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content"><?php $i=1?>
	<table width="100%" cellpadding="4" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
		<tr class="ht">
			<td nowrap>STT</td>
			<td nowrap width="100">Số báo danh</td>
			<td nowrap width="200" align="left">Họ tên</td>
			<td nowrap width="70" align="left">Ngày sinh</td>
			<td nowrap width="50" align="left">Giới tính</td>
			<td nowrap width="100" align="left">Lớp</td>
			<td nowrap width="100" align="left">Điểm</td>
			<td nowrap width="1%">Chữ ký</td>
		</tr><?php $show_mark=Portal::get_setting('show_mark');?>
		<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
		<tr>	
			<td nowrap width="1%" align="right"><?php echo $i++;?></td>
			<td nowrap width="100"><?php echo $this->map['items']['current']['SoBaoDanh'];?></td>
			<td nowrap width="200"><?php echo $this->map['items']['current']['HoDem'];?> <?php echo $this->map['items']['current']['Ten'];?></td>
			<td nowrap width="70" align="center"><?php echo Date_time::to_common_date(substr($this->map['items']['current']['NgaySinh'],0,10));?></td>
			<td nowrap width="50"><?php echo $this->map['items']['current']['GioiTinh']?'Nữ':'Nam';?></td>
			<td nowrap width="100"><?php echo $this->map['items']['current']['name'];?></td>
			<?php if(($show_mark)){?>
			<td nowrap width="100" align="right"><?php echo $this->map['items']['current']['TongDiemTraLoi'];?> / <?php echo $this->map['items']['current']['TongDiem'];?></td>
			 <?php }else{ ?>
			<td nowrap width="100" align="right"><?php echo $this->map['items']['current']['Diem'];?></td>
			<?php } ?>
			
			<td></td>
		</tr>
		<?php }}unset($this->map['items']['current']);} ?>
	</table>
    </div>
</div>