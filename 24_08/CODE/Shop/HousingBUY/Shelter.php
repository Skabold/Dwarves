<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');


if($_SESSION['shelter']==0 AND $_SESSION['observe'] == 0)
{
    if(isset($_SESSION['stone']) AND $_SESSION['stone'] >= 250)
{
//on enlève 500 stone (prix du magasin)
$_SESSION['stone'] = $_SESSION['stone']-(250);
$insertstone = $bdd->prepare("UPDATE ressources SET stone = ? WHERE ID = ?");
$insertstone->execute(array($_SESSION['stone'],$_SESSION['ID']));
//on donne le lvl up de maison
$_SESSION['shelter'] = 1;
$insertHousing = $bdd->prepare("UPDATE housing SET shelter = ? WHERE FID = ?");
$insertHousing->execute(array(1,$_SESSION['FID']));
             
//dwarflimite + 1
$_SESSION['dwarflimite'] = $_SESSION['dwarflimite']+1 ;
$insertuser = $bdd->prepare("UPDATE login SET dwarflimite = ? WHERE ID = ?");
$insertuser->execute(array($_SESSION['dwarflimite'],$_SESSION['ID']));
        
}

}


header("Location: /redirect/ShopRED/HousingRED.php?ID=".$_SESSION['ID']);
?>