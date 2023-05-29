<?php
session_start();
if(!isset($_SESSION['client'])){
    header('Location: login.php');
}
$id_pro = $_POST['id_produit'];
$id_client = $_SESSION['client']['id_client'];
unset($_SESSION['panier'][$id_client][$id_pro]);
header("location:".$_SERVER['HTTP_REFERER']);

?>