@extends('layouts.main')
@section('title', __('user.account.billing.invoice.title'))
@section('content')

<div class="page-header">
    <h4 class="page-title">{{ __('user.account.billing.invoice.title') }} <a class="btn btn-sm btn-success ml-2" href="{{ route('admin-billing-invoice-create') }}"><i class="fa fa-plus"></i> {{ __('global.add') }}</a></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
        <li class="breadcrumb-item">{{ __('user.account.billing.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('user.account.billing.invoice.title') }}</li>
    </ol>
</div>

<div class="row">
    <div class="col-12">

        @if(!\LANMS\Info::getContent('address_city') || !\LANMS\Info::getContent('address_country') || !\LANMS\Info::getContent('address_county') || !\LANMS\Info::getContent('address_postal_code') || !\LANMS\Info::getContent('address_street'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong class="text-uppercase"><i class="far fa-frown mr-2" aria-hidden="true"></i> Missing critical info value</strong>
                <hr class="message-inner-separator">
                <p>One or more address fields in Info is missing. You need this to be able to send invoices! <a href="{{ route('admin-info') }}" class="alert-link">Click here to fix it!</a></p>
            </div>
        @endif

        <div class="card">
            @if(count($invoices) == 0)
                <div class="card-body">
                    <p><em>{{ __('global.nodata') }}</em></p>
                </div>
            @else
                <div class="card-body">
                    <table class="table table-striped table-bordered dataTable no-footer" id="table-1">
                        <thead>
                            <th>{{ __('user.account.billing.invoice.title') }} #</th>
                            <th>User</th>
                            <th>{{ __('global.date') }}</th>
                            <th>{{ __('global.payment.amount') }}</th>
                            <th>{{ __('global.payment.duedate') }}</th>
                            <th>{{ __('global.payment.paid') }}</th>
                            <th>{{ __('global.status') }}</th>
                            <th>{{ __('global.details') }}</th>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice['number'] }}</td>
                                    <?php $user = \LANMS\User::where('stripe_customer', $invoice['customer'])->first() or null; ?>
                                    <td>@if($user)<a href="{{ route('admin-user-edit', $user->id) }}">{{ $user->firstname . ' "' . $user->username . '" ' . $user->lastname }}</a>@endif</td>
                                    <td>{{ \Carbon::parse($invoice['date'])->toDateTimeString() }}</td>
                                    <td>{{ moneyFormat(floatval($invoice['total']/100), strtoupper($invoice['currency'])) }}</td>
                                    <td>@if(\Carbon::parse($invoice['due_date'])->isPast() && $invoice['status'] != 'void' && !$invoice['paid'])<span class="text-danger font-weight-bold">{{ \Carbon::parse($invoice['due_date'])->toDateTimeString() }}</span> @else {{ \Carbon::parse($invoice['due_date'])->toDateTimeString() }}@endif</td>
                                    <td>@if($invoice['status']=='draft') - @else{{ ($invoice['paid'] ? __('global.yes') : __('global.no')) }}@endif</td>
                                    <td>
                                        @if($invoice['status'] == 'draft' && $invoice['auto_advance'] == true)
                                            {{ __('user.account.billing.invoice.status.scheduled') }}
                                        @else
                                            {{ __('user.account.billing.invoice.status.'.$invoice['status']) }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin-billing-invoice-show', $invoice['id']) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>{{ __('global.view') }}</a>
                                        @if($invoice['status'] == 'draft')<a href="{{ route('admin-billing-invoice-edit', $invoice['id']) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>{{ __('global.edit') }}</a>@endif
                                        @if(Sentinel::hasAccess('admin.billing.destroy') && $invoice['status'] == 'draft')
                                            <a href="javascript:;" onclick="jQuery('#invoice-destroy-{{ $invoice['id'] }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>{{ __('global.delete') }}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@foreach($invoices as $invoice)
    <div class="modal fade" id="invoice-destroy-{{ $invoice['id'] }}" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Delete invoice:</strong> #{{ $invoice['id'] }}</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-danger text-center"><strong>Are you sure you want to delete this invoice?</strong></h4>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin-billing-invoice-destroy', $invoice['id']) }}" class="btn btn-danger">Yes, I want to delete it.</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, take me away!</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@stop

@section('css')
    <link href="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@stop
@section('javascript')
    <script src="{{ Theme::url('plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-1').DataTable({
                order: [2, "desc"],
                responsive: true,
                "iDisplayLength": 25
            });
        } );
    </script>
@stop