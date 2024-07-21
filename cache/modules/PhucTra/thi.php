<div class="testonline-bound">
	<form method="post" id="TestOnline" name="TestOnline" enctype="multipart/form-data"><?php $loai_cau_hoi='';$f=true;$i=1?>
	<div class="panel panel-info">
		<div class="panel-heading">CÂU HỎI</div>
		<div class="panel-body">
			<ol style="list-style:none;padding:0">
			<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
			<?php if(($this->map['items']['current']['IDCauHoiCha']==-1)){?>
			<li class="question question-reading">
			<div class="panel panel-info">
				<div class="panel-heading"><?php echo $this->map['items']['current']['Ten'];?></div>
				<div class="panel-body">
					<?php echo $this->map['items']['current']['NoiDungCauHoi'];?>
				</div>
			</div>
			 <?php }else{ ?>
			<li id="question-<?php echo $i;?>" class="question question-type<?php echo $this->map['items']['current']['IDCachHoi'];?>"><strong>Q<?php echo $i;?>: </strong><span class="<?php echo $this->map['items']['current']['is_right']?'is_right': 'is_fail';?>"><?php echo $this->map['items']['current']['NoiDungCauHoi'];?></span>
			<?php } ?>
			
			<?php if((isset($this->map['items']['current']['answers']))){?>
			<div>
				<?php if(isset($this->map['items']['current']['answers']) and is_array($this->map['items']['current']['answers'])){ foreach($this->map['items']['current']['answers'] as $key2=>&$item2){ if($key2!='current'){$this->map['items']['current']['answers']['current'] = &$item2;?>
				<div class="clearfix<?php echo $this->map['items']['current']['answers']['current']['traloi']&&!$this->map['items']['current']['answers']['current']['dapan']?' traloi':'';?> <?php echo $this->map['items']['current']['answers']['current']['dapan']?'dapan':'';?>"><input <?php echo $this->map['items']['current']['answers']['current']['dapan']?'checked': '';?> type="<?php echo $this->map['items']['current']['MultiAnswer']?'checkbox':'radio';?>" name="answer[<?php echo $this->map['items']['current']['id'];?>]<?php echo $this->map['items']['current']['MultiAnswer']?'[]':'';?>" value="<?php echo $this->map['items']['current']['answers']['current']['id'];?>"> <span><?php echo $this->map['items']['current']['answers']['current']['NoiDungTraLoi'];?></span></div>
				<?php }}unset($this->map['items']['current']['answers']['current']);} ?>
			</div>
			<?php } ?>
			
			<?php if((isset($this->map['items']['current']['matching']))){?>
			<div class="matching" question="<?php echo $this->map['items']['current']['id'];?>"><?php $index=1;$Rindex=array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f')?>
			<?php if(isset($this->map['items']['current']['matching']) and is_array($this->map['items']['current']['matching'])){ foreach($this->map['items']['current']['matching'] as $key3=>&$item3){ if($key3!='current'){$this->map['items']['current']['matching']['current'] = &$item3;?>
				<div class="draggable" id="draggable-<?php echo $this->map['items']['current']['id'];?>-<?php echo $this->map['items']['current']['matching']['current']['index'];?>" index="<?php echo $this->map['items']['current']['matching']['current']['index'];?>">
				<?php echo $index;?>.<?php echo $this->map['items']['current']['matching']['current']['right'];?><br /><?php echo $this->map['items']['current']['matching']['current']['select'];?>
				</div>
				<div class="droppable" line="line-<?php echo $this->map['items']['current']['id'];?>-<?php echo $this->map['items']['current']['matching']['current']['index'];?>" id="droppable-<?php echo $this->map['items']['current']['id'];?>-<?php echo $this->map['items']['current']['matching']['current']['index'];?>">
				<span class="index"><?php echo $Rindex[$index++];?>.</span><?php echo $this->map['items']['current']['matching']['current']['left'];?>
				</div>
				<div class="clearfix"></div>
			<?php }}unset($this->map['items']['current']['matching']['current']);} ?>
			</div>
			<input id="answer-<?php echo $this->map['items']['current']['id'];?>" name="answer[<?php echo $this->map['items']['current']['id'];?>]" type="hidden" />
			<?php } ?>
			
			<?php if(($this->map['items']['current']['IDCachHoi']==WRITING)){?>
			<hr>
			<h2><strong>Phần trả lời:</strong></h2>
			<input onchange="is_answer(<?php echo $this->map['items']['current']['id'];?>)" q="<?php echo $i;?>" type="file" name="File_<?php echo $this->map['items']['current']['id'];?>" id="File_<?php echo $this->map['items']['current']['id'];?>" /><br>
			<textarea class="hidden" onchange="is_answer(<?php echo $this->map['items']['current']['id'];?>)" style="width:100%; min-height:200px" name="answer[<?php echo $this->map['items']['current']['id'];?>]" ></textarea>
			<?php } ?>
			
			<?php if(($this->map['items']['current']['IDCachHoi']==SHORTANSWER)){?>
			<input onchange="is_answer(<?php echo $this->map['items']['current']['id'];?>)" style="width:100%;" name="answer[<?php echo $this->map['items']['current']['id'];?>]" />
			<?php } ?>
			</li><?php $i++?>
			<?php }}unset($this->map['items']['current']);} ?>
			</ol>
			<input type="hidden" name="IDThiSinh" value="<?php echo $this->map['IDTSDuThi'];?>">
		</div>
	</div>
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	<script src="lib/js/exam.js"></script>
</div>
<script>
	jQuery(function(){
		show();
	})
	function show(){
		jQuery('.question').show();
	}
	function quickview(_QIndex){
		
	}
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Bạn có chắc nộp bài PhucTra không?</h4>
			</div>            
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Quay lại làm bài</button>
				<button type="button" onclick="NopBai()" class="btn btn-danger btn-ok">Nộp bài</button>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery('#confirm-delete').on('show.bs.modal', function(e) {
		var is_th = false;
		var note = '';
		jQuery('input[type=file]').each(function(){
			is_th = true;
			val = jQuery(this).val();
			if(val){
				note += '<li>Q'+jQuery(this).attr('q')+': '+jQuery(this).val()+'</li>';
			}else{
				note += '<li>Q'+jQuery(this).attr('q')+': Chưa nộp file</li>';
			}
		});
		if(is_th){
			jQuery('.modal-body').html('<h3>Bài thực hành đã nộp</h3><ul>'+note+'</ul>');
		}
	});
</script>