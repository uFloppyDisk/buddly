@extends('layouts.app')

@section('assets')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>

<script defer>
    $(function () {
        $("[rel='tooltip']").tooltip();
    })
</script>

<style>
    .img-frame {
        width: 250px;
        height: 250px;
        vertical-align: middle;
        text-align: center;
        display: table-cell;
    }

    img.user-card {
        height: 100%;

        object-fit: cover;
    }
</style>
@endsection

@section('content')
@php
    $user = Auth::user();
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
                <div class="row px-3">
                    <div class="col-3 align-self-center p-0">
                        <div class="img-frame">
                            <img class="img-fluid user-card" src="{{ fake()->imageUrl(300, 300, 'buddly.ca')}}" alt="">
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
                    <div class="col">
                        <div class="row align-items-center justify-content-end">
                            <div class="col pe-0 text-center">
                                <h4>{{ $user->name_full }}</h4>
                            </div>
                            @if ($user->type == 100)
                                <div class="col-auto float-end">
                                    <span class="badge rounded-pill text-white text-bg-secondary text-truncate">{{ __('Buddly+') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-header">Biography</div>
                            <div class="card-body">
                                <p class="card-text fs-5">{{ $profile->bio }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
