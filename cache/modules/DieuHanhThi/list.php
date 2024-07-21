<div id="dieuhanhthi" class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">ĐIỀU HÀNH THI</div>
    </div>
	<div class="dth-left">
		<h3>Chọn Phòng Thi</h3>
		<ul><?php if(isset($this->map['phongthi']) and is_array($this->map['phongthi'])){ foreach($this->map['phongthi'] as $key1=>&$item1){ if($key1!='current'){$this->map['phongthi']['current'] = &$item1;?><li><a href="<?php echo Url::build_current(array('PhongThi'=>$this->map['phongthi']['current']['id']));?>"><?php echo $this->map['phongthi']['current']['Ten'];?></a></li><?php }}unset($this->map['phongthi']['current']);} ?></ul>
	</div>
	<div class="dth-right">		
		<form name="DieuHanhThi" method="post">
		<div class="clrfix">
			<div class="fl"><h3>Phòng thi: <?php echo $this->map['TenPhongThi'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button>Cập nhật</button></h3></div>
			<div class="fr">Tự động refresh (Min:20): <input onchange="SaveTimeOut(this.value)" style="width:30px; text-align:center" id="timeout"></div>
		</div>		
		<div class="clrfix">			
			<div class="column column-3">
				<h4>Danh sách chưa thi (<?php echo $this->map['ChuaThi_C'];?>)</h4>				
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="84">SBD</th>
						<th width="176">Họ và Tên</th>
						<th width="69">Ngày sinh</th>
					</tr></thead><tbody>
					<?php if((isset($this->map['ChuaThi']))){?><?php if(isset($this->map['ChuaThi']) and is_array($this->map['ChuaThi'])){ foreach($this->map['ChuaThi'] as $key2=>&$item2){ if($key2!='current'){$this->map['ChuaThi']['current'] = &$item2;?>
					<tr>
						<td width="84"><?php echo $this->map['ChuaThi']['current']['SoBaoDanh'];?></td>
						<td width="176"><?php echo $this->map['ChuaThi']['current']['HoDem'];?> <?php echo $this->map['ChuaThi']['current']['Ten'];?></td>
						<td width="69"><?php echo $this->map['ChuaThi']['current']['NgaySinh'];?></td>
					</tr>
					<?php }}unset($this->map['ChuaThi']['current']);} ?><?php } ?></tbody>
				</table>				
			</div>
			<div class="column column-3">
				<h4>Danh sách chờ thi  (<?php echo $this->map['ChoThi_C'];?>)</h4>
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="23"></th>
						<th width="84">SBD</th>
						<th width="177">Họ và Tên</th>
						<th width="69">Ngày sinh</th>
					</tr></thead><tbody>
					<?php if((isset($this->map['ChoThi']))){?><?php if(isset($this->map['ChoThi']) and is_array($this->map['ChoThi'])){ foreach($this->map['ChoThi'] as $key3=>&$item3){ if($key3!='current'){$this->map['ChoThi']['current'] = &$item3;?>
					<tr>
						<td width="22"><input name="ChoThi[<?php echo $this->map['ChoThi']['current']['id'];?>]" value="1" type="checkbox"></td>
						<td width="84"><?php echo $this->map['ChoThi']['current']['SoBaoDanh'];?></td>
						<td width="177"><?php echo $this->map['ChoThi']['current']['HoDem'];?> <?php echo $this->map['ChoThi']['current']['Ten'];?></td>
						<td width="69"><?php echo $this->map['ChoThi']['current']['NgaySinh'];?></td>
					</tr>
					<?php }}unset($this->map['ChoThi']['current']);} ?><?php } ?></tbody>
				</table>
			</div>
			<div class="column column-3">
				<h4>Danh sách được thi (<?php echo $this->map['DuocThi_C'];?>)</h4>
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="23"></th>
						<th width="84">SBD</th>
						<th width="181">Họ và Tên</th>
						<th width="69">Ngày sinh</th>
					</tr></thead><tbody>
					<?php if((isset($this->map['DuocThi']))){?><?php if(isset($this->map['DuocThi']) and is_array($this->map['DuocThi'])){ foreach($this->map['DuocThi'] as $key4=>&$item4){ if($key4!='current'){$this->map['DuocThi']['current'] = &$item4;?>
					<tr>
						<td width="22"><input name="DuocThi[<?php echo $this->map['DuocThi']['current']['id'];?>]" value="1" type="checkbox"></td>
						<td width="84"><?php echo $this->map['DuocThi']['current']['SoBaoDanh'];?></td>
						<td width="181"><?php echo $this->map['DuocThi']['current']['HoDem'];?> <?php echo $this->map['DuocThi']['current']['Ten'];?></td>
						<td width="69"><?php echo $this->map['DuocThi']['current']['NgaySinh'];?></td>
					</tr>
					<?php }}unset($this->map['DuocThi']['current']);} ?><?php } ?></tbody>
				</table>
			</div>
		</div>
		<br>
		<div class="clrfix">
			<div class="column column-2">
				<h4>Danh sách đang thi (<?php echo $this->map['DangThi_C'];?>)</h4>
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="22"></th>
						<th width="84">SBD</th>
						<th width="179">Họ và Tên</th>
						<th width="69">Ngày sinh</th>
						<th width="69">Bắt đầu</th>
						<th width="69">Còn</th>
					</tr></thead><tbody>
					<?php if((isset($this->map['DangThi']))){?><?php if(isset($this->map['DangThi']) and is_array($this->map['DangThi'])){ foreach($this->map['DangThi'] as $key5=>&$item5){ if($key5!='current'){$this->map['DangThi']['current'] = &$item5;?>
					<tr>
						<td width="22"><input name="DangThi[<?php echo $this->map['DangThi']['current']['id'];?>]" value="1" type="checkbox"></td>
						<td width="84"><?php echo $this->map['DangThi']['current']['SoBaoDanh'];?></td>
						<td width="180"><?php echo $this->map['DangThi']['current']['HoDem'];?> <?php echo $this->map['DangThi']['current']['Ten'];?></td>
						<td width="69"><?php echo $this->map['DangThi']['current']['NgaySinh'];?></td>
						<td width="69"><?php echo date('H:i:s',$this->map['DangThi']['current']['T_BatDau']);?></td>
						<td width="69"><?php echo Date_time::remain($this->map['DangThi']['current']['T_KetThuc']-time());?></td>
					</tr>
					<?php }}unset($this->map['DangThi']['current']);} ?><?php } ?></tbody>
				</table>
			</div>
			<div class="column column-2">
				<h4>Danh sách đã thi (<?php echo $this->map['DaThi_C'];?>)</h4>
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="84">SBD</th>
						<th width="200">Họ và Tên</th>
						<th width="75">Ngày sinh</th>
						<th width="70">Bắt đầu</th>
						<th width="70">Kết thúc</th>
						<th width="40">Điểm</th>
					</tr></thead><tbody>
					<?php if((isset($this->map['DaThi']))){?><?php if(isset($this->map['DaThi']) and is_array($this->map['DaThi'])){ foreach($this->map['DaThi'] as $key6=>&$item6){ if($key6!='current'){$this->map['DaThi']['current'] = &$item6;?>
					<tr>
						<td width="84"><?php echo $this->map['DaThi']['current']['SoBaoDanh'];?></td>
						<td width="200"><?php echo $this->map['DaThi']['current']['HoDem'];?> <?php echo $this->map['DaThi']['current']['Ten'];?></td>
						<td width="75"><?php echo $this->map['DaThi']['current']['NgaySinh'];?></td>
						<td width="70"><?php echo date('H:i:s',$this->map['DaThi']['current']['T_BatDau']);?></td>
						<td width="70"><?php echo date('H:i:s',$this->map['DaThi']['current']['T_KetThuc']);?></td>
						<td width="40"><?php echo $this->map['DaThi']['current']['Diem'];?></td>
					</tr>
					<?php }}unset($this->map['DaThi']['current']);} ?><?php } ?></tbody>
				</table>
			</div>
		</div>
		<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	</div>
</div>
<script>
	var localStorage = window.localStorage;
	var autoR;
	if (localStorage.TimeOut) {
		
	} else {
		localStorage.TimeOut = 60;
	}
	$('timeout').value = localStorage.TimeOut;
	function SaveTimeOut(value){
		TimeOut = parseInt(value);
		if(TimeOut<10) TimeOut = 10;
		localStorage.setItem("TimeOut", TimeOut);
		myStopFunction();
		autoRefresh();
	}
	function myStopFunction() {
		clearTimeout(autoR);
	}
	function autoRefresh(){
		autoR = setTimeout(function(){ location.reload(); }, localStorage.TimeOut*1000);
	}
	autoRefresh();
</script>