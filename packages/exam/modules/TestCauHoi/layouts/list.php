<ol>
	<!--LIST:items-->
	<li><b>[[|items.NoiDungCauHoi|]]</b></li>
	<!--IF:ans(isset([[=items.answers=]]))-->
	<div class="row"><ol type="a">
		<!--LIST:items.answers-->
		<li style="margin-right:50px;float:left;">[[|items.answers.NoiDungTraLoi|]] <input type="radio" name="answer[[[|items.ID|]]]" value="[[[|items.answers.ID|]]]"></li>
		<!--/LIST:items.answers--></ol>
	</div>
	<!--/IF:ans-->
	<!--/LIST:items-->
</ol>