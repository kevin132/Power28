<?php
if (!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0) {
    header('location:index.php?page=index.php');
    exit;
}
require_once 'views/admin/partials/nav.php'
?>
<section id="admin">
     <h2 class="text-center mb-4">Administration du site </h2>
     <div class="row">

          <div class="col-lg-4 d-flex align-items-center justify-content-center">
               <a href="">
                    <div class="admin-categorie"><h3 class="text-center">Gestion <br> d'Utilisateurs</h3></div>
               </a>
          </div>
          <div class="col-lg-4 d-flex align-items-center justify-content-center">
               <a href="index.php?page=faq-list">
                    <div class="admin-categorie"><h3 class="text-center">Gestion <br> FAQ</h3></div>
               </a>
          </div>
          <div class="col-lg-4 d-flex align-items-center justify-content-center">
               <a href="">
                    <div class="admin-categorie"><h3 class="text-center">Gestion <br>de Forum</h3></div>
               </a>
          </div>
     </div>
</section>