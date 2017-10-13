(function(ns){    
        function Scroll(element){  
                
            var content = document.createElement("div");  
            var container = document.createElement("div");  
            var _this =this;  
            var cssText = "position: absolute; visibility:hidden; left:0; white-space:nowrap;";  
            this.element = element;   
            this.contentWidth = 0;  
            this.stop = false;  
			
			var width_int = element.offsetWidth;
			var width_str = element.style.width;
                
            content.innerHTML = element.innerHTML;  
                
            //获取元素真实宽度  
            content.style.cssText = cssText;			
			
            element.appendChild(content);  
            //this.contentWidth = content.offsetWidth; 
			
			
			
			if(content.offsetWidth >= width_int){
				this.contentWidth = content.offsetWidth;		
			}else{
				this.contentWidth = width_int;		
				content.style.width = width_str;
			}
			content.style.cssText= "float:left;"; 
			
            container.style.cssText = "width: " + (this.contentWidth*2) + "px; overflow:hidden";  
            container.appendChild(content);  
            container.appendChild(content.cloneNode(true));  
            element.innerHTML = "";  
            element.appendChild(container);  
                
            container.onmouseover = function(e){  
                clearInterval(_this.timer);  
                    
            };  
                
            container.onmouseout = function(e){  
                _this.timer = setInterval(function(){   
                    _this.run();  
                },20);            
    
                    
            };  
            _this.timer = setInterval(function(){   
                _this.run();  
            }, 20);  
        }  
            
        Scroll.prototype = {  
                
            run: function(){                      
                var _this = this;  
                var element = _this.element;                    
                element.scrollLeft = element.scrollLeft + 1;                      
                if(element.scrollLeft >=  this.contentWidth ) {  
                        element.scrollLeft = 0;  
                }  
            }  
        };  
    ns.Scroll = Scroll;   
}(window)); 