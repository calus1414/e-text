<?php
session_start();

include_once '../functions/function.php';


userConnectAccess();

$erreur = '';

try{
    $bdd = new PDO('mysql:host=localhost;dbname=etexte','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(Exception $e){
    die("Erreur : ". $e->getMessage());
}
if (!empty($_POST)) {

    $pseudo = htmlentities($_POST['pseudo']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $mail = htmlentities(strtolower($_POST['email']));
    $password = htmlentities($_POST['password']);
    $second_password = password_hash(htmlentities($_POST['second_password']), PASSWORD_DEFAULT);

    if (!password_verify($password, $second_password)) {

        header("Location: ./signin.php?password=wrong");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $check_pseudo = $bdd->query('SELECT pseudo FROM utilisateur WHERE  pseudo="' . $pseudo . '"');
        $donnee_pseudo =  $check_pseudo->fetch();
        echo $donnee_pseudo;
        if ($pseudo == $donnee_pseudo) {

            header("Location: ./signin.php?pseudo=wrong");
        } else {


            $check_mail = $bdd->query('SELECT email FROM utilisateur WHERE  email="' . $mail . '"');
            $donnee_mail =  $check_mail->fetch();
            if ($mail == $donnee_mail) {

                header("Location: ./signin.php?mail=wrong");
            } else {

                $send = $bdd->prepare('INSERT INTO utilisateur VALUE(?,?,?,?,?,?)');
                $send->execute(array("",  $nom, $prenom , $pseudo,$password, $mail));
            }
        }
    }
}
if(isset($_GET['connect'])){

    if(htmlentities($_GET['connect'] === 'wrong')){

        $erreur =" <p class='alert alert-danger'>Le Pseudo ou le Mot de passe est incorect</p>";
        }
}


$title = "conection";
include_once "../component/header.php";
?>


<main class='container row p-5'>
    <div>
        <form class="row g-3 needs-validation" action='./accueil.php' method='POST' >

            <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">Pseudo</label>
                <div class="input-group has-validation">

                    <input type="text" class="form-control" name='pseudo' id="validationCustomUsername" maxlength="20" aria-describedby="inputGroupPrepend" required>

                </div>
            </div>



            <div class="col-md-12">
                <label for="validationCustom02" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name='password' maxlength="15" id="validationCustom02" required>

            </div>


            <div class="col-12">
            <?= $erreur?>
                <button class="btn btn-primary"  type="submit">Valider</button>
            </div>
        </form>

    </div>

</main>

</body>

</html>