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
</head>
<body>
    <?php
      if($connect){
    require_once "../connection.php";
   
    $sql = "SELECT * FROM categorie ";
    $result = mysqli_query($connection,$sql);

    
     ?>
    <div class="container py-2">
    <h4 style="margin-top:7px; text-align: center;">modifier produit</h4>
    <?php
    $id_produit = $_GET['id'];
    $rem = "SELECT * FROM produit WHERE id_produit = '$id_produit';  ";

     $rel = mysqli_query($connection,$rem);
     if($rem){

     if(isset($_POST['modifier'])){
       $code_product = $_POST['id_produit'];
        $libelle = $_POST['libelle'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $description = $_POST['description'];
        $qte = $_POST['qte'];
        $date = date('y-m-d');
        $id_categorie = $_POST['categorie'];
        $image = "";
        if(isset($_FILES['image'])){
          $image = $_FILES['image']['name'];
          $filename = uniqid().$image;
          move_uploaded_file($_FILES['image']['tmp_name'],'../upload/produit/'.$filename);
                
      }
        if(!empty($code_product) && !empty($libelle) && !empty($prix) && !empty($_POST['description'])  && !empty($id_categorie) &&!empty($qte)){
           $sqli = "UPDATE produit SET id_produit = '$code_product',qte = '$qte', libelle = '$libelle', prix = '$prix', discount = '$discount' ,description = '$description', date_creation ='$date', image = '$filename', id_categorie = '$id_categorie' WHERE id_produit = '$id_produit';";
            $insert = mysqli_query($connection,$sqli);
            if($insert){
                ?>
                <div class="alert alert-success" role="alert">
                  le produit <?php echo $libelle  ?> a été bien modifier !
                </div>
                <?php
                
                header('location: produit.php');
            }
            else{
                ?>
                <div class="alert alert-danger" role="alert">
                  error !!
                </div>
                <?php
            }
        }else{
            ?>
      <div class="alert alert-danger" role="alert">
        les champs modification  sont vide !
      </div>
      <?php
        }
     } 
     while($elt = mysqli_fetch_array($rel)){
      if(isset($_POST['modifier'])){
        $filename = $elt['image'];
        $path = "../upload/produit/".$filename;
        if(file_exists($path)){
            if(!unlink($path)){
                echo "erreur";
            }
      }
    }
     ?>
       
    <form action="" method="post" enctype="multipart/form-data">
    <label for="" class="form-label">code produit</label>
    <input type="number" class="form-control" name="id_produit" id=""  value="<?php echo $elt['id_produit'] ?>">

    <label for="" class="form-label">libelle</label>
    <input type="text" class="form-control" name="libelle" id=""  value="<?php echo $elt['libelle'] ?>">

    <label for="" class="form-label">prix de produit</label>
    <input type="number" class="form-control" name="prix" id="" min = "0"  value="<?php echo $elt['prix'] ?>">
     
    <label for="" class="form-label">quantité de produit</label>
    <input type="number" class="form-control" name="qte" id="" min = "0"  value="<?php echo $elt['qte'] ?>">

    <label for="" class="form-label">discount</label>
    <input type="number" class="form-control" name="discount" id="" min= "0" max ="100" required  value="<?php echo $elt['discount'] ?>">
    
    
    <label for="" class="form-label">description</label>
    <textarea class="form-control" name="description" id="" cols="30" rows="10"><?php echo $elt['description'] ?></textarea>

    <label for="image" class="form-label">image produit</label>
    <input type="file" class="form-control" name="image" id="" value="<?php echo $elt['image'] ?>">

    <label for="" class="form-label">categorie produitt</label>
    <select class="form-control my-2" name="categorie" id="">
        <option value="">choisir une categorie</option>
        <?php
        if($result){
        while($elt = mysqli_fetch_array($result)){
            echo'<option value="'.$elt['id_categorie'].'">'.$elt['libelle'].'</option>';
        }
    }
        ?>
    </select>
    <input type="submit"  name="modifier" value="modifier categorie " class="btn btn-primary btn-lg my-2 ">
    </form>
  
    </div>
    <?php

}
     }
    }else{
        header('location: login.php');
    }
  
     
     ?>
</body>
</html>