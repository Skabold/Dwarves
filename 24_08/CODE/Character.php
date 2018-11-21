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
<link href="style.css" rel="stylesheet" media="all" type="text/css"> 
<title>DWARVES GUILD'S</title>
</head>
<body>
    
<div>
<h2>Character</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>

    <!--CONTENU DE LA PAGE en dessous-->
      

 <p>
            
    <img src="/picture/power.jpg" alt="power" id="icon"> <?php echo $_SESSION['power']; ?> <img src="/picture/power.jpg" alt="power" id="icon"><br><br> 
    <img src="/picture/defaultprofilepicture.jpg" alt="profile picture" id="profile">
    
    
 </p>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!--CONTENU DE LA PAGE au dessus-->
    
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