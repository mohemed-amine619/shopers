<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="icon/png"  href="../image/shopping.png">
    <link href="../bootstrap/bootstrap.css" rel="stylesheet">
    <script src="../bootstrap/bootstrap.js" ></script>
    <title>admin</title>
</head>
<body>
    <?php include_once "./include/nav.php" ;
    if($connect){
    ?>
    <div class="container py-2">
    <h4 style="margin-top:7px; text-align: center;">ajouter categorie</h4>
    <?php
    if(isset($_POST['ajc'])){
        if(!empty($_POST['libelle'])  &&  !empty($_POST['icon'])){
            $libelle = $_POST['libelle'];
           
            $icon = $_POST['icon'];
            $date = date('y-m-d');
           require_once "../connection.php";
           $sql = "INSERT INTO categorie(libelle,icon,date_creation) VALUES('$libelle','$icon','$date')";
           $result = mysqli_query($connection,$sql);
        if($result){
            ?>
        <div class="alert alert-success" role="alert">
        la categorie a etait bien ajouter.
        </div>
        <?php
        }
        }
        else{
            ?>
      <div class="alert alert-danger" role="alert">
        les champs sont vide !
      </div>
      <?php
        }
    }
    ?>
    <form action="" method="post">

    <label for="" class="form-label">libelle</label>
    <input type="text" class="form-control" name="libelle" id="" >

    <label for="" class="form-label">icon tag</label>
    <input type="text" class="form-control" name="icon" id="" placeholder="insert from ionicon">
    <input type="submit"  name="ajc" value="ajouter categorie " class="btn btn-primary btn-lg my-2 ">
    </form>
  
    </div>
</body>
</html>
 <?php }else{
    header('location: login.php');
 } ?>