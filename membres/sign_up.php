<!DOCTYPE html>
<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=chatbox; charset=utf8", "root", "root");

if(isset($_POST["send"])){
    if(isset($_POST['email']) AND isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['password_confirm'])){
        if(!empty($_POST['email']) AND !empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['password_confirm'])){
            $email = trim(htmlspecialchars($_POST['email']));
            $username = trim(htmlspecialchars($_POST['username']));
            $password = trim(htmlspecialchars($_POST['password']));
            $password_confirm = trim(htmlspecialchars($_POST['password_confirm']));



            if(strlen($email) <= 255){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if(strlen($username) >= 3 AND strlen($username) <= 255){
                        if(strlen($password) >= 8 AND strlen($password) <= 100){
                            if($password== $password_confirm){
                                // me permet de crypter mon mdp avec la méthode sha1
                                $password_crypted = sha1($password);
                                // une fois toutes mes valeurs vérifier je fais une requête sql
                                $req = $bdd->prepare("INSERT INTO users(email,username, password) VALUES (?,?,?)");
                                $req->execute(array($email,$username,$password_crypted));
                                $error = "votre compte a été créé avec succés";
                                header ('location: ../tchat.php');
                            }else{
                                $error = "Les mots de passe ne correspondent pas !";
                            }

                        }else{
                            $error= "Votre mot de passe doit être compris entre 8 et 100 carctères";
                        }

                    }else{
                        $error= " Votre username doit être compris entre 3 et 255 caractères !";
                    }

                }else{
                    $error= "Votre email n'est pas au bon format !";
                }

            }else{
                $error = "Votre mail possède trop de caractère !";
            }
        }else{
            $error= "Veuillez remplir les champs !";
        }
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
            <label>Votre Email : </label>
            <input type="email" name="email"/>
        </div>
        <div>
            <label>Votre pseudo : </label>
            <input type="text" name="username"/>
        </div>
        <div>
            <label>Votre mot de passe : </label>
            <input type="password" name="password"/>
        </div>
        <div>
            <label>confirmez votre mdp : </label>
            <input type="password" name="password_confirm"/>
        </div>
        <div>
            <button type="submit" name="send">Envoyer</button>
        </div>

    </form>
    <?php if(isset($error)) { echo $error ;} ?>


    <nav>
        <a href="./login.php">Déjà un compte ? Connectez-vous !</a>
    </nav>



    <footer></footer>
</body>
</html>