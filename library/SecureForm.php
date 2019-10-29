<?php
class SecureForm{
	private $id,$name;
	function __construct($name='secureform'){
		$a = array('A','B','C','D','E');
		shuffle($a);
		$a1 = $a[1];shuffle($a);
		$a2 = $a[1];shuffle($a);
		$a3 = $a[1];
		$id = rand(1000,9999).$a1.rand(0,9).$a2.rand(10,99).$a3.rand(100,999);
		$this->id = $id;
		$this->name = $name;
		
	}
	public function check(){
		$name = $this->name;
		
		if(@$_POST[$name] == @$_SESSION['secureform'][$name]){
			$_SESSION['secureform'][$name] = $this->id;
			return TRUE;
		}else{
			print '<div class="userexc">Please!!! do not reload this form.<br/>
				click <a href="'.$_SERVER['PHP_SELF'].'">here</a> to return</div>';
			return false;
		}

		
	}
	public function htmlInput(){
		$name = $this->name;
		$_SESSION['secureform'][$name] = $this->id;
		print '<input type="hidden" name="'.$name.'" value="'.$this->id.'" />'; 
		
	}
	
}