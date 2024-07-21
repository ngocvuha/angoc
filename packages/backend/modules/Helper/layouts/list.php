<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name')}}</div>
    </div>
	<div class="form-content">
        <div class="helper-bound">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="18%" class="pad-R5">
                <ul class="helper-menu"><.$i=1;.>
                    <!--LIST:menu-->
                    <.$class=Helper::check_class([[=menu.childs=]],[[=total=]],$i); $i++;.>
                    <li class="{{$class}}"{{($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.[[=menu.id=]].')"':''}}>
                        <div id="helper-[[|menu.id|]]" class="close">[[|menu.name|]]</div>
                        <!--IF:childs1([[=menu.childs=]])-->
                        <ul><.$total1=sizeof([[=menu.childs=]]); $j=1;.>
                            <!--LIST:menu.childs-->
                            <.$class=Helper::check_class([[=menu.childs.childs=]],$total1,$j); $j++;.>
                            <li class="{{$class}}"{{($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.[[=menu.childs.id=]].')"':''}}>
                                <div id="helper-[[|menu.childs.id|]]" class="close">[[|menu.childs.name|]]</div>
                                <!--IF:childs2([[=menu.childs.childs=]])-->
                                <ul><.$total2=sizeof([[=menu.childs.childs=]]); $k=1;.>
                                    <!--LIST:menu.childs.childs-->
                                    <.$class=Helper::check_class([[=menu.childs.childs.childs=]],$total2,$k); $k++;.>
                                    <li class="{{$class}}"{{($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.[[=menu.childs.childs.id=]].')"':''}}>
                                        <div id="helper-[[|menu.childs.childs.id|]]" class="close">[[|menu.childs.childs.name|]]</div>
                                        <!--IF:childs3([[=menu.childs.childs.childs=]])-->
                                        <ul><.$total3=sizeof([[=menu.childs.childs.childs=]]); $n=1;.>
                                            <!--LIST:menu.childs.childs.childs-->
                                            <.$class=Helper::check_class([[=menu.childs.childs.childs.childs=]],$total3,$n); $n++;.>
                                            <li class="{{$class}}"{{($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.[[=menu.childs.childs.childs.id=]].')"':''}}>
                                                <div id="helper-[[|menu.childs.childs.childs.id|]]" class="close">[[|menu.childs.childs.childs.name|]]</div>
                                                <!--IF:childs4([[=menu.childs.childs.childs.childs=]])-->
                                                <ul><.$total4=sizeof([[=menu.childs.childs.childs.childs=]]); $q=1;.>
                                                    <!--LIST:menu.childs.childs.childs.childs-->
                                                    <.$class=Helper::check_class([[=menu.childs.childs.childs.childs.childs=]],$total4,$q); $q++;.>
                                                    <li class="{{$class}}"{{($class=='isfile' or $class=='isfile isfile-end')?' onclick="get_helper('.[[=menu.childs.childs.childs.childs.id=]].')"':''}}>
                                                        <div id="helper-[[|menu.childs.childs.childs.childs.id|]]" class="close">[[|menu.childs.childs.childs.childs.name|]]</div>
                                                        
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
                <td width="82%"><div id="helper-content"></div></td>
            </tr>
        </table>
        </div>
</div></div>
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
function get_helper(id){
	jQuery.ajax({
		method: "POST",url: 'form.php?block_id={{Module::block_id()}}',
		data : {
			'cmd':'get_content',
			'id':id
		},
		beforeSend: function(){
			jQuery('#helper-content').html('<img src="{{Portal::template()."images/icon/lightbox-ico-loading.gif"}}" />');
		},
		success: function(content){
			jQuery('#helper-content').html(content);
		}
	});
}
</script>