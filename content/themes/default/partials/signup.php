<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<!-- <div class="sign-up-fullpage" id="signup-form2">
<div class="overlay"></div>


</div> -->








<div class="row" id="signup-form" id="demo" class="collapse">

  <form method="POST" action="<?= ($settings->enable_https) ? secure_url('signup') : URL::to('signup') ?>" class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1" id="payment-form">
    <p class="main-circle">
  <!-- <span class="one-circle"><img src="<?= THEME_URL ?>/assets/img/icon_upload.png"></span> -->
  <span class="two-circle"><img src="<?= THEME_URL ?>/assets/img/img-1avtar.png"></span>
  <!-- <span class="three-circle"><img src="<?= THEME_URL ?>/assets/img/icon_upload-pown.png"></span> -->

</p>

    <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>">
      
      <div class="panel panel-default registration">
        
        <!--div class="panel-heading">
          
          <div class="row">

              <?php if(!$settings->free_registration): ?>
                <h1 class="panel-title col-lg-7 col-md-8 col-sm-6"><?= ThemeHelper::getThemeSetting(@$theme_settings->signup_message, 'Signup to Gain access to all content on the site for $7 a month.') ?></h1>
                <div class="cc-icons col-lg-5 col-md-4">
                    <img src="<?= THEME_URL ?>/assets/img/credit-cards.png" alt="All Credit Cards Supported" />
                </div>
              <?php else: ?>
                <h1 class="panel-title col-lg-12 col-md-12">Enter your info below to signup for an account.</h1>
              <?php endif; ?>

          </div>

        </div> .panel-heading -->

        <div class="panel-body">
                                                                  
          <fieldset>
           
            <!-- Text input-->
            <div class="form-group row">
               <!--  <label class="col-md-4 control-label" for="username"></label> -->
 <?php $username_error = $errors->first('username'); ?>
            <?php if (!empty($errors) && !empty($username_error)): ?>
                <div class="alert alert-danger"><?= $errors->first('username'); ?></div>
            <?php endif; ?>
                <div class="paymeny-field">
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= old('username'); ?>" />
                </div>
            </div>


           
            <!-- Text input-->
            <div class="form-group row">
               <!--  <label class="col-md-4 control-label" for="email"></label> -->
 <?php $email_error = $errors->first('email'); ?>
            <?php if (!empty($errors) && !empty($email_error)): ?>
                <div class="alert alert-danger"><?= $errors->first('email'); ?></div>
            <?php endif; ?>
                <div class="paymeny-field">
                    <input type="text" class="form-control" id="email" placeholder="Email Address" name="email" value="<?= old('email'); ?>">
                </div>
            </div>

           
            <!-- Text input-->
            <div class="form-group row">
             <!--    <label class="col-md-4 control-label" for="password"></label> -->
 <?php $password_error = $errors->first('password'); ?>
            <?php if (!empty($errors) && !empty($password_error)): ?>
                <div class="alert alert-danger"><?= $errors->first('password'); ?></div>
            <?php endif; ?>
                <div class="paymeny-field">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                </div>
            </div>

           
            <!-- Text input-->
            <div class="form-group row">
               <!--  <label class="col-md-4 control-label" for="password_confirmation"></label> -->
 <?php $confirm_password_error = $errors->first('password_confirmation'); ?>
            <?php if (!empty($errors) && !empty($confirm_password_error)): ?>
                <div class="alert alert-danger"><?= $errors->first('password_confirmation'); ?></div>
            <?php endif; ?>
                <div class="paymeny-field">
                    <input type="password" placeholder="Confirm Password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            <div class="form-group row">
              <div class="checkbox">
     <label><input id="chkterms" type="checkbox" value="">I agree to the  <a href="<?=url()?>/page/terms"><u>terms and conditions</u></a></label>
    </div>
            </div>

            <?php if(!$settings->free_registration): ?>

              <hr />

              <div class="payment-errors alert alert-danger"></div>

              <!-- Credit Card Number -->
              <div class="form-group row">
                  <label class="col-md-4 control-label">Credit Card Number</label>

                  <div class="paymeny-field">
                      <input type="text" id="cc-number" class="form-control input-md cc-number" data-stripe="number" required="">
                  </div>
              </div>


              <!-- Expiration Date -->
              <div class="form-group row">
                  <label class="col-md-4 control-label" for="cc-expiration-month">Expiration Date</label>

                  <div class="col-md-3">
                      <select class="form-control cc-expiration-month" data-stripe="exp-month" id="cc-expiration-month"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>        </div>
                  <div class="col-md-2">
                      <select class="form-control cc-expiration-year" data-stripe="exp-year" id="cc-expiration-year"><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option></select>        </div>
              </div>


              <!-- CVV Number -->
              <div class="form-group row">
                  <label class="col-md-4 control-label" for="cvv">CVV Number</label>

                  <div class="col-md-3">
                      <input id="cvv" type="text" placeholder="" class="form-control input-md cvc" data-stripe="cvc" required="">
                  </div>
              </div>

            <?php endif; ?>
            
        </fieldset>


        
        

        
      </div><!-- .panel-body -->

      <div class="panel-footer clearfix">
        <div class="pull-left col-md-3 terms" style="padding-left: 0;"></div>
      
          <div class="sign-up-buttons">
            <button class="btn btn-primary" type="submit" name="create-account">Sign Up Today</button>
            <a href="<?=url()?>/login" class="btn">Or Log In</a>
          </div>

  
      </div><!-- .panel-footer -->

    </div><!-- .panel -->

    <?php if($settings->demo_mode == 1 && !$settings->free_registration): ?>
      <div class="alert alert-info demo-info" role="alert">
        <p class="title">Demo Credit Card Info</p>
        <p><strong>Credit Card Number:</strong> <span>4242 4242 4242 4242</span></p>
        <p><strong>Expiration Date:</strong> <span>January 2020</span></p>
        <p><strong>CVV Code:</strong> <span>123</span></p>
      </div>
    <?php endif; ?>
  
  </form>


</div><!-- #signup-form -->


<?php if(!$settings->free_registration): ?>
  
  <script type="text/javascript" src="<?= THEME_URL ?>/assets/js/jquery.payment.js"></script>
  <script type="text/javascript">

    // This identifies your website in the createToken call below
    <?php if($payment_settings->live_mode): ?>
      Stripe.setPublishableKey('<?= $payment_settings->live_publishable_key; ?>');
    <?php else: ?>
      Stripe.setPublishableKey('<?= $payment_settings->test_publishable_key; ?>');
    <?php endif; ?>

    var stripeResponseHandler = function(status, response) {
        var $form = $('#payment-form');

        if (response.error) {
          // Show the errors on the form
          $form.find('.payment-errors').text(response.error.message);
          $form.find('button').prop('disabled', false);
          $('.payment-errors').fadeIn();
        } else {
          // token contains id, last4, and card type
          var token = response.id;
          // Insert the token into the form so it gets submitted to the server
          $form.append($('<input type="hidden" name="stripeToken" />').val(token));
          // and re-submit
          $form.get(0).submit();
        }
      };

      jQuery(function($) {
        $('#payment-form').submit(function(e) {

          $('.payment-errors').fadeOut();

          var $form = $(this);

          // Disable the submit button to prevent repeated clicks
          $form.find('button').prop('disabled', true);

          Stripe.card.createToken($form, stripeResponseHandler);

          // Prevent the form from submitting with the default action
          return false;
        });
        $('#cc-number').payment('formatCardNumber');

      });

  </script>

<?php endif; ?>


<script type="text/javascript">
        $(function() {
            $('.sign-up-buttons button').click(function(event) {
                if ($('#chkterms').is(':checked')) {
                    //toastr.error('you agreed conditions')
                }
                else {

                    toastr.error('please check terms & conditions');
                    event.preventDefault();
                }
            })
        })
    </script>