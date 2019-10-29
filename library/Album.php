<?php
/**
 *@name Article
 * @author perspective pc
 * @uses db
 */

class Album{
    var $name,  $datereg;


    private $db, $id,$lastError;


     /**
      * @var $pid int PatientID
      * @var $db Object db (PDO object)
      * @return void
      **/
    function __construct($id,$db){
        $this->db           	= $db;
        $this->id          	= $id;
        $data               	= $this->init();




    }
    function getID(){
    	return $this->id;
    }
    /**
     * get Patient's Records
     * @return array
     **/
    function init(){
      //$this->db = new db($type, $host, $dbname, $user, $pass);
        $data = array();
        $id = addslashes($this->id);
        try{
          $q = "SELECT * FROM  album WHERE id = '$id'";
            $r = $this->db->query($q);
            if($data = $r->fetch(PDO::FETCH_ASSOC)){
            	@$this->name   	= $data['name'];
		        @$this->datereg     	= new DateTime($data['datereg']);
               



            }

        }catch(PDOException $err){
            $this->lastError = $err->getMessage();
        }
        return $data;

    }

    function uploadPhotos($post,$file){

        $validPhotos = array();

        $allowedExts = array("gif", "jpeg", "jpg", "png");

//var_dump($file["error"]);
       
        for($i=0 ;$i<count($file['name']); $i++){
              $filename   = $file["name"][$i];
              $tmp_name   = $file["tmp_name"][$i];
              $type       = $file["type"][$i];
              $size       = $file["size"][$i];
              $error	= $file["error"][$i];
             @$extension   = end(explode(".", $filename));

           if ((($type == "image/gif")
                || ($type == "image/jpeg")
                || ($type == "image/jpg")
                || ($type == "image/pjpeg")
                || ($type == "image/x-png")
                || ($type == "image/png"))
                && ( $size < 8000000 )
                && in_array($extension, $allowedExts)) {

                if ($error <= 0) {
                    $validPhotos[] = array(
                        'tmp_name' =>   $tmp_name,
                        'title'    =>   $filename,
                        'caption'  =>   $post['caption'][$i],
                        'ext'      =>   $extension
                    );

                }else print $error;


            }

        }


        if($validPhotos){
            $q = "INSERT INTO photo (aid, title,caption,ext, date)
            VALUES ";
            foreach($validPhotos as $i => $photo){
                $title = $photo['title'];
                $caption = $photo['caption'];
                $ext = $photo['ext'];
                if($i == 0){
                    $q .= "($this->id, '$title', '$caption', '$ext', NOW())";
                }else{
                    $q .= ", ($this->id, '$title', '$caption', '$ext', NOW())";
                }
                
            }

            if($this->db->exec($q)){
                $id = $this->db->lastInsertId();

               foreach($validPhotos as $i => $photo){
                    $ext = $photo['ext'];
                    $tmp_name = $photo['tmp_name'];
                    $newFilePath = __SITEPATH__."gallery/photos/{$id}.{$ext}";
                    move_uploaded_file($tmp_name, $newFilePath);
                     $id++;
                }
                return count($validPhotos);
            }
            else{
                print 'Database Error!';
                 return false;
            }

        }else{
             print 'No valid photo!';
            return false;
        }





    }



    public function getLastError(){
        return $this->lastError;
    }
    /**
     *
     * @param String $type family(default), company, or managed
     * @return Array
     */



   static function createAlbum($data,$db){

        extract($data);

       
       $q = "INSERT INTO album( name, datereg)
            VALUES (?, NOW())";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$name,PDO::PARAM_STR);
        
            if($r = $stmt->execute()){

                return $db->lastInsertId();
            }

            else {
                 
                return false;

            }


        }catch(PDOException $err){
           // print $this->lastError = $err->getMessage();
        }



    }


static function createPhoto($data,$ext,$id,$db){

        extract($data);

       /// var_dump($filename."hghjjkkjkjl");
       $q = "INSERT INTO photo( aid, info,descr,ext,datereg)
            VALUES (?,?,?,?, NOW())";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$aid,PDO::PARAM_INT);
            $stmt->bindValue(1,$info,PDO::PARAM_STR);
            $stmt->bindValue(1,$descr,PDO::PARAM_STR);
            $stmt->bindValue(1,$ext,PDO::PARAM_STR);
            if($r = $stmt->execute()){

                return $db->lastInsertId();
            }

            else {

                return false;

            }


        }catch(PDOException $err){
           // print $this->lastError = $err->getMessage();
        }



    }

    /**
     *
     * @param unknown $data
     * @param unknown $db
     * @return boolean
     */

  static function update($data,$db){
         extract($data);
       // var_dump($data);
    $q = "UPDATE album SET name = ? WHERE id = ?";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$name,PDO::PARAM_STR);
            $stmt->bindValue(2,$aid,PDO::PARAM_INT);

            if($r = $stmt->execute()  ){
             

                return true;
                }
            else{ return false;

            }


        }catch(PDOException $err){
            $this->lastError = $err->getMessage();
        }



    }


 static function getAlbum($db){
  $data = array();
	 	$q = "SELECT
				*
			FROM album
			ORDER BY datereg DESC";
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


  static function getPhotos($db,$id, $limits = 0){
  $data = array();
   $lim = '';
  if($limits){
      $lim = " LIMIT 0, $limits";
  }
	 	$q = "SELECT
				*
			FROM photo
			WHERE aid = '$id' ORDER BY date DESC  $lim";
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


	private function deleteAlbum(){
print $this->id;
        print $q = "DELETE FROM album WHERE id = ?";
        try{
            $stmt = $this->db->prepare($q);
            
            if($r = $stmt->execute(array($this->id)))
               return $stmt->rowCount();
            else{
            	//print_r( $stmt->errorInfo());
            	return false;
            }

        }catch(PDOException $err){
        	$this->lastError = $err->getMessage();
        }
        //print_r( $this->db->errorInfo());
    }
    
    public function removeAlbum($path){
    	
    	$ids = array();
    	
    	$data = Album::getPhotos($this->db, $this->id);
    	
    	foreach ($data as $row){
    		$ids[] = $row['id'];
    	}
    	
    	if(!$this->name) return false;
    	$num = 0;
    	if($data){
    		$num = $this->unlinkPhoto($data, $path);
    		$this->deletePhotos($ids);
    		
    		
    	}
    	$this->deleteAlbum() or print "Errorrro";
    	return "<b>Ablum:</b> ".$this->name." <b>".$num."</b> Photo(s) were deleted";
    }
    
	private function unlinkPhoto($data,$path){
		//print "PATH: ".$path;
		//var_dump($data);
		$i = 0;
		foreach ($data as $photo){
			
			$id			= $photo['id'];
			$ext		= $photo['ext'];
			$filename	= $path.$id.'.'.$ext;
			
			if(is_file($filename)){
				unlink($filename);
				$i++;
			}
		}
		
		return $i;
	}
	
	 private function photos($ids){
		if(!$ids) return false;
		$id = addslashes(implode(", ", $ids));
		
		$q = "SELECT * FROM photo WHERE aid = ? and id IN ($id) ";
		try{
			
			$stmt = $this->db->prepare($q);
					
			if($r = $stmt->execute(array($this->id))){
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}else {
				
				return false;
			}
		
		
		}catch(PDOException $err){
			 $this->lastError = $err->getMessage();
		}
	}
	
	private function deletePhotos($ids){

 		$id = addslashes(implode(", ", $ids));
 		
        $q = "DELETE FROM photo WHERE aid = ? and id IN ($id)";
        
 		try{
 			
			$stmt = $this->db->prepare($q);
					
			if($r = $stmt->execute(array($this->id))){
				return $stmt->rowCount();
			}else {
				return false;
			}
		
		
		}catch(PDOException $err){
			// print $this->lastError = $err->getMessage();
		}


    }
    
    public function removePhotos($ids, $path) {
    	
    	$num = 0;
    	if($data = $this->photos($ids)){
    	
    		$num =  $this->unlinkPhoto($data, $path);
    		$this->deletePhotos($ids);
    		
    	}
    	
    	return $num;
    }
    
}
?>
