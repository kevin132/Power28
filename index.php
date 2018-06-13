<?php
require_once 'tools/common.php';
$db = dbConnect();
session_start();
$page='';
if(isset($_GET['page'])){
    $page=explode('/',$_GET['page']);
}
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'features') {
        require('controllers/features.php');
    } elseif ($_GET['page'] == 'account') {
        require_once('controllers/account.php');
    } elseif ($_GET['page'] == 'prices') {
        require_once('controllers/prices.php');
    } elseif ($_GET['page'] == 'faq') {
        require_once('controllers/faq.php');
    } elseif ($_GET['page'] == 'about') {
        require_once('controllers/about.php');
    } else {
        require('controllers/index.php');
    }

} else {
    require('controllers/index.php');
}

require_once 'views/partials/head_assets.php';
require_once 'views/partials/nav.php';
?>
<?php require_once 'views/partials/footer.php' ?>



