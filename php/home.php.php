<?php





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

if(isset($_POST["send"])){
    if(isset($_POST['message'])){
        if(!empty($_POST['message'])){
            if(strlen($_POST['message']) <= 500){
                $message = htmlspecialchars($_POST['message']);
                $req = $bdd-> prepare("INSERT INTO messages(user_id, message) VALUES (?,?)");
                $req-> execute(array($_SESSION['user']['id'], $message));
            }else{
                $error = "Votre message doit faire moins de 500 charactère";
            }
         
        }else{
            
            $error = "Vous devez entrer un message !";
        }
    }
}

$msgs = $bdd->query("SELECT * FROM messages");




require_once "./view/home.view.php";

?>