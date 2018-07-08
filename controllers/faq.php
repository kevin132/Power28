<?php require_once('models/faq.php');
$faqCategories = getFaq_categories();
$faqContents = getFaq_content();
require_once('views/faq.php');

