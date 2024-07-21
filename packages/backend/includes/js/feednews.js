function getPattern(data,url,obj){
	var url_check=false;
	var url_pattern='';
	jQuery('input.feedurl').each(function(){
		if(jQuery(this).val()!=''){
			url_check=true;
			url_pattern=jQuery(this).val();
			return false;
		}
	});
	if(!url_check){
		alert('Hãy nhập 1 Url');
	}else
	if(jQuery('#pattern_bound').val()=='' && data!='pattern_bound'){
		alert('Hãy nhập mẫu bao ngoài một đối tượng'); jQuery('#pattern_bound').focus();
	}else{
		jQuery('#EditAutoFeed label').removeClass('red');
		if(jQuery('#page_content').html()==''){
			window.location=url+'&url_pattern='+url_pattern+'&pattern='+data;
		}else{
			jQuery('#page_content').attr('data',data);
			jQuery(obj).addClass('red');
		}
	}
}
function getPatternDetail(data,url,link_detail,obj){
	if(jQuery('#link_detail').val()==''){
		alert('Hãy nhập Link detail'); jQuery('#link_detail').focus();
	}else{
		jQuery('#page_content').hide();
		if(jQuery('#page_detail_content').html()==''){
			window.location=url+'&url_pattern_detail='+link_detail+'&pattern_detail='+data;
		}else{
			jQuery('.form-table label').removeClass('red');
			jQuery('#page_detail_content').attr({'data':data});
			jQuery(obj).addClass('red');
		}
	}
}
function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}
function strpos (haystack, needle, offset) {
  var i = (haystack+'').indexOf(needle, (offset || 0));
  return i === -1 ? false : i;
}
function saveSetting(form){
	var check=true;
	var error='';
	var check_url=false;
	jQuery('.feedurl').each(function(){
		if(jQuery(this).val()!=''){
			check_url=true;
		}
	});
	if(jQuery('#title').val()==''){
		check=false;
		jQuery('#title').focus();
		error='Hãy nhập tên mẫu';
	}else
	if(!check_url){
		check=false;
		jQuery('.feedurl').focus();
		error='Hãy nhập đường dẫn cần lấy tin';
	}else
	if(jQuery('#host').val()==''){
		check=false;
		jQuery('#host').focus();
		error='Hãy nhập tên miền của trang cần lấy tin';
	}else
	if(jQuery('#pattern_bound').val()==''){
		check=false;
		jQuery('#pattern_bound').focus();
		error='Hãy nhập mẫu bao ngoài một tin';
	}else
	if(jQuery('#extra').val()==''){
		check=false;
		jQuery('#extra').focus();
		error='Hãy nhập mẫu liên kết của một tin';
	}/*else
	if(jQuery('#post_title_pattern_feed').val()==''){
		check=false;
		jQuery('#post_title_pattern_feed').focus();
		error='Hãy nhập mẫu của tiêu đề cần lấy';
	}*/
	if(check){
		jQuery(form).submit();
	}else{
		alert(error);
		return false;
	}
}
function show_log(obj){
	jQuery(obj).toggle(300);
}
jQuery(function(){
	jQuery('#page_content a').attr('onclick','return false');
	jQuery('#page_detail_content a').attr('onclick','return false');
	jQuery('#page_content img').attr('onclick','return false');
	jQuery('#page_detail_content img').attr('onclick','return false');
	// Page list
	jQuery("#page_content").bind('mouseout mouseover',function(event){
		var $tgt = jQuery(event.target);
		var $z=event.target.nodeName;
		if ($tgt.closest('div').length) {
			$tgt.toggleClass('outline-element');
		}
    }).click(function(event){
		var duplicate=0;
		//alert($(event.target).attr('class'));
		jQuery(event.target).removeClass('outline-element');
		// Mẫu bao ngoài một đối tượng
		var pattern_bound=(jQuery('#pattern_bound').val()).split(',');
		// Mẫu đang lấy
		var data=jQuery('#page_content').attr('data');
		// Đối tượng ban đầu
		var parent=jQuery(event.target);
		// Tên thẻ của đối tượng ban đầu
		var mau=parent.prop('tagName').toLowerCase();
		// ID của đối tượng ban đầu
		var obj_id=parent.attr('id');
		// Class của đối tượng ban đầu
		var obj_class=parent.attr('class');
		// Style của đối tượng ban đầu
		var obj_style=parent.attr('style');
		// Check lấy mẫu là link
		var check_data_link=true;
		if(data=='extra' && mau!='a') check_data_link=false;
		// Nếu đối tượng ban đầu có id
		if(typeof(obj_id) != 'undefined' && obj_id != null && obj_id!='' && check_data_link){
			mau=mau+'[id="'+obj_id+'"]';
			jQuery('#page_content '+mau).each(function(){ duplicate++; });alert('Số lượng mẫu giống nhau tìm thấy trên trang là: '+duplicate);
		}else
		// Nếu đối tượng ban đầu có class
		if(typeof(obj_class) != 'undefined' && obj_class != null && obj_class!='' && check_data_link){
			mau=mau+'[class="'+obj_class+'"]';
			jQuery('#page_content '+mau).each(function(){ duplicate++; });alert('Số lượng mẫu giống nhau tìm thấy trên trang là: '+duplicate);
		}else
		// Nếu đối tượng ban đầu có style
		if(typeof(obj_style) != 'undefined' && obj_style != null && obj_style!='' && check_data_link){
			mau=mau+'[style="'+obj_style+'"]';
			jQuery('#page_content '+mau).each(function(){ duplicate++; });alert('Số lượng mẫu giống nhau tìm thấy trên trang là: '+duplicate);
		}
		else{
			var check=1;
			while (check>0){
				parent=parent.parent();
				parent.removeClass('outline-element');
				obj_id=parent.attr('id');
				obj_class=parent.attr('class');
				obj_style=parent.attr('style');
				if(typeof(obj_id) != 'undefined' && obj_id != null && obj_id != ''){
					mau=parent.prop('tagName').toLowerCase()+'[id="'+obj_id+'"] '+mau;
					if(strpos(mau,pattern_bound,0)!='false' && data!='pattern_bound'){
						for(i=1;i<=pattern_bound.length;i++){
							mau=jQuery.trim(mau.replace(pattern_bound[i],''));
						}
					}
					check=0;
				}else
				if(typeof(obj_class) != 'undefined' && obj_class != null && obj_class != ''){
					mau=parent.prop('tagName').toLowerCase()+'[class="'+obj_class+'"] '+mau;
					if(strpos(mau,pattern_bound,0)!='false' && data!='pattern_bound'){
						for(i=1;i<=pattern_bound.length;i++){
							mau=jQuery.trim(mau.replace(pattern_bound[i],''));
						}
					}
					check=0;
				}else
				if(typeof(obj_style) != 'undefined' && obj_style != null && obj_style != ''){
					mau=parent.prop('tagName').toLowerCase()+'[style="'+obj_style+'"] '+mau;
					if(strpos(mau,pattern_bound,0)!='false' && data!='pattern_bound'){
						for(i=1;i<=pattern_bound.length;i++){
							mau=jQuery.trim(mau.replace(pattern_bound[i],''));
						}
					}
					check=0;
				}else{
					mau=parent.prop('tagName').toLowerCase()+' '+mau;
				}
			}
			jQuery('#page_content '+mau).each(function(){ duplicate++; });alert('Số lượng mẫu giống nhau tìm thấy trên trang là: '+duplicate);
		}
		mau=replaceAll('"','',mau);
		if(jQuery('#'+data).val()==''){
			jQuery('#'+data).val(mau);
		}else{
			jQuery('#'+data).val(jQuery('#'+data).val()+','+mau);
		}
		window.scrollTo(0,0);
	});
	// Page detail
	jQuery("#page_detail_content").bind('mouseout mouseover',function(event){
		var $tgt = jQuery(event.target);
		var $z=event.target.nodeName;
		if ($tgt.closest('div').length) {
			$tgt.toggleClass('outline-element');
		}
    }).click(function(event){
		jQuery(event.target).removeClass('outline-element');
		// Đối tượng ban đầu
		var parent=jQuery(event.target);
		// Tên thẻ của đối tượng ban đầu
		var mau=parent.prop('tagName').toLowerCase();
		// Mẫu đang lấy
		var data=jQuery('#page_detail_content').attr('data');
		// Host
		var host=jQuery('#host').val();
		if(data=='post_title_pattern_feed' || data=='post_excerpt_pattern_feed' || data=='post_content_pattern_feed'){
			// Số lượng cha muốn lấy
			var duplicate=0;
			// ID của đối tượng cha ban đầu
			var obj_id=parent.attr('id');
			// Class của đối tượng cha ban đầu
			var obj_class=parent.attr('class');
			// Style của đối tượng cha ban đầu
			var obj_style=parent.attr('style');
			
			if(typeof(obj_id) != 'undefined' && obj_id != null && obj_id != ''){
				var mau=parent.prop('tagName').toLowerCase()+'[id="'+obj_id+'"]';
				jQuery('#page_detail_content '+mau).each(function(){ duplicate++; });alert('Số lượng mẫu giống nhau tìm thấy trên trang là: '+duplicate);
			}else
			if(typeof(obj_class) != 'undefined' && obj_class != null && obj_class != ''){
				var mau=parent.prop('tagName').toLowerCase()+'[class="'+obj_class+'"]';
				jQuery('#page_detail_content '+mau).each(function(){ duplicate++; });alert('Số lượng mẫu giống nhau tìm thấy trên trang là: '+duplicate);
			}else
			if(typeof(obj_style) != 'undefined' && obj_style != null && obj_style != ''){
				var mau=parent.prop('tagName').toLowerCase()+'[style="'+obj_style+'"]';
				jQuery('#page_detail_content '+mau).each(function(){ duplicate++; });alert('Số lượng mẫu giống nhau tìm thấy trên trang là: '+duplicate);
			}else{
				var check=1;
				while (check>0){
					parent=parent.parent();
					parent.removeClass('outline-element');
					obj_id=parent.attr('id');
					obj_class=parent.attr('class');
					obj_style=parent.attr('style');
					if(typeof(obj_id) != 'undefined' && obj_id != null && obj_id != ''){
						mau=parent.prop('tagName').toLowerCase()+'[id="'+obj_id+'"] '+mau;
						check=0;
					}else
					if(typeof(obj_class) != 'undefined' && obj_class != null && obj_class != ''){
						mau=parent.prop('tagName').toLowerCase()+'[class="'+obj_class+'"] '+mau;
						check=0;
					}else
					if(typeof(obj_style) != 'undefined' && obj_style != null && obj_style != ''){
						mau=parent.prop('tagName').toLowerCase()+'[style="'+obj_style+'"] '+mau;
						check=0;
					}else{
						mau=parent.prop('tagName').toLowerCase()+' '+mau;
					}
				}
				jQuery('#page_detail_content '+mau).each(function(){ duplicate++; });alert('Số lượng mẫu giống nhau tìm thấy trên trang là: '+duplicate);
			}
			mau=replaceAll('"','',mau);
			jQuery('#'+data).val(mau);
			window.scrollTo(0,0);
		}else
		if(data=='image_detail'){
			var src_old=jQuery(event.target).attr('src');
			var src_new=src_old;
			if(strpos(src_old,'://')===false){
				src_old=src_old.replace(/\.\.\//g,'');
				if(strpos(src_old,'/',0)==0){
					var pos=strpos(src_old,'/',1);
					var str1=src_old.substring(0,pos+1);
					var str2=host+''+str1.substring(1);
				}else{
					var pos=strpos(src_old,'/',0);
					var str1=src_old.substring(0,pos+1);
					var str2=host+''+str1;
				}
				jQuery('#image_content_left').val(str1);
				jQuery('#image_content_right').val(str2);
			}else{
				jQuery('#image_content_left').val('');
				jQuery('#image_content_right').val('');
				alert('Đường dẫn ảnh ở dạng tuyệt đối, không cần xử lý!');
			}
			window.scrollTo(0,0);
		}
	});
	jQuery("#feednews_maxitem").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ( jQuery.inArray(event.keyCode,[46,8,9,27,13/*,190*/]) !== -1 ||
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
});