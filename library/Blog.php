<?php 
/**
 *@name Blog
 * @author perspective pc
 * @uses db
 */
 
class Blog{
    var $author, $title, $content, $registered;
        
        
    private $db, $aid,$lastError;

     
     /**
      * @var $pid int PatientID
      * @var $db Object db (PDO object)
      * @return void
      **/
    function __construct($aid,$db){
        $this->db           	= $db;
        $this->aid          	= $aid;
        $data               	= $this->init();
        
  
       
    	
    }
    function getID(){
    	return $this->aid;
    }
    /**
     * get Patient's Records
     * @return array
     **/
    function init(){
      //$this->db = new db($type, $host, $dbname, $user, $pass);
        $data = array();
        $aid = addslashes($this->aid);
        try{
           $q = "SELECT * FROM  blog WHERE aid = $aid ";
            $r = $this->db->query($q);
            if($data = $r->fetch(PDO::FETCH_ASSOC)){
            	@$this->author   	= $data['author'];
		        @$this->title    	= $data['title'];
		        @$this->content   	= $data['content'];
		        @$this->registered     	= new DateTime($data['registered']);;
		        
		        
		       
            }
            //print_r ($this->db->errorInfo());
        }catch(PDOException $err){
            $this->lastError = $err->getMessage();
        }
       // var_dump($data);
        return $data;

    }
    
   
    
    
    
    public function getLastError(){
        return $this->lastError;
    }
    /**
     * 
     * @param String $type family(default), company, or managed
     * @return Array
     */
	
    static function create($data,$db){
        
        extract($data);
       // var_dump($db);
       $q = "INSERT INTO blog(author, title, content, registered)
            VALUES (?, ?, ?, NOW())";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$author,PDO::PARAM_STR);
            $stmt->bindValue(2,$title,PDO::PARAM_STR);
            $stmt->bindValue(3,$content,PDO::PARAM_STR);
           // $stmt->bindValue(4,$registered,PDO::PARAM_STR);
            
           
            if($r = $stmt->execute()){
                // print_r($stmt->errorInfo()) ;
                return $db->lastInsertId();
               
                
                }
        else { 
            // print_r($db->errorInfo()) ;
            return false;
            
        }
            
             
        }catch(PDOException $err){
           // print $this->lastError = $err->getMessage();
        }

        
        
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

    /**
     * 
     * @param unknown $data
     * @param unknown $db
     * @return boolean
     */
  static function update($data,$db){
         extract($data);
        //var_dump($db);
        //var_dump($data);
     $aid  = (int)$aid;
         
        // $dob = $Day."-".$Month."-".$Year;
      $q = "UPDATE blog SET title = ?, 
                author = ?,content = ?, registered = NOW() WHERE aid = ?";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$title,PDO::PARAM_STR);
            $stmt->bindValue(2,$author,PDO::PARAM_STR);
            $stmt->bindValue(3,$content,PDO::PARAM_STR);
           // $stmt->bindValue(3,$registered,PDO::PARAM_STR);
            $stmt->bindValue(4,$aid,PDO::PARAM_INT);
            
            
            
            
            if($r = $stmt->execute())
                return true;
            else return false;
            
             
        }catch(PDOException $err){
            $this->lastError = $err->getMessage();
        }

        
        
    }
    
    
  static function getAll($db, $clause=''){
  $data = array();
	 	$q = "SELECT
				*
			FROM blog
			 ";
		if ($clause)
			$q .= " WHERE( $clause ) ORDER BY registered DESC";
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
  
    
    static function getRecentArticle($db){
    	$data = array();
    	
    	$q = "SELECT
				*
			FROM blog
			  ORDER BY registered DESC LIMIT 0, 1 ";
    	
    		
    	try{
    		if($r = $db->query($q))
    			$data = $r->fetch(PDO::FETCH_ASSOC);
    		// print_r ($db->errorInfo());
    	}catch(PDOException $err){
    		// print $this->lastError = $err->getMessage();
    	}
    	//print_r($db->errorInfo());
    	return $data;
    
    
    }
    
     
   
    }
?>
