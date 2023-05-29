<?php
session_start();
$connect = false;
if(isset($_SESSION['client'])){
  $connect = true;
}
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
  <title>mes commandes</title>
</head>
<body>
 <?php 
 if($connect){
 ?>
  <div class="container">
    <h2>mes commande </h2>
    <?php
      $id_client = $_SESSION['client']['id_client'];
       require_once'../connection.php';
     $req = "SELECT * FROM commande WHERE id_client = '$id_client';";
     $result = mysqli_query($connection,$req);
    
            ?>
     
  <table class="table table-success table-striped">
    <thead>
    <tr>
        <th>id_commande</th>
        <th>total</th>
        <th>date creation</th>
        <th>validation </th>
    </tr>
    </thead>
    <tbody>
    <?php
       if($result){
        while($elt = mysqli_fetch_array($result)){
            ?>
       <tr>
        <td><?php echo $elt['id_commande'] ?></td>
        <td><?php echo $elt['total'] ?></td>
        <td><?php echo $elt['date_commander'] ?></td>
        <td>
         <?php
           if($elt['valid'] == 0){
            ?>

              <div class="alert alert-danger" role="alert">
                cette commande  est encours de traité !!
               </div>

            <?php
           }else{
            ?>
            <div class="alert alert-success w-1" role="alert">
              cette commande  est validé .
              <a class="btn btn-warning" href="../upload/recu/<?php echo $elt['recu_commande']; ?>" download="recu commande">votre recu de commande</a>
             </div>
          <?php
           }
         ?>
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