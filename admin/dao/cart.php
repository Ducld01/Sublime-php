<?php
require_once 'connect.php';

function addToCart($id_product, $id_user, $quantity_product) {
    $sql = "INSERT INTO cart(id_product, id_user, quantity_product) VALUES (?, ?, ?)";
     pdo_execute($sql, $id_product, $id_user, $quantity_product);
}

function existProductUserInCart ($id_user, $id_product){
    $sql = "SELECT count(*) FROM cart WHERE id_user = ? AND id_product = ?";
    return pdo_query_value($sql, $id_user, $id_product) > 0;
}

function fetchProductCart($id_user){
    $sql = "SELECT * FROM cart LEFT JOIN products ON products.id_product = cart.id_product LEFT JOIN categories ON categories.id_category = products.id_category WHERE id_user = ?";
    return pdo_query($sql, $id_user);
}

function countCart ($id_user) {
    $sql = "SELECT count(*) FROM cart WHERE id_user =?";
    return pdo_query_value($sql, $id_user);
}

function updateCart ($id, $quantity_product){
    $sql = "UPDATE cart SET quantity_product=? WHERE id=?";
    pdo_execute($sql, $quantity_product, $id);
}

function deleteCart ($id_user) {
    $sql = "DELETE FROM cart WHERE id_user =?";
    return pdo_execute($sql, $id_user);
}

function deleteItems ($id) {
    $sql = "DELETE FROM items WHERE id =?";
    return pdo_execute($sql, $id);
}