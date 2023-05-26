<?php session_start() ;
     $connect = false;
     if(isset($_SESSION['admin'])){
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
    <title>Document</title>
    <style>
        
    </style>
</head>

<body>
    <?php if($connect){
        require_once '../connection.php';
        $id = $_GET['id'];
       $sql = "SELECT * FROM categorie WHERE id_categorie = '$id' ";
       $res = mysqli_query($connection,$sql);
       if(isset($_POST['modifier'])){
           if(!empty($_POST['libelle'])  && !empty($_POST['icon']) ){
               $libelle = $_POST['libelle'];
               $icon = $_POST['icon'];
               $date = date('y-m-d');
               $requet = "UPDATE categorie
               SET libelle = '$libelle',
                description = '$description' , 
                icon = '$icon',
                date_creation = '$date'
                WHERE id_categorie = '$id' ";
               $result = mysqli_query($connection,$requet);
           if($result){
               ?>
           <div class="alert alert-success" role="alert">
               la categorie  a etait bien modifier .
           </div>
           <?php
           header('location: categorie.php');
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
       
         
       
       
       
       





       if($res){ 
        
        while($elt  = mysqli_fetch_array($res)){
            ?>

    <div class="container">
        <h4>modifier categorie</h4>
    <form action="" method="post">

<label for="" class="form-label">libelle</label>
<input type="text" class="form-control" name="libelle" id="" value="<?php echo $elt['libelle'] ?>">
<label for="" class="form-label">icon tag</label>
<input type="text" class="form-control" name="icon" id="" value="<?php echo $elt['icon'] ?>">
<label for="" class="form-label">description</label>
<textarea class="form-control" name="description" id="" cols="30" rows="10" value=""><?php echo $elt['description'] ?></textarea>
<input type="submit"  name="modifier" value="ajouter categorie " class="btn btn-primary btn-lg my-2 ">
</form>
    </div>
    <?php }

    }
}
else{
    header('location: login.php');
 } 
   
    ?>
</body>
</html>
