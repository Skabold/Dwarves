<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');

//On récup l'ID du nain
$reqDwa = $bdd->prepare("SELECT * FROM dwarves WHERE alive =? AND FID =?");
$reqDwa ->execute(array(1,$_SESSION['FID']));
$reqDID = $reqDwa->fetch();
$DID = $reqDID['ID'];
    
    // on regarde si il y a une entrée qui correspond dans la base armory
    $reqArm = $bdd->prepare("SELECT * FROM armory WHERE DID =?");
    $reqArm ->execute(array($DID));
    $ArmExist = $reqArm->rowCount();

    //existe chargement data + redirect:
    if ($ArmExist ==1) {
        //chargement data :
        $reqArmory = $reqArm->fetch();
        $_SESSION['Weapon'] = $reqArmory['Weapon'];
        $_SESSION['Armor'] = $reqArmory['Armor'];
        $_SESSION['Shield'] = $reqArmory['Shield'];
        $_SESSION['Talisman'] = $reqArmory['Talisman'];
        $_SESSION['ShopID'] = $reqArmory['ID'];
        
        header("Location: /CODE/Shop/Armory.php?ID=".$_SESSION['ID']);
    }

    //existe pas ? il faut la créer + rafraîchir
    if ($ArmExist ==0) {
         $insertArm = $bdd->prepare("INSERT INTO armory(DID) VALUES(?)");
         $insertArm ->execute(array($DID));  
        //redirection
        header("Location: /redirect/ShopRED/ArmoryRED.php?ID=".$_SESSION['ID']);
        
    }




?>