<div class="testonline-bound">
	<form method="post" id="TestOnline" name="TestOnline" enctype="multipart/form-data"><.$loai_cau_hoi='';$f=true;$i=1.>
	<div class="panel panel-info">
		<div class="panel-heading">CÂU HỎI</div>
		<div class="panel-body">
			<ol style="list-style:none;padding:0">
			<!--LIST:items-->
			<!--IF:reading([[=items.IDCauHoiCha=]]==-1)-->
			<li class="question question-reading">
			<div class="panel panel-info">
				<div class="panel-heading">[[|items.Ten|]]</div>
				<div class="panel-body">
					[[|items.NoiDungCauHoi|]]
				</div>
			</div>
			<!--ELSE-->
			<li id="question-{{$i}}" class="question question-type[[|items.IDCachHoi|]]"><strong>Q{{$i}}: </strong><span class="{{[[=items.is_right=]]?'is_right': 'is_fail'}}">[[|items.NoiDungCauHoi|]]</span>
			<!--/IF:reading-->
			
			<!--IF:ans(isset([[=items.answers=]]))-->
			<div>
				<!--LIST:items.answers-->
				<div class="clearfix{{[[=items.answers.traloi=]]&&![[=items.answers.dapan=]]?' traloi':''}} {{[[=items.answers.dapan=]]?'dapan':''}}"><input {{[[=items.answers.dapan=]]?'checked': ''}} type="{{[[=items.MultiAnswer=]]?'checkbox':'radio'}}" name="answer[[[|items.id|]]]{{[[=items.MultiAnswer=]]?'[]':''}}" value="[[|items.answers.id|]]"> <span>[[|items.answers.NoiDungTraLoi|]]</span></div>
				<!--/LIST:items.answers-->
			</div>
			<!--/IF:ans-->
			
			<!--IF:matching(isset([[=items.matching=]]))-->
			<div class="matching" question="[[|items.id|]]"><.$index=1;$Rindex=array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f').>
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
			
			<!--IF:writing([[=items.IDCachHoi=]]==WRITING)-->
			<hr>
			<h2><strong>Phần trả lời:</strong></h2>
			<input onchange="is_answer([[|items.id|]])" q="{{$i}}" type="file" name="File_[[|items.id|]]" id="File_[[|items.id|]]" /><br>
			<textarea class="hidden" onchange="is_answer([[|items.id|]])" style="width:100%; min-height:200px" name="answer[[[|items.id|]]]" ></textarea>
			<!--/IF:writing-->
			
			<!--IF:shortanswer([[=items.IDCachHoi=]]==SHORTANSWER)-->
			<input onchange="is_answer([[|items.id|]])" style="width:100%;" name="answer[[[|items.id|]]]" />
			<!--/IF:shortanswer-->
			</li><.$i++.>
			<!--/LIST:items-->
			</ol>
			<input type="hidden" name="IDThiSinh" value="[[|IDTSDuThi|]]">
		</div>
	</div>
	</form>
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