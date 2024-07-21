<div class="header"><img src="{{Portal::get_setting('logo')}}" /></div>
<div class="menutop-bound">
	<ul class="clrfix">
    	<!--LIST:items-->
        <li>
        	<a href="{{[[=items.url=]]}}" class="{{[[=items.childs=]]?'have-child':''}}{{[[=items.structure_id=]]==Url::get('active_structure_id')?' active':''}}">[[|items.name|]]</a>
            <!--IF:childs_1([[=items.childs=]])-->
            <ul>
	            <!--LIST:items.childs-->
            	<li>
                	<a href="{{[[=items.childs.url=]]}}"{{[[=items.childs.childs=]]?' class="have-child"':''}}>[[|items.childs.name|]]</a>
                    <!--IF:childs_2([[=items.childs.childs=]])-->
                    <ul>
                        <!--LIST:items.childs.childs-->
                        <li>
                            <a href="{{[[=items.childs.childs.url=]]}}"{{[[=items.childs.childs.childs=]]?' class="have-child"':''}}>[[|items.childs.childs.name|]]</a>
                            <!--IF:childs_3([[=items.childs.childs.childs=]])-->
                            <ul>
                                <!--LIST:items.childs.childs.childs-->
                                <li>
                                    <a href="{{[[=items.childs.childs.childs.url=]]}}"{{[[=items.childs.childs.childs.childs=]]?' class="have-child"':''}}>[[|items.childs.childs.childs.name|]]</a>
                                    <!--IF:childs_4([[=items.childs.childs.childs.childs=]])-->
                                    <ul>
                                        <!--LIST:items.childs.childs.childs.childs-->
                                        <li>
                                            <a href="{{[[=items.childs.childs.childs.childs.url=]]}}"{{[[=items.childs.childs.childs.childs.childs=]]?' class="have-child"':''}}>[[|items.childs.childs.childs.childs.name|]]</a>
                                            <!--IF:childs_5([[=items.childs.childs.childs.childs.childs=]])-->
                                            <ul>
                                                <!--LIST:items.childs.childs.childs.childs.childs-->
                                                <li>
                                                    <a href="{{[[=items.childs.childs.childs.childs.childs.url=]]}}"{{[[=items.childs.childs.childs.childs.childs.childs=]]?' class="have-child"':''}}>[[|items.childs.childs.childs.childs.childs.name|]]</a>
                                                    <!--IF:childs_6([[=items.childs.childs.childs.childs.childs.childs=]])-->
                                                    <ul>
                                                        <!--LIST:items.childs.childs.childs.childs.childs.childs-->
                                                        <li>
                                                        	<a href="{{[[=items.childs.childs.childs.childs.childs.childs.url=]]}}">[[|items.childs.childs.childs.childs.childs.childs.name|]]</a>
                                                        </li>
                                                        <!--/LIST:items.childs.childs.childs.childs.childs.childs-->
                                                    </ul>
                                                    <!--/IF:childs_6-->
                                                </li>
                                                <!--/LIST:items.childs.childs.childs.childs.childs-->
                                            </ul>
                                            <!--/IF:childs_5-->
                                        </li>
                                        <!--/LIST:items.childs.childs.childs.childs-->
                                    </ul>
                                    <!--/IF:childs_4-->
                                </li>
                                <!--/LIST:items.childs.childs.childs-->
                            </ul>
                            <!--/IF:childs_3-->
                        </li>
                        <!--/LIST:items.childs.childs-->
                    </ul>
                    <!--/IF:childs_2-->
                </li>
    	        <!--/LIST:items.childs-->
            </ul>
            <!--/IF:childs_1-->
        </li>
    	<!--/LIST:items-->
    	<li class="menutop-link-extra">
            <span>Xin chào : </span><b>{{User::id()}}</b><span> | </span>
            <a style="color:#000;" href="{{Url::build('change_password')}}">Đổi mật khẩu</a><span>|</span>
            <a style="color:#000;" href="{{Url::build('helper')}}">Trợ giúp</a><span>|</span>
            <a style="color:#000;" href="{{Url::build('sign_out')}}">Thoát</a>
        </li>
    </ul>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery('.menutop-bound li').hover(
		function(){
			jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show();
		},function(){
			jQuery(this).find('ul:first').css({visibility: "hidden"});
		}
	);
	jQuery('a.have-child').attr('href','javascript:void(0)');
});
</script>