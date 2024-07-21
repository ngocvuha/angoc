[[|content|]]
<!--IF:can(User::is_admin())-->
<script>jQuery(function(){jQuery('#footer').click(function(){jQuery(".footer-admin").toggle();});});</script>
<div class="footer-admin" style="display:none;">
    <hr />
    <center>
    <a href="[[|link_structure_page|]]" rel="nofollow">Quản lý trang</a>
    | <a href="{{Url::build('package_word')}}" rel="nofollow">Quản lý ngôn ngữ</a>
    </center>
    <!--IF:cond(User::is_admin() and (Url::get('DEBUG')==1 or Url::get('debug')==1))-->
    <.
        echo '<b>'.Url::get('page').': <span style="color:#ff0000">'.[[=total_query=]].' </span>truy vấn - thời gian tải trang: '.[[=page_gen_time=]].'s<br><br>';
        echo [[=information_query_in_page=]].'<br>';
    .>
    <!--/IF:cond-->
</div>
<!--/IF:can-->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
