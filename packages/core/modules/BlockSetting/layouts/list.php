<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Setting của module <span style="text-transform:uppercase; font-size:16px;">[[|name|]]</span> - Vùng <span style="text-transform:uppercase; font-size:16px;">[[|region|]]</span> của trang <span style="text-transform:uppercase; font-size:16px;">[[|page_name|]]</span></div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
    <form id="ListBlockSettingForm" name="ListBlockSettingForm" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <td width="1%" nowrap="nowrap" class="pad-R10"><label><strong>Tên: </strong></label><input name="name" type="text" id="name" autofocus /></td>
                <!--IF:copy(sizeof([[=copy_setting_id_list=]])>1)-->
                <td><label><strong>Copy: </strong></label><select name="copy_setting_id" id="copy_setting_id"></select>&nbsp;<button onclick="make_cmd('copy_setting');" class="blue-button">Copy</button></td>
                <!--/IF:copy-->
                <td align="right"><a target="_blank" href="{{URL::build('module_setting',array('module_id'=>[[=module_id=]]))}}">[[.module_setting.]]</a></td>
            </tr>
        </table>
        <div id="tabs">
            <ul>
            <!--LIST:groups-->
                <li><a href="#tabs-[[|groups.code|]]">[[|groups.name|]]</a></li>
            <!--/LIST:groups-->
            </ul>
            <!--LIST:groups-->
            <div id="tabs-[[|groups.code|]]">
				<.$first = true;.>
                <table cellpadding="5" cellspacing="0" width="100%">
                    <tr valign="top"><td>
                    <!--LIST:groups.items-->
                    <.if([[=groups.items.group_column=]] != 1){
                        echo '</td><td>';
                    }else
                    if(!$first){
                        echo '</td></tr></table>';
                        echo '<table cellpadding="5" cellspacing="0" width="100%">
                            <tr valign="top"><td>';
                    }else{
                        $first = false;
                    }
                    .>
                    <p>
                    <!--IF:inline([[=groups.items.style=]]==1)-->
                    <div style="display:inline;width:250px;" title="[[|groups.items.id|]]">
                            <strong>[[|groups.items.name|]]</strong>
                    </div>
                    <!--ELSE-->
                        <span style="font-weight:bold;font-size:14px" title="[[|groups.items.id|]]">[[|groups.items.name|]]</span><br />
                        <!--IF:description([[=groups.items.description=]]!="")-->
                        <p>[[|groups.items.description|]]</p>
                        <!--/IF:description-->
                    <!--/IF:inline-->
                    [[|groups.items.value|]]
                    <!--IF:inline([[=groups.items.style=]]==1)-->
                        <!--IF:description([[=groups.items.description=]]!="")-->
                        <p>[[|groups.items.description|]]</p>
                        <!--/IF:description-->
                    <!--/IF:inline-->
                    </p>
                    <!--/LIST:groups.items-->
                    </td></tr>
                </table>
            </div>
            <!--/LIST:groups-->
        </div>
        <input type="hidden" value="" name="cmd" id="cmd" />
        <input type="hidden" value="1" name="confirm" />
    </form>
	</div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery("#tabs").tabs();
});
</script>