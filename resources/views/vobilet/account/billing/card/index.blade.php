@extends('layouts.main')
@section('title', trans('user.account.billing.card.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ trans('user.account.billing.card.title') }} <a class="btn btn-sm btn-success ml-2" href="{{ route('account-billing-card-create') }}"><i class="fa fa-plus"></i> {{ trans('global.add') }}</a></h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('user.account.billing.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('user.account.billing.card.title') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(Sentinel::getUser()->addresses->count() == 0)
                <div class="alert alert-warning" role="alert"> <i class="fas fa-exclamation mr-2" aria-hidden="true"></i> {!! trans('user.account.billing.alert.noaddress', ['url' => route('account-addressbook-create')]) !!}</div>
            @endif
            <div class="card">
                @if(count($cards) == 0)
                    <div class="card-body">
                        <p><em>{{ trans('global.nodata') }}</em></p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <th></th>
                                <th>{{ trans('global.payment.cardbrand') }}</th>
                                <th>{{ trans('global.payment.cardtype.title') }}</th>
                                <th>{{ trans('global.payment.cardname') }}</th>
                                <th>{{ trans('global.payment.cardnumber') }}</th>
                                <th>{{ trans('global.payment.cardexp') }}</th>
                                <th>{{ trans('global.details') }}</th>
                            </thead>
                            <tbody>
                                @foreach($cards as $card)
                                    <tr>
                                        <td>@if(array_search($card, $cards) == 0) <span class="badge badge-default">{{ trans('global.default') }}</span> @endif</td>
                                        <td>{{ $card['brand'] }}</td>
                                        <td>{{ trans('global.payment.cardtype.'.$card['funding']) }}</td>
                                        <td>{{ $card['name'] }}</td>
                                        <td>&#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; {{ $card['last4'] }}</td>
                                        <td>{{ $card['exp_month'] }} / {{ $card['exp_year'] }}</td>
                                        <td>
                                            <a href="{{ route('account-billing-card-destroy', $card['id']) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> {{ trans('global.delete') }}</a>
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
</div>
@stop