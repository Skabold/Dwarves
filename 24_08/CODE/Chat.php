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
 
    
    
//chat code
if(isset($_POST['message']) AND !empty($_POST['message']))    {
    date_default_timezone_set ( "Europe/Paris");
    $username = $_SESSION['username'];
    $message  = htmlspecialchars($_POST['message']);
    $time = date('H:i');
    $insertmsg = $bdd->prepare('INSERT INTO chat(username,message,time,GID) VALUES(?,?,?,?)');
    $insertmsg ->execute(array($username,$message,$time,0));
    
}
//chat code    
    
?>

<html>
<head>
<link href="style.css" rel="stylesheet" media="all" type="text/css"> 
<title>DWARVES GUILD'S</title>
</head>
<body>
    
<div>
<h2>Global Chat</h2>
<h3>   
<img src="/picture/level.png" alt="level" id="icon"> <?php echo "XP : " . $_SESSION['xp'] . " Level : " . $_SESSION['level']; ?> <img src="/picture/level.png" alt="level" id="icon"><br>
~~ <?php echo $_SESSION['username']; ?> ~~<br>
<img src="/picture/gold.png" alt="gold" id="icon"> <?php echo $_SESSION['gold']; ?> <img src="/picture/gold.png" alt="gold" id="icon"> <br>
</h3>
</div>
   
<form method="post" action="">
<p><label> Say something :</label></p>
<input type="text" name="message">
<input type="submit" value="Send">
    
</form>
    
    <!-- chat -->
    <?php
    //chat code suite
    $allmsg = $bdd->query('SELECT * FROM chat WHERE GID=0 ORDER BY id DESC LIMIT 0, 12');
    while($msg = $allmsg ->fetch()){
        
        
        //INTEGRATION SMILEY
        $msg['message'] = str_replace(':angry:','<img src="/emojis/emo_angry.png">'     ,$msg['message']);
        $msg['message'] = str_replace(':3',     '<img src="/emojis/emo_cat.png">'       ,$msg['message']);
        $msg['message'] = str_replace(':cry:',  '<img src="/emojis/emo_cry.png">'       ,$msg['message']);
        $msg['message'] = str_replace(':|',     '<img src="/emojis/emo_noreaction.png">',$msg['message']);
        $msg['message'] = str_replace(':(',     '<img src="/emojis/emo_sad.png">'       ,$msg['message']);
        $msg['message'] = str_replace(';)',     '<img src="/emojis/emo_wink.png">'      ,$msg['message']);
        $msg['message'] = str_replace(':)',     '<img src="/emojis/emo_smile.png">'     ,$msg['message']);
        //INTEGRATION SMILEY
    ?>  
    
    
    
    <div id='chat'>
    <b><?php echo $msg['username'] . ": "; ?></b>    <?php  echo " " . $msg['message'] . " - " .$msg['time'] ?>
    <br>
    </div>
    
    
    
    <?php
    }
    ?>
   
    
<!-- chat -->

    

    

<div>
<p>
<a href="/redirect/ChatRED.php">Refresh</a>  
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