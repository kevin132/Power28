<?php
require_once 'tools/common.php';
$db = dbConnect();
session_start();
if (isset($_GET['logout']) && isset($_SESSION['user'])) {
    unset($_SESSION["user"]);
    unset($_SESSION["is_admin"]);
    unset($_SESSION["user_id"]);
}
if (isset($_POST['register'])){
    require_once('controllers/account.php');
}
if (isset($_POST['login'])){
    require_once('controllers/login.php');
}
if(isset($_POST['update'])){
    require_once ('controllers/user-profile.php');
}
if(isset($_POST['recup_submit'])){
    require_once ('controllers/forgot-password.php');
}
if(isset($_POST['verif_submit'])){
    require_once ('controllers/forgot-password.php');
}
if(isset($_POST['change_submit'])){
    require_once ('controllers/forgot-password.php');
}
require_once 'views/partials/head_assets.php';
require_once 'views/partials/nav.php';
$page = '';
if (isset($_GET['page'])) {
    $page = explode('/', $_GET['page']);
}
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'features') {
        require('controllers/features.php');
    } elseif ($_GET['page'] == 'account') {
        require_once('controllers/account.php');
    } elseif ($_GET['page'] == 'user-profile') {
        require_once('controllers/user-profile.php');
    } elseif ($_GET['page'] == 'login') {
        require_once('controllers/login.php');
    } elseif ($_GET['page'] == 'forgot-password') {
        require_once('controllers/forgot-password.php');
    } elseif ($_GET['page'] == 'prices') {
        require_once('controllers/prices.php');
    } elseif ($_GET['page'] == 'faq') {
        require_once('controllers/faq.php');
    } elseif ($_GET['page'] == 'forum') {
        require_once('controllers/forum.php');
    } elseif ($_GET['page'] == 'error') {
        require_once('controllers/error.php');
    } elseif ($_GET['page'] == 'about') {
        require_once('controllers/about.php');
    } else {
        require('controllers/index.php');
    }
} else {
    require('controllers/index.php');
}
require_once 'views/partials/footer.php';




