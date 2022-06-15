<?php
require_once 'connect.php';

function create_order($id_product, $quantity_product, $id_user,$first_name,$last_name,$address,$phone_number, $createAt){
    $sql = "INSERT INTO orders (id_product,quantity_product,id_user,first_name,last_name,adress, phone_number,createAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 
    pdo_execute($sql, $id_product, $quantity_product, $id_user,$first_name,$last_name,$address,$phone_number, $createAt);
}