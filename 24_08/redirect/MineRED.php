<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');


//chargement données utiles mines : stone + energy

$reqres = $bdd->prepare("SELECT * FROM ressources WHERE ID = ?");
$reqres->execute(array($_SESSION['ID']));
$userres = $reqres->fetch();
$_SESSION['stone'] = $userres['stone'];


$reqdw = $bdd->prepare("SELECT * FROM dwarves WHERE alive = ? AND FID = ?");
$reqdw ->execute(array(1,$_SESSION['FID']));
$userdwa = $reqdw->fetch();
$_SESSION['energy'] = $userdwa['energy'];







//redirection
header("Location: /CODE/Mine.php?ID=".$_SESSION['ID']);
?>