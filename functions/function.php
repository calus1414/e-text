<?php
function makeNav($name, $link, $type)
{
    if ($type === 'card') {
        $nav = '<li class="list-group-item">
    <a class="card-link" aria-current="page" href="' . $link . '">' . $name . '</a>
  </li>';
    } else {
        $nav = '<li class="nav-item">
    <a class="nav-link" aria-current="page" href="' . $link . '">' . $name . '</a>
  </li>';
    }
    return $nav;
}


function navBar($bool = false)
{
    if (!empty($_SESSION['user']['pseudo'])) {
        if ($bool === true) {
            $nav_bar = makeNav('Accueil', "./accueil.php", 'card') . makeNav('Contact', "./contact.php", 'card');
        } else {
            $nav_bar = makeNav('Accueil', "./accueil.php", 'nav') . makeNav('Contact', "./contact.php", 'nav')."<li><div class='btn-group'>
            <button class='btn btn-info-light btn-lg dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
              Paramètre
            </button>
            <ul class='dropdown-menu'>
              <li><a class='dropdown-item' href='new_password.php'>Nouveau mot de passe</a></li>
            </ul>
          </div></li>";
        }
        return $nav_bar;
    }
}

function btnConnect($user_online)
{
    if ($user_online) {
        $btn = "<li class='nav-link's><a href='../logout.php' class='link-danger'>ce deconnecter</a></li>";
    } else {
        $btn = "<li class='nav-link'><a href='signin.php' class='link-secondary'>S'enregistrer</a></li>
       <li class='nav-link's><a href='./login.php'class='link-secondary'>ce connecter</a></li>
       ";
    }
    return $btn;
}


function defaultSession()
{
    session_start();

    $_SESSION['unknown'] = ["user" => 'unknown'];
}




function sendMessage($base, $id, $message)
{


    $message = htmlentities($message);
    $heure = date("H:i:s");
    $date = date("Y-m-d");
    $nothing = "";

    $send = mysqli_prepare($base, 'INSERT INTO message VALUE(?,?,?,?,?)');
    mysqli_stmt_bind_param($send, "sisss", $nothing, $id, $message, $date, $heure);
    mysqli_stmt_execute($send);
}

function showMessage($base)
{

    $message = mysqli_query($base, "SELECT  message , date,heure, pseudo
FROM message
INNER JOIN utilisateur ON message.utilisateur_id = utilisateur.id order by message.id ");

    while ($donnees = mysqli_fetch_array($message, MYSQLI_ASSOC)) {
       


echo  '<div class="message">
<form action="
" method="post">
<button type="submit" class="btn  btn-message" >
<div class="row">
<div class="col-2"><strong>' . $donnees['pseudo'] . '</strong></div>
<div class="col-8 "><p class="p-4">' . $donnees['message'] . '</p></div>
 <div class="col-2">
 <input type="hidden" name="destinataire_pseudo" value="' . $donnees['pseudo'] . '">
 ' . $donnees['date'] . ' ' . $donnees['heure'] . '
</div>
</div>

</button></form>


</div>
<br>';

    }
}


function sendPrivateMessage($base, $id_destinataire,$id_utilisateur, $message)
{


    $message = htmlentities($message);
    $heure = date("H:i:s");
    $date = date("Y-m-d");
    $nothing = "";

    $send = mysqli_prepare($base, 'INSERT INTO message_perso VALUE(?,?,?,?,?,?)');
    mysqli_stmt_bind_param($send, "ssssii", $nothing , $message, $date, $heure,$id_destinataire,$id_utilisateur);
    mysqli_stmt_execute($send);
}


function showPrivateMessage($base,$destinataire,$user,$pseudo_destinataire,$pseudo_user){

    $message = mysqli_query($base,"SELECT message , date,heure,id_utilisateur
FROM message_perso
WHERE (id_utilisateur = $user AND id_destinataire = $destinataire) 
 OR (id_destinataire = $user AND id_utilisateur = $destinataire)
  order by id ");



    while ($donnees = mysqli_fetch_array($message, MYSQLI_ASSOC)){
        $pseudo ="";
if($destinataire === $donnees['id_utilisateur']){
    $pseudo = $pseudo_destinataire;
}else{
    $pseudo = $pseudo_user;
}
        echo '<div class="message">
        <form action="
        " method="post">
        <button type="submit" class="btn  btn-message" >
        <div class="row">
        <div class="col-2"><strong>'.$pseudo.'</strong></div>
        <div class="col-8 "><p class="p-4">'.$donnees['message'].'</p></div>
         <div class="col-2">
         <input type="hidden" name="destinataire_pseudo" value="'.$pseudo.'">
         '.$donnees['date'].' '.$donnees['heure'].'
        </div>
        </div>
        
        </button></form>

        
        </div>
        <br>';
    }
}


function userUnconnectAccess()
{
  
    if(!isset($_SESSION['user']['connect'])){
        header('Location: ./login.php');
    }

       
} 


function userConnectAccess()
{
    

    
    if(isset($_SESSION['user']['connect'])){
        header('Location: ./accueil.php');
    }

}  
       
    

