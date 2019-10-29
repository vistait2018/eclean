<?php
//namespace com\crysto;
/**
 *
 * @author crysto
 *
 */


class Db extends \PDO{
	protected  $type, $host, $dbname, $dsn, $extra,$db;
	function __construct($type,$host,$dbname,$user,$pass,$options=null,$extra=null){
		//'mysql:host=localhost;dbname=test', $user, $pass
		$this->type = $type;
		$this->host = $host;
		$this->dbname = $dbname;
		$this->extra = $extra;
		$this->init(strtolower($type));
		try{
			if(!$this->dsn){
				//throw new \PDOException('no dns supplied');
			}else
			parent::__construct($this->dsn, $user, $pass, $options);
		}catch (PDOException $err){
			echo $err->getMessage();
		}

	}
	private function init($type){
		switch ($type):
		case 'mysql': $this->mysql(); break;
		case 'sqlite2':
			$this->sqlite(2);
			break;
		case 'sqlite3': $this->sqlite(3) ; break;
		endswitch;

	}
	private function mysql(){
		$this->host = (!$this->host)? 'localhost': $this->host;
		$this->dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
	}
	private function sqlite($ver){
		$protocol = ($ver == 2)? 'sqlite2:': 'sqlite:';
		$sitedir = preg_replace('/[[:alpha:]]:\//', '',
				dirname($_SERVER['SCRIPT_FILENAME']));//remove C:/ in windows
		switch(strtolower($this->host)){
			case 'localhost':
				$this->host = '/'.$sitedir.'/';
				$this->dbname .='.db';
				break;
			case '': $this->host = '/'.$sitedir.'/';
			$this->dbname .='.db';
			break;
			case 'memory':
				$this->host = ':memory:';
				$this->dbname = '';
				break;
			default  :
				$this->host = rtrim($this->host,'/\\');
				$this->host = $this->host.'/';
				$this->dbname .='.db';
		}
		$this->host = (strtolower($this->host) == 'localhost' or '')? $sitedir: $this->host;
		$this->dsn = $protocol.$this->host.$this->dbname;

	}

}