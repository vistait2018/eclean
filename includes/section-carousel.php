    <section id="main-slider" class="carousel">
        <div class="carousel-inner">
        <?php 
       global $db;
		if($banner = Media::getAllBanner($db)){ 
			for($i = 0; $i<count($banner);$i++){
				?>
				<div class="item<?php print ($i == 0)? ' active': ''?>">
                <div>

                    <div class="carousel-content">
                       
         <?php print'<img src="'. __SITEURI__.'images/banner'.$banner[$i]['mid'].'.jpg"  alt="banner'.$banner[$i]['mid'].'" width="100%" />'; ?>   
                           
                    </div>

                </div>
            </div>
				
				
				<?php 
            }
	}


?>
 </div><!--/.item-->
           
        </div><!--/.carousel-inner-->
        <a class="prev" href="#main-slider" data-slide="prev"><i class="icon-angle-left"></i></a>
        <a class="next" href="#main-slider" data-slide="next"><i class="icon-angle-right"></i></a>
    </section><!--/#main-slider-->
