<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Cấu hình chung<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_admin())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
    <form name="AccountSettingForm" method="post" id="AccountSettingForm" enctype="multipart/form-data">
    <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
      <div id="AccountSetting" class="mar-B10">
        <ul>
            <li><a href="#front_back_config">Cấu hình chung</a></li>
            <li><a href="#seo_config">Cấu hình SEO</a></li>
            <?php if((User::can_admin())){?>
            <li><a href="#image_config">Admin</a></li>
            <?php } ?>
        </ul>
        <div id="front_back_config">
            <table width="100%" cellpadding="6" cellspacing="0" border="1" bordercolor="#E7E7E7">
                <tr class="ht">
                    <td>Tiêu đề</td>
                    <td>Giá trị</td>
                    <?php if((User::is_admin())){?>
                    <td>Ẩn</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="show_mark">Hiển thị điểm thi</td>
                    <td width="80%" align="left">
                    <select  name="config_show_mark" class="select" id="config_show_mark"><?php
					if(isset($this->map['config_show_mark_list']))
					{
						foreach($this->map['config_show_mark_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_show_mark').value = "<?php echo addslashes(URL::get('config_show_mark',isset($this->map['config_show_mark'])?$this->map['config_show_mark']:''));?>";</script>
                    <script>jQuery('#config_show_mark').val(<?php echo Url::get('config_show_mark',0)?>);</script>
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_show_mark" value="1"<?php echo Url::get('hide_show_mark')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
				<tr>
                    <td width="20%" title="default_language"><?php echo Portal::language('default_language');?></td>
                    <td><?php echo $this->map['languages'][$this->map['default_language']]['name'];?><?php if((User::can_admin(MODULE_LANGUAGE,ANY_CATEGORY))){?> - <a href="language.html" style="color:red;"><?php echo Portal::language('edit');?></a><?php } ?></td>
                    <?php if((User::is_admin())){?>
                    <td></td>
                    <?php } ?>
                </tr>
                <?php if((User::can_admin() or !Url::get('hide_site_icon'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="site_icon">Ảnh trên thanh địa chỉ (*.icon)</td>
                    <td width="80%" align="left">
                        <input  name="config_site_icon" id="site_icon" class="file" / type ="file" value="<?php echo String::html_normalize(URL::get('config_site_icon'));?>">
                        <div id="delete_site_icon"><?php if(Url::get('config_site_icon') and file_exists(Url::get('config_site_icon'))){?><img src="<?php echo Url::get('config_site_icon');?>" width="80px" />[<a href="<?php echo Url::get('config_site_icon');?>" target="_blank" style="color:#FF0000"><?php echo Portal::language('view');?></a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','name'=>'site_icon','link'=>Url::get('config_site_icon')));?>" style="color:#FF0000"><?php echo Portal::language('delete');?></a>]<?php }?></div>
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_site_icon" value="1"<?php echo Url::get('hide_site_icon')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_logo'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="logo">Logo</td>
                    <td align="left">
                        <input  name="config_logo" id="logo" class="file" / type ="file" value="<?php echo String::html_normalize(URL::get('config_logo'));?>">
                        <div id="delete_logo"><?php if(Url::get('config_logo') and file_exists(Url::get('config_logo'))){?><img src="<?php echo Url::get('config_logo');?>" width="80px" />[<a href="<?php echo Url::get('config_logo');?>" target="_blank" style="color:#FF0000"><?php echo Portal::language('view');?></a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','name'=>'logo','link'=>Url::get('config_logo')));?>" style="color:#FF0000"><?php echo Portal::language('delete');?></a>]<?php }?></div>
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_logo" value="1"<?php echo Url::get('hide_logo')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_system_email'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="system_email">Email hệ thống<br /><i style="color:#999;">Đây là Email dùng để gửi Email.<br />Vui lòng nhập một tài khoản Gmail.</i></td>
                    <td width="80%" align="left">
                        <p>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name="config_system_email" id="system_email" / type ="text" value="<?php echo String::html_normalize(URL::get('config_system_email'));?>"></p>
                        <p>Mật khẩu: <input  name="config_system_email_password" id="system_email_password" / type ="password" value="<?php echo String::html_normalize(URL::get('config_system_email_password'));?>"></p>
						<p>SMTP: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name="config_system_email_smtp" id="system_email_smtp" / type ="text" value="<?php echo String::html_normalize(URL::get('config_system_email_smtp'));?>">(<i>smtp.gmail.com</i>)</p>
						<p>Port: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name="config_system_email_port" id="system_email_port" / type ="text" value="<?php echo String::html_normalize(URL::get('config_system_email_port'));?>">(<i>465</i>)</p>
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_system_email" value="1"<?php echo Url::get('hide_system_email')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <tr>
                    <td width="20%" align="left" valign="top" title="system_email">Email Quản trị</td>
                    <td width="80%" align="left">
                        Email
                        <input  name="config_email_webmaster" id="email_webmaster" / type ="text" value="<?php echo String::html_normalize(URL::get('config_email_webmaster'));?>">
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_email_webmaster" value="1"<?php echo Url::get('hide_email_webmaster')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php if((User::can_admin() or !Url::get('hide_footer_information_'.$this->map['default_language']))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="footer_information">Thông tin chân trang</td>
                    <td width="80%" align="left">
                    	<div id="tabs-footer-information">
                        	<ul>
                            <?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key1=>&$item1){ if($key1!='current'){$this->map['languages']['current'] = &$item1;?>
                            	<li><a href="#footer-information-<?php echo $this->map['languages']['current']['id'];?>"><?php echo $this->map['languages']['current']['name'];?></a></li>
                            <?php }}unset($this->map['languages']['current']);} ?>
                            </ul>
                            <?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key2=>&$item2){ if($key2!='current'){$this->map['languages']['current'] = &$item2;?>
                            <div id="footer-information-<?php echo $this->map['languages']['current']['id'];?>" class="clrfix">
                            	<textarea  name="config_footer_information_<?php echo $this->map['languages']['current']['id'];?>" style="height:250px;width:100%" class="search-field" id="footer_information_<?php echo $this->map['languages']['current']['id'];?>"><?php echo String::html_normalize(URL::get('config_footer_information_'.$this->map['languages']['current']['id'],''));?></textarea>
								<span class="mce-button" onclick="advance_mce('footer_information_<?php echo $this->map['languages']['current']['id'];?>');">Soạn thảo văn bản</span>
                                <?php if((Portal::get_setting('default_editor'))){?><script>advance_mce('footer_information_<?php echo $this->map['languages']['current']['id'];?>');</script><?php } ?>
                            </div>
                            <?php }}unset($this->map['languages']['current']);} ?>
                        </div>
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_footer_information_<?php echo $this->map['default_language'];?>" value="1"<?php echo Url::get('hide_footer_information_'.$this->map['default_language'])?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_received_notification_from_contact'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="received_notification_from_contact">Gửi mail tới người quản lý (Email hệ thống) khi có liên hệ</td>
                    <td width="80%" align="left">
                    <select  name="config_received_notification_from_contact" class="select" id="config_received_notification_from_contact"><?php
					if(isset($this->map['config_received_notification_from_contact_list']))
					{
						foreach($this->map['config_received_notification_from_contact_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_received_notification_from_contact').value = "<?php echo addslashes(URL::get('config_received_notification_from_contact',isset($this->map['config_received_notification_from_contact'])?$this->map['config_received_notification_from_contact']:''));?>";</script>
                    <script>jQuery('#config_received_notification_from_contact').val(<?php echo Url::get('config_received_notification_from_contact',0)?>);</script>
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_received_notification_from_contact" value="1"<?php echo Url::get('hide_received_notification_from_contact')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_web_block'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="web_block">Dừng hoạt động website</td>
                    <td width="80%" align="left">
                        <select  name="config_web_block" class="select" id="config_web_block"><?php
					if(isset($this->map['config_web_block_list']))
					{
						foreach($this->map['config_web_block_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_web_block').value = "<?php echo addslashes(URL::get('config_web_block',isset($this->map['config_web_block'])?$this->map['config_web_block']:''));?>";</script>
                        <script>jQuery('#config_web_block').val(<?php echo Url::get('config_web_block',0)?>);</script>
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_web_block" value="1"<?php echo Url::get('hide_web_block')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
				<tr>
                    <td width="20%" align="left" valign="top" title="exam_notice">Quy chế thi</td>
                    <td width="80%" align="left">
                    	<textarea  name="config_exam_notice" class="search-field" id="exam_notice" style="width:100%;"><?php echo String::html_normalize(URL::get('config_exam_notice',''));?></textarea>
                        <span class="mce-button" onclick="advance_mce('exam_notice');">Soạn thảo văn bản</span>
                        <?php if((Portal::get_setting('default_editor'))){?><script>advance_mce('exam_notice');</script><?php } ?>
					</td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_notification_when_interrption" value="1"<?php echo Url::get('hide_notification_when_interrption')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php if((User::can_admin() or !Url::get('hide_notification_when_interrption'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="notification_when_interrption">Thông báo website dừng hoạt động</td>
                    <td width="80%" align="left">
                    	<textarea  name="config_notification_when_interrption" class="search-field" id="notification_when_interrption" style="width:100%;"><?php echo String::html_normalize(URL::get('config_notification_when_interrption',''));?></textarea>
                        <span class="mce-button" onclick="advance_mce('notification_when_interrption');">Soạn thảo văn bản</span>
                        <?php if((Portal::get_setting('default_editor'))){?><script>advance_mce('notification_when_interrption');</script><?php } ?>
					</td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_notification_when_interrption" value="1"<?php echo Url::get('hide_notification_when_interrption')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </table>	
        </div>
        <div id="seo_config">
            <table cellpadding="6" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7">
                <tr class="ht">
                    <td>Tiêu đề</td>
                    <td>Giá trị</td>
                    <?php if((User::is_admin())){?>
                    <td>Ẩn</td>
                    <?php } ?>
                </tr>	
                <?php if((User::can_admin() or !Url::get('hide_website_title'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="website_title">Tiêu đề Website</td>
                    <td width="80%" align="left"><input  name="config_website_title" id="website_title" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('config_website_title'));?>"></td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_website_title" value="1"<?php echo Url::get('hide_website_title')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_website_keywords'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="website_keywords">Từ khóa Website<br />(meta keyword)</td>
                    <td width="80%" align="left"><textarea  name="config_website_keywords" class="search-field" id="website_keywords"><?php echo String::html_normalize(URL::get('config_website_keywords',''));?></textarea><!--<script>simple_mce('website_keywords');</script>--></td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_website_keywords" value="1"<?php echo Url::get('hide_website_keywords')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_website_description'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="website_description">Miêu tả Website<br />(meta description)</td>
                    <td width="80%" align="left"><textarea  name="config_website_description" class="search-field" id="website_description"><?php echo String::html_normalize(URL::get('config_website_description',''));?></textarea><!--<script>simple_mce('website_description');</script>--></td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_website_description" value="1"<?php echo Url::get('hide_website_description')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_copyright'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="copyright">Copyright</td>
                    <td><input  name="config_copyright" id="copyright" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('config_copyright'));?>"></td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_copyright" value="1"<?php echo Url::get('hide_copyright')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>	
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_author'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="author">Author</td>
                    <td><input  name="config_author" id="author" class="search-field" / type ="text" value="<?php echo String::html_normalize(URL::get('config_author'));?>"></td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_author" value="1"<?php echo Url::get('hide_author')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>	
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_error_page_'.$this->map['default_language']))){?>
                <tr>
                    <td width="20%" align="left" valign="top">Nội dung trang thông báo lỗi 404</td>
                    <td width="80%" align="left">
                    	<div id="tabs-error-page">
                        	<ul>
                            <?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key3=>&$item3){ if($key3!='current'){$this->map['languages']['current'] = &$item3;?>
                            	<li><a href="#error-page-<?php echo $this->map['languages']['current']['id'];?>"><?php echo $this->map['languages']['current']['name'];?></a></li>
                            <?php }}unset($this->map['languages']['current']);} ?>
                            </ul>
                            <?php if(isset($this->map['languages']) and is_array($this->map['languages'])){ foreach($this->map['languages'] as $key4=>&$item4){ if($key4!='current'){$this->map['languages']['current'] = &$item4;?>
                            <div id="error-page-<?php echo $this->map['languages']['current']['id'];?>" class="clrfix">
	                            <textarea  name="config_error_page_<?php echo $this->map['languages']['current']['id'];?>" style="height:250px;width:100%;" class="search-field" id="error_page_<?php echo $this->map['languages']['current']['id'];?>"><?php echo String::html_normalize(URL::get('config_error_page_'.$this->map['languages']['current']['id'],''));?></textarea>
								<span class="mce-button" onclick="advance_mce('error_page_<?php echo $this->map['languages']['current']['id'];?>');">Soạn thảo văn bản</span>
                                <?php if((Portal::get_setting('default_editor'))){?><script>advance_mce('error_page_<?php echo $this->map['languages']['current']['id'];?>');</script><?php } ?>
                            </div>
                            <?php }}unset($this->map['languages']['current']);} ?>
                        </div>
                    </td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_error_page_<?php echo $this->map['default_language'];?>" value="1"<?php echo Url::get('hide_error_page_'.$this->map['default_language'])?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php if((User::can_admin() or !Url::get('hide_google_analytics'))){?>
                <tr>
                    <td width="20%" align="left" valign="top" title="google_analytics">Google analytics</td>
                    <td width="80%" align="left"><textarea  name="config_google_analytics" class="search-field" id="google_analytics"><?php echo String::html_normalize(URL::get('config_google_analytics',''));?></textarea></td>
                    <?php if((User::is_admin())){?>
                    <td><input type="checkbox" name="hide_google_analytics" value="1"<?php echo Url::get('hide_google_analytics')?' checked':'';?> /></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </table>	
        </div>
        <?php if((User::can_admin())){?>
        <div id="image_config">
            <table cellpadding="6" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7">
                <tr class="ht">
                    <td>Tiêu đề</td>
                    <td>Giá trị</td>
                </tr>	
                <tr>
                    <td width="20%" align="left" valign="top" title="templates_frontend">Mẫu giao diện người dùng</td>
                    <td width="80%" align="left"><select  name="config_templates_frontend" id="config_templates_frontend"><?php
					if(isset($this->map['config_templates_frontend_list']))
					{
						foreach($this->map['config_templates_frontend_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_templates_frontend').value = "<?php echo addslashes(URL::get('config_templates_frontend',isset($this->map['config_templates_frontend'])?$this->map['config_templates_frontend']:''));?>";</script> <?php echo Url::get('config_templates_frontend')?Url::get('config_templates_frontend'):'templates/frontend_default/';?></td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="config_templates_admin">Mẫu giao diện quản trị</td>
                    <td width="80%" align="left"><select  name="config_templates_admin" id="config_templates_admin"><?php
					if(isset($this->map['config_templates_admin_list']))
					{
						foreach($this->map['config_templates_admin_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_templates_admin').value = "<?php echo addslashes(URL::get('config_templates_admin',isset($this->map['config_templates_admin'])?$this->map['config_templates_admin']:''));?>";</script> <?php echo Url::get('config_templates_admin')?Url::get('config_templates_admin'):'templates/admin_default/';?></td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="default_editor">Trình soạn thảo văn bản</td>
                    <td width="80%" align="left"><select  name="config_default_editor" id="config_default_editor"><?php
					if(isset($this->map['config_default_editor_list']))
					{
						foreach($this->map['config_default_editor_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_default_editor').value = "<?php echo addslashes(URL::get('config_default_editor',isset($this->map['config_default_editor'])?$this->map['config_default_editor']:''));?>";</script><script>jQuery('#config_default_editor').val(<?php echo Url::get('config_default_editor',0)?>);</script></td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="use_cache">Sửa dụng cache</td>
                    <td width="80%" align="left"><select  name="config_use_cache" id="config_use_cache"><?php
					if(isset($this->map['config_use_cache_list']))
					{
						foreach($this->map['config_use_cache_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_use_cache').value = "<?php echo addslashes(URL::get('config_use_cache',isset($this->map['config_use_cache'])?$this->map['config_use_cache']:''));?>";</script><script>jQuery('#config_use_cache').val(<?php echo Url::get('config_use_cache',0)?>);</script></td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="website_keywords">Cấu hình cho tin tức</td>
                    <td width="80%" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
	                            <td width="1%" nowrap="nowrap"><label>Dung lượng ảnh tối đa: </label></td>
                                <td><input  name="config_max_file_size_news" id="config_max_file_size_news" style="text-align:right;" / type ="text" value="<?php echo String::html_normalize(URL::get('config_max_file_size_news'));?>"><i style="color:#999;"> Tính theo bit. VD: 2*1024*1024 tương đương 2Mb</i></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label>Loại file được phép upload: </label></td>
                            	<td><input  name="config_filetype_news" id="config_filetype_news" style="text-align:right;" / type ="text" value="<?php echo String::html_normalize(URL::get('config_filetype_news'));?>"><i style="color:#999;"> Mỗi loại cách nhau bởi dấu "|". VD: png|jpg|gif</i></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label for="config_news_thumb_auto">Tự động sinh ảnh thumbnail: </label></td>
                            	<td><select  name="config_news_thumb_auto" id="config_news_thumb_auto"><?php
					if(isset($this->map['config_news_thumb_auto_list']))
					{
						foreach($this->map['config_news_thumb_auto_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_news_thumb_auto').value = "<?php echo addslashes(URL::get('config_news_thumb_auto',isset($this->map['config_news_thumb_auto'])?$this->map['config_news_thumb_auto']:''));?>";</script></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label for="config_news_thumb_width">Kích thước ảnh thumbnail: </label></td>
                            	<td><input  name="config_news_thumb_width" id="config_news_thumb_width" style="text-align:right;" / type ="text" value="<?php echo String::html_normalize(URL::get('config_news_thumb_width'));?>"> x <input  name="config_news_thumb_height" id="config_news_thumb_height" style="text-align:right;" / type ="text" value="<?php echo String::html_normalize(URL::get('config_news_thumb_height'));?>"> px</td>
                            </tr>
                            <tr>
                                <td width="20%" align="left" valign="top" title="news_comment_type">Bình luận</td>
                                <td width="80%" align="left"><select  name="config_news_comment_type" id="config_news_comment_type"><?php
					if(isset($this->map['config_news_comment_type_list']))
					{
						foreach($this->map['config_news_comment_type_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('config_news_comment_type').value = "<?php echo addslashes(URL::get('config_news_comment_type',isset($this->map['config_news_comment_type'])?$this->map['config_news_comment_type']:''));?>";</script><script>jQuery('#config_news_comment_type').val(<?php echo Url::get('config_news_comment_type',0)?>);</script></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="website_keywords">Cấu hình upload file cho thư viện ảnh</td>
                    <td width="80%" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
	                            <td width="1%" nowrap="nowrap"><label>Dung lượng tối đa: </label></td>
                                <td><input  name="config_max_file_size_photo" id="config_max_file_size_photo" style="text-align:right;" / type ="text" value="<?php echo String::html_normalize(URL::get('config_max_file_size_photo'));?>"><i style="color:#999;"> Tính theo bit. VD: 2*1024*1024 tương đương 2Mb</i></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label>Loại file được phép: </label></td>
                            	<td><input  name="config_filetype_photo" id="config_filetype_photo" style="text-align:right;" / type ="text" value="<?php echo String::html_normalize(URL::get('config_filetype_photo'));?>"><i style="color:#999;"> Mỗi loại cách nhau bởi dấu "|". VD: png|jpg|gif</i></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="website_keywords">Cấu hình upload file cho Media</td>
                    <td width="80%" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
	                            <td width="1%" nowrap="nowrap"><label>Dung lượng tối đa: </label></td>
                                <td><input  name="config_max_file_size_media" id="config_max_file_size_media" style="text-align:right;" / type ="text" value="<?php echo String::html_normalize(URL::get('config_max_file_size_media'));?>"><i style="color:#999;"> Tính theo bit. VD: 2*1024*1024 tương đương 2Mb</i></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label>Loại file được phép: </label></td>
                            	<td><input  name="config_filetype_media" id="config_filetype_media" style="text-align:right;" / type ="text" value="<?php echo String::html_normalize(URL::get('config_filetype_media'));?>"><i style="color:#999;"> Mỗi loại cách nhau bởi dấu "|". VD: png|jpg|gif</i></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>	
        </div>
        <?php } ?>
    </div>
    <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >	
    </div>
</div>
<script type="text/javascript">
jQuery(function() {
	jQuery('#AccountSetting').tabs();
	jQuery('#tabs-contact-information').tabs();
	jQuery('#tabs-footer-information').tabs();
	jQuery('#tabs-error-page').tabs();
});
</script>
