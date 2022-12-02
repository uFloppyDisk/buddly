@extends('layouts.app')

@section('assets')
    @include('profile._assets')
@endsection

@section('content')
@php
    $user = isset($user) ? $user : Auth::user();

    $profile = $user->profile;
    $interests = $user->interests;
@endphp

@if (session('status'))
    @switch(session('status')['type'])
        @case('success')
            <div class="alert alert-success" role="alert">
                {{ session('status')['message'] }}
            </div>
            @break

        @case('error')
            <div class="alert alert-danger" role="alert">
                {{ session('status')['message'] }}
            </div>
            @break

        @default
            <div class="alert alert-info" role="alert">
                {{ session('status')['message'] }}
            </div>

    @endswitch
@endif
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2 align-items-center justify-content-end">
                    {{-- <div class="col-3"></div> --}}
                    <div class="col ps-3 pe-0 text-start">
                        <h4>{{ $user->name_full }}</h4>
                        {{-- <x-user-demographic :birthdate="$profile->birthdate" :gender="$profile->gender"> --}}
                    </div>
                    @if (Route::currentRouteName() == "profile")
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ route('profile.edit') }}" role="button">{{ __('Edit Profile') }}</a>
                        </div>
                    @endif
                </div>
                <div class="row px-3">
                    <div class="col-3 align-self-start p-0">
                        <div class="img-frame">
                            <img class="img-fluid user-card" src="{{ fake()->imageUrl(200, 200, 'buddly.ca')}}" alt="">
                                @if ($user->type == 100)
                                    {{-- <div class="col-auto float-end">
                                        <span class="badge rounded-pill text-white text-bg-secondary text-truncate">{{ __('Buddly+') }}</span>
                                    </div> --}}
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                        {{ __('Buddly+') }}
                                    </span>
                                @endif
                            </img>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">Biography</div>
                            <div class="card-body">
                                <p class="card-text fs-5">{{ $profile->bio }}</p>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-header">Interests</div>
                            <div class="row card-body">
                                @if (!is_null($interests))
                                    @foreach ($interests as $interest)
                                        <x-interest-pill :interest="$interest"/>
                                    @endforeach
                                @else
                                    <div class="col">No Interests Specified</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
