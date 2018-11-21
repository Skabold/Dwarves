<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');

$reqres = $bdd->prepare("SELECT * FROM ressources WHERE ID = ?");
$reqres->execute(array($_SESSION['ID']));
$userres = $reqres->fetch();
$_SESSION['stone'] = $userres['stone'];
$_SESSION['diamond'] = $userres['diamond'];
 

 echo $_SESSION['energy'];


 if ($_SESSION['energy']<=0) 
    {
     
     
     
        if ($_SESSION['observe'] == 0)
        { 
            //mort du nain
            header("Location: /PHPalgo/MortAlgo.php?ID=".$_SESSION['ID']);
        }
     
     
        if ($_SESSION['observe'] == 1)
        {
            //observe mode
            header("Location: /CODE/MainMenu.php?ID=".$_SESSION['ID']); 
        }
     
     
     
    }


else
    {
    header("Location: /CODE/MainMenu.php?ID=".$_SESSION['ID']);
    }
?>