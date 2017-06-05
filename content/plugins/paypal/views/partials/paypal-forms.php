<?php if( ! empty($plugin_data->paypal_merchant_id)) : ?>
    <div class="col-md-3 col-md-offset-2" id="paypal-con">
        <div>
            Or Pay With:<br>
            <img src="/content/plugins/paypal/assets/img/pp-logo.png" alt=""><br>
            <script async="async" src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=<?= $plugin_data->paypal_merchant_id ?>"
                    data-button="subscribe"
                    data-name="HelloVideo"
                    data-quantity="1"
                    data-amount="<?= $plugin_data->monthly_price ?>"
                    data-currency="USD"
                    data-shipping="0"
                    data-tax="0"
                    data-callback="<?= URL::to('ipn') ?>"
                    data-return="<?= URL::to('/') ?>"
                    data-cancel="<?= URL::to('/') ?>"
                    data-text="Monthly"
                    data-size="small"
                    data-recurrence="1"
                    data-period="M"
                <?php if( ! $payment_settings->live_mode) : ?>
                    data-env="sandbox"
                <?php endif ?>
                <?php if(Auth::check()): ?>
                    data-custom="<?= Auth::id() ?>"
                <?php endif ?>
                ></script>

            <script async="async" src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=<?= $plugin_data->paypal_merchant_id ?>"
                    data-button="subscribe"
                    data-name="HelloVideo"
                    data-quantity="1"
                    data-amount="<?= $plugin_data->yearly_price ?>"
                    data-currency="USD"
                    data-shipping="0"
                    data-tax="0"
                    data-callback="<?= URL::to('ipn') ?>"
                    data-return="<?= URL::to('/') ?>"
                    data-cancel="<?= URL::to('/') ?>"
                    data-text="Yearly"
                    data-size="small"
                    data-recurrence="1"
                    data-period="Y"
                <?php if( ! $payment_settings->live_mode) : ?>
                    data-env="sandbox"
                <?php endif ?>
                <?php if(Auth::check()): ?>
                    data-custom="<?= Auth::id() ?>"
                <?php endif ?>
                ></script>
        </div>
    </div>
<?php endif; ?>