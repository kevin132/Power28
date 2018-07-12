<section id="payment">
     <div class="row">
          <div class="col-lg-6 w-100 pt-5 d-flex align-items-center justify-content-center flex-column">
               <h2>Tarif</h2>
               <h3>logiciel de gestion +</h3>

               <img src="assets/image/FileMaker.png"  class="w-50" alt="filemaker-image" >
          </div>
          <div class="col-lg-6">
               <div class="cell example example1">
                    <h3 class="ml-4">Paiement en carte bleue en tout sécurité par Stripe</h3>
                    <form method="post" action="index.php?page=payment" id="payment-form">
                         <fieldset>
                              <div class="row">
                                   <label for="example1-name" data-tid="elements_examples.form.name_label">Name</label>
                                   <input id="example1-name" data-tid="elements_examples.form.name_placeholder"
                                          type="text" name="name"
                                          placeholder="Jane Doe" required autocomplete="name" >
                              </div>
                              <div class="row">
                                   <label for="example1-email"
                                          data-tid="elements_examples.form.email_label">Email</label>
                                   <input id="example1-email" data-tid="elements_examples.form.email_placeholder"
                                          type="email" name="email"
                                          placeholder="janedoe@gmail.com" required autocomplete="email"
                                       class="card-cvc">
                              </div>
                              <div class="row">
                                   <label for="example1-phone"
                                          data-tid="elements_examples.form.phone_label">Phone</label>
                                   <input id="example1-phone" data-tid="elements_examples.form.phone_placeholder"
                                          type="tel"
                                          placeholder="+33 622772818" required autocomplete="tel"
                                           class="card-expiry">
                              </div>
                         </fieldset>
                         <fieldset>
                              <div class="row">nbvcx÷÷÷÷≠==:÷: w
                                   <div id="example1-card"></div>
                              </div>
                              <div id="card-errors" role="alert"></div>
                         </fieldset>
                         <button type="submit" data-tid="elements_examples.form.pay_button">Je valide</button>
                    </form>
               </div>
          </div>
     </div>
</section>

