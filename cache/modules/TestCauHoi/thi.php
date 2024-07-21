<div class="testonline-bound" id="ZonePrinter">
	<form method="post" name="TestOnline">
	<?php $loai_cau_hoi='';$f=true;$i=1?> 	
	<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
	<?php if($loai_cau_hoi!=$this->map['items']['current']['LoaiCauHoi']){$loai_cau_hoi=$this->map['items']['current']['LoaiCauHoi'];if($f){$f=false;}else{echo '</div></div>';}?>
	<div class="panel panel-primary">
		<div class="panel-heading"><?php echo $this->map['items']['current']['LoaiCauHoi'];?></div>
		<div class="panel-body">
			<ol style="list-style:none;padding:0"><?php }?>
				
				<?php if(($this->map['items']['current']['IDCauHoiCha']==-1)){?>
				<li class="question question-reading">
				<div class="panel panel-info">
					<div class="panel-heading"><?php echo $this->map['items']['current']['Ten'];?></div>
					<div class="panel-body"><?php echo $this->map['items']['current']['NoiDungCauHoi'];?></div>
					<ul><?php if(isset($this->map['items']['current']['childs']) and is_array($this->map['items']['current']['childs'])){ foreach($this->map['items']['current']['childs'] as $key2=>&$item2){ if($key2!='current'){$this->map['items']['current']['childs']['current'] = &$item2;?>
					<li style="margin-bottom:10px;">
						<h3>Q<?php echo $i++;?>:<?php echo $this->map['items']['current']['childs']['current']['NoiDungCauHoi'];?></h3>
						<?php if((isset($this->map['items']['current']['childs']['current']['answers']))){?>
						<?php if(isset($this->map['items']['current']['childs']['current']['answers']) and is_array($this->map['items']['current']['childs']['current']['answers'])){ foreach($this->map['items']['current']['childs']['current']['answers'] as $key3=>&$item3){ if($key3!='current'){$this->map['items']['current']['childs']['current']['answers']['current'] = &$item3;?>
						<div class="clearfix" style="font-weight:bold"><?php echo $this->map['items']['current']['childs']['current']['answers']['current']['NoiDungTraLoi'];?></div>
						<?php }}unset($this->map['items']['current']['childs']['current']['answers']['current']);} ?>
						<?php } ?>
					</li>
					<?php }}unset($this->map['items']['current']['childs']['current']);} ?></ul>
				</div></li>
				 <?php }else{ ?>
				<li id="question-<?php echo $i;?>" class="question question-type<?php echo $this->map['items']['current']['IDCachHoi'];?>">
					<h3>Q<?php echo $i++;?>:<?php echo $this->map['items']['current']['NoiDungCauHoi'];?></h3>
					<?php } ?>
					<?php if((isset($this->map['items']['current']['answers']))){?>
					<div><?php if(isset($this->map['items']['current']['answers']) and is_array($this->map['items']['current']['answers'])){ foreach($this->map['items']['current']['answers'] as $key4=>&$item4){ if($key4!='current'){$this->map['items']['current']['answers']['current'] = &$item4;?>
						<div class="clearfix">
							<input<?php if($this->map['items']['current']['answers']['current']['Diem']){ echo ' checked';}?> type="<?php echo $this->map['items']['current']['MultiAnswer']?'checkbox':'radio';?>" />
							<?php echo $this->map['items']['current']['answers']['current']['NoiDungTraLoi'];?>
						</div>
					<?php }}unset($this->map['items']['current']['answers']['current']);} ?></div>
					<?php } ?>
				</li>
				<!--/IF:reading-->
				
				<?php if((isset($this->map['items']['current']['matching']))){?>
				<div class="matching" question="<?php echo $this->map['items']['current']['id'];?>">
					<?php $index=1;$Rindex=array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f')?>
					<?php if(isset($this->map['items']['current']['matching']) and is_array($this->map['items']['current']['matching'])){ foreach($this->map['items']['current']['matching'] as $key5=>&$item5){ if($key5!='current'){$this->map['items']['current']['matching']['current'] = &$item5;?>
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
				
				<?php if(($this->map['items']['current']['IDCachHoi']==WRITING)){?> 	<textarea onchange="is_answer(<?php echo $this->map['items']['current']['id'];?>)" style="width:100%; min-height:200px" name="answer[<?php echo $this->map['items']['current']['id'];?>]" ></textarea> 	<?php } ?>	 	<?php if(($this->map['items']['current']['IDCachHoi']==SHORTANSWER)){?> 	<input onchange="is_answer(<?php echo $this->map['items']['current']['id'];?>)" style="width:100%;" name="answer[<?php echo $this->map['items']['current']['id'];?>]" /> 	<?php } ?> 	<?php }}unset($this->map['items']['current']);} ?> 	</ol></div></div> 	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form > 	<script src="lib/js/test.js"></script> </div>
				
				
				
				