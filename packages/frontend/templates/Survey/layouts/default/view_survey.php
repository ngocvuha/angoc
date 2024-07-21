<?php if(MAP['check']==1)
{?>
<div id="view-survey-bound" class="view-survey-bound" style="position:relative;">
	<div class="survey-question-name" style="font-size:14px; font-weight:bold;">[[|question|]]</div>
	<div class="survey-total-answer">[[.total_voting.]] : <strong style="color:#F60; font-size:16px;">[[|num|]]</strong></div>
	<div>
	<ul class="view-survey-options">
	<!--LIST:items-->
	<li class="view-survey-item">
			<div class="view-survey-label"><strong>[[|items.name|]]</strong> <span>( [[|items.count|]]/[[|num|]] [[.voting_paper.]] )</span></div>
			<table width="100%" cellpadding="2" cellspacing="2">
				<tr>
					<td bgcolor="[[|items.color|]]" width="[[|items.width|]]%"></td>
					<td>[[|items.percent|]]%</td>
				</tr>
			</table>
	</li>	
	<!--/LIST:items-->
	</ul>
	</div>
	<?php }
	else
	{?>
	<div class="view-survey-notice">[[.no_result.]]</div>
	<?php }?>
	<div class="view-survey-close-button"><input type="button" value="[[.close.]]" onclick="window.close();" /></div>
</div>
<script type="text/javascript">
	//window.resizeTo( $('view-survey').offsetWidth+30, $('view-survey').offsetHeight+60);
</script>