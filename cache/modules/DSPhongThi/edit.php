<div class="middle" style="padding-bottom:50px;">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý Phòng thi<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
		<h2>Thông tin Phòng Thi</h2>
		<div class="tab-content">
			<table cellpadding="6" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
				<tr>
					<td class="ht"><label for="Ten">Phòng thi số</label></td>
					<td><?php echo $this->map['Ten'];?></td>
				</tr>
				<tr>
					<td class="ht"><label>Ngày - Giờ Thi</label></td>
					<td>Từ <?php echo $this->map['T_BatDau'];?> Đến <?php echo $this->map['T_KetThuc'];?></td>
				</tr>
				<tr>
					<td class="ht"><label for="IDCauTrucDeThi">Đề thi</label></td>
					<td><?php echo $this->map['DeThi'];?></td>
				</tr>
				<tr>
					<td class="ht"><label for="IDQuanLyThi">Giám thị</label></td>
					<td><?php echo $this->map['GiamThi'];?></td>
				</tr>
				<tr>
					<td class="ht"><label for="NgayThi">Ghi chú</label></td>
					<td><?php echo $this->map['GhiChu'];?></td>
				</tr>
				<tr>
					<td class="ht" width="1%" nowrap><label for="NgayThi">Tổng số bài thi đã nộp</label></td>
					<td><span id="Tong"><?php echo isset($this->map['items'])?count($this->map['items']):'';?></span></td>
				</tr>
			</table>
		</div>
		<div id="tabs-options">
			<center><h3>DANH SÁCH BÀI THI</h3></center>
			<table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">					
				<tr class="ht">
					<td>Mã Dự thi</td>
					<td>Họ và Tên</td>
					<td>Điểm</td>
					<td width="1%" nowrap>Xem bài thi</td>
				</tr>
				<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
				<tr>
					<td><?php echo $this->map['items']['current']['MaSV'];?></td>
					<td><?php echo $this->map['items']['current']['HoDem'];?> <?php echo $this->map['items']['current']['Ten'];?></td>
					<td align="right"><?php echo $this->map['items']['current']['Diem'];?></td>
					<td><a target="_blank" href="<?php echo Url::build('phuc-tra-bai-thi',array('id'=>$this->map['items']['current']['BaiThi']));?>"><img width="16px" src="templates/admin/images/buttons/search.gif"></a></td>
				</tr>
				<?php }}unset($this->map['items']['current']);} ?>
			</table>					
		</div>
    </div>
</div>