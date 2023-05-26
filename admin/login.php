<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="icon/png"  href="../image/shopping.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/bootstrap.css" rel="stylesheet">
  <script src="../bootstrap/bootstrap.js" ></script>
    <title>login</title>
</head>
<body>
    <?php include "./include/nav.php" ?>
  <div class="container">
 <?php
 if(isset($_POST['submit'])){
    $id = $_POST['login'];
    $password = hash('md5',$_POST['password']);
    if(!empty($id) && !empty($password)){
      require_once "../connection.php";
      $query = "SELECT * FROM admin WHERE id_admin = '$id' AND password = '$password'";
      $result = mysqli_query($connection, $query);
      if($result){
        if(mysqli_num_rows($result) >0){
            $_SESSION['admin'] = mysqli_fetch_assoc($result);
            header('location: admin.php');
        }
        else{
            ?>
        <div class="alert alert-danger" role="alert">
           login ou bien password incorrect !
        </div>
        <?php
        }
      }
    }
    else{
        ?>
        <div class="alert alert-danger" role="alert">
          login password sont obligatoire
        </div>
        <?php
       }
 }
?>
    <h4 style="margin-top:7px; text-align: center;">Login</h4>
    <form action="" method="post">

    <label for="" class="form-label">ID ADMIN </label>
    <input type="text" class="form-control" name="login" id="" >

    <label for="" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="">

    <input type="submit" name="submit" value="login" class="btn btn-primary btn-lg my-2">
  </form>
  </div>
</body>
</html>