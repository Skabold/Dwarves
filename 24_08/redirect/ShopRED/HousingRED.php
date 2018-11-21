<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
//on charge la pierre :
$reqres = $bdd->prepare("SELECT * FROM ressources WHERE ID = ?");
$reqres->execute(array($_SESSION['ID']));
$userres = $reqres->fetch();
$_SESSION['stone'] = $userres['stone'];

//On charge housing
$reqhousing = $bdd->prepare("SELECT * FROM housing WHERE FID =?");
$reqhousing ->execute(array($_SESSION["FID"]));
$housingExist = $reqhousing->rowCount();

    if ($housingExist ==1) {
        //chargement data :
        $reqhousingInfo = $reqhousing->fetch();
        $_SESSION['shelter'] = $reqhousingInfo['shelter'];
        $_SESSION['house'] = $reqhousingInfo['house'];
        $_SESSION['manor'] = $reqhousingInfo['manor'];
        $_SESSION['palace'] = $reqhousingInfo['palace'];
        
        header("Location: /CODE/Shop/Housing.php?ID=".$_SESSION['ID']);
    }


?>