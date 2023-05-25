<?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="icon" type="icon/png"  href="../image/shopping.png">
    <title>produit | <?php echo $table['libelle'] ?></title>
</head>
<body>
<div class="container py-2">
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
                <h3> prix de <?php echo $table['libelle'] ?> :
                <?php if($table['discount'] != 0) {?>
                <span class="badge text-bg-danger"> <strike><?php echo $table['prix'] ;?> <strong>DA</strong></strike> </span>
               <?php } ?>
                <span class="badge text-bg-success mb-3"> <?php echo $total ?> <strong>DA</strong> </span></h3>
                <div class="card-footer mb-3">
                  <div class="counter d-flex ">
                    <button class="btn btn-primary mx-1" id="add">+</button>
                    <input class="form-control w-25" type="number" name="qty" id="qty" max="<?php echo $table['qte']?>">
                    <button class="btn btn-primary mx-1" id="remove">-</button>
                  </div>
                </div>
                <p> quantité disponible  :  <?php echo $table['qte'] ?> <strong>piece</strong></p>
                <a class="btn btn-primary" href="">ajouter au panier</a>
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