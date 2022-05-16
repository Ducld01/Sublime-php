<?php
    session_start();
// ----------------------------------------------------------------

$ROOT_URL = "/sublime";
$CONTENT_URL = "$ROOT_URL/content";
$ADMIN_URL = "$ROOT_URL/admin";
$CLIENT_URL = "$ROOT_URL/client";


// ----------------------------------------------------------------

$IMAGE_DIR = $_SERVER["DOCUMENT_ROOT"] . "$ROOT_URL/content/images";

// ----------------------------------------------------------------

$VIEW_NAME = "index.php";
$MESSAGE = "";

function existParam($fieldname){
    return array_key_exists($fieldname, $_REQUEST);
}

function saveFile($fieldname, $target_dir){
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, 1);
        $file_uploaded = $_FILES[$fieldname];
        $file_name = basename($file_uploaded["name"]);
        $target_path = $target_dir . $file_name;
        move_uploaded_file($file_uploaded["tmp_name"], $target_path);
        return $file_name;
    }
}

function addCookie($name, $value, $day) 
{
    setcookie($name, $value, time() + (86400 * $day), "/");
}

function getCookie($name){
    return $_COOKIE[$name] ?? '';
}

function deleteCookie($name){
    return $_COOKIE[$name] ?? '';
}

// function checkLogin(){
//     global $CLIENT_URL;
//     if (isset($_SESSION['user'])) {
//         if ($_SESSION['user']['role'] == 1) {
//             return;
//         }
//         if (strpos($_SERVER["REQUEST_URL"], '/admin/') === false) {
//             return;
//         }
//     }
//     $_SESSION['request_uri'] = $_SERVER["REQUEST_URI"];
//     header("location: $CLIENT_URL/pages/user/login.php"); 
// }
