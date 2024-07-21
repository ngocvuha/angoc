<div class="block block-poll last_block">
    <form id="pollForm" action="" method="post" onsubmit="return validatePollAnswerIsSelected();">
        <div class="block-content">
            <p class="block-subtitle">[[|question_name|]]</p>
            <ul id="poll-answers"><.$i=1.>
            <!--LIST:items-->
            <li class="{{$i%2?'odd':'even'}}">
                <!--IF:type([[=type=]])-->
                <input class="radio poll_vote" name="survey_id[]" id="survey_id_[[|items.id|]]" type="checkbox" value="[[|items.id|]]" />
                <!--ELSE-->
                <input class="radio poll_vote" name="survey_id[]" id="survey_id_[[|items.id|]]" type="radio" value="[[|items.id|]]"<?php echo $i==1?' checked="checked"':''; $i++;?> />
                <!--/IF:type-->
                <span class="label"><label for="survey_id_[[|items.id|]]">[[|items.name|]]</label></span>
            </li>
            <!--/LIST:items-->
            </ul>
            <div class="actions">
            <button onclick="__survey()" title="Vote" class="button"><span><span>[[.send_comment.]]</span></span></button>
            <button onclick="__result()" title="Vote" class="button"><span><span>[[.result.]]</span></span></button>
            </div>
        </div>    
        <div class="survey-button">
        </div>
		<div class="clear"></div>
	</form>
    <!--/IF:cond-->
	<!--IF:can(User::can_admin(MODULE_SURVEYADMIN))-->
    <div align="center" class="pad-5">[[|button|]]</div>
	<!--/IF:can-->
</div>	
<script type="text/javascript">
function __survey(){
	if(typeof(view_survey) == 'undefined' || view_survey.closed)
	{
		var url="{{Url::build('survey',array('cmd'=>'view','id'=>[[=survey_id=]]))}}&ids="+survey_list("survey_id[]");
		view_survey=window.open(url,'view_survey','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0, width=500, height=400, left = 10,top = 10');
	}
	view_survey.focus();
}
function __result(){
	if(typeof(view_survey) == 'undefined' || view_survey.closed)
	{
		var url="{{Url::build('survey',array('cmd'=>'view','id'=>[[=survey_id=]]))}}";
		view_survey=window.open(url,'view_survey','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0, width=500, height=400, left = 10,top = 10');
	}
	view_survey.focus();
}
</script>