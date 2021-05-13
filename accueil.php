<?php

  session_start();
 include_once 'functions/function.php';
$user_online = false;
$unknow = 'nouvelle arrivant';
$unknow_name = 'Doe';
$unknow_surname = 'Jhon';
$unknow_mail = "Exemple.****@gmail.com";
$title = "Accueil";








try {
    $bdd = new PDO('mysql:host=localhost;dbname=etexte', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

if (!empty($_POST)) {
    $pseudo = htmlentities($_POST['pseudo']);
    $password = htmlentities($_POST['password']);

    $call_donnees = $bdd->query('SELECT * FROM utilisateur WHERE pseudo = "' . $pseudo . '"');
    $check_donnees = $call_donnees->fetch();
    if (password_verify($password, $check_donnees['password'])) {
        
        
        $_SESSION['user'] = [
            "pseudo" => $check_donnees['pseudo'],
            "nom" => $check_donnees['nom'],
            "prenom" => $check_donnees['prenom'],
            'mail' => $check_donnees['mail'],
            "role" => "normal"


        ];

        
    } else {

        header('Location: login.php?connect=wrong');
    }
}




include_once "./page/header.php";


?>

<main class="container row p-5">

<div class='col-8'>
<h1>Bonjour et bienvenu a toi <?= ($_SESSION['user']['prenom'] ?? $unknow )?></h1>
</div>
<?php 
include_once './page/aside.php';
?>
</main>

</body>

</html>