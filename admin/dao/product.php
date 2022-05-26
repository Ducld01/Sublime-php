<?php

require_once 'connect.php';

function createProduct($name_product, $price_product, $sale_product, $image_product, $createAt_product, $description_product, $special_product, $view_of_number, $id_category){
    $sql = "INSERT INTO products (name_product, price_product, sale_product, image_product, createAt_product, description_product, special_product, view_of_number, id_category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $name_product, $price_product, $sale_product, $image_product, $createAt_product, $description_product, $special_product, $view_of_number, $id_category);
}

function updateProduct($id_product, $name_product, $price_product, $sale_product, $image_product, $createAt_product, $description_product, $special_product, $view_of_number, $id_category){
    $sql = "UPDATE products SET name_product=?, price_product=?, sale_product=?, image_product=?, createAt_product=?, description_product=?, special_product=?, view_of_number=?, id_category=? WHERE id_product=?";
    pdo_execute($sql, $name_product, $price_product, $sale_product, $image_product, $createAt_product, $description_product, $special_product, $view_of_number, $id_category, $id_product);
}

function getAllProducts(){
    $sql = "SELECT * FROM products";
    return pdo_query($sql);
}

function deleteProduct ($id_product){
    $sql = "DELETE FROM products WHERE id_product =?";
    if (is_array($id_product)) {
        foreach ($id_product as $id){
            pdo_execute($sql, $id);
        }
    } else {
        pdo_execute($sql, $id_product);
    }
}

function getProductById($id_product){
    $sql = "SELECT * FROM products WHERE id_product=?";
    return pdo_query_one($sql,$id_product);
}

function getRelatedProductsById($id_category){
    $sql = "SELECT * FROM products WHERE id_category=?";
    return pdo_query($sql,$id_category);
}
