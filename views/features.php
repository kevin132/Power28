<main>
     <section class="feat-background d-flex justify-content-center align-items-center flex-column ">
          <h2 class="feat-background-title">Fonctionnalités</h2>
          <p class="feat-background-subtitle">Logiciel pensé pour le confort d'utilisation </p>
     </section>
     <section class="feat-pres">

          <div class="container">
               <h2 class="text-center">Découvrez la pleine puissance du logiciel</h2>
               <hr id="feat-line">
               <div class="row">
                    <div class="col-lg-3">
                         <div class="feat-pres-icon-one">

                              <div class="feat-pres-circle d-flex align-items-center justify-content-center">
                                   1
                              </div>
                              <a href="#" class="feat-pres-link d-flex align-items-center justify-content-center ">
                                   <img src="assets/image/inventory.png" alt="" class="pres-icon">
                                   <p>Réalisez un inventaire complet</p>
                              </a>
                         </div>
                    </div>

                    <div class="col-lg-3">
                         <div class="feat-pres-icon-two">
                              <div class="feat-pres-circle d-flex align-items-center justify-content-center">2</div>
                              <a href="#" class="feat-pres-link d-flex align-items-center justify-content-center">
                                   <img src="assets/image/transaction.png" alt="" class="pres-icon">
                                   <p>Effectuez les transactions</p>
                              </a>
                         </div>
                    </div>
                    <div class="col-lg-3">
                         <div class="feat-pres-icon-three">
                              <div class="feat-pres-circle d-flex align-items-center justify-content-center">3</div>
                              <a href="#" class="feat-pres-link d-flex align-items-center justify-content-center">
                                   <img src="assets/image/folder.png" alt="" class="pres-icon">
                                   <p>Triez par catégories</p>
                              </a>
                         </div>

                    </div>
                    <div class="col-lg-3">
                         <div class="feat-pres-icon-four">
                              <div class="feat-pres-circle d-flex align-items-center justify-content-center">4</div>
                              <a href="#" class="feat-pres-link d-flex align-items-center justify-content-center">
                                   <img src="assets/image/group.png" alt="" class="pres-icon">
                                   <p>Gérez les nouveaux collaborateurs</p>
                              </a>
                         </div>

                    </div>
               </div>
          </div>

     </section>

     <section class="feat-functionality">
          <div class="container">

               <ul class="row  no-gutters d-flex align-items-center justify-content-center p-3">

                    <li class="feat-functionality-list">
                         <a href="" class="feat-functionality-device">Oridinateur</a>
                    </li>

                    <li class="feat-functionality-list">
                         <a href="" class="feat-functionality-device">Ipad</a>
                    </li>

                    <li class="feat-functionality-list">
                         <a href="" class="feat-functionality-device">Iphone</a>
                    </li>

               </ul>
          </div>

          <div class="row no-gutters">
               <div class="col-lg-6">
                    <div class="feat-mac text-center">
                         <img src="assets/img/article/Power28-catalogue-0.png" id="imgclick" class="feat-features ml-3"
                              alt="">
                    </div>
               </div>
               <div class="col-lg-6">

                    <div class="accordion ml-5 w-75">
                        <?php
                        $query = $db->prepare('SELECT * FROM screen');
                        $query->execute();
                        ?>
                        <?php
                        while ($data = $query->fetch()):?>
                             <div class="card">
                                  <div class="card-header" id="heading<?= $data['id'] ?>">
                                       <h5 class="mb-0">
                                            <button class="btn btn-link collapsed"
                                                    data-img-id="<?= $data['id'] ?>"
                                                    data-toggle="collapse"
                                                    data-target="#collapse<?= $data['id'] ?>"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                 <i class="fas fa-plus"></i></button>
                                       </h5>
                                  </div>
                                  <div id="collapse<?php echo $data['id'] ?>" class="collapse"
                                       aria-labelledby="heading<?php echo $data['id'] ?>" data-parent="#accordion">
                                       <div class="card-body">
                                           <?php echo '<p>' . $data['content'] . '</p>'; ?>
                                       </div>
                                  </div>
                             </div>
                        <?php endwhile ?>
                        <?php $query->closeCursor(); ?>
                    </div>
               </div>
          </div>
          <div class="feat-elevator"><i class="fas fa-arrow-up feat-elevator-arrow"></i></div>
     </section>
</main>


