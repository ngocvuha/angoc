// Jquery Plugin
// Created - Gunjan Kothari
// Date - 24/04/2014
// Plugin to Draw a line between to elements

(function ( $ ) {
	$.fn.connectSVG = function(){
		
		var _svg;
		var _lines = new Array(); //This array will store all lines (option)
		var _me = this;  
		
		//Initialize SVG object
		$(this).svg(this);
		
		//Retrieve SVG object
		_svg = $(this).svg('get'); 
		
		this.drawLine = function(option){
  			//It will push line to array.
			_lines.push(option);
			this.connect(option);	
		};
		this.drawAllLine=function(option){
			
			/*Mandatory Fields------------------
			left_selector = '.class',
			data_attribute = 'data-right',
			*/
			if(option.left_selector != '' && typeof option.left_selector !== 'undefined' && $(option.left_selector).length>0){
				$(option.left_selector).each(function(index){
					var option2 = new Object();
					$.extend(option2, option);
					option2.left_node = $(this).attr('id');
					option2.right_node = $(this).data(option.data_attribute);
					if(option2.right_node != '' && typeof option2.right_node !== 'undefined'){
						_me.drawLine(option2);
						
					}
				});
			}
		};
		
		//This Function is used to connect two different div with a dotted line.
		this.connect = function(option) {
			try
			{
					var _color;
					var _dash;
					var _left = new Object(); //This will store _left elements position  
					var _right = new Object();	//This will store _right elements position	
					var _error = (option.error == 'show') || false;
			/*
			option = {
				left_node - Left Element by ID - Mandatory
				right_node - Right Element ID - Mandatory
				status - accepted, rejected, modified, (none) - Optional
				style - (dashed), solid, dotted - Optional	
				horizantal_gap - (0), Horizantal Gap from original point
				error - show, (hide) - To show error or not
			}
			*/	
				
				if(option.left_node != '' && typeof option.left_node !== 'undefined' && option.right_node != '' && typeof option.right_node !== 'undefined' && $(option.left_node).length>0 && $(option.right_node).length>0)
				{
					
					//To decide colour of the line
					switch (option.status)
					{
						case 'accepted':
							_color = '#0969a2';  
							break;
						
						case 'rejected':
							_color = '#e7005d';  
							break;
			
						case 'modified':
							_color = '#bfb230';  
							break;
			
						case 'none':
							_color = 'grey';  
							break;
						
						default :
							_color = 'grey';  
							break;
					}
					
					//To decide style of the line. dotted or solid
					switch (option.style)
					{
						case 'dashed':
							_dash = '4,2';  
							break;
						
						case 'solid':
							_dash = '0,0';  
							break;
						
						case 'dotted' :
							_dash = '4,2';  
							break;
							
						default :
							_dash = '4,2';  
							break;
					}
					
					//If left_node is actually right side, following code will switch elements.
					
					if($(option.left_node).position().left >= $(option.right_node).position().left)
					{
						_tmp = option.left_node
						option.left_node = option.right_node
						option.right_node =_tmp;
					}
					
					//Get Left point and Right Point
					_left.x = $(option.left_node).position().left + $(option.left_node).outerWidth();
					_left.y = $(option.left_node).position().top + ($(option.left_node).outerHeight()/2);
					_right.x = $(option.right_node).position().left;
					_right.y = $(option.right_node).position().top + ( $(option.right_node).outerHeight()/2);
					
					//Create a group
					var g = _svg.group({strokeWidth: 2, strokeDashArray:_dash}); 	
					
					//Draw Line
					var _gap = option.horizantal_gap || 0 ;
					
					if(_gap != 0)
					{
						_svg.line(g, _left.x, _left.y, _left.x + _gap, _left.y, {stroke: _color}); 
						_svg.line(g, _left.x + _gap , _left.y, _right.x - _gap, _right.y, {stroke: _color}); 
						_svg.line(g,  _right.x - _gap,  _right.y, _right.x, _right.y, {stroke: _color}); 
					}
					else
					{
						_svg.line(g, _left.x, _left.y, _right.x, _right.y, {stroke: _color}); 
					}
					
					option.resize = option.resize || false;
				}
				else
				{
					if(_error) alert('Mandatory Fields are missing or incorrect');	
				}
			}
			catch(err){
				if(_error) alert('Mandatory Fields are missing or incorrect');	
			}
		};
		
		//It will redraw all line when screen resizes
		$(window).resize(function(){
			_me.redrawLines();
		});
		this.redrawLines = function(){
			console.log('Dragged');
			$(_me).find('svg').empty();
			_lines.forEach(function(entry){
				entry.resize=true;
				_me.connect(entry);
			});
		};
		return this;
	};
}( jQuery ));
