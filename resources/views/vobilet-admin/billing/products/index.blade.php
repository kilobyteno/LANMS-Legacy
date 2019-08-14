@extends('layouts.main')
@section('title', 'Products')
@section('content')

<div class="page-header">
    <h4 class="page-title">Products <a class="btn btn-sm btn-success ml-2" href="{{ route('admin-billing-products-create') }}"><i class="fa fa-plus"></i> {{ trans('global.add') }}</a></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if(count($products) == 0)
                <div class="card-body">
                    <p><em>{{ trans('global.nodata') }}</em></p>
                </div>
            @else
                <div class="card-body">
                    <table class="table table-striped table-bordered dataTable no-footer" id="table-1">
                        <thead>
                            <th>Name</th>
                            <th>{{ trans('global.date') }}</th>
                            <th>Type</th>
                            <th>SKUs</th>
                            <th>Shippable</th>
                            <th>Active</th>
                            <th>{{ trans('global.details') }}</th>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ \Carbon::parse($product['created'])->toDateTimeString() }}</td>
                                    <td>{{ ucfirst($product['type']) }}</td>
                                    <td>{{ $product['skus']['total_count'] ?? '' }}</td>
                                    <td>@if($product['shippable']){{ trans('global.yes') }}@else{{ trans('global.no') }}@endif</td>
                                    <td>@if($product['active']){{ trans('global.yes') }}@else{{ trans('global.no') }}@endif</td>
                                    <td>
                                        <a href="{{ route('admin-billing-products-show', $product['id']) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-2"></i>{{ trans('global.view') }}</a>
                                        <a href="{{ route('admin-billing-products-edit', $product['id']) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>{{ trans('global.edit') }}</a>
                                        @if(Sentinel::hasAccess('admin.billing.destroy'))
                                            <a href="javascript:;" onclick="jQuery('#product-destroy-{{ $product['id'] }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>{{ trans('global.delete') }}</a>
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

@foreach($products as $product)
    <div class="modal fade" id="product-destroy-{{ $product['id'] }}" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Delete product:</strong> #{{ $product['id'] }}</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-danger text-center"><strong>Are you sure you want to delete this product?</strong></h4>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin-billing-products-destroy', $product['id']) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
                order: [0, "desc"],
            });
        } );
    </script>
@stop