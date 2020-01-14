<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./../assets/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Chat secours</title>
</head>
<body>
<header><?php require_once "./assets/includes/header.inc.php"; ?></header>
    <div id="content">
  
  
        <a href="./logout.php">Déconnection</a>
        <a href="./membres/profil.php?user=<?= $users['id'] ?> "> Mon compte</a>
        
        <div id="chatLo">

    
        
       
            <div id="msgs" style="overflow:scroll">
                <?php while($msg = $msgs->fetch()) { ?>

                <b><?= $msg["user_id"] ?> </b> : <span class="message"> <?= $msg["message"]?><br>
                <?php }?>
            </div>
            
            <div class="form">
            

                <form method="POST" action="">
                    <input type="text" name="message" placeholder="message"/>
                    <button type="submit" name="send">Envoyer</button>
                </form>
            </div>
        </div>
       

        
    </div>
    
</body>
</html>