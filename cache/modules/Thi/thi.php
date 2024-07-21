<div class="testonline-bound">
	<form method="post" name="TestOnline"><?php $loai_cau_hoi='';$f=true;$i=1?>
	<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
	<?php if($loai_cau_hoi!=$this->map['items']['current']['LoaiCauHoi']){
		$loai_cau_hoi=$this->map['items']['current']['LoaiCauHoi'];if($f){$f=false;}else{echo '</div></div>';}?>
	<div class="panel panel-primary1"><div class="panel-heading1"><!--<?php echo $this->map['items']['current']['LoaiCauHoi'];?> --></div><div class="panel-body1" style="margin-bottom:0px;"><ol style="list-style:none;padding:0">
	<?php }?>
	<?php if(($this->map['items']['current']['IDCauHoiCha']==-1)){?>
	<li class="question question-reading">
	<div class="panel panel-info">
		<div class="panel-heading"><?php echo $this->map['items']['current']['Ten'];?></div>
		<div class="panel-body">
			<?php echo $this->map['items']['current']['NoiDungCauHoi'];?>
		</div>
	</div>
	 <?php }else{ ?>
	<li id="question-<?php echo $i;?>" class="question question-type<?php echo $this->map['items']['current']['IDCachHoi'];?>"><h3>Q<?php echo $i++;?>:<?php echo $this->map['items']['current']['NoiDungCauHoi'];?></h3>
	<?php } ?>
	
	<?php if((isset($this->map['items']['current']['answers']))){?>
	<div>
		<?php if(isset($this->map['items']['current']['answers']) and is_array($this->map['items']['current']['answers'])){ foreach($this->map['items']['current']['answers'] as $key2=>&$item2){ if($key2!='current'){$this->map['items']['current']['answers']['current'] = &$item2;?>
		<div class="clearfix"><input onchange="is_answer(<?php echo $this->map['items']['current']['id'];?>)" type="<?php echo $this->map['items']['current']['MultiAnswer']?'checkbox':'radio';?>" name="answer[<?php echo $this->map['items']['current']['id'];?>]<?php echo $this->map['items']['current']['MultiAnswer']?'[]':'';?>" value="<?php echo $this->map['items']['current']['answers']['current']['id'];?>"> </td><td><?php echo $this->map['items']['current']['answers']['current']['NoiDungTraLoi'];?></div>
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
	<?php } ?></li>
	
	<?php if(($this->map['items']['current']['IDCachHoi']==WRITING)){?>
	<textarea onchange="is_answer(<?php echo $this->map['items']['current']['id'];?>)" style="width:100%; min-height:200px" name="answer[<?php echo $this->map['items']['current']['id'];?>]" ></textarea>
	<?php } ?>
	
	<?php if(($this->map['items']['current']['IDCachHoi']==SHORTANSWER)){?>
	<input onchange="is_answer(<?php echo $this->map['items']['current']['id'];?>)" style="width:100%;" name="answer[<?php echo $this->map['items']['current']['id'];?>]" />
	<?php } ?>
	<?php }}unset($this->map['items']['current']);} ?>
	</ol></div></div>
	<center><input type="submit" onclick="return confirm('Bạn có chắc muốn nộp bài không?');" value="Nộp bài thi" class="btn btn-success" /></center>
	<input type="hidden" name="IDThiSinh" value="<?php echo $this->map['IDTSDuThi'];?>">
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	<script src="lib/js/exam.js"></script>
</div>