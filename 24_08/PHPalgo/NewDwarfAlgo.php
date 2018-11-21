<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
if(isset($_POST['createdwarf']))
{
    $date = date("dmY");
    $name = htmlspecialchars($_POST['namedwa']);
    $namelength = strlen($name);
    if(!empty($name) AND $namelength <= 18 AND $namelength >= 3)    {
        
            //on vérifie que la daily limit de nain n'est pas dépasser
            $reqdate = $bdd->prepare("SELECT * FROM dwarves WHERE date = ? AND FID = ?");
            $reqdate ->execute(array($date,$_SESSION['FID']));
            $dateExist = $reqdate->rowCount();
        
            // on défini la limite :
            $reqlimit = $bdd->prepare("SELECT * FROM login WHERE ID = ?");
            $reqlimit ->execute(array($_SESSION['ID']));
            $userlimit = $reqlimit->fetch();
            $_SESSION['dwarflimite'] = $userlimit['dwarflimite'];
            
                if($dateExist < $_SESSION['dwarflimite']){ 
        
                    //Bah il faut crée le nain !
                    // on a déjà $name   
                    $level = 1 ;
                    $xp = 1 ;
                    $energy = 100;
                    $power = 10 ;
                    $alive = true; // vrai " true / 1 "
                    $FID = $_SESSION['FID'];
       
        
       
                    // on insère tout :
                    $insertdwa = $bdd->prepare("INSERT INTO dwarves(level,xp,energy,power,name,alive,FID,date) VALUES(?,?,?,?,?,?,?,?)");
                    $insertdwa ->execute(array($level,$xp,$energy,$power,$name,$alive,$FID,$date));  
        
        
                    //on charge les infos :
                    $reqdw = $bdd->prepare("SELECT * FROM dwarves WHERE alive = ? AND FID = ?");
                    $reqdw ->execute(array(1,$_SESSION['FID'])); //on cherche le nain de la famille qui est vivant
                    $userdw = $reqdw->fetch();
                    $_SESSION['xp'] = $userdw['xp'];
                    $_SESSION['level'] = $userdw['level'];
                    $_SESSION['energy'] = $userdw['energy'];

        
                    // on redirige
                    $_SESSION['observe']=0;
                    $erreur = "Nain crée, redirection vers main Menu";
                    header('Location:/redirect/MainMenuRED.php');
                    echo $erreur;
        
                }    
    
            if ($dateExist >= $_SESSION['dwarflimite']) {
                    //limite dépasser faire un truc
                    $_SESSION['observe']=1;
                    header('Location:/redirect/MainMenuRED.php');    
                
                
                
            
            
            
            }
        }
    
    else
    {
     echo $name;
     $erreur = "Le nom du nain doit être compris entre 3 et 18";  
     echo $erreur;
        if(!empty($name)) { echo "le nom est pas vide";}
        if($namelength <= 18) { echo "<=18 ok";}
        if($namelength >= 3) { echo ">= 3 pas ok";}
        
        header('Location:/CODE/NewDwa.php');
        
    }
    
    
    
    
}
else
{
   // echo "rien ? rien.... arrête de jouer avec les urls et va te login comme tout le monde stp, sinon ça ne marchera pas.";
    //rien
    
}


?>