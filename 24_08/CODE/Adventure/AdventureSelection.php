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
<h2>Adventure</h2>
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
<img src="/picture/power.jpg" alt="power" id="icon"> <?php echo $_SESSION['power']; ?> <img src="/picture/power.jpg" alt="power" id="icon">    <br><br>
</p>     
</div>
<!-- menu info -->

<p>
To send a dwarf to adventure allows to win a lot of reward. The bigger the adventure, the more risky it is, but the rewards will also be better!
</p>

    
<form method="POST" action="/PHPalgo/Adventure/AdventureSelectionAlgo.php">   
<?php if($_SESSION['energy'] >=10) { ?>   
<input type="submit" value="Small Adventure : cost 10 energies" name="SA" id="SA">
 <?php }   
if($_SESSION['energy'] >=25) {?>   
<input type="submit" value="Medium Adventure : cost 25 energies" name="MA" id="MA">
 <?php }   
if($_SESSION['energy'] >=50) {?>
<input type="submit" value="Huge Adventure : cost 50 energies" name="HA" id="HA">  
<?php }
    
if($_SESSION['energy'] <10) { ?>
<p> You need 10 minimum energies</p>     
<?php }     ?>     
</form>
    

    
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
