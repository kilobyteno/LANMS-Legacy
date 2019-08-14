@extends('layouts.main')
@section('title', 'Product: '.$product['name'])
@section('content')

<div class="page-header">
    <h4 class="page-title">Product: {{ $product['name'] }}</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin-billing-products') }}">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product: {{ $product['name'] }}</li>
    </ol>
</div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Details</h3>
                        <div class="card-options">
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a></a>
                            <a href="#" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash mr-2"></i>Delete</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p><span class="text-muted">ID:</span> {{ $product['id'] }}</p>
                                <p><span class="text-muted">Created:</span> {{ \Carbon::parse($product['created'])->toDateTimeString() }}</p>
                                <p><span class="text-muted">Name:</span> {{ $product['name'] ?? '' }}</p>
                                <p><span class="text-muted">Caption:</span> {{ $product['caption'] ?? '' }}</p>
                                <p><span class="text-muted">Description:</span> {{ $product['description'] ?? '' }}</p>
                                <p><span class="text-muted">URL:</span> {{ $product['url'] ?? '' }}</p>
                            </div>
                            <div class="col-6">
                                <p><span class="text-muted">Active:</span> @if($product['active']){{ trans('global.yes') }}@else{{ trans('global.no') }}@endif</p>
                                <p><span class="text-muted">Attributes:</span> @if($product['attributes'])@foreach($product['attributes'] as $attribute)<span class="tag tag-blue mr-1">{{ $attribute }}</span>@endforeach @endif</p>
                                <p><span class="text-muted">Shippable:</span> @if($product['shippable']){{ trans('global.yes') }}@else{{ trans('global.no') }}@endif</p>
                                <p><span class="text-muted">Dimensions:</span> {{ $product['package_dimensions']['height'].' in' ?? 'N/A' }} <span class="text-muted">&times;</span> {{ $product['package_dimensions']['width'].' in' ?? 'N/A' }} <span class="text-muted">&times;</span> {{ $product['package_dimensions']['length'].' in' ?? 'N/A' }}</p>
                                <p><span class="text-muted">Weight:</span> {{ $product['package_dimensions']['weight'].' ounces' ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inventory (SKU)</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Active</th>
                                    <th>Price</th>
                                    <th>Attributes</th>
                                    <th>Availablity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product['skus']['data'] as $sku)
                                    <tr>
                                        <th scope="row">{{ $sku['id'] }}</th>
                                        <td>@if($sku['active']){{ trans('global.yes') }}@else{{ trans('global.no') }}@endif</td>
                                        <th>{{ floatval($sku['price']/100).' '.strtoupper($sku['currency']) }}</th>
                                        <td>@if($sku['attributes'])@foreach($sku['attributes'] as $attribute)<span class="tag tag-gray mr-1">{{ $attribute }}</span>@endforeach @else {{ 'N/A' }} @endif</td>
                                        <td>
                                            @if($sku['inventory']['type']=='finite')
                                                @if($sku['inventory']['quantity'] <= 3)
                                                    <span class="tag tag-red">
                                                @elseif($sku['inventory']['quantity'] < 10)
                                                    <span class="tag tag-orange">
                                                @else
                                                    <span class="tag tag-gray">
                                                @endif
                                                {{ $sku['inventory']['quantity'].' left' }}</span>
                                            @elseif($sku['inventory']['type']=='bucket')
                                                {{ $sku['inventory']['value'] }}
                                            @else
                                                {{ ucfirst($sku['inventory']['type']) }}
                                            @endif
                                        </td>
                                        <td><a href="" class="btn-link mr-3"><i class="fas fa-edit mr-1"></i>Edit</a><a href="" class="btn-link"><i class="fas fa-trash mr-1"></i>Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Events</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{!! trans('billing.event.'.$event['type'], ['id' => $event['data']['object']['id']]) !!}</td>
                                <td width="10%" class="text-muted">{{ \Carbon::parse($event['created'])->isoFormat('LLLL') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop