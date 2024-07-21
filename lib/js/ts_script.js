jQuery(document).ready(function () {
     /**begin map he thong dai ly*/
    jQuery(".view_map").bind("click",function(){

        view_id = jQuery(this).attr("data-id");

        jQuery(".show_view_map_"+view_id).animate({right:"0px"},600);

    });

    jQuery(".close_view_map").bind("click",function(){
        view_id = jQuery(this).attr("data-id");

        jQuery(".show_view_map_"+view_id).animate({right:"-5000px"},600);

    });
    /**end map he thong dai ly*/
    
    /**begin popup iframe*
    jQuery(".popup_iframe").bind("click", function (e) {
        var href_pu = jQuery(this).attr("href");
        e.preventDefault();
        jQuery('.show_popup_iframe').bPopup();
        jQuery(".comment_popup_iframe").html('<iframe src="' + href_pu + '" width="100%" height="100%" frameborder="0"></iframe>');
    });
    /**end popup iframe*/

    /**begin show map*/
    jQuery(".view_map").bind("click",function(){
        id = jQuery(this).attr("data-id");
        jQuery(".map_disnone").slideUp(200);
        jQuery(".map_disnone_"+id).slideDown(200);
    });
    /**end show map*/   

    /**begin xu ly toi dong y*/
    jQuery("#toi_dong_y").bind("click",function(){
         jQuery("#txtAge").toggle(this.checked);
    });
    /**end xu ly toi dong y*/

    /**begin xu ly footer*/
    jQuery(".shopping_list_footer").bind("change",function(){
        _valft = jQuery(this).val();
        if(_valft){
            window.location.href = _valft;
        }
    })
    /**end xu ly footer*/
});

//ban do 1
function mapgoogle(address_map,id_map){
    var geocoder = new google.maps.Geocoder();
    var myOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById(id_map), myOptions);

    var address = address_map;
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            //alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

//Simply Scroller JavaScript

//ham kiem tra email
function isEmail(str){          
  var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+jQuery/;
  var email = str.val();
  if(email=='')
  {
    str.addClass('error');
    return false;
  }
  if(!re.test(email))
  {
    str.addClass('error');
    return false;
  }
  str.removeClass('error');
  return true;
}



jQuery(document).ready(function () {
    


    /**begin xu so luong va gia san pham*/
    jQuery("#quantity_pro").bind("keyup",function(){
        _val = parseInt(jQuery(this).val());
        _val_qu = parseInt(jQuery("#hd_quantity").val());
        if(_val<0){
            jQuery(this).val(1);
        }else{
            if(_val_qu < _val){
                alert('Số lượng sản phẩm chỉ còn: '+_val_qu);
                jQuery(this).val(_val_qu);
                _data_id = jQuery(this).attr("data-id");
                _tmp_price = jQuery("#hd_price_"+_data_id).val();
                _total = _val_qu*_tmp_price; 
            }else{
                _data_id = jQuery(this).attr("data-id");
                _tmp_price = jQuery("#hd_price_"+_data_id).val();
                _total = _val*_tmp_price;    
            }
            
            jQuery(".tmp_total_"+_data_id).html(_total);
        }
    });
    /**end xu so luong va gia san pham*/

    jQuery(".change_li_de_pro li").bind('click',function(){
        jQuery(".product-info-tab li").removeClass('active');
        jQuery('.change_li_de_pro_ac').addClass('active');
        jQuery('.news-item-body').removeClass('active');
        jQuery('.item-body-active').addClass('active');
    });

     jQuery(".ts-scrollToTop").hide(1);
           jQuery(window).scroll(function() {
            if(jQuery(window).scrollTop() != 0) {
                jQuery('.ts-scrollToTop').fadeIn();
            } else {
                jQuery('.ts-scrollToTop').fadeOut();
            }
           });
           jQuery('.ts-scrollToTop').click(function() {
            jQuery('html, body').animate({scrollTop:0},500);
           }); 
});

// Popup window code
function newPopup(url) {
    popupWindow = window.open(
        url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}

jQuery(window).scroll(function () {
	  if( (jQuery(window).scrollTop()<580) || (jQuery(document).height() <= jQuery(window).scrollTop() + jQuery(window).height()+50) ){
	  	if(jQuery(document).height() <= jQuery(window).scrollTop() + jQuery(window).height()+50){
			 jQuery('#vpro-left-inner').removeClass("scroll_main").addClass("scroll_mains");
		 }else{
			 if(jQuery(window).scrollTop()<580){
			 jQuery('#vpro-left-inner').removeClass("scroll_main").addClass("scroll_maint");
			 }
			 if(jQuery(window).scrollTop()<164){
			 jQuery('#vpro-left-inner').removeClass("scroll_main").addClass("scroll_maintt");
			 }
		 }
      }else{
		jQuery('#vpro-left-inner').removeClass();
        jQuery('#vpro-left-inner').addClass("scroll_main");
      }  
});