<section id="payment">
     <div class="row">
          <div class="col-lg-6">
               <div class="cell example example1">
                    <form method="post" action="index.php?page=payment" id="payment-form">
                         <fieldset>
                              <div class="row">
                                   <label for="example1-name" data-tid="elements_examples.form.name_label">Name</label>
                                   <input id="example1-name" data-tid="elements_examples.form.name_placeholder"
                                          type="text" name="name"
                                          placeholder="Jane Doe" required="" autocomplete="name" value="kevin" >
                              </div>
                              <div class="row">
                                   <label for="example1-email"
                                          data-tid="elements_examples.form.email_label">Email</label>
                                   <input id="example1-email" data-tid="elements_examples.form.email_placeholder"
                                          type="email" name="email"
                                          placeholder="janedoe@gmail.com" required="" autocomplete="email"
                                          value="emailjzjj@gmrlrlr.fr" class="card-cvc">
                              </div>
                              <div class="row">
                                   <label for="example1-phone"
                                          data-tid="elements_examples.form.phone_label">Phone</label>
                                   <input id="example1-phone" data-tid="elements_examples.form.phone_placeholder"
                                          type="tel"
                                          placeholder="(941) 555-0123" required="" autocomplete="tel"
                                          value="0283030303" class="card-expiry">
                              </div>
                         </fieldset>
                         <fieldset>
                              <div class="row">
                                   <div id="example1-card"></div>
                              </div>
                              <div id="card-errors" role="alert"></div>

                         </fieldset>
                         <button type="submit" data-tid="elements_examples.form.pay_button">Pay $25</button>
                    </form>
               </div>
          </div>
          <div class="col-lg-6"></div>
     </div>

</section>

