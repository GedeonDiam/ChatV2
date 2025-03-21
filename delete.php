<?php
session_start();
include "connect.php";
$pseudo = $_SESSION["pseudo"];
$req = "delete from messages where destinataire='$pseudo'";
mysqli_query($id, $req);
header("location:chat.php");
?>