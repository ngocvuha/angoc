<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Cấu hình chung{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_admin())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
    <form name="AccountSettingForm" method="post" id="AccountSettingForm" enctype="multipart/form-data">
    <.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
      <div id="AccountSetting" class="mar-B10">
        <ul>
            <li><a href="#front_back_config">Cấu hình chung</a></li>
            <li><a href="#seo_config">Cấu hình SEO</a></li>
            <!--IF:cond(User::can_admin())-->
            <li><a href="#image_config">Admin</a></li>
            <!--/IF:cond-->
        </ul>
        <div id="front_back_config">
            <table width="100%" cellpadding="6" cellspacing="0" border="1" bordercolor="#E7E7E7">
                <tr class="ht">
                    <td>Tiêu đề</td>
                    <td>Giá trị</td>
                    <!--IF:can(User::is_admin())-->
                    <td>Ẩn</td>
                    <!--/IF:can-->
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="show_mark">Hiển thị điểm thi</td>
                    <td width="80%" align="left">
                    <select name="config_show_mark" class="select" id="config_show_mark"></select>
                    <script>jQuery('#config_show_mark').val(<?php echo Url::get('config_show_mark',0)?>);</script>
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_show_mark" value="1"{{Url::get('hide_show_mark')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
				<tr>
                    <td width="20%" title="default_language">[[.default_language.]]</td>
                    <td>{{[[=languages=]][[[=default_language=]]]['name']}}<!--IF:can_language(User::can_admin(MODULE_LANGUAGE,ANY_CATEGORY))--> - <a href="language.html" style="color:red;">[[.edit.]]</a><!--/IF:can_language--></td>
                    <!--IF:can(User::is_admin())-->
                    <td></td>
                    <!--/IF:can-->
                </tr>
                <!--IF:cond(User::can_admin() or !Url::get('hide_site_icon'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="site_icon">Ảnh trên thanh địa chỉ (*.icon)</td>
                    <td width="80%" align="left">
                        <input name="config_site_icon" type="file" id="site_icon" class="file" />
                        <div id="delete_site_icon"><?php if(Url::get('config_site_icon') and file_exists(Url::get('config_site_icon'))){?><img src="<?php echo Url::get('config_site_icon');?>" width="80px" />[<a href="<?php echo Url::get('config_site_icon');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','name'=>'site_icon','link'=>Url::get('config_site_icon')));?>" style="color:#FF0000">[[.delete.]]</a>]<?php }?></div>
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_site_icon" value="1"{{Url::get('hide_site_icon')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_logo'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="logo">Logo</td>
                    <td align="left">
                        <input name="config_logo" type="file" id="logo" class="file" />
                        <div id="delete_logo"><?php if(Url::get('config_logo') and file_exists(Url::get('config_logo'))){?><img src="<?php echo Url::get('config_logo');?>" width="80px" />[<a href="<?php echo Url::get('config_logo');?>" target="_blank" style="color:#FF0000">[[.view.]]</a>]&nbsp;[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','name'=>'logo','link'=>Url::get('config_logo')));?>" style="color:#FF0000">[[.delete.]]</a>]<?php }?></div>
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_logo" value="1"{{Url::get('hide_logo')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_system_email'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="system_email">Email hệ thống<br /><i style="color:#999;">Đây là Email dùng để gửi Email.<br />Vui lòng nhập một tài khoản Gmail.</i></td>
                    <td width="80%" align="left">
                        <p>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="config_system_email" type="text" id="system_email" /></p>
                        <p>Mật khẩu: <input name="config_system_email_password" type="password" id="system_email_password" /></p>
						<p>SMTP: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="config_system_email_smtp" type="text" id="system_email_smtp" />(<i>smtp.gmail.com</i>)</p>
						<p>Port: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="config_system_email_port" type="text" id="system_email_port" />(<i>465</i>)</p>
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_system_email" value="1"{{Url::get('hide_system_email')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <tr>
                    <td width="20%" align="left" valign="top" title="system_email">Email Quản trị</td>
                    <td width="80%" align="left">
                        Email
                        <input name="config_email_webmaster" type="text" id="email_webmaster" />
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_email_webmaster" value="1"{{Url::get('hide_email_webmaster')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--IF:cond(User::can_admin() or !Url::get('hide_footer_information_'.[[=default_language=]]))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="footer_information">Thông tin chân trang</td>
                    <td width="80%" align="left">
                    	<div id="tabs-footer-information">
                        	<ul>
                            <!--LIST:languages-->
                            	<li><a href="#footer-information-[[|languages.id|]]">[[|languages.name|]]</a></li>
                            <!--/LIST:languages-->
                            </ul>
                            <!--LIST:languages-->
                            <div id="footer-information-[[|languages.id|]]" class="clrfix">
                            	<textarea name="config_footer_information_[[|languages.id|]]" style="height:250px;width:100%" class="search-field" id="footer_information_[[|languages.id|]]"></textarea>
								<span class="mce-button" onclick="advance_mce('footer_information_[[|languages.id|]]');">Soạn thảo văn bản</span>
                                <!--IF:editor(Portal::get_setting('default_editor'))--><script>advance_mce('footer_information_[[|languages.id|]]');</script><!--/IF:editor-->
                            </div>
                            <!--/LIST:languages-->
                        </div>
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_footer_information_[[|default_language|]]" value="1"{{Url::get('hide_footer_information_'.[[=default_language=]])?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_received_notification_from_contact'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="received_notification_from_contact">Gửi mail tới người quản lý (Email hệ thống) khi có liên hệ</td>
                    <td width="80%" align="left">
                    <select name="config_received_notification_from_contact" class="select" id="config_received_notification_from_contact"></select>
                    <script>jQuery('#config_received_notification_from_contact').val(<?php echo Url::get('config_received_notification_from_contact',0)?>);</script>
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_received_notification_from_contact" value="1"{{Url::get('hide_received_notification_from_contact')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_web_block'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="web_block">Dừng hoạt động website</td>
                    <td width="80%" align="left">
                        <select name="config_web_block" class="select" id="config_web_block"></select>
                        <script>jQuery('#config_web_block').val(<?php echo Url::get('config_web_block',0)?>);</script>
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_web_block" value="1"{{Url::get('hide_web_block')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
				<tr>
                    <td width="20%" align="left" valign="top" title="exam_notice">Quy chế thi</td>
                    <td width="80%" align="left">
                    	<textarea name="config_exam_notice" class="search-field" id="exam_notice" style="width:100%;"></textarea>
                        <span class="mce-button" onclick="advance_mce('exam_notice');">Soạn thảo văn bản</span>
                        <!--IF:editor(Portal::get_setting('default_editor'))--><script>advance_mce('exam_notice');</script><!--/IF:editor-->
					</td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_notification_when_interrption" value="1"{{Url::get('hide_notification_when_interrption')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--IF:cond(User::can_admin() or !Url::get('hide_notification_when_interrption'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="notification_when_interrption">Thông báo website dừng hoạt động</td>
                    <td width="80%" align="left">
                    	<textarea name="config_notification_when_interrption" class="search-field" id="notification_when_interrption" style="width:100%;"></textarea>
                        <span class="mce-button" onclick="advance_mce('notification_when_interrption');">Soạn thảo văn bản</span>
                        <!--IF:editor(Portal::get_setting('default_editor'))--><script>advance_mce('notification_when_interrption');</script><!--/IF:editor-->
					</td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_notification_when_interrption" value="1"{{Url::get('hide_notification_when_interrption')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
            </table>	
        </div>
        <div id="seo_config">
            <table cellpadding="6" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7">
                <tr class="ht">
                    <td>Tiêu đề</td>
                    <td>Giá trị</td>
                    <!--IF:can(User::is_admin())-->
                    <td>Ẩn</td>
                    <!--/IF:can-->
                </tr>	
                <!--IF:cond(User::can_admin() or !Url::get('hide_website_title'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="website_title">Tiêu đề Website</td>
                    <td width="80%" align="left"><input name="config_website_title" type="text" id="website_title" class="search-field" /></td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_website_title" value="1"{{Url::get('hide_website_title')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_website_keywords'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="website_keywords">Từ khóa Website<br />(meta keyword)</td>
                    <td width="80%" align="left"><textarea name="config_website_keywords" class="search-field" id="website_keywords"></textarea><!--<script>simple_mce('website_keywords');</script>--></td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_website_keywords" value="1"{{Url::get('hide_website_keywords')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_website_description'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="website_description">Miêu tả Website<br />(meta description)</td>
                    <td width="80%" align="left"><textarea name="config_website_description" class="search-field" id="website_description"></textarea><!--<script>simple_mce('website_description');</script>--></td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_website_description" value="1"{{Url::get('hide_website_description')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_copyright'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="copyright">Copyright</td>
                    <td><input name="config_copyright" type="text" id="copyright" class="search-field" /></td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_copyright" value="1"{{Url::get('hide_copyright')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>	
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_author'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="author">Author</td>
                    <td><input name="config_author" type="text" id="author" class="search-field" /></td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_author" value="1"{{Url::get('hide_author')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>	
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_error_page_'.[[=default_language=]]))-->
                <tr>
                    <td width="20%" align="left" valign="top">Nội dung trang thông báo lỗi 404</td>
                    <td width="80%" align="left">
                    	<div id="tabs-error-page">
                        	<ul>
                            <!--LIST:languages-->
                            	<li><a href="#error-page-[[|languages.id|]]">[[|languages.name|]]</a></li>
                            <!--/LIST:languages-->
                            </ul>
                            <!--LIST:languages-->
                            <div id="error-page-[[|languages.id|]]" class="clrfix">
	                            <textarea name="config_error_page_[[|languages.id|]]" style="height:250px;width:100%;" class="search-field" id="error_page_[[|languages.id|]]"></textarea>
								<span class="mce-button" onclick="advance_mce('error_page_[[|languages.id|]]');">Soạn thảo văn bản</span>
                                <!--IF:editor(Portal::get_setting('default_editor'))--><script>advance_mce('error_page_[[|languages.id|]]');</script><!--/IF:editor-->
                            </div>
                            <!--/LIST:languages-->
                        </div>
                    </td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_error_page_[[|default_language|]]" value="1"{{Url::get('hide_error_page_'.[[=default_language=]])?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
                <!--IF:cond(User::can_admin() or !Url::get('hide_google_analytics'))-->
                <tr>
                    <td width="20%" align="left" valign="top" title="google_analytics">Google analytics</td>
                    <td width="80%" align="left"><textarea name="config_google_analytics" class="search-field" id="google_analytics"></textarea></td>
                    <!--IF:can(User::is_admin())-->
                    <td><input type="checkbox" name="hide_google_analytics" value="1"{{Url::get('hide_google_analytics')?' checked':''}} /></td>
                    <!--/IF:can-->
                </tr>
                <!--/IF:cond-->
            </table>	
        </div>
        <!--IF:cond(User::can_admin())-->
        <div id="image_config">
            <table cellpadding="6" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7">
                <tr class="ht">
                    <td>Tiêu đề</td>
                    <td>Giá trị</td>
                </tr>	
                <tr>
                    <td width="20%" align="left" valign="top" title="templates_frontend">Mẫu giao diện người dùng</td>
                    <td width="80%" align="left"><select name="config_templates_frontend" id="config_templates_frontend"></select> {{Url::get('config_templates_frontend')?Url::get('config_templates_frontend'):'templates/frontend_default/'}}</td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="config_templates_admin">Mẫu giao diện quản trị</td>
                    <td width="80%" align="left"><select name="config_templates_admin" id="config_templates_admin"></select> {{Url::get('config_templates_admin')?Url::get('config_templates_admin'):'templates/admin_default/'}}</td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="default_editor">Trình soạn thảo văn bản</td>
                    <td width="80%" align="left"><select name="config_default_editor" id="config_default_editor"></select><script>jQuery('#config_default_editor').val(<?php echo Url::get('config_default_editor',0)?>);</script></td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="use_cache">Sửa dụng cache</td>
                    <td width="80%" align="left"><select name="config_use_cache" id="config_use_cache"></select><script>jQuery('#config_use_cache').val(<?php echo Url::get('config_use_cache',0)?>);</script></td>
                </tr>
                <tr>
                    <td width="20%" align="left" valign="top" title="website_keywords">Cấu hình cho tin tức</td>
                    <td width="80%" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
	                            <td width="1%" nowrap="nowrap"><label>Dung lượng ảnh tối đa: </label></td>
                                <td><input name="config_max_file_size_news" type="text" id="config_max_file_size_news" style="text-align:right;" /><i style="color:#999;"> Tính theo bit. VD: 2*1024*1024 tương đương 2Mb</i></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label>Loại file được phép upload: </label></td>
                            	<td><input name="config_filetype_news" type="text" id="config_filetype_news" style="text-align:right;" /><i style="color:#999;"> Mỗi loại cách nhau bởi dấu "|". VD: png|jpg|gif</i></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label for="config_news_thumb_auto">Tự động sinh ảnh thumbnail: </label></td>
                            	<td><select name="config_news_thumb_auto" id="config_news_thumb_auto"></select></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label for="config_news_thumb_width">Kích thước ảnh thumbnail: </label></td>
                            	<td><input name="config_news_thumb_width" type="text" id="config_news_thumb_width" style="text-align:right;" /> x <input name="config_news_thumb_height" type="text" id="config_news_thumb_height" style="text-align:right;" /> px</td>
                            </tr>
                            <tr>
                                <td width="20%" align="left" valign="top" title="news_comment_type">Bình luận</td>
                                <td width="80%" align="left"><select name="config_news_comment_type" id="config_news_comment_type"></select><script>jQuery('#config_news_comment_type').val(<?php echo Url::get('config_news_comment_type',0)?>);</script></td>
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
                                <td><input name="config_max_file_size_photo" type="text" id="config_max_file_size_photo" style="text-align:right;" /><i style="color:#999;"> Tính theo bit. VD: 2*1024*1024 tương đương 2Mb</i></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label>Loại file được phép: </label></td>
                            	<td><input name="config_filetype_photo" type="text" id="config_filetype_photo" style="text-align:right;" /><i style="color:#999;"> Mỗi loại cách nhau bởi dấu "|". VD: png|jpg|gif</i></td>
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
                                <td><input name="config_max_file_size_media" type="text" id="config_max_file_size_media" style="text-align:right;" /><i style="color:#999;"> Tính theo bit. VD: 2*1024*1024 tương đương 2Mb</i></td>
                            </tr>
                            <tr>
                            	<td width="1%" nowrap="nowrap"><label>Loại file được phép: </label></td>
                            	<td><input name="config_filetype_media" type="text" id="config_filetype_media" style="text-align:right;" /><i style="color:#999;"> Mỗi loại cách nhau bởi dấu "|". VD: png|jpg|gif</i></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>	
        </div>
        <!--/IF:cond-->
    </div>
    <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
    </form>	
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
