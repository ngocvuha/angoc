<div class="slider">
    <div id="home-page" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators"><.$count=count([[=items=]]).>
            <.for($i=0;$i<$count;$i++){.><li data-target="#home-page" data-slide-to="{{$i}}" class="{{$i?'':'active'}}"></li><.}.>
        </ol>
        <div class="carousel-inner"><.$i=0;.>
        <!--LIST:items-->
		<div class="item{{$i++?'':' active'}}">
			<a href="[[|items.url|]]"><img src="[[|items.image_url|]]" alt="[[|items.name|]]"></a>
			<div class="slider-title-bg"></div>
			<div class="slider-title">[[|items.name|]]</div>
		</div>
        <!--/LIST:items-->
		</div>
        <a class="left carousel-control" href="#home-page" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
        <a class="right carousel-control" href="#home-page" data-slide="next"><span class="fa fa-chevron-right"></span></a>
    </div>
</div>