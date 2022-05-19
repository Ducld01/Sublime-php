<?php
require '../../dao/category.php';
    if (isset($_POST['id'])){
        $id = $_POST['id'];
        $category = categoryById($id);
        echo json_encode($category);
    }
?>