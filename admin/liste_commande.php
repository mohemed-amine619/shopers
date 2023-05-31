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
  <title>admin</title>
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
    <h2>list des categories </h2>
    <?php
    
       require_once'../connection.php';
     $req = "SELECT commande.*,client.nom_cl FROM commande INNER JOIN client ON commande.id_client = client.id_client ORDER BY commande.date_commander DESC";
     $result = mysqli_query($connection,$req);
    
            ?>
     
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
    <?php
       if($result){
        while($elt = mysqli_fetch_array($result)){
            ?>
       <tr>
        <td><?php echo $elt['id_commande'] ?></td>
        <td><?php echo $elt['nom_cl'] ?></td>
        <td><?php echo $elt['total'] ?> <strong>DA</strong></td>
        <td><?php echo $elt['date_commander'] ?></td>
        <td>
        <a href="commande.php?id_commande= <?php echo $elt['id_commande']?>" class="btn btn-primary">afficher détails</a>
        <a href="supprimer_commande.php?id=<?php echo $elt['id_commande']?>" class="btn btn-danger">ejecter la commande</a> 
       </td>
       </tr>
       <?php
        }
    }
    ?>
    </tbody>
</table>
  </div>
</body>
</html>
<?php }else{
    header('location: login.php');
 } ?>