<div class="frame-default-bound" <?php if(Module::get_setting('extra_css_bound')){ echo 'style="'.Module::get_setting('extra_css_bound').'"'; }?> >
    <div class="frame-default-title">
        <?php if($icon = Module::get_setting('frame_icon_title') and file_exists($icon)){?><span class="frame-default-icon"><img src="<?php echo $icon;?>" /></span><?php }?>
        <?php if(Module::get_setting('frame_title_link')){?>
            <a href="<?php echo Module::get_setting('frame_title_link');?>" class="frame-title-link">{{-title-}}</a>
        <?php }else{ ?>
            {{-title-}}
        <?php }?>
        <?php if(Module::get_setting('frame_title_view_all') and Module::get_setting('frame_title_view_all_link')){?>
        <span class="frame-default-view-all"><a href="<?php echo Module::get_setting('frame_title_view_all_link');?>"><?php echo Portal::language('view_all');?> &raquo;</a></span>
        <?php }?>
    </div>
    <div class="frame-default-content">{{-content-}}</div>
</div>