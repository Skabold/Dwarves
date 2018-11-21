<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');


//charge le power
$reqdwa = $bdd->prepare("SELECT * FROM dwarves WHERE FID = ? AND alive=?");
$reqdwa->execute(array($_SESSION['FID'],1));
$userdwa = $reqdwa->fetch();
$_SESSION['power'] = $userdwa['power'];


//redirection
header("Location: /CODE/Character.php?ID=".$_SESSION['ID']);
?>