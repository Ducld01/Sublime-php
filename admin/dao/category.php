<?php
require_once 'connect.php';

function create_category($name_category){
    $sql = "INSERT INTO categories(name_category) VALUES (?)";
    pdo_execute($sql, $name_category);
}
function updateCategory($id_category,$name_category){
    $sql = "UPDATE categories SET name_category = ? WHERE id_category = ?";
    pdo_execute($sql, $id_category, $name_category);
}
function deleteCategory($id_category){
    $sql = "DELETE FROM categories WHERE id_category =?";
    if (is_array($id_category)) {
        foreach($id_category as $id){
            pdo_execute($sql, $id);
        }
    } else {
        pdo_execute($sql, $id_category);
    }
}
function allCategories(){
    $sql = "SELECT * FROM categories";
    return pdo_query($sql);
}
function categoryById($id_category){
    $sql = "SELECT * FROM categories WHERE id_category=?";
    return pdo_query_one($sql, $id_category);
}
function categoryExists($id_category){
    $sql = "SELECT count(*) FROM categories WHERE id_category =?";
    return pdo_query_value($sql, $id_category) > 0;
}
