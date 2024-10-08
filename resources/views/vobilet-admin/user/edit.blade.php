@extends('layouts.main')
@section('title', 'Edit User: '.$user->username.' - Admin')
@section('content')

<div class="page-header">
    <h4 class="page-title">Edit User: {{ $user->username }}</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin-users') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User: {{ $user->username }}</li>
    </ol>
</div>

<div class="row">
    <div class="col-12">

        <form action="{{ route('admin-user-update', $user->id) }}" method="post" class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if(\Activation::completed($user) && !$user->deleted_at)<div class="badge badge-primary">Activated</div>@endif
                    @if($user->last_login)<div class="badge badge-info">Has logged in</div>@endif
                    @if($user->deleted_at)<div class="badge badge-secondary">Deactivated</div>@endif
                    @if($user->isAnonymized)<div class="badge badge-danger">Anonymized</div>@endif
                </h3>
                <div class="card-options">
                    <a class="btn btn-info mr-2" href="{{ route('admin-user-resendverification', $user->id) }}"><i class="fas fa-user-check mr-2"></i>Resend Activation Email</a>
                    <a class="btn btn-info mr-2" href="{{ route('admin-user-forgotpassword', $user->id) }}"><i class="fas fa-asterisk mr-2"></i>Reset password</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Save</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="expanel expanel-default" data-collapsed="0">
                            <div class="expanel-heading">
                                <div class="expanel-title">User Information</div>
                            </div>
                            <div class="expanel-body">
                                <label class="form-label">User ID:</label>
                                <p>{{ $user->id }}</p>
                                <label class="form-label">UUID:</label>
                                <p>{{ $user->uuid }}</p>
                                <label class="form-label">Last Login:</label>
                                <p>{{ ucfirst(\Carbon::parse($user->last_login)->isoFormat('LLLL')) }}</p>
                                <label class="form-label">Last Activity:</label>
                                <p>{{ ucfirst(\Carbon::parse($user->last_activity)->isoFormat('LLLL')) }}</p>
                                <label class="form-label">Accepted GDPR:</label>
                                @if($user->accepted_gdpr){{ __('global.yes') }}@elseif(!$user->accepted_gdpr){{ __('global.no') }}@endif
                            </div>
                        </div>
                        <div class="expanel expanel-default" data-collapsed="0">
                            <div class="expanel-heading">
                                <h3 class="expanel-title">{{ __('global.verification') }}</h3>
                            </div>
                            <div class="expanel-body">
                                <p class="@if(Activation::completed($user)){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-envelope"></i> {{ __('global.email') }} @if(Activation::completed($user)){{ __('global.verified') }}@else{{ __('global.notverified') }}@endif</p>
                                <p class="@if($user->phone_verified_at){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-phone"></i> {{ __('global.phone') }} @if($user->phone_verified_at){{ __('global.verified') }}@else{{ __('global.notverified') }}@endif</p>
                                <p class="@if($user->authy_id){{'text-success'}}@else{{'text-danger'}}@endif"><i class="fas fa-user-lock"></i> {{ __('global.2fa') }} <span class="text-lowercase">@if($user->authy_id){{ __('global.activated') }}@else{{ __('global.deactivated') }}@endif</span></p>
                            </div>
                        </div>
                        <div class="expanel expanel-default" data-collapsed="0">
                            <div class="expanel-heading">
                                <div class="expanel-title">User Details</div>
                            </div>
                            <div class="expanel-body">
                                <div class="form-group @if($errors->has('firstname')) has-error @endif">
                                    <label for="firstname" class="form-label">Firstname</label>
                                    <input type="text" class="form-control" name="firstname" autocomplete="off" value="{{ (old('firstname')) ? old('firstname') : $user->firstname }}" />
                                    @if($errors->has('firstname'))
                                        <p class="text-danger">{{ $errors->first('firstname') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('lastname')) has-error @endif">
                                    <label for="lastname" class="form-label">Lastname</label>
                                    <input type="text" class="form-control" name="lastname" autocomplete="off" value="{{ (old('lastname')) ? old('lastname') : $user->lastname }}" />
                                    @if($errors->has('lastname'))
                                        <p class="text-danger">{{ $errors->first('lastname') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('username')) has-error @endif">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="username" autocomplete="off" value="{{ (old('username')) ? old('username') : $user->username }}" />
                                    </div>
                                    @if($errors->has('username'))
                                        <p class="text-danger">{{ $errors->first('username') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('email')) has-error @endif">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="email" autocomplete="off" value="{{ (old('email')) ? old('email') : $user->email }}" />
                                    </div>
                                    @if($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="expanel expanel-default" data-collapsed="0">
                            <div class="expanel-heading">
                                <div class="expanel-title">Personal Details</div>
                            </div>
                            <div class="expanel-body">
                                <div class="form-group @if($errors->has('gender')) has-error @endif">
                                    <label for="gender" class="form-label">Gender</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-{{ User::getGenderIcon($user->gender) }}"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="gender">
                                            <option value="">-- Please select --</option>
                                            <option value="Male" {{ ($user->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ ($user->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                            <option value="Transgender" {{ ($user->gender == 'Transgender') ? 'selected' : '' }}>Transgender</option>
                                            <option value="Genderless" {{ ($user->gender == 'Genderless') ? 'selected' : '' }}>Genderless</option>
                                        </select>
                                    </div>
                                    @if($errors->has('gender'))
                                        <p class="text-danger">{{ $errors->first('gender') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('location')) has-error @endif">
                                    <label for="location" class="form-label">Location</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-map-marker"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="location" autocomplete="off" value="{{ (old('location')) ? old('location') : $user->location }}" />
                                    </div>
                                    @if($errors->has('location'))
                                        <p class="text-danger">{{ $errors->first('location') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('occupation')) has-error @endif">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="occupation" autocomplete="off" value="{{ (old('occupation')) ? old('occupation') : $user->occupation }}" />
                                    </div>
                                    @if($errors->has('occupation'))
                                        <p class="text-danger">{{ $errors->first('occupation') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('birthdate')) has-error @endif">
                                    <label for="birthdate" class="form-label">Birthdate <small>({{ \Carbon::parse($user->birthdate)->age }} {{ __('global.yearsold') }})</small></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-birthday-cake"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="birthdate" name="birthdate" autocomplete="off" value="{{ (old('birthdate')) ? old('birthdate') : $user->birthdate }}" />
                                    </div>
                                    @if($errors->has('birthdate'))
                                        <p class="text-danger">{{ $errors->first('birthdate') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('phone') || $errors->has('phone_country')) has-error @endif">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" autocomplete="off" value="{{ (old('phone')) ? old('phone') : $user->phone }}" />
                                    <input type="hidden" name="phone_country" id="phone_country" value="{{ $user->phone_country }}">
                                    @if($errors->has('phone') || $errors->has('phone_country'))
                                        <p class="text-danger">{{ $errors->first('phone') }}{{ $errors->first('phone_country') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if ($errors->has('clothing_size')) has-error @endif">
                                    <label class="form-label">{{ __('global.clothingsize.title') }}</label>
                                    <select class="form-control" name="clothing_size">
                                        <option value="0">{{ __('global.clothingsize.nochoice') }}</option>
                                        <option value="1" {{ ($user->clothing_size === 1) ? 'selected' : '' }}>{{ __('global.clothingsize.xs') }}</option>
                                        <option value="2" {{ ($user->clothing_size === 2) ? 'selected' : '' }}>{{ __('global.clothingsize.s') }}</option>
                                        <option value="3" {{ ($user->clothing_size === 3) ? 'selected' : '' }}>{{ __('global.clothingsize.m') }}</option>
                                        <option value="4" {{ ($user->clothing_size === 4) ? 'selected' : '' }}>{{ __('global.clothingsize.l') }}</option>
                                        <option value="5" {{ ($user->clothing_size === 5) ? 'selected' : '' }}>{{ __('global.clothingsize.xl') }}</option>
                                        <option value="6" {{ ($user->clothing_size === 6) ? 'selected' : '' }}>{{ __('global.clothingsize.xxl') }}</option>
                                        <option value="7" {{ ($user->clothing_size === 7) ? 'selected' : '' }}>{{ __('global.clothingsize.3xl') }}</option>
                                    </select>
                                    @if($errors->has('clothing_size'))
                                        <p class="text-danger">{{ $errors->first('clothing_size') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('about')) has-error @endif">
                                    <label class="form-label">{{ __('global.about') }}</label>
                                    <textarea class="form-control" rows="2" name="about">{{ (old('about')) ? old('about') : $user->about }}</textarea>
                                    @if($errors->has('about'))
                                        <p class="text-danger">{{ $errors->first('about') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="expanel expanel-default" data-collapsed="0">
                            <div class="expanel-heading">
                                <div class="expanel-title">User Settings</div>
                            </div>
                            <div class="expanel-body">
                                <div class="form-group @if($errors->has('showname')) has-error @endif">
                                    <label for="showname" class="form-label">Show Fullname</label>
                                    <select class="form-control" name="showname">
                                        <option value="1" {{ ($user->showname == '1') ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ ($user->showname == '0') ? 'selected' : '' }}>No</option>
                                    </select>
                                    @if($errors->has('showname'))
                                        <p class="text-danger">{{ $errors->first('showname') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('showemail')) has-error @endif">
                                    <label for="showemail" class="form-label">Show Email</label>
                                    <select class="form-control" name="showemail">
                                        <option value="1" {{ ($user->showemail == '1') ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ ($user->showemail == '0') ? 'selected' : '' }}>No</option>
                                    </select>
                                    @if($errors->has('showemail'))
                                        <p class="text-danger">{{ $errors->first('showemail') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('showonline')) has-error @endif">
                                    <label for="showonline" class="form-label">Show Online Status</label>
                                    <select class="form-control" name="showonline">
                                        <option value="1" {{ ($user->showonline == '1') ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ ($user->showonline == '0') ? 'selected' : '' }}>No</option>
                                    </select>
                                    @if($errors->has('showonline'))
                                        <p class="text-danger">{{ $errors->first('showonline') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if ($errors->has('language')) has-error @endif">
                                    <label class="form-label">Language</label>
                                    <select class="form-control" name="language">
                                        <option value="">-- Please Select --</option>
                                        @foreach(array_flip(config('app.locales')) as $lang)
                                            <option value="{{ $lang }}" {{ ($user->language == $lang) ? 'selected' : '' }}>{{ __('language.'.$lang) }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('language'))
                                        <p class="text-danger">{{ $errors->first('language') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Theme</label>
                                    <select class="form-control" name="theme">
                                        <option value="">-- {{ __('global.pleaseselect') }} --</option>
                                        @foreach(array_flip(config('app.themes')) as $lang)
                                            <option value="{{ $lang }}" {{ ($user->theme == $lang) ? 'selected' : '' }}>{{ __('theme.'.$lang) }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('theme'))
                                        <p class="text-danger">{{ $errors->first('theme') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="expanel expanel-default" data-collapsed="0">
                            <div class="expanel-heading">
                                <div class="expanel-title">Address</div>
                            </div>
                            <div class="expanel-body">
                                <div class="form-group @if($errors->has('address_street')) has-error @endif">
                                    <label class="form-label">{{ __('global.address.street') }}</label>
                                    <input class="form-control" name="address_street" value="{{ (old('address_street')) ? old('address_street') : $user->address_street }}">
                                    @if($errors->has('address_street'))
                                        <p class="text-danger">{{ $errors->first('address_street') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('address_postalcode')) has-error @endif">
                                    <label class="form-label">{{ __('global.address.postalcode') }}</label>
                                    <input class="form-control" name="address_postalcode" value="{{ (old('address_postalcode')) ? old('address_postalcode') : $user->address_postalcode }}">
                                    @if($errors->has('address_postalcode'))
                                        <p class="text-danger">{{ $errors->first('address_postalcode') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('address_city')) has-error @endif">
                                    <label class="form-label">{{ __('global.address.city') }}</label>
                                    <input class="form-control" name="address_city" value="{{ (old('address_city')) ? old('address_city') : $user->address_city }}">
                                    @if($errors->has('address_city'))
                                        <p class="text-danger">{{ $errors->first('address_city') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('address_county')) has-error @endif">
                                    <label class="form-label">{{ __('global.address.county') }}</label>
                                    <input class="form-control" name="address_county" value="{{ (old('address_county')) ? old('address_county') : $user->address_county }}">
                                    @if($errors->has('address_county'))
                                        <p class="text-danger">{{ $errors->first('address_county') }}</p>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('address_country')) has-error @endif">
                                    <label class="form-label">{{ __('global.address.country') }}</label>
                                    <input class="form-control" name="address_country" value="{{ (old('address_country')) ? old('address_country') : $user->address_country }}">
                                    @if($errors->has('address_country'))
                                        <p class="text-danger">{{ $errors->first('address_country') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        </form>
    </div>
</div>

<div class="row">

    <div class="col-4">
        <form action="{{ route('admin-user-update-permission', $user->id) }}" method="post" class="card">
            <div class="card-header">
                <h3 class="card-title">Permission Roles</h3>
                <div class="card-options">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save mr-2"></i>Update Permissions</button>
                </div>
            </div>
            <div class="card-body">
                <div class="input-group">
                    @foreach($roles as $role)
                        <label class="custom-control custom-checkbox mr-3 mb-2">
                            <input type="checkbox" class="custom-control-input" type="checkbox" name="role-{{ $role->slug }}" {{ $user->inRole($role) ? 'checked' : '' }}>
                            <span class="custom-control-label">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
</div>

@stop

@section('css')
    <link href="{{ Theme::url('css/intlTelInput.css') }}" rel="stylesheet" />
@stop

@section('javascript')
    <script src="{{ Theme::url('js/vendors/intlTelInput.min.js') }}"></script>
    <script>
        var input = document.querySelector("#phone");
        var countryinput = document.querySelector("#phone_country");
        var iti = window.intlTelInput(input, {
            preferredCountries: ["no"],
            initialCountry: "{{ $user->phone_country ?? 'auto' }}",
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
        });
        countryinput.value = iti.getSelectedCountryData().iso2;
        // listen to the telephone input for changes
        input.addEventListener('countrychange', function(e) {
            countryinput.value = iti.getSelectedCountryData().iso2;
            console.log('countrychange: '+iti.getSelectedCountryData().iso2);
        });
    </script>
    <script src="{{ Theme::url('js/cleave.js') }}"></script>
    <script type="text/javascript">
        var cleave = new Cleave('#birthdate', {
            date: true,
            datePattern: ['Y', 'm', 'd'],
            delimiter: '-'
        });
    </script>
@stop