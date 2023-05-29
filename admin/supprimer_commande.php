<?php 
session_start() ;
$connect = false;
if(isset($_SESSION['admin'])){
 $connect = true;
}
if($connect){
require_once "../connection.php";
$id = $_GET['id'];
echo $id;
$sql = "DELETE FROM commande WHERE id_commande = '$id';";
$del = mysqli_query($connection,$sql);
if($del){
    header('location:./liste_commande.php');
}
}else {
    header('location: login.php');
}

?>
