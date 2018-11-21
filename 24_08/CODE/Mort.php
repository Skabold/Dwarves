<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dwarves','root','');
?>


<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" media="all" type="text/css"> 
<title>DWARVES GUILD'S</title>
</head>
<body>
    
    
<div>
<h2>Your dwarf is dead</h2>
<h3>oups...</h3>
<p><img src ="/picture/Grave.jpg" alt="Tombe" id="grave"></p>
</div>
    
    
 <div class="container">
  <form method="POST" action="/PHPalgo/MortAlgo.php"> 
  <input type="submit" value="All my condolences" name="TMC" id="TMC">
  </form>
 </div>
     


    
</body>
</html> 