jQuery(function(){
	jQuery('#myAccountForm').submit(function(){
		var block_id=$('block_id').value;
		return editAddress(block_id);
	});
	jQuery('#same_billing').click(function(){
		$('sname').value=$('bname').value;
		$('sphone').value=$('bphone').value;
		$('semail').value=$('bemail').value;
		$('saddress').value=$('baddress').value;
		$('scountry').value=$('bcountry').value;
		jQuery('#scity').html(jQuery('#bcity').html()).val($('bcity').value);
		$('scompany').value=$('bcompany').value;
		$('sfax').value=$('bfax').value;
	});
});
function editAddress(block_id){
	var check=true;
	__valid('bname,bphone,baddress,bcountry,bcity,sname,sphone,saddress,scountry,scity');
	if(jQuery('#bname').val()==''){
		__validate('bname','Hãy nhập Họ và Tên');check=false;
	}
	if(jQuery('#bphone').val()==''){
		__validate('bphone','Hãy nhập số điện thoại');check=false;
	}
	if(jQuery('#baddress').val()==''){
		__validate('baddress','Hãy nhập địa chỉ');check=false;
	}
	if(jQuery('#sname').val()==''){
		__validate('sname','Hãy nhập Họ và Tên');check=false;
	}
	if(jQuery('#sphone').val()==''){
		__validate('sphone','Hãy nhập số điện thoại');check=false;
	}
	if(jQuery('#saddress').val()==''){
		__validate('saddress','Hãy nhập địa chỉ');check=false;
	}
	return check;
}
function getCity(block_id,id,type){
	if(typeof(id)!='undefined' && id!=''){
		jQuery.ajax({
			method: "POST",url: 'form.php?block_id='+block_id,
			data : {'cmd':'getcity','id':id},
			success: function(content){
				jQuery('#'+type+'city').html(content);
			}
		});
	}
}