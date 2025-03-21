<?php
session_start();
include "connect.php";
if(isset($_POST["bouton"])){
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $req = "select * from user
            where pseudo='$pseudo'
            and mdp='$mdp'";
    $res = mysqli_query($id,$req);
    if(mysqli_num_rows($res)>0){
        $_SESSION["pseudo"] = $pseudo;
        header("location:chat.php");
    }else{
        $erreur = "Erreur de login ou de mot de passe";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_GET["erreur"])) echo "Pour afficher les messages
                                Vous devez d'abord vous connecter<br>";?>
    <h1>Formulaire de connexion</h1><hr>
    <form action="" method="post">
        <?php if(isset($erreur)) echo "<h2>$erreur</h2>";?>
        <input type="text" name="pseudo" placeholder="Pseudo :" required><br><br>
        <input type="password" name="mdp" placeholder="Mot de passe :" required><br><br>
        <input type="submit" value="Connexion" name="bouton">
    </form><hr>
</body>
</html>