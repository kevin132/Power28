<?php

function getRegister($registerEmail)
{
    $db=dbConnect();
    $query = $db->prepare('SELECT email FROM user WHERE email = ?');
    $query->execute(array($registerEmail));
    return $query->fetch();
}

?>