<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');


header("Location: /PHPalgo/MiningAlgo.php?ID=".$_SESSION['ID']);
?>