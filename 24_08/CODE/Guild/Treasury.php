<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
if(isset($_GET['ID']) AND $_GET['ID'] > 0) 
{
$getId=intval($_GET['ID']);
$requser = $bdd->prepare('SELECT * FROM login WHERE ID = ?');
$requser->execute(array($getId));
$userinfo = $requser->fetch();

if($_GET['ID'] == $_SESSION['ID'])

{
?>


<html>
<head>
<link href="/CODE/style.css" rel="stylesheet" media="all" type="text/css"> 
<title>DWARVES GUILD'S</title>
</head>
<body>
    
<div>
<h2>Leaderboard</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
<img src="/picture/stone.png" alt="stone" id="icon"> <?php echo $_SESSION['stone']; ?> <img src="/picture/stone.png" alt="stone" id="icon"> <br>
<img src="/picture/Ressource/diamond.png" alt="diamond" id="icon"> <?php echo $_SESSION['diamond']; ?> <img src="/picture/Ressource/diamond.png" alt="diamond" id="icon"> <br>
</h3>
</div>

<!-- nom guilde --> 
<h2>"<?php echo $_SESSION['guildname'] ; ?>"</h2>
<!-- menu info -->
<div id="info">
<p>GUILD INFORMATION :<br><br>
<img src="/picture/gold.png" alt="gold" id="icon"><?php echo "  " . $_SESSION['ggold'] . "  "; ?><img src="/picture/gold.png" alt="energy" id="icon"><br><br>
<img src="/picture/stone.png" alt="stone" id="icon"><?php echo "  " . $_SESSION['gstone'] . "  "; ?><img src="/picture/stone.png" alt="stone" id="icon"><br><br>
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['gxp'] . " Level : " . $_SESSION['glevel']; ?> <img src="/picture/level.png" alt="level" id="icon"><br><br>
<img src="/picture/Ressource/diamond.png" alt="Diamond" id="icon"><?php echo "  " . $_SESSION['gdiamond'] . "  "; ?><img src="/picture/Ressource/diamond.png" alt="Diamond" id="icon"><br><br>
<img src="/picture/power.jpg" alt="power" id="icon"><?php echo "  " . $_SESSION['gpower'] . "  "; ?><img src="/picture/power.jpg" alt="power" id="icon"><br><br>
</p>     
</div>
    
<!-- FORM TREASURY-->     
 <div class="container">   
  <form method="POST" action="/PHPalgo/Guild/DonateAlgo.php"> 
  <label for="golddonation">Gold :</label>
  <input type="text" id="golddonation" name="golddonation" value="0">
  <br>
  <label for="stonedonation">Stone :</label>
  <input type="text" id="stonedonation" name="stonedonation" value="0">
  <br>
  <label for="diamonddonation">Diamond :</label>
  <input type="text" id="diamonddonation" name="diamonddonation" value="0">
  <br><br>
  <input type="submit" value="DONATE" name="donate">
  </form>  
</div>

    
<div>
<p>
<a href="/redirect/GuildRED/GuildRED.php">Guild Main Menu</a>
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
header("Location: Index.php");
}
}
else
{
header("Location: Index.php");
}

?>
