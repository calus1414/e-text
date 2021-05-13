<?php

function makeNav($name, $link, $type){
    if($type === 'card'){
    $nav = '<li class="list-group-item">
    <a class="card-link" aria-current="page" href="'.$link.'">'.$name.'</a>
  </li>';
}else{
    $nav = '<li class="nav-item">
    <a class="nav-link" aria-current="page" href="'.$link.'">'.$name.'</a>
  </li>';
  }
return $nav;
}


function navBar($bool = false){
    if($bool === true){ 
        $nav_bar = makeNav('Accueil', "accueil.php",'card').makeNav('Contact', "contact.php",'card');
       
    }else{
        $nav_bar = makeNav('Accueil', "accueil.php",'nav').makeNav('Contact', "contact.php",'nav');
    }

        
    
    return $nav_bar;
}

function btnConnect($user_online){
    if($user_online){
        $btn = "<li class='nav-link's><a href='logout.php' class='link-danger'>ce deconnecter</a></li>";
    }else{
       $btn = "<li class='nav-link'><a href='signin.php' class='link-secondary'>S'enregistrer</a></li>
       <li class='nav-link's><a href='login.php'class='link-secondary'>ce connecter</a></li>
       "; 
    }
    return $btn;
}


function defaultSession(){
    session_start();

    $_SESSION['unknown'] = ["user" => 'unknown'];
}


?>