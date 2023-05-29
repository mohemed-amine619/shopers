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
  <title>S'inscrire</title>
</head>
<body>

  <div class="container">
   <?php
   if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = hash('md5',$_POST['password']);
     if(!empty($login) && !empty($password) && !empty($email)){
      require_once '../connection.php';
      $date = date('y-m-d');
      $id = rand(0,999999);
      $query = "SELECT * FROM client WHERE email_cl = '$email' AND password = '$password'";
      $res = mysqli_query($connection,$query);
     
      if($res){
        if(mysqli_num_rows($res) > 0 ){
          ?>
      <div class="alert alert-danger" role="alert">
        cette profile est déja exists
      </div>
      <form action="login.php" method="post">
      <input type="submit" name="sid" value="s'identifier " class="btn btn-primary btn-lg my-2">
      </form>
      <?php
        }
        else{
          $sql = "INSERT INTO client(id_client,nom_cl,email_cl,password,date_creation) VALUES('$id','$login','$email','$password','$date');";
          $result = mysqli_query($connection,$sql);
      if($result){
        ?>
        <div class="alert alert-primary" role="alert">
          <?php header('location: login.php') ?>
        </div>
        <?php  
      }
       }}
     }else{
      ?>
      <div class="alert alert-danger" role="alert">
         les champs sont obligatoire !!
      </div>
      <?php
     }
      }
    
   ?>
    <h4 style="margin-top:7px;"> <ion-icon name="person-add-outline"></ion-icon>s'iscrire</h4>
     <form action="" method="post">
      <label for="" class="form-label">votre nom</label>
      <input type="text" class="form-control" name="login" id="" >
      <label for="" class="form-label">votre Email</label>
      <input type="text" class="form-control" name="email" id="" >
      <label for="" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="">

    <input type="submit"  name="submit" value=" s'inscrire " class="btn btn-primary btn-lg my-2 ">
  </form>
  
  </div>
</body>
</html>
<?php  ?>