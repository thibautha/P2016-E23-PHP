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
	    $mimeTypes=array('html'=>'text/html','json'=>'application/json');
	    $tpl=$f3->get('AJAX')?$this->tpl['async']:$this->tpl['sync'];
	    $ext=substr($tpl,strrpos($tpl,'.')+1);
	    $mime=$mimeTypes[$ext];
	    echo View::instance()->render($tpl,$mime);
	  }
	}
}
?>