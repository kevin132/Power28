<?php
if (isset($_POST['login'])) {
    if (empty($_POST['email']) OR empty($_POST['password'])) {
        $loginMessage = "Merci de remplir tous les champs";
    } else {
        $query = $db->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
        $query->execute(array($_POST['email'], hash('md5', $_POST['password']),));
        $user = $query->fetch();
        if ($user) {
            $_SESSION['is_admin'] = $user['is_admin'];
            $_SESSION['user'] = $user['firstname'];
            $_SESSION['user_id'] = $user['id'];
        } else {
            $loginMessage = "Mauvais identifiants";
        }
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
          <form action="index.php?page=login" method="POST" id="account-form">
                    <input type="email" id="email"
                           class="<?php if (isset($loginMessage)): ?>border border-danger<?php endif; ?> account-input"
                           name="email" placeholder="E-mail">

                    <input type="password" id="password"
                           class="<?php if (isset($loginMessage)): ?>border border-danger<?php endif; ?> account-input"
                           name="password"
                           placeholder="Mot de Passe">
              <?php if (isset($loginMessage)): ?>
                   <div class="text-danger"><?= $loginMessage; ?></div>
              <?php endif; ?>
               <div class="container">
                    <div class="row">
                         <div class="col-lg-6 text-center">
                              <a href="index.php?page=forgot-password" class="account-other-link">
                                   Mot de passe oublié
                              </a>
                         </div>
                         <div class="col-lg-6 text-center">
                              <a href="index.php?page=account" class="account-other-link">
                                   Pas encore de compte ?
                              </a>
                         </div>
                    </div>
               </div>
               <button type="submit" class="info-btn-one mt-3" name="login">Connexion</button>
          </form>
     </section>
</main>
