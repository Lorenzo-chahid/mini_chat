<!DOCTYPE html>
<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=chatbox; charset=utf8", "root", "root");

if($_GET['user']){
    $id= htmlspecialchars($_GET['user']);

    $req = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $req->execute(array($id));


    if($req ->rowCount() == 1){
        $user = $req->fetch();

    }else{
        $error ="utilisateur introuvable";
    }

}else{
    $error= "Aucun utilisateur de précisé";
}
if(isset($_SESSION['user'])){
    if($_SESSION['user']['id'] == $user['id']){
        $set= 1;
    }else{
        $set = 0;
    }

}else{
    $set = 0;
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
</head>
<body>
    <header></header>
    <h1> Page de profil </h1>
    <div>
        <div>Pseudo : <?= $user['username']; ?></div>
        <div>email : <?= $user['email']; ?></div>
        <?php if($set == 1) { ?>
        <a href="setup.php">Modifier mes informations</a>
        <?php } ?>
        


    </div>
    



    <footer>
        <?php if(isset($error)) { echo $error ;} ?>
    </footer>
</body>
</html>