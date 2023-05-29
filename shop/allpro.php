<?php 
$rq = "SELECT * FROM produit;";
$pro = mysqli_query($connection,$rq);
if($pro){
    while($ely = mysqli_fetch_array($pro)){
        ?>
        <?php
    $prix = $ely['prix'];
    if($ely['discount'] == 0){
        $total = $prix;
    }else{
        $total = $prix - ($prix * $ely['discount'] / 100);
    }
   
    ?>
          <div class="card mb-3 me-4 "style="width: 22rem;"  id="oop">
          <div class ="container" style="width: 18rem; height: 15rem;" >
          <img  src="./upload/produit/<?php echo $ely['image'] ?>" class="card-img-top w-70 mx-auto" alt="<?php echo $ely['libelle'] ?>">
          </div>
          <div class="card-body">
               <h5 class="card-title"><?php echo $ely['libelle'] ?></h5>
               
               <strike><p class="card-text">prix :<?php if($ely['discount'] != 0) {?> <?php echo $ely['prix'] ;?><?php } ?> <strong>DA</strong></p></strike>
               
                <p class="card-text">prix : <?php echo $total ;?> <strong>DA</strong></p>
                
                <p class="card-text">remise :<?php if($ely['discount'] != 0) {?> <?php echo $ely['discount'] ?><?php } ?> <strong>%</strong></p>
                
                <p class="card-text">date creation : <?php echo $ely['date_creation'] ?></p>
                <a href="./shop/prdet.php?<?php echo 'id_produit='.$ely['id_produit'];?>" class="btn btn-primary">afficher détails</a>
                
                </div>
                <div class="card-footer">
                  <div class="counter d-flex">
                   <?php if($connect){
                    $id_user = $_SESSION['client']['id_client'];
                    $qte = $_SESSION['panier'][$id_user][$ely['id_produit']] ?? 0;
                   
                    ?>
                    <form action="./shop/cart.php" method="post" class="counter d-flex">
                    <button onclick="return false" class="btn btn-primary mx-1 counter-add">+</button>
                    <input type="hidden" name="id_produit" id="" value="<?php echo $ely['id_produit'] ?>">
                    <input class="form-control" type="number" name="qty" id="qty" value="<?php if($connect) echo $qte ?>" max="<?php echo $ely['qte']?>">
                    <button onclick="return false" class="btn btn-primary mx-1 counter-remove" >-</button>  
                    <input type="submit" value="ajouter" name="ajouter" class="btn btn-success">
                    </form>
                    <?php }
                   
                    ?>
                  </div>
                </div>
          </div>
          <?php
    }
}

?>
       
