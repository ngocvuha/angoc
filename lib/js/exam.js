function Expander() {    	
    this.start = function () {    			
        jQuery(".expandable").keydown(function(e) {               			
            this.style.width = 0;
            var newWidth = this.scrollWidth + 10;    			
            if( this.scrollWidth >= this.clientWidth )
                newWidth += 10;    				
            this.style.width = newWidth + 'px';    			
        });    		
    }    	
}
var Storage = window.localStorage;
var _left = new Object();
var _right = new Object();
var line = new Object();
var player = [];
var playing;
MediaCount = Storage.getItem('MediaCount');
if ((MediaCount === undefined) || (MediaCount == null) || (MediaCount == "undefined")){
	var count = [];
}else{
	var count = JSON.parse(localStorage.getItem("MediaCount"));
}
jQuery(function(){
	//var timeout=self.setInterval(keep_connect, 180000);//~3phut
	window.app = new Expander();
   	window.app.start();
	jQuery('audio,video').each(function(){		
		id = jQuery(this).attr('id');
		AudioIndex = id.substring(6);
		player[AudioIndex] = new MediaElementPlayer('#'+id,{
			features: ['tracks','volume','duration'],
			play: function(e,o){
				
			},
			audioHeight: 30,
		});
		if((count[AudioIndex]===undefined) || (count[AudioIndex]== null) || (count[AudioIndex]=="undefined")){
			count[AudioIndex] = 0
		}
		jQuery(this).bind('ended', function(e) { 
			id = jQuery(this).attr('id');
			AudioIndex = id.substring(6);
			count[AudioIndex]++;
			btn = jQuery('button[target='+AudioIndex+']');
			Storage.setItem('MediaCount',JSON.stringify(count));
			playing = false;
			if(count[AudioIndex]>1){
				btn.remove();
				return false;
			}			
			btn.html('Play again');			
		});
		jQuery('.testonline-bound img[align=left]').removeAttr('align');
	})
	jQuery('button[btn=audio]').click(function(){
		if(!playing){
			target = jQuery(this).attr('target');
			player[target].play();
			playing = true;
		}		
	});
	// Matching Keo tha
	jQuery('.draggable').draggable({
		helper: "clone",
		cursor: "move",
		start: function (event, ui) {
		}
	});
	jQuery('.droppable').droppable({
	  greedy: true,
	  activeClass: "ui-state-hover",
      hoverClass: "ui-state-active",
	  drop: function( event, ui ) {
		id = jQuery(this).attr('line');
		r = jQuery(this);
		l = ui.draggable;
		drawLine(l,r);
		updateMatching(r.parent().attr('question'));
		//update select tag
		r_id = r.attr('id');
		r_index = r_id.split('-');
		l.children('select[q="'+r_index[1]+'"]').val(r_index[2]);
      }
    });
	jQuery('select[type="matching"]').change(function(e){
		q = jQuery(this).attr('q');
		r = jQuery(this).val();
		i = jQuery(this).parent().attr('index');
		if(r!=0){
			drawLine(jQuery('#draggable-'+q+'-'+i),jQuery('#droppable-'+q+'-'+r));
			updateMatching(q);	
		}else{
			removeLeftLine(jQuery('#draggable-'+q+'-'+i));
		}
	});
})
function updateMatching(id){
	is_answer(id);
	var length = jQuery('div[id^=line-'+id+']').length;
	str = '';
	for(i=1;i<=length;i++){
		line = jQuery('div[id=line-'+id+'-'+i+']');
		end = line.attr('point_end');
		str += jQuery('#'+end).attr('index')+'|';
	}
	jQuery('#answer-'+id).val(str);
}
function is_answer(id){
	jQuery('#qlist-'+id).addClass('badge-active');
}
function drawLine(elm1,elm2){
	_left.y = elm1.position().top + Math.round(elm1.height()/2);
	_left.x = elm1.position().left + elm1.width();
	_right.x = elm2.position().left;
	_right.y = elm2.position().top+Math.round(elm2.height()/2)+10;
	
	removeLeftLine(elm1);
	removeRightLine(elm2);
	
	elm1.parent().line(_left.x, _left.y,_right.x,_right.y,  {color:"blue", zindex:1,index:elm2.attr('line'),point_start:elm2.attr('id'),point_end:elm1.attr('id')});
}
function removeLeftLine(e){
	id = e.attr('id');
	jQuery('div[point_end='+id+']').remove();
}
function removeRightLine(e){
	id = e.attr('id');
	jQuery('div[point_start='+id+']').remove();
}
function keep_connect(){
	jQuery.ajax({
	  url: "keep_connect.php"
	})
	return false;
}