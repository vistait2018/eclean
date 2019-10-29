<?php 
class Paging{
	protected $url,$count,$span,$curPage,$rowNum;
	
	private $link,$min, $max;
	var $start,$end,$pagelist;
	private $prev,$next,$first,$last,$output,$width;
	
	function __construct($count,$width="300px",$span=4){
		$this->curPage	= 1;
		$this->rowNum	= 10;
		$this->count	= (int) $count;
		$this->url		= $this->getUrl();
		$this->span		= (int) $span;
		$this->min		= 	1;
		$this->max		= 	1;
		$this->width 	= $width;
		$this->init();
		$this->setPagesNames();
	}
	public function setBaseUrl($base){
		if ($base){
			$this->baseurl = $base;
			$this->link = $base . $this->url;
		}
	}
	private function getUrl(){
		if(preg_match('/\?(pg=)[0-9]*$/', $_SERVER['REQUEST_URI']))
			$url = preg_replace('/\?(pg=)[0-9]*$/', '', $_SERVER['REQUEST_URI']);
		elseif (preg_match('/(&pg=)[0-9]*$/', $_SERVER['REQUEST_URI']))
			$url = preg_replace('/(&pg=)[0-9]*$/', '', $_SERVER['REQUEST_URI']);
		else
			$url = preg_replace('/(pg=)[0-9]*(&)/', '', $_SERVER['REQUEST_URI']);
	
		if (preg_match('/(\?)/', $url))
			$url = $url.'&pg=';
		else
			$url =  $url.'?pg=';
		return $url;
	}
	public function setCurrentPage($cur){
		if(!$cur or !is_int($cur) or $cur ==0 )
			return;
		$this->curPage = $cur;
		$this->init();
	}
	public function setRows($row){
		if(!$row or !is_int($row) or $row == 0 )
			return;
		$this->rowNum = $row;
		$this->init();
	}
	private function init(){
		if(isset($_REQUEST['pg']))
			$this->curPage	= (int)$_REQUEST['pg'];
		
		if (($this->curPage< 0) or ($this->curPage > ceil($this->count/$this->rowNum)))
			$this->curPage = 1;
		
		if(!isset($this->link))
			$this->link		= $this->url;
			
		if (($this->curPage 	-	$this->span)			> 1) 
			$this->min			=	$this->curPage -$this->span;
		else 
			$this->min			= 	1;
		
		$this->max				= 	ceil($this->count/$this->rowNum);
		
		if ($this->curPage		<	$this->max ):
			$this->start		=	($this->curPage-1)		*	$this->rowNum;
			$this->end			=	$this->start			+ 	$this->rowNum;
		elseif ($this->curPage	==	($this->count			/	$this->rowNum)):
			$this->start		=	($this->curPage -1)*	$this->rowNum ;
			$this->end			=	$this->curPage	*	$this->rowNum;
		elseif ($this->curPage	==	$this->max ):
			$this->start		=	($this->curPage - 1)	*	$this->rowNum;
			$this->end			=	$this->start + $this->count	%	$this->rowNum;
		else:
			$this->start		=	0;
			$this->end			=	$this->rowNum;
			$this->curPage		=	1;
		endif;
	}
	function setPagesNames($array= array()){
		$default = array('first'=>'First Page', 'last'=>'Last Page',
				'next'=>'Next', 'prev'=>'Prev');
		if(isset($array['last']))
			$this->last = $array['last'];
		else 
			$this->last = $default['last'];
		
		if(isset($array['next']))
			$this->next = $array['next'];
		else
			$this->next = $default['next'];
		
		if(isset($array['prev']))
			$this->prev = $array['prev'];
		else
			$this->prev = $default['prev'];
		
		if(isset($array['first']))
			$this->first = $array['first'];
		else
			$this->first = $default['first'];
			
	}
	private function output(){
		$out = '';
		//output for first page
		if ($this->curPage == 1)
			$out .= '<td>'.$this->first.'</td>';
		else
			$out .= '<td><a href="'.$this->link.'1">'.$this->first.'</a> | 
					<a href="'.$this->link.($this->curPage-1).'">'.$this->prev.'</a></td>';
		//linklist
		if($this->curPage)
			$this->pagelist[$this->curPage] = $this->curPage;
		//left links

		
		for($i = $this->min; $i < $this->curPage; $i++){
			$out .= '<td><a href="'.$this->link.$i.'">'.$i.'</a></td>';
			$this->pagelist[$i] = $i;//linklist
		}
		
		//center link
		$out .= '<td align="center">'.$this->curPage.'</td>';
		
		//right links
		for($i = $this->curPage+1; $i <= $this->max && $i <= $this->curPage+ $this->span; $i++){
			$out .= '<td><a href="'.$this->link.$i.'">'.$i.'</a></td>';
			$this->pagelist[$i] = $i;//linklist
		}
		
		if ($this->curPage == $this->max){
			$out .= '<td align="right">'.$this->last.'</td>';
		}
		else{
			$out .= '<td align="right"><a href="'.$this->link.($this->curPage+1).'">'.$this->next.'</a>
					 | <a href="'.$this->link.$this->max.'">'.$this->last.'</a></td>';
		}
		//linklist
		if($this->max)$this->pagelist[$this->max] = $this->max;
		return $out;
	}
	function info(){
		$strec = ($this->count == 1)? 'Record':'Records';
		return '<table width="'.$this->width.'">
				<tr><td>Displaying '.($this->start+1).' to '.$this->end.' 
				 of '.$this->count.' '.$strec.'</td></tr></table>';
	}
	function toArray(){
		return array(
				'start'=>$this->start,
				'end'=>$this->end,
				'curPage'=>$this->curPage,
				'pagelist',$this->pagelist
				);
	}
	function __toString(){
		if(!$this->output)
			$this->output = $this->output();
		return '<table width="'.$this->width.'"><tr>'.$this->output.'</tr></table>';
	}
	/**
	 * Special function written for Jquery.navigate by crysto jquery.mobile
	 * @param String $infolink e.g class="navigate" options="option:value" data="data:value<br />
	 * with no trail quote
	 * return String Html anchor link for Navigate
	 */
	function NavigatePage($infolink){
		if (!$infolink) return false;
		$infolink =' data-ajax="false" '. $infolink ;
		
		$pager = $this->toArray();
		$out = '<table data-role="table" class="ui-responsive">';
		if ($this->curPage == 1)
			$out .= '<td>'.$this->first.'</td>';
		else
			$out .= '<td><a href="#" '.$infolink.';pg:1">'.$this->first.'</a> |
					<a href="#" '.$infolink.';pg:'.($this->curPage-1).'">'.$this->prev.'</a></td>';

		for($i = $this->min; $i < $this->curPage; $i++)
			$out .= '<td><a href="#" '.$infolink.';pg:'.$i.'">'.$i.'</a></td>';
			
		
		//center link
		$out .= '<td align="center">'.$this->curPage.'</td>';
		
		//right links
		for($i = $this->curPage+1; $i <= $this->max && $i <= $this->curPage+ $this->span; $i++)
			$out .= '<td><a href="#" '.$infolink.';pg:'.$i.'">'.$i.'</a></td>';
		
		if ($this->curPage == $this->max){
			$out .= '<td align="right">'.$this->last.'</td>';
		}
		else{
			$out .= '<td align="right"><a href="#" '.$infolink.';pg:'.($this->curPage+1).'">'.$this->next.'</a>
					 | <a href="#" '.$infolink.';pg:'.$this->max.'">'.$this->last.'</a></td>';
		}
		return $out.'</table>';
	}
}
	
?>