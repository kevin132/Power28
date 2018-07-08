<section id="faq">
     <h2 class="text-center p-5">Foire aux questions</h2>
     <div class="container">
         <?php foreach ($faqCategories as $c): ?>
              <h3><?= $c['title'] ?></h3>
              <div id="accordion">
                  <?php foreach ($faqContents as $q):
                      if ($q['id'] == $c['id_categories']): ?>
                           <div class="card">
                                <div class="card-header" id="heading<?= $q['id_collapse']; ?>">
                                     <h5 class="mb-0">
                                          <button class="btn btn-link collapsed" data-toggle="collapse"
                                                  data-target="#collapse<?= $q['id_collapse']; ?>"
                                                  aria-expanded="false" aria-controls="collapse<?= $q['id']; ?>">
                                              <?= $q['questions']; ?>
                                          </button>
                                     </h5>
                                </div>
                                <div id="collapse<?= $q['id_collapse']; ?>" class="collapse"
                                     aria-labelledby="heading<?= $q['id']; ?>"
                                     data-parent="#accordion">
                                     <div class="card-body">
                                         <?= $q['answers']; ?>
                                     </div>
                                </div>
                           </div>
                      <?php endif; ?>
                  <?php endforeach; ?>
              </div>
         <?php endforeach; ?>
     </div>
</section>