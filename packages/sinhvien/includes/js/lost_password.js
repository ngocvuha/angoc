jQuery(function(){
	jQuery('#lostPasswordForm').submit(function(){
		var block_id=$('block_id').value;
		return lostPassword(block_id);
	});
});
function lostPassword(block_id){
	var check=true;
	var check_email = check_ajax(block_id,{'cmd':'check_email','email':$('email').value});
	var check_code = check_ajax(block_id,{'cmd':'check_code','confirm_code':$('confirm_code').value});
	var email = document.getElementById('email');
	var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	__valid('email,confirm_code');
	// check email
	if(jQuery('#email').val()==''){
		__validate('email','Hãy nhập Email');check=false;
	}else if(!filter.test(email.value)){
		__validate('email','Sai định dạng Email');check=false;
	}else if(check_email=='2'){
		__validate('email','Email không tồn tại');check=false;
	}else if(check_email=='3'){
		__validate('email','Tài khoản chưa kích hoạt');check=false;
	}else if(check_email=='4'){
		__validate('email','Tài khoản bị khóa');check=false;
	}
	// check confirm code
	if(jQuery('#confirm_code').val()==''){
		__validate('confirm_code','Hãy xác nhận người dùng');check=false;
	}else if(check_code=='false'){
		__validate('confirm_code','Mã xác nhận người dùng không đúng');check=false;
	}
	return check;
}