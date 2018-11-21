<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');



header("Location: /CODE/Shop/Shop.php?ID=".$_SESSION['ID']);
?>