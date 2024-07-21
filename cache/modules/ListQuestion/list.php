<div class="panel panel-default">
  <div class="panel-heading">TIẾN TRÌNH LÀM BÀI</div>
  <div class="panel-body">
	<table class="table table-responsive" style="margin-bottom:0px;margin-top:-15px;">
		<tr><th>Môn thi:</th><td><?php echo $this->map['MonThi'];?></td></tr>
		<tr><th>Thời gian thi:</th><td><?php echo $this->map['ThoiGianLamBai'];?> phút</td></tr>
		<tr><th>Đếm ngược</th><td>
			<ul class="countdown">
				<li> <span class="hours">00</span></li>
				<li class="seperator">:</li>
				<li> <span class="minutes">00</span></li>
				<li class="seperator">:</li>
				<li> <span class="seconds">00</span></li>
			</ul>
		</td></tr>
	</table>
	<div class="question-list"><?php $i=1?>
		<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?><?php if(($this->map['items']['current']['IDCauHoiCha']!=-1)){?><a href="#question-<?php echo $i;?>" id="qlist-<?php echo $this->map['items']['current']['id'];?>" class="badge-normal"><span class="badge"><?php echo $i++;?></span></a><?php } ?><?php }}unset($this->map['items']['current']);} ?>
	</div>
  </div>
</div>
<script>
jQuery(function(){
	jQuery('.countdown').downCount({
		start: '<?php echo date('m/d/Y H:i:s',time());?>',
		date: '<?php echo date('m/d/Y H:i:s',$this->map['T_KetThuc']);?>'
	}, function () {
		jQuery('form[name=TestOnline]').submit();
	});
})
</script>