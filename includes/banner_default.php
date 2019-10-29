
<div class="grid" id="content_wrapper" >
	    <div class="row" style="padding:0px; margin:0px;">
	        
	        <div class="span12" >
				<div class="carousel" style="max-width:920px" >
					
					
					<?php 
					
					if($banner = Media::getAllBanner($db)){ 
                    for($i = 0; $i<count($banner);$i++){
                      print'<div class="slide">';
						   
	                  print'<img src="'. __SITEURL__.'images/banner'.$banner[$i]['mid'].'.jpg"  alt="banner'.$banner[$i]['mid'].'"  />';
					   print'</div>';}
                       }?>
					
				</div>
	        	<script>
	        	$('.carousel').carousel({
	        		//effect:	'fade',
		        });
	        	</script>
	        	
	           
	        </div>
	    </div>
	</div>
	<div class="grid bgBlue fg-white" style="max-width:920px" >
		<div class="row" style="margin-top: -18px;" >
			<div class="span8 newsletter_txt">
				<div style="padding:10px">Subscribe to our newsletter and recieve regular inspiring updates:</div>
		    </div>
			<div class="span4 newsletter_form newsletter_con" style="max-width:280px">
		   		<form method="post" action="" style="padding:7px">
					<input type="text" name="newsletter_email">
					<input type="submit" name="subscribe" value="Subscribe">
				</form>
			</div>
		</div>
	</div>