<div class="testonline-bound" id="ZonePrinter">
	<form method="post" name="TestOnline">
	<.$loai_cau_hoi='';$f=true;$i=1.> 	
	<!--LIST:items-->
	<.if($loai_cau_hoi!=[[=items.LoaiCauHoi=]]){$loai_cau_hoi=[[=items.LoaiCauHoi=]];if($f){$f=false;}else{echo '</div></div>';}.>
	<div class="panel panel-primary">
		<div class="panel-heading">[[|items.LoaiCauHoi|]]</div>
		<div class="panel-body">
			<ol style="list-style:none;padding:0"><.}.>
				
				<!--IF:reading([[=items.IDCauHoiCha=]]==-1)-->
				<li class="question question-reading">
				<div class="panel panel-info">
					<div class="panel-heading">[[|items.Ten|]]</div>
					<div class="panel-body">[[|items.NoiDungCauHoi|]]</div>
					<ul><!--LIST:items.childs-->
					<li style="margin-bottom:10px;">
						<h3>Q{{$i++}}:[[|items.childs.NoiDungCauHoi|]]</h3>
						<!--IF:ans(isset([[=items.childs.answers=]]))-->
						<!--LIST:items.childs.answers-->
						<div class="clearfix" style="font-weight:bold">[[|items.childs.answers.NoiDungTraLoi|]]</div>
						<!--/LIST:items.childs.answers-->
						<!--/IF:ans-->
					</li>
					<!--/LIST:items.childs--></ul>
				</div></li>
				<!--ELSE-->
				<li id="question-{{$i}}" class="question question-type[[|items.IDCachHoi|]]">
					<h3>Q{{$i++}}:[[|items.NoiDungCauHoi|]]</h3>
					<!--/IF:reading-->
					<!--IF:ans(isset([[=items.answers=]]))-->
					<div><!--LIST:items.answers-->
						<div class="clearfix">
							<input<.if([[=items.answers.Diem=]]){ echo ' checked';}.> type="{{[[=items.MultiAnswer=]]?'checkbox':'radio'}}" />
							[[|items.answers.NoiDungTraLoi|]]
						</div>
					<!--/LIST:items.answers--></div>
					<!--/IF:ans-->
				</li>
				<!--/IF:reading-->
				
				<!--IF:matching(isset([[=items.matching=]]))-->
				<div class="matching" question="[[|items.id|]]">
					<.$index=1;$Rindex=array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f').>
					<!--LIST:items.matching-->
					<div class="draggable" id="draggable-[[|items.id|]]-[[|items.matching.index|]]" index="[[|items.matching.index|]]">
						{{$index}}.[[|items.matching.right|]]<br />[[|items.matching.select|]]
					</div>
					<div class="droppable" line="line-[[|items.id|]]-[[|items.matching.index|]]" id="droppable-[[|items.id|]]-[[|items.matching.index|]]">
						<span class="index">{{$Rindex[$index++]}}.</span>[[|items.matching.left|]]
					</div>
					<div class="clearfix"></div>
					<!--/LIST:items.matching-->
				</div>
				<input id="answer-[[|items.id|]]" name="answer[[[|items.id|]]]" type="hidden" />
				<!--/IF:matching-->
				
				<!--IF:writing([[=items.IDCachHoi=]]==WRITING)--> 	<textarea onchange="is_answer([[|items.id|]])" style="width:100%; min-height:200px" name="answer[[[|items.id|]]]" ></textarea> 	<!--/IF:writing-->	 	<!--IF:shortanswer([[=items.IDCachHoi=]]==SHORTANSWER)--> 	<input onchange="is_answer([[|items.id|]])" style="width:100%;" name="answer[[[|items.id|]]]" /> 	<!--/IF:shortanswer--> 	<!--/LIST:items--> 	</ol></div></div> 	</form> 	<script src="lib/js/test.js"></script> </div>
				
				
				
				