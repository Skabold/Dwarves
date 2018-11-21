<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
if(isset($_GET['ID']) AND $_GET['ID'] > 0) 
{
$getId=intval($_GET['ID']);
$requser = $bdd->prepare('SELECT * FROM login WHERE ID = ?');
$requser->execute(array($getId));
$userinfo = $requser->fetch();

    // on défini la limite :
    $reqlimit = $bdd->prepare("SELECT * FROM login WHERE ID = ?");
    $reqlimit ->execute(array($_SESSION['ID']));
    $userlimit = $reqlimit->fetch();
    $_SESSION['dwarflimite'] = $userlimit['dwarflimite'];

if($_GET['ID'] == $_SESSION['ID'])

{
    ?>



<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" media="all" type="text/css"> 
<title>DWARVES GUILD'S</title>
</head>
<body>
<div>
    <h2>Create a new dwarf :</h2>
    <br><br><hr>
</div>    

    
 <div class="container">
  <form method="POST" action="/PHPalgo/NewDwarfAlgo.php"required>
      
    <label for="namedwa">Dwarf name :</label>
    <input type="text" id="namedwa" name="namedwa" >
    <br>
    <input type="submit" value="Create a new dwarf !" name="createdwarf" id="createdwarf">
  </form>
     <p>Your dwarf daily limit is : <?php echo $_SESSION['dwarflimite'];?></p>
</div>

<div>
<p>
<a href="Index.php">Back to the login page </a>
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