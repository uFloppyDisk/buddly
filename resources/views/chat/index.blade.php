@extends('layouts.app')

@section('content')
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

<div class="container-fluid">
    <div class="row flex-nowrap justify-content-center">
        <div class="col-9">
            <div class="d-flex flex-column flex-shrink-0 py-3 bg-light">
                <div class="container">
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
                                <div class="row">
                                    <div class="col-auto fs-4">
                                        {{ $other->name_full }}
                                    </div>
                                </div>
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
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection