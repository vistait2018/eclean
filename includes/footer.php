 <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    &copy; 2016 <a target="_blank" href="http://netronit.com/" title="Netron Technologies Limited">NetronIT</a>. All Rights Reserved.
                </div>
                <div class="col-sm-2">
                   Powered by <a target="_blank" href="http://netronit.com/" title="Netron Technologies Limited">NetronIT</a>.
                </div>
            </div>
        </div>
    </footer>
    <?php if(!isset($_SESSION['adminEdit']) and @$_GET['admin'] == 'edit'){ ?>
			
			<div style="position: fixed;right:10px;bottom:10px;z-index:5; background-color: red" >
	            <form method="post">
	            	<input type="password" placeholder="Admin Pass" name="adminEdit" value="" class="form-control text">
	                
	            </form>
	        </div>
	      	
		<?php
		}?><!--/#footer-->
    <script type="text/javascript">
document.ready = function(){
	 var loc = window.location.pathname;

	   $('#navbar').find('a').each(function() {
		  
	    if( $(this).attr('href') == window.location ){ 
	    	$(this).parent().addClass('active');
			
		}

	    
		
		 
	  });
	   $('#navbar li a').click(function(){
		  resetAll();
		  $(this).parent().addClass('active');
				
		   
	})

	function resetAll(){
		   $('#navbar').find('a').each(function() {
			   $(this).parent().removeClass('active');
		});
	}
	  
 };
 
</script>


    <script src="<?php print __SITEURI__?>static/js/bootstrap.min.js"></script>
    <script src="<?php print __SITEURI__?>static/js/jquery.isotope.min.js"></script>
    <script src="<?php print __SITEURI__?>static/js/jquery.prettyPhoto.js"></script>
    <script src="<?php print __SITEURI__?>static/js/main.js"></script>
</body>
</html>