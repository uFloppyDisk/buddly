@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row flex-nowrap justify-content-center">
        <div class="col-9">
            <div class="d-flex flex-column flex-shrink-0 py-3 bg-light">
                <div class="container">
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
                    <ul class="list-group">
                        @php
                            $convs = $user->conversations();
                        @endphp
                        @foreach ($user->conversations() as $conv)
                            @php
                                $initiator = $conv->initiator;
                                $participant = $conv->participant;

                                $other = $initiator;
                                if ($user->id == $other->id) {
                                    $other = $participant;
                                }

                                $last_message = $conv->messages->first();
                            @endphp
                            <li class="list-group-item"
                                onclick="location.href = '{{ route('chat.view', ['conversation_id' => $conv->id]) }}'"
                                style="cursor: pointer;">
                                <div class="row align-items">
                                    @if (is_null($last_message))
                                        <div class="col-auto pe-0">
                                            <span class="badge bg-light text-dark">New!</span></h1>
                                        </div>
                                    @endif
                                    <div class="col-auto pe-0 fs-4 text-primary">
                                        {{ $other->name_full }}
                                    </div>
                                    <div class="col-auto align-self-end">
                                        @if ($other->type == 100)
                                            <span class="badge rounded-pill text-white text-bg-secondary text-truncate">{{ __('Buddly+') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if (!is_null($last_message))
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="col fw-bolder">
                                                @if ($last_message->author_id == $user->id)
                                                    {{ __('YOU') }}
                                                @else
                                                    {{ $other->name_first }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            {{ $last_message->message }}
                                        </div>
                                        <div class="col-auto">
                                            <span class="col">
                                                @php
                                                    $target = $last_message->created_at->setTimezone(new DateTimeZone("PST"));

                                                    $now = new DateTime("now", new DateTimeZone("PST"));
                                                    $time_elapsed = $now->diff($target);
                                                @endphp
                                                @if ($time_elapsed->days == false)
                                                    {{ $target->format("g:i A")}}
                                                @elseif ($time_elapsed->days == 1)
                                                    yesterday
                                                @elseif ($time_elapsed->days < 7)
                                                    {{ $target->format("l") }}
                                                @elseif ($time_elapsed->days < 365)
                                                    {{ $target->format("M j") }}
                                                @else
                                                    {{ $target->format("M j, Y") }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection