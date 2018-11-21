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
<link href="style.css" rel="stylesheet" media="all" type="text/css"> 
<title>DWARVES GUILD'S</title>
</head>
<body>
    
<div>
<h2>The forgotten gold mine</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>

    
    

<!-- menu info -->
<div id="info">
<p>
<br><img src="/picture/energy.png" alt="energy" id="icon"><?php echo "  " . $_SESSION['energy'] . "  "; ?><img src="/picture/energy.png" alt="energy" id="icon"><br>
</p><hr>
<p>
<img src="/picture/stone.png" alt="stone" id="icon"><?php echo "  " . $_SESSION['stone'] . "  "; ?><img src="/picture/stone.png" alt="stone" id="icon"><br><br>
</p>     
</div>
<!-- menu info -->

<div id="Mine"> 
<p>
<a href="/redirect/MiningRED.php">~Mine~</a><br><br>
<img src="/picture/mine.jpg" alt="mine" id="MinePicture">  
</p>
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
header("Location: Index.php");
}
}
else
{
header("Location: Index.php");
}

?>