<?php
if (isset($_POST['register'])) {
    $query = $db->prepare('SELECT email FROM user WHERE email = ?');
    $query->execute(array($_POST['email']));
    $userAlreadyExists = $query->fetch();
    $password = $_POST['password'];
    if ($userAlreadyExists) {
        $registerMessage = "Adresse email déjà enregistrée";
    } elseif (empty($_POST['firstname']) OR empty($_POST['password']) OR empty($_POST['email'])) {
        $registerMessage = "Merci de remplir tous les champs obligatoires(*)";
    } elseif ($_POST['password'] != $_POST['password_confirm']) {
        $passwordMessage = "Les mots de passe ne sont pas identiques";
    } elseif (strlen($password) < 8 && !preg_match('#^(?=.*[a-z])(?=.*[0-9])#', $password)) {
        $passwordMessage = "Le mot de passe doit contenir au moins 8 caractères et être composé de lettres et de chiffres.";
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
?>
<main>
     <section id="account-content">

          <img src="assets/image/logo.png" class="account-image" alt="">
          <form action="index.php?page=account" method="POST" id="account-form">

               <input type="text" class="account-input" id="fname" name="firstname" placeholder="Nom">

              <?php if (isset($registerMessage)): ?>
                   <div class="text-danger"><?php echo $registerMessage; ?></div>
              <?php endif; ?>
               <input type="text" id="email"
                      class="<?php if (isset($registerMessage)): ?> border border-danger<?php endif; ?> account-input"
                      name="email" placeholder="E-mail">


                    <input type="password" id="password"
                           class="<?php if (isset($passwordMessage)): ?>border border-danger<?php endif; ?> account-input"
                           name="password"
                           placeholder="Mot de Passe">

               <input type="password" id="confirm-password"
                      class="<?php if (isset($passwordMessage)): ?>border border-danger<?php endif; ?> account-input"
                      name="password_confirm"
                      placeholder="Confirmation de mot de passe">

              <?php if (isset($passwordMessage)): ?>
                   <div class="text-danger"><?php echo $passwordMessage; ?></div>
              <?php endif; ?>

               <div class="row">
                    <div class="col-lg-9 condition-private">
                         <div class="d-flex align-items-center">
                              <label for="">
                                   <input type="checkbox" checked="checked">
                              </label>
                              <span class="checkmark"></span>

                              <label class="account-condition-label ml-3">* J'accepte les <a href=""><span
                                                class="account-condition-link"> Conditions générales </span></a>et la
                                   Politique de protection de la vie privée, incluant chacun les détails de leur
                                   consentement.
                              </label>
                         </div>
                    </div>
                    <div class="col-lg-3">
                    </div>
               </div>
               <div class="container">
                    <div class="row">
                         <div class="col-lg-8 text-center">
                         </div>
                         <div class="col-lg-4 ">
                              <a href="index.php?page=login" class="account-other-link">
                                   J'ai déjà un compte
                              </a>
                         </div>
                    </div>
               </div>
               <button type="submit" class="info-btn-one mt-3" name="register">Démarrer</button>
          </form>
     </section>
</main>
