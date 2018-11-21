<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
echo "tu as bien cliqué sur donate ?";
if(isset($_POST['donate']))
{
 echo "tu as bien cliqué sur donate";
 echo"un des champs n'est pas vide ?";    
    if(!empty($_POST['golddonation']) OR !empty($_POST['stonedonation']) OR !empty($_POST['diamonddonation']))
    {
        echo"un des champs n'est pas vide";
        echo"les champs sont bien des nombre ?";
        //si un des champs n'est pas vide alors :
        //check si c'est bien des nombres
        if(strval($_POST['golddonation'])==strval(intval($_POST['golddonation'])) AND strval($_POST['stonedonation'])==strval(intval($_POST['stonedonation'])) AND strval($_POST['diamonddonation'])==strval(intval($_POST['diamonddonation'])))
        {
             echo"les champs sont bien des nombre";
            echo"As-tu suffisament de ressouces ?";
            //change les noms des variables pour que ce soit plus clair :
            $gold = $_POST['golddonation'];
            $stone = $_POST['stonedonation'];
            $diamond = $_POST['diamonddonation'];
            //on vérifie qu'on à assez pour donner :
            
            if($_SESSION['gold']>=$gold AND $_SESSION['stone']>=$stone AND $_SESSION['diamond']>=$diamond)
            {
                echo"tu as suffisament de ressouces";
                // on enlève nos ressources + actualisation bdd
                $_SESSION['gold'] =  $_SESSION['gold'] - $gold;
                $_SESSION['stone'] =  $_SESSION['stone'] - $stone;
                $_SESSION['diamond'] =  $_SESSION['diamond'] - $diamond;
                
                //actualise gold
                $insertgold = $bdd->prepare("UPDATE ressources SET gold = ? WHERE ID = ?");
                $insertgold->execute(array($_SESSION['gold'],$_SESSION['ID']));
    
                //acualise stone
                $insertstone = $bdd->prepare("UPDATE ressources SET stone = ? WHERE ID = ?");
                $insertstone->execute(array($_SESSION['stone'],$_SESSION['ID']));
                
                //acualise diamond
                $insertdiamond = $bdd->prepare("UPDATE ressources SET diamond = ? WHERE ID = ?");
                $insertdiamond->execute(array($_SESSION['stone'],$_SESSION['ID']));
                
               
                
                //on ajoute des ressources à la guilde :
                $_SESSION['ggold'] = $_SESSION['ggold'] + $gold;
                $_SESSION['gstone'] = $_SESSION['gstone'] + $stone;
                $_SESSION['gdiamond'] = $_SESSION['gdiamond'] + $diamond;
                
                $updateguild1= $bdd->prepare("UPDATE guild SET ggold=? WHERE GID=?");
                $updateguild1->execute(array($_SESSION['ggold'],$_SESSION['GID']));
                $updateguild2= $bdd->prepare("UPDATE guild SET gstone=? WHERE GID=?");
                $updateguild2->execute(array($_SESSION['gstone'],$_SESSION['GID']));
                $updateguild3= $bdd->prepare("UPDATE guild SET gdiamond=? WHERE GID=?");
                $updateguild3->execute(array($_SESSION['gdiamond'],$_SESSION['GID']));
                
                //on redirige
                header('Location:/redirect/GuildRED/TreasuryRED.php');
            }
            
        }
        
    }
    
    
    

  
    
}
else
{
    $erreur = "rien ? retourne au login stp";
    echo $erreur;
    //rien
    
}


?>