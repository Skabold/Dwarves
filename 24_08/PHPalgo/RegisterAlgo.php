<?php 
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
if(isset($_POST['register']))
{
    
    
    
    if( !empty($_POST['usernamer']) AND !empty($_POST['pswr']) AND !empty($_POST['pswCr']) AND !empty($_POST['famr']) )
    {
        $usernamer = htmlspecialchars($_POST['usernamer']);
        $famr = htmlspecialchars($_POST['famr']);
        $pswr = sha1($_POST['pswr']);
        $pswCr = sha1($_POST['pswCr']);
        $usernamerlength = strlen($usernamer);
        
        if($usernamerlength <= 18) 
        {
            //on vérifie que le joeur n'existe pas
            $requsernamer = $bdd->prepare("SELECT * FROM login WHERE username = ?");
            $requsernamer ->execute(array($usernamer));
            $usernameExist = $requsernamer->rowCount();
            
            //on vérifie que la famille n'existe pas
            $reqfam = $bdd->prepare("SELECT * FROM family WHERE name = ?");
            $reqfam ->execute(array($famr));
            $famExist = $reqfam->rowCount();
            
            if($usernameExist ==0 AND $famExist ==0)
            {
            
                if($pswr == $pswCr) 
                { 
                    //création variable inspensable pour commencer
                    $gold =0;
                    $stone=0;
                    $GID=0;
                    $level =1;
                    //pas mis en place
                    $mail="default@default.com";
                    
                    
                    //crée la famille
                    $insertfam = $bdd->prepare("INSERT INTO family(name) VALUES(?)");
                    $insertfam ->execute(array($famr));  
                    
                    
                    
                    // on récupèr L'ID de la famille pour la création du joueur IRL
                        $reqfam = $bdd->prepare("SELECT * FROM family WHERE name =?");
                        $reqfam ->execute(array($famr));
                        $reqFID = $reqfam->fetch();
                        $FID = $reqFID['ID']; 
                    //crée le joueur "IRL"
                    $insertlog = $bdd->prepare("INSERT INTO login(username,password,mail,GID,FID) VALUES(?,?,?,?,?)");
                    $insertlog ->execute(array($usernamer,$pswr,$mail,$GID,$FID));
                    
                    //Créer la table housing du joueur.
                    $inserthousing = $bdd->prepare("INSERT INTO housing(FID) VALUES(?)");
                    $inserthousing ->execute(array($FID));
                    
                                         
                                         
                    //donne les ressources aux joueurs
                    $insertres = $bdd->prepare("INSERT INTO ressources(Gold,Stone) VALUES(?,?)");
                    $insertres ->execute(array($gold,$stone));  
                    
                    

                    
                    
                    
                    $erreur = "Votre compte à bien été crée";
                    echo $erreur;
                    header('Location:/CODE/Index.php');
                    
                }
                else
                {
                    $erreur = "Les mots de passes ne correspondent pas !";
                    echo $erreur;
                    header('Location:/CODE/NewAcc.php');
                }
                
                
            }
            else 
            {
                $erreur = "Username déjà utilisé ou family name déjà utilisé";
                echo $erreur;
                header('Location:/CODE/NewAcc.php');
                
            }
                
            
        }
        else
        {
        $erreur = "Votre pseudo ne peut pas dépasser les 18 caractères !";
        echo $erreur;
        header('Location:/CODE/NewAcc.php');
        }
    
    
    
       
    }
    else
    {
        $erreur = "Tout les champs doivent êtres compléter";
        echo $erreur;
        header('Location:/CODE/NewAcc.php');
    }
     

}
else
 {
 $erreur = "Redirection auto vers NewAcc";
 echo $erreur;
 header('Location:/CODE/NewAcc.php');
 }

?>

