<?php




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap/bootstrap.css" rel="stylesheet">
  <script src="../bootstrap/bootstrap.js" ></script>
  <link rel="icon" type="icon/png"  href="../image/shopping.png">
  <title>admin</title>
</head>
<body>
 <?php include 'include/nav.php'; ?>
  <div class="container">
   <?php
   if(!isset($_SESSION['admin'])){
    header('location: login.php');
   }
   
   ?>
   <h3 color = 'red' >Bienvenue, monsieur   <?php echo $_SESSION['admin']['login'];  ?> </h3>
   
  </div>
</body>
</html>