<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');


if($_SESSION['Talisman']<6 AND $_SESSION['observe'] == 0)
{
    if(isset($_SESSION['gold']) AND $_SESSION['gold'] >= 50+50*$_SESSION['Talisman'])
{
//on enlève Xor (prix du magasin)
$_SESSION['gold'] = $_SESSION['gold']-(50+50*$_SESSION['Talisman']);
$insertgold = $bdd->prepare("UPDATE ressources SET gold = ? WHERE ID = ?");
$insertgold->execute(array($_SESSION['gold'],$_SESSION['ID']));
//on augmente le niveau de l'arme
$_SESSION['Talisman'] = $_SESSION['Talisman'] + 1;
$insertWeapon = $bdd->prepare("UPDATE armory SET Talisman = ? WHERE ID = ?");
$insertWeapon->execute(array($_SESSION['Talisman'],$_SESSION['ShopID']));
// on donne re-calcule le power
$insertPower = $bdd->prepare("UPDATE dwarves SET power = ? WHERE FID = ? AND alive =?");
$_SESSION['power'] = 10 + 10*($_SESSION['Armor']+$_SESSION['Talisman']+$_SESSION['Shield']+$_SESSION['Weapon']);
$insertPower->execute(array($_SESSION['power'],$_SESSION['FID'],"1"));


}

}


header("Location: /redirect/ShopRED/ArmoryRED.php?ID=".$_SESSION['ID']);
?>