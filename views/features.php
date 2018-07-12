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
                              <a href="#" class="feat-pres-link ">
                                   <img src="assets/image/inventory.png" alt="" class="pres-icon">
                                   <p>Réalisez un inventaire complet</p>
                              </a>
                         </div>
                    </div>
                    <div class="col-lg-3">
                         <div class="feat-pres-icon-two">
                              <div class="feat-pres-circle d-flex align-items-center justify-content-center">2</div>
                              <a href="#" class="feat-pres-link ">
                                   <img src="assets/image/transaction.png" alt="" class="pres-icon">
                                   <p>Effectuez les transactions</p>
                              </a>
                         </div>
                    </div>
                    <div class="col-lg-3">
                         <div class="feat-pres-icon-three">
                              <div class="feat-pres-circle d-flex align-items-center justify-content-center">3</div>
                              <a href="#" class="feat-pres-link ">
                                   <img src="assets/image/folder.png" alt="" class="pres-icon">
                                   <p>Triez par catégories</p>
                              </a>
                         </div>

                    </div>
                    <div class="col-lg-3">
                         <div class="feat-pres-icon-four">
                              <div class="feat-pres-circle d-flex align-items-center justify-content-center">4</div>
                              <a href="#" class="feat-pres-link ">
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
               <ul class=" nav nav-pills mb-3 row  no-gutters d-flex align-items-center justify-content-center p-3" id="pills-tab" role="tablist">

                    <li class="feat-functionality-list">
                         <a class="nav-link active feat-functionality-device" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ordinateur</a>
                    </li>

                    <li class="feat-functionality-list">
                         <a class="nav-link feat-functionality-device" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ipad</a><li>

               </ul>
          </div>


          <div class="tab-content" id="pills-tabContent">
               <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

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
                                  foreach ($imgFeatures as $f):?>
                                       <div class="card">
                                            <div class="card-header" id="heading<?= $f['id'] ?>">
                                                 <h5 class="mb-0">
                                                      <button class="btn btn-link collapsed"
                                                              data-img-id="<?= $f['id'] ?>"
                                                              data-toggle="collapse"
                                                              data-target="#collapse<?= $f['id'] ?>"
                                                              aria-expanded="false" aria-controls="collapseTwo">
                                                           <i class="fas fa-plus"></i></button>
                                                 </h5>
                                            </div>
                                            <div id="collapse<?php echo $f['id'] ?>" class="collapse"
                                                 aria-labelledby="heading<?php echo $f['id'] ?>" data-parent="#accordion">
                                                 <div class="card-body">
                                                     <?php echo '<p>'. $f['content'] . '</p>'; ?>
                                                 </div>
                                            </div>
                                       </div>
                                  <?php endforeach; ?>
                              </div>
                         </div>
                    </div></div>
               <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                    <div class="row no-gutters">
                         <div class="col-lg-6">
                              <div class="feat-ipad text-center">
                                   <img src="assets/img/article/Power28-catalogue-0.png" id="imgclick" class="feat-features ml-3"
                                        alt="">
                              </div>
                         </div>
                         <div class="col-lg-6">

                              <div class="accordion ml-5 w-75">
                                  <?php
                                  foreach ($imgFeatures as $f):?>
                                       <div class="card">
                                            <div class="card-header" id="heading<?= $f['id'] ?>">
                                                 <h5 class="mb-0">
                                                      <button class="btn btn-link collapsed"
                                                              data-img-id="<?= $f['id'] ?>"
                                                              data-toggle="collapse"
                                                              data-target="#collapse<?= $f['id'] ?>"
                                                              aria-expanded="false" aria-controls="collapseTwo">
                                                           <i class="fas fa-plus"></i></button>
                                                 </h5>
                                            </div>
                                            <div id="collapse<?php echo $f['id'] ?>" class="collapse"
                                                 aria-labelledby="heading<?php echo $f['id'] ?>" data-parent="#accordion">
                                                 <div class="card-body">
                                                     <?php echo '<p>'. $f['content'] . '</p>'; ?>
                                                 </div>
                                            </div>
                                       </div>
                                  <?php endforeach; ?>
                              </div>
                         </div>
                    </div>
               </div>

          </div>
          <div class="feat-elevator"><i class="fas fa-arrow-up feat-elevator-arrow"></i></div>
     </section>
</main>


