<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
if(isset($_GET['ID']) AND $_GET['ID'] > 0 ) 
{
$getId=intval($_GET['ID']);
$requser = $bdd->prepare('SELECT * FROM login WHERE ID = ?');
$requser->execute(array($getId));
$userinfo = $requser->fetch();

if($_GET['ID'] == $_SESSION['ID'] AND $_SESSION['observe'] == 0)

{
?>


<html>
<head>
<link href="/CODE/style.css" rel="stylesheet" media="all" type="text/css"> 
<title>DWARVES GUILD'S</title>
</head>
<body>
    
<div>
<h2>Armory</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>
    
     <div>
        <!--Menu shop-->
         <p>Each equipment gives you more power</p>
        <ul>
          <?php if($_SESSION['Weapon'] < 6 ) { ?>  
        <li><p><img src="/picture/Aventure/Loot/Hache/level<?php echo $_SESSION['Weapon']+1;?>.png" alt="Weapon" id="BigIcon"> WEAPON <img src="/picture/Aventure/Loot/Hache/level<?php echo $_SESSION['Weapon']+1;?>.png" alt="Weapon" id="BigIcon"></p> <a href="ArmoryBUY/Weapon.php">Buy for <?php echo 50+50*$_SESSION['Weapon'] ?> gold</a></li>
          <?php } if($_SESSION['Armor'] < 6 ) { ?>
        <li><p><img src="/picture/Aventure/Loot/Armure/level<?php echo $_SESSION['Armor']+1;?>.png" alt="Armor" id="BigIcon"> ARMOR <img src="/picture/Aventure/Loot/Armure/level<?php echo $_SESSION['Armor']+1;?>.png" alt="Armor" id="BigIcon" alt="Armor" id="BigIcon"></p><a href="ArmoryBUY/Armor.php">Buy for <?php echo 50+50*$_SESSION['Armor'] ?> gold</a></li>
          <?php } if($_SESSION['Shield'] < 6) { ?>
        <li><p><img src="/picture/Aventure/Loot/Bouclier/level<?php echo $_SESSION['Shield']+1;?>.png" alt="Shield" id="BigIcon"> SHIELD <img src="/picture/Aventure/Loot/Bouclier/level<?php echo $_SESSION['Shield']+1;?>.png" alt="Shield" id="BigIcon"></p><a href="ArmoryBUY/Shield.php">Buy for <?php echo 50+50*$_SESSION['Shield'] ?> gold</a></li>
          <?php } if($_SESSION['Talisman'] <6 ) { ?> 
        <li><p><img src="/picture/Aventure/Loot/Talisman/level<?php echo $_SESSION['Talisman']+1;?>.png" alt="Talisman" id="BigIcon"> TALISMAN <img src="/picture/Aventure/Loot/Talisman/level<?php echo $_SESSION['Talisman']+1;?>.png" alt="Talisman" id="BigIcon"></p><a href="ArmoryBUY/Talisman.php">Buy for <?php echo 50+50*$_SESSION['Talisman'] ?> gold</a></li>
          <?php } ?>
        </ul>
         
        <?php 
         if ($_SESSION['Weapon'] >= 6 AND $_SESSION['Armor'] >= 6 AND $_SESSION['Shield'] >= 6 AND $_SESSION['Talisman'] >= 6) {
        ?>
          
         <p>You already have the best equipment possible.</p>
         
         <?php
         }
         ?>
   </div>   
    
    
    
    
    

    

    
<div>
<p>
<a href="/redirect/ShopRED/ShopRED.php">Shop</a>
<a href="/redirect/MainMenuRED.php">Main Menu</a> 
<a href="/PHPalgo/DisconnectAlgo.php">Disconnect</a>
</p>
</div>
    
</body>
</html> 

<?php
}
else
{
header("Location: /CODE/Index.php");
}
}
else
{
header("Location: /CODE/Index.php");
}

?>
