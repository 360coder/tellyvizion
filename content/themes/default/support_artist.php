<?php include('includes/header.php'); ?>
<h2 class="form-signin-heading"><i class="fa fa-credit-card"></i>Become a Subscriber</h2>

<div style="margin-top:0px;">

<form method="POST" action="<?= ($settings->enable_https) ? secure_url('user') : URL::to('user') ?>/<?= $user->username ?>/paynow" class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1" id="payment-form">
    
    <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>">
      
      <div class="panel panel-default registration">
        
        <div class="panel-heading">
          
          <div class="row">
                  
              <h1 class="panel-title col-lg-8 col-md-9 col-sm-6">You are Paying : $<?=$amount?> </h1>
              <input type="hidden" value="<?=$amount?>" name="amount">
              <input type="hidden" value="<?=$video_id?>" name="video_id">

              <div class="cc-icons col-lg-4 col-md-3">
                  <img src="<?= THEME_URL ?>/assets/img/credit-cards.png" alt="All Credit Cards Supported" />
              </div>

          </div>

        </div><!-- .panel-heading -->

        <div class="panel-body">

            <!-- Credit Card Number -->
            <div class="form-group row">
                <label class="col-md-4 control-label">Credit Card Number</label>

                <div class="col-md-8">
                    <input type="text" id="cc-number" name="cc-number" class="form-control input-md cc-number" data-stripe="number" required="">
                </div>
            </div>


            <!-- Expiration Date -->
            <div class="form-group row">
                <label class="col-md-4 control-label" for="cc-expiration-month">Expiration Date</label>

                <div class="col-md-3">
                    <select class="form-control cc-expiration-month" name="cc-expiration-month" data-stripe="exp-month" id="cc-expiration-month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    </select>
                </div>
                <div class="col-md-2">
                  <select class="form-control cc-expiration-year" name="cc-expiration-year" data-stripe="exp-year" id="cc-expiration-year">
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                  </select>
                </div>
            </div>


            <!-- CVV Number -->
            <div class="form-group row">
                <label class="col-md-4 control-label" for="cvv">CVV Number</label>

                <div class="col-md-3">
                    <input id="cvv" name="cvv" type="text" placeholder="" class="form-control input-md cvc" data-stripe="cvc" required="">
                </div>
            </div>

            
        </fieldset>
      </div><!-- .panel-body -->

      <div class="panel-footer clearfix">
        <div class="pull-left col-md-7 terms" style="padding-left: 0;"></div>
      
          <div class="pull-right sign-up-buttons">
          	<a href="<?= ($settings->enable_https) ? secure_url('user') : URL::to('user') ?>/<?= $user->username ?>" class="btn">Cancel</a>
            <button class="btn btn-primary" type="submit" name="create-account">Pay Now</button>
            
          </div>

          <div class="payment-errors col-md-8 text-danger" style="display:none"></div>
  
      </div><!-- .panel-footer -->

    </div><!-- .panel -->
  
  </form>
</div>
<?php include('includes/footer.php'); ?>