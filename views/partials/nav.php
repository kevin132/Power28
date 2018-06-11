<?php
if(isset($_GET['logout']) && isset($_SESSION['user'])){

//la fonction unset() détruit une variable ou une partie de tableau. ici on détruit la session user
    unset($_SESSION["user"]);
//détruire $_SESSION["user"] va permettre l'affichage du bouton connexion / inscription de la nav, et permettre à nouveau l'accès aux formulaires de connexion / inscription
//détruire $_SESSION["is_admin"] va empêcher l'accès au back-office
    unset($_SESSION["is_admin"]);
    unset($_SESSION["user_id"]);
}

?>


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
                    <li class="btn-group nav-item">
                         <button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                 aria-expanded="false">
                              Logiciel
                         </button>
                         <div class="dropdown-menu">
                              <a class="dropdown-item" href="index.php?page=features">Fonctionnalités</a>
                              <a class="dropdown-item" href="#">Inventaires</a>
                              <a class="dropdown-item" href="#">Transactions</a>
                              <a class="dropdown-item" href="#">Catégories</a>
                              <a class="dropdown-item" href="#">Collaborateurs</a>
                         </div>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="index.php?page=prices">Tarif</a>
                    </li>

                    <li class="nav-item">
                         <a class="nav-link" href="#">FAQ</a>
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
                         <a class="nav-link" href="#">Forum</a>
                    </li>
               </ul>
          </div>
          <div class="three mr-4">
               <div class="row">
                    <div class="connect d-flex align-items-center">
                         <i class="fal fa-user-tie user-icon"></i>
                        <?php if(isset($_SESSION['user'])): ?>
                             <div class="nav-item">
                                  <a class="nav-link" href="#"> <?php echo $_SESSION['user']; ?> </a>
                             </div>
                         <!-- ici le boutton de déconnexion est un lien allant vers l'index qui envoie le paramètre "logout" via URL -->
                         <p>
                              <a class="d-block btn btn-danger mb-4 mt-2" href="index.php?logout">Déconnexion</a>
                         </p>
                        <?php else: ?>
                         <div class="nav-item">
                              <a class="nav-link" href="#">Se connecter</a>
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
