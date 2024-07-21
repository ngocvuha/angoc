<ol>
	<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
	<li><b><?php echo $this->map['items']['current']['NoiDungCauHoi'];?></b></li>
	<?php if((isset($this->map['items']['current']['answers']))){?>
	<div class="row"><ol type="a">
		<?php if(isset($this->map['items']['current']['answers']) and is_array($this->map['items']['current']['answers'])){ foreach($this->map['items']['current']['answers'] as $key2=>&$item2){ if($key2!='current'){$this->map['items']['current']['answers']['current'] = &$item2;?>
		<li style="margin-right:50px;float:left;"><?php echo $this->map['items']['current']['answers']['current']['NoiDungTraLoi'];?> <input type="radio" name="answer[<?php echo $this->map['items']['current']['ID'];?>]" value="[<?php echo $this->map['items']['current']['answers']['current']['ID'];?>]"></li>
		<?php }}unset($this->map['items']['current']['answers']['current']);} ?></ol>
	</div>
	<?php } ?>
	<?php }}unset($this->map['items']['current']);} ?>
</ol>