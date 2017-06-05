@extends('admin.master')

@section('content')

	

	<div class="admin-section-title">
		<h3><i class="fa fa-plug"></i> PayPal Subscriptions Plugin</h3>
	</div>

	<form method="POST" action="">

        <div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading">
                <div class="panel-title">PayPal Settings</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div>
            <div class="panel-body" style="display: block;">
                <p>Merchant Email or ID:</p>
                <input type="text" class="form-control" name="paypal_merchant_id" id="paypal_merchant_id" placeholder="Merchant Email or ID" value="@if(!empty($paypal_merchant_id) && Auth::user()->role != 'demo'){{ $paypal_merchant_id }}@endif" />

                <br />
                <p>Monthly Price:</p>
                <input type="text" class="form-control" name="monthly_price" id="monthly_price" placeholder="Monthly Price" value="@if(!empty($monthly_price) && Auth::user()->role != 'demo'){{ $monthly_price }}@endif" />

                <br />
                <p>Yearly Price:</p>
                <input type="text" class="form-control" name="yearly_price" id="yearly_price" placeholder="Yearly Price" value="@if(!empty($yearly_price) && Auth::user()->role != 'demo'){{ $yearly_price }}@endif" />
            </div>
        </div>
		
		<input type="submit" class="btn btn-success pull-right" value="Save Settings" />
		<div class="clear"></div>

	</form>


@stop