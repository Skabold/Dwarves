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
<h2>Shop</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>
    
     <div>
        <!--Menu shop-->
        <ul>
        <li><img src="" alt="Armory" id="icon"> <a href="/redirect/ShopRED/ArmoryRED.php">Armory</a> <img src="" alt="Armory" id="icon"></li>
        <li><img src="" alt="Potion" id="icon"> <a href="/redirect/ShopRED/PotionRED.php">Potions</a> <img src="" alt="Potion" id="icon"></li>
        <li><img src="" alt="housing" id="icon"> <a href="/redirect/ShopRED/HousingRED.php">Housing</a> <img src="" alt="housing" id="icon"></li>
        <li><img src="" alt="event" id="icon"> <a href="">Event (!)</a> <img src="" alt="event" id="icon"></li>
        </ul>
    
   </div>   
    
    
    
    
    

    

    
<div>
<p>
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
