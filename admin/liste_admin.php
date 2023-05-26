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
</head>
<body>
 <?php include 'include/nav.php'; 
 if($connect){
 ?>
  <div class="container">
    <h2> <ion-icon name="person-outline"></ion-icon> admin </h2>
    <a href="ajouter_utilisateur.php" class="btn btn-primary">ajouter admin</a>
    <?php
     require_once'../connection.php';
     $req = "SELECT * FROM admin";
     $result = mysqli_query($connection,$req);
    
            ?>
     
  <table class="table table-success table-striped">
    <thead>
    <tr>
        <th>id admin</th>
        <th> nom admin</th>
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
        <td><?php echo $elt['id_admin'] ?></td>
        <td><?php echo $elt['login'] ?></td>
        <td><?php echo $elt['date_creation'] ?> </td>
        <td>
       
        <a href="supprimer.php?id=<?php echo $elt['id_admin']; ?>" onclick="return confirm('voulez vraiment supprimer l admin  <?php echo $elt['login'] ?> ?')" class="btn btn-danger">supprimer</a>
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