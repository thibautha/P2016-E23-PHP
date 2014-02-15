<?php
class Controller{
	protected $tpl;
	protected $model;

	  protected function __construct(){
	    $modelName=substr(get_class($this),0,strpos(get_class($this),'_')+1).'model';
	    if(class_exists($modelName)){
	      $this->model=new $modelName();
	    } 
	  }
	  
	  public function afterroute($f3){
	  	$this->tpl = "layout.htm";
	    echo Template::instance()->render($this->tpl);
	  }
}
?>