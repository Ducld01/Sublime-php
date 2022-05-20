<?php 
    require '../../dao/product.php';
    if (isset($_POST['id'])){
        $id = $_POST['id'];
        $product = getProductById($id);
        echo json_encode($product);
    }
?>