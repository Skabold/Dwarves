<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');

//On récup l'ID du nain
$reqDwa = $bdd->prepare("SELECT * FROM dwarves WHERE alive =? AND FID =?");
$reqDwa ->execute(array(1,$_SESSION['FID']));
$reqDID = $reqDwa->fetch();
$DID = $reqDID['ID'];
    
    // on regarde si il y a une entrée qui correspond dans la base potion
    $reqPo = $bdd->prepare("SELECT * FROM potion WHERE DID =?");
    $reqPo ->execute(array($DID));
    $PoExist = $reqPo->rowCount();

    //existe chargement data + redirect:
    if ($PoExist ==1) {
        //chargement data :
        $reqPotion = $reqPo->fetch();
        $_SESSION['pr'] = $reqPotion['pr'];
        $_SESSION['pv'] = $reqPotion['pv'];
        $_SESSION['pb'] = $reqPotion['pb'];
        $_SESSION['pj'] = $reqPotion['pj'];
        $_SESSION['ShopPotionID'] = $reqPotion['DID'];
        
        echo"ici";
        header("Location: /CODE/Shop/Potion.php?ID=".$_SESSION['ID']);
    }

    //existe pas ? il faut la créer + rafraîchir
    if ($PoExist ==0) {
         $insertPo = $bdd->prepare("INSERT INTO potion(DID) VALUES(?)");
         $insertPo ->execute(array($DID));  
        //redirection
        header("Location: /redirect/ShopRED/PotionRED.php?ID=".$_SESSION['ID']);
        
    }




?>