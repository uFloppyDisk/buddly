@extends('layouts.app')

@section('assets')
    @include('profile._assets')
@endsection

@section('content')
@php
    $user = Auth::user();
    $profile = $user->profile;

    $val_bio = null;
    $val_renter = null;
    $val_birthdate = null;
    $val_gender = null;
    if (!is_null($profile)) {
        $val_bio = $profile->bio;
        $val_renter = $profile->is_renter;
        $val_birthdate = $profile->birthdate;
        $val_gender = $profile->gender;
    }
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="row">
                <div class="col">
                    <span class="fw-bolder fs-3">{{$user->name_full}}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('profile.edit.publish') }}">
                @csrf

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="in_bio" class="form-label">Biography</label>
                            <textarea class="form-control ps-3" name="in_bio" rows="3">{{ !is_null($val_bio) ? $val_bio : '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="in_renter" value="" {{ !is_null($val_renter) && $val_renter == "1" ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                I will be accepting payment
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="in_birthdate">Birthdate</label>
                            <input name="in_birthdate" class="form-control h-100 fs-6 ps-3" type="date"
                                value="{{ !is_null($val_birthdate) ? $val_birthdate : '' }}"
                                min="{{ date('Y-m-d', strtotime('-120 year', time())) }}"
                                max="{{ date('Y-m-d', strtotime('-18 year', time())) }}"
                            > {{-- date('Y-m-d', strtotime('-18 year', time()) --}}
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="in_gender">Gender</label>
                            <select class="form-select" name="in_gender">
                                @php
                                    $sel = !is_null($val_gender) ? $val_gender : -1;

                                    $options = ["Male", "Female", "Transgender", "Prefer to not specify"]
                                @endphp

                                <option value="3" @if ($sel > 0)selected @endif>Choose...</option>
                                @foreach ($options as $index => $opt)
                                    <option value="{{ $index }}" @if ($sel == $index)selected @endif>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <input type="hidden" name="account_id" value="{{ $user->id }}">
                        <button class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection