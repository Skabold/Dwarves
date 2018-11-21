<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');

echo ($_SESSION['pb']);
echo ($_SESSION['pv']);
echo ($_SESSION['pj']);
echo ($_SESSION['pr']);
      
if($_SESSION['pj']==0 AND $_SESSION['observe'] == 0)
{
    if(isset($_SESSION['gold']) AND $_SESSION['gold'] >= 75 )
{
//on enlève 50or (prix du magasin)
$_SESSION['gold'] = $_SESSION['gold']-75;
$insertgold = $bdd->prepare("UPDATE ressources SET gold = ? WHERE ID = ?");
$insertgold->execute(array($_SESSION['gold'],$_SESSION['ID']));
//on donne la potion
$_SESSION['pj'] = 1;
$insertWeapon = $bdd->prepare("UPDATE potion SET pj = ? WHERE DID = ?");
$insertWeapon->execute(array($_SESSION['pj'],$_SESSION['ShopPotionID']));
//énergie
$_SESSION['energy'] = $_SESSION['energy']+25;
$insertenergy = $bdd->prepare("UPDATE dwarves SET energy = ? WHERE FID = ? AND alive = ?");
$insertenergy->execute(array($_SESSION['energy'],$_SESSION['FID'], "1"));


}

}

header("Location: /redirect/ShopRED/PotionRED.php?ID=".$_SESSION['ID']);
?>