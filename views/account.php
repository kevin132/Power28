<?php

if (isset($_POST['register'])) {

    $query = $db->prepare('SELECT email FROM user WHERE email = ?');
    $query->execute(array($_POST['email']));

    $userAlreadyExists = $query->fetch();

    $passwordLength = $_POST['password'];

    if ($userAlreadyExists) {
        $registerMessage = "Adresse email déjà enregistrée";
    } elseif (empty($_POST['firstname']) OR empty($_POST['password']) OR empty($_POST['email'])) {
        $registerMessage = "Merci de remplir tous les champs obligatoires (*)";
    } elseif ($_POST['password'] != $_POST['password_confirm']) {
        $passwordMessage = "Les mots de passe ne sont pas identiques";
    } elseif (strlen($passwordLength) <8) {
        $passwordMessage = "Le mot de passe doit contenir au moins 8 caractères et être composé de lettres et de chiffres.";

    } else {

        $query = $db->prepare('INSERT INTO user (firstname,lastname,email,password) VALUES (?, ?, ?, ?)');
        $newUser = $query->execute(
            [
                $_POST['firstname'],
                $_POST['lastname'],
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
?>
<main>
     <section id="account-content">
          <div class="container text-center">
               <img src="assets/image/logo.png" alt="">
               <form action="index.php?page=account" method="POST" id="account-form">

                    <input type="text" class="account-input" id="fname" name="firstname" placeholder="Nom">

                    <input type="text" id="lname" class="account-input" name="lastname"
                           placeholder="Nom de l'entreprise">
                   <?php if (isset($registerMessage)): ?>
                        <div class="text-danger"><?php echo $registerMessage; ?></div>
                   <?php endif; ?>

                    <input type="text" id="email" class="account-input" name="email" placeholder="E-mail">

                        <input type="password" id="password" class="account-input" name="password"
                               placeholder="Mot de Passe">

                        <input type="password" id="confirm-password" class="account-input" name="password_confirm"
                               placeholder="Confirmation de mot de passe">
                   <?php if (isset($passwordMessage)): ?>
                        <div class="text-danger"><?php echo $passwordMessage; ?></div>
                   <?php endif; ?>
                      <p>J'accepte les Condition d'utilisation</p>

                    <button type="submit" class="info-btn-one mt-3"  name="register">Démarrer</button>
               </form>
          </div>
     </section>
</main>