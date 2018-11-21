<?php 
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
session_start();
if(isset($_POST['NG']))
{
    $gold = $_SESSION['gold'];
    if(!empty($_POST['guildname']) AND $gold >= 1000)
    {
        
        //on crée les variables de la guilde que l'on va crée :
        $guildname = htmlspecialchars($_POST['guildname']);
        $glevel = 1 ;
        $gxp = 1 ;
        $ggold = 1000 ;
        $gstone = 0 ;
        $gpower = 0 ;
        $gdiamond = 0 ;
        //On enlève les 1000 or
        $_SESSION['gold'] = $_SESSION['gold'] - 1000;
        $insertgold = $bdd->prepare("UPDATE ressources SET gold = ? WHERE ID = ?");
        $insertgold->execute(array($_SESSION['gold'],$_SESSION['ID']));
        
        //on vérifie que le guild name n'est pas pris
        $reqguildname = $bdd->prepare("SELECT * FROM guild WHERE name = ?");
        $reqguildname ->execute(array($guildname));
        $guildnameExist = $reqguildname->rowCount();
        
        if($guildnameExist != 0)
        {
            //le nom existe déjà redirect :
            $erreur = "Le nom existe déjà";
            echo $erreur;
            header('Location:/redirect/GuildRED/NoGuildRED.php');
 
            
        }
        
        if($guildnameExist == 0)
        {
            //le nom n'existe pas : on crée la guilde !
            $insertguild = $bdd->prepare("INSERT INTO guild(name,glevel,gxp,ggold,gstone,gpower,gdiamond) VALUES(?,?,?,?,?,?,?)");
            $insertguild ->execute(array($guildname,$glevel,$gxp,$ggold,$gstone,$gpower,$gdiamond));
            
            //on trouve le GID de la nouvelle guilde :
            $reqguildname = $bdd->prepare("SELECT * FROM guild WHERE name = ?");
            $reqguildname ->execute(array($guildname));
            $guildinfo = $reqguildname->fetch();
            $GIDinfo = $guildinfo['GID'];
            
            //on update le GID du joueur ET on le passe leader de sa guilde :
            $userupdate =$bdd->prepare("UPDATE login SET GID = ? WHERE ID = ? ");
            $userupdate ->execute(array($GIDinfo,$_SESSION['ID']));
            
            $userupdate2 =$bdd->prepare("UPDATE login SET rank = ? WHERE ID = ? ");
            //6 = leader / 5 maréchal / 4 général / 3 officier /2 veteran / 1 novice / 0 pas de guilde pas de grade.
            $userupdate2 ->execute(array(6,$_SESSION['ID']));
            
            //redirection
            header('Location:/redirect/GuildRED/GuildRED.php');
            
        }
        
    }
    
    
    
    
    

}
else
 {
 $erreur = "Redirection auto vers NoGuild";
 echo $erreur;
 header('Location:/redirect/GuildRED/NoGuildRED.php');
 }

?>

