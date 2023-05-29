<?php
session_start();
$connect = false;
if(isset($_SESSION['client'])){
  $connect = true;
}
require_once "../connection.php";
$id = $_GET['id_produit'];
$des = "SELECT * FROM produit WHERE id_produit = '$id';";
$requ = mysqli_query($connection,$des);
if($requ){
    while($table = mysqli_fetch_array($requ)){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css file/navp.css" type="text/css">
    <link href="../bootstrap/bootstrap.css" rel="stylesheet">
    <link href="../css file/style.css" rel="stylesheet">
    <script src="../bootstrap/bootstrap.js" ></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="icon" type="icon/png"  href="../image/shopping.png">
    <title>produit | <?php echo $table['libelle'] ?></title>
</head>
<body>
<div class="nav-bar" id="navbar">
    <div class="logo">
        <img src="../image/shopping.png" alt=""> <p> <strong> shopers </strong></p>
    </div>
    <?php
    if($connect){
       
        $id_client = $_SESSION['client']['id_client'];
        if(isset($_SESSION['panier'])){
            $pro = count($_SESSION['panier'][$id_client]);
        
        }else{
            $pro=0;
        }
    }
    ?>
        <nav>
            <ul>
                <li><a href="./index.php">Accuill</a></li>
                <li><a href="about.php">A propos</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php 
                if($connect){
                  ?>
                <li><a href="mes_commandes.php">Mes Commande</a></li>
                <?php } ?>
                <li><form action="" method="post">
                <?php if(!$connect){
                  ?>
                <input class="btn btn-primary" type="submit" value="inscrire" name="ii">
                <input class="btn btn-success" type="submit" value="connecetr" name="cc">
               <?php }
                if($connect){
                  ?>
          
               <input class="btn btn-danger" type="submit" value="deconecter" name="dd">
                </form></li>
               <?php } ?>
                <?php if(isset($_POST['cc'])){header('location: ./shop/login.php');}else if(isset($_POST['ii'])){header('location: ./shop/sing.php');}  ?>
            </ul>
        </nav>
        <?php
        if(!empty($_SESSION['panier'])){
            ?>
        <div class="cart">
        <a href="panier.php" style="font-size: 20px;"><ion-icon style="font-size: 30px;" name="cart-outline"></ion-icon>(<?php echo $pro; ?>)</a>
        </div>
       <?php } ?>
       
    </div>
<div class="container py-2">
    <a href="../index.php" class="btn btn-warning"> <strong><- retourner</strong></a>
    <?php
    $prix = $table['prix'];
    if($table['discount'] == 0){
        $total = $prix;
    }else{
        $total = $prix - ($prix * $table['discount'] / 100);
    }

    ?>
    <h4> produit : <?php echo $table['libelle'] ?></h4>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img class="img img-fluide w-75" src="../upload/produit/<?php echo $table['image']?>" alt="<?php echo $table['libelle'] ?>">
            </div>
            <div class="col-md-6">
                <h1> <?php echo $table['libelle'] ?></h1>
                <?php if($table['discount'] != 0) {?>
                <h2>remise : <span class="badge text-bg-success"> <?php echo $table['discount'] ?> <strong>%</strong></span> </h2> 
                <?php } ?>
                <p> <?php echo $table['description'] ?></p>
                <h4> prix de <?php echo $table['libelle'] ?> :
                <?php if($table['discount'] != 0) {?>
                <span class="badge text-bg-danger"> <strike><?php echo $table['prix'] ;?> <strong>DA</strong></strike> </span>
               <?php } ?>
                <span class="badge text-bg-success mb-3"> <?php echo $total ?> <strong>DA</strong> </span></h4>
                <h4>quantité de produit</h4>
                <div class="card-footer mb-3">
                
                  <div class="counter d-flex ">
               
                    <?php if($connect){
                    $id_user = $_SESSION['client']['id_client'];
                    $qte = $_SESSION['panier'][$id_user][$table['id_produit']] ?? 0;
                     ?>
                    <form action="./cart.php" method="post" class="counter d-flex">
                    <button onclick="return false" class="btn btn-primary mx-1" id="add">+</button>
                    <input type="hidden" name="id_produit" id="" value="<?php echo $table['id_produit'] ?>">
                    <input class="form-control w-25" value="<?php echo $qte;?>" type="number" name="qty" id="qty" max="<?php echo $table['qte']?>">
                    <button onclick="return false" class="btn btn-primary mx-1" id="remove">-</button>
                    <input type="submit" value="ajouter" name="ajouter" class="btn btn-success">
                    <?php
                     
                    }else{
                        echo '<a href="login.php" class="btn btn-primary mx-1">veuillez connecter pour faire une commande</a>';
                    }
                    ?>
                    </form>

                  </div>
                </div>
                <p> quantité disponible  :  <?php echo $table['qte'] ?> <strong>piece</strong></p>
            </div>
            
        </div>
    </div>
</div>
<?php
    }
}
?>
<script src="../js//counter.js"></script>
</body>
</html>