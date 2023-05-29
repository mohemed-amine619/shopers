<?php 
session_start() ;
     $connect = false;
     if(isset($_SESSION['admin'])){
      $connect = true;
     }
include_once '../connection.php';
if($connect){
    $id = $_GET['id'];
    $etat = $_GET['etat'];
    $sqlState = "UPDATE commande SET valid = '$etat' WHERE id_commande = '$id';";
    $vd = mysqli_query($connection,$sqlState);
    if($vd){
        if($etat == 1){
            header('location: ./recu_commande.php?id_commande='.$id);
        }else{
            header('location: ./liste_commande.php?id_commande='.$id);
        }
        
    }
    
}



?>