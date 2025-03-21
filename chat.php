<?php

session_start();
if(!isset($_SESSION["pseudo"])){
    header("location:connexion.php?erreur=1");
}

$id = mysqli_connect("localhost", "root", "", "chatbox");
$pseudo = $_SESSION["pseudo"];
if(isset($_POST["bouton"])){
    $message = $_POST['message'];
    $destinataire = $_POST['destinataire'];
    $requete = "insert into messages (pseudo,message,date,destinataire)
                values ('$pseudo','$message',now(),'$destinataire')";
    mysqli_query($id,$requete);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylechat.css">
</head>
<body>
    <div class="container">
        <h1>Bonjour <?=$_SESSION["pseudo"]?>, Chattez'en direct! Chatbox
        <a href="deconnexion.php"><img src="quit.png" width="20"></a></h1>
        <div class="messages">
            Suppression des messages 
            <a href="delete.php"><img src="sup.jpg" width="15"></a>
            <ul>
                <?php
                
                $resultat = mysqli_query($id, "select * from messages
                                               where destinataire='$pseudo'
                                               or destinataire='tous'
                                               order by date desc");
                while($ligne = mysqli_fetch_assoc($resultat)){
                    $pseudo = $ligne["pseudo"];
                    $message = $ligne["message"];
                    $date = $ligne["date"];
                    echo "<li class='mess'>$date - $pseudo : $message</li>";
                }
                ?>
                
            </ul>
        </div>
        <div class="formulaire">
            <form action="" method="post">
                
                <input type="text" name="message" placeholder="Message :" required>
                <select name="destinataire">
                    <option value="" selected disabled>Choisir un destinataire :</option>
                    <option value="tous">Tout le monde</option>
                    <?php
                        $req2 = "select * from user";
                        $res2 = mysqli_query($id,$req2);
                        while ($ligne2 = mysqli_fetch_assoc($res2)) {  
                            $pse = $ligne2['pseudo']; 
                    ?>
                    <option value="<?=$pse?>"><?=$pse?></option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" value="Envoyer" name="bouton">
            </form>
        </div>
    </div>
</body>
</html>