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

function hadleFilterPaginations(){
    $row_per_page = 8;
    $total_row = pdo_query_value("SELECT * FROM products");
    $total_page = ceil($total_row / $row_per_page);

    $current_page = existParam("page_no") ? $_REQUEST['page_no'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    }
    if ($current_page > $total_page){
        $current_page = $total_page;
    }
    $start = ($current_page-1)* $row_per_page;
    $sql = "SELECT * FROM products ORDER BY id_category LIMIT {$start}, {$row_per_page}";
    $_SESSION['total_page']= $total_page;
    $_SESSION['prev_page']= ($current_page > 1) ? ($current_page - 1):1;
    $_SESSION['next_page']= ($current_page < $total_page) ? ($current_page + 1):$total_page;
    return pdo_query($sql);
}