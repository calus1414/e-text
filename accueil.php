<?php

session_start();

include_once 'functions/function.php';

userUnconnectAccess();

$title = "Accueil";







try {
    $bdd = mysqli_connect('localhost','root', '','etexte', "3306" );
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

if (isset($_POST['pseudo']) || isset($_POST['password'])) {
    $pseudo = htmlentities($_POST['pseudo']);
    $password = htmlentities($_POST['password']);

    $call_donnees = mysqli_query($bdd,'SELECT * FROM utilisateur WHERE pseudo = "'. $pseudo .'"');
    $check_donnees = mysqli_fetch_array($call_donnees, MYSQLI_ASSOC);
    if (password_verify($password, $check_donnees['password'])) {


        $_SESSION['user'] = [
            "id" => $check_donnees['id'],
            "pseudo" => $check_donnees['pseudo'],
            "nom" => $check_donnees['nom'],
            "prenom" => $check_donnees['prenom'],
            'email' => $check_donnees['email'],
            "role" => "normal",
            "connect" => 'true'



        ];
    } else {

        header('Location: login.php?connect=wrong');
    }
}

 

if (isset($_POST['user-message'])) {

    sendMessage($bdd, $_SESSION['user']['id'], $_POST['user-message']);
}

if(isset($_POST['destinataire_pseudo'])){

    
    $user = htmlentities($_POST['destinataire_pseudo']);
    


}

include_once "./page/header.php";

?>
<main class="container-xxl row p-5">
    <div class='col-8'>

        <h4>Bonjour et bienvenu a toi <?= $_SESSION['user']['prenom'] ?></h4>
        <a href="accueil.php"><input type="button" class='btn btn-info'value="rafraichir"></a>
        <div class='row'>
            <div id='messages'class='messages col-12'>
                <?php
                showMessage($bdd);
                ?>
            </div>
            <div class='text col-12'>
                <form action="messagerie.php" class='row' method="post" autofocus>

                    <textarea name="user-message"class='form-control' id="" cols="80" rows="3"></textarea>

                    <input type="submit" class='btn btn-info'value="Envoyer">
                </form>


            </div>
        </div>

    </div>
    <?php
    include_once './page/aside.php';
    ?>
</main>


<script src="app.js"></script>
<?php
include_once './page/footer.php';
?>