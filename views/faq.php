<section id="faq">
     <h2 class="text-center p-5">Foire aux questions</h2>

     <div class="container">

         <?php

         $query = $db->query('SELECT * FROM categories');

         while ($categories = $query->fetch()):?>

              <?php $query = $db->query('SELECT * FROM faq'); ?>

              <?php while ($questions = $query->fetch())  : ?>

                 <?php if( $categories['id'] == $questions['id']) ?>

               <div class="card">
                    <h2 class="ml-5"> <?php  echo $categories['title'] ?></h2>
                    <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                      aria-expanded="true" aria-controls="collapseOne">
                                  <?php echo $questions['questions'] ?>
                              </button>
                         </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordion">
                         <div class="card-body">
                             <?php echo $questions['answers'] ?>
                         </div>
                    </div>
               </div>
              <?php endwhile; ?>

          <?php endwhile; ?>
          </div>
</section>