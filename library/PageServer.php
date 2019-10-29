<?php

class PageServer{
		
	var $template ;
	private $autoActive = false;
	private $order = array(), $title;
	var $ext_header = '';
	static $CONTENTBREAK	= 'content'; //content
	static $TITLEBREAK	= 'header';  //header
	static $SITEURL		= __SITEPATH__;
	static $SITENAME		= __SITENAME__;
	function __construct($templateName ='',$title='', $order= array()){
		$this->title = $title;
		if($templateName){
			$this->template = 'includes/'.$templateName.'/' ;
		}else{
			$this->template = 'includes/';
		}
		if($order){
			include $this->template.'config.php';
			$this->autoActive = true;
			$this->order = $order;
			return;
			
		}elseif(is_file(static::$SITEURL.$this->template.'config.php')){
			
			include $this->template.'config.php';
			
			if(isset($config['order'])){
				
				$this->autoActive = true;
				$this->order = $config['order'];
				//$this->auto();
				return;
			}
		}
		
		
		
		
		
		
		
		//include_once $this->template.'/top.php';
		
	}
	
	function start(){
		if($this->autoActive)
			$this->auto();
	}
	function header($title = '', $overide = false){
		if($this->autoActive and $overide == false) return;
		
		include_once $this->template.static::$TITLEBREAK.'.php';
		print '<title>'.$title.' | '.static::$SITENAME.'</title>';
		print $this->ext_header;
	}
	
	function top(){

		if($this->autoActive) return;
		
		include_once $this->template.'top.php';
	}
	
	function banner(){

		if($this->autoActive) return;
		
		include_once $this->template.'banner.php';
	}
	function sidebar(){

		if($this->autoActive) return;
		
		include_once $this->template.'sidebar.php';
	}
	
	function footer(){

		if($this->autoActive) return;
		
		include_once $this->template.'footer.php';
	}
	
	private function auto(){
		$order = $this->order;
		for($i= 0 ; $i < count($order) ; $i++){
			//print $this->template.$order[$i].'.php';
			
			array_shift($this->order);
			if($order[$i] == static::$CONTENTBREAK){
				include_once $this->template.$order[$i].'.php';
				break;
			}
			elseif($order[$i] ==  static::$TITLEBREAK){
				$this->header($this->title, true);
			}else
				include_once $this->template.$order[$i].'.php';
			
		}
	}
	function __destruct(){
		if(!$this->autoActive) return;
		
		for($i= 0 ; $i < count($this->order) ; $i++){
			include_once $this->template.$this->order[$i].'.php';
				
		}
	}
}