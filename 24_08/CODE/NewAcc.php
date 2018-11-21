<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" media="all" type="text/css"> 
<title>DWARVES GUILD'S</title>
</head>
<body>
<div>
    <h2>Create an account :</h2>
    <br><br><hr>
</div>    

    
 <div class="container">
  <form method="POST" action="/PHPalgo/RegisterAlgo.php"required>
      
    <label for="usernamer">Username :</label>
    <input type="text" id="usernamer" name="usernamer" >
    <br>
    <label for="pswr">Password :</label>
    <input type="password" id="pswr" name="pswr" required>
    <br>
    <label for="pswCr">Password confirmation :</label>
    <input type="password" id="pswCr" name="pswCr" required>
    <br>
    <label for="famr">Family name :</label>
    <input type="text" id="famr" name="famr" required>
    <br>
    <br>
    <input type="submit" value="REGISTER" name="register" id="register">
  </form>
</div>

    
<div>
<p>
<a href="Index.php">Back to the login page </a>
</p>   
</div>
    
</body>
</html> 