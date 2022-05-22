<?php

    require_once 'connect.php';

    function addToCart($id_product, $id_user, $quantity_product) {
        $sql = "INSERT INTO cart (id_product, id_user, quantity_product) VALUES (?, ?, ?)";
        pdo_execute($sql, $id_product, $id_user, $quantity_product);
    }

    function existProductUserInCart ($id_user, $id_product){
        $sql = "SELECT count(*) FROM cart WHERE id_user = ? AND id_product = ?";
        return pdo_query_value($sql, $id_user, $id_product) > 0;
    }