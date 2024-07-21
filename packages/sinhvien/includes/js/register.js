jQuery(function(){
	jQuery("#account").keypress(function (e){
		// chỉ cho phép nhập [a-zA-Z_-]
		if( e.which!=8 && e.which!=0 && e.which!=13 && e.which!=45 && e.which!=95 && !(e.which>=48 && e.which<=57) && !(e.which>=65 && e.which<=90) && !(e.which>=97 && e.which<=122)) return false;
	});
	jQuery('#RegisterForm').submit(function(){
		var block_id=$('block_id').value;
		return registerUser(block_id);
	});
});
function registerUser(block_id){
	var check=true;
	var check_account = check_ajax(block_id,{'cmd':'check_account','account':$('account').value});
	var check_email = check_ajax(block_id,{'cmd':'check_email','email':$('email').value});
	var check_code = check_ajax(block_id,{'cmd':'check_code','confirm_code':$('confirm_code').value});
	var email = document.getElementById('email');
	var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	__valid('account,r_password,retype_password,full_name,email,confirm_code');
	// check account
	if(jQuery('#account').val()==''){
		__validate('account','Hãy nhập tên tài khoản');check=false;
	}else if(check_account=='true'){
		__validate('account','Tài khoản này đã được đăng ký. Vui lòng chọn tài khoản khác');check=false;
	}
	// check password
	if(jQuery('#r_password').val()==''){
		__validate('r_password','Hãy nhập mật khẩu');check=false;
	}else if((jQuery('#r_password').val()).length<6){
		__validate('r_password','Hãy nhập mật khẩu lớn hơn 6 ký tự');check=false;
	}
	// check retype password
	if(jQuery('#retype_password').val()==''){
		__validate('retype_password','Hãy xác nhận mật khẩu');check=false;
	}else if(jQuery('#retype_password').val()!=jQuery('#r_password').val()){
		__validate('retype_password','Hãy nhập giống mật khẩu');check=false;
	}
	// check full name
	if(jQuery('#full_name').val()==''){
		__validate('full_name','Hãy nhập họ và tên');check=false;
	}
	// check email
	if(jQuery('#email').val()==''){
		__validate('email','Hãy nhập Email');check=false;
	}else if(!filter.test(email.value)){
		__validate('email','Sai định dạng Email');check=false;
	}else if(check_email=='true'){
		__validate('email','Email này đã được đăng ký. Vui lòng nhập Email khác.');check=false;
	}
	// check confirm code
	if(jQuery('#confirm_code').val()==''){
		__validate('confirm_code','Hãy xác nhận người dùng');check=false;
	}else if(check_code=='false'){
		__validate('confirm_code','Mã xác nhận người dùng không đúng');check=false;
	}
	return check;
}