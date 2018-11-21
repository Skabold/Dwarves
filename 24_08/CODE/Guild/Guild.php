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
<h3>
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>
    
    
<!-- SI LE JOUEUR N'A PAS DE GUILDE -->
<?php if ($_SESSION['GID'] == 0) {
header("Location: /redirect/GuildRED/NoGuildRED.php"); } ?>
    
<!--                           --> 
<!-- SI LE JOUEUR A UNE GUILDE --> 
<!--                           --> 
    
    
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
<!-- Guild main menu  -->
<ul>
<li><img src="/picture/social.jpg" alt="chat" id="icon"> <a href="/redirect/GuildRED/GuildChatRED.php">Guild chat</a><img src="/picture/social.jpg" alt="chat" id="icon"></li>
<li><img src="" alt="treasury" id="icon"> <a href="/redirect/GuildRED/TreasuryRED.php">Treasury</a><img src="" alt="treasury" id="icon"></li>    
<li><img src="" alt="" id="icon"> <a href="">(!) Market</a><img src="" alt="" id="icon"></li>    
<li><img src="" alt="" id="icon"> <a href="">(!) Buildings</a><img src="" alt="" id="icon"></li>    
<li><img src="" alt="" id="icon"> <a href="">(!) Army</a><img src="" alt="" id="icon"></li>
<li><img src="" alt="" id="icon"> <a href="">(!) Recruitment</a><img src="" alt="" id="icon"></li>    
</ul>
<!-- Guild member info  -->
<div>
<ul> 
   <?php
    //Guild info
    $GID=$_SESSION['GID'];
    $allmem = $bdd->query("SELECT * FROM login WHERE GID=$GID ORDER BY rank DESC LIMIT 0, 25");
    while($mem = $allmem->fetch())
    {
         $mem['rank'] = str_replace('6','Leader',$mem['rank']);
         $mem['rank'] = str_replace('5','Marshal ',$mem['rank']);
         $mem['rank'] = str_replace('4','General ',$mem['rank']);
         $mem['rank'] = str_replace('3','Officer ',$mem['rank']);
         $mem['rank'] = str_replace('2','Veteran ',$mem['rank']);
         $mem['rank'] = str_replace('1','Novice ',$mem['rank']);
         $mem['rank'] = str_replace('0','BUG ?! ',$mem['rank']);
   ?>
    
 
   <li><b><?php echo $mem['username']; ?> </b><?php echo $mem['rank']; ?></li> 
  
    
    <?php } ?>
    
<!-- Main menu etc -->
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
header("Location: Index.php");
}

?>