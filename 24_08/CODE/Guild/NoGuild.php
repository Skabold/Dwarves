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
<h2>You don't have guild</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>

<!-- Crée une guilde ? -->
 <div class="container">
     <p>You can create your own guild for 500 <img src="/picture/gold.png" alt="gold" id="icon"></p>
  <form method="POST" action="/PHPalgo/Guild/NewGuildAlgo.php<?php echo "?ID=" . $_SESSION['ID'] ?> "> 
  <label for="guildname">Guild Name :</label>
  <input type="text" id="guildname" name="guildname" required>
  <br>
  <input type="submit" value="Create" name="NG">
  </form>
     
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
