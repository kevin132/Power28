<nav class="navbar navbar-light fixed-top">
     <div class="d-flex justify-content-between align-items-center w-100">
          <div class="one">
               <a class="navbar-brand" href="index.php?page=index">
                    <img src="assets/image/logo.png" class="logo" alt="">
               </a>
          </div>
          <div class="two mr-5">
               <ul class="nav">
                    <li class="nav-item">
                         <a class="nav-link" href="index.php?page=index">Accueil</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="index.php?page=features">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="index.php?page=prices">Tarif</a>
                    </li>

                    <li class="nav-item">
                         <a class="nav-link" href="index.php?page=faq">FAQ</a>
                    </li>
                    <li class="btn-group nav-item">
                         <button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                 aria-expanded="false">
                              A Propos
                         </button>
                         <div class="dropdown-menu">
                              <a class="dropdown-item" href="index.php?page=about">Notre équipe</a>
                              <a class="dropdown-item" href="#">Contact</a>

                         </div>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="index.php?page=forum">Forum</a>
                    </li>
               </ul>
          </div>
          <div class="three mr-4">
               <div class="row">
                    <div class="connect d-flex align-items-center">
                         <i class="fal fa-user-tie user-icon"></i>
                        <?php if (isset($_SESSION['user'])): ?>
                             <li class="btn-group nav-item ml-2">
                                  <button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                          aria-expanded="false">
                                      <?= $_SESSION['user']; ?>
                                  </button>
                                  <div class="dropdown-menu">
                                       <a class="dropdown-item" href="index.php?page=user-profile">Mon Compte</a>
                                       <a class="dropdown-item" href="index.php?logout">Déconnexion</a>
                                      <?php if ($_SESSION['is_admin'] == 1): ?>
                                           <a class="d-block btn btn-warning mb-4 mt-2" href="index.php?page=admin">Administration</a>
                                      <?php endif; ?>
                                  </div>
                             </li>
                        <?php else: ?>
                             <div class="nav-item">
                                  <a class="nav-link" href="index.php?page=login">Se connecter</a>
                             </div>
                        <?php endif; ?>
                    </div>
                    <a href="index.php?page=account">
                         <button class="info-btn-one mr-2">Créer un compte</button>
                    </a>
               </div>
          </div>
     </div>
</nav>
