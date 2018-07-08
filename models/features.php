<?php
function getFeatureImage()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM screen');
    return $query->fetchAll();
}



