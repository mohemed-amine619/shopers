<?php 
$id_cat = $_GET['id'];
$req = "SELECT * FROM categorie WHERE id_categorie = '$id_cat';";
$msq = mysqli_query($connection,$req);
while($elt = mysqli_fetch_array($msq)){
?>
    <div class="container py-2">
      <h4> categorie |<strong> <?php echo $elt['icon'] ?></strong> <?php echo $elt['libelle'] ?></h4>
    </div>
    <div class="container">
    <div class="row">

<?php 
}
$sel = "SELECT * FROM produit WHERE id_categorie = '$id_cat';";
$zrt = mysqli_query($connection,$sel);
if($zrt){
    while($row = mysqli_fetch_array($zrt)){
        ?>
        <?php
    $prix = $row['prix'];
    if($row['discount'] == 0){
        $total = $prix;
    }else{
        $total = $prix - ($prix * $row['discount'] / 100);
    }

    ?>
          <div class="card mb-4  col-md-4" style="width: 23rem;" id="oop">
          <div class="container" style="height:270px">
          <img  src="./upload/produit/<?php echo $row['image'] ?>" class="card-img-top w-70 mx-auto" alt="<?php echo $row['libelle'] ?>">
          </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['libelle'] ?></h5>
                <strike><p class="card-text">prix : <?php if($row['discount'] != 0) {?> <?php echo $row['prix'] ;?><?php } ?> <strong>DA</strong></p></strike>
                <p class="card-text">prix : <?php echo $total ?> <strong>DA</strong></p>
                <p class="card-text">remise :<?php if($row['discount'] != 0) {?> <?php echo $row['discount'] ?><?php } ?> <strong>%</strong></p>
                <p class="card-text">date creation : <?php echo $row['date_creation'] ?></p>
                <a href="./shop/prdet.php?<?php echo 'id_produit='.$row['id_produit'];?>" class="btn btn-primary">afficher détails</a>
                </div>
                <div class="card-footer">
                  <div class="counter d-flex">
                    <button class="btn btn-primary mx-1 counter-add ">+</button>
                    <input class="form-control" type="number" name="qte" id="qty" value="1" max="<?php echo $row['qte']?>">
                    <button class="btn btn-primary mx1 counter-remove">-</button>
                  </div>
                </div> 
           </div>
          <?php
    }
}
?>
        </div>
    </div>
