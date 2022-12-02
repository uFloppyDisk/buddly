<div class="col-auto px-1 align-self-start">
    @if (!is_null($birthdate))
        @php
            $birthdate = date_create($birthdate);
            $today = date_create(date('Y-m-d', time()));
        @endphp
        {{ date_diff($birthdate, $today)->format('%y') }}
    @else
        {{ __('?')}}
    @endif
</div>
<div class="col-auto px-1 align-self-start">
    <div class="icon d-flex pt-2 align-items-center justify-content-center">
    @switch($gender)
        @case(0)
            <span class="fa-solid fa-mars"></span>
            @break
        @case(1)
            <span class="fa-solid fa-venus"></span>
            @break
        @case(2)
            <span class="fa-solid fa-transgender"></span>
            @break

        @default
            <span class="fa-solid fa-genderless"></span>
    @endswitch
    </div>
</div>