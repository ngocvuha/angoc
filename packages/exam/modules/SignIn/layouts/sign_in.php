<div class="content">
	<div class="main vlcone">
		<div class="hotel-left">
			<div class="pay_form">
				<h2>Đăng nhập</h2>
				<form name="SignInForm" method="POST" id="SignInForm">
					<.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
					<input class="logo" name="user_id" id="user_id" type="text" value="Tên Đăng nhập" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tên Đăng nhập';}" required="">
					<input class="key" name="password" id="password" type="password" value="Mật khẩu" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mật khẩu';}" required="">
					<input type="submit" value="Đăng nhập">
					<.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
				</form>
			</div>
			<div class="clear"></div>
		</div>
		<div class="hotel-right">
			<h3>HỆ THỐNG TRỰC TUYẾN<span>HỖ TRỢ ĐÁNH GIÁ <br>TRONG GIÁO DỤC</span></h3>
		</div>
		<div class="clear"></div>
	</div>
	<p class="footer"><a target="_blank" href="http://otn.edu.vn/">{{Portal::get_setting('copyright')}}</a></p>
</div>