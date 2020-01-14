<!DOCTYPE html>
<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=chatbox; charset=utf8", "root", "root");
if(isset($_POST['confirm_login'])){
    if(isset($_POST['email']) AND isset($_POST['password'])){
        if(!empty($_POST['email']) AND !empty($_POST['password'])){
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));
            // une fois les vérifications faites je n'oublie pas ma bdd
            $req = $bdd->prepare("SELECT * FROM users WHERE email = ? AND password= ?");
            $req->execute(array($email, sha1($password)));

            if($req->rowCount() == 1){
                $user = $req->fetch();
                $_SESSION['user'] = $user;
                
                header ('location: ../tchat.php');
            }else{
                $error = "Email ou mot de passe incorrect";
            }
        }else{
            $error= "Les champs ne peuvent être vide !";
           
        }

    }else{
        $error = "Erreurs";
    }
}


?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
</head>
<body>
    <header></header>
    <h1>S'inscrire</h1>
    <form method="POST" action="">
        
        <div>
            <label>Votre email : </label>
            <input type="email" name="email"/>
        </div>
        <div>
            <label>Votre mot de passe : </label>
            <input type="password" name="password"/>
        </div>
        
        <div>
            <button type="submit" name="confirm_login">Envoyer</button>
        </div>

    </form>
    <?php if(isset($error)) { echo $error ;} ?>


    <nav>
        <a href="sign_up.php">Pas de compte ? Inscrivez-vous !</a>
    </nav>



    <footer></footer>
</body>
</html>