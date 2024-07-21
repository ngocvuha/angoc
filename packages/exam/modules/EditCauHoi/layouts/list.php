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
				<ul class="helper-menu"><.$i=1;.>
					<!--LIST:menu-->
					<.$class=EditCauHoi::check_class([[=menu.childs=]],sizeof([[=menu=]]),$i); $i++;.>
					<li class="{{$class}}">
						<div id="helper-[[|menu.id|]]" class="close">[[|menu.name|]]  <a style="float:right" href="{{Url::build_current(array('LoaiCauHoi'=>[[=menu.LoaiCauHoi=]]))}}">Chọn</a></div>
						<!--IF:childs1([[=menu.childs=]])-->
						<ul><.$total1=sizeof([[=menu.childs=]]); $j=1;.>
							<!--LIST:menu.childs-->
							<.$class=EditCauHoi::check_class([[=menu.childs.childs=]],$total1,$j); $j++;.>
							<li class="{{$class}}">
								<div id="helper-[[|menu.childs.id|]]" class="close">[[|menu.childs.name|]] <a style="float:right" href="{{Url::build_current(array('LoaiCauHoi'=>[[=menu.childs.LoaiCauHoi=]]))}}">Chọn</a></div>
								<!--IF:childs2([[=menu.childs.childs=]])-->
								<ul><.$total2=sizeof([[=menu.childs.childs=]]); $k=1;.>
									<!--LIST:menu.childs.childs-->
									<.$class=EditCauHoi::check_class([[=menu.childs.childs.childs=]],$total2,$k); $k++;.>
									<li class="{{$class}}">
										<div id="helper-[[|menu.childs.childs.id|]]" class="close">[[|menu.childs.childs.name|]] <a style="float:right" href="{{Url::build_current(array('LoaiCauHoi'=>[[=menu.childs.childs.LoaiCauHoi=]]))}}">Chọn</a></div>
										<!--IF:childs3([[=menu.childs.childs.childs=]])-->
										<ul><.$total3=sizeof([[=menu.childs.childs.childs=]]); $n=1;.>
											<!--LIST:menu.childs.childs.childs-->
											<.$class=EditCauHoi::check_class([[=menu.childs.childs.childs.childs=]],$total3,$n); $n++;.>
											<li class="{{$class}}">
												<div id="helper-[[|menu.childs.childs.childs.id|]]" class="close">[[|menu.childs.childs.childs.name|]] <a style="float:right" href="{{Url::build_current(array('LoaiCauHoi'=>[[=menu.childs.childs.childs.LoaiCauHoi=]]))}}">Chọn</a></div>
												<!--IF:childs4([[=menu.childs.childs.childs.childs=]])-->
												<ul><.$total4=sizeof([[=menu.childs.childs.childs.childs=]]); $q=1;.>
													<!--LIST:menu.childs.childs.childs.childs-->
													<.$class=EditCauHoi::check_class([[=menu.childs.childs.childs.childs.childs=]],$total4,$q); $q++;.>
													<li class="{{$class}}">
														<div id="helper-[[|menu.childs.childs.childs.childs.id|]]" class="close">[[|menu.childs.childs.childs.childs.name|]] <a style="float:right" href="{{Url::build_current(array('LoaiCauHoi'=>[[=menu.childs.childs.childs.childs.LoaiCauHoi=]]))}}">Chọn</a></div>
														<!--IF:childs5([[=menu.childs.childs.childs.childs.childs=]])-->
														<ul><.$total5=sizeof([[=menu.childs.childs.childs.childs.childs=]]); $p=1;.>
															<!--LIST:menu.childs.childs.childs.childs.childs-->
															<.$class=EditCauHoi::check_class([[=menu.childs.childs.childs.childs.childs.childs=]],$total5,$p); $p++;.>
															<li class="{{$class}}">
																<div id="helper-[[|menu.childs.childs.childs.childs.childs.id|]]" class="close">[[|menu.childs.childs.childs.childs.childs.name|]] <a style="float:right" href="{{Url::build_current(array('LoaiCauHoi'=>[[=menu.childs.childs.childs.childs.childs.LoaiCauHoi=]]))}}">Chọn</a></div>
															</li>
															<!--/LIST:menu.childs.childs.childs.childs.childs-->
														</ul>
														<!--/IF:childs5-->
													</li>
													<!--/LIST:menu.childs.childs.childs.childs-->
												</ul>
												<!--/IF:childs4-->
											</li>
											<!--/LIST:menu.childs.childs.childs-->
										</ul>
										<!--/IF:childs3-->
									</li>
									<!--/LIST:menu.childs.childs-->
								</ul>
								<!--/IF:childs2-->
							</li>
							<!--/LIST:menu.childs-->
						</ul>
						<!--/IF:childs1-->
					</li>
					<!--/LIST:menu-->
				</ul>
			</td>
			<td>
				<ol>
					<!--LIST:items-->
					<li><b>[[|items.NoiDungCauHoi|]]</b></li>
					<!--IF:ans(isset([[=items.answers=]]))-->
					<div class="row"><ol type="a">
						<!--LIST:items.answers-->
						<li>
							<input type="radio" name="answer[[[|items.ID|]]]" value="[[[|items.answers.ID|]]]">
							[[|items.answers.NoiDungTraLoi|]]
						</li>
						<!--/LIST:items.answers--></ol>
					</div>
					<!--/IF:ans-->
					<!--/LIST:items-->
				</ol>
			</td>
		</table>
		</form>
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