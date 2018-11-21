<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
if(isset($_POST['login']))
{
    $usernamel = htmlspecialchars($_POST['usernamel']);
    $pswl = sha1($_POST['pswl']);

    if(!empty($usernamel) AND !empty($pswl))
    {
        
        $requser = $bdd->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
        $requser->execute(array($usernamel, $pswl));
        $userexist = $requser->rowCount();
        
            
        if($userexist == 1)
        {

            //info sur l'id le gid et le username et son FID      
            $userinfo = $requser->fetch();
            $_SESSION['ID'] = $userinfo['ID'];
            $_SESSION['FID'] = $userinfo['FID'];
            $_SESSION['username'] = $userinfo['username'];
            $_SESSION['GID'] = $userinfo['GID'];
            $_SESSION['dwarflimite'] = $userinfo['dwarflimite'];
            
            //mon joueur existe, je chope des info sur l'or du comtpe.
            $reqres = $bdd->prepare("SELECT * FROM ressources WHERE ID = ?");
            $reqres->execute(array($_SESSION['ID']));
            $userres = $reqres->fetch();
            $_SESSION['gold'] = $userres['gold'];
            
             
            
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
                $_SESSION['energy'] = $userdwa['energy'];

                //et puis si il existe il à accès a tout
                $_SESSION['observe'] = 0 ; 
                //on redirige vers le menu
                header("Location: /CODE/MainMenu.php?ID=".$_SESSION['ID']);
                
                }
            
            
             //ne devrait pas être possible mais bon
             if($dwaExist>=2) {
                
                $erreur = "Erreur dans la table de données, il existe 2 nains en vie dans ta famille, gros bordel, prévient un admin";
                echo $erreur;
                }
            
            if ($dwaExist==0) {
                
                //Direction création du nain !
                $erreur="redirige moi vers creaion de nain merci";
                echo $erreur;
                header("Location: /CODE/NewDwa.php?ID=".$_SESSION['ID']);
                
            }
           
            
            
        //login incorrect    
        }
        else
        {
            $erreur = "Username ou password incorrect !";
            
            echo $erreur;
            header("Location: /CODE/Index.php");
        }
        
        
    }
    else
    {
     $erreur = "Veuillez remplir tout les champs";  
         header("Location: /CODE/Index.php");
     echo $erreur;
        
    }
    
    
    
    
}
else
{
    $erreur = "rien ?";
    echo $erreur;
    //rien
    
}


?>