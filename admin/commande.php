<?php require_once'../connection.php';
     $id_commande = $_GET['id_commande'];
     $req = "SELECT commande.*,client.nom_cl FROM commande INNER JOIN client ON commande.id_client = client.id_client WHERE commande.id_commande = '$id_commande' ORDER BY commande.date_commander DESC";
     $result = mysqli_query($connection,$req);
     while($commande = mysqli_fetch_array($result)){

     ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="icon/png"  href="../image/shopping.png">
  <link href="../bootstrap/bootstrap.css" rel="stylesheet">
  <script src="../bootstrap/bootstrap.js" ></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <title>commande | <?php echo $commande['id_commande'];?></title>
  <style>
    ion-icon{
      font-size: 2em;
    }
  </style>
</head>
<body>
 <?php include 'include/nav.php'; 
 if($connect){
 ?>
 <div class="container">
   <h2>la commande :</h2>
   <table class="table table-success table-striped">
    <thead>
    <tr>
        <th>id_commande</th>
        <th>client</th>
        <th>total</th>
        <th>date creation</th>
        <th>option</th>
    </tr>
    </thead>
    <tbody>
   
       <tr>
        <td><?php echo $commande['id_commande'] ?></td>
        <td><?php echo $commande['nom_cl'] ?></td>
        <td><?php echo $commande['total'] ?><strong>DA</strong></td>
        <td><?php echo $commande['date_commander'] ?></td>
        <td><?php if($commande['valid'] == 0){
          ?> <a href="validiter_commande.php?id=<?php echo $commande['id_commande']; ?>&etat=1" class="btn btn-success">valider la commande</a><?php
        }else{
          ?> <a href="validiter_commande.php?id=<?php echo $commande['id_commande']; ?>&etat=0" class="btn btn-danger">anuller la commande</a><?php
        }
       
        ?>
        </td>
       </tr>
    </tbody>
</table>
</div>
  <div class="container">
    <h2>les produits </h2>
  <table class="table table-success table-striped">
    <thead>
    <tr>
        <th>id_commande</th>
        <th>produit</th>
        <th>prix unitaire</th>
        <th>quantité</th>
        <th>total</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $req1 = "SELECT composer.*,produit.libelle FROM composer INNER JOIN produit ON composer.id_produit = produit.id_produit WHERE id_commande = '$id_commande' ;";
       $pes = mysqli_query($connection,$req1);
        while($elt = mysqli_fetch_array($pes)){
            ?>
       <tr>
        <td><?php echo $elt['id_produit'] ?></td>
        <td><?php echo $elt['libelle'] ?></td>
        <td><?php echo $elt['prix'] ?><strong>DA</strong></td>
        <td><?php echo $elt['qte'] ?></td>
        <td>
         <?php echo $elt['total_produit'] ?>
         </td>
       </tr>
       <?php
        }
    
    ?>
    </tbody>
</table>
  </div>
</body>
</html>
<?php }else{
    header('location: login.php');
 }} ?>