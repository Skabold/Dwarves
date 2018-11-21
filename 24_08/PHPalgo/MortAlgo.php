<?php
 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');




if(isset($_SESSION['energy']) AND $_SESSION['energy'] <= 0 )
{

    //Bah faut tuer le nain
    $updateMort = $bdd->prepare("UPDATE dwarves SET alive = ? WHERE FID = ?");
    $updateMort->execute(array(0,$_SESSION['FID']));
    
    //si le joueur est déjà passer par la page html :
    //création nouveau nain
     
    if(isset($_POST['TMC'])) {
        $TMC = 1;
     //je vérifie si il reste un nain en vie dans la famille du joueur
            $reqdw = $bdd->prepare("SELECT * FROM dwarves WHERE alive = ? AND FID = ?");
            $reqdw ->execute(array(1,$_SESSION['FID']));
            $dwaExist = $reqdw->rowCount();
            
            //si le nain existe
            if($dwaExist==1) {
            
                //Si le nain existe je charge l'xp et le level du nain qui servent partout
                $userdwa = $reqdw->fetch();
                $_SESSION['xp'] = $userdwa['xp'];
                $_SESSION['level'] = $userdwa['level'];
                //on redirige vers le menu
                header("Location: /CODE/MainMenu.php?ID=".$_SESSION['ID']);
                
                }
            
            
             //ne devrait aps être possible mais bon
             if($dwaExist>=2) {
                
                $erreur = "Erreur dans la table de données, il existe 2 nains en vie dans ta famille, gros bordel, prévient un admin";
                echo $erreur;
                }
            
            if ($dwaExist==0) {
                
                //Direction création du nain !
                header("Location: /CODE/NewDwa.php?ID=".$_SESSION['ID']);
                
            }
     
     }

    

    
    
    
    //sinon :
    if ($TMC != 1) {
    // voilà c'était rapide, on envoie sur une petite page sympa pour annoncer au joueur que son nain est mort ! :D
    $TMC = 0;
    echo "redirection";
    header("Location: /CODE/Mort.php"); }
            
    

  
}
        
        else {
            //on a de l'énergie !?
            // Bah je suis pas mort wtf
            $erreur = "énergie";
            //on retourne à la mine !
           header("Location: /redirect/MainMenuRED.php?ID=".$_SESSION['ID']); 
            
        }
        
        




?>