<div class="">
	<table class="table table-responsive table-bordered">
	<thead><tr class="active">
		<th>Phòng thi</th>
		<th>Ngày Thi</th>
		<th>Điểm</th>
		<th>Điểm (quy đổi hệ số 10)</th>
	</tr></thead>
	<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
	<tr>
		<td><?php echo $this->map['items']['current']['Ten'];?></td>
		<td><?php echo date('d/m/Y',$this->map['items']['current']['T_KetThuc']);?></td>
		<td><?php echo $this->map['items']['current']['TongDiemTraLoi'];?> / <?php echo $this->map['items']['current']['TongDiem'];?></td>
		<td align="right"><?php echo $this->map['items']['current']['Diem'];?></td>
	</tr>
	<?php }}unset($this->map['items']['current']);} ?>
	</table>
</div>