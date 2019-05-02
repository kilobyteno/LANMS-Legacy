@extends('layouts.main')
@section('title', trans('user.account.billing.subscriptions.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ trans('user.account.billing.subscriptions.title') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('user.dashboard.title') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('user.account.billing.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.billing.subscriptions.title') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12"> 
            <div class="card">
                @if(count($subscriptions) == 0)
                    <div class="card-body">
                        <p><em>{{ trans('global.nodata') }}</em></p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <th>{{ trans('global.date') }}</th>
                                <th>Name</th>
                                <th>Pricing</th>
                                <th>{{ trans('global.details') }}</th>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ ucfirst(\Carbon::parse($subscription['created'])->isoFormat('LLLL')) }}</td>
                                        <td>{{ $subscription['plan']['name'] }}</td>
                                        <td>{{ moneyFormat(floatval($subscription['plan']['amount']/100), strtoupper($subscription['plan']['currency'])) }} / {{ trans('user.account.billing.subscriptions.'.strtolower($subscription['plan']['nickname'])) }}</td>
                                        <td><a href="{{ route('account-billing-subscription', $subscription['id']) }}" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i> {{ trans('global.view') }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop