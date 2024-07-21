var player = [];
var playing;
jQuery(function(){
	jQuery('audio,video').each(function(){		
		id = jQuery(this).attr('id');
		AudioIndex = id.substring(6);
		player[AudioIndex] = new MediaElementPlayer('#'+id,{
			features: ['tracks','volume','duration','process'],
			play: function(e,o){
				
			},
			audioHeight: 30,
		});		
	})
	jQuery('testonline-bound img[align=left]').removeAttr('align');
})