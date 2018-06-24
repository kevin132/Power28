<?php
function getloadimage()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM screen');
    return $query->fetch();
}


?>