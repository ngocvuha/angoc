<div class="jumbotron">
  <h2>Bạn đang ở trong phòng thi [[|Ten|]]</h2>
  <p>Vui lòng chờ giám thị xác minh</p>
  <form name="Wait" method="post" onsubmit="phongthi.disabled = true; return true;">
	<button type="submit" id="confirm" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Please Waiting...</button>
	<input name="phongthi" type="hidden" id="phongthi" class="" />
  </form>
	<script type="text/javascript">
        window.onbeforeunload = function () {
			item=document.getElementById("confirm");
			item.disabled=true;
		}
	</script>  
  </div>
<script>
	var status = true;
	var Storage = window.localStorage;
	Storage.removeItem('MediaCount');
	jQuery(function(){
		var timeout=self.setInterval(check_status, 5000);
		if(!status) window.clearInterval(timeout);
		
	})
	function check_status(){
		jQuery.ajax({
		  url: "{{Url::build_current(array('cmd'=>'get_status'))}}",
		  beforeSend: function( xhr ) {
			xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
		  }
		}).done(function( data ) {			
			if(data==2){
				status = false;
				jQuery('#confirm').removeClass('btn-warning').addClass('btn-success').html('Làm Bài Thi');
			}
		});
		return status;
	}
	function closeTimeOut(){
		window.clearInterval(timeout);
	}
</script>