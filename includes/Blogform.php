<script>
	function confirmUpdate(){
		var name = window.document.title.value;
		var question =confirm("Are you certain about these details?");
		if(question){
			return true ;  
		}else{
			return false;
		}
	}
    
</script>
<form method="post" action="">
	<fieldset>  
		<legend >Blog</legend>
		<label for="title">Title</label>
		<input id="title" type="text" name="title" placeholder="Enter The Title"
			value="<?php echo @$Blog->title;
			 ?>" style="width:100%; height:30px;" autofocus class="form-control">
        <label for="content">Content</label>
        <div class="input-control textarea">
        	<textarea id="content" name="content" class="form-control editors" ><?php echo @$Blog->content; ?></textarea>
		</div>
		<label for="author">Author</label>
		<input id="author" type="text" name="author" value="<?php echo @$Blog->author; ?>" 
		placeholder="Author's Name" style="width:100%; height:30px;" class="form-control">
		<br ><br >
		<input type="submit" value="Submit" class="<?php print __THEME__BAR__COLOR__?>">
		
		<input id="aid" type="hidden" name="aid" value="<?php echo @$_GET['aid'];?>" >
	</fieldset> 
</form>
<br />
            <div ><a href="index.php">View all Blogs</a></div>
            
            
<script src="<?php print __SITEURL__ ?>static/editor/jquery.tinymce.js"></script>

  <script type="text/javascript">
	
	$(function() {
		$('textarea.editors').tinymce({
			// Location of TinyMCE script
			script_url : '<?php print __SITEURL__?>static/editor/tiny_mce.js',
			mode : "textareas",
	
			// General options
			theme : "advanced",
			skin : "o2k7",
			skin_variant : "black",
            // Example content CSS (should be your site CSS)
			content_css : "css/content.css",
           // content_css : "<?php print __SITEURL__?>styles/defaultforeditor.css",
            plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
           
            theme_advanced_buttons1 : "preview,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "pasteword,|,cut,copy,paste,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor,removeformat",
        	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
    	
            theme_advanced_resizing :true,
            style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}}
			
		]
        })
	 })	
  </script> 