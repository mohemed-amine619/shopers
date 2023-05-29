<?php
session_start();
if(!isset($_SESSION['client'])){
    header('Location: ../admin/login.php');
}
$id_produit = $_POST['id_produit'];
$qte = $_POST['qty'];
$id_client = $_SESSION['client']['id_client'];
if(!empty($_POST['id_produit'])  ){

    if(!isset($_SESSION['panier'][$id_client])){
        $_SESSION['panier'][$id_client] = [];

    }
    if($qte == 0){
        unset($_SESSION['panier'][$id_client][$id_produit]);
    }
    else{
        $_SESSION['panier'][$id_client][$id_produit] = $qte;
    }
    
        
  
}
header("location:".$_SERVER['HTTP_REFERER']);


?>