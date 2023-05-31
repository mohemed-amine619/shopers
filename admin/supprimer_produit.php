<?php 
session_start() ;
$connect = false;
if(isset($_SESSION['admin'])){
 $connect = true;
}
if($connect){
    $id = $_GET['id'];
    require_once "../connection.php";
    $sqlstat = "SELECT image FROM produit WHere id_produit = '$id';";
    $result = mysqli_query($connection,$sqlstat);
    $file = mysqli_fetch_assoc($result)['image'];
    $path = "../upload/produit/".$file;
    if(file_exists($path)){
        if(!unlink($path)){
            echo "erreur";
        }
    }
$sql = "DELETE FROM produit WHERE id_produit = '$id';";
$del = mysqli_query($connection,$sql);
if($del){
    header('location:./produit.php');
}
}else {
    header('location: login.php');
}
?>