<div class="my-3 px-3 pt-3 pb-2 rounded shadow">
    <div class="row align-items-start px-2">
        <div class="col-auto align-self-center p-0">
            <div class="img-frame">
                <img class="img-fluid user-card" src="{{ fake()->imageUrl(200, 100, 'buddly.ca')}}" alt="">
            </div>
        </div>
        <div class="col">
            <div class="row align-self-center align-items-center">
                <div class="col-auto pe-0">
                    <h5 class="mb-0 fs-5">{{ $user->name_full }}</h5>
                </div>
                <div class="col-auto">
                    @if ($user->type == 100)
                        <span class="badge rounded-pill text-white text-bg-secondary text-truncate">{{ __('Buddly+') }}</span>
                    @endif
                </div>
            </div>
            <div class="row overflow-hidden">
                <div class="col">
                    <p class="mb-0 fs-6 text-start">{{ $profile->bio }}</p>
                </div>
            </div>
        </div>
        <x-user-demographic :birthdate="$profile->birthdate" :gender="$profile->gender"/>
    </div>
    <div class="row align-items-end">
        <div class="col ms-2">
            @php
                $max = 2;
                $count = count($interests);
            @endphp
            @if ($count > 0)
                <div class="row">
                    <div class="col"><span class="fst-italic text-muted">Interested in:</span></div>
                </div>
                <div class="row">
                    @foreach ($interests as $index => $interest)
                        @if ($index > ($max - 1))
                            @break
                        @endif
                        <div class="col-auto mx-1 px-0">
                            <a href="#" rel="tooltip" data-bs-toggle="tooltip" data-bs-title="{{ $interest->description }}">
                                <span class="badge rounded-pill text-bg-primary text-white text-truncate">{{ $interest->title }}</span>
                            </a>
                        </div>
                    @endforeach

                    @if ($count > $max)
                        <div class="col-auto mx-1 px-0">
                            <a class="dropdown" data-toggle="dropdown">
                                <span class="badge rounded-pill text-bg-light text-truncate">{{ __('+') }} {{ $count - $max }} {{ __('more') }}</span>
                                <ul class="dropdown-menu ps-1 pt-1">
                                    @foreach ($interests as $index => $interest)
                                        @if ($index > ($max - 1))
                                            <li class="m-1"><span class="badge rounded-pill text-bg-primary text-white text-truncate">{{ $interest->title }}</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <div class="col-auto">
            <a href="{{ route('profile.show', ['profile_id' => $user->id]) }}">
                {{ __('View Profile') }}
            </a>
        </div>
    </div>
</div>


