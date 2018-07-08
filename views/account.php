<?php
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
?>
<main>
     <section id="account-content">
          <img src="assets/image/logo.png" class="account-image" alt="">
          <form action="index.php?page=account" method="POST" id="account-form">
               <input type="text"
                      class="<?php if (isset($registerEmpty)): ?>border border-danger<?php endif; ?> account-input"
                      id="fname" name="firstname" placeholder="Nom">
               <input type="email" id="email"
                      class="<?php if (isset($registerMessage) || ($registerEmpty)): ?>border border-danger<?php endif; ?> account-input"
                      name="email" placeholder="E-mail">
              <?php if (isset($registerEmpty)): ?>
                   <div class="text-danger"><?= $registerEmpty; ?></div>
              <?php endif; ?>
              <?php if (isset($registerMessage)): ?>
                   <div class="text-danger"><?= $registerMessage; ?></div>
              <?php endif; ?>

               <input type="password" id="password"
                      class="<?php if (isset($passwordMessage) || ($registerEmpty)): ?>border border-danger<?php endif; ?> account-input"
                      name="password"
                      placeholder="Mot de Passe">
              <?php if (isset($passwordMessage)): ?>
                   <div class="text-danger"><?= $passwordMessage; ?></div>
              <?php endif; ?>


               <input type="password" id="confirm-password"
                      class="<?php if (isset($passwordMessage)): ?>border border-danger<?php endif; ?> account-input"
                      name="password_confirm"
                      placeholder="Confirmation de mot de passe">

               <div class="row ">
                    <label for="">
                         <input type="checkbox">
                    </label>
                    <span class="checkmark"></span>
                    &nbsp;* J'accepte les &nbsp; <a href=""><span class="account-condition-link">Conditions générales</span></a>&nbsp; et
                    la<a href=""><span class="account-condition-link"> &nbsp; Politique de protection.</span></a>
               </div>

               <div class="container">
                    <div class="row">
                         <div class="col-lg-8 text-center">
                         </div>
                         <div class="col-lg-4">
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
