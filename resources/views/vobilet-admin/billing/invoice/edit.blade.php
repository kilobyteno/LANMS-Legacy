@extends('layouts.main')
@section('title', 'Edit Invoice - Admin')
@section('content')

<div class="page-header">
	<h4 class="page-title">Edit Invoice</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
        <li class="breadcrumb-item">{{ trans('user.account.billing.title') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('admin-billing-invoice') }}">{{ trans('user.account.billing.invoice.title') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Invoice</li>
	</ol>
</div>

@if($invoice['status'] == 'draft' && $invoice['auto_advance'] == true)
	<div class="alert alert-info" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<i class="fas fa-info mr-2" aria-hidden="true"></i> {{ trans('user.account.billing.invoice.alert.scheduled', ['time' => \Carbon::parse($invoice['date'])->addHours(1)->diffForHumans()]) }}
	</div>
@endif

<form class="row" method="post" action="{{ route('admin-billing-invoice-update', $invoice['id']) }}">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header @if($invoice['status']=='draft') bg-info @elseif($invoice['status']=='paid') bg-success text-white @elseif($invoice['status']=='void' || $invoice['status']=='uncollectible') bg-danger text-white @elseif($invoice['status']=='open') bg-warning text-white @endif">
				<h3 class="card-title">{{ trans('global.status') }}: @if($invoice['status'] == 'draft' && $invoice['auto_advance'] == true){{ trans('user.account.billing.invoice.status.scheduled') }}@else{{ trans('user.account.billing.invoice.status.'.$invoice['status']) }}@endif</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
						<img src="@if(Sentinel::check())@if(Sentinel::getUser()->theme=='dark'){{ Setting::get('WEB_LOGO_LIGHT') }}@else{{ Setting::get('WEB_LOGO_DARK') }}@endif @else {{ Setting::get('WEB_LOGO_DARK') }}@endif" class="header-brand-img d-print-none" alt="{{ Setting::get('WEB_NAME') }}">
						<img src="{{ Setting::get('WEB_LOGO_DARK') }}" class="d-none d-print-inline" style="width:auto;height:auto;max-width:700px;max-height:75px;">
						<address class="mt-2">
							{{ \Setting::get('WEB_NAME') }}<br>
							{{ LANMS\Info::getContent('address_street') }}<br>
							{{ LANMS\Info::getContent('address_postal_code') }}, {{ LANMS\Info::getContent('address_city') }}<br>
							{{ LANMS\Info::getContent('address_county') }}, {{ LANMS\Info::getContent('address_country') }}<br>
							{{ env('MAIL_FROM_ADDRESS') }}
						</address>
					</div>
					<div class="col-lg-6 text-right">
						<p class="h3"></p>
						<address>
							@if($user)
								{{ $user->firstname.' '.$user->lastname }}<br>
								{{ $user->address->address1 ?? '' }} {{ $user->address->address2 ?? '' }}<br>
								{{ $user->address->postalcode ?? '' }} {{ $user->address->city ?? '' }}<br>
								{{ $user->address->county ?? '' }} {{ $user->address->country ?? '' }}<br>
								{{ $user->email }}
							@else
								<em>N/A</em>
							@endif
						</address>
					</div>
				</div>
				
				<div>
					<p class="mb-1 mt-5"><span class="font-weight-semibold">{{ trans('user.account.billing.invoice.title') }} {{ trans('global.date') }}:</span> {{ ucfirst(\Carbon::parse($invoice['created'])->isoFormat('LLLL')) }}</p>
					<p class="mb-5"><span class="font-weight-semibold">{{ trans('global.payment.duedate') }}:</span> {{ \Carbon::parse($invoice['due_date'])->isoFormat('LL') }}</p>
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
							@for($i = 0; $i < count($invoice['lines']['data']); $i++)
								<tr id="{{ 'addr'.string($i) }}">
									<td class="text-center">{{ $i+1 }}<input type="hidden" name="invoiceitem[]" value="{{ $invoice['lines']['data'][$i]['id'] }}" /><button type="button" class="btn btn-sm btn-danger" onClick="$(this).closest('tr').remove();calc_total();">&times;</button></td>
									<td><input type="text" name="description[]" placeholder="Description" class="form-control" required="required" value="{{ $invoice['lines']['data'][$i]['description'] ?? $invoice['lines']['data'][$i]['plan']['name'].' ('.ucfirst($invoice['lines']['data'][$i]['plan']['interval']).')' }}" /></td>
									<td><input type="number" name="qty[]" placeholder="Qty" class="form-control qty" min="1" value="{{ $invoice['lines']['data'][$i]['quantity'] ?? '' }}" /></td>
									<td><input type="number" name="price[]" placeholder="Unit Price" class="form-control price" min="0.01" step="0.01" value="{{ (($invoice['lines']['data'][$i]['amount']/100) / $invoice['lines']['data'][$i]['quantity']) ?? '' }}" /></td>
									<td>
										<div class="input-group mb-2 mb-sm-0">
											<input type="text" name="total[]" placeholder="0" class="form-control total" readonly value="{{ ($invoice['lines']['data'][$i]['amount']/100) }}" />
											<div class="input-group-append">
							                	<span class="input-group-text">{{ strtoupper($invoice['lines']['data'][$i]['currency']) }}</span>
							                </div>
							            </div>
									</td>
								</tr>
							@endfor
							<tr id="{{ 'addr'.string($i) }}">
								<td class="text-center">{{ count($invoice['lines']['data'])+1 }}</td>
								<td><input type="text" name="description[]" placeholder="Description" class="form-control" required="required" /></td>
								<td><input type="number" name="qty[]" placeholder="Qty" class="form-control qty" min="1" /></td>
								<td><input type="number" name="price[]" placeholder="Unit Price" class="form-control price" min="0.01" step="0.01" /></td>
								<td>
									<div class="input-group mb-2 mb-sm-0">
										<input type="text" name="total[]" placeholder="0" class="form-control total" readonly />
										<div class="input-group-append">
						                	<span class="input-group-text">{{ \Setting::get('MAIN_CURRENCY') }}</span>
						                </div>
						            </div>
								</td>
							</tr>
							<tr id="{{ 'addr'.string($i+1) }}"></tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.subtotal') }}</td>
								<td class="text-right">
									<div class="input-group mb-2 mb-sm-0">
										<input type="text" name="sub_total" placeholder="0.00" class="form-control" id="sub_total" readonly />
										<div class="input-group-append">
						                	<span class="input-group-text">{{ \Setting::get('MAIN_CURRENCY') }}</span>
						                </div>
						            </div>
								</td>
							</tr>
							<tr>
								<td colspan="4" class="font-w600 text-right">{{ trans('user.account.billing.invoice.taxrate') }}</td>
								<td class="text-right">
									<div class="input-group mb-2 mb-sm-0">
						                <input type="number" class="form-control" id="tax" placeholder="0" min="0" max="100" value="0">
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
						                	<span class="input-group-text">{{ \Setting::get('MAIN_CURRENCY') }}</span>
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
						                	<span class="input-group-text">{{ \Setting::get('MAIN_CURRENCY') }}</span>
						                </div>
						            </div>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-label">{{ trans('user.account.billing.invoice.invoiceto') }}:</label>
					<p>{{ User::getFullnameAndNicknameByID($user->id) }}</p>
					<input type="hidden" name="user_id" value="{{ $user->id }}">
				</div>
				<div class="form-group">
					<label class="form-label">Memo:</label>
					<textarea name="memo" class="form-control" placeholder="Add a memo here for the user to read.">{{ $invoice['description'] }}</textarea>
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

		    var i = {{ count($invoice['lines']['data'])+1 ?? 1 }};
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
			calc();
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