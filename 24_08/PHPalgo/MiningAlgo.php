<?php
 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');


if(isset($_SESSION['energy']) AND $_SESSION['energy'] >= 1 )
{

    //actualise bdd
    //énergie
    $_SESSION['energy'] = $_SESSION['energy']-1;
    $insertenergy = $bdd->prepare("UPDATE dwarves SET energy = ? WHERE FID = ? AND alive = ?");
    $insertenergy->execute(array($_SESSION['energy'],$_SESSION['FID'], "1"));
    
    //DONNE DES RESSOURCES !
    //quantité entre 0 et ton niveau
    $randQuantityGold = rand(0,$_SESSION['level']+1);
    $randQuantityStone = rand(0,$_SESSION['level']+1);
    $randQuantityXp = rand(0,$_SESSION['level']+1);
    
    $_SESSION['gold'] = $_SESSION['gold'] + $randQuantityGold;
    $_SESSION['stone'] = $_SESSION['stone'] + $randQuantityStone;
    $_SESSION['xp'] = $_SESSION['xp'] + $randQuantityXp;
    
    //actualise gold
    $insertgold = $bdd->prepare("UPDATE ressources SET gold = ? WHERE ID = ?");
    $insertgold->execute(array($_SESSION['gold'],$_SESSION['ID']));
    
    //acualise stone
    $insertstone = $bdd->prepare("UPDATE ressources SET stone = ? WHERE ID = ?");
    $insertstone->execute(array($_SESSION['stone'],$_SESSION['ID']));
    
    //actualise xp
    $insertxp = $bdd->prepare("UPDATE dwarves SET xp = ? WHERE FID = ? AND alive = ?");
    $insertxp->execute(array($_SESSION['xp'],$_SESSION['FID'], "1"));
    
    
    //on retourne à la mine !
    header("Location: /redirect/MineRED.php?ID=".$_SESSION['ID']);

  
}
        
        else {
            //pas d'énergie !
            // C'EST LA MORT DU NAIN :D ! (oui je suis sadique xD)
            $erreur = "pas d'énergie";
             
            header("Location: /PHPalgo/MortAlgo.php?ID=".$_SESSION['ID']);
            
        }
        
        

?>