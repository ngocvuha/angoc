jQuery(function(){
	jQuery('#myAccountForm').submit(function(){
		var block_id=$('block_id').value;
		if(jQuery('#change_password').parent().find('input').is(':checked')) {
			var change_password=1;
		}else{
			var change_password=0;
		}
		return editAccount(block_id,change_password);
	});
	jQuery('#change_password').click(function(){
		if(jQuery(this).parent().find('input').is(':checked')) {
			jQuery('#change_password_form').show();
			jQuery('#new_password').focus();
		}else{
			jQuery('#change_password_form').hide();
		}
	});
});
function editAccount(block_id,change_password){
	var check=true;
	var check_email = check_ajax(block_id,{'email':$('email').value,'cmd':'check_email'});
	var email = document.getElementById('email');
	var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	__valid('full_name,email,new_password,retype_new_password');
	if(jQuery('#full_name').val()==''){
		__validate('full_name','Hãy nhập Họ và Tên');check=false;
	}
	if(jQuery('#email').val()==''){
		__validate('email','Hãy nhập Email');check=false;
	}else if(!filter.test(email.value)){
		__validate('email','Hãy nhập chính xác định dạng Email');check=false;
	}else if(check_email=='true'){
		__validate('email','Email này đã tồn tại trong hệ thống');check=false;
	}
	if(change_password && jQuery('#new_password').val()==''){
		__validate('new_password','Hãy nhập Mật khẩu mới');check=false;
	}
	if(change_password && jQuery('#retype_new_password').val()==''){
		__validate('retype_new_password','Hãy nhập chính xác mật khẩu mới');check=false;
	}
	return check;
}
