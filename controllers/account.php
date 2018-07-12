<?php require('models/account.php');

if (isset($_POST['register'])) {
    $query = $db->prepare('SELECT email FROM user WHERE email = ?');
    $query->execute(array($_POST['email']));
    $userAlreadyExists = $query->fetch();
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];
    if (empty($firstname) OR empty($password) OR empty($email)) {
        $registerEmpty = "Merci de remplir tous les champs";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $registerMessage = "Adresse email non valide";
    } elseif ($userAlreadyExists) {
        $registerMessage = "Adresse email déjà enregistrée";
    } elseif ($password != $passwordConfirm) {
        $passwordMessage = "Les mots de passe ne sont pas identiques";
    } elseif (strlen($password) < 8 && !preg_match('#^(?=.*[a-z])(?=.*[0-9])#', $password)) {
        $passwordMessage = "Le mot de passe doit contenir au moins 8 caractères.";
    } else {
        $query = $db->prepare('INSERT INTO user (firstname,email,password) VALUES (?, ?, ?)');
        $newUser = $query->execute(
            [
                $_POST['firstname'],
                $_POST['email'],
                hash('md5', $_POST['password']),
            ]
        );
        $_SESSION['is_admin'] = 0;
        $_SESSION['user'] = $_POST['firstname'];
    }
    if (isset($_SESSION['user'])) {
        header('location:index.php?page=prices');
        exit;
    }
}
require('views/account.php');




