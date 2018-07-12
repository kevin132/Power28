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


               <div class="condition">
                    <div class="row ">
                         <div class="col-lg-6">
                              <input type="checkbox">

                              <span class="checkmark"></span>
                              &nbsp;* J'accepte les &nbsp; <a href=""><span
                                           class="account-condition-link">Conditions générales</span></a>&nbsp; et
                              la<a href=""><span class="account-condition-link"> &nbsp; Politique de protection.</span></a>
                         </div>
                         <div class="col-lg-6">
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
