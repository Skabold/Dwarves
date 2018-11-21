<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');


//charge le power
$reqdwa = $bdd->prepare("SELECT * FROM dwarves WHERE FID = ? AND alive=?");
$reqdwa->execute(array($_SESSION['FID'],1));
$userdwa = $reqdwa->fetch();
$_SESSION['power'] = $userdwa['power'];

//charge l'énergie

$reqdw = $bdd->prepare("SELECT * FROM dwarves WHERE alive = ? AND FID = ?");
$reqdw ->execute(array(1,$_SESSION['FID']));
$userdw = $reqdw->fetch();
$_SESSION['energy'] = $userdw['energy'];


//charge diamants :
$reqres = $bdd->prepare("SELECT * FROM ressources WHERE ID = ?");
$reqres->execute(array($_SESSION['ID']));
$userres = $reqres->fetch();
$_SESSION['diamond'] = $userres['diamond'];

//redirection
header("Location: /CODE/Adventure/AdventureSelection.php?ID=".$_SESSION['ID']);
?>