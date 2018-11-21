<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');




if(isset($_POST['SA']) OR isset($_POST['MA']) OR isset($_POST['HA'])) {
    
    
    
    //Adventure type detection :
    if(isset($_POST['SA']) AND isset($_SESSION['energy']) AND $_SESSION['energy'] >= 10)
    {
    //small adventure reward and difficulty
    $randdiff = rand(0,20);
    $randRgold = rand(10,50);
    $randRxp = rand(10,50); 
        //diamond reward ? :
        $randRdiamond = rand(0,1000);
    // on enlève l'énergie :
    $_SESSION['energy'] = $_SESSION['energy']-10;
    $insertenergy = $bdd->prepare("UPDATE dwarves SET energy = ? WHERE FID = ? AND alive = ?");
    $insertenergy->execute(array($_SESSION['energy'],$_SESSION['FID'], "1")); 
    //Test victoire defeat
    if ($_SESSION['power'] < $randdiff) {
    //adventure defeat
    header("Location: /CODE/Adventure/DefeatScreen.php?ID=".$_SESSION['ID']);
    }
    
    if ($_SESSION['power'] >= $randdiff) {
    //adventure success
    $_SESSION['gainor'] = $randRgold;
    $_SESSION['gainxp'] = $randRxp;
    
        //actualise la bdd
        $_SESSION['gold'] = $_SESSION['gold'] +  $_SESSION['gainor'];
        $_SESSION['xp'] = $_SESSION['xp'] +  $_SESSION['gainxp'];
        
        //actualise gold
        $insertgold = $bdd->prepare("UPDATE ressources SET gold = ? WHERE ID = ?");
        $insertgold->execute(array($_SESSION['gold'],$_SESSION['ID']));
    
   
        //actualise xp
        $insertxp = $bdd->prepare("UPDATE dwarves SET xp = ? WHERE FID = ? AND alive = ?");
        $insertxp->execute(array($_SESSION['xp'],$_SESSION['FID'], "1"));
        
        
    //check si on donne le diamant
        if($randRdiamond >= 900) {
            $_SESSION['gaindiamond'] = 1;
            
            //on insère le diamant
            $_SESSION['diamond']= $_SESSION['diamond'] +1;
            $insertdiamond = $bdd->prepare("UPDATE ressources SET diamond = ? WHERE ID = ?");
            $insertdiamond->execute(array($_SESSION['diamond'],$_SESSION['ID']));
            
        }
        
        if ($randRdiamond < 900) {
            $_SESSION['gaindiamond'] = 0;
        }
        
    //redirection 
    header("Location: /CODE/Adventure/VictoryScreen.php?ID=".$_SESSION['ID']);   
    }
    }
        

    
    
    
    
    
    
    
    
    
    if(isset($_POST['MA']) AND isset($_SESSION['energy']) AND $_SESSION['energy'] >= 25)
    {
    //medium adventure reward and difficulty
    $randdiff = rand(15,45);
    $randRgold = rand(25,105);
    $randRxp = rand(25,105);
        //diamond reward ? :
        $randRdiamond = rand(0,1000);
    // on enlève l'énergie :
    $_SESSION['energy'] = $_SESSION['energy']-25;
    $insertenergy = $bdd->prepare("UPDATE dwarves SET energy = ? WHERE FID = ? AND alive = ?");
    $insertenergy->execute(array($_SESSION['energy'],$_SESSION['FID'], "1")); 
    //Test victoire defeat
    if ($_SESSION['power'] < $randdiff) {
    //adventure defeat
    header("Location: /CODE/Adventure/DefeatScreen.php?ID=".$_SESSION['ID']);
    }
    
    if ($_SESSION['power'] >= $randdiff) {
    //adventure success
    $_SESSION['gainor'] = $randRgold;
    $_SESSION['gainxp'] = $randRxp;
       
        //actualise la bdd
        $_SESSION['gold'] = $_SESSION['gold'] +  $_SESSION['gainor'];
        $_SESSION['xp'] = $_SESSION['xp'] +  $_SESSION['gainxp'];
        
        //actualise gold
        $insertgold = $bdd->prepare("UPDATE ressources SET gold = ? WHERE ID = ?");
        $insertgold->execute(array($_SESSION['gold'],$_SESSION['ID']));
    
   
        //actualise xp
        $insertxp = $bdd->prepare("UPDATE dwarves SET xp = ? WHERE FID = ? AND alive = ?");
        $insertxp->execute(array($_SESSION['xp'],$_SESSION['FID'], "1"));
        
        //check si on donne le diamant
            if($randRdiamond >= 700) {
            $_SESSION['gaindiamond'] = 1;
            
            //on insère le diamant
            $_SESSION['diamond']= $_SESSION['diamond'] +1;
            $insertdiamond = $bdd->prepare("UPDATE ressources SET diamond = ? WHERE ID = ?");
            $insertdiamond->execute(array($_SESSION['diamond'],$_SESSION['ID']));
            
        }
        
        if ($randRdiamond < 700) {
            $_SESSION['gaindiamond'] = 0;
        }
        
        
    //redirection 
    header("Location: /CODE/Adventure/VictoryScreen.php?ID=".$_SESSION['ID']);   
    }
    }

    
    
    
    
    

    if(isset($_POST['HA']) AND isset($_SESSION['energy']) AND $_SESSION['energy'] >= 50)
    {
    //huge adventure reward and difficulty
    $randdiff = rand(40,250);
    $randRgold = rand(350,1000);
    $randRxp = rand(350,1000);
        //diamond reward ? :
        $randRdiamond = rand(0,1000);
    // on enlève l'énergie :
    $_SESSION['energy'] = $_SESSION['energy']-50;
    $insertenergy = $bdd->prepare("UPDATE dwarves SET energy = ? WHERE FID = ? AND alive = ?");
    $insertenergy->execute(array($_SESSION['energy'],$_SESSION['FID'], "1"));
    //Test victoire defeat
    if ($_SESSION['power'] < $randdiff) {
    //adventure defeat
    header("Location: /CODE/Adventure/DefeatScreen.php?ID=".$_SESSION['ID']);
    }
    
    if ($_SESSION['power'] >= $randdiff) {
    //adventure success
    $_SESSION['gainor'] = $randRgold;
    $_SESSION['gainxp'] = $randRxp; 
   
        //actualise la bdd
        $_SESSION['gold'] = $_SESSION['gold'] +  $_SESSION['gainor'];
        $_SESSION['xp'] = $_SESSION['xp'] +  $_SESSION['gainxp'];
        
        //actualise gold
        $insertgold = $bdd->prepare("UPDATE ressources SET gold = ? WHERE ID = ?");
        $insertgold->execute(array($_SESSION['gold'],$_SESSION['ID']));
    
   
        //actualise xp
        $insertxp = $bdd->prepare("UPDATE dwarves SET xp = ? WHERE FID = ? AND alive = ?");
        $insertxp->execute(array($_SESSION['xp'],$_SESSION['FID'], "1"));
        
        
            //check si on donne le diamant
            if($randRdiamond >= 500) {
            $_SESSION['gaindiamond'] = 1;
            
            //on insère le diamant
            $_SESSION['diamond']= $_SESSION['diamond'] +1;
            $insertdiamond = $bdd->prepare("UPDATE ressources SET diamond = ? WHERE ID = ?");
            $insertdiamond->execute(array($_SESSION['diamond'],$_SESSION['ID']));
            
            }
        
            if ($randRdiamond < 500) {
            $_SESSION['gaindiamond'] = 0;
            }
        
    //redirection 
    
    header("Location: /CODE/Adventure/VictoryScreen.php?ID=".$_SESSION['ID']);   
    }
        
        
        
    }
    
    
   
    

    
}   




    
// aucun bouton submit clicker
else
{
    $erreur = "rien ?";
    echo $erreur;
    //rien
    
}


?>