<?php 
require_once 'connect.php';

function addUser ($name_user, $fullname_user, $password_user, $image_user, $email_user, $status_user, $role_user){
    $sql = "INSERT INTO users(name_user,fullname_user, password_user, image_user, email_user, status_user, role_user) VALUES(?,?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $name_user,$fullname_user, $password_user, $image_user, $email_user, $status_user==1, $role_user);
}

function updateUser( $id_user, $name_user, $fullname_user,  $email_user, $status_user, $role_user){
    $sql = "UPDATE users SET  name_user=?, fullname_user=?, email_user=?, status_user=?, role_user=? WHERE id_user=?";
    pdo_execute($sql, $id_user, $name_user, $fullname_user,  $email_user, $status_user==1,  $role_user);
}

function deleteUser($id_user){
    $sql = "DELETE FROM users WHERE id_user=?";
    if (is_array($id_user)) {
        foreach($id_user as $id){
            pdo_execute($sql, $id);
        }
    }
    else {
        pdo_execute($sql, $id_user);
    }
}

function getAllUsers(){
    $sql = "SELECT * FROM users";
    return pdo_query($sql);
}

function getUserById($id_user){
    $sql = "SELECT * FROM users WHERE id_user=?";
    return pdo_query_one($sql, $id_user);
}

function existUser($email_user){
    $sql = "SELECT count(*) FROM users WHERE email_user=?";
    return pdo_query_value($sql, $email_user) > 0;
}

function existUserName($name_user){
    $sql = "SELECT count(*) FROM users WHERE name_user=?";
    return pdo_query_value($sql, $name_user) > 0;
}

function userSelectByRole($role_user){
    $sql = "SELECT * FROM users WHERE role_user=?";
    return pdo_query($sql, $role_user);
}

function changePasswordUser($id_user, $new_password){
    $sql = "UPDATE users SET password_user=? WHERE id_user=?";
    pdo_execute($sql, $new_password, $id_user);
}