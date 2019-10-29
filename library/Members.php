<?php 
/**
 *@name Member
 * @author Perpective-Pc crysto
 * @uses db
 */
 
class Members{
    var $firstname, $middlename, $lastname, $address,$dob,$sex, $phone,
        $email,$date,$fid,$wa,$ms;
        
        
    private $db, $mid,$lastError;

     
     /**
      * @var $pid int MembersID
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
     * get Member's Records
     * @return array
     **/
    function init(){
      //$this->db = new db($type, $host, $dbname, $user, $pass);
        $data = array();
        $mid = addslashes($this->mid);
        try{
           $q = "SELECT * FROM  members WHERE mid = '$mid'";
            $r = $this->db->query($q);
            if($data = $r->fetch(PDO::FETCH_ASSOC)){
            	@$this->firstname   	= $data['firstname'];
		        @$this->lastname    	= $data['lastname'];
		        @$this->middlename   	= $data['middlename'];
		        @$this->address     	= $data['address'];
		        @$this->sex    	= $data['sex'];
		        @$this->ms        	= $data['ms'];
		        @$this->phone         	= $data['phone'];
		        @$this->email      	= $data['email'];
		        @$this->fid      	= $data['fid'];
		        @$this->dob      		= $data['dob'];
		        @$this->wa   		= $data['wa'];
		        @$this->date    	= new DateTime($data['date']);
		       
		       
            }
            
        }catch(PDOException $err){
            $this->lastError = $err->getMessage();
        }
        return $data;

    }
    
    static function gettUnitName($uid,$db){
    	//$this->db = new db($type, $host, $dbname, $user, $pass);
    	$data = array();
	 	$q = "SELECT
				unitname
			FROM unit
			
		 WHERE unitid = '$uid'";
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
    
  
    
    public function getLastError(){
        return $this->lastError;
    }
    
	
    
    static function create($data,$db){
        
        extract($data);
       //  var_dump($data);
       if(empty($wa)) $wa = NULL;
        
   		$q = "INSERT INTO members (firstname, middlename, lastname, address,  sex,
            ms, phone,email, fid,dob, wa,date)
            VALUES (?, ?, ?,?, ?, ?,?, ?, ?,?,?,NOW())";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$firstname,PDO::PARAM_STR);
            $stmt->bindValue(2,$middlename,PDO::PARAM_STR);
            $stmt->bindValue(3,$lastname,PDO::PARAM_STR);
            $stmt->bindValue(4,$address,PDO::PARAM_STR);
            $stmt->bindValue(5,$sex,PDO::PARAM_STR);
            $stmt->bindValue(6,$ms,PDO::PARAM_STR);
            $stmt->bindValue(7,$phone,PDO::PARAM_STR);
            $stmt->bindValue(8,$email,PDO::PARAM_STR);
            $stmt->bindValue(9,$fid,PDO::PARAM_STR);
            $stmt->bindValue(10,$dob,PDO::PARAM_STR);
            $stmt->bindValue(11,$wa);
            if($r = $stmt->execute()){
            	
                return $db->lastInsertId();}
            else{ 
            	print_r($stmt->errorInfo());
            	return false;
            	
            }
            
             
        }catch(PDOException $err){
        	//print_r ($db->errorInfo());
           // print $this->lastError = $err->getMessage();
        }

        
        
    }
  
    
    static function createunit($data,$db){
    
    	extract($data);
    	//var_dump($data);
    	//print($_POST);
    
    	  $q = "INSERT INTO unit (unitname, date)
            VALUES (?,NOW())";
    	try{
    		$stmt = $db->prepare($q);
    		$stmt->bindValue(1,$unitname,PDO::PARAM_STR);
    		
    		if($r = $stmt->execute())
    			return $db->lastInsertId();
    		//print $this->lastError = $err->getMessage();
    		else return false;
    		//print $this->lastError = $err->getMessage();
    		 
    	}catch(PDOException $err){
    		print $this->lastError = $err->getMessage();
    	}
    
    
    
    }
     /**
      * Deprecated
      * @param unknown $data
      * @param unknown $db
      * @return boolean
      */
    
   /**
    * 
    * @param Db $db
    * @param string $clause
    * @param number $status
    * @return multitype:
    */
static function getAll($db, $clause=''){
  $data = array();
	 	$q = "SELECT
				*
			FROM members
			 ";
		if ($clause)
			$q .= " WHERE( $clause ) ORDER BY firstname DESC";
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
  
   
    static function getAllUnits($db){
    	$data = array();
    	$q = "SELECT
				*
			FROM unit
			 ORDER BY date DESC";
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
    

    /**
     * 
     * @param unknown $data
     * @param unknown $db
     * @return boolean
     */
    static function update($data,$db,$mid){
         extract($data);
        //var_dump($db);
        //var_dump($data);
         
        // $dob = $Day."-".$Month."-".$Year;
        $q = "UPDATE members SET firstname = ?, 
                lastname = ?, middlename = ?, address =?, dob =?, sex =?,
           ms= ?, phone = ?, email = ?,fid = ?,wa = ?, date = NOW() WHERE mid = ?";
        try{
            $stmt = $db->prepare($q);
            $stmt->bindValue(1,$firstname,PDO::PARAM_STR);
            $stmt->bindValue(2,$lastname,PDO::PARAM_STR);
            $stmt->bindValue(3,$middlename,PDO::PARAM_STR);
            $stmt->bindValue(4,$address,PDO::PARAM_STR);
            $stmt->bindValue(5,$dob,PDO::PARAM_STR);
            $stmt->bindValue(6,$sex,PDO::PARAM_STR);
            $stmt->bindValue(7,$ms,PDO::PARAM_STR);
            $stmt->bindValue(8,$phone,PDO::PARAM_STR);
            $stmt->bindValue(9,$email,PDO::PARAM_STR);
            $stmt->bindValue(10,$fid,PDO::PARAM_STR);
            $stmt->bindValue(11,$wa,PDO::PARAM_STR);
            $stmt->bindValue(12,$mid,PDO::PARAM_INT);
            
            
            
            
            if($r = $stmt->execute())
                return true;
            else return false;
            
             
        }catch(PDOException $err){
            $this->lastError = $err->getMessage();
        }

        
        
    }
    
    static function updateUnit($data,$db){
    	extract($data);
    	//var_dump($data);
    	 $unitname = $_POST['unitname'];
    	 $unitID = $_POST['uid'];
    	
   	$q = "UPDATE unit SET unitname = ? WHERE unitID = ?";
    	try{
    		 $stmt = $db->prepare($q);
    		
            $stmt->bindValue(1,$unitname,PDO::PARAM_STR);
            $stmt->bindValue(2,$uid,PDO::PARAM_INT);
    
    
    
    		if($r = $stmt->execute())
    			
    			return true;
    		else {
    			// print_r ($stmt->errorInfo());
    			return false;
    		}
    
    		 
    	}catch(PDOException $err){
    		$this->lastError = $err->getMessage();
    	}
    
    
    
    }
    
      
    static function createunitMember($data,$db){
    
    	extract($data);
    	//var_dump($data);
    	//print 'mid = '.($_POST['mid']);
    
    	$q = "INSERT INTO unitmembers (unitid, mid,role)
            VALUES (?,?,?)";
    	try{
    		$stmt = $db->prepare($q);
    		$stmt->bindValue(1,$unitid,PDO::PARAM_INT);
    		$stmt->bindValue(2,$mid,PDO::PARAM_INT);
    		$stmt->bindValue(3,$role,PDO::PARAM_STR);
    
    		if($r = $stmt->execute()){
    			return $db->lastInsertId();
    		print_r ($db->errorInfo());
    		}
    		else return false;
    		print_r ($db->errorInfo());
    		 
    	}catch(PDOException $err){
    		print $this->lastError = $err->getMessage();
    	}
    
    
    
    } 
    static function checkInUnit($db,$unitid,$mid){
    	$data = array();
    	$q = "SELECT
				*
			FROM unitmembers WHERE mid = '$mid' and unitid ='$unitid'
			 ";
    	
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
    static function listUnitMembers($db,$unitid){
    	$data = array();
    	$unitid = (int) $unitid;
    	$q = "SELECT members.mid,
    	members.lastname,
    	members.firstname,
    	members.middlename,
    	members.sex,
    	members.address,
    	members.phone,
    	unitmembers.role as role,
    	unit.unitname as unit,
    	unit.unitid as unitid
    	FROM members
    	LEFT JOIN  unitmembers ON unitmembers.mid = members.mid
    	LEFT JOIN unit ON unitmembers.unitid = unit.unitid
    	
    	 
    	WHERE
    	unit.unitid = '$unitid' ";
      		
    	
    	try{
    		
    		if($r = $db->query($q))
    			$data = $r->fetchAll(PDO::FETCH_BOTH);
    	}catch(PDOException $err){
    		$this->lastError = $err->getMessage();
    	}
    	return $data;
    }
    
    static function deleteUnitMember($unitids, $db){
    	
    	if(!$unitids) return false;
    	
    	$unitid = (count($unitids) == 1)? $unitids[0]: addslashes(implode(", ", $unitids));
    	
    	$q = "DELETE FROM unitmembers WHERE unitid IN ($unitid) ";
    	//$q = "DELETE FROM unitmembers WHERE unitid = ?";
    	try{
    		$stmt = $db->prepare($q);
					
			if($r = $stmt->execute(array($unitids))){
				//print_r ($db->errorInfo());
			return $stmt->rowCount();
			}
    		else {
    			//print_r ($db->errorInfo());
    			return false;
    		}
    		
    		 
    	}catch(PDOException $err){
    		$this->lastError = $err->getMessage();
    		print_r ($db->errorInfo());
    	}
    }
  
    
    
    static function getAllBirthdays($db){
    	//print $month = date(dm);
    	$data = array();
    	$q = "SELECT
				*
			FROM members
			WHERE  MONTH(dob) = MONTH(Now()) and DAY(Now()) = DAY(Now())  ORDER BY firstname DESC";
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
    
    
    static function getAllWADay($db){
    	
    	$data = array();
    	$q = "SELECT
				*
			FROM members
			 WHERE MONTH(wa) = MONTH(Now()) and DAY(Now()) = DAY(Now())  ORDER BY firstname DESC";
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
    
    
    static function getAllWAMonth($db, $clause=''){
    	
    	$data = array();
    	$q = "SELECT
				*
			 WHERE MONTH(wa) = MONTH(Now()) and DAY(Now()) = DAY(Now())  ORDER BY firstname DESC";
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
    
}
    


?>
