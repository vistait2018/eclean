<body data-spy="scroll" data-target="#navbar" data-offset="0">
<?php

			if(@$_POST['adminEdit'] == "IWCXYZ"){
				$_SESSION['adminEdit']	= true;
                
			}
			
			if(@$_GET['admin'] == 'logout'){
				unset($_SESSION['adminEdit']);
			}
		?>
		
    <header id="header" role="banner">
        <div>
            <div id="navbar" class="navbar navbar-default">
                <div class="navbar-header" style="display:inline">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php print __SITEURI__?>"></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="directlink"><a href="<?php print __SITEURI__?>"><i class="icon-home"></i></a></li>
                        <li class="dropdown">
		                  <a href="" class="dropdown-toggle directlink" data-toggle="dropdown">About Us <span class="caret"></span></a>
		                  <ul class="dropdown-menu" role="menu">
		                  
		                    <li class="directlink"><a  href="<?php print __SITEURI__?>about.php">About IWC</a></li>
                              <li class="directlink"><a  href="<?php print __SITEURI__?>confessions.php">IWC Confession</a></li>
                              <li class="directlink"><a href="<?php print __SITEURI__?>event_calendar.php">IWC Events Calendar</a></li>
                              <li class="directlink"><a  href="<?php print __SITEURI__?>mission.php">Mission Statement</a></li>
                              <li class="directlink"><a  href="<?php print __SITEURI__?>programs.php">Our Programs</a></li>
                              <li class="directlink"><a  href="<?php print __SITEURI__?>todays_thought.php">Manna</a></a></li>
		                    <li class="directlink"><a  href="<?php print __SITEURI__?>aboutpastor.php">About Pastor Laide</a></li>
		                    
		                  </ul>
		                </li>
                       
                                              
                        <li class="directlink"><a href="<?php print __SITEURI__?>gallery/">Gallery</a></li>
                        <li class="directlink"><a href="<?php print __SITEURI__?>contact.php">Contact</a></li>
                        <li class="directlink"><a href="<?php print __SITEURI__?>article/view.php">Article</a></li>
                        <li class="directlink"><a href="<?php print __SITEURI__?>blog/view.php">Pastor's Blog</a></li>
                       
                         <?php if ( isset($_SESSION['adminEdit']) )
                           { 
                               print'<li class="directlink"><a href="'. __SITEURI__.'media/admin.php">Media</a></li>';
                            print 
                          '<li class="dropdown">
		                  <a href="" class="dropdown-toggle directlink" data-toggle="dropdown">Admin <span class="caret"></span></a>
		                  <ul class="dropdown-menu" role="menu">
		                
		                    <li class="directlink"><a href="'. __SITEURI__.'admin/adminpanel.php">Admin Panel</a></li>
                              <li class="directlink"><a href="'. __SITEURI__.'admin/">Members</a></li>
                              <li class="directlink"><a href="'. __SITEURI__.'gallery/">Gallery</a></li>
                               <li class="directlink"><a href="'. __SITEURI__.'programs.php">Our Programs</a></li>
                           <li class="directlink"><a href="'. __SITEURI__.'media/medianew.php">Media</a></li>
		                    
		                  </ul>
                          </li>' ;
                           
                          
                          }?>
                          
                                         
                          
                        
                    </ul>
                </div>
            </div>


                       
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

        </div>
    </header><!--/#header-->





