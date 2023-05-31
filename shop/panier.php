<?php 
session_start();
$connect = false;
if(isset($_SESSION['client'])){
  $connect = true;
}
?>
<?php
if($connect){
require_once "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="icon/png"  href="../image/shopping.png">
  <link href="../bootstrap/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../css file/style.css">
  <link rel="stylesheet" href="../css file/navp.css">
  <script src="../bootstrap/bootstrap.js" ></script>
  <title>panier</title>
</head>
<body>
</div>
   <div class="container">
     <!-- insert data in commande table -->
     <?php 
     $id_client = $_SESSION['client']['id_client'];
     $panier = $_SESSION['panier'][$id_client];
     if(!empty($panier)){
         $id_produits = array_keys($panier);
         $id_produits = implode(",",$id_produits);
         
       
        $produits = "SELECT * FROM produit WHERE id_produit IN ($id_produits)";
        $req = mysqli_query($connection,$produits);
        $total = 0;
        $total_co = 0;
        $prix_produit = [];
     }
      /* items is id_produit */
       if(isset($_POST['valider'])){
        $id_commande = rand(0,999999);
        $date_commander = date('y-m-d H:i:s', time() - 3600);
        $id_client = $_SESSION['client']['id_client'];
        while($produit = mysqli_fetch_array($req)){
            $id_produit = $produit['id_produit'];
            $qte = $panier[$id_produit];
            $price = $produit['prix']-(($produit['discount']*$produit['prix'])/100);
            $total_co = $total_co + ($qte * $price);
            $valid = 0;
            $prix_produit[$id_produit] = [
                'id_produit' => $id_produit,
                'prix' => $price,
                'total' => ($qte * $price),
                'qty' => $qte
            ];
        }
        
        $sqlstate = "INSERT INTO commande(id_commande,id_client,total,date_commander,valid,recu_commande) VALUES ('$id_commande','$id_client','$total_co','$date_commander','$valid','norecu')";
        $valider_commande = mysqli_query($connection,$sqlstate);
        foreach($prix_produit as $produit){
            $id_produit = $produit['id_produit'];
            $qte = $produit['qty'];
            $pr = $produit['prix'];
            $total = $produit['total'];
            $sql = "INSERT INTO composer(id_commande,id_produit,qte,prix,total_produit) VALUES ('$id_commande','$id_produit','$qte','$pr','$total')";
            $reqw= mysqli_query($connection,$sql);
        }
        if($valider_commande){
            $_SESSION['panier'][$id_client] = [];
            ?>
            <div class="alert alert-warning" role="alert">
              votre commande n°=  <?php echo $id_commande ?> avec le montant <?php echo $total_co ?> DA été effectuer
        </div>
            <?php
        }
    }
      ?>
      <h4>Panier</h4>
      <a href="../index.php" class="btn btn-warning mb-2"> <strong><- retourner</strong></a>
    <div class="row">
    <?php 
        
        if(empty($panier)){
            ?>
            <div class="alert alert-warning" role="alert">
              votre panier est vide !!!
        </div>
        <?php
         }
         else{
            ?>
        <table  class="table table-success table-striped">
        <thead>
            <th>id produit</th>
            <th>libelle</th>
            <th>prix</th>
            <th>quantite</th>
            <th>total</th>
        </thead>
    
      <?php
      $req1 = mysqli_query($connection,$produits);
      $total = 0;
        while($prd = mysqli_fetch_array($req1)){
            $prds = $prd['prix'] - (($prd['prix']*$prd['discount'])/100);
            $total += $prds*$panier[$prd['id_produit']];
            ?>
             <tr>
                <td><?php echo $prd['id_produit'] ?></td>
                <td><?php echo $prd['libelle'] ?></td>
                <td><?php echo $prds ?></td>
                <td>
                <div class="counter d-flex">
                    
                   <?php
                     if($connect){
                    $id_user = $_SESSION['client']['id_client'];
                    $qte = $_SESSION['panier'][$id_user][$prd['id_produit']] ?? 0;
                    
                      } ?>
                    <form action="./cart.php" method="post" class="counter d-flex">
                    <button onclick="return false" class="btn btn-primary mx-1 counter-add">+</button>
                    <input type="hidden" name="id_produit" id="" value="<?php echo $prd['id_produit'] ?>">
                    <input class="form-control" type="number" name="qty" id="qty" value="<?php if($connect) echo $qte ?>" max="<?php echo $prd['qte']?>">
                    <button onclick="return false" class="btn btn-primary mx-1 counter-remove" >-</button>  
                    <input type="submit" value="ajouter" name="ajouter" class="btn btn-success">
                    <?php if($qte != 0){
                        ?>
                         <input formaction="supprimer_panier.php" type="submit" value="supprimer" name="ajouter" class="btn btn-danger">
                        <?php
                    }
                   ?>
                    </form>
                  </div>
                </td>
                <td><?php echo $prds*$panier[$prd['id_produit']] ?><strong>DA</strong></td>
             </tr>
            <?php
        }
        ?>
        <tfoot>
            <tr>
                <td colspan="4" align="right"><strong>TOTAL :</strong>  </td>
                <td><?php echo $total ?><strong>DA</strong></td>
            </tr>
            <tr>
                <td colspan="5" align="right">
                    <?php
                    if(isset($_POST['vider'])){
                        $_SESSION['panier'][$id_client] = [];
                        header('location: panier.php');
                    }
                   
                    ?>
                    <form action="" method="post">
                         <input type="submit" value="valider la commande" class="btn btn-success" name="valider">
                         <input onclick="return confirm('vouler vraiment vider le panier');" type="submit" name="vider" value="vider le panier" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        </tfoot>
        <?php }  ?>
        </table>
    </div>
    
   </div>
<script src="../jquery/jq.js"></script>
   <script src="../js/count.js"></script>
</body>
</html>
<?php }else{
    header('location: login.php');
}
?>