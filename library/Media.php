<?php
/**
 *@name Article
 * @author perspective pc
 * @uses db
 */

class Media{
    var $author, $title, $typeselected, $registered, $ext;


    private $db, $mid,$lastError;


     /**
      * @var $pid int PatientID
      * @var $db Object db (PDO object)
      * @return void
      **/
    function __construct($mid,$db){
        $this->db           	= $db;
        $this->mid          	= $mid;
        $data               	= $this->init();
    }
    
    function getID(){
    	return $this->mid;
    }
    
    /**
     * get Patient's Records
     * @return array
     **/
    function init(){
      //$this->db = new db($type, $host, $dbname, $user, $pass);
        $data = array();
        $mid = addslashes($this->mid);
        try{
          $q = "SELECT * FROM  media WHERE mid = '$mid'";
            $r = $this->db->query($q);
            if($data = $r->fetch(PDO::FETCH_ASSOC)){
            	@$this->author   	= $data['author'];
		        @$this->title    	= $data['title'];
		        @$this->typeselected   	= $data['typeselected'];
		        @$this->registered     	= new DateTime($data['registered']);
                @$this->ext    	= $data['ext'];



            }

        }catch(PDOException $err){
            $this->lastError = $err->getMessage();
        }
        return $data;

    }





    public function getLastError(){
        return $this->lastError;
    }


   static function createMedia($data,$ext,$db){

        extract($data);

       /// var_dump($filename."hghjjkkjkjl");
       $q = "INSERT INTO media( title,author, typeselected, ext, registered)
            VALUES (?, ?, ?, ?, NOW())";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$title,PDO::PARAM_STR);
            $stmt->bindValue(2,$author,PDO::PARAM_STR);
            $stmt->bindValue(3,$type,PDO::PARAM_STR);
            $stmt->bindValue(4,$ext,PDO::PARAM_STR);



            if($r = $stmt->execute()){

                return $db->lastInsertId();
            }

            else {
                 print_r($stmt->errorInfo()) ;
                 print_r($db->errorInfo()) ;
                return false;

            }


        }catch(PDOException $err){
           // print $this->lastError = $err->getMessage();
        }



    }

  static function update($data,$ext ,$mid,$db){
         extract($data);
        
    $q = "UPDATE media SET title = ?,
                author = ?,typeselected = ?,ext = ?, registered = NOW()  WHERE mid = ?";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$title,PDO::PARAM_STR);
            $stmt->bindValue(2,$author,PDO::PARAM_STR);
            $stmt->bindValue(3,$type,PDO::PARAM_STR);
            $stmt->bindValue(4,$ext,PDO::PARAM_STR);
            $stmt->bindValue(5,$mid,PDO::PARAM_INT);




            if($r = $stmt->execute()  ){
             unlink('__SITEURL__'.'media/'.$type.'/$mid.'.$ext);

                return true;
                }
            else{ return false;

            }


        }catch(PDOException $err){
            $this->lastError = $err->getMessage();
        }



    }


  static function getAllImages($db, $clause=''){
  $data = array();
	 	$q = "SELECT
				*
			FROM media
			WHERE typeselected = 'Images' ORDER BY registered DESC";
			try{
				if($r = $db->query($q))
					$data = $r->fetchAll(PDO::FETCH_BOTH);
			// print_r ($db->errorInfo());
		}catch(PDOException $err){
			// print $this->lastError = $err->getMessage();
		}
		//print_r($db->errorInfo());
		return $data;


    }




	static function getAllVideos($db,$all = true){
  		$data = array();
  		
	 	$q = "SELECT
				*
			FROM media
			WHERE typeselected = 'Video' ORDER BY registered DESC";
	 	
		try{
			if($r = $db->query($q)){
				if($all)
					$data = $r->fetchAll(PDO::FETCH_ASSOC);
				else $data = $r->fetch(PDO::FETCH_ASSOC);
			}
				
			// print_r ($db->errorInfo());
		}catch(PDOException $err){
			// print $this->lastError = $err->getMessage();
		}
		//print_r($db->errorInfo());
		return $data;


    }

    static function getAllBanner($db){
    	$data = array();
    	$q = "SELECT
				*
			FROM media
			WHERE typeselected = 'Banner' ORDER BY registered DESC";
    	try{
    		if($r = $db->query($q))
    			$data = $r->fetchAll(PDO::FETCH_BOTH);
    		// print_r ($db->errorInfo());
    	}catch(PDOException $err){
    		// print $this->lastError = $err->getMessage();
    	}
    	//print_r($db->errorInfo());
    	return $data;
    
    
    }
    

static function getAllAudio($db){
  $data = array();
	 	$q = "SELECT
				*
			FROM media
			WHERE typeselected = 'Sound' ORDER BY registered DESC";
			try{
				if($r = $db->query($q))
					$data = $r->fetchAll(PDO::FETCH_BOTH);
			// print_r ($db->errorInfo());
		}catch(PDOException $err){
			// print $this->lastError = $err->getMessage();
		}
		//print_r($db->errorInfo());
		return $data;


    }

   
   static function deleteBanners($ids,$db){
    
   	$id = addslashes(implode(", ", $ids));
    		
    	$q = "DELETE FROM media WHERE mid  IN ($id)";
    
    	try{
    
    		$stmt = $db->prepare($q);
    			
    		if($r = $stmt->execute(array($id))){
    			return $stmt->rowCount();
    		}else {
    			return false;
    		}
    
    
    	}catch(PDOException $err){
    		// print $this->lastError = $err->getMessage();
    	}
    
    
    }
    
    static function unlinkPhoto($data,$path){
    	//print "PATH: ".$path;
   
    for($i =0; $i <count($data); $i++){
    	
        @$ext = $data['ext'][$i];
    	@$id			= $data['photoid'][$i];
    	@$filename	= $path.$id.'.'.$ext;
    			
    		if(is_file($filename)){
    			unlink($filename);
    			
    		}
    	}
    
    	return $i;
    }
    static function createBanner($data,$ext,$db){
    
    	extract($data);
    	$type = 'banner';
    	/// var_dump($filename."hghjjkkjkjl");
    	$q = "INSERT INTO media( title,author, typeselected, ext, registered)
            VALUES (?, ?, ?, ?, NOW())";
    	try{
    		$stmt = $db->prepare($q);
    		@ $stmt->bindValue(1,$title,PDO::PARAM_STR);
    		@ $stmt->bindValue(2,$author,PDO::PARAM_STR);
    		$stmt->bindValue(3,$type,PDO::PARAM_STR);
    		$stmt->bindValue(4,$ext,PDO::PARAM_STR);
    
    
    
    		if($r = $stmt->execute()){
    
    			return $db->lastInsertId();
    		}
    
    		else {
    			print_r($stmt->errorInfo()) ;
    			print_r($db->errorInfo()) ;
    			return false;
    
    		}
    
    
    	}catch(PDOException $err){
    		// print $this->lastError = $err->getMessage();
    	}
    
    
    
    }
    
   
    }
?>
