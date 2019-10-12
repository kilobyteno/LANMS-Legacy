@extends('layouts.main')
@section('title', trans('user.account.billing.invoice.title'))
@section('content')

<div class="page-header">
    <h4 class="page-title">{{ trans('user.account.billing.invoice.title') }} <a class="btn btn-sm btn-success ml-2" href="{{ route('admin-billing-invoice-create') }}"><i class="fa fa-plus"></i> {{ trans('global.add') }}</a></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.billing.invoice.title') }}</li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if(count($invoices) == 0)
                <div class="card-body">
                    <p><em>{{ trans('global.nodata') }}</em></p>
                </div>
            @else
                <div class="card-body">
                    <table class="table table-striped table-bordered dataTable no-footer" id="table-1">
                        <thead>
                            <th>{{ trans('user.account.billing.invoice.title') }} #</th>
                            <th>User</th>
                            <th>{{ trans('global.date') }}</th>
                            <th>{{ trans('global.payment.amount') }}</th>
                            <th>{{ trans('global.payment.duedate') }}</th>
                            <th>{{ trans('global.payment.paid') }}</th>
                            <th>{{ trans('global.status') }}</th>
                            <th>{{ trans('global.details') }}</th>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice['number'] }}</td>
                                    <?php $user = \LANMS\StripeCustomer::where('cus', $invoice['customer'])->first() or null; ?>
                                    <td>@if($user)<a href="{{ route('admin-user-edit', $user->user->id) }}">{{ $user->user->firstname . ' "' . $user->user->username . '" ' . $user->user->lastname }}</a>@endif</td>
                                    <td>{{ \Carbon::parse($invoice['date'])->toDateTimeString() }}</td>
                                    <td>{{ floatval($invoice['total']/100).' '.strtoupper($invoice['currency']) }}</td>
                                    <td>@if(\Carbon::parse($invoice['due_date'])->isPast() && !$invoice['paid'])<span class="text-danger font-weight-bold">{{ \Carbon::parse($invoice['due_date'])->toDateTimeString() }}</span> @else {{ \Carbon::parse($invoice['due_date'])->toDateTimeString() }}@endif</td>
                                    <td>@if($invoice['status']=='draft') - @else{{ ($invoice['paid'] ? trans('global.yes') : trans('global.no')) }}@endif</td>
                                    <td>@if($invoice['status'] == 'draft' && $invoice['auto_advance'] == true){{ trans('user.account.billing.invoice.status.scheduled') }}@else{{ trans('user.account.billing.invoice.status.'.$invoice['status']) }}@endif</td>
                                    <td>
                                        <a href="{{ route('admin-billing-invoice-show', $invoice['id']) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>{{ trans('global.view') }}</a>
                                        @if($invoice['status'] == 'draft')<a href="{{ route('admin-billing-invoice-edit', $invoice['id']) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>{{ trans('global.edit') }}</a>@endif
                                        @if(Sentinel::hasAccess('admin.billing.destroy') && $invoice['status'] == 'draft')
                                            <a href="javascript:;" onclick="jQuery('#invoice-destroy-{{ $invoice['id'] }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>{{ trans('global.delete') }}</a>
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
            });
        } );
    </script>
@stop