<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
//on charge le GID pour actualiser
 $requser = $bdd->prepare("SELECT * FROM login WHERE ID = ?");
 $requser->execute(array($_SESSION['ID']));
 $userinfo = $requser->fetch();
 $_SESSION['GID'] = $userinfo['GID'];

//on cherche le guild name pour le passer sous une variable de session    
$reqguild = $bdd->prepare("SELECT * FROM guild WHERE GID = ?");
$reqguild ->execute(array($_SESSION['GID']));
$Ginfo = $reqguild->fetch();
$_SESSION['guildname'] = $Ginfo['name'];
$_SESSION['glevel']  =  $Ginfo['glevel'];
$_SESSION['gxp']  =  $Ginfo['gxp'];
$_SESSION['ggold']  =  $Ginfo['ggold'];
$_SESSION['gstone']  =  $Ginfo['gstone'];
$_SESSION['gpower']  =  $Ginfo['gpower'];
$_SESSION['gdiamond']  =  $Ginfo['gdiamond'];

header("Location: /CODE/Guild/GuildChat.php?ID=".$_SESSION['ID']."&GID=".$_SESSION['GID']);
?>