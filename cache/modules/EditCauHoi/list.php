<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">
        	DS Cau hoi
        </div>
    </div>
	<div class="form-content">
        <form name="DSCauHoi" id="DSCauHoi" method="post">
		<table width="100%" border="1">
			<td width="500px">
				<ul class="helper-menu"><?php $i=1;?>
					<?php if(isset($this->map['menu']) and is_array($this->map['menu'])){ foreach($this->map['menu'] as $key1=>&$item1){ if($key1!='current'){$this->map['menu']['current'] = &$item1;?>
					<?php $class=EditCauHoi::check_class($this->map['menu']['current']['childs'],sizeof($this->map['menu']),$i); $i++;?>
					<li class="<?php echo $class;?>">
						<div id="helper-<?php echo $this->map['menu']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['name'];?>  <a style="float:right" href="<?php echo Url::build_current(array('LoaiCauHoi'=>$this->map['menu']['current']['LoaiCauHoi']));?>">Chọn</a></div>
						<?php if(($this->map['menu']['current']['childs'])){?>
						<ul><?php $total1=sizeof($this->map['menu']['current']['childs']); $j=1;?>
							<?php if(isset($this->map['menu']['current']['childs']) and is_array($this->map['menu']['current']['childs'])){ foreach($this->map['menu']['current']['childs'] as $key2=>&$item2){ if($key2!='current'){$this->map['menu']['current']['childs']['current'] = &$item2;?>
							<?php $class=EditCauHoi::check_class($this->map['menu']['current']['childs']['current']['childs'],$total1,$j); $j++;?>
							<li class="<?php echo $class;?>">
								<div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['name'];?> <a style="float:right" href="<?php echo Url::build_current(array('LoaiCauHoi'=>$this->map['menu']['current']['childs']['current']['LoaiCauHoi']));?>">Chọn</a></div>
								<?php if(($this->map['menu']['current']['childs']['current']['childs'])){?>
								<ul><?php $total2=sizeof($this->map['menu']['current']['childs']['current']['childs']); $k=1;?>
									<?php if(isset($this->map['menu']['current']['childs']['current']['childs']) and is_array($this->map['menu']['current']['childs']['current']['childs'])){ foreach($this->map['menu']['current']['childs']['current']['childs'] as $key3=>&$item3){ if($key3!='current'){$this->map['menu']['current']['childs']['current']['childs']['current'] = &$item3;?>
									<?php $class=EditCauHoi::check_class($this->map['menu']['current']['childs']['current']['childs']['current']['childs'],$total2,$k); $k++;?>
									<li class="<?php echo $class;?>">
										<div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['name'];?> <a style="float:right" href="<?php echo Url::build_current(array('LoaiCauHoi'=>$this->map['menu']['current']['childs']['current']['childs']['current']['LoaiCauHoi']));?>">Chọn</a></div>
										<?php if(($this->map['menu']['current']['childs']['current']['childs']['current']['childs'])){?>
										<ul><?php $total3=sizeof($this->map['menu']['current']['childs']['current']['childs']['current']['childs']); $n=1;?>
											<?php if(isset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['menu']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['menu']['current']['childs']['current']['childs']['current']['childs'] as $key4=>&$item4){ if($key4!='current'){$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item4;?>
											<?php $class=EditCauHoi::check_class($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs'],$total3,$n); $n++;?>
											<li class="<?php echo $class;?>">
												<div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?> <a style="float:right" href="<?php echo Url::build_current(array('LoaiCauHoi'=>$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['LoaiCauHoi']));?>">Chọn</a></div>
												<?php if(($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){?>
												<ul><?php $total4=sizeof($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']); $q=1;?>
													<?php if(isset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs'] as $key5=>&$item5){ if($key5!='current'){$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item5;?>
													<?php $class=EditCauHoi::check_class($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'],$total4,$q); $q++;?>
													<li class="<?php echo $class;?>">
														<div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?> <a style="float:right" href="<?php echo Url::build_current(array('LoaiCauHoi'=>$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['LoaiCauHoi']));?>">Chọn</a></div>
														<?php if(($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){?>
														<ul><?php $total5=sizeof($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']); $p=1;?>
															<?php if(isset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']) and is_array($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'])){ foreach($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'] as $key6=>&$item6){ if($key6!='current'){$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current'] = &$item6;?>
															<?php $class=EditCauHoi::check_class($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs'],$total5,$p); $p++;?>
															<li class="<?php echo $class;?>">
																<div id="helper-<?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['id'];?>" class="close"><?php echo $this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['name'];?> <a style="float:right" href="<?php echo Url::build_current(array('LoaiCauHoi'=>$this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['LoaiCauHoi']));?>">Chọn</a></div>
															</li>
															<?php }}unset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
														</ul>
														<?php } ?>
													</li>
													<?php }}unset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
												</ul>
												<?php } ?>
											</li>
											<?php }}unset($this->map['menu']['current']['childs']['current']['childs']['current']['childs']['current']);} ?>
										</ul>
										<?php } ?>
									</li>
									<?php }}unset($this->map['menu']['current']['childs']['current']['childs']['current']);} ?>
								</ul>
								<?php } ?>
							</li>
							<?php }}unset($this->map['menu']['current']['childs']['current']);} ?>
						</ul>
						<?php } ?>
					</li>
					<?php }}unset($this->map['menu']['current']);} ?>
				</ul>
			</td>
			<td>
				<ol>
					<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key7=>&$item7){ if($key7!='current'){$this->map['items']['current'] = &$item7;?>
					<li><b><?php echo $this->map['items']['current']['NoiDungCauHoi'];?></b></li>
					<?php if((isset($this->map['items']['current']['answers']))){?>
					<div class="row"><ol type="a">
						<?php if(isset($this->map['items']['current']['answers']) and is_array($this->map['items']['current']['answers'])){ foreach($this->map['items']['current']['answers'] as $key8=>&$item8){ if($key8!='current'){$this->map['items']['current']['answers']['current'] = &$item8;?>
						<li>
							<input type="radio" name="answer[<?php echo $this->map['items']['current']['ID'];?>]" value="[<?php echo $this->map['items']['current']['answers']['current']['ID'];?>]">
							<?php echo $this->map['items']['current']['answers']['current']['NoiDungTraLoi'];?>
						</li>
						<?php }}unset($this->map['items']['current']['answers']['current']);} ?></ol>
					</div>
					<?php } ?>
					<?php }}unset($this->map['items']['current']);} ?>
				</ol>
			</td>
		</table>
		<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	</div>
</div>
<script type="text/javascript">
jQuery(function(){	
	jQuery('.havechild-close > div').click(function(){
		jQuery(this).next().toggle();
		if(jQuery(this).parent().hasClass('havechild-open')){
			jQuery(this).parent().removeClass('havechild-open');
		}else{
			jQuery(this).parent().addClass('havechild-open');
		}
		if(jQuery(this).hasClass('open')){
			jQuery(this).removeClass('open');
		}else{
			jQuery(this).addClass('open');
		}
	});
	jQuery('.isfile div').click(function(){
		jQuery('.isfile div').removeClass('active');
		jQuery(this).addClass('active');
	});
	
});
</script>