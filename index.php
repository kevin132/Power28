<?php
require_once 'tools/common.php';
$db = dbConnect();
session_start();
if (isset($_GET['logout']) && isset($_SESSION['user'])) {
    unset($_SESSION["user"]);
    unset($_SESSION["is_admin"]);
    unset($_SESSION["user_id"]);
}
if (isset($_POST['register'])) {
    require_once('controllers/account.php');
}
if (isset($_POST['login'])) {
    require_once('controllers/login.php');
}
if (isset($_POST['update'])) {
    require_once('controllers/user-profile.php');
}
if (isset($_POST['recup_submit'])) {
    require_once('controllers/forgot-password.php');
}
if (isset($_POST['verif_submit'])) {
    require_once('controllers/forgot-password.php');
}
if (isset($_POST['change_submit'])) {
    require_once('controllers/forgot-password.php');
}
if (isset($_POST['forum_save'])) {
    require_once('controllers/forum.php');
}
require_once 'views/partials/head_assets.php';
require_once 'views/partials/nav.php';

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
    } elseif ($_GET['page'] == 'new_topic') {
        require_once('controllers/new_topic.php');
    } elseif ($_GET['page'] == 'forum') {
        require_once('controllers/forum.php');
    } elseif ($_GET['page'] == 'forum_response') {
        require_once('controllers/forum_response.php');
    } elseif ($_GET['page'] == 'error') {
    } elseif ($_GET['page'] == 'admin') {
        require_once('controllers/admin/admin.php');
    } elseif ($_GET['page'] == 'faq-list') {
        require_once('controllers/admin/faq-list.php');
    } elseif ($_GET['page'] == 'admin-faq-form') {
        require_once('controllers/admin/faq-form.php');
        require_once('controllers/error.php');
    } elseif ($_GET['page'] == 'about') {
        require_once('controllers/about.php');
    } elseif ($_GET['page'] == 'payment_form') {
        require_once('controllers/payment_form.php');
    } elseif ($_GET['page'] == 'payment') {
        require_once('controllers/payment.php');
    } elseif ($_GET['page'] == 'stripe') {
        require_once('controllers/stripe.php');
    } else {
        require('controllers/index.php');
    }
} else {
    require('controllers/index.php');
}


require_once 'views/partials/footer.php';




