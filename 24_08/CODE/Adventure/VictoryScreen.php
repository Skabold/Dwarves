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
<h2>Victory !</h2>
<h3>   
This adventure was hard, but you manage to stay alive and save some amazing stuff !
</h3>
</div>

    <div id="info" >
    <hr>
    <p>
    <b style="color : black;">-Reward-</b><br><br>
    <img src="/picture/gold.png" alt="Gold" id="icon"> <?php echo $_SESSION['gainor']; ?> <img src="/picture/gold.png" alt="Gold" id="icon"><br><br>
    <img src="/picture/Level.png" alt="Xp" id="icon"> <?php echo $_SESSION['gainxp']; ?> <img src="/picture/Level.png" alt="Xp" id="icon"><br><br>
    <?php if($_SESSION['gaindiamond'] == 1) { ?> </p><hr><p>+1<br> <img src="/picture/Ressource/diamond.png" alt="Diamond" id="BigIcon"><br><br> <?php } ?>
    </p>
    <hr>
    </div>

    
<div>
<p>
<a href="/redirect/AdventureRED/AdventureRED.php">Adventure Selection</a>    
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
