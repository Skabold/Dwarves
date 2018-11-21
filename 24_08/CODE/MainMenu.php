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
<h2>Main menu</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>

    <?php if ($_SESSION['observe'] == 1) { ?>
    <p>All your dwarves are dead, comeback tomorow</p>
    
    <?php } ?>

    <div>
        <!--Liste lien vers autre pages -->
        <ul>
        <?php if ($_SESSION['observe'] == 0) { ?>
        <li><img src="/picture/chest.png" alt="Shop" id="icon"> <a href="/redirect/ShopRED/ShopRED.php">Shop</a><img src="/picture/chest.png" alt="Shop" id="icon"></li>
        <li><img src="/picture/adventure.png" alt="Adventure" id="icon"> <a href="/redirect/AdventureRED/AdventureRED.php">Adventure</a> <img src="/picture/adventure.png" alt="Adventure" id="icon"></li>
        <li><img src="/picture/wagon.png" alt="Mine" id="icon"> <a href="/redirect/MineRED.php">Go to mine</a> <img src="/picture/wagon.png" alt="Mine" id="icon"></li>
        <li><img src="/picture/character.png" alt="Character" id="icon"> <a href="/redirect/CharacterRED.php">My character</a> <img src="/picture/character.png" alt="Character" id="icon"></li>
        <?php } ?>
        <li><img src="/picture/tools.png" alt="Guild" id="icon"> <a href="/redirect/GuildRED/GuildRED.php">My guild</a> <img src="/picture/tools.png" alt="Guild" id="icon"></li>
        <li><img src="/picture/swords.png" alt="Leaderbords" id="icon"> <a href="/redirect/LeaderboardRED.php">Leaderboard</a> <img src="/picture/swords.png" alt="Leaderbords" id="icon"></li>
        <li><img src="/picture/social.jpg" alt="Social" id="icon"> <a href="/redirect/ChatRED.php">Chat</a><img src="/picture/social.jpg" alt="Social" id="icon"></li>
        </ul>
    
   </div>
    
    <div>
    <p>
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