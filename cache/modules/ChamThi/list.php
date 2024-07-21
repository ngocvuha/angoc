<h3>Người chấm: <?php echo $this->map['HoTen'];?> - Khoa: <?php echo $this->map['Khoa'];?> - Mã người chấm:<?php echo $this->map['IDUser'];?> <a href="<?php echo Url::build_current(array('cmd'=>'thoat'));?>" class="btn btn-primary">Thoát</a></h3>
<?php $i=1?><?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
<div class="row list-writing" id="index-<?php echo $i++;?>" q="<?php echo $this->map['items']['current']['id'];?>" mark="<?php echo $this->map['items']['current']['Diem'];?>" tmark="<?php echo $this->map['items']['current']['TMark'];?>">
	<div class="col-md-9">
		<embed src="<?php echo $this->map['items']['current']['path'];?>" width="100%" height="1200px" />		
	</div>
	<div class="col-md-3">
		<?php echo $this->map['items']['current']['NoiDungCauHoi'];?>
	</div>	
</div>
<?php }}unset($this->map['items']['current']);} ?>
<form method="POST">
	<div class="form-group form-inline">
		<label for="diem">Điểm</label>
		<input class="form-control" name="diem" id="diem" /> / <span id="totalMark"></span> (Điểm tối đa)
	</div>
	<div><input type="button" value="Lưu" class="btn btn-success" onclick="ChamBai()" /></div>
	<input type="hidden" name="IDWriting" id="IDWriting" value="">
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
<div class="row">
	<div class="col-md-12"><?php $i=1?>		
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
				
				<?php $i=1;$ch=''?><?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key2=>&$item2){ if($key2!='current'){$this->map['items']['current'] = &$item2;?>
					<?php if($ch!=$this->map['items']['current']['Ten']){$ch=$this->map['items']['current']['Ten'];$j=1;?>
					<?php if($i>1){?></tr><?php }?>
					<tr><th colspan="18" bgcolor="#09C"><?php echo $this->map['items']['current']['Ten'];?></th></tr>
					<?php }?>
					<?php if($j%9==1){?><tr><?php }$j++;?>
						<td style="width:80px" id="mark-<?php echo $i;?>" class="list-writing-item" stt="<?php echo $i++;?>"><?php echo $this->map['items']['current']['Phach'];?></td>
						<td id="mark-"><?php echo $this->map['items']['current']['Diem']==-1?'':$this->map['items']['current']['Diem'];?></td>
					<?php if($j%9==1){?></tr><?php }?>
				<?php }}unset($this->map['items']['current']);} ?>
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
				url: 'form.php?block_id=<?php echo Module::block_id();?>',
				data: {'Diem':diem,'IDWriting':baithi,'cmd':'cham'},
				success: function(data){
					if(data==1){
						if(index>=<?php echo $this->map['total'];?>){
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