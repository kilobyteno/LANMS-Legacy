@extends('layouts.main')
@section('title', trans('user.addressbook.title'))
@section('content')

<div class="container">
    <div class="page-header">
        <h4 class="page-title">{{ trans('user.addressbook.title') }} <a class="btn btn-sm btn-success pull-right" href="{{ route('account-addressbook-create') }}"><i class="fa fa-plus"></i> {{ trans('global.add') }}</a></h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account') }}">{{ trans('user.account.title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('user.addressbook.title') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12"> 
            @if(Sentinel::getUser()->reservations->count() <> 0)
                <div class="alert alert-info" role="alert"><i class="fas fa-info mr-2" aria-hidden="true"></i> {{ trans('user.addressbook.alert.nodeletewhilereservation') }}</div>
            @endif
            @if($addresses->count() == 0)
                <blockquote>
                    <p><em>{!! trans('user.addressbook.noaddress', ['url' => route('account-addressbook-create')]) !!}</em></p>
                </blockquote>
            @else
                <div class="row">
                    <?php $i=0; ?>
                    @foreach($addresses as $address)
                        <?php $i++; ?>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header @if($address->main_address) bg-primary @endif br-tr-7 br-tl-7">
                                    <h3 class="card-title  @if($address->main_address) text-white @endif">{{ trans('user.addressbook.address') }} #{{ $i }}</h3>
                                </div>
                                <div class="card-body">
                                    <address>
                                        <strong>{{ $address->address1 }}</strong>@if($address->address2), {{ $address->address2 }}@endif<br>
                                        {{ $address->postalcode }}, {{ $address->city }}<br>
                                        {{ $address->county }}<br>
                                        {{ $address->country }}
                                    </address>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-sm btn-warning" href="{{ route('account-addressbook-edit', $address->id) }}"><i class="fas fa-edit"></i> {{ trans('global.edit') }}</a>
                                    @if(Sentinel::getUser()->reservations->count() == 0)
                                        <button id="address-destroy-{{ $address->id }}" class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></i> {{ trans('global.delete') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('javascript')
<script src="{{ Theme::url('js/vendors/sweetalert.min.js') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        @if(Sentinel::getUser()->reservations->count() == 0)
            @foreach($addresses as $address)
                $("#address-destroy-{{ $address->id }}").click(function(){
                    swal({
                        title: "{{ trans('global.delete') }} {{ trans('user.addressbook.address') }}: {{ $address->address1 }}",
                        text: "{{ trans('user.addressbook.areyousure') }}",
                        icon: "error",
                        buttons: ['{{ trans('global.no') }}', '{{ trans('global.yes') }}'],
                        closeOnClickOutside: false
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.replace("{{ route('account-addressbook-destroy', $address->id) }}");
                        } else {
                            swal({
                                title: "{{ trans('user.addressbook.swal.title') }}",
                                text: "{{ trans('user.addressbook.swal.text') }}",
                                icon: "success",
                            });
                        }
                    });
                });
            @endforeach
        @endif
    });
</script>
@stop