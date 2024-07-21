<div class="advertisment-bound"{{Module::get_setting('extend_css')?' style="'.Module::get_setting('extend_css').'"':''}}>
    <!--LIST:items-->
    <!--IF:adv_flash([[=items.flash=]])-->
    <embed src="[[|items.image_url|]]" wmode="transparent" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="{{Module::get_setting('width')}}"></embed>
    <!--ELSE-->
    <!--IF:url(isset([[=items.url=]]) and [[=items.url=]])-->
    <a <!--IF:target([[=items.target=]])-->target="_blank" <!--/IF:target-->href="[[|items.url|]]"><img src="[[|items.image_url|]]" alt="[[|items.name|]]"{{Module::get_setting('internal_css')?' style="'.Module::get_setting('internal_css').'"':''}} /></a>
    <!--ELSE-->
    <img src="[[|items.image_url|]]" alt="[[|items.name|]]"{{Module::get_setting('internal_css')?' style="'.Module::get_setting('internal_css').'"':''}} />
    <!--/IF:url-->
    <!--/IF:adv_flash-->
    <!--/LIST:items-->
</div>