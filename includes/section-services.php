 <section id="services">


        <div class="container">
            <div class="box first">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <div class="center">
                            
		                 
		                  <?php editableInclude("about.min.php", "about-min", @$_SESSION['adminEdit'])?>
                            <a id="abtn"class="btn btn-info" href="<?php print __SITEURI__?>about.php">Explore</a>
                          
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-4">
                        <div class="center">
                            
                             
                 
           <!-- Sidebar contents -->
				<?php// include 'includes/sidebar_default.php';?>

            </div>
                        </div>
                   
                    <div class="col-md-4 col-sm-4">
                        <div class="center">
                           <h3 style="color: #ff6a00">Thought for today</h3>
			<p>God cannot lie. When you get tired of believing you will 
				manufacture Ishmail. Ishmail is the manifestation of unbelief and it 
				carries with it pains and scorn. Learn to live by the word and depend totally on it....
				<a class="btn btn-info" href="<?php print __SITEURI__?>todays_thought.php">Read more</a>
			</p>  
                        </div>
                    </div><!--/.col-md-4-->
                     
                    <div class="col-md-4 col-sm-4">
                        <div class="center">
                            
        <h3 style="color: #ff6a00">My Daily Confessions</h3>
			<p>My life is a masterpiece designed by God in Christ. I am created and zealous for good works. 
		I am a succor and a solace to many. I am eyes to blind, feet to the lame and ears to the deaf.
		I plead the cause of the fatherless and the poor. I and those that come from me raise the foundations of ...
		<a  class="btn btn-info" href="<?php print __SITEURI__?>confessions.php">Read more</a> </p>
	                      
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-4">
                        <div class="center">
                            <br><br>
                            <h3 style="color: #ff6a00">Recent Article</h3>
                         <?php  $recent = Article::getRecentArticle($db);?>
                       
                       
        	<h3><?php print strtoupper($recent['title']);?></h3>
			<address>Author:<?php print strtoupper($recent['author']);?></address>
				Date posted: <?php print $recent['registered'];?>
			
			<p><?php print $recent['content'];?>... <a class="btn btn-info"
                href="<?php print __SITEURI__?>articles/view.php?aid=<?php print $recent['aid'] ?>">Read more</a>
			</p>

                        </div>
                    </div><!--/.col-md-4-->                   
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#services-->
  