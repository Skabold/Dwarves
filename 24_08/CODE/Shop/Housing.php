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
<h2>Housing</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>

    
<!-- STONE INFO -->
<div>
<p>
<img src="/picture/stone.png" alt="stone" id="icon"><?php echo "  " . $_SESSION['stone'] . "  "; ?><img src="/picture/stone.png" alt="stone" id="icon"><br><br>
</p>     
</div>
    
    
    
     <div>
        <!--Menu shop-->
         <p>The buildings are permanent and allow to increase the daily limit of dwarf (+1 for each upgrade) </p>
        <ul>
            <?php if($_SESSION['shelter'] == 0 ) { ?>  
        <li><p><img src="" alt="Shelter" id="BigIcon"> Shelter <img src="" alt="Shelter" id="BigIcon"></p> <a href="HousingBUY/Shelter.php">Buy for "250" stone.</a></li>
            <?php } if($_SESSION['house'] == 0 AND $_SESSION['shelter'] == 1) { ?>
        <li><p><img src="" alt="House" id="BigIcon"> House <img src="" alt="House" id="BigIcon"></p> <a href="HousingBUY/House.php">Buy for "500" stone.</a></li>
            <?php } if($_SESSION['manor'] == 0 AND $_SESSION['house'] == 1 AND $_SESSION['shelter'] == 1) { ?>
        <li><p><img src="" alt="manor" id="BigIcon"> Manor <img src="" alt="manor" id="BigIcon"></p> <a href="HousingBUY/Manor.php">Buy for "1000" stone.</a></li>
            <?php } if($_SESSION['palace'] == 0 AND $_SESSION['manor'] == 1 AND $_SESSION['house'] == 1 AND $_SESSION['shelter'] == 1) { ?>
        <li><p><img src="" alt="Palace" id="BigIcon"> Palace <img src="" alt="Palace" id="BigIcon"></p> <a href="HousingBUY/Palace.php">Buy for "2000" stone.</a></li>
            <?php } ?>
        </ul>
         
         
         
         
         
         <!-- all house == 1  -->
        <?php 
         if ($_SESSION['palace'] == 1 ) {
        ?>
         <p>You already have the best house in the world.</p>
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
