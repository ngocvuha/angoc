<?php echo $this->map['content'];?>
<?php if((User::is_admin())){?>
<script>jQuery(function(){jQuery('#footer').click(function(){jQuery(".footer-admin").toggle();});});</script>
<div class="footer-admin" style="display:none;">
    <hr />
    <center>
    <a href="<?php echo $this->map['link_structure_page'];?>" rel="nofollow">Quản lý trang</a>
    | <a href="<?php echo Url::build('package_word');?>" rel="nofollow">Quản lý ngôn ngữ</a>
    </center>
    <?php if((User::is_admin() and (Url::get('DEBUG')==1 or Url::get('debug')==1))){?>
    <?php 
        echo '<b>'.Url::get('page').': <span style="color:#ff0000">'.$this->map['total_query'].' </span>truy vấn - thời gian tải trang: '.$this->map['page_gen_time'].'s<br><br>';
        echo $this->map['information_query_in_page'].'<br>';
    ?>
    <?php } ?>
</div>
<?php } ?>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
