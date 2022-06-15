<?php
require_once 'connect.php';

function create_order($id_product, $quantity_product, $id_user,$first_name,$last_name,$address_user,$phone_number, $createAt_order){
    $sql = "INSERT INTO orders (id_product,quantity_product,id_user,first_name,last_name,address_user, phone_number,createAt_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 
    pdo_execute($sql, $id_product, $quantity_product, $id_user,$first_name,$last_name,$address_user,$phone_number, $createAt_order);
}
function getAllOrders(){
    $sql = "SELECT * FROM orders LEFT JOIN products ON products.id_product = orders.id_product LEFT JOIN users ON users.id_user = orders.id_user";
    return pdo_query($sql);
}