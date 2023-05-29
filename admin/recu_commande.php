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
    
    <?php
    require_once "../connection.php";
    include_once "./include/nav.php";
    ?>
    <div class="container">
    <?php
    if($connect){
        $id = $_GET['id_commande'];
        $recu = "";
        if(isset($_POST['ajc'])){
            
            if(isset($_FILES['recu'])){
                $recu = $_FILES['recu']['name'];
                
                $filename = uniqid().$recu;
                
                move_uploaded_file($_FILES['recu']['tmp_name'],'../upload/recu/'.$filename);
            }
            
                $sqlState = "UPDATE commande SET recu_commande = '$filename' WHERE id_commande = '$id';";
                $vd = mysqli_query($connection,$sqlState);
                if($vd){
                    ?>

                       <div class="alert alert-success" role="alert">
                         le recu de la commande n° =  <?php echo $id ?> a été bien affecter !
                        </div>

                    <?php
                
               }
             
                
            }
       ?>
    
    
<form action="" method="post" enctype="multipart/form-data">
    <label class="form-label" for="recu_commande">recu commande</label>
    <input class="form-control" type="file" name="recu" id="" required>
    <input type="submit"  name="ajc" value="affecter" class="btn btn-primary btn-lg my-2 ">
</form>
</div>
</body>
</html>
<?php }else{
    header('location: login.php');
 } ?>