<div class="panel panel-default">
  <div class="panel-heading">TIẾN TRÌNH LÀM BÀI</div>
  <div class="panel-body">
	<table class="table table-responsive" style="margin-bottom:0px;margin-top:-15px;">
		<tr><th>Môn thi:</th><td>[[|MonThi|]]</td></tr>
		<tr><th>Thời gian thi:</th><td>[[|ThoiGianLamBai|]] phút</td></tr>
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
	<div class="question-list"><.$i=1.>
		<!--LIST:items--><!--IF:cond([[=items.IDCauHoiCha=]]!=-1)--><a href="#question-{{$i}}" id="qlist-[[|items.id|]]" class="badge-normal"><span class="badge">{{$i++}}</span></a><!--/IF:cond--><!--/LIST:items-->
	</div>
  </div>
</div>
<script>
jQuery(function(){
	jQuery('.countdown').downCount({
		start: '{{date('m/d/Y H:i:s',time())}}',
		date: '{{date('m/d/Y H:i:s',[[=T_KetThuc=]])}}'
	}, function () {
		jQuery('form[name=TestOnline]').submit();
	});
})
</script>