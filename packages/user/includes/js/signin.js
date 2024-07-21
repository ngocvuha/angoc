jQuery(function(){
	jQuery('#SignInForm').submit(function(){
		var block_id=$('block_id').value;
		return logIn(block_id);
	});
});
function logIn(block_id){
	var check=true;
	var params = {
		'user_id':$('user_id').value,
		'password':$('password').value,
		'cmd':'check_user'
	};
	var check_user = check_ajax(block_id,params);
	__valid('user_id,password');
	if(jQuery('#user_id').val()==''){
		__validate('user_id','Hãy nhập tài khoản');check=false;
	}
	if(jQuery('#password').val()==''){
		__validate('password','Hãy nhập mật khẩu');check=false;
	}
	if(check_user==2){
		__validate('user_id','Tài khoản này không tồn tại');check=false;
	}else if(check_user==3){
		__validate('password','Mật khẩu không đúng');check=false;
	}else if(check_user==4){
		__validate('user_id','Tài khoản này đã bị khóa bởi người quản trị');check=false;
	}else if(check_user==5){
		__validate('user_id','Tài khoản này chưa được kích hoạt');check=false;
	}
	return check;
}