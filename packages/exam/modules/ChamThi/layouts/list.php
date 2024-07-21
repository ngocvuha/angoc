<h3>Người chấm: [[|HoTen|]] - Khoa: [[|Khoa|]] - Mã người chấm:[[|IDUser|]] <a href="{{Url::build_current(array('cmd'=>'thoat'))}}" class="btn btn-primary">Thoát</a></h3>
<.$i=1.><!--LIST:items-->
<div class="row list-writing" id="index-{{$i++}}" q="[[|items.id|]]" mark="[[|items.Diem|]]" tmark="[[|items.TMark|]]">
	<div class="col-md-9">
		<embed src="[[|items.path|]]" width="100%" height="1200px" />		
	</div>
	<div class="col-md-3">
		[[|items.NoiDungCauHoi|]]
	</div>	
</div>
<!--/LIST:items-->
<form method="POST">
	<div class="form-group form-inline">
		<label for="diem">Điểm</label>
		<input class="form-control" name="diem" id="diem" /> / <span id="totalMark"></span> (Điểm tối đa)
	</div>
	<div><input type="button" value="Lưu" class="btn btn-success" onclick="ChamBai()" /></div>
	<input type="hidden" name="IDWriting" id="IDWriting" value="">
</form>
<div class="row">
	<div class="col-md-12"><.$i=1.>		
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách bài thi</div>
			<div class="panel-body">
				<table class="table table-bordered" cellpadding="4" cellspacing="6">
					<tr class="bg-primary">
						<th>Số phách</th><th>Điểm</th>
						<th>Số phách</th><th>Điểm</th>
						<th>Số phách</th><th>Điểm</th>
						<th>Số phách</th><th>Điểm</th>
						<th>Số phách</th><th>Điểm</th>
						<th>Số phách</th><th>Điểm</th>
						<th>Số phách</th><th>Điểm</th>
						<th>Số phách</th><th>Điểm</th>
						<th>Số phách</th><th>Điểm</th>
					</tr>
				
				<.$i=1;$ch=''.><!--LIST:items-->
					<.if($ch!=[[=items.Ten=]]){$ch=[[=items.Ten=]];$j=1;.>
					<.if($i>1){.></tr><.}.>
					<tr><th colspan="18" bgcolor="#09C">[[|items.Ten|]]</th></tr>
					<.}.>
					<.if($j%9==1){.><tr><.}$j++;.>
						<td style="width:80px" id="mark-{{$i}}" class="list-writing-item" stt="{{$i++}}">[[|items.Phach|]]</td>
						<td id="mark-">{{[[=items.Diem=]]==-1?'':[[=items.Diem=]]}}</td>
					<.if($j%9==1){.></tr><.}.>
				<!--/LIST:items-->
				</table>
			</div>
		</div>
	</div>	
</div>
<script>
	var index = 1;
	jQuery(function(){
		show(index);
		jQuery('.list-writing-item').on('click',function(){
			index = jQuery(this).attr('stt');
			show(index);
		})		
	})
	function show(i){
		jQuery('.list-writing').hide();
		q = jQuery('#index-'+i);
		q.show();
		$('diem').value = q.attr('mark');
		$('IDWriting').value = q.attr('q');
		$('totalMark').innerHTML = q.attr('tmark');
		jQuery('html, body').animate({scrollTop : 0},800);
	}
	function ChamBai(){
		diem = $('diem').value;
		if(diem!=''){
			baithi = $('IDWriting').value;
			jQuery.ajax({
				url: 'form.php?block_id={{Module::block_id()}}',
				data: {'Diem':diem,'IDWriting':baithi,'cmd':'cham'},
				success: function(data){
					if(data==1){
						if(index>=[[|total|]]){
							isMark(index,diem);
							alert('Bạn đã chấm xong. ');
						}else{
							if(confirm('Điểm đã lưu. Chấm bài tiếp theo')){
								isMark(index,diem);
								index++;
								show(index);
							}else{
								isMark(index,diem);
							}
						}
					}else{
						alert('Điểm chưa được cập nhật. Vui lòng lưu lại điểm');
					}
				}
			});
		}else{
			alert('Bạn chưa cho điểm bài này');
		}
	}
	function isMark(i,d){
		$('diem').value = '';
		$('IDWriting').value = '';
		jQuery('#index-'+i).attr('mark',d);
		jQuery('#mark-'+i).addClass('list-writing-active').next().html(d);
		jQuery('html, body').animate({scrollTop : 0},800);
	}
</script>