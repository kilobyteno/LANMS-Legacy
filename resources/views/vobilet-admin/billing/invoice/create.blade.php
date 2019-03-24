@extends('layouts.main')
@section('title', 'Create Invoice - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Create Invoice</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
        <li class="breadcrumb-item">{{ trans('user.account.billing.invoice.title') }}</li>
		<li class="breadcrumb-item active" aria-current="page">Create Invoice</li>
	</ol>
</div>


<form class="row" method="post" action="{{ route('admin-billing-invoice-store') }}">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-body">
				<div class="row ">
					<div class="col-lg-6">
						<img src="@if(Sentinel::check())@if(Sentinel::getUser()->theme=='dark'){{ Setting::get('WEB_LOGO') }}@else{{ Setting::get('WEB_LOGO_ALT') }}@endif @else {{ Setting::get('WEB_LOGO_ALT') }}@endif" class="header-brand-img d-print-none" alt="{{ Setting::get('WEB_NAME') }}">
						<img src="{{ Setting::get('WEB_LOGO_ALT') }}" class="d-none d-print-inline" style="width:auto;height:auto;max-width:700px;max-height:75px;">
						<address class="mt-2">
							{{ \Setting::get('WEB_NAME') }}<br>
							{{ LANMS\Info::getContent('address_street') }}<br>
							{{ LANMS\Info::getContent('address_postal_code') }}, {{ LANMS\Info::getContent('address_city') }}<br>
							{{ LANMS\Info::getContent('address_county') }}, {{ LANMS\Info::getContent('address_country') }}<br>
							{{ \Setting::get('MAIL_MAIN_EMAIL') }}
						</address>
					</div>
				</div>
				
				<div>
					<p class="mb-1 mt-5 mb-5"><span class="font-weight-semibold">{{ trans('user.account.billing.invoice.title') }} {{ trans('global.date') }}:</span> {{ ucfirst(\Carbon::now()->isoFormat('LLLL')) }}</p>
					<p class="mb-2">
						<button type="button" id="add_row" class="btn btn-outline-success d-inline">Add Row</button>
						<button type="button" id="delete_row" class="btn btn-outline-danger d-inline">Delete Row</button>
					</p>
				</div>
				<div class="table-responsive push">
					<table class="table table-bordered table-hover" id="tab_logic">
						<tbody>
							<tr class="">
								<th class="text-center" style="width: 5%">#</th>
								<th>{{ trans('user.account.billing.invoice.product') }}</th>
								<th class="text-center" style="width: 10%">{{ trans('user.account.billing.invoice.quantity') }}</th>
								<th class="text-right" style="width: 15%">{{ trans('user.account.billing.invoice.unitprice') }}</th>
								<th class="text-right" style="width: 20%">{{ trans('user.account.billing.invoice.amount') }}</th>
							</tr>

							<tr id="addr0">
								<td class="text-center">1</td>
								<td><input type="text" name="description[]" placeholder="Description" class="form-control" required="required" /></td>
								<td><input type="number" name="qty[]" placeholder="Qty" class="form-control qty" min="1" required="required" /></td>
								<td><input type="number" name="price[]" placeholder="Unit Price" class="form-control price" min="0.01" step="0.01" required="required"/></td>
								<td>
									<div class="input-group mb-2 mb-sm-0">
										<input type="text" name="total[]" placeholder="0" class="form-control total" readonly />
										<div class="input-group-append">
						                	<span class="input-group-text">{{ \Setting::get('SEATING_SEAT_PRICE_CURRENCY') }}</span>
						                </div>
						            </div>
								</td>
							</tr>
							<tr id="addr1"></tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.subtotal') }}</td>
								<td class="text-right">
									<div class="input-group mb-2 mb-sm-0">
										<input type="text" name="sub_total" placeholder="0.00" class="form-control" id="sub_total" readonly />
										<div class="input-group-append">
						                	<span class="input-group-text">{{ \Setting::get('SEATING_SEAT_PRICE_CURRENCY') }}</span>
						                </div>
						            </div>
								</td>
							</tr>
							<tr>
								<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.taxrate') }}</td>
								<td class="text-right">
									<div class="input-group mb-2 mb-sm-0">
						                <input type="number" class="form-control" name="tax_percent" id="tax" placeholder="0" min="0" max="100" value="0">
						                <div class="input-group-append">
						                	<span class="input-group-text">%</span>
						                </div>
						            </div>
						       	</td>
							</tr>
							<tr>
								<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.taxdue') }}</td>
								<td class="text-right">
									<div class="input-group mb-2 mb-sm-0">
										<input type="text" name="tax_amount" id="tax_amount" placeholder="0.00" class="form-control" readonly />
										<div class="input-group-append">
						                	<span class="input-group-text">{{ \Setting::get('SEATING_SEAT_PRICE_CURRENCY') }}</span>
						                </div>
						            </div>
								</td>
							</tr>
							<tr>
								<td colspan="4" class="font-weight-bold text-uppercase text-right">{{ trans('user.account.billing.invoice.totaldue') }}</td>
								<td class="font-weight-bold text-right">
									<div class="input-group mb-2 mb-sm-0">
										<input type="text" name="total_amount" id="total_amount" placeholder="0.00" class="form-control" readonly />
										<div class="input-group-append">
						                	<span class="input-group-text">{{ \Setting::get('SEATING_SEAT_PRICE_CURRENCY') }}</span>
						                </div>
						            </div>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<p class="text-muted text-center">
					<label>Footer:</label>
					<textarea name="footer" class="form-control" placeholder="Add a memo here for the user to read."></textarea>
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-label">{{ trans('user.account.billing.invoice.invoiceto') }}:</label>
					<select name="user_id" class="select2">
						<option value="">--- Please Select ---</option>
						@foreach(\User::orderBy('lastname', 'asc')->where('last_activity', '<>', '')->where('isAnonymized', '0')->get() as $user)
							<option value="{{ $user->id }}">{{ User::getFullnameAndNicknameByID($user->id) }}</option>
						@endforeach
					</select>
					@if($errors->has('user_id'))
						<p class="text-danger">{{ $errors->first('user_id') }}</p>
					@endif
				</div>
				<div class="form-group">
					<label class="form-label">Days until due:</label>
					<input type="number" class="form-control" name="days_until_due" min="14" max="60" value="30">
					@if($errors->has('days_until_due'))
						<p class="text-danger">{{ $errors->first('days_until_due') }}</p>
					@endif
				</div>
			</div>
			<div class="card-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>{{ trans('global.savechanges') }}</button>
			</div>
		</div>
	</div>
</form>
@stop
@section('javascript')
	<script type="text/javascript">
		$(function(){
			$('.select2').select2();
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
		    var i=1;
		    $("#add_row").click(function(){b=i-1;
		      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
		      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
		      	i++; 
		  	});
		    $("#delete_row").click(function(){
		    	if(i>1) {
					$("#addr"+(i-1)).html('');
					i--;
				}
				calc();
			});
			$('#tab_logic tbody').on('keyup change',function(){
				calc();
			});
			$('#tax').on('keyup change',function(){
				calc_total();
			});
		});
		function calc() {
			$('#tab_logic tbody tr').each(function(i, element) {
				var html = $(this).html();
				if(html!='')
				{
					var qty = $(this).find('.qty').val();
					var price = $(this).find('.price').val();
					$(this).find('.total').val(qty*price);
					
					calc_total();
				}
		    });
		}
		function calc_total() {
			total=0;
			$('.total').each(function() {
		        total += parseFloat($(this).val());
		    });
			$('#sub_total').val(total.toFixed(2));
			tax_sum=total/100*$('#tax').val();
			$('#tax_amount').val(tax_sum.toFixed(2));
			$('#total_amount').val((tax_sum+total).toFixed(2));
		}
	</script>
@stop