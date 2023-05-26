<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css file/navp.css" type="text/css">
    <link href="./bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css file/style.css" type="text/css">
    <script src="./bootstrap/bootstrap.js" ></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="icon" type="icon/png"  href="./image/shopping.png">
    <title>Document</title>
</head>
<body>
    
    <?php include_once "./shop/navshop.php" ;
    require_once "./connection.php";
    ?>     
     <!-- Large button groups (default and split) -->
     
     <div class="container mt-5 " >
     <div class="btn-group">
        <h4>les categories des produits  : </h4><br>
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
     selctioner
    </button>
    
    <ul class="dropdown-menu">
    <li><a class="dropdown-item active" href="?id=0">Tout les produits</a></li>
      <?php
      require_once "./connection.php";
      $cat = "SELECT * FROM categorie;";
      $ca = mysqli_query($connection,$cat);
      if($ca){
      while($elt = mysqli_fetch_array($ca)){
      ?>
    <li><a class="dropdown-item active" href="?id=<?php echo $elt['id_categorie'] ?>"><strong><?php echo $elt['icon'] ?></strong> <?php echo $elt['libelle'] ?></a></li>
    <?php }}?>    
    </ul>
    </div>
    </div>
    </div>
    <div class="container">
    <div class="input-group input-group-sm mt-3 mb-3">
     <span class="input-group-text" id="inputGroup-sizing-sm">rechercher dans les produits</span>
     <input  id="search" type="search" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
    </div>
    </div>
    
    <center>
    <div class="container mt-6" >
    <div class="row" id="row" >
       <center><h1 id="no"></h1></center> 
     <?php
     if(!isset($_GET['id'])){
        include "./shop/allpro.php"; 
     }
     else if($_GET['id'] == 0){
        include "./shop/allpro.php"; 
     }else{
        include "./shop/prpcat.php";
     }
   
     
     ?>
    
    </div>
    </div>
    </center>
    <script src="./jquery/jq.js"></script>
    <script src="./js/count.js"></script>
    <script src="./js/search.js" defer></script>
    </body>
    </html>