<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
if(isset($_GET['ID']) AND $_GET['ID'] > 0) 
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
<h2>Potion</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>
    
     <div>
        <!--Menu shop-->
         <p>Potions can regenerate energy by 25</p>
        <ul>
          <?php if($_SESSION['pb'] == 0 ) { ?>  
        <li><p><img src="/picture/pb.png" alt="Blue Potion" id="icon">BLUE POTION <img src="/picture/pb.png" alt="Blue Potion" id="icon"></p> <a href="PotionBUY/BluePotion.php">Buy for 10 gold</a></li>
          <?php } if($_SESSION['pj'] == 0 ) { ?>
        <li><p><img src="/picture/pj.png" alt="Yellow Potion" id="icon"> YELLOW POTION <img src="/picture/pj.png" alt="Yellow Potion" id="icon"></p><a href="PotionBUY/YellowPotion.php">Buy for 25 gold</a></li>
          <?php } if($_SESSION['pr'] == 0 ) { ?>
        <li><p><img src="/picture/pr.png" alt="Red Potion" id="icon"> RED POTION <img src="/picture/pr.png" alt="Red Potion" id="icon"></p><a href="PotionBUY/RedPotion.php">Buy for 50 gold</a></li>
          <?php } if($_SESSION['pv'] == 0 ) { ?> 
        <li><p><img src="/picture/pv.png" alt="Green Potion" id="icon"> GREEN POTION <img src="/picture/pv.png" alt="Green Potion" id="icon"></p><a href="PotionBUY/GreenPotion.php">Buy for 75 gold</a></li>
          <?php } ?>
        </ul>
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
