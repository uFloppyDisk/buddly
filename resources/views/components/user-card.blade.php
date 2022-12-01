<div class="overflow-hidden my-3 px-3 py-2 rounded shadow">
    <div class="row align-items-end">
        <div class="col">
            <div class="row align-items-center">
                <div class="col-auto pe-0">
                    <h5>{{ $user->name_full }}</h5>
                </div>
                @if ($user->type == 100)
                    <div class="col-auto">
                        <span class="badge rounded-pill text-white text-bg-secondary text-truncate">{{ __('Buddly+') }}</span>
                    </div>
                @endif
            </div>
            <div class="row overflow-hidden">
                <div class="col">
                    {{-- TODO: Add user bio --}}
                    <p class="text-start">{{ fake()->paragraph() }}</p>
                </div>
            </div>
        </div>
        <div class="col-auto align-self-start">
            @if (!is_null($user->age))
                {{ $user->age }}
            @else
                {{ __('?')}}
            @endif
        </div>
        <div class="col-auto align-self-start">
            {{-- TODO: Add gender expression icon --}}
        </div>
    </div>
    <div class="row">
        <div class="col ms-2">
            @php
                $max = 2;
                $count = count($interests);
            @endphp
            @if ($count > 0)
                <div class="row mt-4">
                    <div class="col"><span class="fst-italic text-muted">Interested in:</span></div>
                </div>
                <div class="row">
                    @foreach ($interests as $index => $interest)
                        @if ($index > ($max - 1))
                            @break
                        @endif
                        <div class="col-auto mx-1 px-0">
                            <span class="badge rounded-pill text-bg-primary text-truncate">{{ $interest->title }}</span>
                        </div>
                    @endforeach

                    @if ($count > $max)
                        <div class="col-auto mx-1 px-0">
                            <span class="badge rounded-pill text-bg-light text-truncate">{{ __('+') }} {{ $count - $max }} {{ __('more') }}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>


