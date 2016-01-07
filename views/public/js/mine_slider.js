 $(document).ready(function(){
                var i = 0;
                var interval;
                var child = $("#main_slider").children("div");
                child.each(function( index ) {
                    if(index != i){
                        $(this).css("display", "none");
                    }
                });
     
             $( ".right_arrow" ).click(function() {
                clearInterval(interval);
                interval = setInt();
                
                $(child[i]).stop(true,false).fadeOut(300, function(){
                        i++;
                        if( i > child.length-1){
                            i = 0;
                        }
                
                 $(child[i]).fadeIn(300);
                
                });
                 
               
                });

     
     
                $( ".left_arrow" ).click(function() {
                    clearInterval(interval);
                    interval = setInt();
                    $(child[i]).stop(true,false).fadeOut(300, function(){
                        i--;
                        if( i < 0){
                            i = child.length-1;
                        }
                        $(child[i]).fadeIn(300);

                    });
                    
                });
                
                interval = setInt();
     
                function setInt(){
                    return setInterval(function(){ $( ".right_arrow" ).click()}, "5000");
                }
     
});