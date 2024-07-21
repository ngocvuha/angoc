jQuery(function(){
	jQuery('#SendContactUsForm').submit(function(){
		var block_id=$('block_id').value;
		return saveContact(block_id);
	});
});
function saveContact(block_id){
	var check=true;
	var check_code = check_ajax(block_id,{'cmd':'check_code','confirm_code':$('confirm_code').value});
	var email = document.getElementById('email');
	var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	__valid('name,email,confirm_code');
	if(jQuery('#name').val()==''){
		__validate('name','Hãy nhập Họ và Tên');check=false;
	}
	if(jQuery('#email').val()==''){
		__validate('email','Hãy nhập Email');check=false;
	}else if(!filter.test(email.value)){
		__validate('email','Hãy nhập chính xác định dạng Email');check=false;
	}
	if(jQuery('#confirm_code').val()==''){
		__validate('confirm_code','Xác nhận người dùng');check=false;
	}else if(check_code=='false'){
		__validate('confirm_code','Mã xác nhận người dùng không chính xác');check=false;
	}
	return check;
}
