<?php
class App_controller{



  function __construct(){
    
  }
  
  function home($f3){
    $f3->set('content','partials/home.html');
    //echo View::instance()->render('main.html');
            $template=new Template;
        echo $template->render('main.html');

  } 

  function getMember($f3){
    $f3->set('content','partials/member.html');
  //echo View::instance()->render('main.html');
            $template=new Template;
        echo $template->render('main.html');
  }

  function getUser($f3){
        $f3->set('content','partials/users.html');
  //echo View::instance()->render('main.html');
            $template=new Template;
        echo $template->render('main.html');

  }

  function getNotification($f3){
        $f3->set('content','partials/notification.html');
    //echo View::instance()->render('main.html');
  //echo View::instance()->render('main.html');
            $template=new Template();
        echo $template->render('main.html');

  }

  function getResult($f3){
        $f3->set('content','partials/res.html');
  //echo View::instance()->render('main.html');
            $template=new Template;
        echo $template->render('main.html');

  }
}
?>