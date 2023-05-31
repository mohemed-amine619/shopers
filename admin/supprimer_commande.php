<?php 
session_start() ;
$connect = false;
if(isset($_SESSION['admin'])){
 $connect = true;
}
if($connect){
require_once "../connection.php";
$id = $_GET['id'];
$sqlstat = "SELECT recu_commande FROM commande WHere id_commande = '$id';";
$result = mysqli_query($connection,$sqlstat);
$file = mysqli_fetch_assoc($result)['recu_commande'];
$path = "../upload/recu/".$file;
if(file_exists($path)){
    if(!unlink($path)){
        echo "erreur";
    }
}
$sql = "DELETE FROM commande WHERE id_commande = '$id';";
$del = mysqli_query($connection,$sql);
if($del){
    header('location:./liste_commande.php');
}
}else {
    header('location: login.php');
}

?>
