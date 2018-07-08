<?php
function getFaq_categories()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM faq_categories');
    return $query->fetchAll();
}
function getFaq_content()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM faq');
    return $query->fetchAll();
}
